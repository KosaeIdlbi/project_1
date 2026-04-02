<div>
    @switch($show)
        @case('ableToEdit')
            <form action="" target="" method="POST">
                <div class="row">
                    <label class="col-sm-4 form-control-label">اسم المنتج: <span class="tx-danger"><x-input-error
                                input="name"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='name' type="text" class="form-control" placeholder="أدخل اسم المنتج">
                    </div>
                </div>
                <br>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">وصف المنتج: <span class="tx-danger"><x-input-error
                                input="description"></x-input-error></span></label>
                    <div class="col-lg">
                        <textarea rows="3" wire:model='description' class="form-control" placeholder="أدخل وصف المنتج"></textarea>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">السعر : <span class="tx-danger"><x-input-error
                                input="price"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='price' type="text" class="form-control" placeholder="أدخل السعر الجديد">
                    </div>
                </div>

                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">الكمية: <span class="tx-danger"><x-input-error
                                input="quantity"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='quantity' type="number" class="form-control" placeholder="أدخل الكمية المتاحة">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">الكمية المسموحة للشراء: <span class="tx-danger"><x-input-error
                                input="able_to_buy_quantity"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='able_to_buy_quantity' type="number" class="form-control"
                            placeholder="أدخل الكمية المسموح شراؤها">
                    </div>
                </div>

                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">اختر القسم:</label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <select class="form-control select2" data-placeholder="اختر قسما" wire:model='catigory'>
                            @foreach ($catigories as $catigory)
                                <option value={{ $catigory->id }}>{{ $catigory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">اختر الصنف:</label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <select class="form-control select2" data-placeholder="اختر صنفا" wire:model='tag'>
                            @foreach ($tags as $tag)
                                <option value={{ $tag->id }}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">اختر الماركة:</label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <select class="form-control select2" data-placeholder="اختر ماركة" wire:model='brand'>
                            @foreach ($brands as $brand)
                                <option value={{ $brand->id }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
                                                <button type="button" wire:click.prevent='deleteSpec({{ $i }})'
                                                    class="btn btn-outline-danger btn-sm" title="حذف">
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
                                        <input type="number" min="1" class="form-control form-control-sm"
                                            wire:model="SpecOrder" placeholder="ترتيب الميزة ">
                                    </div>
                                    <!-- اسم المواصفة -->
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-control-sm" wire:model="SpecName"
                                            placeholder="اسم الميزة ">
                                    </div>

                                    <!-- قيمة/وصف المواصفة -->
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-control-sm" wire:model="SpecDesc"
                                            placeholder="الوصف">
                                    </div>

                                    <!-- زر الإضافة -->
                                    <div class="col-md-2">
                                        <button wire:click.prevent="addSpec" class="btn btn-primary btn-sm w-100">
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
                        <input type="file" id="file" class="custom-file-input" wire:model.live='imgs' multiple>
                        <span class="custom-file-control"></span>
                    </label>&nbsp;
                    <div wire:loading wire:target='imgs'>
                        جاري التحميل، يرجى الانتظار...
                    </div>
                </div>
                @if (!$imgs && $product->imgs->isNotEmpty())
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($product->imgs as $img)
                            <img src="{{ asset('products/imgs/' . $img->path) }}" alt="صورة المنتج"
                                class="img-fluid rounded border" style="max-width:200px; height:auto;">
                        @endforeach
                    </div>
                @else
                    @if (!$errors->any())
                        <div class="row mg-t-20">
                            @foreach ($imgs as $img)
                                <img src={{ $img->temporaryURL() }} alt="" width="200px" hight="200px">
                            @endforeach
                        </div>
                    @else
                        <span class="tx-danger">
                            @foreach ($errors->get('imgs.*') as $errorArray)
                                @foreach ($errorArray as $error)
                                    {{ $error }}<br>
                                @endforeach
                            @endforeach
                            <x-input-error input="imgs"></x-input-error>
                        </span>
                    @endif
                @endif


                <div class="form-layout-footer mg-t-30">
                    <button wire:click.prevent='update' class="btn btn-outline-primary mg-r-5 "
                        wire:loading.attr='disabled'>تحديث</button>
                    <button wire:click.prevent="cancel" class="btn btn-outline-secondary mg-r-5">إلغاء</button>
                </div>
            </form>
        @break

        @case('ableToRemove')
            <form action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">اسم المنتج:
                        <span class="text-danger">
                            <x-input-error input="name"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->name }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($product->imgs as $img)
                            <img src="{{ asset('products/imgs/' . $img->path) }}" alt="صورة المنتج"
                                class="img-fluid rounded border" style="max-width:200px; height:auto;">
                        @endforeach
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">وصف المنتج:
                        <span class="text-danger">
                            <x-input-error input="description"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->desc }}</p>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-12 form-control-label fw-bold">مواصفات المنتج:</label>

                    <div class="row mg-t-20">
                        <label class="col-sm-12 form-control-label fw-bold">مواصفات المنتج:</label>

                        <div class="col-sm-12">
                            <!-- جدول المواصفات -->
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered table-hover" id="specsTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 10%">ترتيب الميزة</th>
                                            <th style="width: 45%">اسم الميزة</th>
                                            <th style="width: 45%">الوصف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < count($SpecNamesArray); $i++)
                                            <tr>
                                                <td>{{ $SpecOrdersArray[$i] }}</td>
                                                <td>{{ $SpecNamesArray[$i] }}</td>
                                                <td>{{ $SpecDescsArray[$i] }}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">السعر :
                        <span class="text-danger">
                            <x-input-error input="price"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->price }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الكمية:
                        <span class="text-danger">
                            <x-input-error input="quantity"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->quantity }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الكمية المسموحة للشراء:
                        <span class="text-danger">
                            <x-input-error input="able_to_buy_quantity"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->able_to_buy_quantity }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">القسم:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->catigory->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الصنف:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->tag->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الماركة:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->brand->name }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">تاريخ الإنشاء:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->created_at->format('Y/m/d | h:i a') }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">تاريخ آخر تعديل:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->updated_at->format('Y/m/d | h:i a') }}</p>
                    </div>
                </div>

                <div class="form-group text-right mt-3">
                    <button wire:click.prevent='destroy'
                        class="btn btn-outline-danger mg-r-5 "wire:loading.attr='disabled'>نعم، احذف</button>
                    <button wire:click.prevent="cancel" class="btn btn-outline-primary mg-r-5">لا، تراجع</button>
                </div>
            </form>
        @break

        @case('deleted')
            تم الحذف
            @if (session('deleted'))
                <div class="alert alert-success mg-r-5" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong class="d-block d-sm-inline-block-force">تم بنجاح!</strong> {{ session('deleted') }}
                </div><!-- alert -->
            @endif
        @break

        @case('offer')
            <form action="" target="" method="POST">

                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label"> السعر الجديد حسب العرض: <span class="tx-danger"><x-input-error
                                input="offer_price"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='offer_price' type="number" min="0" class="form-control"
                            placeholder="أدخل سعر المنتج">
                    </div>
                </div>
                @if ($product->offer_ends_at)
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label"> ينتهي العرض في : <span class="tx-danger"></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            {{ $product->offer_ends_at->format('Y/m/d | h:i a') }}
                        </div>
                    </div>
                @endif
                <hr>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">تعيين موعد نهاية العرض : </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="checkbox" wire:model='set_date' value="true" class="form-control">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">تحديد تاريخ نهاية العرض : <span
                            class="tx-danger"><x-input-error input="offer_ends_at_date"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='offer_ends_at_date' type="date" class="form-control">
                    </div>
                    <label class="col-sm-4 form-control-label">تحديد وقت انتهاء العرض : <span class="tx-danger"><x-input-error
                                input="offer_ends_at_time"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='offer_ends_at_time' type="time" class="form-control">
                    </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                    <button wire:click.prevent='submitOffer' class="btn btn-info mg-r-5" wire:loading.attr='disabled'>تأكيد
                        العرض</button>
                    <button wire:click.prevent="cancel" class="btn btn-secondary">تراجع</button>
                    @if ($product->has_offer)
                        <button wire:click.prevent="deleteOffer" class="btn btn-danger">حذف العرض</button>
                    @endif
                </div>
            </form>
        @break

        @case('default')
            <form action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">اسم المنتج:
                        <span class="text-danger">
                            <x-input-error input="name"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->name }}</p>
                    </div>
                </div>
                @if ($product->imgs->isNotEmpty())
                    <div class="form-group row">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($product->imgs as $img)
                                <img src="{{ asset('products/imgs/' . $img->path) }}" alt="صورة المنتج"
                                    class="img-fluid rounded border" style="max-width:200px; height:auto;">
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">وصف المنتج:
                        <span class="text-danger">
                            <x-input-error input="description"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->desc }}</p>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-12 form-control-label fw-bold">مواصفات المنتج:</label>

                    <div class="col-sm-12">
                        <!-- جدول المواصفات -->
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-hover" id="specsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 10%">ترتيب الميزة</th>
                                        <th style="width: 45%">اسم الميزة</th>
                                        <th style="width: 45%">الوصف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($SpecNamesArray); $i++)
                                        <tr>
                                            <td>{{ $SpecOrdersArray[$i] }}</td>
                                            <td>{{ $SpecNamesArray[$i] }}</td>
                                            <td>{{ $SpecDescsArray[$i] }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">السعر :
                        <span class="text-danger">
                            <x-input-error input="price"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->price }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الكمية:
                        <span class="text-danger">
                            <x-input-error input="quantity"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->quantity }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الكمية المسموحة للشراء:
                        <span class="text-danger">
                            <x-input-error input="able_to_buy_quantity"></x-input-error>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->able_to_buy_quantity }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">القسم:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->catigory->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الصنف:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->tag->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">الماركة:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->brand->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">تاريخ الإنشاء:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->created_at->format('Y/m/d | h:i a') }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">تاريخ آخر تعديل:</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $product->updated_at->format('Y/m/d | h:i a') }}</p>
                    </div>
                </div>

                <div class="form-group text-right mt-3">
                    <button wire:click.prevent='edit' class="btn btn-outline-warning mg-r-5 ">تعديل</button>
                    <button wire:click.prevent="remove" class="btn btn-outline-danger mg-r-5">حذف</button>
                    @if ($product->available)
                        <button wire:click.prevent="unavailable" class="btn btn-outline-success mg-r-5">متاح حاليا</button>
                    @else
                        <button wire:click.prevent="available" class="btn btn-outline-secondary mg-r-5">غير متاح
                            حاليا</button>
                    @endif
                    @if ($product->special)
                        <button wire:click.prevent="notSpecial" class="btn btn-outline-primary mg-r-5">منتج مميز </button>
                    @else
                        <button wire:click.prevent="special" class="btn btn-outline-secondary mg-r-5">منتج غير مميز
                        </button>
                    @endif
                    @if ($product->has_offer)
                        <button wire:click.prevent="offer" class="btn btn-outline-teal mg-r-5"> تخصيص العرض </button>
                    @else
                        <button wire:click.prevent="offer" class="btn btn-outline-teal mg-r-5"> انشاء عرض
                        </button>
                    @endif
                </div>

                @if (session('updated'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>تم بنجاح!</strong> {{ session('updated') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </form>
        @break

        @default
    @endswitch

</div>
