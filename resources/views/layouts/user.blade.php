<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Global CSS -->
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
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
            --primary-color: #660099 !important;
        }

        #carts-chef {
            border: 0;
            box-shadow: none;
            background: transparent;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0px;
        }

        #name-chef {
            font-weight: 400;
            font-size: 13px;
        }

        select.form-select,
        .show-pass i,
        select.form-select,
        .form-text .link,
        .text-primary,
        .title-bar>a,
        .sidebar .navbar-nav li>a.active,
        .dz-mode .theme-btn i,
        .menubar-area .menubar-nav .nav-link i,
        .dz-card.list .dz-buy-btn {
            color: var(--primary-color) !important;
        }

        .dz-mode .theme-btn i.sun,
        .dz-mode .theme-btn.active i,
        .menubar-area .menubar-nav .nav-link.active i {
            color: white !important;
        }

        .sidebar .navbar-nav li>a.active .dz-icon svg path,
        .dz-categories-bx .icon-bx path[fill],
        .dz-categories-bx .icon-bx path {
            fill: var(--primary-color) !important;
        }

        .img-fluid {
            padding: 3px;
            display: flex;
            text-align: center;
            border: 2px solid var(--primary-color);
            border-radius: 50%;
            margin: auto;
            width: 50px;
            height: 50px;
            display: flex;
            text-align: center;
        }

        .dz-mode .theme-btn::after,
        .menubar-area .menubar-nav .nav-link:after {
            background: var(--primary-color) !important;
        }

        .language-icon {
            width: 23px;
            height: auto;
            top: -1px;
            position: relative;
        }

        .container-cart {
            box-shadow: 0px 0px 3px 3px #ededed;
            border-radius: 20px;
            background: #fafafa;
        }

        .container-cart img {
            border-radius: 0px 20px 20px 0px !important;
        }

        #overlay {
            position: absolute;
            top: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            width: 100%;
            height: 100%;
            border-radius: 0px 20px 20px 0px;
        }

        .bookmark {
            position: absolute;
            bottom: 10px;
            text-align: center;
            align-items: center;
            justify-content: end;
            display: flex;
            margin: auto;
            left: 17px;
            width: 100%;
        }

        .heart-switch {
            --duration: 0.45s;
            --stroke: #d1d6ee;
            --fill: #fff;
            --fill-active: #660099;
            --shadow: #{rgba(#00093d, 0.25)

        }

        ;
        cursor: pointer;
        position: relative;
        transform: scale(var(--s, 1)) translateZ(0);
        transition: transform 0.2s;
        -webkit-tap-highlight-color: transparent;

        &:active {
            --s: 0.95;
        }

        input {
            -webkit-appearance: none;
            -moz-appearance: none;
            position: absolute;
            outline: none;
            border: none;
            pointer-events: none;
            z-index: 1;
            margin: 0;
            padding: 0;
            left: 1px;
            top: 1px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 1px 3px 0 var(--shadow);

            &+svg {
                width: 36px;
                height: 25px;
                fill: var(--fill);
                stroke: #660099;
                stroke-width: 1px;
                stroke-linejoin: round;
                display: block;
                transition: stroke var(--duration), fill var(--duration);
            }

            &:not(:checked) {
                animation: uncheck var(--duration) linear forwards;
            }

            &:checked {
                animation: check var(--duration) linear forwards;

                &+svg {
                    --fill: var(--fill-active);
                    --stroke: #660099;
                }
            }
        }
        }

        @keyframes uncheck {
            0% {
                transform: rotate(-30deg) translateX(13.5px) translateY(8px);
            }

            50% {
                transform: rotate(30deg) translateX(9px);
            }

            75% {
                transform: rotate(30deg) translateX(4.5px) scaleX(1.1);
            }

            100% {
                transform: rotate(30deg);
            }
        }

        @keyframes check {
            0% {
                transform: rotate(30deg);
            }

            25% {
                transform: rotate(30deg) translateX(4.5px) scaleX(1.1);
            }

            50% {
                transform: rotate(30deg) translateX(9px);
            }

            100% {
                transform: rotate(-30deg) translateX(13.5px) translateY(8px);
            }
        }

        .chef-logo {
            position: absolute;
            left: 36%;
            top: -20px;
            width: 36px;
        }

        .icon {
            text-align: center;
            align-items: center;
            display: flex;
            justify-content: center;
            font-size: 30px;
            color: var(--primary-color);
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
                    <img class="logo-dark" src="assets/images/user-logo/logo.png" alt="logo">
                    <img class="logo-white d-none" src="assets/images/user-logo/logo-white.png" alt="logo">
                </div>
                <div class="title-bar mb-0">
                    <h4 class="title font-w600" style="visibility: collapse;">Main وصفة</h4>
                    <a href="javascript:void(0);" class="floating-close"><i class="feather icon-x"></i></a>
                </div>
            </div>
            <ul class="nav navbar-nav" style="padding-bottom: 0px; direction: ltr;">
                <li>
                    <a class="nav-link active" href="index.html">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 8.40002V21C3 21.2652 3.10536 21.5196 3.29289 21.7071C3.48043 21.8947 3.73478 22 4 22H20C20.2652 22 20.5196 21.8947 20.7071 21.7071C20.8946 21.5196 21 21.2652 21 21V8.40002C21.0001 8.23638 20.96 8.07523 20.8833 7.93069C20.8066 7.78616 20.6956 7.66265 20.56 7.57102L12.56 2.17102C12.3946 2.05924 12.1996 1.99951 12 1.99951C11.8004 1.99951 11.6054 2.05924 11.44 2.17102L3.44 7.57102C3.30443 7.66265 3.19342 7.78616 3.11671 7.93069C3.03999 8.07523 2.99992 8.23638 3 8.40002V8.40002ZM14 20H10V14H14V20ZM5 8.93202L12 4.20702L19 8.93202V20H16V13C16 12.7348 15.8946 12.4804 15.7071 12.2929C15.5196 12.1054 15.2652 12 15 12H9C8.73478 12 8.48043 12.1054 8.29289 12.2929C8.10536 12.4804 8 12.7348 8 13V20H5V8.93202Z"
                                    fill="#660099" />
                            </svg>
                        </span>
                        <span>الرئيسية</span>
                    </a>
                </li>
                <li>
                    @auth
                    <a class="nav-link" href="#">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_329_300)">
                                    <path
                                        d="M15.7 11.7171C16.6839 10.9477 17.4031 9.89048 17.7575 8.69283C18.1118 7.49518 18.0836 6.21681 17.6767 5.03597C17.2698 3.85513 16.5046 2.8307 15.4877 2.10553C14.4708 1.38036 13.253 0.990601 12.004 0.990601C10.755 0.990601 9.53719 1.38036 8.52031 2.10553C7.50342 2.8307 6.73819 3.85513 6.33131 5.03597C5.92443 6.21681 5.89619 7.49518 6.25053 8.69283C6.60487 9.89048 7.32413 10.9477 8.308 11.7171C6.44917 12.4567 4.85467 13.7364 3.73027 15.3911C2.60587 17.0458 2.00318 18.9995 2 21.0001V22.0001C2 22.2653 2.10536 22.5196 2.29289 22.7072C2.48043 22.8947 2.73478 23.0001 3 23.0001H21C21.2652 23.0001 21.5196 22.8947 21.7071 22.7072C21.8946 22.5196 22 22.2653 22 22.0001V21.0001C21.9975 19.0004 21.3959 17.0474 20.273 15.3928C19.1501 13.7382 17.5573 12.4579 15.7 11.7171V11.7171ZM8 7.00007C8 6.20895 8.2346 5.43559 8.67412 4.77779C9.11365 4.12 9.73836 3.60731 10.4693 3.30456C11.2002 3.00181 12.0044 2.92259 12.7804 3.07693C13.5563 3.23128 14.269 3.61224 14.8284 4.17165C15.3878 4.73106 15.7688 5.44379 15.9231 6.21971C16.0775 6.99564 15.9983 7.7999 15.6955 8.53081C15.3928 9.26171 14.8801 9.88642 14.2223 10.3259C13.5645 10.7655 12.7911 11.0001 12 11.0001C10.9391 11.0001 9.92172 10.5786 9.17157 9.8285C8.42143 9.07835 8 8.06094 8 7.00007ZM4 21.0001C4 18.8783 4.84285 16.8435 6.34315 15.3432C7.84344 13.8429 9.87827 13.0001 12 13.0001C14.1217 13.0001 16.1566 13.8429 17.6569 15.3432C19.1571 16.8435 20 18.8783 20 21.0001H4Z"
                                        fill="#B0ACB3" />
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
                    @else
                    <a class="nav-link" href="{{ route('users.auth.login') }}">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_329_300)">
                                    <path
                                        d="M15.7 11.7171C16.6839 10.9477 17.4031 9.89048 17.7575 8.69283C18.1118 7.49518 18.0836 6.21681 17.6767 5.03597C17.2698 3.85513 16.5046 2.8307 15.4877 2.10553C14.4708 1.38036 13.253 0.990601 12.004 0.990601C10.755 0.990601 9.53719 1.38036 8.52031 2.10553C7.50342 2.8307 6.73819 3.85513 6.33131 5.03597C5.92443 6.21681 5.89619 7.49518 6.25053 8.69283C6.60487 9.89048 7.32413 10.9477 8.308 11.7171C6.44917 12.4567 4.85467 13.7364 3.73027 15.3911C2.60587 17.0458 2.00318 18.9995 2 21.0001V22.0001C2 22.2653 2.10536 22.5196 2.29289 22.7072C2.48043 22.8947 2.73478 23.0001 3 23.0001H21C21.2652 23.0001 21.5196 22.8947 21.7071 22.7072C21.8946 22.5196 22 22.2653 22 22.0001V21.0001C21.9975 19.0004 21.3959 17.0474 20.273 15.3928C19.1501 13.7382 17.5573 12.4579 15.7 11.7171V11.7171ZM8 7.00007C8 6.20895 8.2346 5.43559 8.67412 4.77779C9.11365 4.12 9.73836 3.60731 10.4693 3.30456C11.2002 3.00181 12.0044 2.92259 12.7804 3.07693C13.5563 3.23128 14.269 3.61224 14.8284 4.17165C15.3878 4.73106 15.7688 5.44379 15.9231 6.21971C16.0775 6.99564 15.9983 7.7999 15.6955 8.53081C15.3928 9.26171 14.8801 9.88642 14.2223 10.3259C13.5645 10.7655 12.7911 11.0001 12 11.0001C10.9391 11.0001 9.92172 10.5786 9.17157 9.8285C8.42143 9.07835 8 8.06094 8 7.00007ZM4 21.0001C4 18.8783 4.84285 16.8435 6.34315 15.3432C7.84344 13.8429 9.87827 13.0001 12 13.0001C14.1217 13.0001 16.1566 13.8429 17.6569 15.3432C19.1571 16.8435 20 18.8783 20 21.0001H4Z"
                                        fill="#B0ACB3" />
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
                    @endauth
                </li>
                <li>
                    <a class="nav-link" href="faq.html">
                        <span class="dz-icon">
                            <i class="fi fi-rr-comments text-dark"></i>
                        </span>
                        <span>الأسئلة الشائعة</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="#">
                        <span class="dz-icon">
                            <i class="fi fi-rr-info text-dark"></i>
                        </span>
                        <span>إعرفنا</span>
                    </a>
                </li>

                <li>
                    @auth
                    <a class="nav-link" href="contact-us.html">
                        <span class="dz-icon">
                            <i class="feather icon-message-circle"></i>
                        </span>
                        <span>تواصل معنا</span>
                    </a>
                    @else
                    <a class="nav-link" href="{{ route('users.auth.login') }}">
                        <span class="dz-icon">
                            <i class="feather icon-message-circle"></i>
                        </span>
                        <span>تواصل معنا</span>
                    </a>
                    @endauth
                </li>

                <li>
                    <a class="nav-link" href="#">
                        <span class="dz-icon">
                            <i class="fi fi-rr-info text-dark"></i>
                        </span>
                        <span>سياسة الخصوصية</span>
                    </a>
                </li>

                <li>
                    @auth
                    <form action="{{ route('users.auth.logout') }}" method="POST">
                        @csrf
                        <a class="nav-link">
                            <button
                                style="display: flex; border: 0px; background-color: unset; font-size: 16px; color: #666666;"
                                type="submit">
                                <span class="dz-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.65 3.10008C16.5318 3.04157 16.4033 3.00692 16.2717 2.9981C16.1401 2.98928 16.0081 3.00646 15.8831 3.04866C15.7582 3.09087 15.6428 3.15727 15.5435 3.24407C15.4442 3.33088 15.363 3.43639 15.3045 3.55458C15.246 3.67277 15.2114 3.80132 15.2025 3.9329C15.1937 4.06448 15.2109 4.19652 15.2531 4.32146C15.2953 4.4464 15.3617 4.5618 15.4485 4.66108C15.5353 4.76036 15.6408 4.84157 15.759 4.90008C17.4682 5.74788 18.8405 7.14857 19.6532 8.87467C20.4659 10.6008 20.6712 12.5509 20.2358 14.4084C19.8004 16.2659 18.7499 17.9217 17.2548 19.1069C15.7597 20.292 13.9079 20.937 12 20.937C10.0922 20.937 8.24035 20.292 6.74526 19.1069C5.25018 17.9217 4.19964 16.2659 3.76424 14.4084C3.32885 12.5509 3.53417 10.6008 4.34687 8.87467C5.15956 7.14857 6.5319 5.74788 8.24102 4.90008C8.47972 4.78192 8.6617 4.57379 8.74694 4.32146C8.83217 4.06913 8.81368 3.79327 8.69553 3.55458C8.57737 3.31588 8.36924 3.1339 8.11691 3.04866C7.86458 2.96343 7.58872 2.98192 7.35002 3.10008C5.23724 4.14875 3.54096 5.88079 2.5366 8.01498C1.53223 10.1492 1.27875 12.5602 1.81731 14.8566C2.35587 17.153 3.65485 19.2 5.50334 20.6651C7.35184 22.1302 9.64131 22.9275 12 22.9275C14.3587 22.9275 16.6482 22.1302 18.4967 20.6651C20.3452 19.2 21.6442 17.153 22.1827 14.8566C22.7213 12.5602 22.4678 10.1492 21.4635 8.01498C20.4591 5.88079 18.7628 4.14875 16.65 3.10008V3.10008Z"
                                            fill="#FF8484" />
                                        <path
                                            d="M12 13.0001C12.2652 13.0001 12.5196 12.8948 12.7071 12.7072C12.8947 12.5197 13 12.2654 13 12.0001V2.00012C13 1.73491 12.8947 1.48055 12.7071 1.29302C12.5196 1.10548 12.2652 1.00012 12 1.00012C11.7348 1.00012 11.4804 1.10548 11.2929 1.29302C11.1054 1.48055 11 1.73491 11 2.00012V12.0001C11 12.2654 11.1054 12.5197 11.2929 12.7072C11.4804 12.8948 11.7348 13.0001 12 13.0001Z"
                                            fill="#FF8484" />
                                    </svg>
                                </span>
                                <span>تسجيل خروج</span>
                            </button>
                        </a>
                    </form>
                </li>
                @else
                <a class="nav-link" href="{{ route('users.auth.login') }}">
                    <span class="dz-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.65 3.10008C16.5318 3.04157 16.4033 3.00692 16.2717 2.9981C16.1401 2.98928 16.0081 3.00646 15.8831 3.04866C15.7582 3.09087 15.6428 3.15727 15.5435 3.24407C15.4442 3.33088 15.363 3.43639 15.3045 3.55458C15.246 3.67277 15.2114 3.80132 15.2025 3.9329C15.1937 4.06448 15.2109 4.19652 15.2531 4.32146C15.2953 4.4464 15.3617 4.5618 15.4485 4.66108C15.5353 4.76036 15.6408 4.84157 15.759 4.90008C17.4682 5.74788 18.8405 7.14857 19.6532 8.87467C20.4659 10.6008 20.6712 12.5509 20.2358 14.4084C19.8004 16.2659 18.7499 17.9217 17.2548 19.1069C15.7597 20.292 13.9079 20.937 12 20.937C10.0922 20.937 8.24035 20.292 6.74526 19.1069C5.25018 17.9217 4.19964 16.2659 3.76424 14.4084C3.32885 12.5509 3.53417 10.6008 4.34687 8.87467C5.15956 7.14857 6.5319 5.74788 8.24102 4.90008C8.47972 4.78192 8.6617 4.57379 8.74694 4.32146C8.83217 4.06913 8.81368 3.79327 8.69553 3.55458C8.57737 3.31588 8.36924 3.1339 8.11691 3.04866C7.86458 2.96343 7.58872 2.98192 7.35002 3.10008C5.23724 4.14875 3.54096 5.88079 2.5366 8.01498C1.53223 10.1492 1.27875 12.5602 1.81731 14.8566C2.35587 17.153 3.65485 19.2 5.50334 20.6651C7.35184 22.1302 9.64131 22.9275 12 22.9275C14.3587 22.9275 16.6482 22.1302 18.4967 20.6651C20.3452 19.2 21.6442 17.153 22.1827 14.8566C22.7213 12.5602 22.4678 10.1492 21.4635 8.01498C20.4591 5.88079 18.7628 4.14875 16.65 3.10008V3.10008Z"
                                fill="#FF8484" />
                            <path
                                d="M12 13.0001C12.2652 13.0001 12.5196 12.8948 12.7071 12.7072C12.8947 12.5197 13 12.2654 13 12.0001V2.00012C13 1.73491 12.8947 1.48055 12.7071 1.29302C12.5196 1.10548 12.2652 1.00012 12 1.00012C11.7348 1.00012 11.4804 1.10548 11.2929 1.29302C11.1054 1.48055 11 1.73491 11 2.00012V12.0001C11 12.2654 11.1054 12.5197 11.2929 12.7072C11.4804 12.8948 11.7348 13.0001 12 13.0001Z"
                                fill="#FF8484" />
                        </svg>
                    </span>
                    <span>تسجيل دخول</span>
                </a>
                @endauth
            </ul>
            
            <style>
                .theme-btn {
                    position: relative;
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    background: #1e293b;
                    border-radius: 30px;
                    padding: 6px 10px;
                    width: 120px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .language-icon {
                    width: 37px;
                    height: 33px;
                    padding: 5px;
                    z-index: 2;
                    transition: transform 0.3s ease;
                }

                .theme-btn::after {
                    content: "";
                    position: absolute;
                    top: 3px;
                    left: 3px;
                    width: 50%;
                    height: calc(100% - 6px);
                    background: #2563eb;
                    border-radius: 30px;
                    transition: left 0.3s ease;
                    z-index: 1;
                }

                .theme-btn.en-active::after {
                    left: calc(50% - 3px);
                }
            </style>
            <div class="sidebar-bottom" style="direction: ltr;">
<div class="dz-mode" style="margin-top: 10px;">
    <div>
        <p style="margin-bottom: 5px;">اختر اللغة</p>
        <div class="theme-btn" id="languageSwitcher">
            <!-- امسح onclick من هنا -->
            <img src="./assets/images/ar-man-white.png" alt="AR" class="language-icon active" data-lang="ar">
            <img src="./assets/images/en-man.png" alt="EN" class="language-icon" data-lang="en">
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const switcher = document.getElementById('languageSwitcher');
    const icons = switcher.querySelectorAll('.language-icon');

    icons.forEach(icon => {
        icon.addEventListener('click', () => {
            const lang = icon.dataset.lang;

            // إزالة active من الجميع
            icons.forEach(i => i.classList.remove('active'));

            // أضف active للعنصر المضغوط
            icon.classList.add('active');

            // غيّر الصور
            icons.forEach(i => {
                const base = i.src.split('/').pop().replace('-white.png', '.png');
                if (i.classList.contains('active')) {
                    i.src = `./assets/images/${base.replace('.png', '-white.png')}`;
                } else {
                    i.src = `./assets/images/${base.replace('-white.png', '.png')}`;
                }
            });

            // غيّر شكل المؤشر
            if (lang === 'ar') {
                switcher.classList.remove('en-active');
            } else {
                switcher.classList.add('en-active');
            }

            // أرسل للباك إند
            fetch("{{ route('set.language') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ locale: lang })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(err => console.error('Error:', err));
        });
    });
});
</script>
                <div class="app-info">
                    <span class="ver-info" style="background: white; border-radius: 6px; padding: 4px;">
                        <img style="width: 220px; position: relative; top: 3px;"
                            src="assets/images/user-logo/footer.png" alt="">
                    </span>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->

        <!-- Nav Floting Start -->
        <div class="dz-nav-floting">
            <!-- Header -->
            <header class="header py-2 mx-auto"
                style="position: fixed; width: 100%; border-bottom: 1px solid #ccc; max-height: 60px; min-height: 60px;">
                <div class="header-content" style="top: -11px; position: relative;">
                    <div class="left-content">
                        <div class="info">
                            <p class="text m-b10">مرحبا بك..
                                @auth
                                <span
                                    style="font-size: 15px !important; text-transform: capitalize; color: var(--primary-color); font-weight: bold;">
                                    {{ Auth::user()->name }}
                                </span>
                                @endauth
                            </p>
                        </div>
                    </div>

                    <div class="mid-content">
                    </div>

                    <div class="right-content d-flex align-items-center gap-4">
                        <a href="javascript:void(0);" class="icon dz-floating-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
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
            <main class="page-content bg-white p-b60" style="margin-top: 97px;">
                @yield('content')
            </main>
            <!-- Main Content End -->

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