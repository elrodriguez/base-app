<?php

namespace App\Helpers\Invoice\Documents;

use Greenter\Model\Client\Client;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\Invoice;
use App\Models\SaleDocument;
use App\Helpers\Invoice\Util;
use Carbon\Carbon;
use DateTime;

use function Pest\Laravel\json;

class Boleta
{
    protected $see;
    protected $util;

    public function __construct()
    {
        $this->util = Util::getInstance();
    }

    public function create($document_id)
    {

        $document = SaleDocument::find($document_id);

        $broadcast_date = new DateTime($document->invoice_broadcast_date . ' ' . Carbon::parse($document->created_at)->format('H:m:s'));

        $client = new Client();
        $client->setTipoDoc($document->client_type_doc)
            ->setNumDoc($document->client_number)
            ->setRznSocial($document->client_rzn_social);

        $invoice = new Invoice();

        $invoice->setUblVersion($document->invoice_ubl_version)
            ->setTipoOperacion($document->invoice_type_operation)
            ->setTipoDoc($document->invoice_type_doc)
            ->setSerie($document->invoice_serie)
            ->setCorrelativo($document->invoice_correlative)
            ->setFechaEmision($broadcast_date)
            ->setTipoMoneda('PEN')
            ->setCompany($this->util->getCompany())
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
            array_push($items, $item);
        }
        $legend = new Legend();
        $legend->setCode($document->invoice_legend_code)
            ->setValue($document->invoice_legend_description);

        $invoice->setDetails($items)
            ->setLegends([$legend]);

        $see = $this->util->getSee();
        $res = $see->send($invoice);
        //fecha en la que se envio a sunat el documento
        $document->invoice_send_date = Carbon::now();

        $document->invoice_xml = $this->util->writeXml($invoice, $see->getFactory()->getLastXml());
        $document->invoice_document_name = $invoice->getName();;
        $notes = null;
        $status = null;
        if ($res->isSuccess()) {
            /**@var $res \Greenter\Model\Response\BillResult*/
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
}
