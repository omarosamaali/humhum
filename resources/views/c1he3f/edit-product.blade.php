@extends('layouts.chef')

@section('title', 'منتجاتي')
@section('content')

<!DOCTYPE html>

<html lang="en" dir="rtl">
<head>

    <title>منتجاتي</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" type="image/x-xicon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">

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

        /* input::placeholder {
            color: var(--primary) !important;
        } */

        .custom-tab-1 .nav-link {
            font-size: 14px;
            padding: 6.3px;

        }

        /* Added CSS for hidden class */
        .hidden {
            display: none;
        }

        /* Style for drag and drop area */
        .drop-area {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background-color: #f8f9fa;
        }

        .drop-area.highlight {
            background-color: #e3f2fd;
        }

    </style>

</head>

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
                <div class="mid-content">
                    <h4 class="title">تعديل المنتج </h4>
                </div>
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <main class="page-content space-top p-b100" style="direction: rtl; text-align: center;">
            <div class="container" style="text-align: center;">
                <h2>تعديل المنتج: {{ $product->name }}</h2>
                <form action="{{ route('c1he3f.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- مهم جدًا لتحديد طريقة PUT --}}

                    <div class="bg-cookpad-gray-9gi p-6h1" style="height: 40vh; width: 80%; margin: auto; border-radius: 15px; position: relative;">
                        @if ($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 100%; position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 15px;">
                        @endif
                        <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                            <div class="text-fim" style="position: relative; z-index: 1;">
                                <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-x8v font-9s7 mt-mnq">
                                    @if ($product->image_path)
                                    اضغط لتغيير الصورة
                                    @else
                                    حمّل الصورة الرئيسية لمنتجك
                                    @endif
                                </p>
                            </div>
                            <input type="file" name="image" id="fil-ttd" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer; z-index: 2;">
                        </div>
                    </div>

                    <div class="my-4">
                        <input type="text" id="product_name" name="name" style="text-align: center; color: #000000;" placeholder="عنوان المنتج" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="my-4">
                        <textarea id="product_description" name="description" style="text-align: center; color: #000000;" placeholder="وصف المنتج" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <h6 class="dz-title my-2">نوع المنتج</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="type" id="typePhysical" value="physical" {{ old('type', $product->type) == 'physical' ? 'checked' : '' }}>
                            <label class="form-check-label" for="typePhysical">
                                منتج
                            </label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="type" id="typeDigital" value="digital" {{ old('type', $product->type) == 'digital' ? 'checked' : '' }}>
                            <label class="form-check-label" for="typeDigital">
                                منتج رقمي
                            </label>
                        </div>
                    </div>

                    {{-- Digital File Upload Section --}}
                    <div id="digital-file-upload-section" class="my-4 hidden">
                        <label for="digital_file_input" class="dz-title my-2">ملف المنتج الرقمي</label>
                        <div id="digital-file-drop-area" class="drop-area">
                            <p>اسحب وأفلت ملف المنتج الرقمي هنا أو انقر للتحميل</p>
                            <input
                                value="{{ old('digital_file', $product->image_path) }}" type="file" name="digital_file_path" id="digital_file_input"

                            accept=".zip,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.mp3,.mp4" style="display: none;">
                            <button type="button" onclick="document.getElementById('digital_file_input').click()" class="btn btn-primary mt-2">اختر ملف</button>
                        </div>
                        <div id="digital-file-info" class="mt-2 text-center" style="color: #000000;">
                            @if ($product->digital_file_path)
                            الملف الحالي: {{ basename($product->digital_file_path) }}
                            @endif
                        </div>
                        <button type="button" id="remove-digital-file-btn" class="btn btn-danger btn-sm mt-2 {{ !$product->digital_file_path ? 'hidden' : '' }}">حذف الملف الحالي</button>
                    </div>

                    <div class="my-4">
                        <input type="number" step="0.01" id="base_price" name="base_price" style="text-align: center; color: #000000;" placeholder="السعر الأساسي للمنتج" class="form-control" value="{{ old('base_price', $product->base_price) }}" required>
                    </div>

                    <div class="my-4">
                        <label for="payment_gateway_fee">رسوم بوابة الدفع 
                        <span style="font-size: 13px; color: red !important;">
                            2.9% + 1 درهم 
                        </span>
                    </label>
                        <input type="text" id="payment_gateway_fee" name="payment_gateway_fee" style="text-align: center; color: #000000;" placeholder="" class="form-control" value="{{ old('payment_gateway_fee', $product->payment_gateway_fee) }}" readonly>
                    </div>

                    <div class="my-4">
                        <label for="selling_price">المبلغ الذي سوف تحصل عليه</label>
                        <input type="text" step="0.01" id="selling_price" name="selling_price" style="text-align: center; color: #000000;" placeholder="سعر البيع النهائي" class="form-control" value="{{ old('selling_price', $product->selling_price) }}" required readonly>
                    </div>
                    <h6 class="dz-title my-2">الحالة</h6>

                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="is_active" id="statusActive" value="1" {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusActive">
                                فعال
                            </label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="is_active" id="statusInactive" value="0" {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusInactive">
                                غير فعال
                            </label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 80%; margin: auto;">تحديث المنتج</button>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('c1he3f.my-products') }}" class="btn btn-secondary btn-block" style="width: 80%; margin: auto;">إلغاء</a>
                    </div>
                </form>
            </div>
        </main>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typePhysical = document.getElementById('typePhysical');
            const typeDigital = document.getElementById('typeDigital');
            const digitalFileUploadSection = document.getElementById('digital-file-upload-section');
            const digitalFileInput = document.getElementById('digital_file_input');
            const digitalFileDropArea = document.getElementById('digital-file-drop-area');
            const digitalFileInfo = document.getElementById('digital-file-info');
            const removeDigitalFileBtn = document.getElementById('remove-digital-file-btn');
            const basePriceInput = document.getElementById('base_price');
            const paymentGatewayFeeInput = document.getElementById('payment_gateway_fee');
            const sellingPriceInput = document.getElementById('selling_price');

            // Function to toggle digital file upload section visibility
            function toggleDigitalFileUploadSection() {
                if (typeDigital && typeDigital.checked) {
                    if (digitalFileUploadSection) digitalFileUploadSection.classList.remove('hidden');
                    // Mark digital_file as required only if it's currently digital and no file is present
                    if (digitalFileInput && !digitalFileInfo.textContent.includes('الملف الحالي:') && digitalFileInput.files.length === 0) {
                        digitalFileInput.setAttribute('required', 'required');
                    }
                } else {
                    if (digitalFileUploadSection) digitalFileUploadSection.classList.add('hidden');
                    if (digitalFileInput) digitalFileInput.removeAttribute('required');
                    // Don't clear digitalFileInput.value or digitalFileInfo.textContent here
                    // if it's just being hidden, as the user might switch back.
                    // It should only be cleared if the user explicitly removes the file
                    // or switches from digital to physical and wants to discard the digital file.
                }
            }

            // Event listeners for product type change
            if (typePhysical) typePhysical.addEventListener('change', toggleDigitalFileUploadSection);
            if (typeDigital) typeDigital.addEventListener('change', toggleDigitalFileUploadSection);

            // Initial call to set visibility based on default checked radio
            toggleDigitalFileUploadSection();

            // Handle digital file input change
            if (digitalFileInput) {
                digitalFileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        const file = this.files[0];
                        if (digitalFileInfo) digitalFileInfo.textContent = `الملف المختار: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                        if (removeDigitalFileBtn) removeDigitalFileBtn.classList.remove('hidden');
                        digitalFileInput.removeAttribute('required'); // File selected, so not required anymore
                    } else {
                        if (digitalFileInfo) digitalFileInfo.textContent = '';
                        if (removeDigitalFileBtn) removeDigitalFileBtn.classList.add('hidden');
                        if (typeDigital.checked) { // Only make it required if digital is selected and no file
                            digitalFileInput.setAttribute('required', 'required');
                        }
                    }
                });
            }

            // Handle remove digital file button click
            if (removeDigitalFileBtn) {
                removeDigitalFileBtn.addEventListener('click', function() {
                    if (digitalFileInput) digitalFileInput.value = ''; // Clear the input
                    if (digitalFileInfo) digitalFileInfo.textContent = ''; // Clear the info text
                    removeDigitalFileBtn.classList.add('hidden');
                    if (typeDigital.checked) { // If digital is still selected, make it required again
                        digitalFileInput.setAttribute('required', 'required');
                    }
                });
            }

            // Drag and drop for digital file
            if (digitalFileDropArea) {
                digitalFileDropArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    digitalFileDropArea.classList.add('highlight');
                });

                digitalFileDropArea.addEventListener('dragleave', () => {
                    digitalFileDropArea.classList.remove('highlight');
                });

                digitalFileDropArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    digitalFileDropArea.classList.remove('highlight');
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        if (digitalFileInput) digitalFileInput.files = files;
                        const event = new Event('change', {
                            bubbles: true
                        });
                        if (digitalFileInput) digitalFileInput.dispatchEvent(event);
                    }
                });
            }

            // Price Calculation Logic
            function calculatePrices() {
                const basePrice = parseFloat(basePriceInput.value);
                if (isNaN(basePrice) || basePrice < 0) {
                    paymentGatewayFeeInput.value = '0.00';
                    sellingPriceInput.value = '0.00';
                    return;
                }

                const feePercentage = 0.029; // 2.9%
                const fixedFee = 1.00; // 1 AED

                // Calculate the payment gateway fee
                const paymentGatewayFee = (basePrice * feePercentage) + fixedFee;

                // Calculate the final selling price (base price minus fees)
                const sellingPrice = basePrice - paymentGatewayFee;

                paymentGatewayFeeInput.value = paymentGatewayFee.toFixed(2);
                sellingPriceInput.value = sellingPrice.toFixed(2);
            }

            // Event listener for base price input changes
            if (basePriceInput) {
                basePriceInput.addEventListener('input', calculatePrices);
            }

            // Initial calculation on page load if a default base price is set
            if (basePriceInput) {
                calculatePrices();
            }

            // SweetAlert2 helper function (can also be moved to a global JS file)
            function showMessage(title, message, icon) {
                Swal.fire({
                    title: title
                    , text: message
                    , icon: icon
                    , confirmButtonText: 'حسناً'
                });
            }
        });

    </script>


</body>

@endsection
