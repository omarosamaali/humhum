@extends('layouts.chef')
@section('title', 'إضافة هم هم سناب')
@section('content')
<style>
    /* أضف هذه الأنماط إلى الـ CSS الموجود */

    .message-container {
        margin: 15px 0;
        text-align: center;
        min-height: 20px;
        /* لضمان وجود مساحة للرسائل */
        position: relative;
        z-index: 10;
    }

    .loading-message {
        color: #004085;
        background-color: #cce5ff;
        border: 1px solid #b8daff;
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        position: relative;
        animation: fadeIn 0.3s ease-in;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .error-message {
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        padding: 12px;
        border-radius: 8px;
        display: flex !important;
        justify-content: space-between;
        font-weight: 500;
        position: relative;
        animation: fadeIn 0.3s ease-in;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .success-message {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        position: relative;
        animation: fadeIn 0.3s ease-in;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* زر الإغلاق */
    .error-message button,
    .success-message button {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        padding: 2px 8px;
        margin-left: 10px;
        border-radius: 50%;
        transition: background-color 0.2s;
    }

    .error-message button:hover {
        background-color: rgba(114, 28, 36, 0.1);
    }

    .success-message button:hover {
        background-color: rgba(21, 87, 36, 0.1);
    }

    /* تأثير الظهور */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* تحسينات للتصنيفات الفرعية */
    .selected-items-container {
        margin-top: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        min-height: 20px;
    }

    .selected-items-container.empty {
        display: none;
    }

    .subcategory-counter {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #495057;
        font-size: 14px;
    }

    .selected-item {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 6px 12px;
        margin: 4px;
        border-radius: 20px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .selected-item.removing {
        opacity: 0;
        transform: scale(0.8);
    }

    .selected-item .remove-btn {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        margin-left: 8px;
        cursor: pointer;
        padding: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s;
    }

    .selected-item .remove-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* تحسينات شريط التقدم */
    .progress-bar {
        width: 100%;
        height: 12px;
        background-color: #f0f0f0;
        border-radius: 6px;
        overflow: hidden;
        margin: 15px 0;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .progress-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #007bff, #0056b3);
        transition: width 0.3s ease;
        border-radius: 6px;
    }

    /* إخفاء العناصر */
    .hidden {
        display: none !important;
    }

    /* تحسينات منطقة الرفع */
    .upload-area {
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: #f8f9fa;
    }

    .upload-area:hover {
        background-color: #e9ecef;
        border-color: #007bff;
    }

    /* تحسينات معاينة الفيديو */
    .video-preview {
        margin: 20px 0;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }

    .video-controls {
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .video-info {
        flex: 1;
        min-width: 200px;
    }

    .video-controls .btn {
        flex-shrink: 0;
    }

    /* تحسينات الاستجابة للأجهزة المحمولة */
    @media (max-width: 768px) {
        .video-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .video-info {
            text-align: center;
            margin-bottom: 10px;
        }

        .selected-item {
            display: block;
            margin: 5px 0;
            text-align: center;
        }

        .message-container {
            margin: 10px 0;
        }
    }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<body class="bg-light">
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status"> <span class="visually-hidden">Loading...</span> </div>
            </div>
        </div>
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content"> <a href="javascript:void(0);" class="back-btn"> <i class="feather icon-arrow-left"></i> </a> </div>
                <div class="mid-content">
                    <h4 class="title">عدسة الطاهي - إضافة</h4>
                </div>
            </div>
        </header>
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <div class="container">
                <div class="container" style="max-width: 800px; margin:0px auto; padding: 20px;">
                    <form action="{{ route('c1he3f.snaps.store-snap') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                        @csrf
                        <div class="bg-cookpad-gray-9gi p-6h1 upload-area" id="upload-area" style="height: 280px; width: 80%; margin: auto; border-radius: 15px; border: 2px dashed #dee2e6;">
                            <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                                <div class="text-fim">
                                    <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                    <p class="text-x8v font-9s7 mt-mnq">أضف الفيديو الذي تريد مشاركته</p>
                                    <p class="text-b94 px-ql7">يجب علي الفيديو ان لا يزيد عن 60 ثانية</p>
                                </div>
                                <input type="file" name="video" id="fil-ttd" accept="video/*" style="display: none;">
                            </div>
                        </div>
                        <div id="message-container"></div>
                        <div class="progress-bar hidden" id="progress-bar">
                            <div class="progress-fill" id="progress-fill"></div>
                        </div>
                        <div class="video-preview hidden" id="video-preview">
                            <video id="preview-video" style="height: 280px; width: 100%;" controls>
                                <source src="" type="video/mp4"> متصفحك لا يدعم تشغيل الفيديو.
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
                                <div id="hidden-subcategories-inputs"></div>
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
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // استبدال الكود الموجود في الـ script tag

        let selectedFile = null;
        let videoDuration = 0;

        function showMessage(message, type) {
            console.log(`إظهار رسالة في الـ UI: ${message} (النوع: ${type})`);
            const container = document.getElementById('message-container');
            if (!container) {
                console.error('خطأ: عنصر message-container غير موجود في الـ DOM');
                alert(message); // Fallback to alert if container is not found
                return;
            }

            const messageClass = type === 'error' ? 'error-message' :
                type === 'success' ? 'success-message' : 'loading-message';

            container.innerHTML = ''; // Clear previous messages
            container.innerHTML = `
<div class="${messageClass}" style="display: block;">
    ${message}
    ${type !== 'loading' ? '<button onclick="this.parentElement.remove()" style="margin-left: 10px; border: none; background: none; cursor: pointer;">✖</button>' : ''}
</div>`;

            // Ensure container is visible
            container.style.display = 'block';
            container.style.visibility = 'visible';

            // Auto-hide success messages after 5 seconds
            if (type === 'success') {
                setTimeout(() => {
                    const messageElement = container.querySelector('.success-message');
                    if (messageElement) {
                        messageElement.remove();
                    }
                }, 5000);
            }

            console.log('تم إضافة الرسالة إلى message-container:', container.innerHTML);
        }

        function updateVideoInfo(file, duration) {
            const minutes = Math.floor(duration / 60);
            const seconds = Math.floor(duration % 60);
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

            document.getElementById('video-duration').textContent = `المدة: ${minutes}:${seconds.toString().padStart(2, '0')} دقيقة`;
            document.getElementById('video-size').textContent = `الحجم: ${sizeInMB} ميجابايت`;
        }

        function removeVideo() {
            selectedFile = null;
            videoDuration = 0;
            document.getElementById('fil-ttd').value = '';
            document.getElementById('video-preview').classList.add('hidden');
            document.getElementById('upload-area').classList.remove('hidden');

            const messageContainer = document.getElementById('message-container');
            if (messageContainer) {
                messageContainer.innerHTML = '';
                messageContainer.style.display = 'none';
            }

            document.getElementById('progress-bar').classList.add('hidden');
            document.getElementById('progress-fill').style.width = '0%';
            console.log('حالة: تم إزالة الفيديو وإعادة تعيين النموذج');
        }

        // معالج تحديد الملف
        document.getElementById('fil-ttd').addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (!file) {
                console.log('حالة الخطأ: لم يتم اختيار ملف');
                showMessage('يرجى اختيار ملف فيديو', 'error');
                return;
            }

            // التحقق من نوع الملف
            if (!file.type.startsWith('video/')) {
                console.log('حالة الخطأ: الملف ليس فيديو صالح');
                showMessage('يرجى اختيار ملف فيديو صالح', 'error');
                this.value = ''; // مسح الاختيار
                return;
            }

            // التحقق من حجم الملف (50 ميجابايت)
            const maxSize = 50 * 1024 * 1024;
            if (file.size > maxSize) {
                console.log('حالة الخطأ: حجم الفيديو أكبر من 50 ميجابايت');
                showMessage('حجم الفيديو يجب أن يكون أقل من 50 ميجابايت', 'error');
                this.value = ''; // مسح الاختيار
                return;
            }

            selectedFile = file;
            console.log('حالة النجاح: تم اختيار فيديو صالح، جاري المعاينة');
            previewVideo(file);
        });

function previewVideo(file) {
    const video = document.getElementById('preview-video');
    const url = URL.createObjectURL(file);
    video.src = url;
    video.addEventListener('loadedmetadata', function() {
        videoDuration = video.duration;
        if (videoDuration > 60) {
            console.log('حالة الخطأ: مدة الفيديو أكثر من 60 ثانية');
            showMessage('مدة الفيديو أكثر من 60 ثانية', 'error');
            // Remove the call to removeVideo() here
            // removeVideo(); // <--- REMOVE THIS LINE
            return; // Stop further processing
        }
        updateVideoInfo(file, videoDuration);
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('video-preview').classList.remove('hidden');
        document.getElementById('progress-bar').classList.add('hidden');
        console.log('حالة النجاح: تم تحميل الفيديو للمعاينة بنجاح، المدة:', videoDuration, 'ثانية');
        showMessage('تم تحميل الفيديو بنجاح! يمكنك الآن مراجعته ورفعه', 'success');
    });
    video.addEventListener('error', function() {
        console.log('حالة الخطأ: فشل تحميل الفيديو');
        showMessage('فشل تحميل الفيديو', 'error');
        removeVideo(); // Keep this here as it's a critical loading error
    });
}        // معالج إرسال النموذج
        document.getElementById('upload-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // التحقق من اختيار الفيديو
            if (!selectedFile) {
                console.log('حالة الخطأ: لم يتم اختيار فيديو للرفع');
                showMessage('يرجى اختيار فيديو للرفع', 'error');
                return;
            }

            // التحقق من مدة الفيديو مرة أخرى
            if (videoDuration > 60) {
                console.log('حالة الخطأ: مدة الفيديو أكثر من 60 ثانية');
                showMessage('مدة الفيديو يجب أن تكون 60 ثانية أو أقل', 'error');
                return;
            }

            // التحقق من الحقول المطلوبة
            const name = document.getElementById('name').value.trim();
            if (!name) {
                showMessage('يرجى إدخال وصف للفيديو', 'error');
                return;
            }

            // بدء عملية الرفع
            document.getElementById('progress-bar').classList.remove('hidden');
            console.log('حالة: جاري رفع الفيديو');
            showMessage('جاري رفع الفيديو...', 'loading');

            const formData = new FormData(this);

            $.ajax({
                url: this.action
                , type: 'POST'
                , data: formData
                , processData: false
                , contentType: false
                , xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            const percentComplete = (evt.loaded / evt.total) * 100;
                            console.log('حالة التقدم: ', percentComplete.toFixed(2) + '%');
                            document.getElementById('progress-fill').style.width = percentComplete + '%';
                        }
                    }, false);
                    return xhr;
                }
                , success: function(response) {
                    console.log('حالة النجاح: تم رفع الفيديو بنجاح', response);
                    showMessage('تم رفع الفيديو بنجاح!', 'success');

                    // إعادة تعيين النموذج
                    document.getElementById('upload-form').reset();
                    removeVideo();

                    // إعادة تعيين الحقول المخصصة
                    $('#kitchen-search').val('').trigger('change');
                    $('#mainCategorie-search').val('').trigger('change');
                    $('#recipe-search').val('').trigger('change');
                }
                , error: function(xhr) {
                    console.log('حالة الخطأ: فشل رفع الفيديو', xhr.responseJSON || xhr);

                    let errorMessage = 'حدث خطأ أثناء رفع الفيديو';

                    // محاولة استخراج رسالة الخطأ من الاستجابة
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // إذا كانت هناك أخطاء في التحقق
                        const errors = xhr.responseJSON.errors;
                        const errorMessages = [];

                        for (const field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                errorMessages.push(errors[field][0]);
                            }
                        }

                        if (errorMessages.length > 0) {
                            errorMessage = errorMessages.join(', ');
                        }
                    }

                    showMessage(errorMessage, 'error');
                    document.getElementById('progress-bar').classList.add('hidden');
                }
            });
        });

        // باقي الكود لمعالجة السحب والإسقاط
        const uploadArea = document.getElementById('upload-area');

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '#e3f2fd';
            uploadArea.style.borderColor = '#007bff';
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '';
            uploadArea.style.borderColor = '';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.style.backgroundColor = '';
            uploadArea.style.borderColor = '';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                // محاكاة اختيار الملف
                const fileInput = document.getElementById('fil-ttd');
                fileInput.files = files;

                // تشغيل حدث التغيير
                const event = new Event('change', {
                    bubbles: true
                });
                fileInput.dispatchEvent(event);
            }
        });

        uploadArea.addEventListener('click', function() {
            document.getElementById('fil-ttd').click();
        });

    </script>
</body>
@endsection
