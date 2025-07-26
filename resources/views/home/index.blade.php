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
                <div class="row">
                    <div class="col-lg-8">
                        <!-- First Post -->
                        @if($firstPost)
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="{{ asset($firstPost->image) }}" alt="{{ $firstPost->title }}">
                                <div class="trend-top-cap">
                                    @foreach ($firstPost->categories as $category)
                                        <span class="color1">{{ $category->name }}</span>
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
                                                <span class="badge bg-primary">{{ $category->name }}</span>
                                            @endforeach
                                            <h4><a href="{{ route('posts.show', $secondPost->slug) }}">{{ $secondPost->title }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Thirt Post -->
                    <div class="col-lg-4">
                        @foreach ($thirdPosts as $thirdPost)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <img src="{{ asset($thirdPost->image) }}" alt="{{ $thirdPost->title }}" width="150" height="100">
                                </div>
                                <div class="trand-right-cap">
                                    @foreach ($thirdPost->categories as $category)
                                        <span class="badge bg-primary">{{ $category->name }}</span>
                                    @endforeach
                                    <h4><a href="{{ route('posts.show', $thirdPost->slug) }}">{{ $thirdPost->title }}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->

    <!--  Berita Berdasarkan Kategori -->
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
                                        <span class="badge bg-primary">{{ $category->name }}</span>
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
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Kategori Berita</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                    @foreach($categories as $category)
                                    <a class="nav-item nav-link" id="nav-{{ $category->id }}-tab" data-toggle="tab" href="#nav-{{ $category->id }}" role="tab" aria-controls="nav-{{ $category->id }}" aria-selected="false">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach($allNews->take(4) as $news)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="{{ $news->image }}" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">
                                                        {{ $news->categories->pluck('name')->implode(', ') }}
                                                    </span>
                                                    <h4><a href="#">{{ $news->title }}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @foreach($categories as $category)
                            <div class="tab-pane fade" id="nav-{{ $category->id }}" role="tabpanel" aria-labelledby="nav-{{ $category->id }}-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach($category->posts->take(4) as $news)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="{{ $news->image }}" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">{{ $category->name }}</span>
                                                    <h4><a href="#">{{ $news->title }}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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
                    <img src="{{ asset('home/img/news/news_card.jpg') }}" alt="">
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
@endsection
