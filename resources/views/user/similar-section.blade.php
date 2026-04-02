<div class="container py-5" id="special" style="scroll-margin-top: 100px;">
    <hr>
    <!-- رأس القسم -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- العنوان وزر عرض المزيد -->
        <div class="d-flex align-items-center gap-3">
            <h2 class="fw-bold mb-0">عناصر مشابهة</h2>
            <a href={{ route('user.ViewProducts', [
                'CatigoryName' => 'all',
                'BrandName' => 'all',
                'TagName' => $product->tag->name,
                'ProductName' => 'none',
                'Newests' => 'none',
                'Offers' => 'none',
                'Special' => 'none',
            ]) }}
                class="btn btn-outline-dark btn-sm rounded-pill px-3">
                عرض المزيد
            </a>
        </div>

        <!-- أزرار التحكم بالأسهم -->
        <div class="d-flex gap-2">
            <button class="btn btn-light rounded-circle shadow-sm"
                onclick="scrollContainer('featured-container', 'right')">
                <i class="bi bi-arrow-right"></i>
            </button>
            <button class="btn btn-light rounded-circle shadow-sm"
                onclick="scrollContainer('featured-container', 'left')">
                <i class="bi bi-arrow-left"></i>
            </button>
        </div>
    </div>

    <!-- حاوية الشريط المتحرك -->
    <div id="featured-container" class="scrolling-wrapper-flexbox">

        @foreach ($similar_products as $item)
            @if ($item->has_offer)
                @livewire('user.products.offers.section-item', ['product' => $item, 'user' => $user], key($item->id))
            @else
                @if ($item->special && !$item->has_offer)
                    @livewire('user.products.specials.section-item', ['product' => $item, 'user' => $user], key($item->id))
                @else
                    @if (!$item->special && !$item->has_offer && $item->is_newest)
                        @livewire('user.products.newest.section-item', ['product' => $item, 'user' => $user], key($item->id))
                    @else
                        @if (!$item->special && !$item->has_offer && !$item->is_newest)
                            @livewire('user.products.normal.section-item', ['product' => $item, 'user' => $user], key($item->id))
                        @endif
                    @endif
                @endif
            @endif
        @endforeach
    </div>
</div>
