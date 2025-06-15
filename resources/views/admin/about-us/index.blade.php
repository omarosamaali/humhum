@extends('layouts.admin')

@section('title', 'إدارة صفحة معلومات عنا')
@section('page-title', 'إدارة صفحة معلومات عنا')

@push('styles')
    <style>
        .add-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
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

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 12px;
            margin: 0 2px;
        }

        .about-img {
            width: 50px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .about-preview {
            width: 150px;
            max-height: 100px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
    {{-- <div class="add-section">
        <h5 class="mb-4">
            <i class="fas fa-info-circle ms-2"></i>
            إضافة/تحديث صفحة معلومات عنا
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

        <form action="{{ $aboutUs ? route('admin.about-us.update', ['about_u' => $aboutUs->id]) : route('admin.about-us.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if ($aboutUs)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">العنوان (بالعربية)</label>
                        <input type="text" class="form-control" id="title_ar" name="title_ar"
                            value="{{ old('title_ar', $aboutUs->title_ar ?? '') }}" required>
                        @error('title_ar')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">الوصف (بالعربية)</label>
                        <textarea class="form-control" id="description_ar" name="description_ar" rows="4"
                            required>{{ old('description_ar', $aboutUs->description_ar ?? '') }}</textarea>
                        @error('description_ar')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="main_image_input" class="form-label">الصورة الرئيسية</label>
                        <input type="file" class="form-control" name="main_image" id="main_image_input"
                            accept="image/*">
                        @error('main_image')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                        @if ($aboutUs && $aboutUs->main_image)
                            <img id="current_main_image_preview" src="{{ $aboutUs->main_image_url }}"
                                alt="الصورة الحالية" class="about-preview mt-2">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_main_image"
                                    id="remove_main_image">
                                <label class="form-check-label text-white" for="remove_main_image">
                                    حذف الصورة الرئيسية الحالية
                                </label>
                            </div>
                        @endif
                        <img id="main_image_preview" src="#" alt="معاينة الصورة" class="about-preview"
                            style="display: none;">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="sub_image_input" class="form-label">الصورة الفرعية</label>
                        <input type="file" class="form-control" name="sub_image" id="sub_image_input"
                            accept="image/*">
                        @error('sub_image')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                        @if ($aboutUs && $aboutUs->sub_image)
                            <img id="current_sub_image_preview" src="{{ $aboutUs->sub_image_url }}"
                                alt="الصورة الحالية" class="about-preview mt-2">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_sub_image"
                                    id="remove_sub_image">
                                <label class="form-check-label text-white" for="remove_sub_image">
                                    حذف الصورة الفرعية الحالية
                                </label>
                            </div>
                        @endif
                        <img id="sub_image_preview" src="#" alt="معاينة الصورة" class="about-preview"
                            style="display: none;">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="1"
                                {{ old('status', $aboutUs->status ?? 1) == '1' ? 'selected' : '' }}>
                                فعال</option>
                            <option value="0"
                                {{ old('status', $aboutUs->status ?? 0) == '0' ? 'selected' : '' }}>
                                غير فعال</option>
                        </select>
                        @error('status')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-light mt-3">
                <i class="fas fa-plus ms-1"></i>
                {{ $aboutUs ? 'تحديث' : 'إضافة' }} صفحة معلومات عنا
            </button>
        </form>
    </div> --}}

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($aboutUs)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاريخ الإضافة</th>
                        <th>العنوان (عربي)</th>
                        <th>الصورة الرئيسية</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $aboutUs->created_at->format('d/m/Y') }}</td>
                        <td>{{ $aboutUs->title_ar }}</td>
                        <td>
                            @if ($aboutUs->main_image)
                                <img src="{{ $aboutUs->main_image_url }}" alt="{{ $aboutUs->title_ar }}"
                                    class="about-img">
                            @else
                                لا توجد صورة
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $aboutUs->status_badge_class }}">
                                {{ $aboutUs->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.about-us.show', ['about_u' => $aboutUs->id]) }}"
                                    class="btn btn-info btn-sm" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.about-us.edit', ['about_u' => $aboutUs->id]) }}"
                                    class="btn btn-warning btn-sm" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف"
                                    onclick="confirmDelete({{ $aboutUs->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-4">
            <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2">لا توجد بيانات لصفحة معلومات عنا</p>
        </div>
    @endif

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من حذف محتوى صفحة "معلومات عنا"؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImageInput = document.getElementById('main_image_input');
            const mainImagePreview = document.getElementById('main_image_preview');
            const currentMainImagePreview = document.getElementById('current_main_image_preview');
            const removeMainImageCheckbox = document.getElementById('remove_main_image');

            const subImageInput = document.getElementById('sub_image_input');
            const subImagePreview = document.getElementById('sub_image_preview');
            const currentSubImagePreview = document.getElementById('current_sub_image_preview');
            const removeSubImageCheckbox = document.getElementById('remove_sub_image');

            if (mainImageInput) {
                mainImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            mainImagePreview.src = e.target.result;
                            mainImagePreview.style.display = 'block';
                            if (currentMainImagePreview) {
                                currentMainImagePreview.style.display = 'none';
                            }
                            if (removeMainImageCheckbox) {
                                removeMainImageCheckbox.checked = false;
                            }
                        };
                        reader.readAsDataURL(file);
                    } else {
                        mainImagePreview.src = '#';
                        mainImagePreview.style.display = 'none';
                        if (currentMainImagePreview && !removeMainImageCheckbox.checked) {
                            currentMainImagePreview.style.display = 'block';
                        }
                    }
                });
            }

            if (removeMainImageCheckbox) {
                removeMainImageCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        if (currentMainImagePreview) {
                            currentMainImagePreview.style.display = 'none';
                        }
                        if (mainImagePreview) {
                            mainImagePreview.src = '#';
                            mainImagePreview.style.display = 'none';
                        }
                        if (mainImageInput) {
                            mainImageInput.value = '';
                        }
                    } else {
                        if (currentMainImagePreview && currentMainImagePreview.src &&
                            currentMainImagePreview.src !== window.location.href) {
                            currentMainImagePreview.style.display = 'block';
                        }
                    }
                });
            }

            if (subImageInput) {
                subImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            subImagePreview.src = e.target.result;
                            subImagePreview.style.display = 'block';
                            if (currentSubImagePreview) {
                                currentSubImagePreview.style.display = 'none';
                            }
                            if (removeSubImageCheckbox) {
                                removeSubImageCheckbox.checked = false;
                            }
                        };
                        reader.readAsDataURL(file);
                    } else {
                        subImagePreview.src = '#';
                        subImagePreview.style.display = 'none';
                        if (currentSubImagePreview && !removeSubImageCheckbox.checked) {
                            currentSubImagePreview.style.display = 'block';
                        }
                    }
                });
            }

            if (removeSubImageCheckbox) {
                removeSubImageCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        if (currentSubImagePreview) {
                            currentSubImagePreview.style.display = 'none';
                        }
                        if (subImagePreview) {
                            subImagePreview.src = '#';
                            subImagePreview.style.display = 'none';
                        }
                        if (subImageInput) {
                            subImageInput.value = '';
                        }
                    } else {
                        if (currentSubImagePreview && currentSubImagePreview.src &&
                            currentSubImagePreview.src !== window.location.href) {
                            currentSubImagePreview.style.display = 'block';
                        }
                    }
                });
            }
        });

        function confirmDelete(aboutUsId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/about-us/${aboutUsId}`;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush