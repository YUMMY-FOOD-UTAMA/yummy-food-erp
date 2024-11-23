<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

        Role::updateOrCreate(
            ["name" => "Super Admin", "guard_name" => "web"],
            ["name" => "Super Admin", "guard_name" => "web"]
        );
    }
}
