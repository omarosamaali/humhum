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
                    <th>تاريخ الإرسال</th>
                    <th>الايميل</th>
                    <th>الرسالة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $message)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $message->email ?? 'غير محدد' }}</td>
                        <td>{{ $message->message }}</td>
                        <td>
                            <span
                                class="badge {{ $message->status === 'unread' ? 'badge-unread' : ($message->status === 'opened' ? 'badge-opened' : ($message->status === 'closed' ? 'badge-closed' : 'badge-replied')) }}">
                                {{ $message->status === 'unread' ? 'غير مقروءة' : ($message->status === 'opened' ? 'مفتوحة' : ($message->status === 'closed' ? 'مغلقة' : 'مقروء')) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.contacts.show', $message->id) }}" class="btn btn-info btn-sm"
                                    title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- <a href="{{ route('admin.messages.reply', $message->id) }}" class="btn btn-warning btn-sm"
                                    title="عرض">
                                    <i class="fas fa-reply"></i>
                                </a> --}}
                                <form style="display: inline;" action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="حذف"
                                        onclick="confirmDelete({{ $message->id }})" >

                                        <i class="fas fa-trash"></i>
                                    </button>
                                
                                     </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-envelope text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">لا توجد رسائل</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- روابط التصفح (Pagination) -->
    @if ($contacts->hasPages())
        <div class="flex justify-center mt-4">
            {{ $contacts->links('vendor.pagination.tailwind') }}
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
