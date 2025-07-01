<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>متجري</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
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
        <main class="page-content space-top" style="margin-top: 50px;">
            <div class="container py-0">
                <div class="dz-authentication-area">
                    <div class="main-logo">
                        <a href="javascript:void(0);" class="back-btn">
                            <i class="feather icon-arrow-left"></i>
                        </a>
                        <div class="logo" style="right: 32px; position: relative;">
                            <img src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                        </div>
                    </div>
                    <div class="section-head text-center">
                        <h3 class="title">متجري</h3>
                        <p>هل لديك منتجات تريد بيعها</p>
                    </div>

                    <form action="{{ route('c1he3f.profile.save-market-choice') }}" method="POST" id="marketChoiceForm">
                        @csrf
                        <ul class="dz-list-group radio style-2" style="direction: rtl;">
                            <li class="list-group-items" style="margin-bottom: 20px; border-radius: 5px; border: 1px solid #e00000; padding: 12px;">
                                <label class="radio-label">
                                    <input type="radio" name="has_market" value="1" {{ old('has_market', $chefHasMarket ?? 0) == 1 ? 'checked' : '' }}>
                                    <div class="checkmark">
                                        <div class="list-content">
                                            <h6 class="title">نعم</h6>
                                        </div>
                                        <span class="check"></span>
                                    </div>
                                </label>
                            </li>
                            <li class="list-group-items" style="margin-bottom: 20px; border-radius: 5px; border: 1px solid #e00000; padding: 12px;">
                                <label class="radio-label">
                                    <input type="radio" name="has_market" value="0" {{ old('has_market', $chefHasMarket ?? 0) == 0 ? 'checked' : '' }}>
                                    <div class="checkmark">
                                        <div class="list-content">
                                            <h6 class="title">لا</h6>
                                        </div>
                                        <span class="check"></span>
                                    </div>
                                </label>
                            </li>
                        </ul>

                        {{-- الزر الذي سيتم إخفاؤه/إظهاره --}}
                        <div class="footer-fixed-btn bottom-0 bg-white" id="deliveryLocationButton" style="bottom: 25%; position: relative; 
                             {{ old('has_market', $chefHasMarket ?? 0) == 0 ? 'display: none;' : '' }}">
                            <a href="{{ route('c1he3f.coming-soon') }}" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">أماكن التوصيل</a>
                        </div>

                        {{-- زر الحفظ الذي ينقل لصفحة البروفايل أو أماكن التوصيل بناءً على الاختيار --}}
                        <div class="footer-fixed-btn bottom-0 bg-white">
                            <a href={{ route('c1he3f.coming-soon') }} type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl"
                            >حفظ</a>
                        </div>
                    </form>

                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>

    <script>
        $(document).ready(function() {
            // SweetAlert للتنبيهات
            @if(session('success'))
            Swal.fire({
                icon: 'success'
                , title: 'نجاح!'
                , text: '{{ session('
                success ') }}'
                , showConfirmButton: false
                , timer: 3000
            });
            @endif

            @if(session('error'))
            Swal.fire({
                icon: 'error'
                , title: 'خطأ!'
                , text: '{{ session('
                error ') }}'
                , showConfirmButton: false
                , timer: 3000
            });
            @endif

            // التحكم في زر "أماكن التوصيل"
            $('input[name="has_market"]').change(function() {
                if ($(this).val() == '1') { // إذا اختار "نعم"
                    $('#deliveryLocationButton').show();
                } else { // إذا اختار "لا"
                    $('#deliveryLocationButton').hide();
                }
            });

            // تأكد من أن الزر يظهر/يختفي عند تحميل الصفحة
            var initialValue = $('input[name="has_market"]:checked').val();
            if (initialValue == '1') {
                $('#deliveryLocationButton').show();
            } else {
                $('#deliveryLocationButton').hide();
            }
        });

    </script>
</body>

</html>
