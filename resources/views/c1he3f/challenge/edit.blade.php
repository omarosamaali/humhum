@extends('layouts.chef')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    /* Your existing styles... */
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

    .visible {
        display: block;
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
                    <a href="{{ url()->previous() ?: route('home') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">تعديل تحدي</h4>
                </div>
            </div>
        </header>

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

        <form action="{{ route('challenge.update', $challenge->id) }}" method="POST" enctype="multipart/form-data" id="challengeForm">
            @csrf
            @method('PUT')
            <main class="page-content space-top p-b100" style="direction: rtl;">
                <div class="container">
                    <div class="bg-cookpad-gray-9gi p-6h1" style="height: 40vh; width: 80%; margin: auto; border-radius: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                        @php
                        $filePath = $challenge->announcement_path;
                        $fullPublicPath = null;
                        $isImage = false;
                        $isVideo = false;

                        if ($filePath && Storage::disk('public')->exists($filePath)) {
                        $fullPublicPath = asset('storage/' . $filePath);
                        try {
                        $mimeType = Storage::disk('public')->mimeType($filePath);
                        if (Str::startsWith($mimeType, 'video/')) {
                        $isVideo = true;
                        } elseif (Str::startsWith($mimeType, 'image/')) {
                        $isImage = true;
                        }
                        } catch (\Exception $e) {
                        // Log the error if necessary
                        }
                        }
                        @endphp

                        <div class="image-preview-area" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                            @if($fullPublicPath)
                            @if($isVideo)
                            <video controls style="max-width: 100%; max-height: 100%; border-radius: 15px; object-fit: contain;">
                                <source src="{{ $fullPublicPath }}" type="{{ $mimeType ?? 'video/mp4' }}">
                                متصفحك لا يدعم الفيديو.
                            </video>
                            @elseif($isImage)
                            <img src="{{ $fullPublicPath }}" alt="صورة التحدي" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 15px;">
                            @else
                            <p class="text-x8v font-9s7 mt-mnq" style="text-align: center;">ملف الإعلان موجود، ولكن لا يمكن عرضه (نوع غير مدعوم).</p>
                            @endif
                            <p class="text-x8v font-9s7 mt-mnq" style="position: absolute; bottom: 30px; width: 100%; text-align: center;">لتغيير الملف، اختر ملفًا جديدًا.</p>
                            @else
                            <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                            <p class="text-x8v font-9s7 mt-mnq" style="text-align: center;">أضف الإعلان عن التحدي</p>
                            @endif
                            <p class="text-b94 px-ql7" style="position: absolute; bottom: 5px; width: 100%; text-align: center; color: gray; font-size: 0.8em;">يجب أن يكون حجم الملف أقل من 50 ميجابايت (الفيديو لا يزيد عن 60 ثانية).</p>
                            <input type="file" name="file" id="fil-ttd" accept="video/*,image/*" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                        </div>
                        @error('file')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        {{-- Changed name from 'name' to 'message' to match database and controller validation --}}
                        <input type="text" name="message" id="message" value="{{ old('message', $challenge->message) }}" style="height: 98px; text-align: center; color: #000000;" placeholder="ماذا تريد ان تقول للمستخدمين" class="form-control" required>
                        @error('message')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="dz-title my-2" style="text-align: center;">تاريخ التحدي</h6>
                    <div class="row" id="contentArea">
                        <div class="col-12" style="display: flex; gap: 10px;">
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialDatePicker">تاريخ البدء</label>
                                {{-- Changed name from 'bsMaterialDatePicker' to 'start_date' to match controller validation --}}
                                <input type="text" name="start_date" id="bsMaterialDatePicker" class="form-control" placeholder="اختر التاريخ" readonly required value="{{ old('start_date', $challenge->start_date) }}">
                                @error('start_date')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialTimePicker">وقت البدء</label>
                                {{-- Changed name from 'bsMaterialTimePicker' to 'start_time' to match controller validation --}}
                                <input type="text" name="start_time" id="bsMaterialTimePicker" class="form-control" placeholder="اختر الوقت" readonly required value="{{ old('start_time', \Carbon\Carbon::parse($challenge->start_time)->format('H:i')) }}">
                                @error('start_time')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12" style="display: flex; gap: 10px;">
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialDatePicker1">تاريخ الانتهاء</label>
                                {{-- Changed name from 'bsMaterialDatePicker1' to 'end_date' to match controller validation --}}
                                <input type="text" name="end_date" id="bsMaterialDatePicker1" class="form-control" placeholder="اختر التاريخ" readonly required value="{{ old('end_date', $challenge->end_date) }}">
                                @error('end_date')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label class="dz-title my-2" style="text-align: center;" for="bsMaterialTimePicker1">وقت الانتهاء</label>
                                {{-- Changed name from 'bsMaterialTimePicker1' to 'end_time' to match controller validation --}}
                                <input type="text" name="end_time" id="bsMaterialTimePicker1" class="form-control" placeholder="اختر الوقت" readonly required value="{{ old('end_time', \Carbon\Carbon::parse($challenge->end_time)->format('H:i')) }}">
                                @error('end_time')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="recipe-select" style="text-align: center; display: block; margin-bottom: 5px; margin-top: 15px;">اختر الوصفة</label>
                        <div class="form-group">
                            {{-- Ensured name is 'recipe_id' for consistency with validation --}}
                            <select class="form-control" style="text-align: center;" id="recipe-select" name="recipe_id">
                                <option value="">إختر الوصفة</option>
                                @foreach($recipes as $recipe)
                                <option value="{{ $recipe->id }}" @if(old('recipe_id', $challenge->recipe_id) == $recipe->id) selected @endif>
                                    {{ $recipe->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('recipe_id')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{-- Price input visibility is controlled by JS. Initial state is set by Blade based on if a recipe is selected or a price exists. --}}
                            <input type="number" step="0.01" style="margin-top: 10px;" name="price" id="price" class="form-control {{ (old('recipe_id', $challenge->recipe_id) || (isset($challenge) && $challenge->price !== null)) ? 'visible' : 'hidden' }}" placeholder="أدخل سعر الوصفة" value="{{ old('price', $challenge->price) }}">
                            @error('price')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h6 class="dz-title my-2" style="text-align: center;">تفاصيل الجائزة (اختياري)</h6>
                    <div class="my-3">
                        <label for="prize_name" class="dz-title my-2" style="text-align: center; display: block;">اسم الجائزة</label>
                        <input type="text" name="prize_name" id="prize_name" value="{{ old('prize_name', $challenge->prize_name) }}" style="text-align: center; color: #000000;" placeholder="أدخل اسم الجائزة" class="form-control">
                        @error('prize_name')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3" id="prizeImageSection">
                        <label for="prize_image" class="dz-title my-2" style="text-align: center; display: block;">صورة الجائزة</label>
                        <div class="bg-cookpad-gray-9gi p-6h1 text-center" style="height: 150px; border-radius: 15px; display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative;">

                            @if($challenge->prize_image)
                            <img id="prizeImagePreview" src="{{ asset('storage/' . $challenge->prize_image) }}" alt="صورة الجائزة الحالية" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 15px; display: block;">
                            <p id="prizeImageText" class="text-x8v font-9s7 mt-mnq" style="position: absolute; bottom: 10px; width: 100%; text-align: center; background: rgba(255,255,255,0.7); padding: 5px;">لتغيير الصورة، اختر ملفًا جديدًا.</p>
                            @else
                            <div id="prizeImageDefault" class="text-center" style="position: absolute;">
                                <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p id="prizeImageText" class="text-x8v font-9s7 mt-mnq">أضف صورة الجائزة</p>
                            </div>
                            @endif

                            <input type="file" name="prize_image" id="prize_image" accept="image/*" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                        </div>
                        @error('prize_image')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // ... Other scripts ...

                            const prizeImageContainer = document.querySelector('#prizeImageSection .bg-cookpad-gray-9gi');
                            const prizeImageInput = document.getElementById('prize_image');
                            const prizeImageText = document.getElementById('prizeImageText');
                            const prizeImageDefault = document.getElementById('prizeImageDefault');
                            let prizeImagePreview = document.getElementById('prizeImagePreview');

                            prizeImageContainer.addEventListener('click', function() {
                                prizeImageInput.click();
                            });

                            prizeImageInput.addEventListener('change', function() {
                                const file = this.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        if (prizeImagePreview) {
                                            prizeImagePreview.src = e.target.result;
                                            prizeImagePreview.style.display = 'block';
                                        } else {
                                            // If no preview exists, create it
                                            prizeImagePreview = document.createElement('img');
                                            prizeImagePreview.id = 'prizeImagePreview';
                                            prizeImagePreview.src = e.target.result;
                                            prizeImagePreview.alt = 'صورة الجائزة الجديدة';
                                            prizeImagePreview.style.cssText = 'max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 15px; display: block;';
                                            prizeImageContainer.prepend(prizeImagePreview);
                                        }

                                        // Hide default icon and show new text
                                        if (prizeImageDefault) prizeImageDefault.style.display = 'none';
                                        prizeImageText.style.display = 'block';
                                        prizeImageText.textContent = `تم اختيار الملف: ${file.name}`;
                                    }
                                    reader.readAsDataURL(file);
                                } else {
                                    // If user cancels file selection, revert to original state
                                    if (prizeImagePreview) {
                                        prizeImagePreview.style.display = 'block';
                                        prizeImageText.textContent = 'لتغيير الصورة، اختر ملفًا جديدًا.';
                                    } else {
                                        if (prizeImageDefault) prizeImageDefault.style.display = 'block';
                                        prizeImageText.textContent = 'أضف صورة الجائزة';
                                    }
                                }
                            });
                        });

                    </script>

                    <h6 class="dz-title my-2" style="text-align: center;">نوع التحدي</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            {{-- Changed name from 'filterRadio' to 'challenge_type' to match controller validation --}}
                            <input class="form-check-input" type="radio" name="challenge_type" id="filterRadio1" value="users" {{ old('challenge_type', $challenge->challenge_type) == 'users' ? 'checked' : '' }}>
                            <label class="form-check-label" for="filterRadio1">للمستخدمين</label>
                        </div>
                        <div class="form-check style-2">
                            {{-- Changed name from 'filterRadio' to 'challenge_type' to match controller validation --}}
                            <input class="form-check-input" type="radio" name="challenge_type" id="filterRadio2" value="chefs" {{ old('challenge_type', $challenge->challenge_type) == 'chefs' ? 'checked' : '' }}>
                            <label class="form-check-label" for="filterRadio2">للطهاة</label>
                        </div>
                    </div>
                    @error('challenge_type')
                    <div class="error-message">{{ $message }}</div>
                    @enderror

                    <h6 class="dz-title my-2" style="text-align: center;">حالة التحدي</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="status" id="statusRadio1" value="active" {{ old('status', $challenge->status) == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusRadio1">فعال</label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="status" id="statusRadio2" value="inactive" {{ old('status', $challenge->status) == 'inactive' ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusRadio2">غير فعال</label>
                        </div>
                    </div>
                    @error('status')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </main>
            <div class="footer-fixed-btn bottom-0 bg-white">
                <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl" id="submitBtn">تحديث</button>
            </div>
        </form>
    </div>

    <script>
        // Initialize Flatpickr
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

        // Show/hide price input based on recipe selection
        const selectElement = document.getElementById('recipe-select');
        const priceInput = document.getElementById('price');

        function togglePriceInputVisibility() {
            if (selectElement.value !== '') {
                priceInput.classList.remove('hidden');
                priceInput.classList.add('visible');
            } else {
                priceInput.classList.remove('visible');
                priceInput.classList.add('hidden');
                priceInput.value = ''; // Clear value if recipe is deselected
            }
        }

        document.addEventListener('DOMContentLoaded', togglePriceInputVisibility);
        selectElement.addEventListener('change', togglePriceInputVisibility);

        // Form submission handling
        document.getElementById('challengeForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'جاري التحديث...';
        });

        // File upload feedback and preview
        document.getElementById('fil-ttd').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.querySelector('.image-preview-area'); // Target the actual preview area

            // Clear existing previews and messages within the preview area
            while (previewContainer.firstChild) {
                previewContainer.removeChild(previewContainer.firstChild);
            }

            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert to MB
                if (fileSize > 50) {
                    alert('حجم الملف كبير جداً. يجب أن يكون أقل من 50 ميجابايت.');
                    this.value = ''; // Clear the input
                    // Revert to initial state by reloading or re-rendering initial placeholders
                    location.reload(); // Simple but effective for full reset
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    let mediaElement;
                    if (file.type.startsWith('video/')) {
                        mediaElement = document.createElement('video');
                        mediaElement.controls = true;
                        mediaElement.innerHTML = `<source src="${event.target.result}" type="${file.type}">متصفحك لا يدعم الفيديو.`;
                    } else if (file.type.startsWith('image/')) {
                        mediaElement = document.createElement('img');
                        mediaElement.src = event.target.result;
                        mediaElement.alt = 'معاينة الإعلان';
                    }

                    if (mediaElement) {
                        mediaElement.style.maxWidth = '100%';
                        mediaElement.style.maxHeight = '100%';
                        mediaElement.style.objectFit = 'contain';
                        mediaElement.style.borderRadius = '15px';
                        previewContainer.appendChild(mediaElement);
                    }

                    // Add the "change file" text
                    let feedbackText = document.createElement('p');
                    feedbackText.className = 'text-x8v font-9s7 mt-mnq';
                    feedbackText.style.position = 'absolute';
                    feedbackText.style.bottom = '30px';
                    feedbackText.style.width = '100%';
                    feedbackText.style.textAlign = 'center';
                    feedbackText.textContent = `لتغيير الملف، اختر ملفًا جديدًا.`;
                    previewContainer.appendChild(feedbackText);

                    // Add the file size/duration text
                    let durationText = document.createElement('p');
                    durationText.className = 'text-b94 px-ql7';
                    durationText.style.position = 'absolute';
                    durationText.style.bottom = '5px';
                    durationText.style.width = '100%';
                    durationText.style.textAlign = 'center';
                    durationText.style.color = 'gray';
                    durationText.style.fontSize = '0.8em';
                    durationText.textContent = 'يجب أن يكون حجم الملف أقل من 50 ميجابايت (الفيديو لا يزيد عن 60 ثانية).';
                    previewContainer.appendChild(durationText);
                };
                reader.readAsDataURL(file);
            } else {
                // If no file selected (e.g., user cancels selection), restore the default state
                location.reload(); // Simplest way to revert to the initial state defined by Blade
            }
            // Re-append the file input to make it clickable again
            const fileInput = document.getElementById('fil-ttd');
            fileInput.style.position = 'absolute';
            fileInput.style.top = '0';
            fileInput.style.left = '0';
            fileInput.style.width = '100%';
            fileInput.style.height = '100%';
            fileInput.style.opacity = '0';
            fileInput.style.cursor = 'pointer';
            previewContainer.appendChild(fileInput);
        });

    </script>
</body>
@endsection
