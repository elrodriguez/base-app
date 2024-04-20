<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Person;
use App\Models\PettyCash;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Modules\Restaurant\Entities\ResCategory;
use Modules\Restaurant\Entities\ResComanda;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Modules\Restaurant\Entities\ResSale;
use Modules\Restaurant\Entities\ResSaleDetail;

class ResSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(request()->all());
        $sales = (new ResSale())->newQuery();
        $sales = $sales->join('people', 'person_id', 'people.id')
            ->select(
                'res_sales.id',
                'res_sales.sale_date',
                'res_sales.sale_hour',
                'res_sales.correlative',
                'res_sales.petty_cash_id',
                'res_sales.user_id',
                'res_sales.person_id',
                'res_sales.local_id',
                'res_sales.total',
                'res_sales.total_discount',
                'res_sales.payments',
                'res_sales.queue_status',
                'people.full_name'
            );

        if (request()->has('search')) {
            $sales->where('people.full_name', 'like', '%' . request()->input('search') . '%');
        }

        if (request()->has('date_start') && request()->has('date_end')) {
            $sales->whereBetween('sale_date', [request()->input('date_start'), request()->input('date_end')]);
        }

        if (request()->has('queue_status')) {
            $queue_status = request()->input('queue_status');
            $sales->when($queue_status != '00', function ($query)  use ($queue_status) {
                $query->where('res_sales.queue_status', '=', $queue_status);
            });
        }


        $sales = $sales->paginate(10);

        return Inertia::render('Restaurant::Sales/List', [
            'sales' => $sales,
            'filters' => request()->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Person::where('is_client', true)->get();
        $comandas = ResCategory::with('subcategories.comandas.presentation')
            ->with('comandas.presentation')
            ->whereNull('category_id')
            ->get();
        $paymentMethods = PaymentMethod::all();

        return Inertia::render('Restaurant::Sales/Create', [
            'clients'   => $clients,
            'comandas'  => $comandas,
            'paymentMethods' => $paymentMethods
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $success = false;
        $message = null;

        $client_id = $request->get('client_id');
        $total = $request->get('total');
        $comandas = $request->get('comandas');
        $payments = $request->get('payments');

        $tt = 0;

        foreach ($payments  as  $payment) {
            $tt = $tt + $payment['amount'];
        }

        if ($total <> $tt) {
            $success = false;
            $message = 'El total de venta no coincide con el total de los pagos';
        } else {

            $petty_cash = PettyCash::firstOrCreate([
                'user_id' => Auth::id(),
                'state' => 1,
                'local_sale_id' => Auth::user()->local_id
            ], [
                'date_opening' => Carbon::now()->format('Y-m-d'),
                'time_opening' => date('H:i:s'),
                'income' => 0
            ]);

            $sale = ResSale::create([
                'sale_date' => Carbon::now()->format('Y-m-d'),
                'sale_hour' => Carbon::now()->format('H:i:s'),
                'user_id'   => Auth::id(),
                'petty_cash_id' => $petty_cash->id,
                'person_id' => $client_id,
                'local_id'  => Auth::user()->local_id,
                'total'     => $total,
                'payments'  => json_encode($payments),
                'queue_status' => '01'
            ]);

            foreach ($comandas  as  $comanda) {
                ResSaleDetail::create([
                    'sale_id'       => $sale->id,
                    'comanda_id'    => $comanda['id'],
                    'quantity'      => $comanda['quantity'],
                    'price'         => $comanda['price']
                ]);
            }
            $success = true;
            $message = 'Cobro registrada  con éxito';
        }



        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function edit($id)
    {
        $clients = Person::where('is_client', true)->get();
        $comandas = ResCategory::with('subcategories.comandas.presentation')
            ->with('comandas.presentation')
            ->whereNull('category_id')
            ->get();
        $paymentMethods = PaymentMethod::all();

        $sale = ResSale::with('details.comanda.presentation')->where('id', $id)->first();

        return Inertia::render('Restaurant::Sales/Edit', [
            'clients'   => $clients,
            'comandas'  => $comandas,
            'paymentMethods' => $paymentMethods,
            'sale' => $sale
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $success = false;
        $message = null;

        $client_id = $request->get('client_id');
        $total = $request->get('total');
        $comandas = $request->get('comandas');
        $payments = $request->get('payments');
        $queue_status = $request->get('queue_status');

        $tt = 0;

        foreach ($payments  as  $payment) {
            $tt = $tt + $payment['amount'];
        }

        if ($total <> $tt) {
            $success = false;
            $message = 'El total de venta no coincide con el total de los pagos';
        } else {
            $sale = ResSale::find($id);

            $sale->update([
                // 'sale_date' => Carbon::now()->format('Y-m-d'),
                // 'sale_hour' => Carbon::now()->format('H:i:s'),
                'user_id'   => Auth::id(),
                'person_id' => $client_id,
                'total'     => $total,
                'payments'  => json_encode($payments),
                'queue_status' => $queue_status
            ]);

            ResSaleDetail::where('sale_id', $id)->delete();

            foreach ($comandas  as  $comanda) {
                ResSaleDetail::create([
                    'sale_id'       => $sale->id,
                    'comanda_id'    => $comanda['id'],
                    'quantity'      => $comanda['quantity'],
                    'price'         => $comanda['price']
                ]);
            }
            $success = true;
            $message = 'Actualizado con éxito';
        }



        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ResSale::find($id)->update(['queue_status' => '99']);

        return response()->json([
            'success' => true,
            'message' => 'Venta anulada'
        ]);
    }

    public function cuisine()
    {
        $comandas = ResSale::with('details.comanda')
            ->where('queue_status', '01')
            ->get();
        //dd($comandas);
        return Inertia::render('Restaurant::Sales/Cuisine', [
            'comandas' => $comandas
        ]);
    }

    public function getSale($id)
    {
        $sale = ResSale::with('details.comanda')
            ->where('id', $id)
            ->first();

        return response()->json(['sale' => $sale]);
    }

    public function createBoleta($id)
    {

        $sale = ResSale::with('details')->where('id', $id)->first();
        $payments = PaymentMethod::all();
        $company = Company::first();

        $client = Person::find($sale->client_id);
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

        $company->load('district.province.department');

        // Obtener el nombre de la ciudad usando los datos relacionados
        $city = $company->district->province->department->name . "-" . $company->district->province->name . "-" . $company->district->name;
        $company->city = $city;
        if ($client->ubigeo) {
            $clientCity = $client->district->province->department->name . "-" . $client->district->province->name . "-" . $client->district->name;
            $client->city = $clientCity;
        } else {
            $client->city = $city;
        }



        return Inertia::render('Restaurant::Documents/CreateBoleta', [
            'sale' => $sale
        ]);
    }
}
