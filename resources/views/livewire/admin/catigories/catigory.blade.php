<div>
    @switch($show)
        @case('ableToEdit')
            <form action="" target="" method="POST">
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">اسم التصنيف: <span class="tx-danger"><x-input-error
                                input="name"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='name' type="text" class="form-control" placeholder="أدخل اسم التصنيف">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">ترتيب التصنيف: <span class="tx-danger"><x-input-error
                                input="order"></x-input-error></span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input wire:model='order' type="text" class="form-control" placeholder="أدخل ترتيب التصنيف">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">صورة القسم:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="custom-file">
                        <input type="file" id="file" class="custom-file-input" wire:model.live='Img'>
                        <span class="custom-file-control"></span>
                    </label>&nbsp;
                    <div wire:loading wire:target='Img'>
                        جاري التحميل، يرجى الانتظار...
                    </div>
                </div>
                @if (!$errors->has('Img') && $img_updated != false)
                    <div class="row mg-t-20">
                        <img src={{ $Img->temporaryURL() }} alt="" width="200px" hight="200px">
                    </div>
                @else
                    @if ($catigory->img != null && $img_updated == false)
                        <img src={{ asset('catigories/imgs/' . $catigory->img->path) }} alt="" width="200px"
                            hight="200px">
                    @endif
                @endif
                <span class="tx-danger">
                    <x-input-error input="Img"></x-input-error>
                </span>
                <div class="form-layout-footer mg-t-30">
                    <button wire:click.prevent='update' class="btn btn-outline-primary mg-r-5 " wire:loading.attr='disabled'>حفظ
                        التعديلات</button>
                    <button wire:click.prevent="cancel" class="btn btn-outline-secondary mg-r-5">إلغاء</button>
                </div>
            </form>
        @break

        @case('ableToRemove')
            <form action="" target="" method="POST">
                @if ($catigory->img != null)
                    <img src={{ asset('catigories/imgs/' . $catigory->img->path) }} alt="" width="200px"
                        hight="200px">
                @endif
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">اسم التصنيف:</label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->name }}
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">ترتيب التصنيف: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->order }}
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->created_at->format('Y/m/d | H:i') }}
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->updated_at->format('Y/m/d | H:i') }}
                    </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                    <button wire:click.prevent='destroy' class="btn btn-outline-danger mg-r-5 "wire:loading.attr='disabled'>نعم،
                        احذف</button>
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

        @case('default')
            <form action="" target="" method="POST">
                @if ($catigory->img != null)
                    <img src={{ asset('catigories/imgs/' . $catigory->img->path) }} alt="" width="200px"
                        hight="200px">
                @endif
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">اسم القسم:</label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->name }}
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">ترتيب القسم: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->order }}
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->created_at->format('Y/m/d | H:i') }}
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{ $catigory->updated_at->format('Y/m/d | H:i') }}
                    </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                    <button wire:click.prevent='edit' class="btn btn-outline-warning mg-r-5 ">تعديل</button>
                    <button wire:click.prevent="remove" class="btn btn-outline-danger mg-r-5">حذف</button>
                    @if ($catigory->available)
                        <button wire:click.prevent="unavailable" class="btn btn-outline-success mg-r-5">متاح حاليا</button>
                    @else
                        <button wire:click.prevent="available" class="btn btn-outline-secondary mg-r-5">غير متاح
                            حاليا</button>
                    @endif
                    @if (session('updated'))
                        <div class="alert alert-success mg-r-5" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">تم بنجاح!</strong>
                            {{ session('updated') }}
                        </div><!-- alert -->
                    @endif
                </div>
            </form>
        @break

        @default
    @endswitch

</div>
