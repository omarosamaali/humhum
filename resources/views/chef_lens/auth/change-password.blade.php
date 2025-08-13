<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>تسجيل حساب</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mobile Specific -->
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        .section-head .title,
        .section-head p,
        .section-head h3,
        input {
            color: rgb(0, 0, 0) !important;
        }

        .custom-arrow-1 {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            background-color: rgb(255, 255, 255);
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;

            /* إضافة السهم المخصص */
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23007bff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: left 12px center;
            background-size: 20px;
        }

        .custom-arrow-1:hover {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .flag-icon {
            width: 40px;
            height: 24px;
            background-size: cover;
        }

    </style>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="page-wrapper" style="background: white !important;">
        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">جارٍ التحميل...</span>
                </div>
            </div>
        </div>
        <!-- Preloader end-->
        <div class="logo" style="z-index: 9999999999999999999999999; display: flex; background-color: rgb(255, 255, 255); align-items: center; justify-content: center; display: flex; position: fixed; margin: auto; width: 100%;">
            <img src="{{ asset('assets/images/logo.png') }}" style="height: 90px; margin-top: 20px;" alt="">
        </div>

        <!-- Main Content Start -->
        <main class="page-content" style="">
            <div class="container py-0" style="height: 100vh; background-color: white;">
                <div class="dz-authentication-area">
                    <div class="main-logo" style="background: unset !important; width: 88%;">
                        <a href="javascript:void(0);" class="back-btn">
                            <i class="fa-solid fa-hand-point-left" style="color: black;"></i>
                        </a>
                        <div class="logo" style="right: 32px; position: relative;">
                        </div>
                    </div>
                    <div class="section-head" style="margin-top: 68px;">
                        <h3 class="title">أدخل كلمة المرور الجديدة</h3>
                        <p>يجب أن تكون كلمة المرور الجديدة مختلفة عن كلمة المرور السابقة.</p>
                    </div>
                    <div class="account-section">
<form action="{{ route('chef_lens.change-password.post') }}" method="POST">
    @csrf
    <div class="account-section">
        <input type="hidden" name="email" value="{{ session('otp_email') }}">

        <div class="mb-4">
            <label class="form-label" for="password">كلمة المرور الجديدة</label>
            <div class="input-group input-group-icon input-mini input-lg">
                <input type="password" id="password" name="password" class="form-control dz-password">
                <span class="input-group-text show-pass">
                    <i style="color: #5a5c77;" class="icon feather icon-eye-off eye-close"></i>
                    <i style="color: #5a5c77;" class="icon feather icon-eye eye-open"></i>
                </span>
            </div>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="form-label" for="password_confirmation">تأكيد كلمة المرور</label>
            <div class="input-group input-group-icon input-mini input-lg">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control dz-password">
                <span class="input-group-text show-pass">
                    <i style="color: #5a5c77;" class="icon feather icon-eye-off eye-close"></i>
                    <i style="color: #5a5c77;" class="icon feather icon-eye eye-open"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="bottom-btn pb-3">
        <button type="submit" class="btn btn-thin btn-lg w-100 custom-btn rounded-xl" style="color: black; background-color: #5a5c77 !important; color:white;">
            متابعة
        </button>
        <div class="text-center mt-3 form-text">
            العودة إلى <a style="color: rgb(0, 0, 0);" href="{{ route('chef_lens.login') }}" class="text-underline link">تسجيل الدخول</a>
        </div>
    </div>
</form>
</div>

                    {{-- <div class="bottom-btn pb-3">
                        <a href="{{ route('chef_lens.login') }}" class="btn btn-thin btn-lg w-100 custom-btn rounded-xl" style="color: black; 
                        background-color: #5a5c77 !important; color:white;">متابعة</a>
                        <div class="text-center mt-3 form-text">العودة إلى
                            <a style="color: rgb(0, 0, 0);" href="sign-in.html" class="text-underline link">تسجيل
                                الدخول
                            </a>
                        </div>
                    </div> --}}

                </div>
            </div>
        </main>
        <!-- Main Content End  -->

        <script>
            function toggleFields() {
                console.log(roleSelect.value)
                const isChef = roleSelect.value === 'طاه';
                chefFields.style.display = isChef ? 'block' : 'none';
                subscriptionFields.style.display = isChef && contractTypeSelect.value === 'annual_subscription' ?
                    'block' : 'none';
            }

            document.addEventListener('DOMContentLoaded', function() {
                const roleSelect = document.getElementById('role');
                const chefFields = document.getElementById('chef-fields');
                const contractTypeSelect = document.getElementById('contract_type');
                const subscriptionFields = document.getElementById('subscription-fields');

                // دالة لإظهار/إخفاء حقول الطاه وحقول الاشتراك
                function toggleFields() {
                    console.log(roleSelect.value)
                    const isChef = roleSelect.value === 'طاه';
                    chefFields.style.display = isChef ? 'block' : 'none';
                    subscriptionFields.style.display = isChef && contractTypeSelect.value === 'annual_subscription' ?
                        'block' : 'none';
                }

                // دالة لتأكيد الحذف باستخدام Bootstrap Modal
                window.confirmDelete = function(userId) {
                    const deleteForm = document.getElementById('deleteForm');
                    deleteForm.action = `/admin/users/${userId}`;
                    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    deleteModal.show();
                };

                // إعداد الحالة الأولية عند تحميل الصفحة
                toggleFields();

                // مستمع لتغيير الدور
                roleSelect.addEventListener('change', toggleFields);

                // مستمع لتغيير نوع التعاقد
                contractTypeSelect.addEventListener('change', toggleFields);
            });

        </script>

    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>

</body>

</html>
