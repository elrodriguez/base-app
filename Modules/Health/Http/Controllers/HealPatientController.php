<?php

namespace Modules\Health\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\Health\Entities\HealPatient;

class HealPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $patients = (new HealPatient())->newQuery();
        $patients = $patients->join('people', 'heal_patients.person_id', 'people.id')
            ->select(
                'heal_patients.id',
                'heal_patients.patient_code',
                'people.document_type_id',
                'people.full_name',
                'people.number',
                'people.telephone',
                'people.email',
                'people.address',
                'people.birthdate'
            );
        if (request()->has('search')) {
            $patients->where('people.full_name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $patients->orderBy($attribute, $sort_order);
        } else {
            $patients->latest();
        }

        $patients = $patients->paginate(10);

        return Inertia::render('Health::Patients/List', [
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $identityDocumentType = DB::table('identity_document_type')->get();
        return view('health::create', [
            'identityDocumentType' => $identityDocumentType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('health::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('health::edit');
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
