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
    <section class="banner-area style-3" style="padding: 80px; background-image: url({{ asset('themes/capperu/assets/img/banner/bg-2.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 align-self-center">
                    <div class="banner-inner text-center">
                        <h1>Carrito de Compras</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->
    
    
    <!-- zoom courses Area Start-->
    <section class="zoom-courses-area pd-top-100 pd-bottom-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <b>03 cursos en el carrito</b>
                    <div class="row">
                        <div class="col-md-12" style="padding: 10px;">
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Curso</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-course-wrap">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <b>S/. 250.00</b>&nbsp;&nbsp;
                                                        <a href="#" class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 10px;">
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Curso</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-course-wrap">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <b>S/. 250.00</b>&nbsp;&nbsp;
                                                        <a href="#" class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 10px;">
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Curso</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-course-wrap">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <b>S/. 250.00</b>&nbsp;&nbsp;
                                                        <a href="#" class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="contact-form">
                                    <div class="row">
                                        <div class="col-md-12 single-input-wrap">
                                            <input type="text" placeholder="Nombres">
                                        </div>
                                        <div class="col-md-6 single-input-wrap">
                                            <input type="text" placeholder="Ap. Paterno">
                                        </div>
                                        <div class="col-md-6 single-input-wrap">
                                            <input type="text" placeholder="Ap. Materno">
                                        </div>
                                        <div class="col-md-12 single-input-wrap">
                                            <input type="text" placeholder="Teléfono">
                                        </div>
                                        <div class="col-md-12 single-input-wrap">
                                            <input type="text" placeholder="E-mail">
                                        </div>
                                        <div class="col-md-12 single-input-wrap">
                                            <select class="form-select" aria-label="Default select example">
                                                <option> Tipo de Documento</option>
                                                <option value="1">DNI</option>
                                                <option value="2">Carnet de extranjeria</option>
                                                <option value="3">Ruc</option>
                                            </select>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-12 single-input-wrap">
                                            <input type="text" placeholder="Número">
                                        </div>
                                    </div>                                
                                </form>
                            </div>
                            <div class="col-md-12" style="font-size: 20px;">
                                <i class="fa fa-heart"></i> Total:
                            </div>
                            <div class="col-md-12" style="font-size: 25px;">
                                <p><b>S/. 750.00</b></p>
                            </div>
                            <div class="col-md-12">
                                <a class="btn btn-primary" style="width: 100%">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i> &nbsp;&nbsp;Realizar Pago
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- zoom courses Area End -->

    
    <!-- Más Populares Area Start-->
    <x-capperu.programas-populares-area></x-capperu.programas-populares-area>
    <!-- Más Populares Area End -->



    <x-capperu.footer-area></x-capperu.footer-area>

@endsection