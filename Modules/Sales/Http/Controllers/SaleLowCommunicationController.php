<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\SaleDocument;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\Sales\Entities\SaleLowCommunication;

class SaleLowCommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $communications = (new SaleLowCommunication())->newQuery();
        if (request()->has('search')) {
            $communications->whereDate('communication_date', '=', '%' . request()->input('search') . '%');
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $communications->orderBy($attribute, $sort_order);
        } else {
            $communications->latest();
        }

        $communications = $communications->paginate(10)->onEachSide(2);

        return Inertia::render('Sales::Documents/LowCommunication', [
            'communications' => $communications,
            'filters' => request()->all('search'),
        ]);
    }

    public function searchDocuments($date)
    {
        $success = false;
        $documents = SaleDocument::select(
            'sale_documents.*',
            DB::raw('"" AS description_low'),
            DB::raw('(SELECT description FROM sale_document_types WHERE sunat_id=invoice_type_doc) AS type_description')
        )
            ->whereDate('invoice_broadcast_date', $date)
            ->whereIn('invoice_type_doc', ['01', '07'])
            ->get();

        if (count($documents) > 0) {
            $success = true;
        } else {
            $success = false;
        }

        return response()->json([
            'success'   => $success,
            'documents' => $documents
        ]);
    }
}
