@extends('layouts.admin')

@section('title', 'إدارة التصنيفات الفرعية')
@section('page-title', 'إدارة التصنيفات الفرعية')

@push('styles')
    <style>
        /* استخدم نفس الستايلات التي كانت لديك لصفحة المستخدمين أو الباقات */
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

        /* أضف أي ستايلات إضافية هنا */
    </style>
@endpush

@section('content')
    <div class="add-section">
        <h5 class="mb-4">
            <i class="fas fa-plus-circle ms-2"></i>
            إضافة تصنيف فرعي جديد
        </h5>

        {{-- نموذج إضافة تصنيف فرعي جديد --}}
        <form action="{{ route('admin.subCategories.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">التصنيف الرئيسي</label>
                        <select class="form-select" name="category_id" required>
                            <option value="">اختر تصنيف رئيسي</option>
                            @foreach($mainCategories as $mainCategory) {{-- نحتاج لتمرير mainCategories من الكنترولر --}}
                                <option value="{{ $mainCategory->id }}" {{ old('category_id') == $mainCategory->id ? 'selected' : '' }}>
                                    {{ $mainCategory->name_ar }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الاسم باللغة العربية</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}" required>
                        @error('name_ar') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" name="status" required>
                            {{-- لاحظ أن حالة status في migration كانت 0 فعال و 1 غير فعال --}}
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>فعال</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>غير فعال</option>
                        </select>
                        @error('status') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-light">
                <i class="fas fa-plus ms-1"></i>
                إضافة تصنيف فرعي
            </button>
        </form>
    </div>

    {{-- رسائل الفلاش --}}
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

    {{-- جدول عرض التصنيفات الفرعية --}}
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تاريخ الإضافة</th>
                    <th>التصنيف الرئيسي</th>
                    <th>الاسم (عربي)</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subCategories ?? [] as $subCategory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subCategory->created_at->format('d/m/Y') }}</td>
                        <td>{{ $subCategory->mainCategory->name_ar ?? 'لا يوجد تصنيف رئيسي' }}</td> {{-- لعرض اسم التصنيف الرئيسي --}}
                        <td>{{ $subCategory->name_ar }}</td>
                        <td>
                            <span class="badge {{ $subCategory->status == 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $subCategory->status == 0 ? 'فعال' : 'غير فعال' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.subCategories.show', $subCategory->id) }}" class="btn btn-info btn-sm" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.subCategories.edit', $subCategory->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $subCategory->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4"> {{-- تم تعديل colspan ليتناسب مع الأعمدة المتبقية --}}
                            <i class="fas fa-tags text-muted" style="font-size: 3rem;"></i> {{-- أيقونة مناسبة أكثر --}}
                            <p class="text-muted mt-2">لا توجد بيانات تصنيفات فرعية</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- روابط التصفح (Pagination) --}}
    @if (isset($subCategories) && $subCategories->hasPages())
        <div class="flex justify-center mt-4">
            {{ $subCategories->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    {{-- Modal تأكيد الحذف --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من حذف هذا التصنيف الفرعي؟
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
        function confirmDelete(subCategoryId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/subCategories/${subCategoryId}`; // المسار الصحيح
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush