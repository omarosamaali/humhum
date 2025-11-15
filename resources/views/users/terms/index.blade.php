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
            <!-- Main Content Start -->
            <main class="page-content" style="direction: rtl;">
                <div class="container">
                    @if($terms)
                    <div class="about-section fade-in">
                        <div class="decorative-elements"></div>
                        <div class="decorative-elements"></div>
                        <div class="text-center">
                            <div class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        </div>
                        <h1 class="about-title">
                            {{ trans_field($terms, 'title') }}
                        </h1>
                        <p class="about-description">
                            {{ trans_field($terms, 'description') }}
                        </p>
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
                        <h1 class="about-title">
                            @if(app()->getLocale() == 'ar')
                                لا يوجد معلومات حتي الان
                            @else
                                No information yet
                            @endif
                        </h1>
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
            document.addEventListener('DOMContentLoaded', function() {
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 1000);
                }
                });
        </script>
</body>

@endsection