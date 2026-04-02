@include('admin.layouts.header')

<!-- ########## START: LEFT PANEL ########## -->
{{-- @include('admin.layouts.right-panel') --}}
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
@include('admin.layouts.head')
<!-- ########## END: HEAD PANEL ########## -->

<!-- ########## START: RIGHT PANEL ########## -->
@include('admin.layouts.left-panel')
<!-- ########## END: RIGHT PANEL ########## --->

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel" dir="rtl">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item">لوحة التحكم</a>
        <span class="breadcrumb-item active">@yield('title')</span>
    </nav>
    @yield('content')

</div><!-- sl-mainpanel -->

<!-- ########## END: MAIN PANEL ########## -->


@include('admin.layouts.footer')
