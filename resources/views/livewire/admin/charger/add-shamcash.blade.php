<div>
    <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    @if (session('updated'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong class="d-block d-sm-inline-block-force">تم بنجاح!</strong> {{ session('updated') }}
                        </div><!-- alert -->
                    @endif
                    <form action="" target="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">رقم الحساب : <span
                                    class="tx-danger"><x-input-error
                                        input="account_number"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='account_number' type="text" class="form-control"
                                    placeholder="رقم الحساب">
                            </div>
                        </div>
                        <br>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">الحد الأدنى للشحن في المرة الواحدة: <span
                                    class="tx-danger"><x-input-error
                                        input="minimum_charge"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='minimum_charge' step="10" type="number" class="form-control"
                                    placeholder="أدخل الحد الأدنى للشحن في المرة الواحدة">
                            </div>
                        </div>
                        <br>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">الحد الأعلى للمحفظة: <span
                                    class="tx-danger"><x-input-error
                                        input="minimum_charge"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='maximum_charge' step="10" type="number" class="form-control"
                                    placeholder="أدخل الحد الأعلى للمحفظة">
                            </div>
                        </div>
                        <br>

                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">باركود الحساب</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="custom-file">
                                <input type="file" id="file" class="custom-file-input" wire:model.live='Img'>
                                <span class="custom-file-control"></span>
                            </label>&nbsp;
                            <div wire:loading wire:target='Img'>
                                جاري التحميل، يرجى الانتظار...
                            </div>
                        </div>
                        <span class="tx-danger">
                            <x-input-error input="Img"></x-input-error>
                        </span>
                        @if (!$errors->has('Img') && $Img)
                            <div class="row mg-t-20">
                                <img src={{ $Img->temporaryURL() }} alt="" width="200px" hight="200px">
                            </div>
                        @else
                            @if ($shamcash->img)
                                <img src={{ asset('shamcash/imgs/' . $shamcash->img->path) }} alt=""
                                    width="200px" hight="200px">
                            @endif
                        @endif
                        <div class="form-layout-footer mg-t-30">
                            <button wire:click.prevent='store' class="btn btn-info mg-r-5"
                                wire:loading.attr='store'>حفظ</button>
                            <button wire:click.prevent="resetValues" class="btn btn-secondary">إلغاء</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
