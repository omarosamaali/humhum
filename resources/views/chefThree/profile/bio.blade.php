<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Title -->
    <title>النبذة التعريفية</title>
    <!-- Meta -->
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
    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <!-- Header -->
        <header class="header header-fixed border-bottom onepage">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">النبذة التعريفية </h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <!-- Header -->

        <!-- Page Content Start -->
        <main class="page-content space-top" style="margin-top: 50px;">
            <div class="container fixed-full-area">
                <form method="POST" action="{{ route('c1he3f.profile.updateBio') }}">
                    @csrf
                <div class="error-page" style="top: 30%;">
                    <div class="clearfix">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">نبذة تعريفية</label>
                                    <textarea 
                                    class="form-control" name="bio" rows="4" style="text-align: center; margin: auto; width: 95%">
                                {{ old('bio', Auth::user()->chefProfile->bio ?? '') }}</textarea>
                                </div>
                            </div>
                            <!-- Footer Fixed Button -->
                    </div>
                </div>
                <div class="footer-fixed-btn bottom-0 bg-white">
                    <button type="submit" class="btn btn-lg btn-thin btn-primary rounded-xl w-100">
                        حفظ</button>
                </div>
                </form>

            </div>
        </main>
        <!-- Page Content End -->


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // كود JavaScript الموجود لإخفاء/إظهار حقول الاشتراك
            const contractTypeSelect = document.getElementById('contract_type');
            const subscriptionFields = document.getElementById('subscription-fields');

            function toggleFields() {
                subscriptionFields.style.display = contractTypeSelect.value === 'annual_subscription' ? 'block' : 'none';
            }
            toggleFields(); // Set initial state

            contractTypeSelect.addEventListener('change', toggleFields);

            // كود SweetAlert لإظهار رسائل النجاح والخطأ
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'نجاح!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000 // الرسالة تختفي بعد 3 ثواني
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true // يمكن للمستخدم إغلاقها يدوياً
                });
            @endif

            // إذا كنت تستخدم old() لعرض رسائل التحقق من الصحة (validation errors)
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ في الإدخال!',
                    html: '{!! implode("<br>", $errors->all()) !!}', // لعرض كل الأخطاء في سطر جديد
                    showConfirmButton: true
                });
            @endif
        });
    </script>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
</body>

</html>
