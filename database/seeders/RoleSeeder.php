<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
    $admin = Role::firstOrCreate(['name' => 'admin']);
    $user = Role::firstOrCreate(['name' => 'user']);

    // Create permission
    $dashboardPermission = Permission::firstOrCreate(['name' => 'view dashboard']);

    // Assign permission to admin
    $admin->givePermissionTo($dashboardPermission);
    }
}
