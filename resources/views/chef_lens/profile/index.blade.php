<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>الملف الشخصي</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/profileDisplayed.css') }}">


    <style>
        .widget_getintuch.pb-15.profile {
            direction: rtl;
        }

        .count-area {
            position: absolute;
            right: 6px;
            top: 3px;
            background: rgb(255, 255, 255);
            color: #000;
            width: 25px;
            z-index: 999999999;
            height: 22px;
            border-radius: 50px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex !important;
        }

        .custom-icon {
            color: white !important;
            font-size: 13px !important;
            font-weight: 400;
        }

        .money-btn {
            width: 100%;
            background-color: #000000c9;
            text-align: center;
            width: 70%;
            border-top-right-radius: 15px !important;
            border-bottom-right-radius: 15px !important;
            height: 42px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
        }

        .order-now {
            background-color: #000000a8;
            text-align: center;
            width: 100%;
            text-align: center;
            width: 100%;
            height: 42px;
            margin-left: 10px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            border-top-left-radius: 15px !important;
            border-bottom-left-radius: 15px !important;
            color: white;
        }

        #menu-btn {
            background-color: #efc00454;
            text-align: center;
            width: 100%;
            text-align: center;
            border: 1px solid #EFBF04;
            width: 70%;
            border-radius: 15px;
            height: 42px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
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
        <header class="header header-fixed" style="background-color: white !important;">
            <div class="header-content">
                <div class="right-content d-flex align-items-center gap-4">
                  <form id="delete-account-form" action="{{ route('account.delete') }}" method="POST" style="display: none;">
                      @csrf
                      @method('DELETE')
                  </form>

                  <a href="javascript:void(0);" onclick="confirmAccountDeletion();">
                      <i style="color: red;
              border: 1px solid red;
              width: 28px;
              height: 28px;
              text-align: center;
              align-items: center;
              display: grid;
              border-radius: 5px;" class="fa-solid fa-trash">
                      </i>
                  </a>


                </div>
                <div class="mid-content">
                    <h4 class="title">مدير الحساب</h4>
                </div>
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </div>
            </div>
        </header>

        <main class="page-content p-b40" style="height: 100vh; background-color: white !important;">
            <div class="container pt-0">
                <div class="profile-section">
                    <div class="profile-container">
                        <div class="profile-info">
                            <img class="img-fluid profile-image" src="{{ asset(path: 'storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                            <h6 class="title">
                                <div id="name-chef" class="name-chef" style="text-transform: capitalize;">
                                    {{ Auth::user()->name }}
                                </div>
                            </h6>
                        </div>
                        <span class="follow-icon">
                            <a style="    width: 35px;
    display: block;
    text-align: center;

" href="{{ route('chef_lens.edit-profile') }}" class="follow-btn" data-chef-id="10" data-is-following="false">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        </span>

                    </div>
                </div>

                <div class="profile-area">
                    <div class="author-bx">
                        <div style="width: 100%;" class="swiper-slide">
                            <div class="dz-card list style-4" style="margin-bottom: 20px; border-color: rgb(2, 45, 235) !important; display: flex !important;">
                                <div class="dz-content" style="flex: 2;">
                                    <h6 class="title">
                                        <a href="#" onclick="soon()">حساب عام</a>
                                        <script>
                                            function soon() {
                                                Swal.fire({
                                                    title: "قريبا!"
                                                    , text: "سيتم إضافة الميزة قريبا!"
                                                    , icon: "success"
                                                });
                                            }

                                        </script>
                                        <p style="color: rgb(88, 88, 88); font-size: 12px;">لتغير نوع الحساب إضغط هنا
                                        </p>
                                    </h6>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="cirlce-parent">
                        <div>
                            <div class="cirlce-child">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                            <span class="stat-count">{{ $likedVideosCount }}</span>
                            <span class="stat-label">إعجاب</span>
                        </div>
                        {{-- <div>

                        <div class="cirlce-child">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <span class="stat-count followers-stat">{{ $chefProfile->followers_count }}</span>
                        <span class="stat-label">متابعة</span>
                    </div> --}}
                    <div>
                        <div class="cirlce-child">
                            <img class="img-fluid vs-icon" src="{{ asset('assets/images/hat.png') }}" alt="">
                        </div>
                        <span class="stat-count">
                            @if($acceptedChallengesCount > 99)
                            99+
                            @else
                            {{ $acceptedChallengesCount }}
                            @endif</span>
                        <span class="stat-label">تحدي</span>
                    </div>
                    <div>
                        <div class="cirlce-child">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <span class="stat-count">{{ $snapsCcount }}</span>
                        <span class="stat-label">عدسه</span>
                    </div>
                </div>

                {{-- <div class="widget_getintuch pb-15 profile">
                        <ul>
                            <li>
                                <div class="icon-bx">
                                    <svg class="svg-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 3H2C1.73478 3 1.48043 3.10536 1.29289 3.29289C1.10536 3.48043 1 3.73478 1 4V20C1 20.2652 1.10536 20.5196 1.29289 20.7071C1.48043 20.8946 1.73478 21 2 21H22C22.2652 21 22.5196 20.8946 22.7071 20.7071C22.8946 20.5196 23 20.2652 23 20V4C23 3.73478 22.8946 3.48043 22.7071 3.29289C22.5196 3.10536 22.2652 3 22 3ZM21 19H3V9.477L11.628 12.929C11.867 13.0237 12.133 13.0237 12.372 12.929L21 9.477V19ZM21 7.323L12 10.923L3 7.323V5H21V7.323Z" fill="#4A3749" />
                                    </svg>
                                </div>
                                <div class="dz-content">
                                    <p class="sub-title">البريد الإلكتروني</p>
                                    <h6 class="title">{{ Auth::user()->email }}</h6>
            </div>
            </li>
            </ul>
    </div> --}}
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

        {{-- Tab 1: Snaps بدون وصفات --}}
        <div id="tab1" class="tab-content active">
            <div class="products-grid">
                @forelse ($snapsWithOutRecipes as $snap)
                <div class="product-card">
                    <div class="video-overlay" style="max-height: 180px;">
                        @if(file_exists(storage_path('app/public/' . $snap->video_path)))
                        <video muted preload="metadata" style="max-height: 190px; width: 100%;">
                            <source src="{{ asset('storage/' . $snap->video_path) }}" type="video/mp4">
                            الفيديو غير موجود
                        </video>
                        @else
                        <div style="background: #eee; height: 190px; display: flex; align-items: center; justify-content: center;">
                            <p>الفيديو غير موجود</p>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center w-100">
                    <p>لا توجد فيديوهات متاحة</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Tab 2: التحديات المقبولة --}}
        <div id="tab2" class="tab-content">
            <div class="products-grid">
                @forelse ($acceptedChallenges as $challenge)
                <div class="product-card">
                    <div class="video-overlay" style="max-height: 180px;">
                        @if(file_exists(storage_path('app/public/' . $challenge->announcement_path)))
                        <video muted preload="metadata" style="max-height: 190px; width: 100%;">
                            <source src="{{ asset('storage/' . $challenge->announcement_path) }}" type="video/mp4">
                            الفيديو غير موجود
                        </video>
                        @else
                        <div style="background: #eee; height: 190px; display: flex; align-items: center; justify-content: center;">
                            <p>الفيديو غير موجود</p>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center w-100">
                    <p>لا توجد تحديات مقبولة</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Tab 3: Snaps مع الوصفات --}}
        <div id="tab3" class="tab-content">
            <div class="products-grid">
                @forelse ($snapsWithRecipes as $snap)
                <div class="product-card">
                    <div class="video-overlay" style="max-height: 180px;">
                        @if(file_exists(storage_path('app/public/' . $snap->video_path)))
                        <video muted preload="metadata" style="max-height: 190px; width: 100%;">
                            <source src="{{ asset('storage/' . $snap->video_path) }}" type="video/mp4">
                            الفيديو غير موجود
                        </video>
                        @else
                        <div style="background: #eee; height: 190px; display: flex; align-items: center; justify-content: center;">
                            <p>الفيديو غير موجود</p>
                        </div>
                        @endif

                        {{-- عرض معلومات الوصفة إذا كانت موجودة --}}
                        @if($snap->recipe)
                        <div class="recipe-info">
                            <small>{{ $snap->recipe->name }}</small>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center w-100">
                    <p>لا توجد وصفات متاحة</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>


    </div>
    </main>
    <!-- Main Content End -->


    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
    <script>
        function confirmAccountDeletion() {
        Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "سيتم حذف حسابك بشكل دائم ولا يمكن التراجع عن هذا الإجراء!",
        icon: 'warning',
        input: 'text',
        inputPlaceholder: 'اكتب كلمة "delete" للتأكيد',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'نعم، احذف حسابي!',
        cancelButtonText: 'إلغاء',
        inputValidator: (value) => {
        if (value !== 'delete') {
        return 'يجب أن تكتب كلمة "delete" للمتابعة!';
        }
        }
        }).then((result) => {
        if (result.isConfirmed) {
        document.getElementById('delete-account-form').submit();
        }
        });
        }

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
