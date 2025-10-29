@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Detail Booking #{{ $booking->id }}</h1>
            <a href="{{ route('bookings.index') }}" class="text-gray-600 hover:text-gray-900">
                Kembali ke Daftar
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Informasi Booking</h2>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <span class="px-2 py-1 text-sm font-semibold rounded-full 
                                        @if($booking->status === 'completed')
                                            bg-green-100 text-green-800
                                        @elseif($booking->status === 'confirmed')
                                            bg-blue-100 text-blue-800
                                        @elseif($booking->status === 'cancelled')
                                            bg-red-100 text-red-800
                                        @else
                                            bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tanggal Rafting</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->scheduled_at)->format('d M Y') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jumlah Peserta</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->persons }} orang</dd>
                            </div>
                            @if($booking->boatman)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Boatman</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->boatman->name }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold mb-4">Informasi Pembayaran</h2>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Total Harga</dt>
                                <dd class="mt-1 text-lg font-bold text-gray-900">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status Pembayaran</dt>
                                <dd class="mt-1">
                                    <span class="px-2 py-1 text-sm font-semibold rounded-full 
                                        @if($booking->payment_status === 'paid')
                                            bg-green-100 text-green-800
                                        @elseif($booking->payment_status === 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Metode Pembayaran</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $booking->payment_method === 'qris' ? 'QRIS' : 'Bayar di Tempat' }}
                                </dd>
                            </div>
                            @if($booking->payment_proof)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Bukti Pembayaran</dt>
                                <dd class="mt-1">
                                    <a href="{{ Storage::url($booking->payment_proof) }}" target="_blank" 
                                        class="text-blue-600 hover:text-blue-800">
                                        Lihat Bukti Pembayaran
                                    </a>
                                </dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-lg font-semibold mb-4">Detail Paket</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $booking->package->name }}</h3>
                        <p class="mt-2 text-gray-600">{{ $booking->package->description }}</p>
                        
                        <div class="mt-4">
                            <h4 class="font-medium text-gray-900">Fasilitas:</h4>
                            <ul class="mt-2 list-disc list-inside text-gray-600">
                                @foreach(explode("\n", $booking->package->inclusions) as $inclusion)
                                <li>{{ $inclusion }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h4 class="font-medium text-gray-900">Persyaratan:</h4>
                            <ul class="mt-2 list-disc list-inside text-gray-600">
                                @foreach(explode("\n", $booking->package->requirements) as $requirement)
                                <li>{{ $requirement }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                @if(auth()->user()->role === 'admin' && $booking->status !== 'completed')
                <div class="mt-8 border-t pt-6">
                    <h2 class="text-lg font-semibold mb-4">Update Status</h2>
                    <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status Booking</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label for="payment_status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                            <select name="payment_status" id="payment_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="unpaid" {{ $booking->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $booking->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="refunded" {{ $booking->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Update Status
                            </button>
                        </div>
                    </form>

                    @if($booking->status === 'pending')
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Assign Boatman</h3>
                        <form action="{{ route('bookings.assignBoatman', $booking) }}" method="POST">
                            @csrf
                            <div class="flex gap-4">
                                <div class="flex-grow">
                                    <select name="boatman_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Boatman</option>
                                        @foreach($boatmen as $boatman)
                                        <option value="{{ $boatman->id }}" {{ $booking->boatman_id === $boatman->id ? 'selected' : '' }}>
                                            {{ $boatman->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    Assign
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection