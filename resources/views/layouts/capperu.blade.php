
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
    <link rel="stylesheet" href="{{ asset('themes/capperu/assets/css/aracode.css') }}">
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
    
    @yield('content')

    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Agregar un producto al carrito
        function agregarAlCarrito(producto) {
            carritoTemp=obtenerCarrito();
                
            var agregar = true;
                    for (let i = 0; i < carritoTemp.length; i++) { //consulta si ya exist el artículo en el carrito
                            if(carritoTemp[i].id == producto.id){
                                Swal.fire({
                                    title: "Hola",
                                    text: producto.nombre + " ya se encuentra en su carrito de compras.",
                                    icon: "warning",
                                    confirmButtonText: "Aceptar"
                                });

                                agregar = false;
                                break;
                            }                
                        }

                    if(agregar){

                        Swal.fire({  //Consulta para agregar item al CARRITO
                                title: 'Estas a punto de Aprender',
                                text: '¿Deseas agregar "'+producto.nombre+'" al Carrito?',
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'Sí',
                                cancelButtonText: 'No'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                              // Obtener el carrito actual del almacenamiento local
                                        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

                                        // Agregar el producto al carrito
                                        carrito.push(producto);

                                        // Guardar el carrito actualizado en el almacenamiento local
                                        localStorage.setItem('carrito', JSON.stringify(carrito));
                                        console.log(producto.nombre+ " fue agregado al carrito.");
                                        getTotal();
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    // Acción a realizar si el usuario hace clic en "No" o cierra el diálogo
                                    console.log('El usuario ha cancelado.');
                                }
                                });

                    }
        }

        // Obtener el carrito actual
        function obtenerCarrito() {
        return JSON.parse(localStorage.getItem('carrito')) || [];
        }

        function eliminarCarrito() { //ELiminar por completo el carrito de Compras
        localStorage.removeItem('carrito');
        }
    </script>

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

    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
        })
    </script>

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