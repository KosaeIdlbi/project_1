<?php

namespace App\Livewire\Admin\Employees;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;

class Employee extends Component
{
    public $admin;
    public $roles;
    public $permissions;
    public $admin_has_permissions = [];
    public $admin_has_roles = [];
    public $show = "default";
    public function edit()
    {
        $this->show = "editable";
    }
    public function cancel()
    {
        $this->show = "default";
    }

    public function save()
    {
        //select اعتماد الاسم كقيمة ممررة يؤدي الى تداخل القيم في multiple select لان في Idsنرسل ال
        $permissions = Permission::whereIn("id", $this->admin_has_permissions)->get("name")->toArray("name");
        $roles = Role::whereIn("id", $this->admin_has_roles)->get("name")->toArray("name");
        $this->admin->syncPermissions($permissions);
        $this->admin->syncRoles($roles);
        $this->show = "default";
    }
    public function restore()
    {
        $this->admin->restore();
        return 0;
    }
    public function delete()
    {
        $this->admin->delete();
        return 0;
    }
    public function render()
    {
        return view('livewire.admin.employees.employee');
    }
}
