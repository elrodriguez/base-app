
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CAP | Sitio Web</title>
    <!--fivicon icon-->
    <link rel="icon" href="{{ asset('themes/capperu/assets/img/fevicon-cap.png') }}">
    <!--fivicon icon
    <link rel="icon" href="assets/img/fevicon.png">
    -->
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/magnific.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/slick-slide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/responsive.css') }}">

    <!-- Stylesheet 
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/magnific.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.min.css">
    <link rel="stylesheet" href="assets/css/owl.min.css">
    <link rel="stylesheet" href="assets/css/slick-slide.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    -->

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body class='sc5'>
    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div id="wave1">
            </div>
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- search popup area start -->
    <div class="search-popup" id="search-popup">
        <form action="home.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- //. search Popup -->

    <!-- navbar start -->
    <header class="navbar-area">
        <nav class="navbar navbar-expand-lg">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#themefie_main_menu" 
                    aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="logo">
                    <a class="main-logo" href="">
                        <img style="width:196px; height:61px;" src="{{ asset('themes/capperu/assets/img/logo-cap.png') }}" alt="img">
                    </a>
                </div>
                <div class="nav-right-part nav-right-part-mobile">
                    <ul>
                        <li><a class="search header-search" href="#"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="themefie_main_menu">
                    <!--
                    <div class="single-input-wrap">
                        <input type="text" placeholder="buscar programa">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                    -->
                    
                    <ul class="navbar-nav menu-open text-end">
                        <li>
                            <a href="">Home</a>
                        </li>
                        <li>
                            <a href="">Nosotros</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Programa de Estudios</a>
                            <ul class="sub-menu">
                                <li><a href="blog-cat.html">Blog Category</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="course.html">Course</a></li>
                                <li><a href="course-details.html">Course Details</a></li>
                                <li><a href="category.html">Category</a></li>
                                <li><a href="instructor.html">Instructor</a></li>
                                <li><a href="instructor-details.html">Single Instructor</a></li>
                                <li><a href="dashboard.html">Dashboard</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="">Blog</a>
                        </li>
                        <li>
                            <a href="">Contacto</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-right-part nav-right-part-desktop">
                    <ul>
                        <li class="right-search">
                            <a href="#"><i class="fa fa-search"></i></a>
                            <div class="single-input-wrap">
                                <input type="text" placeholder="Search your best courses">
                                <button><i class="fa fa-search"></i></button>
                            </div>
                        </li>
                        <li><a href="#"><i class="fa fa-shopping-basket"></i></a></li>
                        <li>
                            <a href="" class="btn btn-base-light">
                                Campus Virtual
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="category-responsive d-xl-none d-block">
        <div class="container">
            <div class="category-slider owl-carousel">
                <div class="item"><a href="categoria">Categoria 01</a></div>
                <div class="item"><a href="categoria">Categoria 02</a></div>
                <div class="item"><a href="categoria">Categoria 03</a></div>
                <div class="item"><a href="categoria">Categoria 04</a></div>
                <div class="item"><a href="categoria">Categoria 05</a></div>
                <div class="item"><a href="categoria">Categoria 06</a></div>
                <div class="item"><a href="categoria">Categoria 07</a></div>
                <div class="item"><a href="categoria">Categoria 08</a></div>
            </div>
        </div>
    </div>
    <div class="category-navbar navbar-area d-xl-block d-none">
        <nav class="navbar navbar-expand-lg">
            <div class="container nav-container">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav menu-open">
                        <li><a href="categoria">Categoria 01</a></li>
                        <li><a href="categoria">Categoria 02</a></li>
                        <li><a href="categoria">Categoria 03</a></li>
                        <li><a href="categoria">Categoria 04</a></li>
                        <li><a href="categoria">Categoria 05</a></li>
                        <li><a href="categoria">Categoria 06</a></li>
                        <li><a href="categoria">Categoria 07</a></li>
                        <li><a href="categoria">Categoria 08</a></li>
                        <li><a href="categoria">Categoria 09</a></li>
                        <li><a href="categoria">Categoria 10</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end -->

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

    <!-- trending courses Area Start-->
    <section class="trending-courses-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nuevos Programas</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <ul class="edl-nav nav nav-pills">
                        <li class="nav-item">
                            <button class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" data-bs-target="#pills-1">Todos los programas</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2">Categoria 01</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-3-tab" data-bs-toggle="pill" data-bs-target="#pills-3">Categoria 02</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-4-tab" data-bs-toggle="pill" data-bs-target="#pills-4">Categoria 03</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-5-tab" data-bs-toggle="pill" data-bs-target="#pills-5">Categoria 04</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-6-tab" data-bs-toggle="pill" data-bs-target="#pills-6">Categoria 05</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-1">
                            <div class="course-slider owl-carousel">
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-red">Expert</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/2.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Best way learn fundamentals of design.</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-green">All Level</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">About latest tips news and course for Illustration 2021</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Email & Affiliate Marketing Mastermind</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-2">
                            <div class="course-slider owl-carousel">
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-red">Expert</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/2.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Best way learn fundamentals of design.</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-green">All Level</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">About latest tips news and course for Illustration 2021</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Email & Affiliate Marketing Mastermind</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-3">
                            <div class="course-slider owl-carousel">
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-red">Expert</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/2.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Best way learn fundamentals of design.</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-green">All Level</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">About latest tips news and course for Illustration 2021</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Email & Affiliate Marketing Mastermind</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-4">
                            <div class="course-slider owl-carousel">
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-red">Expert</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/2.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Best way learn fundamentals of design.</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-green">All Level</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">About latest tips news and course for Illustration 2021</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Email & Affiliate Marketing Mastermind</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-5">
                            <div class="course-slider owl-carousel">
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-red">Expert</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/2.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Best way learn fundamentals of design.</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-green">All Level</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">About latest tips news and course for Illustration 2021</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Email & Affiliate Marketing Mastermind</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-6">
                            <div class="course-slider owl-carousel">
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-red">Expert</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/2.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Best way learn fundamentals of design.</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-green">All Level</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/3.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">About latest tips news and course for Illustration 2021</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Beginner</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">Email & Affiliate Marketing Mastermind</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-users"></i></span>(76)
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">$30</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- trending courses Area End -->

    <!-- intro Area Start-->
    <div class="text-center pd-top-135">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2>Oportunidades excepcionales</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet .</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img src="{{ asset('themes/capperu/assets/img/intro/01.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Earn money</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img src="{{ asset('themes/capperu/assets/img/intro/02.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Inspire students</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img src="{{ asset('themes/capperu/assets/img/intro/03.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Join our community</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    <!-- intro Area End -->

    <!-- enllor courses Area Start-->
    <section class="enllor-courses-area pd-top-100 pd-bottom-140">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Most Students Enllor</h2>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-course-wrap">
                        <div class="thumb">
                            <a href="#" class="cat cat-blue">Beginner</a>
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
                                    <span><i class="fa fa-star"></i>
                                        4.9</span>(76)
                                </div>
                            </div>
                            <div class="price-wrap">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="#">Development</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="price">$30</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- enllor courses Area End -->

    <!-- testimonial courses Area Start-->
    <section class="testimonial-courses-area pd-bottom-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>People <i style="color: var(--main-color);" class="fa fa-heart"></i> Edufie</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="testimonial-slider-2 owl-carousel">
                        <div class="item">
                            <div class="single-testimonial-wrap">
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
                            <div class="single-testimonial-wrap">
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
                            <div class="single-testimonial-wrap">
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
                            <div class="single-testimonial-wrap">
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
                            <img src="{{ asset('themes/capperu/assets/img/client/1.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/client/2.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/client/3.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/client/4.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/client/5.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('themes/capperu/assets/img/client/6.png') }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- client Area End -->

    <!-- footer area start -->
    <footer class="footer-area">
        <div class="footer-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_link">
                            <h4 class="widget-title">Categories</h4>
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="pe-5">
                                        <li><a href="category.html">Development</a></li>
                                        <li><a href="category.html">Business</a></li>
                                        <li><a href="category.html">Finance & Accounting</a></li>
                                        <li><a href="category.html">IT & Software</a></li>
                                        <li><a href="category.html">Office Productivity</a></li>
                                        <li><a href="category.html">Design</a></li>
                                        <li><a href="category.html">Marketing</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4">
                                    <ul class="pe-5">
                                        <li><a href="category.html">Lifiestyle</a></li>
                                        <li><a href="category.html">Photography & Video</a></li>
                                        <li><a href="category.html">Health & Fitness</a></li>
                                        <li><a href="category.html">Music</a></li>
                                        <li><a href="category.html">UX Design</a></li>
                                        <li><a href="category.html">Seo</a></li>
                                        <li><a href="category.html">Business Analysis and Strategy</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4">
                                    <ul>
                                        <li><a href="category.html">Customer Service</a></li>
                                        <li><a href="category.html">Human Resources</a></li>
                                        <li><a href="category.html">Leadership and Management
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_link">
                            <h4 class="widget-title">Link</h4>
                            <ul class="pe-4">
                                <li><a href="blog.html">News & Blogs
                                </a></li>
                                <li><a href="blog-cat.html">Blog Category</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="course.html">Course</a></li>
                                <li><a href="course-details.html">Course Details</a></li>
                                <li><a href="instructor.html">Instructor</a></li>
                                <li><a href="instructor-details.html">Instructor Details</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_link">
                            <h4 class="widget-title">Support</h4>
                            <ul class="pe-4">
                                <li><a href="home.html">Documentation</a></li>
                                <li><a href="faq.html">FAQS</a></li>
                                <li><a href="dashboard.html">Dashboard</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Footer bottom-->
        <div class="container">
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-xl-7 align-self-center">
                        <div class="d-md-flex align-items-center mb-4 mb-xl-0">
                            <div class="logo d-inline-block">
                                <img src="assets/img/logo.png" alt="img">
                            </div>
                            <div class="copyright-area">
                                <p>© 2021 - Themefie. All Rights Reserved</p>       
                            </div>
                        </div>                        
                    </div>
                    <div class="col-xl-5 align-self-center text-xl-end">
                        <ul class="social-area d-inline-block">
                            <li><a class="active" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>
                        <select class="single-select float-sm-end">
                            <option>English</option>
                            <option value="asc">Bangla</option>
                            <option value="desc">Spanish</option>
                            <option value="pop">France</option>
                        </select>
                    </div>
                </div>                
            </div>
        </div>
        <!--Footer bottom-->
    </footer>
    <!-- footer area end -->    

    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

    

    <!-- all plugins here -->
    <script src="{{ asset('themes/capperu/assets/js/jquery.3.6.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/imageloded.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/counterup.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/waypoint.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/magnific.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/ripple.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/owl.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/slick-slider.min.js') }}"></script>
    <script src="{{ asset('themes/capperu/assets/js/wow.min.js') }}"></script>

    <!-- main js  -->
    <script src="{{ asset('themes/capperu/assets/js/main.js') }}"></script>

    <!-- all plugins here 
    <script src="assets/js/jquery.3.6.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/imageloded.min.js"></script>
    <script src="assets/js/counterup.js"></script>
    <script src="assets/js/waypoint.js"></script>
    <script src="assets/js/magnific.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/nice-select.min.js"></script>
    <script src="assets/js/fontawesome.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/owl.min.js"></script>
    <script src="assets/js/slick-slider.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    -->
    <!-- main js  
    <script src="assets/js/main.js"></script>
    -->
</body>
</html>