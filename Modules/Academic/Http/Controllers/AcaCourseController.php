<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaInstitution;

class AcaCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    protected $RPTABLE;
    public function __construct()
    {
        $this->RPTABLE = env('RECORDS_PAGE_TABLE') ?? 10;
    }

    public function index()
    {
        $courses = (new AcaCourse())->newQuery();
        if (request()->has('search')) {
            $courses->where('description', 'like', '%' . request()->input('search') . '%');
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $courses->orderBy($attribute, $sort_order);
        } else {
            $courses->latest();
        }
        $courses->with('category');
        $courses->with('modality');
        $courses = $courses->paginate($this->RPTABLE)->onEachSide(2);

        $institutions = AcaInstitution::where('status', true)->get();

        return Inertia::render('Academic::Courses/List', [
            'courses'       => $courses,
            'institutions'  => $institutions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('academic::create');
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
        return view('academic::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('academic::edit');
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
