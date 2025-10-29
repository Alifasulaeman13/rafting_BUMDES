@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Tambah Paket Rafting</h3>

        <div class="mt-8">
            <form id="packageForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.packages.store') }}" class="space-y-5 mt-5">
                @csrf

                <div>
                    <label for="name" class="text-gray-700">Nama Paket</label>
                    <input type="text" name="name" id="name" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('price') }}" step="1000">
                    @error('price')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="min_persons" class="text-gray-700">Minimal Orang</label>
                        <input type="number" name="min_persons" id="min_persons" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('min_persons', 1) }}" min="1">
                        @error('min_persons')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_persons" class="text-gray-700">Maksimal Orang</label>
                        <input type="number" name="max_persons" id="max_persons" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" value="{{ old('max_persons') }}" min="1">
                        @error('max_persons')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="includes" class="text-gray-700">Termasuk</label>
                    <textarea name="includes" id="includes" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" rows="4">{{ old('includes') }}</textarea>
                    @error('includes')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="requirements" class="text-gray-700">Persyaratan</label>
                    <textarea name="requirements" id="requirements" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" rows="4">{{ old('requirements') }}</textarea>
                    @error('requirements')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="text-gray-700">Gambar Paket</label>
                    <input type="file" name="image" id="image" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" accept="image/*">
                    @error('image')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" value="1" {{ old('is_active') ? 'checked' : '' }}>
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

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Log ketika file dipilih
        document.getElementById('image').addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                console.log('Selected File:', {
                    name: file.name,
                    size: file.size,
                    type: file.type
                });
            }
        });

        // Handle form submission
        document.getElementById('packageForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const isActive = document.getElementById('is_active').checked;
            formData.set('is_active', isActive ? '1' : '0');
            
            console.log('Form Data:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                console.log('Response:', data);

                if (response.ok) {
                    await Swal.fire({
                        title: 'Berhasil!',
                        text: 'Paket berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    window.location.href = '{{ route('admin.packages.index') }}';
                } else {
                    let errorMessage = 'Terjadi kesalahan saat menyimpan paket';
                    
                    if (data.message) {
                        errorMessage = data.message;
                    } else if (data.errors) {
                        errorMessage = Object.values(data.errors).join('\n');
                    }

                    console.log('Error details:', {
                        status: response.status,
                        statusText: response.statusText,
                        data: data
                    });
                    
                    await Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                    if (data.file_info) {
                        console.log('File Info:', data.file_info);
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                await Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghubungi server',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
@endsection