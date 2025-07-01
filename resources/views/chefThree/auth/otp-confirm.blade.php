<!DOCTYPE html>
<html lang="en">

<head>
    <title>تسجيل حساب الطاهي</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">

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
        <main class="page-content">
            <div class="container py-0">
                <div class="dz-authentication-area">
                    <div class="main-logo">
                        <a href="javascript:history.back();" class="back-btn"> {{-- Changed to history.back() for better navigation --}}
                            <i class="feather icon-arrow-left"></i>
                        </a>
                        <div class="logo" style="right: 32px; position: relative;">
                            <img src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                        </div>
                    </div>
                    <div class="section-head text-center">
                        <h3 class="title">أدخل الكود</h3>
                        <p>تم إرسال رمز مصادقة إلى
                        <p class="text-lowercase">{{ $email ?? 'info@example.com' }}</p> {{-- Display the email passed from controller --}}
                        </p>
                    </div>
                    <div class="account-section">
                        {{-- Laravel form for OTP verification --}}
                        <form action="{{ route('c1he3f.auth.otp-verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email ?? '' }}"> {{-- Pass email as hidden field --}}

                            <div id="otp" class="digit-group input-mini">
                                {{-- Input fields for 6 digits --}}
                                <input class="form-control" type="text" id="otp_digit_1" name="otp_digit_1"
                                    placeholder="" maxlength="1" data-next="otp_digit_2" autofocus>
                                <input class="form-control" type="text" id="otp_digit_2" name="otp_digit_2"
                                    placeholder="" maxlength="1" data-next="otp_digit_3" data-previous="otp_digit_1">
                                <input class="form-control" type="text" id="otp_digit_3" name="otp_digit_3"
                                    placeholder="" maxlength="1" data-next="otp_digit_4" data-previous="otp_digit_2">
                                <input class="form-control" type="text" id="otp_digit_4" name="otp_digit_4"
                                    placeholder="" maxlength="1" data-next="otp_digit_5"
                                    data-previous="otp_digit_3">
                                <input class="form-control" type="text" id="otp_digit_5" name="otp_digit_5"
                                    placeholder="" maxlength="1" data-next="otp_digit_6"
                                    data-previous="otp_digit_4">
                                <input class="form-control" type="text" id="otp_digit_6" name="otp_digit_6"
                                    placeholder="" maxlength="1" data-previous="otp_digit_5">
                            </div>

                            {{-- Display Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3 text-center">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Display Success/Warning messages from controller --}}
                            @if (session('success'))
                                <div class="alert alert-success mt-3 text-center">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('warning'))
                                <div class="alert alert-warning mt-3 text-center">
                                    {{ session('warning') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mt-3 text-center">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="bottom-btn pb-3 mt-4"> {{-- Added mt-4 for spacing --}}
                                <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">التحقق
                                    والمتابعة</button>
                            </div>
                        </form>

                        <div class="text-center form-text mt-3">إذا لم تستلم الرمز!
                            <form action="{{ route('c1he3f.auth.otp-resend') }}" method="POST" class="d-inline">
                                {{-- Inline form for resend OTP --}}
                                @csrf
                                <input type="hidden" name="email" value="{{ $email ?? '' }}">
                                <button type="submit" class="text-underline link border-0 bg-transparent p-0">إعادة
                                    إرسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3 form-text">العودة إلى <a href="{{ route('c1he3f.auth.sign-in') }}"
                    class="text-underline link">تسجيل الدخول</a></div> {{-- Link to sign-in page --}}
        </main>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- Ensure your OTP input logic is in a script that loads after the HTML --}}
    <script>
        $(document).ready(function() {
            $('.digit-group').find('input').each(function() {
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent());

                    if (e.keyCode === 8 || e.keyCode === 37) { // Backspace or Left Arrow
                        var prev = parent.find('input#' + $(this).data('previous'));
                        if (prev.length) {
                            prev.select();
                        }
                    } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e
                            .keyCode <= 105) || e.keyCode === 39) { // 0-9 keys or Right Arrow
                        var next = parent.find('input#' + $(this).data('next'));
                        if (next.length) {
                            next.select();
                        } 
                    }
                });
            });
        });
    </script>
</body>

</html>
