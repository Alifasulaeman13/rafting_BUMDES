@extends('layouts.app')
@section('hide_header', true)

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-8 border border-gray-100">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-green-600 text-white font-bold mb-3">R</div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Masuk ke Rapting</h2>
                <p class="mt-1 text-sm text-gray-600">Silakan masuk ke akun Anda</p>
            </div>
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1 relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="far fa-envelope"></i>
                            </span>
                            <input id="email" name="email" type="email" required 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Masukkan email Anda">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="far fa-lock"></i>
                            </span>
                            <input id="password" name="password" type="password" required 
                                class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Masukkan password Anda">
                            <button type="button" onclick="const p=document.getElementById('password'); p.type=p.type==='password'?'text':'password'" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <label class="inline-flex items-center text-sm text-gray-600">
                                <input type="checkbox" name="remember" class="h-4 w-4 text-green-600 border-gray-300 rounded">
                                <span class="ml-2">Ingat saya</span>
                            </label>
                            <a href="#" class="text-sm text-green-700 hover:text-green-800">Lupa password?</a>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="rounded-lg bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <button type="submit" 
                        class="w-full inline-flex justify-center items-center py-2.5 px-4 rounded-xl shadow-sm text-sm font-semibold text-white 
                        bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        Masuk
                    </button>
                    <p class="text-center text-xs text-gray-500">Belum punya akun? <a href="{{ route('register') }}" class="text-green-700 hover:text-green-800 font-medium">Daftar sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection