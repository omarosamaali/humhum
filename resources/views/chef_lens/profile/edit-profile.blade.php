<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>الملف الشخصي</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    {!! $swalScript !!}
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    {!! $swalScript !!}

    <style>
        .widget_getintuch.pb-15.profile {
            direction: rtl;
        }

        .count-area {
            position: absolute;
            right: 6px;
            top: 3px;
            background: rgb(255, 255, 255);
            color: #000;
            width: 25px;
            z-index: 999999999;
            height: 22px;
            border-radius: 50px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex !important;
        }

        .custom-icon {
            color: white !important;
            font-size: 13px !important;
            font-weight: 400;
        }

        .money-btn {
            width: 100%;
            background-color: #000000c9;
            text-align: center;
            width: 70%;
            border-top-right-radius: 15px !important;
            border-bottom-right-radius: 15px !important;
            height: 42px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
        }

        .order-now {
            background-color: #000000a8;
            text-align: center;
            width: 100%;
            text-align: center;
            width: 100%;
            height: 42px;
            margin-left: 10px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            border-top-left-radius: 15px !important;
            border-bottom-left-radius: 15px !important;
            color: white;
        }

        #menu-btn {
            background-color: #efc00454;
            text-align: center;
            width: 100%;
            text-align: center;
            border: 1px solid #EFBF04;
            width: 70%;
            border-radius: 15px;
            height: 42px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            color: white;
        }

        label {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;

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

        <!-- Header -->
        <header class="header header-fixed" style="background-color: white !important;">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ url()->previous() ?: route('home') }}" id="back-btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">تعديل الملف الشخصي</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b80">
            <div class="container">
                @if (session('status'))
                <div class="alert alert-success mt-3">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('chef_lens.update-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($user->avatar)
                    <div style="text-align: center; margin-bottom: 20px;">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover;">
                        <p style="margin-top: 10px;">الصورة الشخصية الحالية</p>
                    </div>
                    @endif
                    <div class="mb-4">
                        <label for="avatar">تغيير الصورة الشخصية</label>
                        <input type="file" name="avatar" id="avatar" class="form-control">
                        @error('avatar')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name">الاسم</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary">تحديث الملف الشخصي</button>
                </form>

            </div>

        </main>


        <!-- Main Content End -->


    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>

</body>

</html>
