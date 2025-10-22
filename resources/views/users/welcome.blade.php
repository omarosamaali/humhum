@extends('layouts.user')

@section('title', 'هم هم | Hum Hum')

@section('content')
<div class="container">

    {{-- Start Cheifs Lens --}}
    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin: 0px 10px;">
            <a href="{{ route('users.profile.index') }}" style="text-align: center;">
                <span class="img-fluid icon">
                    😀
                </span>
                {{ __('messages.my_account') }}
            </a>
            <a href="{{ route('users.family.index') }}" style="text-align: center;">
                <span class="img-fluid icon">
                    👪
                </span>
                {{ __('messages.my_family') }}
            </a>
            <a href="{{ route('users.cooks.index') }}" style="text-align: center;">
                <span class="img-fluid icon">
                    👨‍🍳
                </span>
                {{ __('messages.chefs') }}
            </a>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin: 10px 10px;">
            <a href="{{ route('users.blocked.index') }}" style="text-align: center;">
                <span class="img-fluid icon">
                    ❌
                </span>
                {{ __('messages.blacklist') }}
            </a>
            <a href="{{ route('users.cook_table.index') }}" style="text-align: center;">
                <span class="img-fluid icon">
                    📋
                </span>
                {{ __('messages.cooking_schedule') }}
            </a>
            <a href="{{ route('users.notifications.index') }}" style="text-align: center;">
                <span class="img-fluid icon">
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

    {{-- Start Cheifs --}}
    <div class="swiper categories-swiper dz-swiper m-b20">
        <div class="title-bar mb-0"
            style="flex-direction: column; display: flex; align-items: center; justify-content: center;">
            <h5 class="title">
                <img style="width: 50px;" src="{{ asset('assets/images/user-logo/chef.gif') }}" alt="">
            </h5>
            <h5 class="title">اقتراح الطاهي</h5>
        </div>
        <ul class="featured-list">
            @if($dailyRecipe)
            <a href="{{ route('users.recipes.show', $dailyRecipe) }}">
                <li class="container-cart">
                    <div class="dz-card list">
                        <div class="dz-media" style="position: relative;">
                            <img src="{{ asset('storage/' . $dailyRecipe->dish_image) }}" alt="">
                        </div>
                        <div class="dz-content">
                            <div class="dz-head">
                                <h6 class="title">
                                    <span>{{ $dailyRecipe->title }}</span>
                                </h6>
                                <ul class="tag-list">
                                    @if($dailyRecipe->meal_type)
                                    @foreach(explode(',', $dailyRecipe->meal_type) as $type)
                                    <li><span>{{ $type }}</span></li>
                                    @endforeach
                                    @endif
                                </ul>
                                @forelse ($dailyRecipe->subCategories as $subCategory)
                                <span class="badge badge-info">{{ $subCategory->name_ar }}</span>
                                @empty
                                <span class="text-muted">لا توجد</span>
                                @endforelse
                                <ul class="tag-list" style="display: flex; gap: 10px;">
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-clock" style="color: var(--primary-color);"></i>
                                        {{ $dailyRecipe->prep_time ?? '5' }}
                                    </li>
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-eye" style="color: var(--primary-color);"></i>
                                        {{ $dailyRecipe->views ?? 0 }}
                                    </li>
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-heart" style="color: var(--primary-color);"></i>
                                        {{ $favorites_count }}
                                    </li>
                                </ul>
                                <div>
                                    <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                        class="tags">
                                        <img src="{{ $dailyRecipe->cuisine_flag ?? 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/800px-Flag_of_Egypt.svg.png' }}"
                                            style="border-radius: 50% !important; width: 30px; height: 30px;" alt="">
                                        {{ $dailyRecipe->cuisine ?? 'المطبخ المصري' }}
                                    </div>
                                    <div class="bookmark">
                                        <button style="border: 0; background-color: unset;"
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </a>
            @else
            <li>لا توجد وجبات متاحة</li>
            @endif
        </ul>
        {{-- <ul class="featured-list">
            <li class="container-cart">
                <div class="dz-card list">
                    <div class="dz-media" style="position: relative;">
                        <img src="assets/images/product/8.png" alt="">
                    </div>
                    <div class="dz-content">
                        <div class="dz-head">
                            <h6 class="title">
                                <a href="recpie-view.html">سلطة الاسكندراني</a>
                            </h6>
                            <ul class="tag-list">
                                <li><a href="javascript:void(0);">غداء</a></li>
                                <li><a href="javascript:void(0);">عشاء</a></li>
                            </ul>
                            <ul class="tag-list" style="display: flex; gap: 10px;">
                                <li class="dz-price" style="text-align: center; font-size: 14px;">
                                    <i class="fa-solid fa-clock" style="color: var(--primary-color);"></i>
                                    5 دقيقة
                                </li>
                                <li class="dz-price" style="text-align: center; font-size: 14px;">
                                    <i class="fa-solid fa-eye" style="color: var(--primary-color);"></i>
                                    366
                                </li>
                                <li class="dz-price" style="text-align: center; font-size: 14px;">
                                    <i class="fa-solid fa-heart" style="color: var(--primary-color);"></i>
                                    51
                                </li>
                            </ul>
                            <div>

                                <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                    class="tags">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/800px-Flag_of_Egypt.svg.png"
                                        style="border-radius: 50% !important; width: 30px; height: 30px;" alt="">
                                    المطبخ المصري
                                </div>
                                <div class="bookmark">
                                    <button style="border: 0px; background-color: unset;" onclick="openModal()"
                                        type="button">
                                        <label class="heart-switch">
                                            <input type="checkbox">
                                            <svg viewBox="0 0 33 23" fill="white">
                                                <path
                                                    d="M23.5,0.5 C28.4705627,0.5 32.5,4.52943725 32.5,9.5 C32.5,16.9484448 21.46672,22.5 16.5,22.5 C11.53328,22.5 0.5,16.9484448 0.5,9.5 C0.5,4.52952206 4.52943725,0.5 9.5,0.5 C12.3277083,0.5 14.8508336,1.80407476 16.5007741,3.84362242 C18.1491664,1.80407476 20.6722917,0.5 23.5,0.5 Z">
                                                </path>
                                            </svg>
                                        </label>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul> --}}
    </div>
    {{-- End Cheifs --}}

    {{-- Start Kitchens --}}
    <div class="categories-swiper m-b20">
        <div class="title-bar mb-3" style="display: flex; flex-direction: column; text-align: center;">
            <h5 class="title">
                <img style="width: 50px;" src="{{ asset('assets/images/user-logo/kitchen.gif') }}" alt="">
            </h5>
            <h5 class="title">المطابخ</h5>
        </div>
        <style>
            .swiper-slide {
                width: 200px !important;
            }
        </style>
        <div class="swiper kitchenSwiper">
            <div class="swiper-wrapper">
                @foreach($kitchens as $kitchen)
                <div class="swiper-slide">
                    <span>
                        <div class="dz-categories-bx" style="padding: 15px;">
                            <div class="icon-bx">
                                <img src="{{ asset('storage/' . $kitchen->image) }}"
                                    style="width: 50px; min-width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary-color);"
                                    alt="{{ $kitchen->name_ar }}">
                            </div>
                            <div class="dz-content">
                                <h6 class="title">
                                    <span style="width: 105px; display: block;">{{ $kitchen->name_ar }}</span>
                                </h6>
                                <span class="text-primary">
                                    {{ $kitchen->recipes_count ?? count($kitchen->recipes) }} وصفة
                                </span>
                            </div>
                        </div>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

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
    </script> {{-- End Kitchens --}}


    {{-- Start Cheifs --}}
    <div class="m-b20">
        <div class="title-bar mb-0"
            style="flex-direction: column; display: flex; align-items: center; justify-content: center;">
            <h5 class="title">
                <img style="width: 50px;" src="{{ asset('assets/images/user-logo/badge.gif') }}" alt="">
            </h5>
            <h5 class="title">أكثر تقييماً</h5>
        </div>

        <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 20px;">
            @foreach($topRecipes as $recipe)
            <a href="{{ route('users.recipes.show', $recipe) }}" style="position: relative; box-shadow: 0px 0px 3px 3px #ededed; border-radius: 15px; width: 33%;">
                <img src="{{ asset('storage/' . $recipe->dish_image) }}" alt="{{ $recipe->name }}"
                    style="width: 100%; height: 122px; border-radius: 15px 15px 0px 0px;">
                <img src="{{ asset('assets/images/user-logo/' . ($loop->index + 1) . '.png') }}" class="chef-logo"
                    alt="">
                <p style="text-align: center; font-size: 13px; padding-top: 3px;">
                    {{ $recipe->title }}
                </p>
            </a>
            @endforeach
        </div>
    </div>
    {{-- End Cheifs --}}

    <!-- Featured Beverages -->
    <div class="title-bar">
        <h5 class="title" style="margin-right: 0px !important;">أخر الإشعارات</h5>
        <a href="favorites.html">الجميع</a>
    </div>

    <ul class="featured-list">
        <li>
            <div class="dz-card list">
                <div class="dz-media">
                    <a href="product-detail.html"><img src="./assets/images/chef.jpeg" alt=""></a>
                </div>
                <div class="dz-content">
                    <div class="dz-head">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <h6 class="title"><a href="product-detail.html">كشري</a></h6>
                            <ul class="tag-list">
                                <li><a href="javascript:void(0);" style="color: green;">غداء</a></li>
                            </ul>
                        </div>
                        <ul class="tag-list">
                            <li><a href="javascript:void(0);">عمر أسامة</a></li>
                        </ul>
                        <div class="dz-status">
                            <span class="item-time">
                                <i class="feather icon-clock me-1"></i>
                                منذ 2د
                            </span>
                        </div>
                    </div>
                    <ul class="dz-meta">
                        <li class="dz-price flex-1" style="color:red;">لا يتوفر مكون</li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <div class="dz-card list">
                <div class="dz-media">
                    <a href="product-detail.html"><img src="./assets/images/chef.jpeg" alt=""></a>
                </div>
                <div class="dz-content">
                    <div class="dz-head">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <h6 class="title"><a href="product-detail.html">كشري</a></h6>
                            <ul class="tag-list">
                                <li><a href="javascript:void(0);" style="color: green;">غداء</a></li>
                            </ul>
                        </div>
                        <ul class="tag-list">
                            <li><a href="javascript:void(0);">عمر أسامة</a></li>
                        </ul>
                        <div class="dz-status">
                            <span class="item-time">
                                <i class="feather icon-clock me-1"></i>
                                منذ 2د
                            </span>
                        </div>
                    </div>
                    <ul class="dz-meta">
                        <li class="dz-price flex-1" style="color:rgb(38, 0, 255);">طلب جديد</li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <div class="dz-card list">
                <div class="dz-media">
                    <a href="product-detail.html"><img src="./assets/images/chef.jpeg" alt=""></a>
                </div>
                <div class="dz-content">
                    <div class="dz-head">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <h6 class="title"><a href="product-detail.html">كشري</a></h6>
                            <ul class="tag-list">
                                <li><a href="javascript:void(0);" style="color: green;">غداء</a></li>
                            </ul>
                        </div>
                        <ul class="tag-list">
                            <li><a href="javascript:void(0);">عمر أسامة</a></li>
                        </ul>
                        <div class="dz-status">
                            <span class="item-time">
                                <i class="feather icon-clock me-1"></i>
                                منذ 2د
                            </span>
                        </div>
                    </div>
                    <ul class="dz-meta">
                        <li class="dz-price flex-1" style="color:red;">لا يتوفر مكون</li>
                    </ul>
                </div>
            </div>
        </li>


    </ul>
    <!-- Featured Beverages -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    // منع التغيير المؤقت لحين الرد من السيرفر
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
        // إعادة التمكين بعد انتهاء الطلب
        checkbox.disabled = false;
    });
}
    </script>
    @endsection