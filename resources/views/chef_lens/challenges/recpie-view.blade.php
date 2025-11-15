<!DOCTYPE html>
<html lang="ar">

<head>
    <title>إعرفنا</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    {!! $swalScript !!}

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        #custom-header {
            top: 11px;
            background-color: transparent !important;
            z-index: 9999999999999999999999999999999;
            position: relative;
            left: 0px;
            justify-content: end;
            display: flex;
            background-color: transparent !important;

        }

        * {
            direction: rtl;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .count-area {
            position: absolute;
            right: 6px;
            top: 3px;
            background: rgb(0, 0, 0);
            width: 25px;
            z-index: 999999999;
            height: 22px;
            border-radius: 70px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex !important;
        }

        .custom-icon {
            color: black !important;
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
            width: 70%;
            border: 1px solid #EFBF04;
            border-radius: 15px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
        }

        .header-content {
            direction: rtl;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
        }

        #carts-chef {
            border: 0;
            box-shadow: none;
            background: transparent;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 0px;
            gap: 4px;
            margin-left: 56px !important;
        }

        button {
            border: 0px;
        }

        #name-chef {
            font-weight: 400;
            font-size: 16px;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .dz-custom-swiper {
            margin-top: 84px;
            padding: 20px;
        }

        .swiper-slide {
            padding: 10px;
        }

        .swiper-slide h5 {
            text-align: center;
            padding: 15px;
            background: #000000;
            border-radius: 10px;
            margin: 0;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .swiper-slide-thumb-active h5 {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .title i {
            color: white;
        }

        .featured-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 15px;
        }

        .grid-layout {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-layout li {
            width: 100%;
            height: fit-content;
        }

        .grid-layout video {
            height: 100%;
            border-radius: 14px;
            width: 100%;
        }

        .list-layout {
            grid-template-columns: 1fr;
        }

        @media (max-width: 576px) {
            .grid-layout {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        .dz-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            background: usnet !important;
        }

        .dz-card:hover {
            transform: translateY(-5px);
        }

        .w-full {
            width: 100%;
            position: relative;
        }

        .w-full a {
            display: block;
            width: 100%;
            text-decoration: none;
        }

        .w-full img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
        }

        .grid-layout .w-full img {
            height: 120px;
        }

        /* Delete button styles */
        .delete-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .delete-btn:hover {
            background: rgba(255, 0, 0, 1);
            transform: scale(1.1);
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #333;
            padding: 5px 10px;
            border-radius: 50%;
            transition: background 0.3s ease;
        }

        .back-btn:hover {
            background: #f0f0f0;
        }

        .separator {
            width: 100%;
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .dz-custom-swiper {
                padding: 10px;
            }

            .grid-layout {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Animation for item removal */
        .item-removing {
            animation: fadeOut 0.5s ease-in-out;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.8);
            }
        }

    </style>
    <style>
        .back--btn {
            background: #000000;
            width: 50px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            border-radius: 50%;
        }

        .back--btn i {
            font-size: 23px;
            color: white;
        }

        .dz-card.list {
            margin-bottom: 0px;
        }

    </style>

    {!! $swalScript !!}
</head>

<body>
    <div class="page-wrapper" style="top: -19px; position: relative;">

        <div class="dz-nav-floting">
            <header class="header" id="custom-header">

                <div class="header-content">

                    <div class="right-content">
                        {{-- back one page --}}
                        <a href="{{ url()->previous() }}" class="back--btn">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </div>
                </div>
            </header>


            <!-- Main Content Start -->
            <main class="page-content" style="position: relative; top: -61px;">
                <div class="container p-0">
                    <div class="dz-product-preview bg-primary">
                        <div class="swiper product-detail-swiper">
                            <div class="overlay" style="position: absolute; z-index: 999999; height: 370px; width: 100%; background-color: rgba(0, 0, 0, 0.5);">
                            </div>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="padding: 0px;">
                                    <div class="dz-media">
                                        <img style="height: 370px;" src="{{ asset('storage/' . $recipe->dish_image) }}" alt="{{ $recipe->title }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dz-product-detail" style="direction: rtl;">
                        <div class="detail-content">
                            <h4 class="title">{{ $recipe->title }}</h4>
                            <ul class="tag-list" style="display: flex; gap: 10px;">
                                <li class="dz-price" style="text-align: center; font-size: 14px;">
                                    <i class="fa-solid fa-clock" style="color: var(--primary);"></i>
                                    {{ $recipe->preparation_time }} دقيقة
                                </li>
                            </ul>

                            @if($recipe->kitchen)
                            <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;" class="tags">
                                <img src="{{ asset('storage/' . $recipe->kitchen->image) }}" style="border-radius: 50%; width: 30px; height: 30px;" alt="">

                                {{ $recipe->kitchen->name_ar }}
                            </div>
                            @endif

                            <div style="display: flex; gap: 10px; align-items: center;">
                                @if($recipe->is_free)
                                <div style="background-color: green; color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                    مجانية
                                </div>
                                @else
                                <div style="background-color: #9c8500; color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                    مدفوعة
                                </div>
                                @endif

                                @if($recipe->main_category_id)

                                <div style="background-color: rgb(0, 0, 0); color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                    {{ $recipe->mainCategories?->name_ar }}
                                </div>
                                @endif
                                @forelse ($recipe->subCategories as $subCategory)
                                <span class="badge badge-info">{{ $subCategory->name_ar }}</span>
                                @empty
                                <span class="text-muted">لا توجد</span>
                                @endforelse

                            </div>
                        </div>
                        <div style="display: flex;">
                            @if($recipe->chef)
                            <div class="dz-item-rating" style="background-color: white; font-size: 17px; overflow: hidden; line-height: unset; border: 2px solid #660099;">
                                <img src="{{ asset('storage/' . $recipe->chef->chefProfile->official_image) }}" style="width: 100%; height: 100%;" alt="unkown image">


                            </div>
                            <h5 style="position: absolute; right: 100px; top: 10px; font-size: 14px; color: gray;">وصفات
                                الشيف : {{ $recipe->chef->name }}</h5>
                            @endif
                        </div>
                        <div class="item-wrapper">
                            <div class="dz-meta-items">
                                <div class="dz-price flex-1" style="justify-content: space-between; display: flex;">
                                    <div class="price" style="flex-direction: column; align-items: center;">
                                        <div>
                                            <sub><i class="fa fa-users" style="font-size: 14px; margin-left: 5px;"></i></sub>{{ $recipe->servings }}
                                        </div>
                                        <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                            عدد الأشخاص</div>
                                    </div>
                                    <div class="price" style="flex-direction: column; align-items: center;">
                                        <div>
                                            <sub><i class="fa fa-clock" style="font-size: 14px; margin-left: 5px;"></i></sub>{{ $recipe->preparation_time }}د
                                        </div>
                                        <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                            وقت التحضير</div>
                                    </div>
                                    @if (!$recipe->is_free)
                                    <div class="price" style="flex-direction: column; align-items: center;">
                                        <div>
                                            <sub><i class="fa fa-coins" style="font-size: 14px;"></i></sub>{{ $recipe->price }}
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 1000 870" width="18" height="18">
                                                <title>Layer copy</title>
                                                <style>
                                                    .s0 {
                                                        fill: #000000
                                                    }

                                                </style>
                                                <path id="Layer copy" class="s0" d="m88.3 1c0.4 0.6 2.6 3.3 4.7 5.9 15.3 18.2 26.8 47.8 33 85.1 4.1 24.5 4.3 32.2 4.3 125.6v87h-41.8c-38.2 0-42.6-0.2-50.1-1.7-11.8-2.5-24-9.2-32.2-17.8-6.5-6.9-6.3-7.3-5.9 13.6 0.5 17.3 0.7 19.2 3.2 28.6 4 14.9 9.5 26 17.8 35.9 11.3 13.6 22.8 21.2 39.2 26.3 3.5 1 10.9 1.4 37.1 1.6l32.7 0.5v43.3 43.4l-46.1-0.3-46.3-0.3-8-3.2c-9.5-3.8-13.8-6.6-23.1-14.9l-6.8-6.1 0.4 19.1c0.5 17.7 0.6 19.7 3.1 28.7 8.7 31.8 29.7 54.5 57.4 61.9 6.9 1.9 9.6 2 38.5 2.4l30.9 0.4v89.6c0 54.1-0.3 94-0.8 100.8-0.5 6.2-2.1 17.8-3.5 25.9-6.5 37.3-18.2 65.4-35 83.6l-3.4 3.7h169.1c101.1 0 176.7-0.4 187.8-0.9 19.5-1 63-5.3 72.8-7.4 3.1-0.6 8.9-1.5 12.7-2.1 8.1-1.2 21.5-4 40.8-8.9 27.2-6.8 52-15.3 76.3-26.1 7.6-3.4 29.4-14.5 35.2-18 3.1-1.8 6.8-4 8.2-4.7 3.9-2.1 10.4-6.3 19.9-13.1 4.7-3.4 9.4-6.7 10.4-7.4 4.2-2.8 18.7-14.9 25.3-21 25.1-23.1 46.1-48.8 62.4-76.3 2.3-4 5.3-9 6.6-11.1 3.3-5.6 16.9-33.6 18.2-37.8 0.6-1.9 1.4-3.9 1.8-4.3 2.6-3.4 17.6-50.6 19.4-60.9 0.6-3.3 0.9-3.8 3.4-4.3 1.6-0.3 24.9-0.3 51.8-0.1 53.8 0.4 53.8 0.4 65.7 5.9 6.7 3.1 8.7 4.5 16.1 11.2 9.7 8.7 8.8 10.1 8.2-11.7-0.4-12.8-0.9-20.7-1.8-23.9-3.4-12.3-4.2-14.9-7.2-21.1-9.8-21.4-26.2-36.7-47.2-44l-8.2-3-33.4-0.4-33.3-0.5 0.4-11.7c0.4-15.4 0.4-45.9-0.1-61.6l-0.4-12.6 44.6-0.2c38.2-0.2 45.3 0 49.5 1.1 12.6 3.5 21.1 8.3 31.5 17.8l5.8 5.4v-14.8c0-17.6-0.9-25.4-4.5-37-7.1-23.5-21.1-41-41.1-51.8-13-7-13.8-7.2-58.5-7.5-26.2-0.2-39.9-0.6-40.6-1.2-0.6-0.6-1.1-1.6-1.1-2.4 0-0.8-1.5-7.1-3.5-13.9-23.4-82.7-67.1-148.4-131-197.1-8.7-6.7-30-20.8-38.6-25.6-3.3-1.9-6.9-3.9-7.8-4.5-4.2-2.3-28.3-14.1-34.3-16.6-3.6-1.6-8.3-3.6-10.4-4.4-35.3-15.3-94.5-29.8-139.7-34.3-7.4-0.7-17.2-1.8-21.7-2.2-20.4-2.3-48.7-2.6-209.4-2.6-135.8 0-169.9 0.3-169.4 1zm330.7 43.3c33.8 2 54.6 4.6 78.9 10.5 74.2 17.6 126.4 54.8 164.3 117 3.5 5.8 18.3 36 20.5 42.1 10.5 28.3 15.6 45.1 20.1 67.3 1.1 5.4 2.6 12.6 3.3 16 0.7 3.3 1 6.4 0.7 6.7-0.5 0.4-100.9 0.6-223.3 0.5l-222.5-0.2-0.3-128.5c-0.1-70.6 0-129.3 0.3-130.4l0.4-1.9h71.1c39 0 78 0.4 86.5 0.9zm297.5 350.3c0.7 4.3 0.7 77.3 0 80.9l-0.6 2.7-227.5-0.2-227.4-0.3-0.2-42.4c-0.2-23.3 0-42.7 0.2-43.1 0.3-0.5 97.2-0.8 227.7-0.8h227.2zm-10.2 171.7c0.5 1.5-1.9 13.8-6.8 33.8-5.6 22.5-13.2 45.2-20.9 62-3.8 8.6-13.3 27.2-15.6 30.7-1.1 1.6-4.3 6.7-7.1 11.2-18 28.2-43.7 53.9-73 72.9-10.7 6.8-32.7 18.4-38.6 20.2-1.2 0.3-2.5 0.9-3 1.3-0.7 0.6-9.8 4-20.4 7.8-19.5 6.9-56.6 14.4-86.4 17.5-19.3 1.9-22.4 2-96.7 2h-76.9v-129.7-129.8l220.9-0.4c121.5-0.2 221.6-0.5 222.4-0.7 0.9-0.1 1.8 0.5 2.1 1.2z" />
                                            </svg>
                                        </div>
                                        <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                            السعر</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="item-wrapper" style="justify-content: center; display: flex; align-items: center; gap: 10px; flex-direction: row; margin-top: 30px;">
                            <button class="btn btn-primary" style="padding: 6px 18px !important;">
                                <a href="{{ route('recipe.ingredients', $recipe->id) }}" style="color: white;">المكونات</a>
                            </button>
                            <button class="btn btn-warning" style="padding: 6px 18px !important;">
                                <a href="{{ route('recipe.steps', $recipe->id) }}" style="color: white;">
                                    الخطوات
                                </a>
                            </button>
                            <button class="btn btn-success" style="padding: 6px 18px !important;">
                                <a href="{{ route('recipe.facts', $recipe->id) }}" style="color: white;">
                                    الحقائق</a> </button>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>

</body>

</html>
