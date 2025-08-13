<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>المحفوظات</title>

    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uXU3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="shortcut icon" type="image/x-icon" href="assets/images/app-logo/favicon.png">

    <link rel="manifest" href="manifest.json">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        * {
            direction: rtl;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

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
            color: white;
        }

        .order-now {
            background-color: #000000a8;
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
            width: 70%;
            border: 1px solid #EFBF04;
            border-radius: 15px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
        }

        .header-content {
            direction: rtl;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
        }

        #carts-chef {
            border: 0;
            box-shadow: none;
            background: transparent;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 0px;
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

        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .dz-custom-swiper {
            margin-top: 84px;
            padding: 20px;
        }

        .swiper-slide {
            padding: 10px;
        }

        .swiper-slide h5 {
            text-align: center;
            padding: 15px;
            background: #000000;
            border-radius: 10px;
            margin: 0;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .swiper-slide-thumb-active h5 {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .title i {
            color: white;
        }

        .featured-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 15px;
        }

        .grid-layout {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-layout li {
            width: 100%;
            height: fit-content;
        }

        .grid-layout video {
            height: 100%;
            border-radius: 14px;
            width: 100%;
        }

        .list-layout {
            grid-template-columns: 1fr;
        }

        @media (max-width: 576px) {
            .grid-layout {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        .dz-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            background: usnet !important;
        }

        .dz-card:hover {
            transform: translateY(-5px);
        }

        .w-full {
            width: 100%;
            position: relative;
        }

        .w-full a {
            display: block;
            width: 100%;
            text-decoration: none;
        }

        .w-full img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
        }

        .grid-layout .w-full img {
            height: 120px;
        }

        /* Delete button styles */
        .delete-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .delete-btn:hover {
            background: rgba(255, 0, 0, 1);
            transform: scale(1.1);
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #333;
            padding: 5px 10px;
            border-radius: 50%;
            transition: background 0.3s ease;
        }

        .back-btn:hover {
            background: #f0f0f0;
        }

        .separator {
            width: 100%;
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .dz-custom-swiper {
                padding: 10px;
            }

            .grid-layout {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Animation for item removal */
        .item-removing {
            animation: fadeOut 0.5s ease-in-out;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.8);
            }
        }

    </style>
    <style>
        .back--btn {
            background: #000000;
            width: 50px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            border-radius: 50%;
        }

        .back--btn i {
            font-size: 23px;
            color: white;
        }

        .dz-card.list {
            margin-bottom: 0px;
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="page-wrapper" style="top: -19px; position: relative;">
        <div id="preloader">
            <div class="loader"></div>
        </div>
        <div class="dz-nav-floting">
            <header class="header" style="position: fixed; width: 100%; top: 0px; background-color: rgb(0, 0, 0) !important; border-bottom: 1px solid #ffffff;">
                <div class="header-content">
                    <div class="left-content"></div>
                    <div class="mid-content">
                        <span style="font-weight: bold; font-size: 16px; color: #ffffff;">المحفوظات</span>
                    </div>
                    <div class="right-content">
                        <a href="{{ route('chef_lens') }}" class="back--btn">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </div>
                </div>
            </header>

            <div class="dz-custom-swiper" style="background: white;">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide swiper-slide-active">
                            <h5 class="title">
                                <i class="fa-solid fa-bookmark"></i>
                            </h5>
                        </div>
                        <div class="swiper-slide">
                            <h5 class="title">
                                <i class="fa-solid fa-thumbs-up"></i> </h5>

                        </div>
                        <div class="swiper-slide">
                            <h5 class="title">
                                <i class="fa-solid fa-utensils"></i>
                            </h5>
                        </div>
                        
                    </div>
                </div>

                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <ul class="featured-list grid-layout" id="videos-list">
                                @foreach($savedChallenges as $video)
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <button class="delete-btn" onclick="deleteItem(this, 'challenge', {{ $video->id }})" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <video class="myVideo video-reel" autoplay preload="metadata" muted>
                                                <source src="{{ 'storage/' . $video->announcement_path }}" type="video/mp4">
                                                المتصفح لا يدعم HTML5 video.
                                            </video>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @foreach($savedSnaps as $video)
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <button class="delete-btn" onclick="deleteItem(this, 'snap', {{ $video->id }})" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <video class="myVideo video-reel" autoplay preload="metadata" muted>
                                                <source src="{{ 'storage/' . $video->video_path }}" type="video/mp4">
                                                المتصفح لا يدعم HTML5 video.
                                            </video>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="swiper-slide">
                            <ul class="featured-list grid-layout" id="liked-list">
                                @foreach($likedChallenges as $video)
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <button class="delete-btn" onclick="deleteItem(this, 'challenge', {{ $video->id }})" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <video class="myVideo video-reel" autoplay preload="metadata" muted>
                                                <source src="{{ 'storage/' . $video->announcement_path }}" type="video/mp4">
                                                المتصفح لا يدعم HTML5 video.
                                            </video>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @foreach($likedSnaps as $video)
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <button class="delete-btn" onclick="deleteItem(this, 'snap', {{ $video->id }})" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <video class="myVideo video-reel" autoplay preload="metadata" muted>
                                                <source src="{{ 'storage/' . $video->video_path }}" type="video/mp4">
                                                المتصفح لا يدعم HTML5 video.
                                            </video>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="swiper-slide">
                            <ul class="featured-list grid-layout" id="recipes-list">
                                <li>
                                    <div class="dz-card list">
                                        <div class="w-full">
                                            <button class="delete-btn" onclick="deleteItem(this, 'recipe', 1)" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <a href="show-recipe.html">
                                                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=300&fit=crop" alt="باستا كاربونارا">
                                                <div class="recipe-overlay">
                                                    <div class="recipe-info">
                                                        <h6 style="text-align: center; padding: 2px; margin-bottom: 13px;">باستا كاربونارا</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>

                <script>
                    // Hide preloader when page loads
                    window.addEventListener('load', function() {
                        document.getElementById('preloader').style.display = 'none';
                    });

                    // Initialize Swiper
                    let tabSwiper, contentSwiper;

                    document.addEventListener('DOMContentLoaded', function() {
                        // Tab navigation swiper
                        tabSwiper = new Swiper('.mySwiper', {
                            spaceBetween: 10
                            , slidesPerView: 3
                            , watchSlidesProgress: true
                            , centeredSlides: false
                            , direction: 'horizontal'
                            , rtl: true
                        });

                        // Content swiper
                        contentSwiper = new Swiper('.mySwiper2', {
                            spaceBetween: 30
                            , rtl: true
                            , thumbs: {
                                swiper: tabSwiper
                            , }
                        , });

                        // Sync swipers
                        tabSwiper.on('slideChange', function() {
                            contentSwiper.slideTo(tabSwiper.activeIndex);
                        });

                        contentSwiper.on('slideChange', function() {
                            tabSwiper.slideTo(contentSwiper.activeIndex);
                        });
                    });

                    // تحديث دالة deleteItem في الـ JavaScript

                function deleteItem(button, type, videoId) {
                const listItem = button.closest('li');

                // Validate type
                if (!['challenge', 'snap'].includes(type)) {
                Swal.fire({
                title: 'خطأ!',
                text: 'نوع الفيديو غير صالح',
                icon: 'error'
                });
                return;
                }

                const parentList = button.closest('ul');
                const listType = parentList.id === 'liked-list' ? 'liked' : 'saved';
                const itemName = type === 'challenge' ? 'التحدي' : 'السناب';

                Swal.fire({
                title: 'هل أنت متأكد؟',
                text: `سيتم حذف ${itemName} من القائمة`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                // Send delete request
                fetch(`/videos/${videoId}/remove`, {
                method: 'DELETE',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                type: type,
                list: listType // Add list context ('saved' or 'liked')
                })
                })
                .then(response => response.json())
                .then(data => {
                if (data.success) {
                listItem.classList.add('item-removing');
                setTimeout(() => {
                listItem.remove();
                Swal.fire({
                title: 'تم الحذف!',
                text: data.message,
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
                });
                }, 500);
                } else {
                Swal.fire({
                title: 'خطأ!',
                text: data.error || 'حدث خطأ أثناء الحذف',
                icon: 'error'
                });
                }
                })
                .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                title: 'خطأ!',
                text: 'حدث خطأ في الاتصال بالخادم',
                icon: 'error'
                });
                });
                }
                });
                }


                </script>
</body>

</html>
