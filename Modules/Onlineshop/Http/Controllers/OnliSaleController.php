<?php

namespace Modules\Onlineshop\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Modules\Onlineshop\Entities\OnliItem;
use Modules\Onlineshop\Entities\OnliSale;
use Modules\Onlineshop\Entities\OnliSaleDetail;

class OnliSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('onlineshop::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('onlineshop::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request): RedirectResponse
    {
        $ids = $request->get('item_id');

        $validator = Validator::make($request->all(), [
            'names' => 'required',
            'app' => 'required',
            'apm' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'document_type' => 'required',
            'number' => 'required',
        ], [
            'names.required' => 'El nombre es requerido',
            'app.required' => 'El apellido paterno requerido',
            'apm.required' => 'El apellido materno requerido',
            'phone.required' => 'El teléfono es requerido',
            'email.required' => 'El email es requerido',
            'document_type.required' => 'El tipo de documento es requerido',
            'number.required' => 'El numero de documento es requerido'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $person = Person::firstOrCreate(
            [
                'document_type_id' => $request->get('document_type'),
                'number' => $request->get('number')
            ],
            [

                'short_name'            => $request->get('names'),
                'full_name'             => $request->get('names') . ' ' . $request->get('app') . ' ' . $request->get('apm'),
                'telephone'             => $request->get('phone'),
                'is_client'             => true,
                'names'                 => $request->get('names'),
                'father_lastname'       => $request->get('app'),
                'mother_lastname'       => $request->get('apm')

            ]
        );

        $user = User::firstOrCreate(
            [
                'email' => $request->get('email'),
                'person_id' => $person->id
            ],
            [
                'name'          => $request->get('names'),
                'password'      => Hash::make($request->get('number')),
                'local_id'      => 1
            ]
        );

        $sale = OnliSale::create([
            'module_name'                   => 'Academic',
            'person_id'                     => $person->id,
            'email'                         => $request->get('email'),
            'clie_full_name'                => $request->get('app') . ' ' . $request->get('apm') . ' ' . $request->get('names'),
            'identification_type'           => $request->get('document_type'),
            'identification_number'         => $request->get('number'),
            'response_status'               => 'pendiente',
        ]);

        foreach ($ids as $id) {

            $item = OnliItem::find($id);
            OnliSaleDetail::create([
                'sale_id'       => $sale->id,
                'item_id'       => $item->item_id,
                'entitie'       => $item->entitie,
                'price'         => $item->price,
                'quantity'      => 1,
                'onli_item_id'  => $id
            ]);
        }

        return to_route('web_pagar', [
            'sale'     => $sale->id
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('onlineshop::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('onlineshop::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
