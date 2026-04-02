<?php

namespace App\Livewire\User\Products\Cart;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;


class ViewCart extends Component
{
    public $sub_total; //السعر الكلي قبل اضافة الكوبونات
    public $delivery = 0;
    public $coupon = [];
    public $product_ids = [];
    public $product_name = [];
    public $single_price = [];
    public $quantity = [];
    public $total_price = [];
    public $order_price = 0;
    public $show = "";
    public $address;
    public $phone;
    public $notes;
    protected $listeners = ["calcSubTotal", "getCartItemData", "refresh", "showBill"];
    public $user;
    public function calcSubTotal($price, $ope)
    {
        if ($ope == "add") {
            $this->sub_total += $price;
            $this->order_price = $this->delivery + $this->sub_total;
        } elseif ($ope == "sub") {
            $this->sub_total -= $price;
            $this->order_price = $this->delivery + $this->sub_total;
        }
    }
    #[Renderless]
    public function prepareBill()
    {
        $this->reset("product_name", "single_price", "quantity", "total_price", "order_price");
        $this->dispatch("sendCartItemData");
    }
    #[Renderless]
    public function getCartItemData($id, $quantity)
    {
        $product = Product::find($id);
        if ($product) {
            $this->product_ids[] = $id;
            $this->product_name[] = $product->name;
            $this->quantity[] = $quantity;
            if ($product->has_offer) {
                $this->single_price[] = $product->offer_price;
                $this->total_price[] = $product->offer_price * $quantity;
                $this->order_price += $product->offer_price * $quantity;
            } else {
                $this->single_price[] = $product->price;
                $this->total_price[] = $product->price * $quantity;
                $this->order_price += $product->price * $quantity;
            }
            if ($this->coupon) {
                $this->order_price =  $this->order_price - $this->coupon["discountValue"];
            }
            if ($this->cart_items->count() == count($this->product_ids)) {
                $this->dispatch("showBill");
            }
        } else {
            $this->show = "faild";
        }
    }
    public function showBill()
    {
        if ($this->user->balance < $this->order_price) {
            redirect()->route("user.cart")->with("balance_dont_enough", "الرصيد غير كافي الرجاء تعبئة المحفظة");
        } elseif ($this->user->balance >= $this->order_price) {
            $this->show = "bill";
        }
    }
    public function closeBill()
    {
        Redirect()->route("user.cart"); //لجلب التحديثات لو حصلت في المنتجات وعرضها في السلة
    }
    public function buy()
    {
        $this->validate([
            "address" => "required",
            "phone" => "required|numeric|digits:10",
        ], [
            "address.required" => "يرجى تحديد العنوان",
            "phone.required" => "يرجى ادخال رقم الهاتف",
            "phone.numeric" => "رقم الهاتف يجب ان يكون رقما",
            "phone.digits" => "احرص ان يكون رقم الهاتف من عشرة ارقام ",
        ]);

        for ($i = 0; $i < count($this->product_ids); $i++) {
            $product = Product::find($this->product_ids[$i]);
            if ($product) {
                //احتمال تأخر وصول الحدث
                if (
                    $this->user->balance >= $this->order_price &&
                    $this->quantity[$i] <= $product->quantity &&
                    $product->available &&
                    $product->quantity > 0 &&
                    $product->tag->available &&
                    $product->catigory->available &&
                    $product->brand->available &&
                    !$product->deleted_at
                ) {
                    if ($product->quantity - $this->quantity[$i] == 0) {
                        $product->update([ //اذا اشترى كل الكمية اطلق الحدث لتحديث الواجهة
                            "quantity" => $product->quantity - $this->quantity[$i]
                        ]);
                    } else {
                        $product->updateQuietly([ //حتى لا نرسل احداث وتتحدث الواجهة عند المستخدم مع كل عملية شراء
                            "quantity" => $product->quantity - $this->quantity[$i]
                        ]);
                    }
                } else {
                    $this->show = "faild";
                    return 0;
                }
            } else {
                $this->show = "faild";
                return 0;
            }
        }
        $order = Order::create([
            "user_id" => $this->user->id,
            "product_name" => $this->product_name,
            "single_price" => $this->single_price,
            "quantity" => $this->quantity,
            "total_price" => $this->total_price,
            "sub_total" => $this->sub_total,
            "order_price" => $this->order_price,
            "address" => $this->address,
            "phone" => $this->phone,
            "notes" => $this->notes,
            "coupon" => $this->coupon,
        ]);
        $this->user->update(["balance" => $this->user->balance - $this->order_price]);
        $this->show = "success";
    }
    #[Computed()]
    public function cart_items()
    {
        return Product::with(["imgs", "cartItems"])->whereHas("cartItems", function ($query) {
            $query->where("user_id", $this->user->id)->orderBy("created_at", "desc");
        })->get();
    }
    public function clearCart()
    {
        foreach ($this->cart_items as $cart_item) {
            $cart_item->cartItems()->delete();
        }
        $this->dispatch("refresh");
        $this->dispatch("clearCartButton");
    }
    public $code;
    public $updated_code = false;
    public function updatedCode()
    {
        $this->updated_code = true;
    }
    public function useCoupon()
    {
        if ($this->code) {
            $this->validate(["code" => "string"]);
        }
        $coupon = Coupon::where("code", $this->code)->first();
        $this->order_price = $this->sub_total; //قبل حساب الكوبون الجديد اعادة تعيين لقيمة الاوردر
        if ($coupon) {
            $isNotExpire = now()->lessThanOrEqualTo($coupon->expire_at);
            if ($isNotExpire) {
                if (!$this->coupon || $this->updated_code) {
                    //  حساب قيمة الخصم
                    $discountValue = ($coupon->discount * $this->order_price) / 100;
                    //  السعر بعد الخصم
                    $finalPrice = $this->order_price - $discountValue;
                    $this->order_price = $finalPrice;
                    $this->coupon["discountValue"] = $discountValue;
                    $this->coupon["discountPercentage"] = $coupon->discount;
                }
                session()->flash("coupon_details", "تم تطبيق الكوبون وخصم" . " % " . $coupon->discount . " من قيمة الفاتورة ");
            } else {
                session()->flash("coupon_unavailable", "هذا الكوبون غير متوفر");
            }
        } else {
            session()->flash("coupon_unavailable", "هذا الكوبون غير متوفر");
        }
    }
    public function refresh()
    {
        $this->show = "";
    }
    public function render()
    {
        return view('livewire.user.products.cart.view-cart', ["cart_items" => $this->cart_items]);
    }
}
