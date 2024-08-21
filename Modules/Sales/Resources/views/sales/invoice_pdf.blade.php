<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        .bold,
        b,
        strong {
            font-weight: 700
        }

        body {
            background-repeat: no-repeat;
            background-position: center center;
            text-align: center;
            margin: 0;
            font-family: Verdana, monospace
        }

        .tabla_borde {
            border: 1px solid #000;
            border-radius: 10px
        }

        tr.border_bottom td {
            border-bottom: 1px solid #000
        }

        tr.border_top td {
            border-top: 1px solid #000
        }

        td.border_right {
            border-right: 1px solid #000
        }

        .table-valores-totales tbody>tr>td {
            border: 0
        }

        .table-valores-totales>tbody>tr>td:first-child {
            text-align: right
        }

        .table-valores-totales>tbody>tr>td:last-child {
            border-bottom: 1px solid #000;
            text-align: right;
            width: 30%
        }

        hr,
        img {
            border: 0
        }

        table td {
            font-size: 12px
        }

        html {
            font-family: sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-size: 10px;
            -webkit-tap-highlight-color: transparent
        }

        a {
            background-color: transparent
        }

        a:active,
        a:hover {
            outline: 0
        }

        img {
            vertical-align: middle
        }

        hr {
            height: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 1px solid #eee
        }

        table {
            border-spacing: 0;
            border-collapse: collapse
        }

        @media print {

            blockquote,
            img,
            tr {
                page-break-inside: avoid
            }

            *,
            :after,
            :before {
                color: #000 !important;
                text-shadow: none !important;
                background: 0 0 !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important
            }

            a,
            a:visited {
                text-decoration: underline
            }

            a[href]:after {
                content: " (" attr(href) ")"
            }

            blockquote {
                border: 1px solid #999
            }

            img {
                max-width: 100% !important
            }

            p {
                orphans: 3;
                widows: 3
            }

            .table {
                border-collapse: collapse !important
            }

            .table td {
                background-color: #fff !important
            }
        }

        a,
        a:focus,
        a:hover {
            text-decoration: none
        }

        *,
        :after,
        :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        a {
            color: #428bca;
            cursor: pointer
        }

        a:focus,
        a:hover {
            color: #2a6496
        }

        a:focus {
            outline: dotted thin;
            outline: -webkit-focus-ring-color auto 5px;
            outline-offset: -2px
        }

        h6 {
            font-family: inherit;
            line-height: 1.1;
            color: inherit;
            margin-top: 10px;
            margin-bottom: 10px
        }

        p {
            margin: 0 0 10px
        }

        blockquote {
            padding: 10px 20px;
            margin: 0 0 20px;
            border-left: 5px solid #eee
        }

        table {
            background-color: transparent
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px
        }

        h6 {
            font-weight: 100;
            font-size: 10px
        }

        body {
            line-height: 1.42857143;
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #2f4050;
            font-size: 13px;
            color: #676a6c;
            overflow-x: hidden
        }

        .table>tbody>tr>td {
            vertical-align: top;
            border-top: 1px solid #e7eaec;
            line-height: 1.42857;
            padding: 8px
        }

        .white-bg {
            background-color: #fff
        }

        td {
            padding: 6
        }

        .table-valores-totales tbody>tr>td {
            border-top: 0 none !important
        }
    </style>
</head>
@php
    $company = \App\Models\Company::first();
    $logo = public_path('storage' . DIRECTORY_SEPARATOR . $company->logo_document);
@endphp

<body class="white-bg">
    <table width="100%">
        <tbody>
            <tr>
                <td style="padding:30px; !important">
                    <table width="100%" height="200px" border="0" aling="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="50%" height="90" align="left">
                                    <img src="{{ $logo }}" width="270px" border="0" />
                                </td>
                                <td width="5%" height="40" align="center"></td>
                                <td width="45%" rowspan="2" valign="bottom" style="padding-left:0">
                                    <div class="tabla_borde">

                                        <table width="100%" border="0" height="200" cellpadding="6"
                                            cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    @if ($document->getTipoDoc() == '01')
                                                        <td align="center">
                                                            <span
                                                                style="font-family:Tahoma, Geneva, sans-serif; font-size:29px"
                                                                text-align="center">
                                                                FACTURA
                                                            </span>
                                                            <br>
                                                            <span
                                                                style="font-family:Tahoma, Geneva, sans-serif; font-size:19px"
                                                                text-align="center">
                                                                E L E C T R Ó N I C A
                                                            </span>
                                                        </td>
                                                    @elseif($document->getTipoDoc() == '03')
                                                        <td align="center">
                                                            <span
                                                                style="font-family:Tahoma, Geneva, sans-serif; font-size:29px"
                                                                text-align="center">
                                                                BOLETA DE VENTA
                                                            </span>
                                                            <br>
                                                            <span
                                                                style="font-family:Tahoma, Geneva, sans-serif; font-size:19px"
                                                                text-align="center">
                                                                E L E C T R Ó N I C A
                                                            </span>
                                                        </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <span style="font-size:15px" text-align="center">R.U.C.:
                                                            {{ $document->getCompany()->getRuc() }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <span style="font-size:24px">
                                                            {{ $document->getSerie() }}-{{ $document->getCorrelativo() }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom" style="padding-left:0">
                                    <div class="tabla_borde">
                                        <table width="96%" height="100%" border="0" border-radius=""
                                            cellpadding="9" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <strong>
                                                            <span style="font-size:15px">
                                                                {{ $document->getCompany()->getRazonSocial() }}
                                                            </span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <strong>Dirección: </strong>
                                                        {{ $document->getCompany()->getAddress()->getDireccion() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <strong>Teléfono: </strong>
                                                        {{ $params['user']['header'] }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="tabla_borde">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="60%" align="left"><strong>Razón Social:</strong>
                                        {{ $document->getClient()->getRznSocial() }}
                                    </td>
                                    <td width="40%" align="left">
                                        @if ($document->getTipoDoc() == '01')
                                            <strong>RUC:</strong>
                                        @elseif($document->getTipoDoc() == '03')
                                            <strong>N/D:</strong>
                                        @endif
                                        {{ $document->getClient()->getNumDoc() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="60%" align="left">
                                        <strong>Fecha Emisión: </strong>
                                        {{ $document->getFechaEmision()->format('Y-m-d H:i:s') }}
                                    </td>
                                    <td width="40%" align="left">
                                        <strong>Dirección: </strong>
                                        {{ $document->getClient()->getAddress() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="60%" align="left"><strong>Tipo Moneda: </strong> SOLES </td>
                                    <td width="40%" align="left"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br>
                    <div class="tabla_borde">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="center" class="bold">Cant.</td>
                                    <td align="center" class="bold">Unidad</td>
                                    <td align="center" class="bold">Código</td>
                                    <td align="left" class="bold">Descripción</td>
                                    {{-- <td align="center" class="bold">Valor Unitario</td> --}}
                                    <td align="center" class="bold">Valor Total</td>
                                </tr>
                                @foreach ($document->getDetails() as $item)
                                    <tr class="border_top">
                                        <td align="right">
                                            {{ $item->getCantidad() }}
                                        </td>
                                        <td align="center">
                                            {{ $item->getUnidad() }}
                                        </td>
                                        <td align="center">
                                            {{ $item->getCodProducto() }}
                                        </td>
                                        <td align="left" width="300px">
                                            <span>{{ $item->getDescripcion() }}</span>
                                        </td>
                                        {{-- <td align="right">
                                            S/ {{ $item->getMtoValorUnitario() }}
                                        </td> --}}
                                        {{-- <td align="right">
                                            S/ {{ $item->getMtoValorVenta() }}
                                        </td> --}}
                                        <td align="right">
                                            S/ {{ number_format($item->getMtoPrecioUnitario(), 2, '.', ',') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="50%" valign="top">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <br>
                                                    <br>
                                                    <span
                                                        style="font-family:Tahoma, Geneva, sans-serif; font-size:12px"
                                                        text-align="center">
                                                        <strong>
                                                            {{ $document->getLegends()[0]->getValue() }}
                                                        </strong>
                                                    </span>
                                                    <br>
                                                    <br>
                                                    <strong>Información Adicional</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                        <tbody>
                                            <tr class="border_top">
                                                <td width="50%" style="font-size: 10px;">
                                                    LEYENDA:
                                                </td>
                                                <td width="50%" style="font-size: 10px;">
                                                    <p>
                                                    </p>
                                                </td>
                                            </tr>
                                            @foreach ($params['user']['extras'] as $extra)
                                                <tr class="border_top">
                                                    <td width="50%" style="font-size: 10px;">
                                                        {{ $extra['name'] }}:
                                                    </td>
                                                    <td width="50%" style="font-size: 10px;">
                                                        {{ $extra['value'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td width="50%" valign="top">
                                    <br>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                        class="table table-valores-totales">
                                        <tbody>
                                            <tr class="border_bottom">
                                                <td align="right"><strong>Op. Gravadas:</strong></td>
                                                <td width="120" align="right">
                                                    S/
                                                    {{ number_format($document->getMtoOperGravadas(), 2, '.', ',') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right"><strong>I.G.V.:</strong></td>
                                                <td width="120" align="right">
                                                    S/ {{ number_format($document->getMtoIGV(), 2, '.', ',') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right"><strong>Precio Venta:</strong></td>
                                                <td width="120" align="right">
                                                    S/ {{ number_format($document->getMtoImpVenta(), 2, '.', ',') }}

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div>
                        <hr
                            style="display: block; height: 1px; border: 0; border-top: 1px solid #666; margin: 20px 0; padding: 0;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="85%">
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
                                    <td width="15%" align="right">
                                        <img src="{{ $qr_path }}" width="120" height="120" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
