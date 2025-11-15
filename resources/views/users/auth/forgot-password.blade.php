@extends('layouts.user-auth')

@section('title', 'نسيت كلمة المرور | Forgot Password')

@section('section')
<div class="container py-0">
    <div class="dz-authentication-area">
        <div class="main-logo">
            <a href="{{ route('users.auth.login') }}" id="back-btn">
                <i class="feather icon-arrow-left"></i>
            </a>
            <div class="logo" style="right: 32px; position: relative;">
                <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
            </div>
        </div>

        <div class="section-head text-center">
            <h3 class="title">نسيت كلمة المرور</h3>
            <p>أدخل بريدك الإلكتروني المرتبط بحسابك وسنرسل لك رابطًا لإعادة تعيين كلمة المرور</p>
        </div>

        <div class="account-section">
            {{-- فورم إرسال رابط إعادة تعيين كلمة المرور --}}
            <form method="POST" action="{{ route('users.auth.password.email') }}" class="m-b30">
                @csrf

                <div class="mb-4">
                    <label class="form-label" for="email">عنوان البريد الإلكتروني</label>
                    <div class="input-group input-mini input-lg">
                        <input type="email" id="email" name="email" class="form-control text-center"
                            placeholder="example@email.com" required>
                    </div>
                </div>

                @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
                @endif

                @error('email')
                <div class="text-danger text-center mt-2">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">
                    إرسال رابط إعادة التعيين
                </button>
            </form>

            <div class="text-center form-text mt-3">
                الرجوع إلى
                <a href="{{ route('users.auth.login') }}" class="text-underline link">تسجيل الدخول</a>
            </div>
        </div>
    </div>
</div>
@endsection