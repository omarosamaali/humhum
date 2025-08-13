<!DOCTYPE html>
<html lang="en">

<head>
    <title>تسجيل حساب الطاهي</title>

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
        <main class="page-content">
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
                    <div class="section-head">
                        <h3 class="title">إنشاء حساب الشريك</h3>
                        <p>نرحب بإنضمامك لإسرة تطبيق هم هم</p>
                    </div>
                    <div class="account-section">
                        <form class="m-b20" method="POST" action="{{ route('c1he3f.auth.sign-up.post') }}" id="sign-up-form">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label" for="name">إسم الطاهي</label>
                                <div class="input-group input-mini input-lg">
                                    <input type="text" id="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name" name="name">
                                    {{-- تغيير type="name" إلى type="text" --}}
                                    <div>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="email">البريد الالكتروني</label>
                                <div class="input-group input-mini input-lg">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-control">
                                </div>
                                <div>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="m-b30">
                                <label class="form-label" for="password">كلمة المرور</label>
                                <div class="input-group input-mini input-lg">
                                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control dz-password">
                                    <span class="input-group-text show-pass">
                                        <i class="icon feather icon-eye-off eye-close"></i>
                                        <i class="icon feather icon-eye eye-open"></i>
                                    </span>
                                </div>
                                <div>
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div id="chef-fields" class="chef-fields">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">الدولة</label>
                                        <select class="form-select" id="country" name="country" required value="{{ old('country') }}" style="width: 100%; text-align: center;">
                                            <option value="" selected>اختر الدولة</option>
                                            <option value="sa" {{ old('country') == 'sa' ? 'selected' : '' }}>المملكة العربية السعودية</option>
                                            <option value="ae" {{ old('country') == 'ae' ? 'selected' : '' }}>الإمارات العربية المتحدة</option>
                                            <option value="qa" {{ old('country') == 'qa' ? 'selected' : '' }}>قطر</option>
                                            <option value="kw" {{ old('country') == 'kw' ? 'selected' : '' }}>الكويت</option>
                                            <option value="bh" {{ old('country') == 'bh' ? 'selected' : '' }}>البحرين</option>
                                            <option value="om" {{ old('country') == 'om' ? 'selected' : '' }}>سلطنة عُمان</option>
                                            <option value="ye" {{ old('country') == 'ye' ? 'selected' : '' }}>اليمن</option>
                                            <option value="iq" {{ old('country') == 'iq' ? 'selected' : '' }}>العراق</option>
                                            <option value="sy" {{ old('country') == 'sy' ? 'selected' : '' }}>سوريا</option>
                                            <option value="jo" {{ old('country') == 'jo' ? 'selected' : '' }}>الأردن</option>
                                            <option value="lb" {{ old('country') == 'lb' ? 'selected' : '' }}>لبنان</option>
                                            <option value="ps" {{ old('country') == 'ps' ? 'selected' : '' }}>فلسطين</option>
                                            <option value="eg" {{ old('country') == 'eg' ? 'selected' : '' }}>مصر</option>
                                            <option value="sd" {{ old('country') == 'sd' ? 'selected' : '' }}>السودان</option>
                                            <option value="ly" {{ old('country') == 'ly' ? 'selected' : '' }}>ليبيا</option>
                                            <option value="tn" {{ old('country') == 'tn' ? 'selected' : '' }}>تونس</option>
                                            <option value="dz" {{ old('country') == 'dz' ? 'selected' : '' }}>الجزائر</option>
                                            <option value="ma" {{ old('country') == 'ma' ? 'selected' : '' }}>المغرب</option>
                                            <option value="mr" {{ old('country') == 'mr' ? 'selected' : '' }}>موريتانيا</option>
                                            <option value="dj" {{ old('country') == 'dj' ? 'selected' : '' }}>جيبوتي</option>
                                            <option value="so" {{ old('country') == 'so' ? 'selected' : '' }}>الصومال</option>
                                            <option value="km" {{ old('country') == 'km' ? 'selected' : '' }}>جزر القمر</option>
                                        </select>
                                        @error('country')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- بما إن هذه الشاشة مخصصة لتسجيل الطهاة فقط، فلا نحتاج حقل اختيار الدور --}}
                            {{-- لكن سنحتفظ بالحقل المخفي لـ role للتأكد من تسجيله كـ 'طاه' --}}
                            <input type="hidden" name="role" value="طاه">
                            <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl">تسجيل</button>
                        </form>
                        <div class="text-center">
                            <p class="form-text">بالنقر على "سجّل"، فإنك توافق على <a href="javascript:void(0);" class="link">الشروط</a> و <a href="javascript:void(0);" class="link">سياسة
                                    الخصوصية</a></p>
                        </div>
                    </div>
                </div>
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
