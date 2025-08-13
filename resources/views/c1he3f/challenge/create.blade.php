@extends('layouts.chef')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>

<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .hidden {
        display: none;
    }

    /* تحسين مظهر Flatpickr للغة العربية */
    .flatpickr-calendar {
        direction: ltr !important;
        font-family: 'Cairo', sans-serif;
    }

    .flatpickr-time {
        direction: ltr !important;
    }

</style>

<body class="bg-light">
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">تحدي جديد</h4>
                </div>
            </div>
        </header>

        @if($errors->any())
        <div class="alert alert-danger" style="margin: 20px; margin-top: 105px;">
            <ul style="margin: 0; padding-right: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success" style="margin: 20px;">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger" style="margin: 20px;">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('challenge.store') }}" method="POST" enctype="multipart/form-data" id="challengeForm">
            @csrf
            <input type="text" name="user_id" value="{{ Auth::user()->id }}">
            <input type="text" name="chef_id" value="{{ Auth::user()->id }}">
            <main class="page-content space-top p-b100" style="direction: rtl;">
                <div class="container">
                    <div class="bg-cookpad-gray-9gi p-6h1" style="height: 40vh; width: 80%; margin: auto; border-radius: 15px;">
                        <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                            <div class="text-fim">
                                <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-x8v font-9s7 mt-mnq">أضف الإعلان عن التحدي</p>
                                <p class="text-b94 px-ql7">يجب علي الفيديو ان لا يزيد عن 60 ثانية</p>
                            </div>
                            <input type="file" name="file" id="fil-ttd" accept="video/*,image/*" required>
                        </div>
                        @error('file')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Message Input -->
                    <div class="my-3">
                        <input type="text" name="name" id="name" style="height: 98px; text-align: center; color: #000000;" placeholder="ماذا تريد ان تقول للمستخدمين" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date and Time Section -->
                    <h6 class="dz-title my-2" style="text-align: center;">تاريخ التحدي</h6>
                    <div class="row" id="contentArea">
                        <div class="col-12" style="display: flex; gap: 10px;">
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialDatePicker">تاريخ البدء</label>
                                <input type="text" name="bsMaterialDatePicker" id="bsMaterialDatePicker" class="form-control" placeholder="اختر التاريخ" readonly required value="{{ old('bsMaterialDatePicker') }}">
                                @error('bsMaterialDatePicker')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialTimePicker">وقت البدء</label>
                                <input type="text" name="bsMaterialTimePicker" id="bsMaterialTimePicker" class="form-control" placeholder="اختر الوقت" readonly required value="{{ old('bsMaterialTimePicker') }}">
                                @error('bsMaterialTimePicker')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12" style="display: flex; gap: 10px;">
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialDatePicker1">تاريخ الانتهاء</label>
                                <input type="text" name="bsMaterialDatePicker1" id="bsMaterialDatePicker1" class="form-control" placeholder="اختر التاريخ" readonly required value="{{ old('bsMaterialDatePicker1') }}">
                                @error('bsMaterialDatePicker1')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialTimePicker1">وقت الانتهاء</label>
                                <input type="text" name="bsMaterialTimePicker1" id="bsMaterialTimePicker1" class="form-control" placeholder="اختر الوقت" readonly required value="{{ old('bsMaterialTimePicker1') }}">
                                @error('bsMaterialTimePicker1')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Selection -->
                    <div class="form-group">
                        <label for="recipe-select" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">اختر الوصفة</label>
                        <div class="form-group">
                            <select class="form-control" style="text-align: center;" id="recipe-select" name="recipe_id">
                                <option value="">إختر الوصفة</option>
                                @foreach($recipes as $recipe)
                                <option value="{{ $recipe->id }}" data-price="{{ $recipe->price }}" ...>
                                    {{ $recipe->title }}
                                </option>
                                @endforeach
                            </select>

                            <script>
                                document.getElementById('recipe-select').addEventListener('change', function() {
                                    const selectedOption = this.options[this.selectedIndex];
                                    const priceInput = document.getElementById('price');

                                    const selectedPrice = selectedOption.dataset.price;

                                    if (selectedPrice === 'null') {
                                        priceInput.value = '';
                                        priceInput.placeholder = 'أدخل سعر الوصفة';
                                        priceInput.style.display = 'block';
                                    } else {
                                        priceInput.value = selectedPrice;
                                        priceInput.style.display = 'none';
                                    }
                                });

                                document.addEventListener('DOMContentLoaded', function() {
                                    const selectElement = document.getElementById('recipe-select');
                                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                                    if (selectedOption && selectedOption.dataset.price) {
                                        const priceInput = document.getElementById('price');
                                        const selectedPrice = selectedOption.dataset.price;

                                        if (selectedPrice === 'null') {
                                            priceInput.value = '';
                                            priceInput.placeholder = 'أدخل سعر الوصفة';
                                            priceInput.style.display = 'block';
                                        } else {
                                            priceInput.value = selectedPrice;
                                            priceInput.style.display = 'none';
                                        }
                                    }
                                });

                            </script>

                            @error('recipe_id')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="number" step="0.01" style="margin-top: 10px; display: none;" name="price" id="price" class="form-control" placeholder="أدخل سعر الوصفة" value="{{ old('price') }}">
                            @error('price')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Challenge Type -->
                    <h6 class="dz-title my-2" style="text-align: center;">نوع التحدي</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="filterRadio" id="filterRadio1" value="users" {{ old('filterRadio', 'users') == 'users' ? 'checked' : '' }}>
                            <label class="form-check-label" for="filterRadio1">للمستخدمين</label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="filterRadio" id="filterRadio2" value="chefs" {{ old('filterRadio') == 'chefs' ? 'checked' : '' }}>
                            <label class="form-check-label" for="filterRadio2">للطهاة</label>
                        </div>
                    </div>
                    @error('filterRadio')
                    <div class="error-message">{{ $message }}</div>
                    @enderror

                    <h6 class="dz-title my-2" style="text-align: center;">هل يوجد جائزة للتحدي؟</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="prize_type" id="prizeType1" value="none" {{ old('prize_type', 'none') == 'none' ? 'checked' : '' }}>
                            <label class="form-check-label" for="prizeType1">لا</label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="prize_type" id="prizeType2" value="highest_rating" {{ old('prize_type') == 'highest_rating' ? 'checked' : '' }}>
                            <label class="form-check-label" for="prizeType2">نعم لأعلى تقييم</label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="prize_type" id="prizeType3" value="top_three" {{ old('prize_type') == 'top_three' ? 'checked' : '' }}>
                            <label class="form-check-label" for="prizeType3">نعم لأعلى ثلاث تقييمات</label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="prize_type" id="prizeType4" value="all_participants" {{ old('prize_type') == 'all_participants' ? 'checked' : '' }}>
                            <label class="form-check-label" for="prizeType4">نعم لجميع المشاركين</label>
                        </div>
                    </div>

                    <div id="prizeDetails" style="display: none;">
                        <div class="my-3">
                            <input type="text" name="prize_name" id="prize_name" style="height: 50px; text-align: center; color: #000000;" placeholder="اسم الجائزة" class="form-control" value="{{ old('prize_name') }}">
                            @error('prize_name')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="my-3">
                            <label for="prize_image" class="dz-title my-2" style="text-align: center; display: block;">صورة الجائزة</label>
                            <div class="bg-cookpad-gray-9gi p-6h1 text-center" style="height: 150px; border-radius: 15px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                <div class="text-center">
                                    <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                    <p class="text-x8v font-9s7 mt-mnq">أضف صورة الجائزة</p>
                                </div>
                                <input type="file" name="prize_image" id="prize_image" accept="image/*" style="display: none;">
                            </div>
                            @error('prize_image')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Challenge Status -->
                    <h6 class="dz-title my-2" style="text-align: center;">حالة التحدي</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="status" id="statusRadio1" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusRadio1">فعال</label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="status" id="statusRadio2" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusRadio2">غير فعال</label>
                        </div>
                    </div>
                    @error('status')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </main>
            <div class="footer-fixed-btn bottom-0 bg-white">
                <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl" id="submitBtn">حفظ</button>
            </div>
        </form>
    </div>

    <!-- تحميل Flatpickr فقط -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prizeTypeRadios = document.querySelectorAll('input[name="prize_type"]');
            const prizeDetailsDiv = document.getElementById('prizeDetails');
            const prizeImageInput = document.getElementById('prize_image');
            const prizeImageContainer = document.querySelector('#prizeDetails .bg-cookpad-gray-9gi');

            // إعداد Flatpickr للتواريخ
            flatpickr("#bsMaterialDatePicker", {
                dateFormat: "Y-m-d"
                , locale: "ar"
                , allowInput: true
                , placeholder: "اختر التاريخ"
                , minDate: "today"
            });

            flatpickr("#bsMaterialDatePicker1", {
                dateFormat: "Y-m-d"
                , locale: "ar"
                , allowInput: true
                , placeholder: "اختر التاريخ"
                , minDate: "today"
                , onChange: function(selectedDates, dateStr, instance) {
                    // تأكد إن تاريخ الانتهاء بعد تاريخ البدء
                    const startDateInput = document.getElementById('bsMaterialDatePicker');
                    if (startDateInput.value && dateStr < startDateInput.value) {
                        alert('تاريخ الانتهاء يجب أن يكون بعد تاريخ البدء');
                        instance.clear();
                    }
                }
            });

            // إعداد Flatpickr للأوقات
            flatpickr("#bsMaterialTimePicker", {
                enableTime: true
                , noCalendar: true
                , dateFormat: "H:i"
                , time_24hr: true
                , allowInput: true
                , placeholder: "اختر الوقت"
            });

            flatpickr("#bsMaterialTimePicker1", {
                enableTime: true
                , noCalendar: true
                , dateFormat: "H:i"
                , time_24hr: true
                , allowInput: true
                , placeholder: "اختر الوقت"
            });

            // ربط تاريخ البدء مع تاريخ الانتهاء
            document.getElementById('bsMaterialDatePicker').addEventListener('change', function() {
                const endDatePicker = document.querySelector('#bsMaterialDatePicker1')._flatpickr;
                if (endDatePicker) {
                    endDatePicker.set('minDate', this.value);
                    // إذا كان تاريخ الانتهاء أقل من تاريخ البدء، امسحه
                    if (endDatePicker.selectedDates.length > 0 && endDatePicker.selectedDates[0] < new Date(this.value)) {
                        endDatePicker.clear();
                    }
                }
            });

            // Handle prize image container click
            if (prizeImageContainer) {
                prizeImageContainer.addEventListener('click', function() {
                    prizeImageInput.click();
                });
            }

            // Handle prize image file selection
            if (prizeImageInput) {
                prizeImageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    const textElement = this.closest('.bg-cookpad-gray-9gi').querySelector('p');
                    if (file) {
                        textElement.textContent = `تم اختيار الملف: ${file.name}`;
                    } else {
                        textElement.textContent = 'أضف صورة الجائزة';
                    }
                });
            }

            // Function to toggle prize details visibility
            function togglePrizeDetails() {
                const selectedPrizeType = document.querySelector('input[name="prize_type"]:checked');

                if (selectedPrizeType && selectedPrizeType.value !== 'none') {
                    prizeDetailsDiv.style.display = 'block';
                    document.getElementById('prize_name').setAttribute('required', 'required');
                    prizeImageInput.setAttribute('required', 'required');
                } else {
                    prizeDetailsDiv.style.display = 'none';
                    document.getElementById('prize_name').removeAttribute('required');
                    prizeImageInput.removeAttribute('required');
                }
            }

            // Call the function on page load
            togglePrizeDetails();

            // Add event listener to all prize type radio buttons
            prizeTypeRadios.forEach(function(radio) {
                radio.addEventListener('change', togglePrizeDetails);
            });
        });

    </script>

</body>
@endsection
