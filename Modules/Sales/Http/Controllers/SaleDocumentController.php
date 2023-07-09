<?php

namespace Modules\Sales\Http\Controllers;

use App\Helpers\NumberLetter;
use App\Models\Company;
use App\Models\Department;
use App\Models\District;
use App\Models\Kardex;
use App\Models\Parameter;
use App\Models\PaymentMethod;
use App\Models\Person;
use App\Models\PettyCash;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDocument;
use App\Models\SaleDocumentItem;
use App\Models\SaleProduct;
use App\Models\Serie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SaleDocumentController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ubl;
    private $igv;
    private $top;

    public function __construct()
    {
        $this->ubl = Parameter::where('parameter_code', 'P000003')->value('value_default');
        $this->igv = Parameter::where('parameter_code', 'P000001')->value('value_default');
        $this->top = Parameter::where('parameter_code', 'P000002')->value('value_default');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments = PaymentMethod::all();
        $company = Company::first();
        $client = Person::find(1);
        $unitTypes = DB::table('sunat_unit_types')->get();
        $documentTypes = DB::table('identity_document_type')->get();
        $saleDocumentTypes = DB::table('sale_document_types')->whereIn('sunat_id', ['01', '03'])->get();
        $ubigeo = District::join('provinces', 'province_id', 'provinces.id')
            ->join('departments', 'provinces.department_id', 'departments.id')
            ->select(
                'districts.id AS district_id',
                'districts.name AS district_name',
                'provinces.name AS province_name',
                'departments.name AS department_name'
            )
            ->get();



        return Inertia::render('Sales::Documents/Create', [
            'payments'      => $payments,
            'client'        => $client,
            'documentTypes' => $documentTypes,
            'saleDocumentTypes' => $saleDocumentTypes,
            'company'       => $company,
            'departments'   => $ubigeo,
            'unitTypes'     => $unitTypes,
            'type_operation'    => $this->top
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ///se validan los campos requeridos
        $this->validate(
            $request,
            [
                'serie' => 'required',
                'date_issue' => 'required',
                'date_end' => 'required',
                'sale_documenttype_id' => 'required',
                'total' => 'required|numeric|min:0|not_in:0',
                'payments.*.type' => 'required',
                'payments.*.amount' => 'required|numeric|min:0|not_in:0|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
                'items.*.quantity' => 'required|numeric|min:0|not_in:0|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
                'items.*.unit_price' => 'required|numeric|min:0|not_in:0|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
                'items.*.total' => 'required|numeric|min:0|not_in:0|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
                'client_id' => 'required',
            ],
            [
                'items.*.quantity.required' => 'Ingrese Cantidad',
                'items.*.unit_price.required' => 'Ingrese precio',
                'items.*.unit_price.numeric' => 'Solo Numeros',
                'items.*.quantity.numeric' => 'Solo Numeros',
                'items.*.total.required' => 'Ingrese total',
            ]
        );

        try {
            $res = DB::transaction(function () use ($request) {

                ///si no existe una caja abierta para el usuario logueado en la tienda donde inicio session
                ///se crea una caja para poder hacer la venta

                $local_id = Auth::user()->local_id;
                $petty_cash = PettyCash::firstOrCreate([
                    'user_id' => Auth::id(),
                    'state' => 1,
                    'local_sale_id' => $local_id
                ], [
                    'date_opening' => Carbon::now()->format('Y-m-d'),
                    'time_opening' => date('H:i:s'),
                    'income' => 0
                ]);
                ///se crea la venta
                $sale = Sale::create([
                    'user_id' => Auth::id(),
                    'client_id' => $request->get('client_id'),
                    'local_id' => $local_id,
                    'total' => $request->get('total'),
                    'advancement' => $request->get('total'),
                    'total_discount' => $request->get('total_discount'),
                    'payments' => json_encode($request->get('payments')),
                    'petty_cash_id' => $petty_cash->id
                ]);

                ///obtenemos la serie elejida para hacer la venta
                ///para traer tambien su numero correlativo

                $serie = Serie::find($request->get('serie'));

                ///se convierte el total de la venta a letras
                $numberletters = new NumberLetter();

                ///creamos el documento de la venta para enviar a sunat
                $document = SaleDocument::create([
                    'sale_id'                       => $sale->id,
                    'serie_id'                      => $request->get('serie'),
                    'number'                        => str_pad($serie->number, 9, '0', STR_PAD_LEFT),
                    'status'                        => true,
                    'client_type_doc'               => $request->get('client_dti'),
                    'client_number'                 => $request->get('client_number'),
                    'client_rzn_social'             => $request->get('client_name'),
                    'client_address'                => $request->get('client_direction'),
                    'client_ubigeo_code'            => $request->get('client_ubigeo'),
                    'client_ubigeo_description'     => $request->get('client_ubigeo_description'),
                    'client_phone'                  => $request->get('client_phone'),
                    'client_email'                  => $request->get('client_email'),
                    'invoice_ubl_version'           => $this->ubl,
                    'invoice_type_operation'        => $request->get('type_operation'),
                    'invoice_type_doc'              => $request->get('sale_documenttype_id'),
                    'invoice_serie'                 => $serie->description,
                    'invoice_correlative'           => $serie->number,
                    'invoice_type_currency'         => 'PEN',
                    'invoice_broadcast_date'        => $request->get('date_issue'),
                    'invoice_due_date'              => $request->get('date_end'),
                    'invoice_send_date'             => Carbon::now()->format('Y-m-d'),
                    'invoice_legend_code'           => '1000',
                    'invoice_legend_description'    => $numberletters->convertToLetter($request->get('total')),
                    'invoice_status'                => 'registrado'
                ]);

                ///obtenemos los productos o servicios para insertar en los 
                ///detalles de la venta y el documento
                $products = $request->get('items');

                ///totales de la cabecera
                $mto_oper_taxed = 0;
                $mto_igv = 0;
                $icbper = 0;

                foreach ($products as $produc) {
                    /// ahora tenemos que saber si es un producto o servicio ya existente
                    /// o si sera creado para esta venta, verificaremos esto por el id del producto
                    /// si el id es nulo quiere decir que es un producto nuevo y procedemos a crearlo
                    $product_id = null;
                    if ($produc['id']) {
                        SaleProduct::create([
                            'sale_id' => $sale->id,
                            'product_id' => $produc['id'],
                            'product' => json_encode($produc),
                            'price' => $produc['unit_price'],
                            'discount' => $produc['discount'],
                            'quantity' => $produc['quantity'],
                            'total' => $produc['total']
                        ]);
                        $product_id = $produc['id'];
                    } else {
                        $length = 9; // Longitud del número aleatorio
                        $randomNumber = random_int(0, 999999999); // Genera un número aleatorio entre 0 y 999999999

                        $randomNumberPadded = str_pad($randomNumber, $length, '0', STR_PAD_LEFT);

                        $path = 'img/imagen-no-disponible.jpeg';

                        // creamos el nuevo producto o servicio
                        $new_product = Product::create([
                            'usine'                         => $randomNumberPadded,
                            'interne'                       => $randomNumberPadded,
                            'description'                   => $produc['description'],
                            'image'                         => $path,
                            'purchase_prices'               => 0,
                            'sale_prices'                   => json_encode(array('high' => $produc['unit_price'], 'under' => null, 'medium' => null)),
                            'stock_min'                     => 1,
                            'stock'                         => $produc['quantity'],
                            'presentations'                 => false,
                            'is_product'                    => $produc['is_product'],
                            'type_sale_affectation_id'      => '10',
                            'type_purchase_affectation_id'  => '10',
                            'type_unit_measure_id'          => $produc['unit_type'],
                            'status'                        => true
                        ]);
                        $product_id = $new_product->id;
                        // le creamos un kardex en caso de ser un producto
                        if ($produc['is_product']) {
                            Kardex::create([
                                'date_of_issue'     => Carbon::now()->format('Y-m-d'),
                                'motion'            => 'purchase',
                                'product_id'        => $new_product->id,
                                'local_id'          => Auth::user()->local_id,
                                'quantity'          => $produc['quantity'],
                                'description'       => 'Stock Inicial',
                            ]);
                        }
                        /// insertamos en el detalle de la venta
                        SaleProduct::create([
                            'sale_id' => $sale->id,
                            'product_id' => $new_product->id,
                            'product' => json_encode(array("id" => $new_product->id, "size" => null, "price" => $produc['unit_price'], "total" => $produc['unit_price'], "interne" => $randomNumber, "quantity" => $produc['quantity'], "description" => $produc['description'])),
                            'price' => $produc['unit_price'],
                            'discount' => $produc['discount'],
                            'quantity' => $produc['quantity'],
                            'total' => $produc['total']
                        ]);
                        $item = $new_product;
                    }

                    /// imiciamos las variables para hacer los calculos por item;
                    $igvp = $produc['unit_price'] * ($this->igv / 100);
                    $value_unit = $produc['unit_price'] - $igvp;
                    $mto_base_igv = $value_unit * $produc['quantity'];
                    $igv = $igvp * $produc['quantity'];
                    $total_tax = $igv;

                    //se inserta los datos al detalle del documento 
                    SaleDocumentItem::create([
                        'document_id'           => $document->id,
                        'cod_product'           => $product_id,
                        'decription_product'    => $produc['description'],
                        'unit_type'             => $produc['unit_type'],
                        'quantity'              => $produc['quantity'],
                        'mto_base_igv'          => $mto_base_igv,
                        'percentage_igv'        => $this->igv,
                        'igv'                   => $igv,
                        'total_tax'             => $total_tax,
                        'type_afe_igv'          => $produc['afe_igv'],
                        'icbper'                => null,
                        'factor_icbper'         => null,
                        'mto_value_sale'        => $mto_base_igv,
                        'mto_value_unit'        => $value_unit,
                        'mto_price_unit'        => $produc['unit_price'],
                        'mto_total'             => $produc['total']
                    ]);

                    $mto_oper_taxed = $mto_oper_taxed = $mto_base_igv;
                    $mto_igv = $mto_igv + $igv;
                }
                $total_taxes = $mto_igv + $icbper;
                $subtotal = $total_taxes + $mto_oper_taxed;
                $ttotal = $request->get('total');
                $difference = abs($ttotal - $subtotal);
                $rounding = number_format($difference, 2);

                $document->update([
                    'invoice_mto_oper_taxed'    => $mto_oper_taxed,
                    'invoice_mto_igv'           => $mto_igv,
                    'invoice_icbper'            => $icbper,
                    'invoice_total_taxes'       => $total_taxes,
                    'invoice_value_sale'        => $mto_oper_taxed,
                    'invoice_subtotal'          => $subtotal,
                    'invoice_rounding'          => $rounding,
                    'invoice_mto_imp_sale'      => $ttotal,
                    'invoice_sunat_points'      => null,
                ]);
            });

            return response()->json($res);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleDocument  $saleDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDocument $saleDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleDocument  $saleDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleDocument $saleDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleDocument  $saleDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleDocument $saleDocument)
    {
        //
    }

    public function getSerieByDocumentType($id)
    {
        $local_id = Auth::user()->local_id;
        $status = false;
        $series = Serie::where('document_type_id', $id)
            ->where('local_id', $local_id)
            ->get();

        if (count($series) > 0) {
            $status = true;
        } else {
            $status = false;
        }
        return response()->json([
            'status' => $status,
            'series' => $series
        ]);
    }
}
