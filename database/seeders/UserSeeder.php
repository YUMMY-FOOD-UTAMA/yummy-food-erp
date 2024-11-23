<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ["email" => "super-admin@gmail.com"],
            [
                "full_name" => "Super Admin",
                'name' => 'Super Admin',
                'email' => 'super-admin@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        $admin->assignRole('Super Admin');
    }
}
