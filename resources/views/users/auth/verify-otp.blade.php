@extends('layouts.user-auth')

@section('title', 'التحقق من الكود | Verify OTP')

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

    .login-hero .hero-email {
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        direction: ltr;
        position: relative;
        z-index: 1;
        margin-top: 2px;
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

    /* === OTP Section === */
    .otp-section label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 14px;
        text-align: center;
    }

    .otp-hint {
        text-align: center;
        font-size: 12px;
        color: #9ca3af;
        margin-bottom: 16px;
    }

    .otp-group-wrap {
        display: flex;
        justify-content: center;
        gap: 12px;
        direction: ltr;
        margin-bottom: 8px;
    }

    .otp-input {
        width: 58px !important;
        height: 62px !important;
        border: 2px solid #e5e7eb !important;
        border-radius: 16px !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        text-align: center !important;
        color: #1f2937 !important;
        background: #f9fafb !important;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s, transform 0.15s !important;
        outline: none !important;
        padding: 0 !important;
        font-family: 'Tajawal', sans-serif !important;
        caret-color: transparent;
        -webkit-appearance: none;
    }

    .otp-input:focus {
        border-color: var(--primary-color, #2563eb) !important;
        background: #fff !important;
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary-color, #2563eb) 15%, transparent) !important;
        transform: scale(1.06) !important;
    }

    .otp-input.filled {
        border-color: var(--primary-color, #2563eb) !important;
        background: color-mix(in srgb, var(--primary-color, #2563eb) 8%, #fff) !important;
        color: var(--primary-color, #2563eb) !important;
    }

    .otp-input.error {
        border-color: #ef4444 !important;
        background: color-mix(in srgb, #ef4444 6%, #fff) !important;
        color: #ef4444 !important;
    }

    /* === Dots indicator === */
    .otp-dots {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 10px;
        margin-bottom: 8px;
    }

    .otp-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #e5e7eb;
        transition: background 0.2s, transform 0.2s;
    }

    .otp-dot.active {
        background: var(--primary-color, #2563eb);
        transform: scale(1.2);
    }

    /* === Error === */
    .text-danger.small {
        font-size: 12px;
        margin-top: 8px;
        display: block;
        color: #ef4444 !important;
        text-align: center;
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
        margin-top: 28px;
        letter-spacing: 0.2px;
    }

    .btn-login:active {
        transform: scale(0.97);
        box-shadow: 0 2px 8px color-mix(in srgb, var(--primary-color, #2563eb) 30%, transparent);
    }

    .btn-login svg {
        flex-shrink: 0;
    }

    /* === Resend Link === */
    .resend-wrap {
        text-align: center;
        margin-top: 20px;
        font-size: 13px;
        color: #9ca3af;
    }

    .resend-wrap a {
        color: var(--primary-color, #2563eb);
        font-weight: 600;
        text-decoration: none;
    }
</style>

<div class="login-page">

    <!-- Hero -->
    <div class="login-hero">

        <!-- Back Button -->
        <a href="{{ route('users.auth.register') }}" class="btn-back" aria-label="العودة للتسجيل">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </a>

        <div class="logo-wrap">
            <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
        </div>
        <h1>التحقق من الهوية 📩</h1>
        <p>تم إرسال رمز مصادقة إلى</p>
        <p class="hero-email">{{ $email ?? 'info@example.com' }}</p>
    </div>

    <!-- Card -->
    <div class="login-card">
        <p class="section-title">أدخل رمز التحقق</p>
        <p class="section-sub">أدخل الكود المكوّن من 4 أرقام الذي أرسلناه إلى بريدك الإلكتروني</p>

        <form action="{{ route('users.register.verify.otp.post') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="code" id="codeHidden">

            <div class="otp-section">
                <div class="otp-group-wrap" id="otpGroup">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="0" class="otp-input"
                        type="text" id="otp-0">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="1" class="otp-input"
                        type="text" id="otp-1">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="2" class="otp-input"
                        type="text" id="otp-2">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="3" class="otp-input"
                        type="text" id="otp-3">
                </div>

                <div class="otp-dots">
                    <div class="otp-dot" id="dot-0"></div>
                    <div class="otp-dot" id="dot-1"></div>
                    <div class="otp-dot" id="dot-2"></div>
                    <div class="otp-dot" id="dot-3"></div>
                </div>

                @if ($errors->has('code'))
                <span class="text-danger small">{{ $errors->first('code') }}</span>
                @endif
            </div>

            <button type="submit" class="btn-login">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                التحقق والمتابعة
            </button>
        </form>

        <p class="resend-wrap">
            لم تستلم الرمز؟
            <a href="{{ url()->previous() ?: route('home') }}">إعادة إرسال</a>
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs  = Array.from(document.querySelectorAll('.otp-input'));
        const dots    = Array.from(document.querySelectorAll('.otp-dot'));
        const hidden  = document.getElementById('codeHidden');

        // Mark error state if validation failed
        @if ($errors->has('code'))
        inputs.forEach(i => i.classList.add('error'));
        @endif

        function syncHidden() {
            hidden.value = inputs.map(i => i.value).join('');
        }

        inputs.forEach((input, idx) => {
            input.addEventListener('focus', () => input.select());

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Backspace') {
                    if (input.value) {
                        input.value = '';
                        input.classList.remove('filled', 'error');
                        dots[idx].classList.remove('active');
                        syncHidden();
                    } else if (idx > 0) {
                        inputs[idx - 1].focus();
                    }
                    e.preventDefault();
                }
            });

            input.addEventListener('input', function () {
                const val = input.value.replace(/[^0-9]/g, '');
                input.value = val ? val[0] : '';

                if (input.value) {
                    input.classList.add('filled');
                    input.classList.remove('error');
                    dots[idx].classList.add('active');
                    if (idx < inputs.length - 1) inputs[idx + 1].focus();
                } else {
                    input.classList.remove('filled');
                    dots[idx].classList.remove('active');
                }
                syncHidden();
            });

            // Handle paste on any box
            input.addEventListener('paste', function (e) {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData)
                    .getData('text').replace(/[^0-9]/g, '').slice(0, 4);
                pasted.split('').forEach((ch, i) => {
                    if (inputs[i]) {
                        inputs[i].value = ch;
                        inputs[i].classList.add('filled');
                        inputs[i].classList.remove('error');
                        dots[i].classList.add('active');
                    }
                });
                const next = Math.min(pasted.length, inputs.length - 1);
                inputs[next].focus();
                syncHidden();
            });
        });

        // Auto-focus first input
        inputs[0].focus();
    });
</script>

@endsection