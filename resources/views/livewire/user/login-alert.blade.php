<div>
    @if ($login_alert)
        <div class="login-overlay" id="loginAlert">
            <div class="login-overlay-content">

                <!-- زر الإغلاق -->
                <button wire:click.prevent='close'
                    class="position-absolute top-0 end-0 m-3 text-muted bg-transparent border-0 fs-4">
                    <i class="bi bi-x-lg"></i>
                </button>

                <div class="text-center">
                    <!-- دائرة الأيقونة -->
                    <div class="login-icon-circle mb-3 mx-auto">
                        <i class="bi bi-person-lock"></i>
                    </div>

                    <h4 class="fw-bold mb-2">تسجيل الدخول مطلوب</h4>
                    <p class="text-muted mb-4 px-4">
                        يجب عليك تسجيل الدخول أولاً لتتمكن من إتمام هذا الإجراء.
                    </p>

                    <div class="d-grid gap-2 px-4">
                        <a href={{ route('user.login.create') }} class="btn btn-primary btn-lg rounded-pill">
                            تسجيل الدخول
                        </a>
                        <a href={{ route('user.register.create') }}
                            class="btn btn-outline-secondary btn-lg rounded-pill">
                            إنشاء حساب جديد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
