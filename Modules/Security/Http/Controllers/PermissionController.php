<?php

namespace Modules\Security\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;

class PermissionController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('Security::Permissions/List');
    }

    public function getData()
    {
        $model = Permission::query();
        $model = $model->select('id', 'name', 'guard_name', 'created_at', 'updated_at');

        return DataTables::of($model)->toJson();
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render(
            'Security::Permissions/Create',
            ['roles' => $roles]
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:permissions,name'
        ]);

        $permission = Permission::create([
            'name'       => $request->get('name'),
            'guard_name' => 'web'
        ]);

        if (!empty($request->get('roles'))) {
            $permission->assignRole($request->get('roles'));
        }

        return redirect()->route('permissions.index')
            ->with('message', 'Permiso creado con éxito.');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        $roleHasPermissions = array_column(json_decode($permission->roles, true), 'name');
        return Inertia::render(
            'Security::Permissions/Edit',
            [
                'roles' => $roles,
                'permission' => $permission,
                'roleHasPermissions' => $roleHasPermissions,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $permission->update([
            'name' => $request->get('name'),
        ]);
        $roles = $request->get('permissions') ?? [];
        $permission->assignRole($request->get('roles'));

        return redirect()->route('permissions.edit', $permission->id)
            ->with('message', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('message', __('Permission deleted successfully'));
    }
}
