<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>وجباتي</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link rel="stylesheet" href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        .dz-custom-swiper .dz-tabs-swiper2 {
            padding-top: 33px !important;
            padding: 0px;
            margin: 30px 15px 0 !important;
        }

        .dz-custom-swiper .dz-tabs-swiper {
            position: fixed;
            margin-top: -45px;
            width: 100%;
            z-index: 99999999999999999999999999;
            background: white;
        }

        .swiper-backface-hidden .swiper-slide {
            margin: 1px !important;
        }

        .dz-custom-swiper .dz-tabs-swiper .swiper-slide {
            width: 108.333px !important;
        }

        .dz-custom-swiper .dz-tabs-swiper .swiper-slide .title {
            text-align: center;
            font-size: 12px !important;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-fixed">
            <div class="header-content">
                <div class="mid-content">
                    @php
                    $translations = [
                    'ar' => ['cooking_schedule' => 'جدول الطبخ'],
                    'en' => ['cooking_schedule' => 'Cooking Schedule'],
                    'id' => ['cooking_schedule' => 'Jadwal Memasak'],
                    'am' => ['cooking_schedule' => 'የማብሰል መርሃ ግብር'],
                    'hi' => ['cooking_schedule' => 'खाना पकाने की समय-सारणी'],
                    'bn' => ['cooking_schedule' => 'রান্নার সময়সূচী'],
                    'ml' => ['cooking_schedule' => 'പാചക പട്ടിക'],
                    'fil' => ['cooking_schedule' => 'Iskedyul ng Pagluluto'],
                    'ur' => ['cooking_schedule' => 'کھانا پکانے کا شیڈول'],
                    'ta' => ['cooking_schedule' => 'சமையல் அட்டவணை'],
                    'ne' => ['cooking_schedule' => 'खाना पकाउने तालिका'],
                    'ps' => ['cooking_schedule' => 'د پخلي مهالوېش'],
                    'fr' => ['cooking_schedule' => 'Planning de cuisine'],
                    ];

                    $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
                    $t = $translations[$lang] ?? $translations['ar'];
                    @endphp

                    <h4 class="title">{{ $t['cooking_schedule'] }}</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('families.meals.index') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <main class="page-content space-top">
            <div class="container">
                <div class="dz-custom-swiper">
                    @php
                    // 1. تحديد اللغة
                    $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';

                    // 2. مصفوفة الترجمات الكاملة
                    $translations = [
                    'ar' => [
                    'breakfast' => 'الفطور',
                    'lunch' => 'الغداء',
                    'dinner' => 'العشاء',
                    ],
                    'en' => [
                    'breakfast' => 'Breakfast',
                    'lunch' => 'Lunch',
                    'dinner' => 'Dinner',
                    ],
                    'id' => [
                    'breakfast' => 'Sarapan',
                    'lunch' => 'Makan Siang',
                    'dinner' => 'Makan Malam',
                    ],
                    'am' => [
                    'breakfast' => 'ቁርስ',
                    'lunch' => 'ምሳ',
                    'dinner' => 'እራት',
                    ],
                    'hi' => [
                    'breakfast' => 'नाश्ता',
                    'lunch' => 'दोपहर का भोजन',
                    'dinner' => 'रात का खाना',
                    ],
                    'bn' => [
                    'breakfast' => 'সকালের খাবার',
                    'lunch' => 'দুপুরের খাবার',
                    'dinner' => 'রাতের খাবার',
                    ],
                    'ml' => [
                    'breakfast' => 'പ്രഭാതഭക്ഷണം',
                    'lunch' => 'ഉച്ചഭക്ഷണം',
                    'dinner' => 'രാത്രിഭക്ഷണം',
                    ],
                    'fil' => [
                    'breakfast' => 'Almusal',
                    'lunch' => 'Tanghalian',
                    'dinner' => 'Hapunan',
                    ],
                    'ur' => [
                    'breakfast' => 'ناشتہ',
                    'lunch' => 'دوپہر کا کھانا',
                    'dinner' => 'رات کا کھانا',
                    ],
                    'ta' => [
                    'breakfast' => 'காலை உணவு',
                    'lunch' => 'மதிய உணவு',
                    'dinner' => 'இரவு உணவு',
                    ],
                    'ne' => [
                    'breakfast' => 'बिहानको खाना',
                    'lunch' => 'दिउँसोको खाना',
                    'dinner' => 'रातिको खाना',
                    ],
                    'ps' => [
                    'breakfast' => 'سهار',
                    'lunch' => 'غرمه',
                    'dinner' => 'ماخوستن',
                    ],
                    'fr' => [
                    'breakfast' => 'Petit-déjeuner',
                    'lunch' => 'Déjeuner',
                    'dinner' => 'Dîner',
                    ],
                    ];

                    // 3. جلب الترجمة حسب اللغة
                    $t = $translations[$lang] ?? $translations['ar'];
                    @endphp

                    <div thumbsSlider="" class="swiper mySwiper dz-tabs-swiper">
                        <div class="swiper-wrapper" style="justify-content: space-around;">
                            <!-- الفطور -->
                            <div class="swiper-slide">
                                <h5 class="title">
                                    <i class="fas fa-sun" style="color: #FFA500; margin-left: 8px;"></i>
                                    {{ $t['breakfast'] }}
                                    @php
                                    $breakfastTime = null;
                                    if (!empty($breakfasts)) {
                                    $firstItem = $breakfasts[0];
                                    if (isset($firstItem['plan'])) {
                                    $plan = $firstItem['plan'];
                                    $meals = is_object($plan) ? $plan->meals : ($plan['meals'] ?? null);
                                    $mealSettings = is_string($meals) ? json_decode($meals, true) : $meals;

                                    if (isset($mealSettings['breakfast']['time'])) {
                                    $breakfastTime = $mealSettings['breakfast']['time'];
                                    }
                                    }
                                    }
                                    @endphp

                                    @if($breakfastTime)
                                    {{ \Carbon\Carbon::parse($breakfastTime)->format('h:i A') }}
                                    @endif
                                </h5>
                            </div>

                            <!-- الغداء -->
                            <div class="swiper-slide">
                                <h5 class="title">
                                    <i class="fas fa-cloud-sun" style="color: #FFD700; margin-left: 8px;"></i>
                                    {{ $t['lunch'] }}
                                    @php
                                    $lunchTime = null;
                                    if (!empty($lunches)) {
                                    $firstItem = $lunches[0];
                                    if (isset($firstItem['plan'])) {
                                    $plan = $firstItem['plan'];
                                    $meals = is_object($plan) ? $plan->meals : ($plan['meals'] ?? null);
                                    $mealSettings = is_string($meals) ? json_decode($meals, true) : $meals;

                                    if (isset($mealSettings['lunch']['time'])) {
                                    $lunchTime = $mealSettings['lunch']['time'];
                                    }
                                    }
                                    }
                                    @endphp

                                    @if($lunchTime)
                                    <i class="far fa-clock" style="margin-left: 5px;"></i>
                                    {{ \Carbon\Carbon::parse($lunchTime)->format('h:i A') }}
                                    @endif
                                </h5>
                            </div>

                            <!-- العشاء -->
                            <div class="swiper-slide">
                                <h5 class="title">
                                    <i class="fas fa-moon" style="color: #4169E1; margin-left: 8px;"></i>
                                    {{ $t['dinner'] }}
                                    @php
                                    $dinnerTime = null;
                                    if (!empty($dinners)) {
                                    $firstItem = $dinners[0];
                                    if (isset($firstItem['plan'])) {
                                    $plan = $firstItem['plan'];
                                    $meals = is_object($plan) ? $plan->meals : ($plan['meals'] ?? null);
                                    $mealSettings = is_string($meals) ? json_decode($meals, true) : $meals;

                                    if (isset($mealSettings['dinner']['time'])) {
                                    $dinnerTime = $mealSettings['dinner']['time'];
                                    }
                                    }
                                    }
                                    @endphp

                                    @if($dinnerTime)
                                    <i class="far fa-clock" style="margin-left: 5px;"></i>
                                    {{ \Carbon\Carbon::parse($dinnerTime)->format('h:i A') }}
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
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
                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">
                            {{-- Breakfast --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach($breakfasts as $item)
                                    <li class="container-cart" style="margin-bottom: 20px;">
                                        @if($item['recipe_id'])
                                        <a href="{{ route('families.meals.view-meal', $item['detail_id']) }}">
                                            @endif
                                            <div class="dz-card list">
                                                <div class="dz-media" style="position: relative;">
                                                    <div class="container-date">
                                                    @php
                                                    // تحديد اللغة
$lang = $lang = session('cook_language')
?? session('family_language')
?? 'ar';                                                    
                                                    // ترجمة أسماء الأيام (l = full day name)
                                                    $daysTranslations = [
                                                    'ar' => ['Sunday' => 'الأحد', 'Monday' => 'الإثنين', 'Tuesday'
                                                    => 'الثلاثاء', 'Wednesday' => 'الأربعاء', 'Thursday' =>
                                                    'الخميس', 'Friday' => 'الجمعة', 'Saturday' => 'السبت'],
                                                    'en' => ['Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday'
                                                    => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' =>
                                                    'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday'],
                                                    'hi' => ['Sunday' => 'रविवार', 'Monday' => 'सोमवार', 'Tuesday'
                                                    => 'मंगलवार', 'Wednesday' => 'बुधवार', 'Thursday' =>
                                                    'गुरुवार', 'Friday' => 'शुक्रवार', 'Saturday' => 'शनिवार'],
                                                    'id' => ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' =>
                                                    'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis',
                                                    'Friday' => 'Jumat', 'Saturday' => 'Sabtu'],
                                                    'am' => ['Sunday' => 'እሑድ', 'Monday' => 'ሰኞ', 'Tuesday' =>
                                                    'ማክሰኞ', 'Wednesday' => 'ረቡዕ', 'Thursday' => 'ሐሙስ', 'Friday'
                                                    => 'ዓርብ', 'Saturday' => 'ቅዳሜ'],
                                                    'bn' => ['Sunday' => 'রবিবার', 'Monday' => 'সোমবার', 'Tuesday'
                                                    => 'মঙ্গলবার', 'Wednesday' => 'বুধবার', 'Thursday' =>
                                                    'বৃহস্পতিবার', 'Friday' => 'শুক্রবার', 'Saturday' => 'শনিবার'],
                                                    'ml' => ['Sunday' => 'ഞായർ', 'Monday' => 'തിങ്കൾ', 'Tuesday' =>
                                                    'ചൊവ്വ', 'Wednesday' => 'ബുധൻ', 'Thursday' => 'വ്യാഴം',
                                                    'Friday' => 'വെള്ളി', 'Saturday' => 'ശനി'],
                                                    'fil' => ['Sunday' => 'Linggo', 'Monday' => 'Lunes', 'Tuesday'
                                                    => 'Martes', 'Wednesday' => 'Miyerkules', 'Thursday' =>
                                                    'Huwebes', 'Friday' => 'Biyernes', 'Saturday' => 'Sabado'],
                                                    'ur' => ['Sunday' => 'اتوار', 'Monday' => 'پیر', 'Tuesday' =>
                                                    'منگل', 'Wednesday' => 'بدھ', 'Thursday' => 'جمعرات',
                                                    'Friday' => 'جمعہ', 'Saturday' => 'ہفتہ'],
                                                    'ta' => ['Sunday' => 'ஞாயிறு', 'Monday' => 'திங்கள்', 'Tuesday'
                                                    => 'செவ்வாய்', 'Wednesday' => 'புதன்', 'Thursday' =>
                                                    'வியாழன்', 'Friday' => 'வெள்ளி', 'Saturday' => 'சனி'],
                                                    'ne' => ['Sunday' => 'आइतबार', 'Monday' => 'सोमबार', 'Tuesday'
                                                    => 'मङ्गलबार', 'Wednesday' => 'बुधबार', 'Thursday' =>
                                                    'बिहीबार', 'Friday' => 'शुक्रबार', 'Saturday' => 'शनिबार'],
                                                    'ps' => ['Sunday' => 'یکشنبه', 'Monday' => 'دوشنبه', 'Tuesday'
                                                    => 'سه‌شنبه', 'Wednesday' => 'چهارشنبه', 'Thursday' =>
                                                    'پنجشنبه', 'Friday' => 'جمعه', 'Saturday' => 'شنبه'],
                                                    'fr' => ['Sunday' => 'dimanche', 'Monday' => 'lundi', 'Tuesday'
                                                    => 'mardi', 'Wednesday' => 'mercredi', 'Thursday' =>
                                                    'jeudi', 'Friday' => 'vendredi', 'Saturday' => 'samedi'],
                                                    ];
                                                    
                                                    $t_days = $daysTranslations[$lang] ?? $daysTranslations['ar'];
                                                    
                                                    // جلب اسم اليوم بالإنجليزي من التاريخ
                                                    $englishDay = \Carbon\Carbon::parse($item['date'])->format('l');
                                                    // Sunday, Monday, ...
                                                    $translatedDay = $t_days[$englishDay] ?? $englishDay;
                                                    @endphp
                                                    <span>{{ $translatedDay }}</span>
                                                        <span style="font-size: 38px; font-weight: bold;">
                                                            {{ \Carbon\Carbon::parse(time: $item['date'])->format('d')
                                                            }}
                                                        </span>
                                                        <span>{{
                                                            \Carbon\Carbon::parse($item['date'])->format('m/Y')
                                                            }}</span>
                                                    </div>
                                                </div>
                                                <div class="dz-content">
                                                    @if(isset($item['recipe']) && $item['recipe'])
                                                    <span>
                                                        {{-- {{ $item['recipe']->title }} --}}
                                                        {{
                                                        \App\Helpers\TranslationHelper::translate($item['recipe']->title
                                                        ?? '', $lang) }}
                                                    </span>
                                                    @else
                                                    <span>Recipe not found</span>
                                                    @endif
                                                    <h6 class="title">
                                                        <i class="fa fa-users"></i>
                                                        {{ implode(' ، ', $item['family_names']) }}
                                                    </h6>
                                                    <span style="color: #1b1b1bbf;">
                                                        @if($item['notes'] != null)
                                                        {{ $item['notes'] }}
                                                        @else
                                                        {{-- لا يوجد ملاحظات --}}
                                                        {{ $t['no_plans'] }}
                                                        @endif
                                                    </span>
                                                    <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥗
                                                    @if($item['salad_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍹
                                                    @if($item['drink_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥡
                                                    @if($item['appetizers_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥔
                                                    @if($item['healthy_food_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍲
                                                    @if($item['soup_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🧁
                                                    @if($item['desserts_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    <img src="{{ asset('assets/images/user-logo/saled.png') }}"
                                                        style="width: 30px; height: 27px;" />
                                                    @if($item['sauces_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍽️
                                                    @if($item['side_dish_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            @if($item['recipe_id'])
                                        </a>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- Lunch --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach($lunches as $item)
                                    <li class="container-cart" style="margin-bottom: 20px;">
                                        <a href="{{ route('families.meals.view-meal-lunch', $item['detail_id']) }}">
                                            <div class="dz-card list">
                                                <div class="dz-media" style="position: relative;">
<div class="dz-card list">
    <div class="dz-media" style="position: relative;">
        <div class="container-date">
            @php
            // تحديد اللغة
            $lang = $memberData->language ?? (session('family_language') ??
            'ar');

            // ترجمة أسماء الأيام (l = full day name)
            $daysTranslations = [
            'ar' => ['Sunday' => 'الأحد', 'Monday' => 'الإثنين', 'Tuesday'
            => 'الثلاثاء', 'Wednesday' => 'الأربعاء', 'Thursday' =>
            'الخميس', 'Friday' => 'الجمعة', 'Saturday' => 'السبت'],
            'en' => ['Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday'
            => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' =>
            'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday'],
            'hi' => ['Sunday' => 'रविवार', 'Monday' => 'सोमवार', 'Tuesday'
            => 'मंगलवार', 'Wednesday' => 'बुधवार', 'Thursday' =>
            'गुरुवार', 'Friday' => 'शुक्रवार', 'Saturday' => 'शनिवार'],
            'id' => ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' =>
            'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis',
            'Friday' => 'Jumat', 'Saturday' => 'Sabtu'],
            'am' => ['Sunday' => 'እሑድ', 'Monday' => 'ሰኞ', 'Tuesday' =>
            'ማክሰኞ', 'Wednesday' => 'ረቡዕ', 'Thursday' => 'ሐሙስ', 'Friday'
            => 'ዓርብ', 'Saturday' => 'ቅዳሜ'],
            'bn' => ['Sunday' => 'রবিবার', 'Monday' => 'সোমবার', 'Tuesday'
            => 'মঙ্গলবার', 'Wednesday' => 'বুধবার', 'Thursday' =>
            'বৃহস্পতিবার', 'Friday' => 'শুক্রবার', 'Saturday' => 'শনিবার'],
            'ml' => ['Sunday' => 'ഞായർ', 'Monday' => 'തിങ്കൾ', 'Tuesday' =>
            'ചൊവ്വ', 'Wednesday' => 'ബുധൻ', 'Thursday' => 'വ്യാഴം',
            'Friday' => 'വെള്ളി', 'Saturday' => 'ശനി'],
            'fil' => ['Sunday' => 'Linggo', 'Monday' => 'Lunes', 'Tuesday'
            => 'Martes', 'Wednesday' => 'Miyerkules', 'Thursday' =>
            'Huwebes', 'Friday' => 'Biyernes', 'Saturday' => 'Sabado'],
            'ur' => ['Sunday' => 'اتوار', 'Monday' => 'پیر', 'Tuesday' =>
            'منگل', 'Wednesday' => 'بدھ', 'Thursday' => 'جمعرات',
            'Friday' => 'جمعہ', 'Saturday' => 'ہفتہ'],
            'ta' => ['Sunday' => 'ஞாயிறு', 'Monday' => 'திங்கள்', 'Tuesday'
            => 'செவ்வாய்', 'Wednesday' => 'புதன்', 'Thursday' =>
            'வியாழன்', 'Friday' => 'வெள்ளி', 'Saturday' => 'சனி'],
            'ne' => ['Sunday' => 'आइतबार', 'Monday' => 'सोमबार', 'Tuesday'
            => 'मङ्गलबार', 'Wednesday' => 'बुधबार', 'Thursday' =>
            'बिहीबार', 'Friday' => 'शुक्रबार', 'Saturday' => 'शनिबार'],
            'ps' => ['Sunday' => 'یکشنبه', 'Monday' => 'دوشنبه', 'Tuesday'
            => 'سه‌شنبه', 'Wednesday' => 'چهارشنبه', 'Thursday' =>
            'پنجشنبه', 'Friday' => 'جمعه', 'Saturday' => 'شنبه'],
            'fr' => ['Sunday' => 'dimanche', 'Monday' => 'lundi', 'Tuesday'
            => 'mardi', 'Wednesday' => 'mercredi', 'Thursday' =>
            'jeudi', 'Friday' => 'vendredi', 'Saturday' => 'samedi'],
            ];

            $t_days = $daysTranslations[$lang] ?? $daysTranslations['ar'];

            // جلب اسم اليوم بالإنجليزي من التاريخ
            $englishDay = \Carbon\Carbon::parse($item['date'])->format('l');
            // Sunday, Monday, ...
            $translatedDay = $t_days[$englishDay] ?? $englishDay;
            @endphp
            <span>{{ $translatedDay }}</span>
            <span style="font-size: 38px; font-weight: bold;">
                {{ \Carbon\Carbon::parse(time: $item['date'])->format('d')
                }}
            </span>
            <span>{{
                \Carbon\Carbon::parse($item['date'])->format('m/Y')
                }}</span>
        </div>
    </div>
    <div class="dz-content">
        @if(isset($item['recipe']) && $item['recipe'])
        <span>
            {{-- {{ $item['recipe']->title }} --}}
            {{
            \App\Helpers\TranslationHelper::translate($item['recipe']->title
            ?? '', $lang) }}
        </span>
        @else
        <span>Recipe not found</span>
        @endif
        <h6 class="title">
            <i class="fa fa-users"></i>
            {{ implode(' ، ', $item['family_names']) }}
        </h6>
        <span style="color: #1b1b1bbf;">
            @if($item['notes'] != null)
            {{ $item['notes'] }}
            @else
            {{-- لا يوجد ملاحظات --}}
            {{ $t['no_plans'] }}
            @endif
        </span>
        <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
    </div>
</div>                                                </div>
                                                <div class="dz-content">
                                                    @if(isset($item['recipe']) && $item['recipe'])
                                                    <span>{{ $item['recipe']->title }}</span>
                                                    @else
                                                    <span>Recipe not found</span>
                                                    @endif
                                                    <h6 class="title">
                                                        <i class="fa fa-users"></i>
                                                        {{ implode(' ، ', $item['family_names']) }}
                                                    </h6>
                                                    <span style="color: #1b1b1bbf;">{{ $item['notes'] ??
                                                        __('messages.no_notes') }}</span>
                                                    <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥗
                                                    @if($item['salad_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍹
                                                    @if($item['drink_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥡
                                                    @if($item['appetizers_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥔
                                                    @if($item['healthy_food_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍲
                                                    @if($item['soup_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🧁
                                                    @if($item['desserts_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    <img src="{{ asset('assets/images/user-logo/saled.png') }}"
                                                        style="width: 30px; height: 27px;" />
                                                    @if($item['sauces_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍽️
                                                    @if($item['side_dish_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- Dinner --}}
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach($dinners as $item)
                                    <li class="container-cart" style="margin-bottom: 20px;">
                                        <a href="{{ route('families.meals.view-meal-dinner', $item['detail_id']) }}">
                                            <div class="dz-card list">
                                                <div class="dz-media" style="position: relative;">
<div class="dz-card list">
    <div class="dz-media" style="position: relative;">
        <div class="container-date">
            @php
            // تحديد اللغة
         $lang = $lang = session('cook_language')
            ?? session('family_language')
            ?? 'ar';

            // ترجمة أسماء الأيام (l = full day name)
            $daysTranslations = [
            'ar' => ['Sunday' => 'الأحد', 'Monday' => 'الإثنين', 'Tuesday'
            => 'الثلاثاء', 'Wednesday' => 'الأربعاء', 'Thursday' =>
            'الخميس', 'Friday' => 'الجمعة', 'Saturday' => 'السبت'],
            'en' => ['Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday'
            => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' =>
            'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday'],
            'hi' => ['Sunday' => 'रविवार', 'Monday' => 'सोमवार', 'Tuesday'
            => 'मंगलवार', 'Wednesday' => 'बुधवार', 'Thursday' =>
            'गुरुवार', 'Friday' => 'शुक्रवार', 'Saturday' => 'शनिवार'],
            'id' => ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' =>
            'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis',
            'Friday' => 'Jumat', 'Saturday' => 'Sabtu'],
            'am' => ['Sunday' => 'እሑድ', 'Monday' => 'ሰኞ', 'Tuesday' =>
            'ማክሰኞ', 'Wednesday' => 'ረቡዕ', 'Thursday' => 'ሐሙስ', 'Friday'
            => 'ዓርብ', 'Saturday' => 'ቅዳሜ'],
            'bn' => ['Sunday' => 'রবিবার', 'Monday' => 'সোমবার', 'Tuesday'
            => 'মঙ্গলবার', 'Wednesday' => 'বুধবার', 'Thursday' =>
            'বৃহস্পতিবার', 'Friday' => 'শুক্রবার', 'Saturday' => 'শনিবার'],
            'ml' => ['Sunday' => 'ഞായർ', 'Monday' => 'തിങ്കൾ', 'Tuesday' =>
            'ചൊവ്വ', 'Wednesday' => 'ബുധൻ', 'Thursday' => 'വ്യാഴം',
            'Friday' => 'വെള്ളി', 'Saturday' => 'ശനി'],
            'fil' => ['Sunday' => 'Linggo', 'Monday' => 'Lunes', 'Tuesday'
            => 'Martes', 'Wednesday' => 'Miyerkules', 'Thursday' =>
            'Huwebes', 'Friday' => 'Biyernes', 'Saturday' => 'Sabado'],
            'ur' => ['Sunday' => 'اتوار', 'Monday' => 'پیر', 'Tuesday' =>
            'منگل', 'Wednesday' => 'بدھ', 'Thursday' => 'جمعرات',
            'Friday' => 'جمعہ', 'Saturday' => 'ہفتہ'],
            'ta' => ['Sunday' => 'ஞாயிறு', 'Monday' => 'திங்கள்', 'Tuesday'
            => 'செவ்வாய்', 'Wednesday' => 'புதன்', 'Thursday' =>
            'வியாழன்', 'Friday' => 'வெள்ளி', 'Saturday' => 'சனி'],
            'ne' => ['Sunday' => 'आइतबार', 'Monday' => 'सोमबार', 'Tuesday'
            => 'मङ्गलबार', 'Wednesday' => 'बुधबार', 'Thursday' =>
            'बिहीबार', 'Friday' => 'शुक्रबार', 'Saturday' => 'शनिबार'],
            'ps' => ['Sunday' => 'یکشنبه', 'Monday' => 'دوشنبه', 'Tuesday'
            => 'سه‌شنبه', 'Wednesday' => 'چهارشنبه', 'Thursday' =>
            'پنجشنبه', 'Friday' => 'جمعه', 'Saturday' => 'شنبه'],
            'fr' => ['Sunday' => 'dimanche', 'Monday' => 'lundi', 'Tuesday'
            => 'mardi', 'Wednesday' => 'mercredi', 'Thursday' =>
            'jeudi', 'Friday' => 'vendredi', 'Saturday' => 'samedi'],
            ];

            $t_days = $daysTranslations[$lang] ?? $daysTranslations['ar'];

            // جلب اسم اليوم بالإنجليزي من التاريخ
            $englishDay = \Carbon\Carbon::parse($item['date'])->format('l');
            // Sunday, Monday, ...
            $translatedDay = $t_days[$englishDay] ?? $englishDay;
            @endphp
            <span>{{ $translatedDay }}</span>
            <span style="font-size: 38px; font-weight: bold;">
                {{ \Carbon\Carbon::parse(time: $item['date'])->format('d')
                }}
            </span>
            <span>{{
                \Carbon\Carbon::parse($item['date'])->format('m/Y')
                }}</span>
        </div>
    </div>
    <div class="dz-content">
        @if(isset($item['recipe']) && $item['recipe'])
        <span>
            {{-- {{ $item['recipe']->title }} --}}
            {{
            \App\Helpers\TranslationHelper::translate($item['recipe']->title
            ?? '', $lang) }}
        </span>
        @else
        <span>Recipe not found</span>
        @endif
        <h6 class="title">
            <i class="fa fa-users"></i>
            {{ implode(' ، ', $item['family_names']) }}
        </h6>
        <span style="color: #1b1b1bbf;">
            @if($item['notes'] != null)
            {{ $item['notes'] }}
            @else
            {{-- لا يوجد ملاحظات --}}
            {{ $t['no_plans'] }}
            @endif
        </span>
        <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
    </div>
</div>                                                </div>
                                                <div class="dz-content">
                                                    @if(isset($item['recipe']) && $item['recipe'])
                                                    <span>{{ $item['recipe']->title }}</span>
                                                    @else
                                                    <span>Recipe not found</span>
                                                    @endif
                                                    <h6 class="title">
                                                        <i class="fa fa-users"></i>
                                                        {{ implode(' ، ', $item['family_names']) }}
                                                    </h6>
                                                    <span style="color: #1b1b1bbf;">{{ $item['notes'] ??
                                                        __('messages.no_notes') }}</span>
                                                    <span>{{ $item['plan']->created_at->format('Y-m-d') }}</span>
                                                </div>
                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥗
                                                    @if($item['salad_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍹
                                                    @if($item['drink_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥡
                                                    @if($item['appetizers_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🥔
                                                    @if($item['healthy_food_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>


                                            </div>
                                            <div
                                                style="padding: 10px; border-top: 1px solid #ccc; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍲
                                                    @if($item['soup_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🧁
                                                    @if($item['desserts_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    <img src="{{ asset('assets/images/user-logo/saled.png') }}"
                                                        style="width: 30px; height: 27px;" />
                                                    @if($item['sauces_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                                <div style="font-size: 20px; margin-bottom: 5px;">
                                                    🍽️
                                                    @if($item['side_dish_id'] != null)
                                                    <i class="fa fa-check" style="color: green;"></i>
                                                    @else
                                                    <i class="fa fa-close" style="color: red;"></i>
                                                    @endif
                                                </div>
                                            </div>

                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        var tabsSwiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 10,
            watchSlidesProgress: true,
            slideToClickedSlide: true,
        });
    
        var contentSwiper = new Swiper(".mySwiper2", {
            autoHeight: true,
            thumbs: {
                swiper: tabsSwiper,
            },
        });
    </script>
</body>

</html>