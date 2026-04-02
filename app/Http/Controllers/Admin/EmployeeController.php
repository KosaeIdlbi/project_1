<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{


    public function employeesSetPermissions()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.employees.set-permissions", ["admin" => $admin]);
    }
    public function employeesSetRoles()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.employees.set-roles", ["admin" => $admin]);
    }
    public function employeesSetEmployeeRole()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.employees.set-employee-role-permissions", ["admin" => $admin]);
    }
    public function employeesSetRegisterPassword()
    {
        $admin = Auth::guard("admin")->user();
        return view("admin.employees.set-register-password", ["admin" => $admin]);
    }
}
