<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Title -->
    <title>
        هم هم سناب
    </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .cook-btn {
            background-color: #660099a8;
            text-align: center;
            width: 100%;
            border-radius: 15px;
            background-color: #660099a8;
            text-align: center;
            width: 100%;
            border-radius: 15px;
            height: 42px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
        }

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
            /* لازم تبقى flex عشان السكرول الأفقي */
            overflow-x: scroll;
            overflow-y: hidden;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            /* تحسين السكرول على الموبايل */
        }

        .video-reel-item {
            flex: 0 0 100%;
            /* كل عنصر ياخد 100% من عرض الكونتينر */
            width: 100vw;
            height: 100vh;
            scroll-snap-align: center;
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

        /* إزالة الـ ID المتكرر من الفيديو نفسه */
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
            /* Changed from bottom: 0; for full overlay */
            background: rgba(0, 0, 0, 0.3);
            color: #f1f1f1;
            width: 100%;
            height: 100%;
            padding: 20px;
            padding-bottom: 60px;
            z-index: 1;
            /* Ensure content is above video */
            display: flex;
            /* Added for proper alignment of buttons */
            flex-direction: column;
            /* Added for proper alignment of buttons */
            justify-content: flex-end;
            /* Pushes content to the bottom */
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
            justify-content: start;
            display: flex;
            font-size: 24px;
            padding-bottom: 30px;
        }

        #container--btns {
            position: relative;
            /* Changed to relative */
            bottom: unset;
            /* Removed bottom positioning */
            flex-direction: column;
            width: 100%;
            display: flex;
        }

    </style>
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

        <div class="dz-nav-floting">
            <header class="header py-2 mx-auto" style="background-color: transparent !important; position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                        <div class="info">
                            <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 7" data-swiper-slide-index="0" style="margin-left: 18px;">
                                <div class="dz-categories-bx" id="carts-chef" style="flex-direction: unset !important; gap: 10px;">
                                    <div class="icon-bx" style="margin-left: unset !important;">
                                        <a href="profileDisplayed.html">
                                            <img class="img-fluid" style="justify-content: flex-start; display: flex; text-align: center; border-radius: 50%; margin: auto; width: 50px; height: 50px; display: flex; text-align: center;" src="{{ asset('storage/' . Auth::user()->chefProfile->official_image) }}" alt>
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="profileDisplayed.html" id="name-chef" style="color: white;">
                                                {{ Auth::user()->name }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mid-content">

                    </div>
                    <div class="right-content d-flex align-items-center gap-4">
                        <div class="left-content">
                            <a href="javascript:void(0);" class="back-btn" style="background-color: white;">
                                <i class="feather icon-arrow-left"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </header>
            <div class="video-reels-container">

                <div class="video-reel-item">
                    <video autoplay muted class="myVideo video-reel" data-index="0">
                        <source src="{{ Storage::url($snap->video_path) }}" type="video/mp4">

                        Your browser does not support HTML5 video.
                    </video>
                    <div class="content">
                        <div id="container--btns">
                            <button class="myBtn" onclick="myFunctionHeart(this)" style="margin-right: 0px; margin-left: auto; width: min-content; margin-bottom: 20px; background-color: transparent !important; padding: 0px; display: flex; flex-direction: column; align-items: end;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="pause-icon" style="position: relative; right: -3px; bottom: -24px; height: 74px; width: 30px; padding-bottom: 5px;" width="800px" height="800px" viewBox="0 0 24 24" fill="white">
                                    <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#fffff"></path>
                                    <path d="M5 18H19" stroke="#fffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span style="position: relative; right: -14px; padding-bottom: 0px; font-size: 14px; color: white;">0</span>
                            </button>

                            <button class="myBtn" style="margin-right: 0px;
    margin-left: auto; width: min-content;  margin-bottom: 20px; background-color: transparent !important; padding: 0px; 
    display: flex; flex-direction: column; align-items: center;">
                                <i class="fa-solid fa-heart pause-icon heart-icon" style="padding-bottom: 0px;"></i>
                                <span style="position: relative; padding-bottom: 0px; font-size: 14px; color: white;">
                                    {{ $snap->likes_count ?? 0 }}
                                </span>
                            </button>
                            <button class="myBtn" onclick="myFunction(this)" style="background-color: transparent !important; padding: 0px;">
                                <i class="fa-solid fa-play pause-icon play-pause-icon"></i>
                            </button>
                            <button class="myBtn" onclick="myFunctionMute(this)" style="background-color: transparent !important; padding: 0px;"><i class="fa-solid fa-volume-xmark pause-icon mute-icon" style="font-size: 20px;"></i></button>
                            <h1 style="color: white; font-size: 18px; text-align: right;">
                                {{ $snap->name }}
                            </h1>
                            <div style="margin-bottom: 10px; direction: rtl;">
                                <div style="display: flex; gap: 10px; align-items: end;">
                                    <img style="height: 50px; width: 50px; border-radius: 50%;" src="{{ Storage::url($snap->kitchen->image) }}" alt="">
                                    <p style="color: white; font-size: 14px; margin-bottom: 0px;">
                                        {{ $snap->kitchen->name_ar }}
                                    </p>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px; direction: rtl;">
                                <div style="display: flex; gap: 10px; align-items: end;">

                                    <p style="background-color: var(--primary); padding: 5px; border-radius: 5px; color: white; font-size: 14px; margin-bottom: 0px;">
                                        {{ $snap->mainCategory->name_ar }}

                                    </p>
                                    <p style="background-color: rgb(0, 102, 255); padding: 5px; border-radius: 5px; color: white; font-size: 14px; margin-bottom: 0px;">
                                        @for ($i = 0; $i < $snap->subCategories->count(); $i++) {{ $snap->subCategories[$i]->name_ar }}
                                            @if ($i + 1 != $snap->subCategories->count()) , @endif
                                            @endfor
                                    </p>

                                </div>
                            </div>
                            <ul class="dz-meta" style="direction: rtl; display: flex; gap: 15px; margin-bottom: 10px;">
                                <li class="dz-price" style="text-align: center; font-size: 14px;"> <i class="fa-solid fa-clock"></i>
                                    {{ $snap->created_at->diffForHumans() ?? '5 دقيقة' }}
                                </li>
                                <li class="dz-price" style="text-align: center; font-size: 14px;"> <i class="fa-solid fa-eye"></i>
                                    {{ $snap->views ?? 0 }}</li>
                            </ul>
                            @if($snap->recipe)
                            <div style="display: flex; gap: 1px; ">
                                <a href="{{ route('c1he3f.recpies.showChefRecipes', $snap->recipe_id) }}" style="background-color: var(--primary)" class="myBtn cook-btn">إطبخ الوصفة</a>







                            </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
            <script>
                const videoReelsContainer = document.querySelector('.video-reels-container');
                const videos = document.querySelectorAll('.video-reel');
                let currentVideoIndex = 0;

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
                }

                function handleScroll() {
                    const scrollX = videoReelsContainer.scrollLeft;
                    const viewportWidth = videoReelsContainer.clientWidth;
                    const newIndex = Math.round(scrollX / viewportWidth);
                    if (newIndex !== currentVideoIndex) {
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
                    muteIcon.className = `fa-solid fa-volume-${currentVideo.muted ? 'xmark' : 'high'} pause-icon mute-icon`;
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
                        playPauseIcon.className = 'fa-solid fa-pause pause-icon play-pause-icon';
                        console.log(`تشغيل الفيديو ${currentVideoIndex}`);
                    } else {
                        currentVideo.pause();
                        playPauseIcon.className = 'fa-solid fa-play pause-icon play-pause-icon';
                        console.log(`إيقاف الفيديو ${currentVideoIndex}`);
                    }
                }

                function preloadVideos() {
                    videos.forEach((vid, index) => {
                        vid.preload = 'auto';
                        vid.load();
                        const source = vid.querySelector('source').src;
                        fetch(source, {
                            method: 'HEAD'
                        }).then(() => {
                            console.log(`تحميل مسبق للفيديو ${index}: ${source}`);
                        }).catch(err => console.error(`خطأ في التحميل المسبق للفيديو ${index}:`, err));
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
                            currentVideoIndex = nextIndex;
                            playCurrentVideo();
                        };
                    });
                }

                document.addEventListener('DOMContentLoaded', () => {
                    console.log("بدء تهيئة الفيديوهات...");
                    preloadVideos();
                    playCurrentVideo();
                    autoAdvanceVideo();
                    videoReelsContainer.addEventListener('scroll', debounce(handleScroll, 100));
                });

            </script>
            <div class="menubar-area footer-fixed">
                @php
                $user = Auth::user();
                $chefProfile = $user->chefProfile; // Assuming chefProfile is loaded or not null

                $isProfileComplete = false;
                // Only check for profile completeness if the user is a chef
                if ($user && $user->role === 'طاه' && $chefProfile) {
                $isOfficialImageComplete = !empty($chefProfile->official_image);
                $isContractTypeComplete = !empty($chefProfile->contract_type);
                $isBioComplete = !empty($chefProfile->bio);
                $isContractSigned = !empty($user->contract_signed_at); // This is from the user table

                // If all conditions are true
                if ($isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned) {
                $isProfileComplete = true;
                }
                }
                @endphp

                <div class="toolbar-inner menubar-nav" style="direction: rtl;">
                    {{-- رابط الصفحة الرئيسية (عادةً بيكون متاح دايماً) --}}
                    <a href="{{ route('c1he3f.index') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <i class="fi fi-rr-home"></i>
                    </a>

                    <a href="{{ route('c1he3f.coming-soon') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <i class="fa fa-coins"></i>
                    </a>

                    {{-- رابط إضافة وصفة - ده اللي غالباً عايز تقفله --}}
                    {{-- هنستخدم شرط Blade @if/@else أو نعدل الـ class و الـ onclick --}}
                    @if ($isProfileComplete)
                    <a href="{{ route('c1he3f.recpies.add-recpie') }}" class="nav-link" style="color: e00000;">
                        <svg style="color: #e00000;" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="#e00000">
                            <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#e00000" />
                            <path d="M5 18H19" stroke="#e00000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @else
                    {{-- نسخة غير مفعلة من الرابط عند عدم اكتمال البروفايل --}}
                    <a href="#" class="nav-link disabled" onclick="alert('من فضلك، أكمل بيانات ملفك الشخصي أولاً.'); return false;">
                        <svg style="color: #e00000;" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="#e00000">
                            <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#e00000" />
                            <path d="M5 18H19" stroke="#e00000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @endif

                    {{-- رابط إضافة سناب - يمكن التحكم فيه --}}
                    {{-- لو عايز تقفله، ممكن تضيف شرط هنا --}}
                    <a href="{{ route('c1he3f.snaps.add-snap') }}" class="nav-link {{ !$isProfileComplete ? 'disabled' : '' }}" {{ !$isProfileComplete ? 'onclick="return false;"' : '' }}>
                        <svg fill="#e00000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#e00000" d="M48 48l88 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L32 0C14.3 0 0 14.3 0 32L0 136c0 13.3 10.7 24 24 24s24-10.7 24-24l0-88zM175.8 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-26.5 32C119.9 256 96 279.9 96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0zm368 80c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6l56.1 0zm-89.4 0c-8.6-24.3-29.9-42.6-55.9-47c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24zM464 224a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-80-32a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM504 48l88 0 0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-104c0-17.7-14.3-32-32-32L504 0c-13.3 0-24 10.7-24 24s10.7 24 24 24zM48 464l0-88c0-13.3-10.7-24-24-24s-24 10.7-24 24L0 480c0 17.7 14.3 32 32 32l104 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-88 0zm456 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l104 0c17.7 0 32-14.3 32-32l0-104c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 88-88 0z" />
                        </svg>
                    </a>
                </div>
            </div>


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
