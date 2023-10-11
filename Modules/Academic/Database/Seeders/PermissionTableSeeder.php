<?php

namespace Modules\Academic\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::find(1);

        $permissions = [];

        array_push($permissions, Permission::create(['name' => 'aca_dashboard']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_modulos']));

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }

        // $user = User::find(1);

        // $user->assignRole('webAdmin');
    }
}
