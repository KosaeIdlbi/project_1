<div>
    @switch($charge->charge_status)
        @case('waiting')
        @case('received')
            <!-- عملية 2: قيد المراجعة -->
            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 me-2">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <div class="fw-bold small">بانتظار التحقق</div>
                        <div class="text-muted" style="font-size: 0.75rem;">
                            {{ $charge->created_at->format('Y-m-d h:i a') }}</div>
                    </div>
                </div>
                <div class="text-warning fw-bold small">+ {{ $charge->amount }} ل.س</div>
            </div>
        @break

        @case('success')
            <!-- عملية 1: ناجحة -->
            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 me-2">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold small">تمت التعبئة</div>
                        <div class="text-muted" style="font-size: 0.75rem;">
                            {{ $charge->created_at->format('Y-m-d h:i a') }}</div>
                    </div>
                </div>
                <div class="text-success fw-bold small">+ {{ $charge->amount }} ل.س</div>
            </div>
        @break

        @case('denied')
            <!-- عملية 4: مرفوضة مع السبب -->
            <div class="d-flex align-items-start justify-content-between">
                <div class="d-flex align-items-start">
                    <!-- أيقونة الرفض -->
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-2 me-2 flex-shrink-0">
                        <i class="bi bi-x-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold small text-danger">عملية مرفوضة</div>
                        <div class="text-muted" style="font-size: 0.75rem;">
                            {{ $charge->created_at->format('Y-m-d h:i a') }}</div>

                        <!-- صندوق سبب الرفض -->
                        <div class="mt-2 p-2 rounded bg-danger bg-opacity-10 border border-danger border-opacity-25">
                            <div class="d-flex align-items-center gap-1 mb-1">
                                <i class="bi bi-exclamation-circle-fill text-danger small"></i>
                                <span class="text-danger fw-bold small">سبب الرفض:</span>
                            </div>
                            <p class="small text-danger mb-0 opacity-75" style="line-height: 1.4;">
                                @if ($charge->deniedReason)
                                    {{ $charge->deniedReason->desc }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- المبلغ المشطوب -->
                <div class="text-muted text-decoration-line-through small ms-2">{{ $charge->amount }} ل.س
                </div>
            </div>
        @break

        @default
    @endswitch
</div>
