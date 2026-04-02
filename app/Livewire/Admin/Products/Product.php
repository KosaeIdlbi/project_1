<?php

namespace App\Livewire\Admin\Products;

use App\Models\Catigory;
use App\Models\Img;
use App\Models\Product as ModelsProduct;
use App\Models\Specification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Product extends Component
{

    use WithFileUploads;

    public $SpecOrder;
    public $SpecOrdersArray = [];
    public $SpecName;
    public $SpecNamesArray = [];
    public $SpecDesc;
    public $SpecDescsArray = [];
    public $name;
    public $description;
    public $price;
    public $catigory;
    public $catigories;
    public $tag;
    public $tags;
    public $brand;
    public $brands;
    public $imgs = [];
    public $product;
    public $quantity;
    public $able_to_buy_quantity;
    public $show = "default";
    public $offer_price;
    public $offer_ends_at_date;
    public $offer_ends_at_time;
    public $set_date = false;
    protected $listeners = ["refresh"];
    public function mount()
    {
        $this->setValues();
    }
    public function setValues()
    {
        $this->name = $this->product->name;
        $this->description = $this->product->desc;
        $this->price = $this->product->price;
        $this->catigory = $this->product->catigory->id;
        $this->tag = $this->product->tag->id;
        $this->brand = $this->product->brand->id;
        $this->quantity = $this->product->quantity;
        $this->able_to_buy_quantity = $this->product->able_to_buy_quantity;
        $this->offer_price = $this->product->offer_price;
        $this->SpecNamesArray = $this->product->specifications->pluck("name")->toArray();
        $this->SpecDescsArray = $this->product->specifications->pluck("desc")->toArray();
        $this->SpecOrdersArray = $this->product->specifications->pluck("order")->toArray();
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

    public function edit()
    {
        $this->show = "ableToEdit";
    }
    public function remove()
    {
        $this->show = "ableToRemove";
    }
    public function updatedimgs()
    {
        $this->validate([
            'imgs'   => "max:5",
            'imgs.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:1024',
        ]);
    }
    public function update()
    {
        if ($this->name == $this->product->name) {
            $this->validate([
                "name" => "required|string|max:255",
                "price" => "required|numeric",
                "catigory" => "required",
                "brand" => "required",
                "tag" => "required",
                "quantity" => "required|numeric",
                "able_to_buy_quantity" => "required|numeric",
                'imgs'   => "max:5",
                'imgs.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:1024',
            ]);
        } else {
            $this->validate([
                "name" => "required|string|max:255|unique:products,name",
                "price" => "required|numeric",
                "catigory" => "required",
                "brand" => "required",
                "tag" => "required",
                "quantity" => "required|numeric",
                "able_to_buy_quantity" => "required|numeric",
                'imgs'   => "max:5",
                'imgs.*' => 'mimetypes:image/jpg,image/jpeg,image/png|max:1024',
            ]);
        }

        $this->product->update([
            "name" => $this->name,
            "desc" => $this->description,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "able_to_buy_quantity" => $this->able_to_buy_quantity,
            "catigory_id" => $this->catigory,
            "tag_id" => $this->tag,
            "brand_id" => $this->brand,
        ]);
        if ($this->imgs) {
            foreach ($this->product->imgs as $img) {
                Storage::disk('products')->delete($img->path);
            }
            $this->product->imgs()->delete();
            foreach ($this->imgs as $img) {
                $path = $img->store("", "products");
                $this->product->imgs()->create([
                    "path" => $path
                ]);
            }
        }
        foreach ($this->product->specifications as $specification) {
            $specification->delete();
        }
        for ($i = 0; $i < count($this->SpecNamesArray); $i++) {
            Specification::create([
                "order" => $this->SpecOrdersArray[$i],
                "name" => $this->SpecNamesArray[$i],
                "desc" => $this->SpecDescsArray[$i],
                "product_id" => $this->product->id,
            ]);
        }

        $this->product = ModelsProduct::find($this->product->id);
        $this->show = "default";
        session()->flash("updated", "تحديث المنتج");
    }
    public function cancel()
    {
        $this->show = "default";
        $this->reset("imgs");
        $this->setValues();
        $this->resetErrorBag();
    }
    public function available()
    {
        $this->product->update([
            "available" => 1,
        ]);
    }
    public function unavailable()
    {
        $this->product->update([
            "available" => 0,
        ]);
    }
    public function special()
    {
        $this->product->update([
            "special" => 1,
        ]);
    }
    public function notSpecial()
    {
        $this->product->update([
            "special" => 0,
        ]);
    }
    public function offer()
    {
        $this->show = "offer";
    }
    public function submitOffer()
    {
        if ($this->set_date) {
            $this->validate([
                "offer_price" => "required|numeric",
                "offer_ends_at_date" => "required|date",
                "offer_ends_at_time" => "required",
            ]);

            $date = Carbon::parse($this->offer_ends_at_date, Auth::guard("admin")->user()->timezone);
            $time = Carbon::parse($this->offer_ends_at_time);
            $offer_ends_at = $date->addMinutes($time->minute)->addHours($time->hour)->setTimezone("UTC"); //UTC ننقص ثلاث ساعات لنخزن بتوقيت 
            $this->product->update([
                "offer_price" => $this->offer_price,
                "offer_ends_at" => $offer_ends_at,
                "has_offer" => 1,
            ]);
        } else {
            $this->validate([
                "offer_price" => "required|numeric",
            ]);
            $this->product->update([
                "offer_price" => $this->offer_price,
                "offer_ends_at" => null,
                "has_offer" => 1,
            ]);
        }
        $this->product = ModelsProduct::find($this->product->id);
        $this->show = "default";
    }
    public function deleteOffer()
    {
        $this->product->update([
            "offer_price" => null,
            "offer_ends_at" => null,
            "has_offer" => 0,
        ]);
        $this->product = ModelsProduct::find($this->product->id);
        $this->show = "default";
    }
    public function destroy()
    {
        foreach ($this->product->imgs as $img) {
            Storage::disk('products')->delete($img->path);
        }
        $this->product->imgs()->delete();
        $this->product->delete();
        $this->show = "deleted";
        session()->flash("deleted", "حذف المنتج");
        $this->dispatch("refresh");
    }
    public function render()
    {
        return view('livewire.admin.products.product');
    }
}
