<?php

namespace App\Livewire\Admin\Employees;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Computed;

class SetPermissions extends Component
{
    public $permission_name;
    public function store()
    {
        $this->validate(["permission_name" => "required|unique:permissions,name"]);
        Permission::create([
            "name" => $this->permission_name,
            "guard_name" => "admin"
        ]);
        $this->cancel();
    }

    #[Computed()]
    public function permissions()
    {
        return Permission::get();
    }
    public function cancel()
    {
        $this->reset("permission_name");
    }
    public function delete($id)
    {
        Permission::findOrFail($id)->delete();
        return 0;
    }
    public function render()
    {
        return view('livewire.admin.employees.set-permissions', ["permissions" => $this->permissions]);
    }
}
