<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>إضافة إرشاد مخصص</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/user-logo/favicon.png') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/imageuplodify/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #660099;
        }

        .form-control:focus,
        .form-control:active,
        .form-control.active {
            border-color: var(--primary-color);
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

        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('users.family.tips', $myFamily) }}" style="background-color: unset !important;"
                        id="back-btn">
                        <i class="feather icon-arrow-left" style="font-weight: normal; color: #660099;"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.add_new') }}</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    <a id="submitCustomTip" href="javascript:void(0);">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </a>
                </div>
            </div>
        </header>

        <main class="page-content space-top p-b100" style="text-align: center;">
            <div class="container">

                <!-- Form للإرشاد المخصص -->
                <form id="customTipForm" action="{{ route('users.family.add_update_tips', $myFamily) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="custom_tip">{{ __('messages.special_tips') }}</label>
                        <input type="text" id="custom_tip" name="custom_tip"
                            class="form-control @error('custom_tip') is-invalid @enderror" style="text-align: center;"
                            value="{{ old('custom_tip') }}" required>

                        @error('custom_tip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </form>

            </div>
        </main>
    </div>

    <script>
        // إرسال الفورم عند الضغط على علامة الصح
    const submitButton = document.getElementById('submitCustomTip');
    const form = document.getElementById('customTipForm');
    
    submitButton.addEventListener('click', function () {
        // التحقق من أن الحقل غير فارغ
        const input = document.getElementById('custom_tip');
        if (input.value.trim() === '') {
            input.classList.add('is-invalid');
            return;
        }
        form.submit();
    });

    // إزالة رسالة الخطأ عند الكتابة
    document.getElementById('custom_tip').addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
    </script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>