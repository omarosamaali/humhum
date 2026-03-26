@extends('layouts.user-auth')

@section('title', 'تعديل كلمة المرور | Reset Password')

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

    /* === OTP Section === */
    .otp-section {
        margin-bottom: 28px;
    }

    .otp-section .otp-label {
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

    .otp-input.match {
        border-color: #22c55e !important;
        background: color-mix(in srgb, #22c55e 8%, #fff) !important;
        color: #22c55e !important;
    }

    /* === Dots indicator === */
    .otp-dots {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 10px;
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

    .otp-dot.match {
        background: #22c55e;
    }

    /* === Match indicator === */
    .match-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 12px;
        margin-top: 10px;
        min-height: 20px;
        transition: color 0.2s;
    }

    .match-indicator.matched {
        color: #22c55e;
    }

    .match-indicator.mismatched {
        color: #ef4444;
    }

    .match-indicator.hidden {
        visibility: hidden;
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

    .alert-danger-custom {
        background: color-mix(in srgb, #ef4444 10%, #fff);
        border: 1.5px solid #fca5a5;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 13px;
        color: #991b1b;
        text-align: center;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .text-danger.small {
        font-size: 12px;
        margin-top: 6px;
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
        margin-top: 8px;
        letter-spacing: 0.2px;
    }

    .btn-login:active {
        transform: scale(0.97);
        box-shadow: 0 2px 8px color-mix(in srgb, var(--primary-color, #2563eb) 30%, transparent);
    }

    .btn-login:disabled {
        opacity: 0.45;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-login svg {
        flex-shrink: 0;
    }

    /* === Back to login === */
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
</style>

<div class="login-page">

    <!-- Hero -->
    <div class="login-hero">
        <a href="{{ route('users.auth.login') }}" class="btn-back" aria-label="العودة لتسجيل الدخول">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </a>

        <div class="logo-wrap">
            <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
        </div>
        <h1>كلمة مرور جديدة 🔒</h1>
        <p>يجب أن تكون مختلفة عن كلمة المرور السابقة</p>
    </div>

    <!-- Card -->
    <div class="login-card">
        <p class="section-title">تعيين كلمة مرور جديدة</p>
        <p class="section-sub">أدخل الرقم السري الجديد المكوّن من 4 خانات وأعد تأكيده</p>

        <form action="{{ route('users.auth.password.reset.post') }}" method="POST">
            @csrf

            {{-- Success --}}
            @if (session('success'))
            <div class="alert-success-custom">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            {{-- Error --}}
            @if (session('error'))
            <div class="alert-danger-custom">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <input type="hidden" name="password" id="passwordHidden">
            <input type="hidden" name="password_confirmation" id="confirmHidden">

            {{-- New Password OTP --}}
            <div class="otp-section">
                <span class="otp-label">كلمة المرور الجديدة</span>
                <p class="otp-hint">أدخل الرقم السري المكوّن من 4 خانات</p>

                <div class="otp-group-wrap" id="passGroup">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input pass-input" type="text"
                        id="p0" data-group="pass" data-index="0">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input pass-input" type="text"
                        id="p1" data-group="pass" data-index="1">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input pass-input" type="text"
                        id="p2" data-group="pass" data-index="2">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input pass-input" type="text"
                        id="p3" data-group="pass" data-index="3">
                </div>

                <div class="otp-dots">
                    <div class="otp-dot" id="pdot-0"></div>
                    <div class="otp-dot" id="pdot-1"></div>
                    <div class="otp-dot" id="pdot-2"></div>
                    <div class="otp-dot" id="pdot-3"></div>
                </div>

                @error('password')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirm Password OTP --}}
            <div class="otp-section">
                <span class="otp-label">تأكيد كلمة المرور</span>
                <p class="otp-hint">أعد إدخال الرقم السري للتأكيد</p>

                <div class="otp-group-wrap" id="confirmGroup">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input confirm-input"
                        type="text" id="c0" data-group="confirm" data-index="0">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input confirm-input"
                        type="text" id="c1" data-group="confirm" data-index="1">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input confirm-input"
                        type="text" id="c2" data-group="confirm" data-index="2">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" class="otp-input confirm-input"
                        type="text" id="c3" data-group="confirm" data-index="3">
                </div>

                <div class="otp-dots">
                    <div class="otp-dot" id="cdot-0"></div>
                    <div class="otp-dot" id="cdot-1"></div>
                    <div class="otp-dot" id="cdot-2"></div>
                    <div class="otp-dot" id="cdot-3"></div>
                </div>

                {{-- Match indicator --}}
                <div class="match-indicator hidden" id="matchIndicator">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round" id="matchIcon">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    <span id="matchText">كلمتا المرور متطابقتان</span>
                </div>

                @error('password_confirmation')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login" id="submitBtn" disabled>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                حفظ كلمة المرور الجديدة
            </button>
        </form>

        <div class="divider"><span>أو</span></div>

        <a href="{{ route('users.auth.login') }}" class="btn-register">
            العودة إلى تسجيل الدخول
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const passInputs    = Array.from(document.querySelectorAll('.pass-input'));
    const confirmInputs = Array.from(document.querySelectorAll('.confirm-input'));
    const passHidden    = document.getElementById('passwordHidden');
    const confirmHidden = document.getElementById('confirmHidden');
    const submitBtn     = document.getElementById('submitBtn');
    const matchIndicator = document.getElementById('matchIndicator');
    const matchIcon      = document.getElementById('matchIcon');
    const matchText      = document.getElementById('matchText');

    function getVal(inputs) {
        return inputs.map(i => i.value).join('');
    }

    function setupGroup(inputs, dots, hiddenField, onChangeCallback) {
        inputs.forEach((input, idx) => {
            input.addEventListener('focus', () => input.select());

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Backspace') {
                    if (input.value) {
                        input.value = '';
                        input.classList.remove('filled', 'error', 'match');
                        dots[idx].classList.remove('active', 'match');
                        hiddenField.value = getVal(inputs);
                        onChangeCallback();
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
                    input.classList.remove('filled', 'match');
                    dots[idx].classList.remove('active', 'match');
                }

                hiddenField.value = getVal(inputs);
                onChangeCallback();
            });

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
                hiddenField.value = getVal(inputs);
                onChangeCallback();
            });
        });
    }

    function validate() {
        const pass    = getVal(passInputs);
        const confirm = getVal(confirmInputs);
        const passFull    = pass.length === 4;
        const confirmFull = confirm.length === 4;
        const matched = passFull && confirmFull && pass === confirm;
        const mismatched = confirmFull && pass !== confirm;

        // Update confirm box colors
        confirmInputs.forEach((input, idx) => {
            const cdot = document.getElementById('cdot-' + idx);
            if (confirmFull) {
                if (matched) {
                    input.classList.add('match');
                    input.classList.remove('error', 'filled');
                    cdot.classList.add('match');
                } else {
                    input.classList.add('error');
                    input.classList.remove('match', 'filled');
                    cdot.classList.remove('match');
                }
            } else {
                input.classList.remove('match', 'error');
                cdot.classList.remove('match');
            }
        });

        // Match indicator
        if (confirmFull) {
            matchIndicator.classList.remove('hidden');
            if (matched) {
                matchIndicator.classList.add('matched');
                matchIndicator.classList.remove('mismatched');
                matchIcon.innerHTML = '<polyline points="20 6 9 17 4 12"/>';
                matchText.textContent = 'كلمتا المرور متطابقتان ✓';
            } else {
                matchIndicator.classList.add('mismatched');
                matchIndicator.classList.remove('matched');
                matchIcon.innerHTML = '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>';
                matchText.textContent = 'كلمتا المرور غير متطابقتين';
            }
        } else {
            matchIndicator.classList.add('hidden');
            matchIndicator.classList.remove('matched', 'mismatched');
        }

        submitBtn.disabled = !matched;
    }

    const passDots    = Array.from({length: 4}, (_, i) => document.getElementById('pdot-' + i));
    const confirmDots = Array.from({length: 4}, (_, i) => document.getElementById('cdot-' + i));

    setupGroup(passInputs, passDots, passHidden, validate);
    setupGroup(confirmInputs, confirmDots, confirmHidden, validate);

    passInputs[0].focus();
});
</script>

@endsection