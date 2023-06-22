<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
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
        //
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
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }

    public function searchByNumberType(Request $request)
    {
        $document_type = $request->input('document_type');
        $number = $request->input('number');

        $msg1 = '';
        $msg2 = '';
        $status = true;
        $person = [];
        $alert = 'No existen datos para la busqueda';

        if (!$document_type) {
            $msg1 = 'Elija Tipo docuemnto';
        }
        if (!$number) {
            $msg2 = 'Ingrese numero de documento';
        }
        $person = Person::where('document_type_id', $document_type)
            ->where('number', $number)
            ->first();
        if ($person) {
            $status = true;
            $alert = null;
        } else {
            $status = false;
            $alert = 'No existen datos para la busqueda';
        }

        return response()->json([
            'status'        => $status,
            'person'        => $person,
            'document_type' => $msg1,
            'number'        => $msg2,
            'alert'         => $alert
        ]);
    }

    public function saveUpdateOrCreate(Request $request)
    {
        $this->validate($request, [
            'document_type' => 'required',
            'number' => 'required'
        ]);

        $person = Person::updateOrCreate(
            [
                'document_type_id' => $request->input('document_type'),
                'number' => $request->input('number')
            ], // Buscamos a la persona 
            [
                'full_name' => $request->input('full_name'),
                'telephone' => $request->input('telephone'),
                'email' => $request->input('email'),
                'address' => $request->input('address')
                // otros campos que quieras actualizar o crear
            ]
        );

        return response()->json($person);
    }

    public function searchByNameOrNumber(Request $request)
    {
        $search = $request->input('search');
        $status = true;
        $persons = [];
        $alert = 'No existen datos para la busqueda';

        $persons = Person::where('number', $search)
            ->orWhere('full_name', 'like', '%' . $search . '%')
            ->orWhere('short_name', 'like', '%Clientes Varios%')
            ->orderBy('id')
            ->get();
        if (count($persons) > 0) {
            $status = true;
            $alert = null;
        } else {
            $status = false;
            $alert = 'No existen datos para la busqueda';
        }

        return response()->json([
            'status'        => $status,
            'persons'        => $persons,
            'alert'         => $alert
        ]);
    }
}
