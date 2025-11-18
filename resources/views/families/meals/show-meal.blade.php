<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- Title -->
    <title>{{ $recipe->title }} | وصفة</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="وصفة, مطبخ, {{ $recipe->main_category->name_ar ?? '' }}, {{ $recipe->title }}">
    <meta name="description"
        content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta property="og:title" content="{{ $recipe->title }} | وصفة">
    <meta property="og:description"
        content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta property="og:image"
        content="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : asset('assets/images/social-image.png') }}">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:title" content="{{ $recipe->title }} | وصفة">
    <meta name="twitter:description"
        content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta name="twitter:image"
        content="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">

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
    <style>
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

        .btn-primary:hover {
            background: var(--primary-color) !important;
            border: #29A500 1px solid !important;
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
                    <span class="visually-hidden">جاري التحميل...</span>
                </div>
            </div>
        </div>
        <!-- Preloader end-->

        <!-- Header -->
        <header class="header header-fixed transparent">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ url()->previous() }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">
                        @php
                        $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
                        $viewRecipeTranslations = [
                        'ar' => 'عرض الوصفة',
                        'en' => 'View Recipe',
                        'hi' => 'रेसिपी देखें',
                        'id' => 'Lihat Resep',
                        'am' => 'የምግብ አዘገጃጀት መመልከት',
                        'bn' => 'রেসিপি দেখুন',
                        'ml' => 'പാചകക്കുറിപ്പ് കാണുക',
                        'fil' => 'Tingnan ang Recipe',
                        'ur' => 'ترکیب دیکھیں',
                        'ta' => 'செய்முறையைப் பார்க்கவும்',
                        'ne' => 'रेसिपि हेर्नुहोस्',
                        'ps' => 'ترکیب کتل',
                        'fr' => 'Voir la recette',
                        ];

                        $viewRecipeText = $viewRecipeTranslations[$lang] ?? $viewRecipeTranslations['ar'];
                        function tdb($model, $lang, $field = 'name')
                        {
                        if (!$model || !is_object($model)) return '—';
                        $key = "{$field}_{$lang}";
                        $value = $model->$key ?? $model->{"{$field}_ar"} ?? $model->$field ?? '';
                        return is_string($value) ? trim($value) : '—';
                        }

                        $freePaidTranslations = [
                        'ar' => ['free' => 'مجاني', 'paid' => 'مدفوع'],
                        'en' => ['free' => 'Free', 'paid' => 'Paid'],
                        'hi' => ['free' => 'नि: शुल्क', 'paid' => 'भुगतान किया'],
                        'id' => ['free' => 'Gratis', 'paid' => 'Berbayar'],
                        'am' => ['free' => 'ነጻ', 'paid' => 'ተከፍሏል'],
                        'bn' => ['free' => 'বিনামূল্যে', 'paid' => 'পেইড'],
                        'ml' => ['free' => 'സൗജന്യം', 'paid' => 'പണമടച്ചത്'],
                        'fil' => ['free' => 'Libre', 'paid' => 'Bayad'],
                        'ur' => ['free' => 'مفت', 'paid' => 'ادا شدہ'],
                        'ta' => ['free' => 'இலவசம்', 'paid' => 'கட்டணம் செலுத்தப்பட்டது'],
                        'ne' => ['free' => 'निशुल्क', 'paid' => 'भुक्तानी'],
                        'ps' => ['free' => 'وړیا', 'paid' => 'تادیه شوی'],
                        'fr' => ['free' => 'Gratuit', 'paid' => 'Payant'],
                        ];

                        // 4. جلب ترجمة "عرض الوصفة"
                        $viewRecipeText = $viewRecipeTranslations[$lang] ?? $viewRecipeTranslations['ar'];

                        // ⭐ 5. جلب free/paid حسب حالة الوصفة
                        $freePaidText = $recipe->is_free
                        ? ($freePaidTranslations[$lang]['free'] ?? $freePaidTranslations['ar']['free'])
                        : ($freePaidTranslations[$lang]['paid'] ?? $freePaidTranslations['ar']['paid']);
                        @endphp
                        {{ $viewRecipeText }}
                    </h4>
                </div>
                <div class="right-content">
                    @if(session('is_family_logged_in'))
                    <a href="{{ route('families.welcome') }}" id="back-btn">
                        <i class="feather icon-home"></i>
                    </a>
                    @else
                    <a href="{{ route('chefs.welcome') }}" id="back-btn">
                        <i class="feather icon-home"></i>
                    </a>
                    @endif
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
                                    <img style="height: 370px;"
                                        src="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : 'https://via.placeholder.com/740' }}"
                                        alt="{{ $recipe->title }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dz-product-detail" style="direction: rtl; bottom: 120px;">
                    <div class="detail-content">

                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <h4 class="title">
                                {{ \App\Helpers\TranslationHelper::translate($recipe->title ?? '', $lang) }}
                            </h4>
                            <div onclick="speakText('{{ addslashes($recipe->title) }}')"
                                style="cursor: pointer; background-color: var(--primary); color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;"
                                title="تشغيل النطق">
                                <i style="font-size: 20px; color: #ffffff;" class="fa-solid fa-headphones"></i>
                            </div>
                        </div>
                        <script src="https://code.responsivevoice.org/responsivevoice.js?key=vm7hFTHk"></script>
                        <script>
                            function speakText(text) {
                    const isArabic = /[\u0600-\u06FF]/.test(text);
                    const lang = isArabic ? 'ar' : 'en';
                    responsiveVoice.speak(text, getVoiceForLang(lang), {
                        rate: 0.9
                    });
                }

                function getVoiceForLang(lang) {
                    const voices = {
                        'ar': 'Arabic Female',
                        'en': 'UK English Female',
                    };
                    return voices[lang] || 'UK English Female';
                }
                        </script>
                        <ul class="tag-list" style="display: flex; gap: 10px;">
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-clock" style="color: var(--primary);"></i>
                                {{ $recipe->preparation_time }} @php
                                $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';

                                $minutesTranslations = [
                                'ar' => 'دقيقة',
                                'en' => 'minutes',
                                'hi' => 'मिनट',
                                'id' => 'menit',
                                'am' => 'ደቂቃ',
                                'bn' => 'মিনিট',
                                'ml' => 'മിനിറ്റ്',
                                'fil' => 'minuto',
                                'ur' => 'منٹ',
                                'ta' => 'நிமிடங்கள்',
                                'ne' => 'मिनेट',
                                'ps' => 'دقیقه',
                                'fr' => 'minutes',
                                ];

                                $minutesText = $minutesTranslations[$lang] ?? $minutesTranslations['ar'];
                                @endphp

                                {{ $minutesText }}
                            </li>
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-eye" style="color: var(--primary);"></i>
                                {{ $recipe->views ?? 0 }}
                            </li>
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-heart" style="color: var(--primary);"></i>
                                {{ $recipe->likes ?? 0 }}
                            </li>
                            @if (!$recipe->is_free)
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-coins" style="color: var(--primary);"></i>
                                {{ $recipe->price ?? 0 }}
                            </li>
                            @endif
                        </ul>

                        <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;" class="tags">
                            <img src="{{ $recipe->kitchen && $recipe->kitchen->image ? asset('storage/' . $recipe->kitchen->image) : 'https://via.placeholder.com/30' }}"
                                style="border-radius: 50%; width: 30px; height: 30px;"
                                alt="{{ $recipe->kitchen ? $recipe->kitchen->name_ar : __('messages.not_classified') }}">
                            {{-- {{ trans_field($recipe->kitchen, 'name') }} --}}
                            {{ tdb($recipe->kitchen, $lang, 'name') }}
                        </div>

                        <div style="display: flex; gap: 10px; align-items: center;">
                            <div
                                style="background-color: #9c8500; color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                {{ $freePaidText }}
                            </div>

                            <div
                                style="background-color: #29A500; color: white; padding: 5px; border-radius: 5px; width: fit-content; margin-top: 10px;">
                                {{ \App\Helpers\TranslationHelper::translate($recipe->mainCategories->name_ar ?? '',
                                $lang) }}
                            </div>

                            @forelse ($recipe->subCategories as $subCategory)
                            <span class="badge badge-info">
                                {{ tdb($subCategory?->recipe, $lang, 'name') }}
                            </span>
                            @empty
                            @php
                            // ⭐ ترجمة "Not Classified"
                            $notClassifiedTranslations = [
                            'ar' => 'غير مصنف',
                            'en' => 'Not Classified',
                            'hi' => 'वर्गीकृत नहीं',
                            'id' => 'Tidak Diklasifikasikan',
                            'am' => 'ያልተመደበ',
                            'bn' => 'শ্রেণীবদ্ধ নয়',
                            'ml' => 'വർഗ്ഗീകരിക്കാത്തത്',
                            'fil' => 'Hindi Nakakategorya',
                            'ur' => 'غیر درجہ بند',
                            'ta' => 'வரிசைப்படுத்தப்படவில்லை',
                            'ne' => 'वर्गीकृत गरिएको छैन',
                            'ps' => 'نا طبقه بند شوی',
                            'fr' => 'Non classé',
                            ];
                            // ⭐ ترجمة "عدد الأشخاص"
                            $numberOfPeopleTranslations = [
                            'ar' => 'عدد الأشخاص',
                            'en' => 'Number of People',
                            'hi' => 'लोगों की संख्या',
                            'id' => 'Jumlah Orang',
                            'am' => 'የሰዎች ብዛት',
                            'bn' => 'লোকের সংখ্যা',
                            'ml' => 'ആളുകളുടെ എണ്ണം',
                            'fil' => 'Bilang ng Tao',
                            'ur' => 'افراد کی تعداد',
                            'ta' => 'நபர்களின் எண்ணிக்கை',
                            'ne' => 'मानिसहरूको संख्या',
                            'ps' => 'د خلکو شمېر',
                            'fr' => 'Nombre de personnes',
                            ];
                            // ⭐ ترجمة "دقائق مختصرة (د / min)"
                            $minutesShortTranslations = [
                            'ar' => 'د',
                            'en' => 'min',
                            'hi' => 'मि',
                            'id' => 'mnt',
                            'am' => 'ደቂ',
                            'bn' => 'মি',
                            'ml' => 'മിനിറ്റ്',
                            'fil' => 'min',
                            'ur' => 'منٹ',
                            'ta' => 'நிமி',
                            'ne' => 'मि',
                            'ps' => 'دقی',
                            'fr' => 'min',
                            ];
                            $minutesShortText = $minutesShortTranslations[$lang] ?? $minutesShortTranslations['ar'];
                            
                            // ⭐ ترجمة "وقت التحضير"
                            $prepTimeTranslations = [
                            'ar' => 'وقت التحضير',
                            'en' => 'Preparation Time',
                            'hi' => 'तैयारी का समय',
                            'id' => 'Waktu Persiapan',
                            'am' => 'የዝግጅት ጊዜ',
                            'bn' => 'প্রস্তুতির সময়',
                            'ml' => 'തയ്യാറാക്കുന്നതിനുള്ള സമയം',
                            'fil' => 'Oras ng Paghahanda',
                            'ur' => 'تیاری کا وقت',
                            'ta' => 'தயாரிப்பு நேரம்',
                            'ne' => 'तयारी समय',
                            'ps' => 'د تیارۍ وخت',
                            'fr' => 'Temps de préparation',
                            ];
                            $prepTimeText = $prepTimeTranslations[$lang] ?? $prepTimeTranslations['ar'];
                            
                            // ⭐ ترجمة "السعر"
                            $priceTranslations = [
                            'ar' => 'السعر',
                            'en' => 'Price',
                            'hi' => 'कीमत',
                            'id' => 'Harga',
                            'am' => 'ዋጋ',
                            'bn' => 'মূল্য',
                            'ml' => 'വില',
                            'fil' => 'Presyo',
                            'ur' => 'قیمت',
                            'ta' => 'விலை',
                            'ne' => 'मूल्य',
                            'ps' => 'بیه',
                            'fr' => 'Prix',
                            ];
                            // ⭐ ترجمة "المكونات"
                            $ingredientsTranslations = [
                            'ar' => 'المكونات',
                            'en' => 'Ingredients',
                            'hi' => 'सामग्री',
                            'id' => 'Bahan',
                            'am' => 'እቃዎች',
                            'bn' => 'উপাদান',
                            'ml' => 'ഘടകങ്ങൾ',
                            'fil' => 'Mga Sangkap',
                            'ur' => 'اجزاء',
                            'ta' => 'பொருட்கள்',
                            'ne' => 'सामग्री',
                            'ps' => 'مواد',
                            'fr' => 'Ingrédients',
                            ];
                            $ingredientsText = $ingredientsTranslations[$lang] ?? $ingredientsTranslations['ar'];
                            
                            // ⭐ ترجمة "الخطوات"
                            $stepsTranslations = [
                            'ar' => 'الخطوات',
                            'en' => 'Steps',
                            'hi' => 'कदम',
                            'id' => 'Langkah',
                            'am' => 'ደረጃዎች',
                            'bn' => 'ধাপ',
                            'ml' => 'നടപടികൾ',
                            'fil' => 'Mga Hakbang',
                            'ur' => 'مراحل',
                            'ta' => 'படி படிகள்',
                            'ne' => 'कदमहरू',
                            'ps' => 'ګامونه',
                            'fr' => 'Étapes',
                            ];
                            $stepsText = $stepsTranslations[$lang] ?? $stepsTranslations['ar'];
                            
                            // ⭐ ترجمة "أفراد العائلة"
                            $familyMembersTranslations = [
                            'ar' => 'أفراد العائلة',
                            'en' => 'Family Members',
                            'hi' => 'परिवार के सदस्य',
                            'id' => 'Anggota Keluarga',
                            'am' => 'የቤተሰብ አባላት',
                            'bn' => 'পরিবারের সদস্যরা',
                            'ml' => 'കുടുംബാംഗങ്ങൾ',
                            'fil' => 'Mga Miyembro ng Pamilya',
                            'ur' => 'خاندان کے افراد',
                            'ta' => 'குடும்ப உறுப்பினர்கள்',
                            'ne' => 'परिवारका सदस्यहरू',
                            'ps' => 'د کورنۍ غړي',
                            'fr' => 'Membres de la famille',
                            ];
                            $familyMembersText = $familyMembersTranslations[$lang] ?? $familyMembersTranslations['ar'];
                            
                            // ⭐ ترجمة "حقائق" أو "معلومات غذائية"
                            $factsTranslations = [
                            'ar' => 'حقائق',
                            'en' => 'Facts',
                            'hi' => 'तथ्य',
                            'id' => 'Fakta',
                            'am' => 'እውነታዎች',
                            'bn' => 'তথ্য',
                            'ml' => 'വസ്തുതകൾ',
                            'fil' => 'Mga Katotohanan',
                            'ur' => 'حقائق',
                            'ta' => 'உண்மைகள்',
                            'ne' => 'तथ्यहरू',
                            'ps' => 'حقایق',
                            'fr' => 'Faits',
                            ];

                            // ⭐ ترجمة "تعديل"
                            $editTranslations = [
                            'ar' => 'تعديل',
                            'en' => 'Edit',
                            'hi' => 'संपादित करें',
                            'id' => 'Edit',
                            'am' => 'አርትዕ',
                            'bn' => 'সম্পাদনা',
                            'ml' => 'തിരുത്തുക',
                            'fil' => 'I-edit',
                            'ur' => 'ترمیم',
                            'ta' => 'தொகு',
                            'ne' => 'सम्पादन',
                            'ps' => 'سمون',
                            'fr' => 'Modifier',
                            ];
                            
                            $editText = $editTranslations[$lang] ?? $editTranslations['ar'];
                            $factsText = $factsTranslations[$lang] ?? $factsTranslations['ar'];
                            $priceText = $priceTranslations[$lang] ?? $priceTranslations['ar'];
                            $numberOfPeopleText = $numberOfPeopleTranslations[$lang] ?? $numberOfPeopleTranslations['ar'];
                            $notClassifiedText = $notClassifiedTranslations[$lang] ?? $notClassifiedTranslations['ar'];
                            @endphp
                            <span class="text-muted">{{ $notClassifiedText }}</span> @endforelse
                        </div>
                    </div>

                  @if($recipe->chef_id != null)
                <div style="display: flex;">
                    <div class="dz-item-rating"
                        style="background-color: #29A500; font-size: 17px; overflow: hidden; line-height: unset; border: 2px solid #29A500;">
                        @if($recipe->user?->chefProfile?->official_image)
                        <img src="{{ asset('storage/' . $recipe->user->chefProfile->official_image) }}"
                            style="width: 100%; height: 100%;" alt="{{ $recipe->user->name }}">
                        @else
                        <img src="{{ asset('images/default-chef.png') }}" style="width: 100%; height: 100%;" alt="Chef">
                        @endif
                    </div>
                
                    <h5 style="position: absolute; right: 100px; top: 10px; font-size: 14px; color: gray;">
                        {{ __('messages.chef_recipes', ['name' => $recipe->user?->name ?? 'Chef']) }}
                    </h5>
                </div>
                @endif

                    <div class="item-wrapper">
                        <div class="dz-meta-items">
                            <div class="dz-price flex-1" style="justify-content: space-between; display: flex;">
                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <sub><i class="fa fa-users"
                                                style="font-size: 14px; margin-left: 5px;"></i></sub>{{
                                        $recipe->servings }}
                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray;">
                                    
                                        {{ app()->getLocale() == 'ar' ? 'عدد الأشخاص' : 'Number of people' }}
                                    </div>
                                </div>

                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div style="font-size: 18px;">
                                        <sub><i class="fa fa-clock"
                                                style="font-size: 14px; margin-left: 5px;"></i></sub>
                                        {{ $recipe->preparation_time }} 
                                        {{ app()->getLocale() == 'ar' ? 'دقيقة' : 'minute' }}
                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray;">
                                        {{-- {{ $prepTimeText }} --}}
                                        {{ app()->getLocale() == 'ar' ? 'وقت التحضير' : 'Preparation time' }}
                                    </div>
                                </div>

                                @if($recipe->is_free === '1')
                                <div class="price" style="flex-direction: column; align-items: center;">
                                    <div>
                                        <sub><i class="fa fa-coins" style="font-size: 14px;"></i></sub>{{ $recipe->price
                                        }}
                                    </div>
                                    <div style="width: fit-content; font-size: 12px; color: gray;">
                                        {{-- {{ $priceText }} --}}
                                        {{ app()->getLocale() == 'ar' ? 'قيمة الوجبة' : 'Meal price' }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

<div class="item-wrapper"
    style="justify-content: center; display: flex; align-items: center; gap: 5px; flex-direction: row; margin-top: 30px;">

    <button class="btn btn-primary" style="padding: 6px 5px !important;">
        <a href="{{ route('families.meals.ingredients', $recipe->id) }}" style="font-size: 14px; color: white;">
            {{-- {{ $ingredientsText }} --}}
            {{ app()->getLocale() == 'ar' ? 'المكونات' : 'ingredients' }}
        </a>
    </button>

    <button class="btn btn-warning" style="padding: 6px 5px !important;">
        <a href="{{ route('families.meals.steps', $recipe->id) }}" style="font-size: 14px; color: white;">
            {{-- {{ $stepsText }} --}}
            {{ app()->getLocale() == 'ar' ? 'خطوات التحضير' : 'Preparation steps' }}
        </a>
    </button>

    <button class="btn btn-info" style="padding: 6px 5px !important;">
        <a href="{{ route('families.meals.families', $recipe->id) }}?meal_plan_id={{ $mealPlan->id ?? '' }}"
            style="font-size: 14px; width: 79px; color: white;">
            {{-- {{ $familyMembersText }} --}}
            {{ app()->getLocale() == 'ar' ? 'عدد الافراد' : 'Number of people' }}
        </a>
    </button>

    <button class="btn btn-success" style="padding: 6px 5px !important;">
        <a href="{{ route('families.meals.facts', $recipe->id) }}" style="font-size: 14px; color: white;">
            {{-- {{ $factsText }} --}}
            {{ app()->getLocale() == 'ar' ? 'الحقائق' : 'Facts' }}
        </a>
    </button>

</div>
                </div>
            </div>
        </main>
        <!-- Main Content End -->
        @if (Auth::check() && Auth::user()->id == $recipe->user_id)
        <div class="footer-fixed-btn bottom-0 bg-white">
            <a href="{{ route('c1he3f.recpies.editChef', $recipe->id) }}"
                class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">{{ $editText }}</a>
        </div>
        @endif
    </div>

    <!-- Scripts -->
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