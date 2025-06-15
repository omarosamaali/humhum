@extends('layouts.admin')

@section('title', 'تفاصيل الخطة')
@section('page-title', 'تفاصيل الخطة')

@push('styles')
<style>
    /* استخدم نفس الستايلات التي كانت لديك لصفحة تفاصيل المستخدم */
    .details-section {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
    }
    .btn-section {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    .back-btn, .edit-btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .back-btn {
        background-color: #6c757d;
        color: white;
    }
    .back-btn:hover {
        background-color: #5a6268;
        color: white;
    }
    .edit-btn {
        background-color: #ffc107;
        color: black;
        border: none;
    }
    .edit-btn:hover {
        background-color: #e0a800;
    }
</style>
@endpush

@section('content')
    <div class="details-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            <h4 class="mb-0">تفاصيل الخطة: {{ $plan->name_ar }}</h4>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الباقة المرتبطة:</span>
                    <div class="detail-value">{{ $plan->package->name_ar ?? 'لا توجد باقة مرتبطة' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الاسم باللغة العربية:</span>
                    <div class="detail-value">{{ $plan->name_ar }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">السعر:</span>
                    <div class="detail-value">{{ $plan->price }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">المدة:</span>
                    <div class="detail-value">{{ $plan->duration_unit }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">الحالة:</span>
                                         <span class="badge {{ $plan->status_badge_class }}">
                                    {{ $plan->getStatusTextAttribute() }}
                        </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">تاريخ الإنشاء:</span>
                    <div class="detail-value">{{ $plan->created_at->format('Y-m-d H:i:s') }}</div>
                </div>
            </div>
        </div>

        {{-- تفاصيل اللغات الأخرى --}}
        <hr class="my-4">
        <h5>الأسماء المترجمة:</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">الإنجليزية:</span>
                    <div class="detail-value">{{ $plan->name_en }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">الإندونيسية:</span>
                    <div class="detail-value">{{ $plan->name_id }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">الأمهرية:</span>
                    <div class="detail-value">{{ $plan->name_am }}</div>
                </div>
            </div>
            {{-- كرر لبقية اللغات هنا --}}
             <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">الهندية:</span>
                    <div class="detail-value">{{ $plan->name_hi }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">البنغالية:</span>
                    <div class="detail-value">{{ $plan->name_bn }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">المالايالامية:</span>
                    <div class="detail-value">{{ $plan->name_ml }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">الفلبينية:</span>
                    <div class="detail-value">{{ $plan->name_fil }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">الأردية:</span>
                    <div class="detail-value">{{ $plan->name_ur }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">التاميلية:</span>
                    <div class="detail-value">{{ $plan->name_ta }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">النيبالية:</span>
                    <div class="detail-value">{{ $plan->name_ne }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="detail-item">
                    <span class="detail-label">البشتو:</span>
                    <div class="detail-value">{{ $plan->name_ps }}</div>
                </div>
            </div>
        </div>

        <div class="btn-section">
            <a href="{{ route('admin.plans.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة الخطط
            </a>
            <a href="{{ route('admin.plans.edit', $plan->id) }}" class="edit-btn text-white">
                <i class="fas fa-edit ms-1"></i>
                تعديل الخطة
            </a>
        </div>
    </div>
@endsection