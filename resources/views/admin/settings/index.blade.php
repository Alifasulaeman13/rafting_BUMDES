@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Sistem</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="site_name" class="form-label">Nama Situs</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', config('app.name')) }}">
                        </div>
                        <div class="mb-3">
                            <label for="site_description" class="form-label">Deskripsi Situs</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ old('site_description', config('app.description')) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Email Kontak</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ old('contact_email', config('app.contact_email')) }}">
                        </div>
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', config('app.contact_phone')) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection