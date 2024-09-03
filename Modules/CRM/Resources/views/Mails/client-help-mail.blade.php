<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>{{ $data[0]->title }}</title>
</head>

<body>
    <div>
        {!! html_entity_decode($data[1]->content, ENT_QUOTES, 'UTF-8') !!}
    </div>
</body>

</html>
