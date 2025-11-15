<!DOCTYPE html>
<html lang="en">


<head>
    <title>تواصل معنا | Contact Us</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    {!! $swalScript !!}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/user-logo/favicon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/messages.css') }}">
</head>

<body class="bg-light">
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ url()->previous() }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.send_messages') }}</h4>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('users.messages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                    <div class=" p-5"
                        style="background-color: #8100c2db; height: 40vh; width: 80%; margin: auto; border-radius: 15px;">
                        <div style="top: 20%;" class="text-center">
                            <div>
                                <img class="w-25 mx-auto"
                                    src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-white font-weight-bold mt-3">{{ __('messages.أضف الفيديو أو الصورة') }}</p>
                                <p class="text-white">{{ __('messages.نحن هنا لخدمتكم') }}</p>
                            </div>
                            <input type="file" name="file" id="fil-ttd" class="form-control mt-3">
                        </div>
                    </div>
                    <div class="my-3">
                        <input type="text" name="title" id="title" style="text-align: center; color: #000000;"
                            placeholder="{{ __('messages.اسم الموضوع') }}" class="form-control" required>
                    </div>
                    <div class="my-3">
                        <textarea name="content" id="content" style="height: 98px; text-align: center; color: #000000;"
                            placeholder="{{ __('messages.محتوى الرسالة') }}" class="form-control" required></textarea>
                    </div>
                    <div class="footer-fixed-btn bottom-0 bg-white">
                        <button type="submit" class="btn btn-lg btn-primary w-100 rounded-xl">
                            {{ __('messages.send') }}
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

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
