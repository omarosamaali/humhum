@extends('layouts.admin')

@section('title', 'تعديل صفحة معلومات عنا')
@section('page-title', 'تعديل صفحة معلومات عنا')

@push('styles')
<style>
    .add-section {
        background: white;
        color: black;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .about-preview {
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .translated-name-field {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        color: black;
    }

    .translated-name-field:focus {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: white;
    }

    .btn-section {
        margin-top: 20px;
    }

    .back-btn {
        background: #6c757d;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        margin-right: 10px;
        display: inline-block;
    }

    .back-btn:hover {
        background: #545b62;
        color: white;
    }

    .update-btn {
        background: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .update-btn:hover {
        background: #218838;
    }

</style>
@endpush

@section('content')
<div class="add-section">
    <h5 class="mb-4">
        <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        كيفية حساب المعلومات الغذائية للمواد الغذائية </h5>
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

    <form action="{{ route('admin.hosp.update', $hosp->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title_ar" class="form-label font-bold">العنوان (بالعربية)</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $hosp->title_ar) }}" required>
                    @error('title_ar')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="description_ar" class="form-label font-bold">الوصف (بالعربية)</label>
                    <textarea class="form-control" id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar', $hosp->description_ar) }}</textarea>
                    @error('description_ar')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- **إضافة قسم الصورة الجديدة: calc_nutrition_image** --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="calc_nutrition_image_input" class="form-label font-bold">الصورة الرئيسية</label>
                    <input type="file" class="form-control" name="calc_nutrition_image" id="calc_nutrition_image_input" accept="image/*">
                    @error('calc_nutrition_image')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                    @if ($hosp->calc_nutrition_image)
                    <img id="current_calc_nutrition_image_preview" src="{{ Storage::url($hosp->calc_nutrition_image) }}" alt="صورة حساب التغذية الحالية" class="about-preview mt-2 p-2 current-image-preview">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_calc_nutrition_image" id="remove_calc_nutrition_image">
                        <label class="form-check-label text-black" for="remove_calc_nutrition_image">
                            حذف الصورة الرئيسية
                        </label>
                    </div>
                    @endif
                    <img id="calc_nutrition_image_preview" src="#" alt="معاينة صورة حساب التغذية الجديدة" class="about-preview mt-2" style="display: none;">
                </div>
            </div>

            {{-- **إضافة قسم الصورة الجديدة: nutrition_label_image** --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nutrition_label_image_input" class="form-label font-bold">الصورة الفرعية</label>

                    <input type="file" class="form-control" name="nutrition_label_image" id="nutrition_label_image_input" accept="image/*">
                    @error('nutrition_label_image')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                    @if ($hosp->nutrition_label_image)
                    <img id="current_nutrition_label_image_preview" src="{{ Storage::url($hosp->nutrition_label_image) }}" alt="صورة ملصق التغذية الحالية" class="about-preview mt-2 p-2 current-image-preview">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_nutrition_label_image" id="remove_nutrition_label_image">
                        <label class="form-check-label text-black" for="remove_nutrition_label_image">
                            حذف الصورة الفرعية
                        </label>
                    </div>
                    @endif
                    <img id="nutrition_label_image_preview" src="#" alt="معاينة صورة ملصق التغذية الجديدة" class="about-preview mt-2" style="display: none;">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="status" class="form-label font-bold">الحالة</label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="1" {{ old('status', $hosp->status) == '1' ? 'selected' : '' }}>فعال
                        </option>
                        <option value="0" {{ old('status', $hosp->status) == '0' ? 'selected' : '' }}>غير
                            فعال</option>
                    </select>
                    @error('status')
                    <div class="text-black">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <h6 class="mt-4 mb-3 text-black">الأسماء والأوصاف المترجمة (للقراءة فقط - تتحدث تلقائياً):</h6>
        <div class="row">
            @foreach ($targetLanguages as $code => $name)
            <div class="col-md-12 mb-3 border rounded-lg p-2">
                <label for="title_{{ $code }}" class="form-label font-bold">{{ $name }}
                    (العنوان)
                    :</label>
                <span class="text-right">
                    {{ old('title_' . $code, $hosp->{'title_' . $code}) }}
                </span>
                <br>
                <label for="description_{{ $code }}" class="form-label font-bold">{{ $name }}
                    (الوصف):</label>
                <span class="text-right">
                    {{ old('description_' . $code, $hosp->{'description_' . $code}) }}
                </span>
            </div>
            @endforeach
        </div>

        <div class="btn-section text-center">
            <a href="{{ route('admin.about-us.index') }}" id="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة للقائمة
            </a>

            <button type="submit" class="update-btn">
                <i class="fas fa-save ms-1"></i>
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main Image elements
        const mainImageInput = document.getElementById('main_image_input');
        const mainImagePreview = document.getElementById('main_image_preview');
        const currentMainImagePreview = document.getElementById('current_main_image_preview');
        const removeMainImageCheckbox = document.getElementById('remove_main_image');

        // Sub Image elements
        const subImageInput = document.getElementById('sub_image_input');
        const subImagePreview = document.getElementById('sub_image_preview');
        const currentSubImagePreview = document.getElementById('current_sub_image_preview');
        const removeSubImageCheckbox = document.getElementById('remove_sub_image');

        // New: Calc Nutrition Image elements
        const calcNutritionImageInput = document.getElementById('calc_nutrition_image_input');
        const calcNutritionImagePreview = document.getElementById('calc_nutrition_image_preview');
        const currentCalcNutritionImagePreview = document.getElementById('current_calc_nutrition_image_preview');
        const removeCalcNutritionImageCheckbox = document.getElementById('remove_calc_nutrition_image');

        // New: Nutrition Label Image elements
        const nutritionLabelImageInput = document.getElementById('nutrition_label_image_input');
        const nutritionLabelImagePreview = document.getElementById('nutrition_label_image_preview');
        const currentNutritionLabelImagePreview = document.getElementById('current_nutrition_label_image_preview');
        const removeNutritionLabelImageCheckbox = document.getElementById('remove_nutrition_label_image');


        // Function to handle image preview logic
        function setupImagePreview(inputElement, newPreviewElement, currentPreviewElement, removeCheckboxElement) {
            if (inputElement) {
                inputElement.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            newPreviewElement.src = e.target.result;
                            newPreviewElement.style.display = 'block';
                            if (currentPreviewElement) {
                                currentPreviewElement.style.display = 'none';
                            }
                            if (removeCheckboxElement) {
                                removeCheckboxElement.checked = false;
                            }
                        };
                        reader.readAsDataURL(file);
                    } else {
                        newPreviewElement.src = '#';
                        newPreviewElement.style.display = 'none';
                        if (currentPreviewElement && !removeCheckboxElement.checked) {
                            currentPreviewElement.style.display = 'block';
                        }
                    }
                });
            }

            if (removeCheckboxElement) {
                removeCheckboxElement.addEventListener('change', function() {
                    if (this.checked) {
                        if (currentPreviewElement) {
                            currentPreviewElement.style.display = 'none';
                        }
                        if (newPreviewElement) {
                            newPreviewElement.src = '#';
                            newPreviewElement.style.display = 'none';
                        }
                        if (inputElement) {
                            inputElement.value = '';
                        }
                    } else {
                        // Only show current image if it exists and wasn't removed before
                        if (currentPreviewElement && currentPreviewElement.src &&
                            currentPreviewElement.src !== window.location.href) {
                            currentPreviewElement.style.display = 'block';
                        }
                    }
                });
            }
        }

        // Setup for all image fields
        setupImagePreview(mainImageInput, mainImagePreview, currentMainImagePreview, removeMainImageCheckbox);
        setupImagePreview(subImageInput, subImagePreview, currentSubImagePreview, removeSubImageCheckbox);
        setupImagePreview(calcNutritionImageInput, calcNutritionImagePreview, currentCalcNutritionImagePreview, removeCalcNutritionImageCheckbox); // New setup
        setupImagePreview(nutritionLabelImageInput, nutritionLabelImagePreview, currentNutritionLabelImagePreview, removeNutritionLabelImageCheckbox); // New setup
    });

</script>
@endpush

