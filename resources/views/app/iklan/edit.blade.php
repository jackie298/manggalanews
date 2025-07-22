@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Edit Iklan</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('iklan.index') }}">Iklan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Iklan</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Edit Iklan</h4>

                    <form action="{{ route('iklan.update', $iklan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama Iklan</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $iklan->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Konten Iklan (HTML)</label>
                            <textarea name="content" id="content" rows="5" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $iklan->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position">Posisi Iklan</label>
                            <select name="position" id="position" class="form-control @error('position') is-invalid @enderror">
                                <option value="">-- Pilih Posisi --</option>
                                <option value="header" {{ old('position', $iklan->position) == 'header' ? 'selected' : '' }}>Header</option>
                                <option value="sidebar1" {{ old('position', $iklan->position) == 'sidebar1' ? 'selected' : '' }}>Sidebar - Kiri</option>
                                <option value="sidebar2" {{ old('position', $iklan->position) == 'sidebar2' ? 'selected' : '' }}>Sidebar - kanan</option>
                                <option value="footer" {{ old('position', $iklan->position) == 'footer' ? 'selected' : '' }}>Footer</option>
                            </select>
                            <small class="text-muted">Pilih salah satu posisi untuk menampilkan iklan.</small>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Gambar Baru (Opsional)</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($iklan->image)
                            <div class="form-group">
                                <label>Gambar Saat Ini</label><br>
                                <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" width="150">
                            </div>
                        @endif

                        <div class="form-group form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $iklan->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktifkan Iklan Ini</label>
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Perbarui</button>
                        <a href="{{ route('iklan.index') }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection