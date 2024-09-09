<?php

namespace App\Helpers\Invoice\Documents;

use Greenter\Model\Client\Client;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\Invoice;
use App\Models\SaleDocument;
use App\Helpers\Invoice\Util;
use Greenter\Model\Company\Company;
use Carbon\Carbon;
use DateTime;
use App\Models\Company as MyCompany;
use App\Models\User;
use Exception;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Charge;
use App\Helpers\Invoice\QrCodeGenerator;
use App\Models\Kardex;
use App\Models\KardexSize;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDocumentItem;
use App\Models\SaleProduct;
use Illuminate\Support\Facades\DB;

class Boleta
{
    protected $see;
    protected $util;
    protected $mycompany;


    public function __construct()
    {
        $this->util = Util::getInstance();
        $this->mycompany = MyCompany::first();
    }

    public function create($document_id)
    {

        $document = SaleDocument::find($document_id);

        $invoice = $this->setDocument($document);

        $see = $this->util->getSee();
        $res = $see->send($invoice);
        //fecha en la que se envio a sunat el documento
        $document->invoice_send_date = Carbon::now();

        $document->invoice_xml = $this->util->writeXml($invoice, $see->getFactory()->getLastXml());
        $document->invoice_document_name = $invoice->getName();

        $notes = null;
        $status = null;
        if ($res->isSuccess()) {
            $cdr = $res->getCdrResponse();
            $codeError = $cdr->getCode();
            $messageError = $cdr->getDescription();
            $notes = json_encode($cdr->getNotes(), JSON_UNESCAPED_UNICODE);
            $status = $cdr->getCode() == 0 ? 'Aceptada' : null;
            $document->invoice_cdr = $this->util->writeCdr($invoice, $res->getCdrZip());
        } else {
            $error = $res->getError();
            $codeError = $error->getCode();
            $messageError = $error->getMessage();
            $status = 'Rechazada';
            //return array('success' => $res->isSuccess(), 'details' => $this->util->getErrorResponse($res->getError()));

        }
        $document->invoice_response_code = $codeError;
        $document->invoice_response_description = $messageError;
        $document->invoice_notes = $notes;
        $document->invoice_status = $status;

        $document->save();

        return array('success' => $res->isSuccess(), 'code' => $codeError, 'message' => $messageError, 'notes' => $notes);
    }

    public function setDocument($document)
    {
        $broadcast_date = new DateTime($document->invoice_broadcast_date . ' ' . Carbon::parse($document->created_at)->format('H:m:s'));

        $client = new Client();
        $client->setTipoDoc($document->client_type_doc)
            ->setNumDoc($document->client_number)
            ->setRznSocial($document->client_rzn_social);

        $company = new Company();

        $province = $this->mycompany->district->province;
        $department = $province->department;

        $company->setRuc($this->mycompany->ruc)
            ->setRazonSocial($this->mycompany->business_name)
            ->setNombreComercial($this->mycompany->tradename)
            ->setAddress((new Address())
                ->setUbigueo($this->mycompany->ubigeo)
                ->setDepartamento($department->name)
                ->setProvincia($province->name)
                ->setDistrito($this->mycompany->district->name)
                ->setUrbanizacion('-')
                ->setDireccion($this->mycompany->fiscal_address));

        $invoice = new Invoice();

        $invoice->setUblVersion($document->invoice_ubl_version)
            ->setTipoOperacion($document->invoice_type_operation)
            ->setTipoDoc($document->invoice_type_doc)
            ->setSerie($document->invoice_serie)
            ->setCorrelativo($document->invoice_correlative)
            ->setFechaEmision($broadcast_date)
            ->setTipoMoneda('PEN')
            ->setCompany($company)
            ->setClient($client)
            ->setMtoOperGravadas($document->invoice_mto_oper_taxed)
            ->setMtoIGV($document->invoice_mto_igv)
            ->setTotalImpuestos($document->invoice_total_taxes)
            ->setValorVenta($document->invoice_value_sale)
            ->setSubTotal($document->invoice_subtotal)
            ->setMtoImpVenta($document->invoice_mto_imp_sale);

        $details = $document->items;
        $items = [];
        foreach ($details as $detail) {
            $item = new SaleDetail();
            $item->setCodProducto($detail->cod_product)
                ->setUnidad($detail->unit_type)
                ->setCantidad($detail->quantity)
                ->setDescripcion($detail->decription_product)
                ->setMtoBaseIgv($detail->mto_base_igv)
                ->setPorcentajeIgv($detail->percentage_igv)
                ->setIgv($detail->igv)
                ->setTipAfeIgv($detail->type_afe_igv)
                ->setTotalImpuestos($detail->total_tax)
                ->setMtoValorVenta($detail->mto_value_sale)
                ->setMtoValorUnitario($detail->mto_value_unit)
                ->setMtoPrecioUnitario($detail->mto_price_unit);

            $descuent = $detail->mto_discount;

            if ($descuent > 0) {
                $json_discounts = json_decode($detail->json_discounts);

                $charges = [];

                foreach ($json_discounts as $k => $json_discount) {
                    $charges[$k] = (new Charge())
                        ->setCodTipo($json_discount->type)
                        ->setMontoBase($json_discount->base)
                        ->setFactor($json_discount->factor)
                        ->setMonto($json_discount->monto);
                }

                $item->setDescuentos($charges);
            }

            array_push($items, $item);
        }
        $legend = new Legend();
        $legend->setCode($document->invoice_legend_code)
            ->setValue($document->invoice_legend_description);

        $invoice->setDetails($items)
            ->setLegends([$legend]);

        return $invoice;
    }

    public function getBoletatDomPdf($id, $format = 'A4')
    {
        try {
            $document = SaleDocument::find($id);
            $invoice = $this->setDocument($document);

            $generator = new QrCodeGenerator(300);
            $dir = public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'tmp_qr';
            $cadenaqr = $this->stringQr($document);

            $qr_path = $generator->generateQR($cadenaqr, $dir, $invoice->getName() . '.png', 8, 2);


            $seller = User::find($document->user_id);
            $pdf = $this->util->generatePdf($invoice, $seller, $qr_path, $format);
            $document->invoice_pdf = $pdf;
            $document->save();

            return array(
                'fileName' => $invoice->getName() . '.pdf',
                'filePath' => $document->invoice_pdf
            );
        } catch (Exception $e) {
            var_dump($e);
        }
    }


    public function getBoletatPdf($id)
    {
        try {
            $document = SaleDocument::find($id);

            $invoice = $this->setDocument($document);
            $seller = User::find($document->user_id);
            $pdf = $this->util->getPdf($invoice, $seller);
            $filePath = $this->util->showPdf($pdf, $invoice->getName() . '.pdf');
            $document->invoice_pdf = $filePath;
            $document->save();

            return array(
                'fileName' => $invoice->getName() . '.pdf',
                'filePath' => $filePath
            );
        } catch (Exception $e) {
            var_dump($e);
        }
    }
    public function getBoletaXML($id)
    {
        try {
            $document = SaleDocument::find($id);

            return array(
                'fileName' => $document->invoice_document_name . '.xml',
                'filePath' => $document->invoice_xml
            );
        } catch (Exception $e) {
            var_dump($e);
        }
    }
    public function getBoletaCDR($id)
    {
        try {
            $document = SaleDocument::find($id);

            return array(
                'fileName' => $document->invoice_document_name . '.zip',
                'filePath' => $document->invoice_cdr
            );
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    public function stringQr($document)
    {
        return $this->mycompany->ruc . '|' . $document->invoice_type_doc . '|' . $document->invoice_serie . '|' . $document->invoice_correlative . '|' . $document->invoice_mto_imp_sale . '|' . $document->invoice_broadcast_date . '|' . $document->client_type_doc . '|' . $document->client_number;
    }

    public function updateStockSale($id)
    {
        try {
            $res = DB::transaction(function () use ($id) {
                $document = SaleDocument::find($id);

                $sale = Sale::find($document->sale_id);
                $sale->update(['status' => false]);

                $products = SaleProduct::where('sale_id', $sale->id)->get();

                foreach ($products as $item) {
                    // solo si son productos no aplica a los servicios
                    if (json_decode($item->saleProduct)->unit_type != 'ZZ') {

                        $k = Kardex::create([
                            'date_of_issue' => Carbon::now()->format('Y-m-d'),
                            'motion' => 'sale',
                            'product_id' => $item->product_id,
                            'local_id' => $sale->local_id,
                            'quantity' => $item->quantity,
                            'document_id' => $document->id,
                            'document_entity' => SaleDocument::class,
                            'description' => 'Anulacion de Venta'
                        ]);

                        $product = Product::find($item->product_id);

                        if ($product->presentations) {

                            KardexSize::create([
                                'kardex_id' => $k->id,
                                'product_id' => $item->product_id,
                                'local_id' => $sale->local_id,
                                //'size'      => json_decode($produc->product)->size,
                                'size'      => json_decode($item->saleProduct)->size,
                                'quantity'  => $item->quantity
                            ]);

                            $tallas = json_decode($product->sizes, true);

                            $n_tallas = [];
                            foreach ($tallas as &$size) {
                                // Si el tamaño es igual a 22
                                if ($size["size"] == json_decode($item->saleProduct)->size) {

                                    // Obtiene la cantidad actual
                                    $currentQuantity = intval($size["quantity"]); // Convierte a entero

                                    // Suma 1 a la cantidad actual
                                    $newQuantity = $currentQuantity + $item->quantity;

                                    // Actualiza la cantidad
                                    $size["quantity"] = $newQuantity;
                                }
                            }

                            $n_tallas = $tallas;

                            $product->update([
                                'sizes' => json_encode($n_tallas)
                            ]);
                        }
                        Product::find($item->product_id)->increment('stock', $item->quantity);
                    }
                }
                return $sale;
            });

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
