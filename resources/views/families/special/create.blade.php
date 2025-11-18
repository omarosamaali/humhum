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
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --primary-color: #29A500;
            --primary: var(--primary-color);
        }

        .text-right {
            text-align: right
        }

        * {
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        .form-control:focus,
        .form-control:active,
        .form-control.active {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 0, 153, 0.25) !important;
        }

        .form-control,
        .form-select {
            border: 2px solid #ebebeb !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            font-size: 15px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .step-container {
            display: none;
        }

        .step-container.active {
            display: block;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            gap: 10px;
        }

        .step-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ddd;
            transition: all 0.3s;
        }

        .step-dot.active {
            background-color: var(--primary-color);
            width: 30px;
            border-radius: 6px;
        }

        .member-card {
            border: 2px solid #ebebeb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .member-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(102, 0, 153, 0.1);
        }

        .member-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(102, 0, 153, 0.05);
        }

        .member-card input[type="checkbox"],
        .member-card input[type="radio"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary-color);
        }

        .cook-card {
            cursor: pointer;
        }

        .family-cook-card {
            cursor: pointer;
        }

        .attendee-card {
            cursor: pointer;
        }

        .btn-check:checked+.btn-outline-primary {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }

        .alert-info {
            background-color: rgba(102, 0, 153, 0.1);
            border: 1px solid rgba(102, 0, 153, 0.2);
            color: var(--primary-color);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
        }

        .meal-card {
            border: 2px solid #ebebeb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .meal-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(102, 0, 153, 0.1);
        }

        .meal-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(102, 0, 153, 0.05);
        }

        .meal-card input[type="radio"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary-color);
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            padding-right: 45px !important;
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-outline-primary {
            color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .guest-counter {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            border: 2px solid #ebebeb;
        }

        .counter-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            background: white;
            color: var(--primary-color);
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .counter-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .counter-btn:active {
            transform: scale(0.95);
        }

        .counter-value {
            font-size: 32px;
            font-weight: bold;
            color: var(--primary-color);
            min-width: 60px;
            text-align: center;
        }

        .page-content {
            padding-top: 70px;
            padding-bottom: 80px;
        }

        .meal-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: #999;
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
        $lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';
        if (!in_array($lang, ['ar', 'en', 'hi', 'id', 'am', 'bn', 'ml', 'fil', 'ur', 'ta', 'ne', 'ps', 'fr'])) {
        $lang = 'ar';
        }
        $t = [
        'special_request' => [
        'ar' => 'طلب خاص',
        'en' => 'Special Request',
        'hi' => 'विशेष अनुरोध',
        'id' => 'Permintaan Khusus',
        'am' => 'ልዩ ጥያቄ',
        'bn' => 'বিশেষ অনুরোধ',
        'ml' => 'പ്രത്യേക അഭ്യർത്ഥന',
        'fil' => 'Espesyal na Kahilingan',
        'ur' => 'خاص درخواست',
        'ta' => 'சிறப்பு கோரிக்கை',
        'ne' => 'विशेष अनुरोध',
        'ps' => 'ځانګړی غوښتنه',
        'fr' => 'Demande spéciale',
        ],
        'who_is_responsible_for_cooking' => [
        'ar' => 'من المسؤول عن الطبخ؟',
        'en' => 'Who is responsible for cooking?',
        'hi' => 'खाना बनाने की जिम्मेदारी किसकी है?',
        'id' => 'Siapa yang bertanggung jawab memasak?',
        'am' => 'ማብሰል ለማን ነው የሚመጣው?',
        'bn' => 'রান্নার দায়িত্ব কার?',
        'ml' => 'പാചകം ആരാണ് ഉത്തരവാദി?',
        'fil' => 'Sino ang may pananagutan sa pagluluto?',
        'ur' => 'کھانا پکانے کی ذمہ داری کس کی ہے؟',
        'ta' => 'சமைப்பதற்கு யார் பொறுப்பு?',
        'ne' => 'खाना पकाउने जिम्मेवاری कसको हो?',
        'ps' => 'د پخلي مسؤلیت چا ته دی؟',
        'fr' => 'Qui est responsable de la cuisson?',
        ],
        'family_members' => [
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
        ],
        'cooks' => [
        'ar' => 'الطباخين',
        'en' => 'Cooks',
        'hi' => 'रसोइये',
        'id' => 'Koki',
        'am' => 'ማብሰያዎች',
        'bn' => 'রাঁধুনি',
        'ml' => 'പാചകക്കാർ',
        'fil' => 'Mga Kusinero',
        'ur' => 'باورچی',
        'ta' => 'சமையல்காரர்கள்',
        'ne' => 'भान्सेहरू',
        'ps' => 'پخلی کوونکي',
        'fr' => 'Cuisiniers',
        ],
        'select_cook_responsible' => [
        'ar' => 'اختر الطباخ المسؤول عن تحضير الوجبة',
        'en' => 'Select the cook responsible for preparing the meal',
        'hi' => 'भोजन तैयार करने के लिए जिम्मेदार रसोइये का चयन करें',
        'id' => 'Pilih koki yang bertanggung jawab menyiapkan makanan',
        'am' => 'ምግብ ለማዘጋጀት የሚመለከተውን ማብሰያ ይምረጡ',
        'bn' => 'খাবার প্রস্তুতের জন্য দায়ী রাঁধুনি নির্বাচন করুন',
        'ml' => 'ഭക്ഷണം തയ്യാറാക്കുന്നതിന് ഉത്തരവാദിയായ പാചകക്കാരനെ തിരഞ്ഞെടുക്കുക',
        'fil' => 'Piliin ang kusinero na may pananagutan sa paghahanda ng pagkain',
        'ur' => 'کھانا تیار کرنے کے ذمہ دار باورچی کا انتخاب کریں',
        'ta' => 'உணவை தயாரிப்பதற்கு பொறுப்பான சமையல்காரரை தேர்வு செய்யவும்',
        'ne' => 'खाना तयार गर्न जिम्मेवार भान्सेको छनोट गर्नुहोस्',
        'ps' => 'د خواړو چمتو کولو لپاره مسؤل پخلی کوونکی غوره کړئ',
        'fr' => 'Sélectionnez le cuisinier responsable de la préparation du repas',
        ],
        'professional_cook' => [
        'ar' => 'طباخ محترف',
        'en' => 'Professional Cook',
        'hi' => 'पेशेवर रसोइया',
        'id' => 'Koki Profesional',
        'am' => 'ፕሮፌሽናል ማብሰያ',
        'bn' => 'পেশাদার রাঁধুনি',
        'ml' => 'പ്രൊഫഷണൽ പാചകക്കാരൻ',
        'fil' => 'Propesyonal na Kusinero',
        'ur' => 'پروفیشنل باورچی',
        'ta' => 'தொழில்முறை சமையல்காரர்',
        'ne' => 'व्यावसायिक भान्से',
        'ps' => 'مسلکي پخلی کوونکی',
        'fr' => 'Cuisinier professionnel',
        ],
        'select_family_cook_one_only' => [
        'ar' => 'اختر من سيقوم بالطبخ من أفراد العائلة (شخص واحد فقط)',
        'en' => 'Select who will cook from family members (one person only)',
        'hi' => 'परिवार के सदस्यों में से कौन खाना बनाएगा चुनें (केवल एक व्यक्ति)',
        'id' => 'Pilih siapa yang akan memasak dari anggota keluarga (satu orang saja)',
        'am' => 'ከቤተሰብ አባላት መካከል ማብሰል የሚፈልገውን ይምረጡ (አንድ ሰው ብቻ)',
        'bn' => 'পরিবারের সদস্যদের মধ্যে কে রান্না করবে তা নির্বাচন করুন (শুধুমাত্র একজন)',
        'ml' => 'കുടുംബാംഗങ്ങളിൽ നിന്ന് ആരാണ് പാചകം ചെയ്യുക എന്ന് തിരഞ്ഞെടുക്കുക (ഒരു വ്യക്തി മാത്രം)',
        'fil' => 'Piliin kung sino ang magluluto mula sa mga miyembro ng pamilya (isang tao lamang)',
        'ur' => 'خاندان کے افراد میں سے کون کھانا بنائے گا منتخب کریں (صرف ایک شخص)',
        'ta' => 'குடும்ப உறுப்பினர்களில் யார் சமைப்பார் என்பதை தேர்வு செய்யவும் (ஒரு நபர் மட்டும்)',
        'ne' => 'परिवारका सदस्यहरू मध्ये को पकाउनेछ छनोट गर्नुहोस् (एक व्यक्ति मात्र)',
        'ps' => 'د کورنۍ له غړو څخه څوک به پخلی کوي غوره کړئ (یو شخص یوازې)',
        'fr' => 'Sélectionnez qui cuisinera parmi les membres de la famille (une personne seulement)',
        ],
        'family_member' => [
        'ar' => 'فرد من العائلة',
        'en' => 'Family Member',
        'hi' => 'परिवार का सदस्य',
        'id' => 'Anggota Keluarga',
        'am' => 'የቤተሰብ አባል',
        'bn' => 'পরিবারের সদস্য',
        'ml' => 'കുടുംബാംഗം',
        'fil' => 'Miyembro ng Pamilya',
        'ur' => 'خاندان کا فرد',
        'ta' => 'குடுமப உறுப்பினர்',
        'ne' => 'परिवारका सदस्य',
        'ps' => 'د کورنۍ غړی',
        'fr' => 'Membre de la famille',
        ],
        'who_will_attend_meal' => [
        'ar' => 'من سيحضر الوجبة من أفراد العائلة ؟',
        'en' => 'Who will attend the meal from family members?',
        'hi' => 'परिवार के सदस्यों में से कौन भोजन में शामिल होगा?',
        'id' => 'Siapa yang akan menghadiri makanan dari anggota keluarga?',
        'am' => 'ከቤተሰብ አባላት መካከል ምግብ ለመብላት ማን ይመጣል?',
        'bn' => 'পরিবারের সদস্যদের মধ্যে কে খাবারে উপস্থিত থাকবে?',
        'ml' => 'കുടുംബാംഗങ്ങളിൽ നിന്ന് ആരാണ് ഭക്ഷണത്തിൽ പങ്കെടുക്കുക?',
        'fil' => 'Sino ang dadalo sa pagkain mula sa mga miyembro ng pamilya?',
        'ur' => 'خاندان کے افراد میں سے کون کھانے میں شرکت کرے گا؟',
        'ta' => 'குடும்ப உறுப்பினர்களில் யார் உணவில் கலந்துகொள்வார்?',
        'ne' => 'परिवारका सदस्यहरू मध्ये को खानामा उपस्थित हुनेछ?',
        'ps' => 'د کورنۍ له غړو څخه به څوک په خواړو کې ګډون کوي؟',
        'fr' => 'Qui assistera au repas parmi les membres de la famille ?',
        ],
        'select_attendees_multiple' => [
        'ar' => 'اختر الحضور من أفراد العائلة (يمكن اختيار أكثر من شخص)',
        'en' => 'Select attendees from family members (multiple allowed)',
        'hi' => 'परिवार के सदस्यों से उपस्थित लोगों का चयन करें (एक से अधिक की अनुमति है)',
        'id' => 'Pilih peserta dari anggota keluarga (boleh lebih dari satu)',
        'am' => 'ከቤተሰብ አባላት መካከል የሚገኙትን ይምረጡ (ከአንድ በላይ መምረጥ ይችላሉ)',
        'bn' => 'পরিবারের সদস্যদের থেকে উপস্থিতি নির্বাচন করুন (একাধিক অনুমোদিত)',
        'ml' => 'കുടുംബാംഗങ്ങളിൽ നിന്ന് പങ്കെടുക്കുന്നവരെ തിരഞ്ഞെടുക്കുക (ഒന്നിലധികം അനുവദനೀയം)',
        'fil' => 'Pumili ng mga dadalo mula sa mga miyembro ng pamilya (maramihang pinapayagan)',
        'ur' => 'خاندان کے افراد سے حاضرین کا انتخاب کریں (ایک سے زیادہ کی اجازت ہے)',
        'ta' => 'குடுமப உறுப்பினர்களிடமிருந்து வருகை தருபவர்களை தேர்ந்தெடுக்கவும் (பலரை அனுமதி)',
        'ne' => 'परिवारका सदस्यहरू बाट उपस्थितहरूलाई छनोट गर्नुहोस् (बहुविध अनुमति)',
        'ps' => 'د کورنۍ له غړو څخه ګډون کوونکي غوره کړئ (څو ځله اجازه ده)',
        'fr' => 'Sélectionnez les personnes présentes parmi les membres de la famille (plusieurs autorisés)',
        ],
        'are_there_guests' => [
        'ar' => 'هل يوجد ضيوف',
        'en' => 'Are there guests?',
        'hi' => 'क्या मेहमान हैं?',
        'id' => 'Apakah ada tamu?',
        'am' => 'እንግዳዎች አሉ?',
        'bn' => 'অতিথি আছে কি?',
        'ml' => 'അതിഥികളുണ്ടോ?',
        'fil' => 'May mga bisita ba?',
        'ur' => 'کیا مہمان ہیں؟',
        'ta' => 'விருந்தினர்கள் உள்ளனரா?',
        'ne' => 'पाहुनाहरू छन्?',
        'ps' => 'میلمانه شته؟',
        'fr' => 'Y a-t-il des invités ?',
        ],
        'yes' => [
        'ar' => 'نعم',
        'en' => 'Yes',
        'hi' => 'हाँ',
        'id' => 'Ya',
        'am' => 'አዎ',
        'bn' => 'হ্যাঁ',
        'ml' => 'അതെ',
        'fil' => 'Oo',
        'ur' => 'ہاں',
        'ta' => 'ஆம்',
        'ne' => 'हो',
        'ps' => 'هو',
        'fr' => 'Oui',
        ],
        'specify_guests_count' => [
        'ar' => 'حدد عدد الضيوف',
        'en' => 'Specify number of guests',
        'hi' => 'मेहमानों की संख्या निर्दिष्ट करें',
        'id' => 'Tentukan jumlah tamu',
        'am' => 'የእንግዳዎችን ቁጥር ይወስኑ',
        'bn' => 'অতিথির সংখ্যা নির্দিষ্ট করুন',
        'ml' => 'അതിഥികളുടെ എണ്ണം വ്യക്തമാക്കുക',
        'fil' => 'Tukuyin ang bilang ng mga bisita',
        'ur' => 'مہمانوں کی تعداد متعین کریں',
        'ta' => 'விருந்தினர்களின் எண்ணிக்கையை குறிப்பிடவும்',
        'ne' => 'पाहुनाहरूको संख्या तोक्नुहोस्',
        'ps' => 'د میلمنو شمېر مشخص کړئ',
        'fr' => 'Précisez le nombre d\'invités',
        ],
        'meal_type' => [
        'ar' => 'نوع الوجبة',
        'en' => 'Meal Type',
        'hi' => 'भोजन का प्रकार',
        'id' => 'Jenis Makanan',
        'am' => 'የምግብ አይነት',
        'bn' => 'খাবারের ধরন',
        'ml' => 'ഭക്ഷണ തരം',
        'fil' => 'Uri ng Pagkain',
        'ur' => 'کھانے کی قسم',
        'ta' => 'உணவு வகை',
        'ne' => 'खानाको प्रकार',
        'ps' => 'د خواړو ډول',
        'fr' => 'Type de repas',
        ],
        'select_meal_type' => [
        'ar' => 'اختر نوع الوجبة',
        'en' => 'Select meal type',
        'hi' => 'भोजन प्रकार चुनें',
        'id' => 'Pilih jenis makanan',
        'am' => 'የምግብ አይነት ይምረጡ',
        'bn' => 'খাবারের ধরন নির্বাচন করুন',
        'ml' => 'ഭക്ഷണ തരം തിരഞ്ഞെടുക്കുക',
        'fil' => 'Pumili ng uri ng pagkain',
        'ur' => 'کھانے کی قسم منتخب کریں',
        'ta' => 'உணவு வகையை தேர்ந்தெடுக்கவும்',
        'ne' => 'खानाको प्रकार छनोट गर्नुहोस्',
        'ps' => 'د خواړو ډول غوره کړئ',
        'fr' => 'Sélectionnez le type de repas',
        ],
        'breakfast' => [
        'ar' => 'إفطار',
        'en' => 'Breakfast',
        'hi' => 'नाश्ता',
        'id' => 'Sarapan',
        'am' => 'ቁርስ',
        'bn' => 'সকালের খাবার',
        'ml' => 'പ്രഭാതഭക്ഷണം',
        'fil' => 'Almusal',
        'ur' => 'ناشتہ',
        'ta' => 'காலை உணவு',
        'ne' => 'बिहानको खाना',
        'ps' => 'سهار',
        'fr' => 'Petit-déjeuner',
        ],
        'lunch' => [
        'ar' => 'غداء',
        'en' => 'Lunch',
        'hi' => 'दोपहर का भोजन',
        'id' => 'Makan Siang',
        'am' => 'ምሳ',
        'bn' => 'দুপুরের খাবার',
        'ml' => 'ഉച്ചഭക്ഷണം',
        'fil' => 'Tanghalian',
        'ur' => 'دوپہر کا کھانا',
        'ta' => 'மதிய உணவு',
        'ne' => 'दिउँसोको खाना',
        'ps' => 'غرمه',
        'fr' => 'Déjeuner',
        ],
        'dinner' => [
        'ar' => 'عشاء',
        'en' => 'Dinner',
        'hi' => 'रात का खाना',
        'id' => 'Makan Malam',
        'am' => 'እራት',
        'bn' => 'রাতের খাবার',
        'ml' => 'രാത്രിഭക്ഷണം',
        'fil' => 'Hapunan',
        'ur' => 'رات کا کھانا',
        'ta' => 'இரவு உணவு',
        'ne' => 'रातिको खाना',
        'ps' => 'ماخوستن',
        'fr' => 'Dîner',
        ],
        'time' => [
        'ar' => 'الوقت',
        'en' => 'Time',
        'hi' => 'समय',
        'id' => 'Waktu',
        'am' => 'ሰዓት',
        'bn' => 'সময়',
        'ml' => 'സമയം',
        'fil' => 'Oras',
        'ur' => 'وقت',
        'ta' => 'நேரம்',
        'ne' => 'समय',
        'ps' => 'وخت',
        'fr' => 'Heure',
        ],
        'date' => [
        'ar' => 'التاريخ',
        'en' => 'Date',
        'hi' => 'तारीख',
        'id' => 'Tanggal',
        'am' => 'ቀን',
        'bn' => 'তারিখ',
        'ml' => 'തീയതി',
        'fil' => 'Petsa',
        'ur' => 'تاریخ',
        'ta' => 'தேதி',
        'ne' => 'मिति',
        'ps' => 'نېټه',
        'fr' => 'Date',
        ],
        'next' => [
        'ar' => 'التالي',
        'en' => 'Next',
        'hi' => 'अगला',
        'id' => 'Berikutnya',
        'am' => 'ቀጣይ',
        'bn' => 'পরবর্তী',
        'ml' => 'അടുത്തത്',
        'fil' => 'Susunod',
        'ur' => 'اگلا',
        'ta' => 'அடுத்து',
        'ne' => 'अर्को',
        'ps' => 'بل',
        'fr' => 'Suivant',
        ],
        'search_meal' => [
        'ar' => 'ابحث عن الوجبة',
        'en' => 'Search for meal',
        'hi' => 'भोजन खोजें',
        'id' => 'Cari makanan',
        'am' => 'ምግብ ፈልግ',
        'bn' => 'খাবার খুঁজুন',
        'ml' => 'ഭക്ഷണം തിരയുക',
        'fil' => 'Maghanap ng pagkain',
        'ur' => 'کھانا تلاش کریں',
        'ta' => 'உணவைத் தேடவும்',
        'ne' => 'खाना खोज्नुहोस्',
        'ps' => 'خواړه لټون کړئ',
        'fr' => 'Rechercher un repas',
        ],
        'search_meal_placeholder' => [
        'ar' => 'ابحث عن الوجبة...',
        'en' => 'Search for meal...',
        'hi' => 'भोजन खोजें...',
        'id' => 'Cari makanan...',
        'am' => 'ምግብ ፈልግ...',
        'bn' => 'খাবার খুঁজুন...',
        'ml' => 'ഭക്ഷണം തിരയുക...',
        'fil' => 'Maghanap ng pagkain...',
        'ur' => 'کھانا تلاش کریں...',
        'ta' => 'உணவைத் தேடவும்...',
        'ne' => 'खाना खोज्नुहोस्...',
        'ps' => 'خواړه لټون کړئ...',
        'fr' => 'Rechercher un repas...',
        ],
        'select_meal' => [
        'ar' => 'اختر الوجبة',
        'en' => 'Select meal',
        'hi' => 'भोजन चुनें',
        'id' => 'Pilih makanan',
        'am' => 'ምግብ ይምረጡ',
        'bn' => 'খাবার নির্বাচন করুন',
        'ml' => 'ഭക്ഷണം തിരഞ്ഞെടുക്കുക',
        'fil' => 'Pumili ng pagkain',
        'ur' => 'کھانا منتخب کریں',
        'ta' => 'உணவைத் தேர்ந்தெடுக்கவும்',
        'ne' => 'खाना छनोट गर्नुहोस्',
        'ps' => 'خواړه غوره کړئ',
        'fr' => 'Sélectionnez le repas',
        ],
        'load_more' => [
        'ar' => 'عرض المزيد',
        'en' => 'Load More',
        'hi' => 'और लोड करें',
        'id' => 'Muat Lebih Banyak',
        'am' => 'ተጨማሪ አሳይ',
        'bn' => 'আরো লোড করুন',
        'ml' => 'കൂടുതൽ ലോഡുചെയ്യുക',
        'fil' => 'Mag-load ng Higit Pa',
        'ur' => 'مزید لوڈ کریں',
        'ta' => 'மேலும் ஏற்றவும்',
        'ne' => 'थप लोड गर्नुहोस्',
        'ps' => 'نور بار کړئ',
        'fr' => 'Charger plus',
        ],
        'no_results' => [
        'ar' => 'لا توجد نتائج',
        'en' => 'No results',
        'hi' => 'कोई परिणाम नहीं',
        'id' => 'Tidak ada hasil',
        'am' => 'ምንም ውጤት የለም',
        'bn' => 'কোনো ফলাফল নেই',
        'ml' => 'ഫലങ്ങൾ ഇല്ല',
        'fil' => 'Walang resulta',
        'ur' => 'کوئی نتائج نہیں',
        'ta' => 'முடிவுகள் இல்லை',
        'ne' => 'कुनै नतिजा छैन',
        'ps' => 'هیڅ پایلې نشته',
        'fr' => 'Aucun résultat',
        ],
        'previous' => [
        'ar' => 'السابق',
        'en' => 'Previous',
        'hi' => 'पिछला',
        'id' => 'Sebelumnya',
        'am' => 'ቀዳሚ',
        'bn' => 'পূর্ববর্তী',
        'ml' => 'മുൻപത്തെ',
        'fil' => 'Nakaraan',
        'ur' => 'پچھلا',
        'ta' => 'முந்தைய',
        'ne' => 'अघिल्लो',
        'ps' => 'مخکینی',
        'fr' => 'Précédent',
        ],
        'submit_request' => [
        'ar' => 'إرسال الطلب',
        'en' => 'Submit Request',
        ' tch' => 'अनुरोध सबमिट करें',
        'id' => 'Kirim Permintaan',
        'am' => 'ጥያቄ ላክ',
        'bn' => 'অনুরোধ জমা দিন',
        'ml' => 'അഭ്യർത്ഥന സമർപ്പിക്കുക',
        'fil' => 'Isumite ang Kahilingan',
        'ur' => 'درخواست جمع کرائیں',
        'ta' => 'கோரிக்கையை சமர்ப்பிக்கவும்',
        'ne' => 'अनुरोध पेश गर्नुहोस्',
        'ps' => 'غوښتنه وسپارئ',
        'fr' => 'Soumettre la demande',
        ],
        ];
        @endphp

        <!-- Header -->
        <header class="header header-fixed">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('families.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ $t['special_request'][$lang] ?? $t['special_request']['ar'] }}</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step-dot active" data-step="1"></div>
            <div class="step-dot" data-step="2"></div>
        </div>

        <!-- Form -->
        <form action="{{ route('families.special.store') }}" method="POST" id="specialRequestForm">
            @csrf

            <div class="page-content">
                <div class="container">

                    <!-- Step 1 -->
                    <div class="step-container active" id="step1">

                        <!-- اختيار من (الطباخين أو أفراد العائلة) -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">{{ $t['who_is_responsible_for_cooking'][$lang] ??
                                $t['who_is_responsible_for_cooking']['ar'] }}</h5>

                            <!-- Toggle Buttons -->
                            <div class="btn-group w-100 mb-3" role="group">
                                <input type="radio" class="btn-check" name="cooking_by" id="cooking_by_family"
                                    value="family" checked>
                                <label class="btn btn-outline-primary" style="gap:5px;" for="cooking_by_family">
                                    <i class="feather icon-users"></i> {{ $t['family_members'][$lang] ??
                                    $t['family_members']['ar'] }}
                                </label>

                                <input type="radio" class="btn-check" name="cooking_by" id="cooking_by_cook"
                                    value="cook">
                                <label class="btn btn-outline-primary" style="gap:5px;" for="cooking_by_cook">
                                    <i class="feather icon-user"></i> {{ $t['cooks'][$lang] ?? $t['cooks']['ar'] }}
                                </label>
                            </div>

                            <!-- قسم اختيار الطباخين (مخفي) -->
                            <div id="cooksSection" style="display: none;">
                                <div class="alert alert-info mb-3 text-right">
                                    <i class="feather icon-info"></i>
                                    {{ $t['select_cook_responsible'][$lang] ?? $t['select_cook_responsible']['ar'] }}
                                </div>
                                @foreach ($cooks as $cook)
                                <div class="member-card cook-card" style="direction: rtl;"
                                    data-cook-id="{{ $cook->id }}">
                                    <div class="d-flex align-items-center" style="gap: 15px;">
                                        <input type="radio" name="cook_id" value="{{ $cook->id }}"
                                            id="cook-{{ $cook->id }}">
                                        <label for="cook-{{ $cook->id }}" class="ms-3 mb-0 flex-grow-1"
                                            style="cursor: pointer;">
                                            <div class="fw-bold">{{ $cook->name }}</div>
                                            <small class="text-muted">{{ $t['professional_cook'][$lang] ??
                                                $t['professional_cook']['ar'] }}</small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- قسم اختيار أفراد العائلة (ظاهر) -->
                            <div id="familySection">
                                <div class="alert alert-info mb-3 text-right">
                                    <i class="feather icon-info"></i>
                                    {{ $t['select_family_cook_one_only'][$lang] ??
                                    $t['select_family_cook_one_only']['ar'] }}
                                </div>
                                @foreach ($family_members as $member)
                                <div class="member-card family-cook-card" style="direction: rtl;"
                                    data-member-id="{{ $member->id }}">
                                    <div class="d-flex align-items-center" style="gap: 15px;">
                                        <input type="radio" name="cook_id" value="{{ $member->id }}"
                                            id="family-cook-{{ $member->id }}">
                                        <label for="family-cook-{{ $member->id }}" class="ms-3 mb-0 flex-grow-1"
                                            style="cursor: pointer;">
                                            <div class="fw-bold">{{ $member->name }}</div>
                                            <small class="text-muted">{{ $member->relationship ??
                                                ($t['family_member'][$lang] ??
                                                $t['family_member']['ar']) }}
                                            </small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- من سيحضر الوجبة؟ -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">{{ $t['who_will_attend_meal'][$lang] ??
                                $t['who_will_attend_meal']['ar'] }}</h5>

                            <div>
                                <div class="alert alert-info mb-3 text-right">
                                    <i class="feather icon-info"></i>
                                    {{ $t['select_attendees_multiple'][$lang] ?? $t['select_attendees_multiple']['ar']
                                    }}
                                </div>

                                @foreach ($family_members as $member)
                                <div class="member-card attendee-card" style="direction: rtl;"
                                    data-attendee-id="{{ $member->id }}">
                                    <div class="d-flex align-items-center" style="gap: 15px;">
                                        <input type="checkbox" name="attendees[]" value="{{ $member->id }}"
                                            id="attendee-{{ $member->id }}">
                                        <label for="attendee-{{ $member->id }}" class="ms-3 mb-0 flex-grow-1"
                                            style="cursor: pointer;">
                                            <div class="fw-bold">{{ $member->name }}</div>
                                            <small class="text-muted">{{ $member->relationship ??
                                                ($t['family_member'][$lang] ??
                                                $t['family_member']['ar']) }}</small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach

                                <!-- عدد الضيوف مع checkbox -->
                                <div class="mb-4">
                                    <h5 class="section-title text-right">{{ $t['are_there_guests'][$lang] ??
                                        $t['are_there_guests']['ar'] }}</h5>
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <div class="d-flex align-items-center mb-3" style="justify-content: right;">
                                        <label for="has_guests" class="mb-0"
                                            style="margin-right:10px; cursor:pointer;font-weight:600;">
                                            {{ $t['yes'][$lang] ?? $t['yes']['ar'] }}
                                        </label>
                                        <input type="checkbox" id="has_guests" class="me-2"
                                            style="width:18px;height:18px;accent-color:var(--primary-color);">
                                    </div>
                                    <!-- العداد (مخفي في البداية) -->
                                    <div id="guestCounterSection" style="display:none;">
                                        <span style="display: block; width:100%; text-align: center;">{{
                                            $t['specify_guests_count'][$lang] ?? $t['specify_guests_count']['ar'] }}
                                        </span>
                                        <div class="guest-counter">
                                            <div class="counter-btn" id="decreaseGuests">-</div>
                                            <div class="counter-value" id="guestCount">0</div>
                                            <div class="counter-btn" id="increaseGuests">+</div>
                                        </div>
                                        <input type="hidden" name="guests_count" id="guests_count" value="0">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- نوع الوجبة -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">{{ $t['meal_type'][$lang] ?? $t['meal_type']['ar'] }}
                            </h5>
                            <select name="meal_type" id="meal_type" class="form-select"
                                style="text-align: center; width: 100%;" required>
                                <option value="">{{ $t['select_meal_type'][$lang] ?? $t['select_meal_type']['ar'] }}
                                </option>
                                <option value="breakfast">{{ $t['breakfast'][$lang] ?? $t['breakfast']['ar'] }}</option>
                                <option value="lunch">{{ $t['lunch'][$lang] ?? $t['lunch']['ar'] }}</option>
                                <option value="dinner">{{ $t['dinner'][$lang] ?? $t['dinner']['ar'] }}</option>
                            </select>
                        </div>

                        <!-- التاريخ والوقت -->
                        <div class="row mb-4">
                            <div class="col-6">
                                <h5 class="section-title text-right">{{ $t['time'][$lang] ?? $t['time']['ar'] }}</h5>
                                <input type="time" name="time" id="time" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <h5 class="section-title text-right">{{ $t['date'][$lang] ?? $t['date']['ar'] }}</h5>
                                <input type="date" name="date" id="date" class="form-control" required
                                    min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary w-100" id="nextStep">{{ $t['next'][$lang] ??
                            $t['next']['ar'] }}</button>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-container" id="step2">

                        <!-- البحث عن الوجبة -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">{{ $t['search_meal'][$lang] ?? $t['search_meal']['ar']
                                }}</h5>
                            <div class="search-box">
                                <input type="text" class="form-control" id="mealSearch"
                                    placeholder="{{ $t['search_meal_placeholder'][$lang] ?? $t['search_meal_placeholder']['ar'] }}">
                                <i class="feather icon-search"></i>
                            </div>
                        </div>

                        <!-- قائمة الوجبات -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">{{ $t['select_meal'][$lang] ?? $t['select_meal']['ar']
                                }}</h5>
                            <div id="mealsContainer">
                                @foreach ($meals as $meal)
                                <div class="meal-card" data-meal-name="{{ strtolower($meal->name) }}">
                                    <div class="d-flex align-items-center">
                                        <label for="meal-{{ $meal->id }}" style="margin-right: 15px; text-align: right;"
                                            class="mb-0 flex-grow-1 d-flex align-items-center" style="cursor: pointer;">
                                            @if ($meal->image)
                                            <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}"
                                                class="meal-image me-3">
                                            @endif
                                            <div class="flex-grow-1">
                                                <div class="fw-bold">
                                                    {{ \App\Helpers\TranslationHelper::translate($meal->title ?? '',
                                                    $lang) }}
                                                </div>
                                                {{-- {{ $meal->id }} --}}
                                                <small class="text-muted">{{ $meal->description ?? '' }}</small>
                                                @if ($meal->price)
                                                <div class="text-primary fw-bold mt-1">{{ $meal->price }}
                                                    {{-- جنيه --}}
                                                </div>
                                                @endif
                                            </div>
                                        </label>
                                        <input type="radio" name="recipe_id" value="{{ $meal->id }}"
                                            id="meal-{{ $meal->id }}" required>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- زر عرض المزيد -->
                            <div class="text-center mt-3" id="loadMoreContainer">
                                <button type="button" class="btn btn-outline-primary" id="loadMoreBtn">
                                    {{ $t['load_more'][$lang] ?? $t['load_more']['ar'] }}
                                </button>
                            </div>

                            <div class="no-results" id="noResults" style="display: none;">
                                <i class="feather icon-search" style="font-size: 48px; color: #ddd;"></i>
                                <p>{{ $t['no_results'][$lang] ?? $t['no_results']['ar'] }}</p>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary flex-grow-1" id="prevStep">{{
                                $t['previous'][$lang] ?? $t['previous']['ar'] }}</button>
                            <button type="submit" class="btn btn-primary flex-grow-1">{{ $t['submit_request'][$lang] ??
                                $t['submit_request']['ar'] }}</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                let currentStep = 1;
                let guestCount = 0;
                let mealSkip = {{ $meals->count() }};
                let loadingMeals = false;

                const step1 = document.getElementById('step1');
                const step2 = document.getElementById('step2');
                const stepDots = document.querySelectorAll('.step-dot');
                const nextStepBtn = document.getElementById('nextStep');
                const prevStepBtn = document.getElementById('prevStep');
                const form = document.getElementById('specialRequestForm');

                const guestCountDisplay = document.getElementById('guestCount');
                const guestCountInput = document.getElementById('guests_count');
                const increaseBtn = document.getElementById('increaseGuests');
                const decreaseBtn = document.getElementById('decreaseGuests');
                const hasGuestsCheckbox = document.getElementById('has_guests');
                const guestCounterSection = document.getElementById('guestCounterSection');

                // ================= Guest Counter Functions =================
                const updateGuestCount = () => {
                    if (guestCountDisplay) guestCountDisplay.textContent = guestCount;
                    if (guestCountInput) guestCountInput.value = guestCount;
                };

                increaseBtn?.addEventListener('click', () => {
                    guestCount++;
                    updateGuestCount();
                });

                decreaseBtn?.addEventListener('click', () => {
                    if (guestCount > 0) {
                        guestCount--;
                        updateGuestCount();
                    }
                });

                hasGuestsCheckbox?.addEventListener('change', function() {
                    if (this.checked) {
                        guestCounterSection.style.display = 'block';
                        if (guestCount === 0) {
                            guestCount = 1;
                            updateGuestCount();
                        }
                    } else {
                        guestCounterSection.style.display = 'none';
                        guestCount = 0;
                        updateGuestCount();
                    }
                });

                // ================= Cooking By Toggle =================
                document.getElementById('cooking_by_family')?.addEventListener('change', function() {
                    if (this.checked) {
                        document.getElementById('familySection').style.display = 'block';
                        document.getElementById('cooksSection').style.display = 'none';
                        document.querySelectorAll('input[name="cook_id"]').forEach(i => {
                            i.checked = false;
                            i.closest('.member-card')?.classList.remove('selected');
                        });
                    }
                });

                document.getElementById('cooking_by_cook')?.addEventListener('change', function() {
                    if (this.checked) {
                        document.getElementById('familySection').style.display = 'none';
                        document.getElementById('cooksSection').style.display = 'block';
                        document.querySelectorAll('input[name="family_cook_id"]').forEach(i => {
                            i.checked = false;
                            i.closest('.member-card')?.classList.remove('selected');
                        });
                    }
                });

                // ================= Card Selection (Cook, Family, Attendees, Meals) =================
                document.querySelectorAll('.cook-card, .family-cook-card, .attendee-card, .meal-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        if (e.target.type === 'radio' || e.target.type === 'checkbox') return;

                        const input = this.querySelector('input[type="radio"], input[type="checkbox"]');
                        if (!input) return;

                        if (input.type === 'checkbox') {
                            input.checked = !input.checked;
                            this.classList.toggle('selected', input.checked);
                        } else {
                            input.checked = true;
                            const group = this.classList.contains('meal-card') ? '.meal-card' :
                                this.classList.contains('cook-card') ? '.cook-card' :
                                this.classList.contains('family-cook-card') ? '.family-cook-card' :
                                null;

                            if (group) {
                                document.querySelectorAll(group).forEach(c => c.classList.remove(
                                    'selected'));
                                this.classList.add('selected');
                            }
                        }
                    });
                });

                // ================= Meal Search =================
                document.getElementById('mealSearch')?.addEventListener('input', function() {
                    const term = this.value.toLowerCase().trim();
                    const cards = document.querySelectorAll('.meal-card');
                    let visible = false;

                    cards.forEach(c => {
                        if ((c.dataset.mealName || '').includes(term)) {
                            c.style.display = 'block';
                            visible = true;
                        } else {
                            c.style.display = 'none';
                        }
                    });

                    const noResults = document.getElementById('noResults');
                    if (noResults) noResults.style.display = visible ? 'none' : 'block';
                });

                // ================= Load More Meals =================
                document.getElementById('loadMoreBtn')?.addEventListener('click', function() {
                    if (loadingMeals) return;
                    loadingMeals = true;
                    this.disabled = true;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> جاري التحميل...';

                    fetch("{{ route('families.meals.load-more') }}?skip=" + mealSkip, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('HTTP ' + res.status);
                            return res.json();
                        })
                        .then(data => {
                            const container = document.getElementById('mealsContainer');
                            data.meals.forEach(meal => {
                                const card = document.createElement('div');
                                card.className = 'meal-card';
                                card.dataset.mealName = (meal.name || '').toLowerCase();

                                card.innerHTML = `
            <div class="d-flex align-items-center">
                <label for="meal-${meal.id}" style="margin-right: 15px; text-align: right;"
                    class="mb-0 flex-grow-1 d-flex align-items-center" style="cursor: pointer;">
                    ${meal.image ? `<img src="${window.location.origin}/storage/${meal.image}" alt="${meal.name}"
                            class="meal-image me-3">` : ''}
                    <div class="flex-grow-1">
                        <div class="fw-bold">${meal.title}</div>
                        <small class="text-muted">${meal.description || ''}</small>
                        ${meal.price ? `<div class="text-primary fw-bold mt-1">${meal.price} جنيه</div>` : ''}
                    </div>
                </label>
                <input type="radio" name="recipe_id" value="${meal.id}" id="meal-${meal.id}" required>
            </div>
            `;
                                container.appendChild(card);

                                card.addEventListener('click', function(e) {
                                    if (e.target.type !== 'radio') {
                                        const radio = this.querySelector(
                                            'input[type="radio"]');
                                        radio.checked = true;
                                    }
                                    document.querySelectorAll('.meal-card').forEach(c => c
                                        .classList.remove('selected'));
                                    this.classList.add('selected');
                                });
                            });

                            mealSkip += data.meals.length;

                            if (!data.hasMore) {
                                document.getElementById('loadMoreContainer')?.remove();
                            }

                            this.disabled = false;
                            this.innerHTML = 'عرض المزيد';
                            loadingMeals = false;
                        })
                        .catch(err => {
                            console.error('Load more error:', err);
                            alert('فشل تحميل الوجبات. حاول مرة أخرى.');
                            this.disabled = false;
                            this.innerHTML = 'عرض المزيد';
                            loadingMeals = false;
                        });
                });

                // ================= Step Navigation =================
                const goToStep = step => {
                    currentStep = step;
                    step1.classList.toggle('active', step === 1);
                    step2.classList.toggle('active', step === 2);
                    stepDots.forEach((d, i) => d.classList.toggle('active', i + 1 <= step));
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                };
                nextStepBtn?.addEventListener('click', () => {
                    if (validateStep1()) goToStep(2);
                });

                prevStepBtn?.addEventListener('click', () => goToStep(1));

                // ================= Validation =================
                function validateStep1() {
                    const cookingBy = document.querySelector('input[name="cooking_by"]:checked')?.value;

                    if (!cookingBy) {
                        alert('اختر من المسؤول عن الطبخ');
                        return false;
                    }

                    if (cookingBy === 'cook') {
                        if (!document.querySelector('input[name="cook_id"]:checked')) {
                            alert('من فضلك اختر الطباخ');
                            return false;
                        }
                    } 

                    if (hasGuestsCheckbox && hasGuestsCheckbox.checked && guestCount === 0) {
                        alert('من فضلك حدد عدد الضيوف');
                        return false;
                    }

                    const mealType = document.getElementById('meal_type')?.value;
                    const date = document.getElementById('date')?.value;
                    const time = document.getElementById('time')?.value;
                    if (!mealType) {
                        alert('من فضلك اختر نوع الوجبة');
                        return false;
                    }
                    if (!date) {
                        alert('من فضلك اختر التاريخ');
                        return false;
                    }
                    if (!time) {
                        alert('من فضلك اختر الوقت');
                        return false;
                    }
                    return true;
                }

                // ================= Form Submit =================
                form?.addEventListener('submit', e => {
                    if (!document.querySelector('input[name="recipe_id"]:checked')) {
                        e.preventDefault();
                        alert('من فضلك اختر الوجبة');
                    }
                });

                // ================= Hide Preloader =================
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    setTimeout(() => preloader.style.display = 'none', 500);
                }
            });
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>