@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Profil Saya</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/3">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2">Informasi Pengguna</h2>
                    <div class="space-y-2">
                        <p><span class="font-medium">Nama:</span> {{ $user->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $user->email }}</p>
                        <p><span class="font-medium">Tipe Akun:</span> {{ ucfirst($user->role) }}</p>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/3">
                <h2 class="text-lg font-semibold mb-3">Riwayat Booking</h2>
                
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">Tanggal</th>
                                    <th class="py-2 px-4 border-b text-left">Paket</th>
                                    <th class="py-2 px-4 border-b text-left">Jumlah Orang</th>
                                    <th class="py-2 px-4 border-b text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b">{{ $booking->booking_date ? $booking->booking_date->format('d M Y') : 'Tanggal tidak tersedia' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $booking->package->name ?? 'Paket tidak tersedia' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $booking->number_of_people }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                                            @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-gray-50 p-6 rounded-lg text-center">
                        <p class="text-gray-600">Anda belum memiliki riwayat booking.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection