<!-- =========================== -->
<!-- شريط التنقل الثاني (Sub Navbar) -->
<!-- =========================== -->
<nav class="navbar navbar-expand-lg bg-white border-bottom py-2 sticky-top" style="top: 70px; z-index: 999;">
    <div class="container">

        <!-- 1. زر القائمة للموبايل -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#subNavContent">
            <span class="navbar-toggler-icon small"></span>
        </button>

        <!-- 2. زر القائمة المنسدلة للأقسام (Desktop & Mobile) -->
        <!-- هذا الجزء يظهر دائماً في بداية الشريط -->
        <div class="dropdown">
            <button class="btn btn-dark btn-sm rounded-pill px-3 dropdown-toggle" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-list me-2"></i>الأقسام
            </button>
            <ul class="dropdown-menu shadow border-0 rounded-3">
                @foreach ($catigories as $catigory)
                    <li><a class="dropdown-item"
                            href={{ route('user.ViewProducts', [
                                'CatigoryName' => $catigory->name,
                                'BrandName' => 'all',
                                'TagName' => 'all',
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}>{{ $catigory->name }}</a>
                    </li>
                @endforeach

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item fw-bold text-primary" href={{ route('user.ViewCatigories') }}>عرض الكل</a>
                </li>
            </ul>
        </div>

        <!-- 3. الروابط السريعة (محتوى الشريط) -->
        <div class="collapse navbar-collapse" id="subNavContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-3"> <!-- pe-3 للمسافة من القائمة المنسدلة -->

                <!-- روابط الأقسام التي صممناها -->
                <li class="nav-item">
                    <a class="nav-link active" href="#special">عناصر مميزة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="#offers">عروض خاصة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success" href="#newest">وصل حديثاً</a>
                </li>

                <li class="nav-item"><span class="nav-link text-muted">|</span></li>

                <li class="nav-item">
                    <a class="nav-link" href={{ route('user.ViewBrands') }}>الماركات</a>
                </li>
            </ul>
            @livewire('user.products.home-search')
        </div>
    </div>
</nav>
