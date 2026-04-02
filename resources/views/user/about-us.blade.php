@extends('user.layouts.master')
@section('title')
    من نحن
@endsection
@section('content')
    <!-- قسم الهيدر -->
    <header class="hero-section">
        <div class="container">
            <h1 class="hero-title">قصتنا ورسالتنا</h1>
            <p class="lead">أكثر من مجرد متجر، نحن شركاء في نجاحك وراحتك</p>
            <a href={{ route('user.home') }} class="btn btn-light btn-lg mt-3">تسوق الآن</a>
        </div>
    </header>

    <!-- من نحن (النص التعريفي) -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src={{ asset('assets/img/me.jpg') }} alt="من نحن" class="img-fluid rounded shadow" width="500px">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title text-end">من نحن</h2>
                    <p class="lead text-muted">نبدأ رحلتنا من شغف بجلب الأفضل...</p>
                    <p>
                        أهلاً بك في <strong>متجري</strong>. نحن منصة رائدة تهدف لتوفير أفضل المنتجات والخدمات
                        لعملائنا الكرام. بدأنا فكرتنا من رؤية بسيطة: تسهيل الوصول إلى الجودة العالية بأسعار منافسة.
                    </p>
                    <p>
                        نؤمن بأن التسوق الإلكتروني يجب أن يكون تجربة ممتعة، آمنة، وسريعة. لهذا السبب، نعمل يومياً على
                        تحديث تشكيلاتنا وضمان خدمة عملاء تتجاوز توقعاتكم.
                    </p>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="fa fa-check-circle text-success ms-2"></i> جودة مضمونة 100%</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-success ms-2"></i> دعم فني متواصل 24/7</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-success ms-2"></i> شحن سريع لجميع المناطق
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- لماذا نحن (المميزات) -->
    <section class="section-padding bg-light-gray">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">لماذا تختارنا؟</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="icon-circle">
                            <i class="fa fa-gem"></i>
                        </div>
                        <h4>جودة عالية</h4>
                        <p class="text-muted">نختار منتجاتنا بعناية فائقة لضمان حصولك على الأفضل دائماً.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="icon-circle">
                            <i class="fa fa-shipping-fast"></i>
                        </div>
                        <h4>توصيل سريع</h4>
                        <p class="text-muted">شبكة توصيل واسعة تضمن وصول طلباتك في أسرع وقت ممكن.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="icon-circle">
                            <i class="fa fa-headset"></i>
                        </div>
                        <h4>دعم متواصل</h4>
                        <p class="text-muted">فريق خدمة العملاء جاهز للرد على استفساراتكم في أي وقت.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- رؤيتنا ورسالتنا -->
    <section class="section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6 mb-4">
                    <div class="p-4 border rounded h-100">
                        <i class="fa fa-eye fa-3x text-primary mb-3"></i>
                        <h3>رؤيتنا</h3>
                        <p class="text-muted">أن نكون الخيار الأول والأمثل للعملاء في منطقتنا، وأن نساهم في بناء تجربة
                            تسوق إلكترونية تستند إلى الثقة والشفافية.</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="p-4 border rounded h-100">
                        <i class="fa fa-bullseye fa-3x text-primary mb-3"></i>
                        <h3>رسالتنا</h3>
                        <p class="text-muted">توفير حلول تسوق مبتكرة تلبي احتياجات العملاء وتفوق توقعاتهم، من خلال تقديم
                            منتجات متميزة وخدمة استثنائية.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- إحصائيات (اختياري) -->
    <section class="section-padding bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0 counter-box">
                    <div class="counter-number">+5000</div>
                    <p>عميل سعيد</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0 counter-box">
                    <div class="counter-number">+200</div>
                    <p>منتج مميز</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0 counter-box">
                    <div class="counter-number">+50</div>
                    <p>مندوب شحن</p>
                </div>
                <div class="col-md-3 counter-box">
                    <div class="counter-number">5</div>
                    <p>سنوات خبرة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- تذييل الصفحة -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container text-center">
            <h3>متجري</h3>
            <p class="text-white-50 mb-4">وجهتك الأولى للتسوق الإلكتروني الآمن والممتع.</p>

            <div class="mb-4">
                <a href="#" class="text-white mx-2 fs-4"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white mx-2 fs-4"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white mx-2 fs-4"><i class="fab fa-instagram"></i></a>
            </div>

            <hr class="border-secondary">
            <p class="mb-0 small text-white-50">&copy; 2023 جميع الحقوق محفوظة لـ متجري.</p>
        </div>
    </footer>
@endsection
