<div>
    <div class="sl-pagebody">
        <div class="card bd-0 shadow-base pd-20 mg-t-20">
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
                                <input list="products" wire:model.live.debounce.1000ms="search"
                                    class="form-control bd bd-l-0 pd-l-10" placeholder="اكتب اسم المنتج للبحث..."
                                    autocomplete="off">
                                <datalist id="products">
                                    <option value="">كل المنتجات</option>

                                    @foreach ($results as $result)
                                        <option value="{{ $result->name }}">{{ $result->name }}</option>
                                    @endforeach

                                </datalist>
                            </div>
                        </div>

                        <!-- 2. فلتر التصنيف -->
                        <div class="col-lg-4 col-md-6 mg-b-20">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">القسم</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-list mg-r-5"></i>
                                </span>
                                <select wire:model.live='CatigoryName' class="form-control select2">
                                    <option value="">كل الاقسام </option>
                                    @if ($catigories->isNotEmpty())
                                        @foreach ($catigories as $catigory)
                                            <option value="{{ $catigory->name }}">{{ $catigory->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mg-b-20">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">الصنف</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-list mg-r-5"></i>
                                </span>
                                <select wire:model.live='TagName' class="form-control select2">
                                    <option value="">كل الأصناف </option>
                                    @if ($tags->isNotEmpty())
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mg-b-20">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">الماركة</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-list mg-r-5"></i>
                                </span>
                                <select wire:model.live='BrandName' class="form-control select2">
                                    <option value="">كل الماركات </option>
                                    @if ($brands->isNotEmpty())
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- 3. فلتر السعر -->
                        <div class="col-lg-4 col-md-6 mg-b-20">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">السعر الأقصى (SYP)</label>
                            <div class="input-group">
                                <span class="input-group-addon">لغاية</span>
                                <input wire:model.live.debounce.1000ms='Price' type="number" class="form-control"
                                    placeholder="أدخل السعر" min="0">
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

                        <!-- 5. الترتيب (تم تحسين الشرح والوضوح) -->
                        <div class="col-lg-4 col-md-12 mg-b-0">
                            <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">ترتيب النتائج حسب التاريخ</label>

                            <div class="input-group">
                                <span class="input-group-addon bd-r-0">
                                    <i class="fa fa-sort mg-r-5"></i> ترتيب حسب:
                                </span>
                                <span class="input-group-btn">
                                    <button type="button" wire:click='sorting("asc")'
                                        class="btn btn-outline-secondary bd-l-0 bd-r-0 rounded-0"
                                        title="عرض الأقدم أولاً">
                                        <i class="fa fa-sort-amount-asc mg-l-5"></i> تصاعدي
                                    </button>
                                    <button type="button" wire:click='sorting("desc")'
                                        class="btn btn-outline-secondary rounded-0" title="عرض الأحدث أولاً">
                                        <i class="fa fa-sort-amount-desc mg-l-5"></i> تنازلي
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- حاوية الفلتر -->
                        <div class="col-lg-4 col-md-12 mg-b-20">

                            <!-- المجموعة الأولى: الحالة (Status) -->
                            <!-- ملاحظة: type="radio" و name="status" موحد للمجموعة -->
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-check-square-o text-success"></i> متاح
                                        </span>
                                        <!-- value="1" تعني قيمة "متاح" -->
                                        <input wire:model.live="Available" type="radio" name="status"
                                            value="1" id="Available" class="form-control"
                                            style="height: 20px; width: auto; margin: 0 10px;">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-times-circle-o text-danger"></i> غير متاح
                                        </span>
                                        <!-- value="0" تعني قيمة "غير متاح" -->
                                        <input wire:model.live="UnAvailable" type="radio" name="status"
                                            value="0" id="unAvailable" class="form-control"
                                            style="height: 20px; width: auto; margin: 0 10px;">
                                    </div>
                                </div>
                            </div>

                            <!-- المجموعة الثانية: التمييز (Feature) -->
                            <!-- name="feature" موحد لهذه المجموعة -->
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-star text-warning"></i> مميز
                                        </span>
                                        <input wire:model.live="Special" type="radio" name="feature"
                                            value="1" id="Special" class="form-control"
                                            style="height: 20px; width: auto; margin: 0 10px;">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-star-o text-secondary"></i> غير مميز
                                        </span>
                                        <input wire:model.live="NotSpecial" type="radio" name="feature"
                                            value="0" id="notSpecial" class="form-control"
                                            style="height: 20px; width: auto; margin: 0 10px;">
                                    </div>
                                </div>
                            </div>

                            <!-- المجموعة الثالثة: العروض (Offer) -->
                            <!-- name="offer" موحد لهذه المجموعة -->
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tags text-primary"></i> عروض
                                        </span>
                                        <input wire:model.live="Offers" type="radio" name="offer" value="1"
                                            id="Offers" class="form-control"
                                            style="height: 20px; width: auto; margin: 0 10px;">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-ban text-muted"></i> بدون عروض
                                        </span>
                                        <input wire:model.live="WithoutOffers" type="radio" name="offer"
                                            value="0" id="withoutOffers" class="form-control"
                                            style="height: 20px; width: auto; margin: 0 10px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- row -->
                </form>
            </div><!-- card-body -->
        </div><!-- card -->

        <div class="row row-sm mg-t-20">
            @foreach ($products as $product)
                <div class="col-xl-12 col-md-12 mg-t-20">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                        @livewire('admin.products.product', ['product' => $product, 'catigories' => $catigories, 'tags' => $tags, 'brands' => $brands, 'lazy' => true], key($product->id))
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mg-t-20">
            <div class="d-flex justify-content-center mg-t-20">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('clear-checkboxes', function() {
            // يتم التنفيذ فقط عند استقبال الأمر من PHP
            var availableEl = document.getElementById('Available');
            var specialEl = document.getElementById('Special');
            var offersEl = document.getElementById('Offers');
            var unAvailableEl = document.getElementById('unAvailable');
            var notSpecialEl = document.getElementById('notSpecial');
            var withoutOffersEl = document.getElementById('withoutOffers');
            if (availableEl) availableEl.checked = false;
            if (specialEl) specialEl.checked = false;
            if (offersEl) offersEl.checked = false;
            if (unAvailableEl) unAvailableEl.checked = false;
            if (notSpecialEl) notSpecialEl.checked = false;
            if (withoutOffersEl) withoutOffersEl.checked = false;
        });
    </script>
</div>
