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
        .list-group-items {
            position: relative;
            padding: 15px;
            margin-bottom: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .list-group-items.selected {
            border: 2px solid #007bff;
            background: #f8f9ff;
        }

        .action-buttons {
            z-index: 10;
        }

        .radio-label {
            display: block;
            cursor: pointer;
            margin: 0;
            margin-left: 10px;
            padding: 0px 10px;
        }

        .checkmark {
            display: block;
            width: 100%;
        }

        .checkmark .check {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            background: white;
        }

        .list-group-items.selected .checkmark .check {
            border-color: #007bff;
            background: #007bff;
        }

        .list-group-items.selected .checkmark .check::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
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
                                <input type="checkbox" name="selected_location" value="{{ $location->id }}" {{ $location->is_selected ? 'checked' : '' }}>
                                <div class="checkmark">
                                    <div class="dz-icon style-2 icon-fill" onclick="event.stopPropagation();">
                                        <form action="{{ route('c1he3f.profile.delivery-location.destroy', $location->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger" style="border:none; background:none;">
                                                <i class="fi fi-rr-trash font-20"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="dz-icon style-2 icon-fill" onclick="event.stopPropagation();">
                                        <a href="{{ route('c1he3f.profile.delivery-location.edit', $location->id) }}" class="btn btn-link p-0 text-primary edit-btn" style="border:none; background:none;">
                                            <i class="feather icon-edit font-20"></i>
                                        </a>
                                    </div>
                                    <div class="list-content">
                                        <a href="#">
                                        <h6 class="title">
                                            @php
                                            $countryName = '';
                                            switch (strtolower($location->country)) {

                                            case 'sa':
                                            $countryName = 'المملكة العربية السعودية';
                                            break;
                                            case 'ae':
                                            $countryName = 'الإمارات العربية المتحدة';
                                            break;
                                            case 'qa':
                                            $countryName = 'قطر';
                                            break;
                                            case 'kw':
                                            $countryName = 'الكويت';
                                            break;
                                            case 'bh':
                                            $countryName = 'البحرين';
                                            break;
                                            case 'om':
                                            $countryName = 'سلطنة عُمان';
                                            break;
                                            case 'ye':
                                            $countryName = 'اليمن';
                                            break;
                                            case 'iq':
                                            $countryName = 'العراق';
                                            break;
                                            case 'sy':
                                            $countryName = 'سوريا';
                                            break;
                                            case 'jo':
                                            $countryName = 'الأردن';
                                            break;
                                            case 'lb':
                                            $countryName = 'لبنان';
                                            break;
                                            case 'ps':
                                            $countryName = 'فلسطين';
                                            break;
                                            case 'eg':
                                            $countryName = 'مصر';
                                            break;
                                            case 'sd':
                                            $countryName = 'السودان';
                                            break;
                                            case 'ly':
                                            $countryName = 'ليبيا';
                                            break;
                                            case 'tn':
                                            $countryName = 'تونس';
                                            break;
                                            case 'dz':
                                            $countryName = 'الجزائر';
                                            break;
                                            case 'ma':
                                            $countryName = 'المغرب';
                                            break;
                                            case 'mr':
                                            $countryName = 'موريتانيا';
                                            break;
                                            case 'dj':
                                            $countryName = 'جيبوتي';
                                            break;
                                            case 'so':
                                            $countryName = 'الصومال';
                                            break;
                                            case 'km':
                                            $countryName = 'جزر القمر';
                                            break;
                                            default:
                                            $countryName = 'غير محدد';
                                            break;
                                            }
                                            @endphp
                                            @if (Auth::user()->chefProfile)
                                          {{ $countryName }}
                                            {{-- <img src="https://flagcdn.com/24x18/{{ strtolower($chefProfile->country) ?: 'default' }}.png"
                                            alt="علم {{ $countryName }}" style="width: 24px; height: 18px; vertical-align: middle;"> --}}
                                            @else
                                            <p>لا يوجد ملف شخصي.</p>
                                            @endif
                                        </h6>

                                        </a>
                                        <p class="active-status">
                                            {{ $location->city }} , {{ $location->area }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M8 7V17H12C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7H8Z" stroke="#17191C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.5 11H18.5" stroke="#17191C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.5 13H12.5H18.5" stroke="#17191C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
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

        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <script>
            $(document).ready(function() {
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

                // تأكيد الحذف فقط لنماذج الحذف
                $('.delete-form').submit(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'هل أنت متأكد؟'
                        , text: "لن تتمكن من التراجع عن هذا!"
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonColor: '#3085d6'
                        , cancelButtonColor: '#d33'
                        , confirmButtonText: 'نعم، احذفه!'
                        , cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
            $(document).ready(function() {
                $('input[name="selected_location"]').change(function() {
                    var locationId = $(this).val();
                    $.ajax({
                        url: '/profile/delivery-location/select/' + locationId
                        , method: 'POST'
                        , data: {
                            _token: '{{ csrf_token() }}'
                            , selected_location: locationId
                        }
                        , success: function(response) {
                            $('.list-group-items').removeClass('selected');
                            $(`input[value="${locationId}"]`).closest('.list-group-items').addClass('selected');
                            Swal.fire({
                                icon: 'success'
                                , title: 'تم التحديد!'
                                , text: 'تم تحديد مكان التوصيل بنجاح'
                                , showConfirmButton: false
                                , timer: 1500
                            });
                        }
                        , error: function() {
                            Swal.fire({
                                icon: 'error'
                                , title: 'خطأ!'
                                , text: 'حدث خطأ أثناء تحديد الموقع'
                                , showConfirmButton: false
                                , timer: 1500
                            });
                        }
                    });
                });
            });

        </script>

        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/settings.js') }}"></script>
</body>

</html>
