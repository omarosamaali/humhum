<!DOCTYPE html>
<html lang="en">

<head>
    <title>الإرشادات</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/imageuplodify/imageuploadify.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #660099;
        }

        .dz-add-box {
            border: 1px solid var(--primary-color);
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
                    <a href="{{ route('users.family.show', $myFamily) }}" style="background-color: unset !important;"
                        id="back-btn">
                        <i class="feather icon-arrow-left" style="font-weight: normal; color: #660099;"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.tips') }}</h4>
                </div>
                <div class="right-content">
                    <a id="submitForm" href="javascript:void(0);">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b80" style="direction: rtl;">
            <div class="container">

                <!-- إضافة الـ Form هنا -->
                <form id="tipsForm" action="{{ route('users.family.update_tips', $myFamily) }}" method="POST">
                    @csrf

                    <a href="{{ route('users.family.add_tips', $myFamily) }}" class="dz-add-box">
                        <i class="fi fi-rr-add me-2"></i>
                        <span style="margin-right: 5px;">{{ __('messages.add_new') }}</span>
                        <i class="feather icon-chevron-left"></i>
                    </a>

                    <!-- عرض الإرشادات المخصصة -->
                    @if(isset($customTips) && $customTips->count() > 0)
                    <div class="dz-list m-b20" style="margin-top: 20px;">
                        <h6 class="mb-3" style="color: var(--primary-color);">{{ __('messages.your_custom_tips') }}</h6>
                        <ul class="dz-list-group">
                            @foreach ($customTips as $customTip)
                            <li class="list-group-items"
                                style="display: flex; align-items: center; justify-content: space-between;">
                                <div class="list-content">
                                    <h6 class="title">{{ $customTip->custom_tip }}</h6>
                                </div>
                                <a href="{{ url()->previous() ?: route('home') }}"
                                    onclick="deleteCustomTip({{ $customTip->id }})" style="color: red;">
                                    <i class="feather icon-trash-2"></i>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="dz-list m-b20">
                        <ul class="dz-list-group radio style-2">
                            @foreach ($tips as $tip)
                            <li class="list-group-items"
                                style="display: flex; align-items: center; justify-content: space-between;">
                                <label class="radio-label">
                                    <div class="checkmark">
                                        <div class="list-content">
                                            <h6 class="title">{{ app()->getLocale() == 'ar' ? $tip->name_ar :
                                                $tip->name_en }}
                                            </h6>
                                        </div>
                                    </div>
                                </label>
                                <input type="checkbox" name="tips[]" value="{{ $tip->id }}" {{ in_array($tip->id,
                                $selectedTips) ? 'checked' : '' }}
                                style="width: 20px; height: 20px;">
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </form>

            </div>
        </main>
        <!-- Main Content End -->
    </div>

    <script>
        // إرسال الفورم عند الضغط على علامة الصح
    const submitButton = document.getElementById('submitForm');
    const form = document.getElementById('tipsForm');
    
    submitButton.addEventListener('click', function () {
        form.submit();
    });
    
    function deleteCustomTip(id) {
        if (confirm('{{ __("messages.confirm_delete_tip") }}')) {
            fetch("{{ url('users/family/custom-tip') }}/" + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // حذف العنصر من الصفحة مباشرة
                    window.location.reload();
                    if (tipItem) tipItem.remove();
                }
            })
        }
    }
    </script>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>