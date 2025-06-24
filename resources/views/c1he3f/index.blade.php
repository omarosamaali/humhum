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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <!-- Sidebar -->
        <div class="sidebar dz-floting-sidebar">
            <div class="sidebar-header">
                <div class="app-logo">
                    <img class="logo-dark" src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                    <img class="logo-white d-none" src="{{ asset('assets/images/app-logo/logo-white.png') }}"
                        alt="logo">
                </div>
                <div class="title-bar mb-0">
                    <h4 class="title font-w600" style="visibility: collapse;">Main وصفة</h4>
                    <a href="javascript:void(0);" class="floating-close"><i class="feather icon-x"></i></a>
                </div>
            </div>
            <ul class="nav navbar-nav" style="direction: ltr;">
                <li>
                    <a class="nav-link active" href="index.html">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 8.40002V21C3 21.2652 3.10536 21.5196 3.29289 21.7071C3.48043 21.8947 3.73478 22 4 22H20C20.2652 22 20.5196 21.8947 20.7071 21.7071C20.8946 21.5196 21 21.2652 21 21V8.40002C21.0001 8.23638 20.96 8.07523 20.8833 7.93069C20.8066 7.78616 20.6956 7.66265 20.56 7.57102L12.56 2.17102C12.3946 2.05924 12.1996 1.99951 12 1.99951C11.8004 1.99951 11.6054 2.05924 11.44 2.17102L3.44 7.57102C3.30443 7.66265 3.19342 7.78616 3.11671 7.93069C3.03999 8.07523 2.99992 8.23638 3 8.40002V8.40002ZM14 20H10V14H14V20ZM5 8.93202L12 4.20702L19 8.93202V20H16V13C16 12.7348 15.8946 12.4804 15.7071 12.2929C15.5196 12.1054 15.2652 12 15 12H9C8.73478 12 8.48043 12.1054 8.29289 12.2929C8.10536 12.4804 8 12.7348 8 13V20H5V8.93202Z"
                                    fill="#BDBDBD" />
                            </svg>
                        </span>
                        <span>الرئيسية</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.profile.profile') }}">
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
                    <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();">
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
                    </a>
                    <form id="sign-out-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                    <h6 class="name">Ombe Coffee Shop</h6>
                    <span class="ver-info">App Version 1.1</span>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->

        <!-- Nav Floting Start -->
        <div class="dz-nav-floting">
            <!-- Header -->
            <header class="header py-2 mx-auto" style="position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                        <div class="info">
                            <p class="text m-b10">مرحبا بك : الشيف</p>
                            <h5 class="title">{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                    <div class="mid-content">

                    </div>
                    <div class="right-content d-flex align-items-center gap-4">
                        <a href="my-products.html" class="notification-badge font-20 badge-active">
                            <i class="fi fi-rr-shopping-cart" style="color: #e00000;"></i>
                        </a>
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
            <main class="page-content bg-white p-b60" style="margin-top: 100px;">
                <div class="container">
                    <!-- SearchBox -->
                    <div class="search-box">
                        <img style="width: 100%;"
                            src="data:image/jpeg;base64,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"
                            alt="">
                    </div>
                    <!-- SearchBox -->
                    <!-- Featured Beverages -->
                    <div class="title-bar" style="justify-content: space-between;">
                        <h5 class="title" style="margin: 0px; text-align: right;">اخر هم همسناب </h5>
                        <a href="allSnap.html" id="allSnapLink">الجميع</a>
                    </div>

                    <!-- Overlay Card -->
                    <div class="swiper overlay-swiper1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="dz-card-overlay style-1">
                                    <div class="dz-media">
                                        <!-- <video class="dz-media" controls loop autoplay muted> -->
                                        <iframe width="560" height="200" autoplay
                                            src="https://www.youtube.com/embed/BV_otkS8WOI?si=uDPrHOHS8TbuhFT8"
                                            frameborder="0" allowfullscreen></iframe>
                                        <!-- </video> -->
                                        <video class="dz-media" controls loop autoplay muted>
                                            <source src="https://www.youtube.com/embed/BV_otkS8WOI?si=uDPrHOHS8TbuhFT8"
                                                type="video/mp4">
                                            <p>Video not supported or not found.</p>
                                        </video>
                                    </div>
                                    <div class="dz-info">
                                        <h6 class="title" style="text-align: center;"><a href="product-detail.html"
                                                id="videoLink">تحدي
                                                الشاورما</a></h6>
                                        <ul class="dz-meta">
                                            <li class="dz-price" style="text-align: center; font-size: 14px;"> <i
                                                    class="fa-solid fa-eye"></i> 366</li>
                                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                <i class="fa-solid fa-heart"></i> 366
                                            </li>

                                            <li class="dz-price" style="text-align: center; font-size: 14px;"> <i
                                                    class="fa-solid fa-clock"></i> 5 دقيقة</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Overlay Card -->

                    <!-- Categories Swiper -->
                    <div class="title-bar mb-0">
                        <h5 class="title">التصنيفات</h5>
                    </div>
                    <div class="swiper categories-swiper dz-swiper m-b20">
                        <div class="swiper-wrapper">
                            @foreach ($mainCategories as $mainCategorie)
                                <div class="swiper-slide">
                                    <div class="dz-categories-bx">
                                        <div class="icon-bx">
                                            <img src="{{ asset('storage/' . $mainCategorie->image) }}"
                                                style="border-radius: 50%; width: 50px; height: 50px;" alt="">
                                        </div>
                                        <div class="dz-content">
                                            <h6 class="title"><a id="videoLink"
                                                    href="{{ route('c1he3f.category.show', $mainCategorie->id) }}">{{ $mainCategorie->name_ar }}</a></h6>
                                            <span class="وصفة text-primary">{{ $mainCategorie->recipes_count }}
                                                وصفة</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Categories Swiper -->


                    <!-- Featured Beverages -->
                    <div class="title-bar">
                        <h5 class="title" style="margin-right: 0px !important;">اخر إستخدمات وصفات</h5>
                        <a id="favoritesLink" href="favorites.html">الجميع</a>
                    </div>

                    {{-- <ul class="featured-list">
                        @foreach ($recipes as $recipe)
                            <li>
                                <div class="dz-card list">
                                    <div class="dz-media">
                                        <a href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">
                                            <img src="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : 'https://via.placeholder.com/740' }}"
                                                alt="{{ $recipe->title }}">
                                        </a>
                                        <div class="dz-rating" style="background-color: #e00000;">
                                            <i class="fa fa-heart"></i>
                                        </div>
                                    </div>
                                    <div class="dz-content">
                                        <div class="dz-head">
                                            <h6 class="title"><a
                                                    href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">{{ $recipe->title }}</a>
                                            </h6>
                                            <ul class="tag-list">
                                                @foreach ($recipe->subCategories->take(2) as $subCategory)
                                                    <li><a href="javascript:void(0);">{{ $subCategory->name_ar }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="dz-status">
                                                <span class="item-time">
                                                    <i class="feather icon-clock me-1"></i>
                                                    {{ $recipe->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                        <ul class="dz-meta">
                                            <li class="dz-price flex-1">
                                                {{ $recipe->mainCategory->name_ar ?? 'غير مصنف' }}</li>
                                            <li class="dz-pts">
                                                {{ $recipe->subCategories->first()->name_ar ?? 'غير محدد' }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>  --}}
                    <!-- Featured Beverages -->
                </div>
            </main>
            <!-- Main Content End -->

            <!-- Menubar In Layout -->
            <div class="menubar-area footer-fixed">
                <div class="toolbar-inner menubar-nav">
                    <a href="{{ route('c1he3f.index') }}" class="nav-link active">
                        <i class="fi fi-rr-home"></i>
                    </a>
                    <a href="transactions.html" class="nav-link">
                        <i class="fa fa-coins"></i>
                        </svg>
                    </a>
                    <a href="{{ route('chef.recipes.all') }}" class="nav-link">
                        <svg style="color: #e00000;" xmlns="http://www.w3.org/2000/svg" width="800px"
                            height="800px" viewBox="0 0 24 24" fill="#e00000">
                            <path
                                d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z"
                                fill="#e00000" />
                            <path d="M5 18H19" stroke="#e00000" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a href="add-snap.html" class="nav-link">
                        <svg fill="#e00000" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path fill="#e00000"
                                d="M48 48l88 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L32 0C14.3 0 0 14.3 0 32L0 136c0 13.3 10.7 24 24 24s24-10.7 24-24l0-88zM175.8 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-26.5 32C119.9 256 96 279.9 96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0zm368 80c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6l56.1 0zm-89.4 0c-8.6-24.3-29.9-42.6-55.9-47c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24zM464 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-80-32a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM504 48l88 0 0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-104c0-17.7-14.3-32-32-32L504 0c-13.3 0-24 10.7-24 24s10.7 24 24 24zM48 464l0-88c0-13.3-10.7-24-24-24s-24 10.7-24 24L0 480c0 17.7 14.3 32 32 32l104 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-88 0zm456 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l104 0c17.7 0 32-14.3 32-32l0-104c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 88-88 0z" />
                        </svg> </a>
                </div>
            </div>
            <!-- Menubar In Layout -->
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allSnapLink = document.getElementById('allSnapLink');
            const videoLink = document.getElementById('videoLink');
            const favoritesLink = document.getElementById('favoritesLink');
            const faqLink = document.getElementById('faqLink'); // جديد
            const aboutUsLink = document.getElementById('aboutUsLink'); // جديد
            const contactUsLink = document.getElementById('contactUsLink'); // جديد

            const userStatus = "{{ Auth::user()->status }}";

            // دالة مساعدة لتطبيق نفس المنطق على الروابط
            function applyStatusCheck(linkElement) {
                if (linkElement) {
                    linkElement.addEventListener('click', function(event) {
                        if (userStatus === 'بانتظار التفعيل') {
                            event.preventDefault(); // منع الانتقال للصفحة

                            Swal.fire({
                                icon: 'warning',
                                title: 'الملف الشخصي غير مكتمل!',
                                text: 'برجاء إكمال جميع اشتراطات الملف الشخصي لتفعيل حسابك.',
                                confirmButtonText: 'حسناً',
                                customClass: {
                                    confirmButton: 'my-swal-button-class'
                                }
                            });
                        }
                    });
                }
            }

            // تطبيق الدالة على جميع الروابط المطلوبة
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
