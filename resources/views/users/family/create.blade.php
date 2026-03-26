<!DOCTYPE html>
<html lang="ar">

<head>
    <title>إضافة فرد</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">
</head>

<body>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Tajawal', sans-serif !important;
            direction: rtl;
            background: #f7f8fc;
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
        }

        /* === Hero === */
        .page-hero {
            background: linear-gradient(160deg, var(--primary-color, #2563eb) 0%,
                    color-mix(in srgb, var(--primary-color, #2563eb) 70%, #000) 100%);
            padding: 12px 20px 72px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            top: -80px;
            left: -60px;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            bottom: -50px;
            right: -30px;
        }

        .hero-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 2;
            margin-bottom: -1px;
            top: 5px;
        }

        .hero-icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            flex-shrink: 0;
        }

        .hero-icon-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .hero-icon-btn:active {
            transform: scale(0.92);
        }

        .hero-icon-btn.confirm-btn {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.35);
        }

        .hero-nav-title {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
        }

        .hero-emoji {
            font-size: 40px;
            display: block;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 400;
            position: relative;
            z-index: 2;
        }

        /* === Card === */
        .page-card {
            background: #fff;
            border-radius: 32px 32px 0 0;
            margin-top: -58px;
            flex: 1;
            padding: 32px 20px 40px;
            position: relative;
            z-index: 2;
            box-shadow: 0 -4px 30px rgba(0, 0, 0, 0.06);
        }

        .page-card .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .page-card .section-sub {
            font-size: 13px;
            color: #9ca3af;
            margin-bottom: 28px;
            font-weight: 400;
        }

        /* === Field Group === */
        .field-group {
            margin-bottom: 20px;
        }

        .field-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .field-group .input-wrap {
            position: relative;
        }

        .field-group .input-wrap .field-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }

        .field-group .input-wrap .select-arrow {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }

        .field-group input[type="text"],
        .field-group select {
            width: 100%;
            height: 54px;
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            padding: 0 44px 0 16px;
            font-family: 'Tajawal', sans-serif;
            font-size: 15px;
            color: #1f2937;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            text-align: right;
            direction: rtl;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .field-group select {
            padding-left: 36px;
        }

        .field-group input[type="text"]:focus,
        .field-group select:focus {
            border-color: var(--primary-color, #2563eb);
            background: #fff;
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary-color, #2563eb) 15%, transparent);
        }

        .field-group input::placeholder {
            color: #c4c8d1;
        }

        .field-group input.is-invalid,
        .field-group select.is-invalid {
            border-color: #ef4444 !important;
            background: color-mix(in srgb, #ef4444 6%, #fff) !important;
            box-shadow: 0 0 0 3px color-mix(in srgb, #ef4444 12%, transparent) !important;
        }

        /* === Submit Button === */
        .btn-submit {
            width: 100%;
            height: 54px;
            background: var(--primary-color, #2563eb);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: 'Tajawal', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 18px color-mix(in srgb, var(--primary-color, #2563eb) 40%, transparent);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 28px;
            letter-spacing: 0.2px;
        }

        .btn-submit:active {
            transform: scale(0.97);
            box-shadow: 0 2px 8px color-mix(in srgb, var(--primary-color, #2563eb) 30%, transparent);
        }

        /* === Cancel Button === */
        .btn-cancel {
            width: 100%;
            height: 54px;
            background: transparent;
            color: var(--primary-color, #2563eb);
            border: 1.5px solid var(--primary-color, #2563eb);
            border-radius: 14px;
            font-family: 'Tajawal', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            margin-top: 14px;
        }

        .btn-cancel:active {
            background: color-mix(in srgb, var(--primary-color, #2563eb) 8%, transparent);
        }

        /* === Divider === */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }

        .divider span {
            font-size: 12px;
            color: #d1d5db;
            white-space: nowrap;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0f0f0;
        }
    </style>

    <!-- Hero -->
    <div class="page-hero">
        <div class="hero-nav">
            <a href="{{ route('users.family.index') }}" class="hero-icon-btn" aria-label="رجوع">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </a>

            <span class="hero-nav-title">{{ __('messages.add_member') }}</span>

            <button id="submitForm" type="button" class="hero-icon-btn confirm-btn" aria-label="حفظ">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            </button>
        </div>

        <span class="hero-emoji">👤</span>
        <p class="hero-subtitle">أدخل بيانات الفرد الجديد</p>
    </div>

    <!-- Card -->
    <div class="page-card">
        <p class="section-title">{{ __('messages.add_member') }}</p>
        <p class="section-sub">أدخل الاسم واختر اللغة المفضلة</p>

        <form action="{{ route('users.family.store') }}" method="POST" id="addMemberForm">
            @csrf

            {{-- Name --}}
            <div class="field-group">
                <label for="name">{{ __('messages.name') }}</label>
                <div class="input-wrap">
                    <span class="field-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                    </span>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="{{ __('messages.name') }}" required>
                </div>
            </div>

            {{-- Language --}}
            <div class="field-group">
                <label for="language">{{ __('messages.language') }}</label>
                <div class="input-wrap">
                    <span class="field-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path
                                d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        </svg>
                    </span>
                    <span class="select-arrow">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                    @php
                    $languages = [
                    'ar' => 'العربية',
                    'en' => 'الإنجليزية',
                    'id' => 'الإندونيسية',
                    'am' => 'الأمهرية',
                    'hi' => 'الهندية',
                    'bn' => 'البنغالية',
                    'ml' => 'المالايالامية',
                    'fil' => 'الفلبينية',
                    'ur' => 'الأردية',
                    'ta' => 'التاميلية',
                    'ne' => 'النيبالية',
                    'ps' => 'الأفغانية',
                    'fr' => 'الفرنسية',
                    ];
                    @endphp
                    <select id="language" name="language" required>
                        <option value="">{{ __('messages.choose_language') }}</option>
                        @foreach($languages as $code => $name)
                        <option value="{{ $code }}" {{ old('language')==$code ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <line x1="19" y1="8" x2="19" y2="14" />
                    <line x1="22" y1="11" x2="16" y2="11" />
                </svg>
                {{ __('messages.add_member') }}
            </button>
        </form>

        <div class="divider"><span>أو</span></div>

        <a href="{{ route('users.family.index') }}" class="btn-cancel">
            إلغاء والرجوع
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const form       = document.getElementById('addMemberForm');
        const submitBtn  = document.getElementById('submitForm');

        function validateAndSubmit() {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            let firstEmpty = null;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    if (!firstEmpty) firstEmpty = field;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                firstEmpty.focus();
                return;
            }

            form.submit();
        }

        // Header checkmark button
        submitBtn.addEventListener('click', validateAndSubmit);

        // Remove invalid state on input
        form.querySelectorAll('[required]').forEach(field => {
            field.addEventListener('input', () => field.classList.remove('is-invalid'));
            field.addEventListener('change', () => field.classList.remove('is-invalid'));
        });
    });
    </script>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>