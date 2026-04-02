<div>
    <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">اسم السبب: <span class="tx-danger"><x-input-error
                                        input="name"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='name' type="text" class="form-control"
                                    placeholder="أدخل اسم السبب">
                            </div>
                        </div>
                        <br>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">وصف السبب: <span class="tx-danger"><x-input-error
                                        input="desc"></x-input-error></span></label>
                            <div class="col-lg">
                                <textarea rows="3" wire:model='desc' class="form-control" placeholder="أدخل وصف السبب"></textarea>
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
                                <th>اسم السبب</th>
                                <th>وصف السبب</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($denied_reasons as $denied_reason)
                                <tr>
                                    <td>{{ $denied_reason->name }}</td>
                                    <td>{{ $denied_reason->desc }}</td>
                                    <td>
                                        <button wire:click.prevent="delete({{ $denied_reason->id }})"
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
