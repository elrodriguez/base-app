<?php

namespace Modules\Dental\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsDentalTableSeeder extends Seeder
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

        array_push($permissions, Permission::create(['name' => 'dental_dashboard']));
        array_push($permissions, Permission::create(['name' => 'dental_citas_listado']));
        array_push($permissions, Permission::create(['name' => 'dental_citas_nuevo']));
        array_push($permissions, Permission::create(['name' => 'dental_citas_editar']));
        array_push($permissions, Permission::create(['name' => 'dental_citas_eliminar']));

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }

        // $user = User::find(1);

        // $user->assignRole('webAdmin');
    }
}
