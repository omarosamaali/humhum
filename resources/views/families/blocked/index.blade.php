<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>أفراد منزلي</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">


    <!-- Global CSS -->
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
    @vite(['resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #29A500;
        }
    </style>
</head>

<body style="direction: rtl;">
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
        <header class="header header-fixed border-bottom onepage">
            <div class="header-content">
                <div class="left-content">
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.blacklist') }}</h4>
                </div>
                <div class="right-content">
                    <a href="{{ route('families.welcome') }}" style="background-color: unset !important; font-size: 24px;">
                        <i class="feather icon-home" style="font-weight: normal; color: #29A500;"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Page Content Start -->
        @if(session('success'))
        <div id="toast-message" class="toast-message success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div id="toast-message" class="toast-message error">
            <i class="fas fa-times-circle"></i>
            {{ session('error') }}
        </div>
        @endif
        <main class="page-content space-top">
            <div style="text-align: center; margin-bottom: 10px;">
                <span class="img-fluid icon">
                    ❌
                </span>
                {{ __('messages.blacklist') }}
            </div>
            <ul class="featured-list">
                <div>
                    @foreach ($myBlocked as $myFamily)
                    <li class="container-cart">
                        <div class="dz-card list" style="margin-bottom: 13px; border: 1px solid #ccc;">
                            <div class="dz-media" style="position: relative;">
                                <img src="{{ asset('storage/' . $myFamily->recipe->dish_image) }}" alt="">
                            </div>
                            <div class="dz-content">
                                <div class="dz-head">
                                    <h6 class="title">
                                        <span>{{ $myFamily->recipe->title }}</span>
                                    </h6>
                                    @forelse ($myFamily->recipe->subCategories as $subCategory)
                                    <span class="badge badge-info" style="margin-bottom: 3px;">
                                        {{ app()->getLocale() == 'ar' ? $myFamily->recipe->name_ar :
                                        $myFamily->recipe->name_en }}
                                    </span>
                                    @empty
                                    <span class="text-muted">{{ __('messages.none') }}</span>
                                    @endforelse
                                    <div>
                                        <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;" class="tags">
                                            <img src="{{ asset('storage/' . $myFamily->recipe->kitchen->image) }}"
                                                style="border-radius: 50% !important; width: 30px; height: 30px;" alt="">
                                            {{ app()->getLocale() == 'ar' ? $myFamily->recipe->kitchen->name_ar
                                            : $myFamily->recipe->kitchen->name_en }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </div>
            </ul>
        </main>
        <!-- Page Content End -->

    </div>

    {!! $swalScript !!}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast-message');
        if (toast) {
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.5s ease-out';
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }, 3000);
        }
    });
    </script>

    <script>
        function deleteUser(familyId) {
        Swal.fire({
            title: "{{ __('messages.confirm_delete_member') }}",
            html: `
                <p style="margin-bottom: 15px;">{{ __('messages.type_delete_confirm') }}</p>
                <input type="text" id="delete-confirm" class="swal2-input" placeholder="DELETE" style="width: 80%;">
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: "{{ __('messages.yes_delete') }}",
            cancelButtonText: "{{ __('messages.cancel') }}",
            preConfirm: () => {
                const input = document.getElementById('delete-confirm').value;
                if (input !== 'DELETE') {
                    Swal.showValidationMessage("{{ __('messages.must_type_delete') }}");
                    return false;
                }
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + familyId).submit();
            }
        });
    }
    </script>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script><!-- Swiper -->
    <script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>