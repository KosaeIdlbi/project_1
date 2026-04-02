<div>
    @switch($show)
        @case('received')
            @if ($request->img)
                <img src={{ asset('shamcash/imgs/' . $request->img->path) }} alt="" width="400px" hight="400px">
            @endif
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">المبلغ المحول :</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->amount }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">رقم التحويل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->transcation_number }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">حالة الطلب: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->charge_status }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->created_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->updated_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="form-layout-footer mg-t-30">
                <button wire:click.prevent='deniedRequest' class="btn btn-outline-danger mg-r-5 ">رفص الطلب</button>
                <button wire:click.prevent="chargeRequest" class="btn btn-outline-success mg-r-5">شحن الحساب</button>
                @if (session('charged_faild'))
                    <div class="alert alert-danger mg-r-5" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong class="d-block d-sm-inline-block-force"></strong>
                        {{ session('charged_faild') }}
                    </div><!-- alert -->
                @endif
            </div>
        @break

        @case('waiting')
            @if ($request->img)
                <img src={{ asset('shamcash/imgs/' . $request->img->path) }} alt="" width="400px" hight="400px">
            @endif
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">المبلغ المحول :</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->amount }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">رقم التحويل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->transcation_number }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">حالة الطلب: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->charge_status }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->created_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->updated_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="form-layout-footer mg-t-30">
                <button wire:click.prevent='receive' class="btn btn-outline-primary mg-r-5 ">استلام الطلب</button>
            </div>
        @break

        @case('denied')
            <div class="row mg-t-20">
                @if ($request->img)
                    <img src={{ asset('shamcash/imgs/' . $request->img->path) }} alt="" width="400px" hight="400px">
                @endif
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">المبلغ المحول :</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->amount }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">رقم التحويل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->transcation_number }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">حالة الطلب: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->charge_status }}
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mg-b-20">
                <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">سبب رفض التحويل</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-list mg-r-5"></i>
                    </span>
                    <select wire:model='DeniedReason' class="form-control select2">
                        <option value="">
                            بدون سبب
                        </option>
                        @if ($denied_reasons->isNotEmpty())
                            @foreach ($denied_reasons as $denied_reason)
                                <option value="{{ $denied_reason->id }}">{{ $denied_reason->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->created_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->updated_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
        @break

        @case('success')
            <div class="row mg-t-20">
                @if ($request->img)
                    <img src={{ asset('shamcash/imgs/' . $request->img->path) }} alt="" width="400px" hight="400px">
                @endif
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">المبلغ المحول :</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->amount }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">رقم التحويل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->transcation_number }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">حالة الطلب: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->charge_status }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->created_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->updated_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
        @break

        @case('deniedRequest')
            <div class="row mg-t-20">
                @if ($request->img)
                    <img src={{ asset('shamcash/imgs/' . $request->img->path) }} alt="" width="400px"
                        hight="400px">
                @endif
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">المبلغ المحول :</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->amount }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">رقم التحويل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->transcation_number }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">حالة الطلب: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->charge_status }}
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mg-b-20">
                <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">سبب رفض التحويل</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-list mg-r-5"></i>
                    </span>
                    <select wire:model='DeniedReason' class="form-control select2">
                        <option value="">
                            بدون سبب
                        </option>
                        @if ($denied_reasons->isNotEmpty())
                            @foreach ($denied_reasons as $denied_reason)
                                <option value="{{ $denied_reason->id }}">{{ $denied_reason->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->created_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->updated_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="form-layout-footer mg-t-30">
                <button wire:click.prevent='confirmDenied' class="btn btn-outline-danger mg-r-5 ">تأكيد الرفض</button>
                <button wire:click.prevent="cancel" class="btn btn-outline-secondary mg-r-5">تراجع</button>
            </div>
        @break

        @case('chargeRequest')
            <div class="row mg-t-20">
                @if ($request->img)
                    <img src={{ asset('shamcash/imgs/' . $request->img->path) }} alt="" width="400px"
                        hight="400px">
                @endif
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">المبلغ المحول :</label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->amount }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">رقم التحويل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->transcation_number }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">حالة الطلب: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->charge_status }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ الإنشاء: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->created_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">تاريخ آخر تعديل: </label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    {{ $request->updated_at->format('Y/m/d | h:i a') }}
                </div>
            </div>
            <div class="form-layout-footer mg-t-30">
                <button wire:click.prevent='confirmCharge' class="btn btn-outline-success mg-r-5 ">تأكيد الشحن</button>
                <button wire:click.prevent="cancel" class="btn btn-outline-secondary mg-r-5">تراجع</button>
            </div>
        @break

        @default
    @endswitch

</div>
