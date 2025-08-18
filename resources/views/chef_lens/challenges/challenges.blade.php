<!DOCTYPE html>
<html lang="en">
<head>
    <title>التحديات</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uXU3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/app-logo/favicon.png">
    <link rel="manifest" href="manifest.json">
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/challenges.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="page-wrapper">
        <div class="fixed-top-bar">
            <span class="divider"></span>
        </div>
        <div class="dz-nav-floting">
            <header class="header py-2 mx-auto">
                <div class="header-content">
                    <div class="mid-content">
                        <img src="{{ asset('assets/images/Isolation_Mode.png') }}" class="logo" alt="">
                    </div>
                    <div class="right-content d-flex align-items-center gap-4">
                        <a href="javascript:void(0);" class="back-btn">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </div>
                </div>
            </header>
            <div class="dz-nav-floting">
                <header class="header py-2 mx-auto" style="background-color: transparent !important; position: fixed; width: 100%;">
                    <div class="header-content">
                        <div class="mid-content">
                            <img src="./assets/images/Isolation_Mode.png" style="height: 53px; position: relative; right: 11px;" alt="">
                        </div>
                        <div class="right-content d-flex align-items-center gap-4">
                            <a href="javascript:void(0);" class="icon dz-floating-toggler">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <rect y="2" width="20" height="3" rx="1.5" fill="white" />
                                    <rect y="18" width="20" height="3" rx="1.5" fill="white" />
                                    <rect x="4" y="10" width="20" height="3" rx="1.5" fill="white" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </header>
                <div class="dz-custom-swiper" style="top: 80px; position: relative;">
                    <div class="swiper mySwiper dz-tabs-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <h5 class="title">تحديات الطهاة</h5>
                            </div>
                            <div class="swiper-slide">
                                <h5 class="title">تحديات المستخدمين</h5>
                            </div>
                        </div>
                    </div>

                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($challenges->where('challenge_type', 'chefs') as $challenge)
                                    <li>
                                        <div style="margin: 10px 20px; display: flex; align-items: center; justify-content: center; text-align: center;">
                                            <a href="{{ route('chef_lens.challenges.show', $challenge) }}" style="border-radius: 0px 12px 12px 0px; height: 129px; padding: 7px; width: 50%; background-color: #a50707; color: white;">
                                                <span style="font-size: 20px;">{{ $challenge->responses_count }}</span>
                                                <p style="font-size: 15px; margin-bottom: 0px;">قبل التحدي</p>
                                                <p style="font-size: 15px; margin-bottom: 0px;">
                                                    للطهاه
                                                </p>
                                                <span style="font-size: 16px; position: relative; top: 19px;">عرض التحدي</span>
                                            </a>
                                            <img style="position: absolute; width: 79px;" src="./assets/images/vs-icon.png" alt="">
                                            <a href="#" style="color: white; border-radius: 12px 0px 0px 12px; height: 129px; padding: 7px; width: 50%; background-color: #000000; text-align: center;">
                                                <div>
                                                    <img style="width: 40px; height: 40px; border-radius: 50%;" src="https://cdn-front.freepik.com/home/authenticated/cover-cards/foryou/retouch-2-hover.webp?im=AspectCrop=(333,300),xPosition=0.25" alt="">
                                                    <span>{{ $challenge->user->name }}</span>
                                                </div>
                                                <p style="font-size: 10px; margin-bottom: 0px;">يوم : اسبوع : دقيقة : ثانية</p>
                                                <span class="countdown-timer" data-end-date="{{ $challenge->end_date }}"></span>
                                                <br />
                                                <span style="font-size: 16px; position: relative; top: 14px;">تحدي خاص الطهاه</span>
                                            </a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($challenges->where('challenge_type', 'users') as $challenge)
                                    <li>
                                        <div style="margin: 10px 20px; display: flex; align-items: center; justify-content: center; text-align: center;">
                                            @if ($challenge->user_id == Auth::user()->id)
                                            <a href="{{ route('chef_lens.challenges.show' , $challenge) }}" style="border-radius: 0px 12px 12px 0px; height: 129px; padding: 7px; width: 50%; background-color: #a50707; color: white;">
                                                <span style="font-size: 20px;">{{ $challenge->responses_count }}</span>
                                                <p style="font-size: 15px; margin-bottom: 0px;">قبل التحدي</p>
                                                <p style="font-size: 15px; margin-bottom: 0px;">
                                                    للمستخدمين
                                                </p>
                                                <span style="font-size: 16px; position: relative; top: 19px;">عرض التحدي</span>
                                            </a>
                                            <img style="position: absolute; width: 79px;" src="./assets/images/vs-icon.png" alt="">
                                            <a href="{{ route('chef_lens.challenges.show' , $challenge) }}" style="color: white; border-radius: 12px 0px 0px 12px; height: 129px; padding: 7px; width: 50%; background-color: #000000; text-align: center;">

                                                <div>
                                                    <img style="width: 40px; height: 40px; border-radius: 50%;" src="https://cdn-front.freepik.com/home/authenticated/cover-cards/foryou/retouch-2-hover.webp?im=AspectCrop=(333,300),xPosition=0.25" alt="">
                                                    <span>{{ $challenge->user->name }}</span>
                                                </div>
                                                <p style="font-size: 10px; margin-bottom: 0px;">يوم : اسبوع : دقيقة : ثانية</p>
                                                <span class="countdown-timer" data-end-date="{{ $challenge->end_date }}"></span>
                                                <br />
                                                <span style="font-size: 16px; position: relative; top: 14px;">تحدي خاص بك</span>
                                            </a>

                                            @else
                                            <a href="{{ route('chef_lens.challenges.show' , $challenge) }}" style="border-radius: 0px 12px 12px 0px; height: 129px; padding: 7px; width: 50%; background-color: #a50707; color: white;">
                                                <span style="font-size: 20px;">{{ $challenge->responses_count }}</span>
                                                <p style="font-size: 15px; margin-bottom: 0px;">قبل التحدي</p>
                                                <p style="font-size: 15px; margin-bottom: 0px;">
                                                    للمستخدمين
                                                </p>
                                                <span style="font-size: 16px; position: relative; top: 19px;">عرض التحدي</span>
                                            </a>
                                            <img style="position: absolute; width: 79px;" src="./assets/images/vs-icon.png" alt="">
                                            <a href="{{ route('chef_lens.add-vs' , $challenge) }}" style="color: white; border-radius: 12px 0px 0px 12px; height: 129px; padding: 7px; width: 50%; background-color: #000000; text-align: center;">
                                                <div>
                                                    <img style="width: 40px; height: 40px; border-radius: 50%;" src="https://cdn-front.freepik.com/home/authenticated/cover-cards/foryou/retouch-2-hover.webp?im=AspectCrop=(333,300),xPosition=0.25" alt="">
                                                    <span>{{ $challenge->user->name }}</span>
                                                </div>
                                                <p style="font-size: 10px; margin-bottom: 0px;">يوم : اسبوع : دقيقة : ثانية</p>
                                                <span class="countdown-timer" data-end-date="{{ $challenge->end_date }}"></span>
                                                <br />
                                                <span style="font-size: 16px; position: relative; top: 14px;">إقبل التحدي</span>
                                            </a>
                                            @endif
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <script>
                        const endDateStr = "2025-08-15T23:59:59";
                        const endDate = endDateStr ? new Date(endDateStr).getTime() : null;
                        if (isNaN(endDate)) {
                            document.getElementById("countdown-timer").innerHTML = "تاريخ غير صحيح";
                        } else {
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
                        }
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ابحث عن كل العناصر اللي ليها كلاس "countdown-timer"
                const timers = document.querySelectorAll('.countdown-timer');

                // لكل عنصر من العناصر دي، شغل دالة التحديث
                timers.forEach(timer => {
                    const endDate = new Date(timer.dataset.endDate).getTime();

                    // شغل الدالة كل ثانية
                    const updateInterval = setInterval(() => {
                        const now = new Date().getTime();
                        const distance = endDate - now;

                        if (distance < 0) {
                            clearInterval(updateInterval);
                            timer.innerHTML = "انتهى التحدي";
                            return;
                        }

                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        timer.innerHTML = `${days} : ${hours} : ${minutes} : ${seconds}`;
                    }, 1000); // 1000 مللي ثانية = 1 ثانية
                });
            });

        </script>

        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/settings.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
