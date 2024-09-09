<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
            font-family: "VT323", monospace;
            color: #1f1f1f;
        }

        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .receipt {
            width: 100%;
            margin: 0 auto;
        }

        .logo {
            text-align: center;
            padding: 20px;
        }

        .barcode {
            font-family: "Libre Barcode 128", cursive;
            font-size: 42px;
            text-align: center;
        }

        .address {
            text-align: center;
            margin-bottom: 10px;
        }

        .transactionDetails {
            display: flex;
            justify-content: space-between;
        }

        .transactionDetails .detail {
            text-transform: uppercase;
        }

        .centerItem {
            display: flex;
            justify-content: center;
            margin-bottom: 8px;
        }

        .survey {
            text-align: center;
            margin-bottom: 12px;
        }

        .survey .surveyID {
            font-size: 14px;
        }

        .paymentDetails {
            display: flex;
            justify-content: space-between;
            margin: 0 auto;
        }

        .creditDetails {
            margin: 10px auto;
            width: 273px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .receiptBarcode {
            margin: 10px 0;
            text-align: center;
        }

        .returnPolicy {
            margin: 10px 20px;
            width: 273px;
            display: flex;
            justify-content: space-between;
        }

        .coupons {
            margin-top: 20px;
        }

        .tripSummary {
            margin: auto;
            width: 273px;
        }

        .tripSummary .item {
            display: flex;
            justify-content: space-between;
            margin: auto;
            width: 273px;
        }

        .feedback {
            margin: 20px auto;
        }

        .feedback h3.clickBait {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        .feedback h4.web {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        .feedback .break {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .couponContainer {
            border-top: 1px dashed #1f1f1f;
            margin-bottom: 20px;
        }

        .couponContainer .discount {
            font-size: 35px;
            text-align: center;
            margin-bottom: 10px;
        }

        .couponContainer .discountDetails {
            font-size: 20px;
            text-align: center;
            margin-bottom: 15px;
        }

        .couponContainer .barcode {
            margin: 10px 0 0;
        }

        .couponContainer .legal {
            font-size: 12px;
            margin-bottom: 12px;
        }

        .couponContainer .barcodeID {
            margin-bottom: 8px;
        }

        .couponContainer .expiration {
            display: flex;
            justify-content: space-between;
            margin: 10px;
        }

        .couponContainer .couponBottom {
            font-size: 13px;
            text-align: center;
        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        .container {
            padding: 0px 4px 0px 4px
        }
    </style>
</head>
@php
    $company = \App\Models\Company::first();
    $logo = '';
    if ($company->logo_document == '/img/logo176x32.png') {
        $logo = public_path($company->logo_document);
    } else {
        $logo = public_path('storage' . DIRECTORY_SEPARATOR . $company->logo_document);
    }

@endphp

<body>

    <div class="container">
        <div class="receipt">
            <div style="margin-top:36px;width:100%;text-align: center">
                <img src="{{ $logo }}" class="centrado" style="width: 70%">
            </div>

            <div class="address">
                {{ $document->getCompany()->getRazonSocial() }}<br>
                R.U.C.: {{ $document->getCompany()->getRuc() }}<br>
                Teléfono: {{ $params['user']['header'] }}<br>
                {{ $document->getCompany()->getAddress()->getDireccion() }}
            </div>
            <table style="width: 100%">
                <tr>
                    @if ($document->getTipoDoc() == '01')
                        <td align="center">
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:18px" text-align="center">
                                FACTURA
                            </span>
                            <br>
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:12px" text-align="center">
                                E L E C T R Ó N I C A
                            </span>
                        </td>
                    @elseif($document->getTipoDoc() == '03')
                        <td align="center">
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:18px" text-align="center">
                                BOLETA DE VENTA
                            </span>
                            <br>
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:12px" text-align="center">
                                E L E C T R Ó N I C A
                            </span>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td align="center">
                        <span style="font-size:18px">
                            {{ $document->getSerie() }}-{{ $document->getCorrelativo() }}
                        </span>
                    </td>
                </tr>
            </table>
            <div class="transactionDetails" style="margin-top: 26px">
                <div class="detail" style="font-size: 12px">
                    @if ($document->getTipoDoc() == '01')
                        <strong>RUC:</strong>
                    @elseif($document->getTipoDoc() == '03')
                        <strong>N/D:</strong>
                    @endif
                    {{ $document->getClient()->getNumDoc() }}
                </div>
                <div class="detail" style="font-size: 12px">
                    <strong>Razón Social:</strong>
                    {{ $document->getClient()->getRznSocial() }}
                </div>
                <div class="detail" style="font-size: 12px">
                    <strong>Dirección: </strong>
                    {{ $document->getClient()->getAddress() }}
                </div>
                <div class="detail" style="font-size: 12px">
                    <strong>Fecha Emisión: </strong>
                    {{ $document->getFechaEmision()->format('Y-m-d H:i:s') }}
                </div>
            </div>
            <div class="transactionDetails" style="font-size: 12px">
                @foreach ($params['user']['extras'] as $extra)
                    {{ $extra['name'] }} : {{ $extra['value'] }}<br />
                @endforeach
            </div>
            <table style="font-size: 11px; width: 100%;border: 0px; border-collapse: collapse; ">
                <thead>
                    <tr>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="center"
                            class="bold">Cant.</td>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="center"
                            class="bold">Unidad</td>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="left"
                            class="bold">Descripción</td>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="center"
                            class="bold">Valor Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($document->getDetails() as $item)
                        <tr>
                            <td align="center" style="padding: 4px 0px 4px 0px">
                                {{ $item->getCantidad() }}
                            </td>
                            <td align="center" style="padding: 4px 0px 4px 0px">
                                {{ $item->getUnidad() }}
                            </td>
                            <td align="left" style="padding: 4px 0px 4px 0px">
                                {{ $item->getCodProducto() }} - {{ $item->getDescripcion() }}
                            </td>
                            <td align="right" style="padding: 4px 0px 4px 0px">
                                S/ {{ number_format($item->getMtoPrecioUnitario(), 2, '.', ',') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table width="100%" border="0" style="font-size: 11px; border-collapse: collapse;">
                <tbody>
                    <tr class="border_bottom">
                        <td style="border-top: 1px solid black !important; padding: 4px 0px 1px 0px;" width="70%"
                            align="right">
                            <strong>Op. Gravadas:</strong>
                        </td>
                        <td style="border-top: 1px solid black !important; padding: 4px 0px 1px 0px;" width="30%"
                            align="right">
                            S/ {{ number_format($document->getMtoOperGravadas(), 2, '.', ',') }}
                        </td>
                    </tr>
                    <tr>
                        <td width="70%" align="right"><strong>I.G.V.:</strong></td>
                        <td width="30%" align="right">
                            S/ {{ number_format($document->getMtoIGV(), 2, '.', ',') }}
                        </td>
                    </tr>
                    <tr>
                        <td width="70%" align="right"><strong>Precio Venta:</strong></td>
                        <td width="30%" align="right">
                            S/ {{ number_format($document->getMtoImpVenta(), 2, '.', ',') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="align-items: center; ">
                <table>
                    <tr>
                        <td>
                            <table style="font-size: 11px">
                                <tr>
                                    <td>
                                        <p><strong> {{ $document->getLegends()[0]->getValue() }}</strong></p>
                                        <br />
                                        <br />
                                        <blockquote>
                                            <div>consulte en <a
                                                    href="{{ route('client_search_electronic_invoice') }}">{{ env('APP_URL') }}</a>
                                            </div>
                                            {{-- <strong>Resumen:</strong> JhLNj9jIgjYH2VRn5YG28/kdGvU=<br> --}}
                                            @if ($document->getTipoDoc() == '01')
                                                <span>Representación Impresa de la FACTURA ELECTRÓNICA.</span>
                                            @elseif($document->getTipoDoc() == '03')
                                                <span>Representación Impresa de la BOLETA DE VENTA ELECTRÓNICA.</span>
                                            @endif
                                        </blockquote>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <img src="{{ $qr_path }}" width="120" height="120" />
                        </td>
                    </tr>
                </table>
                <div class="break">
                    *************************************
                </div>
                <br /><br />
                <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
            </div>
        </div>
    </div>
</body>

</html>
