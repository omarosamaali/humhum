@extends('layouts.admin')

@section('content')
    <style>
        .details-card {
            background: white;
            color: black;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .details-card h4 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
        }

        .details-item {
            margin-bottom: 15px;
            font-size: 1.1rem;
            display: flex;
            /* justify-content: space-between; */
            flex-direction: row;
        }

        .details-item strong {
            margin-bottom: 5px;
            color: rgba(0, 0, 0, 0.8);
            font-weight: bold;
        }

        .details-image {
            width: 100%;
            height: 560px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .status-badge {
            padding: 0.6em 1em;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .status-active {
            background-color: #28a745;
            color: white;
        }

        .status-inactive {
            background-color: #dc3545;
            color: white;
        }

        .status-free {
            background-color: #17a2b8;
            color: white;
        }

        .status-paid {
            background-color: #ffc107;
            color: #333;
        }

        .btn-back {
            background-color: white;
            color: #764ba2;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #eee;
            color: #667eea;
        }

        .section-title {
            font-size: 1.3rem;
            margin-top: 25px;
            margin-bottom: 10px;
            color: rgba(0, 0, 0, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 5px;
        }

        .content-list {
            list-style: none;
            padding-left: 0;
        }

        .content-list li {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
        }

        .content-list li i {
            margin-right: 10px;
            color: #a7d9ff;
            font-size: 1.2rem;
            margin-top: 3px;
        }

        .tags-container .badge {
            background-color: rgba(255, 255, 255, 0.2);
            color: black;
            margin-right: 5px;
            margin-bottom: 5px;
            padding: 0.6em 1em;
            border-radius: 5px;
            font-weight: normal;
        }

        .media-preview {
            max-width: 150px;
            max-height: 100px;
            object-fit: contain;
            border-radius: 5px;
            margin-left: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .media-preview.video {
            max-height: 120px;
        }
    </style>
    <div style="display: flex; gap: 20px;">

        <div class="recipe-image mb-4" style="width: 50%; min-width: 499px;">
            @if ($recipe->dish_image)
                <!-- Assuming 'image' is the field for the dish photo -->
                <img src="{{ Storage::url($recipe->dish_image) }}" alt="Recipe Image" class="details-image img-fluid rounded">
            @else
                <img src="{{ asset('assets/default-recipe.png') }}" alt="Default Recipe Image"
                    class="details-image img-fluid rounded">
            @endif
            <div class="col-md-12">
                <h5 class="section-title"
                    style="    color: #660099;
    font-size: 29px;
    border: 1px solid #660099;
    font-weight: bold;
    /* width: fit-content; */
    padding: 12px;
    border-radius: 12px;
    text-align: center;">
                    المكونات</h5>
@foreach (explode("\n", $recipe->ingredients) as $ingredient)
    @php
        $trimmed = trim($ingredient);
    @endphp

    @if ($trimmed !== '')
        @if (Str::startsWith($trimmed, '##'))
            <div style="margin-bottom: 5px; justify-content: space-between; font-weight: bold; border-bottom: 1px solid #ccc; padding-bottom: 2px; display: flex; align-items: center; gap: 5px;">
                {{ Str::replaceFirst('##', '', $trimmed) }}
                <h1
                                    style="    color: #ffffff;
                    font-size: 29px;
                    background:  #660099;
                    font-weight: bold;
                    padding: 5px;
                    border-radius: 12px;
                    text-align: center;">
                                    <i style="font-size: 20px; color: #ffffff;" class="fa-solid fa-headphones"></i>
                                </h1>
            </div>
        @else
            <div style="margin-bottom: 5px; justify-content: space-between; display: flex; align-items: center; gap: 5px;">
                {{ $trimmed }}
                <h1
                 style="    color: #ffffff;
 font-size: 29px;
 background:  #660099;
 font-weight: bold;
 padding: 5px;
 border-radius: 12px;
 text-align: center;">
                 <i style="font-size: 20px; color: #ffffff;" class="fa-solid fa-headphones"></i>
             </h1>
            </div>
        @endif
    @endif
@endforeach
            </div>

        </div>

        <div>

            <div class="recipe-number mb-3">
                <span class="badge bg-primary fs-6">#{{ $recipe->recipe_code }}</span>
            </div>
            <div style="display: flex; gap; 20px; ">

                <h1
                    style="    color: #660099;
    font-size: 29px;
    border: 1px solid #660099;
    font-weight: bold;
    padding: 12px;
    border-radius: 12px;
    text-align: center; margin-left: 20px;">
                    {{ $recipe->title }}
                </h1>
                <h1
                    style="    color: #ffffff;
    font-size: 29px;
    background:  #660099;
    font-weight: bold;
    padding: 12px;
    border-radius: 12px;
    text-align: center;">
                    <i style="color: #ffffff;" class="fa-solid fa-headphones"></i>
                </h1>

            </div>
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    {{-- عرض اللغة الحالية --}}
                    <img src="{{ $currentLanguage->flag_image ? Storage::url($currentLanguage->flag_image) : asset('assets/default-flag.png') }}"
                        alt="{{ $currentLanguage->name }}" class="flag-img rounded"
                        style="width: 40px; height: 40px; margin-left: 8px; object-fit: cover;">
                    {{ $currentLanguage->name }}
                </div>
                <div>
                    @if ($recipe->chef)
                        @php
                            $chefDisplayName = 'Not Translated';
                            if ($recipe->chef) {
                                $chefFieldName = 'name_' . $currentLanguageCode;
                                $chefDisplayName =
                                    $recipe->chef->{$chefFieldName} ??
                                    ($recipe->chef->name_ar ?? ($recipe->chef->name ?? 'Not Translated'));
                            }
                        @endphp
                        <div class="detail-item" style="margin-top: 20px;">
                            @if ($recipe->chef->chefProfile && $recipe->chef->chefProfile->official_image)
                                <img src="{{ Storage::url($recipe->chef->chefProfile->official_image) }}"
                                    alt="{{ $chefDisplayName }}" class="chef-img rounded-circle me-2"
                                    style="width: 40px; height: 40px;">
                            @else
                                <img src="{{ asset('assets/default-chef.png') }}" alt="Default Chef"
                                    class="chef-img rounded-circle me-2" style="width: 40px; height: 40px;">
                            @endif
                            الطاهي :
                            {{ $chefDisplayName }}
                        </div>
                    @endif
                </div>
                <div>
                    @if ($recipe->kitchen)
                        @php
                            $kitchenName =
                                $recipe->kitchen->{'name_' . $currentLanguageCode} ??
                                ($recipe->kitchen->name_ar ?? 'Not Translated');
                        @endphp
                        <div class="detail-item">
                            @if ($recipe->kitchen->image)
                                <img src="{{ Storage::url($recipe->kitchen->image) }}" alt="{{ $kitchenName }}"
                                    class="kitchen-img rounded-circle me-2" style="width: 40px; height: 40px;">
                            @else
                                <img src="{{ asset('assets/default-kitchen.png') }}" alt="صورة مطبخ افتراضي"
                                    class="kitchen-img rounded-circle me-2" style="width: 40px; height: 40px;">
                            @endif
                            {{ $kitchenName }}

                        </div>
                    @endif
                </div>

            </div>

            <div style="display: flex; align-items: center; gap: 20px;">

                @if ($recipe->mainCategories)
                    @php
                        $mainCategoryName =
                            $recipe->mainCategories->{'name_' . $currentLanguageCode} ??
                            ($recipe->mainCategories->name_ar ?? 'Not Translated');
                    @endphp
                    <div class="detail-item" style="">
                        @if ($recipe->mainCategories->image)
                            <img src="{{ Storage::url($recipe->mainCategories->image) }}" alt="here"
                                class="main-category-img rounded-circle me-2" style="width: 40px; height: 40px;">
                        @else
                            <img src="{{ asset('assets/default-category.png') }}" alt="صورة تصنيف افتراضي"
                                class="main-category-img rounded-circle me-2" style="width: 40px; height: 40px;">
                        @endif
                        {{ $mainCategoryName }}
                    </div>
                @endif

                @if ($recipe->subCategories->count())
                    <div class="detail-item">
                        @foreach ($recipe->subCategories as $subCategory)
                            @php
                                $subCategoryName =
                                    $subCategory->{'name_' . $currentLanguageCode} ??
                                    ($subCategory->name_ar ?? 'Not Translated');
                            @endphp
                            <span class="badge bg-info me-1">{{ $subCategoryName }}</span>
                        @endforeach
                    </div>
                @endif
                @if ($recipe->preparation_time)
                    <div class="detail-item"><i class="fas fa-clock" style="color: #007bff;"></i>
                        @switch($currentLanguageCode)
                            @case('ar')
                                وقت التحضير
                            @break

                            @case('en')
                                Preparation Time
                            @break

                            @case('id')
                                Waktu Persiapan
                            @break

                            @case('am')
                                የማዘመን ጊዜ
                            @break

                            @case('hi')
                                तैयारी का समय
                            @break

                            @case('bn')
                                প্রস্তুতি সময়
                            @break

                            @case('ml')
                                തയ്യാറാക്കുന്ന സമയം
                            @break

                            @case('fil')
                                Oras ng Paghanda
                            @break

                            @case('ur')
                                تیاری کا وقت
                            @break

                            @case('ta')
                                தயாரிப்பு நேரம்
                            @break

                            @case('ne')
                                तयारी समय
                            @break

                            @default
                                Preparation Time
                        @endswitch:
                        {{ $recipe->preparation_time }}
                        @switch($currentLanguageCode)
                            @case('ar')
                                دقيقة
                            @break

                            @case('en')
                                minutes
                            @break

                            @case('id')
                                menit
                            @break

                            @case('am')
                                ሒውሎች
                            @break

                            @case('hi')
                                मिनट
                            @break

                            @case('bn')
                                মিনিট
                            @break

                            @case('ml')
                                മിനിറ്റുകൾ
                            @break

                            @case('fil')
                                minuto
                            @break

                            @case('ur')
                                منٹ
                            @break

                            @case('ta')
                                நிமிடங்கள்
                            @break

                            @case('ne')
                                मिनेट
                            @break

                            @default
                                minutes
                        @endswitch
                    </div>
                @endif


            </div>

            <div class="recipe-details mb-4">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div style="display: flex; gap: 10px;">
                            @if ($recipe->protein)
                            <div class="detail-item" style="color: #0c1e24;">
                                <span
                                    style="background-color: #e4ebf1;
                                        border-radius: 5px;
                                        width: 39px;
                                        height: 40px;
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        margin-left: 5px;">
                                    <i class="fas fa-egg" style="color: #0c1e24;"></i>
                                </span>
                                <span>
                                    {{ $recipe->protein }}
                                </span>
                                @switch($currentLanguageCode)
                                    @case('ar')
                                        بروتين
                                    @break

                                    @case('en')
                                        calories
                                    @break

                                    @case('id')
                                        kalori
                                    @break

                                    @case('am')
                                        ካሎሪ
                                    @break

                                    @case('hi')
                                        कैलोरी
                                    @break

                                    @case('bn')
                                        ক্যালোরি
                                    @break

                                    @case('ml')
                                        കലോറി
                                    @break

                                    @case('fil')
                                        kalorya
                                    @break

                                    @case('ur')
                                        کیلوری
                                    @break

                                    @case('ta')
                                        கலோரி
                                    @break

                                    @case('ne')
                                        क्यालोरी
                                    @break

                                    @default
                                        calories
                                @endswitch
                            </div>
                            @endif
                            @if ($recipe->calories)
                                <div class="detail-item" style="color: #0c1e24;">
                                    <span
                                        style="background-color: #e4ebf1;
                                        border-radius: 5px;
                                        width: 39px;
                                        height: 40px;
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        margin-left: 5px;">
                                        <i class="fas fa-fire" style="color: #0c1e24;"></i>
                                    </span>
                                    <span>
                                        {{ $recipe->calories }}
                                    </span>
                                    @switch($currentLanguageCode)
                                        @case('ar')
                                            سعرة
                                        @break

                                        @case('en')
                                            calories
                                        @break

                                        @case('id')
                                            kalori
                                        @break

                                        @case('am')
                                            ካሎሪ
                                        @break

                                        @case('hi')
                                            कैलोरी
                                        @break

                                        @case('bn')
                                            ক্যালোরি
                                        @break

                                        @case('ml')
                                            കലോറി
                                        @break

                                        @case('fil')
                                            kalorya
                                        @break

                                        @case('ur')
                                            کیلوری
                                        @break

                                        @case('ta')
                                            கலோரி
                                        @break

                                        @case('ne')
                                            क्यालोरी
                                        @break

                                        @default
                                            calories
                                    @endswitch
                                </div>
                            @endif
                            @if ($recipe->fats)
                            <div class="detail-item" style="color: #0c1e24;">
                                <span
                                    style="background-color: #e4ebf1;
                                        border-radius: 5px;
                                        width: 39px;
                                        height: 40px;
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        margin-left: 5px;">
                                    <i class="fas fa-tint" style="color: #0c1e24;"></i>
                                </span>
                                {{ $recipe->fats }}
                                @switch($currentLanguageCode)
                                    @case('ar')
                                        غرام
                                    @break

                                    @case('en')
                                        grams
                                    @break

                                    @case('id')
                                        gram
                                    @break

                                    @case('am')
                                        ግራም
                                    @break

                                    @case('hi')
                                        ग्राम
                                    @break

                                    @case('bn')
                                        গ্রাম
                                    @break

                                    @case('ml')
                                        ഗ്രാം
                                    @break

                                    @case('fil')
                                        gramo
                                    @break

                                    @case('ur')
                                        گرام
                                    @break

                                    @case('ta')
                                        கிராம்
                                    @break

                                    @case('ne')
                                        ग्राम
                                    @break

                                    @default
                                        grams
                                @endswitch
                            </div>
                            @endif
                            @if ($recipe->carbs)
                            <div class="detail-item" style="color: #0c1e24;">
                                <span
                                    style="background-color: #e4ebf1;
                                        border-radius: 5px;
                                        width: 39px;
                                        height: 40px;
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        margin-left: 5px;">
                                    <i class="fa-brands fa-pagelines" style="color: #0c1e24;"></i>
                                </span>
                                {{ $recipe->carbs }}
                                @switch($currentLanguageCode)
                                    @case('ar')
                                        الكربوهيدرات
                                    @break

                                    @case('en')
                                        grams
                                    @break

                                    @case('id')
                                        gram
                                    @break

                                    @case('am')
                                        ግራም
                                    @break

                                    @case('hi')
                                        ग्राम
                                    @break

                                    @case('bn')
                                        গ্রাম
                                    @break

                                    @case('ml')
                                        ഗ്രാം
                                    @break

                                    @case('fil')
                                        gramo
                                    @break

                                    @case('ur')
                                        گرام
                                    @break

                                    @case('ta')
                                        கிராம்
                                    @break

                                    @case('ne')
                                        ग्राम
                                    @break

                                    @default
                                        grams
                                @endswitch
                            </div>

                            @endif
                            @if($recipe->servings)
                            <div class="detail-item" style="color: #0c1e24; display: flex; align-items: center;">
                                <span
                                    style="background-color: #e4ebf1;
                                    border-radius: 5px;
                                    width: 39px;
                                    height: 40px;
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    margin-left: 5px;">
                                    <i class="fas fa-user" style="color: #0c1e24;"></i>
                                </span>
                                {{ $recipe->servings }}
                                @switch($currentLanguageCode)
                                    @case('ar')
                                        شخص
                                    @break

                                    @case('en')
                                        people
                                    @break

                                    @case('id')
                                        orang
                                    @break

                                    @case('am')
                                        ሰዎች
                                    @break

                                    @case('hi')
                                        लोग
                                    @break

                                    @case('bn')
                                        মানুষ
                                    @break

                                    @case('ml')
                                        ആളുകൾ
                                    @break

                                    @case('fil')
                                        katao
                                    @break

                                    @case('ur')
                                        افراد
                                    @break

                                    @case('ta')
                                        நபர்கள்
                                    @break

                                    @case('ne')
                                        मानिसहरु
                                    @break

                                    @default
                                        servings
                                @endswitch
                            </div>
                            @endif
                        </div>


                    </div>
                    <div class="detail-item" style="display: flex; justify-content: space-between;">
                        @if ($recipe->user)
                            <div class="detail-item" style="font-weight: bold;"><i class="fas fa-user"
                                    style="color: #28a745;"></i>
                                @switch($currentLanguageCode)
                                    @case('ar')
                                        الناشر
                                    @break

                                    @case('en')
                                        The recipe was entered by
                                    @break

                                    @case('id')
                                        Resep dimasukkan oleh
                                    @break

                                    @case('am')
                                        የምግብ አሰራር በ
                                    @break

                                    @case('hi')
                                        रेसिपी दर्ज की गई
                                    @break

                                    @case('bn')
                                        রেসিপি প্রবেশ করিয়েছে
                                    @break

                                    @case('ml')
                                        പാചകക്കുറിപ്പ് നൽകിയത്
                                    @break

                                    @case('fil')
                                        Ang recipe ay inilagay ni
                                    @break

                                    @case('ur')
                                        ترکیب درج کی گئی ہے
                                    @break

                                    @case('ta')
                                        செய்முறை உள்ளிடப்பட்டது
                                    @break

                                    @case('ne')
                                        रेसिपी द्वारा प्रविष्ट गरियो
                                    @break

                                    @default
                                        The recipe was entered by
                                @endswitch: {{ $recipe->user->name ?? ($recipe->user_id ?? 'Not Assigned') }}
                            </div>
                        @endif
                        <div class="detail-item"><i class="fas fa-calendar" style="color: #6c757d;"></i>
                            @switch($currentLanguageCode)
                                @case('ar')
                                    تاريخ النشر
                                @break

                                @case('en')
                                    Publish Date
                                @break

                                @case('id')
                                    Tanggal Publikasi
                                @break

                                @case('am')
                                    የነፃ ቀን
                                @break

                                @case('hi')
                                    प्रकाशन तिथि
                                @break

                                @case('bn')
                                    প্রকাশের তারিখ
                                @break

                                @case('ml')
                                    പ്രകാശന തീയതി
                                @break

                                @case('fil')
                                    Petsa ng Paglalathala
                                @break

                                @case('ur')
                                    شائع کرنے کی تاریخ
                                @break

                                @case('ta')
                                    வெளியிடப்பட்ட தேதி
                                @break

                                @case('ne')
                                    प्रकाशन मिति
                                @break

                                @default
                                    Publish Date
                            @endswitch:
                            {{ $recipe->created_at->format('Y-m-d') }}
                        </div>
                        @if ($recipe->updated_at)
                            <div class="detail-item"><i class="fas fa-calendar-check" style="color: #28a745;"></i>
                                @switch($currentLanguageCode)
                                    @case('ar')
                                        تاريخ التحديث
                                    @break

                                    @case('en')
                                        Update Date
                                    @break

                                    @case('id')
                                        Tanggal Perbarui
                                    @break

                                    @case('am')
                                        የመረጋገጫ ቀን
                                    @break

                                    @case('hi')
                                        अद्यतन तिथि
                                    @break

                                    @case('bn')
                                        হালনাগাদের তারিখ
                                    @break

                                    @case('ml')
                                        അപ്ഡേറ്റ് തീയതി
                                    @break

                                    @case('fil')
                                        Petsa ng Pag-update
                                    @break

                                    @case('ur')
                                        اپ ڈیٹ کی تاریخ
                                    @break

                                    @case('ta')
                                        புதுப்பிப்பு தேதி
                                    @break

                                    @case('ne')
                                        अपडेट मिति
                                    @break

                                    @default
                                        Update Date
                                @endswitch:
                                {{ $recipe->updated_at->format('Y-m-d') }}
                            </div>
                        @endif

                    </div>

                    @if ($recipe->recipeSteps->count())
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">Preparation Steps</div>
                            <div class="card-body">
                                @foreach ($recipe->recipeSteps as $step)
                                    <p>{{ $step->translations->where('language_code', $currentLanguageCode)->first()->description ?? 'Not Translated' }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="">
                        <h5 class="section-title"
                            style="    color: #660099;
    font-size: 29px;
    border: 1px solid #660099;
    font-weight: bold;
    /* width: fit-content; */
    padding: 12px;
    border-radius: 12px;
    text-align: center;">
                            خطوات التحضير</h5>
                        <ol class="content-list">
                            @if ($recipe->steps && is_array($recipe->steps) && count($recipe->steps) > 0)
                                @foreach ($recipe->steps as $index => $step)
                                    <li style="flex-direction: column;">
                                        <span
                                            style="background: #660099;
    color: white;
    font-weight: bold;
    width: 28px;
    height: 28px;
    text-align: center;
    align-items: center;
    justify-content: center;
    display: flex
;
    border-radius: 50px;">
                                            {{ $index + 1 }}
                                        </span>
                                        <div style="display: flex;">

                                            {{ $step['description'] ?? 'بدون وصف' }}
                                            <span
                                            style="    color: #ffffff;
    font-size: 29px;
    text-align: center;
    background: #660099;
    font-weight: bold;
    padding: 12px;
    border-radius: 12px;
    display: flex
;
    align-items: center;
    justify-content: center;">
                    <i style="margin: 0px; color: #ffffff;" class="fa-solid fa-headphones"></i>
                </span>
            </div>

                                        @if (isset($step['media']) && is_array($step['media']) && !empty($step['media']))
                                            <div class="step-media mt-2" style="display: flex;">
                                                
                                                @foreach ($step['media'] as $mediaItem)
                                                    @php
                                                        // *** التعديل الرئيسي هنا ***
                                                        // تأكد من أننا نستخدم مفتاح 'url' لأنه هو الذي يجب أن يحتوي على المسار الكامل.
                                                        // إذا لم يكن موجوداً، أو كان فارغاً، فسيعتبر المسار غير صالح.
                                                        $mediaSource = $mediaItem['url'] ?? null;
                                                        $mediaType = $mediaItem['type'] ?? 'unknown';
                                                        $mediaName = $mediaItem['original_name'] ?? 'Media_' . $index;
                                                    @endphp

                                                    {{-- استخدم Storage::disk('public')->exists للتحقق من وجود الملف فعليًا --}}
                                                    @if ($mediaSource && Storage::disk('public')->exists($mediaSource))
                                                        @if (Str::startsWith($mediaType, 'image'))
                                                            <img src="{{ Storage::url($mediaSource) }}"
                                                                alt="{{ $mediaName }}"
                                                                class="media-preview img-fluid">
                                                                
                                                        @elseif (Str::startsWith($mediaType, 'video'))
                                                            <video controls class="media-preview video">
                                                                <source src="{{ Storage::url($mediaSource) }}"
                                                                    type="{{ $mediaType }}">
                                                                متصفحك لا يدعم تشغيل الفيديو.
                                                            </video>
                                                        @else
                                                            <span class="text-warning">نوع ميديا غير مدعوم:
                                                                {{ $mediaType }}</span>
                                                        @endif
                                                    @else
                                                        {{-- رسالة توضيحية لما الملف بيكون مش موجود --}}
                                                        <span class="text-danger">
                                                            الملف غير موجود أو المسار غير صالح:
                                                            {{ $mediaSource ?: 'مسار غير محدد' }}
                                                        </span>
                                                    @endif
                                                    
                                                @endforeach
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li class="text-warning">لا توجد خطوات متاحة</li>
                            @endif
                        </ol>
                    </div>

                    <div class="mt-4" style="    position: fixed;
    width: fit-content;
    bottom: 14px;
    right: 12px;
    z-index: 999999999999999999;">
                        <button type="button" onclick="backOnePage();" class="btn btn-secondary"
                            style="background: #660099; border: #660099;">الرجوع</button>
                    </div>

                </div>
            </div>

        @endsection

        @push('styles')
            <style>
                .detail-item {
                    padding-bottom: 0.5rem;
                }

                .detail-item:last-child {
                    border-bottom: none;
                }
            </style>
        @endpush
        <script>
            function backOnePage() {
                window.history.back();
            }
        </script>
