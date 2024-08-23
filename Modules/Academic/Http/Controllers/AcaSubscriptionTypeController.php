<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Modules\Academic\Entities\AcaSubscriptionType;

class AcaSubscriptionTypeController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = AcaSubscriptionType::orderBy('order_number')->get();
        return Inertia::render('Academic::Subscriptions/List', [
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periods = getEnumValues('aca_subscription_types', 'period');
        return Inertia::render('Academic::Subscriptions/Create', [
            'periods' => $periods
        ]);
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
                'period' => 'required'
            ]
        );

        AcaSubscriptionType::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'details' => json_encode($request->get('details')),
            'prices' => json_encode($request->get('prices')),
            'status' => $request->get('status') ?? false,
            'period' => $request->get('period'),
            'order_number' => $request->get('order_number'),
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
        $subscription = AcaSubscriptionType::find($id);
        $periods = getEnumValues('aca_subscription_types', 'period');

        return Inertia::render('Academic::Subscriptions/Edit', [
            'subscription' => $subscription,
            'periods' => $periods
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'details.*.label' => 'required',
                'prices.0.currency' => 'required',
                'prices.0.amount' => 'required',
                'prices.0.detail' => 'required',
                'period' => 'required'
            ]
        );

        AcaSubscriptionType::find($id)->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'details' => json_encode($request->get('details')),
            'prices' => json_encode($request->get('prices')),
            'status' => $request->get('status') ?? false,
            'period' => $request->get('period'),
            'order_number' => $request->get('order_number'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = null;
        $success = false;
        try {
            // Usamos una transacción para asegurarnos de que la operación se realice de manera segura.
            DB::beginTransaction();

            // Verificamos si existe.
            $item = AcaSubscriptionType::findOrFail($id);

            // Si no hay detalles asociados, eliminamos.
            $item->delete();

            // Si todo ha sido exitoso, confirmamos la transacción.
            DB::commit();

            $message =  'Eliminado correctamente';
            $success = true;
        } catch (\Exception $e) {
            // Si ocurre alguna excepción durante la transacción, hacemos rollback para deshacer cualquier cambio.
            DB::rollback();
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }
}
