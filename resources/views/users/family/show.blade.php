<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>تعديل الملف الشخصي</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #660099;
        }

        .widget_getintuch.pb-15.profile {
            direction: rtl;
        }

        .container-profile {
            border: 2px solid black;
            border-radius: 15px;
            margin: 16px;
            background: black;
            width: 90%;
        }

        .line {
            height: 20px;
            background-color: white;
            border: 3px solid #cccccc;
            width: 100px;
            text-align: center;
            border-radius: 15px;
            margin: 0px auto 10px;
        }

        .profile-area .author-bx {
            text-align: center;
            padding: 10px 0;
        }

        .profile-area .author-bx .dz-media {
            height: 135px;
            width: 135px;
        }

        .background-fixed {
            position: absolute;
            width: 100%;
            border-radius: 15px;
            height: 100%;
            z-index: 1;
        }

        .hand {
            text-align: center;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            top: 53px;
            z-index: 99999;
            width: 108px;
        }::selection {
        background: var(--primary-color) !important;
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
        <header class="header header-fixed">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('users.family.index') }}" style="background-color: unset !important;" id="back-btn">
                        <i class="feather icon-arrow-left" style="font-weight: normal; color: #660099;"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title"> <span style="color: var(--primary-color);">{{ $myFamily->name }}</span> {{ __('messages.account_user') }}</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    @if($myFamily->owner == '0')
                    <a href="{{ route('users.family.edit', $myFamily) }}">
                        <svg enable-background="new 0 0 461.75 461.75" height="24" viewBox="0 0 461.75 461.75"
                            width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m23.099 461.612c2.479-.004 4.941-.401 7.296-1.177l113.358-37.771c3.391-1.146 6.472-3.058 9.004-5.587l226.67-226.693 75.564-75.541c9.013-9.016 9.013-23.63 0-32.645l-75.565-75.565c-9.159-8.661-23.487-8.661-32.645 0l-75.541 75.565-226.693 226.67c-2.527 2.53-4.432 5.612-5.564 9.004l-37.794 113.358c-4.029 12.097 2.511 25.171 14.609 29.2 2.354.784 4.82 1.183 7.301 1.182zm340.005-406.011 42.919 42.919-42.919 42.896-42.896-42.896zm-282.056 282.056 206.515-206.492 42.896 42.896-206.492 206.515-64.367 21.448z"
                                fill="#4A3749"></path>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </header>
        <!-- Header -->

<!-- Main Content Start -->
<main class="page-content p-b40" style="padding-top: 26px;">
    <img src="assets/images/hand.png" class="hand" alt="unkown image">

    <div class="container pt-0 container-profile" style="padding: 0px; position: relative;">
        <img src="assets/images/background.png" class="background-fixed" alt="">
        <div class="profile-area" style="position: relative; z-index: 999;">
            <div class="author-bx">
                <div class="line"></div>
                <div class="dz-media">
                    <img src="{{ $myFamily->avatar ? $myFamily->avatar : asset('assets/images/default.jpg') }}"
                        style="border-radius: 50%; border: 3px solid #660099; background-color: white !important; object-fit: contain;"
                        alt="unkown image">
                </div>
                <div class="dz-content">
                    <p style="color: white;">{{ __('messages.my_name') }}</p>
                    <h2 style="color: #ffffff;" class="name">{{ $myFamily->name }}</h2>

                    <p class="text-primary" style="background-color: #660099; color:white !important; padding: 5px;">
                        {{ __('messages.family_number') }} {{ Auth::user()?->membership_number }}
                        <br />
                        {{ __('messages.member_code') }} {{ $myFamily->id }}
                    </p>
                </div>
            </div>
            <div class="widget_getintuch pb-15 profile">
                <ul>
                    <!-- رقم العضوية -->
                    <!-- <li>
                        <div class="icon-bx">
                            <svg class="svg-primary" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"
                                    fill="#4A3749" />
                            </svg>
                        </div>
                        <div class="dz-content">
                            <p class="sub-title">{{ __('messages.membership_number') }}</p>
                            <h6 class="title">51342</h6>
                        </div>
                    </li> -->

                    <!-- الباقة الحالية -->
                    <!-- <li>
                        <div class="icon-bx">
                            <svg class="svg-primary" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21L12 17.77L5.82 21L7 14.14L2 9.27L8.91 8.26L12 2Z"
                                    fill="#4A3749" />
                            </svg>
                        </div>
                        <div class="dz-content">
                            <p class="sub-title">{{ __('messages.current_package') }}</p>
                            <h6 class="title">{{ __('messages.gold_package') }}</h6>
                        </div>
                    </li> -->

                    <!-- الخطة الحالية -->
                    <!-- <li>
                        <div class="icon-bx">
                            <svg class="svg-primary" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM10 17H8V15H10V17ZM10 13H8V11H10V13ZM10 9H8V7H10V9ZM14 17H12V15H14V17ZM14 13H12V11H14V13ZM14 9H12V7H14V9ZM18 17H16V15H18V17ZM18 13H16V11H18V13ZM18 9H16V7H18V9Z"
                                    fill="#4A3749" />
                            </svg>
                        </div>
                        <div class="dz-content">
                            <p class="sub-title">{{ __('messages.current_plan') }}</p>
                            <h6 class="title">{{ __('messages.5_months_plan') }}</h6>
                        </div>
                    </li> -->

                    <!-- تاريخ الانتهاء -->
                    <!-- <li>
                        <div class="icon-bx">
                            <svg class="svg-primary" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM10 17H8V15H10V17ZM10 13H8V11H10V13ZM10 9H8V7H10V9ZM14 17H12V15H14V17ZM14 13H12V11H14V13ZM14 9H12V7H14V9ZM18 17H16V15H18V17ZM18 13H16V11H18V13ZM18 9H16V7H18V9Z"
                                    fill="#4A3749" />
                            </svg>
                        </div>
                        <div class="dz-content">
                            <p class="sub-title">{{ __('messages.expiry_date') }}</p>
                            <h6 class="title">31/10/2025</h6>
                        </div>
                    </li> -->
                </ul>
                <!-- <a href="profileDisplayed.html" class="btn btn-primary"
                    style="width: 100% !important; margin-bottom: 20px;">{{ __('messages.upgrade_package') }}</a> -->
            </div>
        </div>
    </div>

    <ul class="tag-list" style="display: flex; gap: 10px; justify-content: space-evenly;">
        <a href="{{ $myFamily->owner == '0' ? route('users.family.has_email', $myFamily) : '#' }}">
            <li class="dz-price"
                style="border: 1px solid var(--primary-color); padding: 5px; border-radius: 5px; display: flex; align-items: center; flex-direction: column; text-align: center; font-size: 14px;">
                <i class="fa-solid fa-user" style="color: var(--primary-color); font-size: 21px;"></i>
                {{ __('messages.account') }}
                <br />
                {{ $myFamily->has_email == '1' ? __('messages.yes') : __('messages.no') }}
            </li>
        </a>

        <a href="{{ route('users.family.language', $myFamily) }}">
            <li class="dz-price"
                style="border: 1px solid var(--primary-color); padding: 5px; border-radius: 5px; display: flex; align-items: center; flex-direction: column; text-align: center; font-size: 14px;">
                <i class="fa-solid fa-earth" style="color: var(--primary-color); font-size: 21px;"></i>
                {{ __('messages.language') }}
                <br />
                {{ __('messages.' . $myFamily->language) }}
            </li>
        </a>

        <a href="{{ route('users.family.tips', $myFamily) }}">
            <li class="dz-price"
                style="border: 1px solid var(--primary-color); padding: 5px; border-radius: 5px; display: flex; align-items: center; flex-direction: column; text-align: center; font-size: 14px;">
                <i class="fa-solid fa-list-check" style="color: var(--primary-color); font-size: 21px;"></i>
                {{ __('messages.tips') }}
                <br />
                {{ $countTips }}
            </li>
        </a>

        <a href="{{ $myFamily->owner == '0' ? route('users.family.send_notification', $myFamily) : '#' }}">
            <li class="dz-price"
                style="border: 1px solid var(--primary-color); padding: 5px; border-radius: 5px; display: flex; align-items: center; flex-direction: column; text-align: center; font-size: 14px;">
                <i class="fa-solid fa-bell" style="color: var(--primary-color); font-size: 21px;"></i>
                {{ __('messages.notifications') }}
                <br />
                {{ $myFamily?->send_notification == '1' ? __('messages.yes') : __('messages.no') }}
            </li>
        </a>
    </ul>
</main>
<!-- Main Content End -->    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>