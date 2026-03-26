@extends('layouts.user-auth')

@section('title', 'تسجيل حساب | Register')

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
        position: relative;
        overflow: hidden;
        text-align: center;
        position: fixed;
        top: 0px;
        z-index: 0;
        width: 100%;
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
    }

    /* === Field Group === */
    .field-group {
        margin-bottom: 20px;
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
        font-size: 17px;
        pointer-events: none;
    }

    .field-group input[type="text"],
    .field-group input[type="email"],
    .field-group select {
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
        appearance: none;
        -webkit-appearance: none;
    }

    .field-group input[type="text"]:focus,
    .field-group input[type="email"]:focus,
    .field-group select:focus {
        border-color: var(--primary-color, #2563eb);
        background: #fff;
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary-color, #2563eb) 15%, transparent);
    }

    .field-group input::placeholder {
        color: #c4c8d1;
        direction: ltr;
        text-align: left;
    }

    /* Select arrow icon */
    .select-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    /* === OTP Section === */
    .otp-section {
        margin-bottom: 8px;
    }

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

    .btn-login:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-login svg {
        flex-shrink: 0;
    }

    /* === Login Button === */
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
        <div class="logo-wrap">
            <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
        </div>
        <h1>أهلاً بك 🎉</h1>
        <p>أنشئ حسابك وابدأ رحلتك معنا</p>
    </div>

    <!-- Card -->
    <div class="login-card">
        <p class="section-title">إنشاء حساب جديد</p>
        <p class="section-sub">نرحب بانضمامك إلى عائلتنا</p>

        <form id="register-form" action="{{ route('users.auth.store') }}" method="POST">
            @csrf
            <input type="hidden" name="membership_number" value="{{ $membershipNumber }}">

            {{-- Name --}}
            <div class="field-group">
                <label for="name">الاسم</label>
                <div class="input-wrap">
                    <span class="field-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                    </span>
                    <input type="text" id="name" name="name" placeholder="الاسم الكامل" required
                        value="{{ old('name') }}">
                </div>
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Country --}}
            <div class="field-group">
                <label for="country">الدولة</label>
                <div class="input-wrap">
                    <span class="field-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path
                                d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        </svg>
                    </span>
                    <span class="select-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                    <select id="country" name="country" required>
                        <option value="">اختر الدولة</option>
                        @foreach($countries as $code => $name)
                        <option value="{{ $code }}" {{ old('country', strtolower(Auth::user()->country ?? '')) == $code
                            ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('country')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

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

            {{-- OTP Password --}}
            <div class="otp-section">
                <label>كلمة المرور (4 أرقام)</label>
                <p class="otp-hint">أدخل الرقم السري المكوّن من 4 خانات</p>

                <div class="otp-group-wrap" id="otpGroup" aria-label="حقل كلمة المرور المكوّن من 4 خانات">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="0"
                        autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-2">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="1"
                        autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-3"
                        name="digit-3" data-next="digit-4" data-previous="digit-2">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="2"
                        autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-4"
                        name="digit-4" data-next="digit-5" data-previous="digit-3">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="3"
                        autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-5"
                        name="digit-5" data-next="digit-6" data-previous="digit-4">
                </div>

                <div class="otp-dots">
                    <div class="otp-dot" id="dot-0"></div>
                    <div class="otp-dot" id="dot-1"></div>
                    <div class="otp-dot" id="dot-2"></div>
                    <div class="otp-dot" id="dot-3"></div>
                </div>

                @error('password')
                <span class="text-danger small" style="text-align:center; display:block; margin-top:8px;">{{ $message
                    }}</span>
                @enderror
            </div>

            <input type="hidden" name="password" id="passwordHidden" />

            <button type="submit" id="submit-btn" class="btn-login" disabled>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <line x1="19" y1="8" x2="19" y2="14" />
                    <line x1="22" y1="11" x2="16" y2="11" />
                </svg>
                تسجيل
            </button>
        </form>

        <div class="divider"><span>أو</span></div>

        <a href="{{ route('users.auth.login') }}" class="btn-register">
            لدي حساب بالفعل
        </a>
    </div>
</div>

<script src="{{ asset('assets/js/password.js') }}"></script>

<script>
    // OTP dot indicators update
    document.querySelectorAll('.otp-input').forEach((input, idx) => {
        input.addEventListener('input', () => {
            const dot = document.getElementById('dot-' + idx);
            if (input.value) {
                input.classList.add('filled');
                if (dot) dot.classList.add('active');
            } else {
                input.classList.remove('filled');
                if (dot) dot.classList.remove('active');
            }
        });
        input.addEventListener('focus', () => {
            input.select();
        });
    });

    // Enable submit only when all required fields are filled
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('register-form');
        const submitBtn = document.getElementById('submit-btn');

        form.addEventListener('input', function () {
            const allFilled = Array.from(form.querySelectorAll('[required]')).every(input => input.value.trim() !== '');
            submitBtn.disabled = !allFilled;
        });
    });
</script>

@endsection