@extends('layouts.chef')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
                            {{-- تغيير name و id ليتناسب مع recipe_id --}}
                            <select class="form-control" style="text-align: center;" id="recipe-select" name="recipe_id">
                                <option value="">إختر الوصفة</option>
                                @foreach($recipes as $recipe)
                                {{-- تعديل شرط الـ 'selected' --}}
                                <option value="{{ $recipe->id }}" @if(isset($challenge) && $challenge->recipe_id == $recipe->id)
                                    selected
                                    @elseif(old('recipe_id') == $recipe->id)
                                    selected
                                    @endif
                                    >
                                    {{ $recipe->title }}
                                </option>
                                @endforeach
                            </select>
                            {{-- تعديل @error --}}
                            @error('recipe_id')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            @if($recipe->price == null)
                            <input type="number" step="0.01" style="margin-top: 10px;" name="price" id="price" class="form-control 
                        "


                            
                            placeholder="أدخل سعر الوصفة" 
                            value="{{ old('price',  $recipe->price) }}">


                            @error('price')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                            @endif
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



    <script>
        flatpickr("#bsMaterialDatePicker", {
            dateFormat: "Y-m-d"
            , locale: "ar"
            , enableTime: false
            , allowInput: false
            , minDate: "today"
        });

        flatpickr("#bsMaterialTimePicker", {
            enableTime: true
            , noCalendar: true
            , dateFormat: "H:i"
            , locale: "ar"
            , allowInput: false
        });

        flatpickr("#bsMaterialDatePicker1", {
            dateFormat: "Y-m-d"
            , locale: "ar"
            , enableTime: false
            , allowInput: false
            , minDate: "today"
        });

        flatpickr("#bsMaterialTimePicker1", {
            enableTime: true
            , noCalendar: true
            , dateFormat: "H:i"
            , locale: "ar"
            , allowInput: false
        });

    const selectElement = document.getElementById('recipe-select'); // تغيير الـ ID
    const priceInput = document.getElementById('price');

    // دالة للتحقق من حالة حقل السعر
    function togglePriceInputVisibility() {
    if (selectElement.value !== '') {
    priceInput.classList.remove('hidden');
    priceInput.classList.add('visible');
    } else {
    priceInput.classList.remove('visible');
    priceInput.classList.add('hidden');
    priceInput.value = ''; // مسح القيمة عند الإخفاء
    }
    }

    // استدعاء الدالة عند تحميل الصفحة للحالة الأولية
    document.addEventListener('DOMContentLoaded', togglePriceInputVisibility);

    // استدعاء الدالة عند تغيير قيمة السلكت
    selectElement.addEventListener('change', togglePriceInputVisibility);


        document.getElementById('challengeForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'جاري الحفظ...';
        });

        document.getElementById('fil-ttd').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024;
                if (fileSize > 50) {
                    alert('حجم الملف كبير جداً. يجب أن يكون أقل من 50 ميجابايت.');
                    this.value = '';
                    return;
                }

                const textElement = document.querySelector('.text-x8v.font-9s7');
                if (textElement) {
                    textElement.textContent = `تم اختيار الملف: ${file.name}`;
                }
            }
        });

    </script>
</body>
@endsection
