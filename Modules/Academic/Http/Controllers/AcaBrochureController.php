<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class AcaBrochureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('academic::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic::create');
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

    public function uploadImage(Request $request)
    {
        //dd($request->all());
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $file_name = 'course_' . date('YmdHis') . '.' . $extension;

        //indicamos que queremos guardar un nuevo archivo en el disco local
        $path = $request->file('file')->storeAs(
            'brochures',
            $file_name,
            'public'
        );

        $url = asset('storage/' . $path);

        return response()->json(['location' =>  $url]);
    }
}
