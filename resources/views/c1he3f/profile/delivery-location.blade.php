<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>متجري</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
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
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">أماكن توصيل</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top" style="margin-top: 50px;">
            <div class="container">
                <div class="dz-list m-b20">
                    <ul class="dz-list-group radio style-2" style="direction: rtl;">
                        @forelse($deliveryLocations as $location)
                            @if ($location->country !== 'غير محدد')
                                <li class="list-group-items">
                                    <label class="radio-label">
                                        <div class="checkmark">
                                            <div class="dz-icon style-2 icon-fill">
                                                <form
                                                    action="{{ route('c1he3f.profile.delivery-location.destroy', $location->id) }}"
                                                    method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-danger"
                                                        style="border:none; background:none;">
                                                        <i class="fi fi-rr-trash font-20"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="list-content">
                                                <a href="#">
                                                    <h6 class="title">{{ $location->country }}</h6>
                                                </a>
                                                <p class="active-status">
                                                    {{ $location->city }} , {{ $location->area }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z"
                                                            stroke="#17191C" stroke-width="1.5" stroke-miterlimit="10"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M6.5 11H18.5" stroke="#17191C" stroke-width="1.5"
                                                            stroke-miterlimit="10" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M6.5 13H12.5H18.5" stroke="#17191C" stroke-width="1.5"
                                                            stroke-miterlimit="10" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    {{ number_format($location->delivery_fee, 2) }}
                                                </p>
                                            </div>
                                            <span class="check"></span>
                                        </div>
                                    </label>
                                </li>
                            @endif
                        @empty
                            {{-- This block runs if $deliveryLocations is empty --}}
                            <p class="text-center">لا توجد أماكن توصيل مضافة بعد.</p>
                        @endforelse

                    </ul>
                </div>

                <a href="{{ route('c1he3f.profile.add-delivery-address') }}" class="dz-add-box">
                    <i class="fi fi-rr-add me-2"></i>
                    <span>إضافة جديد</span>
                    <i class="feather icon-chevron-right"></i>
                </a>
            </div>
        </main>
    </div>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            // SweetAlert للتنبيهات
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'نجاح!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ!',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            // تأكيد الحذف
            $('.delete-form').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع عن هذا!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم، احذفه!',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
