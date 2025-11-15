<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>عرض جدول الطبخ</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        * {
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        .back-btn {
            color: white;
            font-size: 24px;
            text-decoration: none;
        }

        .info-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(102, 0, 153, 0.1);
            border-top: 4px solid #660099;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #660099;
        }

        .family-member {
            display: inline-block;
            background: #f3e5f5;
            color: #660099;
            padding: 5px 15px;
            border-radius: 20px;
            margin: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .date-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 8px rgba(102, 0, 153, 0.1);
            border-right: 5px solid #660099;
        }

        .date-header {
            background: #660099;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
            font-size: 18px;
        }

        .meal-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            border-right: 4px solid #660099;
        }

        .meal-type {
            font-weight: 600;
            color: #660099;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .meal-time {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .recipe-name {
            background: white;
            padding: 12px 15px;
            border-radius: 8px;
            margin: 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 1px 3px rgba(102, 0, 153, 0.1);
            transition: all 0.3s ease;
        }

        .recipe-name:hover {
            transform: translateX(-5px);
            box-shadow: 0 2px 8px rgba(102, 0, 153, 0.2);
        }

        .recipe-icon {
            font-size: 20px;
        }

        .no-meals {
            text-align: center;
            color: #999;
            padding: 20px;
            font-style: italic;
        }

        .badge-breakfast {
            background: #ff9800;
        }

        .badge-lunch {
            background: #4caf50;
        }

        .badge-dinner {
            background: #2196f3;
        }

        .excluded-day {
            background: #ffebee !important;
            border: 2px dashed #ef5350 !important;
        }

        .excluded-label {
            color: #ef5350;
            font-weight: 600;
            text-align: center;
            padding: 10px;
        }

        h3,
        h5 {
            font-weight: 600;
        }

        .additional-recipes {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ddd;
        }

        .additional-title {
            font-weight: 600;
            color: #666;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .main-recipe {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .main-recipe a {
            color: white !important;
        }

        .salad-recipe {
            background: #e8f5e8;
            border-right: 3px solid #4caf50;
        }

        .drink-recipe {
            background: #e3f2fd;
            border-right: 3px solid #2196f3;
        }

        .appetizer-recipe {
            background: #fff3e0;
            border-right: 3px solid #ff9800;
        }

        .healthy-recipe {
            background: #e8f5e8;
            border-right: 3px solid #4caf50;
        }

        .soup-recipe {
            background: #fff3e0;
            border-right: 3px solid #ff9800;
        }

        .dessert-recipe {
            background: #fce4ec;
            border-right: 3px solid #e91e63;
        }

        .sauce-recipe {
            background: #fff3e0;
            border-right: 3px solid #ff9800;
        }

        .side-dish-recipe {
            background: #e8f5e8;
            border-right: 3px solid #4caf50;
        }

        .recipe-link {
            text-decoration: none;
            color: inherit;
            flex: 1;
        }

        .recipe-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header header-fixed border-bottom">
        <div class="header-content">
            <div class="right-content">
                {{-- <a href="{{ route('users.meals.index') }}" class=""><i class="feather icon-home font-24"></i></a>
                --}}
            </div>
            <div class="mid-content">
                <h4 class="title">{{ __('messages.عرض جدول الطبخ') }}</h4>
            </div>
            <div class="left-content">
                <a href="{{ route('users.meals.table-cook') }}" id="back-btn">
                    <i class="feather icon-arrow-left"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- Header -->

    <div class="container" style="margin-top: 60px;">
        <!-- Schedule Information -->
        <div class="info-card">
            <h5 class="mb-3" style="color: #660099;">{{ __('messages.معلومات الجدول') }}</h5>

            <div class="info-row">
                <span class="info-label">{{ __('messages.تاريخ البداية') }}:</span>
                <span>{{ \Carbon\Carbon::parse($mealPlan->start_date)->format('Y/m/d') }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">{{ __('messages.تاريخ النهاية') }}:</span>
                <span>{{ \Carbon\Carbon::parse($mealPlan->end_date)->format('Y/m/d') }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">{{ __('messages.عدد الأيام') }}:</span>
                <span>
                    {{
                    \Carbon\Carbon::parse($mealPlan->start_date)->diffInDays(\Carbon\Carbon::parse($mealPlan->end_date))
                    + 1
                    }} {{ __('messages.يوم') }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">{{ __('messages.أفراد العائلة') }}:</span>
                <div>
                    @foreach($familyMembers as $member)
                    <span class="family-member">{{ $member->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="info-row">
                <span class="info-label">{{ __('messages.الوجبات النشطة') }}:</span>
                <div>
                    @if($mealPlan->meals['breakfast']['active'] ?? false)
                    <span class="badge badge-breakfast text-white me-2">{{ __('messages.إفطار') }}</span>
                    @endif
                    @if($mealPlan->meals['lunch']['active'] ?? false)
                    <span class="badge badge-lunch text-white me-2">{{ __('messages.غداء') }}</span>
                    @endif
                    @if($mealPlan->meals['dinner']['active'] ?? false)
                    <span class="badge badge-dinner text-white">{{ __('messages.عشاء') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Daily Meal Details -->
        <h5 class="mt-4 mb-3" style="color: #660099;">{{ __('messages.تفاصيل الوجبات اليومية') }}</h5>

        @foreach($mealsByDate as $date => $mealTypes)
        @php
        $isExcluded = in_array($date, $mealPlan->meals['excluded_days'] ?? []);
        $dayName = \Carbon\Carbon::parse($date)->locale(app()->getLocale())->translatedFormat('l');
        @endphp

        <div class="date-card {{ $isExcluded ? 'excluded-day' : '' }}">
            <div class="date-header">
                {{ \Carbon\Carbon::parse($date)->format('Y/m/d') }} - {{ $dayName }}
            </div>

            @if($isExcluded)
            <div class="excluded-label">
                <span class="material-icons" style="vertical-align: middle;">block</span>
                {{ __('messages.يوم مستبعد من الجدول') }}
            </div>
            @else
            @foreach(['breakfast' => 'إفطار', 'lunch' => 'غداء', 'dinner' => 'عشاء'] as $type => $label)
            @if($mealPlan->meals[$type]['active'] ?? false)
            @php
            $excludedForThisMeal = $mealPlan->meals[$type]['excluded_days'] ?? [];
            $isMealExcluded = in_array($date, $excludedForThisMeal);
            @endphp

            <div class="meal-section {{ $isMealExcluded ? 'excluded-day' : '' }}">
                <div class="meal-type">
                    <span class="material-icons" style="vertical-align: middle; font-size: 22px;">restaurant</span>
                    {{ __('messages.' . $label) }}
                </div>

                @if($isMealExcluded)
                <div class="excluded-label">{{ __('messages.وجبة مستبعدة') }}</div>
                @else
                @if($mealPlan->meals[$type]['time'] ?? false)
                <div class="meal-time">
                    <span class="material-icons" style="vertical-align: middle; font-size: 16px;">schedule</span>
                    {{ __('messages.الوقت') }}: {{ $mealPlan->meals[$type]['time'] }}
                </div>
                @endif

                @if(isset($mealTypes[$type]))
                @foreach($mealTypes[$type] as $meal)
                <!-- الوصفة الرئيسية -->
                <div class="recipe-name main-recipe">
                    <span class="material-icons recipe-icon">🍽️</span>
                    <a href="{{ route('users.meals.show', $meal->recipe->id) }}" class="recipe-link">
                        <span>{{ $meal->recipe->title ??
                            __('messages.وصفة غير معروفة') }}</span>
                    </a>
                </div>

                <!-- الاضافات -->
                @if($meal->salad_id && $meal->salad || $meal->drink_id && $meal->drink 
                    || $meal->desserts_id && $meal->dessert || $meal->sauces_id && $meal->sauce
                    || $meal->appetizers_id && $meal->appetizer || $meal->healthy_food_id && $meal->healthyFood
                    || $meal->snacks_id && $meal->snack || $meal->soups_id && $meal->soup
                    )
                <div class="additional-recipes">
                    
                    <div class="additional-title">{{ __('messages.الإضافات') }}:</div>

                    @if($meal->salad_id && $meal->salad)
                    <div class="recipe-name salad-recipe">
                        <span class="material-icons recipe-icon">🥗</span>
                        <a href="{{ route('users.meals.show', $meal->salad_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.سلطة') }}</strong> {{ $meal->salad->name_ar ?? '' }}</span>
                        </a>
                    </div>
                    @endif

                    @if($meal->drink_id && $meal->drink)
                    <div class="recipe-name drink-recipe">
                        <span class="material-icons recipe-icon">🍹</span>
                        <a href="{{ route('users.meals.show', $meal->drink_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.مشروب') }}</strong> {{ $meal->drink->name_ar ?? '' }}</span>
                        </a>
                    </div>
                    @endif

                    @if($meal->appetizers_id && $meal->appetizer)
                    <div class="recipe-name appetizer-recipe">
                        <span class="material-icons recipe-icon">🥡</span>
                        <a href="{{ route('users.meals.show', $meal->appetizers_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.مقبلات') }}</strong> {{ $meal->appetizer->name_ar ?? ''
                                }}</span>
                        </a>
                    </div>
                    @endif

                    @if($meal->healthy_food_id && $meal->healthyFood)
                    <div class="recipe-name healthy-recipe">
                        <span class="material-icons recipe-icon">🥬</span>
                        <a href="{{ route('users.meals.show', $meal->healthy_food_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.أكل صحي') }}</strong> {{ $meal->healthyFood->name_ar ?? ''
                                }}</span>
                        </a>
                    </div>
                    @endif

                    @if($meal->soup_id && $meal->soup)
                    <div class="recipe-name soup-recipe">
                        <span class="material-icons recipe-icon">🍲</span>
                        <a href="{{ route('users.meals.show', $meal->soup_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.شوربة') }}</strong> {{ $meal->soup->name_ar ?? '' }}</span>
                        </a>
                    </div>
                    @endif

                    @if($meal->desserts_id && $meal->dessert)
                    <div class="recipe-name dessert-recipe">
                        <span class="material-icons recipe-icon">🍰</span>
                        <a href="{{ route('users.meals.show', $meal->desserts_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.حلويات') }}</strong> {{ $meal->dessert->name_ar ?? '' }}</span>
                        </a>
                    </div>
                    @endif

                    @if($meal->sauces_id && $meal->sauce)
                    <div class="recipe-name sauce-recipe">
                        <span class="material-icons recipe-icon">🧴</span>
                        <a href="{{ route('users.meals.show', $meal->sauces_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.صلصات') }}</strong> {{ $meal->sauce->name_ar ?? '' }}</span>
                        </a>
                    </div>
                    @endif

                    @if($meal->side_dish_id && $meal->sideDish)
                    <div class="recipe-name side-dish-recipe">
                        <span class="material-icons recipe-icon">🍽️</span>
                        <a href="{{ route('users.meals.show', $meal->side_dish_id) }}" class="recipe-link">
                            <span><strong>{{ __('messages.طبق جانبي') }}</strong> {{ $meal->sideDish->name_ar ?? ''
                                }}</span>
                        </a>
                    </div>
                    @endif
                </div>
                @endif
                @endforeach
                @else
                <div class="no-meals">{{ __('messages.لا توجد وصفات لهذه الوجبة') }}</div>
                @endif

                @if($mealPlan->meals[$type]['notes'] ?? false)
                <div class="mt-3 p-2" style="background: white; border-radius: 5px;">
                    <small><strong>{{ __('messages.ملاحظات') }}:</strong> {{ $mealPlan->meals[$type]['notes'] }}</small>
                </div>
                @endif
                @endif
            </div>
            @endif
            @endforeach
            @endif
        </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.js"></script>
</body>

</html>