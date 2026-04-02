<div class="sl-logo"><a href="">{{ config('app.name') }}</a></div>
<div class="sl-sideleft" dir="rtl">
    <label class="sidebar-label">Navigation</label>
    <div class="sl-sideleft-menu">
        <a href={{ route('admin.dashboard') }} class="sl-menu-link">
            <div class="sl-menu-item">
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        @if ($admin->hasAnyPermission(['charge_orders', 'denied_reasons', 'sham_account']))
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    @livewire('admin.charger.new-charge-notification')
                    <span class="menu-item-label">شحن الأرصدة</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                @if ($admin->hasPermissionTo('charge_orders'))
                    <li class="nav-item">
                        <a href={{ route('admin.chargerView') }} class="nav-link">طلبات الشحن</a>
                    </li>
                @endif
                @if ($admin->hasPermissionTo('denied_reasons'))
                    <li class="nav-item"><a href={{ route('admin.chargerAddDeniedReasons') }} class="nav-link">تعيين
                            أسباب
                            رفض
                            عمليات الشحن</a></li>
                @endif
                @if ($admin->hasPermissionTo('sham_account'))
                    <li class="nav-item"><a href={{ route('admin.chargerAddShamcash') }} class="nav-link">تعيين حساب شام
                            كاش</a>
                    </li>
                @endif
            </ul>
        @endif

        @if ($admin->hasPermissionTo('client_orders'))
            <a href={{ route('admin.ordersView') }} class="sl-menu-link">
                <div class="sl-menu-item">
                    @livewire('admin.orders.new-order-notification')
                    <span class="menu-item-label">طلبات الزبائن</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
        @endif

        @if ($admin->hasPermissionTo('coupons'))
            <a href={{ route('admin.couponsView') }} class="sl-menu-link">
                <div class="sl-menu-item">
                    <span class="menu-item-label">الكوبونات</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
        @endif

        @if ($admin->hasPermissionTo('catigories'))
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <span class="menu-item-label">الأقسام</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href={{ route('admin.catigoriesAdd') }} class="nav-link">اضافة قسم جديد</a></li>
                <li class="nav-item"><a href={{ route('admin.catigoriesView') }} class="nav-link">عرض الأقسام
                        الموجودة</a>
                </li>
            </ul>
        @endif

        @if ($admin->hasPermissionTo('brands'))
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <span class="menu-item-label">الماركات</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href={{ route('admin.brandsAdd') }} class="nav-link">اضافة
                        ماركة جديدة</a></li>
                <li class="nav-item"><a href={{ route('admin.brandsView') }} class="nav-link">عرض
                        الماركات الموجودة</a></li>
            </ul>
        @endif

        @if ($admin->hasPermissionTo('tags'))
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <span class="menu-item-label">الأصناف</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href={{ route('admin.tagsAdd') }} class="nav-link">اضافة
                        صنف جديد</a></li>
                <li class="nav-item"><a href={{ route('admin.tagsView') }} class="nav-link">عرض
                        الأصناف الموجودة</a></li>
            </ul>
        @endif

        @if ($admin->hasPermissionTo('products'))
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <span class="menu-item-label">المنتجات</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href={{ route('admin.productsAdd') }} class="nav-link">اضافة منتج جديد</a>
                </li>
                <li class="nav-item"><a href={{ route('admin.productsView') }} class="nav-link">عرض المنتجات</a></li>
            </ul>
        @endif

        @if (
            $admin->hasAnyPermission([
                'set_employees_roles_permissions',
                'set_roles',
                'set_permissions',
                'set_register_password',
            ]))
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    {{-- @livewire('admin.charger.new-charge-notification') --}}
                    <span class="menu-item-label">قسم الموظفين</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                @if ($admin->hasPermissionTo('set_permissions'))
                    <li class="nav-item"><a href={{ route('admin.employeesSetPermissions') }} class="nav-link">تعيين
                            الصلاحيات
                        </a></li>
                @endif
                @if ($admin->hasPermissionTo('set_roles'))
                    <li class="nav-item"><a href={{ route('admin.employeesSetRoles') }} class="nav-link">تعيين الأدوار
                        </a>
                    </li>
                @endif
                @if ($admin->hasPermissionTo('set_employees_roles_permissions'))
                    <li class="nav-item"><a href={{ route('admin.employeesSetEmployeeRole') }} class="nav-link">تعيين
                            أدوار
                            وصلاحيات
                            الموظفين</a></li>
                @endif
                @if ($admin->hasPermissionTo('set_register_password'))
                    <li class="nav-item"><a href={{ route('admin.employeesSetRegisterPassword') }}
                            class="nav-link">تعيين
                            كلمة
                            مرور التسجيل </a></li>
                @endif
            </ul>
        @endif
    </div><!-- sl-sideleft-menu -->
</div><!-- sl-sideleft -->
