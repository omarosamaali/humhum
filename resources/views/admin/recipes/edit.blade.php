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
                    <input type="file" class="form-control" name="dish_image" id="dish_image" accept="image/*">
                    @error('dish_image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <img id="image_preview" src="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : '#' }}"
                        alt="معاينة الصورة" class="dish-image-preview"
                        style="{{ $recipe->dish_image ? '' : 'display: none;' }}">
                </div>
                <!-- ... (بداية الملف كما هي) -->

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

                <!-- ... (باقي الملف كما هو) -->
                @auth
                    @if (auth()->user()->role === 'طاه')
                        <div class="col-md-4 mb-3">
                            <label for="chef_name" class="form-label">الطاهي</label>
                            <input type="text" class="form-control" id="chef_name" value="{{ auth()->user()->name }}"
                                readonly>
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
                                <option value="1" {{ old('is_free', $recipe->is_free) == '1' ? 'selected' : '' }}>مجانية
                                </option>
                                <option value="0" {{ old('is_free', $recipe->is_free) == '0' ? 'selected' : '' }}>مدفوعة
                                </option>
                            </select>
                        @else
                            <select class="form-select" name="is_free" id="is_free" required>
                                <option value="">اختر نوع الوصفة</option>
                                <option value="1" {{ old('is_free', $recipe->is_free) == '1' ? 'selected' : '' }}>مجانية
                                </option>
                                <option value="0" {{ old('is_free', $recipe->is_free) == '0' ? 'selected' : '' }}>نظام
                                    الباقات</option>
                            </select>
                        @endcan
                    </div>
                    @error('is_free')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="main_category_id" class="form-label">التصنيف الرئيسي</label>
                    <select class="form-control" name="main_category_id" id="main_category_id" required>
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

                <div class="col-md-12 mb-3" id="id_sub_categories_container">
                    <label for="sub_categories" class="form-label">التصنيفات الفرعية</label>
                    @php
                        $selectedSubCategoryIds = old(
                            'sub_categories',
                            $recipe->subCategories->pluck('id')->toArray() ?? [],
                        );
                        $selectedSubCategories = \App\Models\SubCategory::whereIn('id', $selectedSubCategoryIds)->get();
                    @endphp

                    <select class="form-control select2" name="sub_categories[]" id="id_sub_categories"
                        multiple="multiple">
                        @foreach ($selectedSubCategories as $sub)
                            <option value="{{ $sub->id }}" selected>{{ $sub->name_ar }}</option>
                        @endforeach
                    </select>
                    @error('sub_categories')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div style="background-color: #f00f0f; padding: 5px; border-radius: 5px; width: fit-content; ">
                    @forelse ($recipe->subCategories as $subCategory)
                        <span class="badge badge-info">{{ $subCategory->name_ar }}</span>
                    @empty
                        <span class="text-muted">لا توجد</span>
                    @endforelse
                </div>
                <div style="width: 100%; height: 1px; background: #afafaf; margin-top: 10px; margin-bottom: 10px;"></div>
                <div class="col-md-12 mb-3">
                    {{-- <label class="form-label">المكونات</label>
                    <ul class="content-list">
                        @foreach (explode("\n", $recipe->ingredients) as $ingredient)
                            @if (trim($ingredient) !== '')
                                <li class="font-{{ trim($ingredient) == 'المكونات' ? 'normal' : 'bold' }}">
                                    {{ trim($ingredient) }}
                                </li>
                            @endif
                        @endforeach
                    </ul> --}}
                    <div class="mb-3">
                        <label class="form-label">المكونات</label>
                        <div id="ingredients-container">
                            {{-- سيتم ملء هذا الـ div بواسطة JavaScript --}}
                        </div>
                        <button type="button" id="add-ingredient-btn" class="btn btn-primary mt-2">
                            <i class="fas fa-plus-circle ms-1"></i> أضف مكون / عنوان جديد
                        </button>
                    </div>
                    <input type="hidden" name="ingredients" id="hidden-ingredients-input">
                    @error('ingredients')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <textarea name="ingredients" id="ingredients" style="display: none;" rows="10">{{ old('ingredients', $recipe->ingredients ?? '') }}</textarea>
                </div>

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
                                    <span class="char-counter">متبقي:
                                        {{ 500 - mb_strlen(old('steps_data.' . $index . '.description', $step['description'] ?? '')) }}
                                        حرف</span>
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
                    <button type="button" id="add-step-btn" class="btn add-ingredient-btn">
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
                        <option value="1" {{ old('status', $recipe->status) == true ? 'selected' : '' }}>فعال
                        </option>
                        <option value="0" {{ old('status', $recipe->status) == false ? 'selected' : '' }}>غير فعال
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
    $('#id_sub_categories').select2({
        placeholder: 'اختر التصنيفات الفرعية',
        allowClear: true,
        dir: 'rtl'
    });

    // Function to load sub-categories
    function loadSubCategories(mainCategoryId, preserveExisting = false) {
        const subCategoriesContainer = $('#id_sub_categories_container');
        const subCategoriesSelect = $('#id_sub_categories');

        if (mainCategoryId) {
            subCategoriesContainer.show();
            
            // إذا كان preserveExisting = true، احتفظ بالقيم الموجودة
            if (!preserveExisting) {
                subCategoriesSelect.empty().append('<option value="">جاري التحميل...</option>').trigger('change');
            }

            $.ajax({
                url: '{{ route('admin.recipes.subcategories') }}',
                type: 'GET',
                data: {
                    main_category_id: mainCategoryId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // احتفظ بالقيم المحددة حالياً قبل مسح الـ select
                    const currentSelectedValues = subCategoriesSelect.val() || [];
                    
                    subCategoriesSelect.empty();

                    if (response.length > 0) {
                        $.each(response, function(index, subCategory) {
                            const isSelected = currentSelectedValues.includes(subCategory.id.toString());
                            subCategoriesSelect.append(
                                `<option value="${subCategory.id}" ${isSelected ? 'selected' : ''}>${subCategory.name_ar}</option>`
                            );
                        });
                        
                        // استعادة القيم المحددة
                        if (currentSelectedValues.length > 0) {
                            subCategoriesSelect.val(currentSelectedValues).trigger('change');
                        } else {
                            // Set old or saved values after options are populated (only if no current values)
                            @if (old('sub_categories'))
                                const oldValues = @json(old('sub_categories'));
                                subCategoriesSelect.val(oldValues).trigger('change');
                            @elseif ($recipe->sub_categories && count($recipe->sub_categories) > 0)
                                const savedValues = @json($recipe->sub_categories->pluck('id')->toArray());
                                subCategoriesSelect.val(savedValues).trigger('change');
                            @endif
                        }
                    } else {
                        subCategoriesSelect.append('<option value="">لا توجد تصنيفات فرعية</option>');
                    }
                    subCategoriesSelect.trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    subCategoriesSelect.empty().append(
                        '<option value="">حدث خطأ في التحميل</option>').trigger('change');
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'فشل تحميل التصنيفات الفرعية. حاول مرة أخرى.'
                    });
                }
            });
        } else {
            subCategoriesContainer.hide();
            subCategoriesSelect.empty().trigger('change');
        }
    }

    // التحقق من وجود options في التصنيفات الفرعية عند تحميل الصفحة
    const initialMainCategoryId = $('#main_category_id').val();
    const hasExistingSubCategories = $('#id_sub_categories option').length > 0;
    
    if (initialMainCategoryId) {
        if (hasExistingSubCategories) {
            // إذا كانت هناك تصنيفات فرعية موجودة بالفعل، لا تحمل من جديد
            console.log('Sub-categories already exist, skipping AJAX load');
        } else {
            // إذا لم تكن هناك تصنيفات فرعية، حمل من الـ AJAX
            loadSubCategories(initialMainCategoryId);
        }
    } else {
        // If no main category is selected, try to load sub-categories based on saved data
        @if ($recipe->sub_categories && count($recipe->sub_categories) > 0)
            const savedMainCategoryId = '{{ $recipe->main_category_id }}';
            if (savedMainCategoryId && !hasExistingSubCategories) {
                loadSubCategories(savedMainCategoryId);
            }
        @endif
    }

    // Handle change event for main category
    $('#main_category_id').on('change', function() {
        const selectedMainCategoryId = $(this).val();
        loadSubCategories(selectedMainCategoryId, false); // لا تحتفظ بالقيم الموجودة عند تغيير التصنيف الرئيسي
    });
});

    </script>
    <script>
        // ** ملاحظة هامة جداً: تأكد أن هذا الكود يوضع بعد تحميل مكتبة jQuery **
        $(document).ready(function() {
            // --- المتغيرات الأساسية وعناصر الـ DOM ---
            const ingredientsContainer = $('#ingredients-container');
            const addIngredientBtn = $('#add-ingredient-btn');
            const stepsContainer = $('#steps-container');
            const addStepBtn = $('#add-step-btn');
            const recipeForm = $('#recipe-form');

            const MAX_CHARS_INGREDIENT = 200;
            const MAX_CHARS_STEP = 500;
            let stepFileInputCounter = 0; // لضمان IDs فريدة لحقول رفع الملفات

            // --- دوال مساعدة عامة ---
            // دالة لتحديث عداد الأحرف لحقول الإدخال
            function updateCharCounter($input, maxLength) {
                const currentLength = $input.val().length;
                const remainingChars = maxLength - currentLength;
                const $counter = $input.next('.char-counter');
                $counter.text(`متبقي: ${remainingChars} حرف`);
                $counter.css('color', remainingChars < 0 ? 'red' : '#666');
            }

            // --- دوال خاصة بالمكونات (Ingredients) ---
            // دالة لإنشاء عنصر مكون جديد (أو عنوان) وإضافته للـ DOM
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
                updateCharCounter($newInput, MAX_CHARS_INGREDIENT); // تحديث العداد الأولي
            }

            // تحميل المكونات الموجودة من قاعدة البيانات عند تحميل الصفحة
            // `json_encode` هنا تحول قيمة PHP إلى نص JavaScript.
            // `old('ingredients', $recipe->ingredients ?? '')` بتجيب القيمة القديمة لو فيه خطأ في الفورم، وإلا بتجيبها من الوصفة.
            const existingIngredientsString = @json(old('ingredients', $recipe->ingredients ?? ''));
            console.log(existingIngredientsString);

            if (existingIngredientsString && existingIngredientsString.trim()) {
                const lines = existingIngredientsString.split('\n'); // تقسيم النص لأسطر
                lines.forEach(line => {
                    const trimmedLine = line.trim();
                    if (trimmedLine.startsWith('##')) { // لو السطر بيبدأ بـ "##" ده معناه إنه عنوان
                        createIngredientItem(trimmedLine.replace('##', '').trim(),
                            true); // بنشيل "##" ونضيفه كعنوان
                    } else if (trimmedLine) { // لو سطر عادي ومش فاضي
                        createIngredientItem(trimmedLine, false); // بنضيفه كمكون عادي
                    }
                });
            } else {
                // لو مفيش مكونات موجودة، بنضيف حقل فارغ عشان المستخدم يبدأ يكتب
                createIngredientItem();
            }

            // --- إدارة أحداث المكونات (Event Listeners) ---
            // عند النقر على زر "أضف مكون / عنوان جديد"
            addIngredientBtn.on('click', function() {
                createIngredientItem();
            });

            // عند النقر على زر الحذف (باستخدام Delegation عشان العناصر اللي هتتضاف بعدين)
            ingredientsContainer.on('click', '.remove-ingredient-btn', function() {
                $(this).closest('.ingredient-item').remove();
            });

            // عند النقر على أزرار "عنوان" أو "مكون" لتبديل النوع
            ingredientsContainer.on('click', '.ingredient-buttons button', function() {
                const $this = $(this);
                const itemType = $this.data('type'); // بنجيب نوع العنصر (heading/ingredient)
                const $parentItem = $this.closest('.ingredient-item');
                const $typeIndicator = $parentItem.find('.ingredient-type-indicator');

                $parentItem.attr('data-type', itemType); // بنحدث الـ data-type للعنصر الأب
                $this.addClass('active').siblings().removeClass(
                    'active'); // بنخلي الزر اللي اتضغط عليه Active
                $typeIndicator.text(itemType === 'heading' ? 'عنوان' : 'مكون'); // بنحدث النص الظاهر
            });

            // تحديث عداد الأحرف عند التركيز، فقدان التركيز، والكتابة في حقل النص
            ingredientsContainer.on('focus', '.ingredient-text', function() {
                $(this).next('.char-counter').addClass('visible');
                updateCharCounter($(this), MAX_CHARS_INGREDIENT);
            }).on('blur', '.ingredient-text', function() {
                $(this).next('.char-counter').removeClass('visible');
            }).on('input', '.ingredient-text', function() {
                updateCharCounter($(this), MAX_CHARS_INGREDIENT);
            });

            // أزرار التحريك لأعلى ولأسفل
            ingredientsContainer.on('click', '.move-up-btn', function() {
                const $currentItem = $(this).closest('.ingredient-item');
                const $prevItem = $currentItem.prev('.ingredient-item');
                if ($prevItem.length) {
                    $currentItem.insertBefore($prevItem);
                }
            });

            ingredientsContainer.on('click', '.move-down-btn', function() {
                const $currentItem = $(this).closest('.ingredient-item');
                const $nextItem = $currentItem.next('.ingredient-item');
                if ($nextItem.length) {
                    $currentItem.insertAfter($nextItem);
                }
            });

            // --- دوال خاصة بالخطوات (Steps) ---
            // دالة لتحديث أرقام الخطوات بعد أي تغيير في الترتيب أو الحذف
            function updateStepIndexes() {
                stepsContainer.find('.step-item').each(function(index) {
                    $(this).attr('data-step-index', index);
                    $(this).find('.step-number-indicator').text(`الخطوة ${index + 1}`);
                    // تحديث الـ name والـ id لحقول رفع الملفات عشان تتوافق مع الـ index الجديد
                    $(this).find('.step-media-input').attr('name', `step_media[${index}][]`).attr('id',
                        `media_step_${index}`);
                    $(this).find('.file-upload-label').attr('for', `media_step_${index}`);
                });
            }

            // دالة لإعداد الـ Event Listeners لعنصر خطوة معين (للعناصر الجديدة أو المحملة)
            function setupStepItemEventListeners($stepItem) {
                // عند النقر على زر "رفع المزيد"
                $stepItem.find('.add-more-media-btn').on('click', function() {
                    $(this).closest('.step-media-section').find('.step-media-input').click();
                });

                // عند اختيار ملفات جديدة (صور/فيديوهات)
                $stepItem.find('.step-media-input').on('change', function(event) {
                    const files = event.target.files;
                    const $multiplePreviews = $(this).closest('.step-media-section').find(
                        '.multiple-media-previews');
                    const $mediaActions = $(this).closest('.step-media-section').find(
                        '.step-media-actions');
                    const $currentStepItem = $(this).closest('.step-item');

                    if (files.length > 0) {
                        $mediaActions.show();
                        $multiplePreviews.show();

                        // كل خطوة هتحتفظ بقائمة الملفات الجديدة اللي المستخدم اختارها
                        if (!$currentStepItem[0].allMediaFiles) {
                            $currentStepItem[0].allMediaFiles = [];
                        }

                        Array.from(files).forEach(file => {
                            $currentStepItem[0].allMediaFiles.push(
                                file); // إضافة الملف لقائمة الملفات الجديدة للخطوة دي
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // عرض معاينة للملف (صورة أو فيديو)
                                const mediaPreview = file.type.startsWith('image/') ?
                                    `<div class="media-item" data-file-name="${file.name}" style="position: relative;">
                                        <img src="${e.target.result}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;">
                                        <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                                    </div>` :
                                    `<div class="media-item" data-file-name="${file.name}" style="position: relative;">
                                        <video src="${e.target.result}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video>
                                        <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                                    </div>`;
                                $multiplePreviews.append(mediaPreview);
                            };
                            reader.readAsDataURL(file);
                        });
                        $(this).val(''); // مسح قيمة حقل الملفات عشان يسمح باختيار نفس الملف تاني
                    }
                });

                // عند النقر على زر حذف ملف واحد من المعاينات
                $stepItem.on('click', '.remove-single-media', function() {
                    const $mediaItem = $(this).closest('.media-item');
                    const $currentStepItem = $(this).closest('.step-item');
                    const mediaIndex = $mediaItem.index(); // بنجيب ترتيب العنصر في المعاينات

                    // لو الملف ده كان جديد ومختار من المستخدم
                    if ($currentStepItem[0].allMediaFiles && $currentStepItem[0].allMediaFiles[
                            mediaIndex] !== undefined) {
                        $currentStepItem[0].allMediaFiles.splice(mediaIndex,
                            1); // بنحذفه من قائمة الملفات الجديدة
                    }
                    // لو ده ملف موجود بالفعل ومحمل من الداتابيز، بيتم حذفه من الـ DOM فقط
                    // عند الإرسال، البيانات اللي هتتبعت هتكون فقط الموجودة في الـ DOM حاليًا (لو URLs) أو في allMediaFiles (لو ملفات جديدة)

                    $mediaItem.remove(); // حذف عنصر المعاينة من الـ DOM
                    if ($currentStepItem.find('.media-item').length === 0) {
                        $currentStepItem.find('.step-media-actions').hide();
                        $currentStepItem.find('.multiple-media-previews').hide();
                    }
                });

                // عند النقر على زر "مسح الكل" للوسائط
                $stepItem.find('.clear-all-media-btn').on('click', function() {
                    const $currentStepItem = $(this).closest('.step-item');
                    $currentStepItem[0].allMediaFiles = []; // مسح كل الملفات الجديدة
                    $currentStepItem.find('.multiple-media-previews').empty()
                        .hide(); // مسح المعاينات وإخفائها
                    $currentStepItem.find('.step-media-actions').hide();
                    $currentStepItem.find('.step-media-input').val(''); // مسح قيمة حقل الإدخال
                });

                // تحديث عداد الأحرف لحقل نص الخطوة
                $stepItem.find('.step-text').on('focus', function() {
                    $(this).next('.char-counter').addClass('visible');
                    updateCharCounter($(this), MAX_CHARS_STEP);
                }).on('blur', function() {
                    $(this).next('.char-counter').removeClass('visible');
                }).on('input', function() {
                    updateCharCounter($(this), MAX_CHARS_STEP);
                });
            }

            // دالة لإنشاء عنصر خطوة جديد وإضافته للـ DOM
            function createStepItem(stepValue = '', existingMedia = []) {
                const index = stepsContainer.children().length;
                stepFileInputCounter++; // زيادة العداد لضمان ID فريد لحقل الملف
                const uniqueId = `media_step_${index}_${stepFileInputCounter}`; // ID فريد لكل حقل ملف

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
                                id="${uniqueId}"
                                accept="image/*,video/*"
                                multiple
                                data-step-index="${index}">
                            <label for="${uniqueId}" class="btn btn-info file-upload-label add-media-btn">
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
                $newItem[0].allMediaFiles = []; // لإنشاء مصفوفة داخل العنصر لتخزين الملفات الجديدة
                stepsContainer.append($newItem);

                // لو فيه وسائط موجودة مسبقًا (جاية من الداتابيز)، بنعرضها
                if (existingMedia && existingMedia.length > 0) {
                    const $multiplePreviews = $newItem.find('.multiple-media-previews');
                    const $mediaActions = $newItem.find('.step-media-actions');
                    existingMedia.forEach(media => {
                        // بناء الـ URL الكامل للصورة/الفيديو المخزن
                        const mediaUrl = `${window.location.origin}/storage/${media.url}`;
                        const mediaPreview = media.type === 'image' ?
                            `<div class="media-item" data-media-url="${media.url}" data-media-type="${media.type}" style="position: relative;">
                                <img src="${mediaUrl}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;">
                                <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                            </div>` :
                            `<div class="media-item" data-media-url="${media.url}" data-media-type="${media.type}" style="position: relative;">
                                <video src="${mediaUrl}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video>
                                <button class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                            </div>`;
                        $multiplePreviews.append(mediaPreview);
                    });
                    if (existingMedia.length > 0) {
                        $multiplePreviews.show();
                        $mediaActions.show();
                    }
                }
                setupStepItemEventListeners($newItem); // إعداد الأحداث للعنصر الجديد
                const $newInput = $newItem.find('.step-text');
                updateCharCounter($newInput, MAX_CHARS_STEP);
                updateStepIndexes(); // تحديث أرقام الخطوات بعد الإضافة
            }

            // تحميل الخطوات الموجودة من قاعدة البيانات عند تحميل الصفحة
            // `json_encode` هنا بتحول مصفوفة PHP لكائن JSON في JavaScript
            const existingSteps = @json(old('steps', $recipe->steps ?? []));
            console.log('Existing Steps:', existingSteps);

            // ** إضافة هذا السطر لتنظيف الحاوية من أي محتوى موجود مسبقاً **
            stepsContainer.empty();

            if (existingSteps && existingSteps.length > 0) {
                existingSteps.forEach(step => {
                    createStepItem(step.description, step.media || []);
                });
            } else {
                createStepItem(); // أضف خطوة فارغة إذا لم تكن هناك خطوات موجودة
            }


            // --- إدارة أحداث الخطوات (Event Listeners) ---
            // عند النقر على زر "أضف خطوة جديدة"
            addStepBtn.on('click', function() {
                createStepItem();
            });

            // عند النقر على زر حذف الخطوة (باستخدام Delegation)
            stepsContainer.on('click', '.remove-step-btn', function() {
                $(this).closest('.step-item').remove();
                updateStepIndexes(); // تحديث الأرقام بعد الحذف
            });

            // أزرار التحريك لأعلى ولأسفل للخطوات
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


            // --- معالجة إرسال الفورم (Submit Form) ---
            recipeForm.on('submit', function(e) {
                e.preventDefault(); // منع الإرسال الافتراضي للفورم عشان نتحكم فيه بالـ AJAX

                const formData = new FormData(this); // لجمع كل بيانات الفورم بما فيها الملفات

                // ** 1. جمع بيانات المكونات **
                const ingredients = [];
                ingredientsContainer.find('.ingredient-item').each(function() {
                    const $this = $(this);
                    const type = $this.data('type');
                    const text = $this.find('.ingredient-text').val().trim();
                    if (text) {
                        // إضافة "##" لو كان عنوان عشان يتعرف عليه في الـ backend
                        ingredients.push(`${type === 'heading' ? '##' : ''}${text}`);
                    }
                });
                // تعيين قيمة حقل 'ingredients' المخفي بسلسلة نصية واحدة
                formData.set('ingredients', ingredients.join('\n'));
                // تحديث قيمة حقل الـ hidden input مباشرة (اختياري، لكن بيخلي الفورم جاهز لو اتعمل له submit عادي)
                $('#hidden-ingredients-input').val(ingredients.join('\n'));

                // ** 2. جمع بيانات الخطوات والملفات **
                const steps = [];
                // مسح أي حقول step_media[X][] موجودة مسبقًا في formData لتجنب التكرار
                // (مهم لو الفورم بيتبعت كذا مرة بدون تحديث الصفحة)
                for (let pair of Array.from(formData
                        .entries())) { // Convert iterator to array for easier manipulation
                    if (pair[0].startsWith('step_media[')) {
                        formData.delete(pair[0]);
                    }
                }

                stepsContainer.find('.step-item').each(function(index) {
                    const $this = $(this);
                    const stepText = $this.find('.step-text').val().trim();
                    const mediaFiles = $this[0].allMediaFiles ||
                []; // الملفات الجديدة اللي اختارها المستخدم للخطوة دي
                    const existingMediaInStep = []; // الوسائط اللي كانت موجودة ومتحملة من الداتابيز

                    // جمع الـ URLs للوسائط الموجودة بالفعل في الخطوة
                    $this.find('.media-item[data-media-url]').each(function() {
                        const $mediaItem = $(this);
                        const url = $mediaItem.data('media-url');
                        const type = $mediaItem.data('media-type'); // 'image' or 'video'
                        existingMediaInStep.push({
                            url: url,
                            type: type
                        });
                    });

                    if (stepText) {
                        // إضافة الملفات الجديدة (اللي المستخدم اختارها حالياً) للـ FormData
                        mediaFiles.forEach((file) => {
                            formData.append(`step_media[${index}][]`, file);
                        });

                        // إضافة بيانات الخطوة (النص والوسائط الموجودة بالفعل) لمصفوفة الخطوات
                        steps.push({
                            description: stepText,
                            media: existingMediaInStep // بنبعت الـ URLs بتاعة الوسائط الموجودة
                        });
                    }
                });

                // التحقق من وجود خطوات (ممكن تضيفها كـ validation من ناحية الـ backend برضه)
                if (steps.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'يجب إضافة خطوة واحدة على الأقل للوصفة!'
                    });
                    return; // إيقاف إرسال الفورم
                }

                // تعيين قيمة حقل 'steps_data' المخفي كـ JSON string
                formData.set('steps_data', JSON.stringify(steps));
                $('#hidden-steps-data').val(JSON.stringify(steps)); // تحديث قيمة الـ hidden input

                // ** 3. إرسال البيانات باستخدام AJAX **
                $.ajax({
                    url: $(this).attr('action'), // الـ URL اللي الفورم بيشاور عليه
                    method: 'POST', //Laravel هيتعامل معها كـ PUT لو @method('PUT') موجودة
                    data: formData,
                    processData: false, // مهم جداً: jQuery ميعالجش البيانات (عشان FormData بتعالجها)
                    contentType: false, // مهم جداً: jQuery ميعيينش نوع المحتوى (عشان FormData بتعينه)
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'نجح!',
                                text: response.message || 'تم حفظ الوصفة بنجاح!'
                            }).then(() => {
                                if (response.redirect_url) {
                                    window.location.href = response
                                        .redirect_url; // الانتقال لصفحة أخرى
                                } else {
                                    location
                                        .reload(); // إعادة تحميل الصفحة لرؤية التغييرات
                                }
                            });
                        } else {
                            // لو الـ backend رجع success: false (مثلاً بسبب منطق معين)
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                text: response.message || 'حدث خطأ غير متوقع.'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'حدث خطأ أثناء الحفظ!';
                        let errors = [];
                        if (xhr.status === 422) { // خطأ Validation من Laravel
                            const response = xhr.responseJSON;
                            // جمع كل رسائل الأخطاء
                            errors = response.errors ? Object.values(response.errors).flat() : [
                                response.message || 'خطأ في التحقق من البيانات.'
                            ];
                            errorMessage = errors.join('<br>'); // عرضهم في سطر واحد بفاصل <br>
                        } else if (xhr.status ===
                            500) { // خطأ في الخادم (Internal Server Error)
                            errorMessage = 'خطأ في الخادم: ' + (xhr.responseJSON?.message ||
                                'يرجى التحقق من سجلات الخادم.');
                        } else {
                            // أي خطأ آخر
                            errorMessage = xhr.responseJSON?.message || 'خطأ غير معروف حدث.';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            html: errorMessage // استخدام html لعرض الأخطاء المتعددة المنسقة
                        });
                    }
                });
            });
        });
    </script>
@endpush
