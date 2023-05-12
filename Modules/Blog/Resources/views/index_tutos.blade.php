@extends('blog::layouts.master')
@section('title', 'Delventas Developers')
@section('title')
<meta name="robots" content="index, follow">
@stop
@section('content')
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Delventas Developers</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tutoriales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Consejos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="jumbotron jumbotron-fluid">
        <div class="container">
        <h1 class="display-4">Bienvenido a Delventas Blog</h1>
        <p class="lead">Encuentra tutoriales cortos y consejos para programadores.</p>
        </div>
    </header>

    <section class="container">
        <div class="row mb-4">
            <div class="col-12 col-md-9">
                @foreach($articles as $article)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('blog_article_by_url',$article->url ) }}" class="flex-shrink-0">
                                    <img src="{{ $article->imagen }}" alt="{{ $article->title }}" style="width: 100px;">
                                </a>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">
                                        <a href="{{ route('blog_article_by_url',$article->url ) }}" style="text-decoration: none; color: inherit;">
                                            {{ $article->title }}
                                        </a>
                                    </h5>
                                    <p>{{ $article->short_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('img/spc.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Sistema de Punto de Ventas de Calzado en Laravel 10</h5>
                      <p class="card-text">Nuestro sistema de punto de ventas de calzado desarrollado en Laravel 10 ofrece una solución completa y eficiente para la gestión de ventas de zapatillas por tallas.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item list-group-item-primary">Registro de productos</li>
                      <li class="list-group-item list-group-item-secondary">Administración de precios por local</li>
                      <li class="list-group-item list-group-item-success">Gestión de ventas</li>
                      <li class="list-group-item list-group-item-danger">Reportes de ventas</li>
                      <li class="list-group-item list-group-item-warning">Apertura y cierre de caja chica</li>
                      <li class="list-group-item list-group-item-light">Roles de usuario</li>
                    </ul>
                    {{-- <div class="card-body">
                      <a href="#" class="card-link">Roles de usuario</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    {{-- <footer class="bg-light py-4">
        <div class="container text-center">
        <p>&copy; 2023 {{ env('APP_NAME') }} Blog. Todos los derechos reservados.</p>
        </div>
    </footer> --}}

@endsection
