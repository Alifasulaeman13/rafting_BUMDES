@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Perahu</h1>
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

        <form action="{{ route('admin.boats.update', $boat) }}" method="POST" class="bg-white rounded-lg shadow-lg p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    Nama Perahu
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $boat->name) }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>

            <div class="mb-4">
                <label for="code" class="block text-gray-700 text-sm font-bold mb-2">
                    Kode Perahu
                </label>
                <input type="text" name="code" id="code" value="{{ old('code', $boat->code) }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                <p class="text-gray-600 text-xs italic mt-1">Kode unik untuk identifikasi perahu</p>
            </div>

            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 text-sm font-bold mb-2">
                    Kapasitas (Orang)
                </label>
                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $boat->capacity) }}" 
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
                    <option value="available" {{ old('status', $boat->status) == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="in_use" {{ old('status', $boat->status) == 'in_use' ? 'selected' : '' }}>Sedang Digunakan</option>
                    <option value="maintenance" {{ old('status', $boat->status) == 'maintenance' ? 'selected' : '' }}>Dalam Perawatan</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">
                    Catatan (Opsional)
                </label>
                <textarea name="notes" id="notes" rows="3" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('notes', $boat->notes) }}</textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Update Perahu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection