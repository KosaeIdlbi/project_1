<div class="col-md-6 col-lg-4 mg-b-20">
    @switch($show)
        @case('default')
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="tx-15 mg-b-0">{{ $admin->name }}</h6>
                    <small>{{ $admin->email }}</small>
                </div>
                <div class="card-body">
                    <div class="mg-b-15">
                        <label class="tx-10 tx-bold tx-gray-700 d-block mb-1">الصلاحيات</label>
                        <select multiple readonly class="form-control select2" data-placeholder="اضف الصلاحيات">
                            @foreach ($admin->permissions as $permission)
                                <option value={{ $permission->name }}>{{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mg-b-20">
                        <label class="tx-10 tx-bold tx-gray-700 d-block mb-1">الأدوار</label>
                        <select multiple readonly class="form-control select2" data-placeholder="اضف الصلاحيات">
                            @foreach ($admin->roles as $role)
                                <option value={{ $role->name }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <button wire:click.prevent="edit" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit mg-r-5"></i> تعديل
                        </button>

                        @if ($admin->deleted_at)
                            <button wire:click.prevent="restore" class="btn btn-danger btn-sm">
                                <i class="fa fa-toggle-off mg-r-5"></i> غير نشط
                            </button>
                        @else
                            <button wire:click.prevent="delete" class="btn btn-success btn-sm">
                                <i class="fa fa-toggle-on mg-r-5"></i> نشط
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @break

        @case('editable')
            <div class="card border-warning">
                <div class="card-header bg-warning text-white">
                    <h6 class="tx-15 mg-b-0">تعديل: {{ $admin->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="mg-b-15">
                        <label class="tx-10 tx-bold tx-gray-700 d-block mb-1">الاسم</label>
                        <p class="form-control-static">{{ $admin->name }}</p>
                    </div>

                    <div class="mg-b-15">
                        <label class="tx-10 tx-bold tx-gray-700 d-block mb-1">البريد الإلكتروني</label>
                        <p class="form-control-static">{{ $admin->email }}</p>
                    </div>

                    <div class="mg-b-15">
                        <label class="tx-10 tx-bold tx-gray-700 d-block mb-1">الصلاحيات</label>
                        <select multiple class="form-control" data-placeholder="اضف الصلاحيات"
                            wire:model='admin_has_permissions'>
                            @foreach ($permissions as $permission)
                                <option value={{ $permission->id }}>{{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mg-b-20">
                        <label class="tx-10 tx-bold tx-gray-700 d-block mb-1">الأدوار</label>
                        <select multiple class="form-control" data-placeholder="اضف الصلاحيات" wire:model='admin_has_roles'>
                            @foreach ($roles as $role)
                                <option value={{ $role->id }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button wire:click.prevent="save" class="btn btn-primary btn-sm flex-fill">
                            <i class="fa fa-save mg-r-5"></i> حفظ
                        </button>
                        <button wire:click.prevent="cancel" class="btn btn-secondary btn-sm flex-fill">
                            <i class="fa fa-times mg-r-5"></i> إلغاء
                        </button>
                    </div>
                </div>
            </div>
        @break

        @default
    @endswitch
</div>
