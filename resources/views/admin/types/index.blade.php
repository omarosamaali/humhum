@extends('layouts.admin') {{-- تأكد من اسم الـ layout الخاص بك --}}

@section('title', 'إدارة صفحة معلومات عنا وإتفاقية الإستخدام')
@section('page-title', 'إدارة صفحة معلومات عنا وإتفاقية الإستخدام')

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
        margin-bottom: 30px;
        /* إضافة مسافة بين الجداول */
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

</style>
@endpush

@section('content')

{{-- رسائل Success/Error --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- --------------------------------- قسم معلومات عنا --------------------------------- --}}
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">معلومات عنا</h6>
        @if (!$aboutUs)
        <a href="{{ route('admin.about-us.create') }}" class="btn btn-success btn-sm">إضافة معلومات عنا</a>
        @endif
    </div>
    <div class="card-body">
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
                        <td>{{ optional($aboutUs->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                        <td>{{ $aboutUs->title_ar ?? 'لا يوجد عنوان' }}</td>
                        <td>
                            @if ($aboutUs->main_image_url)
                            <img src="{{ $aboutUs->main_image_url }}" alt="{{ $aboutUs->title_ar }}" class="about-img">
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
                                <a href="{{ route('admin.about-us.show', ['about_u' => $aboutUs->id]) }}" class="btn btn-info btn-sm" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.about-us.edit', ['about_u' => $aboutUs->id]) }}" class="btn btn-warning btn-sm" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDeleteModal('about-us', {{ $aboutUs->id }})">
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
            <p class="text-muted mt-2">لا توجد بيانات لصفحة معلومات عنا. يرجى <a href="{{ route('admin.about-us.create') }}">إضافة الآن</a></p>
        </div>
        @endif
    </div>
</div>

{{-- --------------------------------- قسم اتفاقية الاستخدام --------------------------------- --}}
<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">إتفاقية الإستخدام</h6>
        @if (!$terms)
        <a href="{{ route('admin.terms.create') }}" class="btn btn-success btn-sm">إضافة اتفاقية الاستخدام</a>
        @endif
    </div>
    <div class="card-body">
        @if ($terms)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاريخ الإضافة</th>
                        <th>العنوان (عربي)</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ optional($terms->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                        {{-- هنا استخدمنا 'title' بناءً على migration جدول 'terms_of_use' --}}
                        <td>{{ $terms->title_ar ?? 'لا يوجد عنوان' }}</td>
                        <td>
                            {{-- هنا استخدمنا 'is_active' بناءً على migration جدول 'terms_of_use' --}}
                            <span class="badge {{ $terms->status_badge_class }}">
                                {{ $terms->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                {{-- الـ Routes هنا يجب أن تشير إلى ميثودات Terms في الكنترولر --}}
                                <a href="{{ route('admin.terms.show', $terms) }}" class="btn btn-info btn-sm" title="عرض">

                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.terms.edit', $terms) }}" class="btn btn-warning btn-sm" title="تعديل">

                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDeleteModal('terms', {{ $terms->id }})">
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
            <p class="text-muted mt-2">لا توجد بيانات لاتفاقية الاستخدام. يرجى <a href="{{ route('admin.terms.create') }}">إضافة الآن</a></p>
        </div>
        @endif
    </div>
</div>

{{-- --------------------------------- قسم اتفاقية الاستخدام --------------------------------- --}}
<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary"> كيفية حساب المعلومات الغذائية للمواد الغذائية</h6>
        @if (!$hosp)
        <a href="{{ route('admin.hosp.create') }}" class="btn btn-success btn-sm">إضافة الضيافة</a>
        @endif
    </div>
    <div class="card-body">
        @if ($hosp)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاريخ الإضافة</th>
                        <th>المعلومات الغذائية</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ optional($hosp->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                        {{-- هنا استخدمنا 'title' بناءً على migration جدول 'terms_of_use' --}}
                        <td>{{ $hosp->title_ar ?? 'لا يوجد عنوان' }}</td>
                        <td>
                            {{-- هنا استخدمنا 'is_active' بناءً على migration جدول 'terms_of_use' --}}
                            <span class="badge {{ $hosp->status_badge_class }}">
                                {{ $hosp->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                {{-- الـ Routes هنا يجب أن تشير إلى ميثودات Terms في الكنترولر --}}
                                <a href="{{ route('admin.hosp.show', $hosp) }}" class="btn btn-info btn-sm" title="عرض">

                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.hosp.edit', $hosp) }}" class="btn btn-warning btn-sm" title="تعديل">

                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDeleteModal('hosp', {{ $hosp->id }})">
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
            <p class="text-muted mt-2">لا توجد بيانات لاتفاقية الاستخدام. يرجى <a href="{{ route('admin.hosp.create') }}">إضافة الآن</a></p>
        </div>
        @endif
    </div>
</div>

{{-- --------------------------------- قسم 1. كيفية فهم واستخدام ملصق المعلومات الغذائية --------------------------------- --}}
<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">كيفية فهم واستخدام ملصق المعلومات الغذائية</h6>
        @if (!$hosp)
        <a href="{{ route('admin.hosp.create') }}" class="btn btn-success btn-sm">إضافة الضيافة</a>
        @endif
    </div>
    <div class="card-body">
        @if ($hosp)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاريخ الإضافة</th>
                        <th>المعلومات الغذائية</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ optional($hosp->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                        {{-- هنا استخدمنا 'title' بناءً على migration جدول 'terms_of_use' --}}
                        <td>{{ $hosp->title_ar ?? 'لا يوجد عنوان' }}</td>
                        <td>
                            {{-- هنا استخدمنا 'is_active' بناءً على migration جدول 'terms_of_use' --}}
                            <span class="badge {{ $hosp->status_badge_class }}">
                                {{ $hosp->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                {{-- الـ Routes هنا يجب أن تشير إلى ميثودات Terms في الكنترولر --}}
                                <a href="{{ route('admin.hosp.show', $hosp) }}" class="btn btn-info btn-sm" title="عرض">

                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.hosp.edit', $hosp) }}" class="btn btn-warning btn-sm" title="تعديل">

                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDeleteModal('hosp', {{ $hosp->id }})">
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
            <p class="text-muted mt-2">لا توجد بيانات لاتفاقية الاستخدام. يرجى <a href="{{ route('admin.hosp.create') }}">إضافة الآن</a></p>
        </div>
        @endif
    </div>
</div>


{{-- Modal for Delete Confirmation --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deleteModalBody">
                هل أنت متأكد من حذف هذا العنصر؟
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
    function confirmDeleteModal(type, id) {
        const deleteForm = document.getElementById('deleteForm');
        const deleteModalBody = document.getElementById('deleteModalBody');
        let route = '';
        let message = '';

        if (type === 'about-us') {
            route = `/admin/about-us/${id}`;
            message = 'هل أنت متأكد من حذف محتوى صفحة "معلومات عنا"؟';
        } else if (type === 'terms') {
            route = `/admin/terms/${id}`;
            message = 'هل أنت متأكد من حذف اتفاقية الاستخدام؟';
        }

        deleteForm.action = route;
        deleteModalBody.textContent = message;

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

</script>
@endpush
