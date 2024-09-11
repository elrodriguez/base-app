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
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones']));
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_suscripciones_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_institucion_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_docente_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_estudiante_certificados_crear']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_listado']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_nuevo']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_editar']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_eliminar']));
        array_push($permissions, Permission::create(['name' => 'aca_cursos_modulos']));

        array_push($permissions, Permission::create(['name' => 'aca_miscursos']));

        array_push($permissions, Permission::create(['name' => 'aca_estudiante_cobrar']));

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }

        $alumno = Role::create(['name' => 'Alumno']);
        $alumno->givePermissionTo('aca_miscursos');

        $docente = Role::create(['name' => 'Docente']);
        $docente->givePermissionTo('aca_cursos_listado');
    }
}
