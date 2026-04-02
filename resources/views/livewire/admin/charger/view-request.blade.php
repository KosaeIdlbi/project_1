<div>
    <div class="sl-pagebody">
        <div class="card bd-0 shadow-base pd-20 mg-t-20">
            @livewire('admin.charger.new-charge-notification')
            <div class="card-header bg-transparent pd-0 bd-0 d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="card-title tx-uppercase tx-12 tx-bold tx-gray-600 mb-0">بحث وتصفية متقدم</h6>
                    <small class="tx-11 tx-gray-500">حدد معايير البحث للوصول للمنتجات المطلوبة</small>
                </div>
                <div>
                    <button wire:click.prevent="resetFilters" class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-times mg-r-5"></i> إلغاء الفلاتر
                    </button>
                </div>
            </div>

            <div class="card-body pd-0">
                <div class="row row-sm">
                    <!-- 1. البحث (تم تحسين الشرح) -->
                    <div class="col-lg-12 mg-b-20">
                        <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">ابحث حسب رقم عملية التحويل</label>
                        <div class="input-group">
                            <span class="input-group-addon bd bd-white bg-white">
                                <i class="fa fa-search tx-gray-400"></i>
                            </span>
                            <input type="search" wire:model="TranscationNumber" class="form-control bd bd-l-0 pd-l-10"
                                placeholder="ابحث حسب رقم عملية التحويل..." autocomplete="off">
                            <button class="btn btn-primary" wire:click.prevent='search'>search</button>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mg-b-20">
                        <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">سبب رفض التحويل</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list mg-r-5"></i>
                            </span>
                            <select wire:model.live='DeniedReason' class="form-control select2">
                                <option value="" selected>لا يوجد
                                </option>
                                @if ($denied_reasons->isNotEmpty())
                                    @foreach ($denied_reasons as $denied_reason)
                                        <option value="{{ $denied_reason->name }}">{{ $denied_reason->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- 4. التواريخ -->
                    <div class="col-lg-4 col-md-12 mg-b-20">
                        <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">جلب حسب تاريخ الاضافة او
                            التعديل من التاريخ المحدد فصاعداً</label>
                        <div class="row row-sm">
                            <!-- تاريخ الإضافة -->
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-addon" title="من التاريخ المحدد فصاعداً">
                                        <i class="fa fa-calendar-plus-o tx-primary"></i> إضافة
                                    </span>
                                    <input wire:model.live='CreatedAt' type="date" class="form-control"
                                        title="تاريخ الإضافة">
                                </div>
                            </div>

                            <!-- تاريخ التعديل -->
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-addon" title="من التاريخ المحدد فصاعداً">
                                        <i class="fa fa-calendar-check-o tx-success"></i> تعديل
                                    </span>
                                    <input wire:model.live='UpdatedAt' type="date" class="form-control"
                                        title="تاريخ التعديل">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card bd-0 shadow-sm pd-10 bg-gray-100">
                            <h6 class="tx-12 tx-bold tx-gray-600 mb-2"><i class="fa fa-globe mg-r-5"></i>
                                طلبات عامة (للجميع)</h6>
                            <div class="row row-sm">

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label
                                        class="d-block bg-white pd-10 rounded cursor-pointer bd bd-gray-200 hover:bg-gray-50 transition">
                                        <div class="d-flex align-items-center">
                                            <input wire:model.live="ChargeStatus" type="radio" name="status"
                                                value="" class="form-control mg-r-10"
                                                style="width: 18px; height: 18px;">
                                            <span class="tx-13">كل الطلبات</span>
                                        </div>
                                    </label>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label
                                        class="d-block bg-white pd-10 rounded cursor-pointer bd bd-gray-200 hover:bg-gray-50 transition">
                                        <div class="d-flex align-items-center">
                                            <input wire:model.live="ChargeStatus" type="radio" name="status"
                                                value="waiting" class="form-control mg-r-10"
                                                style="width: 18px; height: 18px;">
                                            <span class="tx-13">بانتظار استلام الطلب</span>
                                        </div>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- مجموعة 2: طلباتي الخاصة (لي فقط) -->
                    <div class="col-12">
                        <div class="card bd-0 shadow-sm pd-10 bg-info-50" style="background-color: #e3f2fd;">
                            <h6 class="tx-12 tx-bold tx-info-700 mb-2"><i class="fa fa-user mg-r-5"></i>
                                طلباتي الخاصة (لي فقط)</h6>
                            <div class="row row-sm">

                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <label
                                        class="d-block bg-white pd-10 rounded cursor-pointer bd bd-info-100 hover:bg-info-50 transition">
                                        <div class="d-flex align-items-center">
                                            <input wire:model.live="ChargeStatus" type="radio" name="status"
                                                value="success" class="form-control mg-r-10"
                                                style="width: 18px; height: 18px;">
                                            <span class="tx-13">مكتملة</span>
                                        </div>
                                    </label>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <label
                                        class="d-block bg-white pd-10 rounded cursor-pointer bd bd-info-100 hover:bg-info-50 transition">
                                        <div class="d-flex align-items-center">
                                            <input wire:model.live="ChargeStatus" type="radio" name="status"
                                                value="denied" class="form-control mg-r-10"
                                                style="width: 18px; height: 18px;">
                                            <span class="tx-13">مرفوضة</span>
                                        </div>
                                    </label>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <label
                                        class="d-block bg-white pd-10 rounded cursor-pointer bd bd-info-100 hover:bg-info-50 transition">
                                        <div class="d-flex align-items-center">
                                            <input wire:model.live="ChargeStatus" type="radio" name="status"
                                                value="received" class="form-control mg-r-10"
                                                style="width: 18px; height: 18px;">
                                            <span class="tx-13">مستلمة من الزبون</span>
                                        </div>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card -->

        <div class="row row-sm mg-t-20">
            @foreach ($requests as $request)
                <div class="col-xl-6 col-md-6 mg-t-20">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                        @livewire('admin.charger.request', ['request' => $request, 'shamcash' => $shamcash, 'denied_reasons' => $denied_reasons, 'admin' => $admin, 'lazy' => true], key($request->id))
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mg-t-20">
            {{ $requests->links() }}
        </div>
    </div>
    <script>
        document.addEventListener('clear-checkboxes', function() {
            // يتم التنفيذ فقط عند استقبال الأمر من PHP
            var waitingEl = document.getElementById('waiting');
            var successEl = document.getElementById('success');
            var deniedEl = document.getElementById('denied');
            if (waitingEl) waitingEl.checked = false;
            if (successEl) successEl.checked = false;
            if (deniedEl) deniedEl.checked = false;
        });
    </script>
</div>
