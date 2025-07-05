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

        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <header class="header header-fixed">
            <div class="header-content">
                <div class="mid-content">
                    <h4 class="title">الوصفات</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('c1he3f.index') }}" class="back-btn"> {{-- هنا ممكن تعدل الـ href لو عايز يرجع لصفحة معينة --}}
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <main class="page-content space-top">
            <div class="container">
                <div class="dz-custom-swiper">
                    <div thumbsSlider="" class="swiper mySwiper dz-tabs-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <h5 class="title">فعال</h5>
                            </div>
                            <div class="swiper-slide">
                                <h5 class="title">غير فعال</h5>
                            </div>

                        </div>
                    </div>
                    
                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">

                            {{-- Swiper Slide للوصفات الفعالة --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @forelse($activeRecipes as $recipe)
                                        <li>
                                            <div class="dz-card list">
                                                <div class="dz-media">
                                                    <a href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">
                                                        {{-- تأكد من الـ route لصفحة عرض الوصفة --}}
                                                        <img style="max-height: 132px;"
                                                            src="{{ asset('storage/' . $recipe->dish_image) }}"
                                                            alt="{{ $recipe->title }}"> {{-- افترض أن عندك عمود image باسم المسار --}}
                                                    </a>
                                                </div>

                                                <div class="dz-content">
                                                    <div class="dz-head">
                                                        <h6 class="title"><a
                                                                href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">{{ $recipe->title }}</a>
                                                        </h6>
                                                        @forelse ($recipe->subCategories as $subCategory)
                                                            <span class=""
                                                                style="    padding-bottom: 4px;
    color: #777777;
    display: block;
    font-size: 14px;">{{ $subCategory->name_ar }}</span>
                                                        @empty
                                                            <span class="text-muted">لا توجد</span>
                                                        @endforelse
                                                        <ul class="tag-list">
                                                            <li class="dz-price"
                                                                style="text-align: center; font-size: 14px;">
                                                                <i class="fa-solid fa-clock"
                                                                    style="color: var(--primary);"></i>
                                                                {{ $recipe->preparation_time }} دقيقة
                                                                {{-- افترض أن عندك عمود اسمه preparation_time --}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <ul class="dz-meta">
                                                        <li class="dz-price flex-1">
                                                            @if ($recipe->price)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z"
                                                                        stroke="#17191C" stroke-width="1.5"
                                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M6.5 11H18.5" stroke="#17191C"
                                                                        stroke-width="1.5" stroke-miterlimit="10"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M6.5 13H12.5H18.5" stroke="#17191C"
                                                                        stroke-width="1.5" stroke-miterlimit="10"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            @endif
                                                            {{ $recipe->price }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li>
                                            <p style="text-align: center; padding: 20px;">لا توجد وصفات فعالة حاليًا.
                                            </p>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>

                            {{-- Swiper Slide للوصفات الغير فعالة --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @forelse($inactiveRecipes as $recipe)
                                        <li>
                                            <div class="dz-card list">
                                                <div class="dz-media">
                                                    <a
                                                        href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">
                                                        {{-- تأكد من الـ route لصفحة عرض الوصفة --}}
                                                        <img style="max-height: 132px;"
                                                            src="{{ asset('storage/' . $recipe->dish_image) }}"
                                                            alt="{{ $recipe->title }}">
                                                    </a>
                                                </div>

                                                <div class="dz-content">
                                                    <div class="dz-head">
                                                        <h6 class="title"><a
                                                                href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">{{ $recipe->title }}</a>
                                                        </h6>
                                                        @forelse ($recipe->subCategories as $subCategory)
                                                            <span class=""
                                                                style="    padding-bottom: 4px;
    color: #777777;
    display: block;
    font-size: 14px;">{{ $subCategory->name_ar }}</span>
                                                        @empty
                                                            <span class="text-muted">لا توجد</span>
                                                        @endforelse
                                                        <ul class="tag-list">
                                                            <li class="dz-price"
                                                                style="text-align: center; font-size: 14px;">
                                                                <i class="fa-solid fa-clock"
                                                                    style="color: var(--primary);"></i>
                                                                {{ $recipe->preparation_time }} دقيقة
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <ul class="dz-meta">
                                                        <li class="dz-price flex-1">
                                                            @if ($recipe->price)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    fill="none">
                                                                    <path
                                                                        d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z"
                                                                        stroke="#17191C" stroke-width="1.5"
                                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M6.5 11H18.5" stroke="#17191C"
                                                                        stroke-width="1.5" stroke-miterlimit="10"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M6.5 13H12.5H18.5" stroke="#17191C"
                                                                        stroke-width="1.5" stroke-miterlimit="10"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            @endif
                                                            {{ $recipe->price }}
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li>
                                            <p style="text-align: center; padding: 20px;">لا توجد وصفات غير فعالة
                                                حاليًا.</p>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <a href="{{ route('c1he3f.recpies.add-recpie') }}"
                    style="position: fixed; bottom: 30px; left: 20px; z-index: 99999; ">
                    <svg fill="#000" xmlns="http://www.w3.org/2000/svg" style="width: 25px;"
                        viewBox="0 0 448 512">
                        <path
                            d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM200 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>
                </a>
            </div>
        </main>
    </div>

    <div class="menubar-area footer-fixed">
        <div class="toolbar-inner menubar-nav">
            <a href="{{ route('c1he3f.index') }}" class="nav-link">
                <i class="fi fi-rr-home"></i>
            </a>
            <a href="{{ route('c1he3f.coming-soon') }}" class="nav-link">
                <i class="fa fa-coins"></i>
                {{-- </svg> --}} {{-- في هنا closing tag زيادة لـ svg --}}
            </a>
            <a href="{{ route('chef.recipes.all') }}" class="nav-link">
                <div
                    style="background-color: var(--primary);
    width: fit-content;
    align-items: center;
    justify-content: center;
    margin: auto;
    width: 41px;
    display: flex
;
    border-radius: 50%;
    height: 41px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24"
                        fill="white">
                        <path
                            d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z"
                            fill="#fffff" />
                        <path d="M5 18H19" stroke="#fffff" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </a>
            <a href="{{ route('c1he3f.snaps.add-snap') }}" class="nav-link">
                <svg fill="#e00000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path fill="#e00000"
                        d="M48 48l88 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L32 0C14.3 0 0 14.3 0 32L0 136c0 13.3 10.7 24 24 24s24-10.7 24-24l0-88zM175.8 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-26.5 32C119.9 256 96 279.9 96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0zm368 80c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6l56.1 0zm-89.4 0c-8.6-24.3-29.9-42.6-55.9-47c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24zM464 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-80-32a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM504 48l88 0 0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-104c0-17.7-14.3-32-32-32L504 0c-13.3 0-24 10.7-24 24s10.7 24 24 24zM48 464l0-88c0-13.3-10.7-24-24-24s-24 10.7-24 24L0 480c0 17.7 14.3 32 32 32l104 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-88 0zm456 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l104 0c17.7 0 32-14.3 32-32l0-104c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 88-88 0z" />
                </svg>
            </a>
        </div>
    </div>
    <script src="{{ asset('assets/js/noui-slider.init.js') }}"></script>
    <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wnumb/wNumb.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
</body>

</html>
