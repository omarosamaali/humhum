@extends('layouts.admin')

@section('title', 'تعديل التصنيف الفرعي')
@section('page-title', 'تعديل التصنيف الفرعي')

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

        .package-preview {
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
    </style>
@endpush

@section('content')
    <div class="add-section">
        <h5 class="mb-4">
            <i class="fas fa-box-open ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تعديل التصنيف الفرعي: {{ $subCategory->name_ar }}
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

        <form action="{{ route('admin.subCategories.update', $subCategory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Add Select Dropdown For Main Category --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label font-bold">التصنيف الرئيسي</label>
                        <select class="form-select" name="category_id" id="category_id" required>
                            <option value="">اختر التصنيف الرئيسي</option>
                            @foreach ($mainCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $subCategory->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_ar }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name_ar" class="form-label font-bold">اسم التصنيف الفرعي (بالعربية)</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar"
                            value="{{ old('name_ar', $subCategory->name_ar) }}" required>
                        @error('name_ar')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image_input" class="form-label font-bold">صورة التصنيف الفرعي</label>
                        <input type="file" class="form-control" name="image" id="image_input" accept="image/*">
                        @error('image')
                            <div class="text-black">{{ $message }}</div>
                        @enderror

                        @if ($subCategory->image)
                            <img id="current_image_preview" src="{{ $subCategory->image_url }}" alt="الصورة الحالية"
                                class="package-preview mt-2 p-2 current-image-preview">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                <label class="form-check-label text-black" for="remove_image">
                                    حذف الصورة الحالية
                                </label>
                            </div>
                        @endif
                        <img id="image_preview" src="#" alt="معاينة الصورة الجديدة" class="package-preview mt-2"
                            style="display: none;">
                    </div>
                </div> --}}

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label font-bold">الحالة</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="1" {{ old('status', $subCategory->status) == '1' ? 'selected' : '' }}>غير فعال
                            </option>
                            <option value="0" {{ old('status', $subCategory->status) == '0' ? 'selected' : '' }}>فعال
                            </option>
                        </select>
                        @error('status')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <h6 class="mt-4 mb-3 text-black">الأسماء المترجمة (للقراءة فقط - تتحدث تلقائياً):</h6>
            <div class="row">
                @foreach ($targetLanguages as $code => $name)
                    <div class="col-md-12 mb-3 border rounded-lg p-2">
                        <label for="name_{{ $code }}" class="form-label font-bold">{{ $name }} :</label>
                        <span class="text-right">
                            {{ old('name_' . $code, $subCategory->{'name_' . $code}) }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="btn-section text-center">
                <a href="{{ route('admin.subCategories.index') }}" class="back-btn">
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
            const imageInput = document.getElementById('image_input');
            const imagePreview = document.getElementById('image_preview');
            const currentImagePreview = document.getElementById('current_image_preview');
            const removeImageCheckbox = document.getElementById('remove_image');

            if (imageInput) {
                imageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                            if (currentImagePreview) {
                                currentImagePreview.style.display = 'none';
                            }
                            if (removeImageCheckbox) {
                                removeImageCheckbox.checked = false;
                            }
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.src = '#';
                        imagePreview.style.display = 'none';
                        if (currentImagePreview && !removeImageCheckbox.checked) {
                            currentImagePreview.style.display = 'block';
                        }
                    }
                });
            }

            if (removeImageCheckbox) {
                removeImageCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        if (currentImagePreview) {
                            currentImagePreview.style.display = 'none';
                        }
                        if (imagePreview) {
                            imagePreview.src = '#';
                            imagePreview.style.display = 'none';
                        }
                        if (imageInput) {
                            imageInput.value = '';
                        }
                    } else {
                        if (currentImagePreview && currentImagePreview.src && currentImagePreview.src !== window.location.href) {
                            currentImagePreview.style.display = 'block';
                        }
                    }
                });
            }
        });
    </script>
@endpush