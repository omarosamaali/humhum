<!DOCTYPE html>
<html lang="en">

<head>
    <title>الملف الشخصي</title>
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
    <link rel="stylesheet" href="{{ asset('assets/css/profileDisplayed.css') }}">
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
                    @if(!$userReported)
                    <button style="background: red; color: white; border-radius: 4px; padding: 4px 10px; font-size: 14px; cursor: pointer;" onclick="openAlert({{ $chefProfile->user_id }})" class="report-btn">
                        إبلاغ
                    </button>
                    @else
                    <span style="background: gray; color: white; border-radius: 4px; padding: 4px 10px; font-size: 14px; display: inline-block;">
                        تم الإبلاغ
                    </span>
                    @endif
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

            <div class="profile-section">
                <div class="profile-container">
                    <div class="profile-info">
                        <img class="img-fluid profile-image" src="{{ $chefProfile->official_image ? asset('storage/' . $chefProfile->official_image) : asset('assets/images/default-chef.jpg') }}" alt="{{ $chefProfile->user->name ?? $chefProfile->name }}">
                        <h6 class="title">
                            <div id="name-chef" class="name-chef" style="text-transform: capitalize;">
                                {{ $chefProfile->user->name ?? $chefProfile->name }}
                            </div>
                        </h6>
                    </div>
                    <span class="follow-icon">
                        <button class="follow-btn" data-chef-id="{{ $chefProfile->id }}" data-is-following="{{ auth()->check() && $chefProfile->isFollowedBy(auth()->user()) ? 'true' : 'false' }}">
                            @if(auth()->check() && $chefProfile->isFollowedBy(auth()->user()))
                            <i class="fa-solid fa-user-minus"></i>
                            @else
                            <i class="fa-solid fa-user-plus"></i>
                            @endif
                        </button>
                        <span class="followers-count" style="display: none;">{{ $chefProfile->followers_count }}</span>
                    </span>

                </div>
            </div>
            <div class="location-section">
                @php
                $countryName = '';
                switch (strtolower($chefProfile->country)) {
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
                @if ($chefProfile->country)
                <span class="country">{{ $countryName }}</span>
                @endif
                <img class="flag" src="https://flagcdn.com/24x18/{{ strtolower($chefProfile->country) ?: 'default' }}.png" alt="">
            </div>
<!-- عرض أنظف - يظهر فقط الروابط المتاحة -->
@if($socialMedia && $socialMedia->hasAnyLink())
<div class="video-reels-container-icons">
    @if($socialMedia->youtube)
    <div>
        <a href="{{ $socialMedia->youtube }}" target="_blank" rel="noopener noreferrer" title="YouTube">
            <i class="fa-brands fa-youtube"></i>
        </a>
    </div>
    @endif

    @if($socialMedia->tiktok)
    <div>
        <a href="{{ $socialMedia->tiktok }}" target="_blank" rel="noopener noreferrer" title="TikTok">
            <i class="fa-brands fa-tiktok"></i>
        </a>
    </div>
    @endif

    @if($socialMedia->instagram)
    <div>
        <a href="{{ $socialMedia->instagram }}" target="_blank" rel="noopener noreferrer" title="Instagram">
            <i class="fa-brands fa-instagram"></i>
        </a>
    </div>
    @endif

    @if($socialMedia->snapchat)
    <div>
        <a href="{{ $socialMedia->snapchat }}" target="_blank" rel="noopener noreferrer" title="Snapchat">
            <i class="fa-brands fa-snapchat"></i>
        </a>
    </div>
    @endif

    @if($socialMedia->facebook)
    <div>
        <a href="{{ $socialMedia->facebook }}" target="_blank" rel="noopener noreferrer" title="Facebook">
            <i class="fa-brands fa-facebook"></i>
        </a>
    </div>
    @endif
</div>
@endif

<!-- أو إذا كنت تريد رسالة عند عدم وجود روابط -->
@if(!$socialMedia || !$socialMedia->hasAnyLink())
<div class="no-social-media">
    <p style="text-align: center; color: #999; font-size: 14px;">
        لا توجد روابط تواصل اجتماعي
    </p>
</div>
@endif

            <p class="bio-paragraph">
                {{ $chefProfile->bio }}
            </p>
            <div class="cirlce-parent">
                <div>
                    <div class="cirlce-child">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <span class="stat-count">{{ $likesCount }}</span>
                    <span class="stat-label">إعجاب</span>
                </div>
                <div>
                    <div class="cirlce-child">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="stat-count followers-stat">{{ $chefProfile->followers_count }}</span>
                    <span class="stat-label">متابعة</span>
                </div>
                <div>
                    <div class="cirlce-child">
                        <img class="img-fluid vs-icon" src="{{ asset('assets/images/hat.png') }}" alt="">
                    </div>
                    <span class="stat-count">{{ $challangeCount }}</span>
                    <span class="stat-label">تحدي</span>
                </div>
                <div>
                    <div class="cirlce-child">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <span class="stat-count">{{ $snapsCount }}</span>
                    <span class="stat-label">عدسه</span>
                </div>
            </div>
            <div class="tabs-container">
                <div class="tabs-header">
                    <button class="tab-button active" data-tab="tab1">
                        <i class="fa-solid fa-video-camera"></i>
                    </button>
                    <button class="tab-button" data-tab="tab2">
                        <img class="img-fluid vs-icon" src="{{ asset('assets/images/hat.png') }}" alt="">
                    </button>
                    <button class="tab-button" data-tab="tab3">
                        <i class="fa-solid fa-utensils"></i>
                    </button>
                </div>

                <div id="tab1" class="tab-content active">
                    <div class="products-grid">
                        @foreach ($snapsWithOutRecpies as $snaps)
                        <div class="product-card">
                            <div class="video-overlay" style="max-height: 180px;">
                                @if(file_exists(storage_path('app/public/' . $snaps->video_path)))
                                <video muted preload="metadata" style="max-height: 190px; width: 100%;">
                                    <source src="{{ asset('storage/' . $snaps->video_path) }}" type="video/mp4">
                                    الفيديو غير موجود
                                </video>
                                @else
                                <div style="background: #eee; height: 190px; display: flex; align-items: center; justify-content: center;">
                                    <p>الفيديو غير موجود</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div id="tab2" class="tab-content">
                    <div class="products-grid">
                        @foreach ($challanges as $snaps)
                        <div class="product-card">
                            <div class="video-overlay" style="max-height: 180px;">
                                @if(file_exists(storage_path('app/public/' . $snaps->video_path)))
                                <video muted preload="metadata" style="max-height: 190px; width: 100%;">
                                    <source src="{{ asset('storage/' . $snaps->announcement_path) }}" type="video/mp4">
                                    الفيديو غير موجود
                                </video>
                                @else
                                <div style="background: #eee; height: 190px; display: flex; align-items: center; justify-content: center;">
                                    <p>الفيديو غير موجود</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div id="tab3" class="tab-content">
                    <div class="products-grid">
                        @foreach ($snapsWithOutRecpies as $snaps)
                        <div class="product-card">
                            <div class="video-overlay" style="max-height: 180px;">
                                @if(file_exists(storage_path('app/public/' . $snaps->video_path)))
                                <video muted preload="metadata" style="max-height: 190px; width: 100%;">
                                    <source src="{{ asset('storage/' . $snaps->video_path) }}" type="video/mp4">
                                    الفيديو غير موجود
                                </video>
                                @else
                                <div style="background: #eee; height: 190px; display: flex; align-items: center; justify-content: center;">
                                    <p>الفيديو غير موجود</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById(targetTab).classList.add('active');
                });
            });
        });

        function openAlert(userId) { // غيّر الاسم ليكون واضح
            Swal.fire({
                title: "بلاغ؟"
                , text: 'لماذا تقوم بالإبلاغ عن هذا الحساب؟'
                , showDenyButton: true
                , showCancelButton: true
                , confirmButtonText: "الإبلاغ عن المنشور أو الرسالة أو التعليق"
                , denyButtonText: "حساب وهمي"
                , cancelButtonText: "إلغاء"
            }).then((result) => {
                let reportType = '';
                if (result.isConfirmed) {
                    reportType = 'content_report';
                } else if (result.isDenied) {
                    reportType = 'fake_account';
                }

                if (reportType) {
                    // ابحث عن الـ ChefProfile من الـ user_id
                    fetch(`/chef-profile/report-by-user/${userId}`, {
                            method: 'POST'
                            , headers: {
                                'Content-Type': 'application/json'
                                , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                , 'Accept': 'application/json'
                            }
                            , body: JSON.stringify({
                                report_type: reportType
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("تم الإبلاغ!", "شكراً لك. سيتم مراجعة بلاغك.", "success");
                                const reportBtn = document.querySelector('.report-btn');
                                if (reportBtn) {
                                    reportBtn.innerHTML = 'تم الإبلاغ';
                                    reportBtn.style.background = 'gray';
                                    reportBtn.onclick = null;
                                    reportBtn.style.cursor = 'default';
                                }
                            } else {
                                Swal.fire("حدث خطأ!", data.message || "فشل إرسال البلاغ.", "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire("حدث خطأ!", "فشل في التواصل مع الخادم.", "error");
                        });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const followButtons = document.querySelectorAll('.follow-btn');
            followButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const chefId = this.getAttribute('data-chef-id');
                    const isFollowing = this.getAttribute('data-is-following') === 'true';
                    const followersCountElement = this.parentElement.querySelector('.followers-count');
                    const followersStatElement = document.querySelector('.followers-stat');

                    fetch(`/chef-profile/${chefId}/toggle-follow`, {
                            method: 'POST'
                            , headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                , 'Content-Type': 'application/json'
                            , }
                        , })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.setAttribute('data-is-following', data.isFollowing);
                                if (data.isFollowing) {
                                    this.innerHTML = '<i class="fa-solid fa-user-minus"></i> إلغاء المتابعة';
                                } else {
                                    this.innerHTML = '<i class="fa-solid fa-user-plus"></i> متابعة';
                                }
                                if (followersCountElement) {
                                    followersCountElement.textContent = data.followersCount;
                                }
                                if (followersStatElement) {
                                    followersStatElement.textContent = data.followersCount;
                                }
                            } else {
                                alert(data.error || 'حدث خطأ أثناء المتابعة');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('حدث خطأ أثناء المتابعة');
                        });
                });
            });
        });

    </script>

</body>

</html>
