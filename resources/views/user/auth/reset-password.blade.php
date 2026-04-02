@extends('user.auth.partial.master')
@section('title')
    reset-password
@endsection

@section('content')
    <!DOCTYPE html>

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
                    <i class="fa-solid fa-lock-open"></i>
                </div>
                <h2 class="fw-bold mb-1">تعيين كلمة مرور جديدة</h2>
                <p class="small text-muted" style="color: #607d8b; margin-bottom: 0;">أدخل كلمة المرور الجديدة</p>
            </div>

            <form action="{{ route('user.password.update', ['token' => $token]) }}" method="POST">
                @csrf
                @method('patch')

                <!-- حقل كلمة المرور -->
                <div class="input-group-custom">
                    <label class="form-label small mb-1 d-block" style="font-size: 0.8rem;">كلمة المرور الجديدة</label>
                    <input type="password" name="password" class="form-control-glass input-lock" placeholder="••••••••"
                        required>
                    @error('password')
                        <div class="text-danger-custom">{{ $message }}</div>
                    @enderror
                </div>

                <!-- حقل تأكيد كلمة المرور -->
                <div class="input-group-custom">
                    <label class="form-label small mb-1 d-block" style="font-size: 0.8rem;">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control-glass input-check" required>
                    @error('password_confirmation')
                        <div class="text-danger-custom">{{ $message }}</div>
                    @enderror
                </div>

                <!-- زر التحديث -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-submit">
                        تحديث كلمة المرور
                    </button>
                </div>

                <!-- الفاصل -->
                <div class="d-flex align-items-center text-muted mb-2" style="color: #90a4ae; font-size: 0.8rem;">
                    <hr class="flex-grow-1">
                    <span class="px-2">أو</span>
                    <hr class="flex-grow-1">
                </div>

                <!-- الرابط -->
                <div class="text-center small">
                    <a href={{ route('user.home') }} class="text-decoration-none" style="color: #78909c;">
                        العودة للرئيسية
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
