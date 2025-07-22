@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Detail Iklan</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('iklan.index') }}">Iklan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Iklan</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi Iklan</h4>

                    <div class="form-group">
                        <label><strong>Nama Iklan</strong></label>
                        <p>{{ $iklan->name }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Konten Iklan</strong></label>
                        <div style="border:1px solid #ccc; padding:10px; background:#f9f9f9;">
                            {!! $iklan->content !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label><strong>Posisi Iklan</strong></label>
                        <p>{{ $iklan->position ?? 'Tidak Ditentukan' }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Status</strong></label><br>
                        @if ($iklan->is_active)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </div>

                    @if ($iklan->image)
                        <div class="form-group">
                            <label><strong>Gambar Iklan</strong></label><br>
                            <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" width="200">
                        </div>
                    @endif

                    <div class="form-group">
                        <label><strong>Dibuat Pada</strong></label>
                        <p>{{ $iklan->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <a href="{{ route('iklan.edit', $iklan->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('iklan.index') }}" class="btn btn-light">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection