@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Buat Booking Baru</h1>
            <a href="{{ route('bookings.index') }}" class="text-gray-600 hover:text-gray-900">
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

        <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="package_id" class="block text-gray-700 text-sm font-bold mb-2">
                    Pilih Paket
                </label>
                <select name="package_id" id="package_id" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="">Pilih Paket Rafting</option>
                    @foreach($packages as $package)
                    <option value="{{ $package->id }}" 
                        data-price="{{ $package->price }}"
                        data-min="{{ $package->min_persons }}"
                        data-max="{{ $package->max_persons }}"
                        {{ old('package_id') == $package->id ? 'selected' : '' }}>
                        {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}/orang
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="scheduled_at" class="block text-gray-700 text-sm font-bold mb-2">
                    Tanggal Rafting
                </label>
                <input type="date" name="scheduled_at" id="scheduled_at" value="{{ old('scheduled_at') }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
            </div>

            <div class="mb-4">
                <label for="persons" class="block text-gray-700 text-sm font-bold mb-2">
                    Jumlah Peserta
                </label>
                <input type="number" name="persons" id="persons" value="{{ old('persons') }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required min="1">
                <p class="text-gray-600 text-xs italic mt-1" id="persons-info"></p>
            </div>

            <div class="mb-4">
                <label for="total_price" class="block text-gray-700 text-sm font-bold mb-2">
                    Total Harga
                </label>
                <div class="text-lg font-bold text-gray-900" id="total-price">
                    Rp 0
                </div>
            </div>

            <div class="mb-4">
                <label for="payment_method" class="block text-gray-700 text-sm font-bold mb-2">
                    Metode Pembayaran
                </label>
                <select name="payment_method" id="payment_method" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                    <option value="on_site" {{ old('payment_method') == 'on_site' ? 'selected' : '' }}>Bayar di Tempat</option>
                </select>
            </div>

            <div id="payment-proof-section" class="mb-6 {{ old('payment_method') === 'on_site' ? 'hidden' : '' }}">
                <label for="payment_proof" class="block text-gray-700 text-sm font-bold mb-2">
                    Bukti Pembayaran
                </label>
                <input type="file" name="payment_proof" id="payment_proof" accept="image/*"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    {{ old('payment_method') === 'qris' ? 'required' : '' }}>
                <p class="text-gray-600 text-xs italic mt-1">Format yang didukung: JPG, PNG. Maksimal 2MB.</p>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Buat Booking
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const packageSelect = document.getElementById('package_id');
    const personsInput = document.getElementById('persons');
    const personsInfo = document.getElementById('persons-info');
    const totalPriceDiv = document.getElementById('total-price');
    const paymentMethodSelect = document.getElementById('payment_method');
    const paymentProofSection = document.getElementById('payment-proof-section');
    const paymentProofInput = document.getElementById('payment_proof');

    function updatePersonsInfo() {
        const selectedOption = packageSelect.options[packageSelect.selectedIndex];
        if (selectedOption.value) {
            const minPersons = selectedOption.dataset.min;
            const maxPersons = selectedOption.dataset.max;
            personsInfo.textContent = `Minimal ${minPersons} orang, maksimal ${maxPersons} orang`;
            personsInput.min = minPersons;
            personsInput.max = maxPersons;
        } else {
            personsInfo.textContent = '';
        }
    }

    function updateTotalPrice() {
        const selectedOption = packageSelect.options[packageSelect.selectedIndex];
        const persons = parseInt(personsInput.value) || 0;
        
        if (selectedOption.value && persons > 0) {
            const pricePerPerson = parseInt(selectedOption.dataset.price);
            const total = pricePerPerson * persons;
            totalPriceDiv.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        } else {
            totalPriceDiv.textContent = 'Rp 0';
        }
    }

    function updatePaymentProofVisibility() {
        if (paymentMethodSelect.value === 'qris') {
            paymentProofSection.classList.remove('hidden');
            paymentProofInput.required = true;
        } else {
            paymentProofSection.classList.add('hidden');
            paymentProofInput.required = false;
        }
    }

    packageSelect.addEventListener('change', function() {
        updatePersonsInfo();
        updateTotalPrice();
    });

    personsInput.addEventListener('input', updateTotalPrice);

    paymentMethodSelect.addEventListener('change', updatePaymentProofVisibility);

    // Initial updates
    updatePersonsInfo();
    updateTotalPrice();
    updatePaymentProofVisibility();
});
</script>
@endpush
@endsection