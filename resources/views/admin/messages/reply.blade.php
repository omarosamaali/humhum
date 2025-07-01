@extends('layouts.admin')

@section('title', 'الرد على الرسالة')
@section('page-title', 'الرد على الرسالة')

@push('styles')
    <style>
        .message-section {
            background: #fafafa;
            color: rgb(0, 0, 0);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .media-content img,
        .media-content video {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
            height: 500px;
        }
    </style>
@endpush

@section('content')
    <!-- رسائل الفلاش -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- عرض تفاصيل الرسالة -->
    <div class="message-section">
        <h5 class="mb-4">
            <i class="fas fa-envelope ms-2"></i>
            تفاصيل الرسالة
        </h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">العنوان</label>
                    <input type="text" class="form-control" value="{{ $message->title }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">تاريخ الإرسال</label>
                    <input type="text" class="form-control" value="{{ $message->created_at->format('d/m/Y H:i') }}"
                        readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">المحتوى</label>
                    <textarea class="form-control" rows="4" readonly>{{ $message->content }}</textarea>
                </div>
            </div>
            @if ($message->file_path)
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">الملف المرفق</label>
                        <div class="media-content">
                            @if (pathinfo($message->file_path, PATHINFO_EXTENSION) === 'mp4')
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/' . $message->file_path) }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $message->file_path) }}" alt="رسالة">
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if ($message->response)
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">الرد السابق</label>
                        <textarea class="form-control" rows="4" readonly>{{ $message->response }}</textarea>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- نموذج الرد -->
    {{-- @if ($message->status !== 'replied') --}}
    <div class="message-section">

        <h5 class="mb-4">
            <i class="fas fa-reply ms-2"></i>
            إرسال رد
        </h5>
   <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="message-section">
        <h5 class="mb-4 mt-4"> {{-- أضف هامش علوي للفصل --}}
            <i class="fas fa-paperclip ms-2"></i> {{-- أيقونة مشبك الورق --}}
            إضافة مرفق (صورة أو فيديو)
        </h5>
        <div class="mb-3">
            <input type="file" name="file" id="admin_reply_file" class="form-control">
            @error('file')
                <div class="text-danger">{{ $message }}</div> {{-- استخدم text-danger للأخطاء --}}
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save ms-1"></i>
            تحديث الرسالة
        </button>
    </div>
</form>
    </div>
    {{-- @endif --}}
@endsection
