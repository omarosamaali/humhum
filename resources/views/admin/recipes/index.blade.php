@extends('layouts.admin')

@section('title', 'إدارة الوصفات')
@section('page-title', 'قائمة الوصفات')

@push('styles')
    <style>
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-section h5 {
            margin: 0;
            font-size: 1.5rem;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #667eea;
            color: white;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .action-buttons {
            width: 123px;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 12px;
            margin: 0 2px;
            border-radius: 5px;
        }

        .recipe-img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .badge {
            padding: 0.5em 0.8em;
            border-radius: 5px;
            font-weight: normal;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #333;
        }

        .badge-primary {
            background-color: #007bff;
            color: white;
        }

        .pagination .page-link {
            color: #667eea;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #764ba2;
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="header-section">
        <h5 class="mb-0">
            <i class="fas fa-utensils ms-2"></i>
            قائمة الوصفات
        </h5>
        <a href="{{ route('admin.recipes.create') }}" class="btn btn-light">
            <i class="fas fa-plus ms-1"></i>
            إضافة وصفة 
        </a>
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
                    <th>رقم الوصفة</th>
                    <th>صورة الطبق</th>
                    <th>عنوان الوصفة</th>
                    <th>نوع المطبخ</th>
                    <th>الشيف</th>
                    <th>التصنيف الرئيسي</th>
                    <th>التصنيفات الفرعية</th>
                    {{-- <th>السعرات</th> --}}
                    {{-- <th>الوقت</th> --}}
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recipes as $recipe)
                    <tr>
                        <td>{{ $loop->iteration + ($recipes->currentPage() - 1) * $recipes->perPage() }}</td>
                        <td>{{ $recipe->recipe_code }}</td>
                        <td>
                            @if ($recipe->dish_image)
                                <img src="{{ asset('storage/' . $recipe->dish_image) }}" alt="{{ $recipe->title }}"
                                    class="recipe-img">
                            @else
                                <img src="{{ asset('assets/default-recipe-image.png') }}" alt="بدون صورة"
                                    class="recipe-img">
                            @endif
                        </td>
                        <td>{{ $recipe->title }}</td>

                        {{-- Fixed: Safe access to kitchen relationship --}}
                        <td>
                            {{-- {{ $kitchens->name_ar ?? $kitchen->name_ar }} --}}
                            {{ $recipe->kitchen ? $recipe->kitchen->name_ar : 'غير محدد' }}
                          
                        </td>
                        {{-- Fixed: Safe access to chef relationship --}}
                        <td>{{ $recipe->chef?->name ?? 'غير محدد' }}</td>

                        {{-- Fixed: Safe access to main category relationship --}}
                        <td>{{ $recipe->mainCategories?->name_ar ?? 'غير محدد' }}</td>

                        <td>
                            @forelse ($recipe->subCategories as $subCategory)
                                <span class="badge badge-info">{{ $subCategory->name_ar }}</span>
                            @empty
                                <span class="text-muted">لا توجد</span>
                            @endforelse
                        </td>
                        {{-- <td>{{ $recipe->calories ?? 'غير محدد' }}</td> --}}
                        {{-- <td>{{ $recipe->preparation_time }} دقيقة</td> --}}
                        <td>
                            <span class="badge {{ $recipe->status ? 'badge-success' : 'badge-danger' }}">
                                {{ $recipe->status ? 'فعال' : 'غير فعال' }}
                            </span>
                            <br class="mb-1">
                            <span class="badge {{ $recipe->is_free ? 'badge-primary' : 'badge-warning' }}">
                                {{ $recipe->is_free ? 'مجانية' : 'مدفوعة' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.recipes.show', $recipe->id) }}" class="btn btn-info btn-sm"
                                    title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm"
                                    title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف"
                                    onclick="confirmDelete({{ $recipe->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center py-4">
                            <i class="fas fa-info-circle text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">لا توجد وصفات حاليًا.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $recipes->links() }}
    </div>
   @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                    هل أنت متأكد من حذف هذه الوصفة؟
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
        function confirmDelete(recipeId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/recipes/${recipeId}`;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
