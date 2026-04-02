    <!-- =========================== -->
    <!-- قسم العناصر المميزة -->
    <!-- =========================== -->

    <!-- حاوية واحدة مع الـ ID والـ Margin للتمرير -->
    <div class="container py-5" id="special" style="scroll-margin-top: 100px;">

        <!-- رأس القسم -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- العنوان وزر عرض المزيد -->
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-bold mb-0">عناصر مميزة</h2>
                <a href={{ route('user.ViewProducts', [
                    'CatigoryName' => 'all',
                    'BrandName' => 'all',
                    'TagName' => 'all',
                    'ProductName' => 'none',
                    'Newests' => 'none',
                    'Offers' => 'none',
                    'Special' => 1,
                ]) }}
                    class="btn btn-outline-primary btn-sm rounded-pill px-3">
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

            @foreach ($specials as $special)
                @livewire('user.products.specials.section-item', ['product' => $special, 'user' => $user], key($special->id))
            @endforeach

        </div>
    </div>
