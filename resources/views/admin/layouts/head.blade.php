<div class="sl-header">
    <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i
                    class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i
                    class="icon ion-navicon-round"></i></a></div>
    </div><!-- sl-header-left -->

    <div class="sl-header-right">
        <nav class="nav">

            <x-redirect-message name="verified"></x-redirect-message>

            <!-- القائمة المنسدلة للبروفايل -->
            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    @livewire('admin.navbar-profile-data', ['admin' => $admin])
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href={{ route('admin.profile') }}><i class="icon ion-ios-person-outline"></i> الملف
                                الشخصي</a></li>
                        <form action={{ route('admin.logout') }} method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm mg-l-10 wd-170"
                                title="تسجيل الخروج">
                                <i class="fa fa-sign-out"></i>
                                <span class="hidden-md-down">خروج</span>
                            </button>
                        </form>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->

            &nbsp;&nbsp;&nbsp;
            <!-- زر الإشعارات -->
            {{-- <div class="navicon-right">
                <a id="btnRightMenu" href="" class="pos-relative">
                    <i class="icon ion-ios-bell-outline"></i>
                    <span class="square-8 bg-danger"></span>
                </a>
            </div><!-- navicon-right --> --}}

        </nav>
    </div><!-- sl-header-right -->
</div><!-- sl-header -->
