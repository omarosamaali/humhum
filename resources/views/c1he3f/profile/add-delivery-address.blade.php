<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>إضافة مكان</title>
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

    <style>
        body {
            font-family: 'Noto Naskh Arabic', sans-serif;
            direction: rtl;
            text-align: right;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            text-align: center;
            color: black;
        }

        .footer-fixed-btn {
            padding: 10px;
            text-align: center;
        }

        .btn-thin {
            padding: 10px;
            font-size: 16px;
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

            <!-- Header -->
            <header class="header header-fixed border-bottom onepage">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <i class="feather icon-arrow-left"></i>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h4 class="title">إتفاقية الإستخدام</h4>
                    </div>
                    <div class="right-content"></div>
                </div>
            </header>
            <!-- Header -->

    <main class="page-content space-top" style="margin-top: 50px;">
        <div class="container">
            <form action="{{ route('c1he3f.profile.store-delivery-address') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">الدولة</label>
                    <select class="form-select" name="country" style="font-family: 'cairo'; width: 100%; text-align: center; color: black;">
                        <option value="">اختر الدولة</option>
                        <option value="مصر" {{ old('country') == 'مصر' ? 'selected' : '' }}>مصر</option>
                        <option value="السعودية" {{ old('country') == 'السعودية' ? 'selected' : '' }}>السعودية</option>
                        <option value="الإمارات" {{ old('country') == 'الإمارات' ? 'selected' : '' }}>الإمارات</option>
                        <option value="الأردن" {{ old('country') == 'الأردن' ? 'selected' : '' }}>الأردن</option>
                        <option value="المغرب" {{ old('country') == 'المغرب' ? 'selected' : '' }}>المغرب</option>
                        <option value="الجزائر" {{ old('country') == 'الجزائر' ? 'selected' : '' }}>الجزائر</option>
                        <option value="السودان" {{ old('country') == 'السودان' ? 'selected' : '' }}>السودان</option>
                        <option value="تونس" {{ old('country') == 'تونس' ? 'selected' : '' }}>تونس</option>
                        <option value="لبنان" {{ old('country') == 'لبنان' ? 'selected' : '' }}>لبنان</option>
                        <option value="قطر" {{ old('country') == 'قطر' ? 'selected' : '' }}>قطر</option>
                    </select>
                    @error('country')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="city">المدينة</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control" style="font-family: 'cairo'; text-align: center;">

                    @error('city')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="location">المنطقة</label>
                    <input type="text" id="location" name="area" value="{{ old('area') }}" class="form-control" style="font-family: 'cairo'; text-align: center;">

                    @error('area')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="delivery_fee">سعر رسوم التوصيل</label>
                    <input type="number" step="0.01" id="delivery_fee" name="delivery_fee" value="{{ old('delivery_fee') }}" class="form-control" placeholder="الأسعار بالدرهم الإماراتي" style="font-family: 'cairo'; text-align: center;">

                    @error('delivery_fee')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="footer-fixed-btn bottom-0 bg-white">
                    <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">حفظ</button>
                </div>
            </form>
        </div>
    </main>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
