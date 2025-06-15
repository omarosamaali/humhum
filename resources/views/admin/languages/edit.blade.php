@extends('layouts.admin')

@section('title', 'تعديل اللغة: ' . $language->name)
@section('page-title', 'تعديل اللغة')

@push('styles')
    <style>
        .edit-section {
            background: white;
            color: black;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
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
        .flag-preview {
            max-width: 150px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
            margin-top: 15px;
            display: block; /* لضمان ظهورها بشكل صحيح */
        }
        .form-check-label {
            color: black;
        }
    </style>
@endpush

@section('content')
    <div class="edit-section">
        <h5 class="mb-4">
            <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تعديل اللغة: {{ $language->name }} ({{ $language->code }})
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

        <form action="{{ route('admin.languages.update', $language->code) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- مهم جداً لتحديث البيانات --}}

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">اسم اللغة (ثابت):</label>
                        {{-- اسم اللغة والكود ثابتان ولا يمكن تعديلهما من هنا --}}
                        <input type="text" class="form-control" value="{{ $language->name }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">كود اللغة (ثابت):</label>
                        <input type="text" class="form-control" value="{{ $language->code }}" readonly>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">صورة العلم الحالية:</label>
                @if ($language->flag_image)
                    <img src="{{ $language->flag_image_url }}" alt="العلم الحالي" class="flag-preview current-flag-preview">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_flag_image" value="1" id="removeFlagImage">
                        <label class="form-check-label" for="removeFlagImage">
                            إزالة الصورة الحالية
                        </label>
                    </div>
                @else
                    <span>لا توجد صورة علم حالية.</span>
                    <img id="current_flag_preview_placeholder" src="{{ asset('assets/img/logo.svg') }}" alt="علم افتراضي" class="flag-preview mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">رفع صورة علم جديدة (ستحل محل الصورة الحالية):</label>
                <input type="file" class="form-control" name="flag_image" id="flag_image_input" accept="image/*">
                @error('flag_image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
                <img id="flag_preview" src="#" alt="معاينة العلم الجديد" class="flag-preview" style="display: none;">
            </div>

            <div class="mb-3">
                <label class="form-label">الحالة:</label>
                <select class="form-select" name="status" required>
                    <option value="1" {{ old('status', $language->status) == '1' ? 'selected' : '' }}>فعال</option>
                    <option value="0" {{ old('status', $language->status) == '0' ? 'selected' : '' }}>غير فعال</option>
                </select>
                @error('status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save ms-1"></i>
                    حفظ التغييرات
                </button>
                <a href="{{ route('admin.languages.index') }}" class="btn btn-light ms-2">
                    <i class="fas fa-arrow-right ms-1"></i>
                    العودة لقائمة اللغات
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flagImageInput = document.getElementById('flag_image_input');
            const flagPreview = document.getElementById('flag_preview');
            const currentFlagPreview = document.querySelector('.current-flag-preview');
            const currentFlagPreviewPlaceholder = document.getElementById('current_flag_preview_placeholder');
            const removeFlagImageCheckbox = document.getElementById('removeFlagImage');

            // Handle new image upload preview
            if (flagImageInput) {
                flagImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            flagPreview.src = e.target.result;
                            flagPreview.style.display = 'block';

                            // Hide current image/placeholder if a new one is uploaded
                            if (currentFlagPreview) {
                                currentFlagPreview.style.display = 'none';
                            }
                            if (currentFlagPreviewPlaceholder) {
                                currentFlagPreviewPlaceholder.style.display = 'none';
                            }
                            // Uncheck "remove image" if a new image is uploaded
                            if (removeFlagImageCheckbox) {
                                removeFlagImageCheckbox.checked = false;
                            }
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // If no file selected, hide new preview and show current/placeholder
                        flagPreview.src = '#';
                        flagPreview.style.display = 'none';
                        if (currentFlagPreview) {
                            currentFlagPreview.style.display = 'block';
                        } else if (currentFlagPreviewPlaceholder) {
                            currentFlagPreviewPlaceholder.style.display = 'block';
                        }
                    }
                });
            }

            // Handle "remove image" checkbox
            if (removeFlagImageCheckbox) {
                removeFlagImageCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Hide all image previews if checkbox is checked
                        if (currentFlagPreview) {
                            currentFlagPreview.style.display = 'none';
                        }
                        if (currentFlagPreviewPlaceholder) {
                            currentFlagPreviewPlaceholder.style.display = 'none';
                        }
                        if (flagPreview) {
                            flagPreview.src = '#';
                            flagPreview.style.display = 'none';
                        }
                        // Clear file input if "remove image" is checked
                        if (flagImageInput) {
                            flagImageInput.value = '';
                        }
                    } else {
                        // If unchecked, show current image/placeholder (if any)
                        if (currentFlagPreview && currentFlagPreview.src && currentFlagPreview.src !== window.location.href) {
                            currentFlagPreview.style.display = 'block';
                        } else if (currentFlagPreviewPlaceholder) {
                             currentFlagPreviewPlaceholder.style.display = 'block';
                        }
                    }
                });
            }
        });
    </script>
@endpush