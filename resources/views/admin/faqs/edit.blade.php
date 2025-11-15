@extends('layouts.admin')

@section('title', 'تعديل سؤال شائع')
@section('page-title', 'تعديل سؤال شائع')

@push('styles')
    <style>
        .add-section {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .translated-name-field {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            color: black;
        }

        .translated-name-field:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: white;
        }

        .btn-section {
            margin-top: 20px;
        }

        .back-btn {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
            display: inline-block;
        }

        .back-btn:hover {
            background: #545b62;
            color: white;
        }

        .update-btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-btn:hover {
            background: #218838;
        }
    </style>
@endpush

@section('content')
    <div class="add-section">
        <h5 class="mb-4">
            <i class="fas fa-question-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            تعديل سؤال شائع: {{ $faq->question_ar }}
        </h5>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="question_ar" class="form-label font-bold">السؤال (بالعربية)</label>
                        <input type="text" class="form-control" id="question_ar" name="question_ar"
                            value="{{ old('question_ar', $faq->question_ar) }}" required>
                        @error('question_ar')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="answer_ar" class="form-label font-bold">الإجابة (بالعربية)</label>
                        <textarea class="form-control" id="answer_ar" name="answer_ar" rows="4" required>{{ old('answer_ar', $faq->answer_ar) }}</textarea>
                        @error('answer_ar')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label font-bold">الحالة</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="1" {{ old('status', $faq->status) == '1' ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ old('status', $faq->status) == '0' ? 'selected' : '' }}>غير فعال
                            </option>
                        </select>
                        @error('status')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label font-bold">ترتيب العرض</label>
                        <input type="number" class="form-control" id="order" name="order"
                            value="{{ old('order', $faq->order) }}" min="0" required>
                        @error('order')
                            <div class="text-black">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="place" class="form-label">مكان العرض</label>
                        <select name="place" id="place" class="form-control" required>
                            <option value="chef" {{ old('place', $faq->place) == 'chef' ? 'selected' : '' }}>واجهة الطاهي فقط</option>
                            <option value="user" {{ old('place', $faq->place) == 'user' ? 'selected' : ''  }}>واجهة المستخدم فقط</option>
                            <option value="both" {{ old('place', $faq->place) == 'both' ? 'selected' : ''  }}>كلاهما</option>
                        </select>
                    </div>
                    @error('place')
                        <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <h6 class="mt-4 mb-3 text-black">الأسئلة والإجابات المترجمة (للقراءة فقط - تتحدث تلقائياً):</h6>
            <div class="row">
                @foreach ($targetLanguages as $code => $name)
                    <div class="col-md-12 mb-3 border rounded-lg p-2">
                        <label for="question_{{ $code }}" class="form-label font-bold">{{ $name }}
                            (السؤال):</label>
                        <span
                            class="text-right">{{ old("question_$code", $faq->{"question_$code"}) ?? 'غير متوفر' }}</span>
                        <br>
                        <label for="answer_{{ $code }}" class="form-label font-bold">{{ $name }}
                            (الإجابة):</label>
                        <span class="text-right">{{ old("answer_$code", $faq->{"answer_$code"}) ?? 'غير متوفر' }}</span>
                    </div>
                @endforeach
            </div>

            <div class="btn-section text-center">
                <a href="{{ route('admin.faqs.index') }}" id="back-btn">
                    <i class="fas fa-arrow-right ms-1"></i>
                    العودة للقائمة
                </a>
                <button type="submit" class="update-btn">
                    <i class="fas fa-save ms-1"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection
