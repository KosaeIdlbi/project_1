<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Catigory;
use App\Models\Product;
use App\Models\Tag;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ViewProduct extends Component
{
    use WithPagination;
    protected $listeners = ["refresh"];
    public $catigories;
    public $tags;
    public $brands;
    public function mount()
    {
        $this->catigories = Catigory::orderBy("order", "asc")->get();
        $this->tags = Tag::orderBy("order", "asc")->get();
        $this->brands = Brand::orderBy("order", "asc")->get();
    }

    //تصفية المنتجات حسب القسم
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
        $this->reset("UpdatedAt");
        $this->resetPage();
    }

    //جلب المنتجات حسب التعديلات من تاريخ التعديل الى الوقت الحاضر
    public $UpdatedAt = "2000/1/1 00:00:00";
    public function updatedUpdatedAt()
    {
        $this->reset("CreatedAt");
        $this->resetPage();
    }


    //جلب المنتجات المتاحة
    public $Available = "";
    public function updatedAvailable()
    {
        $this->reset("UnAvailable");
        $this->resetPage();
    }
    //جلب المنتجات الغير المتاحة
    public $UnAvailable = "";
    public function updatedUnAvailable()
    {
        $this->reset("Available");
        $this->resetPage();
    }


    //جلب المنتجات المميزة
    public $Special = "";
    public function updatedSpecial()
    {
        $this->reset("NotSpecial");
        $this->resetPage();
    }
    //جلب المنتجات الغير مميزة
    public $NotSpecial = "";
    public function updatedNotSpecial()
    {
        $this->reset("Special");
        $this->resetPage();
    }


    //جلب العروض
    public $Offers = "";
    public function updatedOffers()
    {
        $this->reset("WithoutOffers");
        $this->resetPage();
    }
    //جلب بدون العروض
    public $WithoutOffers = "";
    public function updatedWithoutOffers()
    {
        $this->reset("Offers");
        $this->resetPage();
    }

    //جلب حسب الترتيب التصاعدي او التناولي للتاريخ
    public $sortAs = "desc";
    public function sorting($sort)
    {
        $this->sortAs = $sort;
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
            $this->Available,
            $this->Special,
            $this->Offers,
            $this->UnAvailable,
            $this->NotSpecial,
            $this->WithoutOffers,
            $this->CreatedAt,
            $this->UpdatedAt,
            $this->sortAs
        );
    }
    public function resetFilters()
    {
        $this->reset("search", "CatigoryName", "BrandName", "TagName", "ProductName", "Price", "CreatedAt", "UpdatedAt", "Available", "Offers", "Special", "UnAvailable", "WithoutOffers", "NotSpecial");
        $this->dispatch("clear-checkboxes");
    }
    public function refresh()
    {
        return 0;
    }
    public function render()
    {
        return view('livewire.admin.products.view-product', [
            "products" => $this->products,
        ]);
    }
}
