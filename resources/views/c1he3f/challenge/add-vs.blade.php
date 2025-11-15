@extends('layouts.chef')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons@4.29.0/dist/feather.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* Exported with SnipCSS extension (Ver 1.9.8) */
    @media all {
        body {
            line-height: 1.5;
            font-size: 1rem;
            letter-spacing: -.025em;
            color: rgb(74 74 74/var(--tw-text-opacity, 1));
        }
    }

    body {
        font-size: 17px;
    }

    body {
        /* CSS Variables that may have been missed get put on body */
        --tw-bg-opacity: 1;
        --tw-bg-opacity: 1;
        --tw-text-opacity: 1;
    }

    @media all {
        * {
            border: 0 solid;
            box-sizing: border-box;
        }
    }

    @media (min-width: 970px) {
        .lg\:rounded {
            border-radius: .25rem;
        }

        .lg\:mb-lg {
            margin-bottom: 2.5rem;
        }

        .lg\:grid {
            display: grid;
        }

        .lg\:grid-cols-\[min\(35\%\,300px\)_1fr\] {
            grid-template-columns: min(35%, 300px) 1fr;
        }

        .lg\:gap-md {
            gap: 1.5rem;
        }
    }

    @media all {
        .mx-33j {
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media (min-width: 970px) {
        .lg\:px-rg {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    @media all {
        .fle-kj4 {
            display: flex;
        }
    }

    @media (min-width: 970px) {
        .lg\:col-start-2 {
            grid-column-start: 2;
        }

        .lg\:rounded-lg {
            border-radius: .5rem;
        }

        .lg\:bg-cookpad-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255/var(--tw-bg-opacity, 1));
        }

        .lg\:gap-x-sm {
            column-gap: .5rem;
        }

        .navigation-container:has(.sidebar-navigation) {
            grid-template-columns: clamp(240px, 20%, 270px) 1fr;
            padding-left: .5rem;
            padding-right: .5rem;
        }
    }

    body {
        transition: opacity ease-in 0.2s;
    }

    @media all {
        body {
            line-height: inherit;
            margin: 0;
        }

        body {
            font-size: 1rem;
            letter-spacing: -.025em;
            line-height: 1.5rem;
        }

        body {
            --tw-text-opacity: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-feature-settings: "liga"on;
            color: rgb(74 74 74/var(--tw-text-opacity, 1));
            text-rendering: optimizeLegibility;
        }

        .bg-cookpad-gray-9gi {
            --tw-bg-opacity: 1;
            background-color: rgb(255 234 234);
        }
    }

    @media (min-width: 970px) {
        .lg\:overscroll-y-none {
            overscroll-behavior-y: none;
        }
    }

    :lang(ar) body {
        font-family: Noto Naskh Arabic, Noto Sans Arabic, sans-serif;
        font-size: 17px;
    }

    @media all {
        html {
            -webkit-text-size-adjust: 100%;
            font-feature-settings: normal;
            -webkit-tap-highlight-color: transparent;
            font-family: ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-variation-settings: normal;
            line-height: 1.5;
            tab-size: 4;
        }

        html {
            font-size: 1rem;
            letter-spacing: -.025em;
            line-height: 1.5rem;
        }

        .p-6h1 {
            padding: 1rem;
        }

        *,
        :after,
        :before {
            border: 0 solid;
            box-sizing: border-box;
        }

        .image-zyn {
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .aspect-\[340\/241\] {
            aspect-ratio: 340/241;
        }

        .item-sji {
            align-items: center;
        }

        .justify-byc {
            justify-content: center;
        }

        .text-wbi {
            text-align: center;
        }
    }

    @media (min-width: 970px) {
        .lg\:aspect-\[120\/170\] {
            aspect-ratio: 120/170;
        }
    }

    @media all {
        .text-fim {
            --tw-text-opacity: 1;
            color: rgb(96 96 96/var(--tw-text-opacity, 1));
        }

        input {
            font-feature-settings: inherit;
            color: inherit;
            font-family: inherit;
            font-size: 100%;
            font-variation-settings: inherit;
            font-weight: inherit;
            letter-spacing: inherit;
            line-height: inherit;
            margin: 0;
            padding: 0;
        }

        input {
            text-align: right;
        }

        input[type="file"] {
            display: block;
        }

        .image-zyn input {
            cursor: pointer;
            height: 100%;
            inset: 0;
            margin: 0;
            opacity: 0;
            position: absolute;
            width: 100%;
        }

        img {
            display: block;
            vertical-align: middle;
        }

        img {
            height: auto;
            max-width: 100%;
        }

        .pointer-events-j3t {
            pointer-events: none;
        }

        .w-8so {
            width: 4rem;
        }

        p {
            margin: 0;
        }

        .mt-mnq {
            margin-top: 1.5rem;
        }

        .text-x8v {
            font-size: 1rem;
            letter-spacing: -.025em;
            line-height: 1.5rem;
        }

        .font-9s7 {
            font-weight: 600;
        }

        .px-ql7 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .text-b94 {
            font-size: .75rem;
            letter-spacing: -.2px;
            line-height: 1rem;
        }
    }

    input::placeholder {
        color: #b3a9a9 !important;
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
                    <h4 class="title">قبول التحدي</h4>
                </div>
            </div>
        </header>

        {{-- رسائل الأخطاء والنجاح --}}
        @if ($errors->any())
        <div class="alert alert-danger" style="margin: 20px; margin-top: 105px;">
            <ul style="margin: 0; padding-right: 20px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success" style="margin: 20px;">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger" style="margin: 20px;">
            {{ session('error') }}
        </div>
        @endif


        {{-- النموذج الخاص بإرسال استجابة التحدي --}}
        {{-- ستحتاج إلى تعريف route جديد لهذه الـ form (مثل challenge.submit-response) --}}
        <form action="{{ route('challenge.submit-response', $challenge->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <main class="page-content space-top p-b100" style="direction: rtl;">
                <div style="border: 1px solid var(--primary); margin-top: 16px; width: 87%; border-radius: 16px; margin-bottom: 10px;" class="container">
                    <div style="display: flex; justify-content: center;">
                        <div class="dz-item-rating" style="border-radius: 50px; background-color: #e00000; font-size: 17px; overflow: hidden; line-height: unset; border: 2px solid #e00000;">
                            {{-- عرض صورة الشيف --}}
							<img src="{{ asset('storage/' . $challenge->chefProfile->official_image) }}" style="width: 60px; height: 60px;" alt="صورة الشيف">

                        </div>
                        {{-- عرض اسم الشيف --}}
                        <h5 style="font-size: 16px; color: gray; text-align: center; align-items: center; justify-content: center; display: flex; margin-right: 10px;">
                            {{ $challenge->chef->name ?? 'غير معروف' }}
                        </h5>
                    </div>
                    {{-- عرض عنوان التحدي --}}
                    <span style="align-items: center; justify-content: center; display: flex;">{{ $challenge->name ?? 'عنوان التحدي' }}</span>
                    <p style="text-align: center; font-size: 12px; margin-bottom: 0px;">
                        تاريخ البدء: {{ \Carbon\Carbon::parse($challenge->start_at)->format('Y-m-d') }}

                        <br>
                        تاريخ الانتهاء: {{ \Carbon\Carbon::parse($challenge->end_date)->format('Y-m-d') }}

                    </p>
                    {{-- يمكنك عرض عد تنازلي هنا باستخدام JavaScript --}}
                </div>

                {{-- اسم الوصفة المختارة --}}
                <h6 style="text-align: center;">اسم الوصفة المختارة: {{ $challenge->recipe?->title ?? 'لا توجد وصفة مربوطة' }}</h6>


                <div class="container">
                    {{-- حقل رفع صورة الوصفة --}}
                    <div class="bg-cookpad-gray-9gi p-6h1" style="height: 40vh; width: 80%; margin: auto; border-radius: 15px;">
                        <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                            <div class="text-fim">
                                <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-x8v font-9s7 mt-mnq">أضف صورة الوصفة</p>
                                <p class="text-b94 px-ql7">شاركنا صورة طبقك، كل شي من إيديك حلو</p>
                            </div>
                            <input type="file" name="recipe_image" id="recipe-image-input" accept="image/*" required>
                        </div>
                        @error('recipe_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- حقل رفع فيديو التحدي --}}
                    <div class="bg-cookpad-gray-9gi p-6h1" style="margin-top: 20px !important; height: 40vh; width: 80%; margin: auto; border-radius: 15px;">
                        <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                            <div class="text-fim">
                                <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-x8v font-9s7 mt-mnq">أضف فيديو التحدي</p>
                                <p class="text-b94 px-ql7">يجب علي الفيديو ان لا يزيد عن 3 دقائق</p>
                            </div>
                            <input type="file" name="challenge_video" id="challenge-video-input" accept="video/*" required>
                        </div>
                        @error('challenge_video')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <span style="display: flex; justify-content: center; font-size: 12px; color: var(--primary); font-weight: bold; text-align: center; ">يجب التركيز علي تصوير طريقة إعداد الطبخة وعدم إبراز ملامح الوجه والمكان</span>
                    <span style="display: flex; justify-content: center; font-size: 12px; color: var(--primary); font-weight: bold; text-align: center;">جميع الصور والفيديوهات والمحتوي المرفوع من مسؤلية المستخدم</span>
                    <div class="my-3">
                        <input type="text" name="message_to_chef" id="message-to-chef" style="height: 98px; text-align: center; color: #000000;" placeholder="رسالة إلي الطاهي" class="form-control" value="{{ old('message_to_chef') }}">
                        @error('message_to_chef')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </main>
            <div class="footer-fixed-btn bottom-0 bg-white">
                <button type="submit" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">
                    إرسال</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript لمعالجة معاينة الملفات وعرض أسماء الملفات
        document.getElementById('recipe-image-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const textElement = this.closest('.bg-cookpad-gray-9gi').querySelector('.text-x8v.font-9s7');
                if (textElement) {
                    textElement.textContent = `تم اختيار صورة: ${file.name}`;
                }
            }
        });

        document.getElementById('challenge-video-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const textElement = this.closest('.bg-cookpad-gray-9gi').querySelector('.text-x8v.font-9s7');
                if (textElement) {
                    textElement.textContent = `تم اختيار فيديو: ${file.name}`;
                }
            }
        });

    </script>

</body>

@endsection
