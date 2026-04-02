<?php

namespace App\Livewire\User\Products;

use App\Models\Product;
use Livewire\Component;

class HomeSearch extends Component
{
    public $search = '';
    public $results = [];
    //تصفية المنتجات حسب الاسم
    public function updatedSearch()
    {
        // جلب فقط النتائج المطابقة، وعدد محدود!
        $this->results = Product::where('name', 'LIKE', '%' . $this->search . '%')
            ->take(10) // حد أقصى 10 نتائج
            ->get("name", "id");
    }
    public function render()
    {
        return view('livewire.user.products.home-search');
    }
}
