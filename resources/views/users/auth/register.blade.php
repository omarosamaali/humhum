@extends('layouts.user-auth')

@section('title', 'تسجيل حساب | Register')

@section('section')
<div class="container py-0">
    <div class="dz-authentication-area">

        <div class="main-logo">
           
            <div class="logo" style="right: 32px; position: relative;">
                <img src="assets/images/user-logo/logo.png" alt="logo">
            </div>
        </div>

        <div class="section-head">
            <h3 class="title">إنشاء حساب جديد</h3>
            <p>نرحب بإنضمامك لإسرة تطبيق هم هم</p>
        </div>

        <div class="account-section">
            <form id="register-form" action="{{ route('users.auth.store') }}" method="POST" class="m-b20">
                @csrf
                <input type="text" name="membership_number" hidden value="{{ $membershipNumber }}">

                <div class="mb-4">
                    <label class="form-label">الإسم</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                {{-- <select name="country" class="form-select w-full text-right" style="direction: rtl;" required> --}}
                    <select name="country" class="form-select">
                    <option value="">اختر الدولة</option>
                    @foreach($countries as $code => $name)
                    <option value="{{ $code }}" {{ old('country', strtolower(Auth::user()->country ?? '')) == $code ?
                        'selected' : ''}}>
                        {{ $name }}
                    </option>
                    @endforeach
                </select>
                <div class="mb-4">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <label class="form-label">كلمة المرور</label>
                <div class="otp-group" id="otpGroup" aria-label="حقل كلمة المرور المكوّن من 4 خانات"
                    style="display: flex; direction: rtl; gap: 5px; margin-bottom: 40px;">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="0"
                        autocomplete="one-time-code" class="form-control otp-input" type="password" id="digit-2"
                        الاسم="الرقم ٢" عنصر نائب="" البيانات-التالي="الرقم ٣" البيانات-السابق="الرقم ١">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="1"
                        autocomplete="one-time-code" class="form-control otp-input" type="password" id="digit-3"
                        name="digit-3" placeholder="" data-next="digit-4" data-previous="digit-2">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="2"
                        autocomplete="one-time-code" class="form-control otp-input" type="password" id="digit-4"
                        name="digit-4" placeholder="" data-next="digit-5" data-previous="digit-3">
                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="3"
                        autocomplete="one-time-code" class="form-control otp-input" type="password" id="digit-5"
                        name="digit-5" placeholder="" data-next="digit-6" data-previous="digit-4">
                </div>

                <input type="hidden" name="password" id="passwordHidden" />
                <button type="submit" id="submit-btn" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl" disabled>
                    تسجيل
                </button>
            </form>
        </div>
        <div class="text-center account-footer">
            <a href="{{ route('users.auth.login') }}" style="border: 1px solid var(--primary-color);
                            background-color: white !important; color: var(--primary-color) !important;"
                class="btn btn-secondary btn-lg btn-thin rounded-xl w-100">
                لدي حساب
            </a>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/password.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');
            const submitBtn = document.getElementById('submit-btn');
            form.addEventListener('input', function() {
                const allFilled = Array.from(form.querySelectorAll('[required]')).every(input => input.value.trim() !== '');
                submitBtn.disabled = !allFilled;
            });
        });
</script>

@endsection