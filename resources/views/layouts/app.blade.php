<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Rapting') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100">
    @if (!View::hasSection('hide_header'))
    <header class="sticky top-0 z-40 backdrop-blur bg-white/80 border-b border-gray-200/70">
        <nav class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo-rapting.jpg') }}" alt="Rapting" class="w-9 h-9 rounded-lg object-cover" />
                    <span class="text-lg font-bold tracking-tight text-gray-900">Rapting</span>
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Beranda</a>
                    <a href="/#packages" class="text-sm font-medium text-gray-700 hover:text-gray-900">Paket</a>
                    <a href="#contact" class="text-sm font-medium text-gray-700 hover:text-gray-900">Kontak</a>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                        <span class="hidden sm:inline text-sm text-gray-700">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                        <a href="{{ route('profile') }}" class="inline-flex items-center text-sm px-3 py-2 rounded-lg border border-green-300 text-green-700 hover:bg-green-100">Profil</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center text-sm px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center text-sm px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-sm hover:shadow transition-colors">Login</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    @endif

    <main class="">
        @yield('content')
    </main>

    <!-- Global flash alerts -->
    <script>
        (function() {
            // Tampilkan SweetAlert2 untuk flash success/error di layout publik
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('success')),
                    confirmButtonColor: '#16a34a'
                });
                console.log('Flash success:', @json(session('success')));
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: @json(session('error')),
                    confirmButtonColor: '#dc2626'
                });
                console.error('Flash error:', @json(session('error')));
            @endif

            @if(isset($errors) && $errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memproses',
                    html: `{!! implode('', $errors->all('<div>• :message</div>')) !!}`,
                    confirmButtonColor: '#dc2626'
                });
                console.error('Validasi gagal (layout):', @json($errors->all()));
            @endif
        })();
    </script>
</body>
</html>