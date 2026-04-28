<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =  Admin::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => "admin",
            "email_verified_at" => now(),
        ]);
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
        $admin->syncPermissions($permissions);
    }
}
