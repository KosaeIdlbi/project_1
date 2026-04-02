<div>
    <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">رمز الكوبون: <span class="tx-danger"><x-input-error
                                        input="code"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='code' type="text" class="form-control"
                                    placeholder="أدخل رمز الكوبون">
                            </div>
                        </div>
                        <br>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">نسبة الخصم بالمئة: <span
                                    class="tx-danger"><x-input-error input="discount"></x-input-error></span></label>
                            <div class="col-lg">
                                <input max="100" min="1" type="number" wire:model='discount'
                                    class="form-control" placeholder="أدخل نسبة الخصم">
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">تاريخ الانتهاء: <span
                                    class="tx-danger"><x-input-error input="expire_at"></x-input-error></span></label>
                            <div class="col-lg">
                                <input type="date" wire:model='expire_at' class="form-control"
                                    placeholder="أدخل تاريخ الانتهاء">
                            </div>
                        </div>
                        <button wire:click.prevent='store' class="btn btn-info mg-r-5"
                            wire:loading.attr='disabled'>حفظ</button>
                        <button wire:click.prevent="cancel" class="btn btn-secondary">إلغاء</button>
                    </form>
                </div>
                <div dir="ltr" class="table-responsive mg-t-25">
                    <table class="table table-hover table-bordered mg-b-0">
                        <thead class="bg-primary">
                            <tr>
                                <th> رمز الكوبون</th>
                                <th> نسبة الخصم</th>
                                <th>تاريخ الانتهاء</th>
                                <th>حذف </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->discount }}%</td>
                                    <td>{{ $coupon->expire_at->format('Y/m/d h:i a') }}</td>
                                    <td>
                                        <button wire:click.prevent="delete({{ $coupon->id }})"
                                            class="btn btn-danger">حذف</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div>
        </div>
    </div>
</div>
