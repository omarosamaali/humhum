@extends('layouts.admin')

@section('title', 'تفاصيل اللغة')
@section('page-title', 'تفاصيل اللغة')

@push('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        color: #333;
    }

    .detail-item {
        margin-bottom: 20px;
    }

    .detail-label {
        font-weight: 600;
        color: #555;
        font-size: 1.1rem;
        margin-bottom: 5px;
        display: block;
    }

    .detail-value {
        font-size: 1.05rem;
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 10px 15px;
        border-radius: 8px;
        word-wrap: break-word;
    }

    .detail-value.badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: .5em .75em;
        font-size: 0.9em;
        font-weight: bold;
        color: white;
    }

    .flag-detail-img {
        width: 100px;
        height: auto;
        border-radius: 5px;
        margin-top: 10px;
        border: 2px solid #e9ecef;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
    <div class="user-details-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            <h4 class="mb-0">تفاصيل اللغة: {{ $language->name }}</h4>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الاسم:</span>
                    <div class="detail-value">{{ $language->name }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الكود:</span>
                    <div class="detail-value">{{ $language->code }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الحالة:</span>
                    <div class="detail-value badge {{ $language->status_badge_class }}">{{ $language->status_text }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">تاريخ الإضافة:</span>
                    <div class="detail-value">{{ $language->created_at->format('Y-m-d H:i:s') }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">صورة العلم:</span>
                    @if($language->flag_image)
                        <div><img src="{{ $language->flag_image_url }}" alt="{{ $language->name }}" class="flag-detail-img"></div>
                    @else
                        <div class="detail-value">لا توجد صورة</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="btn-section">
            <a href="{{ route('admin.languages.index') }}" id="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة اللغات
            </a>
             <a href="{{ route('admin.languages.edit', $language->code) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل اللغة
            </a>
        </div>
    </div>
@endsection