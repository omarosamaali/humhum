@extends('layouts.admin')

@section('title', 'إدارة الباقات')
@section('page-title', 'إدارة الباقات')

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

        .package-img {
            width: 50px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .package-preview { /* ستايل لمعاينة الصورة في نموذج الإضافة */
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
    <div class="add-section">
        <h5 class="mb-4">
            <i class="fas fa-box-open ms-2"></i>
            إضافة باقة جديدة
        </h5>

        {{-- رسائل الأخطاء الخاصة بالتحقق من صحة الإدخال لنموذج الإضافة --}}
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

        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name_ar" class="form-label">اسم الباقة (بالعربية)</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar"
                            value="{{ old('name_ar') }}" required>
                        @error('name_ar')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image_input" class="form-label">صورة الباقة</label>
                        <input type="file" class="form-control" name="image" id="image_input" accept="image/*">
                        @error('image')
                            <div class="text-white">{{ $message }}</div>
                        @enderror
                        <img id="image_preview" src="#" alt="معاينة الصورة" class="package-preview"
                            style="display: {{ old('image') ? 'block' : 'none' }};">
                    </div>
                </div>

                <div class="col-md-4">
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

            <button type="submit" class="btn btn-light mt-3">
                <i class="fas fa-plus ms-1"></i>
                إضافة الباقة
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
                    <th>تاريخ الإضافة</th>
                    <th>الاسم (عربي)</th>
                    {{-- <th>الاسم (إنجليزي)</th>
                    <th>الاسم (إندونيسي)</th> --}}
                    <th>الصورة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($packages ?? [] as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $package->created_at->format('d/m/Y') }}</td>
                        <td>{{ $package->name_ar }}</td>
                        {{-- <td>{{ $package->name_en ?? 'لا يوجد' }}</td>
                        <td>{{ $package->name_id ?? 'لا يوجد' }}</td> --}}
                        <td>
                            @if ($package->image)
                                <img src="{{ $package->image_url }}" alt="{{ $package->name_ar }}" class="package-img">
                            @else
                                لا توجد صورة
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $package->status_badge_class }}">
                                {{ $package->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.packages.show', $package->id) }}" class="btn btn-info btn-sm"
                                    title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning btn-sm"
                                    title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف"
                                    onclick="confirmDelete({{ $package->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-box-open text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد بيانات باقات</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (isset($packages) && $packages->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $packages->links() }}
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من حذف هذه الباقة؟
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

        function confirmDelete(packageId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/packages/${packageId}`;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush