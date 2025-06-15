@extends('layouts.admin')

@section('title', 'تفاصيل البانر')
@section('page-title', 'تفاصيل البانر')

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
            width: 150px; /* Adjust as needed for alignment */
            color: black;
            font-weight: bold;
        }

        .detail-item span {
            color: black;
            word-wrap: break-word; /* Allow long text to wrap */
            white-space: pre-wrap; /* Preserve whitespace and allow wrapping */
        }

        .detail-image {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
            object-fit: contain; /* Ensure the image fits within the preview area */
            margin-top: 5px; /* Space between label and image */
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
            <i class="fas fa-image ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تفاصيل البانر: {{ $banner->title_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">العنوان (عربي):</strong>
                    <span>{{ $banner->title_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">العنوان (إنجليزي):</strong>
                    <span>{{ $banner->title_en }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الوصف (عربي):</strong>
                    <span>{{ $banner->description_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الوصف (إنجليزي):</strong>
                    <span>{{ $banner->description_en }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الرابط:</strong>
                    @if ($banner->link)
                        <span><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></span>
                    @else
                        <span>لا يوجد رابط</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">صورة البانر:</strong>
                    @if ($banner->image)
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title_ar }}"
                            class="p-3 detail-image mt-2">
                    @else
                        <span>لا توجد صورة</span>
                    @endif
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span class="badge text-white {{ $banner->status_badge_class }}">
                        {{ $banner->status_text }}
                    </span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    <span>{{ $banner->created_at ? $banner->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    <span>{{ $banner->updated_at ? $banner->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
            </div>
        </div>


        <div class="btn-section">
            <a href="{{ route('admin.banners.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة
            </a>
            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل
            </a>
        </div>
    </div>
@endsection