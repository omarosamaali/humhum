<!DOCTYPE html>
<html lang="ar">

<head>
    <title>طلب خاص</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/user-logo/favicon.png') }}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --primary-color: #660099;
            --primary: var(--primary-color);
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .text-right {
            text-align: right;
        }

        /* Tabs Styling */
        .custom-tabs {
            background: white;
            margin-top: 70px;
            border-bottom: 2px solid #e9ecef;
        }

        .nav-tabs {
            border: none;
            display: flex;
            justify-content: space-around;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 600;
            font-size: 16px;
            padding: 15px 30px;
            position: relative;
            background: transparent;
            border-radius: 0;
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary-color);
            background: transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            background: transparent;
            border: none;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-color);
        }

        .order-header {
            display: flex;
        }

        .order-avatar {
            width: 110px;
            height: 120px;
            border-radius: 0px 15px 15px 0px;
        }

        .order-card {
            background: white;
            border-radius: 12px;
            margin: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .order-info {
            padding: 10px;
        }

        .order-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .order-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        p {
            margin-bottom: 0.2rem;
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

        @php
        // تحديد اللغة
        $lang = $lang = session('cook_language')
        ?? session('family_language')
        ?? 'ar';

        $t = $t ?? []; // لو سبق وعرفت $t في مكان تاني استخدمه، وإلا خليه موجود لتجنب أخطاء
        // ترجمات ثابتة للنصوص في هذا الصفحة
        $t = [
        'meal_type' => [
        'breakfast' => [
        'ar' => 'فطور',
        'en' => 'Breakfast',
        'hi' => 'नाश्ता',
        'id' => 'Sarapan',
        'am' => 'ቁርስ',
        'bn' => 'নাশতা',
        'ml' => 'പ്രഭാതഭക്ഷണം',
        'fil' => 'Almusal',
        'ur' => 'ناشتہ',
        'ta' => 'காலை உணவு',
        'ne' => 'बिहानीको खाजा',
        'ps' => 'ناشته',
        'fr' => 'Petit déjeuner',
        ],
        'lunch' => [
        'ar' => 'غداء',
        'en' => 'Lunch',
        'hi' => 'दोपहर का भोजन',
        'id' => 'Makan Siang',
        'am' => 'ቀትር',
        'bn' => 'দুপুরের খাবার',
        'ml' => 'ഉച്ചഭക്ഷണം',
        'fil' => 'Tanghalian',
        'ur' => 'دوپہر کا کھانا',
        'ta' => 'மதிய உணவு',
        'ne' => 'मध्यान्ह भोजन',
        'ps' => 'غرمنۍ ډوډۍ',
        'fr' => 'Déjeuner',
        ],
        'dinner' => [
        'ar' => 'عشاء',
        'en' => 'Dinner',
        'hi' => 'रात का खाना',
        'id' => 'Makan Malam',
        'am' => 'እራት',
        'bn' => 'রাতের খাবার',
        'ml' => 'വൈകുന്നേര ഭക്ഷണം',
        'fil' => 'Hapunan',
        'ur' => 'رات کا کھانا',
        'ta' => 'இரவு உணவு',
        'ne' => 'बेलुकीको खाना',
        'ps' => 'ماښامنۍ ډوډۍ',
        'fr' => 'Dîner',
        ],
        'snack' => [
        'ar' => 'وجبة خفيفة',
        'en' => 'Snack',
        'hi' => 'नाश्ता',
        'id' => 'Camilan',
        'am' => 'ቅቤ',
        'bn' => 'হালকা খাবার',
        'ml' => 'ലഘുഭക്ഷണം',
        'fil' => 'Meryenda',
        'ur' => 'ہلکی پھلکی خوراک',
        'ta' => 'இலேசான சிற்றுண்டி',
        'ne' => 'हल्का खाना',
        'ps' => 'لنډه ډوډۍ',
        'fr' => 'Collation',
        ],
        ],
        'special_requests' => [
        'ar' => 'الطلبات الخاصة',
        'en' => 'Special Requests',
        'hi' => 'विशेष अनुरोध',
        'id' => 'Permintaan Khusus',
        'am' => 'ልዩ ጥያቄዎች',
        'bn' => 'বিশেষ অনুরোধসমূহ',
        'ml' => 'പ്രത്യേക അഭ്യർത്ഥനകൾ',
        'fil' => 'Mga Espesyal na Kahilingan',
        'ur' => 'خاص درخواستیں',
        'ta' => 'சிறப்பு கோரிக்கைகள்',
        'ne' => 'विशेष अनुरोधहरू',
        'ps' => 'ځانګړې غوښتنې',
        'fr' => 'Demandes spéciales',
        ],
        'request_from' => [
        'ar' => 'طلب من',
        'en' => 'Request from',
        'hi' => 'अनुरोध से',
        'id' => 'Permintaan dari',
        'am' => 'ጥያቄ ከ',
        'bn' => 'অনুরোধ থেকে',
        'ml' => 'അഭ്യർത്ഥനയിൽ നിന്ന്',
        'fil' => 'Kahilingan mula sa',
        'ur' => 'درخواست از',
        'ta' => 'கோரிக்கை இருந்து',
        'ne' => 'अनुरोध बाट',
        'ps' => 'غوښتنه له',
        'fr' => 'Demande de',
        ],
        'to' => [
        'ar' => 'إلى',
        'en' => 'to',
        'hi' => 'को',
        'id' => 'kepada',
        'am' => 'ወደ',
        'bn' => 'প্রতি',
        'ml' => 'ലേക്ക്',
        'fil' => 'sa',
        'ur' => 'کو',
        'ta' => 'க்கு',
        'ne' => 'लाई',
        'ps' => 'ته',
        'fr' => 'à',
        ],
        ];
        @endphp

        <!-- Header -->
        <header class="header header-fixed" style="border-bottom: 1px solid #bababa;">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('families.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ $t['special_requests'][$lang] ?? $t['special_requests']['ar'] }}</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>

        <!-- Tabs Content -->
        <div style="direction: rtl; margin-top: 100px;" class="tab-content" id="ordersTabsContent">
            <!-- My Orders Tab -->
            <div class="tab-pane fade show active" id="my-orders" role="tabpanel">
                @forelse ($specialRequests as $specialRequest)
                <a href="{{ route('families.meals.show-meal', $specialRequest->recipe->id) }}">
                    <div style="border: 1px solid #bababa; border-radius: 16px;" class="order-card">
                        <div class="order-header">
                            <img src="{{ asset('storage/' . $specialRequest->recipe->dish_image) }}" alt="صورة الوجبة"
                                class="order-avatar">
                            <div class="order-info">
                                <p class="order-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $specialRequest->created_at->translatedFormat('Y/m/d') }}
                                    <i class="far fa-clock"></i>
                                    {{ $specialRequest->created_at->translatedFormat('h:i A') }}
                                </p>
                                <p class="order-title">
                                    {{ $t['request_from'][$lang] ?? $t['request_from']['ar'] }}
                                    <strong>{{ $specialRequest->familyUserRecipe->name }}</strong>
                                    {{ $t['to'][$lang] ?? $t['to']['ar'] }}
                                    <strong>
                                        @if($specialRequest->cook_id)
                                        {{ $specialRequest->cook->name }}
                                        @else
                                        {{ $specialRequest->familyMember->name }}
                                        @endif
                                    </strong>
                                </p>
                                <p>
                                    @php
                                    // جلب نوع الوجبة بناءً على اللغة
                                    $mealType = $t['meal_type'][$specialRequest->meal_type][$lang]
                                    ?? ucfirst($specialRequest->meal_type);
                                    @endphp
                                    {{ $mealType }}
                                </p>
                                <p>
                                    @php
                                    $translatedTitle =
                                    \App\Helpers\TranslationHelper::translate($specialRequest->recipe->title
                                    ?? '', $lang);
                                    if (empty($translatedTitle) || $translatedTitle === $specialRequest->recipe->title)
                                    {
                                    $translatedTitle = $t[$specialRequest->recipe->title][$lang] ??
                                    $specialRequest->recipe->title;
                                    }
                                    echo $translatedTitle;
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="text-center py-5">
                    <i class="feather icon-inbox" style="font-size: 48px; color: #ddd;"></i>
                    <p class="text-muted mt-3">{{ __('messages.no_special_requests') }}</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>