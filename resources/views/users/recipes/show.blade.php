<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- Title -->
    <title>عرض الوصفة</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/user-logo/favicon.png') }}">

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
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
        <header class="header header-fixed transparent">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ url()->previous() ?: route('home') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">عرض الوصفة</h4>
                </div>

            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content p-b80">
            <div class="container p-0">
                <div class="dz-product-preview bg-primary">
                    <div class="swiper product-detail-swiper">
                        <div class="overlay"
                            style="position: absolute; z-index: 999999; height: 370px; width: 100%; background-color: rgba(0, 0, 0, 0.5);">
                        </div>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="dz-media">
                                    <img style="height: 370px;" src="{{ asset('storage/' . $recipe->dish_image) }}"
                                        alt="">
                                </div>
                            </div>
                            <!-- <div class="swiper-slide">
								<div class="dz-media">
									<img style="height: 370px;"
										src="https://img.freepik.com/free-photo/chicken-fajita-chicken-fillet-fried-with-bell-pepper-lavash-with-bread-slices-white-plate_114579-174.jpg?uid=R118249704&ga=GA1.1.696324772.1728654570&semt=ais_hybrid&w=740"
										alt="">
								</div>
							</div> -->
                        </div>
                    </div>
                </div>
                <div class="dz-product-detail" style="direction: rtl;">

                    <!-- <div class="dz-handle"></div> -->
                    <div class="detail-content">
                        <h4 class="title">{{ $recipe->title }}</h4>
                        <ul class="tag-list" style="display: flex; gap: 10px;">
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-utensils" style="color: var(--primary);"></i>
                                {{ $recipe->preparation_time }} دقيقة
                            </li>
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-eye" style="color: var(--primary);"></i>
                                {{ $recipe->views }}
                            </li>
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-heart" style="color: var(--primary);"></i>
                                {{ $favorites_count }}
                            </li>
                        </ul>

                        <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;" class="tags">
                            <img src="{{ asset('storage/' . $recipe->kitchen->image) }}" style="
								border-radius: 50%; width: 30px; height: 30px;" alt="">
                            {{ $recipe->kitchen->name_ar }}
                        </div>

                        <div style="display: flex; gap: 10px; align-items: center;">
                            <!-- حالة الوصفة مدفوع مجاني -->
                            <div
                                style="background-color: #9c8500; color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                {{ $recipe->is_free == '0' ? 'مدفوعة' : 'مجانية' }}
                            </div>
                            <!-- التصنيف الرئيسي -->
                            <div
                                style="background-color: #660099; color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                {{ $recipe->mainCategories?->name_ar ?? 'غير مصنف' }}
                            </div>
                            <!-- التصنيف الفرعي -->
                            <div
                                style="background-color: green; color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                @forelse ($recipe->subCategories as $subCategory)
                                {{ $subCategory->name_ar }}
                                @empty
                                لا توجد
                                @endforelse
                            </div>

                        </div>
                    </div>
                    @if($recipe->chef != null)
                    <div style="display: flex;">
                        <div class="dz-item-rating"
                            style="background-color: #660099; font-size: 17px; overflow: hidden; line-height: unset; border: 2px solid #660099;">
                            <img src="{{ asset('storage/' . $recipe->chef->chefProfile->official_image ) }}" style="width: 100%; height: 100%;" alt="">
                        </div>
                        <h5 style="position: absolute; right: 100px; top: 10px; font-size: 14px; color: gray;">
                            الشيف : {{ $recipe->chef->name }}
                        </h5>
                    </div>
                    @endif

                    <div class="item-wrapper">
                        <div class="dz-meta-items">
                            <div class="dz-price flex-1" style="justify-content: space-between; display: flex;">
                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <sub>
                                            <i class="fa fa-users"
                                                style="font-size: 14px; margin-left: 5px; "></i></sub> 
                                                {{ $recipe->servings }}
                                    </div>

                                    <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                        عدد الأشخاص
                                    </div>
                                </div>
                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <sub>
                                            <i class="fa fa-clock"
                                                style="font-size: 14px; margin-left: 5px;"></i></sub>{{ $recipe->preparation_time }}د
                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                        وقت التحضير
                                    </div>
                                </div>
                                @if($recipe->is_free == '0')
                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <sub>
                                            <i class="fa fa-coins" style="font-size: 14px;"></i></sub>{{ $recipe->price }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z"
                                                stroke="#000" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6.5 11H18.5" stroke="#000" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6.5 13H12.5H18.5" stroke="#000" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray; border-radius: 5px;">
                                        السعر
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="item-wrapper"
                        style=" justify-content: center; display: flex; align-items: center; gap: 10px; flex-direction: row; margin-top: 30px;">
                        <button class="btn btn-primary" style="padding: 6px 18px !important;">
                            <a href="{{ route('users.meals.ingredients', $recipe->id) }}" style="color: white;">المكونات</a>
                        </button>
                        <button class="btn btn-warning" style="padding: 6px 18px !important;">
                            <a href="{{ route('users.meals.steps', $recipe->id) }}" style="color: white;">
                                الخطوات
                            </a>
                        </button>
                        <button class="btn btn-success" style="padding: 6px 18px !important;"><a 
                            href="{{ route('users.meals.ingredients', $recipe->id) }}"
                                style="color: white;">الحقائق</a> </button>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content End -->

        <!-- <div class="footer fixed bg-white">
			<div class="container">
				<a href="cart.html" class="btn btn-primary btn-lg rounded-xl btn-thin w-100 gap-2">Place order <span
						class="opacity-25">$17.4</span></a>
			</div>
		</div> -->
    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wnumb/wNumb.js') }}"></script>
    <script src="{{ asset('assets/js/noui-slider.init.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>