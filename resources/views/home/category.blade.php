@extends('layouts.home')

@section('content')
<main>
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
                                        @foreach($allNews as $news)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="{{ $news->image }}" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">{{ $news->category->name }}</span>
                                                    <h4><a href="#">{{ $news->title }}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- Paginasi untuk semua postingan -->
                                    <div class="pagination-area pb-45 text-center">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item {{ $allNews->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $allNews->previousPageUrl() }}"><span class="flaticon-arrow roted"></span></a>
                                                </li>
                                                @for ($i = 1; $i <= $allNews->lastPage(); $i++)
                                                    <li class="page-item {{ $allNews->currentPage() == $i ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $allNews->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                                <li class="page-item {{ $allNews->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $allNews->nextPageUrl() }}"><span class="flaticon-arrow right-arrow"></span></a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            @foreach($categories as $category)
                            <div class="tab-pane fade" id="nav-{{ $category->id }}" role="tabpanel" aria-labelledby="nav-{{ $category->id }}-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach($category->posts as $news)
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
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="{{ asset('home/img/news/news_card.jpg') }}" alt="">
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
</main>
@endsection
