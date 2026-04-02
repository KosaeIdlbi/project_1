<div>
    <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <form action="">
                        <div class="row">
                            <label class="col-sm-4 form-control-label">اسم الدور: <span class="tx-danger"><x-input-error
                                        input="role_name"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input wire:model='role_name' type="text" class="form-control"
                                    placeholder="أدخل اسم الدور">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 form-control-label">اختر الصلاحيات: <span
                                    class="tx-danger"><x-input-error input="role_name"></x-input-error></span></label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                @foreach ($permissions as $permission)
                                    @if (in_array($permission->name, $role_has_permissions))
                                        <button disabled class="btn btn-primary">
                                            {{ $permission->name }}
                                        </button>
                                    @else
                                        <button wire:click.prevent="addPermission('{{ $permission->name }}')"
                                            class="btn btn-primary">
                                            {{ $permission->name }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <br>
                        <button wire:click.prevent='store' class="btn btn-info mg-r-5"
                            wire:loading.attr='disabled'>حفظ</button>
                        <button wire:click.prevent="cancel" class="btn btn-secondary">إلغاء</button>
                    </form>
                </div>
                <div dir="ltr" class="table-responsive mg-t-25">
                    <table class="table table-hover table-bordered mg-b-0">
                        <thead class="bg-primary">
                            <tr>
                                <th> اسم الدور</th>
                                <th> صلاحيات الدور</th>
                                <th>حذف </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                            {{ $permission->name }},
                                        @endforeach
                                    </td>
                                    <td>
                                        <button wire:click.prevent="delete({{ $role->id }})"
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
