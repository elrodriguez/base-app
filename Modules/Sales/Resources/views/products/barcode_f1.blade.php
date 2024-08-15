<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Código de Barras</title>
    <style>
        @page {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
        }

        body {
            margin: 0px;
            font-family: monospace;
            font-size: 10px;
            padding-top: 4px
        }

        .container {
            height: 76px;

            width: 100%
        }

        .barcode-container {
            text-align: center;
            margin-bottom: 4px
        }

        .barcode-image {
            width: 150px;
            /* Ajusta el ancho según sea necesario */
            height: auto;
        }
    </style>
</head>

<body>
    @php
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    @endphp
    <table width="100&" style="margin: auto">
        @foreach (json_decode($product->sizes) as $item)
            @if ($item->quantity > 0)
                @php
                    $stringCode =
                        $product->interne . '|' . json_decode($product->sale_prices)->high . '|' . $item->size;
                    $image = base64_encode($generator->getBarcode($stringCode, $generator::TYPE_EAN_5, 3, 50));
                @endphp
                <tr>
                    <td style="width: 150px;">
                        <div class="container">
                            <div class="barcode-container">
                                <img src="data:image/png;base64,{{ $image }}" class="barcode-image"
                                    alt="Código de barras">
                            </div>
                            <span>PRECIO: S/
                                {{ number_format(json_decode($product->sale_prices)->high, 2, ',', ' ') }}
                            </span><br />
                            <span>PT: {{ $item->size }}
                            </span>
                        </div>
                    </td>
                    <td style="width: 15px"></td>
                    <td style="width: 150px;">
                        <div class="container">
                            <div class="barcode-container">
                                <img src="data:image/png;base64,{{ $image }}" class="barcode-image"
                                    alt="Código de barras">
                            </div>
                            <span>PRECIO: S/
                                {{ number_format(json_decode($product->sale_prices)->high, 2, ',', ' ') }}
                            </span>
                            <br />
                            <span>PT: {{ $item->size }}
                            </span>
                        </div>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
</body>

</html>
