@extends('layouts.capperu')

@section('content')

    <!-- preloader area start -->
    <x-capperu.preloader-area></x-capperu.preloader-area>
    <!-- preloader area end -->
    
    <x-capperu.body-overlay-area></x-capperu.body-overlay-area>

    <!-- search popup area start -->
    <x-capperu.search-popup-area></x-capperu.search-popup-area>
    <!-- //. search Popup -->
    
    <!-- Encabezado inicio -->
    <x-capperu.header-area></x-capperu.header-area>
    <!-- Encabezado fin -->


    <!-- Banner Area Start-->
    <section class="banner-area style-3" style="background-image: url({{ asset('themes/capperu/assets/img/banner/bg-2.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 align-self-center">
                    <div class="banner-inner text-center">
                        <h1>Estudia en línea con mucha facilidad.</h1>
                        <div class="banner-content">
                            <p>Puede acceder a más de 150 cursos diferentes formadores profesionales.</p>                         
                        </div>
                        <a class="btn btn-base" href="categoria">Más Programas de Estudios</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- intro Area Start-->
    <div class="container">
        <div class="intro-area-2">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="intro-slider owl-carousel">
                        <div class="item">
                            <div class="single-intro-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/intro/001.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">Laboral</a></h6>
                                    <p>236 Programas</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-intro-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/intro/002.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">Penal</a></h6>
                                    <p>236 Programas</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-intro-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/intro/003.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">Laboral</a></h6>
                                    <p>236 Programas</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-intro-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/intro/004.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">Ofinatica</a></h6>
                                    <p>236 Programas</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-intro-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/intro/005.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">Marketing</a></h6>
                                    <p>236 Programas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    <!-- intro Area End -->


    <!-- enllor courses Area Start-->
    <section class="enllor-courses-area pd-top-50 pd-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nuevos Programas</h2>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Curso</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-red">Diplomado</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/5.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">Java (Beginner) Programming Tutorials
                            </a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-red">Diplomado</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">About latest tips news and course for Illustration 2021
                            </a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Curso</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/6.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">Email & Affiliate Marketing Mastermind
                            </a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-red">Diplomado</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">Time Management Mastery: Do More, Stress Less
                            </a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Curso</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">Python Programming Tutorials (Computer Science)
                            </a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Curso</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/2.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">Best way learn fundamentals of design.
                            </a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-red">Diplomado</a>
                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6><a href="#">Search Engine Optimization Tips and Tricks
                            </a></h6>
                            <div class="user-area">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="#">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span><i class="fa fa-users"></i>
                                        </span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> 
                                            &nbsp;&nbsp;Comprar Ahora
                                            <b style="text-end"> &nbsp;&nbsp; S/. 250</b>  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 align-self-center">
                    <div class="banner-inner text-center">
                        <a class="btn btn-base" href="categoria">Más Programas de Estudios</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- enllor courses Area End -->

    <!-- intro Area Start-->
    <div class="text-center pd-top-135 pd-top-50 pd-bottom-100" style="background-color: #F9FAFD;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2>Nuestros Beneficios</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet .</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img style="width: 80px;" src="{{ asset('themes/capperu/assets/img/intro/convenio.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Convenios</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img style="width: 80px;" src="{{ asset('themes/capperu/assets/img/intro/aprender.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Campus Virtual</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img style="width: 80px;" src="{{ asset('themes/capperu/assets/img/intro/diploma.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Certificados</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    <!-- intro Area End -->

    <!-- Más Populares Area Start-->
    <x-capperu.programas-populares-area></x-capperu.programas-populares-area>
    <!-- Más Populares Area End -->


    <!-- testimonial courses Area Start-->
    <section class="testimonial-courses-area pd-top-100 pd-bottom-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2><i style="color: var(--main-color);" class="fa fa-heart"></i> Testimonios</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="testimonial-slider-2 owl-carousel">
                        <div class="item">
                            <div class="single-testimonial-wrap" style="background-color: #F9FAFD;">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/quote.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super fast WordPress themes</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Jessica Jessy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-testimonial-wrap" style="background-color: #F9FAFD;">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/quote.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super Courses of great quality</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Kathryn Murphy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-testimonial-wrap" style="background-color: #F9FAFD;">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/quote.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super fast WordPress themes</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Jessica Jessy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-testimonial-wrap" style="background-color: #F9FAFD;">
                                <div class="thumb">
                                    <img src="{{ asset('themes/capperu/assets/img/quote.png') }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super Courses of great quality</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Kathryn Murphy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial courses Area End -->

    <!-- client Area Start-->
    <div class="client-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-slider owl-carousel">
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/convenios/logoIng.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/convenios/logoCallao.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/convenios/logoAdm.png') }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- client Area End -->

    <x-capperu.footer-area></x-capperu.footer-area>

@endsection