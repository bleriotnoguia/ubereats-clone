<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'create shop']);
        Permission::create(['name' => 'edit shop']);
        Permission::create(['name' => 'delete shop']);

        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        Role::create(['name' => 'shipper']);
        Role::create(['name' => 'customer']);

        // create roles and assign created permissions
        // this can be done as separate statements
        $role = Role::create(['name' => 'shop-admin']);
        $role->givePermissionTo([
            'create shop', 
            'edit shop', 
            'delete shop',
             
            'create articles',
            'edit articles',
            'delete articles'
            
        ]);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}