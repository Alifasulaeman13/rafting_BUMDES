@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Edit Paket Rafting</h3>

        <div class="mt-8">
            <form enctype="multipart/form-data" method="POST" action="{{ route('admin.packages.update', $package) }}" class="space-y-5 mt-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="text-gray-700">Nama Paket</label>
                    <input type="text" name="name" id="name" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('name', $package->name) }}">
                    @error('name')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" rows="4">{{ old('description', $package->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('price', $package->price) }}" step="1000">
                    @error('price')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="min_persons" class="text-gray-700">Minimal Orang</label>
                        <input type="number" name="min_persons" id="min_persons" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('min_persons', $package->min_persons) }}" min="1">
                        @error('min_persons')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_persons" class="text-gray-700">Maksimal Orang</label>
                        <input type="number" name="max_persons" id="max_persons" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('max_persons', $package->max_persons) }}" min="1">
                        @error('max_persons')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="includes" class="text-gray-700">Termasuk</label>
                    <textarea name="includes" id="includes" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" rows="4">{{ old('includes', $package->includes) }}</textarea>
                    @error('includes')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="requirements" class="text-gray-700">Persyaratan</label>
                    <textarea name="requirements" id="requirements" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" rows="4">{{ old('requirements', $package->requirements) }}</textarea>
                    @error('requirements')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="text-gray-700">Gambar Paket</label>
                    @if($package->image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
                    @error('image')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="ml-2 block text-gray-700">
                        Aktif
                    </label>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.packages.index') }}" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Batal</a>
                    <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 ml-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection