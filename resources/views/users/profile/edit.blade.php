<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>تعديل الملف الشخصي</title>

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

        .edit-profile .avatar-upload .avatar-preview {
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
                    <a href="{{ route('users.profile.index') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">تعديل الملف الشخصى</h4>
                </div>
                <div class="right-content d-flex align-items-center gap-4">
                    <a href="javascript:void(0);" id="submitForm" style="border: none; background-color: transparent;">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Start -->
        <main class="page-content space-top p-b80">
            <div class="container">
                <div class="edit-profile">

                    <div class="profile-image">
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                                <img src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('assets/images/default.jpg') }}"
                                    style="width: 142px; height: 141px; border-radius: 50%;" alt="unkown image">
                                <div class="change-btn">
                                    <a href="{{ route('users.profile.chooseImage', Auth::user()->id) }}"
                                        for="imageUpload">
                                        <i class="fi fi-rr-pencil" style="color: white;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="editProfileForm" method="POST"
                        action="{{ route('users.profile.update', Auth::user()->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4" style="text-align: center;">
                            <label class="form-label" for="name">الاسم</label>
                            <div class="input-group input-mini input-sm">
                                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-4" style="text-align: center;">
                            <label class="form-label" for="email">البريد الالكتروني</label>
                            <div class="input-group input-mini input-sm">
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}" class="form-control">
                            </div>
                        </div>

                        @php
                        $selectedCountry = strtolower(Auth::user()->country ?? '');
                        @endphp

                        <div class="mb-4">
                            <label class="form-label" style="justify-content: center; display: flex;">الدولة</label>
                            <select name="country" class="form-select w-full text-right" style="direction: rtl;"
                                required>
                                <option>اختر الدولة</option>
                                @foreach ($countries as $code => $name)
                                <option value="{{ $code }}" {{ $selectedCountry==$code ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <!-- Form مخفي للحذف -->
                    <form id="delete-account-form" method="POST" action="{{ route('users.profile.destroy') }}"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <button onclick="deleteUser()"
                        style="border: 1px solid red; background-color: white !important; color: red !important;"
                        class="btn btn-secondary btn-lg btn-thin rounded-xl w-100">
                        حذف الحساب
                    </button>

                    <script>
                        function deleteUser() {
        Swal.fire({
            title: "هل أنت متأكد من حذف حسابك؟",
            html: `
                <p style="color: red; font-weight: bold; margin-bottom: 15px;">
                    تحذير: سيتم حذف جميع بياناتك نهائياً ولن تتمكن من استرجاعها!
                </p>
                <p style="margin-bottom: 15px;">اكتب كلمة <strong>DELETE</strong> للتأكيد</p>
                <input type="text" id="delete-confirm" class="swal2-input" placeholder="DELETE" style="width: 80%;">
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف حسابي',
            cancelButtonText: 'إلغاء',
            preConfirm: () => {
                const input = document.getElementById('delete-confirm').value;
                if (input !== 'DELETE') {
                    Swal.showValidationMessage('يجب كتابة DELETE بشكل صحيح');
                    return false;
                }
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-account-form').submit();
            }
        });
    }
                    </script>

                </div>
            </div>
        </main>
        <!-- Main Content End -->

        <!-- Footer Fixed Button -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/password.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');
            const submitBtn = document.getElementById('submit-btn');
            form.addEventListener('input', function() {
                const allFilled = Array.from(form.querySelectorAll('[required]')).every(input => input.value.trim() !== '');
                submitBtn.disabled = !allFilled;
            });
        });
    </script>

    <script>
        document.getElementById('submitForm').addEventListener('click', function () {
            document.getElementById('editProfileForm').submit();
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
    <script>
        function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
					$('#imagePreview').hide();
					$('#imagePreview').fadeIn(650);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#imageUpload").change(function () {
			readURL(this);
		});
		$('.remove-img').on('click', function () {
			var imageUrl = "images/no-img-avatar.png";
			$('.avatar-preview, #imagePreview').removeAttr('style');
			$('#imagePreview').css('background-image', 'url(' + imageUrl + ')');
		});
    </script>
</body>

</html>