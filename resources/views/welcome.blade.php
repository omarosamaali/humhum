<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hum Hum | هم هم</title>
    <link rel="icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/assets/css/owl.theme.default.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- fancybox -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <!-- style -->
    {{-- <link rel="stylesheet" href="assets/css/style.css"> --}}
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- color -->
    <link rel="stylesheet" href="{{ asset('assets/css/color.css') }}">
    <!-- jQuery -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/preloader.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .container.grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            grid-gap: 30px;
            align-items: center;
        }

        /* Header Styles */
        header.one {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .bottom-bar {
            padding: 10px 0;
        }

        .logo img {
            max-height: 60px;
            width: auto;
        }

        /* Hero Section with Animated Background */
        .slider-hero {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(135deg, #eeeeee 0%, #c9c9c9 100%);
            overflow: hidden;
            display: flex;
            align-items: center;
            padding-top: 80px;
        }

        /* Animated Background Elements */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 10%;
            animation-delay: 1s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 15%;
            animation-delay: 2s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            right: 15%;
            animation-delay: 3s;
        }

        .shape:nth-child(5) {
            width: 40px;
            height: 40px;
            top: 50%;
            left: 5%;
            animation-delay: 4s;
        }

        .shape:nth-child(6) {
            width: 90px;
            height: 90px;
            top: 70%;
            right: 5%;
            animation-delay: 5s;
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

        /* Particle Animation */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: particle-float 8s linear infinite;
        }

        .particle:nth-child(odd) {
            animation-duration: 10s;
            background: rgba(255, 182, 193, 0.7);
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Content Styles */
        .hero-section {
            position: relative;
            z-index: 10;
            width: 100%;
            padding: 60px 0;
        }

        .app-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .app-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .app-card:hover::before {
            left: 100%;
        }

        .app-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .app-icon-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            /* background: linear-gradient(135deg, #ff6b6b, #ee5a24); */
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(185, 185, 185, 0.3);
            transition: all 0.3s ease;
        }

        .app-card:hover .app-icon-container {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 40px rgba(139, 139, 139, 0.4);
        }

        .app-icon-container img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            filter: brightness(1.1);
        }

        .app-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            position: relative;
        }

        .app-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            border-radius: 2px;
        }

        .download-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .download-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: green;
            color: white;
            border-radius: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            font-size: 20px;
        }

        .download-btn:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .download-btn.apple {
            background: linear-gradient(135deg, #333, #666);
            box-shadow: 0 5px 15px rgba(51, 51, 51, 0.3);
        }

        .download-btn.apple:hover {
            box-shadow: 0 10px 25px rgba(51, 51, 51, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container.grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .app-card {
                padding: 30px 15px;
            }

            .app-icon-container {
                width: 100px;
                height: 100px;
            }

            .app-icon-container img {
                width: 60px;
                height: 60px;
            }

            .app-title {
                font-size: 20px;
            }

            .shape {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .slider-hero {
                padding-top: 100px;
            }

            .hero-section {
                padding: 30px 0;
            }

            .download-buttons {
                gap: 10px;
            }

            .download-btn {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
        }

        .slider-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .bratlee-hamint.item {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 0 10px;
            position: relative;
        }

        .bratlee-hamint p {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .bratlee-hamint h3 {
            font-size: 24px;
            color: #000;
            margin-right: 15px;
        }

        .star {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .star li {
            margin: 0 5px;
            color: #f1c40f;
            /* Star color */
        }

        .quote {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 40px;
            opacity: 0.3;
        }

        .slick-prev,
        .slick-next {
            font-size: 0;
            line-height: 0;
            position: absolute;
            top: 50%;
            display: block;
            width: 20px;
            height: 20px;
            padding: 0;
            transform: translate(0, -50%);
            cursor: pointer;
            color: transparent;
            border: none;
            outline: none;
            background: transparent;
        }

        .slick-prev:before,
        .slick-next:before {
            font-family: 'slick';
            font-size: 20px;
            line-height: 1;
            opacity: .75;
            color: #000;
        }

        .slick-prev {
            left: -25px;
        }

        .slick-next {
            right: -25px;
        }

        .slick-dots {
            text-align: center;
            margin-top: 20px;
        }

        .slick-dots li {
            display: inline-block;
            margin: 0 5px;
        }

        .slick-dots li button {
            font-size: 0;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ccc;
            border: none;
            cursor: pointer;
        }

        .slick-dots li.slick-active button {
            background: #000;
        }

        body {
            font-family: 'cairo' !important;
        }

    </style>
</head>

<body>
    <!-- preloader -->
    <div class="preloader">
        <div class="container">
            <div class="dot dot-1"></div>
            <div class="dot dot-2"></div>
            <div class="dot dot-3"></div>
        </div>
    </div>
    <!-- end preloader -->

    <header class="one">
        <div class="bottom-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3" style="width: 100%;">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="logo" style="padding: 20px 0px; text-align: center;">
                                <a href="index.html">
                                    <img alt="logo" src="{{ asset('assets/img/logo.svg') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="slider-hero">
        <!-- Animated Background -->
        <div class="bg-animation">
            <div class="floating-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            <div class="particles">
                <!-- Particles will be generated by JavaScript -->
            </div>
        </div>

        <div class="hero-section">
            <div class="container grid">
                <div class="app-card">
                    <div class="app-icon-container">
                        <img src="../assets/img/4.png" alt="تطبيق هم هم">
                    </div>
                    <h3 class="app-title">تطبيق هم هم</h3>
                    <div class="download-buttons">
                        <a href="#" class="download-btn">
                            <i class="fa-brands fa-google-play"></i>
                        </a>
                        <a href="#" class="download-btn apple">
                            <i class="fa-brands fa-apple"></i>
                        </a>
                    </div>
                </div>

                <div class="app-card">
                    <div class="app-icon-container">
                        <img src="../assets/img/2.png" alt="تطبيق الشريك">
                    </div>
                    <h3 class="app-title">تطبيق الشريك</h3>
                    <div class="download-buttons">
                        <a href="#" class="download-btn">
                            <i class="fa-brands fa-google-play"></i>
                        </a>
                        <a href="#" class="download-btn apple">
                            <i class="fa-brands fa-apple"></i>
                        </a>
                    </div>
                </div>

                <div class="app-card">
                    <div class="app-icon-container">
                        <img src="../assets/img/3.png" alt="تطبيق الطهاه">
                    </div>
                    <h3 class="app-title">تطبيق الطهاه</h3>
                    <div class="download-buttons">
                        <a href="#" class="download-btn">
                            <i class="fa-brands fa-google-play"></i>
                        </a>
                        <a href="#" class="download-btn apple">
                            <i class="fa-brands fa-apple"></i>
                        </a>
                    </div>
                </div>

                <div class="app-card">
                    <div class="app-icon-container">
                        <img src="../assets/img/Layer_1.png" alt="تطبيق عدسة الطهاه">
                    </div>
                    <h3 class="app-title">تطبيق عدسة الطهاه</h3>
                    <div class="download-buttons">
                        <a href="#" class="download-btn">
                            <i class="fa-brands fa-google-play"></i>
                        </a>
                        <a href="#" class="download-btn apple">
                            <i class="fa-brands fa-apple"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session('success'))
    <div style="        display: flex
;
    right: 0px;
    z-index: 9999999999999999999999999;
    width: 93%;
    top: 123px;
    text-align: right;
    position: fixed;
    background: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    justify-content: space-between;">


        <span style="cursor: pointer;" onclick="this.parentElement.style.display='none'" class="close">x</span>
        <div>

            {{ session('success') }}
        </div>
    </div>
    @endif


    <script>
        // Generate particles
        function createParticles() {
            const particlesContainer = document.querySelector('.particles');
            const numberOfParticles = 50;

            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 5 + 8) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles when page loads
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();

            // Hide preloader
            setTimeout(() => {
                document.querySelector('.preloader').style.display = 'none';
            }, 1000);
        });

        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header.one');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.boxShadow = '0 2px 30px rgba(0, 0, 0, 0.15)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            }
        });

    </script>
    <section class="gap no-top">
        <div class="container">
            <div class="heading-two">
                <h2 style="text-align: center; margin: 20px 0px; font-size: 40px;">الطهاة المسجلين لدينا</h2>
                <div class="line"></div>
            </div>
            <div class="swiper swiper-chefs">
                <div class="swiper-wrapper">
                    @foreach ($chefs as $chef)
                    <div class="swiper-slide">
                        <div class="chef">
                            <img alt="الشيف {{ $chef->user->name }}" style="height: 600px; width: 400px;" src="{{ asset('storage/' . $chef->official_image) }}">
                            <div class="chef-text" style="flex-direction: column;">
                                <span style="display: block;">
                                    @php
                                    $countryName = '';
                                    switch (strtolower($chef->country)) {
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

                                    <!-- Display the Arabic country name -->
                                    الدولة: {{ $countryName }}


                                    <img src="https://flagcdn.com/24x18/{{ $chef->country }}.png" alt="علم {{ $chef->country }}" style="width: 24px; height: 18px; vertical-align: middle;"> </span>



                                <br />
                                <a style="display: block;" href="chef-details.html">
                                    <h4>{{ $chef->user->name }} / الشيف </h4>

                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Navigation buttons -->
                <div class="swiper-button-prev swiper-button-prev-chefs"></div>
                <div class="swiper-button-next swiper-button-next-chefs"></div>
                <!-- Pagination -->
                <div class="swiper-pagination swiper-pagination-chefs"></div>
            </div>
        </div>
    </section>


    <section class="section-discover-menu">
        <div class="container">
            <div class="heading-two">
                <h2>المطابخ</h2>
                <div class="line"></div>
            </div>
            <div class="swiper swiper-kitchens">
                <div class="swiper-wrapper">
                    @foreach ($kitchens as $kitchen)
                    <div class="swiper-slide">
                        <img style="height: 100px; width: 100%; object-fit: fill;" src="{{ asset('storage/' . $kitchen->image) }}" alt="المطبخ {{ $kitchen->name_ar }}">
                        <p style="text-align: center; font-size: 19px; color: black;">{{ $kitchen->name_ar }}</p>
                    </div>
                    @endforeach
                </div>
                <!-- Navigation buttons -->
                <div class="swiper-button-prev swiper-button-prev-kitchens"></div>
                <div class="swiper-button-next swiper-button-next-kitchens"></div>
                <!-- Pagination -->
                <!--<div class="swiper-pagination swiper-pagination-kitchens"></div>-->
            </div>
        </div>
    </section>


    <section class="gap" style="">
        <div class="container" style="height: 325px;">
            <div class="row">
                <div class="col-xl-6">
                    <div class="heading">
                        <!-- <span>Testimonials & Reviews</span> -->
                        <h2 style="text-align: center;">مميزات هم هم</h2>
                    </div>
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Slider Example</title>
                        <!-- Include Slick Slider CSS -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
                        <!-- Include Font Awesome for star icons -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
                        <style>
                            /* Custom CSS for the slider */
                            .slider-container {
                                max-width: 800px;
                                margin: 0 auto;
                                padding: 20px;
                            }

                            .bratlee-hamint.item {
                                background: #f9f9f9;
                                padding: 20px;
                                border-radius: 10px;
                                text-align: center;
                                margin: 0 10px;
                                position: relative;
                            }

                            .bratlee-hamint p {
                                font-size: 16px;
                                color: #333;
                                margin-bottom: 20px;
                            }

                            .bratlee-hamint h3 {
                                font-size: 24px;
                                color: #000;
                                margin-right: 15px;
                            }

                            .star {
                                list-style: none;
                                padding: 0;
                                display: flex;
                                justify-content: center;
                            }

                            .star li {
                                margin: 0 5px;
                                color: #f1c40f;
                                /* Star color */
                            }

                            .quote {
                                position: absolute;
                                top: 10px;
                                right: 10px;
                                width: 40px;
                                opacity: 0.3;
                            }

                            .slick-prev,
                            .slick-next {
                                font-size: 0;
                                line-height: 0;
                                position: absolute;
                                top: 50%;
                                display: block;
                                width: 20px;
                                height: 20px;
                                padding: 0;
                                transform: translate(0, -50%);
                                cursor: pointer;
                                color: transparent;
                                border: none;
                                outline: none;
                                background: transparent;
                            }

                            .slick-prev:before,
                            .slick-next:before {
                                font-family: 'slick';
                                font-size: 20px;
                                line-height: 1;
                                opacity: .75;
                                color: #000;
                            }

                            .slick-prev {
                                left: -25px;
                            }

                            .slick-next {
                                right: -25px;
                            }

                            .slick-dots {
                                text-align: center;
                                margin-top: 20px;
                            }

                            .slick-dots li {
                                display: inline-block;
                                margin: 0 5px;
                            }

                            .slick-dots li button {
                                font-size: 0;
                                width: 10px;
                                height: 10px;
                                border-radius: 50%;
                                background: #ccc;
                                border: none;
                                cursor: pointer;
                            }

                            .slick-dots li.slick-active button {
                                background: #000;
                            }

                        </style>
                    </head>
                    <body>
                        <div class="slider-container">
                            <div class="slider">
                                <div class="bratlee-hamint item">
                                    <p>A good restaurant is like a vacation; it transports you, and it becomes a lot more than just about the food. All great deeds and all great thoughts</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <h3>Bratlee Hamint</h3>
                                        <ul class="star">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                    </div>
                                    <img alt="quote" class="quote" src="assets/img/quote.png">
                                </div>
                                <div class="bratlee-hamint item">
                                    <p>A good restaurant is like a vacation; it transports you, and it becomes a lot more than just about the food. All great deeds and all great thoughts</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <h3>Bratlee Hamint</h3>
                                        <ul class="star">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                    </div>
                                    <img alt="quote" class="quote" src="assets/img/quote.png">
                                </div>
                                <div class="bratlee-hamint item">
                                    <p>A good restaurant is like a vacation; it transports you, and it becomes a lot more than just about the food. All great deeds and all great thoughts</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <h3>Bratlee Hamint</h3>
                                        <ul class="star">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                    </div>
                                    <img alt="quote" class="quote" src="assets/img/quote.png">
                                </div>
                                <div class="bratlee-hamint item">
                                    <p>A good restaurant is like a vacation; it transports you, and it becomes a lot more than just about the food. All great deeds and all great thoughts</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <h3>Bratlee Hamint</h3>
                                        <ul class="star">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                    </div>
                                    <img alt="quote" class="quote" src="assets/img/quote.png">
                                </div>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('.slider').slick({
                                    dots: true, // Show navigation dots
                                    arrows: true, // Show next/prev arrows
                                    infinite: true, // Loop the slider
                                    slidesToShow: 1, // Show one slide at a time
                                    slidesToScroll: 1, // Scroll one slide at a time
                                    autoplay: true, // Enable autoplay
                                    autoplaySpeed: 3000, // 3 seconds per slide
                                    responsive: [{
                                        breakpoint: 768
                                        , settings: {
                                            slidesToShow: 1
                                            , slidesToScroll: 1
                                        }
                                    }]
                                });
                            });

                        </script>

                </div>
                <div class="col-xl-6">
                    <div class="bratlee-img">
                        <img alt="bratlee-hamin2" class="bratlee-hamint-2" src="https://placehold.co/292x292">
                        <img alt="bratlee-hamint" class="bratlee-hamint-1" src="https://placehold.co/292x292">
                        <img alt="bratlee-hamin3" class="bratlee-hamint-3" src="https://placehold.co/292x292">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('.bratlee-slider').owlCarousel({
                loop: true
                , margin: 20
                , nav: true
                , dots: true
                , autoplay: true
                , autoplayTimeout: 3000
                , autoplayHoverPause: true
                , responsive: {
                    0: {
                        items: 1
                    }
                    , 768: {
                        items: 2
                    }
                    , 1024: {
                        items: 3
                    }
                }
            });
        });

    </script>
    <section>
        <div class="container" style="margin-top: 54px;">
            <div style="background: black;" class="reserve-table">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="reserve-table-text" style="    margin-bottom: 49px;
">
                            <h3 style="width: 239px;">تواصل معنا</h3>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="best-food-restaurants">
                            <form role="form" id="reservation-form" method="POST" action="{{ route('contacts.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="email" name="email" style="text-align: right;" placeholder="الايميل" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-12">
                                        <textarea type="text" class="form-control" name="message" style="border-radius: 10px; height: 150px; text-align: right;" placeholder="الرسالة" required>{{ old('message') }}</textarea>
                                        @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="button" type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-bootem">
                <h6> جميع الحقوق محفوظة الي<span>© ايفورك </span></h6>
                <div class="header-social-media">
                    <a href="#">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">Instagram</a>
                    <a href="#">Youtube</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- progress -->
    <div id="progress">
        <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
    </div>

    <!-- Bootstrap Js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- fancybox -->
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Form Script -->
    <script src="{{ asset('assets/js/contact.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Swiper لقسم المطابخ
        const swiperKitchens = new Swiper('.swiper-kitchens', {
            loop: true
            , slidesPerView: 2
            , spaceBetween: 20
            , navigation: {
                nextEl: '.swiper-button-next-kitchens'
                , prevEl: '.swiper-button-prev-kitchens'
            , }
            , pagination: {
                el: '.swiper-pagination-kitchens'
                , clickable: true
            , }
            , breakpoints: {
                640: {
                    slidesPerView: 5
                    , spaceBetween: 20
                , }
                , 1024: {
                    slidesPerView: 7, // عرض 5 شرائح في قسم المطابخ
                    spaceBetween: 30
                , }
            , }
            , direction: 'horizontal'
            , a11y: {
                enabled: true
                , prevSlideMessage: 'الشريحة السابقة'
                , nextSlideMessage: 'الشريحة التالية'
            , }
        , });

        // Swiper لقسم الطهاة
        const swiperChefs = new Swiper('.swiper-chefs', {
            loop: true
            , slidesPerView: 1
            , spaceBetween: 20
            , navigation: {
                nextEl: '.swiper-button-next-chefs'
                , prevEl: '.swiper-button-prev-chefs'
            , }
            , pagination: {
                el: '.swiper-pagination-chefs'
                , clickable: true
            , }
            , breakpoints: {
                640: {
                    slidesPerView: 2
                    , spaceBetween: 20
                , }
                , 1024: {
                    slidesPerView: 3, // الإعدادات الأصلية للطهاة
                    spaceBetween: 30
                , }
            , }
            , direction: 'horizontal'
            , a11y: {
                enabled: true
                , prevSlideMessage: 'الشريحة السابقة'
                , nextSlideMessage: 'الشريحة التالية'
            , }
        , });

    </script>

</body>

</html>

