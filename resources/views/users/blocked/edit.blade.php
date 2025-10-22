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
                    <h4 class="title">تعديل المحظورات</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('users.blocked.show') }}" class="back-btn">
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
                    <i class="fa-solid fa-utensils"></i> بيانات الوجبة
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
                                    {{ $subCategory->name_ar }}
                                </span>
                                @empty
                                <span class="text-muted">لا توجد</span>
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
                                    {{ $recipe->kitchen->name_ar }}
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
                            <i class="fa-solid fa-users"></i> تعديل الأفراد المحظورين
                        </h5>

                        <label for="familyMembers">اختر الأفراد المحظورين من هذه الوجبة:</label>
                        <select multiple class="form-select" name="members[]" id="familyMembers" required>
                            <option value="all" {{ $isBlockedForAll ? 'selected' : '' }}>الجميع</option>
                            @foreach($allFamilyMembers as $member)
                            <option value="{{ $member->id }}" {{ $blockedMembers->contains('id', $member->id) ?
                                'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                            @endforeach
                        </select>

                        <div style="margin-top: 15px; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                            <small style="color: #666;">
                                <i class="fa-solid fa-info-circle" style="color: #660099;"></i>
                                <strong>محظورة حالياً لـ:</strong>
                                @if($isBlockedForAll)
                                <span class="info-badge">الجميع</span>
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
                            <i class="fa-solid fa-save"></i> حفظ التعديلات
                        </button>
                        <button type="button" class="btn-delete" onclick="deleteBlock()">
                            <i class="fa-solid fa-trash"></i> حذف من المحظورات
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // تفعيل Select2
            $('#familyMembers').select2({
                placeholder: "اختر الأفراد المحظورين",
                allowClear: true,
                language: {
                    noResults: function() {
                        return "لا توجد نتائج";
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
                        title: "يجب اختيار عضو واحد على الأقل",
                        icon: "warning",
                        confirmButtonText: "حسناً",
                        confirmButtonColor: "#660099"
                    });
                    return false;
                }

                Swal.fire({
                    title: "هل أنت متأكد من حفظ التعديلات؟",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#660099",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "نعم، احفظ",
                    cancelButtonText: "إلغاء"
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
                title: "هل أنت متأكد من إزالة هذه الوجبة من المحظورات؟",
                text: "سيتم إلغاء حظرها عن جميع الأفراد",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "نعم، احذف",
                cancelButtonText: "إلغاء"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteBlockForm').submit();
                }
            });
        }
    </script>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>