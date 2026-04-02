@extends('user.auth.partial.master')
@section('title')
    إنشاء حساب
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
                    <i class="fa-solid fa-store"></i>
                </div>
                <h2 class="fw-bold mb-1">متجري</h2>
                <p class="small text-muted" style="color: #607d8b; margin-bottom: 0;">سجل الآن</p>
            </div>

            <form action="{{ route('user.register.store') }}" method="POST">
                @csrf

                <!-- حقل الاسم -->
                <div class="input-group-custom">
                    <label class="form-label small mb-1 d-block" style="font-size: 0.8rem;">الاسم الكامل</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control-glass input-name"
                        placeholder="الاسم" required>
                    @error('name')
                        <div class="text-danger-custom">{{ $message }}</div>
                    @enderror
                </div>

                <!-- حقل البريد -->
                <div class="input-group-custom">
                    <label class="form-label small mb-1 d-block" style="font-size: 0.8rem;">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control-glass input-email"
                        placeholder="example@gmail.com" required>
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
                </div>

                <!-- حقل تأكيد كلمة المرور -->
                <div class="input-group-custom">
                    <label class="form-label small mb-1 d-block" style="font-size: 0.8rem;">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control-glass input-check"
                        placeholder="••••••••" required>
                </div>

                <!-- زر التسجيل -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-register">
                        إنشاء حساب
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
                        لديك حساب؟ <a href="{{ route('user.login.create') }}" class="text-decoration-none fw-bold"
                            style="color: #1565c0;">دخول</a>
                    </div>
                    <a href={{ route('user.home') }} class="text-decoration-none" style="color: #78909c;">
                        الرئيسية
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
