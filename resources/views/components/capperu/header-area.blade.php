<div>
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
                        <li><a href="carrito" class="btn btn-base-light"><i class="fa fa-cart-plus"></i></a></li>
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
                            <a href="{{ route('cms_principal') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('web_nosotros') }}">Nosotros</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Programa de Estudios</a>
                            <ul class="sub-menu">
                                <li><a href="">Sector: <b>Empresarial</b></a></li>
                                <li><a href="">Sector: <b>Laboral</b></a></li>
                                <li><a href="">Sector: <b>Penal</b></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('web_categorias') }}">Categorias</a>
                        </li>
                        <li>
                            <a href="">Blog</a>
                        </li>
                        <li>
                            <a href="{{ route('web_contacto') }}">Contacto</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-right-part nav-right-part-desktop">
                    <ul>
                        <li><a href="carrito" class="btn btn-base-light"><i class="fa fa-cart-plus"></i></a></li>
                        <li>
                            <a href="" class="btn btn-primary">
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
</div>