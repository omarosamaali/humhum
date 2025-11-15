@extends('layouts.user')
@section('title', 'هم هم | Hum Hum')

@section('content')
<style>
    :root {
        --primary: #660099 !important;
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
            background: linear-gradient(90deg, #660099, #660099, #660099);
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
            background: linear-gradient(90deg, #660099, #660099);
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
            background: linear-gradient(45deg, #660099, #660099);
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
            background: #660099;
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
    </style>
<body>
    <div class="page-wrapper">
        <div class="dz-nav-floting">
            <!-- Header -->
            <header class="header header-fixed">
                <div class="header-content">
                    <div class="left-content">
                        <a href="{{ url()->previous() ?: route('home') }}" class="icon dz-floating-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect y="2" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect y="18" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect x="4" y="10" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                            </svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h4 class="title">الأسئلة الشائعة</h4>
                    </div>
                    <!-- <div class="right-content">
                <a href="chat.html" class="font-24 d-block lh-1">
                    <i class="fi fi-rr-comment"></i>
                </a>
            </div> -->
                </div>
            </header>
            <!-- Header -->

            <!-- Main Content Start -->
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

@endsection