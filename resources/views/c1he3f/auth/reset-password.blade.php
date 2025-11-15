<!DOCTYPE html>
<html lang="en">

<head>
    <title>إعادة تعين كلمة المرور</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
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
                        <a href="{{ url()->previous() ?: route('home') }}" id="back-btn">
                            <i class="feather icon-arrow-left"></i>
                        </a>
                        <div class="logo" style="right: 32px; position: relative;">
                            <img src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                        </div>
                    </div>
                    <div class="section-head">
                        <h3 class="title">أدخل كلمة المرور الجديدة</h3>
                        <p>يجب أن تكون كلمة المرور الجديدة مختلفة عن كلمة المرور السابقة.</p>
                    </div>
                    <div class="account-section">
                        <form method="POST" action="{{ route('auth/password.update.chef') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="mb-4">
                                <label class="form-label" for="email">عنوان البريد الإلكتروني</label>
                                <div class="input-group input-mini input-lg">
                                    <input id="email" class="form-control block mt-1 w-full" type="email"
                                        name="email" :value="old('email', $request - > email)" required autofocus
                                        autocomplete="username">
                                </div>
                            </div>
                            <div class="mb-4">
                                @error('email')
                                    <span class="error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="dz-password">كلمة المرور</label>
                                <div class="input-group input-group-icon input-mini input-lg">
                                    <input type="password" id="dz-password" class="form-control dz-password"
                                        value="123456789">
                                    <span class="input-group-text show-pass">
                                        <i class="icon feather icon-eye-off eye-close"></i>
                                        <i class="icon feather icon-eye eye-open"></i>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="form-label" for="dz-password2">تأكيد كلمة المرور</label>
                                <div class="input-group input-group-icon input-mini input-lg">
                                    <input type="password" id="dz-password2" class="form-control dz-password"
                                        value="123456789">
                                    <span class="input-group-text show-pass">
                                        <i class="icon feather icon-eye-off إغلاق العين"></i>
                                        <i class="icon feather icon-eye eye-open"></i>
                                    </span>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">متابعة</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <div class="bottom-btn pb-3">
        <div class="text-center mt-3 form-text">العودة إلى <a href="sign-in.html" class="text-underline link">تسجيل
                الدخول</a></div>
    </div>
    </main>
    <!-- Main Content End  -->

    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>

</body>

</html>
