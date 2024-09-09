<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 10px;
            margin-right: 10px;
        }

        * {
            font-size: 14px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        /* td.producto,
            th.producto {
                width: 75px;
                max-width: 75px;
            } */

        td.cantidad,
        th.cantidad {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.precio,
        th.precio {
            width: 90px;
            max-width: 90px;
            word-break: break-all;
        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px !important;
        }

        img {
            max-width: 400;
            width: 200;
            aling: center;
            margin: auto
        }
    </style>
</head>
@php
    $logo = '';
    if ($company->logo_document == '/img/logo176x32.png') {
        $logo = public_path($company->logo_document);
    } else {
        $logo = public_path('storage' . DIRECTORY_SEPARATOR . $company->logo_document);
    }

@endphp

<body style="padding: 0px">
    <div>
        <div style="margin-top:16px;width:100%;text-align: center">
            <img src="{{ $logo }}" alt="Logotipo" class="centrado">
        </div>
        <p class="centrado">
            {{-- {{ $company->name }} --}}
            <br>{{ \Carbon\Carbon::parse($document->created_at)->format('Y-m-d H:i:s') }}
        </p>
        <p class="centrado">NOTA DE VENTA</p>
        <p class="centrado">{{ $document->description }} - {{ $document->number }}</p>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th style="text-align: left" class="producto">PRODUCTO</th>
                    <th style="text-align: center" class="precio">S/.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    @php
                        $json = json_decode($item->product, true);
                        $size = isset($json['size']) ? $json['size'] : null;
                    @endphp
                    <tr>
                        <td style="text-align: center" class="cantidad">{{ (int) $item->quantity }}</td>
                        <td class="producto">
                            {{ json_decode($item->product, true)['interne'] }}-{{ json_decode($item->product, true)['description'] }}
                            {{ $size ? ' / ' . $size : '' }}
                        </td>
                        <td style="text-align: right" class="precio">{{ $item->total }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="cantidad"></td>
                    <td style="text-align: right" class="producto">TOTAL</td>
                    <td style="text-align: right" class="precio">{{ $sale->total }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table style="width: 100%; border-bottom: 1px solid black !important;padding:0px">
            <tr>
                <td style="padding: 0px">
                    <p style="padding: 0px">VENDEDOR: {{ $seller->name }}</p>
                </td>
            </tr>
        </table>
        {{-- <div style="margin-top:16px;margin-bottom:16px;width:100%;">
            <p class="centrado">
                ¡Vuelve a amar cada paso con {{ $company->name }}!
            </p>
        </div> --}}
        <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
    </div>
</body>

</html>
