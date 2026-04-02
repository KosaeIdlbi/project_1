<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Catigory;
use App\Models\Product;
use App\Models\Specification;
use App\Models\Tag;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;
    public $SpecName;
    public $SpecNamesArray = [];
    public $SpecDesc;
    public $SpecDescsArray = [];
    public $SpecOrder;
    public $SpecOrdersArray = [];
    public $name;
    public $description;
    public $price;
    public $catigory;
    public $catigories;
    public $brand;
    public $brands;
    public $tag;
    public $tags;
    public $imgs = [];
    public $quantity;
    public $able_to_buy_quantity;
    public function mount()
    {
        $this->catigories = Catigory::orderBy("order", "asc")->get();
        if ($this->catigories->isNotEmpty()) {
            $this->catigory = $this->catigories->first()->id;
        }
        $this->brands = Brand::orderBy("order", "asc")->get();
        if ($this->brands->isNotEmpty()) {
            $this->brand = $this->brands->first()->id;
        }
        $this->tags = Tag::orderBy("order", "asc")->get();
        if ($this->tags->isNotEmpty()) {
            $this->tag = $this->tags->first()->id;
        }
    }
    public function addSpec()
    {
        $this->validate([
            "SpecName" => "max:255",
            "SpecDesc" => "max:255",
            "SpecOrder" => "numeric|gte:1"
        ]);
        if (
            trim($this->SpecName) != "" &&
            trim($this->SpecDesc) != "" &&
            trim($this->SpecDesc) != ""
        ) {
            $this->SpecNamesArray[] =  trim($this->SpecName);
            $this->SpecDescsArray[] = trim($this->SpecDesc);
            $this->SpecOrdersArray[] = trim($this->SpecOrder);
            $this->reset("SpecName", "SpecDesc", "SpecOrder");
        }
    }
    public function deleteSpec($i)
    {
        for ($j = $i; $j < count($this->SpecNamesArray) - 1; $j++) {
            $this->SpecOrdersArray[$j] = $this->SpecOrdersArray[$j + 1];
            $this->SpecNamesArray[$j] = $this->SpecNamesArray[$j + 1];
            $this->SpecDescsArray[$j] = $this->SpecDescsArray[$j + 1];
        }
        array_pop($this->SpecOrdersArray);
        array_pop($this->SpecNamesArray);
        array_pop($this->SpecDescsArray);
    }
    public function updatedImgs()
    {
        $this->validate([
            'imgs'   => "max:5",
            'imgs.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:10240',
        ]);
    }
    public function store()
    {

        $this->validate([
            "name" => "required|string|max:255|unique:products,name",
            "price" => "required|numeric",
            "quantity" => "required|numeric|gt:0",
            "able_to_buy_quantity" => "required|numeric|gt:0",
            "catigory" => "required",
            "brand" => "required",
            "tag" => "required",
            'imgs'   => "max:5",
            'imgs.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:10240',
        ]);

        $product = Product::create([
            "name" => trim($this->name),
            "desc" => trim($this->description),
            "price" => trim($this->price),
            "catigory_id" => trim($this->catigory),
            "tag_id" => trim($this->tag),
            "brand_id" => trim($this->brand),
            "quantity" => trim($this->quantity),
            "able_to_buy_quantity" => trim($this->able_to_buy_quantity),
        ]);
        foreach ($this->imgs as $img) {
            $path = $img->store("", "products");
            $product->imgs()->create([
                "path" => $path
            ]);
        }
        for ($i = 0; $i < count($this->SpecNamesArray); $i++) {
            Specification::create([
                "order" => $this->SpecOrdersArray[$i],
                "name" => $this->SpecNamesArray[$i],
                "desc" => $this->SpecDescsArray[$i],
                "product_id" => $this->product->id,
            ]);
        }
        session()->flash("stored", "تخزين المنتج");
        $this->reset("name", "description", "price", "catigory", "brand", "tag", "imgs", "quantity", "able_to_buy_quantity", "SpecNamesArray", "SpecDescsArray", "SpecName", "SpecDesc", "SpecOrdersArray", "SpecOrder");
    }
    public function resetValues()
    {
        $this->reset("name", "description", "price", "catigory", "brand", "tag", "imgs", "quantity", "able_to_buy_quantity", "SpecNamesArray", "SpecDescsArray", "SpecName", "SpecDesc", "SpecOrdersArray", "SpecOrder");
    }
    public function render()
    {
        return view('livewire.admin.products.add-product');
    }
}
