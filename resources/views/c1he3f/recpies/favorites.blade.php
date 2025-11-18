<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <!-- Title -->
    <title>نوع التعاقد</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    {!! $swalScript !!}
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
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
        <header class="header header-fixed shadow">
            <div class="header-content">
                <div class="left-content">
                    <div class="dz-head-items">
                        <h5 class="title mb-0">المفضلة</h5>
                        <!-- <ul class="dz-meta">
       <li class="dz-item"><b>6</b> items</li>
       <li class="dz-item">total: <b>$213</b></li>
      </ul> -->
                    </div>
                </div>
                <div class="mid-content"></div>
                <div class="right-content">
                    {{-- <a href="search.html" class="icon font-20">
                        <i class="icon feather icon-search"></i>
                    </a> --}}
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b60">
            <div class="container">
                <div class="row g-3">
                    <ul class="featured-list">
                        <li>
                            <div class="dz-card list">
                                <div class="dz-media">
                                    <a href="product-detail.html"><img
                                            src="https://img.freepik.com/free-photo/side-view-shawarma-with-fried-potatoes-board-cookware_176474-3215.jpg?uid=R118249704&ga=GA1.1.696324772.1728654570&semt=ais_hybrid&w=740"
                                            alt=""></a>
                                </div>
                                <div class="dz-content">
                                    <div class="dz-head">
                                        <h6 class="title"><a href="product-detail.html">كشري</a></h6>
                                        <ul class="tag-list">
                                            <li><a href="{{ url()->previous() ?: route('home') }}">غداء</a></li>
                                            <li><a href="{{ url()->previous() ?: route('home') }}">عشاء</a></li>
                                        </ul>
                                        <div class="dz-status">
                                            <span class="item-time">
                                                <i class="feather icon-clock me-1"></i>
                                                منذ 2د
                                            </span>
                                        </div>

                                    </div>
                                    <ul class="dz-meta">
                                        <li class="dz-price flex-1">الإمارات</li>
                                        <div class="dz-media" style="margin-left: -25px;">
                                            <div class="dz-rating" style="background-color: #e00000;"><i
                                                    class="fa fa-heart"></i> </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dz-card list">
                                <div class="dz-media">
                                    <a href="product-detail.html"><img
                                            src="https://img.freepik.com/free-photo/side-view-shawarma-with-fried-potatoes-board-cookware_176474-3215.jpg?uid=R118249704&ga=GA1.1.696324772.1728654570&semt=ais_hybrid&w=740"
                                            alt=""></a>
                                </div>
                                <div class="dz-content">
                                    <div class="dz-head">
                                        <h6 class="title"><a href="product-detail.html">كشري</a></h6>
                                        <ul class="tag-list">
                                            <li><a href="{{ url()->previous() ?: route('home') }}">غداء</a></li>
                                            <li><a href="{{ url()->previous() ?: route('home') }}">عشاء</a></li>
                                        </ul>
                                        <div class="dz-status">
                                            <span class="item-time">
                                                <i class="feather icon-clock me-1"></i>
                                                منذ 2د
                                            </span>
                                        </div>

                                    </div>
                                    <ul class="dz-meta">
                                        <li class="dz-price flex-1">الإمارات</li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="dz-card list">
                                <div class="dz-media">
                                    <a href="product-detail.html"><img
                                            src="https://img.freepik.com/free-photo/side-view-shawarma-with-fried-potatoes-board-cookware_176474-3215.jpg?uid=R118249704&ga=GA1.1.696324772.1728654570&semt=ais_hybrid&w=740"
                                            alt=""></a>
                                </div>
                                <div class="dz-content">
                                    <div class="dz-head">
                                        <h6 class="title"><a href="product-detail.html">كشري</a></h6>
                                        <ul class="tag-list">
                                            <li><a href="{{ url()->previous() ?: route('home') }}">غداء</a></li>
                                            <li><a href="{{ url()->previous() ?: route('home') }}">عشاء</a></li>
                                        </ul>
                                        <div class="dz-status">
                                            <span class="item-time">
                                                <i class="feather icon-clock me-1"></i>
                                                منذ 2د
                                            </span>
                                        </div>

                                    </div>
                                    <ul class="dz-meta">
                                        <li class="dz-price flex-1">الإمارات</li>
                                        <div class="dz-media" style="margin-left: -25px;">
                                            <div class="dz-rating" style="background-color: #e00000;"><i
                                                    class="fa-regular fa-face-frown"></i> </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    </li>

    </ul>

    </div>
    </div>
    </main>
    <!-- Main Content End -->

    <!-- Menubar -->
    <div class="menubar-area footer-fixed">
        <div class="toolbar-inner menubar-nav">
            <a href="{{ route('c1he3f.index') }}" class="nav-link">
                <i class="fi fi-rr-home"></i>
            </a>
            <a href="wishlist.html" class="nav-link active">
                <i class="fi fi-rr-heart"></i>
            </a>
            <a href="cart.html" class="nav-link">
                <i class="fi fi-rr-shopping-cart"></i>
            </a>
            <a href="profile.html" class="nav-link">
                <i class="fi fi-rr-user"></i>
            </a>
        </div>
    </div>
    <!-- Menubar -->

    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
</body>

</html>
