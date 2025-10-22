<!DOCTYPE html>
<html lang="en">

<head>
    <title>إضافة طباخ</title>
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

    <style>
        :root {
            --primary-color: #660099;
        }

        .edit-profile .avatar-upload .avatar-preview {
            border: 2px solid var(--primary-color);
        }

        .edit-profile .avatar-upload .change-btn {
            background-color: var(--primary-color);
        }

        .form-control:focus,
        .form-control:active,
        .form-control.active {
            border-color: var(--primary-color) !important;
        }

        .form-control {
            border: 2px solid #ebebeb !important;
            border-radius: 6px !important;
        }

        select.form-select {
            border: 2px solid !important;
            color: var(--primary-color) !important;
            --bs-form-select-bg-img: url(https://cdn-icons-png.flaticon.com/512/32/32195.png) !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <!-- Preloader end-->

        <header class="header header-fixed">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">إضافة طباخ</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    <a href="javascript:void(0);" id="submitForm">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Start -->
        <main class="page-content space-top p-b80">
            <div class="container">
                <div class="edit-profile">

                    <form action="{{ route('users.cooks.store') }}" method="POST">
                        @csrf

                        <div class="mb-4" style="text-align: center;">
                            <label class="form-label" for="name">الاسم</label>
                            <div class="input-group input-mini input-sm">
                                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3" style="text-align: center;">
                            <label class="form-label">اللغة</label>
                            <select class="form-select" name="language" required
                                style="width: 100%; text-align: center; color: black;">
                                <option value="">اختر اللغة</option>
                                <option value="العربية">العربية</option>
                                <option value="الإنجليزية">الإنجليزية</option>
                            </select>
                        </div>

                        <div class="col-md-12" id="passwordSection">
                            <div class="password-label">
                                <label class="form-label" style="display: flex; justify-content: center;">أدخل كلمة
                                    المرور (4 أرقام)</label>
                            </div>
                            <div class="otp-group" style="display: flex; gap:11px;" id="otpGroup"
                                aria-label="حقل كلمة المرور المكوّن من 4 خانات">
                                <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="0"
                                    class="form-control otp-input" type="password" id="digit-1" name="digit-1"
                                    placeholder="" autocomplete="off" required>
                                <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="1"
                                    class="form-control otp-input" type="password" id="digit-2" name="digit-2"
                                    placeholder="" autocomplete="off" required>
                                <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="2"
                                    class="form-control otp-input" type="password" id="digit-3" name="digit-3"
                                    placeholder="" autocomplete="off" required>
                                <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="3"
                                    class="form-control otp-input" type="password" id="digit-4" name="digit-4"
                                    placeholder="" autocomplete="off" required>
                            </div>
                        </div>
                        <input type="hidden" name="password" id="passwordHidden" />
                    </form>
                </div>
            </div>
        </main>
    </div>

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
            const otpInputs = document.querySelectorAll('.otp-input');
            const passwordHidden = document.getElementById('passwordHidden');
            const submitButton = document.getElementById('submitForm');
            const form = document.querySelector('form');

            // معالجة إدخال OTP - الانتقال التلقائي
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = this.value;
                    
                    // السماح بالأرقام فقط
                    if (!/^\d*$/.test(value)) {
                        this.value = '';
                        return;
                    }

                    // الانتقال التلقائي للحقل التالي
                    if (value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }

                    // تحديث الباسورد المخفي
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
                
                // نجيب كل العناصر المطلوبة
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                let firstEmptyField = null;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        if (!firstEmptyField) firstEmptyField = field;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('من فضلك املأ جميع الحقول المطلوبة قبل الإرسال.');
                    if (firstEmptyField) firstEmptyField.focus();
                    return;
                }

                // التأكد من كتابة 4 أرقام كاملة
                const password = passwordHidden.value;
                if (password.length !== 4) {
                    alert('يرجى إدخال كلمة المرور المكونة من 4 أرقام');
                    otpInputs[0].focus();
                    return;
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