<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call your custom seeders here
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call([
    RoleSeeder::class,
    PermissionSeeder::class, // if you've created it
    UserSeeder::class,
    ]);


    }
}
