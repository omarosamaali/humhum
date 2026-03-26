@extends('layouts.user-auth')

@section('title', 'نسيت كلمة المرور | Forgot Password')

@section('section')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body,
    .dz-authentication-area {
        font-family: 'Tajawal', sans-serif !important;
        direction: rtl;
    }

    .login-page {
        min-height: 100dvh;
        background: #f7f8fc;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    /* === Hero Top Section === */
    .login-hero {
        background: linear-gradient(160deg, var(--primary-color, #2563eb) 0%,
                color-mix(in srgb, var(--primary-color, #2563eb) 70%, #000) 100%);
        padding: 63px 26px 17px;
        position: fixed;
        top: 0px;
        z-index: 0;
        width: 100%;
        overflow: hidden;
        text-align: center;
    }

    .login-hero::before {
        content: '';
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        top: -80px;
        left: -60px;
    }

    .login-hero::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        bottom: -50px;
        right: -30px;
    }

    /* === Back Button === */
    .btn-back {
        position: absolute;
        top: 18px;
        left: 18px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        z-index: 2;
        transition: background 0.2s, transform 0.15s;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .btn-back:active {
        transform: scale(0.92);
    }

    .login-hero .logo-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        width: 180px;
        height: 1px;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .login-hero .logo-wrap img {
        width: 202px;
        height: 152px;
        object-fit: contain;
        filter: brightness(0) invert(1);
    }

    .login-hero h1 {
        color: #fff;
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
        letter-spacing: -0.3px;
    }

    .login-hero p {
        color: rgba(255, 255, 255, 0.72);
        font-size: 14px;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }

    /* === Card Body === */
    .login-card {
        background: #fff;
        border-radius: 32px 32px 0 0;
        margin-top: 210px;
        flex: 1;
        padding: 36px 24px 40px;
        position: relative;
        z-index: 2;
        box-shadow: 0 -4px 30px rgba(0, 0, 0, 0.06);
    }

    .login-card .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 4px;
    }

    .login-card .section-sub {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 28px;
        font-weight: 400;
        line-height: 1.7;
    }

    /* === Field Group === */
    .field-group {
        margin-bottom: 24px;
    }

    .field-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .field-group .input-wrap {
        position: relative;
    }

    .field-group .input-wrap .field-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    .field-group input[type="email"] {
        width: 100%;
        height: 54px;
        border: 1.5px solid #e5e7eb;
        border-radius: 14px;
        padding: 0 44px 0 16px;
        font-family: 'Tajawal', sans-serif;
        font-size: 15px;
        color: #1f2937;
        background: #f9fafb;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        text-align: right;
        direction: rtl;
        outline: none;
    }

    .field-group input[type="email"]:focus {
        border-color: var(--primary-color, #2563eb);
        background: #fff;
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary-color, #2563eb) 15%, transparent);
    }

    .field-group input[type="email"]::placeholder {
        color: #c4c8d1;
        direction: ltr;
        text-align: left;
    }

    /* === Submit Button === */
    .btn-login {
        width: 100%;
        height: 54px;
        background: var(--primary-color, #2563eb);
        color: #fff;
        border: none;
        border-radius: 14px;
        font-family: 'Tajawal', sans-serif;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.2s, background 0.2s;
        box-shadow: 0 4px 18px color-mix(in srgb, var(--primary-color, #2563eb) 40%, transparent);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 8px;
        letter-spacing: 0.2px;
    }

    .btn-login:active {
        transform: scale(0.97);
        box-shadow: 0 2px 8px color-mix(in srgb, var(--primary-color, #2563eb) 30%, transparent);
    }

    .btn-login svg {
        flex-shrink: 0;
    }

    /* === Back to login link === */
    .btn-register {
        width: 100%;
        height: 54px;
        background: transparent;
        color: var(--primary-color, #2563eb);
        border: 1.5px solid var(--primary-color, #2563eb);
        border-radius: 14px;
        font-family: 'Tajawal', sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        margin-top: 14px;
    }

    .btn-register:active {
        background: color-mix(in srgb, var(--primary-color, #2563eb) 8%, transparent);
    }

    /* === Divider === */
    .divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 20px 0;
    }

    .divider span {
        font-size: 12px;
        color: #d1d5db;
        white-space: nowrap;
        font-weight: 500;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #f0f0f0;
    }

    /* === Alerts === */
    .alert-success-custom {
        background: color-mix(in srgb, #22c55e 10%, #fff);
        border: 1.5px solid #86efac;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 13px;
        color: #166534;
        text-align: center;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    /* Error */
    .text-danger.small {
        font-size: 12px;
        margin-top: 6px;
        display: block;
        color: #ef4444 !important;
    }
</style>

<div class="login-page">

    <!-- Hero -->
    <div class="login-hero">

        <!-- Back Button -->
        <a href="{{ route('users.auth.login') }}" class="btn-back" aria-label="العودة لتسجيل الدخول">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </a>

        <div class="logo-wrap">
            <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
        </div>
        <h1>نسيت كلمة المرور؟ 🔑</h1>
        <p>لا تقلق، سنساعدك على استعادة حسابك</p>
    </div>

    <!-- Card -->
    <div class="login-card">
        <p class="section-title">استرجاع كلمة المرور</p>
        <p class="section-sub">أدخل بريدك الإلكتروني المرتبط بحسابك وسنرسل لك رابطًا لإعادة تعيين كلمة المرور</p>

        <form method="POST" action="{{ route('users.auth.password.email') }}">
            @csrf

            {{-- Success Message --}}
            @if (session('status'))
            <div class="alert-success-custom">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                {{ session('status') }}
            </div>
            @endif

            {{-- Email --}}
            <div class="field-group">
                <label for="email">البريد الإلكتروني</label>
                <div class="input-wrap">
                    <span class="field-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="3" />
                            <path d="m2 7 10 7 10-7" />
                        </svg>
                    </span>
                    <input type="email" id="email" name="email" placeholder="example@email.com" required
                        value="{{ old('email') }}">
                </div>
                @error('email')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13" />
                    <polygon points="22 2 15 22 11 13 2 9 22 2" />
                </svg>
                إرسال رمز إعادة التعيين
            </button>
        </form>

        <div class="divider"><span>أو</span></div>

        <a href="{{ route('users.auth.login') }}" class="btn-register">
            العودة إلى تسجيل الدخول
        </a>
    </div>
</div>

@endsection