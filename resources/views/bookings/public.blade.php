@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
        <h1 class="text-2xl font-bold text-gray-900">Pesan Jadwal Rafting</h1>
        <p class="text-sm text-gray-600 mt-1">Pilih tanggal dan jam (09:00 - 15:00 WIB)</p>

        @if ($errors->any())
            <div class="mt-4 rounded-lg bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('book.store') }}" class="mt-6 space-y-5">
            @csrf
            <input type="hidden" name="package_id" value="{{ old('package_id', $package ? $package->id : '') }}" required />

            <div>
                <label class="block text-sm font-medium text-gray-700">Paket</label>
                <input type="text" value="{{ $package ? $package->name : 'Paket tidak dipilih' }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700" disabled>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam</label>
                    <input type="time" name="time" value="{{ old('time') }}" min="09:00" max="15:00" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                    <p class="text-xs text-gray-500 mt-1">Operasional 09:00 - 15:00 WIB</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                <input type="number" name="persons" min="1" value="{{ old('persons', 1) }}" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="/" class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-sm">Konfirmasi</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Log data saat submit form Booking Publik
    (function() {
        const form = document.querySelector('form[action="{{ route('book.store') }}"]');
        if (!form) return;
        form.addEventListener('submit', function() {
            const payload = {
                package_id: document.querySelector('input[name="package_id"]')?.value || null,
                date: document.querySelector('input[name="date"]')?.value || null,
                time: document.querySelector('input[name="time"]')?.value || null,
                persons: document.querySelector('input[name="persons"]')?.value || null,
            };
            console.log('Mengirim data booking:', payload);
        });
    })();

    // SweetAlert2 untuk error/sukses
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal membuat booking',
            html: `{!! implode('', $errors->all('<div>• :message</div>')) !!}`,
            confirmButtonColor: '#dc2626'
        });
        console.error('Validasi gagal (booking publik):', @json($errors->all()));
    @endif

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            confirmButtonColor: '#16a34a'
        });
        console.log('Booking berhasil:', @json(session('success')));
    @endif
</script>
@endsection


