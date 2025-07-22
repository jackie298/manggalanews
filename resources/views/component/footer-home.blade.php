
   <footer>
       <!-- Footer Start-->
       <div class="footer-area footer-padding fix">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                        <div class="single-footer-caption">
                            <div class="single-footer-caption">
                                <!-- Menampilkan iklan footer -->
                                    @include('app.partials.ads', ['position' => 'footer'])
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="/"><img src="{{ asset('home/img/logo/manggalanews.svg') }}" style="filter: invert(100%); width: 200px;" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Portal Berita Manggala News merupakan Portal berita berdasarkan Akta Pendirian PT. Manggala Nusa Informasi, dengan Nomor 07 Tanggal 04 Juli 2025 pada Kantor Notaris Vievi Kurniavi, S.H,.M.K.N.; Keputusan Menteri Hukum Republik Indonesia Nomor AHU-0055801.ah.01.01 Tahun 2025 Tentang Pengesahan Pendirian Badan Usaha Perseroan Terbatas PT. Manggala Nusa Informasi.; dan Perizinan Berusaha Berbasis Resiko dengan Nomor Induk Berusaha : 0907250093115.</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="https://api.whatsapp.com/send?phone=6288999956565" target="_blank" ><i style="color: #fff;" class="fab fa-whatsapp"></i></a>
                                    <a href="#" target="_blank" ><i style="color: #fff;" class="fab fa-instagram"></i></a>
                                    <a href="https://www.facebook.com/ManggalaNews/" target="_blank" ><i style="color: #fff;" class="fab fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4  col-sm-6">
                        <div class="single-footer-caption mt-60">
                            <div class="footer-tittle">
                                <h4>Join Us</h4>
                                <p>Subscribe to our newsletter and stay updated with the latest news and updates from us.</p>
                                <!-- Form -->
                                <div class="footer-form" >
                                    <div id="mc_embed_signup">
                                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                        method="get" class="subscribe_form relative mail_part">
                                            <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                            class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = ' Email Address '">
                                            <div class="form-icon">
                                            <button type="submit" name="submit" id="newsletter-submit"
                                            class="email_icon newsletter-submit button-contactForm"><img src="{{ asset('home/img/logo/form-iocn.png') }}" alt=""></button>
                                            </div>
                                            <div class="mt-10 info"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50 mt-60">
                            <div class="footer-tittle">
                                <h4>Artikel Terbaru</h4>
                            </div>
                            <div class="recent-post-caption">
                                <!-- recent-post-caption start -->
                                <ul class="list-unstyled">
                                    @foreach ($latest_posts as $post)
                                        <li class="media">
                                            <a href="{{ route('posts.show', $post->slug) }}" class="hover-text">
                                                {{ $post->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <style>
                                    .recent-post-caption ul {
                                        list-style: none;
                                        padding: 0;
                                    }
                                    .recent-post-caption ul li {
                                        margin-bottom: 10px;
                                    }
                                    .recent-post-caption ul li a {
                                        text-decoration: none;
                                    }
                                    .hover-text:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <!-- footer-bottom aera -->
       <div class="footer-bottom-area">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p>
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | PT. MANGGALA NUSA INFORMATION</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>
                                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                                    <li><a href="#">Kontak</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
       <!-- Footer End-->
   </footer>
