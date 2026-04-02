@extends('user.auth.partial.master')
@section('title')
    التحقق عبر الإيميل
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
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
                <h2 class="fw-bold mb-1">التحقق من البريد</h2>
                <p class="small text-muted" style="color: #607d8b; margin-bottom: 0;">حسابك غير مفعل بعد</p>
            </div>

            <!-- رسالة المعلومات الأساسية -->
            <div class="text-center mb-2 small" style="color: #455a64; line-height: 1.5;">
                يرجى تفقد بريدك الإلكتروني وضغط على رابط التفعيل لإكمال عملية التسجيل.
            </div>

            <!-- رسالة إعادة الإرسال -->
            <div class="text-center mb-2" style="color: #2e7d32; font-size: 0.85rem;">
                <x-redirect-message name='new'></x-redirect-message>
            </div>

            <!-- رسالة الخطأ (الرابط غير صحيح) -->
            <div class="text-center mb-2" style="color: #d32f2f; font-size: 0.85rem;">
                <x-redirect-message name='unverified'></x-redirect-message>
            </div>

            <!-- المؤقت (Cooldown) -->
            @if (session('maxAttempts'))
                <div class="text-center mb-3" style="color: #d32f2f">
                    @livewire('user.verification-cooldown-timer')
                </div>
            @endif

            <!-- زر إعادة الإرسال -->
            <form action="{{ route('user.verify.update') }}" method="POST">
                @csrf
                @method('patch')

                <!-- رسالة عدم التطابق -->
                <div class="text-center mb-2 small" style="color: #d32f2f;">
                    <x-redirect-message name='notMatch'></x-redirect-message>
                </div>

                <button type="submit" class="btn btn-submit">
                    إعادة إرسال رابط التفعيل
                </button>
            </form>

            <!-- زر تسجيل الخروج -->
            <form action="{{ route('user.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout">
                    تسجيل الخروج
                </button>
            </form>
            <!-- الروابط -->
            <div class="text-center small">
                <a href={{ route('user.home') }} class="text-decoration-none" style="color: #78909c;">
                    الرئيسية
                </a>
            </div>

        </div>
    </div>
@endsection
