<div>
    <div class="sl-pagebody">
        <div class="card bd-0 shadow-base pd-20 mg-t-20">
            @livewire('admin.orders.new-order-notification')
            <hr>
            <div class="card-header bg-transparent pd-0 bd-0 d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="card-title tx-uppercase tx-12 tx-bold tx-gray-600 mb-0">بحث وتصفية متقدم</h6>
                    <small class="tx-11 tx-gray-500">حدد معايير البحث للوصول للمنتجات المطلوبة</small>
                </div>
            </div>
            <div class="card-body pd-0">
                <form wire:submit.prevent="applyFilters">
                    <div class="row row-sm">
                        <!-- 1. البحث (تم تحسين الشرح) -->
                        <div class="col-lg-12 mg-b-20">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">البحث بالاسم
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon bd bd-white bg-white">
                                    <i class="fa fa-search tx-gray-400"></i>
                                </span>
                                <input type="search" wire:model.live.debounce.1000ms="OrderId"
                                    class="form-control bd bd-l-0 pd-l-10" placeholder="اكتب رقم الطلب للبحث..."
                                    autocomplete="off">
                            </div>
                        </div>
                        <!-- 4. التواريخ -->
                        <div class="col-lg-4 col-md-12 mg-b-20">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">جلب حسب تاريخ انشاء الطلب
                                من التاريخ المحدد فصاعداً</label>
                            <div class="row row-sm">
                                <!-- تاريخ الإضافة -->
                                <div class="col-6">
                                    <div class="input-group">
                                        <input wire:model.live='CreatedAt' type="date" class="form-control"
                                            title="تاريخ الإضافة">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- حاوية الفلتر -->
                        <div class="col-lg-8 col-md-12 mg-b-20">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-2">تصفية حسب الحالة والصلاحية</label>

                            <div class="row row-sm">

                                <!-- مجموعة 1: الطلبات العامة (للجميع) -->
                                <div class="col-12 mb-3">
                                    <div class="card bd-0 shadow-sm pd-10 bg-gray-100">
                                        <h6 class="tx-12 tx-bold tx-gray-600 mb-2"><i class="fa fa-globe mg-r-5"></i>
                                            طلبات عامة (للجميع)</h6>
                                        <div class="row row-sm">

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label
                                                    class="d-block bg-white pd-10 rounded cursor-pointer bd bd-gray-200 hover:bg-gray-50 transition">
                                                    <div class="d-flex align-items-center">
                                                        <input wire:model.live="OrderStatus" type="radio"
                                                            name="status" value="" class="form-control mg-r-10"
                                                            style="width: 18px; height: 18px;">
                                                        <span class="tx-13">كل الطلبات</span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <label
                                                    class="d-block bg-white pd-10 rounded cursor-pointer bd bd-gray-200 hover:bg-gray-50 transition">
                                                    <div class="d-flex align-items-center">
                                                        <input wire:model.live="OrderStatus" type="radio"
                                                            name="status" value="waiting" class="form-control mg-r-10"
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
                                    <div class="card bd-0 shadow-sm pd-10 bg-info-50"
                                        style="background-color: #e3f2fd;">
                                        <h6 class="tx-12 tx-bold tx-info-700 mb-2"><i class="fa fa-user mg-r-5"></i>
                                            طلباتي الخاصة (لي فقط)</h6>
                                        <div class="row row-sm">

                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <label
                                                    class="d-block bg-white pd-10 rounded cursor-pointer bd bd-info-100 hover:bg-info-50 transition">
                                                    <div class="d-flex align-items-center">
                                                        <input wire:model.live="OrderStatus" type="radio"
                                                            name="status" value="delivered"
                                                            class="form-control mg-r-10"
                                                            style="width: 18px; height: 18px;">
                                                        <span class="tx-13">مكتملة</span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <label
                                                    class="d-block bg-white pd-10 rounded cursor-pointer bd bd-info-100 hover:bg-info-50 transition">
                                                    <div class="d-flex align-items-center">
                                                        <input wire:model.live="OrderStatus" type="radio"
                                                            name="status" value="delivery_in_progress"
                                                            class="form-control mg-r-10"
                                                            style="width: 18px; height: 18px;">
                                                        <span class="tx-13">تم الشحن</span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <label
                                                    class="d-block bg-white pd-10 rounded cursor-pointer bd bd-info-100 hover:bg-info-50 transition">
                                                    <div class="d-flex align-items-center">
                                                        <input wire:model.live="OrderStatus" type="radio"
                                                            name="status" value="cancelled"
                                                            class="form-control mg-r-10"
                                                            style="width: 18px; height: 18px;">
                                                        <span class="tx-13">ملغية</span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <label
                                                    class="d-block bg-white pd-10 rounded cursor-pointer bd bd-info-100 hover:bg-info-50 transition">
                                                    <div class="d-flex align-items-center">
                                                        <input wire:model.live="OrderStatus" type="radio"
                                                            name="status" value="received" class="form-control mg-r-10"
                                                            style="width: 18px; height: 18px;">
                                                        <span class="tx-13">مستلمة من الزبون</span>
                                                    </div>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- row -->
                </form>
            </div><!-- card-body -->
        </div><!-- card -->

        <div class="row row-sm mg-t-20">
            @foreach ($orders as $order)
                <div class="col-xl-6 col-md-6 mg-t-20">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                        @livewire('admin.orders.order', ['order' => $order, 'admin' => $admin, 'lazy' => true], key($order->id))
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mg-t-20">
            {{ $orders->links() }}
        </div>
    </div>
</div>
