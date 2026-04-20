@extends('admin.layouts.app')

@section('page-title', 'Tambah Gambar Galeri')

@section('content')

<div class="content-card" style="max-width: 600px;">
    <h2 style="margin-top: 0; color: #2d3748;">Tambah Gambar Baru ke Galeri</h2>

    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Judul Gambar *</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Masukkan judul gambar" required>
            <small style="color: #718096;">Judul yang akan ditampilkan di galeri</small>
        </div>

        <div class="form-group">
            <label for="image">Pilih Gambar *</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            <small style="color: #718096;">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Gambar</button>
            <a href="{{ route('gallery') }}" class="btn btn-secondary">Kembali ke Galeri</a>
        </div>
    </form>
</div>

@endsection
