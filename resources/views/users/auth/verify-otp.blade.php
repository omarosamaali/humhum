@extends('layouts.user-auth')

@section('title', 'التحقق من الكود | Verify OTP')

@section('section')
<div class="container py-0">
    <div class="dz-authentication-area">

        <div class="main-logo">
            <a href="{{ route('users.auth.register') }}" class="back-btn">
                <i class="feather icon-arrow-left"></i>
            </a>
            <div class="logo" style="right: 32px; position: relative;">
                <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
            </div>
        </div>

        <div class="section-head text-center">
            <h3 class="title">أدخل الكود</h3>
            <p>تم إرسال رمز مصادقة إلى</p>
            <p class="text-lowercase">{{ $email ?? 'info@example.com' }}</p>
        </div>

        <div class="account-section">
            {{-- فورم إدخال الكود --}}
            <form action="{{ route('users.register.verify.otp.post') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="mb-4">
                    <label class="form-label text-center d-block">أدخل الكود المكون من 4 أرقام</label>
                    <input type="text" name="code" class="form-control text-center fs-4" maxlength="4"
                        pattern="[0-9]{4}" inputmode="numeric" required placeholder="____">
                </div>

                @if ($errors->has('code'))
                <div class="text-danger mt-2 text-center">{{ $errors->first('code') }}</div>
                @endif

                <div class="bottom-btn pb-3 mt-4">
                    <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">
                        التحقق والمتابعة
                    </button>
                </div>
            </form>

            <div class="text-center form-text mt-2">
                إذا لم تستلم الرمز!
                <a href="javascript:void(0);" class="text-underline link">إعادة إرسال</a>
            </div>
{{-- 
            <div class="text-center mt-3 form-text">
                العودة إلى <a href="{{ route('login') }}" class="text-underline link">تسجيل الدخول</a>
            </div> --}}
        </div>
    </div>
</div>
@endsection