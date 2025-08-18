@extends('layouts.admin')

@section('title', 'البلاغات')
@section('page-title', 'البلاغات')

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

    .package-preview {
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
                <th>تاريخ البلاغ</th>
                <th>المُبلغ</th>
                <th>نوع البلاغ</th>
                <th> الطاه المُبلغ عنه</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report->created_at->format('d/m/Y') }}</td>
                <td>{{ $report->user->name }}</td>
                <td>{{ $report->report_type == 'fake_account' ? 'حساب وهمي' : 'الإبلاغ عن المنشور أو الرسالة أو التعليق' }}</td>
                <td>
                    {{ $report->chef_profile_id ? $report->chefProfile->user->name : 'لا يوجد' }}
                </td>
                <td>
                    <div class="action-buttons">
                        {{-- View button, assuming a view route exists --}}
                        <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-info btn-sm" title="عرض التفاصيل">
                            <i class="fas fa-eye"></i>
                        </a>
                        {{-- Delete button --}}
                        <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $report->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">
                    <i class="fas fa-clipboard-list text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-2">لا توجد بلاغات حاليًا.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

{{-- Change this section --}}
@if ($reports instanceof \Illuminate\Pagination\LengthAwarePaginator || $reports instanceof \Illuminate\Pagination\Paginator)
<div class="d-flex justify-content-center mt-4">
    {{ $reports->links() }}
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
                هل أنت متأكد من حذف هذا البلاغ؟
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
    function confirmDelete(reportId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/reports/${reportId}`;

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

</script>
@endpush
