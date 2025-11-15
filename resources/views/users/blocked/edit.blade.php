<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>تعديل المحظورات</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link rel="stylesheet" href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .container-cart {
            box-shadow: 0px 0px 3px 3px #ededed;
            border-radius: 20px;
            margin: 20px;
            background: #fafafa;
        }

        .dz-card.list {
            display: flex;
            margin-bottom: 0px !important;
            overflow: visible;
        }

        .dz-card {
            position: relative;
            height: 100%;
            border-radius: var(--border-radius-xl);
            overflow: hidden;
        }

        .dz-card.list .dz-media {
            margin-left: 20px;
            overflow: visible;
            max-width: 112px;
            min-width: 112px;
        }

        .dz-card.list .dz-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
            padding: 10px 0;
        }

        .dz-card.list .dz-media img {
            display: flex;
            border-radius: var(--border-radius-xl);
            width: 100%;
            height: 100%;
        }

        .container-cart img {
            border-radius: 0px 20px 20px 0px !important;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }

        .btn-save {
            background-color: #660099;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-save:hover {
            background-color: #550088;
            transform: translateY(-2px);
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .members-section {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .members-section label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

        .select2-container--default .select2-selection--multiple {
            border: 2px solid #660099 !important;
            border-radius: 8px !important;
            min-height: 45px;
            padding: 5px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #660099 !important;
            border: none !important;
            color: white !important;
            border-radius: 5px !important;
            padding: 5px 10px !important;
        }

        .info-badge {
            display: inline-block;
            background: #f0f0f0;
            padding: 8px 15px;
            border-radius: 20px;
            margin: 5px;
            font-size: 14px;
        }

        .section-title {
            color: #660099;
            font-weight: 600;
            margin: 20px 20px 10px 20px;
            font-size: 18px;
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

        <!-- Header -->
        <header class="header header-fixed" style="border-bottom: 1px solid #eee;">
            <div class="header-content">
                <div class="right-content d-flex align-items-center gap-4"></div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.edit_blocks') }}</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('users.blocked.show') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="page-content space-top">
            <div class="container">

                <!-- معلومات الوجبة -->
                <h5 class="section-title">
                    <i class="fa-solid fa-utensils"></i> {{ __('messages.meal_data') }}
                </h5>

                <li class="container-cart">
                    <div class="dz-card list">
                        <div class="dz-media">
                            <img src="{{ asset('storage/' . $recipe->dish_image) }}" alt="{{ $recipe->title }}">
                        </div>
                        <div class="dz-content">
                            <div class="dz-head">
                                <h6 class="title">
                                    <span>{{ $recipe->title }}</span>
                                </h6>
                                <ul class="tag-list"></ul>

                                @forelse($recipe->subCategories as $subCategory)
                                <span class="badge badge-info" style="margin-bottom: 3px;">
                                    {{ app()->getLocale() == 'ar' ? $subCategory->name_ar : $subCategory->name_en }}
                                </span>
                                @empty
                                <span class="text-muted">{{ __('messages.none') }}</span>
                                @endforelse

                                <ul class="tag-list" style="display: flex; gap: 10px;">
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-clock" style="color: var(--primary-color);"></i>
                                        {{ $recipe->preparation_time }}
                                    </li>
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-eye" style="color: var(--primary-color);"></i>
                                        {{ $recipe->views }}
                                    </li>
                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                        <i class="fa-solid fa-heart" style="color: var(--primary-color);"></i>
                                        {{ $recipe->favorited_by_count ?? 0 }}
                                    </li>
                                </ul>

                                <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;">
                                    <img src="{{ asset('storage/' . $recipe->kitchen->image) }}"
                                        style="border-radius: 50% !important; width: 30px; height: 30px;" alt="">
                                    {{ app()->getLocale() == 'ar' ? $recipe->kitchen->name_ar :
                                    $recipe->kitchen->name_en }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- فورم التعديل -->
                <form id="updateBlockForm" action="{{ route('users.blocked.update', $recipe->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- اختيار الأفراد -->
                    <div class="members-section">
                        <h5 class="section-title" style="margin: 0 0 15px 0;">
                            <i class="fa-solid fa-users"></i> {{ __('messages.edit_blocked_members') }}
                        </h5>

                        <label for="familyMembers">{{ __('messages.select_blocked_members') }}:</label>
                       <!-- الـ Select المخفي (للـ form submission) -->
<select multiple name="members[]" id="hiddenFamilyMembers" style="display: none;">
    @foreach ($allFamilyMembers as $member)
    <option value="{{ $member->id }}" {{ $blockedMembers->contains('id', $member->id) ? 'selected' : '' }}>
        {{ $member->name }}
    </option>
    @endforeach
</select>

<!-- الـ Dropdown المخصص -->
<div class="custom-multiselect" style="width: 84%; position: relative;">
    <!-- صندوق العرض -->
    <div class="multiselect-display" onclick="toggleDropdown()" style="
        border: 1px solid #660099;
        padding: 10px 15px;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        min-height: 45px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    ">
        <span class="placeholder" style="color: #999;">اختر أعضاء العائلة...</span>
        <div class="selected-items" style="display: flex; flex-wrap: wrap; gap: 5px;"></div>
        <span style="margin-right: auto; color: #660099;">▼</span>
    </div>

    <!-- قائمة الخيارات -->
    <div class="multiselect-dropdown" id="dropdownMenu" style="
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
        <div style="padding: 10px; border-bottom: 1px solid #eee; position: sticky; top: 0; background: white;">
            <input type="text" id="searchBox" placeholder="ابحث..." style="
                width: 100%;
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            " onkeyup="filterOptions()">
        </div>

        <!-- الخيارات -->
        <div class="options-list" style="padding: 5px 0;">
            <!-- خيار "الكل" -->
            <label class="option-item" data-value="all" style="
                display: flex;
                align-items: center;
                padding: 10px 15px;
                cursor: pointer;
                transition: background 0.2s;
                border-bottom: 1px solid #f0f0f0;
            " onmouseover="this.style.background='#f8f4fc'" onmouseout="this.style.background='white'">
                <input type="checkbox" class="option-checkbox" value="all" onchange="selectAll(this)" {{ $isBlockedForAll ? 'checked' : '' }}>
                <span style="margin-right: 10px;">{{ __('messages.all') }}</span>
            </label>

            @foreach ($allFamilyMembers as $member)
            <label class="option-item" data-value="{{ $member->id }}" data-name="{{ $member->name }}" style="
                display: flex;
                align-items: center;
                padding: 10px 15px;
                cursor: pointer;
                transition: background 0.2s;
            " onmouseover="this.style.background='#f8f4fc'" onmouseout="this.style.background='white'">
                <input type="checkbox" class="option-checkbox" value="{{ $member->id }}" onchange="updateSelection()" 
                       {{ $blockedMembers->contains('id', $member->id) ? 'checked' : '' }}>
                <span style="margin-right: 10px;">{{ $member->name }}</span>
            </label>
            @endforeach
        </div>
    </div>
</div>

<script>
// تهيئة الحالة الأولية
document.addEventListener('DOMContentLoaded', function() {
    updateSelection();
});

// فتح/إغلاق القائمة
function toggleDropdown() {
    const dropdown = document.getElementById('dropdownMenu');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    
    if(dropdown.style.display === 'block') {
        document.getElementById('searchBox').focus();
    }
}

// إغلاق عند الضغط خارج القائمة
document.addEventListener('click', function(e) {
    const container = document.querySelector('.custom-multiselect');
    if (!container.contains(e.target)) {
        document.getElementById('dropdownMenu').style.display = 'none';
    }
});

// تحديث الاختيارات
function updateSelection() {
    const checkboxes = document.querySelectorAll('.option-checkbox[value]');
    const selectedContainer = document.querySelector('.selected-items');
    const placeholder = document.querySelector('.placeholder');
    const hiddenSelect = document.getElementById('hiddenFamilyMembers');
    
    // مسح الاختيارات القديمة
    selectedContainer.innerHTML = '';
    
    let selectedCount = 0;
    const allChecked = document.querySelector('.option-checkbox[value="all"]').checked;
    
    // تحديث الـ hidden select
    hiddenSelect.innerHTML = '';
    
    checkboxes.forEach(checkbox => {
        if (checkbox.checked && checkbox.value !== 'all') {
            selectedCount++;
            const name = checkbox.closest('.option-item').dataset.name;
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
            badge.innerHTML = `${name} <span onclick="removeItem('${value}')" style="cursor: pointer; font-weight: bold;">×</span>`;
            selectedContainer.appendChild(badge);
            
            // إضافة للـ hidden select
            const option = document.createElement('option');
            option.value = value;
            option.selected = true;
            option.textContent = name;
            hiddenSelect.appendChild(option);
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
        
        // إضافة خيار "all" للـ hidden select
        const allOption = document.createElement('option');
        allOption.value = 'all';
        allOption.selected = true;
        allOption.textContent = '{{ __("messages.all") }}';
        hiddenSelect.appendChild(allOption);
    }
    
    // إظهار/إخفاء placeholder
    placeholder.style.display = (selectedCount > 0 || allChecked) ? 'none' : 'block';
}

// حذف عنصر محدد
function removeItem(value) {
    const checkbox = document.querySelector(`.option-checkbox[value="${value}"]`);
    if (checkbox) {
        checkbox.checked = false;
        updateSelection();
    }
}

// تحديد الكل
function selectAll(checkbox) {
    const allCheckboxes = document.querySelectorAll('.option-checkbox[value]');
    const isAllChecked = checkbox.checked;
    
    allCheckboxes.forEach(cb => {
        if (cb.value !== 'all') {
            cb.checked = isAllChecked;
            cb.disabled = isAllChecked;
        }
    });
    
    updateSelection();
}

// البحث
function filterOptions() {
    const searchTerm = document.getElementById('searchBox').value.toLowerCase();
    const items = document.querySelectorAll('.option-item[data-name]');
    
    items.forEach(item => {
        const text = item.dataset.name.toLowerCase();
        item.style.display = text.includes(searchTerm) ? 'flex' : 'none';
    });
}
</script>

<style>
/* Scrollbar تخصيص */
.multiselect-dropdown::-webkit-scrollbar {
    width: 6px;
}

.multiselect-dropdown::-webkit-scrollbar-thumb {
    background: #660099;
    border-radius: 3px;
}

.multiselect-dropdown::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Checkbox تخصيص */
.option-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #660099;
}

/* تعطيل الخيارات عند اختيار الكل */
.option-checkbox[value]:not([value="all"]):disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>

                        <div style="margin-top: 15px; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                            <small style="color: #666;">
                                <i class="fa-solid fa-info-circle" style="color: #660099;"></i>
                                <strong>{{ __('messages.currently_blocked_for') }}:</strong>
                                @if($isBlockedForAll)
                                <span class="info-badge">{{ __('messages.all') }}</span>
                                @else
                                @foreach($blockedMembers as $member)
                                <span class="info-badge">{{ $member->name }}</span>
                                @endforeach
                                @endif
                            </small>
                        </div>
                    </div>

                    <!-- أزرار الإجراءات -->
                    <div class="action-buttons">
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-save"></i> {{ __('messages.save_changes') }}
                        </button>
                        <button type="button" class="btn-delete" onclick="deleteBlock()">
                            <i class="fa-solid fa-trash"></i> {{ __('messages.delete_from_blocks') }}
                        </button>
                    </div>
                </form>

                <!-- فورم الحذف المخفي -->
                <form id="deleteBlockForm" action="{{ route('users.blocked.destroy', $recipe->id) }}" method="POST"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
        // تفعيل Select2
        $('#familyMembers').select2({
            placeholder: "{{ __('messages.select_blocked_members_placeholder') }}",
            allowClear: true,
            language: {
                noResults: function() {
                    return "{{ __('messages.no_results') }}";
                }
            }
        });

        // التعامل مع خيار "الجميع"
        $('#familyMembers').on('change', function() {
            var selected = $(this).val();
            
            if (selected && selected.includes('all')) {
                // لو اختار "الجميع"، نختار كل الأعضاء
                $('#familyMembers option').prop('selected', true);
                $('#familyMembers').trigger('change');
            }
        });

        // التأكد من التعديل قبل الحفظ
        $('#updateBlockForm').on('submit', function(e) {
            e.preventDefault();
            
            var selectedMembers = $('#familyMembers').val();
            
            if (!selectedMembers || selectedMembers.length === 0) {
                Swal.fire({
                    title: "{{ __('messages.select_at_least_one_member') }}",
                    icon: "warning",
                    confirmButtonText: "{{ __('messages.ok') }}",
                    confirmButtonColor: "#660099"
                });
                return false;
            }

            Swal.fire({
                title: "{{ __('messages.confirm_save_changes') }}",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#660099",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "{{ __('messages.yes_save') }}",
                cancelButtonText: "{{ __('messages.cancel') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });

    // دالة حذف الحظر
    function deleteBlock() {
        Swal.fire({
            title: "{{ __('messages.confirm_remove_block') }}",
            text: "{{ __('messages.remove_block_message') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "{{ __('messages.yes_delete') }}",
            cancelButtonText: "{{ __('messages.cancel') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteBlockForm').submit();
            }
        });
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {!! $swalScript !!}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>