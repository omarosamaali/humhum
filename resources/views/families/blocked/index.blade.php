<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui, viewport-fit=cover">
    <title>الوجبات المحظورة</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/user-logo/favicon.png') }}">
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">

    @vite(['resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #29A500;
        }

        .toast-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            padding: 12px 24px;
            border-radius: 8px;
            color: #fff;
            font-weight: 500;
            animation: slideIn 0.5s ease-out;
        }

        .toast-message.success {
            background: #28a745;
        }

        .toast-message.error {
            background: #dc3545;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-50%) translateY(-100px);
                opacity: 0;
            }

            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            to {
                transform: translateX(-50%) translateY(-100px);
                opacity: 0;
            }
        }
    </style>
</head>

{{-- ============ تعريف $lang و $t و tdb() في الأول ============ --}}
@php
// 1. تحديد اللغة
$lang = $lang = session('cook_language') 
            ?? session('family_language') 
            ?? 'ar';

// 2. عنوان الصفحة مترجم
$t_title = [
'ar' => 'المحظورات',
'en' => 'Blacklist',
'id' => 'Daftar Hitam',
'am' => 'ጥቁር ዝርዝር',
'hi' => 'ब्लैकलिस्ट',
'bn' => 'কালো তালিকা',
'ml' => 'ബ്ലാക്ക്ലിസ്റ്റ്',
'fil' => 'Blacklist',
'ur' => 'بلیک لسٹ',
'ta' => 'கருப்பு பட்டியல்',
'ne' => 'कालोसूची',
'ps' => 'تور لیست',
'fr' => 'Liste noire',
][$lang] ?? 'المحظورات';

// 3. مصفوفة الترجمات العامة
$translations = [
'ar' => ['next_meal_is' => 'الوجبة القادمة هي', 'none' => 'لا يوجد', 'no_plans' => 'لا توجد خطط حاليًا'],
'en' => ['next_meal_is' => 'Next meal is', 'none' => 'None', 'no_plans' => 'No plans yet'],
'id' => ['next_meal_is' => 'Makanan berikutnya adalah', 'none' => 'Tidak ada', 'no_plans' => 'Belum ada rencana'],
'am' => ['next_meal_is' => 'የሚቀጥለው ምግብ', 'none' => 'ምንም', 'no_plans' => 'እስካሁን ምንም እቅድ'],
'hi' => ['next_meal_is' => 'अगला भोजन है', 'none' => 'कोई नहीं', 'no_plans' => 'अभी कोई योजना नहीं'],
'bn' => ['next_meal_is' => 'পরবর্তী খাবার হলো', 'none' => 'কোনোটিই নয়', 'no_plans' => 'এখনো কোনো পরিকল্পনা নেই'],
'ml' => ['next_meal_is' => 'അടുത്ത ഭക്ഷണം', 'none' => 'ഒന്നുമില്ല', 'no_plans' => 'ഇതുവരെ പ്ലാനുകളില്ല'],
'fil' => ['next_meal_is' => 'Ang susunod na pagkain ay', 'none' => 'Wala', 'no_plans' => 'Wala pang plano'],
'ur' => ['next_meal_is' => 'اگلا کھانا ہے', 'none' => 'کوئی نہیں', 'no_plans' => 'ابھی تک کوئی منصوبہ نہیں'],
'ta' => ['next_meal_is' => 'அடுத்த உணவு', 'none' => 'ஏதுமில்லை', 'no_plans' => 'இதுவரை திட்டமில്ലை'],
'ne' => ['next_meal_is' => 'अर्को खाना', 'none' => 'कुनै पनि छैन', 'no_plans' => 'अहिलेसम्म कোনै योजना छैन'],
'ps' => ['next_meal_is' => 'بل خواړه', 'none' => 'هیڅ', 'no_plans' => 'تر اوسه کوم پلان نشته'],
'fr' => ['next_meal_is' => 'Le prochain repas est', 'none' => 'Aucun', 'no_plans' => 'Aucun plan pour l\'instant'],
];
$t = $translations[$lang] ?? $translations['ar'];

// 4. دالة tdb آمنة
function tdb($model, $lang, $field = 'name')
{
if (!$model || !is_object($model)) return '—';
$key = "{$field}_{$lang}";
$value = $model->$key ?? $model->{"{$field}_ar"} ?? $model->$field ?? null;
return is_string($value) ? trim($value) : '—';
}
@endphp
{{-- ========================================================= --}}

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

        <!-- Header -->
        <header class="header header-fixed border-bottom onepage">
            <div class="header-content">
                <div class="left-content"></div>
                <div class="mid-content">
                    <h4 class="title">{{ $t_title }}</h4>
                </div>
                <div class="right-content">
                    <a href="{{ route('families.welcome') }}" style="background: unset; font-size: 24px;">
                        <i class="feather icon-home" style="color: #29A500;"></i>
                    </a>
                </div>
        </header>

        <!-- Toasts -->
        @if(session('success'))
        <div id="toast-message" class="toast-message success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div id="toast-message" class="toast-message error">
            <i class="fas fa-times-circle"></i> {{ session('error') }}
        </div>
        @endif

        <!-- Page Content -->
        <main class="page-content space-top">
            <div style="text-align: center; margin-bottom: 15px; font-size: 18px;">
                <span style="font-size: 32px;">❌</span><br>
                <small style="color: #666;">{{ $t_title }}</small>
            </div>

            <ul class="featured-list">
                @forelse($myBlocked as $myFamily)
                @php
                $recipe = $myFamily->recipe;
                $kitchen = $recipe?->kitchen;
                $title = is_string($recipe?->title) ? $recipe->title : '';
                $dishImage = $recipe?->dish_image ? asset('storage/' . $recipe->dish_image) :
                asset('assets/images/background.png');
                @endphp

                <li class="container-cart">
                    <div class="dz-card list"
                        style="margin-bottom: 13px; border: 1px solid #ccc; border-radius: 12px; overflow: hidden;">
                        <div class="dz-media" style="margin-left: 15px; position: relative;">
                            <img src="{{ $dishImage }}" alt="{{ $title }}"
                                style="width: 100%; height: 140px; object-fit: cover; border-radius: 0px 11px 11px 0px !important;">
                        </div>

                        <div class="dz-content">
                            <div class="dz-head">
                                <h6 class="title" style="margin: 0 0 8px; font-size: 16px; font-weight: 600;">
                                    {{ \App\Helpers\TranslationHelper::translate($title, $lang) }}
                                </h6>

                                @if($recipe?->subCategories?->isNotEmpty())
                                @foreach($recipe->subCategories as $subCategory)
                                @php $subName = tdb($subCategory?->recipe, $lang, 'name'); @endphp
                                @if($subName !== '—')
                                <span class="badge badge-info"
                                    style="margin: 2px 4px 6px 0; font-size: 11px; padding: 4px 8px;">
                                    {{ $subName }}
                                </span>
                                @endif
                                @endforeach
                                @else
                                <span class="text-muted" style="font-size: 12px;">{{ $t['none'] }}</span>
                                @endif

                                @if($kitchen)
                                <div style="display: flex; gap: 8px; font-size: 13px; align-items: center; margin-top: 10px;"
                                    class="tags">
                                    <img src="{{ asset('storage/' . $kitchen->image) }}"
                                        style="border-radius: 50%; width: 36px; height: 36px; object-fit: cover; border: 1px solid #bababa;"
                                        alt="">
                                    <span style="color: #555;">{{ tdb($kitchen, $lang, 'name') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                @empty
                <li style="text-align: center; padding: 40px; color: #888;">
                    <p style="font-size: 16px;">{{ $t['no_plans'] }}</p>
                </li>
                @endforelse
            </ul>
        </main>
    </div>

    {!! $swalScript ?? '' !!}

    <!-- Toast Auto Hide -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast-message');
        if (toast) {
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.5s ease-out forwards';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    });
    </script>

    <!-- Scripts -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>