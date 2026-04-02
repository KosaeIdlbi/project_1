<div>
    <div class="container pb-5">

        @if ($cart_items->isEmpty())
            <!-- رسالة إذا كانت السلة فارغة -->
            <div class="text-center py-5">
                <!-- أيقونة السلة الفارغة -->
                <i class="bi bi-cart-x text-muted display-1"></i>

                <h4 class="mt-3 text-muted fw-bold">سلة المشتريات فارغة</h4>
                <p class="text-muted small">ابدأ بإضافة بعض المنتجات الرائعة إلى سلتك</p>

                <a href={{ route('user.home') }} class="btn btn-primary rounded-pill px-5 py-3 mt-3">
                    <i class="bi bi-bag me-2"></i> تصفح المنتجات
                </a>
            </div>
        @else
            <div class="row g-4">

                <!-- القسم الأيمن: قائمة العناصر -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold mb-0">سلة المشتريات </h4>
                        <button wire:click.prevent='clearCart'
                            class="btn btn-link text-danger text-decoration-none p-0 small">إفراغ السلة</button>
                    </div>
                    @foreach ($cart_items as $cart_item)
                        @livewire('user.products.cart.cart-item', ['cart_item' => $cart_item], key($cart_item->id))
                    @endforeach

                </div>
                <!-- القسم الأيسر: ملخص الطلب -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h5 class="fw-bold mb-4">ملخص الطلب</h5>

                        <div class="summary-row">
                            <span>المجموع الفرعي</span>
                            <span>{{ $sub_total }} ل.س</span>
                        </div>

                        <div class="summary-row">
                            <span>الشحن</span>
                            <span class="text-success">مجاني</span>
                        </div>

                        <!-- كود الخصم -->
                        <div class="mt-3 mb-3">
                            <label class="form-label small fw-bold text-muted">هل لديك كوبون؟</label>
                            <div class="input-group">
                                <input wire:model='code' type="text" class="form-control"
                                    placeholder="أدخل الكود هنا">
                                <button wire:click.prevent='useCoupon' class="btn btn-outline-secondary">تطبيق</button>
                            </div>
                            <div class="form-text" style="color: green">
                                <x-redirect-message name="coupon_details"></x-redirect-message>
                            </div>
                            <div class="form-text" style="color: red">
                                <x-redirect-message name="coupon_unavailable"></x-redirect-message>
                            </div>
                        </div>

                        <div class="total-row">
                            <span>الإجمالي</span>
                            <span class="text-primary">{{ $order_price }} ل.س</span>
                        </div>

                        <button wire:click='prepareBill' wire:loading.attr='disabled'
                            class="btn btn-primary w-100 py-3 rounded-pill fw-bold mt-3 shadow-sm">
                            إتمام الشراء
                        </button>
                        <div style="color: red">
                            @if (session('balance_dont_enough'))
                                {{ session('balance_dont_enough') }}<br>
                            @endif
                        </div>
                        <div class="text-center mt-3">
                            <a href={{ route('user.home') }} class="text-decoration-none small text-muted">
                                <i class="bi bi-arrow-right me-1"></i> متابعة التسوق
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($show == 'bill')
            <style>
                body {
                    overflow: hidden;
                    /* لمنع التمرير في الخلفية */
                }
            </style>
            <!-- النافذة العائمة للدفع -->
            <div class="checkout-overlay">
                <div class="checkout-container">

                    <!-- رأس النافذة -->
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-white">
                        <h5 class="fw-bold mb-0"><i class="bi bi-receipt me-2 text-primary"></i>فاتورة الطلب</h5>
                        <button class="btn btn-close" aria-label="Close" wire:click.prevent='closeBill'></button>
                    </div>

                    <!-- منطقة المحتوى القابلة للتمرير -->
                    <div class="checkout-scroll-area">

                        <div class="row g-4">
                            <!-- القسم الأيمن: الفاتورة -->
                            <div class="col-lg-7">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-0">
                                        <table class="table table-borderless invoice-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="ps-3">المنتج</th>
                                                    <th class="text-center">الكمية</th>
                                                    <th class="text-end pe-3">السعر</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- منتج 1 -->
                                                @for ($i = 0; $i < count($product_ids); $i++)
                                                    <tr>
                                                        <td class="ps-3">
                                                            <div class="fw-bold text-dark">{{ $product_name[$i] }}</div>
                                                            <div class="text-muted small">{{ $single_price[$i] }}ل.س
                                                            </div>
                                                        </td>
                                                        <td class="text-center">{{ $quantity[$i] }}</td>
                                                        <td class="text-end pe-3 fw-bold text-primary">
                                                            {{ $total_price[$i] }} ل.س</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- خلاصة الحساب -->
                                <div class="mt-4 p-3 bg-white rounded shadow-sm">
                                    <div class="summary-row">
                                        <span>المجموع الفرعي</span>
                                        <span>{{ $sub_total }} ل.س</span>
                                    </div>
                                    @if ($coupon)
                                        <div class="summary-row text-success">
                                            <span>خصم الكوبون (% SAVE {{ $coupon['discountPercentage'] }} )</span>
                                            <span>- {{ $coupon['discountValue'] }} ل.س</span>
                                        </div>
                                    @endif
                                    <div class="summary-row">
                                        <span>رسوم التوصيل</span>
                                        <span>{{ $delivery }} ل.س</span>
                                    </div>
                                    <div class="total-row text-primary">
                                        <span>الإجمالي النهائي</span>
                                        <span>{{ $order_price }} ل.س</span>
                                    </div>
                                </div>
                            </div>

                            <!-- القسم الأيسر: الموقع والتوصيل -->
                            <div class="col-lg-5">
                                <h6 class="fw-bold mb-3">تفاصيل التوصيل</h6>

                                <!-- 1. خرائط جوجل -->
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">تحديد الموقع على الخريطة</label>
                                    <div
                                        class="map-container d-flex align-items-center justify-content-center text-muted">
                                        <!-- هنا تضيف كود Google Maps Embed أو API -->
                                        <div class="text-center">
                                            <i class="bi bi-geo-alt-fill fs-1 mb-2 d-block"></i>
                                            <span>خريطة جوجل (Map Placeholder)</span>
                                        </div>
                                    </div>
                                    <input wire:model='address' type="text" class="form-control mt-2"
                                        placeholder="العنوان التفصيلي (المنطقة، الشارع...)">
                                </div>
                                <div class="form-text" style="color: red"><x-input-error
                                        input="address"></x-input-error></div>
                                <!-- 2. رقم الهاتف -->
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">رقم الهاتف</label>
                                    <div class="input-group">

                                        <input wire:model='phone' type="tel" class="form-control"
                                            placeholder="09xxxxxxxx"><span class="input-group-text">سوريا</span>

                                    </div>
                                    <div class="form-text" style="color: red"><x-input-error
                                            input="phone"></x-input-error></div>
                                    <div class="form-text">سيتم إرسال رسالة SMS لتأكيد الطلب.</div>
                                </div>

                                <!-- 3. ملاحظات -->
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">ملاحظات (اختياري)</label>
                                    <textarea wire:model='notes' class="form-control" rows="2" placeholder="أي تفاصيل إضافية للتوصيل..."></textarea>
                                </div>
                                <div class="form-text" style="color: red"><x-input-error
                                        input="notes"></x-input-error>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- تذييل النافذة (زر الدفع) -->
                    <div class="checkout-footer">
                        <div class="text-muted small">
                            <i class="bi bi-shield-check text-success me-1"></i>
                            دفع آمن ومشفر 100%
                        </div>
                        <button wire:click.prevent='buy' class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                            <i class="bi bi-credit-card me-2"></i> تأكيد الدفع
                        </button>
                    </div>

                </div>
            </div>
        @endif

        @if ($show == 'success')
            <!-- رسالة النجاح العائمة -->
            <div class="success-overlay">
                <div class="success-card">

                    <!-- دائلة علامة الصح المتحركة -->
                    <div class="success-icon-wrapper">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <h2 class="fw-bold mb-2 text-dark">تمت عملية الشراء بنجاح!</h2>
                    <p class="text-muted mb-4">
                        شكراً لك. تم خصم مبلغ <strong>{{ $order_price }} ر.س</strong> من حسابك بنجاح.<br>
                        سيتم توصيل طلبك في أقرب وقت ممكن.
                    </p>

                    <!-- زر الانتقال للطلبات -->
                    <a href={{ route('user.orders') }}
                        class="btn btn-primary btn-lg rounded-pill w-100 fw-bold shadow-sm">
                        <i class="bi bi-bag-check me-2"></i> متابعة الطلب
                    </a>

                    <a href={{ route('user.home') }} class="btn btn-link text-decoration-none mt-3 text-muted small">
                        العودة للرئيسية
                    </a>

                </div>
            </div>
        @endif
        @if ($show == 'faild')
            <!-- رسالة الفشل العائمة -->
            <div class="fail-overlay">
                <div class="fail-card">

                    <!-- دائلة علامة X -->
                    <div class="fail-icon-wrapper">
                        <i class="bi bi-x-lg"></i>
                    </div>

                    <h2 class="fw-bold mb-2 text-dark">فشلت عملية الشراء</h2>
                    <p class="text-muted mb-4">
                        عذراً، لم تتم عملية الشراء بسبب <strong>نفاذ الكمية</strong> أو أن المنتج <strong>لم يعد
                            متوفراً</strong>.<br>
                        يرجى مراجعة سلة المشتريات والمحاولة مرة أخرى.
                    </p>

                    <!-- زر العودة للسلة -->
                    <a href={{ route('user.cart') }}
                        class="btn btn-danger btn-lg rounded-pill w-100 fw-bold shadow-sm">
                        <i class="bi bi-cart-x me-2"></i> مراجعة السلة
                    </a>

                    <a href={{ route('user.home') }} class="btn btn-link text-decoration-none mt-3 text-muted small">
                        العودة للرئيسية
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
