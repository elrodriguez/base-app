<?php

namespace Modules\CRM\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::find(1);

        $permissions = [];

        array_push($permissions, Permission::create(['name' => 'crm_dashboard']));
        array_push($permissions, Permission::create(['name' => 'crm_contactos_listado']));
        array_push($permissions, Permission::create(['name' => 'crm_contactos_nuevo']));
        array_push($permissions, Permission::create(['name' => 'crm_contactos_editar']));
        array_push($permissions, Permission::create(['name' => 'crm_contactos_eliminar']));
        array_push($permissions, Permission::create(['name' => 'crm_chat_dashboard']));
        array_push($permissions, Permission::create(['name' => 'crm_mailbox_dashboard']));

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }
    }
}
