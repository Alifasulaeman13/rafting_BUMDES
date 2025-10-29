@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-900">{{ ucfirst($role) }} Dashboard</h1>
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                    {{ now()->format('d M Y') }}
                </span>
            </div>

            @if($role === 'admin')
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-900">Kontrol Admin</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                            <h3 class="font-semibold text-lg mb-2">Posts</h3>
                            <p class="text-emerald-100 mb-4">Kelola konten website</p>
                            <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-emerald-100">
                                Kelola Posts
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                            <h3 class="font-semibold text-lg mb-2">Paket</h3>
                            <p class="text-emerald-100 mb-4">Konfigurasi paket rafting</p>
                            <a href="{{ route('packages.index') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-emerald-100">
                                Kelola Paket
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                            <h3 class="font-semibold text-lg mb-2">Boatmen</h3>
                            <p class="text-emerald-100 mb-4">Kelola operator perahu</p>
                            <a href="{{ route('admin.boatmen.index') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-emerald-100">
                                Kelola Boatmen
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                            <h3 class="font-semibold text-lg mb-2">Tim Rescue</h3>
                            <p class="text-emerald-100 mb-4">Kelola personel rescue</p>
                            <a href="{{ route('admin.rescue-team.index') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-emerald-100">
                                Kelola Tim
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-900">Statistik Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-100">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Booking Aktif</h3>
                                    <p class="text-3xl font-bold text-green-600">{{ $stats['activeBookings'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-100">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Total Boatmen</h3>
                                    <p class="text-3xl font-bold text-green-600">{{ $stats['totalBoatmen'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-100">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Tim Rescue</h3>
                                    <p class="text-3xl font-bold text-green-600">{{ $stats['totalRescue'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-100">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Booking Hari Ini</h3>
                                    <p class="text-3xl font-bold text-green-600">{{ $stats['todayBookings'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

    @if($role === 'boatman')
        <div class="space-y-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-green-100">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900">Tugas Hari Ini</h2>
                <div class="divide-y divide-green-100">
                    @if($stats['todayAssignments']->count() > 0)
                        @foreach($stats['todayAssignments'] as $assignment)
                            <div class="py-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">Booking #{{ $assignment->id }}</h3>
                                        <p class="text-sm text-gray-600">{{ $assignment->scheduled_at->format('H:i') }} - {{ $assignment->persons }} orang</p>
                                    </div>
                                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="py-4 text-center text-gray-500">
                            Tidak ada tugas untuk hari ini
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border border-green-100">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900">Tugas Mendatang</h2>
                <div class="divide-y divide-green-100">
                    @if($stats['upcomingAssignments']->count() > 0)
                        @foreach($stats['upcomingAssignments'] as $assignment)
                            <div class="py-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">Booking #{{ $assignment->id }}</h3>
                                        <p class="text-sm text-gray-600">{{ $assignment->scheduled_at->format('d M Y - H:i') }} - {{ $assignment->persons }} orang</p>
                                    </div>
                                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                        Mendatang
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="py-4 text-center text-gray-500">
                            Tidak ada tugas mendatang
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if($role === 'rescue')
        <div class="space-y-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-green-100">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900">Aktivitas Hari Ini</h2>
                <div class="divide-y divide-green-100">
                    @if($stats['todayBookings']->count() > 0)
                        @foreach($stats['todayBookings'] as $booking)
                            <div class="py-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">Booking #{{ $booking->id }}</h3>
                                        <p class="text-sm text-gray-600">{{ $booking->scheduled_at->format('H:i') }} - {{ $booking->persons }} orang</p>
                                    </div>
                                    <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                        Terjadwal
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="py-4 text-center text-gray-500">
                            Tidak ada aktivitas untuk hari ini
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border border-green-100">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900">Status Tim</h2>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Anggota Tim Rescue Aktif</h3>
                            <p class="text-sm text-gray-600">Sedang bertugas</p>
                        </div>
                    </div>
                    <span class="text-3xl font-bold text-green-600">{{ $stats['activeRescueTeam'] }}</span>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection