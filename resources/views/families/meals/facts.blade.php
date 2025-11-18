<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <title>Ombe - الحقائق الغذائية</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Global CSS -->
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/imageuplodify/imageuploadify.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: white;
            min-height: 100vh;
            direction: rtl;
            color: #333;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
        }

        /* Header Styles */

        .header h1 {
            color: white;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
        }

        /* Nutrition Card */
        .nutrition-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Nutrition Items */
        .nutrition-item {
            display: flex;
            align-items: center;
            padding: 20px;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%);
            border-radius: 18px;
            border-left: 5px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nutrition-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(103, 126, 234, 0.15);
        }

        .nutrition-item:hover::before {
            opacity: 1;
        }

        /* Icons */
        .icon-container {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 20px;
            position: relative;
            z-index: 1;
        }

        .nutrition-item:nth-child(1) .icon-container {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        }

        .nutrition-item:nth-child(2) .icon-container {
            background: linear-gradient(135deg, #4ecdc4, #6dd5db);
        }

        .nutrition-item:nth-child(3) .icon-container {
            background: linear-gradient(135deg, #45b7d1, #67c5e0);
        }

        .nutrition-item:nth-child(4) .icon-container {
            background: linear-gradient(135deg, #96ceb4, #a8d5c4);
        }

        .icon-container svg {
            width: 28px;
            height: 28px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        /* Content */
        .nutrition-content {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .nutrition-label {
            font-size: 14px;
            color: #666;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .nutrition-value {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Decorative Elements */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            .nutrition-card {
                padding: 20px;
            }

            .nutrition-item {
                padding: 15px;
            }

            .icon-container {
                width: 50px;
                height: 50px;
                margin-left: 15px;
            }

            .nutrition-value {
                font-size: 20px;
            }
        }

        /* Loading Animation */
        .nutrition-item {
            opacity: 0;
            animation: slideIn 0.6s ease forwards;
        }

        .nutrition-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .nutrition-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .nutrition-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .nutrition-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header header-fixed border-bottom">
        <div class="header-content">
            <div class="mid-content">
                @php
                $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
                $factsTranslations = [
                'ar' => 'حقائق',
                'en' => 'Facts',
                'hi' => 'तथ्य',
                'id' => 'Fakta',
                'am' => 'እውነታዎች',
                'bn' => 'তথ্য',
                'ml' => 'തത്വങ്ങൾ',
                'fil' => 'Mga Katotohanan',
                'ur' => 'حقائق',
                'ta' => 'வास्तவங்கள்',
                'ne' => 'तथ्यहरू',
                'ps' => 'حقایق',
                'fr' => 'Faits',
                ];
                $factsText = $factsTranslations[$lang] ?? $factsTranslations['ar'];
                @endphp

                <h4 class="title">{{ $factsText }}</h4>
            </div>
            <div class="left-content">
                <a href="{{ url()->previous() }}" id="back-btn">
                    <i class="feather icon-arrow-left"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- Header -->
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="nutrition-card">
@php
$lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';

$nutritionLabels = [
'calories' => [
'ar' => 'السعرات الحرارية',
'en' => 'Calories',
'hi' => 'कैलोरीज़',
'id' => 'Kalori',
'am' => 'ካሎሪ',
'bn' => 'ক্যালোরি',
'ml' => 'കാൽറീസ്',
'fil' => 'Kaloriya',
'ur' => 'کیلوریز',
'ta' => 'கலோரி',
'ne' => 'क्यालोरी',
'ps' => 'کالوري',
'fr' => 'Calories',
],
'calorie' => [
'ar' => 'سعرة',
'en' => 'cal',
'hi' => 'कैल',
'id' => 'kal',
'am' => 'ካሎሪ',
'bn' => 'কাল',
'ml' => 'കാൽ',
'fil' => 'kal',
'ur' => 'کیل',
'ta' => 'காலரி',
'ne' => 'काल',
'ps' => 'کال',
'fr' => 'cal',
],
'fats' => [
'ar' => 'الدهون',
'en' => 'Fats',
'hi' => 'वसा',
'id' => 'Lemak',
'am' => 'ስብ',
'bn' => 'চর্বি',
'ml' => 'ചെറുകഷണം',
'fil' => 'Taba',
'ur' => 'چربی',
'ta' => 'கொழுப்பு',
'ne' => 'फ्याट्स',
'ps' => 'وړتیاوې',
'fr' => 'Graisses',
],
'carbs' => [
'ar' => 'الكربوهيدرات',
'en' => 'Carbs',
'hi' => 'कार्बोहाइड्रेट्स',
'id' => 'Karbohidrat',
'am' => 'ካርቦሃይድሬት',
'bn' => 'ক্যাবস',
'ml' => 'കാർബ്സ്',
'fil' => 'Carbs',
'ur' => 'کاربوہائیڈریٹس',
'ta' => 'கார்ப்ஸ்',
'ne' => 'कार्ब्स',
'ps' => 'کاربوهایدریټ',
'fr' => 'Glucides',
],
'protein' => [
'ar' => 'البروتين',
'en' => 'Protein',
'hi' => 'प्रोटीन',
'id' => 'Protein',
'am' => 'ፕሮቲን',
'bn' => 'প্রোটিন',
'ml' => 'പ്രോട്ടീൻ',
'fil' => 'Protina',
'ur' => 'پروٹین',
'ta' => 'புரோட்டீன்',
'ne' => 'प्रोटिन',
'ps' => 'پروټین',
'fr' => 'Protéines',
],
'gram' => [
'ar' => 'جرام',
'en' => 'g',
'hi' => 'ग्राम',
'id' => 'g',
'am' => 'ግራም',
'bn' => 'গ্রাম',
'ml' => 'ഗ്രാം',
'fil' => 'g',
'ur' => 'گرام',
'ta' => 'கிராம்',
'ne' => 'ग्राम',
'ps' => 'ګرام',
'fr' => 'g',
],
];

function t($key, $lang, $labels) {
return $labels[$key][$lang] ?? $labels[$key]['ar'];
}
@endphp

<!-- السعرات الحرارية -->
<div class="nutrition-item">
    <div class="icon-container">
        <svg viewBox="0 0 24 24" fill="white">
            <path
                d="M12,2A7,7 0 0,0 5,9C5,11.38 6.19,13.47 8,14.74V17A1,1 0 0,0 9,18H15A1,1 0 0,0 16,17V14.74C17.81,13.47 19,11.38 19,9A7,7 0 0,0 12,2M9,21V20H15V21A1,1 0 0,1 14,22H10A1,1 0 0,1 9,21M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5Z" />
        </svg>
    </div>
    <div class="nutrition-content">
        <div class="nutrition-label">{{ t('calories', $lang, $nutritionLabels) }}</div>
        <div class="nutrition-value">
            {{ $recipe->calories }}
            <span style="font-size: 16px; color: #999;">{{ t('calorie', $lang, $nutritionLabels) }}</span>
        </div>
    </div>
</div>

<!-- الدهون -->
<div class="nutrition-item">
    <div class="icon-container">
        <svg viewBox="0 0 24 24" fill="white">
            <path
                d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M12,16A1,1 0 0,1 13,17V21A1,1 0 0,1 12,22A1,1 0 0,1 11,21V17A1,1 0 0,1 12,16Z" />
        </svg>
    </div>
    <div class="nutrition-content">
        <div class="nutrition-label">{{ t('fats', $lang, $nutritionLabels) }}</div>
        <div class="nutrition-value">
            {{ $recipe->fats }}
            <span style="font-size: 16px; color: #999;">{{ t('gram', $lang, $nutritionLabels) }}</span>
        </div>
    </div>
</div>

<!-- الكربوهيدرات -->
<div class="nutrition-item">
    <div class="icon-container">
        <svg viewBox="0 0 24 24" fill="white">
            <path
                d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z" />
        </svg>
    </div>
    <div class="nutrition-content">
        <div class="nutrition-label">{{ t('carbs', $lang, $nutritionLabels) }}</div>
        <div class="nutrition-value">
            {{ $recipe->carbs }}
            <span style="font-size: 16px; color: #999;">{{ t('gram', $lang, $nutritionLabels) }}</span>
        </div>
    </div>
</div>

<!-- البروتين -->
<div class="nutrition-item">
    <div class="icon-container">
        <svg viewBox="0 0 24 24" fill="white">
            <path
                d="M12,2C13.1,2 14,2.9 14,4C14,5.1 13.1,6 12,6C10.9,6 10,5.1 10,4C10,2.9 10.9,2 12,2M21,9V7L15,13L13.5,7.5C13.1,6.2 11.9,5.2 10.5,5.2C9.1,5.2 7.9,6.2 7.5,7.5L6,13L0,7V9L6,15L7.5,9.5C7.9,8.2 9.1,7.2 10.5,7.2C11.9,7.2 13.1,8.2 13.5,9.5L15,15L21,9Z" />
        </svg>
    </div>
    <div class="nutrition-content">
        <div class="nutrition-label">{{ t('protein', $lang, $nutritionLabels) }}</div>
        <div class="nutrition-value">
            {{ $recipe->protein }}
            <span style="font-size: 16px; color: #999;">{{ t('gram', $lang, $nutritionLabels) }}</span>
        </div>
    </div>
</div>
        </div>
    </div>
</body>

</html>