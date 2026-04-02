<div>
    @switch($order->order_status)
        @case('waiting')
            <div class="order-card">

                <!-- رأس الطلب (كله قابل للضغط) -->
                <div class="order-header cursor-pointer" onclick="toggleOrderDetails(this)">
                    <div>
                        <div class="order-id">#ORD-{{ $order->id }}</div>
                        <div class="order-date"><i
                                class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('Y/m/d h:i a') }}</div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <span class="status-badge status-pending"><i class="bi bi-hourglass-split me-1"></i>&nbsp;
                            بإنتظار إستلام الطلب</span>
                        <!-- السهم (مجرد مؤشر visual، يمكن إزالة الزر button إذا أردت) -->
                        <div class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-chevron-down transition-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- محتوى الفاتورة (يظهر ويخفي) -->
                <div class="order-details-content collapse show">
                    <div class="p-3">

                        <!-- جدول منتجات الفاتورة -->
                        <div class="table-responsive mb-3">
                            <table class="table table-borderless table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-2 small text-muted">المنتج</th>
                                        <th class="text-end small text-muted pe-3">السعر الفردي</th>
                                        <th class="text-center small text-muted">الكمية</th>
                                        <th class="text-end pe-2 small text-muted">الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($order->product_name); $i++)
                                        <tr>
                                            <td class="ps-2">
                                                <div class="fw-bold text-dark small">{{ $order->product_name[$i] }}</div>
                                            </td>
                                            <td class="text-end pe-3 text-muted small">{{ $order->single_price[$i] }} ل.س</td>
                                            <td class="text-center small">{{ $order->quantity[$i] }}</td>
                                            <td class="text-end pe-2 small fw-bold text-primary">{{ $order->total_price[$i] }}
                                                ل.س</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">

                        <!-- ملخص الحساب -->
                        <div class="row justify-content-end">
                            <div class="col-md-6 col-lg-5">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">المجموع الفرعي:</span>
                                    <span class="small fw-bold">{{ $order->sub_total }} ل.س</span>
                                </div>
                                @if ($order->coupon && $order->coupon != '[]')
                                    <div class="d-flex justify-content-between mb-1 text-success">
                                        <span class="small">خصم الكوبون (% SAVE {{ $order->coupon['discountPercentage'] }}
                                            )</span>
                                        <span class="small fw-bold">- {{ $order->coupon['discountValue'] }} ل.س</span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">رسوم التوصيل:</span>
                                    <span class="small fw-bold">25 ل.س</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2 pt-2 border-top border-2 border-dark">
                                    <span class="fw-bold text-dark">الإجمالي النهائي:</span>
                                    <span class="fw-bold text-primary fs-5">{{ $order->order_price }} ل.س</span>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">جاري التحقق من طلبك...</div>
                            <button wire:click.prevent='cancelOrder' class="btn btn-outline-danger btn-sm rounded-pill">إلغاء
                                الطلب</button>
                        </div>

                    </div>
                </div>
            </div>
        @break

        @case('received')
            <div class="order-card">

                <!-- رأس الطلب (كله قابل للضغط) -->
                <div class="order-header cursor-pointer" onclick="toggleOrderDetails(this)">
                    <div>
                        <div class="order-id">#ORD-{{ $order->id }}</div>
                        <div class="order-date"><i
                                class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('Y/m/d h:i a') }}</div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <span class="status-badge status-pending"><i class="bi bi-hourglass-split me-1"></i>&nbsp;
                            قيد التحضير</span>
                        <!-- السهم (مجرد مؤشر visual، يمكن إزالة الزر button إذا أردت) -->
                        <div class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-chevron-down transition-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- محتوى الفاتورة (يظهر ويخفي) -->
                <div class="order-details-content collapse show">
                    <div class="p-3">

                        <!-- جدول منتجات الفاتورة -->
                        <div class="table-responsive mb-3">
                            <table class="table table-borderless table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-2 small text-muted">المنتج</th>
                                        <th class="text-end small text-muted pe-3">السعر الفردي</th>
                                        <th class="text-center small text-muted">الكمية</th>
                                        <th class="text-end pe-2 small text-muted">الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($order->product_name); $i++)
                                        <tr>
                                            <td class="ps-2">
                                                <div class="fw-bold text-dark small">{{ $order->product_name[$i] }}</div>
                                            </td>
                                            <td class="text-end pe-3 text-muted small">{{ $order->single_price[$i] }} ل.س</td>
                                            <td class="text-center small">{{ $order->quantity[$i] }}</td>
                                            <td class="text-end pe-2 small fw-bold text-primary">{{ $order->total_price[$i] }}
                                                ل.س</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">

                        <!-- ملخص الحساب -->
                        <div class="row justify-content-end">
                            <div class="col-md-6 col-lg-5">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">المجموع الفرعي:</span>
                                    <span class="small fw-bold">{{ $order->sub_total }} ل.س</span>
                                </div>
                                @if ($order->coupon && $order->coupon != '[]')
                                    <div class="d-flex justify-content-between mb-1 text-success">
                                        <span class="small">خصم الكوبون (% SAVE {{ $order->coupon['discountPercentage'] }}
                                            )</span>
                                        <span class="small fw-bold">- {{ $order->coupon['discountValue'] }} ل.س</span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">رسوم التوصيل:</span>
                                    <span class="small fw-bold">25 ل.س</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2 pt-2 border-top border-2 border-dark">
                                    <span class="fw-bold text-dark">الإجمالي النهائي:</span>
                                    <span class="fw-bold text-primary fs-5">{{ $order->order_price }} ل.س</span>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">جاري تجهيز طلبك...</div>
                        </div>
                    </div>
                </div>
            </div>
        @break

        @case('delivery_in_progress')
            <div class="order-card">

                <!-- رأس الطلب (كله قابل للضغط) -->
                <div class="order-header cursor-pointer" onclick="toggleOrderDetails(this)">
                    <div>
                        <div class="order-id">#ORD-{{ $order->id }}</div>
                        <div class="order-date"><i
                                class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('Y/m/d h:i a') }}</div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <span class="status-badge status-shipped"><i class="bi bi-truck me-1"></i>&nbsp;تم الشحن</span>

                        <!-- السهم (مجرد مؤشر visual، يمكن إزالة الزر button إذا أردت) -->
                        <div class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-chevron-down transition-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- محتوى الفاتورة (يظهر ويخفي) -->
                <div class="order-details-content collapse show">
                    <div class="p-3">

                        <!-- جدول منتجات الفاتورة -->
                        <div class="table-responsive mb-3">
                            <table class="table table-borderless table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-2 small text-muted">المنتج</th>
                                        <th class="text-end small text-muted pe-3">السعر الفردي</th>
                                        <th class="text-center small text-muted">الكمية</th>
                                        <th class="text-end pe-2 small text-muted">الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- منتج 1 -->
                                    @for ($i = 0; $i < count($order->product_name); $i++)
                                        <tr>
                                            <td class="ps-2">
                                                <div class="fw-bold text-dark small">{{ $order->product_name[$i] }}</div>
                                            </td>
                                            <td class="text-end pe-3 text-muted small">{{ $order->single_price[$i] }} ل.س</td>
                                            <td class="text-center small">{{ $order->quantity[$i] }}</td>
                                            <td class="text-end pe-2 small fw-bold text-primary">{{ $order->total_price[$i] }}
                                                ل.س</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">

                        <!-- ملخص الحساب -->
                        <div class="row justify-content-end">
                            <div class="col-md-6 col-lg-5">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">المجموع الفرعي:</span>
                                    <span class="small fw-bold">{{ $order->sub_total }} ل.س</span>
                                </div>
                                @if ($order->coupon && $order->coupon != '[]')
                                    <div class="d-flex justify-content-between mb-1 text-success">
                                        <span class="small">خصم الكوبون (% SAVE {{ $order->coupon['discountPercentage'] }}
                                            )</span>
                                        <span class="small fw-bold">- {{ $order->coupon['discountValue'] }} ل.س</span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">رسوم التوصيل:</span>
                                    <span class="small fw-bold">25 ل.س</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2 pt-2 border-top border-2 border-dark">
                                    <span class="fw-bold text-dark">الإجمالي النهائي:</span>
                                    <span class="fw-bold text-primary fs-5">{{ $order->order_price }} ل.س</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-success small fw-bold"><i class="bi bi-geo-alt-fill me-1"></i>الشاحن
                                في
                                الطريق إليك</div>
                        </div>
                    </div>
                </div>
            </div>
        @break

        @case('delivered')
            <div class="order-card">

                <!-- رأس الطلب (كله قابل للضغط) -->
                <div class="order-header cursor-pointer" onclick="toggleOrderDetails(this)">
                    <div>
                        <div class="order-id">#ORD-{{ $order->id }}</div>
                        <div class="order-date"><i
                                class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('Y/m/d h:i a') }}</div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <span class="status-badge status-completed"><i class="bi bi-check-circle-fill me-1"></i>&nbsp;
                            تم الاستلام</span>

                        <!-- السهم (مجرد مؤشر visual، يمكن إزالة الزر button إذا أردت) -->
                        <div class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-chevron-down transition-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- محتوى الفاتورة (يظهر ويخفي) -->
                <div class="order-details-content collapse show">
                    <div class="p-3">

                        <!-- جدول منتجات الفاتورة -->
                        <div class="table-responsive mb-3">
                            <table class="table table-borderless table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-2 small text-muted">المنتج</th>
                                        <th class="text-end small text-muted pe-3">السعر الفردي</th>
                                        <th class="text-center small text-muted">الكمية</th>
                                        <th class="text-end pe-2 small text-muted">الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- منتج 1 -->
                                    @for ($i = 0; $i < count($order->product_name); $i++)
                                        <tr>
                                            <td class="ps-2">
                                                <div class="fw-bold text-dark small">{{ $order->product_name[$i] }}</div>
                                            </td>
                                            <td class="text-end pe-3 text-muted small">{{ $order->single_price[$i] }} ل.س</td>
                                            <td class="text-center small">{{ $order->quantity[$i] }}</td>
                                            <td class="text-end pe-2 small fw-bold text-primary">{{ $order->total_price[$i] }}
                                                ل.س</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">

                        <!-- ملخص الحساب -->
                        <div class="row justify-content-end">
                            <div class="col-md-6 col-lg-5">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">المجموع الفرعي:</span>
                                    <span class="small fw-bold">{{ $order->sub_total }} ل.س</span>
                                </div>
                                @if ($order->coupon && $order->coupon != '[]')
                                    <div class="d-flex justify-content-between mb-1 text-success">
                                        <span class="small">خصم الكوبون (% SAVE {{ $order->coupon['discountPercentage'] }}
                                            )</span>
                                        <span class="small fw-bold">- {{ $order->coupon['discountValue'] }} ل.س</span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">رسوم التوصيل:</span>
                                    <span class="small fw-bold">25 ل.س</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2 pt-2 border-top border-2 border-dark">
                                    <span class="fw-bold text-dark">الإجمالي النهائي:</span>
                                    <span class="fw-bold text-primary fs-5">{{ $order->order_price }} ل.س</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @break

        @case('cancelled')
            <div class="order-card">

                <!-- رأس الطلب (كله قابل للضغط) -->
                <div class="order-header cursor-pointer" onclick="toggleOrderDetails(this)">
                    <div>
                        <div class="order-id">#ORD-{{ $order->id }}</div>
                        <div class="order-date"><i
                                class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('Y/m/d h:i a') }}</div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <span class="status-badge status-cancelled"><i class="bi bi-x-circle-fill me-1"></i>&nbsp;تم
                            الإلغاء</span>
                        <!-- السهم (مجرد مؤشر visual، يمكن إزالة الزر button إذا أردت) -->
                        <div class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-chevron-down transition-icon"></i>
                        </div>
                    </div>
                </div>
                <!-- محتوى الفاتورة (يظهر ويخفي) -->
                <div class="order-details-content collapse show">
                    <div class="p-3">

                        <!-- جدول منتجات الفاتورة -->
                        <div class="table-responsive mb-3">
                            <table class="table table-borderless table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-2 small text-muted">المنتج</th>
                                        <th class="text-end small text-muted pe-3">السعر الفردي</th>
                                        <th class="text-center small text-muted">الكمية</th>
                                        <th class="text-end pe-2 small text-muted">الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- منتج 1 -->
                                    @for ($i = 0; $i < count($order->product_name); $i++)
                                        <tr>
                                            <td class="ps-2">
                                                <div class="fw-bold text-dark small">{{ $order->product_name[$i] }}</div>
                                            </td>
                                            <td class="text-end pe-3 text-muted small">{{ $order->single_price[$i] }} ل.س</td>
                                            <td class="text-center small">{{ $order->quantity[$i] }}</td>
                                            <td class="text-end pe-2 small fw-bold text-primary">{{ $order->total_price[$i] }}
                                                ل.س</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">

                        <!-- ملخص الحساب -->
                        <div class="row justify-content-end">
                            <div class="col-md-6 col-lg-5">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">المجموع الفرعي:</span>
                                    <span class="small fw-bold">{{ $order->sub_total }} ل.س</span>
                                </div>
                                @if ($order->coupon && $order->coupon != '[]')
                                    <div class="d-flex justify-content-between mb-1 text-success">
                                        <span class="small">خصم الكوبون (% SAVE {{ $order->coupon['discountPercentage'] }}
                                            )</span>
                                        <span class="small fw-bold">- {{ $order->coupon['discountValue'] }} ل.س</span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted small">رسوم التوصيل:</span>
                                    <span class="small fw-bold">25 ل.س</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2 pt-2 border-top border-2 border-dark">
                                    <span class="fw-bold text-dark">الإجمالي النهائي:</span>
                                    <span class="fw-bold text-primary fs-5">{{ $order->order_price }} ل.س</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @break

        @default
    @endswitch

</div>
