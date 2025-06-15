@extends('layouts.admin')

@section('title', 'إدارة الخطط')
@section('page-title', 'إدارة الخطط')

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
            إضافة خطة جديدة
        </h5>

        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">الباقة</label>
                        <select class="form-select" name="package_id" required>
                            <option value="">اختر باقة</option>
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                    {{ $package->name_ar }}
                                </option>
                            @endforeach
                        </select>
                        @error('package_id') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">الاسم باللغة العربية</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}" required>
                        @error('name_ar') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">السعر</label>
                        <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price') }}" required>
                        @error('price') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">المدة</label>
                        <select class="form-select" name="duration_unit" required>
                            <option value="">اختر المدة</option>
                            <option value="1 شهر" {{ old('duration_unit') == '1 شهر' ? 'selected' : '' }}>1 شهر</option>
                            <option value="3 شهور" {{ old('duration_unit') == '3 شهور' ? 'selected' : '' }}>3 شهور</option>
                            <option value="6 شهور" {{ old('duration_unit') == '6 شهور' ? 'selected' : '' }}>6 شهور</option>
                            <option value="12 شهر" {{ old('duration_unit') == '12 شهر' ? 'selected' : '' }}>12 شهر</option>
                        </select>
                        @error('duration_unit') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" name="status" required>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>فعال</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>غير فعال</option>
                        </select>
                        @error('status') <div class="text-white">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-light">
                <i class="fas fa-plus ms-1"></i>
                إضافة الخطة
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

    {{-- جدول عرض الخطط --}}
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تاريخ الإضافة</th>
                    <th>الباقة المرتبطة</th>
                    <th>الاسم (عربي)</th>
                    {{-- <th>الاسم (إنجليزي)</th>
                    <th>الاسم (إندونيسي)</th> --}}
                    {{-- أضف رؤوس أعمدة اللغات الأخرى هنا --}}
                    <th>السعر</th>
                    <th>المدة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans ?? [] as $plan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $plan->created_at->format('d/m/Y') }}</td>
                        <td>{{ $plan->package->name_ar ?? 'لا توجد باقة' }}</td>
                        <td>{{ $plan->name_ar }}</td>
                        {{-- <td>{{ $plan->name_en }}</td>
                        <td>{{ $plan->name_id }}</td> --}}
                        {{-- أضف عرض اللغات الأخرى هنا --}}
                        {{-- <td>{{ $plan->name_am }}</td> --}}
                        {{-- <td>{{ $plan->name_hi }}</td> --}}
                        {{-- <td>{{ $plan->name_bn }}</td> --}}
                        {{-- <td>{{ $plan->name_ml }}</td> --}}
                        {{-- <td>{{ $plan->name_fil }}</td> --}}
                        {{-- <td>{{ $plan->name_ur }}</td> --}}
                        {{-- <td>{{ $plan->name_ta }}</td> --}}
                        {{-- <td>{{ $plan->name_ne }}</td> --}}
                        {{-- <td>{{ $plan->name_ps }}</td> --}}

                        <td>{{ $plan->price }}</td>
                        <td>{{ $plan->duration_unit }}</td>
                        <td>
                        <span class="badge {{ $plan->status_badge_class }}">
                                    {{ $plan->getStatusTextAttribute() }}
                        </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.plans.show', $plan->id) }}" class="btn btn-info btn-sm" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $plan->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <i class="fas fa-money-check-alt text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد بيانات خطط</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- روابط التصفح (Pagination) --}}
    @if (isset($plans) && $plans->hasPages())
        <div class="flex justify-center mt-4">
            {{ $plans->links('vendor.pagination.tailwind') }}
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
                    هل أنت متأكد من حذف هذه الخطة؟
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
        function confirmDelete(planId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/plans/${planId}`; // تأكد من مطابقة المسار
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush