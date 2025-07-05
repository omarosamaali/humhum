<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Title -->
    <title>{{ $recipe->title }} | وصفة</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="وصفة, مطبخ, {{ $recipe->main_category->name_ar ?? '' }}, {{ $recipe->title }}">
    <meta name="description"
        content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta property="og:title" content="{{ $recipe->title }} | وصفة">
    <meta property="og:description"
        content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta property="og:image"
        content="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : asset('assets/images/social-image.png') }}">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:title" content="{{ $recipe->title }} | وصفة">
    <meta name="twitter:description"
        content="{{ Str::limit($recipe->title, 100) }} - اكتشف وصفة {{ $recipe->main_category->name_ar ?? '' }} الرائعة مع تفاصيل المكونات والخطوات.">
    <meta name="twitter:image"
        content="{{ $recipe->dish_image ? asset('storage/' . $recipe->dish_image) : asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
</head>
<style>
    /* Your custom styles from ingredients.blade.php should be copied here */
    /* Example: */
    .step-item {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        display: flex;
        flex-wrap: wrap;
        /* Allow items to wrap on smaller screens */
        align-items: center;
        gap: 10px;
    }

    .step-item .handle {
        cursor: grab;
        padding: 5px;
        margin-right: 10px;
        color: #6c757d;
    }

    .step-item .flex-grow-1 {
        flex-grow: 1;
    }

    .step-text {
        flex-grow: 1;
        /* Allow text input to take available space */
        min-width: 200px;
        /* Ensure it doesn't get too small */
    }

    .char-counter {
        font-size: 0.8em;
        color: #6c757d;
        text-align: end;
        display: block;
        width: 100%;
        /* Take full width below input */
    }

    .btn-group.step-buttons {
        margin-top: 10px;
    }

    .remove-step-btn {
        background-color: #e00000;
        color: white;
        border: none;
    }

    .remove-step-btn:hover {
        background-color: #c82333;
    }

    .footer-fixed-btn {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        padding: 10px 20px;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transform: unset !important;

    }

    .page-content {
        padding-bottom: 70px;
        padding-top: 25px !important;
        /* To prevent content from being hidden by fixed footer */
    }

    .alert {
        margin-top: 20px;
    }

    /* Styles for media previews */
    .media-previews {
        width: 100%;
        /* Take full width for better layout */
    }

    .multiple-media-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .media-item {
        position: relative;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 5px;
        background-color: #fff;
    }

    .media-item img,
    .media-item video {
        width: 130px;
        max-height: 100px;
        object-fit: unset !important;
        border-radius: 3px;
        display: block;
        /* Remove extra space below images/videos */
    }

    .step-number-indicator {
        text-align: center;
        display: block;
        width: fit-content;
        color: white;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        margin: auto;
        padding: 5px 10px;
        margin-bottom: 10px;
        background-color: #e00000;
    }

    .remove-single-media {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #e00000;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        padding: 0;
        font-size: 0.9em;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
</style>
</head>

<body>
    <header class="header header-fixed border-bottom">
        <div class="header-content">
            <div class="mid-content">
                <h4 class="title">الخطوات </h4>
            </div>
            <div class="left-content">
                <a href="javascript:history.back()" class="back-btn">

                    <i class="feather icon-arrow-left"></i>
                </a>
            </div>
        </div>
    </header>

    
    <div class="container mt-5 page-content">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

<form id="stepsForm" action="{{ route('c1he3f.recpies.updateSteps', $recipe->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <main class="page-content space-top p-b100">
        <div class="col-md-12 mb-3">
            <label class="form-label">خطوات التحضير</label>
            <div id="steps-container"></div>
            <button type="button" style="color: white; width: 100%; background-color: #e00000 !important; border: #e00000;" id="add-step-btn" class="btn add-ingredient-btn">
                <i class="fas fa-plus-circle ms-1"></i> أضف خطوة
            </button>
        </div>
    </main>
    <input type="hidden" name="steps_data" id="steps_data">
</form>    </div>

    <div class="footer-fixed-btn">
        <button type="submit" form="stepsForm" class="btn btn-success w-100"
            style="background-color: #e00000 !important; border: #e00000;">
            <i class="fas fa-save"></i> حفظ الخطوات
        </button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
const MAX_CHARS_STEP = 500;
let stepFileInputCounter = 0;

function createStepItem(stepData = { description: '', media: [] }) {
    const index = document.querySelectorAll('#steps-container .step-item').length;
    stepFileInputCounter = Math.max(stepFileInputCounter, index + 1);

    const existingMediaHtml = stepData.media.map(media => {
        const mediaSrc = media.url || `{{ Storage::url('') }}${media.path}`;
        return `
            <div class="media-item" data-media-url="${media.url || ''}" data-media-path="${media.path || ''}" data-media-type="${media.type || ''}" style="position: relative;">
                ${media.type === 'image' ?
                    `<img src="${mediaSrc}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;">` :
                    `<video src="${mediaSrc}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video>`
                }
                <button type="button" class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
            </div>`;
    }).join('');

    const itemHtml = `
        <div class="step-item" data-step-index="${index}">
            <span class="step-number-indicator">الخطوة ${index + 1}</span>
            <input type="text" class="form-control step-text" value="${stepData.description}" placeholder="ادخل وصف الخطوة" maxlength="${MAX_CHARS_STEP}" required>
            <span class="char-counter">متبقي: ${MAX_CHARS_STEP - stepData.description.length} حرف</span>
            <div class="btn-group order-buttons" role="group" style="flex-direction: row-reverse; margin-top: 10px; margin-bottom: 10px;">
                <button type="button" class="btn btn-sm btn-outline-secondary move-up-btn" title="تحريك لأعلى"><i class="fas fa-arrow-up"></i></button>
                <button type="button" class="btn btn-sm btn-outline-secondary move-down-btn" title="تحريك لأسفل"><i class="fas fa-arrow-down"></i></button>
            </div>
            <button type="button" class="btn btn-sm remove-step-btn" title="حذف الخطوة"><i class="fas fa-times"></i></button>
            <div class="step-media-section">
                <input type="file" class="upload-input-hidden step-media-input" name="step_media[${index}][]" id="media_${index}" accept="image/*,video/*" multiple data-step-index="${index}" style="display: none;">
                <label for="media_${index}" class="btn btn-info file-upload-label add-media-btn">
                    <i class="fas fa-plus-square ms-1"></i> أضف صورة / فيديو
                </label>
                <div class="media-previews">
                    <div class="multiple-media-previews" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; ${stepData.media.length > 0 ? '' : 'display: none;'}">
                        ${existingMediaHtml}
                    </div>
                </div>
                <div class="step-media-actions" style="display: ${stepData.media.length > 0 ? 'flex' : 'none'}; gap: 5px; margin-top: 10px; margin-bottom: 10px;">
                    <button type="button" class="btn btn-sm btn-primary add-more-media-btn">رفع المزيد</button>
                    <button type="button" class="btn btn-sm btn-danger clear-all-media-btn">مسح الكل</button>
                </div>
            </div>
        </div>
    `;

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = itemHtml.trim();
    const newItem = tempDiv.firstChild;

    document.getElementById('steps-container').appendChild(newItem);

    setupStepItemEventListeners(newItem);
    updateStepNumbers();
}

function setupStepItemEventListeners(stepItem) {
    const stepText = stepItem.querySelector('.step-text');
    const charCounter = stepItem.querySelector('.char-counter');
    const mediaInput = stepItem.querySelector('.step-media-input');
    const multiplePreviews = stepItem.querySelector('.multiple-media-previews');
    const mediaActions = stepItem.querySelector('.step-media-actions');
    const addMoreMediaBtn = stepItem.querySelector('.add-more-media-btn');
    const clearAllMediaBtn = stepItem.querySelector('.clear-all-media-btn');
    const moveUpBtn = stepItem.querySelector('.move-up-btn');
    const moveDownBtn = stepItem.querySelector('.move-down-btn');
    const removeStepBtn = stepItem.querySelector('.remove-step-btn');

    function updateCharCounter() {
        const remaining = MAX_CHARS_STEP - stepText.value.length;
        charCounter.textContent = `متبقي: ${remaining} حرف`;
        if (stepText.value.length > 0 || remaining !== MAX_CHARS_STEP) {
            charCounter.classList.add('visible');
        } else {
            charCounter.classList.remove('visible');
        }
    }
    stepText.addEventListener('input', updateCharCounter);
    updateCharCounter();

    addMoreMediaBtn.addEventListener('click', () => mediaInput.click());

    mediaInput.addEventListener('change', (event) => {
        const files = event.target.files;
        console.log('Selected files:', Array.from(files).map(file => ({
            name: file.name,
            type: file.type,
            size: file.size
        })));
        if (files.length > 0) {
            mediaActions.style.display = 'flex';
            multiplePreviews.style.display = 'flex';
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const mediaType = file.type.startsWith('image/') ? 'image' : 'video';
                    const mediaPreviewHtml = `
                        <div class="media-item" data-media-type="${mediaType}" data-media-url="${e.target.result}" style="position: relative;">
                            ${mediaType === 'image' ?
                                `<img src="${e.target.result}" style="max-width: 100px; max-height: 80px; object-fit: contain; border-radius: 5px;">` :
                                `<video src="${e.target.result}" controls style="max-width: 150px; max-height: 100px; border-radius: 5px;"></video>`
                            }
                            <button type="button" class="btn btn-sm btn-danger remove-single-media" style="position: absolute; top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0;">×</button>
                        </div>`;
                    multiplePreviews.insertAdjacentHTML('beforeend', mediaPreviewHtml);
                    setupRemoveSingleMediaListeners(stepItem);
                };
                reader.readAsDataURL(file);
            });
        }
    });

    clearAllMediaBtn.addEventListener('click', () => {
        multiplePreviews.innerHTML = '';
        mediaActions.style.display = 'none';
        multiplePreviews.style.display = 'none';
        mediaInput.value = '';
    });

    moveUpBtn.addEventListener('click', () => {
        const prevItem = stepItem.previousElementSibling;
        if (prevItem && prevItem.classList.contains('step-item')) {
            stepItem.parentNode.insertBefore(stepItem, prevItem);
            updateStepNumbers();
        }
    });

    moveDownBtn.addEventListener('click', () => {
        const nextItem = stepItem.nextElementSibling;
        if (nextItem && nextItem.classList.contains('step-item')) {
            stepItem.parentNode.insertBefore(nextItem, stepItem);
            updateStepNumbers();
        }
    });

    removeStepBtn.addEventListener('click', () => {
        stepItem.remove();
        updateStepNumbers();
        if (document.querySelectorAll('#steps-container .step-item').length === 0) {
            createStepItem();
        }
    });

    setupRemoveSingleMediaListeners(stepItem);
}

function setupRemoveSingleMediaListeners(stepItem) {
    stepItem.querySelectorAll('.remove-single-media').forEach(btn => {
        btn.onclick = null;
        btn.addEventListener('click', (e) => {
            const mediaItem = e.target.closest('.media-item');
            if (mediaItem) {
                mediaItem.remove();
                const mediaItems = stepItem.querySelectorAll('.media-item');
                if (mediaItems.length === 0) {
                    stepItem.querySelector('.step-media-actions').style.display = 'none';
                    stepItem.querySelector('.multiple-media-previews').style.display = 'none';
                    const mediaInput = stepItem.querySelector('.step-media-input');
                    mediaInput.value = '';
                }
            }
        });
    });
}

function updateStepNumbers() {
    document.querySelectorAll('#steps-container .step-item').forEach((item, index) => {
        item.querySelector('.step-number-indicator').textContent = `الخطوة ${index + 1}`;
        item.setAttribute('data-step-index', index);
        item.querySelector('.step-text').setAttribute('name', `steps[${index}][description]`);
        const mediaInput = item.querySelector('.step-media-input');
        mediaInput.setAttribute('name', `step_media[${index}][]`);
        const newId = `media_${index}`;
        mediaInput.setAttribute('id', newId);
        item.querySelector('.add-media-btn').setAttribute('for', newId);
    });
}

document.querySelector('#stepsForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default submission for debugging
    const formData = new FormData(this);
    console.log('Form data:', Array.from(formData.entries()));
    const steps = [];
    document.querySelectorAll('#steps-container .step-item').forEach(item => {
        const description = item.querySelector('.step-text').value.trim();
        const media = [];
        item.querySelectorAll('.media-item').forEach(mediaItem => {
            const mediaPath = mediaItem.dataset.mediaPath;
            const mediaType = mediaItem.dataset.mediaType;
            const mediaUrl = mediaItem.dataset.mediaUrl;
            if (mediaPath) {
                media.push({
                    path: mediaPath,
                    url: mediaUrl,
                    type: mediaType
                });
            }
        });
        if (description || media.length > 0 || item.querySelector('.step-media-input').files.length > 0) {
            steps.push({
                description: description,
                media: media
            });
        }
    });
    document.getElementById('steps_data').value = JSON.stringify(steps);
    this.submit(); // Submit the form after setting steps_data
});

document.addEventListener('DOMContentLoaded', () => {
    const addStepBtn = document.getElementById('add-step-btn');
    addStepBtn.addEventListener('click', () => createStepItem());
    const initialStepsData = @json($stepsData ?? []);
    if (initialStepsData.length > 0) {
        initialStepsData.forEach(step => createStepItem(step));
    } else {
        createStepItem();
    }
});
</script></body>

</html>
