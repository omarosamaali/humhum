@extends('layouts.chef')
@section('content')

<body>
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <header class="header header-fixed transparent">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">عرض التحدي</h4>
                </div>
            </div>
        </header>

        <!-- Main Content Start -->
        <main class="page-content p-b80">
            <div class="container p-0">
                <div style="height: 555px; max-height: 600px;" class="dz-product-preview bg-primary">
                    <div class="swiper product-detail-swiper">
                        <div class="overlay" style="position: absolute; z-index: 999999; height: 536px; width: 100%; background-color: rgba(0, 0, 0, 0.5);">
                        </div>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="dz-media">
                                    <video style="height: 536px; width: 100%; object-fit: cover; border: none; outline: none;" autoplay muted loop playsinline>
                                        <source src="{{ Storage::url($challenge->announcement_path) }}" type="video/mp4">

                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dz-product-detail" style="direction: rtl;">
                    <div class="detail-content">
                        <h4 class="title">{{ $challenge->message }}</h4>
                        <ul class="tag-list" style="text-align: right; direction: ltr;">
                            <li>
                                <div style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                    {{ \Carbon\Carbon::parse($challenge->start_date . ' ' . $challenge->start_time)->format('Y-m-d h:i A') }}
                                    <i class="feather icon-calendar"></i>
                                </div>
                                <div style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                    {{ \Carbon\Carbon::parse($challenge->end_date . ' ' . $challenge->end_time)->format('Y-m-d h:i A') }} <i class="feather icon-calendar"></i>
                                </div>
                            </li>
                        </ul>
                        <ul class="tag-list" style="display: flex; gap: 10px;">
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-clock" style="color: var(--primary);"></i>
                                {{ \Carbon\Carbon::parse($challenge->start_date)->format('Y-m-d') }}
                            </li>
                        </ul>
                    </div>

                    <div style="display: flex;">
                        <div class="dz-item-rating" style="background-color: #e00000; font-size: 17px; overflow: hidden; line-height: unset; border: 2px solid #e00000;">
                            <img src="{{ asset('storage/' . $challenge->chefProfile->official_image) }}" style="width: 100%; height: 100%;" alt="">
                        </div>
                        <h5 style="position: absolute; right: 100px; top: 10px; font-size: 14px; color: gray;">
                            الشيف : {{ $challenge->user->name }}</h5>
                    </div>

                    <div class="item-wrapper">
                        <div class="dz-meta-items">
                            <div class="dz-price flex-1" style="justify-content: space-between; display: flex;">
                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <sub>
                                            <i class="fa fa-users" style="font-size: 14px; margin-left: 5px; "></i></sub>38
                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                        عدد المتحديين
                                    </div>
                                </div>
                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <p style="font-size: 12px; margin-bottom: 0px;">
                                            يوم - ساعة - دقيقة - ثانية
                                        </p>
                                        <p>
                                            <div id="countdown"></div>
                                        </p>
                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                        باقي علي نهاية التحدي
                                    </div>
                                </div>
<script>
    // Countdown Timer
    function startCountdown(endDate, endTime) {
        const end = new Date(`${endDate} ${endTime} UTC`).getTime();
        const interval = setInterval(() => {
            const now = new Date().getTime();
            const distance = end - now;

            if (distance < 0) {
                clearInterval(interval);
                document.getElementById('countdown').innerHTML = 'انتهى التحدي';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('countdown').innerHTML = `${days} : ${hours} : ${minutes} : ${seconds}`;
        }, 1000);
    }

    // Start countdown with challenge end date and time
    const endDate = '{{ $challenge->end_date }}';
    const endTime = '{{ $challenge->end_time }}';
    if (endDate && endTime) {
        startCountdown(endDate, endTime);
    } else {
        document.getElementById('countdown').innerHTML = 'تاريخ النهاية غير محدد';
    }

</script>

                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <sub>
                                            <i class="fa fa-user" style="font-size: 14px;"></i></sub>
                                        <span style="font-size: 14px;">
                                            {{ $challenge->challenge_type == 'users' ? 'للمستخدمين' : 'للطهاة' }}
                                        </span>

                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                        نوع التحدي
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content End -->
        @if(Auth::check() && Auth::user()->id == $challenge->user_id)
        <div class="footer-fixed-btn bottom-0 bg-white">
            <a href="{{ route('challenge.edit', $challenge->id) }}" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">
                تعديل</a>
        </div>
        @endif
    </div>
</body>

@endsection
