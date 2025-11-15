<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ __('messages.جدول الطبخ') }}</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
    <style>
        /* Scrollbar تخصيص */
        .family-multiselect-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .family-multiselect-dropdown::-webkit-scrollbar-thumb {
            background: #660099;
            border-radius: 3px;
        }

        .family-multiselect-dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Checkbox تخصيص */
        .family-option-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #660099;
        }

        /* تعطيل الخيارات عند اختيار الكل */
        .family-option-checkbox[value]:not([value="all"]):disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <!-- Header مع زر الحفظ -->
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('users.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.جدول الطبخ') }}</h4>
                </div>
                <div class="right-content">
                    <button type="submit" form="mealPlanForm" class="btn btn-success p-0 border-0 bg-transparent">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- النموذج الكامل -->
        <form id="mealPlanForm" action="{{ route('user.meal-plans.store') }}" method="POST">
            @csrf

            <div style="text-align: center; margin-top: 20px;">
                <h3 class="title">
                    {{ __('messages.إنشاء جدول وجبات جديد') }}
                </h3>
                <p>
                    {{ __('messages.قم باستكمال البيانات المطلوبة') }}
                </p>
            </div>

            <div class="container" style="text-align: center;">
                <div class="row" id="contentArea">
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger " style="width: 96%; margin: 0 auto !important;">
                        {{ $error }}
                    </div>
                    @endforeach
                    <div class="col-12 col-md-6">
                        <div class="col-12 col-md-6">
                            <label class="form-label">{{ __('messages.تاريخ البداية') }}</label>
                            <input type="date" name="startDatePicker" id="startDatePicker" class="form-control mb-3"
                                min="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{ __('messages.تاريخ النهاية') }}</label>
                        <input type="date" min="{{ date('Y-m-d') }}" name="endDatePicker" id="endDatePicker"
                            class="form-control mb-3" required>
                    </div>

                    <!-- أفراد العائلة -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">{{ __('messages.افراد العائلة') }}</label>
                        <select multiple name="familyMembers[]" id="hiddenFamilyMembers" style="display: none;">
                            @foreach ($my_family as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>

                        <div class="custom-multiselect"
                            style=" direction: rtl; width: 50%; margin: auto; position: relative;">
                            <div class="multiselect-display" onclick="toggleFamilyDropdown()" style="border: 1px solid #660099;padding: 10px 15px;background: white;border-radius: 6px;cursor: pointer;min-height: 45px;display: flex;align-items: center;flex-wrap: wrap;gap: 0px;">
                                <span class="family-placeholder" style="color: #999;">اختر أعضاء العائلة...</span>
                                <div class="family-selected-items" style="display: flex; flex-wrap: wrap; gap: 5px;">
                                </div>
                                <span style="margin-right: auto; color: #660099;">▼</span>
                            </div>

                            <!-- قائمة الخيارات -->
                            <div class="family-multiselect-dropdown" id="familyDropdownMenu" style="display: none;position: absolute;top: 100%;left: 0;right: 0;background: white;border: 1px solid #660099;border-radius: 6px;margin-top: 5px;box-shadow: 0 4px 12px rgba(102, 0, 153, 0.15);z-index: 1000;max-height: 300px;overflow-y: auto;">
                                <!-- صندوق البحث -->
                                <div
                                    style="padding: 10px; border-bottom: 1px solid #eee; position: sticky; top: 0; background: white;">
                                    <input type="text" id="familySearchBox" placeholder="ابحث..." style="
                    width: 100%;
                    padding: 8px 12px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    font-size: 14px;
                " onkeyup="filterFamilyOptions()">
                                </div>

                                <!-- الخيارات -->
                                <div class="family-options-list" style="padding: 5px 0;">
                                    <!-- خيار "الكل" -->
                                    <label class="family-option-item" data-value="all" style="
                    display: flex;
                    align-items: center;
                    padding: 10px 15px;
                    cursor: pointer;
                    transition: background 0.2s;
                    border-bottom: 1px solid #f0f0f0;
                " onmouseover="this.style.background='#f8f4fc'" onmouseout="this.style.background='white'">
                                        <input type="checkbox" class="family-option-checkbox" value="all"
                                            onchange="selectAllFamilyMembers(this)">
                                        <span style="margin-right: 10px;">{{ __('messages.all') }}</span>
                                    </label>

                                    @foreach ($my_family as $member)
                                    <label class="family-option-item" data-value="{{ $member->id }}"
                                        data-name="{{ $member->name }}" style="
                    display: flex;
                    align-items: center;
                    padding: 10px 15px;
                    cursor: pointer;
                    transition: background 0.2s;
                " onmouseover="this.style.background='#f8f4fc'" onmouseout="this.style.background='white'">
                                        <input type="checkbox" class="family-option-checkbox" value="{{ $member->id }}"
                                            onchange="updateFamilySelection()">
                                        <span style="margin-right: 10px;">{{ $member->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- رسالة الخطأ -->
                        <div id="familyMultiselectError"
                            style="display: none; color: #dc3545; font-size: 14px; margin-top: 8px;">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            {{ __('messages.please_select_at_least_one_member') }}
                        </div>

                        @error('familyMembers')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- إعداد الوجبات -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="justify-content: right;">
                                <h5 class="card-title">{{ __('messages.meal_setup') }}</h5>
                            </div>
                            <div class="card-body">

                                <!-- إفطار -->
                                <div class="accordion-item mb-3 border rounded">
                                    <div
                                        class="accordion-header d-flex justify-content-between align-items-center p-3 bg-light">
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="time" name="time_breakfast" class="form-control"
                                                style="width: 120px; font-size: 13px;" value="07:00">
                                        </div>
                                        <span class="fw-bold">{{ __('messages.breakfast') }}</span>
                                        <input type="checkbox" name="meal_breakfast_active" class="accordion-toggle"
                                            data-target="#collapse-breakfast">
                                    </div>
                                    <div id="collapse-breakfast" class="collapse">
                                        <div class="p-3">
                                            <select name="kitchen_breakfast[]" class="form-select kitchen-select"
                                                multiple style="width: 100%;">
                                                <option value="">{{ __('messages.all_kitchen_types') }}</option>
                                                @foreach ($kitchens as $kitchen)
                                                <option value="{{ $kitchen->id }}">
                                                    {{ trans_field($kitchen, 'name') }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="mb-3 mt-3" style="columns: 2;">
                                                @foreach ([
                                                'contains_salad',
                                                'contains_drinks',
                                                'contains_appetizers',
                                                'contains_healthy_food',
                                                'contains_soup',
                                                'contains_desserts',
                                                'contains_sauces',
                                                'contains_side_dish'
                                                ] as $feature)
                                                <label
                                                    style="font-size: 12px; width: 100%; display: flex; justify-content: space-between;">
                                                    <input type="checkbox" style="height: 15px; width: unset;"
                                                        name="features_breakfast[]" value="{{ $feature }}">
                                                    {{ __('messages.' . $feature) }}
                                                </label>
                                                @endforeach
                                            </div>

                                            <div class="mt-3"> <input type="text" name="comments_breakfast"
                                                    placeholder="{{ __('messages.comments') }}" class="form-control">
                                            </div>

                                            <label class="form-label d-block mt-3">
                                                {{ __('messages.excluded_dates') }}
                                            </label>
                                            <select name="excluded_dates_breakfast[]" class="dates-select" multiple
                                                style="width: 100%;"></select>
                                        </div>
                                    </div>
                                </div>

                                <!-- غداء -->
                                <div class="accordion-item mb-3 border rounded">
                                    <div
                                        class="accordion-header d-flex justify-content-between align-items-center p-3 bg-light">

                                        <div class="d-flex align-items-center gap-3">

                                            <input type="time" name="time_lunch" class="form-control"
                                                style="width: 120px; font-size: 13px;" value="13:00">
                                        </div>

                                        <span class="fw-bold">{{ __('messages.lunch') }}</span>
                                        <input type="checkbox" name="meal_lunch_active" class="accordion-toggle"
                                            data-target="#collapse-lunch">
                                    </div>
                                    <div id="collapse-lunch" class="collapse">
                                        <div class="p-3">
                                            <select name="kitchen_lunch[]" class="form-select kitchen-select" multiple
                                                style="width: 100%;">
                                                <option value="">{{ __('messages.all_kitchen_types') }}</option>
                                                @foreach ($kitchens as $kitchen)
                                                <option value="{{ $kitchen->id }}">{{ trans_field($kitchen, 'name') }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <div class="mb-3 mt-3" style="columns: 2;">
                                                @foreach ([
                                                'contains_salad',
                                                'contains_drinks',
                                                'contains_appetizers',
                                                'contains_healthy_food',
                                                'contains_soup',
                                                'contains_desserts',
                                                'contains_sauces',
                                                'contains_side_dish'
                                                ] as $feature)
                                                <label
                                                    style="font-size: 12px; width: 100%; display: flex; justify-content: space-between;">
                                                    <input type="checkbox" style="height: 15px; width: unset;"
                                                        name="features_lunch[]" value="{{ $feature }}">
                                                    {{ __('messages.' . $feature) }}
                                                </label>
                                                @endforeach
                                            </div>

                                            <div class="mt-3">
                                                <input type="text" name="comments_lunch"
                                                    placeholder="{{ __('messages.comments') }}" class="form-control">
                                            </div>

                                            <label class="form-label d-block mt-3">{{ __('messages.excluded_dates')
                                                }}</label>
                                            <select name="excluded_dates_lunch[]" class="dates-select" multiple
                                                style="width: 100%;"></select>
                                        </div>
                                    </div>
                                </div>

                                <!-- عشاء -->
                                <div class="accordion-item mb-3 border rounded">
                                    <div
                                        class="accordion-header d-flex justify-content-between align-items-center p-3 bg-light">
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="time" name="time_dinner" class="form-control"
                                                style="width: 120px; font-size: 13px;" value="19:00">
                                        </div>
                                        <span class="fw-bold">{{ __('messages.dinner') }}</span>
                                        <input type="checkbox" name="meal_dinner_active" class="accordion-toggle"
                                            data-target="#collapse-dinner">
                                    </div>
                                    <div id="collapse-dinner" class="collapse">
                                        <div class="p-3">
                                            <select name="kitchen_dinner[]" class="form-select kitchen-select" multiple
                                                style="width: 100%;">
                                                <option value="">{{ __('messages.all_kitchen_types') }}</option>
                                                @foreach ($kitchens as $kitchen)
                                                <option value="{{ $kitchen->id }}">
                                                    {{ trans_field($kitchen, 'name') }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="mb-3 mt-3" style="columns: 2;">
                                                @foreach ([
                                                'contains_salad',
                                                'contains_drinks',
                                                'contains_appetizers',
                                                'contains_healthy_food',
                                                'contains_soup',
                                                'contains_desserts',
                                                'contains_sauces',
                                                'contains_side_dish'
                                                ] as $feature)
                                                <label
                                                    style="font-size: 12px; width: 100%; display: flex; justify-content: space-between;">
                                                    <input type="checkbox" style="height: 15px; width: unset;"
                                                        name="features_dinner[]" value="{{ $feature }}">
                                                    {{ __('messages.' . $feature) }}
                                                </label>
                                                @endforeach
                                            </div>

                                            <div class="mt-3">
                                                <input type="text" name="comments_dinner"
                                                    placeholder="{{ __('messages.comments') }}" class="form-control">
                                            </div>

                                            <label class="form-label d-block mt-3">ازل الأيام التالية</label>
                                            <select name="excluded_dates_dinner[]" class="dates-select" multiple
                                                style="width: 100%;"></select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- تحديث الأيام -->
    <script>
        // تهيئة الحالة الأولية
    document.addEventListener('DOMContentLoaded', function() {
        updateFamilySelection();
        
        // إضافة event listener للنموذج
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!validateFamilyForm()) {
                    e.preventDefault();
                }
            });
        }
    });
    
    // فتح/إغلاق القائمة
    function toggleFamilyDropdown() {
        const dropdown = document.getElementById('familyDropdownMenu');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        
        if(dropdown.style.display === 'block') {
            document.getElementById('familySearchBox').focus();
        }
    }
    
    // إغلاق عند الضغط خارج القائمة
    document.addEventListener('click', function(e) {
        const container = document.querySelector('.custom-multiselect');
        if (!container.contains(e.target)) {
            document.getElementById('familyDropdownMenu').style.display = 'none';
        }
    });
    
    // التحقق من الصحة قبل الإرسال - الإصحة المعدلة
    function validateFamilyForm() {
        const hiddenSelect = document.getElementById('hiddenFamilyMembers');
        const selectedOptions = hiddenSelect.selectedOptions;
        
        console.log('Number of selected options:', selectedOptions.length);
        console.log('Hidden select content:', hiddenSelect.innerHTML);
        
        const errorDiv = document.getElementById('familyMultiselectError');
        
        if (selectedOptions.length === 0) {
            // إظهار الخطأ
            errorDiv.style.display = 'block';
            
            // تأثيرات بصرية
            const displayBox = document.querySelector('.multiselect-display');
            displayBox.style.borderColor = '#dc3545';
            displayBox.style.animation = 'shake 0.5s ease-in-out';
            
            // فتح القائمة
            toggleFamilyDropdown();
            
            setTimeout(() => {
                displayBox.style.animation = '';
            }, 500);
            
            return false;
        }
        
        // إخفاء الخطأ إذا كان كل شيء صحيح
        errorDiv.style.display = 'none';
        return true;
    }
    
    // تحديث الاختيارات - الإصحة المعدلة
    function updateFamilySelection() {
        const checkboxes = document.querySelectorAll('.family-option-checkbox[value]');
        const selectedContainer = document.querySelector('.family-selected-items');
        const placeholder = document.querySelector('.family-placeholder');
        const hiddenSelect = document.getElementById('hiddenFamilyMembers');
        const errorDiv = document.getElementById('familyMultiselectError');
        
        // إخفاء رسالة الخطأ عند التحديث
        errorDiv.style.display = 'none';
        
        // مسح الاختيارات القديمة
        selectedContainer.innerHTML = '';
        
        let selectedCount = 0;
        const allChecked = document.querySelector('.family-option-checkbox[value="all"]').checked;
        
        // تحديث الـ hidden select - الطريقة المصححة
        // أولاً: إلغاء تحديد جميع الخيارات
        Array.from(hiddenSelect.options).forEach(option => {
            option.selected = false;
        });
        
        // ثانياً: تحديد الخيارات المختارة
        checkboxes.forEach(checkbox => {
            if (checkbox.checked && checkbox.value !== 'all') {
                selectedCount++;
                const name = checkbox.closest('.family-option-item').dataset.name;
                const value = checkbox.value;
                
                // إضافة Badge
                const badge = document.createElement('span');
                badge.style.cssText = `
                    background: #660099;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 15px;
                    font-size: 13px;
                    display: inline-flex;
                    align-items: center;
                    gap: 5px;
                `;
                badge.innerHTML = `${name} <span onclick="event.stopPropagation(); removeFamilyItem('${value}')" style="cursor: pointer; font-weight: bold;">×</span>`;
                selectedContainer.appendChild(badge);
                
                // تحديد الخيار في الـ hidden select
                const option = Array.from(hiddenSelect.options).find(opt => opt.value === value);
                if (option) {
                    option.selected = true;
                }
            }
        });
        
        // معالجة حالة "الكل"
        if (allChecked) {
            selectedContainer.innerHTML = '';
            const badge = document.createElement('span');
            badge.style.cssText = `
                background: #660099;
                color: white;
                padding: 4px 10px;
                border-radius: 15px;
                font-size: 13px;
                display: inline-flex;
                align-items: center;
            `;
            badge.textContent = '{{ __("messages.all") }}';
            selectedContainer.appendChild(badge);
            
            // تحديد جميع الخيارات في الـ hidden select
            Array.from(hiddenSelect.options).forEach(option => {
                option.selected = true;
            });
            
            selectedCount = hiddenSelect.options.length;
        }
        
        // إعادة لون الحدود الطبيعي
        const displayBox = document.querySelector('.multiselect-display');
        displayBox.style.borderColor = '#660099';
        
        // إظهار/إخفاء placeholder
        placeholder.style.display = selectedCount > 0 ? 'none' : 'block';
        
        // تسجيل للتصحيح
        console.log('Final selection - Count:', selectedCount);
        console.log('Hidden select selected options:', hiddenSelect.selectedOptions.length);
    }
    
    // حذف عنصر محدد
    function removeFamilyItem(value) {
        const checkbox = document.querySelector(`.family-option-checkbox[value="${value}"]`);
        if (checkbox) {
            checkbox.checked = false;
            updateFamilySelection();
        }
    }
    
    // تحديد الكل
    function selectAllFamilyMembers(checkbox) {
        const allCheckboxes = document.querySelectorAll('.family-option-checkbox[value]');
        const isAllChecked = checkbox.checked;
        
        allCheckboxes.forEach(cb => {
            if (cb.value !== 'all') {
                cb.checked = isAllChecked;
                cb.disabled = isAllChecked;
            }
        });
        
        updateFamilySelection();
    }
    
    // البحث
    function filterFamilyOptions() {
        const searchTerm = document.getElementById('familySearchBox').value.toLowerCase();
        const items = document.querySelectorAll('.family-option-item[data-name]');
        
        items.forEach(item => {
            const text = item.dataset.name.toLowerCase();
            item.style.display = text.includes(searchTerm) ? 'flex' : 'none';
        });
    }
    
    // إضافة تأثير الاهتزاز
    const familyStyle = document.createElement('style');
    familyStyle.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(familyStyle);

        document.addEventListener('DOMContentLoaded', function () {
            const startDateInput = document.getElementById('startDatePicker');
            const endDateInput = document.getElementById('endDatePicker');
            const datesSelects = document.querySelectorAll('.dates-select');
            let datesChoicesList = [];

            datesSelects.forEach((select) => {
                const choices = new Choices(select, {
                    removeItemButton: true,
                    searchEnabled: true,
                    placeholderValue: '{{ __('messages.excluded_dates') }}',
                    noResultsText: '{{ __('messages.no_results') }}',
                    itemSelectText: '{{ __('messages.click_to_select') }}',
                    searchPlaceholderValue: '{{ __('messages.search') }}',
                    shouldSort: false
                });
                datesChoicesList.push(choices);
            });

            function generateDateOptions() {
                const start = startDateInput.value;
                const end = endDateInput.value;

                if (!start || !end) return;

                const startDate = new Date(start);
                const endDate = new Date(end);
                if (endDate < startDate) {
                    alert('{{ __('messages.end_date_must_be_after_start_date') }}');
                    return;
                }

                const options = [];
                let current = new Date(startDate);
                while (current <= endDate) {
                    const y = current.getFullYear();
                    const m = String(current.getMonth() + 1).padStart(2, '0');
                    const d = String(current.getDate()).padStart(2, '0');
                    const value = `${y}-${m}-${d}`;
                    const label = `${d}-${m}-${y}`;
                    options.push({ value, label });
                    current.setDate(current.getDate() + 1);
                }

                datesChoicesList.forEach((choices) => {
                    choices.clearChoices();
                    choices.setChoices(options, 'value', 'label', true);
                });
            }

            startDateInput.addEventListener('change', generateDateOptions);
            endDateInput.addEventListener('change', generateDateOptions);
        });
    </script>

    <!-- تحكم الـ Checkbox -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggles = document.querySelectorAll(".accordion-toggle");
            toggles.forEach(toggle => {
                const targetId = toggle.dataset.target;
                const targetCollapse = document.querySelector(targetId);
                if (!targetCollapse) return;

                const bsCollapse = new bootstrap.Collapse(targetCollapse, { toggle: false });
                bsCollapse.hide();

                toggle.addEventListener("change", function () {
                    this.checked ? bsCollapse.show() : bsCollapse.hide();
                });
            });
        });
    </script>

    <!-- اختيار الأفراد + المطابخ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.kitchen-select').forEach(el => {
                new Choices(el, {
                    removeItemButton: true,
                    searchEnabled: true,
                    placeholderValue: '{{ __('messages.choose_kitchens') }}',
                    noResultsText: 'لا توجد نتائج',
                    itemSelectText: 'اضغط للاختيار',
                    searchPlaceholderValue: 'ابحث...'
                });
            });

            const selectAll = document.getElementById('selectAll');
            const memberCheckboxes = document.querySelectorAll('.member-checkbox');

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    memberCheckboxes.forEach(ch => ch.checked = this.checked);
                });
            }

            memberCheckboxes.forEach(ch => {
                ch.addEventListener('change', function() {
                    if (!this.checked && selectAll && selectAll.checked) {
                        selectAll.checked = false;
                    }
                });
            });
        });
    </script>
</body>

</html>