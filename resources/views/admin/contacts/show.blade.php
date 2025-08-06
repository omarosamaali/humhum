@extends('layouts.admin')

@section('title', 'عرض الرسالة')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">عرض الرسالة</h1>
        <div>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-right"></i> العودة للقائمة
            </a>
        </div>
    </div>

    <!-- Message Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">تفاصيل الرسالة</h6>
                    <div>
                        <span class="badge {{ $contact->status === 'unread' ? 'badge-unread' : ($contact->status === 'opened' ? 'badge-opened' : ($contact->status === 'closed' ? 'badge-closed' : 'badge-replied')) }}">
                            {{ $contact->status === 'unread' ? 'غير مقروءة' : ($contact->status === 'opened' ? 'مفتوحة' : ($contact->status === 'closed' ? 'مغلقة' : 'تم الرد')) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Message Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="font-weight-bold text-gray-700">الإيميل:</label>
                                <p class="mb-0">{{ $contact->email ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="font-weight-bold text-gray-700">تاريخ الإرسال:</label>
                                <p class="mb-0">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if(isset($contact->name))
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="font-weight-bold text-gray-700">الاسم:</label>
                                <p class="mb-0">{{ $contact->name }}</p>
                            </div>
                        </div>
                        @if(isset($contact->phone))
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="font-weight-bold text-gray-700">رقم الهاتف:</label>
                                <p class="mb-0">{{ $contact->phone }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(isset($contact->subject))
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="info-item mb-3">
                                <label class="font-weight-bold text-gray-700">الموضوع:</label>
                                <p class="mb-0">{{ $contact->subject }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Message Content -->
                    <div class="message-content">
                        <label class="font-weight-bold text-gray-700 mb-2">محتوى الرسالة:</label>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">{{ $contact->message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">الإجراءات</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <!-- Mark as Read/Unread -->
                        @if($contact->status === 'unread')
                        <form action="{{ route('admin.contacts.mark-read', $contact->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> تعليم كمقروءة
                            </button>
                        </form>
                        @else
                        <form action="{{ route('admin.contacts.mark-unread', $contact->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning btn-block">
                                <i class="fas fa-undo"></i> تعليم كغير مقروءة
                            </button>
                        </form>
                        @endif

                        <!-- Delete Button -->
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-block" type="submit">
                                <i class="fas fa-trash"></i> حذف الرسالة
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Message Stats -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">معلومات إضافية</h6>
                </div>
                <div class="card-body">
                    <div class="stats-item mb-2">
                        <small class="text-muted">رقم الرسالة:</small>
                        <div class="font-weight-bold">#{{ $contact->id }}</div>
                    </div>
                    {{-- <div class="stats-item mb-2">
                        <small class="text-muted">تاريخ آخر تحديث:</small>
                        <div class="font-weight-bold">{{ $contact->updated_at->format('d/m/Y H:i') }}
                </div>
            </div> --}}
            @if($contact->created_at != $contact->updated_at)
            <div class="stats-item">
                <small class="text-muted">آخر تعديل منذ:</small>
                <div class="font-weight-bold">{{ $contact->updated_at->diffForHumans() }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من رغبتك في حذف هذه الرسالة؟ لا يمكن التراجع عن هذا الإجراء.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .badge-unread {
        background-color: #e74a3b;
        color: white;
    }

    .badge-opened {
        background-color: #f39c12;
        color: white;
    }

    .badge-closed {
        background-color: #95a5a6;
        color: white;
    }

    .badge-replied {
        background-color: #27ae60;
        color: white;
    }

    .info-item label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .info-item p {
        font-size: 0.95rem;
        color: #495057;
    }

    .message-content {
        border-top: 1px solid #e3e6f0;
        padding-top: 1.5rem;
    }

    .stats-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #e3e6f0;
    }

    .stats-item:last-child {
        border-bottom: none;
    }

    .btn-block {
        margin-bottom: 0.5rem;
    }

    .d-grid {
        display: grid;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    @media (max-width: 768px) {
        .d-grid .btn {
            margin-bottom: 0.5rem;
        }
    }

</style>
@endsection

@section('scripts')
<script>
    function confirmDelete(messageId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/contacts/${messageId}`;
        $('#deleteModal').modal('show');
    }

    // Auto-mark as read when page loads (if message is unread)
    @if($contact->status === 'unread')
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-mark as read after 2 seconds
        setTimeout(function() {
            fetch(`/admin/contacts/{{ $contact->id }}/mark-read`, {
                method: 'PATCH'
                , headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    , 'Content-Type': 'application/json'
                , }
            }).then(response => {
                if (response.ok) {
                    // Update badge status
                    const badge = document.querySelector('.badge-unread');
                    if (badge) {
                        badge.className = 'badge badge-opened';
                        badge.textContent = 'مفتوحة';
                    }
                }
            });
        }, 2000);
    });
    @endif

</script>
@endsection
