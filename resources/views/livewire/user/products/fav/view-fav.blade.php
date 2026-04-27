<div>
    <div class="container py-5">
        <!-- عنوان الصفحة -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-4">
            <div>
                <h2 class="fw-bold mb-1">عناصر المفضلة</h2>
            </div>
            <button wire:click.prevent='clearFav' class="btn btn-outline-danger btn-sm rounded-pill px-4">
                <i class="bi bi-trash me-1"></i> إفراغ القائمة
            </button>
        </div>

        <!-- شبكة المنتجات -->
        <div class="row g-4">
            @foreach ($fav_items as $item)
                @if ($item->has_offer)
                    @livewire('user.products.offers.section-item', ['product' => $item, 'user' => $user, 'lazy' => true], key($item->id))
                @else
                    @if ($item->special && !$item->has_offer)
                        @livewire('user.products.specials.section-item', ['product' => $item, 'user' => $user, 'lazy' => true], key($item->id))
                    @else
                        @if (!$item->special && !$item->has_offer && $item->is_newest)
                            @livewire('user.products.newest.section-item', ['product' => $item, 'user' => $user, 'lazy' => true], key($item->id))
                        @else
                            @if (!$item->special && !$item->has_offer && !$item->is_newest)
                                @livewire('user.products.normal.section-item', ['product' => $item, 'user' => $user, 'lazy' => true], key($item->id))
                            @endif
                        @endif
                    @endif
                @endif
            @endforeach
        </div>
        <div dir="ltr">
            <br>
            {{ $fav_items->links() }}
        </div>

        @if ($fav_items->IsEmpty())
            <!-- رسالة إذا كانت القائمة فارغة (مخفية حالياً) -->
            <div class="text-center py-5">
                <i class="bi bi-heart text-muted display-1"></i>
                <h4 class="mt-3 text-muted">قائمتك المفضلة فارغة</h4>
                <a href={{ route('user.home') }} class="btn btn-primary mt-3">تصفح المنتجات</a>
            </div>
        @endif
    </div>
</div>
