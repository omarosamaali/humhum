<!DOCTYPE html>
<html lang="ar" dir="rtl">

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
$translations = [
'ar' => [
'special_requests' => 'الطلبات الخاصة',
'no_requests' => 'لا توجد طلبات خاصة حالياً',
'request_from' => 'طلب من',
'to' => 'إلى',
'unknown' => 'غير محدد',
'breakfast' => 'إفطار',
'lunch' => 'غداء',
'dinner' => 'عشاء',
'snack' => 'وجبة خفيفة',
],
'en' => [
'special_requests' => 'Special Requests',
'no_requests' => 'No special requests at the moment',
'request_from' => 'Request from',
'to' => 'to',
'unknown' => 'Unknown',
'breakfast' => 'Breakfast',
'lunch' => 'Lunch',
'dinner' => 'Dinner',
'snack' => 'Snack',
],
'id' => [
'special_requests' => 'Permintaan Khusus',
'no_requests' => 'Tidak ada permintaan khusus saat ini',
'request_from' => 'Permintaan dari',
'to' => 'ke',
'unknown' => 'Tidak diketahui',
'breakfast' => 'Sarapan',
'lunch' => 'Makan Siang',
'dinner' => 'Makan Malam',
'snack' => 'Cemilan',
],
'am' => [
'special_requests' => 'ልዩ ጥያቄዎች',
'no_requests' => 'በአሁኑ ጊዜ ልዩ ጥያቄዎች የሉም',
'request_from' => 'ጥያቄ ከ',
'to' => 'ወደ',
'unknown' => 'ያልታወቀ',
'breakfast' => 'ቁርስ',
'lunch' => 'ምሳ',
'dinner' => 'እራት',
'snack' => 'መክሰስ',
],
'hi' => [
'special_requests' => 'विशेष अनुरोध',
'no_requests' => 'वर्तमान में कोई विशेष अनुरोध नहीं',
'request_from' => 'अनुरोध से',
'to' => 'को',
'unknown' => 'अज्ञात',
'breakfast' => 'नाश्ता',
'lunch' => 'दोपहर का भोजन',
'dinner' => 'रात का खाना',
'snack' => 'नाश्ता',
],
'bn' => [
'special_requests' => 'বিশেষ অনুরোধ',
'no_requests' => 'বর্তমানে কোনো বিশেষ অনুরোধ নেই',
'request_from' => 'অনুরোধ থেকে',
'to' => 'প্রতি',
'unknown' => 'অজানা',
'breakfast' => 'সকালের নাস্তা',
'lunch' => 'দুপুরের খাবার',
'dinner' => 'রাতের খাবার',
'snack' => 'জলখাবার',
],
'ml' => [
'special_requests' => 'പ്രത്യേക അഭ്യർത്ഥനകൾ',
'no_requests' => 'നിലവിൽ പ്രത്യേക അഭ്യർത്ഥനകളൊന്നുമില്ല',
'request_from' => 'അഭ്യർത്ഥന',
'to' => 'ലേക്ക്',
'unknown' => 'അജ്ഞാതം',
'breakfast' => 'പ്രാതൽ',
'lunch' => 'ഉച്ചഭക്ഷണം',
'dinner' => 'അത്താഴം',
'snack' => 'ലഘുഭക്ഷണം',
],
'fil' => [
'special_requests' => 'Mga Espesyal na Kahilingan',
'no_requests' => 'Walang espesyal na kahilingan sa ngayon',
'request_from' => 'Kahilingan mula kay',
'to' => 'kay',
'unknown' => 'Hindi kilala',
'breakfast' => 'Almusal',
'lunch' => 'Tanghalian',
'dinner' => 'Hapunan',
'snack' => 'Meryenda',
],
'ur' => [
'special_requests' => 'خصوصی درخواستیں',
'no_requests' => 'اس وقت کوئی خصوصی درخواست نہیں',
'request_from' => 'درخواست سے',
'to' => 'کو',
'unknown' => 'نامعلوم',
'breakfast' => 'ناشتہ',
'lunch' => 'دوپہر کا کھانا',
'dinner' => 'رات کا کھانا',
'snack' => 'ہلکا ناشتہ',
],
'ta' => [
'special_requests' => 'சிறப்பு கோரிக்கைகள்',
'no_requests' => 'தற்போது சிறப்பு கோரிக்கைகள் இல்லை',
'request_from' => 'கோரிக்கை',
'to' => 'க்கு',
'unknown' => 'தெரியவில்லை',
'breakfast' => 'காலை உணவு',
'lunch' => 'மதிய உணவு',
'dinner' => 'இரவு உணவு',
'snack' => 'தின்பண்டம்',
],
'ne' => [
'special_requests' => 'विशेष अनुरोधहरू',
'no_requests' => 'हाल कुनै विशेष अनुरोध छैन',
'request_from' => 'अनुरोधबाट',
'to' => 'लाई',
'unknown' => 'अज्ञात',
'breakfast' => 'बिहानको खाना',
'lunch' => 'दिउँसोको खाना',
'dinner' => 'रातिको खाना',
'snack' => 'खाजा',
],
'ps' => [
'special_requests' => 'ځانګړې غوښتنې',
'no_requests' => 'اوس مهال ځانګړې غوښتنې نشته',
'request_from' => 'غوښتنه له',
'to' => 'ته',
'unknown' => 'نامعلوم',
'breakfast' => 'سهارنۍ',
'lunch' => 'غرمه',
'dinner' => 'ماخوستن',
'snack' => 'لږ خواړه',
],
'fr' => [
'special_requests' => 'Demandes spéciales',
'no_requests' => 'Aucune demande spéciale pour le moment',
'request_from' => 'Demande de',
'to' => 'à',
'unknown' => 'Inconnu',
'breakfast' => 'Petit-déjeuner',
'lunch' => 'Déjeuner',
'dinner' => 'Dîner',
'snack' => 'Collation',
],
];

// قراءة اللغة من السيشن (آمنة من null)
$lang = session('cook_language', 'ar');
$t = $translations[$lang] ?? $translations['ar'];
@endphp

<header class="header header-fixed">
    <div class="header-content">
        <div class="right-content"></div>
        <div class="mid-content">
            <h4 class="title">{{ $t['special_requests'] }}</h4>
        </div>
        <div class="left-content">
            <a href="{{ route('chefs.welcome') }}" id="back-btn">
                <i class="feather icon-arrow-left"></i>
            </a>
        </div>
    </div>
</header>

<div style="margin-top: 10px !important;" class="container">
    <h1>{{ $t['special_requests'] }}</h1>
    <div class="requests-grid">
        @forelse($requests as $specialRequest)
        <a href="{{ route('families.meals.show-meal', $specialRequest->recipe->id) }}">
            <div class="order-card">
                <div class="order-header">
                    <img src="{{ asset('storage/' . $specialRequest->recipe->dish_image) }}" alt="صورة الطبق"
                        class="order-avatar">
                    <div class="order-info">
                        <p class="order-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ $specialRequest->created_at->format('Y/m/d') }}
                            <i class="far fa-clock"></i>
                            {{ $specialRequest->created_at->format('h:i A') }}
                        </p>
                        <p class="order-title">
                            {{ $t['request_from'] }}
                            {{ $specialRequest->user->name ?? $t['unknown'] }}
                            {{ $t['to'] }}
                            @if($specialRequest->cook_id && $specialRequest->cook)
                            {{ $specialRequest->cook->name }}
                            @elseif($specialRequest->familyMember)
                            {{ $specialRequest->familyMember->name }}
                            @else
                            {{ $t['unknown'] }}
                            @endif
                        </p>
                        <p>
                            {{ $t[strtolower($specialRequest->meal_type)] ?? $specialRequest->meal_type }}
                        </p>
                        <p>
                            {{ \App\Helpers\TranslationHelper::translate($specialRequest->recipe->title ?? '', $lang) }}
                        </p>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <p style="text-align: center; grid-column: 1/-1;">
            {{ $t['no_requests'] }}
        </p>
        @endforelse
    </div>
</div>

        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>