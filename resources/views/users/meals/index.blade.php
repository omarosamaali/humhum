<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>وجباتي</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link rel="stylesheet" href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        .dz-custom-swiper .dz-tabs-swiper2 {
            padding-top: 33px !important;
            padding: 0px;
            margin: 30px 15px 0 !important;
        }

        .dz-custom-swiper .dz-tabs-swiper {
            position: fixed;
            margin-top: -45px;
            width: 100%;
            z-index: 99999999999999999999999999;
            background: white;
        }

        .swiper-backface-hidden .swiper-slide {
            margin: 1px !important;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-fixed">
            <div class="header-content">
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.جدول الطبخ') }}</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('users.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <style>
            .dz-custom-swiper .dz-tabs-swiper .swiper-slide {
                width: 108.333px !important;
            }

            .dz-custom-swiper .dz-tabs-swiper .swiper-slide .title {
                text-align: center;
                font-size: 12px !important;
            }
        </style>
        <main class="page-content space-top">
            <div class="container">
                <div class="dz-custom-swiper">
                    <div thumbsSlider="" class="swiper mySwiper dz-tabs-swiper">
                        <div class="swiper-wrapper" style="justify-content: space-around;">
                            <div class="swiper-slide">
                                <h5 class="title">
                                    <i class="fas fa-sun" style="color: #FFA500; margin-left: 8px;"></i>
                                    {{ __('messages.breakfast') }}
                                    @php
                                    $breakfastTime = null;
                                    if (!empty($breakfasts)) {
                                    $firstItem = $breakfasts[0];
                                    if (isset($firstItem['plan'])) {
                                    $plan = $firstItem['plan'];
                                    $meals = is_object($plan) ? $plan->meals : ($plan['meals'] ?? null);
                                    $mealSettings = is_string($meals) ? json_decode($meals, true) : $meals;

                                    if (isset($mealSettings['breakfast']['time'])) {
                                    $breakfastTime = $mealSettings['breakfast']['time'];
                                    }
                                    }
                                    }
                                    @endphp

                                    @if($breakfastTime)
                                    {{ \Carbon\Carbon::parse($breakfastTime)->format('h:i A') }}
                                    @endif
                                </h5>
                            </div>

                            <div class="swiper-slide">
                                <h5 class="title">
                                    <i class="fas fa-cloud-sun" style="color: #FFD700; margin-left: 8px;"></i>
                                    {{ __('messages.lunch') }}
                                    @php
                                    $lunchTime = null;
                                    if (!empty($lunches)) {
                                    $firstItem = $lunches[0];
                                    if (isset($firstItem['plan'])) {
                                    $plan = $firstItem['plan'];
                                    $meals = is_object($plan) ? $plan->meals : ($plan['meals'] ?? null);
                                    $mealSettings = is_string($meals) ? json_decode($meals, true) : $meals;

                                    if (isset($mealSettings['lunch']['time'])) {
                                    $lunchTime = $mealSettings['lunch']['time'];
                                    }
                                    }
                                    }
                                    @endphp

                                    @if($lunchTime)
                                    <i class="far fa-clock" style="margin-left: 5px;"></i>
                                    {{ \Carbon\Carbon::parse($lunchTime)->format('h:i A') }}
                                    @endif
                                </h5>
                            </div>

                            <div class="swiper-slide">
                                <h5 class="title">
                                    <i class="fas fa-moon" style="color: #4169E1; margin-left: 8px;"></i>
                                    {{ __('messages.dinner') }}
                                    @php
                                    $dinnerTime = null;
                                    if (!empty($dinners)) {
                                    $firstItem = $dinners[0];
                                    if (isset($firstItem['plan'])) {
                                    $plan = $firstItem['plan'];
                                    $meals = is_object($plan) ? $plan->meals : ($plan['meals'] ?? null);
                                    $mealSettings = is_string($meals) ? json_decode($meals, true) : $meals;

                                    if (isset($mealSettings['dinner']['time'])) {
                                    $dinnerTime = $mealSettings['dinner']['time'];
                                    }
                                    }
                                    }
                                    @endphp

                                    @if($dinnerTime)
                                    <i class="far fa-clock" style="margin-left: 5px;"></i>
                                    {{ \Carbon\Carbon::parse($dinnerTime)->format('h:i A') }}
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">
                            {{-- Breakfast --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach($breakfasts as $item)
                                    <li class="container-cart" style="margin-bottom: 20px;">
                                        @if($item['recipe_id'])
                                        <a href="{{ route('users.meals.view-meal', $item['detail_id']) }}">
                                            @endif
                                            <div class="dz-card list">
                                                <div class="dz-media" style="position: relative;">
                                                    <div class="container-date">
                                                        <span>{{
                                                            \Carbon\Carbon::parse($item['date'])->translatedFormat('l')
                                                            }}</span>
                                                        <span style="font-size: 38px; font-weight: bold;">
                                                            {{ \Carbon\Carbon::parse(time: $item['date'])->format('d')
                                                            }}
                                                        </span>
                                                        <span>{{
                                                            \Carbon\Carbon::parse($item['date'])->format('m/Y')
                                                            }}</span>
                                                    </div>
                                                </div>
                                                <div class="dz-content">
                                                    @if(isset($item['recipe']) && $item['recipe'])
                                                    <div class="position-relative"
                                                        style="display: flex; align-items: center;">
                                                        <span>{{ $item['recipe']->title }}</span>
                                                        @if($item['date'] < \Carbon\Carbon::now()->format('Y-m-d'))
                                                            <div
                                                                style="display: inline-flex; align-items: center; gap: 6px; margin-right: 10px; color: #991b1b; border: 1px solid #991b1b; font-size: 13px; background-color: #fde6e6e8; border-radius: 5px; padding: 4px 5px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    style="width: 18px; height: 18px; stroke-width: 2.5;"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span style="font-weight: 500;">منتهية</span>
                                                            </div>
                                                            @endif
                                                    </div>
                                                    @else
                                                    <span>Recipe not found</span>
                                                    @endif
                                                    <h6 class="title">
                                                        <i class="fa fa-users"></i>
                                                        {{ implode(' ، ', $item['family_names']) }}
                                                    </h6>
                                                    <span style="color: #1b1b1bbf;">
                                                        @if($item['notes'] != null)
                                                        {{ $item['notes'] }}
                                                        @else
                                                        @if(app()->getLocale() == 'ar')
                                                        لا يوجد ملاحظات
                                                        @else
                                                        No notes
                                                        @endif
                                                        @endif
                                                    </span>
                                                    <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥗
                                                    @if($item['salad_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍹
                                                    @if($item['drink_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥡
                                                    @if($item['appetizers_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥔
                                                    @if($item['healthy_food_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍲
                                                    @if($item['soup_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🧁
                                                    @if($item['desserts_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    <img src="{{ asset('assets/images/user-logo/saled.png') }}"
                                                        style="width: 30px; height: 27px;" />
                                                    @if($item['sauces_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍽️
                                                    @if($item['side_dish_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            @if($item['recipe_id'])
                                        </a>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- Lunch --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach($lunches as $item)
                                    <li class="container-cart" style="margin-bottom: 20px;">
                                        <a href="{{ route('users.meals.view-meal-lunch', $item['detail_id']) }}">
                                            <div class="dz-card list">
                                                <div class="dz-media" style="position: relative;">
                                                    <div class="container-date">
                                                        <span>{{
                                                            \Carbon\Carbon::parse($item['date'])->translatedFormat('l')
                                                            }}</span>
                                                        <span style="font-size: 38px; font-weight: bold;">
                                                            {{ \Carbon\Carbon::parse($item['date'])->format('d')
                                                            }}
                                                        </span>
                                                        <span>{{
                                                            \Carbon\Carbon::parse($item['date'])->format('m/Y')
                                                            }}</span>
                                                    </div>
                                                </div>
                                                <div class="dz-content">
                                                    @if(isset($item['recipe']) && $item['recipe'])
                                                    <div class="position-relative"
                                                        style="display: flex; align-items: center;">
                                                        <span>{{ $item['recipe']->title }}</span>
                                                        @if($item['date'] < \Carbon\Carbon::now()->format('Y-m-d'))
                                                            <div
                                                                style="display: inline-flex; align-items: center; gap: 6px; margin-right: 10px; color: #991b1b; border: 1px solid #991b1b; font-size: 13px; background-color: #fde6e6e8; border-radius: 5px; padding: 4px 5px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    style="width: 18px; height: 18px; stroke-width: 2.5;"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span style="font-weight: 500;">منتهية</span>
                                                            </div>
                                                            @endif
                                                    </div>
                                                    @else
                                                    <span>Recipe not found</span>
                                                    @endif
                                                    <h6 class="title">
                                                        <i class="fa fa-users"></i>
                                                        {{ implode(' ، ', $item['family_names']) }}
                                                    </h6>
                                                    <span style="color: #1b1b1bbf;">{{ $item['notes'] ??
                                                        __('messages.no_notes') }}</span>
                                                    <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥗
                                                    @if($item['salad_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍹
                                                    @if($item['drink_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥡
                                                    @if($item['appetizers_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥔
                                                    @if($item['healthy_food_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍲
                                                    @if($item['soup_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🧁
                                                    @if($item['desserts_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    <img src="{{ asset('assets/images/user-logo/saled.png') }}"
                                                        style="width: 30px; height: 27px;" />
                                                    @if($item['sauces_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍽️
                                                    @if($item['side_dish_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- Dinner --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach($dinners as $item)
                                    <li class="container-cart" style="margin-bottom: 20px;">
                                        <a href="{{ route('users.meals.view-meal-dinner', $item['detail_id']) }}">
                                            <div class="dz-card list">
                                                <div class="dz-media" style="position: relative;">
                                                    <div class="container-date">
                                                        <span>{{
                                                            \Carbon\Carbon::parse($item['date'])->translatedFormat('l')
                                                            }}</span>
                                                        <span style="font-size: 38px; font-weight: bold;">
                                                            {{ \Carbon\Carbon::parse($item['date'])->format('d')
                                                            }}
                                                        </span>
                                                        <span>{{
                                                            \Carbon\Carbon::parse($item['date'])->format('m/Y')
                                                            }}</span>
                                                    </div>
                                                </div>
                                                <div class="dz-content">
                                                    @if(isset($item['recipe']) && $item['recipe'])
                                                    <div class="position-relative"
                                                        style="display: flex; align-items: center;">
                                                        <span>{{ $item['recipe']->title }}</span>
                                                        @if($item['date'] < \Carbon\Carbon::now()->format('Y-m-d'))
                                                            <div
                                                                style="display: inline-flex; align-items: center; gap: 6px; margin-right: 10px; color: #991b1b; border: 1px solid #991b1b; font-size: 13px; background-color: #fde6e6e8; border-radius: 5px; padding: 4px 5px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    style="width: 18px; height: 18px; stroke-width: 2.5;"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span style="font-weight: 500;">منتهية</span>
                                                            </div>
                                                            @endif
                                                    </div>
                                                    @else
                                                    <span>Recipe not found</span>
                                                    @endif
                                                    <h6 class="title">
                                                        <i class="fa fa-users"></i>
                                                        {{ implode(' ، ', $item['family_names']) }}
                                                    </h6>
                                                    <span style="color: #1b1b1bbf;">{{ $item['notes'] ??
                                                        __('messages.no_notes') }}</span>
                                                    <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥗
                                                    @if($item['salad_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍹
                                                    @if($item['drink_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥡
                                                    @if($item['appetizers_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥔
                                                    @if($item['healthy_food_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍲
                                                    @if($item['soup_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🧁
                                                    @if($item['desserts_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    <img src="{{ asset('assets/images/user-logo/saled.png') }}"
                                                        style="width: 30px; height: 27px;" />
                                                    @if($item['sauces_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍽️
                                                    @if($item['side_dish_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                            </div>

                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        var tabsSwiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 10,
            watchSlidesProgress: true,
            slideToClickedSlide: true,
        });
    
        var contentSwiper = new Swiper(".mySwiper2", {
            autoHeight: true,
            thumbs: {
                swiper: tabsSwiper,
            },
        });
    </script>
</body>

</html>