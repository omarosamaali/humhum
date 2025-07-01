<!DOCTYPE html>
<html lang="en">

<head>
    <title>إضافة عنوان جديد</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<body class="bg-light">
    <div class="page-wrapper">

        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    {{-- Changed href to use route helper --}}
                    <a href="{{ route('c1he3f.profile.delivery-location') }}" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">إضافة جديد</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <main class="page-content space-top p-b100" style="text-align: center;">
            <div class="container">
                {{-- Added form tag with action and method, and @csrf --}}
                <form action="{{ route('c1he3f.profile.store-delivery-address') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">الدولة</label>
                        {{-- Added name attribute --}}
                        <select class="form-select" name="country" style="width: 100%; text-align: center; color: black;">
                            <option value="">اختر الدولة</option>
                            <option value="مصر" {{ old('country')=='مصر' ? 'selected' : '' }}>مصر</option>
                            <option value="السعودية" {{ old('country')=='السعودية' ? 'selected' : '' }}>السعودية</option>
                            <option value="الإمارات" {{ old('country')=='الإمارات' ? 'selected' : '' }}>الإمارات</option>
                            <option value="الأردن" {{ old('country')=='الأردن' ? 'selected' : '' }}>الأردن</option>
                            <option value="المغرب" {{ old('country')=='المغرب' ? 'selected' : '' }}>المغرب</option>
                            <option value="الجزائر" {{ old('country')=='الجزائر' ? 'selected' : '' }}>الجزائر</option>
                            <option value="السودان" {{ old('country')=='السودان' ? 'selected' : '' }}>السودان</option>
                            <option value="تونس" {{ old('country')=='تونس' ? 'selected' : '' }}>تونس</option>
                            <option value="لبنان" {{ old('country')=='لبنان' ? 'selected' : '' }}>لبنان</option>
                            <option value="قطر" {{ old('country')=='قطر' ? 'selected' : '' }}>قطر</option>
                        </select>
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="city">المدينة</label>
                        {{-- Added name attribute --}}
                        <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control" style="text-align: center;">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="location">المنطقة</label>
                        {{-- Added name attribute --}}
                        <input type="text" id="location" name="area" value="{{ old('area') }}" class="form-control" style="text-align: center;">
                        @error('area')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="delivery_fee">سعر رسوم التوصيل</label>
                        {{-- Added name attribute and changed id for clarity --}}
                        <input type="number" step="0.01" id="delivery_fee" name="delivery_fee" value="{{ old('delivery_fee') }}" class="form-control" placeholder="الأسعار بالدرهم الإماراتي" style="text-align: center;">
                        @error('delivery_fee')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- These parts were hidden with display: none !important;, keeping them hidden --}}
                    <h6 class="dz-title my-2" style="display: none;">الحالة</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center; display: none !important;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="filterRadio" id="filterRadio1" checked="">
                            <label class="form-check-label" for="filterRadio1">
                                فعال
                            </label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="filterRadio" id="filterRadio2">
                            <label class="form-check-label" for="filterRadio2">
                                غير فعال
                            </label>
                        </div>
                    </div>
                    {{-- End of hidden parts --}}

                    <div class="footer-fixed-btn bottom-0 bg-white">
                        <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">حفظ</button>
                    </div>
                    </form>
            </div>
        </main>
        </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
    <script>
        $(document).ready(function() {
            // SweetAlert for notifications (already present)
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'نجاح!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ!',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
</body>

</html>