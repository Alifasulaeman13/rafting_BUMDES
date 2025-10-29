<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Booking;
use App\Models\Operator;
use App\Models\Boat;
use App\Models\BoatRotation;
use App\Models\Order;
use App\Models\ScheduleRotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PublicBookingController extends Controller
{
    public function create(Request $request, Package $package)
    {
        // Package sudah otomatis di-resolve oleh Laravel route model binding
        return view('bookings.public', compact('package'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'persons' => ['required', 'integer', 'min:1'],
        ]);

        // Validasi jam 09:00 - 15:00 WIB
        [$h, $m] = explode(':', $request->time);
        if ((int)$h < 9 || (int)$h > 15 || ((int)$h === 15 && (int)$m > 0)) {
            return back()->withErrors(['time' => 'Waktu harus antara 09:00 dan 15:00 WIB'])->withInput();
        }

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')
                ->withErrors(['global' => 'Silakan login untuk melakukan booking'])
                ->withInput();
        }

        return DB::transaction(function () use ($request, $userId) {
            $scheduleAt = Carbon::parse($request->date.' '.$request->time.':00');

            // Buat booking sederhana
            $booking = Booking::create([
                'user_id' => $userId,
                'package_id' => $request->package_id,
                'schedule_date' => $scheduleAt,
                'scheduled_at' => $scheduleAt,
                'number_of_persons' => (int)$request->persons,
                'total_price' => Package::find($request->package_id)->price * (int)$request->persons,
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            // Round-robin operator assignment
            $operators = Operator::where('status_aktif', true)->orderBy('id')->get();
            if ($operators->isEmpty()) {
                return back()->withErrors(['global' => 'Belum ada operator aktif'])->withInput();
            }

            $rotation = ScheduleRotation::first();
            if (!$rotation) {
                $rotation = ScheduleRotation::create(['pointer_index' => 0]);
            }

            $count = $operators->count();
            $pointer = (int)($rotation->pointer_index ?? 0);

            $assigned = null;
            for ($i = 0; $i < $count; $i++) {
                $idx = ($pointer + $i) % $count;
                $candidate = $operators[$idx];
                // batasi tugas per hari
                $assignedCount = Order::whereDate('tgl_order', $scheduleAt->toDateString())
                    ->where('assigned_operator_id', $candidate->id)
                    ->whereIn('status', ['Pending','Assigned'])
                    ->count();
                if ($assignedCount < ($candidate->max_tugas_per_hari ?? 10)) {
                    $assigned = $candidate;
                    $pointer = ($idx + 1) % $count; // next pointer
                    break;
                }
            }

            if (!$assigned) {
                return back()->withErrors(['global' => 'Semua operator penuh untuk tanggal tersebut'])->withInput();
            }

            // Simpan order penugasan operator
            Order::create([
                'booking_id' => $booking->id,
                'jenis_order' => 'orang',
                'assigned_operator_id' => $assigned->id,
                'tgl_order' => $scheduleAt,
                'status' => 'Assigned',
                'meta' => ['source' => 'public_booking'],
            ]);

            // Update pointer
            $rotation->update([
                'pointer_index' => $pointer,
                'last_assigned_operator_id' => $assigned->id,
            ]);

            // Round-robin boat assignment
            $boats = Boat::where('status', 'available')->orderBy('id')->get();
            if ($boats->isEmpty()) {
                return back()->withErrors(['global' => 'Belum ada perahu tersedia'])->withInput();
            }

            $boatRotation = BoatRotation::first();
            if (!$boatRotation) {
                $boatRotation = BoatRotation::create(['pointer_index' => 0]);
            }

            $boatCount = $boats->count();
            $boatPointer = (int)($boatRotation->pointer_index ?? 0);

            $selectedBoat = $boats[$boatPointer % $boatCount];

            // Assign boat to booking
            $booking->update(['boat_id' => $selectedBoat->id]);

            // Advance boat pointer
            $boatRotation->update([
                'pointer_index' => ($boatPointer + 1) % $boatCount,
                'last_assigned_boat_id' => $selectedBoat->id,
            ]);

            return redirect()->route('profile')->with('success', 'Booking berhasil dibuat. Anda dapat melihat status booking di profil Anda.');
        });
    }
}


