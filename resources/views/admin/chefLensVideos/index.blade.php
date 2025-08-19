@extends('layouts.admin')

@section('title', 'إدارة الفيديوهات')
@section('page-title', 'إدارة الفيديوهات')

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

    .video-thumbnail {
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
            <i class="fas fa-video ms-2"></i>
            إدارة الفيديوهات
        </h5>
        <a href="{{ route('admin.chefLensVideos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ms-1"></i>
            إضافة فيديو جديد
        </a>
    </div>

    <div class="search-section">
        <form method="GET" action="{{ route('admin.chefLensVideos.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="البحث عن فيديو..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="category">
                        <option value="">جميع الفئات</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_ar }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="">جميع الحالات</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>نشط</option>
                        <option value="darft" {{ request('status') == 'darft' ? 'selected' : '' }}>غير نشط</option>
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
                <th>الفيديو</th>
                <th>عنوان الفيديو</th>
                <th>الطاه</th>
                <th>التصنيف</th>
                <th>تاريخ الإضافة</th>
                <th>عدد المشاهدات</th>
                <th>الإعجابات</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videos as $video)
            <tr>
                <td>{{ $loop->iteration + ($videos->currentPage() - 1) * $videos->perPage() }}</td>
                <td>
                    @if($video->video_path)
                    <video class="video-thumbnail" controls>
                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                    </video>
                    @else
                    <div class="video-thumbnail bg-secondary d-flex align-items-center justify-content-center">
                        <i class="fas fa-video text-white"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <strong>{{ $video->name }}</strong>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        @if($video->user && $video->user->chefProfile && $video->user->chefProfile->official_image)
                        <img src="{{ asset('storage/' . $video->user->chefProfile->official_image) }}" class="rounded-circle me-2" width="30" height="30" alt="Chef">
                        @endif
                        <span>{{ $video->user->name ?? 'غير محدد' }}</span>
                    </div>
                </td>
                <td>
                    @if($video->mainCategory)
                    <span class="badge bg-primary">{{ $video->mainCategory->name_ar }}</span>
                    @else
                    <span class="badge bg-secondary">غير محدد</span>
                    @endif
                </td>
                <td>{{ $video->created_at->format('Y/m/d') }}</td>
                <td>
                    <i class="fas fa-eye text-primary"></i>
                    {{ number_format($video->views) }}
                </td>
                <td>
                    <i class="fas fa-heart text-danger"></i>
                    {{ number_format($video->likes) }}
                </td>
                <td>
                    @switch($video->status)
                    @case('published')
                    <span class="badge bg-success">نشط</span>
                    @break
                    @case('draft')
                    <span class="badge bg-secondary">غير نشط</span>
                    @break
                    @default
                    <span class="badge bg-secondary">{{ $video->status == 'published' ? 'نشط' : 'غير نشط' }}</span>
                    @endswitch
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.chefLensVideos.show', $video) }}" class="btn btn-info btn-sm" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $video->id }})" title="حذف نهائي">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center py-4">
                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                    <p class="text-muted">لا توجد فيديوهات</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($videos->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $videos->links() }}
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
                هل أنت متأكد من حذف هذا الفيديو نهائياً؟ لن يمكن استرداده بعد الحذف.
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
    // Permanent delete confirmation
    function confirmDelete(id) {
        // Set the action of the hidden form to the correct delete URL
        const form = document.getElementById('deleteForm');
        form.action = `/admin/chefLensVideos/${id}`;

        // Show the delete confirmation modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

</script>
@endpush
