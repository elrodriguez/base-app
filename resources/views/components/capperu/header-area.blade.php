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
                            <a href="">Convenios</a>
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
                        <li>
                            <a href="carrito" class="btn btn-base-light"><i class="fa fa-cart-plus "></i><span id="contadorCarrito" class="contador"></span></a>
                        </li>
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
                <div class="item">
                    <a href="">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        capperuacademica@gmail.com
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        (01)7397026 – (043) 200324 - 977 66 24 60 - 946 94 38 87
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="category-navbar navbar-area d-xl-block d-none">
        <nav class="navbar navbar-expand-lg">
            <div class="container nav-container">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav menu-open" style="text-align:center;">
                        <li>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                capperuacademica@gmail.com
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                (01)7397026 – (043) 200324 - 977 66 24 60 - 946 94 38 87
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <style>
        .contador {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: rgba(98, 0, 255, 0.253);
        color: white;
        border-radius: 66%;
        padding: 2px 19px;
        font-size: 12px;
        }
    </style>
    <script>
        function cargarContadorCarrito(){
            // Obtener el carrito actual del almacenamiento local
        carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        actualizarContador(carrito.length);
        }
        // Actualizar el valor del contador
        function actualizarContador(valor) {
        // Obtener el elemento del contador
        var contadorCarrito = document.getElementById("contadorCarrito");
        if(valor==0){
            contadorCarrito.setAttribute("hidden", true); // Ocultar el contador
        }else{
            contadorCarrito.removeAttribute("hidden"); // Mostrar el contador
        }
        contadorCarrito.textContent = valor;
        }
        // Función a ejecutar cada 3 segundos
        function ejecutarCodigo() {
        // Aquí colocas el código que deseas ejecutar cada 3 segundos
        cargarContadorCarrito();
        }

        // Ejecutar la función cada 1 segundos
        setInterval(ejecutarCodigo, 700);
    </script>
</div>