@extends('layouts.admin')

@section('title', 'تفاصيل العائلة')
@section('page-title', 'تفاصيل العائلة')

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
            color: black;
        }

        .detail-item span {
            color: black;
        }

        .detail-image {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
        }

        .btn-section {
            margin-top: 20px;
            text-align: center;
        }

        .back-btn,
        .edit-btn {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            margin-left: 10px;
        }

        .back-btn {
            background-color: #6c757d;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .back-btn:hover,
        .edit-btn:hover {
            opacity: 0.9;
        }
    </style>
@endpush

@section('content')
    <div class="detail-section">
        <h5 class="mb-4">
            <i class="fas fa-users ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تفاصيل العائلة: {{ $family->name_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">الاسم (عربي):</strong>
                    <span>{{ $family->name_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    <span>{{ $family->created_at ? $family->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    <span>{{ $family->updated_at ? $family->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span
                        class="badge text-white {{ $family->status_badge_class ?? ($family->status == 1 ? 'bg-success' : 'bg-danger') }}">
                        {{ $family->status_text ?? ($family->status == 1 ? 'فعال' : 'غير فعال') }}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">صورة العائلة:</strong>
                    @if ($family->image)
                        <img src="{{ $family->image_url }}" alt="{{ $family->name_ar }}"
                            class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="btn-section">
            <a href="{{ route('admin.families.index') }}" id="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة العائلات
            </a>
            <a href="{{ route('admin.families.edit', $family->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل العائلة
            </a>
        </div>
    </div>
@endsection