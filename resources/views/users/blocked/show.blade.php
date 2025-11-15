<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <!-- Title -->
    <title>المحظورات</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta name="keywords"
        content="android, ios, mobile, mobile template, mobile app, ui kit, dark layout, app, delivery, ecommerce, material design, mobile, mobile web, order, phonegap, pwa, store, web app, Ombe, coffee app, coffee template, coffee shop, mobile UI, coffee design, app template, responsive design, coffee showcase, style app, trendy app, modern UI, technology, User-Friendly Interface, Coffee Shop App, PWA (Progressive Web App), Mobile Ordering, Coffee Experience, Digital Menu, Innovative Technology, App Development, Coffee Experience, cafe, bootatrap, Bootstrap Framework, UI/UX Design, Coffee Shop Technology, Online Presence, Coffee Shop Website, Cafe Template, Mobile App Design, Web Application, Digital Presence, ">

    <meta name="description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta property="og:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">
    <meta name="twitter:card" content="summary_large_image">

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
        .container-cart {
            box-shadow: 0px 0px 3px 3px #ededed;
            border-radius: 20px;
            margin: 20px;
            background: #fafafa;
        }

        .dz-card.list {
            display: flex;
            margin-bottom: 0px !important;
            overflow: visible;
        }

        .featured-list li:last-child .dz-card.list {
            margin-bottom: 20px;
        }

        .dz-card {
            position: relative;
            height: 100%;
            border-radius: var(--border-radius-xl);
            overflow: hidden;
        }

        .dz-card.list .dz-media {
            margin-left: 20px;
            overflow: visible;
            max-width: 112px;
            min-width: 112px;
        }

        .bookmark {
            position: absolute;
            bottom: 10px;
            text-align: center;
            align-items: center;
            justify-content: end;
            display: flex;
            margin: auto;
            left: 17px;
            width: 100%;
        }

        .dz-card.list .dz-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
            padding: 10px 0;
        }

        .dz-card.list .dz-media img {
            display: flex;
            border-radius: var(--border-radius-xl);
            width: 100%;
            height: 100%;
        }

        .container-cart img {
            border-radius: 0px 20px 20px 0px !important;
        }

        label input {
            width: 23px !important;
            height: 28px !important;
        }

        .correct {
            position: absolute;
            font-size: 18px;
            left: 1px;
            top: 26px;
            font-size: 13px;
            border: 0px;
            background-color: red;
            border-radius: 5px;
            padding: 7.8px 10px;
            color: white;
        }

        .menu {
            background: #660099;
            color: white;
            border-radius: 5px;
            padding: 7.5px 10px;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #660099 !important;
            box-shadow: unset;
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
        <!-- Preloader end-->

        <!-- Header -->
        <header class="header header-fixed" style="border-bottom: 1px solid #eee;">
            <div class="header-content">
                <div class="right-content d-flex align-items-center gap-4">
                    <!-- <a href="blockes.html" class="menu">
      القائمة
     </a> -->
                </div>
                <div class="mid-content">
                    <h4 class="title">{{ __('messages.blacklist') }}</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('users.blocked.index') }}" id="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

<!-- Main Content Start -->
<main class="page-content space-top">
	<div class="container">

		<!-- SearchBox -->
		<div class="search-box">
			<!-- SearchBox -->
			<div class="search-box">
				<div class="input-group input-radius input-rounded input-lg">
					<input type="search" id="searchBlockedRecipes"
						placeholder="{{ __('messages.search_blocked_recipes') }}" class="form-control">
					<span class="input-group-text">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M9.65925 19.3102C11.8044 19.3103 13.8882 18.5946 15.5806 17.2764L21.9653 23.6612C22.4423 24.1218 23.2023 24.1086 23.663 23.6316C24.1123 23.1664 24.1123 22.4288 23.663 21.9635L17.2782 15.5788C20.5491 11.3682 19.7874 5.30333 15.5769 2.03243C11.3663 -1.23848 5.30149 -0.476799 2.03058 3.73374C-1.24033 7.94428 -0.478646 14.0092 3.73189 17.2801C5.42702 18.5969 7.51269 19.3113 9.65925 19.3102ZM4.52915 4.5273C7.36245 1.69394 11.9561 1.69389 14.7895 4.5272C17.6229 7.3605 17.6229 11.9542 14.7896 14.7876C11.9563 17.6209 7.36261 17.621 4.52925 14.7877C4.5292 14.7876 4.5292 14.7876 4.52915 14.7876C1.69584 11.9749 1.67915 7.39794 4.49181 4.56464C4.50424 4.55216 4.51667 4.53973 4.52915 4.5273Z"
								fill="#C9C9C9" />
						</svg>
					</span>
				</div>
			</div>

			<!-- JavaScript للبحث في الوجبات المحظورة -->
			<script>
				document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchBlockedRecipes');
                    const recipeCards = document.querySelectorAll('.container-cart');
                    if (!searchInput) return;
                    searchInput.addEventListener('input', function() {
                        const searchTerm = this.value.trim().toLowerCase();
                        recipeCards.forEach(function(card) {
                            const title = card.querySelector('.title span');
                            const titleText = title ? title.textContent.toLowerCase() : '';
                            const kitchen = card.querySelector('.tags');
                            const kitchenText = kitchen ? kitchen.textContent.toLowerCase() : '';
                            const membersDiv = card.querySelector('div[style*="margin-left: 28px"]');
                            const membersText = membersDiv ? membersDiv.textContent.toLowerCase() : '';
                            const badges = card.querySelectorAll('.badge');
                            let badgesText = '';
                            badges.forEach(badge => {
                                badgesText += badge.textContent.toLowerCase() + ' ';
                            });
                            if (searchTerm === '') {
                                card.style.display = '';
                            }
                            else if (titleText.includes(searchTerm) ||
                                kitchenText.includes(searchTerm) ||
                                membersText.includes(searchTerm) ||
                                badgesText.includes(searchTerm)) {
                                card.style.display = '';
                            }
                            else {
                                card.style.display = 'none';
                            }
                        });
                        const visibleCards = Array.from(recipeCards).filter(card => card.style.display !== 'none');
                        const oldMessage = document.querySelector('.no-results-message');
                        if (oldMessage) {
                            oldMessage.remove();
                        }
                        if (visibleCards.length === 0 && searchTerm !== '') {
                            const container = document.querySelector('.container');
                            const message = document.createElement('div');
                            message.className = 'no-results-message text-center py-5';
                            message.innerHTML = `
                                <i class="fa fa-search" style="font-size: 50px; color: #ccc;"></i>
                                <h5 class="mt-3">{{ __('messages.no_results') }}</h5>
                                <p class="text-muted">{{ __('messages.no_blocked_results_message') }} "<strong>${searchTerm}</strong>"</p>
                            `;

                            const searchBox = document.querySelector('.search-box');
                            if (searchBox && searchBox.nextSibling) {
                                searchBox.parentNode.insertBefore(message, searchBox.nextSibling);
                            }
                        }
                    });
                });
			</script>
			<span style="text-align: center; display: flex; justify-content: center; color: #660099; margin-top: 5px;">
				{{ __('messages.choose_recipe_for_edit_or_delete') }}
			</span>
		</div>

		<!-- Products Area -->
		<div class="dz-custom-swiper">
			@if (count($blockedRecipes) == 0)
			<div class="text-center py-5">
				<i class="fa fa-ban" style="font-size: 60px; color: #ccc;"></i>
				<h5 class="mt-3">{{ __('messages.no_blocked_meals') }}</h5>
				<p class="text-muted">{{ __('messages.no_blocked_meals_message') }}</p>
				<a href="{{ route('users.blocked.index') }}" class="btn btn-primary mt-3">
					{{ __('messages.start_blocking_meals') }}
				</a>
			</div>
			@else
			@foreach ($blockedRecipes as $blockedItem)
			<a href="{{ route('users.blocked.edit', ['blocked' => $blockedItem['recipe']->id]) }}">
				<li class="container-cart">
					<div class="dz-card list">
						<div class="dz-media" style="position: relative;">
							<img src="{{ asset('storage/' . $blockedItem['recipe']->dish_image) }}"
								alt="{{ $blockedItem['recipe']->title }}">
						</div>
						<div class="dz-content">
							<div class="dz-head">
								<h6 class="title">
									<span>{{ $blockedItem['recipe']->title }}</span>
								</h6>
								<ul class="tag-list"></ul>

								@forelse($blockedItem['recipe']->subCategories as $subCategory)
								<span class="badge badge-info" style="margin-bottom: 3px;">
									{{ app()->getLocale() == 'ar' ? $subCategory->name_ar : $subCategory->name_en }}
								</span>
								@empty
								<span class="text-muted">{{ __('messages.none') }}</span>
								@endforelse

								<ul class="tag-list" style="display: flex; gap: 10px;">
									<li class="dz-price" style="text-align: center; font-size: 14px;">
										<i class="fa-solid fa-clock" style="color: var(--primary-color);"></i>
										{{ $blockedItem['recipe']->preparation_time }}
									</li>
									<li class="dz-price" style="text-align: center; font-size: 14px;">
										<i class="fa-solid fa-eye" style="color: var(--primary-color);"></i>
										{{ $blockedItem['recipe']->views }}
									</li>
									<li class="dz-price" style="text-align: center; font-size: 14px;">
										<i class="fa-solid fa-heart" style="color: var(--primary-color);"></i>
										{{ $blockedItem['recipe']->favorited_by_count ?? 0 }}
									</li>
								</ul>

								<div>
									<div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
										class="tags">
										<img src="{{ asset('storage/' . $blockedItem['recipe']->kitchen->image) }}"
											style="border-radius: 50% !important; width: 30px; height: 30px;" alt="">
										{{ app()->getLocale() == 'ar' ? $blockedItem['recipe']->kitchen->name_ar :
										$blockedItem['recipe']->kitchen->name_en }}
									</div>

									<div style="margin-top: 10px; height: 5px;"></div>

									<div>
										<i class="fa fa-users" style="color: #660099;"></i>
									</div>

									<div style="margin-left: 28px; color: #333; font-size: 14px;">
										{{ $blockedItem['members_text'] }}
										<span style="color: #999; font-size: 12px;">
											({{ $blockedItem['blocked_count'] }}
											{{ $blockedItem['blocked_count'] > 1 ? __('messages.members') :
											__('messages.member') }})
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
			</a>
			@endforeach

			@endif
		</div>

	</div>
</main>
<!-- Main Content End -->
</div>

{!! $swalScript !!}
<script>
	function deleteRecipe() {
        Swal.fire({
            title: "{{ __('messages.confirm_remove_block') }}",
            showDenyButton: true,
            confirmButtonText: "{{ __('messages.yes') }}",
            denyButtonText: "{{ __('messages.no') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("{{ __('messages.block_removed') }}", "", "success");
            } else if (result.isDenied) {
                Swal.fire("{{ __('messages.cancelled') }}", "", "info");
            }
        });
    }
</script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
    <script src="assets/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
    <script src="assets/js/noui-slider.init.js"></script><!-- NOUSLIDER MIN JS-->
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
