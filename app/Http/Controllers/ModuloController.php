<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Complex\Functions;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ModuloController extends Controller
{
    public function index()
    {
        $modulos = Modulo::all();
        return Inertia::render('Modulos/Index', [
            'modulos' => $modulos
        ]);
    }
    public function create()
    {
        return Inertia::render('Modulos/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description'   => 'required|max:255|min:4',
            'identifier'       => 'required|min:4|max:4|unique:modulos,identifier',
            'icon'        => 'required'
        ]);

        Modulo::create([
            'identifier' => $request->get('identifier'),
            'description' => $request->get('description'),
            'icon' => $request->get('icon'),
            'status' => $request->get('status') ? true : false
        ]);
    }

    public function edit(Modulo $modulo)
    {
        return Inertia::render('Modulos/Edit', [
            'modulo' => $modulo
        ]);
    }

    public function  update(Request $request, $id)
    {
        $this->validate($request, [
            'description'   => 'required|max:255|min:4',
            'identifier'       => 'required|min:4|max:4|unique:modulos,identifier,' . $id . ',identifier',
            'icon'        => 'required'
        ]);

        Modulo::where('identifier', $id)->update([
            'identifier' => $request->get('identifier'),
            'description' => $request->get('description'),
            'icon' => $request->get('icon'),
            'status' => $request->get('status') ? true : false
        ]);
    }

    public function destroy($id)
    {
        $message = null;
        $success = false;
        try {
            // Usamos una transacción para asegurarnos de que la operación se realice de manera segura.
            DB::beginTransaction();

            // Verificamos si existe.
            $item = Modulo::findOrFail($id);

            // Si no hay detalles asociados, eliminamos.
            $item->delete();

            // Si todo ha sido exitoso, confirmamos la transacción.
            DB::commit();

            $message =  'Modulo eliminado correctamente';
            $success = true;
        } catch (\Exception $e) {
            // Si ocurre alguna excepción durante la transacción, hacemos rollback para deshacer cualquier cambio.
            DB::rollback();
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function permissions($id)
    {
        $modulo = Modulo::find($id);
        $hasPermissions = DB::table('model_has_permissions')
            ->join('permissions', 'model_has_permissions.permission_id', 'permissions.id')
            ->select('permissions.*')
            ->where('model_type', Modulo::class)
            ->where('model_id', $id)
            ->get();

        $permissions = Permission::all();

        return Inertia::render('Modulos/Permissions', [
            'modulo' => $modulo,
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions
        ]);
    }

    public function storePermissions(Request $request)
    {

        $permissions = $request->get('permissions');
        $modulo = $request->get('modulo');

        DB::table('model_has_permissions')->where('model_id', $modulo)
            ->where('model_type', Modulo::class)
            ->delete();

        foreach ($permissions as $permission) {
            $id = Permission::where('name', $permission['name'])->value('id');
            DB::table('model_has_permissions')->insert([
                'permission_id' => $id,
                'model_type' => Modulo::class,
                'model_id' => $modulo
            ]);
        }
    }
}
