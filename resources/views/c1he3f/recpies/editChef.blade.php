<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>واجهة الطاهي</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
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
        #remove-image {
            display: block !important;
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
            color: var(--primary) !important;
        }

        .custom-tab-1 .nav-link {
            font-size: 14px;
            padding: 6.3px;

        }

    </style>
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
                    <h4 class="title">تعديل وصفة </h4>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <div class="container">
                <form action="{{ route('c1he3f.recipes.updateChef', $recipe) }}" method="POST" id="recipe-update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="bg-cookpad-gray-9gi p-6h1" style="position: relative; height: 40vh; width: 80%; margin: auto; border-radius: 15px;">
                        <div style="top: 20%; text-align: center;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                            <div class="text-fim">
                                <img name="dish_image" id="dish_image" accept="image/*" class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-x8v font-9s7 mt-mnq">حمّل صورة الطبق إذا صوّرته</p>
                                <p class="text-b94 px-ql7">شاركنا صورة طبقك، كل شي من إيديك حلو</p>
                            </div>
                            <input type="file" name="dish_image" id="fil-ttd" accept="image/*">
                            @error('dish_image')
                            <div class="text-white mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <img src="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : 'https://via.placeholder.com/740' }}" value="{{ asset('storage/' . $recipe->dish_image) }}" id="image_preview" src="#" alt="معاينة الصورة" class="dish-image-preview" style="width: 100%; height: 100%; position: absolute; top: 0px; right: 0px; border-radius: 17px;">
                    </div>
                    @if(! $recipe->dish_image !== null)
                    <button type="button" class="btn btn-danger" id="remove-image" style="display: block !important; margin-right: 58px; margin-top: 13px;">
                        حذف
                    </button>
                    @endif
                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">اسم الوصفة</label>
                        <input type="text" name="title" style="text-align: center; color: #000000;" placeholder="اسم الوصفة: مكرونة بالدجاج والكريمة للعشاء" value="{{ old('title', $recipe->title) }}" class="form-control">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">نوع المطبخ</label>
                        <select class="form-select" name="kitchen_type_id" style="width: 100%; text-align: center;" id="kitchen_type_id">
                            <option value="">اختر المطبخ</option>
                            @foreach ($kitchens as $kitchen)
                            <option value="{{ $kitchen->id }}" {{ old('kitchen_type_id', $recipe->kitchen_type_id) == $kitchen->id ? 'selected' : '' }}>
                                {{ $kitchen->name_ar }}
                            </option>
                            @endforeach
                        </select>
                        @error('kitchen_type_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">نوع الوصفة</label>
                        <select class="form-select" name="is_free" style="width: 100%; text-align: center;">
                            <option value="">اختر نوع الوصفة</option>
                            <option value="1" {{ old('is_free', $recipe->is_free) == 1 ? 'selected' : '' }}>مجانية</option>
                            <option value="0" {{ old('is_free', $recipe->is_free) == 0 ? 'selected' : '' }}>مدفوعة</option>
                        </select>
                        @error('is_free')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="main_category_id" class="form-label">التصنيف الرئيسي</label>
                        <select class="form-control" name="main_category_id" id="main_category_id" required>
                            <option value="" {{ old('main_category_id', $recipe->mainCategories?->id) ? '' : 'selected' }}>اختر تصنيف</option>
                            @foreach ($mainCategories as $mainCategory)
                            <option value="{{ $mainCategory->id }}" {{ old('main_category_id', $recipe->mainCategories?->id == $mainCategory?->id ? 'selected' : '') }}>
                                {{ $mainCategory->name_ar }}
                            </option>
                            @endforeach
                        </select>
                        @error('main_category_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3" id="id_sub_categories_container">
                        <label for="sub_categories" class="form-label">التصنيفات الفرعية</label>
                        <select class="form-control select2" style="text-align: center;" name="sub_categories[]" id="id_sub_categories" multiple="multiple" required>
                            @foreach ($recipe->subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}" selected>{{ $subCategory->name_ar }}</option>
                            @endforeach
                        </select>
                        @error('sub_categories')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Servings -->
                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">عدد الأشخاص</label>
                        <input type="number" name="servings" style="text-align: center; color: #000000;" placeholder="عدد الأشخاص: 4" value="{{ old('servings', $recipe->servings) }}" class="form-control" min="1">
                        @error('servings')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preparation Time -->
                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">وقت التحضير (بالدقائق)</label>
                        <input type="number" name="preparation_time" style="text-align: center; color: #000000;" placeholder="وقت التحضير: 30د" value="{{ old('preparation_time', $recipe->preparation_time) }}" class="form-control" min="1">
                        @error('preparation_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="my-3">
                        <label class="form-label" style="display: flex; justify-content: center;">الحالة</label>
                        <select class="form-select" name="status" style="width: 100%; text-align: center;">
                            <option value="">اختر الحالة</option>
                            <option value="1" {{ old('status', $recipe->status) == 1 ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ old('status', $recipe->status) == 0 ? 'selected' : '' }}>غير فعال</option>
                        </select>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="my-3 text-center">
                        <button type="submit" class="btn btn-primary">تحديث الوصفة</button>
                    </div>
                </form>
            </div>
        </main>

    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wnumb/wNumb.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/noui-slider.init.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/index.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            console.log('Document ready - initializing...');
            console.log('Main category element:', $('#main_category_id').length);
            console.log('Sub categories element:', $('#id_sub_categories').length);
            console.log('Container element:', $('#id_sub_categories_container').length);

            // Initialize Select2
            if ($('#id_sub_categories').length > 0) {
                $('#id_sub_categories').select2({
                    placeholder: 'اختر التصنيفات الفرعية'
                    , allowClear: true
                    , dir: 'rtl'
                });
                console.log('Select2 initialized');
            } else {
                console.error('Sub categories select element not found!');
            }

            // Handle subcategory loading
            $('#main_category_id').on('change', function() {
                console.log('Main category changed event fired');

                const mainCategoryId = $(this).val();
                const subCategoriesContainer = $('#id_sub_categories_container');
                const subCategoriesSelect = $('#id_sub_categories');

                console.log('Main Category ID selected:', mainCategoryId);
                console.log('Container element found:', subCategoriesContainer.length);
                console.log('Select element found:', subCategoriesSelect.length);

                if (mainCategoryId) {
                    console.log('Main category ID is valid, proceeding...');
                    subCategoriesContainer.show();
                    subCategoriesSelect.empty()
                        .append('<option value="">جاري التحميل...</option>')
                        .trigger('change');
                    console.log('Loading message added');
                    const ajaxUrl = '{{ route("c1he3f.recpies.subcategories") }}';
                    console.log('AJAX URL:', ajaxUrl);
                    $.ajax({
                        url: ajaxUrl
                        , type: 'GET'
                        , data: {
                            category_id: mainCategoryId
                        }
                        , headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , beforeSend: function() {
                            console.log('Sending AJAX request...');
                            console.log('Request data:', {
                                category_id: mainCategoryId
                            });
                        }
                        , success: function(response) {
                            console.log('AJAX Success!');
                            console.log('Response type:', typeof response);
                            console.log('Response data:', response);
                            console.log('Response length:', response ? response.length : 'N/A');
                            subCategoriesSelect.empty();
                            if (response && response.length > 0) {
                                console.log('Adding subcategories...');
                                $.each(response, function(index, subCategory) {
                                    console.log('Adding subcategory:', subCategory);
                                    subCategoriesSelect.append(
                                        `<option value="${subCategory.id}">${subCategory.name_ar}</option>`
                                    );
                                });
                                @if(old('sub_categories'))
                                const oldValues = @json(old('sub_categories'));
                                console.log('Old values:', oldValues);
                                subCategoriesSelect.val(oldValues);
                                @endif
                            } else {
                                console.log('No subcategories found');
                                subCategoriesSelect.append(
                                    '<option value="">لا توجد تصنيفات فرعية</option>'
                                );
                            }

                            // تحديث Select2
                            subCategoriesSelect.trigger('change');
                            console.log('Select2 updated');
                        }
                        , error: function(xhr, status, error) {
                            console.error('AJAX Error!');
                            console.error('Status:', status);
                            console.error('Error:', error);
                            console.error('Status Code:', xhr.status);
                            console.error('Response Text:', xhr.responseText);
                            console.error('Ready State:', xhr.readyState);

                            subCategoriesSelect.empty()
                                .append('<option value="">حدث خطأ في التحميل</option>')
                                .trigger('change');

                            // إظهار رسالة خطأ مفصلة
                            let errorMessage = 'فشل تحميل التصنيفات الفرعية: ';
                            if (xhr.status === 404) {
                                errorMessage += 'الرابط المطلوب غير موجود (404)';
                            } else if (xhr.status === 500) {
                                errorMessage += 'خطأ في الخادم (500)';
                            } else if (xhr.status === 0) {
                                errorMessage += 'لا يوجد اتصال بالخادم';
                            } else {
                                errorMessage += `خطأ غير معروف (${xhr.status})`;
                            }

                            alert(errorMessage); // استخدم alert بدلاً من Swal للتبسيط
                        }
                    });
                } else {
                    console.log('No main category selected, hiding container');
                    // إخفاء حاوية التصنيفات الفرعية
                    subCategoriesContainer.hide(); // استخدم hide() بدلاً من removeClass('show')
                    subCategoriesSelect.empty().trigger('change');
                }
            });

            // تحميل التصنيفات الفرعية إذا كان هناك تصنيف رئيسي محدد مسبقاً
            @if(old('main_category_id'))
            console.log('Triggering change for old main category');
            $('#main_category_id').trigger('change');
            @endif

            // Image preview functionality
            $('#fil-ttd').on('change', function() {
                console.log('File input changed');
                const file = this.files[0];
                const imagePreview = $('#image_preview');
                const defaultImage = $('#dish_image');
                const removeButton = $('#remove-image');

                if (file) {
                    console.log('File selected:', file.name);
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.attr('src', e.target.result).show();
                        defaultImage.hide();
                        removeButton.show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    console.log('No file selected');
                    imagePreview.hide().attr('src', '#');
                    defaultImage.show();
                    removeButton.hide();
                }
            });

            // Remove image functionality
            $('#remove-image').on('click', function() {
                console.log('Remove image clicked');
                $('#fil-ttd').val('');
                $('#image_preview').hide().attr('src', '#');
                $('#dish_image').show();
                $(this).hide();
            }).hide(); // إخفاء الزر عند تحميل الصفحة
        });

    </script>



    </div>
</body>
</html>
