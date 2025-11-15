<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <!-- Title -->
    <title>واجهة الطاهي</title>

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
    {!! $swalScript !!}
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
        <header class="header header-fixed">
            <div class="header-content">
                <div class="mid-content">
                    <h4 class="title">التصنيفات</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('c1he3f.index') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top">
            <div class="container">
                <!-- SearchBox -->
                <div class="search-box">
                    <div class="input-group input-radius input-rounded input-lg">
                        <input type="search" placeholder="ما هي الوصفات التي تبحث عنها" class="form-control">
                        <span class="input-group-text">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.65925 19.3102C11.8044 19.3103 13.8882 18.5946 15.5806 17.2764L21.9653 23.6612C22.4423 24.1218 23.2023 24.1086 23.663 23.6316C24.1123 23.1664 24.1123 22.4288 23.663 21.9635L17.2782 15.5788C20.5491 11.3682 19.7874 5.30333 15.5769 2.03243C11.3663 -1.23848 5.30149 -0.476799 2.03058 3.73374C-1.24033 7.94428 -0.478646 14.0092 3.73189 17.2801C5.42702 18.5969 7.51269 19.3113 9.65925 19.3102ZM4.52915 4.5273C7.36245 1.69394 11.9561 1.69389 14.7895 4.5272C17.6229 7.3605 17.6229 11.9542 14.7896 14.7876C11.9563 17.6209 7.36261 17.621 4.52925 14.7877C4.5292 14.7876 4.5292 14.7876 4.52915 14.7876C1.69584 11.9749 1.67915 7.39794 4.49181 4.56464C4.50424 4.55216 4.51667 4.53973 4.52915 4.5273Z" fill="#C9C9C9" />
                            </svg>
                        </span>
                    </div>
                </div>
                <!-- SearchBox -->
<script>
    // إضافة وظيفة البحث
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-box input[type="search"]');

    if (searchInput) {
    searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase().trim();
    filterRecipes(searchTerm);
    });
    }

    function filterRecipes(searchTerm) {
    // البحث في جميع الوصفات
    const recipeCards = document.querySelectorAll('.dz-card.list');
    let hasVisibleResults = false;

    recipeCards.forEach(function(card) {
    const title = card.querySelector('.title a') ? card.querySelector('.title a').textContent.toLowerCase() : '';
    const tags = card.querySelectorAll('.tag-list a');
    let tagText = '';

    tags.forEach(tag => {
    tagText += tag.textContent.toLowerCase() + ' ';
    });

    const shouldShow = searchTerm === '' ||
    title.includes(searchTerm) ||
    tagText.includes(searchTerm);

    const listItem = card.closest('li');
    if (listItem) {
    listItem.style.display = shouldShow ? 'block' : 'none';
    if (shouldShow) hasVisibleResults = true;
    }
    });

    // إخفاء/إظهار رسالة "لا توجد نتائج"
    showNoResultsMessage(!hasVisibleResults && searchTerm !== '');
    }

    function showNoResultsMessage(show) {
    // إزالة رسائل "لا توجد نتائج" السابقة
    const existingMessage = document.querySelector('.no-results-message');
    if (existingMessage) {
    existingMessage.remove();
    }

    if (show) {
    const productsLists = document.querySelectorAll('.products-list');
    productsLists.forEach(list => {
    const noResultsMsg = document.createElement('li');
    noResultsMsg.className = 'no-results-message';
    noResultsMsg.innerHTML = `
    <div class="dz-card list">
        <div class="dz-content">
            <h6 class="title">لا توجد وصفات تطابق البحث</h6>
        </div>
    </div>
    `;
    list.appendChild(noResultsMsg);
    });
    }
    }
    });

</script>
                <!-- Products Area -->
                <div class="dz-custom-swiper">
                    <div thumbsSlider="" class="swiper mySwiper dz-tabs-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($mainCategories as $mainCategorie)
                            <div class="swiper-slide {{ $selectedCategory->id == $mainCategorie->id ? 'swiper-slide-active' : '' }}">
                                <h5 class="title">{{ $mainCategorie->name_ar }}</h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">
                            @foreach ($mainCategories as $mainCategorie)
                            <div class="swiper-slide {{ $selectedCategory->id == $mainCategorie->id ? 'swiper-slide-active' : '' }}">
                                <ul class="products-list">
                                    @forelse ($mainCategorie->recipes as $recipe)
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-media">
                                                <a href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">
                                                    <img style="max-height: 132px;" src="{{ asset('storage/' . $recipe->dish_image) }}" alt="{{ $recipe->title }}">
                                                </a>
                                                <div class="dz-rating" style="background-color: var(--primary);">
                                                    <i class="fa fa-heart"></i> {{ $recipe->likes_count ?? 0 }}
                                                </div>
                                            </div>
                                            <div class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <a href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}">{{ $recipe->title }}</a>
                                                    </h6>
                                                    <ul class="tag-list">
                                                        @if ($recipe->subCategories)
                                                        @foreach ($recipe->subCategories as $subCategory)
                                                        <li><a href="{{ url()->previous() ?: route('home') }}">{{ $subCategory->name_ar }}</a></li>
                                                        @endforeach
                                                        @endif
                                                        @if ($recipe->chef)
                                                        <li style="display: block;">
                                                            <a href="javascript:void(0)">الطاهي / {{ $recipe->chef->name }}</a>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <ul class="dz-meta">
                                                    <li class="dz-price flex-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z" stroke="#17191C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M6.5 11H18.5" stroke="#17191C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M6.5 13H12.5H18.5" stroke="#17191C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>{{ $recipe->price ?? '0.00' }}
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('c1he3f.recpies.showChefRecipes', $recipe->id) }}" class="btn rounded-xl dz-buy-btn">
                                                            <i class="fa fa-eye"></i> عرض
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-content">
                                                <h6 class="title">لا توجد وصفات لهذا التصنيف</h6>
                                            </div>
                                        </div>
                                    </li>
                                    @endforelse
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Products Area -->
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

                </style> 
                <a href="{{ route('c1he3f.recpies.add-recpie') }}" class="plus-btn"> <span style="position: relative; top: -4px;">+</span> </a>

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
