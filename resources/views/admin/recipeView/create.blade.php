@extends('layouts.admin')

@section('title', 'إضافة وصفة جديدة')
@section('page-title', 'إضافة وصفة جديدة')

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
    </style>
@endpush
@section('content')
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 " role="alert">
        <span class="font-medium">ملاحظة هامة</span> يجب ادخال جميع البيانات باللغة العربية فقط
    </div>
    <div class="form-section">
        <h5 class="mb-4">
            <i class="fas fa-plus-circle ms-2"></i>
            إضافة وصفة جديدة
        </h5>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="recipe-form" action="{{ route('admin.recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">عنوان الوصفة</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                        required>
                    @error('title')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dish_image" class="form-label">صورة الطبق</label>
                    <input type="file" class="form-control" name="dish_image" id="dish_image" accept="image/*">
                    @error('dish_image')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                    <img id="image_preview" src="#" alt="معاينة الصورة" class="dish-image-preview"
                        style="display: none;">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="kitchen_type_id" class="form-label">نوع المطبخ</label>
                    <select class="form-select" name="kitchen_type_id" id="kitchen_type_id" required>
                        <option value="">اختر نوع المطبخ</option>
                        @foreach ($kitchens as $kitchen)
                            <option value="{{ $kitchen->id }}"
                                {{ old('kitchen_type_id') == $kitchen->id ? 'selected' : '' }}>
                                {{ $kitchen->name_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('kitchen_type_id')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Conditional display for Chef selection --}}
                {{-- Conditional display for Chef selection --}}
                @auth {{-- 1. تحقق إذا كان المستخدم مسجلاً للدخول --}}

                    @if (auth()->user()->role === 'طاه')
                        {{-- 2. الشرط الأول: إذا كان الدور 'admin' أو 'data_entry' --}}
                        {{-- المسؤولون ومدخلي البيانات يمكنهم اختيار طاهٍ --}}
                        <div class="col-md-4 mb-3">

                            <label for="chef_id" class="form-label">الطاهي</label>
                            <input type="text" class="form-control" id="chef_id" name="chef_id" value="{{ auth()->user()->name }}"
                                readonly>
                            {{-- {{ auth()->user()->name }}@ --}}
                        </div>
                    @else
                        <div class="col-md-4 mb-3">
                            <label for="chef_id" class="form-label">الطاهي</label>
                            <select class="form-select" name="chef_id" id="chef_id" required>
                                <option value="">اختر الطاهي</option>
                                @foreach ($chefs as $chef)
                                    <option value="{{ $chef->id }}" {{ old('chef_id') == $chef->id ? 'selected' : '' }}>
                                        الطاهي: {{ $chef->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('chef_id')
                                <div class="text-white mt-1">{{ $message }}</div>
                            @enderror

                        </div>
                    @endif
                @else
                    {{-- 4. إذا لم يكن هناك مستخدم مسجل الدخول --}}
                    {{-- في حال عدم وجود مستخدم مصادق عليه، ربما رسالة افتراضية أو خطأ --}}
                    <div class="col-md-4 mb-3">
                        <label for="chef_id" class="form-label">الطاهي</label>
                        <select class="form-select" name="chef_id" id="chef_id" required disabled>
                            <option value="">لا يوجد طاهي متاح (يرجى تسجيل الدخول)</option>
                        </select>
                    </div>
                @endauth
                <div class="col-md-4 mb-3">
                    <label for="main_category_id" class="form-label">التصنيف الرئيسي</label>
                    <select class="form-select" name="main_category_id" id="main_category_id" required>
                        <option value="">اختر التصنيف الرئيسي</option>
                        @foreach ($mainCategories as $mainCategory)
                            <option value="{{ $mainCategory->id }}"
                                {{ old('main_category_id') == $mainCategory->id ? 'selected' : '' }}>
                                {{ $mainCategory->name_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('main_category_id')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="sub_categories" class="form-label">التصنيفات الفرعية</label>
                    <select class="form-control select2" name="sub_categories[]" id="sub_categories" multiple="multiple">
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ in_array($subCategory->id, old('sub_categories', [])) ? 'selected' : '' }}>
                                {{ $subCategory->name_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('sub_categories')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Section for Ingredients with Buttons --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">المكونات</label>
                    <div id="ingredients-container">
                        {{-- Ingredients will be added here by JavaScript --}}
                    </div>
                    <button type="button" id="add-ingredient-btn" class="btn add-ingredient-btn">
                        <i class="fas fa-plus-circle ms-1"></i> أضف مكون / عنوان
                    </button>
                    {{-- Hidden field to store aggregated ingredients --}}
                    <input type="hidden" name="ingredients" id="hidden-ingredients-input">
                    @error('ingredients')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Section for Preparation Steps with Buttons --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">خطوات التحضير</label>
                    <div id="steps-container">
                        {{-- Steps will be added here by JavaScript --}}
                    </div>
                    <button type="button" id="add-step-btn" class="btn add-step-btn">
                        <i class="fas fa-plus-circle ms-1"></i> أضف خطوة
                    </button>
                    {{-- Hidden field to store aggregated steps --}}
                    <input type="hidden" name="steps" id="hidden-steps-input">
                    @error('steps')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="servings" class="form-label">تكفي لعدد </label>
                    <input type="number" class="form-control" id="servings" name="servings"
                        value="{{ old('servings') }}" min="1" required>
                    @error('servings')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="preparation_time" class="form-label">وقت التحضير (بالدقائق)</label>
                    <input type="number" class="form-control" id="preparation_time" name="preparation_time"
                        value="{{ old('preparation_time') }}" min="1" required>
                    @error('preparation_time')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="calories" class="form-label">السعرات الحرارية</label>
                    <input type="number" class="form-control" id="calories" name="calories"
                        value="{{ old('calories') }}" min="0">
                    @error('calories')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="fats" class="form-label">الدهون (جرام)</label>
                    <input type="number" step="0.01" class="form-control" id="fats" name="fats"
                        value="{{ old('fats') }}" min="0">
                    @error('fats')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="carbs" class="form-label">الكربوهيدرات (جرام)</label>
                    <input type="number" step="0.01" class="form-control" id="carbs" name="carbs"
                        value="{{ old('carbs') }}" min="0">
                    @error('carbs')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="protein" class="form-label">البروتين (جرام)</label>
                    <input type="number" step="0.01" class="form-control" id="protein" name="protein"
                        value="{{ old('protein') }}" min="0">
                    @error('protein')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="is_free" class="form-label">نوع الوصفة</label>
                    <select class="form-select" name="is_free" id="is_free">
                        <option value="1" {{ old('is_free', true) == true ? 'selected' : '' }}>مجانية</option>
                        <option value="0" {{ old('is_free', true) == false ? 'selected' : '' }}>مدفوعة</option>
                    </select>
                    @error('is_free')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">الحالة</label>
                    <select class="form-select" name="status" id="status">
                        <option value="1" {{ old('status', true) == true ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('status', true) == false ? 'selected' : '' }}>غير فعال</option>
                    </select>
                    @error('status')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-light mt-3 btn-submit">
                <i class="fas fa-plus ms-1"></i>
                إضافة الوصفة
            </button>
            <a href="{{ route('admin.recipes.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-times ms-1"></i>
                إلغاء
            </a>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {!! $swalScript !!}
    <script>
        $(document).ready(function() {
            // Initialize Select2 for sub_categories
            $('#sub_categories').select2({
                placeholder: "اختر التصنيفات الفرعية",
                allowClear: true
            });

            // Image preview logic for dish_image
            const dishImageInput = document.getElementById('dish_image');
            const imagePreview = document.getElementById('image_preview');
            if (dishImageInput) {
                dishImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.src = '#';
                        imagePreview.style.display = 'none';
                    }
                });
            }

            // --- Dynamic Ingredients Logic ---
            const ingredientsContainer = $('#ingredients-container');
            const addIngredientBtn = $('#add-ingredient-btn');
            const MAX_CHARS_INGREDIENT = 200;

            function updateCharCounter($input, maxLength) {
                const currentLength = $input.val().length;
                const remainingChars = maxLength - currentLength;
                const $counter = $input.next('.char-counter');
                $counter.text(`متبقي: ${remainingChars} حرف`);
                $counter.css('color', remainingChars < 0 ? 'red' : '#666');
            }

            function createIngredientItem(value = '', isHeading = false) {
                const itemHtml = `
            <div class="ingredient-item" data-type="${isHeading ? 'heading' : 'ingredient'}">
                <span class="ingredient-type-indicator">${isHeading ? 'عنوان' : 'مكون'}</span>
                <input type="text" class="form-control ingredient-text" value="${value}" placeholder="ادخل المكون أو العنوان" maxlength="${MAX_CHARS_INGREDIENT}" required>
                <span class="char-counter">متبقي: ${MAX_CHARS_INGREDIENT} حرف</span>
                <div class="btn-group ingredient-buttons" role="group">
                    <button type="button" class="btn btn-sm btn-is-heading ${isHeading ? 'active' : ''}" data-type="heading"><i class="fas fa-heading"></i> عنوان</button>
                    <button type="button" class="btn btn-sm btn-is-ingredient ${!isHeading ? 'active' : ''}" data-type="ingredient"><i class="fas fa-list-alt"></i> مكون</button>
                </div>
                <div class="btn-group order-buttons" role="group">
                    <button type="button" class="btn btn-sm btn-outline-secondary move-up-btn" title="تحريك لأعلى"><i class="fas fa-arrow-up"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-secondary move-down-btn" title="تحريك لأسفل"><i class="fas fa-arrow-down"></i></button>
                </div>
                <button type="button" class="btn btn-sm remove-ingredient-btn" title="حذف المكون/العنوان"><i class="fas fa-times"></i></button>
            </div>
        `;
                const $newItem = $(itemHtml);
                ingredientsContainer.append($newItem);
                const $newInput = $newItem.find('.ingredient-text');
                updateCharCounter($newInput, MAX_CHARS_INGREDIENT);
            }

            // Handle existing ingredients from old() input
            const existingIngredientsString = `{!! old('ingredients', '') !!}`;
            if (existingIngredientsString.trim()) {
                const lines = existingIngredientsString.split('\n');
                lines.forEach(line => {
                    const trimmedLine = line.trim();
                    if (trimmedLine.startsWith('##')) {
                        createIngredientItem(trimmedLine.substring(2).trim(), true);
                    } else if (trimmedLine) {
                        createIngredientItem(trimmedLine, false);
                    }
                });
            } else {
                createIngredientItem(); // Add one empty ingredient by default
            }

            addIngredientBtn.on('click', function() {
                createIngredientItem();
            });

            ingredientsContainer.on('click', '.remove-ingredient-btn', function() {
                $(this).closest('.ingredient-item').remove();
            });

            ingredientsContainer.on('click', '.ingredient-buttons button', function() {
                const $this = $(this);
                const itemType = $this.data('type');
                const $parentItem = $this.closest('.ingredient-item');
                const $typeIndicator = $parentItem.find('.ingredient-type-indicator');
                $parentItem.attr('data-type', itemType);
                $this.addClass('active').siblings().removeClass('active');
                $typeIndicator.text(itemType === 'heading' ? 'عنوان' : 'مكون');
            });

            ingredientsContainer.on('focus', '.ingredient-text', function() {
                $(this).next('.char-counter').addClass('visible');
                updateCharCounter($(this), MAX_CHARS_INGREDIENT);
            }).on('blur', '.ingredient-text', function() {
                $(this).next('.char-counter').removeClass('visible');
            }).on('input', '.ingredient-text', function() {
                updateCharCounter($(this), MAX_CHARS_INGREDIENT);
            });

            ingredientsContainer.on('click', '.move-up-btn', function() {
                const $currentItem = $(this).closest('.ingredient-item');
                const $prevItem = $currentItem.prev('.ingredient-item');
                if ($prevItem.length) $currentItem.insertBefore($prevItem);
            });

            ingredientsContainer.on('click', '.move-down-btn', function() {
                const $currentItem = $(this).closest('.ingredient-item');
                const $nextItem = $currentItem.next('.ingredient-item');
                if ($nextItem.length) $currentItem.insertAfter($nextItem);
            });

            // --- Dynamic Steps Logic ---
            const stepsContainer = $('#steps-container');
            const addStepBtn = $('#add-step-btn');
            const MAX_CHARS_STEP = 500;
            let stepFileInputCounter = 0;

            function updateStepNumbers() {
                stepsContainer.find('.step-item').each(function(index) {
                    $(this).find('.step-number-indicator').text(`خطوة ${index + 1}`);
                });
            }

            function createStepItem(stepValue = '', mediaFiles = []) {
                stepFileInputCounter++;
                const itemHtml = `
            <div class="step-item">
                <span class="step-number-indicator">خطوة ${stepsContainer.children().length + 1}</span>
                <input type="text" class="form-control step-text" value="${stepValue}" placeholder="ادخل وصف الخطوة" maxlength="${MAX_CHARS_STEP}" required>
                <span class="char-counter">متبقي: ${MAX_CHARS_STEP} حرف</span>
                <div class="btn-group order-buttons" role="group">
                    <button type="button" class="btn btn-sm btn-outline-secondary move-up-btn" title="تحريك لأعلى"><i class="fas fa-arrow-up"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-secondary move-down-btn" title="تحريك لأسفل"><i class="fas fa-arrow-down"></i></button>
                </div>
                <button type="button" class="btn btn-sm remove-step-btn" title="حذف الخطوة"><i class="fas fa-times"></i></button>
                <div class="step-media-section">
                    <input type="file" class="upload-input-hidden step-media-input" name="step_media[${stepFileInputCounter - 1}][]" id="media_${stepFileInputCounter}" accept="image/*,video/*" multiple>
                    <label for="media_${stepFileInputCounter}" class="btn btn-info file-upload-label add-media-btn"><i class="fas fa-plus-square ms-1"></i> أضف صورة / فيديو</label>
                    <div class="media-previews"><div class="multiple-media-previews" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div></div>
                    <div class="step-media-actions" style="display: ${mediaFiles.length > 0 ? 'flex' : 'none'}; gap: 5px; margin-top: 10px;">
                        <button type="button" class="btn btn-sm btn-primary add-more-media-btn">رفع المزيد</button>
                        <button type="button" class="btn btn-sm btn-danger clear-all-media-btn">مسح الكل</button>
                    </div>
                </div>
            </div>
        `;
                const $newItem = $(itemHtml);
                $newItem[0].allMediaFiles = []; // Initialize an array to hold File objects

                // Re-populate media if existing mediaUrls are passed (for old data)
                mediaFiles.forEach(file => {
                    $newItem[0].allMediaFiles.push(file); // Add to internal array
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const mediaPreview = file.type.startsWith('image/') ?
                            `<div class="media-item" style="position: relative;"><img src="${e.target.result}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;"><button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button></div>` :
                            `<div class="media-item" style="position: relative;"><video src="${e.target.result}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video><button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button></div>`;
                        $newItem.find('.multiple-media-previews').append(mediaPreview).show();
                    };
                    reader.readAsDataURL(file);
                });

                stepsContainer.append($newItem);

                // Event listener for "Add More Media" button
                $newItem.find('.add-more-media-btn').on('click', function() {
                    $(this).closest('.step-media-section').find('.step-media-input').click();
                });

                // Event listener for file input change
                $newItem.find('.step-media-input').on('change', function(event) {
                    const files = event.target.files;
                    const $multiplePreviews = $(this).closest('.step-media-section').find(
                        '.multiple-media-previews');
                    const $mediaActions = $(this).closest('.step-media-section').find(
                        '.step-media-actions');
                    const $stepItem = $(this).closest('.step-item');

                    if (files.length > 0) {
                        $mediaActions.show();
                        Array.from(files).forEach(file => {
                            $stepItem[0].allMediaFiles.push(file); // Add the actual File object
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const mediaPreview = file.type.startsWith('image/') ?
                                    `<div class="media-item" style="position: relative;"><img src="${e.target.result}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;"><button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button></div>` :
                                    `<div class="media-item" style="position: relative;"><video src="${e.target.result}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video><button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button></div>`;
                                $multiplePreviews.append(mediaPreview).show();
                            };
                            reader.readAsDataURL(file);
                        });
                        $(this).val(''); // Reset input to allow selecting same files again
                    }
                });

                // Event listener for removing single media
                $newItem.on('click', '.remove-single-media', function() {
                    const $mediaItem = $(this).closest('.media-item');
                    const $stepItem = $(this).closest('.step-item');
                    const mediaIndex = $mediaItem.index();

                    if ($stepItem[0].allMediaFiles && $stepItem[0].allMediaFiles[mediaIndex]) {
                        $stepItem[0].allMediaFiles.splice(mediaIndex, 1); // Remove from internal array
                    }
                    $mediaItem.remove();
                    if ($stepItem.find('.media-item').length === 0) {
                        $stepItem.find('.step-media-actions').hide();
                        $stepItem.find('.multiple-media-previews').hide();
                    }
                });

                // Event listener for clearing all media
                $newItem.find('.clear-all-media-btn').on('click', function() {
                    const $stepItem = $(this).closest('.step-item');
                    $stepItem[0].allMediaFiles = []; // Clear internal array
                    $stepItem.find('.multiple-media-previews').empty().hide();
                    $stepItem.find('.step-media-actions').hide();
                    $stepItem.find('.step-media-input').val(''); // Clear file input value
                });

                const $newInput = $newItem.find('.step-text');
                updateCharCounter($newInput, MAX_CHARS_STEP);
            }

            // Handle existing steps from old() input
            const existingStepsString = `{!! old('steps', '') !!}`;
            if (existingStepsString.trim()) {
                const lines = existingStepsString.split('\n');
                lines.forEach(line => {
                    const trimmedLine = line.trim();
                    if (trimmedLine) {
                        createStepItem(trimmedLine); // Pass only the text for old steps
                    }
                });
            } else {
                createStepItem(); // Add one empty step by default
            }

            addStepBtn.on('click', function() {
                createStepItem();
                updateStepNumbers();
            });

            stepsContainer.on('click', '.remove-step-btn', function() {
                $(this).closest('.step-item').remove();
                updateStepNumbers();
            });

            stepsContainer.on('focus', '.step-text', function() {
                $(this).next('.char-counter').addClass('visible');
                updateCharCounter($(this), MAX_CHARS_STEP);
            }).on('blur', '.step-text', function() {
                $(this).next('.char-counter').removeClass('visible');
            }).on('input', '.step-text', function() {
                updateCharCounter($(this), MAX_CHARS_STEP);
            });

            stepsContainer.on('click', '.move-up-btn', function() {
                const $currentItem = $(this).closest('.step-item');
                const $prevItem = $currentItem.prev('.step-item');
                if ($prevItem.length) {
                    $currentItem.insertBefore($prevItem);
                    updateStepNumbers();
                }
            });

            stepsContainer.on('click', '.move-down-btn', function() {
                const $currentItem = $(this).closest('.step-item');
                const $nextItem = $currentItem.next('.step-item');
                if ($nextItem.length) {
                    $currentItem.insertAfter($nextItem);
                    updateStepNumbers();
                }
            });

            // --- Form Submission Logic ---
            $('#recipe-form').on('submit', function(e) {
                // Collect Ingredients
                const ingredients = [];
                ingredientsContainer.find('.ingredient-item').each(function() {
                    const $this = $(this);
                    const type = $this.data('type');
                    const text = $this.find('.ingredient-text').val().trim();
                    if (text) {
                        ingredients.push(`${type === 'heading' ? '##' : ''}${text}`);
                    }
                });
                $('#hidden-ingredients-input').val(ingredients.join('\n'));

                // Collect Steps
                const steps = [];
                stepsContainer.find('.step-item').each(function(index) {
                    const $this = $(this);
                    const stepText = $this.find('.step-text').val().trim();
                    if (stepText) {
                        steps.push(stepText);
                    }
                });
                $('#hidden-steps-input').val(steps.join('\n'));

                // Form will submit normally with multipart/form-data
                // The step media files will be handled by their respective input[name="step_media[x][]"] elements
            });
        });
    </script>
@endpush
