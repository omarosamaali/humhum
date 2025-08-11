@extends('layouts.chef')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons@4.29.0/dist/feather.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Container for challenge categories */
    .dz-categories-bx {
        padding: 0 !important;
        height: 112px;
        margin-top: 40px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dz-categories-bx.bottom {
        background-color: transparent;
        height: 50px;
        margin-top: -40px;
    }

    /* Left section with red background */
    .challenge-left {
        height: 100%;
        padding: 10px 20px;
        border-top-right-radius: 15px;
        width: 50%;
        background-color: #a50707;
        color: white;
    }

    /* Right section with black background */
    .challenge-right {
        padding: 5px 20px;
        width: 50%;
        border-top-left-radius: 15px;
        background-color: black;
        color: white;
        z-index: 99999;
    }

    /* Bottom left section with black background */
    .challenge-bottom-right {
        padding: 10px 20px;
        height: 100%;
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom-left-radius: 15px;
        background-color: black;
        color: white;
        z-index: 99999;
    }

    /* Bottom right section with red background */
    .challenge-bottom-left {
        height: 100%;
        padding: 10px 20px;
        width: 50%;
        justify-content: center;
        display: flex;
        text-align: center;
        border-bottom-right-radius: 15px;
        background-color: #a50707;
        color: white;
    }

    /* Title styling for challenge count */
    .challenge-count {
        flex-direction: column;
        width: 100px;
        z-index: 999999;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        top: 9px;
        font-size: 15px;
        color: rgb(255, 255, 255);
        font-weight: normal;
    }

    .challenge-count p {
        font-size: 28px;
        margin-bottom: 0;
    }

    /* VS icon positioning */
    .vs-icon-container {
        left: 37%;
        position: absolute;
        top: -16px;
        z-index: 99999999999999;
    }

    /* Chef profile container */
    .chef-profile {
        display: flex;
        justify-content: center;
    }

    /* Chef rating badge */
    .dz-item-rating {
        border-radius: 50px;
        background-color: #e00000;
        font-size: 17px;
        overflow: hidden;
        line-height: unset;
        border: 2px solid #e00000;
    }

    .dz-item-rating img {
        width: 30px;
        height: 30px;
    }

    /* Chef name styling */
    .chef-name {
        font-size: 10px;
        color: gray;
        text-align: center;
        align-items: center;
        justify-content: center;
        display: flex;
        margin-right: 10px;
    }

    /* Challenge name styling */
    .challenge-name {
        align-items: center;
        justify-content: center;
        display: flex;
    }

    /* Countdown timer styling */
    .countdown {
        font-size: 15px;
        color: rgb(255, 255, 255);
        font-weight: bold;
        background-color: #000;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .countdown-container {
        margin-bottom: 14px;
        margin-top: 18px;
        text-align: center;
    }

    /* Challenge type styling */
    .challenge-type {
        align-items: center;
        justify-content: center;
        display: flex;
        font-size: 12px;
    }

    /* Bottom challenge text */
    .challenge-bottom-text {
        font-size: 17px !important;
        position: relative;
        top: 1px;
    }

    .challenge-bottom-text-container {
        font-size: 17px;
        position: relative;
        top: 9px;
    }

    /* Media card styling */
    .dz-media video,
    .dz-media img {
        height: 186px;
        object-fit: contain;
        border-radius: 20px;
        max-width: 100%;
        max-height: 100%;
    }

    .dz-media img.my-cooking {
        height: 142px;
        width: 283px;
    }

    /* Chef profile image in my-cookings */
    .chef-profile-img {
        width: 45px;
        height: 46px;
        border-radius: 50%;
        border: 2px solid var(--primary);
    }

    .vs-icon {
        max-width: 92px;
    }

    .plus-btn {
        position: fixed;
        bottom: 30px;
        text-align: center;
        left: 20px;
        z-index: 99999;
        background-color: black;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 37px;
    }

    .swiper-wrapper {
        height: fit-content !important;
    }

    .accept-challenge {
        background: var(--primary);
        color: white;
        border-radius: 12px;
        padding: 3px 15px;
        position: relative;
        top: 14px;
    }

</style>

<body style="direction: rtl;">
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
                <div class="right-content">
                    <a href="{{ route('challenge.all-vs') }}" class="accept-challenge" style="position: relative; top: 0px;">
                        تحدياتي
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">جميع التحديات</h4>
                </div>
                <div class="left-content">
                    <a href="{{ url('/') }}" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>

        <main class="page-content space-top">
            <div class="container">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="dz-custom-swiper">
                    <div thumbsSlider="" class="swiper mySwiper dz-tabs-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <h5 class="title">تحديات الطهاة</h5>
                            </div>
                            <div class="swiper-slide">
                                <h5 class="title">تحديات المستخدمين</h5>
                            </div>
                            <div class="swiper-slide">
                                <h5 class="title">طبخاتي</h5>
                            </div>
                        </div>
                    </div>

                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($chefChallenges as $challenge)
                                    <li>
                                        <div class="swiper-slide" style="position: relative;">
                                            <div class="dz-categories-bx">
                                                <a href="{{ route('challenge.show', $challenge->id) }}" class="challenge-left">

                                                    <p style="margin-bottom: 0px;"></p>
                                                    <h3 class="challenge-count">
                                                        <p>{{ $challenge->responses_count }}</p>
                                                        <span>قبل التحدي</span>
                                                    </h3>
                                                </a>
                                                <div>
                                                    <div class="vs-icon-container">
                                                        <img src="{{ asset('assets/images/vs-icon.png') }}" class="vs-icon" alt="">
                                                    </div>
                                                </div>
                                                <div class="challenge-right">
                                                    <div class="chef-profile">
                                                        <div class="dz-item-rating">
                                                            <img src="{{ asset('storage/' . $challenge->chef->chefProfile?->official_image) }}" alt="">
                                                        </div>
                                                        <h5 class="chef-name">{{ $challenge->chef->name }}</h5>
                                                    </div>
                                                    <span class="challenge-name">{{ $challenge->name }}</span>
                                                    <p class="countdown-container">
                                                        <sub id="countdown-timer" class="countdown">جاري الحساب...</sub>
                                                    </p>
                                                    <span class="challenge-type">
                                                        {{ $challenge->challenge_type == 'users' ? 'للمستخدمين' : 'للطهاة' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" style="position: relative;">
                                            <div class="dz-categories-bx bottom">
                                                <a href="{{ route('challenge.show', $challenge->id) }}" class="challenge-bottom-left">
                                                    <h3 class="challenge-count">
                                                        <p class="challenge-bottom-text">عرض التحديات</p>
                                                    </h3>
                                                </a>
                                                <div class="challenge-bottom-right">
                                                    <p class="challenge-bottom-text-container">
                                                        @if ($challenge->challengeResponses->isEmpty())
                                                        <a href="{{ route('challenge.add-vs', $challenge->id) }}" style="color: white;">إقبل التحدي</a>
                                                        @else
                                                        <span style="color: green; font-weight: bold;">تم قبول التحدي</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($chefChallenges->isEmpty())
                                    <li>
                                        <p>لا توجد تحديات طهاة حاليًا.</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($userChallenges as $challenge)
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-media">
                                                @php
                                                $fullPath = asset('storage/' . $challenge->announcement_path);
                                                $fileExtension = pathinfo($challenge->announcement_path, PATHINFO_EXTENSION);
                                                $isVideo = in_array($fileExtension, ['mp4', 'mov', 'ogg', 'webm', 'avi']);
                                                @endphp
                                                @if($isVideo)
                                                <video controls>
                                                    <source src="{{ Storage::url($challenge->announcement_path) }}" type="video/{{ $fileExtension }}">
                                                    متصفحك لا يدعم الفيديو.
                                                </video>
                                                @else
                                                <img src="{{ $fullPath }}" alt="صورة التحدي">
                                                @endif
                                            </div>
                                            <div class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <a href="{{ route('challenge.show', $challenge->id) }}">{{ $challenge->message }}</a>
                                                    </h6>
                                                    <ul class="tag-list">
                                                        <li>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($challenge->start_at)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($challenge->end_at)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-user" style="color: var(--primary);"></i>
                                                            {{ $challenge->challenge_type == 'users' ? 'للمستخدمين' : 'للطهاة' }}
                                                        </li>
                                                    </ul>
                                                    @if($challenge->recipe)
                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-utensils" style="color: var(--primary);"></i>
                                                            {{ $challenge->recipe?->title }}
                                                        </li>
                                                    </ul>
                                                    @endif
                                                    @if ($challenge->has_responded)
                                                    <span class="accepted-challenge-text">تم قبول التحدي</span>
                                                    @else
                                                    @if (Auth::check() && Auth::user()->id != $challenge->user_id)
                                                    @if ($challenge->challengeResponses->isEmpty())
                                                    @if ($challenge->challenge_type == 'users')
                                                    <a href="javascript:void(0);" class="dz-btn prevent-user-challenge-acceptance accept-challenge" data-challenge-id="{{ $challenge->id }}">
                                                        إقبل التحدي
                                                    </a>
                                                    @else
                                                    <a href="{{ route('challenge.add-vs', $challenge->id) }}" id="accept-challenge-{{ $challenge->id }}" class="accept-challenge dz-btn accept-challenge">
                                                        إقبل التحدي
                                                    </a>
                                                    @endif
                                                    @else
                                                    <a href="javascript:void(0);" class="dz-btn accepted-challenge-btn">
                                                        تم قبول التحدي
                                                    </a>
                                                    @endif
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($userChallenges->isEmpty())
                                    <li>
                                        <p>لا توجد تحديات مستخدمين حاليًا.</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($myCookings as $response)
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-media">
                                                @php
                                                $fullPath = asset('storage/' . $response->recipe_image_path);
                                                $fileExtension = pathinfo($response->image_path, PATHINFO_EXTENSION);
                                                $isVideo = in_array($fileExtension, ['mp4', 'mov', 'ogg', 'webm', 'avi']);
                                                @endphp
                                                @if($isVideo)
                                                <video controls>
                                                    <source src="{{ Storage::url($challenge->announcement_path) }}" type="video/{{ $fileExtension }}">
                                                    متصفحك لا يدعم الفيديو.
                                                </video>
                                                @else
                                                <img src="{{ $fullPath }}" alt="صورة الطبخ" class="my-cooking">
                                                @endif
                                            </div>
                                            <div class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <a href="#">{{ $response->message_to_chef }}</a>
                                                    </h6>
                                                    <ul class="tag-list">
                                                        <li>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($response->created_at)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-trophy" style="color: var(--primary);"></i>
                                                            {{ $response->challenge?->message }}
                                                        </li>
                                                    </ul>
                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px; display: flex; align-items: center; gap: 5px; margin-top: 5px;">
                                                            <img src="{{ asset('storage/' . $challenge->chefProfile->official_image) }}" alt="صورة الشيف" class="chef-profile-img">
                                                            الشيف / {{ $response->challenge?->chef?->name }}
                                                        </li>
                                                    </ul>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            document.querySelectorAll('.prevent-user-challenge-acceptance').forEach(button => {
                                                                button.addEventListener('click', function(event) {
                                                                    event.preventDefault();
                                                                    Swal.fire({
                                                                        icon: 'warning'
                                                                        , title: 'غير مسموح'
                                                                        , text: 'لا يمكنك الاشتراك في تحديات المستخدمين. من فضلك، اشترك في تحديات الطهاة.'
                                                                        , confirmButtonText: 'حسناً'
                                                                        , customClass: {
                                                                            confirmButton: 'dz-btn'
                                                                        , }
                                                                    , });
                                                                });
                                                            });
                                                        });

                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($myCookings->isEmpty())
                                    <li>
                                        <p>لم تشارك في أي طبخات بعد.</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <script>
                        const endDateStr = "{{ optional($challenge)->end_date ?? '' }}T23:59:59";
                        const endDate = endDateStr ? new Date(endDateStr).getTime() : null;

                        if (isNaN(endDate)) {
                            document.getElementById("countdown-timer").innerHTML = "تاريخ غير صحيح";
                            throw new Error("تاريخ الانتهاء غير صالح: " + endDateStr);
                        }

                        const countdownTimer = setInterval(() => {
                            const now = new Date().getTime();
                            const distance = endDate - now;

                            if (distance < 0) {
                                clearInterval(countdownTimer);
                                document.getElementById("countdown-timer").innerHTML = "انتهى الوقت";
                                return;
                            }

                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            document.getElementById("countdown-timer").innerHTML =
                                `${days} : ${hours.toString().padStart(2, '0')} : ${minutes.toString().padStart(2, '0')} : ${seconds.toString().padStart(2, '0')}`;
                        }, 1000);

                    </script>

                </div>

            </div>
        </main>
    </div>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10
            , slidesPerView: 3
            , freeMode: true
            , watchSlidesProgress: true
        , });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10
            , thumbs: {
                swiper: swiper
            , }
        });

    </script>
</body>
@endsection
