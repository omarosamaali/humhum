@extends('layouts.admin')

@section('title', 'تعديل البانر')
@section('page-title', 'تعديل البانر')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        .banner-preview {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
            object-fit: contain; /* Ensure the image fits within the preview area */
        }

        .translated-field-value {
            /* Style for the read-only translated values */
            display: block;
            background-color: #f8f9fa; /* Light background for read-only fields */
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid #e9ecef;
            margin-top: 5px;
            word-wrap: break-word; /* Allow long text to wrap */
            white-space: pre-wrap; /* Preserve whitespace and allow wrapping */
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
            <i class="fas fa-image ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تعديل البانر
            {{-- Removed: : {{ $banner->title_ar }} as title_ar no longer exists --}}
        </h5>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image_input" class="form-label font-bold">صورة البانر</label>
                        <input type="file" class="form-control" name="image" id="image_input" accept="image/*">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @if ($banner->image)
                            <img id="current_image_preview" src="{{ $banner->image_url }}" alt="الصورة الحالية"
                                class="banner-preview mt-2 p-2 current-image-preview">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                <label class="form-check-label text-black" for="remove_image">
                                    حذف الصورة الحالية
                                </label>
                            </div>
                        @endif
                        <img id="image_preview" src="#" alt="معاينة الصورة الجديدة" class="banner-preview mt-2"
                            style="display: none;">
                    </div>
                </div>

                <div class="col-md-6">
                    {{-- Start Date --}}
                    <div class="mb-3">
                        <label for="start_date" class="form-label font-bold">تاريخ البدء</label>
                        <input type="text" class="form-control flatpickr" id="start_date" name="start_date"
                            value="{{ old('start_date', $banner->start_date ? $banner->start_date->format('Y-m-d H:i') : '') }}"
                            placeholder="حدد تاريخ ووقت البدء">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div class="mb-3">
                        <label for="end_date" class="form-label font-bold">تاريخ الانتهاء</label>
                        <input type="text" class="form-control flatpickr" id="end_date" name="end_date"
                            value="{{ old('end_date', $banner->end_date ? $banner->end_date->format('Y-m-d H:i') : '') }}"
                            placeholder="حدد تاريخ ووقت الانتهاء">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Display Location --}}
                    <div class="mb-3">
                        <label for="display_location" class="form-label font-bold">مكان العرض</label>
                        <select class="form-select" name="display_location" id="display_location" required>
                            <option value="website" {{ old('display_location', $banner->display_location) == 'website' ? 'selected' : '' }}>موقع الويب</option>
                            <option value="mobile_app" {{ old('display_location', $banner->display_location) == 'mobile_app' ? 'selected' : '' }}>تطبيق الجوال</option>
                        </select>
                        @error('display_location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label font-bold">الحالة</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="1" {{ old('status', $banner->status) == '1' ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ old('status', $banner->status) == '0' ? 'selected' : '' }}>غير فعال</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="btn-section text-center">
                <a href="{{ route('admin.banners.index') }}" class="back-btn">
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script> {{-- For Arabic localization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview logic
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
                                removeImageCheckbox.checked = false; // Uncheck "remove" if new image is selected
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
                            imageInput.value = ''; // Clear the file input
                        }
                    } else {
                        // If unchecked, and there was a current image, show it
                        if (currentImagePreview && currentImagePreview.src &&
                            currentImagePreview.src !== window.location.href) {
                            currentImagePreview.style.display = 'block';
                        }
                    }
                });
            }

            // Flatpickr for date and time selection
            flatpickr("#start_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                altInput: true,
                altFormat: "d F, Y h:i K", // e.g., 13 June, 2025 04:30 PM
                locale: "ar" // Use Arabic locale
            });

            flatpickr("#end_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                altInput: true,
                altFormat: "d F, Y h:i K", // e.g., 13 June, 2025 04:30 PM
                locale: "ar" // Use Arabic locale
            });
        });
    </script>
@endpush
