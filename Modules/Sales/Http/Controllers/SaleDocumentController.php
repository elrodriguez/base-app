<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Person;
use App\Models\SaleDocument;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SaleDocumentController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $client = Person::find(1);
        $documentTypes = DB::table('identity_document_type')->get();
        return Inertia::render('Sales::Documents/Create', [
            'payments'      => $payments,
            'client'        => $client,
            'documentTypes' => $documentTypes
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleDocument  $saleDocument
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDocument $saleDocument)
    {
        //
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
}
