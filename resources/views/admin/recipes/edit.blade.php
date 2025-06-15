@extends('layouts.admin')

@section('title', 'تعديل الوصفة: ' . $recipe->title)
@section('page-title', 'تعديل الوصفة: ' . $recipe->title)

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
            color: #333;
        }

        .btn-is-heading.active {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-is-ingredient {
            background-color: #17a2b8;
            color: white;
        }

        .btn-is-ingredient.active {
            background-color: #138496;
            border-color: #138496;
        }

        .remove-ingredient-btn {
            background-color: #dc3545;
            color: white;
        }

        .add-ingredient-btn {
            background-color: #28a745;
            color: white;
            margin-top: 10px;
            width: fit-content;
        }

        .ingredient-type-indicator {
            background-color: rgba(110, 110, 110, 0.2);
            color: rgb(0, 0, 0);
            padding: 5px 8px;
            border-radius: 5px;
            font-size: 0.8rem;
            min-width: 60px;
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
        }

        .step-item .form-control {
            flex-grow: 1;
            margin-bottom: 0;
        }

        .step-number-indicator {
            background-color: rgba(118, 75, 162, 0.2);
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
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
        }

        .step-media-section .upload-input-hidden {
            display: none;
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
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">ملاحظة هامة</span> يجب إدخال جميع البيانات باللغة العربية فقط
    </div>
    <div class="form-section">
        <h5 class="mb-4">
            <i class="fas fa-edit ms-2"></i>
            تعديل الوصفة
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

        <form id="recipe-form" action="{{ route('admin.recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">عنوان الوصفة</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
                    @error('title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dish_image" class="form-label">صورة الطبق</label>
                    <input type="file" class="form-control" name="dish_image" id="dish_image" accept="image/*">
                    @error('dish_image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <img id="image_preview" src="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : '#' }}"
                        alt="معاينة الصورة" class="dish-image-preview" style="{{ $recipe->dish_image ? '' : 'display: none;' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="kitchen_type_id" class="form-label">نوع المطبخ</label>
                    <select class="form-select" name="kitchen_type_id" id="kitchen_type_id" required>
                        <option value="">اختر نوع المطبخ</option>
                        @foreach ($kitchens as $kitchen)
                            <option value="{{ $kitchen->id }}"
                                {{ old('kitchen_type_id', $recipe->kitchen_type_id) == $kitchen->id ? 'selected' : '' }}>
                                {{ $kitchen->name_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('kitchen_type_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                @auth
                    @if (auth()->user()->role === 'طاه')
                        <div class="col-md-4 mb-3">
                            <label for="chef_name" class="form-label">الطاهي</label>
                            <input type="text" class="form-control" id="chef_name" 
                                value="{{ auth()->user()->name }}" readonly>
                            <input type="hidden" name="chef_id" value="{{ auth()->user()->id }}">
                        </div>
                    @else
                        <div class="col-md-4 mb-3">
                            <label for="chef_id" class="form-label">الطاهي (اختياري)</label>
                            <select class="form-select" name="chef_id" id="chef_id">
                                <option value="">اختر الطاهي</option>
                                @foreach ($chefs as $chef)
                                    <option value="{{ $chef->id }}"
                                        {{ old('chef_id', $recipe->chef_id) == $chef->id ? 'selected' : '' }}>
                                        الطاهي: {{ $chef->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('chef_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                @else
                    <div class="col-md-4 mb-3">
                        <label for="chef_id" class="form-label">الطاهي (اختياري)</label>
                        <select class="form-select" name="chef_id" id="chef_id" disabled>
                            <option value="">لا يوجد طاهي متاح (يرجى تسجيل الدخول)</option>
                        </select>
                    </div>
                @endauth

                <div class="col-md-3 mb-3">
                    <div class="form-group mb-3">
                        <label for="is_free" class="form-label">نوع الوصفة</label>
                        @can('isChef')
                            <select class="form-select" name="is_free" id="is_free" required>
                                <option value="">اختر نوع الوصفة</option>
                                <option value="1" {{ old('is_free', $recipe->is_free) == '1' ? 'selected' : '' }}>مجانية</option>
                                <option value="0" {{ old('is_free', $recipe->is_free) == '0' ? 'selected' : '' }}>مدفوعة</option>
                            </select>
                        @else
                            <select class="form-select" name="is_free" id="is_free" required>
                                <option value="">اختر نوع الوصفة</option>
                                <option value="1" {{ old('is_free', $recipe->is_free) == '1' ? 'selected' : '' }}>مجانية</option>
                                <option value="0" {{ old('is_free', $recipe->is_free) == '0' ? 'selected' : '' }}>نظام الباقات</option>
                            </select>
                        @endcan
                    </div>
                    @error('is_free')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="main_category_id" class="form-label">التصنيف الرئيسي</label>
                    <select class="form-select" name="main_category_id" id="main_category_id" required>
                        <option value="">اختر التصنيف الرئيسي</option>
                        @foreach ($mainCategories as $mainCategory)
                            <option value="{{ $mainCategory->id }}"
                                {{ old('main_category_id', $recipe->main_category_id) == $mainCategory->id ? 'selected' : '' }}>
                                {{ $mainCategory->name_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('main_category_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="sub_categories" class="form-label">التصنيفات الفرعية</label>
                    <select class="form-control select2" name="sub_categories[]" id="sub_categories" multiple="multiple">
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ in_array($subCategory->id, old('sub_categories', $recipe->subCategories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $subCategory->name_ar }}
                            </option>
                        @endforeach
                    </select>
                    @error('sub_categories')
                        <div class="text-danger mt-1">{{ $message }}</div>
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
                    <input type="hidden" name="ingredients" id="hidden-ingredients-input">
                    @error('ingredients')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Section for Preparation Steps with Buttons --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">خطوات التحضير</label>
                    <div id="steps-container">
                        @php
                            $index = 0;
                        @endphp
                        @if ($recipe->steps && is_array($recipe->steps))
                            @foreach ($recipe->steps as $index => $step)
                                <div class="step-item" data-step-index="{{ $index }}">
                                    <span class="step-number-indicator">الخطوة {{ $index + 1 }}</span>
                                    <input type="text" class="form-control step-text"
                                        value="{{ old('steps_data.' . $index . '.description', $step['description'] ?? '') }}"
                                        placeholder="ادخل وصف الخطوة" maxlength="500" required>
                                    <span class="char-counter">متبقي: {{ 500 - mb_strlen(old('steps_data.' . $index . '.description', $step['description'] ?? '')) }} حرف</span>
                                    <div class="btn-group order-buttons" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary move-up-btn"
                                            title="تحريك لأعلى"><i class="fas fa-arrow-up"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary move-down-btn"
                                            title="تحريك لأسفل"><i class="fas fa-arrow-down"></i></button>
                                    </div>
                                    <button type="button" class="btn btn-sm remove-step-btn" title="حذف الخطوة"><i
                                            class="fas fa-times"></i></button>
                                    <div class="step-media-section">
                                        <input type="file" class="upload-input-hidden step-media-input"
                                            name="step_media[{{ $index }}][]" id="media_{{ $index }}"
                                            accept="image/*,video/*" multiple data-step-index="{{ $index }}">
                                        <label for="media_{{ $index }}"
                                            class="btn btn-info file-upload-label add-media-btn">
                                            <i class="fas fa-plus-square ms-1"></i> أضف صورة / فيديو
                                        </label>
                                        <div class="media-previews">
                                            <div class="multiple-media-previews"
                                                style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                                                @if (!empty($step['media']))
                                                    @foreach ($step['media'] as $media)
                                                        <div class="media-item">
                                                            @if (str_contains($media['type'], 'image'))
                                                                <img src="{{ asset('storage/' . $media['url']) }}"
                                                                    style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;">
                                                            @else
                                                                <video src="{{ asset('storage/' . $media['url']) }}"
                                                                    controls
                                                                    style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video>
                                                            @endif
                                                            <button class="btn btn-sm btn-danger remove-single-media"
                                                                style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="step-media-actions"
                                            style="display: {{ !empty($step['media']) ? 'flex' : 'none' }}; gap: 5px; margin-top: 10px;">
                                            <button type="button" class="btn btn-sm btn-primary add-more-media-btn">رفع
                                                المزيد</button>
                                            <button type="button" class="btn btn-sm btn-danger clear-all-media-btn">مسح
                                                الكل</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" id="add-step-btn" class="btn add-step-btn">
                        <i class="fas fa-plus-circle ms-1"></i> أضف خطوة
                    </button>
                    <input type="hidden" name="steps_data" id="hidden-steps-data">
                    @error('steps_data')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="servings" class="form-label">تكفي لعدد</label>
                    <input type="number" class="form-control" id="servings" name="servings"
                        value="{{ old('servings', $recipe->servings) }}" min="1" required>
                    @error('servings')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="preparation_time" class="form-label">وقت التحضير (بالدقائق)</label>
                    <input type="number" class="form-control" id="preparation_time" name="preparation_time"
                        value="{{ old('preparation_time', $recipe->preparation_time) }}" min="1" required>
                    @error('preparation_time')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="calories" class="form-label">السعرات الحرارية</label>
                    <input type="number" class="form-control" id="calories" name="calories"
                        value="{{ old('calories', $recipe->calories) }}" min="0">
                    @error('calories')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="fats" class="form-label">الدهون (جرام)</label>
                    <input type="number" step="0.01" class="form-control" id="fats" name="fats"
                        value="{{ old('fats', $recipe->fats) }}" min="0">
                    @error('fats')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="carbs" class="form-label">الكربوهيدرات (جرام)</label>
                    <input type="number" step="0.01" class="form-control" id="carbs" name="carbs"
                        value="{{ old('carbs', $recipe->carbs) }}" min="0">
                    @error('carbs')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2 mb-3">
                    <label for="protein" class="form-label">البروتين (جرام)</label>
                    <input type="number" step="0.01" class="form-control" id="protein" name="protein"
                        value="{{ old('protein', $recipe->protein) }}" min="0">
                    @error('protein')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">الحالة</label>
                    <select class="form-select" name="status" id="status">
                        <option value="1" {{ old('status', $recipe->status) == true ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('status', $recipe->status) == false ? 'selected' : '' }}>غير فعال</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-light mt-3 btn-submit">
                <i class="fas fa-save ms-1"></i>
                حفظ التعديلات
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        imagePreview.src = '{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : '#' }}';
                        imagePreview.style.display = '{{ $recipe->dish_image ? 'block' : 'none' }}';
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

            // Handle existing ingredients
            const existingIngredientsString = `{!! old('ingredients', $recipe->ingredients ?? '') !!}`;
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

            // Event listeners for ingredients
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
            let stepFileInputCounter = {{ count($recipe->steps ?? []) }};

            function updateStepIndexes() {
                stepsContainer.find('.step-item').each(function(index) {
                    $(this).attr('data-step-index', index);
                    $(this).find('.step-number-indicator').text(`الخطوة ${index + 1}`);
                    $(this).find('.step-media-input').attr('name', `step_media[${index}][]`);
                    $(this).find('.step-media-input').attr('id', `media_${index}`);
                    $(this).find('.add-media-btn').attr('for', `media_${index}`);
                });
            }

            function setupStepItemEventListeners($stepItem) {
                $stepItem.find('.add-more-media-btn').on('click', function() {
                    $(this).closest('.step-media-section').find('.step-media-input').click();
                });

                $stepItem.find('.step-media-input').on('change', function(event) {
                    const files = event.target.files;
                    const $multiplePreviews = $(this).closest('.step-media-section').find('.multiple-media-previews');
                    const $mediaActions = $(this).closest('.step-media-section').find('.step-media-actions');
                    const $currentStepItem = $(this).closest('.step-item');

                    if (files.length > 0) {
                        $mediaActions.show();
                        $multiplePreviews.show();

                        if (!$currentStepItem[0].allMediaFiles) {
                            $currentStepItem[0].allMediaFiles = [];
                        }

                        Array.from(files).forEach(file => {
                            $currentStepItem[0].allMediaFiles.push(file);
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const mediaPreview = file.type.startsWith('image/') ?
                                    `<div class="media-item" style="position: relative;">
                                        <img src="${e.target.result}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;">
                                        <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                                    </div>` :
                                    `<div class="media-item" style="position: relative;">
                                        <video src="${e.target.result}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video>
                                        <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                                    </div>`;
                                $multiplePreviews.append(mediaPreview);
                            };
                            reader.readAsDataURL(file);
                        });
                        $(this).val('');
                    }
                });

                $stepItem.on('click', '.remove-single-media', function() {
                    const $mediaItem = $(this).closest('.media-item');
                    const $currentStepItem = $(this).closest('.step-item');
                    const mediaIndex = $mediaItem.index();

                    if ($currentStepItem[0].allMediaFiles && $currentStepItem[0].allMediaFiles[mediaIndex] !== undefined) {
                        $currentStepItem[0].allMediaFiles.splice(mediaIndex, 1);
                    }

                    $mediaItem.remove();

                    if ($currentStepItem.find('.media-item').length === 0) {
                        $currentStepItem.find('.step-media-actions').hide();
                        $currentStepItem.find('.multiple-media-previews').hide();
                    }
                });

                $stepItem.find('.clear-all-media-btn').on('click', function() {
                    const $currentStepItem = $(this).closest('.step-item');
                    $currentStepItem[0].allMediaFiles = [];
                    $currentStepItem.find('.multiple-media-previews').empty().hide();
                    $currentStepItem.find('.step-media-actions').hide();
                    $currentStepItem.find('.step-media-input').val('');
                });

                $stepItem.find('.step-text').on('focus', function() {
                    $(this).next('.char-counter').addClass('visible');
                    updateCharCounter($(this), MAX_CHARS_STEP);
                }).on('blur', function() {
                    $(this).next('.char-counter').removeClass('visible');
                }).on('input', function() {
                    updateCharCounter($(this), MAX_CHARS_STEP);
                });
            }

            function createStepItem(stepValue = '', existingMedia = []) {
                stepFileInputCounter++;
                const index = stepsContainer.children().length;
                const itemHtml = `
                    <div class="step-item" data-step-index="${index}">
                        <span class="step-number-indicator">الخطوة ${index + 1}</span>
                        <input type="text" class="form-control step-text" value="${stepValue}" placeholder="ادخل وصف الخطوة" maxlength="${MAX_CHARS_STEP}" required>
                        <span class="char-counter">متبقي: ${MAX_CHARS_STEP} حرف</span>
                        <div class="btn-group order-buttons" role="group">
                            <button type="button" class="btn btn-sm btn-outline-secondary move-up-btn" title="تحريك لأعلى"><i class="fas fa-arrow-up"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary move-down-btn" title="تحريك لأسفل"><i class="fas fa-arrow-down"></i></button>
                        </div>
                        <button type="button" class="btn btn-sm remove-step-btn" title="حذف الخطوة"><i class="fas fa-times"></i></button>
                        <div class="step-media-section">
                            <input type="file" class="upload-input-hidden step-media-input" 
                                name="step_media[${index}][]" 
                                id="media_${stepFileInputCounter}" 
                                accept="image/*,video/*" 
                                multiple 
                                data-step-index="${index}">
                            <label for="media_${stepFileInputCounter}" class="btn btn-info file-upload-label add-media-btn">
                                <i class="fas fa-plus-square ms-1"></i> أضف صورة / فيديو
                            </label>
                            <div class="media-previews">
                                <div class="multiple-media-previews" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>
                            </div>
                            <div class="step-media-actions" style="display: none; gap: 5px; margin-top: 10px;">
                                <button type="button" class="btn btn-sm btn-primary add-more-media-btn">رفع المزيد</button>
                                <button type="button" class="btn btn-sm btn-danger clear-all-media-btn">مسح الكل</button>
                            </div>
                        </div>
                    </div>
                `;

                const $newItem = $(itemHtml);
                $newItem[0].allMediaFiles = [];
                stepsContainer.append($newItem);

                if (existingMedia && existingMedia.length > 0) {
                    const $multiplePreviews = $newItem.find('.multiple-media-previews');
                    const $mediaActions = $newItem.find('.step-media-actions');

                    existingMedia.forEach(media => {
                        const mediaPreview = media.type === 'image' ?
                            `<div class="media-item" style="position: relative;">
                                <img src="${window.location.origin}/storage/${media.url}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;">
                                <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                            </div>` :
                            `<div class="media-item" style="position: relative;">
                                <video src="${window.location.origin}/storage/${media.url}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video>
                                <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                            </div>`;
                        $multiplePreviews.append(mediaPreview);
                    });

                    if (existingMedia.length > 0) {
                        $multiplePreviews.show();
                        $mediaActions.show();
                    }
                }

                setupStepItemEventListeners($newItem);
                const $newInput = $newItem.find('.step-text');
                updateCharCounter($newInput, MAX_CHARS_STEP);
            }

            // Initialize existing steps
            @if (!$recipe->steps || count($recipe->steps) === 0)
                createStepItem();
            @endif

            // Event listeners for steps
            addStepBtn.on('click', function() {
                createStepItem();
            });

            stepsContainer.on('click', '.remove-step-btn', function() {
                $(this).closest('.step-item').remove();
                updateStepIndexes();
            });

            stepsContainer.on('click', '.move-up-btn', function() {
                const $currentItem = $(this).closest('.step-item');
                const $prevItem = $currentItem.prev('.step-item');
                if ($prevItem.length) {
                    $currentItem.insertBefore($prevItem);
                    updateStepIndexes();
                }
            });

            stepsContainer.on('click', '.move-down-btn', function() {
                const $currentItem = $(this).closest('.step-item');
                const $nextItem = $currentItem.next('.step-item');
                if ($nextItem.length) {
                    $currentItem.insertAfter($nextItem);
                    updateStepIndexes();
                }
            });

            // --- Form Submission Logic ---
            $('#recipe-form').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                // Handle ingredients
                const ingredients = [];
                ingredientsContainer.find('.ingredient-item').each(function() {
                    const $this = $(this);
                    const type = $this.data('type');
                    const text = $this.find('.ingredient-text').val().trim();
                    if (text) {
                        ingredients.push(`${type === 'heading' ? '##' : ''}${text}`);
                    }
                });
                formData.set('ingredients', ingredients.join('\n'));

                // Handle steps
                const steps = [];
                for (let pair of formData.entries()) {
                    if (pair[0].startsWith('step_media[')) {
                        formData.delete(pair[0]);
                    }
                }

                stepsContainer.find('.step-item').each(function(index) {
                    const $this = $(this);
                    const stepText = $this.find('.step-text').val().trim();
                    const mediaFiles = $this[0].allMediaFiles || [];

                    if (stepText) {
                        if (mediaFiles.length > 0) {
                            mediaFiles.forEach((file, fileIndex) => {
                                formData.append(`step_media[${index}][]`, file);
                            });
                        }

                        const existingMedia = [];
                        $this.find('.media-item').each(function() {
                            const $mediaItem = $(this);
                            const imgSrc = $mediaItem.find('img').attr('src');
                            const videoSrc = $mediaItem.find('video').attr('src');

                            if (imgSrc && imgSrc.includes('storage/')) {
                                const urlPath = imgSrc.split('storage/')[1];
                                existingMedia.push({
                                    url: urlPath,
                                    type: 'image',
                                    original_name: 'existing_image.jpg'
                                });
                            } else if (videoSrc && videoSrc.includes('storage/')) {
                                const urlPath = videoSrc.split('storage/')[1];
                                existingMedia.push({
                                    url: urlPath,
                                    type: 'video',
                                    original_name: 'existing_video.mp4'
                                });
                            }
                        });

                        const stepData = {
                            description: stepText,
                            media: existingMedia
                        };

                        steps.push(stepData);
                    }
                });

                if (steps.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'يجب إضافة خطوة واحدة على الأقل!'
                    });
                    return;
                }

                formData.set('steps_data', JSON.stringify(steps));

                // AJAX submission
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST', // Use POST with _method=PUT
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'نجح!',
                                text: response.message || 'تم تحديث الوصفة بنجاح!'
                            }).then(() => {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                text: response.message || 'حدث خطأ أثناء الحفظ!'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'حدث خطأ أثناء الحفظ!';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON?.errors || {};
                            const errorMessages = Object.values(errors).flat();
                            if (errorMessages.length > 0) {
                                errorMessage = errorMessages.join('\n');
                            }
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: errorMessage
                        });
                    }
                });
            });
        });
    </script>
@endpush