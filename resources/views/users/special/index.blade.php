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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --primary-color: #660099;
            --primary: var(--primary-color);
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .text-right {
            text-align: right;
        }

        /* Tabs Styling */
        .custom-tabs {
            background: white;
            margin-top: 70px;
            border-bottom: 2px solid #e9ecef;
        }

        .nav-tabs {
            border: none;
            display: flex;
            justify-content: space-around;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 600;
            font-size: 16px;
            padding: 15px 30px;
            position: relative;
            background: transparent;
            border-radius: 0;
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary-color);
            background: transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            background: transparent;
            border: none;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-color);
        }

        .order-header {
            display: flex;
        }

        .order-avatar {
            width: 110px;
            height: 120px;
            border-radius: 0px 15px 15px 0px;
        }

        .order-card {
            background: white;
            border-radius: 12px;
            margin: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .order-info {
            padding: 10px;
        }

        .order-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .order-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        p {
            margin-bottom: 0.2rem;
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
                    <a href="{{ route('users.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">الطلبات الخاصة</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>

        <!-- Tabs Navigation -->
        <div style="direction: rtl;" class="custom-tabs">
            <ul class="nav nav-tabs" id="ordersTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="my-orders-tab" data-bs-toggle="tab" data-bs-target="#my-orders"
                        type="button" role="tab">
                        <i class="fas fa-user-circle"></i> طلباتي
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="family-orders-tab" data-bs-toggle="tab" data-bs-target="#family-orders"
                        type="button" role="tab">
                        <i class="fas fa-users"></i> طلبات العائلة
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tabs Content -->
        <div style="direction: rtl;" class="tab-content" id="ordersTabsContent">
            <!-- My Orders Tab -->
            <div class="tab-pane fade show active" id="my-orders" role="tabpanel">
                @foreach ($specialRequests as $specialRequest)
                <a href="{{ route('users.meals.show', $specialRequest->recipe->id) }}">
                    <div class="order-card">
                        <div class="order-header">
                            <img src="{{ asset('storage/' . $specialRequest->recipe->dish_image) }}"
                                alt="صورة المرسل" class="order-avatar">
                            <div class="order-info">
                                <p class="order-date">
                                    <i class="far fa-calendar-alt"></i> {{ $specialRequest->created_at->format('Y/m/d') }}
                                    <i class="far fa-clock"></i> {{ $specialRequest->created_at->format('h:i A') }}
                                </p>
                                <p class="order-title">طلب من 
                                    {{ $specialRequest->user->name }} إلى 
                                    @if($specialRequest->cook_id)
                                    {{ $specialRequest->cook->name }}
                                    @else
                                    {{ $specialRequest->familyMember->name }}
                                    @endif
                                </p>
                                {{-- <p>{{ $specialRequest->meal_type }}</p> --}}
                                <p>{{ __('messages.' . $specialRequest->meal_type) }}</p>
                                <p>{{ $specialRequest->recipe->title }}</p>
                            </div>
    
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Family Orders Tab -->
            <div class="tab-pane fade" id="family-orders" role="tabpanel">
                <!-- Order Card 1 -->
                <div class="order-card">
                    <div class="order-header">
                        <img src="https://via.placeholder.com/50" alt="صورة المرسل" class="order-avatar">
                        <div class="order-info">
                            <p class="order-title">طلب من والدة العائلة إلى جميع الأفراد</p>
                            <p class="order-date">
                                <i class="far fa-calendar-alt"></i> 2024/03/15
                                <i class="far fa-clock"></i> 03:00 م
                            </p>
                        </div>
                    </div>
                    <div class="order-details">
                        <p class="meal-name">أرز بالدجاج</p>
                        <p class="meal-type"><i class="fas fa-utensils"></i> وجبة جماعية</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>