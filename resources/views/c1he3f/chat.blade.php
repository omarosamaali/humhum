<!DOCTYPE html>
<html lang="ar" dir="rtl">
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
            font-family: Noto Naskh Arabic, Noto Sans Arabic, sans-serif;
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
        }
    </style>
</head>
<body class="bg-light">
<div class="page-wrapper">
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!-- Preloader end-->

    <!-- Header -->
    <header class="header header-fixed">
        <div class="header-content">
            <div class="left-content">
                <a href="{{ route('c1he3f.messages') }}" class="back-btn">
                    <i class="feather icon-arrow-right"></i>
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
                <div class="chat-content user">
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
                @if ($message->response)
                    <div class="chat-content">
                        <div class="message-item">
                            <div class="media align-items-end gap-2">
                                <div>
                                    <div class="bubble">{{ $message->response }}</div>
                                    <div class="message-time">{{ $message->updated_at->format('h:i A') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
    <!-- Main Content End -->

    <!-- Chat Footer -->
    @if ($message->status !== 'replied')
        <div class="chat-footer">
            <form action="{{ route('c1he3f.messages.reply', $message->id) }}" method="POST">
                @csrf
                <div class="form-group boxed">
                    <div class="input-wrapper message-area input-lg">
                        <div class="append-media"></div>
                        <input type="text" name="response" class="form-control" placeholder="اكتب ردك هنا ..." required>
                        <button type="submit" class="btn chat-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.49984 21.75C1.33034 21.75 1.16384 21.693 1.02734 21.582C0.81134 21.4065 0.70934 21.126 0.76409 20.8523L2.26409 13.3523C2.32484 13.047 2.56859 12.8108 2.87609 12.7598L7.43759 12L2.87684 11.2395C2.56934 11.1885 2.32559 10.9523 2.26484 10.647L0.76484 3.147C0.70934 2.874 0.81134 2.5935 1.02734 2.418C1.24334 2.2425 1.54184 2.20125 1.79459 2.31075L22.7946 11.3108C23.0713 11.4285 23.2498 11.7 23.2498 12C23.2498 12.3 23.0713 12.5715 22.7953 12.6893L1.79534 21.6893C1.70084 21.7305 1.59959 21.75 1.49984 21.75V21.75Z" fill="#e00000"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    <!-- Chat Footer -->
</div>

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