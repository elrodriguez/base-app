<?php

namespace Modules\Dental\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use DataTables;
use Modules\Dental\Entities\DentAttention;
use Modules\Health\Entities\HealDoctor;

class DentAttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dental::Attentions/List');
    }

    public function getTable()
    {

        $table = (new DentAttention())->newQuery();
        return DataTables::of($table)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = HealDoctor::with('person')->get();
        if (count($doctors) > 0) {
            foreach ($doctors as $i => $doctor) {
                $doctors[$i] = array(
                    'code' => $doctor->id,
                    'name' => $doctor->person->full_name,
                    'email' => $doctor->person->email,
                    'telephone' => $doctor->person->telephone
                );
            }
        }

        return Inertia::render('Dental::Attentions/Create', [
            'doctors' => $doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dental::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dental::edit');
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
