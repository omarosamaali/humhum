@extends('layouts.admin')

@section('title', 'تعديل الوصفة')
@section('page-title', 'تعديل الوصفة')

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

        .current-image {
            position: relative;
            display: inline-block;
        }

        .remove-current-image {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 12px;
            cursor: pointer;
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

        /* Step styles */
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 8px;
            flex-wrap: wrap;
        }

        .step-number-indicator {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            min-width: 80px;
            text-align: center;
            white-space: nowrap;
        }

        .step-item .form-control {
            flex-grow: 1;
            margin-bottom: 0;
        }

        .char-counter {
            font-size: 0.8rem;
            color: #666;
            margin-left: 10px;
        }

        .step-media-section {
            width: 100%;
            margin-top: 10px;
        }

        .upload-input-hidden {
            display: none;
        }

        .file-upload-label {
            cursor: pointer;
            margin-bottom: 10px;
        }

        .media-previews {
            margin-top: 10px;
        }

        .multiple-media-previews {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .media-item {
            position: relative;
            display: inline-block;
        }

        .remove-single-media {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            cursor: pointer;
        }

        .step-media-actions {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
        <span class="font-medium">ملاحظة هامة</span> يجب ادخال جميع البيانات باللغة العربية فقط
    </div>

    <div class="form-section">
        <h5 class="mb-4">
            <i class="fas fa-edit ms-2"></i>
            تعديل الوصفة: {{ $recipe->title }}
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

        <form id="recipe-form" action="{{ route('admin.recipes.update', $recipe->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">عنوان الوصفة</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $recipe->title) }}" required>
                    @error('title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dish_image" class="form-label">صورة الطبق</label>
                    @if ($recipe->dish_image)
                        <div class="current-image mb-2">
                            <img src="{{ asset('storage/' . $recipe->dish_image) }}" alt="الصورة الحالية"
                                class="dish-image-preview" id="current_image">
                            <button type="button" class="remove-current-image" id="remove_current_image"
                                title="إزالة الصورة الحالية">×</button>
                            <input type="hidden" name="remove_current_image" id="remove_image_input" value="0">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="dish_image" id="dish_image" accept="image/*">
                    @error('dish_image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <img id="image_preview" src="#" alt="معاينة الصورة الجديدة" class="dish-image-preview"
                        style="display: none;">
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

                <div class="col-md-4 mb-3">
                    <label for="chef_id" class="form-label">الطاه</label>
                    <select class="form-select" name="chef_id" id="chef_id" required>
                        <option value="">اختر الطاه</option>
                        @foreach ($chefs as $chef)
                            <option value="{{ $chef->id }}"
                                {{ old('chef_id', $recipe->chef_id) == $chef->id ? 'selected' : '' }}>
                                الطاه : {{ $chef->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('chef_id')
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

                {{-- قسم المكونات --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">المكونات</label>
                    <div id="ingredients-container">
                        {{-- Ingredients will be loaded here by JavaScript --}}
                    </div>
                    <button type="button" id="add-ingredient-btn" class="btn add-ingredient-btn">
                        <i class="fas fa-plus-circle ms-1"></i> أضف مكون / عنوان
                    </button>
                    <input type="hidden" name="ingredients" id="hidden-ingredients-input">
                    @error('ingredients')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <script>
                    $(document).ready(function() {
                        // Function to create a step item HTML
                        function createStepItem(stepText = '', media = [], stepId = null) {
                            const stepIndex = $('#steps-container .step-item').length + 1;
                            const itemHtml = `
                <div class="step-item" data-step-id="${stepId || ''}">
                    <span class="step-number-indicator">الخطوة ${stepIndex}</span>
                    <textarea class="form-control step-text" rows="3" placeholder="ادخل وصف الخطوة" required>${stepText}</textarea>
                    <div class="step-media-section">
                        <label class="file-upload-label">
                            <i class="fas fa-upload"></i> رفع صورة/فيديو
                            <input type="file" class="upload-input-hidden step-media-input" accept="image/*,video/*" multiple>
                        </label>
                        <div class="multiple-media-previews">
                            ${media.map((item, index) => `
                                                <div class="media-item">
                                                    ${item.type === 'image' ? 
                                                        `<img src="${item.path}" class="media-preview" style="max-width: 100px;">` :
                                                        `<video src="${item.path}" class="media-preview" style="max-width: 100px;" controls></video>`
                                                    }
                                                    <button type="button" class="remove-single-media">×</button>
                                                    <input type="hidden" name="existing_media[${stepId || 'new_' + Date.now()}_${index}]" value="${JSON.stringify(item)}">
                                                </div>
                                            `).join('')}
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-step-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
                            $('#steps-container').append(itemHtml);
                            updateStepNumbers();
                        }

                        // Update step numbers
                        function updateStepNumbers() {
                            $('#steps-container .step-item').each(function(index) {
                                $(this).find('.step-number-indicator').text(`الخطوة ${index + 1}`);
                            });
                        }

                        // Load existing steps from the recipe
                        const recipeSteps = @json($recipe->recipeSteps);

                        if (recipeSteps && recipeSteps.length > 0) {
                            recipeSteps.forEach(step => {
                                createStepItem(step.step_text || '', step.media || [], step.id);
                            });
                        } else {
                            // Add an initial empty step if no steps exist
                            createStepItem();
                        }

                        // Add new step item
                        $('#add-step-btn').on('click', function() {
                            createStepItem();
                        });

                        // Handle remove step button (event delegation)
                        $('#steps-container').on('click', '.remove-step-btn', function() {
                            $(this).closest('.step-item').remove();
                            updateStepNumbers();
                            // If all steps are removed, add an empty one back
                            if ($('#steps-container .step-item').length === 0) {
                                createStepItem();
                            }
                        });

                        // Handle media upload preview (event delegation)
                        $('#steps-container').on('change', '.step-media-input', function(event) {
                            const $previewContainer = $(this).closest('.step-media-section').find(
                                '.multiple-media-previews');
                            const files = event.target.files;

                            for (let i = 0; i < files.length; i++) {
                                const file = files[i];
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const mediaType = file.type.startsWith('image') ? 'image' : 'video';
                                    const mediaHtml = `
                        <div class="media-item">
                            ${mediaType === 'image' ? 
                                `<img src="${e.target.result}" class="media-preview" style="max-width: 100px;">` :
                                `<video src="${e.target.result}" class="media-preview" style="max-width: 100px;" controls></video>`
                            }
                            <button type="button" class="remove-single-media">×</button>
                        </div>
                    `;
                                    $previewContainer.append(mediaHtml);
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        // Handle remove media button (event delegation)
                        $('#steps-container').on('click', '.remove-single-media', function() {
                            $(this).closest('.media-item').remove();
                        });

                        // Prepare steps data before form submission
                        $('#recipe-form').on('submit', function(e) {
                            const allSteps = [];
                            $('#steps-container .step-item').each(function() {
                                const $item = $(this);
                                const stepText = $item.find('.step-text').val().trim();
                                const stepId = $item.data('step-id') || null;

                                if (stepText) { // Only add if step text is not empty
                                    const stepData = {
                                        id: stepId,
                                        step_text: stepText,
                                        media: []
                                    };
                                    allSteps.push(stepData);
                                }
                            });

                            // Set the steps data to the hidden input field
                            $('#hidden-steps-input').val(JSON.stringify(allSteps));
                        });
                    });
                </script>
                            <div class="col-md-6">
                <h5 class="section-title">خطوات التحضير:</h5>
                <ol class="content-list">
                    @if ($recipe->recipeSteps && $recipe->recipeSteps->count() > 0)
                        @foreach ($recipe->recipeSteps as $index => $step)
                            <li>
                                <i class="fas fa-arrow-right"></i>
                                {{ $step->step_text ?? 'بدون وصف' }}

                                @if ($step->media && is_array($step->media))
                                    <div class="step-media mt-2">
                                        @foreach ($step->media as $mediaItem)
                                            @php
                                                $mediaPath = isset($mediaItem['path'])
                                                    ? Storage::url($mediaItem['path'])
                                                    : '';
                                                $mediaType = $mediaItem['type'] ?? 'unknown';
                                            @endphp

                                            @if (!empty($mediaPath))
                                                @if ($mediaType === 'image')
                                                    <img src="{{ $mediaPath }}" alt="Step Media"
                                                        class="media-preview img-fluid"
                                                        style="max-width: 200px; margin: 5px;">
                                                @elseif ($mediaType === 'video')
                                                    <video src="{{ $mediaPath }}" controls class="media-preview video"
                                                        style="max-width: 200px; margin: 5px;"></video>
                                                @endif
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
                {{-- قسم خطوات التحضير --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">خطوات التحضير</label>
                    <div id="steps-container">
                        {{-- Steps will be loaded here by JavaScript --}}
                    </div>
                    <button type="button" id="add-step-btn" class="btn add-step-btn">
                        <i class="fas fa-plus-circle ms-1"></i> أضف خطوة
                    </button>
                    <input type="hidden" name="steps" id="hidden-steps-input">
                    @error('steps')
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
                    <label for="is_free" class="form-label">نوع الوصفة</label>
                    <select class="form-select" name="is_free" id="is_free">
                        <option value="1" {{ old('is_free', $recipe->is_free) == 1 ? 'selected' : '' }}>مجانية
                        </option>
                        <option value="0" {{ old('is_free', $recipe->is_free) == 0 ? 'selected' : '' }}>مدفوعة
                        </option>
                    </select>
                    @error('is_free')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">الحالة</label>
                    <select class="form-select" name="status" id="status">
                        <option value="1" {{ old('status', $recipe->status) == 1 ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('status', $recipe->status) == 0 ? 'selected' : '' }}>غير فعال
                        </option>
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

            // Function to create an ingredient item HTML
            function createIngredientItem(value = '', isHeading = false) {
                const itemHtml = `
                    <div class="ingredient-item" data-type="${isHeading ? 'heading' : 'ingredient'}">
                        <span class="ingredient-type-indicator">${isHeading ? 'عنوان' : 'مكون'}</span>
                        <input type="text" class="form-control ingredient-text" value="${value}" placeholder="ادخل المكون أو العنوان" required>
                        <div class="btn-group ingredient-buttons" role="group">
                            <button type="button" class="btn btn-sm btn-is-heading ${isHeading ? 'active' : ''}" data-type="heading">
                                <i class="fas fa-heading"></i> عنوان
                            </button>
                            <button type="button" class="btn btn-sm btn-is-ingredient ${!isHeading ? 'active' : ''}" data-type="ingredient">
                                <i class="fas fa-list-alt"></i> مكون
                            </button>
                        </div>
                        <button type="button" class="btn btn-sm remove-ingredient-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                $('#ingredients-container').append(itemHtml);
            }

            // Load existing ingredients
            const oldIngredientsString = @json(old('ingredients'));
            const recipeIngredientsString = @json($recipe->ingredients);

            let ingredientsToParse = oldIngredientsString || recipeIngredientsString ? (oldIngredientsString ||
                recipeIngredientsString).split('\n') : [];

            if (ingredientsToParse.length > 0 && (ingredientsToParse.length > 1 || ingredientsToParse[0].trim() !==
                    '')) {
                ingredientsToParse.forEach(line => {
                    const trimmedLine = line.trim();
                    if (trimmedLine.startsWith('##')) {
                        createIngredientItem(trimmedLine.substring(2).trim(), true);
                    } else if (trimmedLine !== '') {
                        createIngredientItem(trimmedLine, false);
                    }
                });
            } else {
                createIngredientItem();
            }

            // Image preview logic
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
                    }
                });
            }

            // Dynamic Ingredients Logic
            const ingredientsContainer = $('#ingredients-container');
            const addIngredientBtn = $('#add-ingredient-btn');

            addIngredientBtn.on('click', function() {
                createIngredientItem();
            });

            ingredientsContainer.on('click', '.remove-ingredient-btn', function() {
                $(this).closest('.ingredient-item').remove();
                if (ingredientsContainer.children().length === 0) {
                    createIngredientItem();
                }
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

            // Prepare ingredients data
            $('#recipe-form').on('submit', function(e) {
                e.preventDefault();

                const allIngredients = [];
                ingredientsContainer.find('.ingredient-item').each(function() {
                    const $item = $(this);
                    const text = $item.find('.ingredient-text').val().trim();
                    const type = $item.data('type');

                    if (text) {
                        allIngredients.push(type === 'heading' ? '##' + text : text);
                    }
                });

                $('#hidden-ingredients-input').val(allIngredients.join('\n'));

                Swal.fire({
                    title: 'جاري الحفظ...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => Swal.showLoading()
                });

                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.recipes.ajax-update', $recipe->id) }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'تم بنجاح!',
                                text: response.message,
                                confirmButtonText: 'موافق'
                            }).then((result) => {
                                if (result.isConfirmed) window.location.href = response
                                    .redirect_url;
                            });
                        } else {
                            let errorMessage = 'حدث خطأ أثناء الحفظ:\n';
                            if (response.errors) $.each(response.errors, function(field,
                                messages) {
                                errorMessage += messages.join('\n') + '\n';
                            });
                            else if (response.message) errorMessage = response.message;
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ!',
                                text: errorMessage,
                                confirmButtonText: 'موافق'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        let errorMessage = 'حدث خطأ في الاتصال بالخادم';
                        if (xhr.responseJSON && xhr.responseJSON.message) errorMessage = xhr
                            .responseJSON.message;
                        else if (error) errorMessage = 'خطأ غير معروف: ' + error;
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ!',
                            text: errorMessage,
                            confirmButtonText: 'موافق'
                        });
                    }
                });
            });
        });

        // Function to create a step item HTML
        function createStepItem(stepText = '', media = [], stepId = null) {
            const stepIndex = $('#steps-container .step-item').length + 1;
            const itemHtml = `
                <div class="step-item" data-step-id="${stepId || ''}">
                    <span class="step-number-indicator">الخطوة ${stepIndex}</span>
                    <textarea class="form-control step-text" rows="3" placeholder="ادخل وصف الخطوة" required>${stepText || ''}</textarea>
                    <div class="step-media-section">
                        <label class="file-upload-label">
                            <i class="fas fa-upload"></i> رفع صورة/فيديو
                            <input type="file" class="upload-input-hidden step-media-input" accept="image/*,video/*" multiple>
                        </label>
                        <div class="multiple-media-previews">
                            ${media.map((item, index) => `
                                    <div class="media-item">
                                        ${item.type === 'image' ? 
                                            `<img src="${asset('storage/' + item.path)}" class="media-preview" style="max-width: 100px;">` :
                                            `<video src="${asset('storage/' + item.path)}" class="media-preview" style="max-width: 100px;" controls></video>`
                                        }
                                        <button type="button" class="remove-single-media">×</button>
                                        <input type="hidden" name="existing_media[${stepId || 'new_' + Date.now()}_${index}]" value="${JSON.stringify(item)}">
                                    </div>
                                `).join('')}
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-step-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            $('#steps-container').append(itemHtml);
            updateStepNumbers();
        }

        // Update step numbers
        function updateStepNumbers() {
            $('#steps-container .step-item').each(function(index) {
                $(this).find('.step-number-indicator').text(`الخطوة ${index + 1}`);
            });
        }

        // Load existing steps from the recipe
        const recipeSteps = @json($recipe->recipeSteps);
        if (recipeSteps && recipeSteps.length > 0) {
            recipeSteps.forEach(step => {
                createStepItem(step.step_text || '', step.media || [], step.id);
            });
        } else {
            createStepItem();
        }

        // Add new step item
        $('#add-step-btn').on('click', function() {
            createStepItem();
        });

        // Handle remove step button
        $('#steps-container').on('click', '.remove-step-btn', function() {
            $(this).closest('.step-item').remove();
            updateStepNumbers();
            if ($('#steps-container .step-item').length === 0) {
                createStepItem();
            }
        });

        // Handle media upload preview
        $('#steps-container').on('change', '.step-media-input', function(event) {
            const $previewContainer = $(this).closest('.step-media-section').find('.multiple-media-previews');
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const mediaType = file.type.startsWith('image') ? 'image' : 'video';
                    const mediaHtml = `
                        <div class="media-item">
                            ${mediaType === 'image' ? 
                                `<img src="${e.target.result}" class="media-preview" style="max-width: 100px;">` :
                                `<video src="${e.target.result}" class="media-preview" style="max-width: 100px;" controls></video>`
                            }
                            <button type="button" class="remove-single-media">×</button>
                        </div>
                    `;
                    $previewContainer.append(mediaHtml);
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle remove media button
        $('#steps-container').on('click', '.remove-single-media', function() {
            $(this).closest('.media-item').remove();
        });

        // Prepare steps data before form submission
        $('#recipe-form').on('submit', function(e) {
            const allSteps = [];
            $('#steps-container .step-item').each(function() {
                const $item = $(this);
                const stepText = $item.find('.step-text').val().trim();
                const stepId = $item.data('step-id') || null;
                const mediaItems = $item.find('.media-item').map(function() {
                    const $media = $(this).find('img, video');
                    const type = $media.is('img') ? 'image' : 'video';
                    const path = $media.attr('src').replace(/^.*storage\//, '');
                    return {
                        type,
                        path
                    };
                }).get();

                if (stepText) {
                    allSteps.push({
                        id: stepId,
                        step_text: stepText,
                        media: mediaItems.length ? mediaItems : null
                    });
                }
            });

            $('#hidden-steps-input').val(JSON.stringify(allSteps));
        });
    </script>

    <script>
        window.addEventListener('beforeunload', function() {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });

        window.addEventListener('load', function() {
            const scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                sessionStorage.removeItem('scrollPosition');
            }
        });
    </script>
@endpush
