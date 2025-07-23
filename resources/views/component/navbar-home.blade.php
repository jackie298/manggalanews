<header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header"> 
                <div class="header-mid d-none d-md-block">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <!-- Media Sosial -->
                            <div class="col-auto social-icons">
                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                            </div>

                            <!-- Logo -->
                            <div class="col text-center">
                                <a href="/">
                                    <img src="{{ asset('home/img/logo/manggalanews.png') }}" alt="Manggala News Logo" class="logo-img">
                                </a>
                            </div>                            
                        </div>
                    </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <a href="/"><img src="{{ asset('home/img/logo/manggalanews.png') }}" style="width: 150px;" alt=""></a>
                                    </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="/">Beranda</a></li>
                                            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                                            <li><a href="{{ route('categories') }}">Kategori</a></li>

                                            @auth
                                                <li>
                                                    <a href="{{ route('dashboard') }}">
                                                        <i class="fas fa-sign-in-alt"></i> Dashboard
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('login') }}">
                                                        <i class="fas fa-sign-in-alt"></i> Login
                                                    </a>
                                                </li>
                                            @endauth
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>
