<!DOCTYPE html>
<html lang="ar">
<head>
    <!-- Title -->
    <title>عرض الرسالة</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :lang(ar) body {
            font-family: 'cairo';
            font-size: 17px;
        }
        body {
            --tw-bg-opacity: 1;
            --tw-text-opacity: 1;
            line-height: 1.5;
            font-size: 1rem;
            letter-spacing: -.025em;
            color: rgb(74 74 74/var(--tw-text-opacity, 1));
            transition: opacity ease-in 0.2s;
        }
        .chat-content.user .bubble {
            background-color: #e0f7fa;
            color: #000;
            margin-left: auto;
            border-radius: 10px 10px 0 10px;
        }
        .chat-content .bubble {
            background-color: #f5f5f5;
            color: #000;
            border-radius: 10px 10px 10px 0;
        }

        .chat-content.outgoing {
            justify-content: end;
            padding-right: 0px !important;
        }

        .chat-content:last-of-type {
            margin-bottom: 100px !important;
        }

        .chat-content.outgoing .bubble {
            background: var(--primary) !important;
            color: #ffffff !important;
            
        }

        .bubble {
            padding: 10px 15px;
            max-width: 70%;
            margin-bottom: 5px;
        }
        .message-time {
            font-size: 0.8rem;
            color: #999;
        }
        .chat-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #fff;
            padding: 10px;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
        .input-wrapper {
            display: flex;
            align-items: center;
        }
        .chat-btn svg {
            fill: #e00000;
        }
        .media-content img, .media-content video {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
            height: 300px;
        }
    </style>
</head>
<body class="bg-light">
<div class="page-wrapper">
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            {{-- <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> --}}
        </div>
    </div>
    <!-- Preloader end-->

    <!-- Header -->
    <header class="header header-fixed">
        <div class="header-content">
            <div class="left-content">
                <a href="{{ route('c1he3f.messages') }}" class="back-btn">
                    <i class="feather icon-arrow-left"></i>
                </a>
            </div>
            <div class="mid-content">
                <h4 class="title">{{ $message->title }}</h4>
            </div>
        </div>
    </header>
    <!-- Header -->

    <!-- Main Content Start -->
<main class="page-content space-top p-b60">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="chat-box-area">
            <span class="active-date">{{ $message->created_at->format('d M Y') }}</span>
            <!-- Original Message -->
            <div class="chat-content user" style="justify-content: end;">
                <div class="message-item">
                    <div class="bubble">{{ $message->content }}</div>
                    @if ($message->file_path)
                        <div class="media-content">
                            @if (pathinfo($message->file_path, PATHINFO_EXTENSION) === 'mp4')
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/' . $message->file_path) }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $message->file_path) }}" alt="رسالة">
                            @endif
                        </div>
                    @endif
                    <div class="message-time">{{ $message->created_at->format('h:i A') }}</div>
                </div>
            </div>
            <!-- Display All Replies -->
            @foreach ($message->replies as $reply)
                <div class="chat-content {{ $reply->user_id === Auth::id() ? 'outgoing' : 'incoming' }}">
                    <div class="message-item">
                        <div class="media align-items-end gap-2">
                            <div>
                                <div class="bubble">{{ $reply->content }}</div>
                                @if ($reply->file_path)
                                    <div class="media-content">
                                        @if (pathinfo($reply->file_path, PATHINFO_EXTENSION) === 'mp4')
                                            <video width="100%" controls>
                                                <source src="{{ asset('storage/' . $reply->file_path) }}" type="video/mp4">
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/' . $reply->file_path) }}" alt="رد">
                                        @endif
                                    </div>
                                @endif
                                <div class="message-time">{{ $reply->created_at->format('h:i A') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>    <!-- Main Content End -->

<div class="chat-footer">
    <form action="{{ route('c1he3f.messages.reply', $message->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <textarea class="form-control" name="content" id="content" rows="1" placeholder="اكتب ردك هنا..." required>{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 5px; align-items: center;">

            <div class="upload-image-button">
                <label for="chef_reply_file" class="custom-file-upload-button">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <input type="file" name="file" id="chef_reply_file" accept="image/*,video/*">
                </label>
                @error('file')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-paper-plane ms-2"></i>
                إرسال الرد
            </button>
        </div>
    </form>
</div>

<style>
    /* ... (الـ CSS الحالي لديك) ... */
    .custom-file-upload-button {
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f0f0f0;
        color: #e00000;
        font-size: 1rem;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .custom-file-upload-button:hover {
        background-color: #e0e0e0;
    }

    .custom-file-upload-button input[type="file"] {
        display: none; /* إخفاء حقل الإدخال الفعلي */
    }

    /* تنسيقات إضافية لمربعات الشات */
    .chat-content.incoming .bubble { /* الرسائل المستلمة (من الأدمن للشيف) */
        background-color: #e0f7fa; /* لون فاتح */
        color: #000;
        margin-right: auto; /* لترتيبها على اليسار */
        border-radius: 10px 10px 10px 0;
    }
    .chat-content.outgoing .bubble { /* الرسائل المرسلة (من الشيف للأدمن) */
        background-color: #dcf8c6; /* لون أخضر فاتح */
        color: #000;
        margin-left: auto; /* لترتيبها على اليمين */
        border-radius: 10px 10px 0 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.chat-footer form');
        const button = form.querySelector('button[type="submit"]');

        if (form && button) {
            const originalText = button.innerHTML;

            form.addEventListener('submit', function() {
                button.innerHTML = '<i class="fas fa-spinner fa-spin ms-2"></i>جاري الإرسال...';
                button.disabled = true;
            });
        }

        // التمرير التلقائي لآخر رسالة
        const chatBoxArea = document.querySelector('.chat-box-area');
        if (chatBoxArea) {
            chatBoxArea.scrollTop = chatBoxArea.scrollHeight;
        }

        // معاينة الملف المرفق (إذا أردت إضافة هذه الميزة)
        const fileInput = document.getElementById('chef_reply_file');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const fileName = this.files[0].name;
                    // يمكنك عرض اسم الملف للمستخدم هنا
                    // مثال: alert('تم اختيار ملف: ' + fileName);
                    console.log('File selected:', fileName);
                }
            });
        }
    });
</script>
</div>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        console.log('Form submitted with response:', document.querySelector('input[name="response"]').value);
    });
</script>
<!-- Scripts -->
<script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('index.js') }}"></script>
</body>
</html>