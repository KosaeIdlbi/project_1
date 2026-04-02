<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ config('app.name') }} - @yield('title') </title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- خط Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- مكتبة الأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href={{ asset('assets/css/front.css') }}>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @endif
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">

            <!-- 1. زر القائمة (يمين) -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- 2. الشعار (يمين - بجانب الزر في الموبايل، وسط في الديسكتوب) -->
            <!-- ملاحظة: في RTL، يبدأ الترتيب من اليمين، لذا الشعار يأتي بعد التوجر مباشرة -->
            <a class="navbar-brand ms-auto mx-lg-auto" href={{ route('user.home') }}>
                <i class="bi bi-shop text-primary fs-4 me-1"></i>
                <span class="fw-bold text-dark fs-4">متجر</span><span class="fw-bold text-primary fs-4">ي</span>
            </a>

            <!-- 3. مجموعة العناصر (المفضلة + السلة + الحساب) -> تذهب لليسار -->
            <div class="d-flex align-items-center gap-2 ms-auto order-last">

                @if (!$user)
                    <!-- حالة الزائر -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('user.login.create') }}"
                            class="btn btn-outline-primary rounded-pill px-3 d-none d-sm-block">دخول</a>
                        <a href="{{ route('user.register.create') }}"
                            class="btn btn-primary rounded-pill px-3 d-none d-sm-block">حساب جديد</a>
                    </div>
                @else
                    <!-- عنصر المفضلة -->
                    @livewire('user.products.fav.fav-button', ['user' => $user])

                    <!-- عنصر السلة -->
                    @livewire('user.products.cart.cart-button', ['user' => $user])

                    <!-- عنصر الحساب (آخر عنصر على اليسار) -->
                    <div class="vr d-none d-lg-block mx-1 h-50"></div> <!-- فاصل خطي للديسكتوب -->

                    <!-- حالة المستخدم المسجل -->
                    <div class="dropdown">
                        <button
                            class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2 rounded-pill px-2"
                            type="button" data-bs-toggle="dropdown">
                            @livewire('user.navbar-profile-data', ['user' => $user])
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow text-end">
                            <li>
                                <h6 class="dropdown-header">حسابي</h6>
                            </li>
                            <li><a class="dropdown-item" href={{ route('user.profile') }}><i
                                        class="bi bi-person me-2"></i> الملف
                                    الشخصي</a></li>
                            <li><a class="dropdown-item" href={{ route('user.orders') }}><i class="bi bi-bag me-2"></i>
                                    طلباتي</a></li>
                            <li><a class="dropdown-item" href={{ route('user.wallet.create') }}><i
                                        class="bi bi-wallet me-2"></i> المحفظة</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> تسجيل خروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>

            <!-- 4. محتوى النافبار (الروابط) -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- في الموبايل: سنظهر الروابط وأزرار الدخول هنا -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 w-100 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href={{ route('user.home') }}>الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold"
                            href={{ route('user.ViewProducts', [
                                'BrandName' => 'all',
                                'CatigoryName' => 'all',
                                'TagName' => 'all',
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}>المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href={{ route('user.aboutUs') }}>من نحن</a>
                    </li>
                </ul>

                <!-- نسخة الموبايل لأزرار الدخول (تظهر فقط داخل القائمة المنسدلة) -->
                @if (!$user)
                    <div class="d-sm-none d-flex gap-2 justify-content-center pb-2 border-top mt-2 pt-2">
                        <a href="{{ route('user.login.create') }}"
                            class="btn btn-outline-primary rounded-pill w-50">دخول</a>
                        <a href="{{ route('user.register.create') }}" class="btn btn-primary rounded-pill w-50">حساب
                            جديد</a>
                    </div>
                @endif
            </div>

        </div>
    </nav>
    <br>
