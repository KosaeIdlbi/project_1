<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Admin;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetEmployeeRole extends Component
{
    use WithPagination;
    public $permissions;
    public $roles;
    public function mount()
    {
        $this->permissions = Permission::get();
        $this->roles = Role::get();
    }
    public $search = '';
    public $results = [];
    //تصفية المنتجات حسب الاسم
    public $admin_name = "";
    public function updatedSearch()
    {
        $this->resetPage();
        // جلب فقط النتائج المطابقة، وعدد محدود!
        $this->results = Admin::where('name', 'LIKE', '%' . $this->search . '%')
            ->take(10) // حد أقصى 10 نتائج
            ->get("name");
        $this->admin_name = $this->search;
    }
    #[Computed()]
    public function admins()
    {
        return Admin::withTrashed()->with(["roles", "permissions"])->where('name', 'LIKE', '%' .  $this->admin_name . '%')->simplePaginate(12);
    }
    public function render()
    {
        return view('livewire.admin.employees.set-employee-role', ["admins" => $this->admins, "permissions" => $this->permissions, "roles" => $this->roles]);
    }
}
