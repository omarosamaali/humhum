@extends('layouts.admin')

@section('title', 'إدارة التحديات')
@section('page-title', 'إدارة التحديات')

@push('styles')
<style>
    .add-user-section {
        background: #fafafa;
        color: rgb(0, 0, 0);
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

    .filter-buttons .btn {
        margin-right: 10px;
        min-width: 120px;
    }

    .challenge-thumbnail {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
    }

    .search-section {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

</style>
@endpush

@section('content')
<div class="add-user-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>
            <i class="fas fa-trophy ms-2"></i>
            إدارة التحديات
        </h5>
        <a href="{{ route('admin.chefLensChallenges.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ms-1"></i>
            إضافة تحدي جديد
        </a>
    </div>

    <div class="search-section">
        <form method="GET" action="{{ route('admin.chefLensChallenges.index') }}">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="search" placeholder="البحث عن تحدي..." value="{{ request('search') }}">
                </div>
                <div class="col-md-5">
                    <select class="form-select" name="status">
                        <option value="">جميع الحالات</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>بانتظار المراجعة</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="fas fa-search"></i> بحث
                    </button>
                </div>
            </div>
        </form>
    </div>
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
                <th>إعلان التحدي</th>
                <th>رسالة التحدي</th>
                <th>الطاهي</th>
                <th>الوصفة</th>
                <th>تاريخ البدء</th>
                <th>تاريخ الانتهاء</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($challenges as $challenge)
            <tr>
                <td>{{ $loop->iteration + ($challenges->currentPage() - 1) * $challenges->perPage() }}</td>
                <td>
                    @if($challenge->announcement_path)
                    @if(in_array(pathinfo($challenge->announcement_path, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov']))
                    <video class="challenge-thumbnail" controls>
                        <source src="{{ asset('storage/' . $challenge->announcement_path) }}" type="video/mp4">
                    </video>
                    @else
                    <img src="{{ asset('storage/' . $challenge->announcement_path) }}" class="challenge-thumbnail" alt="إعلان التحدي">
                    @endif
                    @else
                    <div class="challenge-thumbnail bg-secondary d-flex align-items-center justify-content-center">
                        <i class="fas fa-image text-white"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <div style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <strong>{{ $challenge->message }}</strong>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        @if($challenge->chef && $challenge->chef->chefProfile && $challenge->chef->chefProfile->official_image)
                        <img src="{{ asset('storage/' . $challenge->chef->chefProfile->official_image) }}" class="rounded-circle me-2" width="30" height="30" alt="Chef">
                        @endif
                        <span>{{ $challenge->chef->name ?? 'غير محدد' }}</span>
                    </div>
                </td>
                <td>
                    @if($challenge->recipe)
                    <span class="badge bg-info">{{ $challenge->recipe->name_ar }}</span>
                    @else
                    <span class="badge bg-secondary">لا يوجد</span>
                    @endif
                </td>
                <td>{{ $challenge->start_date }} <br> {{ $challenge->start_time }}</td>
                <td>{{ $challenge->end_date }} <br> {{ $challenge->end_time }}</td>
                <td>
                    @switch($challenge->status)
                    @case('active')
                    <span class="badge bg-success">نشط</span>
                    @break
                    @case('inactive')
                    <span class="badge bg-secondary">غير نشط</span>
                    @break
                    @case('pending')
                    <span class="badge bg-warning">بانتظار المراجعة</span>
                    @break
                    @endswitch
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.chefLensChallenges.show', $challenge) }}" class="btn btn-info btn-sm" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $challenge->id }})" title="حذف نهائي">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center py-4">
                    <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                    <p class="text-muted">لا توجد تحديات</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($challenges->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $challenges->links() }}
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
                هل أنت متأكد من حذف هذا التحدي نهائياً؟ لن يمكن استرداده بعد الحذف.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف نهائي</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/chefLensChallenges/${id}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

</script>
@endpush
