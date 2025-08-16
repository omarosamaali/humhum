@extends('layouts.chef_lens')

@section('section')
<style>
    .main-container {
        top: 71px;
        direction: rtl;
        display: flex;
        flex-direction: row;
        position: relative;
    }

    .title-bar {
        width: 276px;
        overflow: hidden;
        justify-content: start;
        gap: 15px;
    }

    .title-bar.right-section {
        left: 0px;
        justify-content: start;
        gap: 15px;
    }

    .categories-swiper {
        padding-bottom: 0px;
    }

    .right-section .categories-swiper {
        right: 10px;
        padding-left: 0px;
        padding-right: 0px;
    }

    .icon-bx {
        margin-left: unset !important;
    }

    .chef-img {
        padding: 3px;
        display: flex;
        text-align: center;
        border-radius: 50%;
        margin: auto;
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .chef-name {
        color: white;
        font-size: 12px;
        text-align: center;
    }

    .challenge-img {
        padding: 3px;
        display: flex;
        text-align: center;
        border-radius: 50%;
        margin: auto;
        width: 50px;
        height: 50px;
    }

    .video-btn {
        background-color: transparent !important;
        padding: 0px;
    }

    .bookmark-btn,
    .heart-btn {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: end;
    }

    .bookmark-icon,
    .heart-icon {
        font-size: 23px;
        color: white;
    }

    .bookmark-count,
    .heart-count {
        position: relative;
        right: 3px;
        padding-bottom: 0px;
        font-size: 14px;
        color: white;
    }

    .mute-icon {
        font-size: 20px;
    }

    .challenge-title {
        color: white;
        font-size: 18px;
        text-align: right;
    }

    .challenge-info {
        margin-bottom: 10px;
        direction: rtl;
    }

    .challenge-flex {
        display: flex;
        gap: 10px;
        align-items: end;
    }

    .challenge-type {
        background-color: var(--primary);
        padding: 5px;
        border-radius: 5px;
        color: white;
        font-size: 14px;
        margin-bottom: 0px;
    }

    .price-container {
        flex-direction: column;
        align-items: end;
        justify-content: center;
        display: flex;
        color: white;
    }

    .time-label {
        font-size: 12px;
        margin-bottom: 0px;
    }

    .countdown {
        margin-bottom: 0px;
        font-size: 18px;
        color: rgb(255, 255, 255);
        font-weight: bold;
    }

    .remaining-time {
        margin-top: -5px;
        margin-bottom: 10px;
        width: fit-content;
        font-size: 12px;
        color: rgb(255, 255, 255);
        border-radius: 5px;
    }

    .dz-meta {
        direction: rtl;
        display: flex;
        gap: 15px;
        margin-bottom: 10px;
    }

    .dz-price {
        text-align: center;
        font-size: 14px;
    }

    .button-container {
        display: flex;
        gap: 1px;
        width: 100%;
    }

    .button-half {
        width: 50%;
    }

    .video-reels-container {
        height: 100vh;
        overflow-x: auto;
        display: flex;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .video-reel-item {
        min-width: 100vw;
        height: 100vh;
        position: relative;
        scroll-snap-align: start;
    }

    .video-reel {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }

    #container--btns {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }

    .liked {
        color: red !important;
    }

    .bookmarked {
        color: #EFBF04 !important;
    }

    .bookmark-btn,
    .heart-btn {
        margin-bottom: 0px;
    }

    .pause-icon {
        padding-bottom: 9px;
    }

</style>


<div class="main-container">
    <div class="title-bar">
        <div>
            <div class="swiper categories-swiper dz-swiper">
                <div class="swiper-wrapper">
                    @foreach($chefs as $index => $chef)
                    <div class="swiper-slide">
                        <a href="{{ route('chef_lens.profileDisplayed') }}" 
                            style="flex-direction: column; border: 0px; padding: 0px; background-color: transparent; box-shadow: none;" class="dz-categories-bx chef-selector" data-chef-id="{{ $chef->id }}">
                            <div class="icon-bx">
                                <img class="img-fluid chef-img {{ $index === 1 ? 'active' : '' }}" src="{{ $chef->official_image ? asset('storage/' . $chef->official_image) : asset('assets/images/default-chef.jpg') }}" alt="{{ $chef->name }}">
                            </div>
                            <div class="dz-content">
                                <h6 class="title">
                                    <span class="chef-name {{ $index === 1 ? 'active' : '' }}">{{ $chef->user->name }}</span>
                                </h6>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="title-bar right-section" style="width: unset !important;">
        <div>
            <div class="swiper categories-swiper dz-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="dz-categories-bx" style=" flex-direction: column; border: 0px; padding: 0px; background-color: transparent; box-shadow: none;">
                            <div class="icon-bx" style="padding-left: 2px;">
                                <img class="img-fluid challenge-img" src="{{ asset('assets/images/hat.png') }}" alt="التحديات">
                            </div>
                            <div class="dz-content">
                                <h6 class="title">
                                    <span class="chef-name">التحديات</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('message'))
<span class="alert alert-success">{{ session('message') }}</span>
@endif

<div class="video-reels-container" id="videoContainer">
    @foreach($challenges as $video)

    <div class="video-reel-item" data-video-id="{{ $video->id }}" data-chef-id="{{ $video->user->chefProfile->id ?? '' }}" data-video-type="challenge">
        <video class="myVideo video-reel" data-index="{{ $loop->index }}" autoplay preload="metadata" muted>

            <source src="{{ 'storage/' . $video->announcement_path }}" type="video/mp4">
            المتصفح لا يدعم HTML5 video.
        </video>
        <div class="content">
            <div id="container--btns" style="margin-bottom: 48px;">
                <button class="myBtn video-btn bookmark-btn" onclick="toggleBookmark('challenge', {{ $video->id }}, this)">
                    <i class="fa-solid fa-bookmark bookmark-icon {{ Auth::check() && in_array(Auth::id(), $video->bookmarked_by ?? []) ? 'bookmarked' : '' }}"></i>
                    <span class="bookmark-count">{{ $video->bookmarks ?? 0 }}</span>
                </button>
                <button class="myBtn video-btn heart-btn" onclick="toggleLike('challenge', {{ $video->id }}, this)">
                    <i class="fa-solid fa-heart heart-icon {{ Auth::check() && in_array(Auth::id(), $video->liked_by ?? []) ? 'liked' : '' }}"></i>
                    <span class="heart-count">{{ $video->likes ?? 0 }}</span>
                </button>

                <button class="myBtn video-btn" onclick="togglePlay(this)">
                    <i class="fa-solid fa-play pause-icon play-pause-icon"></i>
                </button>
                <button class="myBtn video-btn" onclick="toggleMute(this)">
                    <i class="fa-solid fa-volume-xmark pause-icon mute-icon"></i>
                </button>

                <h1 class="challenge-title">{{ $video->message ?? 'اسم التحدي' }}</h1>
                <ul class="dz-meta">
                    <li class="dz-price"><i class="fa-solid fa-clock"></i> {{ $video->created_at->locale('ar')->diffForHumans() }}</li>
                    <li class="dz-price"><i class="fa-solid fa-eye"></i> <span class="views-count">{{ $video->views ?? 0 }}</span></li>
                </ul>

                <div class="button-container">
                    @if($video->challengeResponses->isEmpty() && Auth::user()->id == $video->user_id)
                    <a href="{{ route('accpet-challenge', $video->id ?? '') }}" style="{{ $video->recipe_id ? '' : 'width: 100%; border-radius: 15px;' }}" class="myBtn order-now button-half">إقبل التحدي</a>
                    @else
                    <span style="width: 100%; border-radius: 15px;" class="myBtn order-now button-half">تم قبول التحدي</span>
                    @endif
                    @if($video->recipe_id)
                    <a href="{{ route('recipe.view', $video->recipe_id) }}" class="myBtn money-btn button-half">عرض الوصفة</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($snaps as $video)
    <div class="video-reel-item" data-video-id="{{ $video->id }}" data-chef-id="{{ $video->user->chefProfile->id ?? '' }}" data-video-type="snap">
        <video class="myVideo video-reel" data-index="{{ $loop->index + $challenges->count() }}" autoplay preload="metadata" muted>

            <source src="{{ 'storage/' . $video->video_path }}" type="video/mp4">
            المتصفح لا يدعم HTML5 video.
        </video>
        <div class="content">
            <div id="container--btns" style="margin-bottom: 48px;">
                <button class="myBtn video-btn bookmark-btn" onclick="toggleBookmark('snap', {{ $video->id }}, this)">
                    <i class="fa-solid fa-bookmark bookmark-icon {{ Auth::check() && in_array(Auth::id(), $video->bookmarked_by ?? []) ? 'bookmarked' : '' }}"></i>
                    <span class="bookmark-count">{{ $video->bookmarks ?? 0 }}</span>
                </button>
                <button class="myBtn video-btn heart-btn" onclick="toggleLike('snap', {{ $video->id }}, this)">
                    <i class="fa-solid fa-heart heart-icon {{ Auth::check() && in_array(Auth::id(), $video->liked_by ?? []) ? 'liked' : '' }}"></i>
                    <span class="heart-count">{{ $video->likes ?? 0 }}</span>
                </button>

                <button class="myBtn video-btn" onclick="togglePlay(this)">
                    <i class="fa-solid fa-play pause-icon play-pause-icon"></i>
                </button>
                <button class="myBtn video-btn" onclick="toggleMute(this)">
                    <i class="fa-solid fa-volume-xmark pause-icon mute-icon"></i>
                </button>

                <h1 class="challenge-title">{{ $video->name ?? 'اسم السناب' }}</h1>
                <ul class="dz-meta">
                    <li class="dz-price"><i class="fa-solid fa-clock"></i> {{ $video->created_at->locale('ar')->diffForHumans() }}</li>
                    <li class="dz-price"><i class="fa-solid fa-eye"></i> <span class="views-count">{{ $video->views ?? 0 }}</span></li>
                </ul>

                <div class="button-container">
                    @if($video->recipe_id)
                    <a href="{{ route('recipe.view', $video->recipe_id) }}" class="myBtn money-btn" style="border-radius: 15px; width: 100%;">عرض الوصفة</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    const videoReelsContainer = document.querySelector('.video-reels-container');
    const videos = document.querySelectorAll('.video-reel');
    const chefSelectors = document.querySelectorAll('.chef-selector');
    let currentVideoIndex = 0;

    document.addEventListener('DOMContentLoaded', () => {
        if (videos.length > 0) {
            playCurrentVideo();
        }

        videoReelsContainer.addEventListener('scroll', debounce(handleScroll, 200));

        videos.forEach((vid) => {
            vid.addEventListener('playing', () => {
                const videoItem = vid.closest('.video-reel-item');
                const videoId = videoItem.getAttribute('data-video-id');
                const videoType = videoItem.getAttribute('data-video-type');

                if (videoId && videoType) {
                    updateViews(videoType, videoId);
                }
            });
            vid.onended = () => {
                const nextIndex = (currentVideoIndex + 1) % videos.length;
                videoReelsContainer.scrollTo({
                    left: nextIndex * videoReelsContainer.clientWidth
                    , behavior: 'smooth'
                });
            };
        });

        chefSelectors.forEach(chefSelector => {
            chefSelector.addEventListener('click', (e) => {
                e.preventDefault();
                const selectedChefId = chefSelector.getAttribute('data-chef-id');
                const targetVideoItem = document.querySelector(`.video-reel-item[data-chef-id="${selectedChefId}"]`);
                if (targetVideoItem) {
                    const videoIndex = Array.from(videos).findIndex(vid => vid.closest('.video-reel-item') === targetVideoItem);
                    if (videoIndex !== -1 && videoIndex !== currentVideoIndex) {
                        currentVideoIndex = videoIndex;
                        videoReelsContainer.scrollTo({
                            left: videoIndex * videoReelsContainer.clientWidth
                            , behavior: 'smooth'
                        });
                        playCurrentVideo();
                    }
                }
            });
        });
    });

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

    function updateActiveChef() {
        const currentVideoItem = videos[currentVideoIndex].closest('.video-reel-item');
        const currentChefId = currentVideoItem.getAttribute('data-chef-id');

        document.querySelectorAll('.chef-img, .chef-name').forEach(el => {
            el.classList.remove('active');
        });

        const activeChefImage = document.querySelector(`.chef-selector[data-chef-id="${currentChefId}"] .chef-img`);
        const activeChefName = document.querySelector(`.chef-selector[data-chef-id="${currentChefId}"] .chef-name`);

        if (activeChefImage) {
            activeChefImage.classList.add('active');
        }
        if (activeChefName) {
            activeChefName.classList.add('active');
        }
    }

    function playCurrentVideo() {
        videos.forEach((vid, index) => {
            const playPauseIcon = vid.parentElement.querySelector('.play-pause-icon');
            if (index === currentVideoIndex) {
                vid.play().catch(err => console.error(`Error playing video ${index}:`, err));
                if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause pause-icon play-pause-icon';
                updateActiveChef();
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
        if (newIndex !== currentVideoIndex && newIndex < videos.length) {
            currentVideoIndex = newIndex;
            playCurrentVideo();
        }
    }

    function toggleLike(type, videoId, buttonElement) {
        fetch(`/videos/toggle-like`, {
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    , 'Content-Type': 'application/json'
                }
                , body: JSON.stringify({
                    type: type
                    , videoId: videoId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const heartIcon = buttonElement.querySelector('.heart-icon');
                    const heartCount = buttonElement.querySelector('.heart-count');
                    heartIcon.classList.toggle('liked');
                    heartCount.textContent = data.likes;
                } else {
                    console.error('Error toggling like:', data.error);
                    if (data.error === 'يجب تسجيل الدخول') {
                        alert('يجب تسجيل الدخول للإعجاب بالفيديو');
                    }
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }

    function toggleBookmark(type, videoId, buttonElement) {
        fetch(`/videos/toggle-bookmark`, {
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    , 'Content-Type': 'application/json'
                }
                , body: JSON.stringify({
                    type: type
                    , videoId: videoId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const bookmarkIcon = buttonElement.querySelector('.bookmark-icon');
                    const bookmarkCount = buttonElement.querySelector('.bookmark-count');
                    bookmarkIcon.classList.toggle('bookmarked');
                    bookmarkCount.textContent = data.bookmarks;
                } else {
                    console.error('Error toggling bookmark:', data.error);
                    if (data.error === 'يجب تسجيل الدخول') {
                        alert('يجب تسجيل الدخول لحفظ الفيديو');
                    }
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }

    function updateViews(type, videoId) {
        fetch(`/videos/update-views`, {
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    , 'Content-Type': 'application/json'
                }
                , body: JSON.stringify({
                    type: type
                    , videoId: videoId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const viewsElement = document.querySelector(`.video-reel-item[data-video-id="${videoId}"] .views-count`);
                    if (viewsElement) {
                        viewsElement.textContent = data.views;
                    }
                } else {
                    console.error('Error updating views:', data.error);
                }
            })
            .catch(error => console.error('Fetch error:', error));
    }

    function toggleMute(buttonElement) {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) return;
        currentVideo.muted = !currentVideo.muted;
        const muteIcon = buttonElement.querySelector('.mute-icon');
        muteIcon.className = `fa-solid fa-volume-${currentVideo.muted ? 'xmark' : 'high'} pause-icon mute-icon`;
    }

    function togglePlay(buttonElement) {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) return;
        const playPauseIcon = buttonElement.querySelector('.play-pause-icon');
        if (currentVideo.paused) {
            currentVideo.play();
            playPauseIcon.className = 'fa-solid fa-pause pause-icon play-pause-icon';
        } else {
            currentVideo.pause();
            playPauseIcon.className = 'fa-solid fa-play pause-icon play-pause-icon';
        }
    }

</script>

@endsection
