@extends('layouts.admin')

@section('title', 'تفاصيل التصنيف الرئيسي')
@section('page-title', 'تفاصيل التصنيف الرئيسي')

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

        /* إضافة ستايلات للأزرار إذا كانت غير معرفة في مكان آخر */
        .btn-section {
            margin-top: 20px;
            text-align: right;
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
            background-color: #ffc107;
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
            <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تفاصيل التصنيف الرئيسي: {{ $mainCategory->name_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">الاسم (عربي):</strong>
                    <span>{{ $mainCategory->name_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    {{-- إضافة شرط للتحقق من عدم كون created_at Null --}}
                    <span>{{ $mainCategory->created_at ? $mainCategory->created_at->format('d/m/Y H:i A') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    {{-- إضافة شرط للتحقق من عدم كون updated_at Null --}}
                    <span>{{ $mainCategory->updated_at ? $mainCategory->updated_at->format('d/m/Y H:i A') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span
                        class="badge text-white {{ $mainCategory->status_badge_class ?? ($mainCategory->status == 1 ? 'bg-danger' : 'bg-success') }}">
                        {{ $mainCategory->status_text ?? ($mainCategory->status == 1 ? 'غير فعال' : 'فعال') }}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">صورة التصنيف:</strong>
                    @if ($mainCategory->image)
                        <img src="{{ $mainCategory->image_url }}" alt="{{ $mainCategory->name_ar }}"
                            class="p-3 detail-image mt-2">
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
                    $translatedName = $mainCategory->$columnName;
                @endphp
                @if ($translatedName)
                    <div class="col-md-12 mb-3">
                        <div class="detail-item border rounded-lg p-2">
                            <strong class="text-black">{{ $name }} :</strong>
                            <span>{{ $translatedName }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="btn-section text-center">
            <a href="{{ route('admin.mainCategories.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة التصنيفات الرئيسية
            </a>
            {{-- Change $mainCategory->id to $mainCategory->id --}}
            <a href="{{ route('admin.mainCategories.edit', $mainCategory) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل التصنيف الرئيسي
            </a>
        </div>
    </div>
@endsection
