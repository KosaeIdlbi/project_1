    <!-- بداية قسم العناصر الجديدة -->
    <div class="container py-5" style="scroll-margin-top: 100px;" id="offers">

        <!-- هنا باقي كود القسم ... -->



        <!-- =========================== -->
        <!-- قسم العروض الخاصة -->
        <!-- =========================== -->
        <div class="container py-5">

            <!-- رأس القسم -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <h2 class="fw-bold mb-1 text-danger">عروض خاصة</h2>
                    <!-- زر عرض المزيد -->
                    <a href={{ route('user.ViewProducts', [
                        'CatigoryName' => 'all',
                        'BrandName' => 'all',
                        'TagName' => 'all',
                        'ProductName' => 'none',
                        'Newests' => 'none',
                        'Offers' => 1,
                        'Special' => 'none',
                    ]) }}
                        class="btn btn-outline-danger btn-sm rounded-pill px-3">
                        عرض المزيد
                    </a>
                </div>

                <!-- أزرار التحكم بالأسهم (الاتجاه المصحح) -->
                <div class="d-flex gap-2">
                    <!-- السهم الأيمن -->
                    <button class="btn btn-light rounded-circle shadow-sm border"
                        onclick="scrollContainer('offers-container', 'right')">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                    <!-- السهم الأيسر -->
                    <button class="btn btn-light rounded-circle shadow-sm border"
                        onclick="scrollContainer('offers-container', 'left')">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- الشريط المتحرك -->
            <div id="offers-container" class="scrolling-wrapper-flexbox">

                @foreach ($offers as $offer)
                    @livewire('user.products.offers.section-item', ['product' => $offer, 'user' => $user], key($offer->id))
                @endforeach
            </div>
        </div>
    </div>
