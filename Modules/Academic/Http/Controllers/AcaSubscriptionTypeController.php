<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Academic\Entities\AcaSubscriptionType;

class AcaSubscriptionTypeController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = AcaSubscriptionType::all();
        return Inertia::render('Academic::Subscriptions/List', [
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Academic::Subscriptions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //dd($request->all());
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'details.*.label' => 'required',
                'prices.0.currency' => 'required',
                'prices.0.amount' => 'required',
                'prices.0.detail' => 'required',
            ]
        );

        AcaSubscriptionType::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'details' => json_encode($request->get('details')),
            'prices' => json_encode($request->get('prices')),
            'status' => $request->get('status') ?? false,
        ]);

        return redirect()->route('aca_subscriptions_list')
            ->with('message', __('Creado con éxito'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('academic::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('academic::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
