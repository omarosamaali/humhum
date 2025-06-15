@extends('layouts.admin')

@section('title', 'إدارة البنرات')
@section('page-title', 'إدارة البنرات')

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
            margin-top: 30px;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 12px;
            margin: 0 2px;
        }

        .banner-img {
            width: 80px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
            object-fit: cover;
        }

        .banner-preview {
            max-width: 200px;
            max-height: 120px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
            object-fit: contain;
        }
    </style>
@endpush

@section('content')
    <div class="add-section">
        <h5 class="mb-4" id="bannerFormTitle">
            <i class="fas fa-image ms-2"></i>
            إضافة بانر جديد
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

        <form id="bannerForm" action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- This input will be populated by JavaScript for updates --}}
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="banner_id" id="bannerId">

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image_input" class="form-label">صورة البانر</label>
                        <input type="file" class="form-control" name="image" id="image_input" accept="image/*" required>
                        @error('image')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                        {{-- Preview for newly selected image --}}
                        <img id="image_preview" src="#" alt="معاينة الصورة" class="banner-preview" style="display: none;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">وقت بدء العرض</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                            value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="end_date" class="form-label">وقت انتهاء العرض</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                            value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="display_location" class="form-label">مكان العرض</label>
                        <select class="form-select" name="display_location" id="display_location" required>
                            <option value="website" {{ old('display_location') == 'website' ? 'selected' : '' }}>موقع الويب</option>
                            <option value="mobile_app" {{ old('display_location') == 'mobile_app' ? 'selected' : '' }}>تطبيق الهاتف</option>
                        </select>
                        @error('display_location')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غير فعال</option>
                        </select>
                        @error('status')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-light mt-3" id="submitButton">
                <i class="fas fa-plus ms-1"></i>
                إضافة بانر
            </button>
            <button type="button" class="btn btn-secondary mt-3" id="cancelEditButton" style="display: none;">
                <i class="fas fa-times ms-1"></i>
                إلغاء التعديل
            </button>
        </form>
    </div>

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

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>وقت البدء</th>
                    <th>وقت الانتهاء</th>
                    <th>مكان العرض</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($banners as $banner)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($banner->image)
                                <img src="{{ $banner->image_url }}" alt="بانر" class="banner-img">
                            @else
                                لا توجد صورة
                            @endif
                        </td>
                        <td>{{ $banner->start_date ? $banner->start_date->format('d/m/Y - H:i') : 'غير محدد' }}</td>
                        <td>{{ $banner->end_date ? $banner->end_date->format('d/m/Y - H:i') : 'غير محدد' }}</td>
                        <td>{{ $banner->display_location === 'website' ? 'موقع الويب' : 'تطبيق الهاتف' }}</td>
                        <td>
                            <span class="badge {{ $banner->status_badge_class }}">
                                {{ $banner->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.banners.show', $banner->id) }}" class="btn btn-info btn-sm" title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف"
                                    onclick="confirmDelete({{ $banner->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-info-circle text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">لا توجد بنرات حاليًا.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من حذف هذا البانر؟
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
            const imageInput = document.getElementById('image_input');
            const imagePreview = document.getElementById('image_preview');

            // Image preview logic for the create form
            if (imageInput) {
                imageInput.addEventListener('change', function(event) {
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
        });

        function confirmDelete(bannerId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/banners/${bannerId}`;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush