<!DOCTYPE html>
<html lang="en" dir="rtl">

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
            background-color: #667eea;
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

    <style>
        :root {
            --primary: #dc3545;
            --secondary: #f8f9fa;
            --danger: #dc3545;
            --success: #28a745;
            --light: #fff;
            --dark: #333;
            --border: #e9ecef;
        }

        body {
            font-family: 'Poppins', 'Noto Naskh Arabic', 'Noto Sans Arabic', sans-serif;
            font-size: 17px;
            line-height: 1.5;
            background-color: #f5f5f5;
            color: #4a4a4a;
            direction: rtl;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            background-color: var(--light);
            border-bottom: 1px solid var(--border);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 60px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            height: 100%;
        }

        .header .title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }

        .back-btn {
            color: var(--primary);
            text-decoration: none;
            font-size: 18px;
        }

        /* Main Content */
        .page-content {
            padding-top: 80px;
            padding-bottom: 100px;
            padding-left: 20px;
            padding-right: 20px;
        }

        /* Ingredient Item Styles */
        .ingredient-item {
            background-color: var(--light);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .ingredient-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .ingredient-type-indicator {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .ingredient-text {
            width: 100%;
            border: 2px solid var(--border);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            background-color: #fafafa;
        }

        .ingredient-text:focus {
            outline: none;
            border-color: var(--primary);
            background-color: var(--light);
        }

        .ingredient-text::placeholder {
            color: #999;
        }

        .char-counter {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            display: block;
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-group {
            display: flex;
            gap: 8px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .btn-is-heading,
        .btn-is-ingredient {
            background-color: #f8f9fa;
            border: 2px solid var(--border);
            color: var(--dark);
            padding: 8px 12px;
            font-size: 14px;
        }

        .btn-is-heading.active,
        .btn-is-ingredient.active {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-outline-secondary {
            border: 1px solid var(--border);
            color: #666;
            padding: 6px 10px;
        }

        .btn-outline-secondary:hover {
            background-color: var(--secondary);
            border-color: var(--border);
        }

        .remove-ingredient-btn {
            background-color: var(--danger);
            border: none;
            color: white;
            padding: 8px 12px;
            margin-top: 10px;
        }

        .remove-ingredient-btn:hover {
            background-color: #c82333;
        }

        .order-buttons {
            margin-top: 10px;
        }

        /* Add Ingredient Button */
        #add-ingredient {
            background-color: var(--primary);
            border: none;
            color: white;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
            margin: 20px 0;
            transition: all 0.3s ease;
        }

        #add-ingredient:hover {
            background-color: #e6651f;
            transform: translateY(-2px);
        }

        /* Footer Fixed Button */
        .footer-fixed-btn {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px 20px;
            background-color: var(--light);
            border-top: 1px solid var(--border);
            z-index: 1000;
            transform: unset;
        }

        .footer-fixed-btn .btn {
            background-color: var(--success);
            border: none;
            color: white;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
        }

        .footer-fixed-btn .btn:hover {
            background-color: #218838;
        }

        /* Drag Handle */
        .handle {
            cursor: grab;
            color: #999;
            font-size: 18px;
            margin-left: 10px;
            display: inline-block;
            vertical-align: middle;
        }

        .handle:active {
            cursor: grabbing;
        }

        /* Sortable Placeholder */
        .ui-state-highlight {
            height: 80px;
            background-color: #f0f0f0;
            border: 2px dashed #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* Alert Styles */
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Form Check Styles */
        .form-check {
            margin-top: 15px;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            font-size: 14px;
            color: var(--dark);
            margin-right: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-content {
                padding-left: 15px;
                padding-right: 15px;
            }

            .ingredient-item {
                padding: 15px;
            }

            .btn-group {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-group .btn {
                margin-bottom: 5px;
            }
        }

        .btn-group .btn {
            width: fit-content;
        }
    </style>
</head>

<body class="bg-light">
    <div class="page-wrapper">
        <header class="header">
            <div class="header-content">
                <div class="mid-content">
                    <h4 class="title">تعديل المكونات</h4>
                </div>
                <div class="left-content">
                    <a href="javascript:history.back()" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="right-content">
                </div>
            </div>
        </header>

        <main class="page-content" style="margin-top: 15px;">
            <div id="success-message" class="alert alert-success" style="display: none;"></div>
            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
            <form id="ingredientsForm" method="POST" action="{{ route('c1he3f.recpies.updateIngredients', $recipe->id) }}">
                @csrf
                @method('PUT')
                <div id="ingredients-list" class="ingredients-container"></div>
                <input type="hidden" name="ingredients_data" id="ingredients_data">
                <button type="button" class="btn btn-primary" id="add-ingredient">
                    <i class="fas fa-plus"></i> إضافة مكون جديد
                </button>
            </form>
        </main>

        <div class="footer-fixed-btn">
            <button type="submit" form="ingredientsForm" class="btn btn-success w-100">
                حفظ المكونات
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const MAX_CHARS_INGREDIENT = 100;
            let ingredientIndex = 0;

            function createIngredientItem(description = '', isHeading = false) {
                const newIndex = ingredientIndex++;
                const ingredientHtml = `
            <div class="ingredient-item" data-index="${newIndex}" data-type="${isHeading ? 'heading' : 'ingredient'}">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <span class="ingredient-type-indicator">${isHeading ? 'عنوان' : 'مكون'}</span>
                        <input type="text" class="form-control ingredient-text mb-2"
                               name="ingredients[${newIndex}][description]"
                               placeholder="وصف المكون (مثال: 1 كوب دقيق)"
                               value="${description}"
                               maxlength="${MAX_CHARS_INGREDIENT}">
                        <span class="char-counter">متبقي: ${MAX_CHARS_INGREDIENT - description.length} حرف</span>
                        <input type="hidden" class="is-heading-input" name="ingredients[${newIndex}][is_heading]" value="${isHeading ? '1' : '0'}">
                        <div class="btn-group ingredient-buttons" role="group">
                            <div style="display: flex; gap: 8px;">
                                <button type="button" class="btn btn-sm btn-is-heading ${isHeading ? 'active' : ''}" data-type="heading">عنوان</button>
                                <button type="button" class="btn btn-sm btn-is-ingredient ${!isHeading ? 'active' : ''}" data-type="ingredient">مكون</button>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="button" class="btn btn-sm btn-outline-secondary move-up-btn" title="تحريك لأعلى">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 19V5M5 12l7-7 7 7"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary move-down-btn" title="تحريك لأسفل">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5v14M19 12l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-sm remove-ingredient-btn" title="حذف المكون">حذف</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
                $('#ingredients-list').append(ingredientHtml);
                $('#no-ingredients-message').remove();
                setupIngredientItemEvents(newIndex);
                return newIndex;
            }

            function setupIngredientItemEvents(index) {
                const item = $(`.ingredient-item[data-index="${index}"]`);
                const input = item.find('.ingredient-text');
                const charCounter = item.find('.char-counter');
                const typeIndicator = item.find('.ingredient-type-indicator');
                const isHeadingHiddenInput = item.find('.is-heading-input');

                input.on('input', function() {
                    const remaining = MAX_CHARS_INGREDIENT - $(this).val().length;
                    charCounter.text(`متبقي: ${remaining} حرف`);
                });

                item.find('.btn-is-heading').on('click', function() {
                    item.attr('data-type', 'heading');
                    typeIndicator.text('عنوان');
                    $(this).addClass('active');
                    item.find('.btn-is-ingredient').removeClass('active');
                    isHeadingHiddenInput.val('1');
                });

                item.find('.btn-is-ingredient').on('click', function() {
                    item.attr('data-type', 'ingredient');
                    typeIndicator.text('مكون');
                    $(this).addClass('active');
                    item.find('.btn-is-heading').removeClass('active');
                    isHeadingHiddenInput.val('0');
                });

                item.find('.remove-ingredient-btn').on('click', function() {
                    item.remove();
                    if ($('#ingredients-list .ingredient-item').length === 0) {
                        $('#ingredients-list').append(
                            '<p id="no-ingredients-message">لا توجد مكونات بعد.</p>');
                    }
                });

                item.find('.move-up-btn').on('click', function() {
                    const prev = item.prev('.ingredient-item');
                    if (prev.length) {
                        item.insertBefore(prev);
                    }
                });

                item.find('.move-down-btn').on('click', function() {
                    const next = item.next('.ingredient-item');
                    if (next.length) {
                        item.insertAfter(next);
                    }
                });
            }

            $('#add-ingredient').on('click', function() {
                createIngredientItem();
            });

            $("#ingredients-list").sortable({
                handle: ".handle"
                , placeholder: "ui-state-highlight"
                , axis: "y"
                , update: function(event, ui) {}
            });

            $('#ingredientsForm').on('submit', function(e) {
                const ingredients = [];
                $('#ingredients-list .ingredient-item').each(function() {
                    const description = $(this).find('.ingredient-text').val();
                    const isHeading = $(this).find('.is-heading-input').val() === '1';
                    if (description.trim()) {
                        ingredients.push({
                            description: description
                            , is_heading: isHeading
                        });
                    }
                });
                $('#ingredients_data').val(JSON.stringify(ingredients));
            });

            // *********************************************************************
            // * تعديل هذا الجزء لتحويل النص من قاعدة البيانات إلى مصفوفة JSON    *
            // *********************************************************************
            @if(isset($recipe -> ingredients) && !empty($recipe -> ingredients))
            @php
            $parsedIngredients = [];
            $lines = explode("\n", $recipe -> ingredients);
            foreach($lines as $line) {
                $trimmedLine = trim($line);
                if (!empty($trimmedLine)) {
                    $isHeading = Str::startsWith($trimmedLine, '##');
                    $description = $isHeading ? Str::replaceFirst('##', '', $trimmedLine) : $trimmedLine;
                    $parsedIngredients[] = [
                        'description' => $description
                        , 'is_heading' => $isHeading
                    , ];
                }
            }
            @endphp
            const initialIngredients = @json($parsedIngredients);
            initialIngredients.forEach(function(ing) {
                createIngredientItem(ing.description, ing.is_heading);
            });
            @else
            // إذا لم تكن هناك مكونات محفوظة، أضف عنصرًا واحدًا افتراضيًا
            if ($('#ingredients-list .ingredient-item').length === 0) {
                createIngredientItem();
            }
            @endif

            $('#ingredients-list .ingredient-item').each(function() {
                const index = $(this).data('index');
                if (index >= ingredientIndex) {
                    ingredientIndex = index + 1;
                }
                setupIngredientItemEvents(index);
            });
        });

    </script>
</body>


</html>
