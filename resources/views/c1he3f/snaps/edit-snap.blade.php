<!DOCTYPE html dir="rtl">
<html lang="en">

<head>
    <style>
        .video-preview {
            text-align: center;
            margin-top: 20px;
        }

        .video-controls {
            margin-top: 15px;
        }

        .video-info {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: #007bff;
            width: 0%;
            transition: width 0.3s ease;
        }

        .hidden {
            display: none !important;
        }

        .btn {
            margin: 0 5px;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

    </style>


    <title>Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta name="keywords" content="android, ios, mobile, mobile template, mobile app, ui kit, dark layout, app, delivery, ecommerce, material design, mobile, mobile web, order, phonegap, pwa, store, web app, Ombe, coffee app, coffee template, coffee shop, mobile UI, coffee design, app template, responsive design, coffee showcase, style app, trendy app, modern UI, technology, User-Friendly Interface, Coffee Shop App, PWA (Progressive Web App), Mobile Ordering, Coffee Experience, Digital Menu, Innovative Technology, App Development, Coffee Experience, cafe, bootatrap, Bootstrap Framework, UI/UX Design, Coffee Shop Technology, Online Presence, Coffee Shop Website, Cafe Template, Mobile App Design, Web Application, Digital Presence, ">

    <meta name="description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta property="og:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="shortcut icon" type="image/x-icon" href="assets/images/app-logo/favicon.png">

    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/imageuplodify/imageuploadify.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
 
        .bg-cookpad-gray-9gi {
            background-color: #f8f9fa;
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
        }

        .bg-cookpad-gray-9gi:hover {
            border-color: #007bff;
            background-color: #f0f8ff;
        }

        .p-6h1 {
            padding: 24px;
        }

        .text-wbi {
            color: #6c757d;
        }

        .fle-kj4 {
            display: flex;
        }

        .item-sji {
            align-items: center;
        }

        .justify-byc {
            justify-content: center;
        }

        .text-fim {
            text-align: center;
        }

        .w-8so {
            width: 80px;
        }

        .mx-33j {
            margin: 0 auto;
        }

        .pointer-events-j3t {
            pointer-events: none;
        }

        .text-x8v {
            font-size: 18px;
        }

        .font-9s7 {
            font-weight: 600;
        }

        .mt-mnq {
            margin-top: 16px;
        }

        .text-b94 {
            font-size: 14px;
        }

        .px-ql7 {
            padding: 0 16px;
        }

        .video-preview {
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .video-preview video {
            width: 100%;
            height: auto;
        }

        .video-controls {
            padding: 15px;
            background: white;
            text-align: center;
        }

        .video-info {
            margin: 10px 0;
            padding: 10px;
            background: #e3f2fd;
            border-radius: 8px;
            font-size: 14px;
        }

        .error-message {
            color: #dc3545;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .success-message {
            color: #155724;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .btn {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress-fill {
            height: 100%;
            background: #007bff;
            width: 0%;
            transition: width 0.3s ease;
        }

        #fil-ttd {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .upload-area {
            position: relative;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

    </style>


    <style>
        .selected-items-container {
            min-height: 50px;
            border: 1px dashed #dee2e6;
            border-radius: 8px;
            padding: 10px;
            background-color: #f8f9fa;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: flex-start;
        }

        /* Removed the ::before pseudo-element that hardcoded the "empty" message */
        .selected-items-container.empty {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-style: italic;
        }

        .selected-item {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 123, 255, 0.2);
            transition: all 0.3s ease;
            animation: slideIn 0.3s ease;
        }

        .selected-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .selected-item .remove-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .selected-item .remove-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .subcategory-counter {
            background: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-right: 8px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(-20px);
            }
        }

        .removing {
            animation: slideOut 0.3s ease forwards;
        }

        /* تحسين القائمة المنسدلة */
        #subCategory-search {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }

        #subCategory-search:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            background: white;
        }

        /* مؤشر التحميل */
        .loading-indicator {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>


    <style>
        /* Exported with SnipCSS extension (Ver 1.9.8) */
        @media all {
            body {
                line-height: 1.5;
                font-size: 1rem;
                letter-spacing: -.025em;
                color: rgb(74 74 74/var(--tw-text-opacity, 1));
            }
        }

        body {
            font-size: 17px;
        }

        body {
            /* CSS Variables that may have been missed get put on body */
            --tw-bg-opacity: 1;
            --tw-bg-opacity: 1;
            --tw-text-opacity: 1;
        }

        @media all {
            * {
                border: 0 solid;
                box-sizing: border-box;
            }
        }

        @media (min-width: 970px) {
            .lg\:rounded {
                border-radius: .25rem;
            }

            .lg\:mb-lg {
                margin-bottom: 2.5rem;
            }

            .lg\:grid {
                display: grid;
            }

            .lg\:grid-cols-\[min\(35\%\,300px\)_1fr\] {
                grid-template-columns: min(35%, 300px) 1fr;
            }

            .lg\:gap-md {
                gap: 1.5rem;
            }
        }

        @media all {
            .mx-33j {
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (min-width: 970px) {
            .lg\:px-rg {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media all {
            .fle-kj4 {
                display: flex;
            }
        }

        @media (min-width: 970px) {
            .lg\:col-start-2 {
                grid-column-start: 2;
            }

            .lg\:rounded-lg {
                border-radius: .5rem;
            }

            .lg\:bg-cookpad-white {
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255/var(--tw-bg-opacity, 1));
            }

            .lg\:gap-x-sm {
                column-gap: .5rem;
            }

            .navigation-container:has(.sidebar-navigation) {
                grid-template-columns: clamp(240px, 20%, 270px) 1fr;
                padding-left: .5rem;
                padding-right: .5rem;
            }
        }

        body {
            transition: opacity ease-in 0.2s;
        }

        @media all {
            body {
                line-height: inherit;
                margin: 0;
            }

            body {
                font-size: 1rem;
                letter-spacing: -.025em;
                line-height: 1.5rem;
            }

            body {
                --tw-text-opacity: 1;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                font-feature-settings: "liga"on;
                color: rgb(74 74 74/var(--tw-text-opacity, 1));
                text-rendering: optimizeLegibility;
            }

            .bg-cookpad-gray-9gi {
                --tw-bg-opacity: 1;
                background-color: rgb(255 234 234);
            }
        }

        @media (min-width: 970px) {
            .lg\:overscroll-y-none {
                overscroll-behavior-y: none;
            }
        }

        :lang(ar) body {
            font-family: Noto Naskh Arabic, Noto Sans Arabic, sans-serif;
            font-size: 17px;
        }

        @media all {
            html {
                -webkit-text-size-adjust: 100%;
                font-feature-settings: normal;
                -webkit-tap-highlight-color: transparent;
                font-family: ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
                font-variation-settings: normal;
                line-height: 1.5;
                tab-size: 4;
            }

            html {
                font-size: 1rem;
                letter-spacing: -.025em;
                line-height: 1.5rem;
            }

            .p-6h1 {
                padding: 1rem;
            }

            *,
            :after,
            :before {
                border: 0 solid;
                box-sizing: border-box;
            }

            .image-zyn {
                cursor: pointer;
                overflow: hidden;
                position: relative;
            }

            .aspect-\[340\/241\] {
                aspect-ratio: 340/241;
            }

            .item-sji {
                align-items: center;
            }

            .justify-byc {
                justify-content: center;
            }

            .text-wbi {
                text-align: center;
            }
        }

        @media (min-width: 970px) {
            .lg\:aspect-\[120\/170\] {
                aspect-ratio: 120/170;
            }
        }

        @media all {
            .text-fim {
                --tw-text-opacity: 1;
                color: rgb(96 96 96/var(--tw-text-opacity, 1));
            }

            input {
                font-feature-settings: inherit;
                color: inherit;
                font-family: inherit;
                font-size: 100%;
                font-variation-settings: inherit;
                font-weight: inherit;
                letter-spacing: inherit;
                line-height: inherit;
                margin: 0;
                padding: 0;
            }

            input {
                text-align: right;
            }

            input[type="file"] {
                display: block;
            }

            .image-zyn input {
                cursor: pointer;
                height: 100%;
                inset: 0;
                margin: 0;
                opacity: 0;
                position: absolute;
                width: 100%;
            }

            img {
                display: block;
                vertical-align: middle;
            }

            img {
                height: auto;
                max-width: 100%;
            }

            .pointer-events-j3t {
                pointer-events: none;
            }

            .w-8so {
                width: 4rem;
            }

            p {
                margin: 0;
            }

            .mt-mnq {
                margin-top: 1.5rem;
            }

            .text-x8v {
                font-size: 1rem;
                letter-spacing: -.025em;
                line-height: 1.5rem;
            }

            .font-9s7 {
                font-weight: 600;
            }

            .px-ql7 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .text-b94 {
                font-size: .75rem;
                letter-spacing: -.2px;
                line-height: 1rem;
            }
        }

        input::placeholder {
            color: #b3a9a9 !important;
        }

    </style>
</head>

@extends('layouts.chef')

@section('title', 'إضافة هم هم سناب')
@section('content')

<body class="bg-light">
    <div class="page-wrapper">

        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">عدسة الطاهي - إضافة</h4>
                </div>
            </div>
        </header>
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <div class="container">
                <div class="container" style="max-width: 800px; margin:0px auto; padding: 20px;">

                    <form action="{{ route('c1he3f.snaps.update-snap', $snap) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="bg-cookpad-gray-9gi p-6h1 upload-area" id="upload-area" style="height: 280px; width: 80%; margin: auto; border-radius: 15px; 
                            {{ $snap->video_path ? 'display: none;' : '' }}">
                            <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                                <div class="text-fim">
                                    <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                    <p class="text-x8v font-9s7 mt-mnq">أضف الفيديو الذي تريد مشاركته</p>
                                    <p class="text-b94 px-ql7">يجب علي الفيديو ان لا يزيد عن 60 ثانية</p>
                                </div>
                                <input type="file" name="video" id="fil-ttd" accept="video/*">
                            </div>
                        </div>

                        <div id="message-container"></div>

                        <div class="video-preview {{ $snap->video_path ? '' : 'hidden' }}" id="video-preview">
                            @if($snap->video_path)
                            <video id="preview-video" style="height: 280px; width: 80%; margin: auto; border-radius: 15px;" controls>
                                <source src="{{ Storage::url($snap->video_path) }}" type="video/mp4">

                                متصفحك لا يدعم تشغيل الفيديو.
                            </video>
                            @else
                            <video id="preview-video" style="height: 280px; width: 80%; margin: auto; border-radius: 15px;" controls>
                                <source src="" type="video/mp4">
                                متصفحك لا يدعم تشغيل الفيديو.
                            </video>
                            @endif

                            <div class="video-controls" style="margin-top: 10px; text-align: center;">
                                <div class="video-info" id="video-info">
                                    @if($snap->video_path)
                                    <strong>الفيديو الحالي:</strong><br>
                                    <span>{{ basename($snap->video_path) }}</span><br>
                                    <span id="video-duration"></span><br>
                                    <span id="video-size"></span>
                                    @endif
                                </div>

                                <div class="progress-bar" id="progress-bar" style="display: none; margin: 10px 0;">
                                    <div class="progress-fill" id="progress-fill"></div>
                                </div>

                                <div style="margin-top: 15px;">
                                    <button type="button" class="btn btn-secondary" onclick="changeVideo()" id="change-video-btn">
                                        {{ $snap->video_path ? 'تغيير الفيديو' : 'اختيار فيديو' }}
                                    </button>
                                    @if($snap->video_path)
                                    <button type="button" class="btn btn-danger" onclick="removeVideo()">إزالة الفيديو</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="my-3">
                            <input type="text" id="name" value="{{ $snap->name }}" name="name" style="height: 98px; text-align: center; color: #000000;" placeholder="ماذا تريد ان تقول للمستخدمين" class="form-control" required>
                        </div>
                        <div class="my-3">
                            <div class="form-group">
                                <label for="kitchen-search" style="text-align: center; display: block; margin-bottom: 5px;">إختر المطبخ</label>
                                <select class="form-control" id="kitchen-search" name="kitchen_id" style="width: 100%;">
                                    <option value="">إختر مطبخ</option>
                                    @foreach($kitchens as $kitchen)
                                    <option value="{{ $kitchen->id }}" {{ $snap->kitchen_id == $kitchen->id ? 'selected' : '' }}>
                                        {{ $kitchen->name_ar }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="main_category_id">التصنيف الرئيسي:</label>
                                <select class="form-control" id="main_category_id" name="main_category_id">
                                    <option value="">اختر التصنيف الرئيسي</option>
                                    @foreach($mainCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('main_category_id', $snap->main_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_ar }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- حاوية التصنيفات الفرعية -->
                            <div id="subcategory-container">
                                <!-- سيتم ملء هذا القسم بواسطة JavaScript -->
                            </div>


                            <div class="form-group">
                                <label for="recipe-search" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">إربط مع وصفة</label>
                                <select class="form-control" id="recipe-search" name="recipe_id" style="width: 100%;">
                                    <option value="">إختر وصفة</option>
                                    @foreach($recpies as $recipe)
                                    <option value="{{ $recipe->id }}" {{ old('recipe_id', $snap->recipe_id) == $recipe->id ? 'selected' : '' }}>{{ $recipe->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h6 class="dz-title my-2" style="text-align: center;">اين تريد ان تحفظ الفيديو</h6>
                        <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                            <div class="form-check style-2">
                                <input class="form-check-input" type="radio" name="status" id="filterRadio1" value="published" 
                                       {{ $snap->status == 'published' ? 'checked' : '' }}>
                                <label class="form-check-label" for="filterRadio1">
                                    نشر
                                </label>
                            </div>
                            <div class="form-check style-2">
                                <input {{ $snap->status == 'draft' ? 'checked' : '' }} class="form-check-input" type="radio" name="status" id="filterRadio2" value="draft">
                                <label  class="form-check-label" for="filterRadio2">
                                    مسودة
                                </label>
                            </div>
                        </div>
    <input type="hidden" id="subCategory_ids" name="subCategory_ids" value="">


                        <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">حفظ</button>
                    
                    </form>
                </div>

        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let selectedFile = null;
        let videoDuration = 0;

        document.getElementById('fil-ttd').addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (!file) return;

            if (!file.type.startsWith('video/')) {
                showMessage('يرجى اختيار ملف فيديو صالح', 'error');
                return;
            }

            // التحقق من حجم الملف (50MB كحد أقصى)
            const maxSize = 50 * 1024 * 1024; // 50MB
            if (file.size > maxSize) {
                showMessage('حجم الفيديو كبير جداً. الحد الأقصى 50 ميجابايت', 'error');
                return;
            }

            selectedFile = file;
            previewVideo(file);
        });

        function previewVideo(file) {
            const video = document.getElementById('preview-video');
            const url = URL.createObjectURL(file);

            video.src = url;

            video.addEventListener('loadedmetadata', function() {
                videoDuration = video.duration;

                // التحقق من مدة الفيديو
                if (videoDuration > 60) {
                    showMessage('مدة الفيديو أكثر من 60 ثانية. يرجى اختيار فيديو أقصر', 'error');
                    removeVideo();
                    return;
                }

                // إظهار معلومات الفيديو
                updateVideoInfo(file, videoDuration);

                // إخفاء منطقة الرفع وإظهار المعاينة
                document.getElementById('upload-area').classList.add('hidden');
                document.getElementById('video-preview').classList.remove('hidden');

                showMessage('تم تحميل الفيديو بنجاح! يمكنك الآن مراجعته ورفعه', 'success');
            });

            video.addEventListener('error', function() {
                showMessage('حدث خطأ في تحميل الفيديو', 'error');
                removeVideo();
            });
        }

        function updateVideoInfo(file, duration) {
            const minutes = Math.floor(duration / 60);
            const seconds = Math.floor(duration % 60);
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

            document.getElementById('video-duration').textContent =
                `المدة: ${minutes}:${seconds.toString().padStart(2, '0')} دقيقة`;
            document.getElementById('video-size').textContent =
                `الحجم: ${sizeInMB} ميجابايت`;
        }

        function removeVideo() {
            selectedFile = null;
            videoDuration = 0;

            // إعادة تعيين input الملف
            document.getElementById('fil-ttd').value = '';

            // إخفاء المعاينة وإظهار منطقة الرفع
            document.getElementById('video-preview').classList.add('hidden');
            document.getElementById('upload-area').classList.remove('hidden');

            // مسح الرسائل
            document.getElementById('message-container').innerHTML = '';

            // إعادة تعيين شريط التقدم
            document.getElementById('progress-fill').style.width = '0%';
        }

        function uploadVideo() {
            if (!selectedFile) {
                showMessage('لم يتم اختيار فيديو للرفع', 'error');
                return;
            }

            // محاكاة عملية الرفع
            simulateUpload();
        }

        function simulateUpload() {
            const progressFill = document.getElementById('progress-fill');
            let progress = 0;

            const interval = setInterval(() => {
                progress += Math.random() * 15;

                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    showMessage('تم رفع الفيديو بنجاح!', 'success');

                    // هنا يمكنك إضافة كود الرفع الفعلي للسيرفر
                    // uploadToServer(selectedFile);
                }

                progressFill.style.width = progress + '%';
            }, 200);
        }

        function showMessage(message, type) {
            const container = document.getElementById('message-container');
            const messageClass = type === 'error' ? 'error-message' : 'success-message';

            container.innerHTML = `<div class="${messageClass}">${message}</div>`;

            // إزالة الرسالة بعد 5 ثواني
            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        // إضافة إمكانية السحب والإفلات
        const uploadArea = document.getElementById('upload-area');

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#e3f2fd';
            uploadArea.style.borderColor = '#007bff';
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#f8f9fa';
            uploadArea.style.borderColor = '#dee2e6';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#f8f9fa';
            uploadArea.style.borderColor = '#dee2e6';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                document.getElementById('fil-ttd').files = files;

                // تشغيل event change يدوياً
                const event = new Event('change', {
                    bubbles: true
                });
                document.getElementById('fil-ttd').dispatchEvent(event);
            }
        });

    </script>
@php
$selectedSubCategoryIds = $snap->subCategories->pluck('id')->toArray();
@endphp


    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const mainCategorySelect = document.getElementById('main_category_id');
    const subCategoryContainer = document.getElementById('subcategory-container');
    const subCategoryIdsInput = document.getElementById('subCategory_ids');

    // احصل على معرفات التصنيفات الفرعية المرتبطة بهذا السناب
    const savedSubCategories = @json($selectedSubCategoryIds);
    console.log('التصنيفات المحفوظة:', savedSubCategories); // للتأكد من البيانات


            // دالة لجلب التصنيفات الفرعية
            function loadSubcategories(mainCategoryId, selectedSubCategories = []) {
                if (!mainCategoryId) {
                    subCategoryContainer.innerHTML = '';
                    subCategoryIdsInput.value = '';
                    return;
                }

                // إظهار مؤشر التحميل
                subCategoryContainer.innerHTML = '<div class="text-center">جاري التحميل...</div>';

                // استخدام fetch للحصول على التصنيفات الفرعية
                fetch(`/c1he3f/get-subcategories/${mainCategoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            subCategoryContainer.innerHTML = '<div class="text-muted">لا توجد تصنيفات فرعية لهذا التصنيف</div>';
                            return;
                        }

                        let html = '<div class="form-group"><label>التصنيفات الفرعية:</label><div class="subcategory-checkboxes">';

                        data.forEach(subCategory => {
                            // التحقق من أن التصنيف الفرعي محدد مسبقاً
                            // نحول كلاً من القيم إلى string للمقارنة الصحيحة
                            const isSelected = selectedSubCategories.map(id => String(id)).includes(String(subCategory.id));
                            const isChecked = isSelected ? 'checked' : '';

                            console.log(`التصنيف ${subCategory.id}: محدد = ${isSelected}`); // للتأكد

                            html += `
                        <div class="form-check">
                            <input class="form-check-input subcategory-checkbox" 
                                   type="checkbox" 
                                   value="${subCategory.id}" 
                                   id="subcat_${subCategory.id}"
                                   ${isChecked}>
                            <label class="form-check-label" style="margin-right: 31px;" for="subcat_${subCategory.id}">
                                ${subCategory.name_ar}
                            </label>
                        </div>
                    `;
                        });

                        html += '</div></div>';
                        subCategoryContainer.innerHTML = html;

                        // إضافة event listeners للـ checkboxes
                        addCheckboxListeners();

                        // تحديث القيم المخفية
                        updateSelectedSubcategories();
                    })
                    .catch(error => {
                        console.error('خطأ في جلب التصنيفات الفرعية:', error);
                        subCategoryContainer.innerHTML = '<div class="text-danger">خطأ في تحميل التصنيفات الفرعية</div>';
                    });
            }

            // دالة لإضافة event listeners للـ checkboxes
            function addCheckboxListeners() {
                const checkboxes = document.querySelectorAll('.subcategory-checkbox');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateSelectedSubcategories);
                });
            }

function updateSelectedSubcategories() {
const checkboxes = document.querySelectorAll('.subcategory-checkbox:checked');
const selectedIds = Array.from(checkboxes).map(cb => cb.value);
const subCategoryIdsInput = document.getElementById('subCategory_ids');

// إزالة أي مدخلات مخفية سابقة
subCategoryIdsInput.parentNode.querySelectorAll('input[name="subCategory_ids[]"]').forEach(input => input.remove());

// إضافة مدخل مخفي لكل معرف
selectedIds.forEach(id => {
const input = document.createElement('input');
input.type = 'hidden';
input.name = 'subCategory_ids[]';
input.value = id;
subCategoryIdsInput.parentNode.appendChild(input);
});

console.log('القيم المحدثة:', selectedIds);
}


            // عند تغيير التصنيف الرئيسي
            mainCategorySelect.addEventListener('change', function() {
                const selectedMainCategory = this.value;
                loadSubcategories(selectedMainCategory);
            });

            // تحميل التصنيفات الفرعية عند تحميل الصفحة (إذا كان هناك تصنيف رئيسي محدد مسبقاً)
            const currentMainCategory = mainCategorySelect.value;
            if (currentMainCategory) {
                // تمرير التصنيفات المحفوظة مباشرة
                loadSubcategories(currentMainCategory, savedSubCategories);
            }
        });

    </script>

    <script>
        $(document).ready(function() {
            $('#kitchen-search').select2({
                placeholder: "إختر مطبخ"
                , allowClear: true
            });

            $('#mainCategorie-search').select2({
                placeholder: "إختر التصنيف الرئيسي"
                , allowClear: true
            });

            $('#recipe-search').select2({
                placeholder: "إختر وصفة"
                , allowClear: true
            });


            let selectedSubcategories = {}; // Object to store selected subcategories {id: name_ar}

            function updateSelectedSubcategoriesDisplay() {
                const container = $('#selected-subcategories');
                container.empty(); // Clear current display

                const ids = Object.keys(selectedSubcategories);
                if (ids.length === 0) {
                    container.addClass('empty').text('لم يتم اختيار أي تصنيفات فرعية بعد');
                } else {
                    container.removeClass('empty').text(''); // Remove the placeholder text

                    ids.forEach(id => {
                        const name = selectedSubcategories[id];
                        const itemHtml = `
                            <div class="selected-item" data-id="${id}">
                                <span>${name_ar}</span>
                                <button type="button" class="remove-btn" data-id="${id}">&times;</button>
                            </div>
                        `;
                        container.append(itemHtml);
                    });
                }
                $('#subcategory-ids').val(ids.join(',')); // Update the hidden input field
            }

            // Initial display check
            updateSelectedSubcategoriesDisplay();

            $('#mainCategorie-search').on('change', function() {
                const mainCategoryId = $(this).val();
                const subCategorySelect = $('#subCategory-search');
                subCategorySelect.empty().append($('<option value="">إختر التصنيف الفرعي لإضافته</option>')); // Clear existing options and add default

                if (mainCategoryId) {
                    // Show a loading indicator in the select box
                    subCategorySelect.append($('<option disabled>جارٍ التحميل...</option>'));

                    $.ajax({
                        url: `/api/subcategories/${mainCategoryId}`, // Adjust this API endpoint as needed
                        method: 'GET'
                        , success: function(data) {
                            subCategorySelect.empty().append($(
                                '<option value="">إختر التصنيف الفرعي لإضافته</option>')); // Clear loading
                            data.forEach(subCategory => {
                                // Only add if not already selected
                                if (!selectedSubcategories[subCategory.id]) {
                                    subCategorySelect.append(new Option(subCategory
                                        .name_ar, subCategory.id));
                                }
                            });
                        }
                        , error: function(error) {
                            console.error("Error fetching subcategories:", error);
                            subCategorySelect.empty().append($(
                                '<option value="">حدث خطأ في تحميل التصنيفات</option>'));
                        }
                    });
                }
            });

            $('#subCategory-search').on('change', function() {
                const subcategoryId = $(this).val();
                const subcategoryName = $(this).find('option:selected').text();

                if (subcategoryId && !selectedSubcategories[subcategoryId]) {
                    selectedSubcategories[subcategoryId] = subcategoryName;
                    updateSelectedSubcategoriesDisplay();

                    // Remove the selected option from the dropdown to prevent re-selection
                    $(this).find(`option[value="${subcategoryId}"]`).remove();
                    $(this).val(''); // Reset dropdown
                }
            });

            // Handle removal of subcategory
            $('#selected-subcategories').on('click', '.remove-btn', function() {
                const idToRemove = $(this).data('id');
                const $itemToRemove = $(this).closest('.selected-item');

                $itemToRemove.addClass('removing'); // Add animation class

                $itemToRemove.on('animationend', function() {
                    delete selectedSubcategories[idToRemove];
                    updateSelectedSubcategoriesDisplay();

                    // Re-add the option to the main dropdown if its parent category is currently selected
                    const mainCategoryId = $('#mainCategorie-search').val();
                    if (mainCategoryId) {
                        $.ajax({
                            url: `/api/subcategory-details/${idToRemove}`, // Fetch details of the removed subcategory
                            method: 'GET'
                            , success: function(data) {
                                if (data && data.main_category_id == mainCategoryId) {
                                    const subCategorySelect = $('#subCategory-search');
                                    // Append the option back in alphabetical order if desired, or just at the end
                                    subCategorySelect.append(new Option(data.name_ar, data
                                        .id));
                                }
                            }
                        });
                    }
                });
            });
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fil-ttd');
            const uploadArea = document.getElementById('upload-area');
            const videoPreview = document.getElementById('video-preview');
            const previewVideo = document.getElementById('preview-video');
            const videoInfo = document.getElementById('video-info');
            const progressBar = document.getElementById('progress-bar');
            const changeVideoBtn = document.getElementById('change-video-btn');

            // إذا كان هناك فيديو محفوظ، قم بتحميل معلوماته
            @if($snap->video_path)
            loadVideoInfo('{{ asset('
                storage / ' . $snap->video_path) }}');
            @endif

            // عند تغيير الملف
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // التحقق من نوع الملف
                    if (!file.type.startsWith('video/')) {
                        alert('يرجى اختيار ملف فيديو صالح');
                        return;
                    }

                    // التحقق من حجم الملف (60MB كحد أقصى)
                    if (file.size > 60 * 1024 * 1024) {
                        alert('حجم الفيديو يجب أن يكون أقل من 60 ميجابايت');
                        return;
                    }

                    // إنشاء URL للمعاينة
                    const videoUrl = URL.createObjectURL(file);

                    // إخفاء منطقة الرفع وإظهار المعاينة
                    uploadArea.style.display = 'none';
                    videoPreview.classList.remove('hidden');

                    // تحديث مصدر الفيديو
                    previewVideo.src = videoUrl;

                    // تحديث معلومات الفيديو
                    updateVideoInfo(file);

                    // تحديث النص في الزر
                    changeVideoBtn.textContent = 'تغيير الفيديو';
                }
            });

            function loadVideoInfo(videoUrl) {
                const video = document.createElement('video');
                video.src = videoUrl;

                video.addEventListener('loadedmetadata', function() {
                    const duration = Math.round(video.duration);
                    const minutes = Math.floor(duration / 60);
                    const seconds = duration % 60;

                    document.getElementById('video-duration').textContent =
                        `المدة: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                });
            }

            function updateVideoInfo(file) {
                // حساب حجم الملف
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                document.getElementById('video-size').textContent = `الحجم: ${fileSize} ميجابايت`;

                // حساب مدة الفيديو
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);

                video.addEventListener('loadedmetadata', function() {
                    const duration = Math.round(video.duration);

                    if (duration > 60) {
                        alert('مدة الفيديو يجب أن تكون أقل من 60 ثانية');
                        removeVideo();
                        return;
                    }

                    const minutes = Math.floor(duration / 60);
                    const seconds = duration % 60;

                    document.getElementById('video-duration').textContent =
                        `المدة: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                });
            }
        });

        function changeVideo() {
            document.getElementById('fil-ttd').click();
        }

        function removeVideo() {
            const fileInput = document.getElementById('fil-ttd');
            const uploadArea = document.getElementById('upload-area');
            const videoPreview = document.getElementById('video-preview');
            const previewVideo = document.getElementById('preview-video');

            // إعادة تعيين الملف
            fileInput.value = '';

            // إخفاء المعاينة وإظهار منطقة الرفع
            videoPreview.classList.add('hidden');
            uploadArea.style.display = 'block';

            // مسح مصدر الفيديو
            previewVideo.src = '';

            // مسح معلومات الفيديو
            document.getElementById('video-info').innerHTML = '<strong>معلومات الفيديو:</strong><br>';
            document.getElementById('video-duration').textContent = '';
            document.getElementById('video-size').textContent = '';
        }

    </script>

</body>

</html>
