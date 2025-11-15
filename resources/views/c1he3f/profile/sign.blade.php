<!DOCTYPE html>
<html lang="en">

<head>
    <title>إعتماد الإتفاقية</title>
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
    {!! $swalScript !!}
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
        <style>
            .placeholder {
                min-height: 1px !important;
                height: 1px !important;
            }
            .error-message {
                color: red;
                font-size: 0.85em;
                margin-top: 5px;
                text-align: right;
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
        <main class="page-content">
            <div class="container py-0">
                <div class="dz-authentication-area">
                    <div class="main-logo">
                        <a href="javascript:history.back()" id="back-btn"> {{-- تم تعديله للعودة للصفحة السابقة --}}
                            <i class="feather icon-arrow-left"></i>
                        </a>
                        <div class="logo" style="right: 32px; position: relative;">
                            <img src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                        </div>
                    </div>
                    <div class="section-head text-center">
                        <h3 class="title">رمز الإعتماد</h3>
                        <p>تم إرسال رمز إعتماد توقيع الإتفاقية على
                        <p class="text-lowercase">{{ auth()->user()->email }}</p> {{-- عرض البريد الإلكتروني للمستخدم --}}
                        </p>
                    </div>
                    <div class="account-section">
                        <form action="{{ route('c1he3f.profile.verify-contract-otp') }}" method="POST"> {{-- تعديل مسار الإرسال --}}
                            @csrf {{-- إضافة CSRF token --}}
                            <div id="otp" class="digit-group input-mini">
                                {{-- تم تعديل 'الاسم' إلى 'name' وإضافة 'maxlength' و 'inputmode' و 'pattern' --}}
                                <input class="form-control" type="text" id="digit-2" name="digit-2" placeholder=""
                                    data-next="digit-3" data-previous="digit-1" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                                <input class="form-control" type="text" id="digit-3" name="digit-3" placeholder=""
                                    data-next="digit-4" data-previous="digit-2" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                                <input class="form-control" type="text" id="digit-4" name="digit-4" placeholder=""
                                    data-next="digit-5" data-previous="digit-3" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                                <input class="form-control" type="text" id="digit-5" name="digit-5" placeholder=""
                                    data-next="digit-6" data-previous="digit-4" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                            </div>

                            {{-- عرض رسائل الأخطاء للـ Validation --}}
                            @error('digit-2')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @error('digit-3')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @error('digit-4')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @error('digit-5')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            {{-- عرض رسائل الأخطاء العامة من session --}}
                            @if(session('error'))
                                <div class="error-message">{{ session('error') }}</div>
                            @endif


                            <div class="text-center form-text">إذا لم تستلم الرمز!
                                {{-- تعديل رابط إعادة الإرسال ليقوم بـ POST request --}}
                                <a href="{{ url()->previous() ?: route('home') }}" onclick="document.getElementById('resend-otp-form').submit();"
                                   class="text-underline link">إعادة إرسال</a>
                            </div>

                            <div class="bottom-btn pb-3">
                                <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">
                                    التوقيع والإعتماد</button>
                                <div class="text-center mt-3 form-text">
                                    بإدخال رمز الإعتماد والضغط علي التوقيع يتم إعتماد العقد
                                </div>
                            </div>
                        </form>

                        <form id="resend-otp-form" action="{{ route('c1he3f.profile.resend-contract-otp') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </main>
        </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        // SweetAlert for session messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'نجاح!',
                text: '{{ session('success') }}',
                confirmButtonText: 'حسناً'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'خطأ!',
                text: '{{ session('error') }}',
                confirmButtonText: 'حسناً'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'معلومة!',
                text: '{{ session('info') }}',
                confirmButtonText: 'حسناً'
            });
        @endif


        // OTP input auto-focus/move logic (as provided by your template)
        $(function() {
            $('.digit-group').find('input').each(function() {
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent());

                    if (e.keyCode === 8 || e.keyCode === 37) { // Backspace or Left arrow
                        var prev = parent.find('input#' + $(this).data('previous'));
                        if (prev.length) {
                            prev.focus();
                        }
                    } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) { // 0-9 keys or Right arrow
                        var next = parent.find('input#' + $(this).data('next'));
                        if (next.length) {
                            next.focus();
                        } else {
                            // If it's the last input, trigger form submission or focus elsewhere
                            $(this).blur();
                            // Optional: submit the form automatically if all digits are entered
                            // $('form').submit();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>