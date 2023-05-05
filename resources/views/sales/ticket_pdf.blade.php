<!DOCTYPE html>
<html>
    <head>
        <title>Ticket</title>
        <style>
        caption {
            padding: 0.3em;
            color: #fff;
            background: #000;
        }
        .table th {
            background: #eee;
        }
        </style>
    </head>
    <body>
        <div style="width: 72mm;height: auto;padding: 0px;font-family: Arial, sans-serif;font-size: 12px;">
            <div>
                <table style="border: 0px;width: 100%">
                    <tr>
                        <td style="width:20%"><img src="{{ asset('img/logo.jpg') }}" alt="Logo" style="width: 60px"></td>
                        <td style="width:80%"><h1>{{ env('APP_NAME','Laravel') }}</h1></td>
                    </tr> 
                </table>
              
            </div>
            <span>Dirección: {{ $local->address }}</span>
            <br>
            <span>Teléfono: {{ $local->phone }}</span>
            <br>
            <br>
            <div style="text-align: center">
                
                <h1>{{ $document->description }} - {{ $document->number }}</h1>
            </div>
            <table style="width: 100%;border: 1px solid #000;border-collapse: collapse;">
                <tr>
                    <td style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">Cant.</td>
                    <td style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">Producto</td>
                    <td style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">Precio U.</td>
                    {{-- <td style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">Descuento.</td> --}}
                    <td style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">Importe</td>
                </tr>
                @foreach ($products as $item)
                    <tr>
                        <td style="text-align: right;vertical-align: top;
                        border: 1px solid #000;
                        border-collapse: collapse;
                        padding: 0.3em;
                        caption-side: bottom;">{{ (int) $item->quantity }}</td> 
                        <td style="vertical-align: top;
                        border: 1px solid #000;
                        border-collapse: collapse;
                        padding: 0.3em;
                        caption-side: bottom;">{{ json_decode($item->product,true)['interne'] }}-{{ json_decode($item->product,true)['description'] }} / {{ json_decode($item->product,true)['size'] }}</td>
                        <td style="text-align: right;vertical-align: top;
                        border: 1px solid #000;
                        border-collapse: collapse;
                        padding: 0.3em;
                        caption-side: bottom;">{{ $item->price }}</td>
                        {{-- <td style="text-align: right;vertical-align: top;
                        border: 1px solid #000;
                        border-collapse: collapse;
                        padding: 0.3em;
                        caption-side: bottom;">{{ $item->discount }}</td> --}}
                        <td style="text-align: right;vertical-align: top;
                        border: 1px solid #000;
                        border-collapse: collapse;
                        padding: 0.3em;
                        caption-side: bottom;">{{ $item->total }}</td>
                    </tr>
                @endforeach
            </table>
            <table  style="border: 0px;width:100%">
                <tr>
                    <td style="text-align: right;width:80%">Total</td>
                    <td style="text-align: right;width:20%">{{ $sale->total }}</td>
                </tr>
            </table>
        </div>
    </body>
</html>
