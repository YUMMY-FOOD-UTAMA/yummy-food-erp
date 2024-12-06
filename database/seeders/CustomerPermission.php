<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CustomerPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
