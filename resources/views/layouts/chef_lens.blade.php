<!DOCTYPE html>
<html lang="en">

<head>

    <title>Chef lens</title>

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uXU3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="shortcut icon" type="image/x-icon" href="assets/images/app-logo/favicon.png">

    <link rel="manifest" href="manifest.json">

    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        .count-area {
            position: absolute;
            right: 6px;
            top: 3px;
            background: rgb(0, 0, 0);
            width: 25px;
            z-index: 999999999;
            height: 22px;
            border-radius: 50px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex !important;
        }

        .custom-icon {
            color: white !important;
            font-size: 13px !important;
            font-weight: 400;
        }

        .money-btn {
            width: 100%;
            background-color: #000000c9;
            text-align: center;
            width: 70%;
            border-top-right-radius: 15px !important;
            border-bottom-right-radius: 15px !important;
            height: 42px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
        }

        .order-now {
            background-color: #000000a8;
            text-align: center;
            width: 100%;
            text-align: center;
            width: 100%;
            height: 42px;
            margin-left: 10px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            border-top-left-radius: 15px !important;
            border-bottom-left-radius: 15px !important;
            color: white;
        }

        #menu-btn {
            background-color: #efc00454;
            text-align: center;
            width: 100%;
            text-align: center;
            border: 1px solid #EFBF04;
            width: 70%;
            border-radius: 15px;
            height: 42px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
        }

        .header-content,
        .container--btns {
            direction: rtl;
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

        button {
            border: 0px;

        }

        #name-chef {
            font-weight: 400;
            font-size: 13px;
        }

        .video-reels-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            /* لازم تبقى flex عشان السكرول الأفقي */
            overflow-x: scroll;
            overflow-y: hidden;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            /* تحسين السكرول على الموبايل */
        }

        .video-reel-item {
            flex: 0 0 100%;
            /* كل عنصر ياخد 100% من عرض الكونتينر */
            width: 100vw;
            height: 100vh;
            scroll-snap-align: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-reel {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* إزالة الـ ID المتكرر من الفيديو نفسه */
        .myVideo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content {
            position: absolute;
            bottom: 0;
            top: 0;
            /* Changed from bottom: 0; for full overlay */
            background: rgba(0, 0, 0, 0.3);
            color: #f1f1f1;
            width: 100%;
            height: 100%;
            padding: 20px;
            padding-bottom: 60px;
            z-index: 1;
            /* Ensure content is above video */
            display: flex;
            /* Added for proper alignment of buttons */
            flex-direction: column;
            /* Added for proper alignment of buttons */
            justify-content: flex-end;
            /* Pushes content to the bottom */
        }

        #myBtn {
            width: 200px;
            font-size: 18px;
            padding: 10px;
            border: none;
            background: #000;
            color: #fff;
            cursor: pointer;
        }

        #myBtn:hover {
            background: #ddd;
            color: black;
        }

        .pause-icon {
            color: white;
            justify-content: end;
            display: flex;
            font-size: 29px;
            padding-bottom: 30px;
        }

        #container--btns {
            position: relative;
            bottom: unset;
            flex-direction: column;
            width: 100%;
            display: flex;
        }

        .sidebar .navbar-nav li>a {
            color: white !important;
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

        <!-- Sidebar -->
        <div class="sidebar dz-floting-sidebar" style="color: rgb(255, 255, 255); background-color: rgb(0, 0, 0);">
            <div class="sidebar-header">
                <div class="app-logo">
                    <div class="mid-content">
                        <img src="./assets/images/logo.png" style="height: 111px; position: relative; right: 11px;" alt="">
                    </div>
                </div>
                <div class="title-bar mb-0">
                    <a href="javascript:void(0);" class="floating-close"><i class="feather icon-x"></i></a>
                </div>
            </div>
            <ul class="nav navbar-nav" style="direction: ltr;">
                <li>
                    <a class="nav-link" href="{{ route('chef_lens') }}">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 8.40002V21C3 21.2652 3.10536 21.5196 3.29289 21.7071C3.48043 21.8947 3.73478 22 4 22H20C20.2652 22 20.5196 21.8947 20.7071 21.7071C20.8946 21.5196 21 21.2652 21 21V8.40002C21.0001 8.23638 20.96 8.07523 20.8833 7.93069C20.8066 7.78616 20.6956 7.66265 20.56 7.57102L12.56 2.17102C12.3946 2.05924 12.1996 1.99951 12 1.99951C11.8004 1.99951 11.6054 2.05924 11.44 2.17102L3.44 7.57102C3.30443 7.66265 3.19342 7.78616 3.11671 7.93069C3.03999 8.07523 2.99992 8.23638 3 8.40002V8.40002ZM14 20H10V14H14V20ZM5 8.93202L12 4.20702L19 8.93202V20H16V13C16 12.7348 15.8946 12.4804 15.7071 12.2929C15.5196 12.1054 15.2652 12 15 12H9C8.73478 12 8.48043 12.1054 8.29289 12.2929C8.10536 12.4804 8 12.7348 8 13V20H5V8.93202Z" fill="black" />
                            </svg>
                        </span>
                        <span>الرئيسية</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('chef_lens.profile') }}">
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
                    <a class="nav-link" href="{{ route('chef_lens.faq') }}">
                        <span class="dz-icon">
                            <i class="fi fi-rr-comments text-dark"></i>
                        </span>
                        <span>الأسئلة الشائعة</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="about-us.html">
                        <span class="dz-icon">
                            <i class="fi fi-rr-info text-dark"></i>
                        </span>
                        <span>إعرفنا</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="contact-us.html">
                        <span class="dz-icon">
                            <i class="feather icon-message-circle"></i>
                        </span>
                        <span>تواصل معنا</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 16L21 12L17 8" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 12H21" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13 16V17C13 18.6569 11.6569 20 10 20C8.34315 20 7 18.6569 7 17V7C7 5.34315 8.34315 4 10 4C11.6569 4 13 5.34315 13 7V8" stroke="#FF8484" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span>تسجيل خروج</span>
                    </a>

                    <form id="logout-form" action="{{ route('chef_lens.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </li>
            </ul>
            <div class="sidebar-bottom" style="direction: ltr;">
                <div class="app-info">
                    <span class="ver-info">
                        V 1.0.1</span>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->
        <style>
            .modal-overlay {
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(4px);
            }

            .notification-new {
                background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
                border-right: 4px solid #3b82f6;
            }

            .star-filled {
                color: #fbbf24;
                fill: currentColor;
            }

            .star-empty {
                color: #d1d5db;
            }

            .pulse-dot::before {
                content: '';
                width: 12px;
                height: 12px;
                background: #3b82f6;
                border-radius: 50%;
                position: absolute;
                top: -2px;
                right: -2px;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    transform: scale(0.95);
                    opacity: 1;
                }

                70% {
                    transform: scale(1);
                    opacity: 0.7;
                }

                100% {
                    transform: scale(0.95);
                    opacity: 1;
                }
            }

            .gradient-bg {
                background: linear-gradient(135deg, #e63333 0%, #dc2626 100%);
            }

            .fa-bell {
                font-size: 24px;
                width: 37px;
                color: rgb(94, 94, 94);
                height: 37px;
                text-align: center;
                align-items: center;
                display: flex;
                justify-content: center;
            }

        </style>


        <div class="dz-nav-floting">

            <header class="header py-2 mx-auto" style="background-color: transparent !important; position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                    </div>
                    <div class="mid-content">
                        <img src="./assets/images/Isolation_Mode.png" style="height: 53px; position: relative; right: 11px;" alt="">
                    </div>
                    {{-- Start Notifications --}}
                    <x-notifications :notifications="$notifications" :notificationsCount="$notificationsCount" />
                    {{-- End Notifications --}}

                    <div class="right-content d-flex align-items-center gap-4" style="margin-right: 20px;">
                        <a href="javascript:void(0);" class="icon dz-floating-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <rect y="2" width="20" height="3" rx="1.5" fill="white" />
                                <rect y="18" width="20" height="3" rx="1.5" fill="white" />
                                <rect x="4" y="10" width="20" height="3" rx="1.5" fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
            </header>

            @yield('section')
            <div class="menubar-area footer-fixed" style="justify-content: center; background-color: transparent !important;">
                <div class="toolbar-inner menubar-nav" style="justify-content: center;">

                    <a href="{{ route('chef_lens') }}" class="nav-link custom-icon">
                        <i class="fi fi-rr-home" style="color: white; height: 24px;"></i>
                        الرئيسية
                    </a>

                    <a href="{{ route('saved_video') }}" class="nav-link custom-icon" style="position: relative;">
                        <span class="count-area">{{ $savedVideosCount }}</span>
                        <i class="fa-solid fa-bookmark" style="color: white; height: 24px;"></i>
                        الحفظ
                    </a>

                    <a href="{{ route('saved_video') }}" class="nav-link custom-icon" style="position: relative;">
                        <span class="count-area">{{ $likedVideosCount }}</span>
                        <i class="fa-solid fa-heart" style="color: white; height: 24px;"></i>
                        أعجبني
                    </a>

                    <a href="{{ route('chef_lens.challenge.challenges-own') }}" class="nav-link custom-icon" style="position: relative;">
                        <span class="count-area">
                            @if($acceptedChallengesCount > 99)
                            99+
                            @else
                            {{ $acceptedChallengesCount }}
                            @endif
                        </span>
                        <i class="fa-solid fa-receipt" style="color: white; height: 24px;"></i>
                        تحدياتي
                    </a>

                </div>
            </div>

        </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
