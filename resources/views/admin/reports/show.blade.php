@extends('layouts.admin')

@section('title', 'تفاصيل البلاغ')
@section('page-title', 'تفاصيل البلاغ')

@push('styles')
<style>
    .detail-section {
        background: white;
        color: black;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .detail-item {
        margin-bottom: 15px;
    }

    .detail-item strong {
        display: inline-block;
        width: 150px;
        /* لتنسيق أفضل */
        color: rgba(0, 0, 0, 0.8);
    }

    .detail-item span {
        color: black;
    }

    .message-form {
        margin-top: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .message-form textarea {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px;
    }

    .message-form textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

</style>
@endpush

@section('content')
<div class="detail-section">
    <h5 class="mb-4">
        <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تفاصيل البلاغ #{{ $report->id }}
    </h5>

    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <strong>المُبلغ:</strong>
                <span>{{ $report->user->name ?? 'غير محدد' }}</span>
            </div>
            <div class="detail-item">
                <strong>الطاهي المُبلغ عنه:</strong>
                <span>{{ $report->chefProfile ? $report->chefProfile->user->name : 'لا يوجد' }}</span>
            </div>
            <div class="detail-item">
                <strong>نوع البلاغ:</strong>
                <span>{{ $report->report_type == 'fake_account' ? 'حساب وهمي' : 'الإبلاغ عن المنشور أو الرسالة أو التعليق' }}</span>
            </div>
            <div class="detail-item">
                <strong>تاريخ البلاغ:</strong>
                <span>{{ $report->created_at->format('d/m/Y H:i A') }}</span>
            </div>
            <div class="detail-item">
                <strong>تاريخ آخر تحديث:</strong>
                <span>{{ $report->updated_at->format('d/m/Y H:i A') }}</span>
            </div>
        </div>
    </div>

    <!-- Message Form -->
    <div class="message-form">
        <h6 class="mb-3">إرسال رسالة إلى المُبلغ</h6>
        <form action="{{ route('admin.reports.send-message', $report->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="message" class="form-label">الرسالة:</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                @error('message')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane ms-1"></i>
                إرسال الرسالة
            </button>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-right ms-1"></i>
            العودة إلى قائمة البلاغات
        </a>
        <button class="btn btn-danger" onclick="confirmDelete({{ $report->id }})">
            <i class="fas fa-trash ms-1"></i>
            حذف البلاغ
        </button>
    </div>
</div>

<!-- Delete Confirmation Modal -->
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
                <form id="deleteForm" action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" style="display: inline;">
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
