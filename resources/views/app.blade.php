<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/isotipo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @php
        $parts = explode('::', $page['component']);
    @endphp
    @if (count($parts) > 1)
        @vite(['resources/js/app.js', "Modules/{$parts[0]}/Resources/assets/js/Pages/{$parts[1]}.vue"])
    @else
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @endif
    @inertiaHead
</head>

<body>
    @inertia
    <script>
        window.assetUrl = @json(asset(''));
    </script>
</body>

</html>
