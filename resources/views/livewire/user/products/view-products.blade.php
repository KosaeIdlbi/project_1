<div>
    <div class="container py-4">
        <div class="row g-4">

            <!-- القسم الأيمن: الفلاتر والبحث -->
            <div class="col-lg-3">
                <div class="filter-sidebar">

                    <button wire:click.prevent='resetFilters'
                        class="btn btn-outline-danger w-100 mt-4 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>
                        مسح الفلاتر </button>
                    <!-- مربع البحث -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">بحث بالاسم</label>
                        <div class="input-group">
                            <input list="products" wire:model.live.debounce.1000ms="search"
                                class="form-control bd bd-l-0 pd-l-10" placeholder="اكتب اسم المنتج للبحث..."
                                autocomplete="off" type="search">
                            <datalist id="products">
                                <option value="">كل المنتجات</option>

                                @foreach ($results as $result)
                                    <option value="{{ $result->name }}">{{ $result->name }}</option>
                                @endforeach

                            </datalist>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="filter-group-title">السعر الأقصى</div>

                        <!-- أدخل السعر الأقصى -->
                        <div class="d-flex gap-2 align-items-center">
                            <div class="input-group input-group-sm">
                                <input wire:model.live.debounce.1000ms='Price' type="number" class="form-control"
                                    placeholder="السعر الأقصى..." min="0">
                            </div>
                        </div>
                    </div>
                    <!-- فلتر السعر -->
                    <div class="mb-4">
                        <div class="filter-group-title">القسم</div>
                        <div class="filter-item">
                            <select wire:model.live='CatigoryName'
                                class="form-select form-select-sm w-100 border-0 bg-transparent">
                                <option value="">كل الاقسام </option>
                                @if ($catigories->isNotEmpty())
                                    @foreach ($catigories as $catigory)
                                        <option value="{{ $catigory->name }}">{{ $catigory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div wire:model.live='BrandName' class="filter-group-title">الماركة</div>
                        <div class="filter-item">
                            <select wire:model.live='BrandName'
                                class="form-select form-select-sm w-100 border-0 bg-transparent">
                                <option value="">كل الماركات </option>
                                @if ($brands->isNotEmpty())
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="filter-group-title">الصنف</div>
                        <div class="filter-item">
                            <select wire:model.live='TagName'
                                class="form-select form-select-sm w-100 border-0 bg-transparent">
                                <option value="">كل الأصناف </option>
                                @if ($tags->isNotEmpty())
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- فلتر العلامات/المواصفات -->
                    <div class="mb-4">
                        <div class="filter-group-title">حالة المنتج</div>
                        <ul class="filter-list">
                            <li class="filter-item">
                                <span>مميز</span>
                                <div class="form-check">
                                    <input wire:model.live="Special" {{ $Special ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="check1">
                                </div>
                            </li>
                            <li class="filter-item">
                                <span>عروض</span>
                                <div class="form-check">
                                    <input wire:model.live="Offers" {{ $Offers ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="check2">
                                </div>
                            </li>
                            <li class="filter-item">
                                <span>جديد</span>
                                <div class="form-check">
                                    <input wire:model.live="Newests" {{ $Newests ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="check3">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- القسم الأيسر: شبكة المنتجات -->
            <div class="col-lg-9">
                <!-- شبكة المنتجات -->
                <div class="row g-4 ">
                    @foreach ($products as $item)
                        @if ($item->has_offer)
                            @livewire('user.products.offers.section-item', ['product' => $item, 'user' => $user], key($item->id))
                        @else
                            @if ($item->special && !$item->has_offer)
                                @livewire('user.products.specials.section-item', ['product' => $item, 'user' => $user], key($item->id))
                            @else
                                @if (!$item->special && !$item->has_offer && $item->is_newest)
                                    @livewire('user.products.newest.section-item', ['product' => $item, 'user' => $user], key($item->id))
                                @else
                                    @if (!$item->special && !$item->has_offer && !$item->is_newest)
                                        @livewire('user.products.normal.section-item', ['product' => $item, 'user' => $user], key($item->id))
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endforeach
                </div>

                <!-- الترقيم (Pagination) -->
                <nav aria-label="Page navigation" class="mt-5">
                    {{ $products->links() }}
                </nav>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('clear-checkboxes', function() {
            // يتم التنفيذ فقط عند استقبال الأمر من PHP
            var availableEl = document.getElementById('check1');
            var specialEl = document.getElementById('check2');
            var offersEl = document.getElementById('check3');
            if (availableEl) availableEl.checked = false;
            if (specialEl) specialEl.checked = false;
            if (offersEl) offersEl.checked = false;
        });
    </script>
</div>
