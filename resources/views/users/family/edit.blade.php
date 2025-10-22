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
            --bs-form-select-bg-img: url(https://cdn-icons-png.flaticon.com/512/32/32195.png) !important;
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
                    <h4 class="title">تعديل بيانات الفرد</h4>
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

                    <div class="profile-image">
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                                <div id="imagePreview" style="{{ $myFamily?->avatar ? 
                                'background-image: url(' . asset($myFamily->avatar) . ');' 
                                : 'background-image: url(assets/images/default.jpg);' }}"></div>
                                <div class="change-btn">
                                    <a href="{{ route('users.family.chooseImage', $myFamily) }}" for="imageUpload">
                                        <i class="fi fi-rr-pencil" style="color: white;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('users.family.update', $myFamily->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="mb-4" style="text-align: center;">
                            <label class="form-label" for="name">الاسم</label>
                            <div class="input-group input-mini input-sm">
                                <input type="text" id="name" name="name" value="{{ $myFamily->name }}"
                                    class="form-control">
                            </div>
                        </div>

                    </form>
                    <div id="chef-fields" class="chef-fields">
                        <button onclick="deleteUser()"
                            style="border: 1px solid red; background-color: white !important; color: red !important;"
                            class="btn btn-secondary btn-lg btn-thin rounded-xl w-100">
                            حذف الحساب
                        </button>
                    </div>

                </div>
            </div>
        </main>
        <!-- Main Content End -->

        <!-- Footer Fixed Button -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteUser() {
			Swal.fire({
				title: "هل أنت متأكد من حذف حساب",
				showDenyButton: true,
				// showCancelButton: true,
				confirmButtonText: "نعم",
				denyButtonText: `لا`
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					Swal.fire("تم الحذف بنجاح", "", "success");
				} else if (result.isDenied) {
					Swal.fire("تم إلغاء الحذف", "", "info");
				}
			});

		}
    </script>
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