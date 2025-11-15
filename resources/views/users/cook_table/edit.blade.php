<!DOCTYPE html>
<html lang="ar">

<head>
    <title>تعديل جدول الطبخ</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cook_table.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ url()->previous() }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.edit_cook_table') }}</h4>
                </div>
                <div class="right-content d-flex gap-2">
                    <button type="submit" form="mealPlanForm" class="btn btn-success p-0 border-0 bg-transparent">
                        <i class="feather icon-check" style="font-size: 29px; font-weight: bold; color: green;"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- النموذج -->
        <form style="margin-top: 70px;" id="mealPlanForm" action="{{ route('meal_plans.update', $mealPlan->id) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="container text-center">
                <div class="row" id="contentArea">

                    <!-- الأخطاء -->
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger" style="width: 96%; margin: 0 auto !important;">
                        {{ $error }}
                    </div>
                    @endforeach

                    <!-- تاريخ البداية والنهاية -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{ __('messages.start_date') }}</label>
                        <input type="date" name="startDatePicker" id="startDatePicker" class="form-control mb-3"
                            value="{{ $mealPlan->start_date }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">{{ __('messages.end_date') }}</label>
                        <input type="date" name="endDatePicker" id="endDatePicker" class="form-control mb-3"
                            value="{{ $mealPlan->end_date }}" required>
                    </div>

                    <!-- أفراد العائلة -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">{{ __('messages.family_members') }}</label>

                        <!-- الـ Select المخفي (للـ form submission) -->
                        <select multiple name="familyMembers[]" id="hiddenFamilyMembers" style="display: none;">
                            @foreach ($my_family as $member)
                            <option value="{{ $member->id }}" {{ in_array($member->id, $mealPlan->family_members) ?
                                'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                            @endforeach
                        </select>

                        <!-- الـ Dropdown المخصص -->
                        <div class="custom-multiselect"
                            style="direction: rtl; width: 50%; margin: auto; position: relative;">
                            <!-- صندوق العرض -->
                            <div class="multiselect-display" onclick="toggleFamilyDropdown()" style="
                                border: 1px solid #660099;
                                padding: 10px 15px;
                                background: white;
                                border-radius: 6px;
                                cursor: pointer;
                                min-height: 45px;
                                display: flex;
                                align-items: center;
                                flex-wrap: wrap;
                                gap: 0px;
                            ">
                                <span class="family-placeholder" style="color: #999;">اختر أعضاء العائلة...</span>
                                <div class="family-selected-items" style="display: flex; flex-wrap: wrap; gap: 5px;">
                                </div>
                                <span style="margin-right: auto; color: #660099;">▼</span>
                            </div>

                            <!-- قائمة الخيارات -->
                            <div class="family-multiselect-dropdown" id="familyDropdownMenu" style="
                                display: none;
                                position: absolute;
                                top: 100%;
                                left: 0;
                                right: 0;
                                background: white;
                                border: 1px solid #660099;
                                border-radius: 6px;
                                margin-top: 5px;
                                box-shadow: 0 4px 12px rgba(102, 0, 153, 0.15);
                                z-index: 1000;
                                max-height: 300px;
                                overflow-y: auto;
                            ">
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
                                    " onmouseover="this.style.background='#f8f4fc'"
                                        onmouseout="this.style.background='white'">
                                        <input type="checkbox" class="family-option-checkbox" value="all"
                                            onchange="selectAllFamilyMembers(this)">
                                        <span style="margin-right: 10px;">{{ __('messages.select_all') }}</span>
                                    </label>

                                    @foreach ($my_family as $member)
                                    <label class="family-option-item" data-value="{{ $member->id }}"
                                        data-name="{{ $member->name }}" style="
                                        display: flex;
                                        align-items: center;
                                        padding: 10px 15px;
                                        cursor: pointer;
                                        transition: background 0.2s;
                                    " onmouseover="this.style.background='#f8f4fc'"
                                        onmouseout="this.style.background='white'">
                                        <input type="checkbox" class="family-option-checkbox" value="{{ $member->id }}"
                                            onchange="updateFamilySelection()" {{ in_array($member->id,
                                        $mealPlan->family_members) ? 'checked' : '' }}>
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

                                @foreach(['breakfast' => __('messages.breakfast'), 'lunch' => __('messages.lunch'),
                                'dinner' => __('messages.dinner')] as $type => $label)
                                @php
                                $mealData = $mealPlan->meals[$type] ?? [];
                                $isActive = $mealData['active'] ?? false;
                                @endphp

                                <div class="accordion-item mb-3 border rounded">
                                    <div
                                        class="accordion-header d-flex justify-content-between align-items-center p-3 bg-light">
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="time" name="time_{{ $type }}" class="form-control"
                                                style="width: 120px;" value="{{ $mealData['time'] ?? '' }}"
                                                placeholder="الوقت">
                                        </div>
                                        <span class="fw-bold">{{ $label }}</span>
                                        <input type="checkbox" name="meal_{{ $type }}_active" class="accordion-toggle"
                                            data-target="#collapse-{{ $type }}" {{ $isActive ? 'checked' : '' }}>
                                    </div>

                                    <div id="collapse-{{ $type }}" class="collapse {{ $isActive ? 'show' : '' }}">
                                        <div class="p-3">
                                            <!-- المطابخ -->
                                            <select name="kitchen_{{ $type }}[]" class="form-select kitchen-select"
                                                multiple style="width: 100%;">
                                                <option value="">{{ __('messages.all_kitchens') }}</option>
                                                @foreach ($kitchens as $kitchen)
                                                <option value="{{ $kitchen->id }}" {{ in_array($kitchen->id,
                                                    $mealData['kitchens'] ?? []) ? 'selected' : '' }}>
                                                    {{ trans_field($kitchen, 'name') }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <!-- الميزات -->
                                            <div class="mb-3 mt-3" style="columns: 2;">
                                                @php
                                                $featureMapping = [
                                                'contains_salad' => 'contains_salad',
                                                'contains_drinks' => 'contains_drinks',
                                                'contains_appetizers' => 'contains_appetizers',
                                                'contains_healthy_food' => 'contains_healthy_food',
                                                'contains_soup' => 'contains_soup',
                                                'contains_desserts' => 'contains_desserts',
                                                'contains_sauces' => 'contains_sauces',
                                                'contains_side_dish' => 'contains_side_dish'
                                                ];
                                                @endphp

                                                @foreach ($featureMapping as $key => $feature)
                                                <label
                                                    style="font-size: 12px; width: 100%; display: flex; justify-content: space-between;">
                                                    <input type="checkbox" style="height: 15px; width: unset;"
                                                        name="features_{{ $type }}[]" value="{{ $key }}" {{
                                                        in_array($key, $mealData['features'] ?? []) ? 'checked' : '' }}>
                                                    {{ __('messages.' . $feature) }}
                                                </label>
                                                @endforeach
                                            </div>

                                            <!-- الملاحظات -->
                                            <div class="mt-3">
                                                <input type="text" name="comments_{{ $type }}"
                                                    placeholder="{{ __('messages.notes') }}" class="form-control"
                                                    value="{{ $mealData['notes'] ?? '' }}">
                                            </div>

                                            <!-- الأيام المستبعدة -->
                                            <label class="form-label d-block mt-3">{{ __('messages.remove_days')
                                                }}</label>
                                            <select name="excluded_dates_{{ $type }}[]"
                                                class="dates-select dates-select-{{ $type }}" multiple
                                                style="width: 100%;"
                                                data-excluded="{{ json_encode($mealData['excluded_days'] ?? []) }}">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

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

    <!-- JavaScript لأفراد العائلة -->
    <script>
        // تهيئة الحالة الأولية مع البيانات المسبقة
        document.addEventListener('DOMContentLoaded', function() {
            // تعيين الحالة المبدئية للـ checkboxes بناءً على البيانات المحفوظة
            const savedMembers = @json($mealPlan->family_members);
            const allCheckbox = document.querySelector('.family-option-checkbox[value="all"]');
            const memberCheckboxes = document.querySelectorAll('.family-option-checkbox[value]:not([value="all"])');
            
            // إذا كان عدد الأعضاء المختارين يساوي إجمالي الأعضاء، نختار "الكل"
            if (savedMembers.length === memberCheckboxes.length) {
                allCheckbox.checked = true;
                // تعطيل الخيارات الفردية عند اختيار الكل
                memberCheckboxes.forEach(cb => {
                    cb.disabled = true;
                });
            } else {
                // تحديد الأعضاء المختارين مسبقاً
                memberCheckboxes.forEach(checkbox => {
                    if (savedMembers.includes(parseInt(checkbox.value))) {
                        checkbox.checked = true;
                    }
                });
            }
            
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

        // التحقق من الصحة قبل الإرسال
        function validateFamilyForm() {
            const hiddenSelect = document.getElementById('hiddenFamilyMembers');
            const selectedOptions = hiddenSelect.selectedOptions;
            
            console.log('Number of selected options:', selectedOptions.length);
            
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

        // تحديث الاختيارات
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
            
            // تحديث الـ hidden select
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
                badge.textContent = '{{ __("messages.select_all") }}';
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
        }

        // حذف عنصر محدد
        function removeFamilyItem(value) {
            const checkbox = document.querySelector(`.family-option-checkbox[value="${value}"]`);
            if (checkbox) {
                checkbox.checked = false;
                // إذا كنا في حالة "الكل"، نلغي اختيار "الكل" أيضاً
                const allCheckbox = document.querySelector('.family-option-checkbox[value="all"]');
                if (allCheckbox.checked) {
                    allCheckbox.checked = false;
                    // إعادة تفعيل الخيارات الفردية
                    const memberCheckboxes = document.querySelectorAll('.family-option-checkbox[value]:not([value="all"])');
                    memberCheckboxes.forEach(cb => {
                        cb.disabled = false;
                    });
                }
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
    </script>

    <!-- تحديث الأيام -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const startDateInput = document.getElementById('startDatePicker');
            const endDateInput = document.getElementById('endDatePicker');
            const datesSelects = document.querySelectorAll('.dates-select');
            let datesChoicesList = [];

            datesSelects.forEach((select) => {
                const choices = new Choices(select, {
                    removeItemButton: true,
                    searchEnabled: true,
                    placeholderValue: "{{ __('messages.remove_days') }}",
                    noResultsText: "{{ __('messages.no_results') }}",
                    itemSelectText: "{{ __('messages.click_to_select') }}",
                    searchPlaceholderValue: "{{ __('messages.search') }}",
                    shouldSort: false
                });
                datesChoicesList.push({ choices, select });
            });

            function generateDateOptions() {
                const start = startDateInput.value;
                const end = endDateInput.value;
                if (!start || !end) return;
                const startDate = new Date(start);
                const endDate = new Date(end);
                if (endDate < startDate) {
                    alert("{{ __('messages.end_date_after_start') }}");
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

                datesChoicesList.forEach((item) => {
                    const excludedDates = JSON.parse(item.select.dataset.excluded || '[]');
                    item.choices.clearChoices();
                    item.choices.setChoices(options, 'value', 'label', true);
                    if (excludedDates.length > 0) {
                        item.choices.setChoiceByValue(excludedDates);
                    }
                });
            }

            generateDateOptions();
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

                // فتح الـ collapse إذا كان الـ checkbox checked
                if (toggle.checked) {
                    targetCollapse.classList.add('show');
                }

                const bsCollapse = new bootstrap.Collapse(targetCollapse, {
                    toggle: false
                });

                toggle.addEventListener("change", function () {
                    this.checked ? bsCollapse.show() : bsCollapse.hide();
                });
            });
        });
    </script>

    <!-- اختيار المطابخ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.kitchen-select').forEach(el => {
                new Choices(el, {
                    removeItemButton: true,
                    searchEnabled: true,
                    placeholderValue: "{{ __('messages.select_kitchens') }}",
                    noResultsText: "{{ __('messages.no_results') }}",
                    itemSelectText: "{{ __('messages.click_to_select') }}",
                    searchPlaceholderValue: "{{ __('messages.search') }}"
                });
            });
        });
    </script>

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
</body>

</html>