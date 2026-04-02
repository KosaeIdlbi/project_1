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

                    <form action="" target="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">كلمة المرور: <span
                                    class="tx-danger"><x-input-error input="password"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='password' type="text" class="form-control"
                                    placeholder="أدخل كلة المرور">
                            </div>
                        </div>
                        <br>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">تأكيد كلمة المرور: <span
                                    class="tx-danger"><x-input-error
                                        input="password_confirmation"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='password_confirmation' type="text" class="form-control"
                                    placeholder="تأكيد كلمة المرور">
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-30">
                            <button wire:click.prevent='save' class="btn btn-info mg-r-5"
                                wire:loading.attr='disabled'>حفظ الكلمة</button>
                            <button wire:click.prevent="resetValues" class="btn btn-secondary">إلغاء</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
