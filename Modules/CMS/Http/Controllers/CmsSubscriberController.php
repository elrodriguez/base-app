<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Modules\CMS\Entities\CmsSubscriber;

class CmsSubscriberController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('cms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function apiStore(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|unique:cms_subscribers,email|max:255',
            ],
            [
                'email.unique' => 'El correo electrónico ya existe',
                'email.required' => 'El correo electrónico es obligatorio',
                'email.email' => 'Por favor, ingrese una dirección de correo electrónico válida.',
                'email.max' => 'Limita la longitud máxima del campo de correo electrónico a 255 caracteres',
            ]
        );

        // Verificar si las validaciones fallaron
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        CmsSubscriber::create([
            'full_name'     => $request->get('full_name') ?? null,
            'email'         => $request->get('email'),
            'phone'         => $request->get('phone') ?? null,
            'client_ip'     => $request->ip()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Datos registrados con exito'
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cms::edit');
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
