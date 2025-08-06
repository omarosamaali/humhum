<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>بيانات تحويل الأرباح</title>
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
                    <h4 class="title">بيانات التحويل </h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <!-- Header -->

        <!-- Page Content Start -->
        <main class="page-content space-top" style="margin-top: 50px;">
            <div class="container fixed-full-area">
                <div class="" style="margin-top: 74px; text-align: center;">
                    <form method="POST" action="{{ route('c1he3f.profile.updateTransfer') }}">
                        @csrf
                        <div class="clearfix">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label"
                                        style="
                                     color: #000;">بيانات
                                        تحويل الأرباح</label>
                                    <textarea placeholder="أدخل بيانات التحويل البنكي او حساب الباي بال"
                                        style="text-align: center; margin: auto; width: 95%" class="form-control" name="profit_transfer_details"
                                        style="text-align: center;" rows="4">{{ old('profit_transfer_details', Auth::user()->chefProfile->profit_transfer_details ?? '') }}</textarea>
                                    <div class="instructions container-box mt-4 mx-4" style="padding-bottom: 5px;">
                                        <p><strong>إرشادات تزويد بحساب الباي بال</strong></p>
                                        <p><strong>تزويدنا بالبريد الألكتروني</strong></p>
                                        <p><strong>مع الإسم باللغة الإنجليزية</strong></p>
                                        <div
                                            style="width: 96%; margin: auto; height: .5px; 
                                    background-color: #ccc;">
                                        </div>
                                        <p class="mt-4"><strong>إرشادات التزويد ببيانات التحويل البنكي</strong></p>

                                        <p>لضمان معالجة التحويل البنكي بشكل صحيح وسريع، يرجى تزويدنا بالبيانات التالية
                                            بدقة
                                            عبر الحقل المخصص أعلاه:</p>
                                        <ul style="overflow: auto; margin-bottom: 109px;">
                                            <li><strong>اسم المستفيد الكامل</strong>: يرجى كتابة الاسم كما هو مسجل في
                                                الحساب
                                                البنكي باللغة
                                                الإنجليزية (حسب متطلبات البنك). مثال:
                                                <br/>
                                                Ahmed Mohamed.</li>
                                            <li><strong>اسم البنك</strong>: اذكر الاسم الكامل للبنك الذي يحتضن الحساب.
                                                مثال:
                                                البنك الأهلي السعودي.</li>
                                            <li><strong>رقم الحساب البنكي</strong>: تأكد من إدخال رقم الحساب بشكل صحيح
                                                وكامل. مثال: 1234567890123456.</li>
                                            <li><strong>رقم الآيبان (IBAN)</strong>: يجب إدخال رقم الآيبان الخاص
                                                بالحساب،
                                                وهو عبارة عن سلسلة أحرف وأرقام
                                                تبدأ برمز البلد (مثل SA للسعودية). مثال: SA1234567890123456789012. تأكد
                                                من
                                                التحقق من رقم الآيبان من خلال كشف
                                                الحساب أو تطبيق البنك.</li>
                                            <li><strong>فرع البنك (إن وجد)</strong>: اذكر اسم أو رقم فرع البنك إذا كان
                                                مطلوبًا. مثال: فرع الرياض - شارع
                                                الملك فهد.</li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="footer-fixed-btn bottom-0 bg-white">
                            <button type="submit" class="btn btn-lg btn-thin btn-primary rounded-xl w-100">
                                حفظ</button>
                        </div>
                    </form>

                </div>
            </div>

    </div>
    </main>
    <!-- Page Content End -->

    <!-- Footer Fixed Button -->

    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
</body>

</html>
