@extends('layouts.admin')

@section('title', 'عرض الرسالة')
@section('page-title', 'عرض الرسالة')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            overflow-x: hidden;
        } */
    .media-content img,
    .media-content video {
        height: 300px;
    }

    .page-wrapper {
        /* max-width: 800px; */
        margin: 0 auto;
        background: #fff;
        min-height: 100vh;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.2);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
        color: white;
    }

    .title {
        color: white;
        font-size: 18px;
        font-weight: 600;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* منطقة الشات الرئيسية */
    .chat-container {
        padding: 20px 15px;
        min-height: calc(100vh - 300px);
        background: #f8f9fa;
    }

    .active-date {
        display: block;
        text-align: center;
        background: rgba(33, 150, 243, 0.1);
        color: #660099;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        margin: 20px auto;
        width: fit-content;
        border: 1px solid rgba(33, 150, 243, 0.2);
    }

    /* تحسين فقاعات الرسائل */
    .chat-content {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    .chat-content.incoming {
        align-items: flex-start;
    }

    .chat-content.outgoing {
        align-items: flex-end;
    }

    .message-item {
        max-width: 85%;
        animation: fadeInUp 0.4s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bubble {
        padding: 15px 18px;
        border-radius: 20px;
        position: relative;
        word-wrap: break-word;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 8px;
        line-height: 1.5;
    }

    .chat-content.incoming .bubble {
        background: linear-gradient(135deg, #f1f3f4, #e8eaf6);
        color: #333;
        border-bottom-right-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .chat-content.incoming .bubble::before {
        content: '';
        position: absolute;
        bottom: 0;
        right: -8px;
        width: 0;
        height: 0;
        border-left: 8px solid #f1f3f4;
        border-bottom: 8px solid transparent;
    }

    .chat-content.outgoing .bubble {
        background: linear-gradient(135deg, #660099, #660099);
        color: white;
        border-bottom-left-radius: 6px;
        box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
    }

    .chat-content.outgoing .bubble::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: -8px;
        width: 0;
        height: 0;
        border-right: 8px solid #660099;
        border-bottom: 8px solid transparent;
    }

    .message-time {
        font-size: 11px;
        color: #999;
        padding: 0 5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chat-content.incoming .message-time {
        justify-content: flex-start;
    }

    .chat-content.outgoing .message-time {
        justify-content: flex-end;
    }

    .badge {
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 9px;
        font-weight: 500;
    }

    .bg-warning {
        background: linear-gradient(45deg, #ff9800, #ffc107);
        color: white;
    }

    .bg-success {
        background: linear-gradient(45deg, #4caf50, #8bc34a);
        color: white;
    }

    .bg-secondary {
        background: linear-gradient(45deg, #6c757d, #adb5bd);
        color: white;
    }

    .bg-info {
        background: linear-gradient(45deg, #17a2b8, #20c997);
        color: white;
    }

    .bg-danger {
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        color: white;
    }

    /* تحسين عرض الصور والفيديو */
    .media-content {
        margin-top: 12px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .media-content img,
    .media-content video {
        width: 100%;
        max-width: 100%;
        border-radius: 15px;
        transition: transform 0.3s ease;
    }

    .media-content img:hover {
        transform: scale(1.02);
    }

    /* تحسين منطقة الرد */
    .chat-footer {
        background: white;
        padding: 20px 15px;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.1);
        border-top: 1px solid #e0e0e0;
        position: sticky;
        bottom: 0;
        z-index: 50;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-select,
    .form-control {
        border: 2px solid #e3f2fd;
        border-radius: 12px;
        padding: 12px 16px;
        font-family: 'Cairo', sans-serif;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #660099;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
        outline: none;
        background: white;
    }

    .form-control[type="file"] {
        padding: 10px;
        background: #f8f9fa;
    }

    .btn-primary {
        background: linear-gradient(135deg, #660099, #660099);
        border: none;
        padding: 15px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(33, 150, 243, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(33, 150, 243, 0.4);
        background: linear-gradient(135deg, #1976D2, #1CB5E0);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    /* تأثيرات إضافية */
    .alert-success {
        background: linear-gradient(135deg, #4caf50, #8bc34a);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }

    .text-danger {
        color: #f44336;
        font-size: 12px;
        margin-top: 5px;
    }

    /* تحسينات الاستجابة */
    @media (max-width: 480px) {
        .page-wrapper {
            max-width: 100%;
        }

        .bubble {
            padding: 12px 15px;
        }

        .message-item {
            max-width: 90%;
        }
    }

    /* تحسين شكل الاختيار */
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23660099' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    }

    /* إضافة styles للفورم في Laravel */
    .edit-form-section {
        background: transparent;
        border-radius: 0;
        padding: 0;
        box-shadow: none;
    }

    .container {
        max-width: 100%;
        padding: 0;
    }

    /* تخفي العناصر الأصلية وتستبدلها بالتصميم الجديد */
    .card {
        display: none;
    }

    .custom-file-upload-button {
        display: inline-block;
        /* لكي لا يأخذ العرض بالكامل وليسمح بالتحكم في حجمه */
        padding: 10px 15px;
        /* مساحة داخلية حول الأيقونة/النص */
        cursor: pointer;
        /* لإظهار مؤشر اليد عند المرور فوقه */
        border: 1px solid #ccc;
        /* حدود خفيفة */
        border-radius: 5px;
        /* حواف مستديرة */
        background-color: #f0f0f0;
        /* لون خلفية خفيف */
        color: #660099;
        /* لون الأيقونة */
        font-size: 1rem;
        /* حجم الخط للنص إن وجد */
        text-align: center;
        transition: background-color 0.3s ease;
        /* تأثير انتقال عند التمرير */
    }

    .custom-file-upload-button:hover {
        background-color: #e0e0e0;
        /* تغيير لون الخلفية عند التمرير */
    }

    .custom-file-upload-button input[type="file"] {
        display: none;
        /* الطريقة الأكثر شيوعًا لإخفائه تمامًا */
    }

</style>

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="edit-form-section">
    <div class="page-wrapper">

        <!-- منطقة الشات -->
        <main class="chat-container">
            <!-- رسالة نجاح -->
            @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle ms-2"></i>
                {{ session('success') }}
            </div>
            @endif

            <div class="chat-box-area">
                <span class="active-date">
                    <i class="fas fa-calendar-alt ms-1"></i>
                    {{ $message->created_at->format('d M Y') }}
                </span>

                <!-- الرسالة الأصلية -->
                <div class="chat-content incoming">
                    <div class="message-item">
                        <div class="bubble">
                            {{ $message->content }}
                            @if ($message->file_path)
                            <div class="media-content">
                                @php
                                $extension = pathinfo($message->file_path, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($message->file_path) }}" alt="مرفق الرسالة الأصلية">
                                @elseif (in_array($extension, ['mp4', 'mov', 'avi']))
                                <video width="100%" controls>
                                    <source src="{{ Storage::url($message->file_path) }}" type="video/{{ $extension }}">
                                </video>
                                @else
                                <p><a href="{{ Storage::url($message->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">عرض المرفق</a></p>
                                @endif
                            </div>
                            @endif
                        </div>
                        <div class="message-time">
                            {{-- <i class="fas fa-user-circle ms-1"></i> --}}
                            {{-- <img src="{{ $message->chef_profile->official_image }}" alt=""> --}}
                            {{ $message->user->name ?? 'مستخدم محذوف' }} - {{ $message->created_at->format('h:i A') }}
                            <span class="badge {{ $message->status === 'unread' ? 'bg-secondary' : ($message->status === 'opened' ? 'bg-info' : ($message->status === 'closed' ? 'bg-danger' : 'bg-success')) }}">
                                @switch($message->status)
                                @case('unread')
                                غير مقروءة
                                @break

                                @case('opened')
                                مفتوحة
                                @break

                                @case('closed')
                                مغلقة
                                @break

                                @case('replied')
                                تم الرد
                                @break

                                @default
                                حالة غير معروفة
                                @endswitch
                            </span>
                        </div>
                    </div>
                </div>

                <!-- عرض الردود السابقة -->
                @foreach ($message->replies->sortBy('created_at') as $reply)
                <div class="chat-content {{ $reply->user_id === Auth::id() ? 'outgoing' : 'incoming' }}">
                    <div class="message-item">
                        <div class="bubble">
                            {{ $reply->content }}
                            @if ($reply->file_path)
                            <div class="media-content">
                                @php
                                $extension = pathinfo($reply->file_path, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($reply->file_path) }}" alt="مرفق الرد">
                                @elseif (in_array($extension, ['mp4', 'mov', 'avi']))
                                <video width="100%" controls>
                                    <source src="{{ Storage::url($reply->file_path) }}" type="video/{{ $extension }}">
                                </video>
                                @else
                                <p><a href="{{ Storage::url($reply->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">عرض المرفق</a></p>
                                @endif
                            </div>
                            @endif
                        </div>
                        <div class="message-time">
                            <i class="fas fa-user-circle ms-1"></i>
                            {{ $reply->user->name ?? 'مستخدم محذوف' }}
                            @if ($reply->user_id === Auth::id())
                            (أنت)
                            @endif
                            - {{ $reply->created_at->format('h:i A') }}
                            <span class="badge {{ $reply->status === 'unread' ? 'bg-warning' : 'bg-success' }}">
                                {{ $reply->status === 'unread' ? 'غير مقروء' : 'مقروء' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>

        <!-- منطقة الرد المحسنة -->
        <form action="{{ route('admin.messages.update-status-and-reply', $message->id) }}" method="POST" enctype="multipart/form-data">
            {{-- <div class="chat-footer">
                <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST"
            enctype="multipart/form-data"> --}}
            @csrf

            <!-- حالة الرسالة -->
            <div class="mb-3">
                <label for="status" class="form-label">
                    <i class="fas fa-flag ms-1"></i>
                    حالة الرسالة الأصلية:
                </label>
                <select class="" name="status" id="status" required>
                    <option value="unread" {{ old('status', $message->status) == 'unread' ? 'selected' : '' }}>🔴
                        غير مقروءة</option>
                    <option value="opened" {{ old('status', $message->status) == 'opened' ? 'selected' : '' }}>📖
                        مفتوحة</option>
                    <option value="replied" {{ old('status', $message->status) == 'replied' ? 'selected' : '' }}>✅
                        تم الرد</option>
                    <option value="closed" {{ old('status', $message->status) == 'closed' ? 'selected' : '' }}>🔒
                        مغلقة</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- الرد النصي -->
            <div class="mb-3">

                <textarea class="form-control" name="content" id="content" rows="1" placeholder="اكتب ردك هنا...">{{ old('content') }}</textarea>
                @error('content')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div style="display: flex; gap: 5px;">

                <!-- رفع المرفقات -->
                <div class="upload-image-button">
                    <div class="">
                        <label for="admin_reply_file" class="custom-file-upload-button">
                            {{-- الأيقونة أو النص الذي سيظهر للمستخدم --}}
                            <i class="fas fa-plus-circle fa-2x"></i> {{-- حقل الإدخال الفعلي: مخفي ولكن تفاعلي --}}
                            <input type="file" name="file" id="admin_reply_file" accept="image/*,video/*">
                        </label>
                        @error('file')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @error('file')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-paper-plane ms-2"></i>
                    إرسال الرد وتحديث الحالة
                </button>
            </div>
        </form>
    </div>
</div>

{{-- الكود الأصلي مخفي للاحتفاظ بالوظائف --}}
<div style="display: none;">
    <div class="container">
        {{-- تفاصيل الرسالة الأصلية --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">الرسالة الأصلية</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $message->title }}</h5>
                <p class="card-text">{{ $message->content }}</p>
                @if ($message->file_path)
                <div class="mb-3">
                    <strong>مرفق الرسالة الأصلية:</strong>
                    @php
                    $extension = pathinfo($message->file_path, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ Storage::url($message->file_path) }}" class="img-fluid rounded" alt="Attached Image" style="max-width: 300px;">
                    @elseif (in_array($extension, ['mp4', 'mov', 'avi']))
                    <video controls width="320" height="240" class="rounded">
                        <source src="{{ Storage::url($message->file_path) }}" type="video/{{ $extension }}">
                        متصفحك لا يدعم عرض الفيديو.
                    </video>
                    @else
                    <a href="{{ Storage::url($message->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">عرض المرفق</a>
                    @endif
                </div>
                @endif
                <hr>
                <p class="card-subtitle text-muted">من: {{ $message->user->name ?? 'مستخدم محذوف' }}
                    ({{ $message->user->role ?? 'غير معروف' }})</p>
                <p class="card-subtitle text-muted">تاريخ: {{ $message->created_at->format('d/m/Y H:i') }}</p>
                <p class="card-subtitle text-muted">الحالة:
                    <span class="badge {{ $message->status === 'unread' ? 'bg-secondary' : ($message->status === 'opened' ? 'bg-info' : ($message->status === 'closed' ? 'bg-danger' : 'bg-success')) }}">
                        @switch($message->status)
                        @case('unread')
                        غير مقروءة
                        @break

                        @case('opened')
                        مفتوحة
                        @break

                        @case('closed')
                        مغلقة
                        @break

                        @case('replied')
                        تم الرد
                        @break

                        @default
                        حالة غير معروفة
                        @endswitch
                    </span>
                </p>
            </div>
        </div>

        {{-- الردود السابقة --}}
        @if ($message->replies->count() > 0)
        <h4 class="mb-3 mt-4">الردود السابقة:</h4>
        @foreach ($message->replies->sortBy('created_at') as $reply)
        <div class="card mb-3 {{ $reply->user_id === Auth::id() ? 'border-primary' : 'border-secondary' }}">
            <div class="card-body">
                <p class="card-text">{{ $reply->content }}</p>
                @if ($reply->file_path)
                <div class="mb-3">
                    <strong>مرفق الرد:</strong>
                    @php
                    $extension = pathinfo($reply->file_path, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ Storage::url($reply->file_path) }}" class="img-fluid rounded" alt="Reply Attached Image" style="max-width: 200px;">
                    @elseif (in_array($extension, ['mp4', 'mov', 'avi']))
                    <video controls width="240" height="180" class="rounded">
                        <source src="{{ Storage::url($reply->file_path) }}" type="video/{{ $extension }}">
                        متصفحك لا يدعم عرض الفيديو.
                    </video>
                    @else
                    <a href="{{ Storage::url($reply->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">عرض المرفق</a>
                    @endif
                </div>
                @endif
                <hr>
                <p class="card-subtitle text-muted">
                    من: {{ $reply->user->name ?? 'مستخدم محذوف' }}
                    @if ($reply->user_id === Auth::id())
                    (أنت)
                    @endif
                    <span class="float-end">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                </p>
                <p class="card-subtitle text-muted">
                    الحالة:
                    <span class="badge {{ $reply->status === 'unread' ? 'bg-warning text-dark' : 'bg-success' }}">
                        {{ $reply->status === 'unread' ? 'غير مقروء' : 'مقروء' }}
                    </span>
                </p>
            </div>
        </div>
        @endforeach
        @else
        <p class="mt-4">لا توجد ردود على هذه الرسالة حتى الآن.</p>
        @endif

        {{-- فورم إرسال رد جديد - مخفي --}}
        <h4 class="mb-3 mt-4">إرسال رد جديد:</h4>
        <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            <div class="mb-3">
                <label for="content_old" class="form-label">الرد (اختياري)</label>
                <textarea class="form-control" name="content" id="content_old" rows="4">{{ old('content') }}</textarea>
                @error('content')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div style="display: flex;">

                <div class="mb-3">
                    {{-- <label for="admin_reply_file_old" class="form-label">إضافة مرفق (اختياري)</label> --}}
                    <input type="file" name="file" id="admin_reply_file_old" class="form-control" hidden>
                    +
                    @error('file')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane ms-1"></i>
                    إرسال الرد
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    // تأثيرات تفاعلية
    document.addEventListener('DOMContentLoaded', function() {
        // إضافة تأثير عند الإرسال
        const form = document.querySelector('.chat-footer form');
        const button = document.querySelector('.btn-primary');

        if (form && button) {
            const originalText = button.innerHTML;

            form.addEventListener('submit', function(e) {
                button.innerHTML = '<i class="fas fa-spinner fa-spin ms-2"></i>جاري الإرسال...';
                button.disabled = true;
            });
        }

        // إضافة تأثير للصور
        const images = document.querySelectorAll('.media-content img');
        images.forEach(img => {
            img.addEventListener('click', function() {
                this.style.transform = this.style.transform === 'scale(1.1)' ? 'scale(1)' :
                    'scale(1.1)';
            });
        });

        // التمرير التلقائي لآخر رسالة
        const chatContainer = document.querySelector('.chat-container');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });

</script>
@endsection
