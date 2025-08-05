@extends('layouts.chef')
@section('content')

<style>
    .header-content,
    .container--btns {
        direction: rtl;
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

    button {
        border: 0px;
    }

    #name-chef {
        font-weight: 400;
        font-size: 13px;
    }

    .video-reels-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        overflow-x: scroll;
        /* This enables horizontal scrolling */
        overflow-y: hidden;
        scroll-snap-type: x mandatory;
        /* This helps with snapping to each video */
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        /* For smoother scrolling on iOS */

    }

    .video-reel-item {
        flex: 0 0 100%;
        /* Each item takes 100% of the container width */
        width: 100vw;
        height: 100vh;
        scroll-snap-align: center;
        /* Snaps the video to the center when scrolling stops */
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .video-reel {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .myVideo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .content {
        position: absolute;
        bottom: 0;
        top: 0;
        background: rgba(0, 0, 0, 0.3);
        color: #f1f1f1;
        width: 100%;
        height: 100%;
        padding: 20px;
        padding-bottom: 60px;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    #myBtn {
        width: 200px;
        font-size: 18px;
        padding: 10px;
        border: none;
        background: #000;
        color: #fff;
        cursor: pointer;
    }

    #myBtn:hover {
        background: #ddd;
        color: black;
    }

    .pause-icon {
        color: white;
        justify-content: end;
        display: flex;
        font-size: 24px;
        padding-bottom: 12px;
    }

    #container--btns {
        position: relative;
        bottom: unset;
        flex-direction: column;
        width: 100%;
        display: flex;
    }

</style>
<body>
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div class="dz-nav-floting">
            <header class="header py-2 mx-auto" style="background-color: transparent !important; position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                        <div class="info">
                            <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 7" data-swiper-slide-index="0" style="margin-left: 18px;">
                                <div class="dz-categories-bx" id="carts-chef" style="flex-direction: unset !important; gap: 10px;">
                                    <div class="icon-bx" style="margin-left: unset !important;">
                                        <a href="profileDisplayed.html">
                                            <img class="img-fluid" id="header-user-image" style="justify-content: flex-start; display: flex; text-align: center; border-radius: 50%; 
                                                margin: auto; width: 50px; height: 50px; display: flex; text-align: center;" 
                                                src="{{ asset('storage/' . ($challenge->user->chefProfile->official_image ?? 'default_profile.jpeg')) }}" alt>
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title">
                                            <a href="profileDisplayed.html" style="color: white;">
                                                الشيف / {{ $challenge->user->name }}
                                            </a>
                                        </h6>
                                        <h6 class="title">
                                            <a href="profileDisplayed.html"  style="color: white;">
                                                {{ $challenge->user->chefProfile->country }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mid-content"></div>
                    <div class="right-content d-flex align-items-center gap-4">
                        <a href="vs.html" class="back-btn" style="background-color: white;">
                            <i class="feather icon-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </header>

            <div class="video-reels-container">
                @foreach($responses as $index => $response)
                <div class="video-reel-item">
                    <video autoplay muted playsinline class="myVideo video-reel" data-index="{{ $index }}" data-user-id="{{ $response->user_id }}">
                        <source src="{{ asset('storage/' . $response->challenge_video_path) }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>

                    <div class="content">
                        <div id="container--btns">
                            <button class="myBtn" onclick="myFunctionHeart(this)" style="margin-bottom: 5px; background-color: transparent !important; padding: 0px; display: flex; flex-direction: column; align-items: end;">
                                <img src="{{ asset('/assets/images/hat.png') }}" alt="" style="width: 29px; height: 24px;">
                                <span class="response-counter" style="position: relative; right: 0px; padding-bottom: 0px; font-size: 14px; color: white;">{{ $index + 1 }}/{{ $totalResponses }}</span>
                            </button>
                            <a href="{{ route('challenge.image-vs', $response->id) }}" class="myBtn" style="margin-bottom: 5px; background-color: transparent !important; padding: 0px; display: flex; flex-direction: column; align-items: end;">
                                <i class="fa-solid fa-camera-retro pause-icon play-pause-icon" style="padding-bottom: 0px;"></i>
                                <span style="position: relative; right: -5px; padding-bottom: 1px; font-size: 12px;color: white;">الطبخة</span>
                            </a>
                            <button class="myBtn" onclick="myFunction(this)" style="background-color: transparent !important; padding: 0px;">
                                <i class="fa-solid fa-play pause-icon play-pause-icon"></i>
                            </button>

                            <button class="myBtn" onclick="myFunctionMute(this)" style="background-color: transparent !important; padding: 0px;">
                                <i class="fa-solid fa-volume-xmark pause-icon mute-icon" style="font-size: 20px;"></i>
                            </button>

                            <h1 style="color: white; font-size: 18px; text-align: right;">{{ $challenge->title }}</h1>

                            <div style="margin-bottom: 10px; direction: rtl;">
                                <div style="display: flex; gap: 10px; align-items: end;">
                                    {{-- Using $response->user for the profile image and name --}}
                                    <img class="user-profile-image" style="height: 50px; width: 50px; border-radius: 50%;" 
                                    src="{{ asset('storage/' . ($response->user->chefProfile->official_image ?? 'default_profile.jpeg')) }}" alt="">
                                    <div style="display: flex; flex-direction: column;">
                                        <p class="user-name" style="color: white; font-size: 14px; margin-bottom: 0px;">
                                            {{ $response->user->name ?? 'اسم الشيف' }}</p>
                                        <p class="user-name" style="color: white; font-size: 14px; margin-bottom: 0px;">
                                            {{ $response->user->chefProfile->country}}</p>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-bottom: 10px; direction: rtl;">
                                <div style="display: flex; gap: 10px; align-items: end;">
                                    <p style="background-color: var(--primary); padding: 5px; border-radius: 5px; color: white; font-size: 14px; margin-bottom: 0px;">
                                        {{ $challenge->challenge_type ?? 'users' == 'users' ? 'للمستخدمين' : 'للطهاة' }}
                                    </p>
                                </div>
                            </div>

                            <div class="price" style="flex-direction: column; align-items: end; justify-content: center; display: flex; color: white;">
                                <p style="font-size: 12px; margin-bottom: 0px; ">ثانية - دقيقة - ساعة - يوم</p>
                                <p class="countdown-timer" data-end-date="{{ $challenge->end_date }}" style="margin-bottom: 0px; font-size: 18px; color: rgb(255, 255, 255); font-weight: bold;">
                                    -- : -- : -- : --
                                </p>
                                <div style="margin-top: -5px; margin-bottom: 10px; width: fit-content; font-size: 12px; color: rgb(255, 255, 255); border-radius: 5px;">
                                    باقي علي نهاية التحدي
                                </div>
                            </div>

                            <ul class="dz-meta" style="direction: rtl; display: flex; gap: 15px; margin-bottom: 10px;">
                                <li class="dz-price" style="text-align: center; font-size: 14px;">
                                    <i class="fa-solid fa-clock"></i>  {{ \Carbon\Carbon::parse($response->created_at)->diffForHumans() }}
                                </li>
                                <li class="dz-price" style="text-align: center; font-size: 14px;">
                                    <i class="fa-solid fa-eye"></i> {{ $response->views ?? '0' }}
                                </li>
                            </ul>
    @php
    $firstResponse = $challenge->challengeResponses->first();
    @endphp


                            <div style="display: flex; gap: 1px;">
                                <a href="{{ route('c1he3f.challenge.review', $firstResponse->id) }}" class="myBtn" style="background-color: var(--primary); text-align: center; width: 100%; border-radius: 15px; height: 42px; text-align: center; align-items: center; justify-content: center; display: flex; color: white;">
                                    قيم الطبخة
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="menubar-area footer-fixed" style="background-color: transparent !important;">
                <div class="toolbar-inner menubar-nav">
                    <a href="index.html" class="nav-link">
                        <i class="fi fi-rr-home" style="color: white;"></i>
                    </a>
                    <a href="account.html" class="nav-link">
                        <i class="fa-solid fa-receipt" style="color: white;"></i>
                    </a>
                    <a href="add-recpie.html" class="nav-link">
                        <i class="fa-solid fa-shop" style="color: white;"></i>
                    </a>
                    <a href="add-snap.html" class="nav-link">
                        <i class="fa-regular fa-user" style="color: white;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    const videoReelsContainer = document.querySelector('.video-reels-container');
    const videos = document.querySelectorAll('.video-reel');
    const totalResponses = @json($totalResponses ?? 0);
    let currentVideoIndex = 0;
    let countdownInterval;

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function updateCountdown() {
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }

        const currentVideo = videos?.[currentVideoIndex];
        if (!currentVideo) {
            console.warn('No current video found to update countdown.');
            return;
        }

        const currentVideoContainer = currentVideo.closest('.video-reel-item');
        const countdownTimerElement = currentVideoContainer.querySelector('.countdown-timer');

        if (!countdownTimerElement) {
            console.warn('Countdown timer element not found for current video.');
            return;
        }

        const endDateStr = countdownTimerElement.dataset.endDate;
        if (!endDateStr) {
            countdownTimerElement.textContent = 'تاريخ الانتهاء غير محدد';
            return;
        }

        // إضافة وقت نهاية اليوم إذا لم يكن موجود
        let formattedEndDate = endDateStr;
        if (!endDateStr.includes('T') && !endDateStr.includes(' ')) {
            formattedEndDate = endDateStr + 'T23:59:59';
        }

        const endDate = new Date(formattedEndDate).getTime();
        if (isNaN(endDate)) {
            countdownTimerElement.textContent = 'تاريخ الانتهاء غير صالح';
            return;
        }

        const calculateAndDisplayTime = () => {
            const now = new Date().getTime();
            const distance = endDate-now;

            if (distance < 0) {
                countdownTimerElement.textContent = 'انتهى التحدي';
                clearInterval(countdownInterval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownTimerElement.textContent = `${days} : ${hours.toString().padStart(2, '0')}  : ${minutes.toString().padStart(2, '0')}  : ${seconds.toString().padStart(2, '0')} `;
        };

        calculateAndDisplayTime(); // عرض الوقت فوراً عند التحديث 
        countdownInterval = setInterval(calculateAndDisplayTime, 1000);
    }

    function updateHeaderInfo() {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) {
            console.error('No current video to update header info from.');
            return;
        }

        const currentVideoContainer = currentVideo.closest('.video-reel-item');
        const userNameElement = currentVideoContainer.querySelector('.user-name');
        const userImageElement = currentVideoContainer.querySelector('.user-profile-image');
        const userCountryElement = currentVideoContainer.querySelector('.user-country');

        const userName = userNameElement ? userNameElement.textContent : 'اسم المتحدي';
        const userImageSrc = userImageElement ? userImageElement.src : '{{ asset("assets/images/chef.jpeg") }}';
        const userCountry = userCountryElement ? userCountryElement.textContent : 'بلد المتحدي';

        // Update header elements
        const headerUserName = document.getElementById('header-user-name');
        const headerUserImage = document.getElementById('header-user-image');
        const headerUserCountry = document.getElementById('header-user-country');

        if (headerUserName) {
            headerUserName.textContent = userName;
        }
        if (headerUserImage) {
            headerUserImage.src = userImageSrc;
        }
        if (headerUserCountry) {
            headerUserCountry.textContent = userCountry;
        }

        const headerCounter = document.querySelector('.header-counter');
        if (headerCounter) {
            headerCounter.textContent = `${currentVideoIndex + 1}/${totalResponses}`;
        }
    }

    function playCurrentVideo() {
        console.log(`تشغيل الفيديو رقم: ${currentVideoIndex}`);
        videos.forEach((vid, index) => {
            const playPauseIcon = vid.parentElement.querySelector('.play-pause-icon');
            if (index === currentVideoIndex) {
                if (vid.readyState >= 2) {
                    vid.play().catch(err => console.error(`خطأ في تشغيل الفيديو ${index}:`, err));
                    if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause pause-icon play-pause-icon';
                } else {
                    vid.load();
                    setTimeout(() => vid.play().catch(err => console.error(`خطأ في تشغيل الفيديو ${index}:`, err)), 100);
                }
            } else {
                vid.pause();
                vid.currentTime = 0;
                if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-play pause-icon play-pause-icon';
            }
        });

        updateHeaderInfo();
        updateCountdown();
    }

    function handleScroll() {
        const scrollX = videoReelsContainer.scrollLeft;
        const viewportWidth = videoReelsContainer.clientWidth;
        const newIndex = Math.round(scrollX / viewportWidth);

        if (newIndex !== currentVideoIndex && newIndex >= 0 && newIndex < videos.length) {
            console.log(`السكرول وصل للفيديو رقم: ${newIndex}`);
            currentVideoIndex = newIndex;
            playCurrentVideo();
        }
    }

    function myFunctionHeart(buttonElement) {
        const heartIcon = buttonElement.querySelector('.heart-icon');
        if (heartIcon) {
            heartIcon.style.color = heartIcon.style.color === 'red' ? 'white' : 'red';
            console.log(`تغيير لون القلب للفيديو ${currentVideoIndex}`);
        } else {
            console.warn('No heart-icon found inside the button for myFunctionHeart.');
        }
    }

    function myFunctionMute(buttonElement) {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) {
            console.error('ما فيش فيديو حالي');
            return;
        }
        currentVideo.muted = !currentVideo.muted;
        const muteIcon = buttonElement.querySelector('.mute-icon');
        if (muteIcon) {
            muteIcon.className = `fa-solid fa-volume-${currentVideo.muted ? 'xmark' : 'high'} pause-icon mute-icon`;
        }
        console.log(`الفيديو ${currentVideoIndex} ${currentVideo.muted ? 'مكتوم' : 'مش مكتوم'}`);
    }

    function myFunction(buttonElement) {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) {
            console.error('ما فيش فيديو حالي');
            return;
        }
        const playPauseIcon = buttonElement.querySelector('.play-pause-icon');
        if (currentVideo.paused) {
            currentVideo.play().catch(err => console.error(`خطأ في تشغيل الفيديو ${currentVideoIndex}:`, err));
            if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause pause-icon play-pause-icon';
            console.log(`تشغيل الفيديو ${currentVideoIndex}`);
        } else {
            currentVideo.pause();
            if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-play pause-icon play-pause-icon';
            console.log(`إيقاف الفيديو ${currentVideoIndex}`);
        }
    }

    function preloadVideos() {
        videos.forEach((vid, index) => {
            vid.preload = 'auto';
            vid.load();
        });
    }

    function autoAdvanceVideo() {
        videos.forEach((vid, index) => {
            vid.onended = () => {
                console.log(`الفيديو ${index} خلّص`);
                const nextIndex = (currentVideoIndex + 1) % videos.length;
                videoReelsContainer.scrollTo({
                    left: nextIndex * videoReelsContainer.clientWidth
                    , behavior: 'smooth'
                });
            };
        });
    }

    // بدء التطبيق عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', () => {
        console.log("بدء تهيئة الفيديوهات...");
        preloadVideos();
        playCurrentVideo();
        autoAdvanceVideo();
        videoReelsContainer.addEventListener('scroll', debounce(handleScroll, 100));
    });

</script>


@endsection
