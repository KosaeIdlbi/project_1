@extends('user.auth.partial.master')
@section('title')
    تسجيل الدخول
@endsection

@section('content')
    <style>
        /* 1. الخلفية */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eef2f6;
            background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-blend-mode: soft-light;
        }
    </style>


    <div class="container d-flex align-items-center justify-content-center h-100">
        <div class="glass-card">

            <div class="text-center mb-3">
                <div class="logo-icon">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </div>
                <h2 class="fw-bold mb-1">تسجيل الدخول</h2>
                <p class="small text-muted" style="color: #607d8b; margin-bottom: 0;">أهلاً بعودتك</p>
            </div>

            <!-- رسائل التنبيه -->
            <div class="text-center mb-2" style="color: #d32f2f; font-size: 0.85rem;">
                <x-redirect-message name="fail"></x-redirect-message>
            </div>
            <div class="text-center mb-2" style="color: #2e7d32; font-size: 0.85rem;">
                <x-redirect-message name='password_updated'></x-redirect-message>
            </div>

            <form action="{{ route('user.login.store') }}" method="POST">
                @csrf

                <!-- حقل البريد -->
                <div class="input-group-custom">
                    <label class="form-label small mb-1 d-block" style="font-size: 0.8rem;">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control-glass input-email"
                        placeholder="name@example.com" required>
                    @error('email')
                        <div class="text-danger-custom">{{ $message }}</div>
                    @enderror
                </div>

                <!-- حقل كلمة المرور -->
                <div class="input-group-custom">
                    <label class="form-label small mb-1 d-block" style="font-size: 0.8rem;">كلمة المرور</label>
                    <input type="password" name="password" class="form-control-glass input-lock" placeholder="••••••••"
                        required>
                    @error('password')
                        <div class="text-danger-custom">{{ $message }}</div>
                    @enderror

                    <!-- خيارات إضافية -->
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label text-muted" style="font-size: 0.8rem;" for="rememberMe">
                                تذكرني
                            </label>
                        </div>
                        <a href="{{ route('user.password.create') }}" class="text-decoration-none small"
                            style="color: #1976d2; font-size: 0.8rem;">نسيت كلمة المرور؟</a>
                    </div>
                </div>

                <!-- زر الدخول -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-login">
                        دخول
                    </button>
                </div>

                <!-- الفاصل -->
                <div class="d-flex align-items-center text-muted mb-2" style="color: #90a4ae; font-size: 0.8rem;">
                    <hr class="flex-grow-1">
                    <span class="px-2">أو</span>
                    <hr class="flex-grow-1">
                </div>

                <!-- الروابط -->
                <div class="text-center small">
                    <div class="mb-1">
                        ليس لديك حساب؟ <a href="{{ route('user.register.create') }}" class="text-decoration-none fw-bold"
                            style="color: #1565c0;">إنشاء حساب</a>
                    </div>
                    <a href={{ route('user.home') }} class="text-decoration-none" style="color: #78909c;">
                        الرئيسية
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
