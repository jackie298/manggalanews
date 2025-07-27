@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Tambah Iklan Baru</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('iklan.index') }}">Iklan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Iklan</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Tambah Iklan</h4>
                    <form action="{{ route('iklan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama Iklan</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Konten Iklan (HTML)</label>
                            <textarea name="content" id="content" rows="5" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position">Posisi Iklan</label>
                            <select name="position" id="position" class="form-control @error('position') is-invalid @enderror">
                                <option value="">-- Pilih Posisi --</option>
                                <option value="header" {{ old('position') == 'header' ? 'selected' : '' }}>Header</option>
                                <option value="sidebar1" {{ old('position') == 'sidebar1' ? 'selected' : '' }}>Sidebar - Kiri</option>
                                <option value="sidebar2" {{ old('position') == 'sidebar2' ? 'selected' : '' }}>Sidebar - Kanan</option>
                                <option value="home" {{ old('position') == 'sidebar2' ? 'selected' : '' }}>Halaman Utama</option>
                                <option value="newsads" {{ old('position') == 'sidebar2' ? 'selected' : '' }}>Halaman Berita</option>
                                <option value="footer" {{ old('position') == 'footer' ? 'selected' : '' }}>Footer</option>
                            </select>
                            <small class="text-muted">Pilih salah satu posisi untuk menampilkan iklan.</small>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image">Upload Gambar Iklan (Opsional)</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Keterangan Gambar :
                                <ul>
                                <li><small>Dimensi Gambar 1920 x 1080 pixel </small></li>
                                <li><small>Ukuran Gambar Maksimal 2 Mb</small></li>
                                </ul>
                            </small>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktifkan Iklan Ini</label>
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                        <a href="{{ route('iklan.index') }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection