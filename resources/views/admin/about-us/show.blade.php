@extends('layouts.admin')

@section('title', 'تفاصيل صفحة معلومات عنا')
@section('page-title', 'تفاصيل صفحة معلومات عنا')

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
            <i class="fas fa-info-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تفاصيل صفحة معلومات عنا: {{ $aboutUs->title_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">العنوان (عربي):</strong>
                    <span>{{ $aboutUs->title_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الوصف (عربي):</strong>
                    <span>{{ $aboutUs->description_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    <span>{{ $aboutUs->created_at ? $aboutUs->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    <span>{{ $aboutUs->updated_at ? $aboutUs->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span class="badge text-white {{ $aboutUs->status_badge_class }}">
                        {{ $aboutUs->status_text }}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">الصورة الرئيسية:</strong>
                    @if ($aboutUs->main_image)
                        <img src="{{ $aboutUs->main_image_url }}" alt="{{ $aboutUs->title_ar }}"
                            class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
                    @endif
                </div>
                <div class="detail-item">
                    <strong class="text-black">الصورة الفرعية:</strong>
                    @if ($aboutUs->sub_image)
                        <img src="{{ $aboutUs->sub_image_url }}" alt="{{ $aboutUs->title_ar }}"
                            class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
                    @endif
                </div>
            </div>
        </div>

        <h6 class="mt-4 mb-3">الأسماء والأوصاف المترجمة:</h6>
        <div class="row">
            @foreach ($targetLanguages as $code => $name)
                @php
                    $titleColumn = 'title_' . $code;
                    $descColumn = 'description_' . $code;
                    $translatedTitle = $aboutUs->$titleColumn;
                    $translatedDesc = $aboutUs->$descColumn;
                @endphp
                @if ($translatedTitle || $translatedDesc)
                    <div class="col-md-12 mb-3">
                        <div class="detail-item border rounded-lg p-2">
                            <strong class="text-black">{{ $name }} (العنوان):</strong>
                            <span>{{ $translatedTitle ?? 'غير متوفر' }}</span>
                            <br>
                            <strong class="text-black">{{ $name }} (الوصف):</strong>
                            <span>{{ $translatedDesc ?? 'غير متوفر' }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="btn-section">
            <a href="{{ route('admin.about-us.index') }}" id="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة
            </a>
            <a href="{{ route('admin.about-us.edit', $aboutUs->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل
            </a>
        </div>
    </div>
@endsection