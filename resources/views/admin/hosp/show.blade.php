@extends('layouts.admin')

@section('title', 'تفاصيل صفحة الضيافة')
@section('page-title', 'تفاصيل صفحة الضيافة')

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
            تفاصيل صفحة معلومات عنا: {{ $hosp->title_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">العنوان (عربي):</strong>
                    <span>{{ $hosp->title_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الوصف (عربي):</strong>
                    <span>{{ $hosp->description_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    <span>{{ $hosp->created_at ? $hosp->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    <span>{{ $hosp->updated_at ? $hosp->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span class="badge text-white {{ $hosp->status_badge_class }}">
                        {{ $hosp->status_text }}
                    </span>
                </div>
            </div>
        </div>

        <h6 class="mt-4 mb-3">الأسماء والأوصاف المترجمة:</h6>
        <div class="row">
            @foreach ($targetLanguages as $code => $name)
                @php
                    $titleColumn = 'title_' . $code;
                    $descColumn = 'description_' . $code;
                    $translatedTitle = $hosp->$titleColumn;
                    $translatedDesc = $hosp->$descColumn;
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
            <a href="{{ route('admin.about-us.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة
            </a>
            <a href="{{ route('admin.hosp.edit', $hosp->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل
            </a>
        </div>
    </div>
@endsection