@extends('layouts.home')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 font-weight-bold">Kategori: {{ $category->name }}</h3>

    @forelse ($posts as $post)
    <div class="row mb-4 align-items-center">
        <div class="col-md-4">
            <a href="{{ route('posts.show', $post->slug) }}">
                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="height: 180px; object-fit: cover; width: 100%;">
            </a>
        </div>
        <div class="col-md-8">
            <div class="mb-2">
                @foreach($post->categories as $cat)
                    <span class="badge bg-primary text-white">{{ $cat->name }}</span>
                @endforeach
            </div>
            <h5 class="mb-2">
                <a href="{{ route('posts.show', $post->slug) }}" class="post-link text-dark">
                    {{ $post->title }}
                </a>
            </h5>
            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
        </div>
    </div>
    <hr>
    @empty
        <p>Belum ada berita untuk kategori ini.</p>
    @endforelse

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

<style>
    .post-link {
        transition: color 0.3s ease;
    }

    .post-link:hover {
        color: orange;
        text-decoration: none;
    }

    .badge.bg-primary {
        background-color: #007bff;
    }
</style>
@endsection
