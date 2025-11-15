@extends('layouts.chef')

@section('content')
<style>
    .rating-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .rating-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .stars {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-bottom: 20px;
    }

    .star {
        font-size: 30px;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star.active {
        color: #ffc107 !important;
    }

    .star.hover {
        color: #ffc107 !important;
    }

    .rating-text {
        font-size: 18px !important;
        color: #666;
        margin-top: 10px;
    }

</style>
<body class="bg-light">
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
                <div class="left-content">
                    <a href="{{ url()->previous() ?: route('home') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">قيم الطبخة</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                </div>
            </div>
        </header>
        <main class="page-content space-top p-b50" style="direction: rtl;">
            <div class="container">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="list style-3 bg-white border-bottom" style="display: flex; align-items: center; padding-top: 33px; padding-bottom: 87px;">
                    <div class="media-100 me-3" style="margin-left: 1em;">
                        @if ($challengeResponse->user && $challengeResponse->user->chefProfile && $challengeResponse->user->chefProfile->official_image)
                        <img style="    width: 100px;
    border-radius: 50% !important;
    height: 100px;

" src="{{ asset('storage/' . $challengeResponse->user->chefProfile->official_image) }}" alt="صورة المتحدي">
                        @else
                        <img class="rounded" src="{{ asset('assets/images/placeholder.jpg') }}" alt="صورة افتراضية">
                        @endif
                    </div>
                    <div class="dz-content">
                        <div class="dz-head">
                            <h6 class="title font-w500 max-100">
                                <a href="{{ url()->previous() ?: route('home') }}" style="font-weight: bold;">
                                    {{ $challengeResponse->user->name ?? 'اسم المستخدم غير متاح' }}
                                </a>
                            </h6>
                        </div>
                        <ul class="tag-list">
                            <li><a href="{{ url()->previous() ?: route('home') }}" style="    display: flex
;
    align-items: center;
    gap: 8px;color: #776e6e;">

                                    {{-- {{ $challengeResponse->user->chefProfile?->country }} --}}
                                    @php
                                    $countryName = '';
                                    switch (strtolower($challengeResponse->user->chefProfile?->country)) {

                                    case 'sa':
                                    $countryName = 'المملكة العربية السعودية';
                                    break;
                                    case 'ae':
                                    $countryName = 'الإمارات العربية المتحدة';
                                    break;
                                    case 'qa':
                                    $countryName = 'قطر';
                                    break;
                                    case 'kw':
                                    $countryName = 'الكويت';
                                    break;
                                    case 'bh':
                                    $countryName = 'البحرين';
                                    break;
                                    case 'om':
                                    $countryName = 'سلطنة عُمان';
                                    break;
                                    case 'ye':
                                    $countryName = 'اليمن';
                                    break;
                                    case 'iq':
                                    $countryName = 'العراق';
                                    break;
                                    case 'sy':
                                    $countryName = 'سوريا';
                                    break;
                                    case 'jo':
                                    $countryName = 'الأردن';
                                    break;
                                    case 'lb':
                                    $countryName = 'لبنان';
                                    break;
                                    case 'ps':
                                    $countryName = 'فلسطين';
                                    break;
                                    case 'eg':
                                    $countryName = 'مصر';
                                    break;
                                    case 'sd':
                                    $countryName = 'السودان';
                                    break;
                                    case 'ly':
                                    $countryName = 'ليبيا';
                                    break;
                                    case 'tn':
                                    $countryName = 'تونس';
                                    break;
                                    case 'dz':
                                    $countryName = 'الجزائر';
                                    break;
                                    case 'ma':
                                    $countryName = 'المغرب';
                                    break;
                                    case 'mr':
                                    $countryName = 'موريتانيا';
                                    break;
                                    case 'dj':
                                    $countryName = 'جيبوتي';
                                    break;
                                    case 'so':
                                    $countryName = 'الصومال';
                                    break;
                                    case 'km':
                                    $countryName = 'جزر القمر';
                                    break;
                                    default:
                                    $countryName = 'غير محدد';
                                    break;
                                    }
                                    @endphp

                                    <!-- Display the Arabic country name -->


                                    الدولة:
                                    <img src="https://flagcdn.com/24x18/{{ $challengeResponse->user->chefProfile?->country }}.png" alt="علم {{ $challengeResponse->country }}" style="width: 24px; height: 18px; vertical-align: middle;"> </span>
                                    {{ $countryName }}



                                </a></li>
                        </ul>
                    </div>
                </div>

                <div class="mb-3">
                    @if ($challengeResponse->challenge_video_path)
                    <video controls style="width: 100%; max-height: 400px; border-radius: 8px;">
                        <source src="{{ asset('storage/' . $challengeResponse->challenge_video_path) }}" type="video/mp4">
                        متصفحك لا يدعم عرض الفيديو.
                    </video>
                    @else
                    <p>لا يوجد فيديو متاح لهذه الاستجابة.</p>
                    @endif
                </div>

                <div class="write-reviews-box">
                    <div class="rating-content">
                        <h5 class="title">رسالة من صاحب الفيديو</h5>
                        <p class="dz-text">{{ $challengeResponse->message_to_chef ?? 'لا توجد رسالة.' }}</p>
                    </div>

                    <form action="{{ route('chef.challenge_response.submit_review', ['challenge_response_id' => $challengeResponse->id]) }}" method="POST">
                        @csrf
                        <div class="rating-info" style="margin-bottom: 50px;">
                            <div class="rating-container">
                                <h2 class="rating-title">قيم تجربتك</h2>
                                <div class="stars" id="stars">
                                    <span class="star" data-rating="1">★</span>
                                    <span class="star" data-rating="2">★</span>
                                    <span class="star" data-rating="3">★</span>
                                    <span class="star" data-rating="4">★</span>
                                    <span class="star" data-rating="5">★</span>
                                </div>
                                <div class="rating-text" id="ratingText">اختر تقييمك</div>
                            </div>
                            <input type="hidden" name="rating" id="rating-input" value="{{ $challengeResponse->chefReview->rating ?? $challengeResponse->chef_rating ?? '0' }}">
                            <input type="hidden" name="chef_id" value="{{ $challengeResponse->user_id }}">

                        </div>

                        <div class="mb-3">
                            <textarea class="form-control bg-white" style="text-align: center;" name="chef_message_response" id="chef-message-response-textarea" placeholder="الرد على صاحب الفيديو">{{ $challengeResponse->chefReview->chef_message_response ?? '' }}</textarea>
                        </div>

                        @if(!$challengeResponse->chefReview || !$challengeResponse->chefReview->rating)
                        <div class="footer fixed bg-transparent">
                            <div class="container" style="background: white;">
                                <button type="submit" class="btn btn-primary rounded-xl btn-lg btn-thin w-100 gap-2">إرسال</button>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-info text-center mt-3">
                            <i class="feather icon-check-circle"></i> تم إرسال تقييمك بنجاح
                        </div>
                        @endif
                    </form>

                </div>
            </div>
        </main>
    </div>
    <script>
        let selectedRating = 0;
        const stars = document.querySelectorAll('.star');
        const ratingText = document.getElementById('ratingText');
        const ratingInput = document.getElementById('rating-input');

        const ratingMessages = {
            1: 'سيء جداً'
            , 2: 'سيء'
            , 3: 'متوسط'
            , 4: 'جيد'
            , 5: 'ممتاز'
        };

        // تحميل التقييم السابق عند تحميل الصفحة
        function loadPreviousRating() {
            const previousRating = parseInt(ratingInput.value) || 0;
            if (previousRating > 0) {
                selectedRating = previousRating;
                updateStars();
                updateText();
            }
        }

        // تحديد إذا كان التقييم موجود مسبقاً
        function disableRatingIfExists() {
            const hasExistingRating = selectedRating > 0;

            // إذا كان هناك تقييم مسبق، منع التفاعل مع النجوم
            if (hasExistingRating) {
                stars.forEach(star => {
                    star.style.pointerEvents = 'none';
                    star.style.opacity = '0.7';
                });

                // تعطيل textarea أيضاً
                const textarea = document.getElementById('chef-message-response-textarea');
                if (textarea) {
                    textarea.readOnly = true;
                    textarea.style.backgroundColor = '#f8f9fa';
                    textarea.style.cursor = 'not-allowed';
                }
            }
        }

        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                ratingInput.value = selectedRating;
                updateStars();
                updateText();
            });

            star.addEventListener('mouseenter', function() {
                const hoverRating = parseInt(this.dataset.rating);
                highlightStars(hoverRating);
            });
        });

        document.querySelector('.stars').addEventListener('mouseleave', function() {
            clearHoverStars();
            updateStars();
        });

        function updateStars() {
            stars.forEach((star, index) => {
                star.classList.remove('hover');
                if (index < selectedRating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function highlightStars(rating) {
            stars.forEach((star, index) => {
                star.classList.remove('active');
                if (index < rating) {
                    star.classList.add('hover');
                } else {
                    star.classList.remove('hover');
                }
            });
        }

        function clearHoverStars() {
            stars.forEach(star => {
                star.classList.remove('hover');
            });
        }

        function updateText() {
            if (selectedRating > 0) {
                ratingText.textContent = `تقييمك: ${selectedRating} نجوم - ${ratingMessages[selectedRating]}`;
            } else {
                ratingText.textContent = 'اختر تقييمك';
            }
        }

        // تحميل التقييم السابق عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            loadPreviousRating();
        });

    </script>


</body>
@endsection
