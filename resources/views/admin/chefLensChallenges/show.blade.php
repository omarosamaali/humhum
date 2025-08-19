@extends('layouts.admin')

@section('title', 'تفاصيل الفيديو')
@section('page-title', 'تفاصيل الفيديو')

@push('styles')
<style>
    .video-details-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .video-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .video-player {
        width: 100%;
        max-height: 400px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .chef-info {
        display: flex;
        align-items: center;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .chef-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-left: 20px;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin: 10px 0;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .info-section {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        display: flex;
        align-items: center;
    }

    .info-label i {
        margin-left: 8px;
        color: #667eea;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin: 30px 0;
    }

    .btn-custom {
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .subcategories-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .subcategory-badge {
        background: #e9ecef;
        color: #495057;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
    }

    .back-button {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
    }

</style>
@endpush

@section('content')
<div class="position-relative">
    <a href="{{ route('admin.chefLensVideos.index') }}" class="btn btn-outline-light back-button btn-custom">
        <i class="fas fa-arrow-right me-2"></i>
        العودة للقائمة
    </a>
</div>

<div class="video-details-card">
    <div class="video-header">
        <h2 class="mb-3">{{ $chefLensVideo->name }}</h2>
        @switch($chefLensVideo->status)
        @case('active')
        <span class="badge bg-success status-badge">نشط</span>
        @break
        @case('inactive')
        <span class="badge bg-secondary status-badge">غير نشط</span>
        @break
        @endswitch
    </div>

    <div class="p-4">
        <!-- Video Player -->
        @if($chefLensVideo->video_path)
        <div class="text-center mb-4">
            <video class="video-player" controls>
                <source src="{{ asset('storage/' . $chefLensVideo->video_path) }}" type="video/mp4">
                متصفحك لا يدعم تشغيل الفيديوهات
            </video>
        </div>
        @endif

        <!-- Chef Information -->
        @if($chefLensVideo->user)
        <div class="chef-info">
            @if($chefLensVideo->user->chefProfile && $chefLensVideo->user->chefProfile->official_image)
            <img src="{{ asset('storage/' . $chefLensVideo->user->chefProfile->official_image) }}" class="chef-avatar" alt="صورة الطاه">
            @else
            <div class="chef-avatar bg-primary d-flex align-items-center justify-content-center">
                <i class="fas fa-user fa-2x text-white"></i>
            </div>
            @endif
            <div>
                <h5 class="mb-2">{{ $chefLensVideo->user->name }}</h5>
                <p class="text-muted mb-1">
                    <i class="fas fa-utensils me-2"></i>
                    طاه متخصص
                </p>
                @if($chefLensVideo->user->chefProfile && $chefLensVideo->user->chefProfile->country)
                <p class="text-muted mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    {{ $chefLensVideo->user->chefProfile->country }}
                </p>
                @endif
            </div>
        </div>
        @endif

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-number">{{ number_format($chefLensVideo->views) }}</div>
                <div class="stat-label">مشاهدة</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-number">{{ number_format($chefLensVideo->likes) }}</div>
                <div class="stat-label">إعجاب</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-bookmark"></i>
                </div>
                <div class="stat-number">{{ number_format($chefLensVideo->bookmarks) }}</div>
                <div class="stat-label">حفظ</div>
            </div>
        </div>

        <!-- Video Information -->
        <div class="info-section">
            <h5 class="mb-4">
                <i class="fas fa-info-circle me-2"></i>
                معلومات الفيديو
            </h5>

            <div class="info-row">
                <span class="info-label">
                    <i class="fas fa-calendar-alt"></i>
                    تاريخ الإضافة
                </span>
                <span>{{ $chefLensVideo->created_at->format('Y/m/d H:i') }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">
                    <i class="fas fa-calendar-check"></i>
                    آخر تحديث
                </span>
                <span>{{ $chefLensVideo->updated_at->format('Y/m/d H:i') }}</span>
            </div>

            @if($chefLensVideo->mainCategory)
            <div class="info-row">
                <span class="info-label">
                    <i class="fas fa-tags"></i>
                    التصنيف الرئيسي

                </span>
                <span class="badge bg-primary">{{ $chefLensVideo->mainCategory->name_ar }}</span>
            </div>
            @endif

            @if($chefLensVideo->subCategories && $chefLensVideo->subCategories->count() > 0)
            <div class="info-row">
                <span class="info-label">
                    <i class="fas fa-tag"></i>
                    الفئات الفرعية
                </span>
                <div class="subcategories-list">
                    @foreach($chefLensVideo->subCategories as $subCategory)
                    <span class="subcategory-badge">{{ $subCategory->name_ar }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if($chefLensVideo->kitchen)
            <div class="info-row">
                <span class="info-label">
                    <i class="fas fa-utensils"></i>
                    المطبخ
                </span>
                <span>{{ $chefLensVideo->kitchen->name_ar ?? $chefLensVideo->kitchen->name }}</span>
            </div>
            @endif

            @if($chefLensVideo->recipe)
            <div class="info-row">
                <span class="info-label">
                    <i class="fas fa-book"></i>
                    الوصفة المرتبطة
                </span>
                <a href="#" class="text-primary">{{ $chefLensVideo->recipe->name }}</a>
            </div>
            @endif

            <div class="info-row">
                <span class="info-label">
                    <i class="fas fa-database"></i>
                    معرف الفيديو
                </span>
                <span class="badge bg-secondary">#{{ $chefLensVideo->id }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            @if($chefLensVideo->status != 'deleted')
            {{-- <a href="{{ route('admin.chefLensVideos.edit', $chefLensVideo) }}" class="btn btn-warning btn-custom">
                <i class="fas fa-edit me-2"></i>
                تعديل الفيديو
            </a> --}}

            <button class="btn btn-danger btn-custom" onclick="confirmSoftDelete({{ $chefLensVideo->id }})">
                <i class="fas fa-trash me-2"></i>
                حذف الفيديو
            </button>
            @else
            <form action="{{ route('admin.chefLensVideos.restore', $chefLensVideo) }}" method="POST" style="display: inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success btn-custom">
                    <i class="fas fa-undo me-2"></i>
                    استرداد الفيديو
                </button>
            </form>

            <button class="btn btn-danger btn-custom" onclick="confirmDelete({{ $chefLensVideo->id }})">
                <i class="fas fa-times me-2"></i>
                حذف نهائي
            </button>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف النهائي</h5>
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

<!-- Soft Delete Modal -->
<div class="modal fade" id="softDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من حذف هذا الفيديو؟ يمكنك استرداده لاحقاً.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="softDeleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Permanent delete confirmation
    function confirmDelete(videoId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/chefLensVideos/${videoId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    // Soft delete confirmation
    function confirmSoftDelete(videoId) {
        const softDeleteForm = document.getElementById('softDeleteForm');
        softDeleteForm.action = `/admin/chefLensVideos/${videoId}/soft-delete`;
        const softDeleteModal = new bootstrap.Modal(document.getElementById('softDeleteModal'));
        softDeleteModal.show();
    }

</script>
@endpush
