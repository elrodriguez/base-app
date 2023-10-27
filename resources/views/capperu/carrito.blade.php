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




                        <div class="col-md-12" style="padding: 10px;" id="1_pc"> <!-- el id debe generarse de la base de datos el id concatenado a un string  id+"algo" ejemplo id."pc";-->
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
                                                        <a onclick="eliminarproducto({ id: 1, nombre: 'PHP for Beginners - Become a PHP Master - CMS Project', precio: 250 });"  class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="col-md-12" style="padding: 10px;" id="2_pc"> <!-- el id debe generarse de la base de datos el id concatenado a un string  id+"algo" ejemplo id."pc";-->
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Curso</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/1.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-course-wrap">
                                        <div class="wrap-details">
                                            <h6><a href="#">PHP for Seniors - Become a PHP Doctor - ERP Project</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/2.png') }}" alt="img">
                                                    <a href="#">James  Anderson</a>
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
                                                        <b>S/. 750.00</b>&nbsp;&nbsp;
                                                        <a onclick="eliminarproducto({ id: 2, nombre: 'PHP for Seniors - Become a PHP Doctor - ERP Project', precio: 750 })"  class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="col-md-12" style="padding: 10px;" id="3_pc"> <!-- el id debe generarse de la base de datos el id concatenado a un string  id+"algo" ejemplo id."pc";-->
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">Curso</a>
                                            <img src="{{ asset('themes/capperu/assets/img/course/4.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-course-wrap">
                                        <div class="wrap-details">
                                            <h6><a href="#">Mi primera Chamba</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                                    <a href="#">Bad Bunny</a>
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
                                                        <b>S/. 50.00</b>&nbsp;&nbsp;
                                                        <a onclick="eliminarproducto({ id: 3, nombre: 'Mi Primera Chamba', precio: 50 })" class="btn btn-danger">
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
                                <p><b id="totalid"></b></p>
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

    <script>
        // Obtener el carrito actual del almacenamiento local
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        console.log("items del carrito: ", carrito);
        //Tiene que hacer una consulta con los datos de la variable carrito para que llene los espacios necesarios de los cursos elegidos

        function eliminarproducto(producto){
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            let indice = carrito.findIndex(item => item.id === producto.id);
            if (indice >= 0) {
                // Elimina el producto del carrito utilizando el índice
                carrito.splice(indice, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));

                //codigo que elimine el producto o curso de la vista
                // Seleccionar el elemento con el ID "1pc" el id + la cadena ya especificada en la BD ejemplo id+"pc"
                const elemento = document.getElementById(producto.id+"_pc");

                // Verificar si el elemento existe antes de eliminarlo
                if (elemento) {
                    // Eliminar el elemento y su contenido
                    elemento.remove();
                }
            }
            getTotal();

            //Aquí el producto ya fue eliminado del localstorage y de la vista
            // ahora debería luego de que ya eliminó del localstorage "el producto o curso" verificar si está logueado y si lo está eliminar de la base de datos tambien
        }
        getTotal();
        function getTotal(){
            carritoTemp = JSON.parse(localStorage.getItem('carrito')) || [];
            total=0;
            for (let i = 0; i < carritoTemp.length; i++) {
                total+=carritoTemp[i].precio;                              
            }
            document.getElementById("totalid").textContent = "S/. "+total+".00";
            console.log("total: "+total);
        }
    </script>
    <!-- zoom courses Area End -->

    
    <!-- Más Populares Area Start-->
    <x-capperu.programas-populares-area></x-capperu.programas-populares-area>
    <!-- Más Populares Area End -->



    <x-capperu.footer-area></x-capperu.footer-area>

@endsection