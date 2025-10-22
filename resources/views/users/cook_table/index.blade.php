<!DOCTYPE html>
<html lang="en">

<head>
    <title>جدول الطبخ</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link href="assets/vendor/lightgallery/dist/css/lightgallery.css" rel="stylesheet">
    <link href="assets/vendor/lightgallery/dist/css/lg-thumbnail.css" rel="stylesheet">
    <link href="assets/vendor/lightgallery/dist/css/lg-zoom.css" rel="stylesheet">
    <link rel="stylesheet"
        href="assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cook_table.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">جدول الطبخ</h4>
                </div>
                <div class="right-content">
                    <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                </div>
            </div>
        </header>

        <!-- Page Content Start -->
        <div class="page-content space-top" style="direction: rtl;">
            <div class="" style="text-align: center; margin-top: 20px;">
                <h3 class="title">إنشاء جدول وجبات جديد</h3>
                <p>قم باستكمال البيانات المطلوبة </p>
            </div>

            <div class="container" style="text-align: center;">
                <div class="row" id="contentArea">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="startDatePicker">تاريخ البداية</label>
                            <input type="text" id="startDatePicker" class="form-control" style="text-align: center;"
                                placeholder="التاريخ">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="endDatePicker">تاريخ النهاية</label>
                            <input type="text" id="endDatePicker" class="form-control" style="text-align: center;"
                                placeholder="التاريخ">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">أفراد العائلة</label>
                        <div
                            style="border: 1px solid #660099; padding: 10px; border-radius: 10px; width: 50%; margin: auto;">
                            <div>
                                <label
                                    style="margin-bottom: 10px; display: flex; justify-content: space-between; gap: 5px;">
                                    الجميع
                                    <input type="checkbox" id="selectAll">
                                </label>
                            </div>
                            @foreach ($my_family as $member)
                            <label
                                style="margin-bottom: 10px; display: flex; justify-content: space-between; gap: 5px;">
                                {{ $member->name }}
                                <input type="checkbox" name="familyMembers[]" value="{{ $member->id }}"
                                    class="member-checkbox">
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Accordion - 2 -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">إعداد الوجبات</h5>
                            </div>
                            
                            <div class="card-body">
                                <div class="accordion accordion-danger-solid" id="accordion-two">
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="accord-2One" data-bs-toggle="collapse"
                                            data-bs-target="#collapse2One" aria-controls="collapse2One"
                                            aria-expanded="true" role="button">
                                            <span class="accordion-header-text">
                                                <div class="col-12">
                                                    <div class="mb-3" style="display: flex; align-items: center;">
                                                        <input type="text" id="bsMaterialTimePicker"
                                                            class="form-control">
                                                        <i class="fa fa-clock"
                                                            style="position: absolute; left: 7px; top: 26px;"></i>
                                                    </div>
                                                </div>
                                                إفطار
                                            </span>
                                            <input type="checkbox" class="accordion-header-indicator" checked>
                                        </div>
                                        <div id="collapse2One" class="collapse accordion__body show"
                                            aria-labelledby="accord-2One" data-bs-parent="#accordion-two">
                                            <div class="accordion-body-text">
                                                <select class="form-select kitchen-select" name="kitchen[]"
                                                    multiple="multiple" style="width: 100%;">
                                                    <option value="">جميع أنواع المطابخ</option>
                                                    @foreach ($kitchens as $kitchen)
                                                    <option value="{{ $kitchen->id }}">{{ $kitchen->name_ar }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                <div class="mb-4">
                                                    <x-check-group name="meal_features"
                                                        :items="['يحتوي على سلطة', 'يحتوي علي مشروبات']" />
                                                    <x-check-group name="meal_features"
                                                        :items="['يحتوي علي مقبلات', 'يحتوي علي اكل صحي']" />
                                                    <x-check-group name="meal_features"
                                                        :items="['يحتوي علي شوربة', 'يحتوي علي حلويات']" />
                                                    <x-check-group name="meal_features"
                                                        :items="['يحتوي علي صلصات', 'يحتوي علي طبق جانبي']" />

                                                    <div class="input-group input-mini input-lg"
                                                        style="margin: 10px 0px">
                                                        <input type="comments" id="comments" placeholder="ملاحظات"
                                                            class="form-control">
                                                    </div>
                                                    <label style="margin-bottom: 5px;">ازل الأيام التالية</label>
                                                    <select class="form-select dates-select" name="excluded_dates[]"
                                                        multiple="multiple" style="width: 100%;">
                                                        <option value="2025-11-10">10-11-2025</option>
                                                        <option value="2025-12-10">10-12-2025</option>
                                                        <option value="2025-13-10">10-13-2025</option>
                                                        <option value="2025-14-10">10-14-2025</option>
                                                        <option value="2025-15-10">10-15-2025</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion - 2 -->

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        const kitchenElement = document.querySelector('.kitchen-select');
    if (kitchenElement) {
        const kitchenChoices = new Choices(kitchenElement, {
            removeItemButton: true,
            searchEnabled: true,
            placeholderValue: 'اختر المطابخ',
            noResultsText: 'لا توجد نتائج',
            itemSelectText: 'اضغط للاختيار',
            searchPlaceholderValue: 'ابحث...',
        });
    }
    const datesElement = document.querySelector('.dates-select');
    if (datesElement) {
        const datesChoices = new Choices(datesElement, {
            removeItemButton: true,
            searchEnabled: true,
            placeholderValue: 'اختر الأيام المراد استبعادها',
            noResultsText: 'لا توجد نتائج',
            itemSelectText: 'اضغط للاختيار',
            searchPlaceholderValue: 'ابحث...',
        });
    }
        const selectAll = document.getElementById('selectAll');
    const memberCheckboxes = document.querySelectorAll('.member-checkbox');
    
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            memberCheckboxes.forEach(ch => ch.checked = selectAll.checked);
        });
    }
    
    memberCheckboxes.forEach(ch => {
        ch.addEventListener('change', function() {
            if (!this.checked && selectAll) {
                selectAll.checked = false;
            }
        });
    });
    </script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>