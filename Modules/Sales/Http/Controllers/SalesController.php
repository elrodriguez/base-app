<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDocument;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sales::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function parameters()
    {
        return view('sales::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function totalBalanceTables(Request $request)
    {
        // Validar el parámetro de búsqueda
        $request->validate([
            'period' => 'required|in:day,week,month',
        ]);

        $period = $request->input('period');
        $now = Carbon::now();

        // Inicializar la consulta base
        $query = Sale::selectRaw('SUM(total) as total_sales');

        // Determinar el agrupamiento según el período
        switch ($period) {
            case 'day':
                $query->whereDate('created_at', $now->format('Y-m-d'));
                $previousDay = $now->subDay()->format('Y-m-d');
                $previousTotal = Sale::whereDate('created_at', $previousDay)->sum('total');
                break;

            case 'week':
                $startOfWeek = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
                $endOfWeek = $now->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $previousWeekStart = $now->subWeek()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
                $previousWeekEnd = $previousWeekStart . '+6 days';
                $previousTotal = Sale::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])->sum('total');
                break;

            case 'month':
                $startOfMonth = $now->startOfMonth()->format('Y-m-d');
                $endOfMonth = $now->endOfMonth()->format('Y-m-d');
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                $previousMonthStart = $now->subMonth()->startOfMonth()->format('Y-m-d');
                $previousMonthEnd = $now->subMonth()->endOfMonth()->format('Y-m-d');
                $previousTotal = Sale::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->sum('total');
                break;
        }

        // Obtener el total de ventas
        $totalSales = $query->first()->total_sales ?? 0;

        // Calcular la diferencia con el período anterior
        $difference = $totalSales - $previousTotal;
        //dd($totalSales);
        // Devolver la respuesta en formato JSON
        return response()->json([
            'total_sales' => $totalSales,
            'difference' => $difference,
            'period' => $period,
        ]);
    }

    public function minimumStock()
    {
        $products = Product::where('stock', '<=', DB::raw('stock_min'))
            ->where('is_product', true)
            ->limit(100)
            ->get();

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function clientSearchDocument(Request $request)
    {
        $document = SaleDocument::select(
            'id',
            'client_number',
            'client_rzn_social',
            'invoice_serie',
            'invoice_correlative',
            'number',
            'invoice_mto_imp_sale',
            'invoice_type_doc'
        )
            ->where('invoice_type_doc', $request->get('type'))
            ->where('invoice_serie', $request->get('serie'))
            ->where('invoice_correlative', $request->get('number'))
            ->where('client_number', $request->get('client'))
            ->where('invoice_mto_imp_sale', $request->get('amount'))
            ->where('invoice_broadcast_date', $request->get('date'))
            ->get();

        return response()->json([
            'document' => $document
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function findInvoice()
    {
        $saleDocumentTypes = DB::table('sale_document_types')->whereIn('sunat_id', ['01', '03'])->get();
        return Inertia::render('Sales::Finder/Invoices', [
            'saleDocumentTypes' => $saleDocumentTypes
        ]);
    }
}
