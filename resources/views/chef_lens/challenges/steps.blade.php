<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Title -->
    <title>{{ $recipe->title }} | وصفة</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="وصفة, مطبخ, {{ $recipe->main_category->name_ar ?? '' }}, {{ $recipe->title }}">
    <meta name="description" content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta property="og:title" content="{{ $recipe->title }} | وصفة">
    <meta property="og:description" content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta property="og:image" content="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : asset('assets/images/social-image.png') }}">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:title" content="{{ $recipe->title }} | وصفة">
    <meta name="twitter:description" content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta name="twitter:image" content="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<style>
    /* Your custom styles from ingredients.blade.php should be copied here */
    /* Example: */
    .step-item {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        display: flex;
        flex-wrap: wrap;
        /* Allow items to wrap on smaller screens */
        align-items: center;
        gap: 10px;
    }

    .step-item .handle {
        cursor: grab;
        padding: 5px;
        margin-right: 10px;
        color: #6c757d;
    }

    .step-item .flex-grow-1 {
        flex-grow: 1;
    }

    .step-text {
        flex-grow: 1;
        /* Allow text input to take available space */
        min-width: 200px;
        /* Ensure it doesn't get too small */
    }

    .char-counter {
        font-size: 0.8em;
        color: #6c757d;
        text-align: end;
        display: block;
        width: 100%;
        /* Take full width below input */
    }

    .btn-group.step-buttons {
        margin-top: 10px;
    }

    .remove-step-btn {
        background-color: #e00000;
        color: white;
        border: none;
    }

    .remove-step-btn:hover {
        background-color: #c82333;
    }

    .footer-fixed-btn {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        padding: 10px 20px;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transform: unset !important;

    }

    .page-content {
        padding-bottom: 70px;
        padding-top: 25px !important;
        /* To prevent content from being hidden by fixed footer */
    }

    .alert {
        margin-top: 20px;
    }

    /* Styles for media previews */
    .media-previews {
        width: 100%;
        /* Take full width for better layout */
    }

    .multiple-media-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .media-item {
        position: relative;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 5px;
        background-color: #fff;
    }

    .media-item img,
    .media-item video {
        width: 130px;
        max-height: 100px;
        object-fit: unset !important;
        border-radius: 3px;
        display: block;
        /* Remove extra space below images/videos */
    }

    .step-number-indicator {
        text-align: center;
        display: block;
        width: fit-content;
        color: white;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        margin: auto;
        padding: 5px 10px;
        margin-bottom: 10px;
        background-color: #e00000;
    }

    .remove-single-media {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #e00000;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        padding: 0;
        font-size: 0.9em;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

</style>
<style>
    .back--btn {
        background: #000000;
        width: 50px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        border-radius: 50%;
    }

    .back--btn i {
        font-size: 23px;
        color: white;
    }

    .dz-card.list {
        margin-bottom: 0px;
    }

</style>

<body>
    <header class="header header-fixed border-bottom">
        <div class="header-content">
            <div class="mid-content">
                <h4 class="title">الخطوات</h4>
            </div>
            <div class="left-content">
                <a href="{{ url()->previous() }}" class="back--btn">
                    <i class="fa-solid fa-angle-left"></i>
                </a>

            </div>
        </div>
    </header>

    <div class="container mt-5 page-content">
        <main class="page-content space-top p-b100">
            @if(isset($recipe->steps) && is_array($recipe->steps) && !empty($recipe->steps))
            <div class="steps-list">
                @foreach($recipe->steps as $index => $step)
                <div class="step-view-item">
                    <h5 class="step-title">الخطوة {{ $index + 1 }}</h5>
                    @if(!empty($step['description']))
                    <p class="step-description">{{ $step['description'] }}</p>
                    @endif
                    @if(isset($step['media']) && is_array($step['media']) && !empty($step['media']))
                    <div class="step-media-gallery">
                        @foreach($step['media'] as $media)
                        @php
                        $mediaSrc = isset($media['url']) ? $media['url'] : (isset($media['path']) ? Storage::url($media['path']) : '');
                        @endphp
                        @if($mediaSrc)
                        <div class="media-preview">
                            @if(isset($media['type']) && $media['type'] === 'image')
                            <img src="{{ $mediaSrc }}" alt="صورة للخطوة">
                            @elseif(isset($media['type']) && $media['type'] === 'video')
                            <video src="{{ $mediaSrc }}" controls></video>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="no-steps">
                <p>لا توجد خطوات تحضير لهذه الوصفة.</p>
            </div>
            @endif
        </main>
    </div>


    <script src="{{ asset('assets/js/pwa.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <style>
        .step-view-item {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .step-title {
            font-weight: bold;
            font-size: 1.2rem;
            color: #dc3545;
            margin-bottom: 10px;
            border-bottom: 2px solid #dc3545;
            display: inline-block;
            padding-bottom: 5px;
        }

        .step-description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .step-media-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .media-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        .media-preview img,
        .media-preview video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-steps {
            text-align: center;
            padding: 40px;
            background-color: #f8f9fa;
            border-radius: 12px;
            border: 2px dashed #e9ecef;
        }

        .no-steps p {
            font-size: 1.1rem;
            color: #888;
        }

    </style>
</body>
</html>
