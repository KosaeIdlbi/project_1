<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'charge_orders',
            'denied_reasons',
            'sham_account',
            'client_orders',
            'coupons',
            'catigories',
            'brands',
            'tags',
            'products',
            'set_employees_roles_permissions',
            'set_roles',
            'set_permissions',
            'set_register_password',
        ];

        foreach ($permissions as $permissionName) {
            Permission::create([
                "name" => $permissionName,
                "guard_name" => "admin"
            ]);
        }
    }
}
