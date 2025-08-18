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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <!-- Preloader end-->

        <!-- Header -->
        <header class="header header-fixed" style="background-color: white !important;">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">مدير الحساب</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    <a href="{{ route('chef_lens.edit-profile') }}">
                        <svg enable-background="new 0 0 461.75 461.75" height="24" viewBox="0 0 461.75 461.75" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m23.099 461.612c2.479-.004 4.941-.401 7.296-1.177l113.358-37.771c3.391-1.146 6.472-3.058 9.004-5.587l226.67-226.693 75.564-75.541c9.013-9.016 9.013-23.63 0-32.645l-75.565-75.565c-9.159-8.661-23.487-8.661-32.645 0l-75.541 75.565-226.693 226.67c-2.527 2.53-4.432 5.612-5.564 9.004l-37.794 113.358c-4.029 12.097 2.511 25.171 14.609 29.2 2.354.784 4.82 1.183 7.301 1.182zm340.005-406.011 42.919 42.919-42.919 42.896-42.896-42.896zm-282.056 282.056 206.515-206.492 42.896 42.896-206.492 206.515-64.367 21.448z" fill="#4A3749"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b40" style="height: 100vh; background-color: white !important;">
            <div class="container pt-0">
                <div class="profile-area">
                    <div>
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" style="border-radius: 50%; height: 100px; width: 100px; margin: auto; display: flex; justify-content: center;" alt="">
                    </div>
                    <div class="author-bx">
                        <div class="dz-content">
                            <h2 class="name" style="text-transform: capitalize">{{ Auth::user()->name }}</h2>
                        </div>
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


                        <div style="width: 100%;" class="swiper-slide">
                            <div class="dz-card list style-4" style="
																								border-color: rgb(235, 2, 2) !important;
																								display: flex !important;">


                                <div class="dz-content" style="flex: 2;">
                                    <h6 class="title">
                                        <a href="javascript:void(0);" onclick="confirmAccountDeletion();">
                                            الغاء الحساب
                                        </a>
                                    </h6>

                                    <form id="delete-account-form" action="{{ route('account.delete') }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <script>
                                        function confirmAccountDeletion() {
                                            Swal.fire({
                                                title: 'هل أنت متأكد؟'
                                                , text: 'Delete لتأكيد الحذف قم بكتابة كلمة '
                                                , icon: 'warning'
                                                , showCancelButton: true
                                                , confirmButtonColor: '#d33'
                                                , cancelButtonColor: '#3085d6'
                                                , confirmButtonText: 'نعم، قم بحذفه!'
                                                , cancelButtonText: 'إلغاء'
                                                , input: 'text'
                                                , inputPlaceholder: 'اكتب كلمة "Delete" للتأكيد'
                                                , inputValidator: (value) => {
                                                    if (value !== 'Delete') {
                                                        return 'يجب أن تكتب كلمة "حذف" للتأكيد!';
                                                    }
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delete-account-form').submit();
                                                }
                                            });
                                        }

                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget_getintuch pb-15 profile">
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
                    </div>
                </div>

                <div class="swiper overlay-swiper2">
                    <div class="" style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; flex-direction: row; gap: 10px;">

                            <div class="dz-card list style-4" style="
                                    {{ Auth::user()->contract_signed_at == null ? 'border-color: red !important;' : 'border-color: green !important;' }}
									display: flex !important;">
                                <div class="" style="flex: 1;">
                                    <i style="
                                            {{ Auth::user()->contract_signed_at == null ? 'color: red;' : 'color: green;' }}
                                            font-size: 35px;" class="fa-solid fa-{{ Auth::user()->contract_signed_at == null ? 'circle-xmark' : 'circle-check' }}"></i>
                                </div>

                                <div class="dz-content" style="flex: 2;">
                                    <h6 class="title">
                                        <a href="{{ route('c1he3f.profile.agrem') }}">إتفاقية الإستخدام</a>
                                        <a href="javascript:void(0);"><i style="color:black;" class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </h6>
                                </div>
                            </div>


                            <div style="width: 48%;" class="swiper-slide">
                                <div class="dz-card list style-4" style="border-color: green !important; display: flex !important;">
                                    <div class="" style="flex: 1;">
                                        <i style="color: green; font-size: 35px;" class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <div class="dz-content" style="flex: 2;">
                                        <h6 class="title">
                                            <a href="{{ route('chef_lens.challenge.challenges-own') }}"> تحدياتي</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: row; gap: 10px;">
                            <div style="width: 48%;" class="swiper-slide">
                                <div class="dz-card list style-4" style="border-color: green !important; display: flex !important;">
                                    <div class="" style="flex: 1;">
                                        <i style="color: green; font-size: 35px;" class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <div class="dz-content" style="flex: 2;">
                                        <h6 class="title">
                                            <a href="overview.html"> مراسلاتي</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            {{-- <div style="width: 48%;" class="swiper-slide">
                                <div class="dz-card list style-4" style="border-color: green !important; display: flex !important;">
                                    <div class="" style="flex: 1;">
                                        <i style="color: green; font-size: 35px;" class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <div class="dz-content" style="flex: 2;">
                                        <h6 class="title">
                                            <a href="overview.html"> المشتريات</a>
                                        </h6>
                                    </div>
                                </div>
                            </div> --}}
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

</body>

</html>
