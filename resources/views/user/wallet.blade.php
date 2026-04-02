@extends('user.layouts.master')
@section('title')
    المحفظة
@endsection
@section('content')
    @if (session('charged_field'))
        <script>
            alert("{{ session('charged_field') }}");
        </script>
    @endif

    <div class="container py-4">
        <div class="row g-4">

            <!-- القسم الأيمن: الرصيد وطلبات التعبئة -->
            <div class="col-lg-8">

                <!-- 1. بطاقة الرصيد -->
                <div class="balance-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="m-0"><i class="bi bi-wallet2 me-2"></i> الرصيد الحالي</h5>
                    </div>
                    <div class="balance-amount">{{ $user->balance }} ل.س</div>
                    <div class="mt-2 opacity-75"> آخر عملية شحن : &nbsp;
                        {{ $last_charge ? $last_charge->updated_at->format('Y-m-d - h:i a') : '' }}
                    </div>
                </div>

                <!-- 2. واجهة طلب تعبئة الرصيد -->
                <div class="topup-section">
                    <h5 class="fw-bold mb-4 pb-2 border-bottom">تعبئة الرصيد</h5>

                    <div class="row align-items-center">
                        <!-- QR Code -->
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <div class="qr-wrapper mb-2">
                                @if ($sham_cash_account->img)
                                    <!-- تم تصحيح الاقتباس وإضافة كلاسات التنسيق -->
                                    <img src="{{ asset('shamcash/imgs/' . $sham_cash_account->img->path) }}"
                                        class="qr-image" alt="QR Code">
                                @else
                                    <div class="qr-placeholder-inner">
                                        <i class="bi bi-qr-code display-4"></i>
                                    </div>
                                @endif
                            </div>
                            <small class="text-muted d-block">امسح الرمز للتعبئة</small>
                        </div>

                        <!-- التفاصيل والباركود -->
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">رقم الحساب /
                                    الباركود</label>
                                <div style="font-size: 16px" class="barcode-display">
                                    {{ $sham_cash_account->account_number }}
                                </div>
                            </div>

                            <div class="alert alert-info d-flex align-items-center p-2 small">
                                <i class="bi bi-info-circle-fill ms-2 fs-5"></i>
                                <div>
                                    قم بتحويل المبلغ عبر تطبيق "شام كاش" باستخدام الرقم أعلاه، ثم ارفع الإيصال.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. رفع إشعار الدفع -->
                <div class="topup-section mt-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-upload me-2 text-primary"></i>إرفاق إيصال التحويل</h6>

                    <form action={{ route('user.wallet.store') }} target="" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">صورة الإيصال</label>
                            <div class="upload-area" onclick="document.getElementById('receiptInput').click()">
                                <i class="bi bi-cloud-arrow-up display-4 text-muted mb-2"></i>
                                <p class="mb-0 text-muted">اضغط هنا لرفع صورة الإيصال</p>
                                <input required type="file" value="{{ old('receipt') }}" id="receiptInput" class="d-none"
                                    name="receipt" accept="image/*"
                                    onchange="this.nextElementSibling.innerText = this.files[0].name">
                                <small class="text-primary d-block mt-1" id="fileName">لم يتم اختيار ملف</small>
                            </div>
                            <div class="form-text" style="color: red">
                                <x-input-error input="receipt"></x-input-error>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">المبلغ المحول (ل.س)</label>
                            <input type="number" required min={{ $sham_cash_account->minimum_charge }}
                                max={{ $sham_cash_account->maximum_charge }} name="amount" class="form-control"
                                placeholder="أدخل المبلغ">
                        </div>
                        <div class="form-text" style="color: red">
                            <x-input-error input="amount"></x-input-error>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رقم المرجع</label>
                            <input type="text" required value="{{ old('transcation_number') }}" name="transcation_number"
                                class="form-control" placeholder="رقم العملية من التطبيق البنكي">
                        </div>
                        <div class="form-text" style="color: red">
                            <x-input-error input="transcation_number"></x-input-error>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            إرسال طلب التعبئة
                        </button>
                        <div class="form-text" style="color: red">
                            <x-redirect-message name="charged_faild"></x-redirect-message>
                        </div>
                    </form>
                </div>

            </div>

            <!-- القسم الأيسر: المعلومات الشخصية -->
            <div class="col-lg-4">

                <!-- =========================== -->
                <!-- 1. قائمة عمليات التحويل -->
                <!-- =========================== -->
                <div class="info-card">
                    <h6 class="fw-bold mb-3">آخر الطلبات</h6>

                    <!-- حاوية قابلة للتمرير -->
                    <div class="transaction-list" style="max-height: 600px; overflow-y: auto; padding-right: 5px;">

                        @foreach ($charges as $charge)
                            @livewire('user.charger.charge', ['charge' => $charge], key($charge->id))
                        @endforeach
                    </div>
                    {{-- 
                    <!-- رابط "عرض الكل" -->
                    <div class="text-center mt-2">
                        <a href="#" class="text-decoration-none small text-primary fw-bold">عرض الكل <i
                                class="bi bi-arrow-left"></i></a>
                    </div> --}}
                </div>

                <!-- =========================== -->
                <!-- 2. مربع حدود المحفظة -->
                <!-- =========================== -->
                <div class="info-card mt-4">
                    <h6 class="fw-bold mb-3">حدود المحفظة</h6>
                    <ul class="list-unstyled small text-muted">
                        <li class="d-flex justify-content-between mb-2">
                            <span>الحد الأدنى للشحن:</span>
                            <span class="text-dark fw-bold">
                                {{ $sham_cash_account->minimum_charge }}ل.س
                            </span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span>الحد الأقصى للمحفظة:</span>
                            <span class="text-dark fw-bold">
                                {{ $sham_cash_account->maximum_charge }}ل.س
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
