<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $activeBookings = Booking::where('status', 'active')->count();
        $totalBoatmen = User::where('role', 'boatman')->count();
        $totalRescue = User::where('role', 'rescue')->count();
        $todayBookings = Booking::whereDate('schedule_date', today())->count();

        return view('dashboard', [
            'role' => 'admin',
            'stats' => [
                'activeBookings' => $activeBookings,
                'totalBoatmen' => $totalBoatmen,
                'totalRescue' => $totalRescue,
                'todayBookings' => $todayBookings
            ]
        ]);
    }

    public function boatmanDashboard()
    {
        $user = auth()->user();
        $todayAssignments = Booking::where('boatman_id', $user->id)
            ->whereDate('scheduled_at', today())
            ->get();
        $upcomingAssignments = Booking::where('boatman_id', $user->id)
            ->whereDate('scheduled_at', '>', today())
            ->get();

        return view('dashboard', [
            'role' => 'boatman',
            'stats' => [
                'todayAssignments' => $todayAssignments,
                'upcomingAssignments' => $upcomingAssignments
            ]
        ]);
    }

    public function rescueDashboard()
    {
        $todayBookings = Booking::whereDate('scheduled_at', today())->get();
        $activeRescueTeam = User::where('role', 'rescue')
            ->where('status', 'active')
            ->count();

        return view('dashboard', [
            'role' => 'rescue',
            'stats' => [
                'todayBookings' => $todayBookings,
                'activeRescueTeam' => $activeRescueTeam
            ]
        ]);
    }
}