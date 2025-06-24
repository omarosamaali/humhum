<!DOCTYPE html>
<html lang="ar" >

<head>
    <title>إعرفنا</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">

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
            background: linear-gradient(90deg, #df1313, #df1313, #df1313);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: -200% 0; }
            50% { background-position: 200% 0; }
        }

        .about-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
            font-family: 'Poppins', sans-serif;
        }

        .about-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #df1313, #df1313);
            border-radius: 2px;
        }

        .about-description {
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: center;
            color: #4a5568;
            margin-bottom: 30px;
            padding: 0 10px;
            font-family: 'Poppins', sans-serif;
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
            background: linear-gradient(45deg, #df1313, #df1313);
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
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .info-icon {
            display: inline-block;
            width: 50px;
            height: 50px;
            background: #df1313;
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
            0% { box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3); }
            50% { box-shadow: 0 4px 25px rgba(0, 123, 255, 0.5); }
            100% { box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3); }
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

        <!-- Header -->
        <header class="header header-fixed border-bottom onepage">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">إعرفنا</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>

        <!-- Page Content Start -->
        <main class="page-content space-top" style="margin-top: 50px;">
            <div class="container">
                <div class="about-section fade-in">
                    <div class="decorative-elements"></div>
                    <div class="decorative-elements"></div>
                    
                    <div class="text-center">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                    
                    <h1 class="about-title">{{ $about->title_ar }}</h1>
                    
                    <p class="about-description">{{ $about->description_ar }}</p>
                    
                    <div class="about-image-container">
                        <img src="{{ asset('storage/' . $about->main_image) }}" 
                             alt="صورة تعريفية" 
                             class="about-image">
                    </div>
                </div>
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