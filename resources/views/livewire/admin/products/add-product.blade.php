<div>
    <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    @if (session('stored'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">تم بنجاح!</strong> {{ session('stored') }}
                        </div><!-- alert -->
                    @endif

                    <form action="" target="" method="POST">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">اسم المنتج: <span
                                    class="tx-danger"><x-input-error input="name"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='name' type="text" class="form-control"
                                    placeholder="أدخل اسم المنتج">
                            </div>
                        </div>
                        <br>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">وصف المنتج: <span
                                    class="tx-danger"><x-input-error input="description"></x-input-error></span></label>
                            <div class="col-lg">
                                <textarea rows="3" wire:model='description' class="form-control" placeholder="أدخل وصف المنتج"></textarea>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">سعر المنتج: <span
                                    class="tx-danger"><x-input-error input="price"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='price' type="text" class="form-control"
                                    placeholder="أدخل سعر المنتج">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">الكمية: <span class="tx-danger"><x-input-error
                                        input="quantity"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='quantity' type="number" class="form-control" min="0"
                                    placeholder="أدخل الكمية المتاحة">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">الكمية المسموحة للشراء: <span
                                    class="tx-danger"><x-input-error
                                        input="able_to_buy_quantity"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='able_to_buy_quantity' type="number" class="form-control"
                                    min="0" placeholder="أدخل الكمية المسموح شراؤها">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">اختر القسم:<span class="tx-danger"><x-input-error
                                        input="catigory"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select class="form-control select2" data-placeholder="اختر التصنيف"
                                    wire:model='catigory'>
                                    @if ($catigories)
                                        @foreach ($catigories as $catigory)
                                            <option value={{ $catigory->id }}>{{ $catigory->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">اختر الصنف:<span class="tx-danger"><x-input-error
                                        input="tag"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select class="form-control select2" data-placeholder="اختر الصنف" wire:model='tag'>
                                    @if ($tags)
                                        @foreach ($tags as $tag)
                                            <option value={{ $tag->id }}>{{ $tag->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">اختر الماركة:<span
                                    class="tx-danger"><x-input-error input="brand"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select class="form-control select2" data-placeholder="اختر الماركة" wire:model='brand'>
                                    @if ($brands)
                                        @foreach ($brands as $brand)
                                            <option value={{ $brand->id }}>{{ $brand->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- ... باقي حقول النموذج (السعر، الكمية، الماركة...) ... -->

                        <!-- =========================== -->
                        <!-- قسم إدراج المواصفات (Dynamic) -->
                        <!-- =========================== -->
                        <div class="row mg-t-20">
                            <label class="col-sm-12 form-control-label fw-bold">مواصفات المنتج:</label>

                            <div class="col-sm-12">
                                <!-- جدول المواصفات -->
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered table-hover" id="specsTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 10%">ترتيب الميزة</th>
                                                <th style="width: 40%">اسم الميزة</th>
                                                <th style="width: 40%">الوصف</th>
                                                <th style="width: 10%" class="text-center">إجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($SpecNamesArray); $i++)
                                                <tr>
                                                    <td>{{ $SpecOrdersArray[$i] }}</td>
                                                    <td>{{ $SpecNamesArray[$i] }}</td>
                                                    <td>{{ $SpecDescsArray[$i] }}</td>
                                                    <td class="text-center">
                                                        <!-- زر الحذف -->
                                                        <button type="button"
                                                            wire:click.prevent='deleteSpec({{ $i }})'
                                                            class="btn btn-outline-danger btn-sm rounded-circle"
                                                            title="حذف">
                                                            حذف
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>

                                <!-- نموذج إضافة مواصفة جديدة -->
                                <div class="card bg-light border-0">
                                    <div class="card-body py-2">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-2">
                                                <input type="number" class="form-control form-control-sm"
                                                    wire:model="SpecOrder" min="1"
                                                    placeholder="ترتيب الميزة ">
                                            </div>
                                            <!-- اسم المواصفة -->
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm"
                                                    wire:model="SpecName" placeholder="اسم الميزة ">
                                            </div>

                                            <!-- قيمة/وصف المواصفة -->
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm"
                                                    wire:model="SpecDesc" placeholder="الوصف">
                                            </div>

                                            <!-- زر الإضافة -->
                                            <div class="col-md-2">
                                                <button wire:click.prevent="addSpec"
                                                    class="btn btn-primary btn-sm w-100">
                                                    <i class="bi bi-plus-lg me-1"></i> إضافة
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">صور المنتج:</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="custom-file">
                                <input type="file" id="file" class="custom-file-input"
                                    wire:model.live='imgs' multiple>
                                <span class="custom-file-control"></span>
                            </label>&nbsp;
                            <div wire:loading wire:target='imgs'>
                                جاري التحميل، يرجى الانتظار...
                            </div>
                        </div>
                        <span class="tx-danger">
                            @foreach ($errors->get('imgs.*') as $errorArray)
                                @foreach ($errorArray as $error)
                                    {{ $error }}<br>
                                @endforeach
                            @endforeach
                            <x-input-error input="imgs"></x-input-error>
                        </span>
                        @if (!$errors->any())
                            <div class="row mg-t-20">
                                @foreach ($imgs as $img)
                                    <img src={{ $img->temporaryURL() }} alt="" width="200px"
                                        hight="200px">
                                @endforeach
                            </div>
                        @endif

                        <div class="form-layout-footer mg-t-30">
                            <button wire:click.prevent='store' class="btn btn-info mg-r-5"
                                wire:loading.attr='disabled'>حفظ المنتج</button>
                            <button wire:click.prevent="resetValues" class="btn btn-secondary">إلغاء</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
