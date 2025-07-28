@extends('layouts.home')

@section('content')

{{-- Iklan Kiri --}}
<div class="left-fixed-ad d-none d-lg-block">
    @include('app.partials.ads', ['position' => 'sidebar1']) 
</div>

{{-- Iklan Kanan --}}
<div class="right-fixed-ad d-none d-lg-block">
    @include('app.partials.ads', ['position' => 'sidebar2']) 
</div> 


<!-- Menampilkan iklan sidebar -->



<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                         <div class="bg-gradient-category text-white py-2 px-3 rounded d-flex align-items-center mb-3">
                            <div class="trending-label mr-3">
                                🔴 <strong>Trending Now:</strong>
                            </div>
                            <div class="breaking-news-scroll-wrapper">
                                <div class="breaking-news-scroll">
                                    <div class="scrolling-text">
                                        @foreach($breakingNews as $news)
                                            <a href="{{ route('posts.show', $news->slug) }}" class="text-white mr-5">
                                                {{ $news->title }}
                                            </a>
                                        @endforeach
                                        @foreach($breakingNews as $news) {{-- Duplikasi untuk loop halus --}}
                                            <a href="{{ route('posts.show', $news->slug) }}" class="text-white mr-5">
                                                {{ $news->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- First Post -->
                        @if($firstPost)
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="{{ asset($firstPost->image) }}" alt="{{ $firstPost->title }}">
                                <div class="trend-top-cap">
                                    @foreach ($firstPost->categories as $category)
                                        @if($category)
                                            <span class="color1">{{ $category->name }}</span>
                                        @endif
                                    @endforeach
                                    <h2><a href="{{ route('posts.show', $firstPost->slug) }}">{{ $firstPost->title }}</a></h2>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Second Post -->
                        <div class="trending-bottom">
                            <div class="row">
                                @foreach ($secondPosts as $secondPost)
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img src="{{ asset($secondPost->image) }}" alt="{{ $secondPost->title }}" style="width: 100%; object-fit: cover; height: 100px;">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            @foreach ($secondPost->categories as $category)
                                                @if($category)
                                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                                @endif
                                            @endforeach
                                            <h4><a href="{{ route('posts.show', $secondPost->slug) }}">{{ $secondPost->title }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
    <!-- Trending Area End -->

    <!--  Berita Berdasarkan Kategori -->
    <!--<div class="weekly-news-area pt-50">-->
    <!--    <div class="container">-->
    <!--       <div class="weekly-wrapper">-->
                 <!--section Tittle -->
    <!--            <div class="row">-->
    <!--                <div class="col-lg-12">-->
    <!--                    <div class="section-tittle mb-30">-->
    <!--                        <h3>Berita Populer</h3>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                <div class="col-12">-->
    <!--                    <div class="weekly-news-active dot-style d-flex dot-style">-->
    <!--                        @foreach ($mostViews as $mostView)-->
    <!--                        <div class="weekly-single">-->
    <!--                            <div class="weekly-img">-->
    <!--                                <img src="{{ Storage::url($mostView->image) }}" alt="{{ $mostView->title }}" width="150" height="200" style="object-fit: cover;">-->
    <!--                            </div>-->
    <!--                            <div class="weekly-caption">-->
    <!--                                @foreach ($mostView->categories as $category)
                                            @if($category)
                                                <span class="badge bg-primary">{{ $category->name }}</span>
                                            @endif
                                        @endforeach
    <!--                                <h4><a href="{{ route('posts.show', $mostView->slug) }}">{{ $mostView->title }}</a></h4>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        @endforeach-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--       </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- End Weekly-News -->

   <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">

    <div class="weekly-news-area pt-50">

        <div class="container">
           <div class="weekly-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Berita Populer</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly-news-active dot-style d-flex dot-style">
                            @foreach ($mostViews as $mostView)
                            <div class="weekly-single">
                                <div class="weekly-img">
                                    <img src="{{ asset($mostView->image) }}" alt="{{ $mostView->title }}" width="150" height="200" style="object-fit: cover;">
                                </div>
                                <div class="weekly-caption">
                                   @foreach ($mostView->categories as $category)
                                        @if($category)
                                            <span class="badge bg-primary">{{ $category->name }}</span>
                                        @endif
                                    @endforeach
                                    <h4><a href="{{ route('posts.show', $mostView->slug) }}">{{ $mostView->title }}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <!-- End Weekly-News -->

   <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @foreach($categories as $category)
                    @php $posts = $category->posts->take(4); @endphp
                    @if($posts->isNotEmpty())
                        <div class="mb-5" id="category-{{ $category->id }}">
                            <h4 class="mb-3 font-weight-bold">{{ $category->name }}</h4>

                            @foreach($posts as $news)
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <a href="{{ route('posts.show', $news->slug) }}">
                                            <img src="{{ asset($news->image) }}" class="img-fluid rounded" style="height: 180px; object-fit: cover; width: 100%;" alt="{{ $news->title }}">
                                        </a>
                                    </div>
                                    <div class="col-md-8 d-flex flex-column justify-content-between">
                                        <div>
                                            {{-- Badge kategori --}}
                                            <div class="mb-1">
                                                @foreach($news->categories as $cat)
                                                    <span class="badge bg-primary text-white">{{ $cat->name }}</span>
                                                @endforeach
                                            </div>

                                            {{-- Judul berita --}}
                                            <h5>
                                                <a href="{{ route('posts.show', $news->slug) }}" class="post-link text-dark">
                                                    {{ $news->title }}
                                                </a>
                                            </h5>
                                        </div>

                                        {{-- Tanggal --}}
                                        <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Tombol Selengkapnya --}}
                            <div class="mt-2 text-right">
                                <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-sm btn-outline-primary">
                                    Selengkapnya →
                                </a>
                            </div>
                            <hr>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-lg-4">
                <!-- Section Tittle -->
                <div class="section-tittle mb-40">
                    <h3>Ikuti Kami</h3>
                </div>
                <!-- Flow Socail -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="https://www.facebook.com/ManggalaNews/"><img src="home/img/news/icon-fb.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>2,150</span>
                                <p>Pengikut</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="home/img/news/icon-tw.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Pengikut</p>
                            </div>
                        </div>
                            <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="home/img/news/icon-ins.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Pegnikut</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="home/img/news/icon-yo.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Pengikut</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    @include('app.partials.ads', ['position' => 'home'])
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
    <!-- End Weekly-News -->
    <!-- Start Youtube -->
    @if (count($videos) >= 6)
    <div class="youtube-area video-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="video-items-active">
                        @foreach ($videos as $video)
                        <div class="video-items text-center">
                            <iframe src="{{ $video->url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="video-info">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="video-caption">
                            <div class="top-caption">
                                <span class="color1">Youtube</span>
                            </div>
                            <div class="bottom-caption">
                                <h2>Video Terkait Trend Terbaru</h2>
                                <p>Seminggu ini berita terkini terkait trend terbaru dari seluruh dunia, termasuk desain terbaru dari Paris Fashion Week dan trend terbaru untuk musim prima/genap 2024.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testmonial-nav text-center">
                            @foreach ($videos as $video)
                            <div class="single-video">
                                <iframe src="{{ $video->url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-intro">
                                    <h4>{{ $video->title }}</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="weekly2-news-area  weekly2-pading">
        <div class="container">
            <div class="weekly2-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div style="margin-right: 1rem;">
                                    <img src="https://i.pinimg.com/originals/0e/c0/db/0ec0dbf1e9a008acb9955d3246970e15.gif" alt="" width="150" height="150" style="object-fit: cover;">
                                </div>
                                <div>
                                    <div style="font-size: 1.5rem; font-weight: 600; color: #000;">
                                        Video belum ditemukan
                                    </div>
                                    <p style="font-size: 1.2rem; color: #666;">
                                        Segera kembali dengan video populer terbaru. Tunggu apalagi? Perburuanlah ke halaman ini lagi!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- End Start youtube -->

</main>

<style>
   .breaking-news-scroll-wrapper {
        overflow: hidden;
        padding-left: 15px; /* sesuai container */
        padding-right: 15px;
    }
    
    .breaking-news-scroll {
        width: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .scrolling-text {
        display: inline-block;
        white-space: nowrap;
        animation: scroll-left 60s linear infinite;
    }
    
    @keyframes scroll-left {
        0% {
            transform: translateX(0%); /* Mulai dari posisi awal di dalam margin */
        }
        100% {
            transform: translateX(-50%); /* Hanya geser sampai tengah isi duplikat */
        }
    }
    
    .breaking-news-scroll:hover .scrolling-text {
        animation-play-state: paused;
    }
    
    .bg-gradient-category {
        background: linear-gradient(to right, #1a2980, #26d0ce);
        color: #fff;
    }

</style>
@endsection
