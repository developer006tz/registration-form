<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list districts']);
        Permission::create(['name' => 'view districts']);
        Permission::create(['name' => 'create districts']);
        Permission::create(['name' => 'update districts']);
        Permission::create(['name' => 'delete districts']);

        Permission::create(['name' => 'list languages']);
        Permission::create(['name' => 'view languages']);
        Permission::create(['name' => 'create languages']);
        Permission::create(['name' => 'update languages']);
        Permission::create(['name' => 'delete languages']);

        Permission::create(['name' => 'list allregions']);
        Permission::create(['name' => 'view allregions']);
        Permission::create(['name' => 'create allregions']);
        Permission::create(['name' => 'update allregions']);
        Permission::create(['name' => 'delete allregions']);

        Permission::create(['name' => 'list userlanguages']);
        Permission::create(['name' => 'view userlanguages']);
        Permission::create(['name' => 'create userlanguages']);
        Permission::create(['name' => 'update userlanguages']);
        Permission::create(['name' => 'delete userlanguages']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
