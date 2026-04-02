<div class="card-scroll-item">
    {{-- <div wire:poll.1s></div> --}}
    @if (!$product->deleted_at && !$product->special && !$product->has_offer && !$product->is_newest)
        <div class="product-card h-100">

            <!-- زر المفضلة العائم (على اليسار - دائري) -->
            @if ($IsFavItem)
                <button wire:click.prevent='removeFromFav' wire:loading.attr='disabled'
                    class="btn-fav-active position-absolute top-0 start-0 m-2 rounded-circle">
                    <i class="bi bi-heart-fill"></i>
                </button>
            @else
                <button wire:click.prevent='addToFav' wire:loading.attr='disabled'
                    class="btn-fav-inactive position-absolute top-0 start-0 m-2 rounded-circle">
                    <i class="bi bi-heart"></i>
                </button>
            @endif
            <!-- الصورة -->
            <a href={{ route('user.product', ['type' => 'normal', 'id' => $product->id]) }} class="card-img-wrapper">
                @if ($product->imgs->isNotEmpty())
                    <img src={{ asset('products/imgs/' . $product->imgs[0]->path) }} class="card-img-top"
                        alt="New Product">
                @endif
            </a>

            <!-- التفاصيل -->
            <div class="card-body">
                <div class="mb-2 d-flex gap-1 flex-wrap">
                </div>
                <a href={{ route('user.product', ['type' => 'normal', 'id' => $product->id]) }}
                    class="product-title">{{ $product->name }}</a>
                <div class="product-price">{{ $product->price }} ل.س</div>

                @if (
                    $product->available &&
                        $product->quantity > 0 &&
                        $product->tag->available &&
                        $product->catigory->available &&
                        $product->brand->available)
                    @if ($IsCartItem)
                        <button wire:click.prevent='removeFromCart' wire:loading.attr='disabled'
                            class="btn btn-primary btn-add-cart opacity-75">
                            ازالة من السلة&nbsp;<i class="bi bi-cart-plus me-2"></i>
                        </button>
                    @else
                        <button wire:click.prevent='addToCart' wire:loading.attr='disabled'
                            class="btn btn-primary btn-add-cart">
                            إضافة للسلة&nbsp;<i class="bi bi-cart-plus me-2"></i>
                        </button>
                    @endif
                @else
                    <div class="stock-info-section">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom">
                            <span class="fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;">حالة
                                التوفر:</span>
                            <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> غير
                                متوفر</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
