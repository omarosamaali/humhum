<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <!-- Title -->
    <title>واجهة الطاهي</title>

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
        .plus-btn {
            position: fixed;
            bottom: 30px;
            text-align: center;
            left: 20px;
            z-index: 99999;
            background-color: black;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 37px;
        }

        .challenge-link {
            color: white;
            text-decoration: none;
        }

        .swiper-slide {
            position: relative;
        }

        .dz-categories-bx {
            padding: 0px !important;
            height: 79px;
            margin-top: 40px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .before-challenge {
            width: 50%;
            height: 100%;
            padding: 10px 20px;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            background-color: #a50707;
            color: white;
        }

        .before-challenge p {
            margin-bottom: 0px;
        }

        .before-challenge h3 {
            z-index: 9;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 9px;
            position: relative;
            font-size: 15px;
            color: rgb(255, 255, 255);
            font-weight: normal;
            margin: 0;
        }

        .before-challenge h3 span {
            font-size: 28px;
        }

        .vs-icon-container {
            left: 50%;
            transform: translate(-50%, 3%);
            position: absolute;
            top: -10px;
            z-index: 9;
        }

        .vs-icon {
            width: 78px;
            height: 98px;
        }

        .challenge-title {
            width: 50%;
            padding: 8.5px 20px;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            background-color: black;
            color: white;
        }

        .challenge-title-text {
            align-items: center;
            justify-content: center;
            display: flex;
        }

        .challenge-title p {
            text-align: center;
            margin-bottom: 0px;
        }

        .challenge-timer {
            font-size: 15px;
            color: rgb(255, 255, 255);
            font-weight: bold;
        }

        .challenge-users {
            align-items: center;
            justify-content: center;
            display: flex;
            font-size: 12px;
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
                    <a class="nav-link active" href="{{ route('c1he3f.index') }}">
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
        <div class="dz-nav-floting">
            <header class="header py-2 mx-auto" style="position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                        <div class="info">
                            <p class="text m-b10">مرحبا بك.. الشيف</p>
                            <h5 class="title">{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                    <div class="mid-content"></div>
                    <div class="right-content d-flex align-items-center gap-4">
                        {{-- Start Notifications --}}
                        <x-notifications :notifications="$notifications" :notificationsCount="$notificationsCount" />
                        {{-- End Notifications --}}
                        @if($delivery_locations->isNotEmpty() && $delivery_locations->contains('has_market', 1))


                        <a href="{{ route('c1he3f.my-products') }}" class="notification-badge font-20">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 451 458" fill="none">
                                <rect width="451" height="458" fill="url(#pattern0_7518_7)" />
                                <defs>
                                    <pattern id="pattern0_7518_7" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_7518_7" transform="scale(0.00221729 0.00218341)" />
                                    </pattern>
                                    <image id="image0_7518_7" width="451" height="458" preserveAspectRatio="none" xlink:href="data:image/png;base64,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" />
                                </defs>
                            </svg>
                        </a>
                        @endif

                        @php
                        $user = Auth::user();
                        $chefProfile = $user->chefProfile;
                        $isProfileComplete = false;
                        if ($user && $user->role === 'طاه' && $chefProfile) {
                        $isOfficialImageComplete = !empty($chefProfile->official_image);
                        $isContractTypeComplete = !empty($chefProfile->contract_type);
                        $isBioComplete = !empty($chefProfile->bio);
                        $isContractSigned = !empty($user->contract_signed_at);
                        if ($isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned) {
                        $isProfileComplete = true;
                        }
                        }
                        @endphp
                        @if(!$isProfileComplete)
                        <button onclick="openModal();" style="width: 29px; height: 29px;">
                            <img src="{{ asset('assets/images/hat.png') }}" alt="">
                        </button>
                        @else
                        <a href="{{ route('challenge.vs') }}" style="width: 29px; height: 29px;">
                            <img src="{{ asset('assets/images/hat.png') }}" alt="">
                        </a>
                        @endif
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

            <script>
                function openModal() {
                    Swal.fire({
                        title: "نأسف!"
                        , text: " قم باستكمال بياناتك الشخصية أولا!"
                        , confirmButtonText: "حسناً"
                        , icon: "warning"
                    , });
                }

            </script>
            <main class="page-content bg-white p-b60" style="margin-top: 100px;">
                <div class="container">
                    <div class="search-box">
                        @if ($banner)
                        <img style="width: 100%; height: 300px; border-radius: 15px;" src="{{ asset('storage/' . $banner->image) }}" alt="">
                        @else
                        <img style="width: 100%;" src="{{ asset('path/to/default-image.jpg') }}" alt="Default Banner">
                        @endif
                    </div>
                    @if($activeChallenge)
                    <a href="{{ route('challenge.vs2', ['type' => 'vs']) }}" class="challenge-link">
                        <div class="swiper-slide">
                            <div class="dz-categories-bx">
                                <div class="before-challenge">
                                    <p>
                                        <h3>
                                            قبل التحدي
                                            @if ($activeChallenge)
                                            <span>&nbsp;{{ $activeChallenge?->responses->count() ?? 0 }}</span>
                                            @else
                                            <span>&nbsp;0</span>
                                            @endif
                                        </h3>
                                    </p>
                                </div>
                                <div>
                                    <div class="vs-icon-container">
                                        <img src="{{ asset('assets/images/vs-icon.png') }}" class="vs-icon" alt="">
                                    </div>
                                </div>
                                <div class="challenge-title">
                                    <span class="challenge-title-text">
                                        {{ $activeChallenge?->message }}
                                    </span>
                                    <p>
                                        <sub class="challenge-timer" @if ($activeChallenge) data-end-date="{{ $activeChallenge->end_date }}" data-end-time="{{ $activeChallenge->end_time }}" @endif>
                                            -- : -- : -- : --
                                        </sub>
                                    </p>
                                    <span class="challenge-users">
                                        @if ($activeChallenge)
                                        {{ $activeChallenge?->challenge_type == 'users' ? 'للمستخدمين' : 'للطهاة' }}
                                        @else
                                        --
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const challengeTimerElement = document.querySelector('.challenge-timer');
                            if (challengeTimerElement && challengeTimerElement.dataset.endDate && challengeTimerElement.dataset.endTime) {
                                const endDateStr = challengeTimerElement.dataset.endDate;
                                const endTimeStr = challengeTimerElement.dataset.endTime;
                                const endDateTimeCombined = `${endDateStr} ${endTimeStr}`;
                                const endDate = new Date(endDateTimeCombined).getTime();

                                function updateCountdownDisplay() {
                                    const now = new Date().getTime();
                                    const distance = endDate - now;
                                    if (distance < 0) {
                                        challengeTimerElement.textContent = 'انتهى التحدي';
                                        clearInterval(countdownInterval); // Stop the interval
                                        return;
                                    }
                                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    challengeTimerElement.textContent =
                                        `${String(days).padStart(2, '0')} : ${String(hours).padStart(2, '0')} : ${String(minutes).padStart(2, '0')} : ${String(seconds).padStart(2, '0')}`;
                                }
                                updateCountdownDisplay();
                                const countdownInterval = setInterval(updateCountdownDisplay, 1000);
                            } else {
                                if (challengeTimerElement) {
                                    challengeTimerElement.textContent = 'لا يوجد تحدي حالي';
                                }
                            }
                        });

                    </script>
                    <div class="title-bar mb-0">
                        <h5 class="title">التصنيفات</h5>
                    </div>
                    @php
                    $user = Auth::user();
                    $chefProfile = $user->chefProfile;
                    $isProfileComplete = false;
                    if ($user && $user->role === 'طاه' && $chefProfile) {
                    $isOfficialImageComplete = !empty($chefProfile->official_image);
                    $isContractTypeComplete = !empty($chefProfile->contract_type);
                    $isBioComplete = !empty($chefProfile->bio);
                    $isContractSigned = !empty($user->contract_signed_at);
                    if ($isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned) {
                    $isProfileComplete = true;
                    }
                    }
                    @endphp
                    <div class="swiper categories-swiper dz-swiper m-b20">
                        <div class="swiper-wrapper">
                            @foreach ($mainCategories as $mainCategorie)
                            <div class="swiper-slide">
                                <a id="videoLink" href="{{ $isProfileComplete ? route('c1he3f.category.show', $mainCategorie->id) : '#' }}" class="{{ !$isProfileComplete ? 'disabled-link' : '' }}" {{ !$isProfileComplete ? 'onclick="alert(\'من فضلك، أكمل بيانات ملفك الشخصي أولاً.\'); return false;"' : '' }}>
                                    <div class="dz-categories-bx" style="padding: 15px !important;">
                                        <div class="icon-bx">
                                            <img src="{{ asset('storage/' . $mainCategorie->image) }}" style="border-radius: 50%; width: 50px; height: 50px;" alt="">
                                        </div>
                                        <div class="dz-content">
                                            <h6 class="title">
                                                {{ $mainCategorie->name_ar }}
                                            </h6>
                                            <span class="وصفة text-primary">{{ $mainCategorie->recipes_count }}
                                                وصفة</span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="title-bar">
                        <h5 class="title" style="margin-right: 0px !important;">اخر إستخدمات وصفات</h5>
                        <a id="favoritesLink" href="{{ route('c1he3f.coming-soon') }}">الجميع</a>
                    </div>
                </div>
            </main>
            <div class="menubar-area footer-fixed">
                @php
                $user = Auth::user();
                $chefProfile = $user->chefProfile;
                $isProfileComplete = false;
                if ($user && $user->role === 'طاه' && $chefProfile) {
                $isOfficialImageComplete = !empty($chefProfile->official_image);
                $isContractTypeComplete = !empty($chefProfile->contract_type);
                $isBioComplete = !empty($chefProfile->bio);
                $isContractSigned = !empty($user->contract_signed_at);
                if ($isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned) {
                $isProfileComplete = true;
                }
                }
                @endphp
                <div class="toolbar-inner menubar-nav">
                    <a href="{{ route('c1he3f.index') }}" class="nav-link 
                    {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <i class="fi fi-rr-home"></i>
                    </a>
                    <a href="{{ route('c1he3f.coming-soon') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <i class="fa fa-coins"></i>
                    </a>
                    @if ($isProfileComplete)
                    <a href="{{ route('c1he3f.recpies.add-recpie') }}" class="nav-link" style="color: e00000;">
                        <svg style="color: #e00000;" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="#e00000">
                            <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#e00000" />
                            <path d="M5 18H19" stroke="#e00000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @else
                    <a href="#" class="nav-link disabled" onclick="alert('من فضلك، أكمل بيانات ملفك الشخصي أولاً.'); return false;">
                        <svg style="color: #e00000;" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="#e00000">
                            <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#e00000" />
                            <path d="M5 18H19" stroke="#e00000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @endif
                    <a href="{{ route('c1he3f.snaps.all-snap') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <svg fill="#e00000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#e00000" d="M48 48l88 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L32 0C14.3 0 0 14.3 0 32L0 136c0 13.3 10.7 24 24 24s24-10.7 24-24l0-88zM175.8 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-26.5 32C119.9 256 96 279.9 96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0zm368 80c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6l56.1 0zm-89.4 0c-8.6-24.3-29.9-42.6-55.9-47c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24zM464 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-80-32a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM504 48l88 0 0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-104c0-17.7-14.3-32-32-32L504 0c-13.3 0-24 10.7-24 24s10.7 24 24 24zM48 464l0-88c0-13.3-10.7-24-24-24s-24 10.7-24 24L0 480c0 17.7 14.3 32 32 32l104 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-88 0zm456 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l104 0c17.7 0 32-14.3 32-32l0-104c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 88-88 0z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allSnapLink = document.getElementById('allSnapLink');
            const videoLink = document.getElementById('videoLink');
            const favoritesLink = document.getElementById('favoritesLink');
            const faqLink = document.getElementById('faqLink');
            const aboutUsLink = document.getElementById('aboutUsLink'); // جديد
            const contactUsLink = document.getElementById('contactUsLink'); // جديد
            const userStatus = "{{ Auth::user()->status }}";

            function applyStatusCheck(linkElement) {
                if (linkElement) {
                    linkElement.addEventListener('click', function(event) {
                        if (userStatus === 'بانتظار التفعيل') {
                            event.preventDefault();
                            Swal.fire({
                                icon: 'warning'
                                , title: 'الملف الشخصي غير مكتمل!'
                                , text: 'برجاء إكمال جميع اشتراطات الملف الشخصي لتفعيل حسابك.'
                                , confirmButtonText: 'حسناً'
                                , customClass: {
                                    confirmButton: 'my-swal-button-class'
                                }
                            });
                        }
                    });
                }
            }
            applyStatusCheck(allSnapLink);
            applyStatusCheck(videoLink);
            applyStatusCheck(favoritesLink);
            applyStatusCheck(faqLink); // تطبيق على رابط الأسئلة الشائعة
            applyStatusCheck(aboutUsLink); // تطبيق على رابط إعرفنا
            applyStatusCheck(contactUsLink); // تطبيق على رابط تواصل معنا
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
