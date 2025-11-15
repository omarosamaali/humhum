<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>تعديل بيانات الفرد</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/imageuplodify/imageuploadify.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

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

        .edit-profile .avatar-upload .avatar-preview {
            border: 2px solid var(--primary-color);
        }

        .edit-profile .avatar-upload .change-btn {
            background: var(--primary-color);
        }

        select.form-select {
            color: var(--primary-color) !important;
            --bs-form-select-bg-img: url(https://cdn-icons-png.flaticon.com/512/32/32195.png) !important;
        }

        .form-control:focus,
        .form-control:active,
        .form-control.active {
            border-color: var(--primary-color) !important;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--primary-color);
            box-shadow: unset;
        }

        .edit-profile .avatar-upload .avatar-preview>#imagePreview {
            background-size: contain !important;
        }
    </style>
</head>

<body>
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

        <header class="header header-fixed">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('users.family.show', $myFamily) }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.edit_member_data') }}</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    <a id="submitForm" href="javascript:void(0);">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Start -->
        <main class="page-content space-top p-b80">
            <div class="container">
                <div class="edit-profile">
                    <form method="POST" action="{{ route('users.family.update_send_notification', $myFamily->id) }}">
                        @csrf
                        <div id="chef-fields" class="chef-fields">
                            <div class="col-md-12" style="text-align: center;">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.allow_user_receive_notifications')
                                        }}</label>
                                    <select class="form-select" name="send_notification"
                                        value="{{ old('send_notification') }}" style="width: 100%; text-align: center;">
                                        <option value="">{{ __('messages.choose_status') }}</option>
                                        <option value="1" {{ $myFamily->send_notification == '1' ? 'selected' : '' }}>
                                            {{ __('messages.yes') }}
                                        </option>
                                        <option value="0" {{ $myFamily->send_notification == '0' ? 'selected' : '' }}>
                                            {{ __('messages.no') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <!-- Main Content End -->

    </div>
    {!! $swalScript !!}
    <script>
        const submitButton = document.getElementById('submitForm');
                const form = document.querySelector('form');
                submitButton.addEventListener('click', function () {
                    form.submit();
                });
    </script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imageuplodify/imageuploadify.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>