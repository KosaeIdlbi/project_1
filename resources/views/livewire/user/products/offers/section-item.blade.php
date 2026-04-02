<div class="card-scroll-item">
    {{-- <div wire:poll.1s></div> --}}
    @if (!$product->deleted_at && $product->has_offer)
        <div class="product-card border-danger border-opacity-10 h-100">
            <span class="badge-featured bg-danger text-white">
                <i class="bi bi-percent me-1"></i>
                {{ ceil((($product->price - $product->offer_price) / $product->price) * 100) }}%
            </span>

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
            <a href={{ route('user.product', ['type' => 'offer', 'id' => $product->id]) }} class="card-img-wrapper">
                @if ($product->imgs->isNotEmpty())
                    <img src={{ asset('products/imgs/' . $product->imgs[0]->path) }} class="card-img-top"
                        alt="New Product">
                @endif

            </a>
            <div class="card-body">
                <div class="mb-2 d-flex gap-2 align-items-center">

                    @if ($product->special)
                        <!-- شارة المميز (أيقونة جوهرة) -->
                        <span class="badge bg-dark text-warning" style="font-size: 0.7rem; padding: 6px 12px;">
                            <i class="bi bi-gem me-1"></i> مميز
                        </span>
                    @endif

                    @if ($product->is_newest)
                        <!-- شارة جديد (أيقونة فلاش) -->
                        <span class="badge bg-success text-white" style="font-size: 0.7rem; padding: 6px 12px;">
                            <i class="bi bi-lightning-charge-fill me-1"></i> جديد
                        </span>
                    @endif

                </div>
                <a href={{ route('user.product', ['type' => 'offer', 'id' => $product->id]) }} class="product-title">
                    {{ $product->name }} </a>
                <div class="mb-2">
                    <span class="product-price text-danger">{{ $product->offer_price }} ل.س</span>
                    <span class="text-muted text-decoration-line-through ms-2 small">{{ $product->price }}
                        ل.س</span>
                </div>
                @if ($product->offer_ends_at)
                    @livewire('user.products.offers.offer-count-down', ['offer_ends_at' => $product->offer_ends_at, 'product_id' => $product->id])
                @endif
                @if (
                    $product->available &&
                        $product->quantity > 0 &&
                        $product->tag->available &&
                        $product->catigory->available &&
                        $product->brand->available)
                    @if ($IsCartItem)
                        <button wire:click.prevent='removeFromCart' wire:loading.attr='disabled'
                            class="btn btn-danger btn-add-cart opacity-75">
                            ازالة من السلة&nbsp;<i class="bi bi-cart-plus me-2"></i>
                        </button>
                    @else
                        <button wire:click.prevent='addToCart' wire:loading.attr='disabled'
                            class="btn btn-danger btn-add-cart">
                            إضافة للسلة&nbsp;<i class="bi bi-cart-plus me-2"></i>
                        </button>
                    @endif
                @else
                    <div class="stock-info-section">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom">
                            <span class="fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;">حالة
                                التوفر:</span>
                            <h6><span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> غير
                                    متوفر</span></h6>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endif
</div>
