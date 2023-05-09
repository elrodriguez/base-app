@extends('blog::layouts.master')
@section('title', $article->title)

@section('title')
<meta name="robots" content="index, follow">
<meta name="keywords" content="laravel 10, php8">
{{-- <meta name="description" content="Descripción breve de la página"> --}}
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
                        <a class="nav-link" href="{{ route('blog_principal') }}">Inicio</a>
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
    <main class="container"> 
        <div class="row g-5"> 
            <div class="col-md-8"> 
                <div class="mt-4">
                    <h3>{{ $article->title }}</h3>
                </div>
                <article class="blog-post"> 
                    {!! $article->content_text !!}
                </article>
                {{-- <nav class="blog-pagination" aria-label="Pagination"> 
                    <a class="btn btn-outline-primary rounded-pill" href="#">Older</a> 
                    <a class="btn btn-outline-secondary rounded-pill disabled">Newer</a> 
                </nav>  --}}
            </div> 
            <div class="col-md-4"> 
                <div class="position-sticky" style="top: 2rem;"> 
                    {{-- <div class="p-4 mb-3 bg-body-tertiary rounded"> 
                        <h4 class="fst-italic">About</h4> 
                        <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p> 
                    </div> 
                    <div class="p-4"> 
                        <h4 class="fst-italic">Elsewhere</h4> 
                        <ol class="list-unstyled"> 
                            <li><a href="#">GitHub</a></li> 
                            <li><a href="#">Twitter</a></li> 
                            <li><a href="#">Facebook</a></li> 
                        </ol> 
                    </div>  --}}
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2128776301009629"
                    crossorigin="anonymous"></script>
                </div> 
            </div> 
        </div> 
    </main> 
    <footer class="bg-light py-4">
        <div class="container text-center">
        <p>&copy; 2023 {{ env('APP_NAME') }} Blog. Todos los derechos reservados.</p>
        </div>
    </footer>
@endsection
