<?php

namespace Modules\Health\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\Health\Entities\HealDoctor;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DoctorController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = (new HealDoctor())->newQuery();
        $doctors = $doctors->join('people', 'heal_doctors.person_id', 'people.id')
            ->select(
                'heal_doctors.id',
                'heal_doctors.person_id',
                'heal_doctors.doctor_code',
                'people.document_type_id',
                'people.full_name',
                'people.number',
                'people.telephone',
                'people.email',
                'people.address',
                'people.birthdate',
                'heal_doctors.created_at',
                'people.image',
                'people.gender'
            );
        if (request()->has('search')) {
            $doctors->where('people.full_name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $doctors->orderBy($attribute, $sort_order);
        } else {
            $doctors->latest();
        }

        $doctors = $doctors->paginate(10)->onEachSide(2);

        return Inertia::render('Health::Doctors/CardList', [
            'doctors' => $doctors,
            'filters' => request()->all('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $identityDocumentTypes = DB::table('identity_document_type')->get();

        $ubigeo = District::join('provinces', 'province_id', 'provinces.id')
            ->join('departments', 'provinces.department_id', 'departments.id')
            ->select(
                'districts.id AS district_id',
                'districts.name AS district_name',
                'provinces.name AS province_name',
                'departments.name AS department_name'
            )
            ->get();

        return Inertia::render('Health::Doctors/Create', [
            'identityDocumentTypes' => $identityDocumentTypes,
            'ubigeo'       => $ubigeo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $update_id = null;

        $this->validate(

            $request,
            [
                'document_type_id'  => 'required',
                'number'            => 'required|max:12',
                'number'            => 'unique:people,number,' . $update_id . ',id,document_type_id,' . $request->get('document_type_id'),
                'telephone'         => 'required|max:12',
                'email'             => 'required|max:255|unique:people,email',
                'email'             => 'required|max:255|unique:users,email',
                'address'           => 'required|max:255',
                'ubigeo'            => 'required|max:255',
                'birthdate'         => 'required|',
                'names'             => 'required|max:255',
                'father_lastname'   => 'required|max:255',
                'mother_lastname'   => 'required|max:255',
            ]
        );

        // $path = 'img' . DIRECTORY_SEPARATOR . 'imagen-no-disponible.jpeg';
        // $destination = 'uploads' . DIRECTORY_SEPARATOR . 'products';
        $path = null;
        $destination = 'uploads/doctores';
        $file = $request->file('image');
        if ($file) {
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $original_name = str_replace(" ", "_", $original_name);
            $extension = $file->getClientOriginalExtension();
            $file_name = date('YmdHis') . '.' . $extension;
            //dd($destination);
            $path = $request->file('image')->storeAs(
                $destination,
                $file_name,
                'public'
            );
        }

        $per = Person::create([
            'document_type_id'      => $request->get('document_type_id'),
            'short_name'            => $request->get('names'),
            'full_name'             => $request->get('father_lastname') . ' ' .  $request->get('mother_lastname') . ' ' . $request->get('names'),
            'description'           => 'Doctor',
            'number'                => $request->get('number'),
            'telephone'             => $request->get('telephone'),
            'email'                 => $request->get('email'),
            'image'                 => $path,
            'address'               => $request->get('address'),
            'is_provider'           => false,
            'is_client'             => false,
            'ubigeo'                => $request->get('ubigeo'),
            'birthdate'             => $request->get('birthdate'),
            'names'                 => $request->get('names'),
            'father_lastname'       => $request->get('father_lastname'),
            'mother_lastname'       => $request->get('mother_lastname'),
            'gender'                => $request->get('gender')
        ]);

        HealDoctor::create([
            'person_id'     => $per->id,
            'doctor_code'  => $request->get('number')
        ]);

        return redirect()->route('heal_doctors_create')
            ->with('message', __('Doctor creado con éxito'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('health::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $identityDocumentTypes = DB::table('identity_document_type')->get();

        $ubigeo = District::join('provinces', 'province_id', 'provinces.id')
            ->join('departments', 'provinces.department_id', 'departments.id')
            ->select(
                'districts.id AS district_id',
                'districts.name AS district_name',
                'provinces.name AS province_name',
                'departments.name AS department_name'
            )
            ->get();

        $doctor = Person::leftJoin('districts', 'ubigeo', 'districts.id')
            ->leftJoin('provinces', 'districts.province_id', 'provinces.id')
            ->leftJoin('departments', 'provinces.department_id', 'departments.id')
            ->select(
                'people.*',
                DB::raw('CONCAT(departments.name,"-",provinces.name,"-",districts.name) AS city'),

            )
            ->where('people.id', $id)
            ->first();

        return Inertia::render('Health::Doctors/Edit', [
            'identityDocumentTypes' => $identityDocumentTypes,
            'ubigeo'                => $ubigeo,
            'doctor'               => $doctor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $update_id = $request->get('id');

        $this->validate(

            $request,
            [
                'document_type_id'  => 'required',
                'number'            => 'required|max:12',
                'number'            => 'unique:people,number,' . $update_id . ',id,document_type_id,' . $request->get('document_type_id'),
                'telephone'         => 'required|max:12',
                'email'             => 'required|max:255|unique:people,email,' . $update_id . ',id',
                'address'           => 'required|max:255',
                'ubigeo'            => 'required|max:255',
                'birthdate'         => 'required|',
                'names'             => 'required|max:255',
                'father_lastname'   => 'required|max:255',
                'mother_lastname'   => 'required|max:255',
            ]
        );

        // $path = 'img' . DIRECTORY_SEPARATOR . 'imagen-no-disponible.jpeg';
        // $destination = 'uploads' . DIRECTORY_SEPARATOR . 'products';

        $person = Person::find($update_id);

        $person->document_type_id   = $request->get('document_type_id');
        $person->short_name         = $request->get('names');
        $person->full_name          = $request->get('father_lastname') . ' ' .  $request->get('mother_lastname') . ' ' . $request->get('names');
        $person->number             = $request->get('number');
        $person->telephone          = $request->get('telephone');
        $person->email              = $request->get('email');
        $person->address            = $request->get('address');
        $person->ubigeo             = $request->get('ubigeo');
        $person->birthdate          = $request->get('birthdate');
        $person->names              = $request->get('names');
        $person->father_lastname    = $request->get('father_lastname');
        $person->mother_lastname    = $request->get('mother_lastname');
        $person->gender             = $request->get('gender');

        $path = null;
        $destination = 'uploads/doctores';
        $file = $request->file('image');
        if ($file) {
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $original_name = str_replace(" ", "_", $original_name);
            $extension = $file->getClientOriginalExtension();
            $file_name = date('YmdHis') . '.' . $extension;
            $path = $request->file('image')->storeAs(
                $destination,
                $file_name,
                'public'
            );
            $person->image = $path;
        }

        $person->save();

        HealDoctor::where('person_id', $update_id)->update([
            'doctor_code'  => $request->get('number')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
