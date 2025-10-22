<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>تسجيل دخول الفرد</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/family-logo/icon.png">
    <link rel="stylesheet" class="main-css" type="text/css" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        :root {
            --primary: #29A500;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn:hover {
            background-color: var(--primary);
            border-color: var(--primary);
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

        <!-- Main Content Start  -->
        <main class="page-content">
            <div class="container py-0">
                <div class="dz-authentication-area">
                    <div class="main-logo">
                        <div class="logo" style="top: 15px; left: 32px; position: relative;">
                            <img src="assets/images/family-logo/logo.png" alt="logo">
                        </div>
                    </div>
                    <div class="section-head">
                        <h3 class="title">تسجل دخول المستخدم</h3>
                        <p>أدخل البيانات المطلوبة لتسجيل الدخول</p>
                    </div>
                    <div class="account-section">
                        <form class="m-b30" method="POST" action="{{ route('users.family_members.login.post') }}">
                            @csrf

                            @if($errors->has('login'))
                            <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                            @endif

                            <div class="mb-4">
                                <label class="form-label" for="family_number">رقم العضوية</label>
                                <div class="input-group input-mini input-lg">
                                    <input type="text" name="family_number" id="family_number"
                                        class="form-control @error('family_number') is-invalid @enderror"
                                        value="{{ old('family_number') }}" maxlength="5" pattern="\d{1,5}"
                                        inputmode="numeric">
                                </div>
                                @error('family_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="m-b30">
                                <label class="form-label" for="password">رمز الدخول</label>
                                <div class="account-section">
                                    <input type="hidden" name="password" id="password-hidden">
                                    <div id="otp" class="digit-group input-mini">
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="0">
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="1">
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="2">
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="3">
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-thin btn-lg w-100 btn-primary rounded-xl mb-3">دخول</button>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.otp-input');
    const hiddenInput = document.getElementById('password-hidden');
    
    inputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            if (this.value.length === 1) {
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            }
            updateHiddenInput();
        });
        
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && this.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
    
    function updateHiddenInput() {
        let password = '';
        inputs.forEach(input => {
            password += input.value;
        });
        hiddenInput.value = password;
    }
});
                        </script>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content End  -->
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
    <script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>