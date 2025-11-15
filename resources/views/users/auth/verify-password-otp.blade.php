@extends('layouts.user-auth')

@section('title', 'التحقق من الكود | Verify OTP')

@section('section')
<div class="container py-0">
    <div class="dz-authentication-area">

        <div class="main-logo">
            <a href="{{ route('users.auth.password.request') }}" id="back-btn">
                <i class="feather icon-arrow-left"></i>
            </a>
            <div class="logo" style="right: 32px; position: relative;">
                <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
            </div>
        </div>

        <div class="section-head text-center">
            <h3 class="title">أدخل رمز التحقق</h3>
            <p class="mb-2">تم إرسال رمز التحقق إلى بريدك الإلكتروني</p>
            <p class="text-lowercase fw-bold" style="color: #6c757d;">
                {{ $email ?? 'info@example.com' }}
            </p>
        </div>

        <div class="account-section">
            {{-- فورم إدخال الكود --}}
            <form action="{{ route('users.auth.password.verify.otp.post') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="mb-4">
                    <label class="form-label text-center d-block mb-3">أدخل الكود المكون من 4 أرقام</label>

                    {{-- حقل إدخال الكود --}}
                    <div class="otp-input-container">
                        <input type="text" name="code" id="otp-code" class="form-control text-center" maxlength="4"
                            pattern="[0-9]{4}" inputmode="numeric" required placeholder="____" value="{{ old('code') }}"
                            style="font-size: 2rem; letter-spacing: 0.5rem; font-weight: 600;">
                    </div>
                </div>

                @if ($errors->has('code'))
                <div class="alert alert-danger text-center" role="alert">
                    <i class="feather icon-alert-circle"></i>
                    {{ $errors->first('code') }}
                </div>
                @endif

                @if ($errors->has('email'))
                <div class="alert alert-danger text-center" role="alert">
                    <i class="feather icon-alert-circle"></i>
                    {{ $errors->first('email') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger text-center" role="alert">
                    <i class="feather icon-alert-circle"></i>
                    {{ session('error') }}
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    <i class="feather icon-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                <div class="bottom-btn pb-3 mt-4">
                    <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">
                        <i class="feather icon-check-circle me-2"></i>
                        التحقق والمتابعة
                    </button>
                </div>
            </form>

            {{-- إعادة إرسال الكود --}}
            <div class="text-center form-text mt-3">
                <p class="mb-2">لم تستلم الرمز؟</p>
                <form action="{{ route('users.auth.password.email') }}" method="POST" class="d-flex justify-center" id="resend-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" class="btn btn-link text-primary text-decoration-underline p-0"
                        id="resend-btn">
                        إعادة إرسال الكود
                    </button>
                </form>
                <span id="countdown" class="text-muted" style="display: none;"></span>
            </div>

            {{-- العودة لتسجيل الدخول --}}
            <div class="text-center mt-4 form-text">
                <p class="mb-0">
                    تذكرت كلمة المرور؟
                    <a href="{{ route('users.auth.login') }}" class="text-primary text-decoration-underline">
                        تسجيل الدخول
                    </a>
                </p>
            </div>
        </div>

    </div>
</div>

<style>
    .otp-input-container {
        max-width: 300px;
        margin: 0 auto;
    }

    #otp-code {
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    #otp-code:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
    }

    .section-head {
        margin-bottom: 2rem;
    }

    .section-head .title {
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .alert {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
    }

    .alert i {
        margin-left: 0.5rem;
    }

    .btn-link:hover {
        text-decoration: underline !important;
    }

    #countdown {
        display: inline-block;
        margin-right: 0.5rem;
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const otpInput = document.getElementById('otp-code');
        const resendBtn = document.getElementById('resend-btn');
        const countdown = document.getElementById('countdown');
        
        // التركيز التلقائي على حقل الإدخال
        if (otpInput) {
            otpInput.focus();
        }

        // السماح بالأرقام فقط
        if (otpInput) {
            otpInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // إرسال النموذج تلقائياً عند إدخال 4 أرقام (اختياري)
            otpInput.addEventListener('input', function(e) {
                if (this.value.length === 4) {
                    // يمكنك تفعيل هذا إذا أردت الإرسال التلقائي
                    // this.form.submit();
                }
            });
        }

        // عداد إعادة الإرسال (60 ثانية)
        let timeLeft = 60;
        let timerInterval;

        function startCountdown() {
            resendBtn.disabled = true;
            resendBtn.style.opacity = '0.5';
            countdown.style.display = 'inline';
            
            timerInterval = setInterval(function() {
                timeLeft--;
                countdown.textContent = `(${timeLeft} ثانية)`;
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    countdown.style.display = 'none';
                    resendBtn.disabled = false;
                    resendBtn.style.opacity = '1';
                    timeLeft = 60;
                }
            }, 1000);
        }

        // بدء العداد عند النقر على إعادة الإرسال
        if (resendBtn) {
            document.getElementById('resend-form').addEventListener('submit', function(e) {
                startCountdown();
            });
        }

        // بدء العداد تلقائياً عند تحميل الصفحة (اختياري)
        startCountdown();
    });
</script>
@endsection