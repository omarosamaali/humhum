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
        padding-bottom: 30px;
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
                            {{-- <div class="icon-bx" style="margin-left: unset !important;">
                                <a href="profileDisplayed.html">
                                    <img class="img-fluid" style="justify-content: flex-start; display: flex; text-align: center; border-radius: 50%; margin: auto; width: 50px; height: 50px; display: flex; text-align: center;" src="{{ $response->user->chefProfile->profile_image ?? './assets/images/chef.jpeg' }}" alt="Chef Profile">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title">
                                    <a href="profileDisplayed.html" id="name-chef" style="color: white;">
                                        {{ $response->user->name ?? 'احمد عبدالقادر' }}
                                    </a>
                                </h6>
                                <h6 class="title">
                                    <a href="profileDisplayed.html" id="name-chef" style="color: white;">
                                        {{ $response->user->chefProfile->country ?? 'مصر' }}
                                    </a>
                                </h6>
                            </div> --}}
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

    <div style="height: 100vh;">
        @if($response->recipe_image_path)
        <img style="height: 100%; width: 100%; object-fit: cover;" src="{{ asset('storage/' . $response->recipe_image_path) }}" alt="Challenge Recipe Image">
        @else
        <img style="height: 100%; width: 100%; object-fit: cover;" src="https://img.freepik.com/free-psd/samosa-food-social-media-promotion-instagram-banner-post-template-design_84443-3058.jpg?uid=R118249704&ga=GA1.1.696324772.1728654570&semt=ais_hybrid&w=740" alt="Default Challenge Image">
        @endif
    </div>
</div>


    </div>
</body>
@endsection
