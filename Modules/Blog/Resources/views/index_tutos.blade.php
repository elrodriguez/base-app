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
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
            @foreach($articles as $article)
                
                <div class="col">
                    <div class="card h-100 mb-4">
                        <img src="{{ $article->imagen }}" class="card-img-top" alt="{{ $article->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('blog_article_by_url',$article->url ) }}" class="btn btn-link">Leer más</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </section>

    {{-- <footer class="bg-light py-4">
        <div class="container text-center">
        <p>&copy; 2023 {{ env('APP_NAME') }} Blog. Todos los derechos reservados.</p>
        </div>
    </footer> --}}

@endsection
