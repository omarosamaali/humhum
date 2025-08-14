<!DOCTYPE html>
<html lang="en">

<head>
    <title>الملف الشخصي</title>
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
    <style>
        .count-area {
            position: absolute;
            right: 6px;
            top: 3px;
            background: rgb(0, 0, 0);
            width: 25px;
            z-index: 999999999;
            height: 22px;
            border-radius: 70px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex !important;
        }

        .custom-icon {
            color: black !important;
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
            color: black;
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
            color: black;
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
            color: black;
        }

        .header-content,
        .container--btns {
            direction: rtl;
        }

        .header {
            z-index: 9999999999999999999999;
        }

        #carts-chef {
            border: 0;
            box-shadow: none;
            background: transparent;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0px;
            flex-direction: row;
            gap: 4px;
            margin-left: 56px !important;
        }

        button {
            border: 0px;
        }

        #name-chef {
            font-weight: 400;
            font-size: 16px;
        }

        .video-reels-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            overflow-x: scroll;
            overflow-y: hidden;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .video-reel-item {
            flex: 0 0 100%;
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
            padding: 4px;
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
            padding: 4px;
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
            color: black;
            justify-content: end;
            display: flex;
            font-size: 29px;
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

        .video-reels-container-icons {
            z-index: 99999999;
            position: relative;
            display: flex;
            flex-direction: row;
            top: -20px;
            width: 100%;
            justify-content: center;
            color: black;
            font-size: 22px;
            gap: 13px;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .profile-image {
            padding: 3px;
            display: flex;
            text-align: center;
            border-radius: 50%;
            margin: auto;
            width: 90px;
            height: 90px;
            display: flex;
            text-align: center;
        }

        .widget_getintuch.pb-15.profile {
            direction: rtl;
        }

        #flag-image {
            width: 50px;
            height: 30px;
            z-index: 9;
            position: absolute;
            top: 14px;
            right: 16px;
        }

        li {
            width: fit-content;
            width: 100%;

        }

        li .dz-card.list,
        .w-full {
            width: 100%;
        }

        .w-full a {
            width: 100%;
            display: block;
        }

        .w-full a img {
            width: 100%;
        }

        .cirlce-parent {
            margin: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .cirlce-child i {
            color: rgb(0, 0, 0);
            font-size: 28px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            margin: auto;
            top: 8px;
            position: relative;
        }

        .cirlce-child {
            border: 1px solid rgb(0, 0, 0);
            padding: 2px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .vs-icon {
            padding: 3px;
            display: flex;
            text-align: center;
            border-radius: 50%;
            margin: auto;
            width: 50px;
            height: 42px;
            display: flex;
            text-align: center;
        }

        .sub-btn {
            position: fixed;
            width: 100%;
            left: -21px;
            bottom: -19px;
            margin: 20px;
            background: white;
            color: black;
            border-radius: 0px;
        }

        .sub-btn:hover {
            background-color: #c4bfbf !important;
            color: unset !important;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div style="top: 73px; position: fixed; padding: 15px 0px; display: grid; gap: 10px; grid-template-columns: 1fr; width: 100%; z-index: 9999999999999;">
            <span style="width: 100%; background-color: rgb(111 111 111); height: 1px;"></span>
        </div>
        <div class="dz-nav-floting" style="background-color: white;">
            <header class="header py-2 mx-auto" style="background-color: white; position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                        <i onclick="openAlert()" class="fa-solid fa-skull-crossbones" style="font-size: 22px; color: red;"></i>
                    </div>
                    <div class="mid-content">
                        <img src="{{ asset('assets/images/Isolation_Mode.png') }}" style="height: 53px; position: relative; right: 11px;" alt="">
                    </div>
                    <div class="right-content d-flex align-items-center gap-4">
                        <a href="javascript:void(0);" class="back-btn">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </div>
                </div>
            </header>
            <script>
                function openAlert() {
                    Swal.fire({
                        title: "بلاغ؟"
                        , text: 'لماذا تقوم بالإبلاغ عن هذا الحساب؟'
                        , showDenyButton: true
                        , showCancelButton: true,
                        confirmButtonText: "الإبلاغ عن المنشور أو الرسالة أو التعليق"
                        , denyButtonText: "حساب وهمي"
                        , cancelButtonText: "الغاء"
                    , }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire("تم الإبلاغ!", "", "success");
                        } else if (result.isDenied) {
                            Swal.fire("تم الإبلاغ!", "", "success");
                        }
                    });
                }
            </script>
            <div style="direction: rtl; display: flex; flex-direction: row; margin-top: 100px;">
                <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 4px; justify-content: space-between; margin-right: 20px;">
                        <img class="img-fluid profile-image" src="./assets/images/chef.jpeg" alt>
                        <h6 class="title">
                            <div id="name-chef" style="color: black;">
                                احمد عبدالقادر
                            </div>
                        </h6>
                    </div>
                    <span style="margin-left: 20px;">
                        <i style="    border: 1px solid black;
    padding: 5px;
    border-radius: 8px;
    background: black;
    color: white;
" class="fa-solid fa-user-plus"></i>
                    </span>
                </div>
            </div>

            <div style="    position: relative;
    top: -35px;
	    right: 8px;

color: black;     margin-right: 108px;
    text-align: right;
">

                <span style="    color: black;
    text-align: right;
    top: 2px;
    right: 0px;

    position: relative;
">الامارات العربية المتحدة</span>
                <img id="" style="    width: 23px;
height: 16px;
z-index: 99999999999;
" src="https://img.freepik.com/free-photo/flag-united-arab-emirates_1401-251.jpg?uid=R118249704&amp;ga=GA1.1.696324772.1728654570&amp;semt=ais_hybrid&amp;w=740" class="flag" alt="">
            </div>
            <div class="video-reels-container-icons">
                <div><i class="fa-brands fa-youtube"></i></div>
                <div><i class="fa-brands fa-tiktok"></i></div>
                <div><i class="fa-brands fa-instagram"></i></div>
                <div><i class="fa-brands fa-snapchat"></i></div>
                <div><i class="fa-brands fa-facebook"></i></div>
            </div>
            <p style="text-align: center; width: 90%; margin: auto;">
                "الطَّبَّاخُ المشهورُ هو سَفيرُ النَّكهاتِ وحَكيمُ المَطبخِ، يَمزجُ بينَ الأصالةِ
                والحداثةِ بِبراعةٍ فائقةٍ.
                هَكَذا يُصبحُ الطَّعامُ عِندَهُ لُغةً تُحَكِي حِكاياتِ العالَمِ! 😊🍴
            </p>
            <div class="video-reels-container">
            </div>
            <div class="cirlce-parent">
                <div>
                    <div class="cirlce-child">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <span style="display: block; color:black !important; text-align:center;">12k</span>
                    <span style="display: block; color:black !important; text-align:center;">إعجاب</span>
                </div>
                <div>
                    <div class="cirlce-child">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span style="display: block; color:black !important; text-align:center;">6k</span>
                    <span style="display: block; color:black !important; text-align:center;">متابعة</span>
                </div>
                <div>
                    <div class="cirlce-child">
                        <img class="img-fluid vs-icon" src="./assets/images/hat.png" alt="">
                    </div>
                    <span style="display: block; color:black !important; text-align:center;">12k</span>
                    <span style="display: block; color:black !important; text-align:center;">تحدي</span>
                </div>
                <div>
                    <div class="cirlce-child">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <span style="display: block; color:black !important; text-align:center;">123</span>
                    <span style="display: block; color:black !important; text-align:center;">عدسه</span>
                </div>

            </div>
            <div class="dz-custom-swiper" style="direction: rtl;">
                <div thumbsslider="" class="swiper mySwiper dz-tabs-swiper swiper-initialized swiper-horizontal swiper-rtl swiper-backface-hidden swiper-thumbs">
                    <div class="swiper-wrapper" id="swiper-wrapper-652fef0ff29b4ef4" aria-live="polite" style="justify-content: space-between; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms; transition-delay: 0ms;">
                        <div class="swiper-slide swiper-slide-visible swiper-slide-active" role="group" aria-label="1 / 5">
                            <h5 class="title">
                                <i class="fa-solid fa-camera"></i>
                            </h5>
                        </div>
                        <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-next swiper-slide-thumb-active" role="group" aria-label="2 / 5">
                            <h5 class="title"><i class="fa-solid fa-video-camera"></i>
                            </h5>
                        </div>
                        <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-next swiper-slide-thumb-active" role="group" aria-label="3 / 5">
                            <h5 class="title"><i class="fa-solid fa-utensils"></i></h5>
                        </div>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div class="swiper mySwiper2 dz-tabs-swiper2 swiper-initialized swiper-horizontal swiper-rtl swiper-backface-hidden">
                    <div class="swiper-wrapper" id="swiper-wrapper-1f2a7daa9e3dd3ba" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(360px, 0px, 0px); transition-delay: 0ms;">
                        <div class="swiper-slide swiper-slide-prev" role="group" aria-label="1 / 2" style="width: 345px;     padding: 4px;">
                            <ul class="featured-list">
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="2 / 2" style="width: 345px;     padding: 4px;">
                            <ul class="featured-list" style="row-gap: 7px; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); column-gap: 1px; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));">
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>

                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <a href="show-vs.html"><img src="assets/images/products/product5.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
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

</body>

</html>
