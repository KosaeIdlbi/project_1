<div class="container py-5" style="scroll-margin-top: 100px;" id="newest">

    <!-- =========================== -->
    <!-- قسم العناصر الجديدة (New Arrivals) -->
    <!-- =========================== -->
    <div class="container py-5">

        <!-- رأس القسم -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- العنوان وزر عرض المزيد -->
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-bold mb-1 text-success">وصل حديثاً</h2>
                <a href={{ route('user.ViewProducts', [
                    'CatigoryName' => 'all',
                    'BrandName' => 'all',
                    'TagName' => 'all',
                    'ProductName' => 'none',
                    'Newests' => 1,
                    'Offers' => 'none',
                    'Special' => 'none',
                ]) }}
                    class="btn btn-outline-success btn-sm rounded-pill px-3">
                    عرض المزيد
                </a>
            </div>

            <!-- أزرار التحكم بالأسهم -->
            <div class="d-flex gap-2">
                <!-- السهم الأيمن -->
                <button class="btn btn-light rounded-circle shadow-sm"
                    onclick="scrollContainer('new-arrivals-container', 'right')">
                    <i class="bi bi-arrow-right"></i>
                </button>
                <!-- السهم الأيسر -->
                <button class="btn btn-light rounded-circle shadow-sm"
                    onclick="scrollContainer('new-arrivals-container', 'left')">
                    <i class="bi bi-arrow-left"></i>
                </button>
            </div>
        </div>

        <!-- حاوية الشريط المتحرك -->
        <div id="new-arrivals-container" class="scrolling-wrapper-flexbox">

            <!-- منتج جديد 1 -->
            @foreach ($newests as $newest)
                @livewire('user.products.newest.section-item', ['product' => $newest, 'user' => $user], key($newest->id))
            @endforeach

        </div>
    </div>
</div>
