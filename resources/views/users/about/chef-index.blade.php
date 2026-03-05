{{-- @extends('layouts.user')
@section('title', 'هم هم | Hum Hum')

@section('content') --}}
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
            left: calc(50% - -2px);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary-color: #660099;
        }

        ::selection {
            background: var(--primary-color) !important;
        }
    </style>

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#000000">

    <script>
        if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/sw.js');
    }
    </script>
</head>
<style>
    :root {
        --primary: #29A500 !important;
    }
</style>
<style>
        .about-section {
            padding: 30px 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            margin: 20px 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }
    
        .about-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #29A500, #29A500, #29A500);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }
    
        @keyframes shimmer {
    
            0%,
            100% {
                background-position: -200% 0;
            }
    
            50% {
                background-position: 200% 0;
            }
        }
    
        .about-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
            font-family: 'Cairo', sans-serif;
        }
    
        .about-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #29A500, #29A500);
            border-radius: 2px;
        }
    
        .about-description {
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: center;
            color: #4a5568;
            margin-bottom: 30px;
            padding: 0 10px;
            font-family: 'Cairo', sans-serif;
            font-weight: 400;
        }
    
        .about-image-container {
            position: relative;
            text-align: center;
            margin-top: 25px;
        }
    
        .about-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            border: 3px solid #fff;
        }
    
        .about-image:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }
    
        .decorative-elements {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #29A500, #29A500);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
    
        .decorative-elements:nth-child(2) {
            top: auto;
            bottom: -15px;
            left: -15px;
            animation-delay: -3s;
            background: linear-gradient(45deg, #28a745, #20c997);
        }
    
        @keyframes float {
    
            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }
    
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
    
        .info-icon {
            display: inline-block;
            width: 50px;
            height: 50px;
            background: #29A500;
            border-radius: 50%;
            color: white;
            font-size: 24px;
            line-height: 50px;
            text-align: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            animation: pulse 2s infinite;
        }
    
        @keyframes pulse {
            0% {
                box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            }
    
            50% {
                box-shadow: 0 4px 25px rgba(0, 123, 255, 0.5);
            }
    
            100% {
                box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            }
        }
    
        .fade-in {
            animation: fadeInUp 0.8s ease-out;
        }
    
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
    
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    
        @media (max-width: 768px) {
            .about-section {
                margin: 15px 10px;
                padding: 25px 15px;
            }
    
            .about-title {
                font-size: 1.8rem;
            }
    
            .about-description {
                font-size: 1rem;
                padding: 0 5px;
            }
        }


        .header {
            display: none !important;
        }

        main {
                margin-top: 0px !important;
                }

                .text-primary {
                    color: #29A500 !important;
                    }
                    
                    :root {
                    --primary: #29A500 !important;
                    }
                    
                    .header {
                    display: none !important;
                    }
                    
                    main {
                    margin-top: 0px !important;
                    }
                    
                    ::selection {
                    background-color: #29A500 !important;
                    color: white !important;
                    }
                    
                    .accordion-collapse.collapse {
                    visibility: visible !important;
                    display: none;
                    }
                    
                    .accordion-collapse.collapse.show {
                    display: block;
                    visibility: visible !important;
                    }
    </style>
<body>
    <div class="page-wrapper">
        <div class="dz-nav-floting">
            <main class="page-content" style="direction: rtl;">
                <div class="container">
                    @if($about)
                    <div class="about-section fade-in">
                        <div class="decorative-elements"></div>
                        <div class="decorative-elements"></div>

                        <div class="text-center">
                            <div class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        </div>

                        <h1 class="about-title">
                            {{ trans_field($about, 'title') }}
                        </h1>

                        <p class="about-description">
                            {{ trans_field($about, 'description') }}
                        </p>
                        @if ($about->main_image)
                        <div class="about-image-container">
                            <img src="{{ asset('storage/' . $about->main_image) }}" alt="صورة تعريفية"
                                class="about-image">
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="about-section fade-in">
                        <div class="decorative-elements"></div>
                        <div class="decorative-elements"></div>

                        <div class="text-center">
                            <div class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        </div>

                        <h1 class="about-title">لا يوجد معلومات حتي الأن</h1>
                    </div>
                    @endif
                </div>
            </main>
        </div>

<script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
    
    <script>
        // إضافة تأثيرات تفاعلية
            document.addEventListener('DOMContentLoaded', function() {
                // إزالة البريلودر
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 1000);
                }
    
                // تأثير التمرير السلس للصورة
                const aboutImage = document.querySelector('.about-image');
                if (aboutImage) {
                    aboutImage.addEventListener('load', function() {
                        this.style.opacity = '1';
                        this.style.transform = 'translateY(0)';
                    });
                }
            });
    </script>
</body>
</html>
{{-- @endsection --}}