@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Tambah Perahu</h1>
            <a href="{{ route('admin.boats.index') }}" class="text-gray-600 hover:text-gray-900">
                Kembali ke Daftar
            </a>
        </div>

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.boats.store') }}" method="POST" class="bg-white rounded-lg shadow-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    Nama Perahu
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>

            <div class="mb-4">
                <label for="code" class="block text-gray-700 text-sm font-bold mb-2">
                    Kode Perahu
                </label>
                <input type="text" name="code" id="code" value="{{ old('code') }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                <p class="text-gray-600 text-xs italic mt-1">Kode unik untuk identifikasi perahu</p>
            </div>

            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 text-sm font-bold mb-2">
                    Kapasitas (Orang)
                </label>
                <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required min="1">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                    Status
                </label>
                <select name="status" id="status" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>Sedang Digunakan</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Dalam Perawatan</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">
                    Catatan (Opsional)
                </label>
                <textarea name="notes" id="notes" rows="3" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('notes') }}</textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan Perahu
                </button>
            </div>
        </form>
</div>
</div>
@endsection

@push('scripts')
<script>
    // Log data saat submit form Tambah Perahu
    (function() {
        const form = document.querySelector('form[action="{{ route('admin.boats.store') }}"]');
        if (!form) return;

        form.addEventListener('submit', function() {
            const payload = {
                name: document.getElementById('name')?.value || null,
                code: document.getElementById('code')?.value || null,
                capacity: document.getElementById('capacity')?.value || null,
                status: document.getElementById('status')?.value || null,
                notes: document.getElementById('notes')?.value || null,
            };
            console.log('Mengirim data perahu:', payload);
        });
    })();

    // Tampilkan SweetAlert2 jika ada error validasi (gagal tersimpan)
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal menyimpan',
            html: `{!! implode('', $errors->all('<div>• :message</div>')) !!}`,
            confirmButtonColor: '#dc2626'
        });
        console.error('Validasi gagal:', @json($errors->all()));
    @endif
</script>
@endpush