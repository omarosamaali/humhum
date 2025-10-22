@extends('layouts.user-auth')

@section('title', 'تعديل كلمة المرور | Reset Password')

@section('section')
<div class="container py-0">
    <div class="dz-authentication-area">
        <div class="main-logo">
            <a href="{{ route('users.auth.login') }}" class="back-btn">
                <i class="feather icon-arrow-left"></i>
            </a>
            <div class="logo" style="right: 32px; position: relative;">
                <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
            </div>
        </div>

        <div class="section-head text-center">
            <h3 class="title">أدخل كلمة المرور الجديدة</h3>
            <p>يجب أن تكون كلمة المرور الجديدة مختلفة عن كلمة المرور السابقة.</p>
        </div>

        <div class="account-section">
            <form action="{{ route('users.auth.password.reset.post') }}" method="POST" class="m-b20">
                @csrf

                {{-- عرض رسالة النجاح --}}
                @if (session('success'))
                <div class="alert alert-success text-center mb-4" role="alert">
                    <i class="feather icon-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                {{-- عرض الأخطاء العامة --}}
                @if (session('error'))
                <div class="alert alert-danger text-center mb-4" role="alert">
                    <i class="feather icon-alert-circle"></i>
                    {{ session('error') }}
                </div>
                @endif

                {{-- كلمة المرور الجديدة --}}
                <div class="mb-4">
                    <label class="form-label" for="password">كلمة المرور الجديدة</label>
                    <div class="input-group input-group-icon input-mini input-lg">
                        <input type="password" id="password" name="password" class="form-control dz-password"
                            placeholder="أدخل كلمة المرور الجديدة" minlength="8" required>
                        <span class="input-group-text show-pass" style="cursor: pointer;">
                            <i class="icon feather icon-eye-off eye-close"></i>
                            <i class="icon feather icon-eye eye-open" style="display: none;"></i>
                        </span>
                    </div>
                    @error('password')
                    <div class="text-danger mt-2">
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                    <small class="form-text text-muted mt-1">
                        يجب أن تكون كلمة المرور 8 أحرف على الأقل
                    </small>
                </div>

                {{-- تأكيد كلمة المرور --}}
                <div class="mb-4">
                    <label class="form-label" for="password_confirmation">تأكيد كلمة المرور</label>
                    <div class="input-group input-group-icon input-mini input-lg">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control dz-password" placeholder="أعد إدخال كلمة المرور" minlength="8" required>
                        <span class="input-group-text show-pass" style="cursor: pointer;">
                            <i class="icon feather icon-eye-off eye-close"></i>
                            <i class="icon feather icon-eye eye-open" style="display: none;"></i>
                        </span>
                    </div>
                    @error('password_confirmation')
                    <div class="text-danger mt-2">
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>

                {{-- متطلبات كلمة المرور --}}
                <div class="password-requirements mb-4 p-3" style="background-color: #f8f9fa; border-radius: 8px;">
                    <h6 class="mb-2" style="font-size: 0.9rem;">متطلبات كلمة المرور:</h6>
                    <ul class="list-unstyled mb-0" style="font-size: 0.85rem;">
                        <li class="mb-1">
                            <i class="feather icon-check-circle text-success"></i>
                            <span id="length-req" class="text-muted">8 أحرف على الأقل</span>
                        </li>
                    </ul>
                </div>

                {{-- زر الحفظ --}}
                <div class="bottom-btn pb-3">
                    <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">
                        <i class="feather icon-check me-2"></i>
                        حفظ كلمة المرور الجديدة
                    </button>
                </div>
            </form>

            {{-- العودة لتسجيل الدخول --}}
            <div class="text-center mt-3 form-text">
                العودة إلى
                <a href="{{ route('users.auth.login') }}" class="text-primary text-decoration-underline">
                    تسجيل الدخول
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .input-group-icon .show-pass {
        border-right: none;
        background-color: transparent;
        padding: 0 1rem;
    }

    .input-group-icon .form-control {
        border-left: none;
        padding-right: 1rem;
    }

    .input-group-icon .form-control:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }

    .input-group-icon .show-pass:hover {
        background-color: #f8f9fa;
    }

    .password-requirements li {
        padding: 0.25rem 0;
    }

    .password-requirements i {
        font-size: 0.9rem;
        margin-left: 0.5rem;
    }

    .alert {
        border-radius: 12px;
        padding: 0.75rem 1rem;
    }

    .alert i {
        margin-left: 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // إظهار/إخفاء كلمة المرور
        const showPassButtons = document.querySelectorAll('.show-pass');
        
        showPassButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const eyeClose = this.querySelector('.eye-close');
                const eyeOpen = this.querySelector('.eye-open');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeClose.style.display = 'none';
                    eyeOpen.style.display = 'inline';
                } else {
                    input.type = 'password';
                    eyeClose.style.display = 'inline';
                    eyeOpen.style.display = 'none';
                }
            });
        });

        // التحقق من متطلبات كلمة المرور
        const passwordInput = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const lengthReq = document.getElementById('length-req');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const value = this.value;
                
                // التحقق من الطول
                if (value.length >= 8) {
                    lengthReq.classList.remove('text-muted');
                    lengthReq.classList.add('text-success');
                } else {
                    lengthReq.classList.remove('text-success');
                    lengthReq.classList.add('text-muted');
                }
            });
        }

        // التحقق من تطابق كلمة المرور
        if (passwordConfirmation) {
            passwordConfirmation.addEventListener('input', function() {
                if (this.value !== passwordInput.value && this.value.length > 0) {
                    this.setCustomValidity('كلمات المرور غير متطابقة');
                } else {
                    this.setCustomValidity('');
                }
            });
        }

        // منع نسخ ولصق كلمة المرور في حقل التأكيد (اختياري)
        if (passwordConfirmation) {
            passwordConfirmation.addEventListener('paste', function(e) {
                e.preventDefault();
                alert('الرجاء كتابة كلمة المرور يدوياً للتأكد من صحتها');
            });
        }
    });
</script>
@endsection