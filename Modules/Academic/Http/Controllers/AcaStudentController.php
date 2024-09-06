<?php

namespace Modules\Academic\Http\Controllers;

use App\Models\District;
use App\Models\Parameter;
use App\Models\PaymentMethod;
use App\Models\Person;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\Academic\Entities\AcaStudent;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Academic\Entities\AcaCapRegistration;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaModule;

class AcaStudentController extends Controller
{
    use ValidatesRequests;

    private $ubl;
    private $igv;
    private $top;
    private $icbper;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function __construct()
    {
        $this->ubl = Parameter::where('parameter_code', 'P000003')->value('value_default');
        $this->igv = Parameter::where('parameter_code', 'P000001')->value('value_default');
        $this->top = Parameter::where('parameter_code', 'P000002')->value('value_default');
        $this->icbper = Parameter::where('parameter_code', 'P000004')->value('value_default');
    }

    public function index()
    {
        $students = (new AcaStudent())->newQuery();
        $students = $students->join('people', 'aca_students.person_id', 'people.id')
            ->select(
                'aca_students.id',
                'aca_students.student_code',
                'people.document_type_id',
                'people.full_name',
                'people.number',
                'people.telephone',
                'people.email',
                'people.address',
                'people.birthdate',
                'people.image AS people_image',
                'aca_students.created_at'
            );
        if (request()->has('search')) {
            $students->where('people.full_name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $students->orderBy($attribute, $sort_order);
        } else {
            $students->latest();
        }

        $students = $students->paginate(12)->onEachSide(2);

        return Inertia::render('Academic::Students/List', [
            'students' => $students,
            'filters' => request()->all('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
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

        return Inertia::render('Academic::Students/Create', [
            'identityDocumentTypes' => $identityDocumentTypes,
            'ubigeo' => $ubigeo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $update_id = $request->get('id');
        $user = User::where('person_id', $request->get('id'))->first();

        $this->validate(
            $request,
            [
                'document_type_id'  => 'required',
                'number'            => 'required|max:12',
                'number'            => 'unique:people,number,' . $update_id . ',id,document_type_id,' . $request->get('document_type_id'),
                'telephone'         => 'required|max:12',
                'email'             => 'required|max:255',
                'email'             => 'unique:people,email,' . $update_id . ',id',
                'email'             => 'unique:users,email,' . ($user ? $user->id  : null) . ',id',
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
        $destination = 'uploads/students';
        $file = $request->file('image');

        $per = Person::updateOrCreate(
            [
                'document_type_id'      => $request->get('document_type_id'),
                'number'                => $request->get('number'),
            ],
            [
                'short_name'            => $request->get('names'),
                'full_name'             => trim($request->get('father_lastname') . ' ' .  $request->get('mother_lastname') . ' ' . $request->get('names')),
                'description'           => $request->get('description'),
                'telephone'             => $request->get('telephone'),
                'email'                 => $request->get('email'),
                'image'                 => $path,
                'address'               => $request->get('address'),
                'is_provider'           => false,
                'is_client'             => true,
                'ubigeo'                => $request->get('ubigeo'),
                'birthdate'             => $request->get('birthdate'),
                'names'                 => trim($request->get('names')),
                'father_lastname'       => trim($request->get('father_lastname')),
                'mother_lastname'       => trim($request->get('mother_lastname'))
            ]
        );

        if ($file) {
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $original_name = str_replace(" ", "_", $original_name);
            $extension = $file->getClientOriginalExtension();
            $file_name = trim($request->get('number')) . '.' . $extension;
            $path = $request->file('image')->storeAs(
                $destination,
                $file_name,
                'public'
            );

            $per->image = $path;
            $per->save();
        }


        $user = User::updateOrCreate(
            [
                'email'         => $request->get('email'),
                'person_id'     => $per->id
            ],
            [
                'name'          => $request->get('names'),
                'password'      => Hash::make($request->get('number')),
                'information'   => $request->get('description'),
                'avatar'        => $path,
                'person_id'     => $per->id
            ]
        );

        $user->assignRole('Alumno');

        AcaStudent::updateOrCreate(
            [
                'person_id'     => $per->id
            ],
            [
                'student_code'  => $request->get('number'),
            ]
        );

        return redirect()->route('aca_students_list')
            ->with('message', __('Estudiante creado con éxito'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('academic::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
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

        $student = AcaStudent::join('people', 'person_id', 'people.id')
            ->leftJoin('districts', 'ubigeo', 'districts.id')
            ->leftJoin('provinces', 'districts.province_id', 'provinces.id')
            ->leftJoin('departments', 'provinces.department_id', 'departments.id')
            ->select(
                'people.*',
                'aca_students.id AS student_id',
                DB::raw('CONCAT(departments.name,"-",provinces.name,"-",districts.name) AS city')
            )
            ->where('aca_students.id', $id)
            ->first();

        $student->image_preview = $student->image;

        return Inertia::render('Academic::Students/Edit', [
            'identityDocumentTypes' => $identityDocumentTypes,
            'ubigeo'                => $ubigeo,
            'student'               => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $person_id = $request->get('id');
        $student_id = $request->get('student_id');
        $user = User::where('person_id', $person_id)->first();

        $this->validate(

            $request,
            [
                'document_type_id'  => 'required',
                'number'            => 'required|max:12',
                'number'            => 'unique:people,number,' . $person_id . ',id,document_type_id,' . $request->get('document_type_id'),
                'telephone'         => 'required|max:12',
                'email'             => 'required|max:255',
                'email'            => 'unique:people,email,' . $person_id . ',id',
                'email'            => 'unique:users,email,' . $user->id . ',id',
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
        $destination = 'uploads/students';
        $file = $request->file('image');
        if ($file) {
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $original_name = str_replace(" ", "_", $original_name);
            $extension = $file->getClientOriginalExtension();
            $file_name = trim($request->get('number')) . '.' . $extension;
            $path = $request->file('image')->storeAs(
                $destination,
                $file_name,
                'public'
            );
            //$path = asset('storage/' . $path);
            $path =  $path;
        }

        Person::find($person_id)->update([
            'document_type_id'      => $request->get('document_type_id'),
            'short_name'            => trim($request->get('names')),
            'full_name'             => trim($request->get('father_lastname') . ' ' .  $request->get('mother_lastname') . ' ' . $request->get('names')),
            'description'           => $request->get('description'),
            'number'                => $request->get('number'),
            'telephone'             => $request->get('telephone'),
            'email'                 => $request->get('email'),
            'image'                 => $path,
            'address'               => $request->get('address'),
            'is_provider'           => false,
            'is_client'             => true,
            'ubigeo'                => $request->get('ubigeo'),
            'birthdate'             => $request->get('birthdate'),
            'names'                 => trim($request->get('names')),
            'father_lastname'       => trim($request->get('father_lastname')),
            'mother_lastname'       => trim($request->get('mother_lastname'))
        ]);

        $user->update([
            'name'          => $request->get('names'),
            'email'         => $request->get('email'),
            'password'      => Hash::make($request->get('number')),
            'information'   => $request->get('description'),
            'avatar'        => $path
        ]);

        AcaStudent::where('person_id', $person_id)->update([
            'student_code'  => $request->get('number'),
        ]);

        return redirect()->route('aca_students_edit', $student_id)
            ->with('message', __('Estudiante creado con éxito'));
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

    public function myCourses()
    {
        $user = Auth::user();
        $student_id = AcaStudent::where('person_id', $user->person_id)->value('id');
        $courses = [];
        // También puedes verificar múltiples roles a la vez
        if ($user->hasAnyRole(['admin', 'Docente', 'Administrador'])) {
            $courses = AcaCourse::with('modules.themes.contents')
                ->with('teacher.person')->where('status', true)
                ->with('category')
                ->with('modality')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $courses = AcaCourse::with('modules.themes.contents')
                ->with('modality')
                ->with('category')
                ->with('teacher.person')->whereHas('registrations', function ($query) use ($student_id) {
                    $query->where('student_id', $student_id);
                })->orderBy('id', 'DESC')
                ->get();
        }
        //dd($courses);
        return Inertia::render('Academic::Students/Courses', [
            'courses' => $courses
        ]);
    }

    public function courseLessons($id)
    {
        $course = AcaCourse::with('modules')
            ->where('id', $id)
            ->first();

        return Inertia::render('Academic::Students/Lessons', [
            'course' => $course
        ]);
    }

    public function courseLessonThemes($id)
    {


        $module = AcaModule::with(['themes' => function ($query) {
            $query->orderBy('position')
                ->with('contents')
                ->with('comments.user'); // Cargar los contenidos de cada theme
        }])
            ->where('id', $id)
            ->first();

        $course = AcaCourse::with('teacher.person')->where('id', $module->course_id)
            ->first();

        return Inertia::render('Academic::Students/Themes', [
            'course' => $course,
            'module' => $module
        ]);
    }

    public function invoice($id)
    {
        $payments = PaymentMethod::all();
        $saleDocumentTypes = DB::table('sale_document_types')->whereIn('sunat_id', ['01', '03'])->get();
        $services = Product::where('is_product', false)->get();
        $courses = AcaCourse::where('status', true)->get();

        return Inertia::render('Academic::Students/Invoice', [
            'payments' => $payments,
            'saleDocumentTypes' => $saleDocumentTypes,
            'student' => AcaStudent::with('person')->where('id', $id)->first(),
            'services' => $services,
            'courses' => $courses,
            'taxes' => array(
                'igv' => $this->igv,
                'icbper' => $this->icbper
            )
        ]);
    }

    public function getCourses(Request $request)
    {
        $student = AcaStudent::where('person_id', $request->id)->first();
        $mycourses = $student->registrations()
            ->with(['course.modality', 'course.teachers.teacher.person'])
            ->get();

        $allcourses = [];

        if (empty($mycourses)) {
            $allcourses = AcaCourse::with('teachers.teacher.person')
                ->with('modality')
                ->get();
        } else {
            $ids = $mycourses->pluck('course_id')->toArray();
            $allcourses = AcaCourse::with('teachers.teacher.person')
                ->with('modality')
                ->whereNotIn('id', $ids)
                ->get();
        }


        return response()->json([
            'mycourses' => $mycourses,
            'allcourses' => $allcourses
        ]);
    }
}
