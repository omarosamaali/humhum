@extends('layouts.admin')

@section('title', 'تفاصيل سؤال شائع')
@section('page-title', 'تفاصيل سؤال شائع')

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
            <i class="fas fa-question-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تفاصيل سؤال شائع: {{ $faq->question_ar }}
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <strong class="text-black">السؤال (عربي):</strong>
                    <span>{{ $faq->question_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الإجابة (عربي):</strong>
                    <span>{{ $faq->answer_ar }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ الإضافة:</strong>
                    <span>{{ $faq->created_at ? $faq->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">تاريخ آخر تحديث:</strong>
                    <span>{{ $faq->updated_at ? $faq->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">الحالة:</strong>
                    <span class="badge text-white {{ $faq->status_badge_class }}">
                        {{ $faq->status_text }}
                    </span>
                </div>
                <div class="detail-item">
                    <strong class="text-black">ترتيب العرض:</strong>
                    <span>{{ $faq->order }}</span>
                </div>
            </div>
        </div>

        <h6 class="mt-4 mb-3">الأسئلة والإجابات المترجمة:</h6>
        <div class="row">
            @foreach ($targetLanguages as $code => $name)
                @php
                    $questionColumn = 'question_' . $code;
                    $answerColumn = 'answer_' . $code;
                    $translatedQuestion = $faq->$questionColumn;
                    $translatedAnswer = $faq->$answerColumn;
                @endphp
                @if ($translatedQuestion || $translatedAnswer)
                    <div class="col-md-12 mb-3">
                        <div class="detail-item border rounded-lg p-2">
                            <strong class="text-black">{{ $name }} (السؤال):</strong>
                            <span>{{ $translatedQuestion ?? 'غير متوفر' }}</span>
                            <br>
                            <strong class="text-black">{{ $name }} (الإجابة):</strong>
                            <span>{{ $translatedAnswer ?? 'غير متوفر' }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="btn-section">
            <a href="{{ route('admin.faqs.index') }}" class="back-btn">
                <i class="fas fa-arrow-right ms-1"></i>
                العودة
            </a>
            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="edit-btn">
                <i class="fas fa-edit ms-1"></i>
                تعديل
            </a>
        </div>
    </div>
@endsection