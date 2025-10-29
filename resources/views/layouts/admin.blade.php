<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Rapting</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-green-800 text-white w-64 py-4 flex flex-col">
            <div class="px-6 py-4 border-b border-green-700">
                <h1 class="text-2xl font-bold">Rapting Admin</h1>
            </div>
            <nav class="flex-1 px-4 py-4">
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-green-700' : '' }}">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Manajemen Perahu -->
                    <div class="py-2">
                        <h2 class="px-4 text-xs font-semibold text-green-300 uppercase tracking-wider">Manajemen Perahu</h2>
                        <a href="{{ route('admin.boats.index') }}" class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.boats.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-ship w-5 h-5 mr-3"></i>
                            <span>Data Perahu</span>
                        </a>
                    </div>

                    <!-- Manajemen Tim -->
                    <div class="py-2">
                        <h2 class="px-4 text-xs font-semibold text-green-300 uppercase tracking-wider">Manajemen Tim</h2>
                        <a href="{{ route('admin.boatmen.index') }}" class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.boatmen.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-users w-5 h-5 mr-3"></i>
                            <span>Ojek Perahu</span>
                        </a>
                        <a href="{{ route('admin.rescue-team.index') }}" class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.rescue-team.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-life-ring w-5 h-5 mr-3"></i>
                            <span>Tim Rescue</span>
                        </a>
                    </div>

                    <!-- Manajemen Layanan -->
                    <div class="py-2">
                        <h2 class="px-4 text-xs font-semibold text-green-300 uppercase tracking-wider">Manajemen Layanan</h2>
                        <a href="{{ route('admin.packages.index') }}" class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.packages.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-box w-5 h-5 mr-3"></i>
                            <span>Paket Rafting</span>
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.posts.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-newspaper w-5 h-5 mr-3"></i>
                            <span>Blog & Berita</span>
                        </a>
                    </div>

                    <!-- Manajemen Pemesanan -->
                    <div class="py-2">
                        <h2 class="px-4 text-xs font-semibold text-green-300 uppercase tracking-wider">Manajemen Pemesanan</h2>
                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.bookings.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-calendar-check w-5 h-5 mr-3"></i>
                            <span>Pemesanan</span>
                        </a>
                    </div>

                    <!-- Pengaturan -->
                    <div class="py-2">
                        <h2 class="px-4 text-xs font-semibold text-green-300 uppercase tracking-wider">Pengaturan</h2>
                        <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg transition-colors {{ request()->routeIs('admin.settings') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-cog w-5 h-5 mr-3"></i>
                            <span>Pengaturan Sistem</span>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="px-6 py-4 border-t border-green-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-white hover:bg-green-700 rounded-lg transition-colors w-full">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200">
                <div class="px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('success')),
                    confirmButtonColor: '#16a34a'
                });
                console.log('Sukses:', @json(session('success')));
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: @json(session('error')),
                    confirmButtonColor: '#dc2626'
                });
                console.error('Gagal:', @json(session('error')));
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>