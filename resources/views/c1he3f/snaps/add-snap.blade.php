@extends('layouts.chef')
@section('title', 'إضافة هم هم سناب')
@section('content')

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
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">عدسة الطاهي - إضافة</h4>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <div class="container">
                <div class="container" style="max-width: 800px; margin:0px auto; padding: 20px;">

<form action="{{ route('c1he3f.snaps.store-snap') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-cookpad-gray-9gi p-6h1 upload-area" id="upload-area" style="height: 280px; width: 80%; margin: auto; border-radius: 15px;">
        <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
            <div class="text-fim">
                <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                <p class="text-x8v font-9s7 mt-mnq">أضف الفيديو الذي تريد مشاركته</p>
                <p class="text-b94 px-ql7">يجب علي الفيديو ان لا يزيد عن 60 ثانية</p>
            </div>
            <input type="file" name="video" id="fil-ttd" accept="video/*">
        </div>
    </div>

    <div id="message-container"></div>

    <div class="video-preview hidden" id="video-preview">
        <video id="preview-video" style="height: 280px;" controls>
            <source src="" type="video/mp4">
            متصفحك لا يدعم تشغيل الفيديو.
        </video>

        <div class="video-controls">
            <div class="video-info" id="video-info">
                <strong>معلومات الفيديو:</strong><br>
                <span id="video-duration"></span><br>
                <span id="video-size"></span>
            </div>

            <button type="button" class="btn btn-danger" onclick="removeVideo()">إزالة الفيديو</button>

        </div>
    </div>

    <div class="my-3">
        <input type="text" id="name" name="name" style="height: 98px; text-align: center; color: #000000;" placeholder="ماذا تريد ان تقول للمستخدمين" class="form-control" required>
    </div>

    <div class="my-3">
        <div class="form-group">
            <label for="kitchen-search" style="text-align: center; display: block; margin-bottom: 5px;">إختر المطبخ</label>
            <select class="form-control" id="kitchen-search" name="kitchen_id" style="width: 100%;">
                <option value="">إختر مطبخ</option>
                @foreach($kitchens as $kitchen)
                <option value="{{ $kitchen->id }}">{{ $kitchen->name_ar }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="mainCategorie-search" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">اختر التصنيف الرئيسي</label>
            <select class="form-control" id="mainCategorie-search" name="main_category_id" style="width: 100%;">
                <option value="">إختر التصنيف الرئيسي</option>
                @foreach($mainCategories as $mainCategorie)
                <option value="{{ $mainCategorie->id }}">{{ $mainCategorie->name_ar }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subCategory-search" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">اختر التصنيفات الفرعية</label>
            <select class="form-control" id="subCategory-search" style="width: 100%;">
                <option value="">إختر التصنيف الفرعي لإضافته</option>
            </select>
            <div id="selected-subcategories" class="selected-items-container mt-3"></div>
<div id="hidden-subcategories-inputs">
</div>
</div>


        <div class="form-group">
            <label for="recipe-search" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">إربط مع وصفة أو منتج</label>

            <select class="form-control" id="recipe-search" name="recipe_id" style="width: 100%;">
                <option value="">إختر وصفة أو منتج</option>

                @foreach($recpies as $recipe)
                <option value="{{ $recipe->id }}">{{ $recipe->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <h6 class="dz-title my-2" style="text-align: center;">اين تريد ان تحفظ الفيديو</h6>
    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
        <div class="form-check style-2">
            <input class="form-check-input" type="radio" name="status" id="filterRadio1" value="published" checked>
            <label class="form-check-label" for="filterRadio1">نشر</label>
        </div>
        <div class="form-check style-2">
            <input class="form-check-input" type="radio" name="status" id="filterRadio2" value="draft">
            <label class="form-check-label" for="filterRadio2">مسودة</label>
        </div>
    </div>
    <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">حفظ</button>
</form>
</div>

        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let selectedFile = null;
        let videoDuration = 0;

        document.getElementById('fil-ttd').addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (!file) return;

            if (!file.type.startsWith('video/')) {
                showMessage('يرجى اختيار ملف فيديو صالح', 'error');
                return;
            }

            const maxSize = 50 * 1024 * 1024;
            if (file.size > maxSize) {
                showMessage('حجم الفيديو كبير جداً. الحد الأقصى 50 ميجابايت', 'error');
                return;
            }

            selectedFile = file;
            previewVideo(file);
        });

        function previewVideo(file) {
            const video = document.getElementById('preview-video');
            const url = URL.createObjectURL(file);

            video.src = url;

            video.addEventListener('loadedmetadata', function() {
                videoDuration = video.duration;

                if (videoDuration > 60) {
                    showMessage('مدة الفيديو أكثر من 60 ثانية. يرجى اختيار فيديو أقصر', 'error');
                    removeVideo();
                    return;
                }

                updateVideoInfo(file, videoDuration);

                document.getElementById('upload-area').classList.add('hidden');
                document.getElementById('video-preview').classList.remove('hidden');

                showMessage('تم تحميل الفيديو بنجاح! يمكنك الآن مراجعته ورفعه', 'success');
            });

            video.addEventListener('error', function() {
                showMessage('حدث خطأ في تحميل الفيديو', 'error');
                removeVideo();
            });
        }

        function updateVideoInfo(file, duration) {
            const minutes = Math.floor(duration / 60);
            const seconds = Math.floor(duration % 60);
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

            document.getElementById('video-duration').textContent =
                `المدة: ${minutes}:${seconds.toString().padStart(2, '0')} دقيقة`;
            document.getElementById('video-size').textContent =
                `الحجم: ${sizeInMB} ميجابايت`;
        }

        function removeVideo() {
            selectedFile = null;
            videoDuration = 0;

            // إعادة تعيين input الملف
            document.getElementById('fil-ttd').value = '';

            // إخفاء المعاينة وإظهار منطقة الرفع
            document.getElementById('video-preview').classList.add('hidden');
            document.getElementById('upload-area').classList.remove('hidden');

            // مسح الرسائل
            document.getElementById('message-container').innerHTML = '';

            // إعادة تعيين شريط التقدم
            document.getElementById('progress-fill').style.width = '0%';
        }

        function uploadVideo() {
            if (!selectedFile) {
                showMessage('لم يتم اختيار فيديو للرفع', 'error');
                return;
            }

            // محاكاة عملية 
            simulateUpload();
        }

        function simulateUpload() {
            const progressFill = document.getElementById('progress-fill');
            let progress = 0;

            const interval = setInterval(() => {
                progress += Math.random() * 15;

                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    showMessage('تم رفع الفيديو بنجاح!', 'success');

                    // هنا يمكنك إضافة كود الرفع الفعلي للسيرفر
                    // uploadToServer(selectedFile);
                }

                progressFill.style.width = progress + '%';
            }, 200);
        }

        function showMessage(message, type) {
            const container = document.getElementById('message-container');
            const messageClass = type === 'error' ? 'error-message' : 'success-message';

            container.innerHTML = `<div class="${messageClass}">${message}</div>`;

            // إزالة الرسالة بعد 5 ثواني
            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        const uploadArea = document.getElementById('upload-area');

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#e3f2fd';
            uploadArea.style.borderColor = '#007bff';
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#f8f9fa';
            uploadArea.style.borderColor = '#dee2e6';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#f8f9fa';
            uploadArea.style.borderColor = '#dee2e6';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                document.getElementById('fil-ttd').files = files;

                // تشغيل event change يدوياً
                const event = new Event('change', {
                    bubbles: true
                });
                document.getElementById('fil-ttd').dispatchEvent(event);
            }
        });

        $(document).ready(function() {
            let selectedSubcategories = []; // مصفوفة لحفظ التصنيفات المحددة
            let allSubcategories = []; // مصفوفة لحفظ جميع التصنيفات المتاحة

            // تهيئة Select2 للتصنيف الرئيسي
            if (typeof $.fn.select2 !== 'undefined') {
                $('#mainCategorie-search').select2({
                    placeholder: "إختر التصنيف الرئيسي"
                    , allowClear: true
                });

                // تهيئة Select2 للتصنيف الفرعي
                $('#subCategory-search').select2({
                    placeholder: "إختر التصنيف الفرعي لإضافته"
                    , allowClear: true
                    , dir: "rtl"
                });
            }

            // عند تغيير التصنيف الرئيسي
            $('#mainCategorie-search').on('change', function() {
                var mainCategoryId = $(this).val();

                // مسح التصنيفات الحالية
                clearAllSubcategories();
                updateSubcategoryDropdown([]);

                if (mainCategoryId && mainCategoryId !== "") {
                    loadSubcategories(mainCategoryId);
                }
            });

            // عند اختيار تصنيف فرعي من القائمة
            $('#subCategory-search').on('change', function() {
                var selectedId = $(this).val();
                var selectedText = $(this).find('option:selected').text();

                if (selectedId && selectedId !== "") {
                    addSubcategory(selectedId, selectedText);
                    $(this).val('').trigger('change'); // إعادة تعيين القائمة
                }
            });

            // دالة تحميل التصنيفات الفرعية
            function loadSubcategories(mainCategoryId) {
                var ajaxUrl = '/c1he3f/get-subcategories/' + mainCategoryId;

                // إضافة مؤشر التحميل
                $('#subCategory-search').html('<option value="">جاري التحميل... <span class="loading-indicator"></span></option>');

                $.ajax({
                    url: ajaxUrl
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        allSubcategories = data || [];
                        updateSubcategoryDropdown(allSubcategories);
                    }
                    , error: function(jqXHR, textStatus, errorThrown) {
                        console.error("خطأ في AJAX:", textStatus, errorThrown);
                        $('#subCategory-search').html('<option value="">حدث خطأ في التحميل</option>');
                        alert("حدث خطأ أثناء جلب التصنيفات الفرعية.");
                    }
                });
            }

            // دالة تحديث القائمة المنسدلة
            function updateSubcategoryDropdown(subcategories) {
                var dropdown = $('#subCategory-search');
                dropdown.empty();

                if (subcategories.length === 0) {
                    dropdown.append('<option value="">لا توجد تصنيفات فرعية</option>');
                } else {
                    dropdown.append('<option value="">إختر التصنيف الفرعي لإضافته</option>');

                    // إضافة التصنيفات غير المحددة فقط
                    subcategories.forEach(function(subcategory) {
                        if (!isSubcategorySelected(subcategory.id)) {
                            dropdown.append('<option value="' + subcategory.id + '">' + subcategory.name_ar + '</option>');
                        }
                    });
                }

                // إعادة تهيئة Select2
                if (typeof $.fn.select2 !== 'undefined') {
                    dropdown.select2('destroy').select2({
                        placeholder: "إختر التصنيف الفرعي لإضافته"
                        , allowClear: true
                        , dir: "rtl"
                    });
                }
            }

            // دالة إضافة تصنيف فرعي
            function addSubcategory(id, name) {
                // التحقق من عدم وجود التصنيف مسبقاً
                if (isSubcategorySelected(id)) {
                    showNotification('هذا التصنيف مُضاف بالفعل!', 'warning');
                    return;
                }

                // إضافة التصنيف للمصفوفة
                selectedSubcategories.push({
                    id: id
                    , name: name
                });

                // تحديث العرض
                renderSelectedSubcategories();
                updateSubcategoryDropdown(allSubcategories);
                updateHiddenInput();

                showNotification('تم إضافة التصنيف: ' + name, 'success');
            }

            // دالة حذف تصنيف فرعي
            function removeSubcategory(id) {
                var subcategory = selectedSubcategories.find(item => item.id == id);

                // إضافة animation للحذف
                var element = $('[data-subcategory-id="' + id + '"]');
                element.addClass('removing');

                setTimeout(function() {
                    // حذف من المصفوفة
                    selectedSubcategories = selectedSubcategories.filter(item => item.id != id);

                    // تحديث العرض
                    renderSelectedSubcategories();
                    updateSubcategoryDropdown(allSubcategories);
                    updateHiddenInput();

                    if (subcategory) {
                        showNotification('تم حذف التصنيف: ' + subcategory.name, 'info');
                    }
                }, 300);
            }

            // دالة عرض التصنيفات المحددة
            function renderSelectedSubcategories() {
                var container = $('#selected-subcategories');
                container.empty();

                if (selectedSubcategories.length === 0) {
                    container.addClass('empty');
                    return;
                }

                container.removeClass('empty');

                // إضافة عداد
                var counter = $('<span class="subcategory-counter">' + selectedSubcategories.length + ' تصنيف محدد</span>');
                container.append(counter);

                // إضافة التصنيفات
                selectedSubcategories.forEach(function(subcategory) {
                    var item = $(`
                <div class="selected-item" data-subcategory-id="${subcategory.id}">
                    <span>${subcategory.name}</span>
                    <button type="button" class="remove-btn" onclick="removeSubcategoryById(${subcategory.id})">
                        ×
                    </button>
                </div>
            `);
                    container.append(item);
                });
            }

            // دالة مساعدة للتحقق من وجود التصنيف
            function isSubcategorySelected(id) {
                return selectedSubcategories.some(item => item.id == id);
            }

            // دالة تحديث الـ input المخفي
            // دالة تحديث الـ input المخفي
// In your document.ready function or globally if preferred
function updateHiddenInput() {
var container = $('#hidden-subcategories-inputs');
container.empty(); // Clear existing hidden inputs

selectedSubcategories.forEach(function(item) {
// Create a new hidden input for each selected subcategory
container.append('<input type="hidden" name="subCategory_ids[]" value="' + item.id + '">');
});
}


            // دالة مسح جميع التصنيفات
            function clearAllSubcategories() {
                selectedSubcategories = [];
                renderSelectedSubcategories();
                updateHiddenInput();
            }

            // دالة عرض الإشعارات
            function showNotification(message, type) {
                // يمكنك استخدام أي نظام إشعارات تفضله
                console.log(type.toUpperCase() + ': ' + message);

                // مثال بسيط للإشعار
                var alertClass = type === 'success' ? 'alert-success' :
                    type === 'warning' ? 'alert-warning' :
                    type === 'info' ? 'alert-info' : 'alert-primary';

                var notification = $(`
            <div class="alert ${alertClass} alert-dismissible fade show notification-toast" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);

                $('body').append(notification);

                // إزالة الإشعار تلقائياً بعد 3 ثواني
                setTimeout(function() {
                    notification.fadeOut(function() {
                        $(this).remove();
                    });
                }, 3000);
            }

            // دالة عامة لحذف التصنيف (للاستخدام في onclick)
            window.removeSubcategoryById = function(id) {
                removeSubcategory(id);
            };

            // دالة للحصول على التصنيفات المحددة (للاستخدام الخارجي)
            window.getSelectedSubcategories = function() {
                return selectedSubcategories;
            };

            // مثال على كيفية استخدام البيانات عند الإرسال
            $('form').on('submit', function(e) {
                if (selectedSubcategories.length === 0) {
                    // يمكنك إضافة تحقق هنا إذا كان التصنيف الفرعي مطلوب
                    // e.preventDefault();
                    // alert('يرجى اختيار تصنيف فرعي واحد على الأقل');
                    // return false;
                }

                console.log('التصنيفات المحددة للإرسال:', selectedSubcategories);
            });
        });

    </script>
</body>

@endsection
