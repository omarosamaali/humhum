@extends('layouts.user')

@section('title', 'هم هم | Hum Hum')
<!-- Global CSS -->
{{--
<link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css"> --}}

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<style>
    .dz-card.list .dz-media img {
        border-radius: 0px !important;
        height: 114px !important;
    }

    :root {
        --primary: #660099 !important;
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

    .special-request {
        background: #660099;
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

    .container--cart {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1px;
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: space-between;
    }

    .bottom-container {
        flex-direction: row;
        display: flex;
        align-items: start;
        position: relative;
        /* top: 25px; */
    }

    .badge-text {
        font-size: 13px;
        position: absolute;
        top: -7px;
        right: -1px;
        background: red;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
    }
</style>

@section('content')
<div class="container">

    {{-- Start Cheifs Lens --}}
    <div>
        <div
            style="display: flex; justify-content: space-between; align-items: center; margin: 0px 0px; width: 100%; margin-bottom: 10px;">
            <a href="{{ route('users.profile.index') }}" style="text-align: center; width: 105px;">
                <span class="img-fluid icon">
                    😀
                </span>
                {{ __('messages.my_account') }}
            </a>
            <a href="{{ route('users.family.index') }}" style="text-align: center; width: 105px;">
                <span class="img-fluid icon">
                    👪
                </span>
                {{ __('messages.my_family') }}
            </a>
            <a href="{{ route('users.cooks.index') }}" style="text-align: center; width: 105px;">
                <span class="img-fluid icon">
                    👨‍🍳
                </span>
                {{ __('messages.chefs') }}
            </a>
        </div>

        <div style="display: flex
;
    justify-content: space-between;
    align-items: center;
    margin: 0px 0px;
    width: 100%;">
            <a href="{{ route('users.blocked.index') }}" style="text-align: center; width: 105px;">
                <span class="img-fluid icon">
                    ❌
                </span>
                {{ __('messages.blacklist') }}
            </a>
            <a href="{{ route('users.meals.table-cook') }}" style="text-align: center; width: 105px;">
                <span class="img-fluid icon">
                    📋
                </span>
                {{ __('messages.cooking_schedule') }}
            </a>
            <a href="{{ route('users.notifications.index') }}" style="text-align: center; width: 105px;">
                <span class="img-fluid icon" style="position: relative;">
                    @if($notifications)
                    <span class="badge-text">{{ $notifications->count() }}</span>
                    @endif
                    🔔
                </span>
                {{ __('messages.notifications') }}
            </a>
        </div>
    </div>
    {{-- End Cheifs Lens --}}

    {{-- Start Banner --}}
    {{-- @if($banner)
    <div class="search-box">
        <img style="width: 100%;" src="{{ asset('storage/' . $banner->image) }}" alt="">
    </div>
    @endif --}}
    {{-- End Banner --}}

    {{-- Start Cheifs --}}
    {{-- <div class="swiper categories-swiper dz-swiper m-b20">
        <div class="title-bar mb-0">
            <h5 class="title">الطهاه</h5>
        </div>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="dz-categories-bx">
                    <div class="icon-bx">
                        <a href="#">
                            <svg enable-background="new 0 0 48 48" height="24" viewBox="0 0 48 48" width="24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m30.1 47.5h-21.8c-.9 0-1.7-.7-1.9-1.6l-5.9-30.5c-.1-.6 0-1.2.4-1.6.4-.5.9-.7 1.5-.7h33.5c.6 0 1.1.3 1.5.7s.5 1 .4 1.6l-5.8 30.5c-.2.9-1 1.6-1.9 1.6zm-20.2-3.9h18.6l5.1-26.6h-28.8z"
                                    fill="#fff" />
                                <path
                                    d="m31.3 42.3c-.5 0-1.1-.2-1.5-.7-.7-.8-.6-2.1.2-2.8 3.9-3.4 6.1-5.5 9-8.2 1-.9 2-1.9 3.2-3 1.8-1.7 1.4-3.4.9-4.2-.9-1.7-3.3-3.1-6.5-2.4-1.1.2-2.1-.4-2.3-1.5s.4-2.1 1.5-2.3c4.5-1 8.9.9 10.8 4.5 1.6 3 .9 6.4-1.8 8.9-1.2 1.1-2.2 2.1-3.2 3-2.8 2.6-5.2 4.9-9.1 8.3-.3.2-.7.4-1.2.4z"
                                    fill="#fff" />
                                <path d="m9.3 10.1c-1.1 0-2-.9-2-2v-5.6c0-1.1.9-2 2-2s2 .9 2 2v5.7c-.1 1-.9 1.9-2 1.9z"
                                    fill="#fff" />
                                <path d="m18.1 10.1c-1.1 0-2-.9-2-2v-5.6c0-1.1.9-2 2-2s2 .9 2 2v5.7c-.1 1-.9 1.9-2 1.9z"
                                    fill="#fff" />
                                <path d="m26.9 10.1c-1.1 0-2-.9-2-2v-5.6c0-1.1.9-2 2-2s2 .9 2 2v5.7c-.1 1-.9 1.9-2 1.9z"
                                    fill="#fff" />
                            </svg>
                        </a>
                    </div>
                    <div class="dz-content">
                        <h6 class="title">
                            <div id="name-chef">
                                عمر أسامة
                            </div>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End Cheifs --}}

    {{-- Start Special request--}}
    <div class="container--cart">
        <a href="{{ route('users.special.create') }}" style="border-radius: 0px 15px 15px 0px;" class="special-request">
            {{ __('messages.special_requests') }}
        </a>
        <a href="{{ route('users.special.index') }}" style="border-radius: 15px 0px 0px 15px;" class="special-request">
            {{-- {{ __('messages.special_requests') }} --}}
            {{ __('messages.سجل الطلبات') }}
        </a>
    </div>
    {{-- End Special request --}}

    {{-- Start Cheifs --}}
    <div class="swiper categories-swiper dz-swiper m-b20">
        <div class="title-bar mb-0 chef-title-container">
            @auth
            @if ($recipe)
            <a href="{{ route('users.meals.show', $recipe->recipe->id) }}">
                <li class="container-cart mb-10">
                    <div class="dz-card list"
                        style="margin-bottom: 0px; flex-direction: column; border: 1px solid #ccc; box-shadow: 0px 0px 0px 2px #cccccc7a;">
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
            @endauth
            <h5 class="title">
                <img class="chef-icon" src="{{ asset('assets/images/user-logo/chef.gif') }}" alt="">
            </h5>
            <h5 class="title">{{ __('messages.chef_suggestion') }}</h5>
        </div>
        <ul class="featured-list">
            @if($dailyRecipe)
            <a href="{{ route('users.meals.show', $dailyRecipe) }}">
                <li class="container-cart" style="border: 1px solid #bababa;">
                    <div class="dz-card list" style="height: unset !important; margin-bottom: 0px;">
                        <div class="dz-media recipe-media">
                            <img src="{{ asset('storage/' . $dailyRecipe->dish_image) }}" style="
                                border-radius: 0px 22px 22px 0px !important;
                                height: 100% !important;
                                max-height: 148px !important;
                                max-width: 150px;" alt="">
                        </div>
                        <div class="dz-content">
                            <div class="dz-head cart-items">
                                <div>
                                    <h6 class="title" style="padding-left: 13px;">
                                        <span style="font-size: 13px;">{{ $dailyRecipe->title }}</span>
                                    </h6>
                                    <ul class="tag-list">
                                        @if($dailyRecipe->meal_type)
                                        @foreach(explode(',', $dailyRecipe->meal_type) as $type)
                                        <li><span>{{ __('messages.' . strtolower(trim($type))) }}</span></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    @forelse ($dailyRecipe->subCategories as $subCategory)
                                    <span class="badge badge-info">
                                        @if(app()->getLocale() == 'ar')
                                        {{ $subCategory->name_ar }}
                                        @else
                                        {{ $subCategory->name_en }}
                                        @endif
                                    </span>
                                    @empty
                                    <span class="text-muted">{{ __('messages.no_subcategories') }}</span>
                                    @endforelse
                                    <ul class="tag-list recipe-stats">
                                        <li class="dz-price stat-item">
                                            <i class="fa-solid fa-clock primary-icon"></i>
                                            {{ $dailyRecipe->prep_time ?? '5' }}
                                        </li>
                                        <li class="dz-price stat-item">
                                            <i class="fa-solid fa-eye primary-icon"></i>
                                            {{ $dailyRecipe->views ?? 0 }}
                                        </li>
                                        <li class="dz-price stat-item">
                                            <i class="fa-solid fa-heart primary-icon"></i>
                                            {{ $favorites_count }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="bottom-container">
                                    <div class="tags cuisine-tag">
                                        <img src="{{ $dailyRecipe->cuisine_flag ?? 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/800px-Flag_of_Egypt.svg.png' }}"
                                            class="cuisine-flag" style="border-radius: 50% !important;" alt="">
                                        {{ $dailyRecipe->cuisine ?? __('messages.egyptian_cuisine') }}
                                    </div>
                                    <div class="bookmark" style="bottom: 0px;">
                                        @auth
                                        <button class="favorite-btn"
                                            onclick="toggleFavorite({{ $dailyRecipe->id }}, this)" type="button">
                                            <label class="heart-switch">
                                                <input type="checkbox" {{
                                                    auth()->user()?->favorites->contains($dailyRecipe->id) ? 'checked' :
                                                ''
                                                }}>
                                                <svg viewBox="0 0 33 23" fill="white">
                                                    <path d="M23.5,0.5 C28.4705627,0.5 32.5,4.52943725 32.5,9.5 
                                                            C32.5,16.9484448 21.46672,22.5 16.5,22.5 
                                                            C11.53328,22.5 0.5,16.9484448 0.5,9.5 
                                                            C0.5,4.52952206 4.52943725,0.5 9.5,0.5 
                                                            C12.3277083,0.5 14.8508336,1.80407476 16.5007741,3.84362242 
                                                            C18.1491664,1.80407476 20.6722917,0.5 23.5,0.5 Z">
                                                    </path>
                                                </svg>
                                            </label>
                                        </button>
                                        @else
                                        <button class="favorite-btn" onclick="login()" type="button">
                                            <label class="heart-switch">
                                                <input type="checkbox" disabled>
                                                <svg viewBox="0 0 33 23" fill="white">
                                                    <path
                                                        d="M23.5,0.5 C28.4705627,0.5 32.5,4.52943725 32.5,9.5 
                                                                                                    C32.5,16.9484448 21.46672,22.5 16.5,22.5 
                                                                                                    C11.53328,22.5 0.5,16.9484448 0.5,9.5 
                                                                                                    C0.5,4.52952206 4.52943725,0.5 9.5,0.5 
                                                                                                    C12.3277083,0.5 14.8508336,1.80407476 16.5007741,3.84362242 
                                                                                                    C18.1491664,1.80407476 20.6722917,0.5 23.5,0.5 Z">
                                                    </path>
                                                </svg>
                                            </label>
                                        </button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </a>
            @else
            <li>{{ __('messages.no_meals_available') }}</li>
            @endif
        </ul>
    </div>

    <style>
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
    </style>
    {{-- End Cheifs --}}

    {{-- Start Kitchens --}}
    <div class="categories-swiper m-b20" style="height: 200px;">
        <div class="title-bar mb-3 kitchen-title">
            <h5 class="title">
                <img class="kitchen-icon" src="{{ asset('assets/images/user-logo/kitchen.gif') }}" alt="">
            </h5>
            <h5 class="title">{{ __('messages.kitchens') }}</h5>
        </div>

        <div class="swiper kitchenSwiper">
            <div class="swiper-wrapper">
                @foreach($kitchens as $kitchen)
                <div class="swiper-slide kitchen-slide">
                    <span>
                        <div class="dz-categories-bx kitchen-card">
                            <div class="icon-bx">
                                <img src="{{ asset('storage/' . $kitchen->image) }}" class="kitchen-image"
                                    alt="{{ $kitchen->name_ar }}">
                            </div>
                            <div class="dz-content">
                                <h6 class="title">
                                    <span class="kitchen-name">
                                        @if(app()->getLocale() == 'ar')
                                        {{ $kitchen->name_ar }}
                                        @else
                                        {{ $kitchen->name_en }}
                                        @endif
                                    </span>
                                </h6>
                                <span class="text-primary">
                                    {{ __('messages.recipes_count', ['count' => $kitchen->recipes_count ??
                                    count($kitchen->recipes)]) }}
                                </span>
                            </div>
                        </div>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="m-b20">
        <div class="title-bar mb-0 top-rated-title">
            <h5 class="title">
                <img class="badge-icon" src="{{ asset('assets/images/user-logo/badge.gif') }}" alt="">
            </h5>
            <h5 class="title">{{ __('messages.top_rated') }}</h5>
        </div>

        <div class="top-recipes-container">
            @foreach($topRecipes as $recipe)
            <a href="{{ route('users.meals.show', $recipe) }}" class="recipe-card">
                <img src="{{ asset('storage/' . $recipe->dish_image) }}" alt="{{ $recipe->name }}" class="recipe-image">
                <img src="{{ asset('assets/images/user-logo/' . ($loop->index + 1) . '.png') }}" class="chef-logo"
                    alt="">
                <p class="recipe-name">
                    {{ Str::limit($recipe->title, 20) }}
                    {{ substr($recipe->title, 0, 10) }}
                </p>
            </a>
            @endforeach
        </div>
    </div>

    <style>
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
    </style>

    {{-- JavaScript للتهيئة --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.kitchenSwiper', {
        slidesPerView: 1,
        spaceBetween: 10,
        rtl: true, // مهم للعربي
        loop: true,
        autoplay: {
            delay: 993000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            // موبايل
            320: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            // تابلت
            640: {
                slidesPerView: 3,
                spaceBetween: 15
            },
            // ديسكتوب صغير
            768: {
                slidesPerView: 4,
                spaceBetween: 20
            },
            // ديسكتوب كبير
            1024: {
                slidesPerView: 5,
                spaceBetween: 20
            }
        }
    });
});
    </script>
    {{-- End Kitchens --}}

    <!-- Featured Beverages -->
    {{-- <div class="title-bar">
        <h5 class="title notifications-title">{{ __('messages.latest_notifications') }}</h5>
        <a href="{{ route('users.notifications.index') }}">{{ __('messages.all') }}</a>
    </div>

    <ul class="featured-list">
        @foreach ($latest_recipes as $recipe)
        <li style="height: 115px; margin-bottom: 16px;">
            <div class="dz-card list"
                style="margin-bottom: 20px; box-shadow: 0px 0px 7px 0px #ccc; padding-left: 11px; border: 1px solid #ccc;">
                <div class="dz-media">
                    <a href="{{ route('users.meals.show', $recipe) }}">
                        <img src="{{ asset('storage/' . $recipe->dish_image) }}"
                            style="border-radius: 0px 10px 10px 0px; width: 114px;" alt="">
                    </a>
                </div>
                <div class="dz-content">
                    <div class="dz-head">
                        <div class="notification-header">
                            <h6 class="title">{{ $recipe->title }}</h6>
                            <ul class="tag-list">
                                <li>
                                    @if(app()->getLocale() == 'ar')
                                    {{ $recipe->mainCategories->name_ar }}
                                    @else
                                    {{ $recipe->mainCategories->name_en }}
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <ul class="tag-list">
                            @auth
                            <li>{{ $recipe?->user?->name }}</li>
                            @endauth
                        </ul>
                        <div class="dz-status">
                            <span class="item-time">
                                <i class="feather icon-clock me-1"></i>
                                {{ $recipe->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul> --}}

    <style>
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
    </style>

    <!-- Featured Beverages -->

    {!! $swalScript !!}

    <script>
        function openModal(){
        Swal.fire({
        title: "رائع",
        text: "تم التحديث بنجاح",
        icon: "success"
        });
    }
    function toggleFavorite(recipeId, buttonElement) {
    const checkbox = buttonElement.querySelector('input[type="checkbox"]');
    checkbox.disabled = true;

    fetch('{{ route('favorites.toggle') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ recipe_id: recipeId })
    })
    .then(response => response.json())
    .then(data => {
        // لو تم الإضافة أو الإزالة
        if (data.status === 'added') {
            checkbox.checked = true;
            Swal.fire({
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            });
        } else if (data.status === 'removed') {
            checkbox.checked = false;
            Swal.fire({
                icon: 'info',
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: data.message,
                showConfirmButton: true
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'حدث خطأ أثناء العملية',
            text: error,
        });
    })
    .finally(() => {
        checkbox.disabled = false;
    });
}

 function login() {
    window.location.href = "{{ route('users.auth.login') }}";
 }
 if (window.OneSignal) {
OneSignal.push(["getUserId", function(playerId) {
if (playerId) {
// إرسال مباشر للسيرفر (بدون CSRF لأن التطبيق موثوق)
fetch('https://humhum.food/save-onesignal-id', {
method: 'POST',
headers: { 'Content-Type': 'application/json' },
body: JSON.stringify({ player_id: playerId })
});
}
}]);
}
    </script>
    @endsection
@if(auth()->check() || session('is_family_logged_in') || session('is_cook_logged_in'))
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "{{ env('ONESIGNAL_APP_ID') }}",
            allowLocalhostAsSecureOrigin: true,
            notifyButton: { enable: false },
            autoResubscribe: true,
            persistNotification: false,
            // الأهم: خلّي OneSignal يشتغل حتى في WebView
            serviceWorkerParam: { scope: '/' },
            serviceWorkerPath: 'OneSignalSDKWorker.js'
        });

        // ده اللي هيشتغل في Natively / WebView
        OneSignal.on('subscriptionChange', function(isSubscribed) {
            console.log('OneSignal subscription changed:', isSubscribed);
            if (isSubscribed) {
                sendPlayerIdToServer();
            }
        });

        // وده عشان لو كان مشترك من قبل
        OneSignal.isPushNotificationsEnabled(function(isEnabled) {
            if (isEnabled) {
                sendPlayerIdToServer();
            }
        });

        function sendPlayerIdToServer() {
            OneSignal.getExternalUserId() || OneSignal.getUserId(function(playerId) {
                if (playerId) {
                    console.log('OneSignal Player ID:', playerId);
                    fetch('/save-onesignal-id', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ player_id: playerId })
                    }).then(r => r.json()).then(data => {
                        console.log('Player ID saved to server:', playerId);
                    });
                }
            });
        }

        // لو التطبيق (Natively) بعت الـ ID بنفسه (أحسن طريقة)
        window.addEventListener('message', function(e) {
            try {
                var data = typeof e.data === 'string' ? JSON.parse(e.data) : e.data;
                if (data.type === 'onesignal_player_id' && data.playerId) {
                    console.log('Player ID from native app:', data.playerId);
                    fetch('/save-onesignal-id', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ player_id: data.playerId })
                    });
                }
            } catch(err) {}
        });
    });
</script>
@endif