<!DOCTYPE html>
<html lang="ar">

<head>
    <title>طلب خاص</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/user-logo/favicon.png') }}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --primary-color: #29A500;
            --primary: var(--primary-color);
        }

        .text-right {
            text-align: right
        }

        * {
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        .form-control:focus,
        .form-control:active,
        .form-control.active {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 0, 153, 0.25) !important;
        }

        .form-control,
        .form-select {
            border: 2px solid #ebebeb !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            font-size: 15px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .step-container {
            display: none;
        }

        .step-container.active {
            display: block;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            gap: 10px;
        }

        .step-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ddd;
            transition: all 0.3s;
        }

        .step-dot.active {
            background-color: var(--primary-color);
            width: 30px;
            border-radius: 6px;
        }

        .member-card {
            border: 2px solid #ebebeb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .member-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(102, 0, 153, 0.1);
        }

        .member-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(102, 0, 153, 0.05);
        }

        .member-card input[type="checkbox"],
        .member-card input[type="radio"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary-color);
        }

        .cook-card {
            cursor: pointer;
        }

        .family-cook-card {
            cursor: pointer;
        }

        .attendee-card {
            cursor: pointer;
        }

        .btn-check:checked+.btn-outline-primary {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }

        .alert-info {
            background-color: rgba(102, 0, 153, 0.1);
            border: 1px solid rgba(102, 0, 153, 0.2);
            color: var(--primary-color);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
        }

        .meal-card {
            border: 2px solid #ebebeb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .meal-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(102, 0, 153, 0.1);
        }

        .meal-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(102, 0, 153, 0.05);
        }

        .meal-card input[type="radio"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary-color);
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            padding-right: 45px !important;
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-outline-primary {
            color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .guest-counter {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            border: 2px solid #ebebeb;
        }

        .counter-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            background: white;
            color: var(--primary-color);
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .counter-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .counter-btn:active {
            transform: scale(0.95);
        }

        .counter-value {
            font-size: 32px;
            font-weight: bold;
            color: var(--primary-color);
            min-width: 60px;
            text-align: center;
        }

        .page-content {
            padding-top: 70px;
            padding-bottom: 80px;
        }

        .meal-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: #999;
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
        <header class="header header-fixed">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('families.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">طلب خاص</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step-dot active" data-step="1"></div>
            <div class="step-dot" data-step="2"></div>
        </div>

        <!-- Form -->
        <form action="{{ route('families.special.store') }}" method="POST" id="specialRequestForm">
            @csrf

            <div class="page-content">
                <div class="container">

                    <!-- Step 1 -->
                    <div class="step-container active" id="step1">

                        <!-- اختيار من (الطباخين أو أفراد العائلة) -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">من المسؤول عن الطبخ؟</h5>

                            <!-- Toggle Buttons -->
                            <div class="btn-group w-100 mb-3" role="group">
                                <input type="radio" class="btn-check" name="cooking_by" id="cooking_by_family"
                                    value="family" checked>
                                <label class="btn btn-outline-primary" style="gap:5px;" for="cooking_by_family">
                                    <i class="feather icon-users"></i> أفراد العائلة
                                </label>

                                <input type="radio" class="btn-check" name="cooking_by" id="cooking_by_cook"
                                    value="cook">
                                <label class="btn btn-outline-primary" style="gap:5px;" for="cooking_by_cook">
                                    <i class="feather icon-user"></i> الطباخين
                                </label>
                            </div>

                            <!-- قسم اختيار الطباخين (مخفي) -->
                            <div id="cooksSection" style="display: none;">
                                <div class="alert alert-info mb-3 text-right">
                                    <i class="feather icon-info"></i>
                                    اختر الطباخ المسؤول عن تحضير الوجبة
                                </div>
                                @foreach ($cooks as $cook)
                                <div class="member-card cook-card" style="direction: rtl;"
                                    data-cook-id="{{ $cook->id }}">
                                    <div class="d-flex align-items-center" style="gap: 15px;">
                                        <input type="radio" name="cook_id" value="{{ $cook->id }}"
                                            id="cook-{{ $cook->id }}">
                                        <label for="cook-{{ $cook->id }}" class="ms-3 mb-0 flex-grow-1"
                                            style="cursor: pointer;">
                                            <div class="fw-bold">{{ $cook->name }}</div>
                                            <small class="text-muted">طباخ محترف</small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- قسم اختيار أفراد العائلة (ظاهر) -->
                            <div id="familySection">
                                <div class="alert alert-info mb-3 text-right">
                                    <i class="feather icon-info"></i>
                                    اختر من سيقوم بالطبخ من أفراد العائلة (شخص واحد فقط)
                                </div>
                                @foreach ($family_members as $member)
                                <div class="member-card family-cook-card" style="direction: rtl;"
                                    data-member-id="{{ $member->id }}">
                                    <div class="d-flex align-items-center" style="gap: 15px;">
                                        <input type="radio" name="cook_id" value="{{ $member->id }}"
                                            id="family-cook-{{ $member->id }}">
                                        <label for="family-cook-{{ $member->id }}" class="ms-3 mb-0 flex-grow-1"
                                            style="cursor: pointer;">
                                            <div class="fw-bold">{{ $member->name }}</div>
                                            <small class="text-muted">{{ $member->relationship ?? 'فرد من العائلة' }}
                                            </small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- من سيحضر الوجبة؟ -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">من سيحضر الوجبة من أفراد العائلة ؟</h5>

                            <div>
                                <div class="alert alert-info mb-3 text-right">
                                    <i class="feather icon-info"></i>
                                    اختر الحضور من أفراد العائلة (يمكن اختيار أكثر من شخص)
                                </div>

                                @foreach ($family_members as $member)
                                <div class="member-card attendee-card" style="direction: rtl;"
                                    data-attendee-id="{{ $member->id }}">
                                    <div class="d-flex align-items-center" style="gap: 15px;">
                                        <input type="checkbox" name="attendees[]" value="{{ $member->id }}"
                                            id="attendee-{{ $member->id }}">
                                        <label for="attendee-{{ $member->id }}" class="ms-3 mb-0 flex-grow-1"
                                            style="cursor: pointer;">
                                            <div class="fw-bold">{{ $member->name }}</div>
                                            <small class="text-muted">{{ $member->relationship ?? 'فرد من العائلة'
                                                }}</small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach

                                <!-- عدد الضيوف مع checkbox -->
                                <div class="mb-4">
                                    <h5 class="section-title text-right">هل يوجد ضيوف</h5>
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <div class="d-flex align-items-center mb-3" style="justify-content: right;">
                                        <label for="has_guests" class="mb-0"
                                            style="margin-right:10px; cursor:pointer;font-weight:600;">
                                            نعم
                                        </label>
                                        <input type="checkbox" id="has_guests" class="me-2"
                                            style="width:18px;height:18px;accent-color:var(--primary-color);">
                                    </div>
                                    <!-- العداد (مخفي في البداية) -->
                                    <div id="guestCounterSection" style="display:none;">
                                        <span style="display: block; width:100%; text-align: center;">حدد عدد الضيوف
                                        </span>
                                        <div class="guest-counter">
                                            <div class="counter-btn" id="decreaseGuests">-</div>
                                            <div class="counter-value" id="guestCount">0</div>
                                            <div class="counter-btn" id="increaseGuests">+</div>
                                        </div>
                                        <input type="hidden" name="guests_count" id="guests_count" value="0">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- نوع الوجبة -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">نوع الوجبة</h5>
                            <select name="meal_type" id="meal_type" class="form-select"
                                style="text-align: center; width: 100%;" required>
                                <option value="">اختر نوع الوجبة</option>
                                <option value="breakfast">إفطار</option>
                                <option value="lunch">غداء</option>
                                <option value="dinner">عشاء</option>
                            </select>
                        </div>

                        <!-- التاريخ والوقت -->
                        <div class="row mb-4">
                            <div class="col-6">
                                <h5 class="section-title text-right">الوقت</h5>
                                <input type="time" name="time" id="time" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <h5 class="section-title text-right">التاريخ</h5>
                                <input type="date" name="date" id="date" class="form-control" required
                                    min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary w-100" id="nextStep">التالي</button>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-container" id="step2">

                        <!-- البحث عن الوجبة -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">ابحث عن الوجبة</h5>
                            <div class="search-box">
                                <input type="text" class="form-control" id="mealSearch" placeholder="ابحث عن الوجبة...">
                                <i class="feather icon-search"></i>
                            </div>
                        </div>

                        <!-- قائمة الوجبات -->
                        <div class="mb-4">
                            <h5 class="section-title text-right">اختر الوجبة</h5>
                            <div id="mealsContainer">
                                @foreach ($meals as $meal)
                                <div class="meal-card" data-meal-name="{{ strtolower($meal->name) }}">
                                    <div class="d-flex align-items-center">
                                        <label for="meal-{{ $meal->id }}" style="margin-right: 15px; text-align: right;"
                                            class="mb-0 flex-grow-1 d-flex align-items-center" style="cursor: pointer;">
                                            @if ($meal->image)
                                            <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}"
                                                class="meal-image me-3">
                                            @endif
                                            <div class="flex-grow-1">
                                                <div class="fw-bold">{{ $meal->title }}</div>
                                                {{ $meal->id }}
                                                <small class="text-muted">{{ $meal->description ?? '' }}</small>
                                                @if ($meal->price)
                                                <div class="text-primary fw-bold mt-1">{{ $meal->price }}
                                                    جنيه</div>
                                                @endif
                                            </div>
                                        </label>
                                        <input type="radio" name="recipe_id" value="{{ $meal->id }}"
                                            id="meal-{{ $meal->id }}" required>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- زر عرض المزيد -->
                            <div class="text-center mt-3" id="loadMoreContainer">
                                <button type="button" class="btn btn-outline-primary" id="loadMoreBtn">
                                    عرض المزيد
                                </button>
                            </div>

                            <div class="no-results" id="noResults" style="display: none;">
                                <i class="feather icon-search" style="font-size: 48px; color: #ddd;"></i>
                                <p>لا توجد نتائج</p>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary flex-grow-1"
                                id="prevStep">السابق</button>
                            <button type="submit" class="btn btn-primary flex-grow-1">إرسال الطلب</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

                // ================= Global Variables =================
                let currentStep = 1;
                let guestCount = 0;
                let mealSkip = {{ $meals->count() }};
                let loadingMeals = false;

                // ================= DOM Elements =================
                const step1 = document.getElementById('step1');
                const step2 = document.getElementById('step2');
                const stepDots = document.querySelectorAll('.step-dot');
                const nextStepBtn = document.getElementById('nextStep');
                const prevStepBtn = document.getElementById('prevStep');
                const form = document.getElementById('specialRequestForm');

                const guestCountDisplay = document.getElementById('guestCount');
                const guestCountInput = document.getElementById('guests_count');
                const increaseBtn = document.getElementById('increaseGuests');
                const decreaseBtn = document.getElementById('decreaseGuests');
                const hasGuestsCheckbox = document.getElementById('has_guests');
                const guestCounterSection = document.getElementById('guestCounterSection');

                // ================= Guest Counter Functions =================
                const updateGuestCount = () => {
                    if (guestCountDisplay) guestCountDisplay.textContent = guestCount;
                    if (guestCountInput) guestCountInput.value = guestCount;
                };

                increaseBtn?.addEventListener('click', () => {
                    guestCount++;
                    updateGuestCount();
                });

                decreaseBtn?.addEventListener('click', () => {
                    if (guestCount > 0) {
                        guestCount--;
                        updateGuestCount();
                    }
                });

                hasGuestsCheckbox?.addEventListener('change', function() {
                    if (this.checked) {
                        guestCounterSection.style.display = 'block';
                        if (guestCount === 0) {
                            guestCount = 1;
                            updateGuestCount();
                        }
                    } else {
                        guestCounterSection.style.display = 'none';
                        guestCount = 0;
                        updateGuestCount();
                    }
                });

                // ================= Cooking By Toggle =================
                document.getElementById('cooking_by_family')?.addEventListener('change', function() {
                    if (this.checked) {
                        document.getElementById('familySection').style.display = 'block';
                        document.getElementById('cooksSection').style.display = 'none';
                        document.querySelectorAll('input[name="cook_id"]').forEach(i => {
                            i.checked = false;
                            i.closest('.member-card')?.classList.remove('selected');
                        });
                    }
                });

                document.getElementById('cooking_by_cook')?.addEventListener('change', function() {
                    if (this.checked) {
                        document.getElementById('familySection').style.display = 'none';
                        document.getElementById('cooksSection').style.display = 'block';
                        document.querySelectorAll('input[name="family_cook_id"]').forEach(i => {
                            i.checked = false;
                            i.closest('.member-card')?.classList.remove('selected');
                        });
                    }
                });

                // ================= Card Selection (Cook, Family, Attendees, Meals) =================
                document.querySelectorAll('.cook-card, .family-cook-card, .attendee-card, .meal-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        if (e.target.type === 'radio' || e.target.type === 'checkbox') return;

                        const input = this.querySelector('input[type="radio"], input[type="checkbox"]');
                        if (!input) return;

                        if (input.type === 'checkbox') {
                            input.checked = !input.checked;
                            this.classList.toggle('selected', input.checked);
                        } else {
                            input.checked = true;
                            const group = this.classList.contains('meal-card') ? '.meal-card' :
                                this.classList.contains('cook-card') ? '.cook-card' :
                                this.classList.contains('family-cook-card') ? '.family-cook-card' :
                                null;

                            if (group) {
                                document.querySelectorAll(group).forEach(c => c.classList.remove(
                                    'selected'));
                                this.classList.add('selected');
                            }
                        }
                    });
                });

                // ================= Meal Search =================
                document.getElementById('mealSearch')?.addEventListener('input', function() {
                    const term = this.value.toLowerCase().trim();
                    const cards = document.querySelectorAll('.meal-card');
                    let visible = false;

                    cards.forEach(c => {
                        if ((c.dataset.mealName || '').includes(term)) {
                            c.style.display = 'block';
                            visible = true;
                        } else {
                            c.style.display = 'none';
                        }
                    });

                    const noResults = document.getElementById('noResults');
                    if (noResults) noResults.style.display = visible ? 'none' : 'block';
                });

                // ================= Load More Meals =================
                document.getElementById('loadMoreBtn')?.addEventListener('click', function() {
                    if (loadingMeals) return;
                    loadingMeals = true;
                    this.disabled = true;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> جاري التحميل...';

                    fetch("{{ route('families.meals.load-more') }}?skip=" + mealSkip, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('HTTP ' + res.status);
                            return res.json();
                        })
                        .then(data => {
                            const container = document.getElementById('mealsContainer');
                            data.meals.forEach(meal => {
                                const card = document.createElement('div');
                                card.className = 'meal-card';
                                card.dataset.mealName = (meal.name || '').toLowerCase();

                                card.innerHTML = `
            <div class="d-flex align-items-center">
                <label for="meal-${meal.id}" style="margin-right: 15px; text-align: right;"
                    class="mb-0 flex-grow-1 d-flex align-items-center" style="cursor: pointer;">
                    ${meal.image ? `<img src="${window.location.origin}/storage/${meal.image}" alt="${meal.name}"
                            class="meal-image me-3">` : ''}
                    <div class="flex-grow-1">
                        <div class="fw-bold">${meal.title}</div>
                        <small class="text-muted">${meal.description || ''}</small>
                        ${meal.price ? `<div class="text-primary fw-bold mt-1">${meal.price} جنيه</div>` : ''}
                    </div>
                </label>
                <input type="radio" name="recipe_id" value="${meal.id}" id="meal-${meal.id}" required>
            </div>
            `;
                                container.appendChild(card);

                                card.addEventListener('click', function(e) {
                                    if (e.target.type !== 'radio') {
                                        const radio = this.querySelector(
                                            'input[type="radio"]');
                                        radio.checked = true;
                                    }
                                    document.querySelectorAll('.meal-card').forEach(c => c
                                        .classList.remove('selected'));
                                    this.classList.add('selected');
                                });
                            });

                            mealSkip += data.meals.length;

                            if (!data.hasMore) {
                                document.getElementById('loadMoreContainer')?.remove();
                            }

                            this.disabled = false;
                            this.innerHTML = 'عرض المزيد';
                            loadingMeals = false;
                        })
                        .catch(err => {
                            console.error('Load more error:', err);
                            alert('فشل تحميل الوجبات. حاول مرة أخرى.');
                            this.disabled = false;
                            this.innerHTML = 'عرض المزيد';
                            loadingMeals = false;
                        });
                });

                // ================= Step Navigation =================
                const goToStep = step => {
                    currentStep = step;
                    step1.classList.toggle('active', step === 1);
                    step2.classList.toggle('active', step === 2);
                    stepDots.forEach((d, i) => d.classList.toggle('active', i + 1 <= step));
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                };
                nextStepBtn?.addEventListener('click', () => {
                    if (validateStep1()) goToStep(2);
                });

                prevStepBtn?.addEventListener('click', () => goToStep(1));

                // ================= Validation =================
                function validateStep1() {
                    const cookingBy = document.querySelector('input[name="cooking_by"]:checked')?.value;

                    if (!cookingBy) {
                        alert('اختر من المسؤول عن الطبخ');
                        return false;
                    }

                    if (cookingBy === 'cook') {
                        if (!document.querySelector('input[name="cook_id"]:checked')) {
                            alert('من فضلك اختر الطباخ');
                            return false;
                        }
                    } 

                    if (hasGuestsCheckbox && hasGuestsCheckbox.checked && guestCount === 0) {
                        alert('من فضلك حدد عدد الضيوف');
                        return false;
                    }

                    const mealType = document.getElementById('meal_type')?.value;
                    const date = document.getElementById('date')?.value;
                    const time = document.getElementById('time')?.value;
                    if (!mealType) {
                        alert('من فضلك اختر نوع الوجبة');
                        return false;
                    }
                    if (!date) {
                        alert('من فضلك اختر التاريخ');
                        return false;
                    }
                    if (!time) {
                        alert('من فضلك اختر الوقت');
                        return false;
                    }
                    return true;
                }

                // ================= Form Submit =================
                form?.addEventListener('submit', e => {
                    if (!document.querySelector('input[name="recipe_id"]:checked')) {
                        e.preventDefault();
                        alert('من فضلك اختر الوجبة');
                    }
                });

                // ================= Hide Preloader =================
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    setTimeout(() => preloader.style.display = 'none', 500);
                }
            });
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>