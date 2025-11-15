<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>{{ __('messages.جدول الطبخ') }}</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">

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
            --primary: #660099 !important;
        }

        .btn:hover {
            background-color: #4a006e !important;
            border-color: #4a006e !important;
        }

        .dz-card.list .dz-media {
            max-width: 100% !important;
        }

        .recpie-name {
            text-align: center;
            background: black;
            color: white;
            border-radius: 15px 15px 0px 0px;
            padding: 8px;
            margin-bottom: 0px;
        }

        .dz-card.list .dz-media img {
            border-radius: 0px !important;
            height: 114px;
        }
    </style>
    @vite(['resources/js/app.js'])
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
        <!-- Preloader end-->

        <!-- Header -->
        <header class="header header-sticky border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ route('users.welcome') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.جدول الطبخ') }}</h4>
                </div>
                <div class="right-content">
                    <a href="{{ route('users.cook_table.index') }}" class=""><i class="feather icon-plus font-24"></i></a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top" style="direction: rtl;">
            <div class="container pt-0">
                <div class="default-tab style-2 mt-1">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" aria-selected="true"
                                role="tab">{{
                                __('messages.active') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile" aria-selected="false" role="tab"
                                tabindex="-1">{{ __('messages.ended') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                            <ul class="featured-list">
                                @if ($recipe)
                                <a href="#">
                                    <li class="container-cart">
                                        <div class="dz-card list"
                                            style="flex-direction: column; border: 1px solid #ccc; box-shadow: 0px 0px 0px 2px #cccccc7a;">
                                            <p class="recpie-name">
                                                {{ __('messages.next_meal_is') }}
                                            </p>
                                            <div class="dz-media"
                                                style="position: relative; display: flex; align-items: center; gap: 20px;">
                                                <img src="assets/images/background.png" style="width: 150px;" alt="">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <span>{{ $recipe->recipe->title }}</span>
                                                    </h6>
                                                    @forelse ($recipe->recipe->subCategories as $subCategory)
                                                    <span class="badge badge-info">{{ $subCategory?->recipe?->name_ar
                                                        }}</span>
                                                    @empty
                                                    <span class="text-muted">{{ __('messages.none') }}</span>
                                                    @endforelse
                                                    <ul class="tag-list" style="display: flex; gap: 10px;">
                                                        <li class="dz-price"
                                                            style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-clock"
                                                                style="color: var(--primary-color);"></i>
                                                            {{ $recipe->recipe->preparation_time }}
                                                        </li>
                                                        <li class="dz-price"
                                                            style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-eye"
                                                                style="color: var(--primary-color);"></i>
                                                            {{ $recipe->recipe->views ?? 0 }}
                                                        </li>
                                                        <li class="dz-price"
                                                            style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-heart"
                                                                style="color: var(--primary-color);"></i>
                                                            {{ $recipe->recipe->favorites_count ?? 0 }}
                                                        </li>
                                                    </ul>
                                                    <div>
                                                        <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                                            class="tags">
                                                            <img src="{{ asset('storage/' . $recipe->recipe->kitchen->image) }}"
                                                                style="border-radius: 50% !important; width: 30px; height: 30px;"
                                                                alt="">
                                                            {{ trans_field($recipe->recipe->kitchen, 'name') }}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="recpie-name" style="border-radius: 0px;">
                                                {{ __('messages.cooking_schedule_details') }}
                                            </p>
                                            <div style="border-top: 1px solid #ccc; padding: 10px;" class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title"
                                                        style="display: flex; align-items: center; justify-content: space-between;">
                                                        <span><i class="fa-regular fa-calendar"></i>
                                                            {{ $recipe->mealPlan->start_date }}</span>
                                                        <span><i class="fa-solid fa-arrow-left-long"
                                                                style="font-size: 22px;"></i></span>
                                                        <span><i class="fa-regular fa-calendar"></i>
                                                            {{ $recipe->mealPlan->end_date }}</span>
                                                    </h6>
                                                    <h6 class="title"
                                                        style="display: flex; align-items: center; justify-content: space-between;">
                                                        <span><i class="fa-solid fa-utensils"></i>
                                                            {{ $recipeCount }}
                                                            {{ __('messages.meal') }}</span>
                                                        <span><i class="fa fa-users"></i>
                                                            {{ count($recipe->mealPlan->family_members) }}
                                                            {{ __('messages.person') }}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="card-body" style="width: 100%; direction: ltr; padding: 0px;">
                                                <div class="btn-group" style="width: 100%;">
                                                    <form id="delete-form-{{ $recipe->mealPlan->id }}"
                                                        style="display: none;" method="POST"
                                                        action="{{ route('users.meals.destroy', parameters: $recipe->mealPlan->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button onclick="deletePlan({{ $recipe->mealPlan->id }})"
                                                        type="button" class="btn btn-primary" style="border-top-left-radius: 0px !important;
                                                                border-top-right-radius: 0px !important;
                                                                border-bottom-right-radius: 0px !important;
                                                                border-bottom-left-radius: 12px !important;">
                                                        {{ __('messages.delete') }}
                                                    </button>

                                                    {!! $swalScript !!}
                                                    <script>
                                                        function deletePlan() {
                                                            Swal.fire({
                                                                title: "{{ __('messages.are_you_sure') }}",
                                                                text: "{{ __('messages.cannot_restore') }}",
                                                                icon: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: "#3085d6",
                                                                cancelButtonColor: "#d33",
                                                                confirmButtonText: "{{ __('messages.yes_delete') }}",
                                                                cancelButtonText: "{{ __('messages.close') }}"
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    Swal.fire({
                                                                        title: "{{ __('messages.deleted') }}",
                                                                        text: "{{ __('messages.plan_deleted_successfully') }}",
                                                                        icon: "success"
                                                                    });
                                                                    document.getElementById('delete-form-' + {{ $recipe->mealPlan->id }}).submit();
                                                                }
                                                            });
                                                        }
                                                    </script>

                                                    <button type="button" class="btn btn-primary" onclick="edit()">{{
                                                        __('messages.edit') }}</button>
                                                    <button class="btn btn-primary" onclick="show()"
                                                        style="border-top-right-radius: 0px !important; border-bottom-right-radius: 12px !important;">
                                                        {{ __('messages.show') }}
                                                    </button>

                                                    <script>
                                                        function show() {
                                                            window.location.href = "{{ route('users.meals.index', $recipe->mealPlan->id) }}";
                                                        }
                                                        function edit() {
                                                            window.location.href = "{{ route('meal_plans.edit', $recipe->mealPlan->id) }}";
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                                @else
                                <p style="text-align: center; font-size: 21px;">{{ __('messages.no_plans') }}</p>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content End -->
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>