<?php

namespace Database\Seeders;

use App\Models\Geographic\Province;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Province::count() == 0) {
            $this->call([
                Indonesia::class,
            ]);
        }
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
