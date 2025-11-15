@extends('layouts.chef')
@section('title', 'إضافة هم هم سناب')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<!-- HTML محسن مع تصميم أجمل -->

<!-- CSS مدمج لتحسين المظهر -->
<style>
    /* تصميم القائمة المنسدلة */
    .subcategory-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .subcategory-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        outline: none;
    }

    /* حاوي التصنيفات المختارة */
    .selected-subcategories-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 20px;
        min-height: 60px;
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .selected-subcategories-container:before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #007bff, #28a745, #ffc107, #dc3545);
        border-radius: 15px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .selected-subcategories-container.has-items:before {
        opacity: 0.1;
    }

    .selected-subcategories-container.has-items {
        border-color: #007bff;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    /* عنوان التصنيفات المختارة */
    .selected-title {
        font-size: 16px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .selected-title:before {
        content: '✓';
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    /* تصميم البادجات */
    .subcategory-badge {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        padding: 8px 12px;
        margin: 4px 6px 4px 0;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        transition: all 0.3s ease;
        animation: slideInRight 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .subcategory-badge:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .subcategory-badge:hover:before {
        left: 100%;
    }

    .subcategory-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
    }

    /* زر الحذف */
    .remove-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
        transition: all 0.2s ease;
    }

    .remove-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    /* رسالة فارغة */
    .empty-message {
        text-align: center;
        color: #6c757d;
        font-style: italic;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .empty-message:before {
        content: '📂';
        font-size: 32px;
        opacity: 0.5;
    }

    /* أنيميشن الدخول */
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* أنيميشن الخروج */
    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(20px);
        }
    }

    .removing {
        animation: slideOutRight 0.3s ease forwards;
    }

    /* تحسين Select2 */
    .select2-container--default .select2-selection--single {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        height: 48px;
        padding: 0 15px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 44px;
        color: #495057;
        padding-left: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 44px;
        right: 15px;
    }

    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .subcategory-badge {
            font-size: 13px;
            padding: 6px 10px;
            margin: 3px 4px 3px 0;
        }

        .selected-subcategories-container {
            padding: 15px;
        }
    }

    /* تأثير التحميل */
    .loading-state {
        position: relative;
        opacity: 0.7;
    }

    .loading-state:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        transform: translate(-50%, -50%);
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

</style>

<style>
    /* أضف هذه الأنماط إلى الـ CSS الموجود */

    .message-container {
        margin: 15px 0;
        text-align: center;
        min-height: 20px;
        /* لضمان وجود مساحة للرسائل */
        position: relative;
        z-index: 10;
    }

    .loading-message {
        color: #004085;
        background-color: #cce5ff;
        border: 1px solid #b8daff;
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        position: relative;
        animation: fadeIn 0.3s ease-in;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .error-message {
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        padding: 12px;
        border-radius: 8px;
        display: flex !important;
        justify-content: space-between;
        font-weight: 500;
        position: relative;
        animation: fadeIn 0.3s ease-in;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .success-message {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        position: relative;
        animation: fadeIn 0.3s ease-in;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* زر الإغلاق */
    .error-message button,
    .success-message button {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        padding: 2px 8px;
        margin-left: 10px;
        border-radius: 50%;
        transition: background-color 0.2s;
    }

    .error-message button:hover {
        background-color: rgba(114, 28, 36, 0.1);
    }

    .success-message button:hover {
        background-color: rgba(21, 87, 36, 0.1);
    }

    /* تأثير الظهور */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* تحسينات للتصنيفات الفرعية */
    .selected-items-container {
        margin-top: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        min-height: 20px;
    }

    .selected-items-container.empty {
        display: none;
    }

    .subcategory-counter {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #495057;
        font-size: 14px;
    }

    .selected-item {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 6px 12px;
        margin: 4px;
        border-radius: 20px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .selected-item.removing {
        opacity: 0;
        transform: scale(0.8);
    }

    .selected-item .remove-btn {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        margin-left: 8px;
        cursor: pointer;
        padding: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s;
    }

    .selected-item .remove-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* تحسينات شريط التقدم */
    .progress-bar {
        width: 100%;
        height: 12px;
        background-color: #f0f0f0;
        border-radius: 6px;
        overflow: hidden;
        margin: 15px 0;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .progress-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #007bff, #0056b3);
        transition: width 0.3s ease;
        border-radius: 6px;
    }

    /* إخفاء العناصر */
    .hidden {
        display: none !important;
    }

    /* تحسينات منطقة الرفع */
    .upload-area {
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: #f8f9fa;
    }

    .upload-area:hover {
        background-color: #e9ecef;
        border-color: #007bff;
    }

    /* تحسينات معاينة الفيديو */
    .video-preview {
        margin: 20px 0;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }

    .video-controls {
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .video-info {
        flex: 1;
        min-width: 200px;
    }

    .video-controls .btn {
        flex-shrink: 0;
    }

    /* تحسينات الاستجابة للأجهزة المحمولة */
    @media (max-width: 768px) {
        .video-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .video-info {
            text-align: center;
            margin-bottom: 10px;
        }

        .selected-item {
            display: block;
            margin: 5px 0;
            text-align: center;
        }

        .message-container {
            margin: 10px 0;
        }
    }

    /* إضافة هذا CSS */

    .selected-items-container {
        min-height: 40px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-top: 10px;
    }

    .selected-items-container:empty {
        display: none;
    }

    .badge {
        font-size: 14px !important;
        padding: 8px 12px !important;
    }

    .badge .btn-close {
        margin-left: 8px;
        font-size: 12px;
        cursor: pointer;
        border: none;
        background: none;
        color: white;
        opacity: 0.8;
    }

    .badge .btn-close:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    /* تحسين Select2 */
    .select2-container {
        width: 100% !important;
    }

    .select2-selection {
        height: 45px !important;
        border-radius: 8px !important;
    }

    .select2-selection__rendered {
        line-height: 45px !important;
        padding-right: 12px !important;
    }

    .select2-selection__arrow {
        height: 45px !important;
    }

    /* رسائل الخطأ والنجاح */
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px;
        border-radius: 8px;
        margin: 10px 0;
        border: 1px solid #f5c6cb;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin: 10px 0;
        border: 1px solid #c3e6cb;
    }

    .loading-message {
        background-color: #d1ecf1;
        color: #0c5460;
        padding: 12px;
        border-radius: 8px;
        margin: 10px 0;
        border: 1px solid #bee5eb;
    }

</style>
<body class="bg-light">
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status"> <span class="visually-hidden">Loading...</span> </div>
            </div>
        </div>
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content"> <a href="{{ url()->previous() ?: route('home') }}" id="back-btn"> <i class="feather icon-arrow-left"></i> </a> </div>
                <div class="mid-content">
                    <h4 class="title">عدسة الطاهي - إضافة</h4>
                </div>
            </div>
        </header>
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <div class="container">
                <div class="container" style="max-width: 800px; margin:0px auto; padding: 20px;">
                    <form action="{{ route('c1he3f.snaps.store-snap') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                        @csrf
                        <div class="bg-cookpad-gray-9gi p-6h1 upload-area" id="upload-area" style="height: 280px; width: 80%; margin: auto; border-radius: 15px; border: 2px dashed #dee2e6;">
                            <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                                <div class="text-fim">
                                    <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                    <p class="text-x8v font-9s7 mt-mnq">أضف الفيديو الذي تريد مشاركته</p>
                                    <p class="text-b94 px-ql7">يجب علي الفيديو ان لا يزيد عن 60 ثانية</p>
                                </div>
                                <input type="file" name="video" id="fil-ttd" accept="video/*" style="display: none;">
                            </div>
                        </div>
                        <div id="message-container"></div>
                        <div class="progress-bar hidden" id="progress-bar">
                            <div class="progress-fill" id="progress-fill"></div>
                        </div>
                        <div class="video-preview hidden" id="video-preview">
                            <video id="preview-video" style="height: 280px; width: 100%;" controls>
                                <source src="" type="video/mp4"> متصفحك لا يدعم تشغيل الفيديو.
                            </video>
                            <div class="video-controls">
                                <div class="video-info" id="video-info">
                                    <strong>معلومات الفيديو:</strong><br>
                                    <span id="video-duration"></span><br>
                                    <span id="video-size"></span>
                                </div>
                                <button type="button" class="btn btn-danger" onclick="removeVideo()">إزالة الفيديو</button>
                            </div>
                        </div>
                        <div class="my-3">
                            <input type="text" id="name" name="name" style="height: 98px; text-align: center; color: #000000;" placeholder="ماذا تريد ان تقول للمستخدمين" class="form-control" required>
                        </div>
                        <div class="my-3">
                            <div class="form-group">
                                <label for="kitchen-search" style="text-align: center; display: block; margin-bottom: 5px;">إختر المطبخ</label>
                                <select class="form-control" id="kitchen-search" name="kitchen_id" style="width: 100%;">
                                    <option value="">إختر مطبخ</option>
                                    @foreach($kitchens as $kitchen)
                                    <option value="{{ $kitchen->id }}">{{ $kitchen->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <style>
                                .form-control {
                                    height: auto;
                                    min-height: 38px;
                                    padding: 6px 12px;
                                    font-size: 16px;
                                    border: 1px solid #ced4da;
                                    border-radius: 4px;
                                    background-color: white;
                                }

                                #subCategory-search {
                                    width: 100%;
                                    max-height: 200px;
                                    overflow-y: auto;
                                }

                                .badge {
                                    display: inline-flex;
                                    align-items: center;
                                    font-size: 14px;
                                    padding: 6px 10px;
                                    margin: 2px;
                                }

                                .btn-close {
                                    padding: 0;
                                    font-size: 1rem;
                                    line-height: 1;
                                    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
                                    border: none;
                                    opacity: .5;
                                }

                                .btn-close:hover {
                                    opacity: .75;
                                }

                            </style>

                            <div class="form-group">
                                <label for="mainCategorie-search" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">اختر التصنيف الرئيسي</label>
                                <select class="form-control" id="mainCategorie-search" name="main_category_id" style="width: 100%;">
                                    <option value="">إختر التصنيف الرئيسي</option>
                                    @foreach($mainCategories as $mainCategorie)
                                    <option value="{{ $mainCategorie->id }}">{{ $mainCategorie->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subCategory-search" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">اختر التصنيفات الفرعية</label>
                                <select class="form-control" id="subCategory-search" name="subCategory_ids[]" multiple style="width: 100%;">
                                    <option value="">إختر التصنيف الفرعي</option>
                                </select>
                                <div id="selected-subcategories" class="selected-items-container mt-3"></div>
                                <div id="hidden-subcategories-inputs"></div>
                            </div>

                            <div class="form-group">
                                <label for="recipe-search" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">إربط مع وصفة أو منتج</label>
                                <select class="form-control" id="recipe-search" name="recipe_id" style="width: 100%;">
                                    <option value="">إختر وصفة أو منتج</option>
                                    @foreach($recpies as $recipe)
                                    <option value="{{ $recipe->id }}">{{ $recipe->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h6 class="dz-title my-2" style="text-align: center;">اين تريد ان تحفظ الفيديو</h6>
                        <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                            <div class="form-check style-2">
                                <input class="form-check-input" type="radio" name="status" id="filterRadio1" value="published" checked>
                                <label class="form-check-label" for="filterRadio1">نشر</label>
                            </div>
                            <div class="form-check style-2">
                                <input class="form-check-input" type="radio" name="status" id="filterRadio2" value="draft">
                                <label class="form-check-label" for="filterRadio2">مسودة</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">حفظ</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            console.log('=== بدء التطبيق ===');
            console.log('jQuery version:', $.fn.jquery);

            // معالج تغيير التصنيف الرئيسي
            $('#mainCategorie-search').on('change', function() {
                const mainCategoryId = $(this).val();
                const subCategorySelect = $('#subCategory-search');
                console.log('Main Category ID selected:', mainCategoryId);

                // إظهار معلومات التشخيص
                $('#debug-info').show();
                $('#debug-content').html(`التصنيف الرئيسي المختار: ${mainCategoryId || 'لا شيء'}<br>جاري تحميل التصنيفات الفرعية...`);

                // مسح التصنيفات الفرعية
                subCategorySelect.empty().append('<option value="">إختر التصنيف الفرعي</option>');

                if (mainCategoryId) {
                    $.ajax({
                        url: `/c1he3f/subcategories/${mainCategoryId}`
                        , type: 'GET'
                        , dataType: 'json'
                        , timeout: 10000
                        , success: function(data) {
                            console.log('Subcategories received:', data);
                            subCategorySelect.empty().append('<option value="">إختر التصنيف الفرعي</option>');

                            if (data && data.length > 0) {
                                data.forEach(function(subcategory) {
                                    subCategorySelect.append(`<option value="${subcategory.id}">${subcategory.name_ar}</option>`);
                                });
                                $('#debug-content').html(`تم تحميل ${data.length} تصنيفات فرعية`);
                            } else {
                                $('#debug-content').html('لا توجد تصنيفات فرعية لهذا التصنيف');
                            }
                        }
                        , error: function(xhr, status, error) {
                            console.error('Error fetching subcategories:', xhr.responseText);
                            $('#debug-content').html(`<span style="color: red;">فشل التحميل: ${xhr.status} - ${xhr.responseText}</span>`);
                        }
                    });
                } else {
                    $('#debug-content').html('لم يتم اختيار تصنيف رئيسي');
                }
            });

            // معالج اختيار التصنيفات الفرعية
            $('#subCategory-search').on('change', function() {
                const selectedValues = $(this).val() || [];
                const selectedContainer = $('#selected-subcategories');
                const hiddenInputsContainer = $('#hidden-subcategories-inputs');

                selectedContainer.empty();
                hiddenInputsContainer.empty();

                selectedValues.forEach(function(id) {
                    const name = $(`#subCategory-search option[value="${id}"]`).text();
                    selectedContainer.append(`
<span class="badge bg-primary me-2 mb-2 p-2">${name}
    <button type="button" class="btn-close btn-close-white ms-2" onclick="removeSubcategory(${id})"></button>
</span>
`);
                    hiddenInputsContainer.append(`<input type="hidden" name="subCategory_ids[]" value="${id}">`);
                });

                console.log('Selected Subcategories:', selectedValues);
                $('#debug-content').append(`<br>التصنيفات الفرعية المختارة: ${selectedValues.join(', ')}`);
            });

            // دالة حذف تصنيف فرعي
            window.removeSubcategory = function(subcategoryId) {
                const select = $('#subCategory-search');
                const values = select.val() || [];
                const newValues = values.filter(val => val != subcategoryId);
                select.val(newValues).trigger('change');
                console.log('Removed subcategory:', subcategoryId);
            };
        });

    </script>

    <script>
        let selectedFile = null;
        let videoDuration = 0;

        function showMessage(message, type) {
            console.log(`إظهار رسالة في الـ UI: ${message} (النوع: ${type})`);
            const container = document.getElementById('message-container');
            if (!container) {
                console.error('خطأ: عنصر message-container غير موجود في الـ DOM');
                alert(message); // Fallback to alert if container is not found
                return;
            }

            const messageClass = type === 'error' ? 'error-message' :
                type === 'success' ? 'success-message' : 'loading-message';

            container.innerHTML = ''; // Clear previous messages
            container.innerHTML = `
<div class="${messageClass}" style="display: block;">
    ${message}
    ${type !== 'loading' ? '<button onclick="this.parentElement.remove()" style="margin-left: 10px; border: none; background: none; cursor: pointer;">✖</button>' : ''}
</div>`;

            // Ensure container is visible
            container.style.display = 'block';
            container.style.visibility = 'visible';

            // Auto-hide success messages after 5 seconds
            if (type === 'success') {
                setTimeout(() => {
                    const messageElement = container.querySelector('.success-message');
                    if (messageElement) {
                        messageElement.remove();
                    }
                }, 5000);
            }

            console.log('تم إضافة الرسالة إلى message-container:', container.innerHTML);
        }

        function updateVideoInfo(file, duration) {
            const minutes = Math.floor(duration / 60);
            const seconds = Math.floor(duration % 60);
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

            document.getElementById('video-duration').textContent = `المدة: ${minutes}:${seconds.toString().padStart(2, '0')} دقيقة`;
            document.getElementById('video-size').textContent = `الحجم: ${sizeInMB} ميجابايت`;
        }

        function removeVideo() {
            selectedFile = null;
            videoDuration = 0;
            document.getElementById('fil-ttd').value = '';
            document.getElementById('video-preview').classList.add('hidden');
            document.getElementById('upload-area').classList.remove('hidden');

            const messageContainer = document.getElementById('message-container');
            if (messageContainer) {
                messageContainer.innerHTML = '';
                messageContainer.style.display = 'none';
            }

            document.getElementById('progress-bar').classList.add('hidden');
            document.getElementById('progress-fill').style.width = '0%';
            console.log('حالة: تم إزالة الفيديو وإعادة تعيين النموذج');
        }

        // معالج تحديد الملف
        document.getElementById('fil-ttd').addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (!file) {
                console.log('حالة الخطأ: لم يتم اختيار ملف');
                showMessage('يرجى اختيار ملف فيديو', 'error');
                return;
            }

            // التحقق من نوع الملف
            if (!file.type.startsWith('video/')) {
                console.log('حالة الخطأ: الملف ليس فيديو صالح');
                showMessage('يرجى اختيار ملف فيديو صالح', 'error');
                this.value = ''; // مسح الاختيار
                return;
            }

            // التحقق من حجم الملف (50 ميجابايت)
            const maxSize = 50 * 1024 * 1024;
            if (file.size > maxSize) {
                console.log('حالة الخطأ: حجم الفيديو أكبر من 50 ميجابايت');
                showMessage('حجم الفيديو يجب أن يكون أقل من 50 ميجابايت', 'error');
                this.value = ''; // مسح الاختيار
                return;
            }

            selectedFile = file;
            console.log('حالة النجاح: تم اختيار فيديو صالح، جاري المعاينة');
            previewVideo(file);
        });

        function previewVideo(file) {
            const video = document.getElementById('preview-video');
            const url = URL.createObjectURL(file);
            video.src = url;
            video.addEventListener('loadedmetadata', function() {
                videoDuration = video.duration;
                if (videoDuration > 60) {
                    console.log('حالة الخطأ: مدة الفيديو أكثر من 60 ثانية');
                    showMessage('مدة الفيديو أكثر من 60 ثانية', 'error');
                    // Remove the call to removeVideo() here
                    // removeVideo(); // <--- REMOVE THIS LINE
                    return; // Stop further processing
                }
                updateVideoInfo(file, videoDuration);
                document.getElementById('upload-area').classList.add('hidden');
                document.getElementById('video-preview').classList.remove('hidden');
                document.getElementById('progress-bar').classList.add('hidden');
                console.log('حالة النجاح: تم تحميل الفيديو للمعاينة بنجاح، المدة:', videoDuration, 'ثانية');
                showMessage('تم تحميل الفيديو بنجاح! يمكنك الآن مراجعته ورفعه', 'success');
            });
            video.addEventListener('error', function() {
                console.log('حالة الخطأ: فشل تحميل الفيديو');
                showMessage('فشل تحميل الفيديو', 'error');
                removeVideo(); // Keep this here as it's a critical loading error
            });
        } // معالج إرسال النموذج
document.getElementById('upload-form').addEventListener('submit', function(e) {
e.preventDefault();

// التحقق من اختيار الفيديو
if (!selectedFile) {
console.log('حالة الخطأ: لم يتم اختيار فيديو للرفع');
showMessage('يرجى اختيار فيديو للرفع', 'error');
return;
}

// التحقق من مدة الفيديو
if (videoDuration > 60) {
console.log('حالة الخطأ: مدة الفيديو أكثر من 60 ثانية');
showMessage('مدة الفيديو يجب أن تكون 60 ثانية أو أقل', 'error');
return;
}

// التحقق من الحقول المطلوبة
const name = document.getElementById('name').value.trim();
if (!name) {
showMessage('يرجى إدخال وصف للفيديو', 'error');
return;
}

// بدء عملية الرفع
document.getElementById('progress-bar').classList.remove('hidden');
console.log('حالة: جاري رفع الفيديو');
showMessage('جاري رفع الفيديو...', 'loading');

const formData = new FormData(this);

$.ajax({
url: this.action,
type: 'POST',
data: formData,
processData: false,
contentType: false,
xhr: function() {
const xhr = new window.XMLHttpRequest();
xhr.upload.addEventListener('progress', function(evt) {
if (evt.lengthComputable) {
const percentComplete = (evt.loaded / evt.total) * 100;
console.log('حالة التقدم: ', percentComplete.toFixed(2) + '%');
document.getElementById('progress-fill').style.width = percentComplete + '%';
}
}, false);
return xhr;
},
success: function(response) {
console.log('حالة النجاح: تم رفع الفيديو بنجاح', response);
showMessage('تم رفع الفيديو بنجاح!', 'success');

// إعادة تعيين النموذج
document.getElementById('upload-form').reset();
removeVideo();

// إعادة تعيين الحقول المخصصة
$('#kitchen-search').val('').trigger('change');
$('#mainCategorie-search').val('').trigger('change');
$('#recipe-search').val('').trigger('change');

// توجيه المستخدم إلى صفحة جميع السنابات
window.location.href = "{{ route('c1he3f.snaps.all-snap') }}";
},
error: function(xhr) {
console.log('حالة الخطأ: فشل رفع الفيديو', xhr.responseJSON || xhr);

let errorMessage = 'حدث خطأ أثناء رفع الفيديو';
if (xhr.responseJSON && xhr.responseJSON.message) {
errorMessage = xhr.responseJSON.message;
} else if (xhr.responseJSON && xhr.responseJSON.errors) {
const errors = xhr.responseJSON.errors;
const errorMessages = [];
for (const field in errors) {
if (errors.hasOwnProperty(field)) {
errorMessages.push(errors[field][0]);
}
}
if (errorMessages.length > 0) {
errorMessage = errorMessages.join(', ');
}
}

showMessage(errorMessage, 'error');
document.getElementById('progress-bar').classList.add('hidden');
}
});
}); const uploadArea = document.getElementById('upload-area');


        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#e3f2fd';
            uploadArea.style.borderColor = '#007bff';
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '';
            uploadArea.style.borderColor = '';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '';
            uploadArea.style.borderColor = '';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                // محاكاة اختيار الملف
                const fileInput = document.getElementById('fil-ttd');
                fileInput.files = files;

                // تشغيل حدث التغيير
                const event = new Event('change', {
                    bubbles: true
                });
                fileInput.dispatchEvent(event);
            }
        });

        uploadArea.addEventListener('click', function() {
            document.getElementById('fil-ttd').click();
        });

    </script>
</body>
@endsection
