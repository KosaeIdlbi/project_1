<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ViewTag extends Component
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
        $this->reset("CreatedAt", "UpdatedAt", "TagName", "sortAs", "Available", "UnAvailable");
    }
    public $search = '';
    public $results = [];
    public $TagName = "";
    public function updatedSearch()
    {
        $this->resetFilters();
        // جلب فقط النتائج المطابقة، وعدد محدود!
        $this->results = Tag::where('name', 'LIKE', '%' . $this->search . '%')
            ->take(10) // حد أقصى 10 نتائج
            ->get("name");
        $this->TagName = $this->search;
    }
    #[Computed()]
    public function tags()
    {
        return Tag::with(["img", "products"])->where("name", "like", "%" . $this->TagName . "%")
            ->where("available", "like", "%" . $this->Available . "%")
            ->where("available", "like", "%" . $this->UnAvailable . "%")
            ->where("created_at", ">=", Carbon::parse($this->CreatedAt))->orderBy("created_at", $this->sortAs)
            ->where("updated_at", ">=", Carbon::parse($this->UpdatedAt))->orderBy("updated_at", $this->sortAs)
            ->simplePaginate(6);
    }
    public function render()
    {
        return view('livewire.admin.tags.view-tag', ["tags" => $this->tags]);
    }
}
