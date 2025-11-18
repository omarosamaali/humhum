<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>{{ __('messages.جدول الطبخ') }}</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #29A500 !important;
            --primary-color: #29A500 !important;
        }

        .btn:hover {
            background-color: #279402 !important;
            border-color: #279402 !important;
        }

        .dz-card.list .dz-media {
            max-width: 100% !important;
        }

        .recpie-name {
            text-align: center;
            background: black;
            color: white;
            border-radius: 15px 15px 0px 0px;
            padding: 8px;
            margin-bottom: 0px;
        }

        .dz-card.list .dz-media img {
            border-radius: 0px !important;
            height: 114px;
        }
    </style>
    @vite(['resources/js/app.js'])
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
        <header class="header header-sticky border-bottom">
            <div class="header-content">
                <div class="left-content">
                    @if(session('is_family_logged_in'))
                    <a href="{{ route('families.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                    @else
                    <a href="{{ route('chefs.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                    @endif
                </div>
                <div class="mid-content">
                    @php
                    // 1. تحديد اللغة
                    $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
                    
                    // 2. مصفوفة الترجمات العامة + جدول الطبخ
                    $translations = [
                    'ar' => [
                    'next_meal_is' => 'الوجبة القادمة هي',
                    'none' => 'لا يوجد',
                    'no_plans' => 'لا توجد خطط حاليًا',
                    'cooking_schedule' => 'جدول الطبخ',
                    ],
                    'en' => [
                    'next_meal_is' => 'Next meal is',
                    'none' => 'None',
                    'no_plans' => 'No plans yet',
                    'cooking_schedule' => 'Cooking Schedule',
                    ],
                    'id' => [
                    'next_meal_is' => 'Makanan berikutnya adalah',
                    'none' => 'Tidak ada',
                    'no_plans' => 'Belum ada rencana',
                    'cooking_schedule' => 'Jadwal Memasak',
                    ],
                    'am' => [
                    'next_meal_is' => 'የሚቀጥለው ምግብ',
                    'none' => 'ምንም',
                    'no_plans' => 'እስካሁን ምንም እቅድ',
                    'cooking_schedule' => 'የማብሰል መርሃ ግብር',
                    ],
                    'hi' => [
                    'next_meal_is' => 'अगला भोजन है',
                    'none' => 'कोई नहीं',
                    'no_plans' => 'अभी कोई योजना नहीं',
                    'cooking_schedule' => 'खाना पकाने की समय-सारणी',
                    ],
                    'bn' => [
                    'next_meal_is' => 'পরবর্তী খাবার হলো',
                    'none' => 'কোনোটিই নয়',
                    'no_plans' => 'এখনো কোনো পরিকল্পনা নেই',
                    'cooking_schedule' => 'রান্নার সময়সূচী',
                    ],
                    'ml' => [
                    'next_meal_is' => 'അടുത്ത ഭക്ഷണം',
                    'none' => 'ഒന്നുമില്ല',
                    'no_plans' => 'ഇതുവരെ പ്ലാനുകളില്ല',
                    'cooking_schedule' => 'പാചക പട്ടിക',
                    ],
                    'fil' => [
                    'next_meal_is' => 'Ang susunod na pagkain ay',
                    'none' => 'Wala',
                    'no_plans' => 'Wala pang plano',
                    'cooking_schedule' => 'Iskedyul ng Pagluluto',
                    ],
                    'ur' => [
                    'next_meal_is' => 'اگلا کھانا ہے',
                    'none' => 'کوئی نہیں',
                    'no_plans' => 'ابھی تک کوئی منصوبہ نہیں',
                    'cooking_schedule' => 'کھانا پکانے کا شیڈول',
                    ],
                    'ta' => [
                    'next_meal_is' => 'அடுத்த உணவு',
                    'none' => 'ஏதுமில்லை',
                    'no_plans' => 'இதுவரை திட்டமில்லை',
                    'cooking_schedule' => 'சமையல் அட்டவணை',
                    ],
                    'ne' => [
                    'next_meal_is' => 'अर्को खाना',
                    'none' => 'कुनै पनि छैन',
                    'no_plans' => 'अहिलेसम्म कुनै योजना छैन',
                    'cooking_schedule' => 'खाना पकाउने तालिका',
                    ],
                    'ps' => [
                    'next_meal_is' => 'بل خواړه',
                    'none' => 'هیڅ',
                    'no_plans' => 'تر اوسه کوم پلان نشته',
                    'cooking_schedule' => 'د پخلي مهالوېش',
                    ],
                    'fr' => [
                    'next_meal_is' => 'Le prochain repas est',
                    'none' => 'Aucun',
                    'no_plans' => 'Aucun plan pour l\'instant',
                    'cooking_schedule' => 'Planning de cuisine',
                    ],
                    ];
                    
                    // 3. جلب الترجمة حسب اللغة (مع fallback للعربي)
                    $t = $translations[$lang] ?? $translations['ar'];
                    @endphp
                    {{-- <h4 class="title">{{ __('messages.جدول الطبخ') }}</h4> --}}
                    <h4 class="title">{{ $t['cooking_schedule'] }}</h4>
                </div>
                <div class="right-content">
                    {{-- <a href="{{ route('users.cook_table.index') }}" class=""><i class="feather icon-plus font-24"></i></a> --}}
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content" style="margin-top: 30px; direction: rtl;">
            <div class="container pt-0">
                <div class="default-tab style-2 mt-1">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                            <ul class="featured-list">
                               @php
                            // 1. تحديد اللغة
                            $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
                            
                            // 2. مصفوفة الترجمات الكاملة
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
                            
                            // 3. جلب الترجمة حسب اللغة
                            $t = $translations[$lang] ?? $translations['ar'];
                            
                            // 4. دالة tdb للترجمة التلقائية (لو مفيش حقل مترجم)
                            function tdb($model, $lang, $field = 'name')
                            {
                            if (!$model || !is_object($model)) return '—';
                            $key = "{$field}_{$lang}";
                            $value = $model->$key ?? $model->{"{$field}_ar"} ?? $model->$field ?? '';
                            return is_string($value) ? trim($value) : '—';
                            }
                            @endphp
                            
                            @if ($recipe)
                            <a href="{{ route('families.meals.show', $recipe->id) }}">
                                <li class="container-cart">
                                    <div class="dz-card list"
                                        style="flex-direction: column; border: 1px solid #ccc; box-shadow: 0px 0px 0px 2px #cccccc7a;">
                            
                                        <!-- الوجبة القادمة -->
                                        <p class="recpie-name">
                                            {{ $t['next_meal_is'] }}
                                        </p>
                            
                                        <div class="dz-media" style="position: relative; display: flex; align-items: center; gap: 20px;">
                                            <img src="assets/images/background.png" style="width: 150px; height: 123px;" alt="">
                                            <div class="dz-head">
                                                <h6 class="title">
                                                    <span>
                                                        {{ \App\Helpers\TranslationHelper::translate($recipe->recipe->title ?? '', $lang) }}
                                                    </span>
                                                </h6>
                            
                                                <!-- الفئات الفرعية -->
                                                @forelse ($recipe->recipe->subCategories as $subCategory)
                                                <span class="badge badge-info">
                                                    {{ tdb($subCategory?->recipe, $lang, 'name') }}
                                                </span>
                                                @empty
                                                <span class="text-muted">{{ $t['none'] }}</span>
                                                @endforelse
                            
                                                <!-- الوقت والمشاهدات والمفضلة -->
                                                <ul class="tag-list" style="display: flex; gap: 10px;">
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-clock" style="color: var(--primary-color);"></i>
                                                        {{ $recipe->recipe->preparation_time }}
                                                    </li>
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-eye" style="color: var(--primary-color);"></i>
                                                        {{ $recipe->recipe->views ?? 0 }}
                                                    </li>
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-heart" style="color: var(--primary-color);"></i>
                                                        {{ $recipe->recipe->favorites_count ?? 0 }}
                                                    </li>
                                                </ul>
                            
                                                <!-- المطبخ -->
                                                <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;" class="tags">
                                                    <img src="{{ asset('storage/' . $recipe->recipe->kitchen->image) }}"
                                                        style="border-radius: 50% !important; width: 30px; height: 30px;" alt="">
                                                    {{ tdb($recipe->recipe->kitchen, $lang, 'name') }}
                                                </div>
                                            </div>
                                        </div>
                            
                                        <!-- تفاصيل جدول الطبخ -->
                                        <p class="recpie-name" style="border-radius: 0px;">
                                            {{ $t['cooking_schedule_details'] }}
                                        </p>
                            
                                        <div style="border-top: 1px solid #ccc; padding: 10px;" class="dz-content">
                                            <div class="dz-head">
                                                <!-- التواريخ -->
                                                <h6 class="title"
                                                    style="display: flex; align-items: center; justify-content: space-between; font-size: 14px;">
                                                    <span><i class="fa-regular fa-calendar"></i>
                                                        {{ $recipe->mealPlan->start_date }}</span>
                                                    <span><i class="fa-solid fa-arrow-left-long" style="font-size: 22px;"></i></span>
                                                    <span><i class="fa-regular fa-calendar"></i>
                                                        {{ $recipe->mealPlan->end_date }}</span>
                                                </h6>
                            
                                                <!-- عدد الوجبات والأشخاص -->
                                                <h6 class="title"
                                                    style="display: flex; align-items: center; justify-content: space-between; font-size: 14px;">
                                                    <span><i class="fa-solid fa-utensils"></i>
                                                        {{ $recipeCount }} {{ $t['meal'] }}</span>
                                                    <span><i class="fa fa-users"></i>
                                                        {{ count($recipe->mealPlan->family_members) }} {{ $t['person'] }}</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </a>
                            @else
                            <p style="text-align: center; font-size: 21px;">{{ $t['no_plans'] }}</p>
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
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>