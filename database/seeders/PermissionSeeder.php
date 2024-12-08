<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return isset($route->action['as']) &&
                !str_starts_with($route->action['as'], 'debugbar') &&
                !str_starts_with($route->action['as'], 'generated') &&
                !str_starts_with($route->action['as'], 'storage') &&
                !str_starts_with($route->action['as'], 'login') &&
                !str_starts_with($route->action['as'], 'logout') &&
                !str_starts_with($route->action['as'], 'post.login') &&
                !str_starts_with($route->action['as'], 'api');
        })->map(function ($route) {
            return $route->action['as'];
        });

        $routes->unique()->each(function ($routeName) {
            Permission::firstOrCreate([
                'name' => $routeName,
                'guard_name' => 'web'
            ]);
        });

        Permission::updateOrCreate(
            ["name" => "receivable.crm.sales-confirm-visit.index.only-self", "guard_name" => "web"],
            ["name" => "receivable.crm.sales-confirm-visit.index.only-self", "guard_name" => "web"]
        );
        Permission::updateOrCreate(
            ["name" => "receivable.crm.sales-confirm-visit.confirm.only-self", "guard_name" => "web"],
            ["name" => "receivable.crm.sales-confirm-visit.confirm.only-self", "guard_name" => "web"]
        );

        Permission::updateOrCreate(
            ["name" => "receivable.crm.sales-visit-report.index.only-self", "guard_name" => "web"],
            ["name" => "receivable.crm.sales-visit-report.index.only-self", "guard_name" => "web"]
        );

        Permission::updateOrCreate(
            ["name" => "receivable.crm.schedule-visit.index.only-self", "guard_name" => "web"],
            ["name" => "receivable.crm.schedule-visit.index.only-self", "guard_name" => "web"]
        );

        $this->command->info('Permissions seeded successfully based on route names!');
    }
}
