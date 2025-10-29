@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-green-600 to-green-700 text-white">
        <div class="absolute inset-0 opacity-20"
             style="background-image: radial-gradient(circle at 20% 20%, rgba(255,255,255,.15) 0 8%, transparent 9%), radial-gradient(circle at 80% 30%, rgba(255,255,255,.12) 0 7%, transparent 8%), radial-gradient(circle at 40% 80%, rgba(255,255,255,.10) 0 6%, transparent 7%);"></div>
        <div class="max-w-7xl mx-auto px-4 py-18 sm:py-24 relative">
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-flex items-center text-green-100/90 bg-white/10 backdrop-blur px-3 py-1 rounded-full text-sm tracking-wide border border-white/20">
                    Aman • Seru • Berkesan
                </span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight mt-4 leading-tight">
                    Petualangan Rafting Terbaik
                </h1>
                <p class="text-lg sm:text-xl max-w-2xl mx-auto mt-4 text-green-50">
                    Nikmati adrenalin di arus sungai dengan pemandu profesional dan peralatan berstandar internasional.
                </p>
                <div class="mt-8 flex items-center justify-center gap-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center bg-white text-green-700 px-7 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        Mulai Petualangan
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-2">
                            <path d="M13.5 4.5a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 .75.75v6a.75.75 0 0 1-1.5 0V6.31l-7.97 7.97a.75.75 0 1 1-1.06-1.06l7.97-7.97h-4.19a.75.75 0 0 1-.75-.75Z"/>
                            <path d="M5.25 5.625A3.375 3.375 0 0 0 1.875 9v9.375A3.375 3.375 0 0 0 5.25 21.75h9.375A3.375 3.375 0 0 0 18 18.375V13.5a.75.75 0 0 0-1.5 0v4.875a1.875 1.875 0 0 1-1.875 1.875H5.25A1.875 1.875 0 0 1 3.375 18.375V9A1.875 1.875 0 0 1 5.25 7.125H10.5a.75.75 0 0 0 0-1.5H5.25Z"/>
                        </svg>
                    </a>
                    <a href="#packages" class="inline-flex items-center px-7 py-3 rounded-xl font-semibold border border-white/30 text-white/90 hover:text-white hover:bg-white/10 backdrop-blur transition-all">
                        Lihat Paket
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <div class="relative group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-green-50 text-green-600 text-2xl mb-4 group-hover:scale-105 transition-transform">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Pemandu Profesional</h3>
                <p class="text-gray-600">Tim pemandu berpengalaman dan tersertifikasi untuk keamanan Anda.</p>
                <div class="absolute inset-x-0 bottom-0 h-1 rounded-b-2xl bg-gradient-to-r from-green-600 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            <div class="relative group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-green-50 text-green-600 text-2xl mb-4 group-hover:scale-105 transition-transform">
                    <i class="fas fa-life-ring"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Peralatan Standar</h3>
                <p class="text-gray-600">Peralatan rafting berstandar internasional untuk keamanan maksimal.</p>
                <div class="absolute inset-x-0 bottom-0 h-1 rounded-b-2xl bg-gradient-to-r from-green-600 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            <div class="relative group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-green-50 text-green-600 text-2xl mb-4 group-hover:scale-105 transition-transform">
                    <i class="fas fa-helicopter"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Tim Rescue Siaga</h3>
                <p class="text-gray-600">Tim rescue profesional selalu siap 24/7 untuk menjamin keselamatan Anda.</p>
                <div class="absolute inset-x-0 bottom-0 h-1 rounded-b-2xl bg-gradient-to-r from-green-600 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </div>
    </div>

    <!-- Packages Preview -->
    <div id="packages" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-12 tracking-tight">Paket Rafting</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($packages as $package)
                <div class="group bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition-all">
                    <div class="relative">
                        <img src="{{ $package->image ? asset('storage/'.$package->image) : asset('images/package-default.jpg') }}" alt="{{ $package->name }}" class="w-full h-60 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent opacity-90"></div>
                        <div class="absolute top-3 left-3 inline-flex items-center text-xs font-medium bg-white/90 text-green-700 px-2.5 py-1 rounded-full shadow-sm">
                            Aktif
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-lg font-semibold line-clamp-1">{{ $package->name }}</h3>
                            <span class="text-sm text-green-700 bg-green-50 px-2.5 py-1 rounded-full">{{ $package->min_persons }}-{{ $package->max_persons ?? '∞' }} org</span>
                        </div>
                        <p class="text-gray-600 mt-2 line-clamp-2">{{ $package->description }}</p>
                        <div class="mt-5 flex items-center justify-between">
                            <div class="text-2xl font-extrabold text-green-600 tracking-tight">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </div>
                            <a href="{{ Auth::check() ? route('public.booking.create', ['package' => $package->id]) : route('login') }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl shadow-sm hover:shadow transition-colors">
                                Pesan
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-2">
                                    <path fill-rule="evenodd" d="M3.75 12a.75.75 0 0 1 .75-.75h12.19l-3.22-3.22a.75.75 0 1 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06-1.06l3.22-3.22H4.5A.75.75 0 0 1 3.75 12Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                        <div class="mt-3 text-[11px] text-gray-500 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Harga per orang
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="text-gray-500">
                        <i class="fas fa-box text-4xl mb-4"></i>
                        <p>Belum ada paket tersedia</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="contact" class="relative bg-gray-900 text-gray-300">
        <div class="absolute inset-x-0 -top-1 h-1 bg-gradient-to-r from-green-600 to-emerald-600"></div>
        <div class="max-w-7xl mx-auto px-4 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-gradient-to-br from-green-600 to-emerald-600 text-white font-bold">R</span>
                        <span class="text-lg font-semibold text-white">Rapting</span>
                    </div>
                    <p class="mt-4 text-sm text-gray-400 leading-relaxed">Penyedia layanan rafting terpercaya dengan pemandu profesional dan standar keselamatan tinggi.</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-white tracking-wide">Navigasi</h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Beranda</a></li>
                        <li><a href="#packages" class="hover:text-white">Paket</a></li>
                        <li><a href="#contact" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-white tracking-wide">Kontak</h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li class="flex items-center"><i class="fas fa-phone w-5"></i> <span class="ml-2">+62 812-3456-7890</span></li>
                        <li class="flex items-center"><i class="fas fa-envelope w-5"></i> <span class="ml-2">info@rapting.com</span></li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt w-5"></i> <span class="ml-2">Jl. Rafting No. 123, Kota</span></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-white tracking-wide">Berlangganan</h4>
                    <p class="mt-4 text-sm text-gray-400">Dapatkan update promo dan informasi terbaru.</p>
                    <form class="mt-4 flex items-center gap-2">
                        <input type="email" placeholder="Email Anda" class="w-full px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-600" />
                        <button type="button" class="px-4 py-2 rounded-lg bg-gradient-to-r from-green-600 to-emerald-600 text-white hover:from-green-700 hover:to-emerald-700">Kirim</button>
                    </form>
                    <div class="mt-5 flex items-center gap-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-6 border-t border-gray-800 flex items-center justify-between text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} Rapting. All rights reserved.</p>
                <p>Made with <span class="text-green-500">♥</span> in Indonesia</p>
            </div>
        </div>
    </footer>
@endsection
