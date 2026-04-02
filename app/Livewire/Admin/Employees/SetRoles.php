<?php

namespace App\Livewire\Admin\Employees;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetRoles extends Component
{
    public $role_name;
    public $permissions;
    public $role_has_permissions = [];
    public function mount()
    {
        $this->permissions = Permission::get();
    }
    public function store()
    {
        $this->validate(["role_name" => "required|unique:roles,name"]);
        Role::create([
            "name" => $this->role_name,
            "guard_name" => "admin"
        ])->givePermissionTo($this->role_has_permissions);
        $this->cancel();
    }
    public function addPermission($permission_name)
    {
        $this->role_has_permissions[] = $permission_name;
    }
    #[Computed()]
    public function roles()
    {
        return Role::with("permissions")->get();
    }
    public function cancel()
    {
        $this->reset("role_name", "role_has_permissions");
    }
    public function delete($id)
    {
        Role::findOrFail($id)->delete();
        return 0;
    }
    public function render()
    {
        return view('livewire.admin.employees.set-roles', ["roles" => $this->roles]);
    }
}
