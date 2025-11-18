<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>أفراد منزلي</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">


    <!-- Global CSS -->
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #29A500;
        }
    </style>
</head>

<body style="direction: rtl;">
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
        <header class="header header-fixed border-bottom onepage">
            <div class="header-content">
                <div class="left-content">
                </div>
                <div class="mid-content">
                    <h4 class="title">@php
                    $lang = session('cook_language')
            ?? session('family_language')
            ?? 'ar';
                    
                    $t = [
                    'ar' => 'أفراد منزلي',
                    'en' => 'My Household Members',
                    'id' => 'Anggota Rumah Tangga Saya',
                    'am' => 'የቤተሰቤ አባላት',
                    'hi' => 'मेरे घर के सदस्य',
                    'bn' => 'আমার পরিবারের সদস্যরা',
                    'ml' => 'എന്റെ വീട്ടിലെ അംഗങ്ങൾ',
                    'fil' => 'Mga Miyembro ng Aking Tahanan',
                    'ur' => 'میرے گھر کے افراد',
                    'ta' => 'என் வீட்டு உறுப்பினர்கள்',
                    'ne' => 'मेरो घरका सदस्यहरू',
                    'ps' => 'زما د کورنۍ غړي',
                    'fr' => 'Membres de mon foyer',
                    ][$lang] ?? 'أفراد منزلي';
                    @endphp
                    
                    <h4 class="title">{{ $t }}</h4></h4>
                </div>
                <div class="right-content">
                    <a href="{{ route('families.welcome') }}"
                        style="background-color: unset !important; font-size: 24px;">
                        <i class="feather icon-home" style="font-weight: normal; color: #29A500;"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Page Content Start -->
        @if(session('success'))
        <div id="toast-message" class="toast-message success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div id="toast-message" class="toast-message error">
            <i class="fas fa-times-circle"></i>
            {{ session('error') }}
        </div>
        @endif
        @php
        $lang = session('cook_language')
            ?? session('family_language')
            ?? 'ar';
        
        // ترجمات ستاتيك
        $t = [
        'my_family_members' => [
        'ar' => 'أفراد عائلتي',
        'en' => 'My Family Members',
        'id' => 'Anggota Keluarga Saya',
        'am' => 'የቤተሰቤ አባላት',
        'hi' => 'मेरे परिवार के सदस्य',
        'bn' => 'আমার পরিবারের সদস্যরা',
        'ml' => 'എന്റെ കുടുംബാംഗങ്ങൾ',
        'fil' => 'Aking Mga Miyembro ng Pamilya',
        'ur' => 'میرے خاندان کے افراد',
        'ta' => 'என் குடும்ப உறுப்பினர்கள்',
        'ne' => 'मेरो परिवारका सदस्यहरू',
        'ps' => 'زما د کورنۍ غړي',
        'fr' => 'Membres de ma famille',
        ],
        'yes' => [
        'ar' => 'نعم',
        'en' => 'Yes',
        'id' => 'Ya',
        'am' => 'አዎ',
        'hi' => 'हाँ',
        'bn' => 'হ্যাঁ',
        'ml' => 'അതെ',
        'fil' => 'Oo',
        'ur' => 'ہاں',
        'ta' => 'ஆம்',
        'ne' => 'हो',
        'ps' => 'هو',
        'fr' => 'Oui',
        ],
        'no' => [
        'ar' => 'لا',
        'en' => 'No',
        'id' => 'Tidak',
        'am' => 'አይ',
        'hi' => 'नहीं',
        'bn' => 'না',
        'ml' => 'ഇല്ല',
        'fil' => 'Hindi',
        'ur' => 'نہیں',
        'ta' => 'இல்லை',
        'ne' => 'होइन',
        'ps' => 'نه',
        'fr' => 'Non',
        ],
        'lang_names' => [
        'ar' => 'العربية',
        'en' => 'English',
        'id' => 'Indonesia',
        'am' => 'አማርኛ',
        'hi' => 'हिन्दी',
        'bn' => 'বাংলা',
        'ml' => 'മലയാളം',
        'fil' => 'Filipino',
        'ur' => 'اردو',
        'ta' => 'தமிழ்',
        'ne' => 'नेपाली',
        'ps' => 'پښتو',
        'fr' => 'Français',
        ],
        ];
        
        // دالة ترجمة بسيطة
        $trans = fn($group, $key = null) =>
        $key ? ($t[$group][$key][$lang] ?? $t[$group][$key]['ar'] ?? $key)
        : ($t[$group][$lang] ?? $t[$group]['ar'] ?? $group);
        @endphp
        <main class="page-content space-top">
            <div style="text-align: center; margin-bottom: 10px;">
                <span class="img-fluid icon">
                    👪
                </span>
                {{-- {{ __('messages.my_family_members') }} --}}
                {{ $trans('my_family_members') }}
            </div>
            <ul class="featured-list">
                <div>
                    @foreach ($myFamilies as $myFamily)
                    <li class="container-cart">
                        <div class="dz-card list" style="margin-bottom: 11px; margin-right: 8px;">
                            <div class="dz-media" style="margin-left: 0px; min-width: 93px; position: relative;">
                                <img src="{{ $myFamily->avatar ? $myFamily->avatar : asset('assets/images/default.jpg') }}"
                                    style="width: 70px; height: 70px; margin: auto; margin-top: 10px; border-radius: 50%; border: 2px solid var(--primary-color)"
                                    class="card-img-top" alt="...">
                            </div>
                            <div class="dz-content" style="justify-content: center;">
                                <div class="dz-head">
                                    <h6 class="title">
                                        <span>{{ $myFamily->name }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <ul class="tag-list" style="display: flex; gap: 10px; justify-content: space-evenly;">
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-user" style="color: var(--primary-color);"></i>
                                {{ $myFamily?->has_email == '1' ? $trans('yes') : $trans('no') }}
                            </li>
                           @php
                        $lang = session('cook_language')
            ?? session('family_language')
            ?? 'ar';
                        
                        // مصفوفة أسماء اللغات (مترجمة)
                        $langNames = [
                        'ar' => 'العربية',
                        'en' => 'English',
                        'id' => 'Indonesia',
                        'am' => 'አማርኛ',
                        'hi' => 'हिन्दी',
                        'bn' => 'বাংলা',
                        'ml' => 'മലയാളം',
                        'fil' => 'Filipino',
                        'ur' => 'اردو',
                        'ta' => 'தமிழ்',
                        'ne' => 'नेपाली',
                        'ps' => 'پښتو',
                        'fr' => 'Français',
                        ];
                        
                        // دالة بسيطة لجلب اسم اللغة
                        $getLangName = fn($code) => $langNames[$code] ?? ucfirst($code);
                        @endphp
                        
                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                            <i class="fa-solid fa-earth" style="color: var(--primary-color);"></i>
                            {{ $getLangName($myFamily->language) }}
                        </li>
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-list-check" style="color: var(--primary-color);"></i>
                                0
                            </li>
                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                <i class="fa-solid fa-bell" style="color: var(--primary-color);"></i>
                                {{ $myFamily->send_notification == '1' ? $trans('yes') : $trans('no') }}
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </div>
            </ul>
        </main>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script><!-- Swiper -->
    <script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>