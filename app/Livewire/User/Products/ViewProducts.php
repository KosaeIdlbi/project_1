<?php

namespace App\Livewire\User\Products;

use App\Models\Brand;
use App\Models\Catigory;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ViewProducts extends Component
{
    use WithPagination;
    protected $listeners = ["refresh"];
    public $user;
    public $catigories;
    public $tags;
    public $brands;
    public function mount()
    {
        $this->catigories = Catigory::orderBy("order", "asc")->get();
        $this->tags = Tag::orderBy("order", "asc")->get();
        $this->brands = Brand::orderBy("order", "asc")->get();
        $this->search = $this->ProductName;
    }
    public $CatigoryName = "";
    public function updatedCatigoryName()
    {
        $this->resetPage();
    }
    public $BrandName = "";
    public function updatedBrandName()
    {
        $this->resetPage();
    }
    public $TagName = "";
    public function updatedTagName()
    {
        $this->resetPage();
    }
    //تصفية المنتجات حسب السعر
    public $Price = null;
    public function updatedPrice()
    {
        $this->resetPage();
    }

    //جلب المنتجات من تاريخ الانشاءالى الوقت الحاضر
    public $CreatedAt = "2000/1/1 00:00:00";
    public function updatedCreatedAt()
    {

        $this->resetPage();
    }

    //جلب المنتجات المميزة
    public $Special = "";
    public function updatedSpecial()
    {
        $this->resetPage();
    }

    //جلب العروض
    public $Offers = "";
    public function updatedOffers()
    {
        $this->resetPage();
    }
    //جلب بدون العروض

    public $Newests = "";
    public function updatedNewests()
    {
        if ($this->Newests) {
            $this->CreatedAt = now()->subDays(30);
        } else {
            $this->reset("CreatedAt");
        }
        $this->resetPage();
    }

    public $search = '';
    public $results = [];
    //تصفية المنتجات حسب الاسم
    public $ProductName = "";
    public function updatedSearch()
    {
        $this->resetPage();
        // جلب فقط النتائج المطابقة، وعدد محدود!
        $this->results = Product::where('name', 'LIKE', '%' . $this->search . '%')
            ->take(10) // حد أقصى 10 نتائج
            ->get("name");
        $this->ProductName = $this->search;
    }
    //جلب المنتجات مع كل تحديث للفلتر
    #[Computed()]
    public function products()
    {
        return Product::getProductsWithFilters(
            $this->Price,
            $this->CatigoryName,
            $this->BrandName,
            $this->TagName,
            $this->ProductName,
            "",
            $this->Special,
            $this->Offers,
            "",
            "",
            "",
            $this->CreatedAt,
            "2000/1/1 00:00:00",
            "desc"
        );
    }
    public function resetFilters()
    {
        $this->reset("search", "CatigoryName", "BrandName", "TagName", "ProductName", "Price", "CreatedAt", "Offers", "Special", "Newests");
        $this->dispatch("clear-checkboxes");
    }
    public function render()
    {
        return view('livewire.user.products.view-products', ["products" => $this->products]);
    }
}
