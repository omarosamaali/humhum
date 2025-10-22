<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تعديل بيانات الفرد</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/imageuplodify/imageuploadify.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #660099;
        }

        .edit-profile .avatar-upload .avatar-preview {
            border: 2px solid var(--primary-color);
        }

        .edit-profile .avatar-upload .change-btn {
            background: var(--primary-color);
        }

        select.form-select {
            color: var(--primary-color) !important;
            --bs-form-select-bg-img: url(https://cdn-icons-png.flaticon.com/512/32/32195.png) !important;
        }

        .form-control:focus,
        .form-control:active,
        .form-control.active {
            border-color: var(--primary-color) !important;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--primary-color);
            box-shadow: unset;
        }

        .edit-profile .avatar-upload .avatar-preview>#imagePreview {
            background-size: contain !important;
        }

        .otp-group {
            display: flex;
            gap: 10px;
            margin-bottom: 40px;
            justify-content: center;
            direction: ltr;
        }

        .otp-input {
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .otp-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 0, 153, 0.1);
        }

        .password-label {
            text-align: center;
            margin-bottom: 15px;
            font-weight: 600;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <header class="header header-fixed" style="direction: ltr;">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:history.back()" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">تعديل بيانات الفرد</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    <a id="submitForm" href="javascript:void(0);">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </a>
                </div>
            </div>
        </header>

        <main class="page-content space-top p-b80">
            <div class="container">
                <div class="edit-profile">
                    <form method="POST" action="{{ route('users.family.update_has_email', $myFamily) }}" id="hasEmailForm">
                        @csrf

                        <div id="chef-fields" class="chef-fields">
                            <div class="col-md-12" style="text-align: center;">
                                <div class="mb-4">
                                    <label class="form-label">يمكنه الدخول للحساب</label>
                                    <select class="form-select" name="has_email" id="hasEmailSelect" required
                                        style="width: 100%; text-align: center;">
                                        <option value="">اختر الحالة</option>
                                        <option value="1">نعم</option>
                                        <option value="0">لا</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" id="passwordSection" style="display: none;">
                                <div class="password-label">
                                    <label class="form-label">أدخل كلمة المرور (4 أرقام)</label>
                                </div>
                                <div class="otp-group" id="otpGroup" aria-label="حقل كلمة المرور المكوّن من 4 خانات">
                                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="0"
                                        class="form-control otp-input" type="password" id="digit-1" name="digit-1"
                                        placeholder="" autocomplete="off">
                                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="1"
                                        class="form-control otp-input" type="password" id="digit-2" name="digit-2"
                                        placeholder="" autocomplete="off">
                                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="2"
                                        class="form-control otp-input" type="password" id="digit-3" name="digit-3"
                                        placeholder="" autocomplete="off">
                                    <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="3"
                                        class="form-control otp-input" type="password" id="digit-4" name="digit-4"
                                        placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <input type="hidden" name="password" id="passwordHidden" />
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imageuplodify/imageuploadify.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hasEmailSelect = document.getElementById('hasEmailSelect');
            const passwordSection = document.getElementById('passwordSection');
            const otpInputs = document.querySelectorAll('.otp-input');
            const passwordHidden = document.getElementById('passwordHidden');
            const submitButton = document.getElementById('submitForm');
            const form = document.getElementById('hasEmailForm');

            // إظهار/إخفاء حقول كلمة المرور بناءً على الاختيار
            hasEmailSelect.addEventListener('change', function() {
                if (this.value === '1') {
                    passwordSection.style.display = 'block';
                    otpInputs.forEach(input => input.required = true);
                } else if (this.value === '0') {
                    passwordSection.style.display = 'none';
                    otpInputs.forEach(input => {
                        input.required = false;
                        input.value = '';
                    });
                    passwordHidden.value = '';
                }
            });

            // معالجة إدخال OTP
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = this.value;
                    
                    // السماح بالأرقام فقط
                    if (!/^\d*$/.test(value)) {
                        this.value = '';
                        return;
                    }

                    // الانتقال للحقل التالي
                    if (value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }

                    // تحديث الـ password المخفي
                    updatePassword();
                });

                input.addEventListener('keydown', function(e) {
                    // الرجوع للحقل السابق عند Backspace
                    if (e.key === 'Backspace' && !this.value && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                    
                    // الانتقال للحقل التالي عند السهم الأيمن
                    if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                    
                    // الرجوع للحقل السابق عند السهم الأيسر
                    if (e.key === 'ArrowLeft' && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });

                // معالجة اللصق
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text');
                    const digits = pastedData.match(/\d/g);
                    
                    if (digits) {
                        digits.slice(0, 4).forEach((digit, i) => {
                            if (otpInputs[i]) {
                                otpInputs[i].value = digit;
                            }
                        });
                        updatePassword();
                        // التركيز على آخر حقل تم ملؤه
                        const lastFilledIndex = Math.min(digits.length - 1, 3);
                        otpInputs[lastFilledIndex].focus();
                    }
                });
            });

            // تحديث قيمة الـ password المخفي
            function updatePassword() {
                const password = Array.from(otpInputs).map(input => input.value).join('');
                passwordHidden.value = password;
            }

            // إرسال الفورم
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                
                const hasEmail = hasEmailSelect.value;
                
                if (!hasEmail) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'تنبيه',
                        text: 'يرجى اختيار حالة الدخول للحساب',
                        confirmButtonColor: '#660099'
                    });
                    return;
                }

                if (hasEmail === '1') {
                    const password = passwordHidden.value;
                    
                    if (password.length !== 4) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'تنبيه',
                            text: 'يرجى إدخال كلمة المرور المكونة من 4 أرقام',
                            confirmButtonColor: '#660099'
                        });
                        otpInputs[0].focus();
                        return;
                    }
                }

                form.submit();
            });

            // إخفاء preloader
            window.addEventListener('load', function() {
                document.getElementById('preloader').style.display = 'none';
            });
        });
    </script>
</body>

</html>