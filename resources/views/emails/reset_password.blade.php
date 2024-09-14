<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            line-height: 1.5;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #7963e0;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
@php
    $company = \App\Models\Company::first();
@endphp

<body>
    <div class="container">
        <div style="align-content: center;margin-bottom: 10px;width: 100%;">
            @if ($company->logo == '/img/logo176x32.png')
                <img src="{{ asset($company->logo) }}" style="width: 300px;" />
            @else
                <img src="{{ asset($company->logo) }}" style="width: 300px" />
            @endif
        </div>
        <h1>Hola, {{ $user->name }}</h1>
        <p>Estás recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña
            para tu cuenta:</p>
        <a href="{{ $url }}" class="button">Restablecer contraseña</a>
        <p>Este enlace de restablecimiento de contraseña caducará en 60 minutos.</p>
        <p>Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.</p>
        <div class="footer">
            <p>Saludos,<br>El equipo de {{ $company->name }}</p>
        </div>
    </div>
</body>

</html>
