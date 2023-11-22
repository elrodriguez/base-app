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
                                    <h6><a href="#">Público</a></h6>
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


                @if (count($programs) > 0)
                    @foreach ($programs as $key => $program)
                        <div class="col-md-3">
                            <div class="single-course-wrap" style="background-color: #F9FAFD;">
                                <div class="thumb">
                                    <a href="{{ route('web_categoria_programa_cursos') }}" class="cat cat-blue"
                                        style="font-size: 18px;">
                                        {{ $program->additional }}
                                    </a>
                                    <a href="{{ route('web_descripcion_programa', $program->id) }}">
                                        <img style="height: 260px; object-fit: cover;" src="{{ asset($program->image) }}"
                                            alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6 title="{{ $program->name }}" class="texto-oculto2">
                                        <a
                                            href="{{ route('web_descripcion_programa', $program->id) }}">{{ $program->name }}</a>
                                    </h6>
                                    <div>
                                        <div>
                                            <p class="texto-oculto3">{{ $program->description }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="user-area" style="padding: 3px;">
                                        <div class="user-details">
                                            <img style="width: 30px; height: 30px; border-radius: 50%;"
                                                src="{{ $program->avatar }}" alt="img">
                                            <a
                                                href="{{ route('web_perfil_docente', $program->teacher_id) }}">{{ $program->teacher }}</a>
                                        </div>
                                        <div class="user-rating">
                                            <span style="color:orange;">
                                                <i class="fa fa-users"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="user-area" style="padding: 3px;">
                                        <div class="user-details">
                                            <a href="">
                                                <span style="color:orange;">
                                                    Sector:
                                                </span>
                                                <br>
                                                <b>{{ $program->category_description }}</b>
                                            </a>
                                        </div>
                                        <div class="user-rating">
                                            <a href="">
                                                <span style="color:orange;">
                                                    <i>Modalidad:</i>
                                                </span>
                                                <br>
                                                <b>
                                                    <div style="text-align: right;">{{ $program->additional1 }}</div>
                                                </b>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="price-wrap">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <button
                                                    onclick="agregarAlCarrito({ id: {{ $program->id }}, nombre: '{{ $program->name }}', precio: {{ $program->price }} })"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-cart-plus"></i>
                                                    &nbsp;&nbsp;Comprar Ahora S/. {{ $program->price }}
                                                </button>
                                                <div id="wallet_container"></div>
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
