<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>روبط التواصل الاجتماعي</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <style>
        .form-group.mb-3 {
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="page-wrapper">

        <main class="page-content space-top">
            <div class="container py-0">
                <div class="dz-authentication-area" style="padding-bottom: 0px;">
                    <div class="main-logo">
                        <a href="javascript:void(0);" class="back-btn">
                            <i class="feather icon-arrow-left"></i>
                        </a>
                        <div class="logo" style="right: 32px; position: relative;">
                            <img src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                        </div>
                    </div>
                </div>
                <div class="social-media-form">
                    <div class="dz-card">
                        <div class="card-header" style="justify-content: center;">
                            <h4 class="card-title">روابط التواصل الاجتماعي</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('social-media.store') }}" method="POST">
                                @csrf

                                <!-- YouTube -->
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fa-brands fa-youtube text-danger me-2"></i>
                                        YouTube
                                    </label>
                                    <input value="{{ old('youtube', $socialMedia?->youtube) }}" type="url" class="form-control @error('youtube') is-invalid @enderror" name="youtube" placeholder="https://youtube.com/@channel" value="{{ old('youtube') }}">
                                    @error('youtube')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- TikTok -->
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fa-brands fa-tiktok text-dark me-2"></i>
                                        TikTok
                                    </label>
                                    <input value="{{ old('tiktok', $socialMedia?->tiktok) }}" type="url" class="form-control @error('tiktok') is-invalid @enderror" name="tiktok" placeholder="https://tiktok.com/@username" value="{{ old('tiktok') }}">
                                    @error('tiktok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Instagram -->
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fa-brands fa-instagram text-danger me-2"></i>
                                        Instagram
                                    </label>
                                    <input value="{{ old('instagram', $socialMedia?->instagram) }}" type="url" class="form-control @error('instagram') is-invalid @enderror" name="instagram" placeholder="https://instagram.com/username" value="{{ old('instagram') }}">
                                    @error('instagram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Snapchat -->
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fa-brands fa-snapchat text-warning me-2"></i>
                                        Snapchat
                                    </label>
                                    <input value="{{ old('snapchat', default: $socialMedia?->snapchat) }}" type="url" class="form-control @error('snapchat') is-invalid @enderror" 
                                    name="snapchat" placeholder="https://snapchat.com/add/username" value="{{ old('snapchat') }}">
                                    @error('snapchat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Facebook -->
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fa-brands fa-facebook me-2" style="color: #3b5998;"></i>
                                        Facebook
                                    </label>
                                    <input value="{{ old('facebook', $socialMedia?->facebook) }}" type="url" class="form-control @error('facebook') is-invalid @enderror" name="facebook" placeholder="https://facebook.com/page" value="{{ old('facebook') }}">
                                    @error('facebook')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-save me-2"></i>
                                        حفظ الروابط
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>

    <script>
        $(document).ready(function() {
            // SweetAlert للتنبيهات
            @if(session('success'))
            Swal.fire({
                icon: 'success'
                , title: 'نجاح!'
                , text: '{{ session('
                success ') }}'
                , showConfirmButton: false
                , timer: 3000
            });
            @endif

            @if(session('error'))
            Swal.fire({
                icon: 'error'
                , title: 'خطأ!'
                , text: '{{ session('
                error ') }}'
                , showConfirmButton: false
                , timer: 3000
            });
            @endif

            // التحكم في زر "أماكن التوصيل"
            $('input[name="has_market"]').change(function() {
                if ($(this).val() == '1') { // إذا اختار "نعم"
                    $('#deliveryLocationButton').show();
                } else { // إذا اختار "لا"
                    $('#deliveryLocationButton').hide();
                }
            });

            // تأكد من أن الزر يظهر/يختفي عند تحميل الصفحة
            var initialValue = $('input[name="has_market"]:checked').val();
            if (initialValue == '1') {
                $('#deliveryLocationButton').show();
            } else {
                $('#deliveryLocationButton').hide();
            }
        });

    </script>
</body>

</html>
