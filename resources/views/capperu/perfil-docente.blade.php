@@ -0,0 +1,342 @@
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
    <section class="banner-area style-3" style="padding: 120px 0px; z-index: -1; background-image: url({{ asset('themes/capperu/assets/img/banner/bg-2.jpg') }});">
    </section>
    <!-- Banner Area End -->

    <!-- instructor Area Start-->
    <div class="pd-bottom-115" style="z-index: 9999999;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="instructor-details-area text-center">
                        <div class="thumb">
                            <img src="{{ asset('themes/capperu/assets/img/instructor-details.png') }}" alt="img">
                        </div>
                        <h3>Jessica Jessy
                        </h3>
                        <p>Staff de Docentes</p>
                        
                        <ul class="achivement-fact">
                            {{-- <li class="ratting">
                                <div class="icon">
                                    <img src="{{ asset('themes/capperu/assets/img/icon/star.png') }}" alt="img">
                                </div>
                                <h5 class="counter">5.0</h5>
                                <p>Ratings</p>
                            </li>
                            <li class="students">
                                <div class="icon">
                                    <img src="{{ asset('themes/capperu/assets/img/icon/user.png') }}" alt="img">
                                </div>
                                <h5 class="counter">28,453</h5>
                                <p>Students Learning</p>
                            </li>
                            <li class="courses">
                                <div class="icon">
                                    <img src="{{ asset('themes/capperu/assets/img/icon/book.png') }}" alt="img">
                                </div>
                                <h5 class="counter">34</h5>
                                <p>Courses</p>
                            </li> --}}
                        </ul>

                        <div class="text-start px-30">
                            <h5>Acerca de mí</h5>
                            <p>Starting out at the age of 13 I never stopped learning new programming skills and languages. Early I started creating websites for friends and just for fun as well. Besides web development I also explored Python and other non-web-only languages. This passion has since lasted and lead to my decision of working as a freelance web developer and consultant. The success and fun I have in this job is immense and really keeps that passion burningly alive.</p>
                        </div>
                        <!-- <div class="education-qualification">
                            <h5>Education</h5>
                            <ul>
                                <li>Bachelor Degree<span>2009-2011</span></li>
                                <li>Master Degree<span>2012-2011</span></li>
                                <li>Bachelor Degree<span>2009-2011</span></li>
                                <li>Bachelor Degree<span>2009-2011</span></li>
                                <li>Bachelor Degree<span>2009-2011</span></li>
                                <li>Bachelor Degree<span>2009-2011</span></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-8 pd-top-120">
                    <h5>Lista de Programas</h5>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="{{ route('web_categoria_programa_cursos') }}" class="cat cat-blue">Curso</a>
                                    <a href="{{ route('web_descripcion_en_vivo') }}">
                                        <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6>
                                        <a href="{{ route('web_descripcion_en_vivo') }}">PHP for Beginners - Become a PHP Master - CMS Project</a>
                                    </h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                            <a href="{{ route('web_perfil_docente') }}">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span>
                                                <i class="fa fa-users"></i>
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
                                                <a href="" class="btn btn-primary">
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
                        <div class="col-md-6">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="{{ route('web_categoria_programa_diplomados') }}" class="cat cat-red">Diplomado</a>
                                    <a href="{{ route('web_descripcion_en_vivo') }}">
                                        <img src="{{ asset('themes/capperu/assets/img/course/5.png') }}" alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6>
                                        <a href="#">Java (Beginner) Programming Tutorials</a>
                                    </h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                            <a href="{{ route('web_perfil_docente') }}">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span>
                                                <i class="fa fa-users"></i>
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
                        <div class="col-md-6">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="{{ route('web_categoria_programa_cursos') }}" class="cat cat-blue">Curso</a>
                                    <a href="{{ route('web_descripcion_e_learning') }}">
                                        <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6>
                                        <a href="{{ route('web_descripcion_e_learning') }}">PHP for Beginners - Become a PHP Master - CMS Project</a>
                                    </h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                            <a href="{{ route('web_perfil_docente') }}">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span>
                                                <i class="fa fa-users"></i>
                                            </span>(76)
                                        </div>
                                    </div>
                                    <div class="user-area" style="padding: 0px;">
                                        <div class="user-details">
                                            <a href="{{ route('web_categoria_sector') }}">&nbsp;S. Empresarial</a>
                                        </div>
                                        <div class="user-rating">
                                            <a href="{{ route('web_categoria_modalidad_e_learning') }}">&nbsp;E-Learning</a>
                                        </div>
                                    </div>
                                    <div class="price-wrap">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <a href="" class="btn btn-primary">
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
                        <div class="col-md-6">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="{{ route('web_categoria_programa_cursos') }}" class="cat cat-blue">Curso</a>
                                    <a href="{{ route('web_descripcion_en_vivo') }}">
                                        <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6>
                                        <a href="{{ route('web_descripcion_en_vivo') }}">PHP for Beginners - Become a PHP Master - CMS Project</a>
                                    </h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                            <a href="{{ route('web_perfil_docente') }}">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span>
                                                <i class="fa fa-users"></i>
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
                                                <a href="" class="btn btn-primary">
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
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Nuevo</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>            
    </div>
    <!-- instructor Area End -->

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



    <x-capperu.footer-area></x-capperu.footer-area>

@endsection