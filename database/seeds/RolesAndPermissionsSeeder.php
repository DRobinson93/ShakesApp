<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create shake']);
        Permission::create(['name' => 'delete shake']);
        Permission::create(['name' => 'react to shake']);
        Permission::create(['name' => 'delete others shake']);
        Permission::create(['name' => 'set role']);

        // create roles and assign created permissions

        $perms = ['create shake', 'delete shake', 'react to shake'];
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo($perms);

        $perms[] = 'delete anyones shake';
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo($perms);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
