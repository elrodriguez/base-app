<?php

namespace Modules\Health\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Health\Entities\HealPatient;

class HealHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('health::index');
    }

    public function patientStory($id)
    {
        $patient = HealPatient::with('person')
            ->where('id', $id)
            ->first();

        return Inertia::render('Health::History/PatientStory', [
            'patient' => $patient
        ]);
    }
}
