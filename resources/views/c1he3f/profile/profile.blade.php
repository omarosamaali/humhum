<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <!-- Title -->
    <title>الملف الشخصي</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
        .delete-btn {
            border: 0px;
            border: 1px solid black;
            background: white;
            color: black;
            font-weight: bold;
            border-radius: 10px;
            height: 48px;
            min-width: 118px;
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

        <!-- Sidebar -->
        <div class="sidebar dz-floting-sidebar">
            <div class="sidebar-header">
                <div class="app-logo">
                    <img class="logo-dark" src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                    <img class="logo-white d-none" src="{{ asset('assets/images/app-logo/logo-white.png') }}" alt="logo">
                </div>
                <div class="title-bar mb-0">
                    <h4 class="title font-w600" style="visibility: collapse;">Main وصفة</h4>
                    <a href="javascript:void(0);" class="floating-close"><i class="feather icon-x"></i></a>
                </div>
            </div>
            <ul class="nav navbar-nav" style="direction: ltr;">

                <li>
                    <a class="nav-link {{ Auth::user()->status == 'فعال' ? 'active' : 'disabled' }}" href="{{ route('c1he3f.index') }}">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 8.40002V21C3 21.2652 3.10536 21.5196 3.29289 21.7071C3.48043 21.8947 3.73478 22 4 22H20C20.2652 22 20.5196 21.8947 20.7071 21.7071C20.8946 21.5196 21 21.2652 21 21V8.40002C21.0001 8.23638 20.96 8.07523 20.8833 7.93069C20.8066 7.78616 20.6956 7.66265 20.56 7.57102L12.56 2.17102C12.3946 2.05924 12.1996 1.99951 12 1.99951C11.8004 1.99951 11.6054 2.05924 11.44 2.17102L3.44 7.57102C3.30443 7.66265 3.19342 7.78616 3.11671 7.93069C3.03999 8.07523 2.99992 8.23638 3 8.40002V8.40002ZM14 20H10V14H14V20ZM5 8.93202L12 4.20702L19 8.93202V20H16V13C16 12.7348 15.8946 12.4804 15.7071 12.2929C15.5196 12.1054 15.2652 12 15 12H9C8.73478 12 8.48043 12.1054 8.29289 12.2929C8.10536 12.4804 8 12.7348 8 13V20H5V8.93202Z" fill="#BDBDBD" />
                            </svg>
                        </span>
                        <span>الرئيسية</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.profile.profile') }}">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_329_300)">
                                    <path d="M15.7 11.7171C16.6839 10.9477 17.4031 9.89048 17.7575 8.69283C18.1118 7.49518 18.0836 6.21681 17.6767 5.03597C17.2698 3.85513 16.5046 2.8307 15.4877 2.10553C14.4708 1.38036 13.253 0.990601 12.004 0.990601C10.755 0.990601 9.53719 1.38036 8.52031 2.10553C7.50342 2.8307 6.73819 3.85513 6.33131 5.03597C5.92443 6.21681 5.89619 7.49518 6.25053 8.69283C6.60487 9.89048 7.32413 10.9477 8.308 11.7171C6.44917 12.4567 4.85467 13.7364 3.73027 15.3911C2.60587 17.0458 2.00318 18.9995 2 21.0001V22.0001C2 22.2653 2.10536 22.5196 2.29289 22.7072C2.48043 22.8947 2.73478 23.0001 3 23.0001H21C21.2652 23.0001 21.5196 22.8947 21.7071 22.7072C21.8946 22.5196 22 22.2653 22 22.0001V21.0001C21.9975 19.0004 21.3959 17.0474 20.273 15.3928C19.1501 13.7382 17.5573 12.4579 15.7 11.7171V11.7171ZM8 7.00007C8 6.20895 8.2346 5.43559 8.67412 4.77779C9.11365 4.12 9.73836 3.60731 10.4693 3.30456C11.2002 3.00181 12.0044 2.92259 12.7804 3.07693C13.5563 3.23128 14.269 3.61224 14.8284 4.17165C15.3878 4.73106 15.7688 5.44379 15.9231 6.21971C16.0775 6.99564 15.9983 7.7999 15.6955 8.53081C15.3928 9.26171 14.8801 9.88642 14.2223 10.3259C13.5645 10.7655 12.7911 11.0001 12 11.0001C10.9391 11.0001 9.92172 10.5786 9.17157 9.8285C8.42143 9.07835 8 8.06094 8 7.00007ZM4 21.0001C4 18.8783 4.84285 16.8435 6.34315 15.3432C7.84344 13.8429 9.87827 13.0001 12 13.0001C14.1217 13.0001 16.1566 13.8429 17.6569 15.3432C19.1571 16.8435 20 18.8783 20 21.0001H4Z" fill="#B0ACB3" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_329_300">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <span>ملفي</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.faq') }}"> <span class="dz-icon">
                            <i class="fi fi-rr-comments text-dark"></i>
                        </span>
                        <span>الأسئلة الشائعة</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.about') }}"> <span class="dz-icon">
                            <i class="fi fi-rr-info text-dark"></i>
                        </span>
                        <span>إعرفنا</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.messages') }}"> <span class="dz-icon">
                            <i class="feather icon-message-circle"></i>
                        </span>
                        <span>تواصل معنا</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.65 3.10008C16.5318 3.04157 16.4033 3.00692 16.2717 2.9981C16.1401 2.98928 16.0081 3.00646 15.8831 3.04866C15.7582 3.09087 15.6428 3.15727 15.5435 3.24407C15.4442 3.33088 15.363 3.43639 15.3045 3.55458C15.246 3.67277 15.2114 3.80132 15.2025 3.9329C15.1937 4.06448 15.2109 4.19652 15.2531 4.32146C15.2953 4.4464 15.3617 4.5618 15.4485 4.66108C15.5353 4.76036 15.6408 4.84157 15.759 4.90008C17.4682 5.74788 18.8405 7.14857 19.6532 8.87467C20.4659 10.6008 20.6712 12.5509 20.2358 14.4084C19.8004 16.2659 18.7499 17.9217 17.2548 19.1069C15.7597 20.292 13.9079 20.937 12 20.937C10.0922 20.937 8.24035 20.292 6.74526 19.1069C5.25018 17.9217 4.19964 16.2659 3.76424 14.4084C3.32885 12.5509 3.53417 10.6008 4.34687 8.87467C5.15956 7.14857 6.5319 5.74788 8.24102 4.90008C8.47972 4.78192 8.6617 4.57379 8.74694 4.32146C8.83217 4.06913 8.81368 3.79327 8.69553 3.55458C8.57737 3.31588 8.36924 3.1339 8.11691 3.04866C7.86458 2.96343 7.58872 2.98192 7.35002 3.10008C5.23724 4.14875 3.54096 5.88079 2.5366 8.01498C1.53223 10.1492 1.27875 12.5602 1.81731 14.8566C2.35587 17.153 3.65485 19.2 5.50334 20.6651C7.35184 22.1302 9.64131 22.9275 12 22.9275C14.3587 22.9275 16.6482 22.1302 18.4967 20.6651C20.3452 19.2 21.6442 17.153 22.1827 14.8566C22.7213 12.5602 22.4678 10.1492 21.4635 8.01498C20.4591 5.88079 18.7628 4.14875 16.65 3.10008V3.10008Z" fill="#FF8484" />
                                <path d="M12 13.0001C12.2652 13.0001 12.5196 12.8948 12.7071 12.7072C12.8947 12.5197 13 12.2654 13 12.0001V2.00012C13 1.73491 12.8947 1.48055 12.7071 1.29302C12.5196 1.10548 12.2652 1.00012 12 1.00012C11.7348 1.00012 11.4804 1.10548 11.2929 1.29302C11.1054 1.48055 11 1.73491 11 2.00012V12.0001C11 12.2654 11.1054 12.5197 11.2929 12.7072C11.4804 12.8948 11.7348 13.0001 12 13.0001Z" fill="#FF8484" />
                            </svg>
                        </span>
                        <span>تسجيل خروج</span>
                    </a>
                    <form id="sign-out-form" action="{{ route('chef.logout') }}" method="POST" class="d-none">

                        @csrf
                    </form>
                </li>
            </ul>
            <div class="sidebar-bottom" style="direction: ltr;">
                <div class="dz-mode">
                    <div class="theme-btn">
                        <i class="feather icon-sun sun"></i>
                        <i class="feather icon-moon moon"></i>
                    </div>
                </div>
                <div class="app-info">
                    <h6 class="name">هم هم - الشريك</h6>
                    <span class="ver-info">v.4.0.0</span>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->

        <!-- Nav Floting Start -->
        <div class="dz-nav-floting">
            <!-- Header -->
            <header class="header py-2 mx-auto" style="position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                        <div class="info">
                            <a href="{{ route('c1he3f.profile.edit-profile') }}">
                                <svg enable-background="new 0 0 461.75 461.75" height="24" viewBox="0 0 461.75 461.75" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m23.099 461.612c2.479-.004 4.941-.401 7.296-1.177l113.358-37.771c3.391-1.146 6.472-3.058 9.004-5.587l226.67-226.693 75.564-75.541c9.013-9.016 9.013-23.63 0-32.645l-75.565-75.565c-9.159-8.661-23.487-8.661-32.645 0l-75.541 75.565-226.693 226.67c-2.527 2.53-4.432 5.612-5.564 9.004l-37.794 113.358c-4.029 12.097 2.511 25.171 14.609 29.2 2.354.784 4.82 1.183 7.301 1.182zm340.005-406.011 42.919 42.919-42.919 42.896-42.896-42.896zm-282.056 282.056 206.515-206.492 42.896 42.896-206.492 206.515-64.367 21.448z" fill="#4A3749"></path>
                                </svg>
                            </a>

                        </div>
                    </div>
                    <div class="mid-content" style="font-weight: bold; font-size: 19px;">
                        الملف الشخصي
                    </div>
                    <div class="right-content d-flex align-items-center gap-4">

                        <a href="javascript:void(0);" class="icon dz-floating-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="2" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect y="18" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect x="4" y="10" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                            </svg>
                        </a>
                    </div>
                </div>
            </header>


            <!-- Header -->

            <!-- Main Content Start -->
            <main class="page-content space-top p-b40">
                <div class="container pt-0">
                    <div class="profile-area">
                        <div class="author-bx">
                            <div class="dz-media">
                                @if (Auth::user()->chefProfile && Auth::user()->chefProfile->official_image)
                                <img class="img-fluid" style="border-radius: 50%; width: 100px; height: 100px;" src="{{ asset('storage/' . Auth::user()->chefProfile->official_image) }}" alt>
                                @else
                                <img class="img-fluid" style="border-radius: 50%; width: 100px; height: 100px;" src="{{ asset('assets/images/chef (3).png') }}" alt>
                                @endif
                            </div>
                            <div class="dz-content">
                                <h2 class="name" style="text-transform: capitalize;">{{ Auth::user()->name }}</h2>
                                <p>حالة الحساب :
                                    @php
                                    $user = Auth::user();
                                    $chefProfile = $user->chefProfile;

                                    // تحقق من اكتمال البيانات المطلوبة
                                    $isDataComplete = false;

                                    if ($chefProfile) {
                                    $hasOfficialImage = !empty($chefProfile->official_image);
                                    $hasContractType = !empty($chefProfile->contract_type);
                                    $hasBio = !empty($chefProfile->bio);
                                    $hasSignedContract = !empty($user->contract_signed_at);

                                    // إذا كانت جميع البيانات الأربعة موجودة
                                    $isDataComplete = $hasOfficialImage && $hasContractType && $hasBio && $hasSignedContract;
                                    }
                                    @endphp

                                    @php
                                    $user = Auth::user();
                                    $chefProfile = $user->chefProfile;

                                    // تحقق من اكتمال البيانات المطلوبة
                                    $isDataComplete = false;

                                    if ($chefProfile) {
                                    $hasOfficialImage = !empty($chefProfile->official_image);
                                    $hasContractType = !empty($chefProfile->contract_type);
                                    $hasBio = !empty($chefProfile->bio);
                                    $hasSignedContract = !empty($user->contract_signed_at);

                                    // إذا كانت جميع البيانات الأربعة موجودة
                                    $isDataComplete = $hasOfficialImage && $hasContractType && $hasBio && $hasSignedContract;
                                    }
                                    @endphp

                                    @if (Auth::user()->role === 'طاه')
                                    @if (Auth::user()->status == 'فعال')
                                    فعال
                                    @elseif ($isDataComplete)
                                    بإنتظار الاعتماد
                                    @else
                                    بإنتظار إستكمال البيانات
                                    @endif
                                    @else
                                    بإنتظار إستكمال البيانات
                                    @endif

                                </p>
                            </div>
                            <div style="margin-top: 10px;">
                                <button class="delete-btn" id="deleteAccountBtn">🗑️ حذف حسابي</button>
                            </div>

                        </div>
                        <div class="widget_getintuch pb-15 profile">
                            <ul>
                                <li>
                                    <div class="icon-bx">
                                        <svg class="svg-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.9993 5.48404C9.59314 5.48404 7.64258 7.4346 7.64258 9.84075C7.64258 12.2469 9.59314 14.1975 11.9993 14.1975C14.4054 14.1975 16.356 12.2469 16.356 9.84075C16.356 7.4346 14.4054 5.48404 11.9993 5.48404ZM11.9993 12.0191C10.7962 12.0191 9.82096 11.0438 9.82096 9.84075C9.82096 8.6377 10.7962 7.66242 11.9993 7.66242C13.2023 7.66242 14.1776 8.6377 14.1776 9.84075C14.1776 11.0438 13.2023 12.0191 11.9993 12.0191Z" fill="#4A3749"></path>
                                            <path d="M21.793 9.81896C21.8074 4.41054 17.4348 0.0144869 12.0264 5.09008e-05C6.61797 -0.0143851 2.22191 4.35827 2.20748 9.76664C2.16044 15.938 5.85106 21.5248 11.546 23.903C11.6884 23.9674 11.8429 24.0005 11.9991 24C12.1565 24.0002 12.3121 23.9668 12.4555 23.9019C18.1324 21.5313 21.8191 15.9709 21.793 9.81896ZM11.9992 21.7127C7.30495 19.646 4.30485 14.9691 4.38364 9.84071C4.38364 5.63477 7.79323 2.22518 11.9992 2.22518C16.2051 2.22518 19.6147 5.63477 19.6147 9.84071V9.91152C19.6686 15.0154 16.672 19.6591 11.9992 21.7127Z" fill="#4A3749"></path>
                                        </svg>
                                    </div>
                                    <div class="dz-content">
                                        <p class="sub-title">الدولة</p>
                                        <h6 class="title">
                                            @php
                                            $countryName = '';
                                            switch (strtolower($chefProfile->country)) {

                                            case 'sa':
                                            $countryName = 'المملكة العربية السعودية';
                                            break;
                                            case 'ae':
                                            $countryName = 'الإمارات العربية المتحدة';
                                            break;
                                            case 'qa':
                                            $countryName = 'قطر';
                                            break;
                                            case 'kw':
                                            $countryName = 'الكويت';
                                            break;
                                            case 'bh':
                                            $countryName = 'البحرين';
                                            break;
                                            case 'om':
                                            $countryName = 'سلطنة عُمان';
                                            break;
                                            case 'ye':
                                            $countryName = 'اليمن';
                                            break;
                                            case 'iq':
                                            $countryName = 'العراق';
                                            break;
                                            case 'sy':
                                            $countryName = 'سوريا';
                                            break;
                                            case 'jo':
                                            $countryName = 'الأردن';
                                            break;
                                            case 'lb':
                                            $countryName = 'لبنان';
                                            break;
                                            case 'ps':
                                            $countryName = 'فلسطين';
                                            break;
                                            case 'eg':
                                            $countryName = 'مصر';
                                            break;
                                            case 'sd':
                                            $countryName = 'السودان';
                                            break;
                                            case 'ly':
                                            $countryName = 'ليبيا';
                                            break;
                                            case 'tn':
                                            $countryName = 'تونس';
                                            break;
                                            case 'dz':
                                            $countryName = 'الجزائر';
                                            break;
                                            case 'ma':
                                            $countryName = 'المغرب';
                                            break;
                                            case 'mr':
                                            $countryName = 'موريتانيا';
                                            break;
                                            case 'dj':
                                            $countryName = 'جيبوتي';
                                            break;
                                            case 'so':
                                            $countryName = 'الصومال';
                                            break;
                                            case 'km':
                                            $countryName = 'جزر القمر';
                                            break;
                                            default:
                                            $countryName = 'غير محدد';
                                            break;
                                            }
                                            @endphp
                                            @if (Auth::user()->chefProfile)
                                            <p><strong></strong> {{ $countryName }}</p>
                                            {{-- <img src="https://flagcdn.com/24x18/{{ strtolower($chefProfile->country) ?: 'default' }}.png" 
                                            alt="علم {{ $countryName }}" style="width: 24px; height: 18px; vertical-align: middle;"> --}}
                                            @else
                                            <p>لا يوجد ملف شخصي.</p>
                                            @endif 
                                        </h6>


                                        {{-- {{ Auth::user()->chefProfile ? Auth::user()->chefProfile->country : 'غير محدد' }} --}}
                                        </h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-bx">
                                        <svg class="svg-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22 3H2C1.73478 3 1.48043 3.10536 1.29289 3.29289C1.10536 3.48043 1 3.73478 1 4V20C1 20.2652 1.10536 20.5196 1.29289 20.7071C1.48043 20.8946 1.73478 21 2 21H22C22.2652 21 22.5196 20.8946 22.7071 20.7071C22.8946 20.5196 23 20.2652 23 20V4C23 3.73478 22.8946 3.48043 22.7071 3.29289C22.5196 3.10536 22.2652 3 22 3ZM21 19H3V9.477L11.628 12.929C11.867 13.0237 12.133 13.0237 12.372 12.929L21 9.477V19ZM21 7.323L12 10.923L3 7.323V5H21V7.323Z" fill="#4A3749"></path>
                                        </svg>
                                    </div>
                                    <div class="dz-content">
                                        <p class="sub-title">البريد الإلكتروني</p>
                                        <h6 class="title">{{ Auth::user()->email }}</h6>
                                    </div>
                                </li>
                            </ul>
                            <div style="display: flex; gap: 6px;">
                                <a href="{{ route('c1he3f.profile.profileDisplayed') }}" class="btn btn-primary" style="width: 100% !important;
							margin-bottom: 20px;
							">كيف يرى عملائك ملفك</a>

                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // الكود الموجود هنا...

                                        // إضافة وظيفة زر حذف الحساب
                                        const deleteBtn = document.querySelector('.delete-btn');

                                        if (deleteBtn) {
                                            deleteBtn.addEventListener('click', function() {
                                                Swal.fire({
                                                    title: 'تأكيد حذف الحساب'
                                                    , html: `
<div style="text-align: right; margin-bottom: 20px;">
    <p>لحذف حسابك نهائياً، يجب عليك كتابة كلمة <strong>delete</strong> في الحقل أدناه.</p>
    <p style="color: #dc3545; font-size: 0.9em; margin-top: 10px;">
        <strong>تحذير:</strong> سيتم حذف جميع بياناتك وإلغاء تفعيل جميع الوصفات والفيديوهات الخاصة بك نهائياً.
    </p>
    <p style="color: #dc3545; font-size: 0.9em; margin-top: 5px;">
        <strong>هذا الإجراء لا يمكن التراجع عنه!</strong>
    </p>
</div>
<div class="confirmation-input">
    <label for="deleteConfirmationInput" style="display: block; margin-bottom: 8px; font-weight: bold;">اكتب كلمة "delete" للتأكيد:</label>
    <input type="text" id="deleteConfirmationInput" class="swal2-input" placeholder="اكتب delete هنا" style="margin:0px; width: 100%; text-align: center;">
    <div id="deleteInputError" class="error-text" style="display: none; color: #dc3545; font-size: 0.875em; margin-top: 5px;">يجب كتابة كلمة "delete" بالضبط</div>
</div>
`
                                                    , icon: 'error'
                                                    , showCancelButton: true
                                                    , confirmButtonColor: '#dc3545'
                                                    , cancelButtonColor: '#6c757d'
                                                    , confirmButtonText: 'حذف الحساب نهائياً'
                                                    , cancelButtonText: 'إلغاء'
                                                    , customClass: {
                                                        popup: 'text-right'
                                                        , title: 'text-right'
                                                        , content: 'text-right'
                                                    }
                                                    , preConfirm: () => {
                                                        const inputValue = document.getElementById('deleteConfirmationInput').value;
                                                        const errorDiv = document.getElementById('deleteInputError');

                                                        if (inputValue !== 'delete') {
                                                            errorDiv.style.display = 'block';
                                                            return false;
                                                        }
                                                        return true;
                                                    }
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // الحصول على CSRF Token
                                                        const csrfToken = getCSRFToken();

                                                        if (!csrfToken) {
                                                            Swal.fire({
                                                                title: 'خطأ'
                                                                , text: 'لم يتم العثور على رمز الحماية. يرجى تحديث الصفحة والمحاولة مرة أخرى.'
                                                                , icon: 'error'
                                                                , confirmButtonText: 'موافق'
                                                                , customClass: {
                                                                    popup: 'text-right'
                                                                    , title: 'text-right'
                                                                    , content: 'text-right'
                                                                }
                                                            });
                                                            return;
                                                        }

                                                        // إرسال طلب حذف الحساب
                                                        fetch('/delete-account', {
                                                                method: 'POST'
                                                                , headers: {
                                                                    'Content-Type': 'application/json'
                                                                    , 'X-CSRF-TOKEN': csrfToken
                                                                }
                                                                , body: JSON.stringify({
                                                                    confirmation: 'delete'
                                                                })
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                if (data.success) {
                                                                    Swal.fire({
                                                                        title: 'تم حذف الحساب'
                                                                        , text: 'تم حذف حسابك بنجاح. سيتم تسجيل خروجك الآن.'
                                                                        , icon: 'success'
                                                                        , confirmButtonText: 'موافق'
                                                                        , customClass: {
                                                                            popup: 'text-right'
                                                                            , title: 'text-right'
                                                                            , content: 'text-right'
                                                                        }
                                                                    }).then(() => {
                                                                        // إعادة توجيه إلى صفحة تسجيل الدخول
                                                                        window.location.href = '/login';
                                                                    });
                                                                } else {
                                                                    Swal.fire({
                                                                        title: 'خطأ'
                                                                        , text: data.message || 'حدث خطأ أثناء حذف الحساب'
                                                                        , icon: 'error'
                                                                        , confirmButtonText: 'موافق'
                                                                        , customClass: {
                                                                            popup: 'text-right'
                                                                            , title: 'text-right'
                                                                            , content: 'text-right'
                                                                        }
                                                                    });
                                                                }
                                                            })
                                                            .catch(error => {
                                                                console.error('Error:', error);
                                                                Swal.fire({
                                                                    title: 'خطأ'
                                                                    , text: 'حدث خطأ غير متوقع'
                                                                    , icon: 'error'
                                                                    , confirmButtonText: 'موافق'
                                                                    , customClass: {
                                                                        popup: 'text-right'
                                                                        , title: 'text-right'
                                                                        , content: 'text-right'
                                                                    }
                                                                });
                                                            });
                                                    }
                                                });
                                            });
                                        }
                                    });

                                    // دالة للحصول على CSRF Token من مصادر مختلفة
                                    function getCSRFToken() {
                                        // محاولة الحصول على التوكن من meta tag
                                        const metaToken = document.querySelector('meta[name="csrf-token"]');
                                        if (metaToken) {
                                            return metaToken.getAttribute('content');
                                        }

                                        // محاولة الحصول على التوكن من input hidden
                                        const hiddenInput = document.querySelector('input[name="_token"]');
                                        if (hiddenInput) {
                                            return hiddenInput.value;
                                        }

                                        // محاولة الحصول على التوكن من cookie
                                        const cookies = document.cookie.split(';');
                                        for (let cookie of cookies) {
                                            const [name, value] = cookie.trim().split('=');
                                            if (name === 'XSRF-TOKEN') {
                                                return decodeURIComponent(value);
                                            }
                                        }

                                        return null;
                                    }

                                </script>



                            </div>
                        </div>

                        <!-- Most Ordered -->
                        <div class="title-bar">
                            <h5 class="title">أكمل ملفك</h5>
                        </div>
                        <div class="swiper overlay-swiper2">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="dz-card list style-4" style="
									
                                    {{ Auth::user()->contract_signed_at == null ? 'border-color: red !important;' : 'border-color: green !important;' }}
									display: flex !important;">
                                        <div class="" style="flex: 1;">
                                            <i style="
                                            {{ Auth::user()->contract_signed_at == null ? 'color: red;' : 'color: green;' }}
                                            font-size: 35px;" class="fa-solid fa-{{ Auth::user()->contract_signed_at == null ? 'circle-xmark' : 'circle-check' }}"></i>
                                        </div>

                                        <div class="dz-content" style="flex: 2;">
                                            <h6 class="title">
                                                <a href="{{ route('c1he3f.profile.agrem') }}">إتفاقية الإستخدام</a>
                                                <a href="javascript:void(0);"><i style="color:black;" class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dz-card list style-4" style="display: flex !important;
                                {{ Auth::user()->chefProfile && Auth::user()->chefProfile->contract_type !== null ? 'border-color: green !important;' : 'border-color: red !important;' }}									">
                                        <div class="" style="flex: 1;">
                                            <i style="
                {{ Auth::user()->chefProfile && Auth::user()->chefProfile->contract_type !== null ? 'color: green;' : 'color: red;' }}
                font-size: 35px;" class="fa-solid fa-{{ Auth::user()->chefProfile && Auth::user()->chefProfile->contract_type !== null ? 'circle-check' : 'circle-xmark' }}">
                                            </i>
                                        </div>

                                        <div class="dz-content" style="flex: 2;">
                                            <h6 class="title">
                                                <a href="{{ route('c1he3f.profile.agryType') }}"> نوع التعاقد</a>
                                                <a href="{{ route('c1he3f.profile.agryType') }}"><i style="color:black;" class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dz-card list style-4" style="
									{{ Auth::user()->chefProfile && Auth::user()->chefProfile->bio == null ? 'border-color: red;' : 'border-color: green;' }}
										display: flex !important;">
                                        <div class="" style="flex: 1;">
                                            <i style="
										{{ Auth::user()->chefProfile && Auth::user()->chefProfile->bio == null ? 'color: red;' : 'color: green;' }}
										font-size: 35px;" class="fa-solid fa-{{ Auth::user()->chefProfile && Auth::user()->chefProfile->bio == null ? 'circle-xmark' : 'circle-check' }}"></i>
                                        </div>

                                        <div class="dz-content" style="flex: 2;">
                                            <h6 class="title">
                                                <a href="{{ route('c1he3f.profile.bio') }}"> النبذة</a>
                                                <a href="javascript:void(0);"><i style="color:black;" class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dz-card list style-4" style="
									{{ Auth::user()->chefProfile && Auth::user()->chefProfile->profit_transfer_details == null ? 'border-color: red;' : 'border-color: green;' }}
									display: flex !important;">
                                        <div class="" style="flex: 1;">
                                            <i style="
											{{ Auth::user()->chefProfile && Auth::user()->chefProfile->profit_transfer_details == null ? 'color: red;' : 'color: green;' }}
											font-size: 35px;" class="fa-solid fa-{{ Auth::user()->chefProfile && Auth::user()->chefProfile->profit_transfer_details == null ? 'circle-xmark' : 'circle-check' }}"></i>
                                        </div>

                                        <div class="dz-content" style="flex: 2;">
                                            <h6 class="title">
                                                <a href="{{ route('c1he3f.profile.transfer') }}"> بيانات تحويل الأرباح</a>
                                                <a href="javascript:void(0);"><i style="color:black;" class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dz-card list style-4" style="{{ Auth::user()->deliveryLocations()->exists() ? 'border-color: green !important;' : 'border-color: red !important;' }} display: flex !important;">
                                        <div class="" style="flex: 1;">
                                            <i style="{{ Auth::user()->deliveryLocations()->exists() ? 'color: green;' : 'color: red;' }} font-size: 35px;" class="fa-solid fa-{{ Auth::user()->deliveryLocations()->exists() ? 'circle-check' : 'circle-xmark' }}"></i>
                                        </div>
                                        <div class="dz-content" style="flex: 2;">
                                            <h6 class="title">
                                                <a href="{{ route('c1he3f.profile.my-market') }}"> متجري</a>
                                                <a href="javascript:void(0);"><i style="color:black;" class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Main Content End -->


            <div class="menubar-area footer-fixed">
                @php
                $user = Auth::user();
                $chefProfile = $user->chefProfile; // Assuming chefProfile is loaded or not null

                $isProfileComplete = false;
                // Only check for profile completeness if the user is a chef
                if ($user && $user->role === 'طاه' && $chefProfile) {
                $isOfficialImageComplete = !empty($chefProfile->official_image);
                $isContractTypeComplete = !empty($chefProfile->contract_type);
                $isBioComplete = !empty($chefProfile->bio);
                $isContractSigned = !empty($user->contract_signed_at); // This is from the user table

                // If all conditions are true
                if ($isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned) {
                $isProfileComplete = true;
                }
                }
                @endphp

                <div class="toolbar-inner menubar-nav">
                    {{-- رابط الصفحة الرئيسية (عادةً بيكون متاح دايماً) --}}
                    <a href="{{ route('c1he3f.index') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <i class="fi fi-rr-home"></i>
                    </a>

                    {{-- رابط المعاملات - يمكن التحكم فيه --}}
                    {{-- لو عايز تقفله، ممكن تضيف شرط هنا --}}
                    <a href="{{ route('c1he3f.coming-soon') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <i class="fa fa-coins"></i>
                    </a>

                    {{-- رابط إضافة وصفة - ده اللي غالباً عايز تقفله --}}
                    {{-- هنستخدم شرط Blade @if/@else أو نعدل الـ class و الـ onclick --}}
                    @if ($isProfileComplete)
                    <a href="{{ route('c1he3f.recpies.add-recpie') }}" class="nav-link" style="color: e00000;">
                        <svg style="color: #e00000;" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="#e00000">
                            <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#e00000" />
                            <path d="M5 18H19" stroke="#e00000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @else
                    {{-- نسخة غير مفعلة من الرابط عند عدم اكتمال البروفايل --}}
                    <a href="#" class="nav-link disabled" onclick="alert('من فضلك، أكمل بيانات ملفك الشخصي أولاً.'); return false;">
                        <svg style="color: #e00000;" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="#e00000">
                            <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#e00000" />
                            <path d="M5 18H19" stroke="#e00000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @endif

                    {{-- رابط إضافة سناب - يمكن التحكم فيه --}}
                    {{-- لو عايز تقفله، ممكن تضيف شرط هنا --}}
                    <a href="{{ route('c1he3f.snaps.all-snap') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <svg fill="#e00000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#e00000" d="M48 48l88 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L32 0C14.3 0 0 14.3 0 32L0 136c0 13.3 10.7 24 24 24s24-10.7 24-24l0-88zM175.8 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-26.5 32C119.9 256 96 279.9 96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0zm368 80c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6l56.1 0zm-89.4 0c-8.6-24.3-29.9-42.6-55.9-47c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24zM464 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-80-32a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM504 48l88 0 0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-104c0-17.7-14.3-32-32-32L504 0c-13.3 0-24 10.7-24 24s10.7 24 24 24zM48 464l0-88c0-13.3-10.7-24-24-24s-24 10.7-24 24L0 480c0 17.7 14.3 32 32 32l104 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-88 0zm456 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l104 0c17.7 0 32-14.3 32-32l0-104c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 88-88 0z" />
                        </svg>
                    </a>
                </div>
            </div>
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
