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
                    <button onclick="openAlert();" class="add-btn" style="border: 0px;">
                        <i class="feather icon-plus" style="color: green;"></i>
                    </button>
                </div>
                <div class="mid-content">
                    <h4 class="title">أفراد منزلي</h4>
                </div>
                <div class="right-content">
                    <a href="{{ route('users.welcome') }}" style="background-color: unset !important; font-size: 24px;">
                        <i class="feather icon-home" style="font-weight: normal; color: #660099;"></i>
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
            <div style="text-align: center;">
                <span class="img-fluid icon">
                    👪
                </span>
                أفراد عائلتي
            </div>

            <div style="text-align: center; color:red; margin-bottom: 20px;">
                @if ($count < 10) يمكن إضافة {{ 10 - $count }}/10 @else لا يمكن إضافة المزيد @endif </div>

                <ul class="featured-list">
                    <div>
                            @foreach ($myFamilies as $myFamily)
                            <li class="container-cart">
                                <div class="dz-card list">
                                    <div class="dz-media" style="position: relative;">
                                        <img src="{{ $myFamily->avatar ? $myFamily->avatar : asset('assets/images/default.jpg') }}"
                                            style="width: 100px; height: 100px; margin: auto; margin-top: 10px; border-radius: 50%; border: 2px solid var(--primary-color)"
                                            class="card-img-top" alt="...">
                                    </div>
                                    <div class="dz-content">
                                        <div class="dz-head">
                                            <h6 class="title">
                                                <span>{{ $myFamily->name }}</span>
                                            </h6>
                                            <span class="badge badge-info"
                                                style="color: var(--primary-color); background-color: unset !important; font-size: 12px;">
                                                @if($myFamily->owner == '1') الحساب الرئيسي
                                                @else
                                                فرد
                                                @endif
                                            </span>
                                            <br />
                                            <a href="{{ route('users.family.show', $myFamily) }}"
                                                style="display: block; text-align: center; border: 0px; background-color: var(--primary-color); border-radius: 15px; color: white; padding: 5px 10px; width: 95%; margin-top: 10px;">
                                                الملف الشخصى
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="tag-list" style="display: flex; gap: 10px; justify-content: space-evenly;">
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-user" style="color: var(--primary-color);"></i>
                                        {{ $myFamily?->has_email == '1' ? 'نعم' : 'لا' }}
                                    </li>
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-earth" style="color: var(--primary-color);"></i>
                                        {{ $myFamily->language }}
                                    </li>
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-list-check" style="color: var(--primary-color);"></i>
                                        0
                                    </li>

                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-bell" style="color: var(--primary-color);"></i>
                                        {{ $myFamily->send_notification == '1' ? 'نعم' : 'لا' }}
                                    </li>
                                    @if($myFamily->owner == '0')
                                    <li class="dz-price"
                                        style="text-align: center; font-size: 14px; padding-left: 15px;">
                                        <form id="delete-form-{{ $myFamily->id }}" method="POST"
                                            action="{{ route('users.family.destroy', $myFamily->id) }}"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <i onclick="deleteUser({{ $myFamily->id }})" class="fa-solid fa-trash"
                                            style="color: red; border: 1px solid red; padding: 5px; border-radius: 50px;"></i>
                                    </li>
                                    @endif
                                </ul>

                            </li>
                            @endforeach
                    </div>
                </ul>

        </main>
        <!-- Page Content End -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                title: "هل أنت متأكد من حذف هذا العضو؟",
                html: `
    <p style="margin-bottom: 15px;">اكتب كلمة <strong>DELETE</strong> للتأكيد</p>
    <input type="text" id="delete-confirm" class="swal2-input" placeholder="DELETE" style="width: 80%;">
    `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
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
                    // إرسال الـ form
                    document.getElementById('delete-form-' + familyId).submit();
                }
            });
        }

        $count = "{{ $count }}"

        function openAlert() {
            if ($count == 10) {
                Swal.fire({
                    title: "لا يمكنك إضافة المزيد من الأعضاء",
                    confirmButtonText: "حسناً",
                    icon: "warning"
                });
            } else {
                Swal.fire({
                    title: `باقي لك {{ 10 - $count }} أفراد، هل تريد إضافة المزيد؟`,
                    showDenyButton: true,
                    confirmButtonText: "نعم",
                    denyButtonText: "لا",
                    icon: "question"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('users.family.create') }}";
                    } else if (result.isDenied) {
                        Swal.fire("تم الإلغاء", "", "info");
                    }
                });
            }
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