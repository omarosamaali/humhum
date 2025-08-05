@extends('layouts.chef')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons@4.29.0/dist/feather.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
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
                                <h5 class="title">فعال</h5>
                            </div>
                            <div class="swiper-slide">
                                <h5 class="title">غير فعال</h5>
                            </div>
                        </div>
                    </div>
                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">
                            <!-- Active Challenges -->
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($challenges->where('user_id', auth()->user()->id)->where('status', 'active') as $challenge)
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-media">
                                                @php
                                                $fullPath = asset('storage/' . $challenge->announcement_path);
                                                $fileExtension = pathinfo($challenge->announcement_path, PATHINFO_EXTENSION);
                                                $isVideo = in_array($fileExtension, ['mp4', 'mov', 'ogg', 'webm', 'avi']); // أضف امتدادات الفيديو التي تدعمها
                                                @endphp
                                                @if($isVideo)
                                                <video controls style="height: 186px; object-fit: contain; border-radius: 20px; max-width: 100%; max-height: 100%; object-fit: contain;">
                                                    <source src="{{ $fullPath }}" type="video/{{ $fileExtension }}">
                                                    متصفحك لا يدعم الفيديو.
                                                </video>
                                                @else
                                                <img src="{{ $fullPath }}" alt="صورة التحدي" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                @endif
                                            </div>
                                            <div class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <a href="{{ route('challenge.show', $challenge->id) }}">
                                                            {{ $challenge->message }}</a>
                                                    </h6>
                                                    <ul class="tag-list">
                                                        <li>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($challenge->start_date . ' ' . $challenge->start_time)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($challenge->end_date . ' ' . $challenge->end_time)->format('Y-m-d h:i A') }}
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
                                                    <a href="" class="dz-btn accept-challenge">
                                                        تقييم المتحديين
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($challenges->where('status', 'inactive')->isNotEmpty())
                                    <li>
                                        <p>لا توجد تحديات فعالة حاليًا</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- Inactive Challenges -->
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($challenges->where('user_id', auth()->user()->id)->where('status', 'inactive') as $challenge)
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-media">
                                                @php
                                                $fullPath = asset('storage/' . $challenge->announcement_path);
                                                $fileExtension = pathinfo($challenge->announcement_path, PATHINFO_EXTENSION);
                                                $isVideo = in_array($fileExtension, ['mp4', 'mov', 'ogg', 'webm', 'avi']); // أضف امتدادات الفيديو التي تدعمها
                                                @endphp
                                                @if($isVideo)
                                                <video controls style="    height: 186px; object-fit: contain; border-radius: 20px; max-width: 100%; max-height: 100%; object-fit: contain;">
                                                    <source src="{{ $fullPath }}" type="video/{{ $fileExtension }}">
                                                    متصفحك لا يدعم الفيديو.
                                                </video>
                                                @else
                                                <img src="{{ $fullPath }}" alt="صورة التحدي" style="max-width: 100%; max-height: 100%; object-fit: contain;">
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
                                                                {{ \Carbon\Carbon::parse($challenge->start_date . ' ' . $challenge->start_time)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($challenge->end_date . ' ' . $challenge->end_time)->format('Y-m-d h:i A') }}
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
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($challenges->where('status', 'inactive')->isEmpty())
                                    <li>
                                        <p>لا توجد تحديات غير فعالة حاليًا</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('challenge.create') }}" class="plus-btn">
                    <span style="position: relative; top: -4px;">+</span>
                </a>
            </div>
        </main>
    </div>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10
            , slidesPerView: 4
            , freeMode: true
            , watchSlidesProgress: true
        , });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10
            , thumbs: {
                swiper: swiper
            , }
        , });

    </script>
</body>
@endsection
