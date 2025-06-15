@extends('layouts.admin')

@section('title', 'تفاصيل الباقة')
@section('page-title', 'تفاصيل الباقة')

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
        .detail-item strong class="text-black" {
            display: inline-block;
            width: 150px; /* لتنسيق أفضل */
            color: rgba(255, 255, 255, 0.8);
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
    </style>
@endpush

@section('content')
    <div class="detail-section">
        <h5 class="mb-4">
            <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تفاصيل الباقة: {{ $package->name_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">الاسم (عربي):</strong class="text-black">
                    <span>{{ $package->name_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong class="text-black">
                    <span>{{ $package->created_at->format('d/m/Y H:i A') }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong class="text-black">
                    <span>{{ $package->updated_at->format('d/m/Y H:i A') }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong class="text-black">
                    <span class="badge text-white {{ $package->status_badge_class }}">
                        {{ $package->status_text }}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">صورة الباقة:</strong class="text-black">
                    @if ($package->image)
                        <img src="{{ $package->image_url }}" alt="{{ $package->name_ar }}" class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
                    @endif
                </div>
            </div>
        </div>

        <h6 class="mt-4 mb-3">الأسماء المترجمة:</h6>
        <div class="row">
            @foreach ($targetLanguages as $code => $name)
                @php
                    $columnName = 'name_' . $code;
                    $translatedName = $package->$columnName; // الوصول المباشر للعمود
                @endphp
                @if ($translatedName)
                    <div class="col-md-12 mb-3">
                        <div class="detail-item border rounded-lg p-2">
                            <strong class="text-black">{{ $name }} :</strong class="text-black">
                            <span>{{ $translatedName }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- <div class="mt-4">
            <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning">
                <i class="fas fa-edit ms-1"></i>
                تعديل الباقة
            </a>
            <a href="{{ route('admin.packages.index') }}" class="btn btn-light ms-2">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة إلى قائمة الباقات
            </a>
        </div> --}}
                <div class="btn-section">
            <a href="{{ route('admin.packages.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة الباقات
            </a>
            <a href="{{ route('admin.packages.edit', $package->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل الباقة
            </a>
    </div>
@endsection