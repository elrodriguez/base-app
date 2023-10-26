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
    <section class="banner-area style-3"
        style="background-image: url({{ asset('themes/capperu/assets/img/banner/bg-2.jpg') }});">
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
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nuevos Programas</h2>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="{{ route('web_categoria_programa_cursos') }}" class="cat cat-blue" style="font-size: 18px;">
                                Curso
                            </a>
                            <a href="{{ route('web_descripcion_en_vivo') }}">
                                <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                            </a>
                        </div>
                        <div class="wrap-details">
                            <h6 class="nombre">
                                <a href="{{ route('web_descripcion_en_vivo') }}">PHP for Beginners - Become a PHP Master - CMS Project</a>
                            </h6>
                            <div class="user-area" style="padding: 0px;">
                                <div class="user-details">
                                    <p style="padding: 2px 0px;">Breve descripción del curso, maximo 02 lineas con sus respectivos puntos al final...</p>
                                </div>
                            </div>
                            <div class="user-area" style="padding: 3px;">
                                <div class="user-details">
                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                    <a href="{{ route('web_perfil_docente') }}">Jessica Jessy</a>
                                </div>
                                <div class="user-rating">
                                    <span style="color:orange;">
                                        <i class="fa fa-users"></i>
                                    </span>(76)
                                </div>
                            </div>
                            <div class="user-area" style="padding: 3px;">
                                <div class="user-details">
                                    <a href="">
                                        <span style="color:orange;">
                                            <i class="fa fa-fire" aria-hidden="true"></i> Sector:
                                        </span>
                                        <br>
                                        <b>Empresarial</b>
                                    </a>
                                </div>
                                <div class="user-rating">
                                    <span style="color:orange;">
                                        <i>Modalidad:</i>
                                    </span>
                                    <br>
                                    <b>En Vivo</b>
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <button onclick="agregarAlCarrito({ id: 1, nombre: 'PHP for Beginners - Become a PHP Master - CMS Project', precio: 250 });" class="btn btn-primary">
                                            <i class="fa fa-cart-plus"></i>
                                            &nbsp;&nbsp;Comprar Ahora S/. 250
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                @if (count($programs) > 0)
                    @foreach ($programs as $key => $program)
                        <div class="col-md-4">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="{{ route('web_categoria_programa_cursos') }}" class="cat cat-blue">{{ $program->additional }}</a>
                                    <a href="{{ route('web_descripcion_en_vivo') }}">
                                        <img src="{{ $program->image }}" alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="{{ route('web_descripcion_en_vivo') }}">{{ $program->name }}</a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                            <a href="{{ route('web_perfil_docente') }}">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span><i class="fa fa-users"></i>
                                            </span>(76)
                                        </div>
                                    </div>
                                    <div class="user-area" style="padding: 0px;">
                                        <div class="user-details">
                                            <a href="{{ route('web_categoria_sector') }}">&nbsp;S. Empresarial</a>
                                        </div>
                                        <div class="user-rating">
                                            <a href="{{ route('web_categoria_modalidad_en_vivo') }}">&nbsp;En Vivo</a>
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
                    @endforeach
                @endif
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

    <!-- Nuestros Beneficios Area Start-->
    <x-capperu.nuestros-beneficios-area></x-capperu.nuestros-beneficios-area>
    <!-- Nuestros Beneficios Area End -->

    <!-- Más Populares Area Start-->
    <x-capperu.programas-populares-area></x-capperu.programas-populares-area>
    <!-- Más Populares Area End -->

    <!-- Testimonios Area Start-->
    <x-capperu.testimonios-area></x-capperu.testimonios-area>
    <!-- Testimonios Area End -->

    <!-- Convenios Area - HOME - Start-->
    <x-capperu.convenios-area-home></x-capperu.convenios-area-home>
    <!-- Convenios Area - HOME - End -->

    <x-capperu.footer-area></x-capperu.footer-area>

@endsection