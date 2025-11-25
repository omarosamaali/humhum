<html lang="en" dir="rtl">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<head>

    <!-- Title -->
    <title>هم هم | Hum Hum</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Global CSS -->
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        :root {
            --primary-color: #29A500 !important;
        }

        #carts-chef {
            border: 0;
            box-shadow: none;
            background: transparent;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0px;
        }

        #name-chef {
            font-weight: 400;
            font-size: 13px;
        }

        select.form-select,
        .show-pass i,
        select.form-select,
        .form-text .link,
        .text-primary,
        .title-bar>a,
        .sidebar .navbar-nav li>a.active,
        .dz-mode .theme-btn i,
        .menubar-area .menubar-nav .nav-link i,
        .dz-card.list .dz-buy-btn {
            color: var(--primary-color) !important;
        }

        .dz-mode .theme-btn i.sun,
        .dz-mode .theme-btn.active i,
        .menubar-area .menubar-nav .nav-link.active i {
            color: white !important;
        }

        .sidebar .navbar-nav li>a.active .dz-icon svg path,
        .dz-categories-bx .icon-bx path[fill],
        .dz-categories-bx .icon-bx path {
            fill: var(--primary-color) !important;
        }

        .img-fluid {
            padding: 3px;
            display: flex;
            text-align: center;
            border: 2px solid var(--primary-color);
            border-radius: 50%;
            margin: auto;
            width: 50px;
            height: 50px;
            display: flex;
            text-align: center;
        }

        .dz-mode .theme-btn::after,
        .menubar-area .menubar-nav .nav-link:after {
            background: var(--primary-color) !important;
        }

        .language-icon {
            width: 23px;
            height: auto;
            top: -1px;
            position: relative;
        }

        .container-cart {
            box-shadow: 0px 0px 3px 3px #ededed;
            border-radius: 20px;
            background: #fafafa;
        }

        .container-cart img {
            border-radius: 0px 20px 20px 0px !important;
        }

        #overlay {
            position: absolute;
            top: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            width: 100%;
            height: 100%;
            border-radius: 0px 20px 20px 0px;
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

        .heart-switch {
            --duration: 0.45s;
            --stroke: #d1d6ee;
            --fill: #fff;
            --fill-active: #29A500;
            --shadow: #{rgba(#00093d, 0.25)

        }

        ;
        cursor: pointer;
        position: relative;
        transform: scale(var(--s, 1)) translateZ(0);
        transition: transform 0.2s;
        -webkit-tap-highlight-color: transparent;

        &:active {
            --s: 0.95;
        }

        input {
            -webkit-appearance: none;
            -moz-appearance: none;
            position: absolute;
            outline: none;
            border: none;
            pointer-events: none;
            z-index: 1;
            margin: 0;
            padding: 0;
            left: 1px;
            top: 1px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 1px 3px 0 var(--shadow);

            &+svg {
                width: 36px;
                height: 25px;
                fill: var(--fill);
                stroke: #29A500;
                stroke-width: 1px;
                stroke-linejoin: round;
                display: block;
                transition: stroke var(--duration), fill var(--duration);
            }

            &:not(:checked) {
                animation: uncheck var(--duration) linear forwards;
            }

            &:checked {
                animation: check var(--duration) linear forwards;

                &+svg {
                    --fill: var(--fill-active);
                    --stroke: #29A500;
                }
            }
        }
        }

        @keyframes uncheck {
            0% {
                transform: rotate(-30deg) translateX(13.5px) translateY(8px);
            }

            50% {
                transform: rotate(30deg) translateX(9px);
            }

            75% {
                transform: rotate(30deg) translateX(4.5px) scaleX(1.1);
            }

            100% {
                transform: rotate(30deg);
            }
        }

        @keyframes check {
            0% {
                transform: rotate(30deg);
            }

            25% {
                transform: rotate(30deg) translateX(4.5px) scaleX(1.1);
            }

            50% {
                transform: rotate(30deg) translateX(9px);
            }

            100% {
                transform: rotate(-30deg) translateX(13.5px) translateY(8px);
            }
        }

        .chef-logo {
            position: absolute;
            left: 36%;
            top: -20px;
            width: 36px;
        }

        .icon {
            text-align: center;
            align-items: center;
            display: flex;
            justify-content: center;
            font-size: 30px;
            color: var(--primary-color);
        }

        .theme-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            background: #1e293b;
            border-radius: 30px;
            padding: 6px 10px;
            width: 120px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .language-icon {
            width: 37px;
            height: 33px;
            padding: 5px;
            z-index: 2;
            transition: transform 0.3s ease;
        }

        .theme-btn::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 50%;
            height: calc(100% - 6px);
            background: #2563eb;
            border-radius: 30px;
            transition: left 0.3s ease;
            z-index: 1;
        }

        .theme-btn.en-active::after {
            left: calc(50% - -2px);
        }

        .dz-card.list .dz-media img {
            border-radius: 0px !important;
            height: 114px !important;
        }

        :root {
            --primary: #29A500 !important;
        }

        .btn:hover {
            background-color: #4a006e !important;
            border-color: #4a006e !important;
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

        ::selection {
            background: var(--primary-color) !important;
        }

        .chef-title-container {
            flex-direction: column;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chef-icon {
            width: 50px;
        }

        .recipe-media {
            position: relative;
        }

        .recipe-stats {
            display: flex;
            gap: 10px;
        }

        .stat-item {
            text-align: center;
            font-size: 14px;
        }

        .primary-icon {
            color: var(--primary-color);
        }

        .cuisine-tag {
            display: flex;
            gap: 10px;
            font-size: 13px;
            align-items: center;
        }

        .cuisine-flag {
            border-radius: 50% !important;
            width: 30px;
            height: 30px;
        }

        .favorite-btn {
            border: 0;
            background-color: unset;
        }

        .kitchen-title,
        .top-rated-title {
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .kitchen-icon,
        .badge-icon {
            width: 50px;
        }

        .kitchen-slide {
            width: 200px !important;
        }

        .kitchen-card {
            padding: 15px;
        }

        .kitchen-image {
            width: 50px;
            min-width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        .kitchen-name {
            width: 105px;
            display: block;
        }

        .top-rated-title {
            flex-direction: column;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-recipes-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .recipe-card {
            position: relative;
            box-shadow: 0px 0px 3px 3px #ededed;
            border-radius: 15px;
            width: 33%;
        }

        .recipe-image {
            width: 100%;
            height: 122px;
            border-radius: 15px 15px 0px 0px;
        }

        .recipe-name {
            text-align: center;
            font-size: 13px;
            padding: 5px 0px;
        }

        .notifications-title {
            margin-right: 0px !important;
        }

        .notification-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .lunch-tag {
            color: green;
        }

        .status-unavailable {
            color: red;
        }

        .status-new {
            color: rgb(38, 0, 255);
        }

        .container--cart {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1px;
        }

        .special-request {
            background: #29A500;
            color: white;
            width: 100%;
            text-align: center;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-top: 12px;
        }

        .button-special-request {
            flex: 1;
            padding: 15px;
            text-align: center;
            background: linear-gradient(135deg, #29A500 0%, #3dd105 100%);
            color: white;
            text-decoration: none;
            font-weight: bold;
            align-items: center;
            justify-content: center;
            display: flex;
            font-size: 21px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        @php
        $translations = [
        'ar' => [
        'my_account' => 'حسابي',
        'my_family' => 'عائلتي',
        'chefs' => 'الطباخين',
        'blacklist' => 'المحظورات',
        'cooking_schedule' => 'جدول الطبخ',
        'notifications' => 'الإشعارات',
        ],
        'en' => [
        'my_account' => 'My Account',
        'my_family' => 'My Family',
        'chefs' => 'Chefs',
        'blacklist' => 'Blacklist',
        'cooking_schedule' => 'Cooking Schedule',
        'notifications' => 'Notifications',
        ],
        'id' => [
        'my_account' => 'Akun Saya',
        'my_family' => 'Keluarga Saya',
        'chefs' => 'Koki',
        'blacklist' => 'Daftar Hitam',
        'cooking_schedule' => 'Jadwal Memasak',
        'notifications' => 'Notifikasi',
        ],
        'am' => [
        'my_account' => 'የእኔ መለያ',
        'my_family' => 'ቤተሰቤ',
        'chefs' => 'ኩኪዎች',
        'blacklist' => 'ጥቁር ዝርዝር',
        'cooking_schedule' => 'የማብሰያ መርሃ ግብር',
        'notifications' => 'ማሳወቂያዎች',
        ],
        'hi' => [
        'my_account' => 'मेरा खाता',
        'my_family' => 'मेरा परिवार',
        'chefs' => 'रसोइये',
        'blacklist' => 'ब्लैकलिस्ट',
        'cooking_schedule' => 'खाना पकाने का शेड्यूल',
        'notifications' => 'सूचनाएँ',
        ],
        'bn' => [
        'my_account' => 'আমার অ্যাকাউন্ট',
        'my_family' => 'আমার পরিবার',
        'chefs' => 'শেফ',
        'blacklist' => 'ব্ল্যাকলিস্ট',
        'cooking_schedule' => 'রান্নার সময়সূচী',
        'notifications' => 'বিজ্ঞপ্তি',
        ],
        'ml' => [
        'my_account' => 'എന്റെ അക്കൗണ്ട്',
        'my_family' => 'എന്റെ കുടുംബം',
        'chefs' => 'ഷെഫുമാർ',
        'blacklist' => 'ബ്ലാക്ക്‌ലിസ്റ്റ്',
        'cooking_schedule' => 'പാചക ഷെഡ്യൂൾ',
        'notifications' => 'അറിയിപ്പുകൾ',
        ],
        'fil' => [
        'my_account' => 'Aking Account',
        'my_family' => 'Aking Pamilya',
        'chefs' => 'Mga Chef',
        'blacklist' => 'Blacklist',
        'cooking_schedule' => 'Iskedyul ng Pagluluto',
        'notifications' => 'Mga Abiso',
        ],
        'ur' => [
        'my_account' => 'میرا اکاؤنٹ',
        'my_family' => 'میری فیملی',
        'chefs' => 'شیف',
        'blacklist' => 'بلیک لسٹ',
        'cooking_schedule' => 'کھانا پکانے کا شیڈول',
        'notifications' => 'اطلاعات',
        ],
        'ta' => [
        'my_account' => 'என் கணக்கு',
        'my_family' => 'என் குடும்பம்',
        'chefs' => 'சமையல்காரர்கள்',
        'blacklist' => 'கருப்பு பட்டியல்',
        'cooking_schedule' => 'சமையல் அட்டவணை',
        'notifications' => 'அறிவிப்புகள்',
        ],
        'ne' => [
        'my_account' => 'मेरो खाता',
        'my_family' => 'मेरो परिवार',
        'chefs' => 'भान्सेहरू',
        'blacklist' => 'कालोसूची',
        'cooking_schedule' => 'खाना पकाउने तालिका',
        'notifications' => 'सूचनाहरू',
        ],
        'ps' => [
        'my_account' => 'زما حساب',
        'my_family' => 'زما کورنۍ',
        'chefs' => 'پخلیان',
        'blacklist' => 'تور لیست',
        'cooking_schedule' => 'د پخلي مهالویش',
        'notifications' => 'خبرتیاوې',
        ],
        'fr' => [
        'my_account' => 'Mon compte',
        'my_family' => 'Ma famille',
        'chefs' => 'Chefs',
        'blacklist' => 'Liste noire',
        'cooking_schedule' => 'Planning cuisine',
        'notifications' => 'Notifications',
        ],
        ];

        // تحديد اللغة: من العضو أو الـ session
        $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
        $t = $translations[$lang] ?? $translations['ar'];
        @endphp
        <div>
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin: 0px 0px; width: 100%; margin-bottom: 10px;">
                <a href="{{ route('families.profile.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        😀
                    </span>
                    {{ $t['my_account'] }}
                </a>
                <a href="{{ route('families.family.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        👪
                    </span>
                    {{ $t['my_family'] }} </a>
                <a href="{{ route('families.cooks.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        👨‍🍳
                    </span>
                    {{ $t['chefs'] }}
                </a>
            </div>

            <div
                style="display: flex; justify-content: space-between; align-items: center; margin: 0px 0px; width: 100%;">
                <a href="{{ route('families.blocked.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        ❌
                    </span>
                    {{ $t['blacklist'] }}
                </a>
                <a href="{{ route('families.meals.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        📋
                    </span>
                    {{ $t['cooking_schedule'] }} </a>
                <a href="{{ route('families.notifications.index') }}" style="text-align: center; width: 105px;">
                    <span class="img-fluid icon">
                        🔔
                    </span>
                    {{ $t['notifications'] }}
                </a>
            </div>
        </div>
        @php
        $translations = [
        'ar' => [
        'special_requests' => 'طلبات خاصة',
        'special_requests_log' => 'سجل الطلبات',
        ],
        'en' => [
        'special_requests' => 'Special Requests',
        'special_requests_log' => 'Requests Log',
        ],
        'id' => [
        'special_requests' => 'Permintaan Khusus',
        'special_requests_log' => 'Log Permintaan',
        ],
        'am' => [
        'special_requests' => 'ልዩ ጥያቄዎች',
        'special_requests_log' => 'የጥያቄ መዝገብ',
        ],
        'hi' => [
        'special_requests' => 'विशेष अनुरोध',
        'special_requests_log' => 'अनुरोध लॉग',
        ],
        'bn' => [
        'special_requests' => 'বিশেষ অনুরোধ',
        'special_requests_log' => 'অনুরোধ লগ',
        ],
        'ml' => [
        'special_requests' => 'പ്രത്യേക അഭ്യർത്ഥനകൾ',
        'special_requests_log' => 'അഭ്യർത്ഥന ലോഗ്',
        ],
        'fil' => [
        'special_requests' => 'Mga Espesyal na Kahilingan',
        'special_requests_log' => 'Log ng Kahilingan',
        ],
        'ur' => [
        'special_requests' => 'خصوصی درخواستیں',
        'special_requests_log' => 'درخواستوں کا لاگ',
        ],
        'ta' => [
        'special_requests' => 'சிறப்பு கோரிக்கைகள்',
        'special_requests_log' => 'கோரிக்கை பதிவு',
        ],
        'ne' => [
        'special_requests' => 'विशेष अनुरोधहरू',
        'special_requests_log' => 'अनुरोध लग',
        ],
        'ps' => [
        'special_requests' => 'ځانګړي غوښتنې',
        'special_requests_log' => 'غوښتنو لاگ',
        ],
        'fr' => [
        'special_requests' => 'Demandes spéciales',
        'special_requests_log' => 'Journal des demandes',
        ],
        ];

        $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
        $t = $translations[$lang] ?? $translations['ar'];
        @endphp

        <div class="container--cart">
            <a href="{{ route('families.special.create') }}" style="border-radius: 0px 15px 15px 0px;"
                class="special-request">
                {{ $t['special_requests'] }}
            </a>
            <a href="{{ route('families.special.index') }}" style="border-radius: 15px 0px 0px 15px;"
                class="special-request">
                {{ $t['special_requests_log'] }}
            </a>
        </div>

        <div class="swiper categories-swiper dz-swiper m-b20" style="height: 190px !important;">
            @php
            // 1. مصفوفة الترجمات العامة
            $translations = [
            'ar' => [
            'next_meal_is' => 'الوجبة القادمة هي',
            'none' => 'لا يوجد',
            'no_plans' => 'لا توجد خطط حاليًا',
            ],
            'en' => [
            'next_meal_is' => 'Next meal is',
            'none' => 'None',
            'no_plans' => 'No plans yet',
            ],
            'id' => [
            'next_meal_is' => 'Makanan berikutnya adalah',
            'none' => 'Tidak ada',
            'no_plans' => 'Belum ada rencana',
            ],
            'am' => [
            'next_meal_is' => 'የሚቀጥለው ምግብ',
            'none' => 'ምንም',
            'no_plans' => 'እስካሁን ምንም እቅድ',
            ],
            'hi' => [
            'next_meal_is' => 'अगला भोजन है',
            'none' => 'कोई नहीं',
            'no_plans' => 'अभी कोई योजना नहीं',
            ],
            'bn' => [
            'next_meal_is' => 'পরবর্তী খাবার হলো',
            'none' => 'কোনোটিই নয়',
            'no_plans' => 'এখনো কোনো পরিকল্পনা নেই',
            ],
            'ml' => [
            'next_meal_is' => 'അടുത്ത ഭക്ഷണം',
            'none' => 'ഒന്നുമില്ല',
            'no_plans' => 'ഇതുവരെ പ്ലാനുകളില്ല',
            ],
            'fil' => [
            'next_meal_is' => 'Ang susunod na pagkain ay',
            'none' => 'Wala',
            'no_plans' => 'Wala pang plano',
            ],
            'ur' => [
            'next_meal_is' => 'اگلا کھانا ہے',
            'none' => 'کوئی نہیں',
            'no_plans' => 'ابھی تک کوئی منصوبہ نہیں',
            ],
            'ta' => [
            'next_meal_is' => 'அடுத்த உணவு',
            'none' => 'ஏதுமில்லை',
            'no_plans' => 'இதுவரை திட்டமில்லை',
            ],
            'ne' => [
            'next_meal_is' => 'अर्को खाना',
            'none' => 'कुनै पनि छैन',
            'no_plans' => 'अहिलेसम्म कुनै योजना छैन',
            ],
            'ps' => [
            'next_meal_is' => 'بل خواړه',
            'none' => 'هیڅ',
            'no_plans' => 'تر اوسه کوم پلان نشته',
            ],
            'fr' => [
            'next_meal_is' => 'Le prochain repas est',
            'none' => 'Aucun',
            'no_plans' => 'Aucun plan pour l\'instant',
            ],
            ];

            // 2. تحديد اللغة
            $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
            $t = $translations[$lang] ?? $translations['ar'];

            // 3. دالة لجلب الحقل حسب اللغة (مثل name_ar, name_en, ...)
            function getFieldByLang($model, $fieldBase)
            {
            global $lang;
            $field = $fieldBase . '_' . $lang;
            return $model->$field ?? $model->{$fieldBase . '_ar'} ?? $model->{$fieldBase} ?? '—';
            }
            @endphp
            <div class="title-bar mb-0 chef-title-container">
                @if ($recipe)
                <a href="{{ route('families.meals.show-meal', $recipe->recipe->id) }}">
                    <li class="container-cart">
                        <div class="dz-card list"
                            style="flex-direction: column; border: 1px solid #ccc; box-shadow: 0px 0px 0px 2px #cccccc7a;">
                            <p class="recpie-name">
                                {{-- {{ __('messages.next_meal_is') }} --}}
                                {{ $t['next_meal_is'] }}
                            </p>
                            <div class="dz-media"
                                style=" position: relative; display: flex; align-items: center; gap: 20px;">
                                <img src="assets/images/background.png"
                                    style="height: 136px !important; width: 150px; border-bottom-right-radius: 15px !important;"
                                    alt="">
                                <div class="dz-head">
                                    <h6 class="title">
                                        @php
                                        $langs = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
                                        @endphp
                                        {{ \App\Helpers\TranslationHelper::translate($recipe->recipe->title ?? '',
                                        $langs) }}</h6>
                                    @forelse ($recipe->recipe->subCategories as $subCategory)
                                   <span class="badge badge-info">
                                    {{ $subCategory?->recipe?->getTranslation('name', $lang) ?? $subCategory?->recipe?->name }}
                                </span>
                                    @empty
                                    <span class="text-muted">{{ $t['none'] }}</span>
                                    @endforelse
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
                                    <div>
                                        <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                            class="tags">
                                            <img src="{{ asset('storage/' . $recipe->recipe->kitchen->image) }}"
                                                style="border-radius: 50% !important; width: 30px !important; height: 30px !important;"
                                                alt="">
                                            @php
                                            $lang = session('cook_language')
                                            ?? session('family_language')
                                            ?? 'ar';
                                            function tdb($model, $lang, $field = 'name')
                                            {
                                            if (!$model) return '—';
                                            $key = "{$field}_{$lang}";
                                            return $model->$key
                                            ?? $model->{"{$field}_ar"}
                                            ?? $model->$field
                                            ?? '—';
                                            }
                                            @endphp
                                            <span>{{ tdb($recipe->recipe->kitchen, $lang, 'name') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </a>
                @else
                <p style="text-align: center; font-size: 21px;">{{ $t['no_plans'] }}</p>
                @endif
            </div>
        </div>
    </div>
    <div style="display: flex; width: 100%; height: 35%;">
        @php
        $lang = session('cook_language')
        ?? session('family_language')
        ?? 'ar';
        $static = [
        'ar' => [
        'new_request' => 'طلب جديد',
        'cooking_schedule' => 'جدول الطبخ',
        ],
        'en' => [
        'new_request' => 'New Request',
        'cooking_schedule' => 'Cooking Schedule',
        ],
        'id' => [
        'new_request' => 'Permintaan Baru',
        'cooking_schedule' => 'Jadwal Memasak',
        ],
        'am' => [
        'new_request' => 'አዲስ ጥያቄ',
        'cooking_schedule' => 'የማብሰያ መርሃ ግብር',
        ],
        'hi' => [
        'new_request' => 'नया अनुरोध',
        'cooking_schedule' => 'खाना पकाने का शेड्यूल',
        ],
        'bn' => [
        'new_request' => 'নতুন অনুরোধ',
        'cooking_schedule' => 'রান্নার সময়সূচী',
        ],
        'ml' => [
        'new_request' => 'പുതിയ അഭ്യർത്ഥന',
        'cooking_schedule' => 'പാചക ഷെഡ്യൂൾ',
        ],
        'fil' => [
        'new_request' => 'Bagong Kahilingan',
        'cooking_schedule' => 'Iskedyul ng Pagluluto',
        ],
        'ur' => [
        'new_request' => 'نیا درخواست',
        'cooking_schedule' => 'کھانا پکانے کا شیڈول',
        ],
        'ta' => [
        'new_request' => 'புதிய கோரிக்கை',
        'cooking_schedule' => 'சமையல் அட்டவணை',
        ],
        'ne' => [
        'new_request' => 'नयाँ अनुरोध',
        'cooking_schedule' => 'खाना पकाउने तालिका',
        ],
        'ps' => [
        'new_request' => 'نوې غوښتنه',
        'cooking_schedule' => 'د پخلي مهالویش',
        ],
        'fr' => [
        'new_request' => 'Nouvelle demande',
        'cooking_schedule' => 'Planning cuisine',
        ],
        ];

        $t = $static[$lang] ?? $static['ar'];
        @endphp

        <a href="{{ route('families.meals.show', $recipe->id) }}" class="button-special-request">
            {{ $t['new_request'] }}
        </a>
        <a href="{{ route('families.meals.index') }}" class="button-special-request">
            {{ $t['cooking_schedule'] }}
        </a>
    </div>
    @if(auth()->check() || session('is_family_logged_in') || session('is_cook_logged_in'))

@endif
</body>

</html>
