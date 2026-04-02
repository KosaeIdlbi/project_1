<div>
    <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="pd-20 pd-sm-40 form-layout form-layout-4">
                    <div class="col-lg-12 mg-b-20">
                        <label class="tx-11 tx-bold tx-gray-700 d-block mb-1">البحث بالاسم</label>
                        <div class="input-group">
                            <span class="input-group-addon bd bd-white bg-white">
                                <i class="fa fa-search tx-gray-400"></i>
                            </span>
                            <input list="admins" wire:model.live.debounce.1000ms="search"
                                class="form-control bd bd-l-0 pd-l-10" placeholder="اكتب اسم الموظف للبحث..."
                                autocomplete="off">
                            <datalist id="admins">
                                <option value="">الكل</option>
                                @foreach ($results as $result)
                                    <option value="{{ $result->name }}">{{ $result->name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                <!-- استبدال الجدول بالكروت -->
                <div class="row mg-t-25">
                    @foreach ($admins as $admin)
                        @livewire('admin.employees.employee', ['admin' => $admin, 'permissions' => $permissions, 'roles' => $roles], key($admin->id))
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mg-t-20">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div><!-- إضافة تنسيقات بسيطة -->
    <style>
        .gap-2 {
            gap: 0.5rem;
        }

        .flex-fill {
            flex: 1;
        }

        .card {
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            padding: 0.75rem 1.25rem;
        }

        @media (max-width: 768px) {
            .d-flex.gap-2 {
                flex-direction: column;
            }

            .btn-sm {
                width: 100%;
                margin-bottom: 0.25rem;
            }
        }
    </style>
</div>
