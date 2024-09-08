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
use Modules\Sales\Entities\SalePhysicalDocument;

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

    public function getSummaryTotals(Request $request)
    {
        // Validar el parámetro de búsqueda
        $request->validate([
            'period' => 'required|in:day,week,month',
        ]);

        $period = $request->input('period');
        $now = Carbon::now();

        // Inicializar la consulta
        $query = SaleDocument::select('invoice_type_doc', DB::raw('SUM(overall_total) as total'))
            ->whereNotNull('invoice_type_doc')
            ->where('status', 1)
            ->groupBy('invoice_type_doc');

        $queryNote = SaleDocument::select('invoice_type_doc', DB::raw('SUM(overall_total) as total'))
            ->whereNull('invoice_type_doc')
            ->where('status', 1)
            ->groupBy('invoice_type_doc');

        $queryPhysical = SalePhysicalDocument::select('document_type', DB::raw('SUM(total) as total'))
            ->where('status', '<>', 'A')
            ->groupBy('document_type');


        // Filtrar según el período
        switch ($period) {
            case 'day':
                $query->whereDate('created_at', $now->format('Y-m-d'));
                $queryNote->whereDate('created_at', $now->format('Y-m-d'));
                $queryPhysical->whereDate('created_at', $now->format('Y-m-d'));
                break;

            case 'week':
                $startOfWeek = $now->startOfWeek()->format('Y-m-d');
                $endOfWeek = $now->endOfWeek()->format('Y-m-d');
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $queryNote->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $queryPhysical->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                break;

            case 'month':
                $startOfMonth = $now->startOfMonth()->format('Y-m-d');
                $endOfMonth = $now->endOfMonth()->format('Y-m-d');
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                $queryNote->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                $queryPhysical->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                break;
        }

        // Obtener los totales
        $documents = $query->get();
        $salesNote = $queryNote->get();
        $physicals = $queryPhysical->get();

        $total = 0;

        foreach ($documents as $doc) {
            $total = $total + $doc->total;
        }
        foreach ($salesNote as $not) {
            $total = $total + $not->total;
        }

        $newPhysicals = 0;
        foreach ($physicals as $physical) {
            $total = $total + $physical->total;
            $newPhysicals = $newPhysicals + $physical->total;
        }


        // Devolver la respuesta en formato JSON
        return response()->json([
            'documents' => $documents,
            'notes_sale' => $salesNote,
            'physical' => $newPhysicals,
            'total' => $total
        ]);
    }

    public function totalBalanceTables(Request $request)
    {
        // Validar el parámetro de búsqueda
        $request->validate([
            'period' => 'required|in:day,week,month',
        ]);

        $period = $request->input('period');
        $now = Carbon::now();

        // Inicializar la consulta base
        $query = SaleDocument::selectRaw('SUM(overall_total) as total_sales')->where('status', 1);

        $queryPhysical = SalePhysicalDocument::selectRaw('SUM(total) as total_sales')
            ->where('status', '<>', 'A')
            ->groupBy('document_type');

        // Determinar el agrupamiento según el período
        switch ($period) {
            case 'day':
                $query->whereDate('created_at', $now->format('Y-m-d'));
                $queryPhysical->whereDate('created_at', $now->format('Y-m-d'));

                $previousDay = $now->subDay()->format('Y-m-d');
                $previousTotal = SaleDocument::whereDate('created_at', $previousDay)
                    ->where('status', 1)
                    ->sum('overall_total');
                $previousTotalPhysical = SalePhysicalDocument::whereDate('created_at', $previousDay)
                    ->where('status', '<>', 'A')
                    ->sum('total');
                break;

            case 'week':
                $startOfWeek = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
                $endOfWeek = $now->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $queryPhysical->whereBetween('created_at', [$startOfWeek, $endOfWeek]);

                $previousWeekStart = $now->subWeek()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
                $previousWeekEnd = $previousWeekStart . '+6 days';
                $previousTotal = SaleDocument::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
                    ->where('status', 1)
                    ->sum('overall_total');
                $previousTotalPhysical = SalePhysicalDocument::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
                    ->where('status', '<>', 'A')
                    ->sum('total');

                break;

            case 'month':
                $startOfMonth = $now->startOfMonth()->format('Y-m-d');
                $endOfMonth = $now->endOfMonth()->format('Y-m-d');
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                $queryPhysical->whereBetween('created_at', [$startOfMonth, $endOfMonth]);

                $previousMonthStart = $now->subMonth()->startOfMonth()->format('Y-m-d');
                $previousMonthEnd = $now->subMonth()->endOfMonth()->format('Y-m-d');
                $previousTotal = SaleDocument::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
                    ->where('status', 1)
                    ->sum('overall_total');

                $previousTotalPhysical = SalePhysicalDocument::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
                    ->where('status', '<>', 'A')
                    ->sum('total');
                break;
        }

        // Obtener el total de ventas
        $totalSales = $query->first()->total_sales ?? 0;
        $totalPhysical = $queryPhysical->first()->total_sales ?? 0;
        //dd($previousTotal);
        // Calcular la diferencia con el período anterior
        $difference = ($totalSales + $totalPhysical) - ($previousTotal + ($previousTotalPhysical ?? 0));
        //dd($totalSales);
        // Devolver la respuesta en formato JSON
        return response()->json([
            'total_sales' => ($totalSales + $totalPhysical),
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
