<head>
    <!-- Title -->
    <title>تغيير الوصفة</title>
    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #FF9800;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #e0e0e0;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .container {
            padding: 0px 15px;
        }

        /* Section Header */
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--primary-color);
        }

        .section-header h5 {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 18px;
        }

        .section-header i {
            font-size: 20px;
        }

        /* Current Meal Section */
        .current-meal-section {
            background: black;
            border-radius: 16px;
            padding: 20px;
            margin-top: 20px;
        }

        .current-meal-section .section-header {
            border-bottom-color: rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
        }

        .current-meal-section .section-header h5,
        .current-meal-section .section-header i {
            color: white;
        }

        .current-meal-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .meal-image-wrapper {
            position: relative;
            height: 90px;
            overflow: hidden;
        }

        .meal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .meal-image:hover {
            transform: scale(1.05);
        }

        .current-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .current-badge i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        .meal-info {
            padding: 0px 20px;
        }

        .meal-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .meal-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* Alternatives Section */
        .alternatives-section {
            margin-top: 30px;
        }

        .alternative-card {
            background: white;
            border-radius: 16px;
            margin-bottom: 17px !important;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .alternative-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-4px);
        }

        .card-image-wrapper {
            position: relative;
            height: 180px;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .alternative-card:hover .card-image {
            transform: scale(1.1);
        }

        .kitchen-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 6px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .kitchen-badge img {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .kitchen-badge span {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .card-content {
            padding: 18px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .card-description {
            color: var(--text-light);
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .card-stats {
            display: flex;
            gap: 15px;
            padding: 12px 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 15px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--text-light);
            font-size: 13px;
        }

        .stat-item i {
            color: var(--primary-color);
            font-size: 14px;
        }

        .select-form {
            margin: 0;
        }

        .btn-select {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, #45a049 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-select:hover {
            background: linear-gradient(135deg, #45a049 0%, #3d8b40 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }

        .btn-select:active {
            transform: translateY(0);
        }

        .btn-select i {
            font-size: 16px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .empty-state i {
            font-size: 64px;
            color: var(--border-color);
            margin-bottom: 20px;
        }

        .empty-state h6 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-light);
            font-size: 14px;
            margin: 0;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        /* Alert */
        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }

        .alternatives-grid {
            grid-template-columns: repeat(1, 1fr);
        }
    </style>
</head>

<body style="direction: rtl;">
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
                <div class="mid-content">
                    <h4 class="title">اختر وجبة بديلة</h4>
                </div>
                <div class="left-content">
                    <a href="{{ url()->previous() }}" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Start -->
        <main class="page-content space-top">
            <div class="search-box" style="width: 94%; margin: auto;">
                <form method="GET" action="{{ url()->current() }}">
                    <div class="input-group input-radius input-rounded input-lg">
                        <input type="search" id="searchRecipes" name="search" value="{{ request('search') }}"
                            placeholder="اختر من البدائل او ابحث عن وجبة خاصة" class="form-control">
                        <button type="submit" class="input-group-text" style="cursor: pointer; border: none;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M9.65925 19.3102C11.8044 19.3103 13.8882 18.5946 15.5806 17.2764L21.9653 23.6612C22.4423 24.1218 23.2023 24.1086 23.663 23.6316C24.1123 23.1664 24.1123 22.4288 23.663 21.9635L17.2782 15.5788C20.5491 11.3682 19.7874 5.30333 15.5769 2.03243C11.3663 -1.23848 5.30149 -0.476799 2.03058 3.73374C-1.24033 7.94428 -0.478646 14.0092 3.73189 17.2801C5.42702 18.5969 7.51269 19.3113 9.65925 19.3102ZM4.52915 4.5273C7.36245 1.69394 11.9561 1.69389 14.7895 4.5272C17.6229 7.3605 17.6229 11.9542 14.7896 14.7876C11.9563 17.6209 7.36261 17.621 4.52925 14.7877C4.5292 14.7876 4.5292 14.7876 4.52915 14.7876C1.69584 11.9749 1.67915 7.39794 4.49181 4.56464C4.50424 4.55216 4.51667 4.53973 4.52915 4.5273Z"
                                    fill="#C9C9C9" />
                            </svg>
                        </button>
                    </div>
                </form>

                @if (request('search'))
                    <div class="mt-2">
                        <span class="badge bg-primary">
                            البحث عن: {{ request('search') }}
                            <a href="{{ url()->current() }}" class="text-white ms-1">×</a>
                        </span>
                    </div>
                @endif
            </div>
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="current-meal-section mb-4">
                    <div class="section-header">
                        <i class="fa fa-utensils text-primary me-2"></i>
                        <h5 class="mb-0">الوجبة الحالية</h5>
                    </div>

                    @php
                        $currentRecipe = $type === 'recipe' ? $mealDetail->recipe : $mealDetail->{$type};
                    @endphp

                    <div class="current-meal-card">
                        <div class="meal-image-wrapper">
                            <img src="{{ asset('storage/' . $currentRecipe->dish_image) }}"
                                alt="{{ $currentRecipe->title }}" class="meal-image">
                            <div class="current-badge">
                                <i class="fa fa-star"></i>
                                الوجبة الحالية
                            </div>
                        </div>
                        <div class="meal-info">
                            <h6 class="meal-title">{{ $currentRecipe->title }}</h6>
                            {{-- <h6 class="meal-title">{{ Auth::user()->name }}</h6> --}}
                            @if ($currentRecipe->description)
                                <p class="meal-description">
                                    {{ Str::limit($currentRecipe->description, 100) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- البدائل المتاحة -->
                <div class="alternatives-section">
                    <div class="section-header">
                        <i class="fa fa-exchange-alt text-primary me-2"></i>
                        <h5 class="mb-0">البدائل المتاحة</h5>
                    </div>

                    @if ($alternatives->count() > 0)
                        <div class="alternatives-grid">
                            @foreach ($alternatives as $alternative)
                                <div class="alternative-card">
                                    <div class="card-image-wrapper">
                                        <img src="{{ asset('storage/' . $alternative->dish_image) }}"
                                            alt="{{ $alternative->title }}" class="card-image">
                                        @if ($alternative->kitchen)
                                            <div class="kitchen-badge">
                                                <img src="{{ asset('storage/' . $alternative->kitchen->image) }}"
                                                    alt="{{ $alternative->kitchen->name_ar }}">
                                                <span>{{ $alternative->kitchen->name_ar }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-content">
                                        <h6 class="card-title">{{ $alternative->title }}</h6>

                                        @if ($alternative->description)
                                            <p class="card-description">
                                                {{ Str::limit($alternative->description, 80) }}
                                            </p>
                                        @endif

                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <i class="fa fa-clock"></i>
                                                <span>{{ $alternative->preparation_time ?? 0 }} د</span>
                                            </div>
                                            <div class="stat-item">
                                                <i class="fa fa-eye"></i>
                                                <span>{{ $alternative->views ?? 0 }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <i class="fa fa-heart"></i>
                                                <span>{{ $alternative->favorited_by_count ?? 0 }}</span>
                                            </div>
                                        </div>

                                        <form action="{{ route('users.meals.update-recipe', $mealDetail->id) }}"
                                            method="POST" class="select-form">
                                            @csrf
                                            <input type="hidden" name="new_recipe_id"
                                                value="{{ $alternative->id }}">
                                            <input type="hidden" name="type" value="{{ $type }}">

                                            <button type="submit" class="btn-select"
                                                onclick="return confirm('هل أنت متأكد من تغيير الوجبة؟')">
                                                <i class="fa fa-check-circle"></i>
                                                اختر هذه الوجبة
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            {{ $alternatives->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fa fa-inbox"></i>
                            <h6>لا توجد بدائل متاحة</h6>
                            <p>لا يوجد وجبات بديلة في الوقت الحالي</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('searchRecipes').addEventListener('input', function(e) {
            clearTimeout(this.searchTimer);
            this.searchTimer = setTimeout(() => {
                fetch(`{{ url()->current() }}?search=${encodeURIComponent(this.value)}`)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        document.querySelector('.alternatives-section').innerHTML =
                            doc.querySelector('.alternatives-section').innerHTML;
                    });
            }, 500);
        });
    </script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
