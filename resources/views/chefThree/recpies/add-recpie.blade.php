<!DOCTYPE html dir="rtl">
<html lang="en">

<head>

    <!-- Title -->
    <title>إضاف وصفة</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
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
                font-feature-settings: "liga" on;
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

        input::placeholder,
        textarea::placeholder,
        select::placeholder {
            color: var(--primary) !important;
        }

        .custom-tab-1 .nav-link {
            font-size: 14px;
            padding: 6.3px;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            text-align: center;
            margin-bottom: 10px;
            justify-content: center;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: #667eea;
        }

        .form-control {
            border: 2px solid #e9ecef !important;
            border-radius: 12px !important;
            padding: 10px 16px !important;
            font-size: 16px !important;
            transition: all 0.3s ease !important;
            background: #fafbfc !important;
        }

        .form-control:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
            background: white !important;
        }

        .select2-container--default .select2-selection--single {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            height: 50px;
            padding: 8px 12px;
            background: #fafbfc;
            transition: all 0.3s ease;
        }

        * {
            font-family: 'cairo', sans-serif !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: 2px solid #e9ecef !important;
            border-radius: 12px !important;
            min-height: 50px !important;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex !important;
            padding: 8px 12px !important;
            background: #fafbfc !important;
            transition: all 0.3s ease !important;
        }

        .select2-container .select2-search--inline .select2-search__field {
            height: 26px !important;

        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
            display: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057;
            line-height: 32px;
            padding-right: 20px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px;
            right: 10px;
        }

        .select2-dropdown {
            border: 2px solid #667eea;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .select2-container--default .select2-results__option {
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #667eea;
            color: white;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000000 !important;
            border: none;
            border-radius: 20px;
            color: white;
            width: fit-content;
            padding: 6px 12px;
            margin: 3px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice:hover {
            background-color: #5a67d8;
            transform: translateY(-1px);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 18px;
            margin-left: 8px;
            transition: all 0.3s ease;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .sub-categories-container {
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.4s ease;
            max-height: 0;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .sub-categories-container.show {
            opacity: 1;
            transform: translateY(0);
            max-height: 300px;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            color: #667eea;
            margin-top: 10px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .select2-container {
            width: 100% !important;
        }

        .badge-info {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            margin-right: 10px;
        }

        .b-3 {
            margin-bottom: 25px;
        }

        .sub-categories-smooth {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .sub-categories-smooth.hidden {
            max-height: 0;
            opacity: 0;
            margin: 0;
            padding: 0;
        }

        .sub-categories-smooth.visible {
            max-height: 300px;
            opacity: 1;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .form-section {
                background: #fafafa;
                color: black;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .form-control,
            .form-select {
                border-radius: 8px;
                border: 1px solid #ddd;
                padding: 10px 15px;
                background-color: rgba(255, 255, 255, 0.9);
                color: #333;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                background-color: white;
            }

            .form-label {
                color: rgb(0, 0, 0);
                font-weight: bold;
                margin-bottom: 5px;
            }

            .btn-submit {
                background-color: #fff;
                color: #764ba2;
                border: none;
                padding: 10px 20px;
                border-radius: 8px;
                font-weight: bold;
                transition: all 0.3s ease;
            }

            .btn-submit:hover {
                background-color: #eee;
                color: #667eea;
            }

            .dish-image-preview {
                max-width: 200px;
                max-height: 150px;
                height: auto;
                border: 1px solid #ddd;
                border-radius: 8px;
                margin-top: 10px;
                object-fit: contain;
                background-color: white;
                padding: 5px;
            }

            /* Adjust Select2 styles for dark background */
            .select2-container .select2-selection--multiple {
                background-color: rgba(255, 255, 255, 0.9) !important;
                border-radius: 8px !important;
                border: 1px solid #ddd !important;
                min-height: 44px;
                /* Adjust height */
                padding: 5px 10px;
            }

            .select2-container .select2-selection--multiple .select2-selection__choice {
                background-color: #667eea !important;
                color: white !important;
                border: 1px solid #667eea !important;
                border-radius: 4px !important;
                padding: 2px 17px !important;
                margin-top: 5px !important;
            }

            .select2-container .select2-selection--multiple .select2-selection__choice__remove {
                color: white !important;
                float: right;
                margin-left: 5px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__clear {
                color: #764ba2 !important;
                font-weight: bold;
            }

            .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
                background-color: #667eea !important;
                color: white !important;
            }

            .select2-container--default .select2-search--dropdown .select2-search__field {
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px 15px;
            }

            .select2-dropdown {
                border-radius: 8px !important;
                border: 1px solid #667eea !important;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .select2-container--default .select2-results__option--selected {
                background-color: #e0e0e0;
                color: #333;
            }

            /* Styles for dynamic ingredient input */
            .ingredient-item {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 10px;
                background-color: rgba(255, 255, 255, 0.1);
                padding: 10px;
                border-radius: 8px;
            }

            @media (max-width: 768px) {
                .ingredient-item {
                    flex-direction: column;
                }

                .ingredient-item div {
                    width: 100%;
                }

                .ingredient-type-indicator {
                    display: block;
                }
            }

            .ingredient-item .form-control {
                flex-grow: 1;
                margin-bottom: 0;
                /* Override default margin-bottom */
            }

            .ingredient-buttons button {
                white-space: nowrap;
            }

            .ingredient-buttons .btn {
                padding: 8px 12px;
                font-size: 0.9rem;
            }

            .btn-is-heading {
                background-color: #ffc107;
                /* Warning yellow */
                color: #333;
            }

            .btn-is-heading.active {
                background-color: #e0a800;
                /* Darker yellow when active */
                border-color: #e0a800;
            }

            .btn-is-ingredient {
                background-color: #17a2b8;
                /* Info blue */
                color: white;
            }

            .btn-is-ingredient.active {
                background-color: #138496;
                /* Darker blue when active */
                border-color: #138496;
            }

            .remove-ingredient-btn {
                background-color: #dc3545;
                /* Danger red */
                color: white;
            }

            .add-ingredient-btn {
                background-color: #28a745;
                /* Success green */
                color: white;
                margin-top: 10px;
                width: fit-content;
            }

            /* Style for the type indicator span */
            .ingredient-type-indicator {
                background-color: rgba(110, 110, 110, 0.2);
                color: rgb(0, 0, 0);
                padding: 5px 8px;
                border-radius: 5px;
                font-size: 0.8rem;
                min-width: 60px;
                /* لضمان عرض ثابت */
                text-align: center;
            }

            /* Styles for step items */
            .step-item {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 10px;
                background-color: rgba(255, 255, 255, 0.1);
                padding: 10px;
                border-radius: 8px;
                flex-wrap: wrap;
                /* Allow wrapping for media section */
            }

            .step-item .form-control {
                flex-grow: 1;
                margin-bottom: 0;
            }

            .step-number-indicator {
                background-color: rgba(118, 75, 162, 0.2);
                /* A shade of purple from your theme */
                color: #764ba2;
                padding: 5px 8px;
                border-radius: 5px;
                font-size: 0.8rem;
                min-width: 70px;
                text-align: center;
                font-weight: bold;
            }

            .step-media-section {
                display: flex;
                flex-direction: column;
                gap: 10px;
                width: 100%;
                /* Take full width within the step item */
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px dashed #ddd;
            }

            .step-media-section .upload-input-hidden {
                display: none;
                /* Hide the default file input */
            }

            .step-media-section .file-upload-label {
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 5px;
                padding: 8px 15px;
                border-radius: 8px;
                font-weight: bold;
                transition: background-color 0.3s ease;
            }

            .step-media-section .file-upload-label:hover {
                opacity: 0.9;
            }

            .multiple-media-previews {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 10px;
            }

            .media-item {
                position: relative;
                border: 1px solid #eee;
                border-radius: 5px;
                padding: 5px;
                background-color: #fff;
            }

            .media-item img,
            .media-item video {
                display: block;
                max-width: 100px;
                max-height: 80px;
                object-fit: contain;
                border-radius: 3px;
            }

            .remove-single-media {
                position: absolute;
                top: -8px;
                right: -8px;
                background-color: #dc3545;
                color: white;
                border: none;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                padding: 0;
                font-size: 0.8rem;
                line-height: 1;
                text-align: center;
                cursor: pointer;
                transition: background-color 0.2s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .remove-single-media:hover {
                background-color: #c82333;
            }

            .step-media-actions {
                display: flex;
                gap: 5px;
                margin-top: 10px;
            }

            #remove-image {
                display: none;
                margin-top: 10px;
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 5px;
                cursor: pointer;
            }

            #remove-image:hover {
                background-color: #c82333;
            }

            span>span>textarea {
                font-family: 'cairo', sans-serif;
                text-align: center !important;
            }

            .dish-image-preview {
                max-width: 100%;
                max-height: 200px;
                margin-top: 10px;
                border-radius: 10px;
            }

            .text-fim {
                position: relative;
            }

            .w-8so {
                width: 100px;
            }

            .mx-33j {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    @endpush
</head>

<body class="bg-light">
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
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">إضافة وصفة </h4>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <form id="recipe-form" action="{{ route('c1he3f.recpies.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="chef_id" value="{{ auth()->user()->id }}">

                <div class="container">
                    <div class="bg-cookpad-gray-9gi p-6h1"
                        style="position: relative; height: 40vh; width: 80%; margin: auto; border-radius: 15px;">
                        <div style="top: 20%; text-align: center;"
                            class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                            <div class="text-fim">
                                <img name="dish_image" id="dish_image" accept="image/*"
                                    class="w-8so mx-33j pointer-events-j3t"
                                    src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-x8v font-9s7 mt-mnq">حمّل صورة الطبق إذا صوّرته</p>
                                <p class="text-b94 px-ql7">شاركنا صورة طبقك، كل شي من إيديك حلو</p>
                            </div>
                            <input type="file" name="dish_image" id="fil-ttd" accept="image/*">
                            @error('dish_image')
                                <div class="text-white mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <img id="image_preview" src="#" alt="معاينة الصورة" class="dish-image-preview"
                            style="display: none; width: 100%; height: 100%; position: absolute; top: 0px; right: 0px; border-radius: 17px;">

                    </div>
                    <button type="button" class="btn btn-danger" id="remove-image" style="margin-right: 58px; margin-top: 13px;">
                        حذف
                    </button>
                    <div class="my-3">
                        <input type="text" id="name" name="title"
                            style="text-align: center; color: #000000;"
                            placeholder="اسم الوصفة : مكرونة بالدجاج والكريمة للعشاء" class="form-control" required>
                        @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div class="my-3">
                            <label class="form-label" for="kitchen_type_id"
                                style="display: flex; justify-content: center;">نوع المطبخ</label>
                            <select class="form-select" name="kitchen_type_id" id="kitchen_type_id" required
                                style="width: 100%; text-align: center;">
                                <option value="">اختر المطبخ</option>
                                @foreach ($kitchens as $kitchen)
                                    <option value="{{ $kitchen->id }}"
                                        {{ old('kitchen_type_id') == $kitchen->id ? 'selected' : '' }}>
                                        {{ $kitchen->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kitchen_type_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="my-3">
                            <label class="form-label" style="display: flex; justify-content: center;">نوع
                                الوصفة</label>
                            <select class="form-select" name="is_free" id="is_free" required
                                style="width: 100%; text-align: center;">
                                <option value="">اختر نوع الوصفة</option>
                                <option value="1" {{ old('is_free') == '1' ? 'selected' : '' }}>مجانية</option>
                                <option value="0" {{ old('is_free') == '0' ? 'selected' : '' }}>مدفوعة</option>
                            </select>
                            @error('is_free')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="main_category_id" class="form-label">التصنيف الرئيسي</label>
                            <select class="form-control" name="main_category_id" id="main_category_id" required>
                                <option value="">اختر التصنيف الرئيسي</option>
                                @foreach ($mainCategories as $mainCategory)
                                    <option value="{{ $mainCategory->id }}"
                                        {{ old('main_category_id') == $mainCategory->id ? 'selected' : '' }}>
                                        {{ $mainCategory->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('main_category_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="id_sub_categories_container" >
                            <label for="sub_categories" class="form-label">التصنيفات الفرعية</label>
                            <select class="form-control select2" style="text-align: center;" name="sub_categories[]"
                                id="id_sub_categories" multiple="multiple" required>
                            </select>
                            @error('sub_categories')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">عدد الأشخاص</label>
                        <input type="number" id="servings" name="servings" value="{{ old('servings') }}"
                            min="1" required style="text-align: center; color: #000000;"
                            placeholder="عدد الأشخاص : 4" class="form-control">
                        @error('servings')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">وقت التحضير
                            (بالدقائق)</label>
                        <input type="number" id="preparation_time" name="preparation_time"
                            value="{{ old('preparation_time') }}" min="1" required
                            style="text-align: center; color: #000000;" placeholder="وقت التحضير : 30د"
                            class="form-control">
                        @error('preparation_time')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">الحالة</label>
                        <select class="form-select" name="status" id="status" required
                            style="width: 100%; text-align: center;">
                            <option value="">اختر الحالة</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غير فعال</option>
                        </select>
                        @error('status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="footer-fixed-btn bottom-0 bg-white">
                        <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">حفظ</button>
                    </div>
                </div>
            </form>
        </main>
         <!-- Main Content End -->

        <!-- Footer Fixed Button -->
        <!-- Footer Fixed Button -->
    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('index.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#id_sub_categories').select2({
                placeholder: 'اختر التصنيفات الفرعية',
                allowClear: true,
                dir: 'rtl'
            });

            // Handle subcategory loading
            $('#main_category_id').on('change', function() {
                const mainCategoryId = $(this).val();
                const subCategoriesContainer = $('#id_sub_categories_container');
                const subCategoriesSelect = $('#id_sub_categories');

                console.log('Main Category ID selected:', mainCategoryId);

                if (mainCategoryId) {
                    subCategoriesContainer.addClass('show');
                    subCategoriesSelect.empty().append('<option value="">جاري التحميل...</option>').trigger(
                        'change');

                    $.ajax({
                        url: '{{ route('c1he3f.recpies.subcategories') }}',
                        type: 'GET',
                        data: {
                            main_category_id: mainCategoryId
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('AJAX Response:', response);
                            subCategoriesSelect.empty();

                            if (response.length > 0) {
                                $.each(response, function(index, subCategory) {
                                    subCategoriesSelect.append(
                                        `<option value="${subCategory.id}">${subCategory.name_ar}</option>`
                                    );
                                });
                                @if (old('sub_categories'))
                                    const oldValues = @json(old('sub_categories'));
                                    subCategoriesSelect.val(oldValues).trigger('change');
                                @endif
                            } else {
                                subCategoriesSelect.append(
                                    '<option value="">لا توجد تصنيفات فرعية</option>');
                            }
                            subCategoriesSelect.trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', xhr.responseText);
                            subCategoriesSelect.empty().append(
                                '<option value="">حدث خطأ في التحميل</option>').trigger(
                                'change');
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                text: 'فشل تحميل التصنيفات الفرعية. حاول مرة أخرى.'
                            });
                        }
                    });
                } else {
                    subCategoriesContainer.removeClass('show');
                    subCategoriesSelect.empty().trigger('change');
                }
            });

            @if (old('main_category_id'))
                $('#main_category_id').trigger('change');
            @endif

            $(document).ready(function() {
                // Ensure remove button is hidden on page load
                $('#remove-image').hide();

                // Image preview functionality
                $('#fil-ttd').on('change', function() {
                    const file = this.files[0];
                    const imagePreview = $('#image_preview');
                    const defaultImage = $('#dish_image');
                    const removeButton = $('#remove-image');

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.attr('src', e.target.result).show();
                            defaultImage.hide();
                            removeButton.show();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.hide().attr('src', '#');
                        defaultImage.show();
                        removeButton.hide();
                    }
                });

                // Remove image functionality
                $('#remove-image').on('click', function() {
                    $('#fil-ttd').val('');
                    $('#image_preview').hide().attr('src', '#');
                    $('#dish_image').show();
                    $(this).hide();
                });
            });
        });
    </script>

</body>

</html>
