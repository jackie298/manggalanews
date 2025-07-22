@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Daftar Iklan</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Iklan</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Iklan</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">List Iklan</h4>
                        <a href="{{ route('iklan.create') }}" class="btn btn-primary">Tambah Iklan</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Iklan</th>
                                    <th>Posisi</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($iklans as $iklan)
                                <tr>
                                    <td>
                                        @if ($iklan->image)
                                           <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan">
                                        @else
                                            Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>{{ $iklan->name }}</td>
                                    <td>{{ $iklan->position ?? 'Tidak Ditentukan' }}</td>
                                    <td>
                                        @if ($iklan->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $iklan->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('iklan.edit', $iklan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('iklan.destroy', $iklan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus iklan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <div>
                            Menampilkan {{ $iklans->firstItem() }} - {{ $iklans->lastItem() }} dari {{ $iklans->total() }} iklan
                        </div>
                        <div>
                            {{ $iklans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection