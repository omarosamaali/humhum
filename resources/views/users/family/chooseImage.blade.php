<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>{{ __('messages.اختر الصورة الشخصية') }}</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Globle Stylesheets -->

    <!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        :root {
            --primary-color: #660099;
        }

        .edit-profile .avatar-upload .avatar-preview {
            border: 3px solid gray;
        }

        .edit-profile .avatar-upload .avatar-preview.active {
            border: 3px solid var(--primary-color);
        }

        .edit-profile .avatar-upload .change-btn {
            background-color: var(--primary-color);
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control,
        .form-control:focus,
        .form-control:active,
        .form-control.active {
            border-color: var(--primary-color);
        }

        .edit-profile .avatar-upload .avatar-preview>#imagePreview {
            background-size: contain;
        }
    </style>
    @vite(['resources/js/app.js'])
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
                    <a href="{{ route('users.profile.edit') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.اختر الصورة الشخصية') }}</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    <a id="submitForm" href="javascript:void(0);">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </a>
                </div>
            </div>
        </header>
        
        <!-- Main Content Start  -->
        <main class="page-content">
            <div class="container py-0">
                <div class="dz-authentication-area">
                    <div class="account-section" style="padding-bottom: 78px; margin-top: 78px;">
                        <form class="m-b20" method="POST" action="{{ route('users.family.updateImage', $myFamily) }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- @method('PUT') --}}
                            <input type="hidden" name="avatar" id="selectedImage">
                            <div class="edit-profile">
                                <p>{{ __('messages.إختر الصورة المعبرة لك') }}</p>
                                <div
                                    style="display: flex; flex-wrap: wrap; gap: 40px; align-items: center; justify-content: center;">
                                    @foreach ($avatars as $avatar)
                                    <div class="profile-image">
                                        <div class="avatar-upload">
                                            <div class="avatar-preview" style="width: 100px; height: 100px;"
                                                data-image="{{ asset('storage/' . $avatar->image) }}">
                                                <img src="{{ asset('storage/' . $avatar->image) }}" style="width: 90px; height: 90px; border-radius: 50%;"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <script>
        document.querySelectorAll('.avatar-preview').forEach(preview => {
            preview.addEventListener('click', function () {
                // إزالة الكلاس active من كل الصور
                document.querySelectorAll('.avatar-preview').forEach(p => p.classList.remove('active'));
    
                // إضافة الكلاس active على الصورة اللي تم الضغط عليها
                this.classList.add('active');
            });
        });
    </script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
                const previews = document.querySelectorAll('.avatar-preview');
                const selectedImageInput = document.getElementById('selectedImage');
                const submitButton = document.getElementById('submitForm');
                const form = document.querySelector('form');
    
                previews.forEach(preview => {
                    preview.addEventListener('click', function() {
                        // إزالة النشاط من جميع الصور
                        previews.forEach(p => p.classList.remove('active'));
                        
                        // إضافة النشاط للصورة المختارة
                        this.classList.add('active');
                        
                        // الحصول على رابط الصورة من data-image
                        const imageUrl = this.getAttribute('data-image');
                        selectedImageInput.value = imageUrl;
                        
                        console.log('Selected image:', imageUrl); // للت Debug
                    });
                });
    
                submitButton.addEventListener('click', function() {
                    if(selectedImageInput.value) {
                        form.submit();
                    } else {
                        alert('{{ __('messages.please_choose_image_first') }}');
                    }
                });
            });
    </script>    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
    <script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>