<html lang="en" dir="rtl">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<head>

    <!-- Title -->
    <title>هم هم | Hum Hum</title>

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
            --primary-color: #29A500 !important;
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
            --fill-active: #29A500;
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
                stroke: #29A500;
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
                    --stroke: #29A500;
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

        .dz-card.list .dz-media img {
            border-radius: 0px !important;
            height: 114px !important;
        }

        :root {
            --primary: #29A500 !important;
        }

        .btn:hover {
            background-color: #4a006e !important;
            border-color: #4a006e !important;
        }

        .dz-card.list .dz-media {
            max-width: 100% !important;
        }

        .recpie-name {
            text-align: center;
            background: black;
            color: white;
            border-radius: 15px 15px 0px 0px;
            padding: 8px;
            margin-bottom: 0px;
        }

        .dz-card.list .dz-media img {
            border-radius: 0px !important;
            height: 114px;
        }

        ::selection {
            background: var(--primary-color) !important;
        }

        .chef-title-container {
            flex-direction: column;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chef-icon {
            width: 50px;
        }

        .recipe-media {
            position: relative;
        }

        .recipe-stats {
            display: flex;
            gap: 10px;
        }

        .stat-item {
            text-align: center;
            font-size: 14px;
        }

        .primary-icon {
            color: var(--primary-color);
        }

        .cuisine-tag {
            display: flex;
            gap: 10px;
            font-size: 13px;
            align-items: center;
        }

        .cuisine-flag {
            border-radius: 50% !important;
            width: 30px;
            height: 30px;
        }

        .favorite-btn {
            border: 0;
            background-color: unset;
        }

        .kitchen-title,
        .top-rated-title {
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .kitchen-icon,
        .badge-icon {
            width: 50px;
        }

        .kitchen-slide {
            width: 200px !important;
        }

        .kitchen-card {
            padding: 15px;
        }

        .kitchen-image {
            width: 50px;
            min-width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        .kitchen-name {
            width: 105px;
            display: block;
        }

        .top-rated-title {
            flex-direction: column;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-recipes-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .recipe-card {
            position: relative;
            box-shadow: 0px 0px 3px 3px #ededed;
            border-radius: 15px;
            width: 33%;
        }

        .recipe-image {
            width: 100%;
            height: 122px;
            border-radius: 15px 15px 0px 0px;
        }

        .recipe-name {
            text-align: center;
            font-size: 13px;
            padding: 5px 0px;
        }

        .notifications-title {
            margin-right: 0px !important;
        }

        .notification-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .lunch-tag {
            color: green;
        }

        .status-unavailable {
            color: red;
        }

        .status-new {
            color: rgb(38, 0, 255);
        }

        .container--cart {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1px;
        }

        .special-request {
            background: #29A500;
            color: white;
            width: 100%;
            text-align: center;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-top: 12px;
        }

        .button-special-request {
            flex: 1;
            padding: 15px;
            text-align: center;
            background: linear-gradient(135deg, #29A500 0%, #3dd105 100%);
            color: white;
            text-decoration: none;
            font-weight: bold;
            align-items: center;
            justify-content: center;
            display: flex;
            font-size: 21px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div>
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin: 0px 0px; width: 100%; margin-bottom: 10px;">
                <a href="{{ route('families.profile.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        😀
                    </span>
                    {{ __('messages.my_account') }}
                </a>
                <a href="{{ route('families.family.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        👪
                    </span>
                    {{ __('messages.my_family') }}
                </a>
                <a href="{{ route('families.cooks.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        👨‍🍳
                    </span>
                    {{ __('messages.chefs') }}
                </a>
            </div>

            <div
                style="display: flex; justify-content: space-between; align-items: center; margin: 0px 0px; width: 100%;">
                <a href="{{ route('families.blocked.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        ❌
                    </span>
                    {{ __('messages.blacklist') }}
                </a>
                <a href="{{ route('families.meals.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        📋
                    </span>
                    {{ __('messages.cooking_schedule') }}
                </a>
                <a href="{{ route('families.notifications.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        🔔
                    </span>
                    {{ __('messages.notifications') }}
                </a>
            </div>
        </div>
        
        <div class="container--cart">
            <a href="{{ route('families.special.create') }}" style="border-radius: 0px 15px 15px 0px;"
                class="special-request">
                {{ __('messages.special_requests') }}
            </a>
            <a href="{{ route('families.special.index') }}" style="border-radius: 15px 0px 0px 15px;"
                class="special-request">
                {{-- {{ __('messages.special_requests') }} --}}
                سجل الطلبات
            </a>
        </div>
        <div class="swiper categories-swiper dz-swiper m-b20" style="height: 170px !important;">
            <div class="title-bar mb-0 chef-title-container">
                {{-- @auth --}}
                @if ($recipe)
                <a href="{{ route('families.meals.show-meal', $recipe->recipe->id) }}">
                    <li class="container-cart">
                        <div class="dz-card list"
                            style="flex-direction: column; border: 1px solid #ccc; box-shadow: 0px 0px 0px 2px #cccccc7a;">
                            <p class="recpie-name">
                                {{ __('messages.next_meal_is') }}
                            </p>
                            <div class="dz-media"
                                style="position: relative; display: flex; align-items: center; gap: 20px;">
                                <img src="assets/images/background.png"
                                    style="width: 150px; border-bottom-right-radius: 15px !important;" alt="">
                                <div class="dz-head">
                                    <h6 class="title">
                                        <span>{{ $recipe->recipe->title }}</span>
                                    </h6>
                                    @forelse ($recipe->recipe->subCategories as $subCategory)
                                    <span class="badge badge-info">{{ $subCategory?->recipe?->name_ar
                                        }}</span>
                                    @empty
                                    <span class="text-muted">{{ __('messages.none') }}</span>
                                    @endforelse
                                    <ul class="tag-list" style="display: flex; gap: 10px;">
                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                            <i class="fa-solid fa-clock" style="color: var(--primary-color);"></i>
                                            {{ $recipe->recipe->preparation_time }}
                                        </li>
                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                            <i class="fa-solid fa-eye" style="color: var(--primary-color);"></i>
                                            {{ $recipe->recipe->views ?? 0 }}
                                        </li>
                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                            <i class="fa-solid fa-heart" style="color: var(--primary-color);"></i>
                                            {{ $recipe->recipe->favorites_count ?? 0 }}
                                        </li>
                                    </ul>
                                    <div>
                                        <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                            class="tags">
                                            <img src="{{ asset('storage/' . $recipe->recipe->kitchen->image) }}"
                                                style="border-radius: 50% !important; width: 30px !important; height: 30px !important;"
                                                alt="">
                                            {{ trans_field($recipe->recipe->kitchen, 'name') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </a>
                @else
                <p style="text-align: center; font-size: 21px;">{{ __('messages.no_plans') }}</p>
                @endif
                {{-- @endauth --}}
            </div>
        </div>
    </div>
    <div style="display: flex; width: 100%; height: 35%;">
        <a href="{{ route('families.meals.show', $recipe->id) }}" class="button-special-request">
            طلب جديد
        </a>
        <a href="{{ route('families.meals.index') }}" class="button-special-request">
            جدول الطبخ
        </a>
    </div>
</body>

</html>