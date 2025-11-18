<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <!-- Title -->
    <title>Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta name="keywords"
        content="android, ios, mobile, mobile template, mobile app, ui kit, dark layout, app, delivery, ecommerce, material design, mobile, mobile web, order, phonegap, pwa, store, web app, Ombe, coffee app, coffee template, coffee shop, mobile UI, coffee design, app template, responsive design, coffee showcase, style app, trendy app, modern UI, technology, User-Friendly Interface, Coffee Shop App, PWA (Progressive Web App), Mobile Ordering, Coffee Experience, Digital Menu, Innovative Technology, App Development, Coffee Experience, cafe, bootatrap, Bootstrap Framework, UI/UX Design, Coffee Shop Technology, Online Presence, Coffee Shop Website, Cafe Template, Mobile App Design, Web Application, Digital Presence, ">

    <meta name="description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta property="og:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        .container-cart {
            box-shadow: 0px 0px 3px 3px #ededed;
            border-radius: 20px;
            background: #fafafa;
        }

        .dz-card.list {
            display: flex;
            margin-bottom: 0px !important;
            overflow: visible;
        }

        .featured-list li:last-child .dz-card.list {
            margin-bottom: 20px;
        }

        .dz-card {
            position: relative;
            height: 100%;
            border-radius: var(--border-radius-xl);
            overflow: hidden;
        }

        .dz-card.list .dz-media {
            margin-left: 20px;
            overflow: visible;
            max-width: 112px;
            min-width: 112px;
        }

        .bookmark {
            position: absolute;
            bottom: 10px;
            text-align: center;
            align-items: center;
            justify-content: end;
            display: flex;
            margin: auto;
            left: 17px;
            width: 100%;
        }

        .dz-card.list .dz-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
            padding: 10px 0;
        }

        .dz-card.list .dz-media img {
            display: flex;
            border-radius: var(--border-radius-xl);
            width: 100%;
            height: 100%;
        }

        .container-cart img {
            border-radius: 0px 20px 20px 0px !important;
        }

        label input {
            width: 23px !important;
            height: 28px !important;
        }

        .correct {
            position: absolute;
            font-size: 18px;
            left: 1px;
            top: 26px;
            font-size: 13px;
            border: 0px;
            background-color: red;
            border-radius: 5px;
            padding: 7.8px 10px;
            color: white;
        }

        :root {
            --primary: #29A500 !important;
            --primary-color: #29A500 !important;
        }

        .menu {
            background: #29A500;
            color: white;
            border-radius: 5px;
            padding: 7.5px 10px;
        }

        .recpie-name {
            text-align: center;
            background: black;
            color: white;
            border-radius: 15px 15px 0px 0px;
            padding: 8px;
            margin-bottom: 0px;
        }

        .container-date {
            text-align: center;
            background-color: black;
            color: white;
            width: 112px;
            height: 118px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .btn.btn-sm,
        .btn-group-sm>.btn {
            padding: 7px 10px;
            font-size: 14px;
            font-weight: 500;
            margin-top: 7px;
            margin-left: 7px;
            line-height: 1;
            border-radius: var(--border-radius);
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
        <header class="header header-fixed">
            <div class="header-content">
                <div class="mid-content">
                    @php
                    $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';

                    $mealTranslations = [
                    'ar' => 'وجبة إفطار',
                    'en' => 'Breakfast Meal',
                    'hi' => 'नाश्ता भोजन',
                    'id' => 'Makan Sarapan',
                    'am' => 'የቁርስ ምግብ',
                    'bn' => 'সকালের খাবার',
                    'ml' => 'പ്രഭാതഭക്ഷണ വിഭവം',
                    'fil' => 'Almusal na Pagkain',
                    'ur' => 'ناشتہ کھانا',
                    'ta' => 'காலை உணவு வகை',
                    'ne' => 'बिहानको खाना',
                    'ps' => 'د سهار ډوډۍ',
                    'fr' => 'Repas du petit-déjeuner',
                    ];
                    $mealTitle = $mealTranslations[$lang] ?? $mealTranslations['ar'];

                    function tdb($model, $lang, $field = 'name')
                    {
                    if (!$model || !is_object($model)) return '—';
                    $key = "{$field}_{$lang}";
                    $value = $model->$key ?? $model->{"{$field}_ar"} ?? $model->$field ?? '';
                    return is_string($value) ? trim($value) : '—';
                    }
                    @endphp
                    <h4 class="title">{{ $mealTitle }} {{ $recipe->meal_date }}</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('families.meals.show' , $recipe->id) }}" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top">
            <div class="container">
                <!-- Products Area -->
                <div class="swiper mySwiper2 dz-tabs-swiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <ul class="featured-list">
                                <!-- الوجبة الرئيسية -->
                                <a href="{{ route('families.meals.show-meal', $recipe->recipe->id) }}"
                                    style="display: block; margin-bottom: 20px;" class="container-cart">
                                    @php
                                    // 1. تحديد اللغة
                                    $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';

                                    // 2. ترجمة "الوجبة الرئيسية" فقط (13 لغة)
                                    $mainMealTranslations = [
                                    'ar' => 'الوجبة الرئيسية',
                                    'en' => 'Main Meal',
                                    'hi' => 'मुख्य भोजन',
                                    'id' => 'Makanan Utama',
                                    'am' => 'ዋናው ምግብ',
                                    'bn' => 'প্রধান খাবার',
                                    'ml' => 'പ്രധാന ഭക്ഷണം',
                                    'fil' => 'Pangunahing Pagkain',
                                    'ur' => 'بنیادی کھانا',
                                    'ta' => 'முதன்மை உணவு',
                                    'ne' => 'मुख्य खाना',
                                    'ps' => 'اصلي خواړه',
                                    'fr' => 'Repas principal',
                                    ];
                                    $translations = [
                                    'ar' => [
                                    'next_meal_is' => 'الوجبة القادمة هي',
                                    'none' => 'لا يوجد',
                                    'no_plans' => 'لا توجد خطط حاليًا',
                                    'cooking_schedule_details' => 'تفاصيل جدول الطبخ',
                                    'meal' => 'وجبة',
                                    'person' => 'شخص',
                                    ],
                                    'en' => [
                                    'next_meal_is' => 'Next meal is',
                                    'none' => 'None',
                                    'no_plans' => 'No plans yet',
                                    'cooking_schedule_details' => 'Cooking Schedule Details',
                                    'meal' => 'meal',
                                    'person' => 'person',
                                    ],
                                    'id' => [
                                    'next_meal_is' => 'Makanan berikutnya adalah',
                                    'none' => 'Tidak ada',
                                    'no_plans' => 'Belum ada rencana',
                                    'cooking_schedule_details' => 'Detail Jadwal Memasak',
                                    'meal' => 'makanan',
                                    'person' => 'orang',
                                    ],
                                    'am' => [
                                    'next_meal_is' => 'የሚቀጥለው ምግብ',
                                    'none' => 'ምንም',
                                    'no_plans' => 'እስካሁን ምንም እቅድ',
                                    'cooking_schedule_details' => 'የማብሰል መርሃ ግብር ዝርዝሮች',
                                    'meal' => 'ምግብ',
                                    'person' => 'ሰው',
                                    ],
                                    'hi' => [
                                    'next_meal_is' => 'अगला भोजन है',
                                    'none' => 'कोई नहीं',
                                    'no_plans' => 'अभी कोई योजना नहीं',
                                    'cooking_schedule_details' => 'खाना पकाने की समय-सारणी विवरण',
                                    'meal' => 'भोजन',
                                    'person' => 'व्यक्ति',
                                    ],
                                    'bn' => [
                                    'next_meal_is' => 'পরবর্তী খাবার হলো',
                                    'none' => 'কোনোটিই নয়',
                                    'no_plans' => 'এখনো কোনো পরিকل্পনা নেই',
                                    'cooking_schedule_details' => 'রান্নার সময়সূচীর বিস্তারিত',
                                    'meal' => 'খাবার',
                                    'person' => 'ব্যক্তি',
                                    ],
                                    'ml' => [
                                    'next_meal_is' => 'അടുത്ത ഭക്ഷണം',
                                    'none' => 'ഒന്നുമില്ല',
                                    'no_plans' => 'ഇതുവരെ പ്ലാനുകളില്ല',
                                    'cooking_schedule_details' => 'പാചക പട്ടികയുടെ വിശദാംശങ്ങൾ',
                                    'meal' => 'ഭക്ഷണം',
                                    'person' => 'വ്യക്തി',
                                    ],
                                    'fil' => [
                                    'next_meal_is' => 'Ang susunod na pagkain ay',
                                    'none' => 'Wala',
                                    'no_plans' => 'Wala pang plano',
                                    'cooking_schedule_details' => 'Mga Detalye ng Iskedyul ng Pagluluto',
                                    'meal' => 'pagkain',
                                    'person' => 'tao',
                                    ],
                                    'ur' => [
                                    'next_meal_is' => 'اگلا کھانا ہے',
                                    'none' => 'کوئی نہیں',
                                    'no_plans' => 'ابھی تک کوئی منصوبہ نہیں',
                                    'cooking_schedule_details' => 'کھانا پکانے کے شیڈول کی تفصیلات',
                                    'meal' => 'کھانا',
                                    'person' => 'شخص',
                                    ],
                                    'ta' => [
                                    'next_meal_is' => 'அடுத்த உணவு',
                                    'none' => 'ஏதுமில்லை',
                                    'no_plans' => 'இதுவரை திட்டமில்லை',
                                    'cooking_schedule_details' => 'சமையல் அட்டவணை விவரங்கள்',
                                    'meal' => 'உணவு',
                                    'person' => 'நபர்',
                                    ],
                                    'ne' => [
                                    'next_meal_is' => 'अर्को खाना',
                                    'none' => 'कुनै पनि छैन',
                                    'no_plans' => 'अहिलेसम्म कुनै योजना छैन',
                                    'cooking_schedule_details' => 'खाना पकाउने तालिकाको विवरण',
                                    'meal' => 'खाना',
                                    'person' => 'व्यक्ति',
                                    ],
                                    'ps' => [
                                    'next_meal_is' => 'بل خواړه',
                                    'none' => 'هیڅ',
                                    'no_plans' => 'تر اوسه کوم پلان نشته',
                                    'cooking_schedule_details' => 'د پخلي د مهالوېش تفصیلات',
                                    'meal' => 'خواړه',
                                    'person' => 'شخص',
                                    ],
                                    'fr' => [
                                    'next_meal_is' => 'Le prochain repas est',
                                    'none' => 'Aucun',
                                    'no_plans' => 'Aucun plan pour l\'instant',
                                    'cooking_schedule_details' => 'Détails du planning de cuisine',
                                    'meal' => 'repas',
                                    'person' => 'personne',
                                    ],
                                    ];
                                    $t = $translations[$lang] ?? $translations['ar'];
                                    // 3. جلب الترجمة
                                    $mainMealTitle = $mainMealTranslations[$lang] ?? $mainMealTranslations['ar'];
                                    @endphp

                                    <p class="recpie-name">{{ $mainMealTitle }}

                                    
                                    </p>
                                    </button>
                                    <div class="dz-card list" style="border-radius: 0px 0px 15px 15px; border: 1px solid #bababa;">
                                        <div class="dz-media" style="position: relative;">
                                            <img style="border-radius: 0px; border-top-right-radius: 0px !important;"
                                                src="{{ asset('storage/' . $recipe->recipe->dish_image) }}"
                                                alt="{{ $recipe->recipe->title }}">
                                        </div>
                                        <div class="dz-content">
                                            <div class="dz-head">
                                                <h6 class="title">
                                                    <span>
                                                        {{
                                                        \App\Helpers\TranslationHelper::translate($recipe->recipe->title
                                                        ?? '', $lang) }}
                                                    </span>
                                                </h6>
                                                <ul class="tag-list"></ul>
                                               @forelse ($recipe->recipe->subCategories as $subCategory)
                                                <span class="badge badge-info">
                                                    {{ tdb($subCategory?->recipe, $lang, 'name') }}
                                                </span>
                                                @empty
                                                <span class="text-muted">{{ $t['none'] }}</span>
                                                @endforelse
                                                <ul class="tag-list" style="display: flex; gap: 10px;">
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-clock"
                                                            style="color: var(--primary-color);"></i>
                                                        {{ $recipe->recipe->preparation_time ?? 0 }}
                                                    </li>
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-eye"
                                                            style="color: var(--primary-color);"></i>
                                                        {{ $recipe->recipe->views ?? 0 }}
                                                    </li>
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-heart"
                                                            style="color: var(--primary-color);"></i>
                                                        {{ $recipe->recipe->favorited_by_count ?? 0 }}
                                                    </li>
                                                </ul>
                                                <div>
                                                    <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                                        class="tags">
                                                        @if($recipe->recipe->kitchen)
                                                        <img src="{{ asset('storage/' . $recipe->recipe->kitchen->image) }}"
                                                            style="border-radius: 50% !important; width: 30px; height: 30px;"
                                                            alt="{{ $recipe->recipe->kitchen->name_ar }}">
                                                        {{-- {{ $recipe->recipe->kitchen->name_ar }} --}}
                                                        {{ tdb($recipe->recipe->kitchen, $lang, 'name') }}
                                                        @else
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/800px-Flag_of_Egypt.svg.png"
                                                            style="border-radius: 50% !important; width: 30px; height: 30px;"
                                                            alt="المطبخ المصري">
                                                        المطبخ المصري
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- الإضافات -->
                                @php
                                $additionalRecipes = [
                                'salad' => [
                                'title' => 'السلطات',
                                'recipe' => $recipe->salad,
                                'icon' => '🥗'
                                ],
                                'drink' => [
                                'title' => 'المشروبات',
                                'recipe' => $recipe->drink,
                                'icon' => '🍹'
                                ],
                                'appetizer' => [
                                'title' => 'المقبلات',
                                'recipe' => $recipe->appetizer,
                                'icon' => '🥡'
                                ],
                                'healthyFood' => [
                                'title' => 'الأكل الصحي',
                                'recipe' => $recipe->healthyFood,
                                'icon' => '🥬'
                                ],
                                'soup' => [
                                'title' => 'الشوربات',
                                'recipe' => $recipe->soup,
                                'icon' => '🍲'
                                ],
                                'dessert' => [
                                'title' => 'الحلويات',
                                'recipe' => $recipe->dessert,
                                'icon' => '🍰'
                                ],
                                'sauce' => [
                                'title' => 'الصلصات',
                                'recipe' => $recipe->sauce,
                                'icon' => '🧴'
                                ],
                                'sideDish' => [
                                'title' => 'طبق جانبي',
                                'recipe' => $recipe->sideDish,
                                'icon' => '🍽️'
                                ]
                                ];
                                @endphp

                                @foreach($additionalRecipes as $key => $additional)
                                @if($additional['recipe'])
                                <div style="margin-bottom: 16px !important; border: 1px solid #bababa; border-radius: 15px;">
                                    <a
                                        href="{{ route('families.meals.show-meal', parameters: $additional['recipe']->id) }}">
                                        <p class="recpie-name">
                                            {{
                                                \App\Helpers\TranslationHelper::translate($additional['title']
                                                ?? '', $lang) }}
                                        </p>
                                        <div class="dz-card list">
                                            <div class="dz-media" style="position: relative;">
                                                @if($additional['recipe']->dish_image)
                                                <img style="border-radius: 0px; height: 121px; border-bottom-right-radius: 15px;"
                                                    src="{{ asset('storage/' . $additional['recipe']->dish_image) }}"
                                                    alt="{{ $additional['recipe']->title }}">
                                                @else
                                                <img style="border-radius: 0px;"
                                                    src="http://127.0.0.1:8000/storage/recipes/YPj0AqgaV0TYojt0HtGrvLtPF639DmK8KHvaLedc.jpg"
                                                    alt="صورة افتراضية">
                                                @endif
                                            </div>
                                            <div class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <a
                                                            href="{{ route('families.meals.show-meal', $recipe->recipe->id) }}">
                                                            <span>
                                                                {{
                                                                \App\Helpers\TranslationHelper::translate($additional['recipe']->title
                                                                ?? '', $lang) }}
                                                            </span>
                                                        </a>
                                                    </h6>
                                                    <ul class="tag-list"></ul>
                                                    @forelse ($recipe->recipe->subCategories as $subCategory)
                                                    <span class="badge badge-info">
                                                        {{ tdb($subCategory?->recipe, $lang, 'name') }}
                                                    </span>
                                                    @empty
                                                    <span class="text-muted">{{ $t['none'] }}</span>
                                                    @endforelse
                                                    <ul class="tag-list" style="display: flex; gap: 10px;">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-clock"
                                                                style="color: var(--primary-color);"></i>
                                                            {{ $additional['recipe']->preparation_time ?? 5 }}
                                                        </li>
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-eye"
                                                                style="color: var(--primary-color);"></i>
                                                            {{ $additional['recipe']->views ?? 2 }}
                                                        </li>
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-heart"
                                                                style="color: var(--primary-color);"></i>
                                                            {{ $additional['recipe']->favorited_by_count ?? 4 }}
                                                        </li>
                                                    </ul>
                                                    <div>
                                                        <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                                            class="tags">
                                                            @if($additional['recipe']->kitchen &&
                                                            $additional['recipe']->kitchen->image)
                                                            <img src="{{ asset('storage/' . $additional['recipe']->kitchen->image) }}"
                                                                style="border-radius: 50% !important; width: 30px; height: 30px;"
                                                                alt="{{ $additional['recipe']->kitchen->name_ar }}">
    {{ tdb($recipe->recipe->kitchen, $lang, 'name') }}                                                        @else
                                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/800px-Flag_of_Egypt.svg.png"
                                                                style="border-radius: 50% !important; width: 30px; height: 30px;"
                                                                alt="المطبخ المصري">
                                                            المطبخ المصري
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @endforeach

                                <!-- إذا مفيش إضافات -->
                                @php
                                $hasAdditionalRecipes = false;
                                foreach($additionalRecipes as $additional) {
                                if($additional['recipe']) {
                                $hasAdditionalRecipes = true;
                                break;
                                }
                                }
                                @endphp

                                @if(!$hasAdditionalRecipes)
                                <li style="margin-bottom: 20px;" class="container-cart">
                                    <div class="alert alert-info text-center" style="margin: 20px;">
                                        <i class="fa fa-info-circle"></i>
                                        لا توجد إضافات لهذه الوجبة
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content End -->

    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
    <script src="assets/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
    <script src="assets/js/noui-slider.init.js"></script><!-- NOUSLIDER MIN JS-->
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>