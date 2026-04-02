<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ViewBrand extends Component
{

    use WithPagination;
    protected $listeners = ["refresh"];
    public function refresh()
    {
        return 0;
    }
    public $CreatedAt = "2000/1/1 00:00:00";
    public function updatedCreatedAt()
    {
        $this->reset("UpdatedAt");
        $this->resetPage();
    }
    public $UpdatedAt = "2000/1/1 00:00:00";
    public function updatedUpdatedAt()
    {
        $this->reset("CreatedAt");
        $this->resetPage();
    }
    public $sortAs = "desc";
    public function sorting($sort)
    {
        $this->sortAs = $sort;
    }
    public $Available = "";
    public function updatedAvailable()
    {
        $this->reset("UnAvailable");
        $this->resetPage();
    }
    public $UnAvailable = "";
    public function updatedUnAvailable()
    {
        $this->reset("Available");
        $this->resetPage();
    }
    public function resetFilters()
    {
        $this->dispatch("clear-checkboxes");
        $this->reset("CreatedAt", "UpdatedAt", "BrandName", "sortAs", "Available", "UnAvailable");
    }
    public $BrandName = "";
    public $results = [];
    public $search = "";
    public function updatedSearch()
    {
        $this->resetFilters();
        $this->results = Brand::where("name", "like", "%" . $this->search . "%")->take(10)->get("name");
        $this->BrandName = $this->search;
    }
    #[Computed()]
    public function brands()
    {
        return Brand::with("img")->where("name", "like", "%" . $this->BrandName . "%")
            ->where("available", "like", "%" . $this->Available . "%")
            ->where("available", "like", "%" . $this->UnAvailable . "%")
            ->where("created_at", ">=", Carbon::parse($this->CreatedAt))->orderBy("created_at", $this->sortAs)
            ->where("updated_at", ">=", Carbon::parse($this->UpdatedAt))->orderBy("updated_at", $this->sortAs)
            ->simplePaginate(6);
    }
    public function render()
    {
        return view('livewire.admin.brands.view-brand', [
            "brands" => $this->brands,
        ]);
    }
}
