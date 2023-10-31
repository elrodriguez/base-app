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
    @php
        require base_path('vendor/autoload.php');

        use MercadoPago\Client\Preference\PreferenceClient;
        use MercadoPago\Exceptions\MPApiException;
        use MercadoPago\MercadoPagoConfig;

        // Step 2: Set production or sandbox access token
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));
        $client = new PreferenceClient();

        $preference = $client->create([
            'external_reference' => 'teste',
            'items' => [
                [
                    'id' => '4567',
                    'title' => 'Dummy Title',
                    'description' => 'Dummy description',
                    'picture_url' => 'http://www.myapp.com/myimage.jpg',
                    'category_id' => 'eletronico',
                    'quantity' => 1,
                    'currency_id' => 'BRL',
                    'unit_price' => 100,
                ],
            ],
            'payment_methods' => [
                'default_payment_method_id' => 'master',
                'excluded_payment_types' => [
                    [
                        'id' => 'ticket',
                    ],
                ],
                'installments' => 12,
                'default_installments' => 1,
            ],
        ]);

    @endphp

    <!-- Banner Area Start-->
    <section class="banner-area style-3"
        style="padding: 40px; background-image: url({{ asset('themes/capperu/assets/img/banner/bg-2.jpg') }});">
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
                    <b id="total_productos">03 programas en el carrito</b>
                    <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                        <i class="fas fa-trash"></i>
                        <i class="fas fa-check-square"></i>
                      </button>
                    <div class="row" id="cart">
                        <div class="col-md-12" style="padding: 10px;" id="1_pc">
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-2">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <!--<a href="#" class="cat cat-blue">Curso</a>-->
                                            <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                            <a href="#">Jessica Jessy</a>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="color:orange;">
                                                <i class="fa fa-users"></i>
                                            </span>(76)
                                        </div>
                                        <div class="col-md-4">
                                            <a href="">
                                                <span style="color:orange;">
                                                    <b>En Vivo</b>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="price-wrap">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <b>S/. 250.00</b>&nbsp;&nbsp;
                                                    <a onclick="eliminarproducto({ id: 1, nombre: 'PHP for Beginners - Become a PHP Master - CMS Project', precio: 250 });"
                                                        class="btn btn-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="padding: 10px;" id="2_pc">
                            <!-- el id debe generarse de la base de datos el id concatenado a un string  id+"algo" ejemplo id."pc";-->
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-2">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <!--<a href="#" class="cat cat-blue">Curso</a>-->
                                            <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}" alt="img">
                                            <a href="#">Jessica Jessy</a>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="color:orange;">
                                                <i class="fa fa-users"></i>
                                            </span>(76)
                                        </div>
                                        <div class="col-md-4">
                                            <a href="">
                                                <span style="color:orange;">
                                                    <b>En Vivo</b>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="price-wrap">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <b>S/. 250.00</b>&nbsp;&nbsp;
                                                    <a onclick="eliminarproducto({ id: 2, nombre: 'PHP for Beginners - Become a PHP Master - CMS Project', precio: 250 });"
                                                        class="btn btn-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="padding: 10px;" id="3_pc">
                            <!-- el id debe generarse de la base de datos el id concatenado a un string  id+"algo" ejemplo id."pc";-->
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-2">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <!--<a href="#" class="cat cat-blue">Curso</a>-->
                                            <img src="{{ asset('themes/capperu/assets/img/course/7.png') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('themes/capperu/assets/img/author/1.png') }}"
                                                alt="img">
                                            <a href="#">Jessica Jessy</a>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="color:orange;">
                                                <i class="fa fa-users"></i>
                                            </span>(76)
                                        </div>
                                        <div class="col-md-4">
                                            <a href="">
                                                <span style="color:orange;">
                                                    <b>En Vivo</b>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                        <div class="price-wrap">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <b>S/. 250.00</b>&nbsp;&nbsp;
                                                    <a onclick="eliminarproducto({ id: 3, nombre: 'PHP for Beginners - Become a PHP Master - CMS Project', precio: 250 });"
                                                        class="btn btn-danger">
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
                                <div id="wallet_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        
        
        cargarItemsCarritoBD();
        function cargarItemsCarritoBD(){
                document.getElementById('cart').innerHTML =""; // BORRAR contenido de la vista, antes de cargar de la base de datos
                    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                carrito.forEach(function(item) {
                        // Hacer algo con cada elemento del carrito
                        realizarConsulta(item.id);
                });
        }

        function realizarConsulta(id) {
            // Realizar la petición Ajax
            var csrfToken = "{{ csrf_token() }}";

            $.ajax({
                url: '{{ route('onlineshop_get_item_carrito') }}',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(respuesta) {
                    // La consulta se realizó exitosamente
                    console.log("respuesta de servidor", respuesta);
                    renderProducto(respuesta);
                    // Aquí puedes hacer algo con la respuesta recibida
                },
                error: function(xhr) {
                    // Ocurrió un error al realizar la consulta
                    console.log(xhr.responseText);
                    // Aquí puedes manejar el error de alguna manera
                }
            });

        }

        function renderProducto(respuesta) {
            var cart = document.getElementById('cart');
            if(cart != null){
            var id = respuesta.id;
            var teacher = respuesta.teacher;
            var teacher_id = respuesta.teacher_id;
            var avatar = respuesta.avatar;
            var image = respuesta.image;
            var name = respuesta.name;
            var price = respuesta.price;
            var modalidad = respuesta.additional;            
            cart.innerHTML += `
            <div class="col-md-12" style="padding: 10px;" id="` + id + `_pc">
                            <div class="row contact-inner" style="padding: 10px; border: 1px solid #f2f2f2;">
                                <div class="col-md-2">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <img src="` + image + `" alt="img"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6><a href="#">` + name + `</a></h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="`+ avatar +`" alt="img">
                                            <a href="#">`+ teacher +`</a>
                                        </div>
                                        <div class="col-md-4">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <a href="">
                                                <span style="color:orange;">
                                                    <b>` + modalidad + `</b>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="single-course-wrap">
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <b>S/. ` + price + `</b>&nbsp;&nbsp;
                                                        <a onclick="eliminarproducto({ id: ` + id + `, nombre: '` +
                                                                                        name + `', precio: ` + price + ` });"  class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    }
        }
    </script>


    <!-- zoom courses Area End -->


    <!-- Más Populares Area Start-->
    <x-capperu.programas-populares-area></x-capperu.programas-populares-area>
    <!-- Más Populares Area End -->



    <x-capperu.footer-area></x-capperu.footer-area>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        const mp = new MercadoPago("{{ env('MERCADOPAGO_KEY') }}");

        mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: "{{ $preference->id }}",
            },
        });
    </script>
@endsection
