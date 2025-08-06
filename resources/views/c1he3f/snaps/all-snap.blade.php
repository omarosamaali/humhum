<!DOCTYPE html>
<html lang="ar">
<head>
    <!-- Title -->
    <title>
        هم هم سناب
    </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Global CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :lang(ar) body {
            font-family: 'cairo';
            font-size: 17px;
        }

        body {
            --tw-bg-opacity: 1;
            --tw-text-opacity: 1;
            line-height: 1.5;
            font-size: 1rem;
            letter-spacing: -.025em;
            color: rgb(74 74 74/var(--tw-text-opacity, 1));
            transition: opacity ease-in 0.2s;
        }

        .chat-content.user .bubble {
            background-color: #e0f7fa;
            color: #000;
            margin-left: auto;
            border-radius: 10px 10px 0 10px;
        }

        .chat-content .bubble {
            background-color: #f5f5f5;
            color: #000;
            border-radius: 10px 10px 10px 0;
        }

        .chat-content.outgoing {
            justify-content: end;
            padding-right: 0px !important;
        }

        .chat-content:last-of-type {
            margin-bottom: 100px !important;
        }

        .chat-content.outgoing .bubble {
            background: var(--primary) !important;
            color: #ffffff !important;

        }

        .bubble {
            padding: 10px 15px;
            max-width: 70%;
            margin-bottom: 5px;
        }

        .message-time {
            font-size: 0.8rem;
            color: #999;
        }

        .chat-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #fff;
            padding: 10px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .input-wrapper {
            display: flex;
            align-items: center;
        }

        .chat-btn svg {
            fill: #e00000;
        }

        .media-content img,
        .media-content video {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
            height: 300px;
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

        <!-- Header -->
        <header class="header header-sticky border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title"> عدسة الطاهي</h4>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top">
            <div class="container pt-0">
                <div class="default-tab style-2 mt-1">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" aria-selected="true" role="tab">
                                منشور
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile" aria-selected="false" role="tab" tabindex="-1">
                                مسودة
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Published Tab -->
                        <div class="tab-pane fade active show" style="direction: rtl;" id="home" role="tabpanel">
                            <ul class="featured-list" style="margin-bottom: 100px;">
                                @forelse ($publishedSnaps as $snap)
                                <li>
                                    <div class="dz-card list">
                                        <div class="dz-media">
                                            <a href="{{ route('c1he3f.snaps.lens-show', $snap) }}">
                                                @if ($snap && $snap->video_path)
                                                <div style="position: relative; width: 120px; height: 132px;">
                                                    <video width="120" height="132" style="border-radius: var(--border-radius); object-fit: cover;" preload="metadata" muted>
                                                        <source src="{{ Storage::url($snap->video_path) }}#t=1" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                                @else
                                                <p>الفيديو غير متاح.</p>
                                                @endif
                                                <div class="dz-rating" style="left: 25px; background-color: var(--primary);">
                                                    {{ $snap->likes_count ?? 0 }}
                                                    <i class="feather icon-heart-on"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="dz-content">
                                            <div class="dz-head">
                                                <h6 class="title"> <a href="{{ route('c1he3f.snaps.lens-show', $snap) }}">
                                                        {{ $snap->name }}</a></h6>
                                                <div style="display: flex; flex-direction: column;">
                                                    <h6 class="title" style="font-size: 13px; background-color: green; color: white; width: fit-content; padding: 3px; border-radius: 5px; ">
                                                        {{ $snap->mainCategory->name_ar ?? 'غير محدد' }}
                                                    </h6>
                                                    <div class="subcategory-container">
                                                        @if($snap->subCategories->isNotEmpty())
                                                        <div class="subcategory-list">
                                                            @foreach($snap->subCategories as $subCategory)
                                                            <span class="badge" style="font-size: 12px; background-color: #007bff; color: white; margin: 2px; padding: 3px 8px; border-radius: 5px;">
                                                                {{ $subCategory->name_ar }}
                                                            </span>
                                                            @endforeach
                                                        </div>
                                                        @else
                                                        <div class="text-muted">لا توجد تصنيفات فرعية</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        const mainCategorySelect = document.getElementById('main_category_id');
                                                        const subCategoryContainer = document.getElementById('subcategory-container');
                                                        const subCategoryIdsInput = document.getElementById('subCategory_ids');
                                                        const savedSubCategories = @json($subCategories);

                                                        // احصل على معرفات التصنيفات الفرعية المرتبطة بهذا السناب
                                                        const savedSubCategories = @json($subCategories);

                                                        console.log('التصنيفات المحفوظة:', savedSubCategories); // للتأكد من البيانات


                                                        // دالة لجلب التصنيفات الفرعية
                                                        function loadSubcategories(mainCategoryId, selectedSubCategories = []) {
                                                            if (!mainCategoryId) {
                                                                subCategoryContainer.innerHTML = '';
                                                                subCategoryIdsInput.value = '';
                                                                return;
                                                            }

                                                            // إظهار مؤشر التحميل
                                                            subCategoryContainer.innerHTML = '<div class="text-center">جاري التحميل...</div>';

                                                            // استخدام fetch للحصول على التصنيفات الفرعية
                                                            fetch(`/c1he3f/snaps/get-subcategories/${mainCategoryId}`).then(response => response.json())

                                                                .then(data => {
                                                                    if (data.length === 0) {
                                                                        subCategoryContainer.innerHTML = '<div class="text-muted">لا توجد تصنيفات فرعية لهذا التصنيف</div>';
                                                                        return;
                                                                    }

                                                                    let html = '<div class="form-group"><label>التصنيفات الفرعية:</label><div class="subcategory-checkboxes">';

                                                                    data.forEach(subCategory => {
                                                                        // التحقق من أن التصنيف الفرعي محدد مسبقاً
                                                                        // نحول كلاً من القيم إلى string للمقارنة الصحيحة
                                                                        const isSelected = selectedSubCategories.map(id => String(id)).includes(String(subCategory.id));
                                                                        const isChecked = isSelected ? 'checked' : '';

                                                                        console.log(`التصنيف ${subCategory.id}: محدد = ${isSelected}`); // للتأكد

                                                                        html += `
                        <div class="form-check">
                            <input class="form-check-input subcategory-checkbox" 
                                   type="checkbox" 
                                   value="${subCategory.id}" 
                                   id="subcat_${subCategory.id}"
                                   ${isChecked}>
                            <label class="form-check-label" style="margin-right: 31px;" for="subcat_${subCategory.id}">
                                ${subCategory.name_ar}
                            </label>
                        </div>
                    `;
                                                                    });

                                                                    html += '</div></div>';
                                                                    subCategoryContainer.innerHTML = html;

                                                                    // إضافة event listeners للـ checkboxes
                                                                    addCheckboxListeners();

                                                                    // تحديث القيم المخفية
                                                                    updateSelectedSubcategories();
                                                                })
                                                                .catch(error => {
                                                                    console.error('خطأ في جلب التصنيفات الفرعية:', error);
                                                                    subCategoryContainer.innerHTML = '<div class="text-danger">خطأ في تحميل التصنيفات الفرعية</div>';
                                                                });
                                                        }

                                                        // دالة لإضافة event listeners للـ checkboxes
                                                        function addCheckboxListeners() {
                                                            const checkboxes = document.querySelectorAll('.subcategory-checkbox');
                                                            checkboxes.forEach(checkbox => {
                                                                checkbox.addEventListener('change', updateSelectedSubcategories);
                                                            });
                                                        }

                                                        function updateSelectedSubcategories() {
                                                            const checkboxes = document.querySelectorAll('.subcategory-checkbox:checked');
                                                            const selectedIds = Array.from(checkboxes).map(cb => cb.value);
                                                            const subCategoryIdsInput = document.getElementById('subCategory_ids');

                                                            // إزالة أي مدخلات مخفية سابقة
                                                            subCategoryIdsInput.parentNode.querySelectorAll('input[name="subCategory_ids[]"]').forEach(input => input.remove());

                                                            // إضافة مدخل مخفي لكل معرف
                                                            selectedIds.forEach(id => {
                                                                const input = document.createElement('input');
                                                                input.type = 'hidden';
                                                                input.name = 'subCategory_ids[]';
                                                                input.value = id;
                                                                subCategoryIdsInput.parentNode.appendChild(input);
                                                            });

                                                            console.log('القيم المحدثة:', selectedIds);
                                                        }


                                                        // عند تغيير التصنيف الرئيسي
                                                        mainCategorySelect.addEventListener('change', function() {
                                                            const selectedMainCategory = this.value;
                                                            loadSubcategories(selectedMainCategory);
                                                        });

                                                        // تحميل التصنيفات الفرعية عند تحميل الصفحة (إذا كان هناك تصنيف رئيسي محدد مسبقاً)
                                                        const currentMainCategory = mainCategorySelect.value;
                                                        if (currentMainCategory) {
                                                            // تمرير التصنيفات المحفوظة مباشرة
                                                            loadSubcategories(currentMainCategory, savedSubCategories);
                                                        }
                                                    });

                                                </script>

                                                <ul class="tag-list">
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-clock" style="color: var(--primary);"></i>
                                                        {{ $snap->created_at->diffForHumans() ?? '5 دقيقة' }}

                                                    </li>
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-eye" style="color: var(--primary);"></i>
                                                        {{ $snap->views ?? 0 }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <ul class="dz-meta">
                                                <li class="dz-price flex-1">
                                                    <a href="{{ url('c1he3f/snaps/edit-snap', $snap) }}" class="btn btn-primary btn-xs font-13 btn-thin rounded-xl" style="background-color: orange; border: orange;">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('c1he3f.snaps.delete', $snap) }}" method="POST" id="{{ $snap->id }}" onsubmit="return confirmDelete(event, '{{ $snap->name }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary btn-xs font-13 btn-thin rounded-xl">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <script>
                                                        function confirmDelete(event, snap) {
                                                            event.preventDefault();
                                                            const confirmation = confirm(`هل أنت متأكد من حذف ${snap}`)
                                                            if (confirmation) {

                                                                event.target.submit();
                                                            }
                                                            return false
                                                        }

                                                    </script>


                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li>
                                    <p>لا توجد مقاطع منشورة حاليًا.</p>
                                </li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Draft Tab -->
                        <div class="tab-pane fade" id="profile" style="direction: rtl;" role="tabpanel">
                            <ul class="featured-list" style="margin-bottom: 100px;">
                                @forelse ($draftSnaps as $snap)
                                <li>
                                    <div class="dz-card list">
                                        <div class="dz-media">
                                            <a href="{{ route('c1he3f.snaps.lens-show', $snap) }}">
                                                @if ($snap && $snap->video_path)
                                                <div style="position: relative; width: 120px; height: 132px;">
                                                    <video width="120" height="132" style="border-radius: var(--border-radius); object-fit: cover;" preload="metadata" muted>
                                                        <source src="{{ Storage::url($snap->video_path) }}#t=1" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                                @else
                                                <p>الفيديو غير متاح.</p>
                                                @endif
                                                <div class="dz-rating" style="left: 25px; background-color: var(--primary);">
                                                    {{ $snap->likes_count ?? 0 }}
                                                    <i class="feather icon-heart-on"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="dz-content">
                                            <div class="dz-head">
                                                <h6 class="title">
                                                    <a href="{{ route('c1he3f.snaps.lens-show', $snap) }}">
                                                        {{ $snap->name }}</a>
                                                </h6>
                                                 <ul class="tag-list">
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-clock" style="color: var(--primary);"></i>
                                                        {{ $snap->created_at->diffForHumans() ?? '5 دقيقة' }}
                                                    </li>
                                                    <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                        <i class="fa-solid fa-eye" style="color: var(--primary);"></i>
                                                        {{ $snap->views ?? 0 }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <ul class="dz-meta">
                                                <li class="dz-price flex-1">
                                                    <a href="{{ url('c1he3f/snaps/edit-snap', $snap) }}" class="btn btn-primary btn-xs font-13 btn-thin rounded-xl" style="background-color: orange; border: orange;">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form id="delete-snap-form-{{ $snap->id }}" method="POST" action="{{ route('c1he3f.snaps.delete', $snap) }}" onsubmit="return confirmDelete(event, '{{ $snap->name }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs font-13 btn-thin rounded-xl">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>

                                                    <script>
                                                        function confirmDelete(event, snapName) {
                                                            event.preventDefault();
                                                            const confirmation = confirm(`هل أنت متأكد أنك تريد حذف السناب "${snapName}"؟ هذا الإجراء لا يمكن التراجع عنه.`);
                                                            if (confirmation) {
                                                                event.target.submit();
                                                            }
                                                            return false;
                                                        }

                                                    </script>


                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li>
                                    <p>لا توجد مسودات حاليًا.</p>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </main>
        <!-- Footer Fixed Button -->
        <div class="footer-fixed-btn bottom-0 bg-white">
            <a href="{{ route('c1he3f.snaps.add-snap') }}" class="btn btn-lg btn-thin btn-primary rounded-xl w-100">

                إضافة جديد</a>
        </div>
        <!-- Main Content End -->
    </div>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            console.log('Form submitted with response:', document.querySelector('input[name="response"]').value);
        });
    </script>
    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
</body>
</html>
