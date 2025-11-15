@extends('layouts.admin')

@section('title', 'تفاصيل المطبخ') {{-- تم التعديل هنا --}}
@section('page-title', 'تفاصيل المطبخ') {{-- تم التعديل هنا --}}

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
            <i class="fas fa-utensils ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i> {{-- تم تغيير الأيقونة هنا --}}
            تفاصيل المطبخ: {{ $kitchen->name_ar }} {{-- تم التعديل هنا ($mainCategory إلى $kitchen) --}}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">الاسم (عربي):</strong>
                    <span>{{ $kitchen->name_ar }}</span> {{-- تم التعديل هنا ($mainCategory إلى $kitchen) --}}
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    {{-- إضافة شرط للتحقق من عدم كون created_at Null --}}
                    <span>{{ $kitchen->created_at ? $kitchen->created_at->format('d/m/Y H:i A') : 'غير متوفر' }}</span> {{-- تم التعديل هنا ($mainCategory إلى $kitchen) --}}
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    {{-- إضافة شرط للتحقق من عدم كون updated_at Null --}}
                    <span>{{ $kitchen->updated_at ? $kitchen->updated_at->format('d/m/Y H:i A') : 'غير متوفر' }}</span> {{-- تم التعديل هنا ($mainCategory إلى $kitchen) --}}
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span
                        class="badge text-white {{ $kitchen->status_badge_class ?? ($kitchen->status == 1 ? 'bg-success' : 'bg-danger') }}"> {{-- تم التعديل هنا ($mainCategory إلى $kitchen) وتصحيح ترتيب الألوان --}}
                        {{ $kitchen->status_text ?? ($kitchen->status == 1 ? 'فعال' : 'غير فعال') }} {{-- تم التعديل هنا ($mainCategory إلى $kitchen) وتصحيح ترتيب النصوص --}}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">صورة المطبخ:</strong> {{-- تم التعديل هنا --}}
                    @if ($kitchen->image) {{-- تم التعديل هنا ($mainCategory إلى $kitchen) --}}
                        <img src="{{ $kitchen->image_url }}" alt="{{ $kitchen->name_ar }}" {{-- تم التعديل هنا ($mainCategory إلى $kitchen) --}}
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
                    $translatedName = $kitchen->$columnName; 
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
            <a href="{{ route('admin.kitchens.index') }}" id="back-btn"> {{-- تم التعديل هنا (mainCategories إلى kitchens) --}}
                <i class="fas fa-arrow-right ms-1"></i>
                العودة لقائمة المطابخ {{-- تم التعديل هنا --}}
            </a>
            <a href="{{ route('admin.kitchens.edit', $kitchen) }}" class="edit-btn"> {{-- تم التعديل هنا ($mainCategory إلى $kitchen) --}}
                <i class="fas fa-edit ms-1"></i>
                تعديل المطبخ {{-- تم التعديل هنا --}}
            </a>
        </div>
    </div>
@endsection