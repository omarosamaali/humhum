@extends('layouts.admin')

@section('title', 'إدارة الرسائل')
@section('page-title', 'إدارة الرسائل')

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

    .badge-unread {
        background-color: #007bff;
    }

    .badge-opened {
        background-color: #28a745;
    }

    .badge-replied {
        background-color: #fd7e14;
    }

    .badge-closed {
        background-color: #dc3545;
    }
</style>
@endpush

@section('content')
<!-- رسائل الفلاش -->
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

<!-- جدول عرض الرسائل -->
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم المرسل</th>
                <th>الصلاحية</th>
                <th>تاريخ الإرسال</th>
                <th>العنوان</th>
                <th>المحتوى</th>
                <th>الملف</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
          <tbody>
            @forelse($messages as $message)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $message->user->name ?? 'مستخدم محذوف' }}</td>
                <td>{{ $message->user->role ?? 'غير معروف' }}</td>
                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $message->title ?? 'بدون عنوان' }}</td>
                <td>{{ Str::limit($message->content, 50) }}</td>
                <td>
                    @if ($message->file_path)
                    <img src="{{ asset('storage/' . $message->file_path) }}" width="60" style="border-radius:13px">
                    @else
                    لا يوجد
                    @endif
                </td>
                <td>
                    <span class="badge badge-{{ $message->status === 'unread' ? 'danger' : 'success' }}">
                        {{ $message->status === 'unread' ? 'غير مقروءة' : 'مقروءة' }}
                    </span>
                </td>
                <td>

                    <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-info btn-sm" title="عرض">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $message->id }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @empty
            @endforelse
            @forelse($messagesUser as $message)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $message->user->name ?? 'غير محدد' }}</td>
                <td>{{ $message->user->role ?? 'غير محدد' }}</td>
                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $message->title }}</td>
                <td>{{ Str::limit($message->content, 50) }}</td>
                <td>
                    @if ($message->file_path)
                    @if (pathinfo($message->file_path, PATHINFO_EXTENSION) === 'mp4')
                    <video width="100%" controls>
                        <source style="width: 60px; border-radius: 13px;"
                            src="{{ asset('storage/' . $message->file_path) }}" type="video/mp4">
                    </video>
                    @else
                    <img style="width: 60px; border-radius: 13px;" src="{{ asset('storage/' . $message->file_path) }}"
                        alt="">
                    @endif
                    @else
                    لا يوجد
                    @endif
                </td>
                <td>
                    <span
                        class="badge {{ $message->status === 'unread' ? 'badge-unread' : ($message->status === 'opened' ? 'badge-opened' : ($message->status === 'closed' ? 'badge-closed' : 'badge-replied')) }}">
                        {{ $message->status === 'unread' ? 'غير مقروءة' : ($message->status === 'opened' ? 'مفتوحة' :
                        ($message->status === 'closed' ? 'مغلقة' : 'تم الرد')) }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-info btn-sm"
                            title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $message->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>

<!-- روابط التصفح (Pagination) -->
@if ($messages->hasPages())
<div class="flex justify-center mt-4">
    {{ $messages->links('vendor.pagination.tailwind') }}
</div>
@endif

<!-- Modal تأكيد الحذف -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من حذف هذه الرسالة؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btnDanger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(messageId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/admin/messages/${messageId}`;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
</script>
@endpush