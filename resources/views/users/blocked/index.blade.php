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
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link rel="stylesheet" href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/blocked.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        <header class="header header-fixed" style="border-bottom: 1px solid #eee;">
            <div class="header-content">
                <div class="right-content d-flex align-items-center gap-4">
                    <a href="{{ route('users.blocked.show') }}" class="menu">
                        القائمة
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">المحظورات</h4>
                </div>
                <div class="left-content">
                    <a href="{{ route('users.welcome') }}" id="back-btn">
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
<!-- SearchBox -->
<div class="search-box">
    <div class="input-group input-radius input-rounded input-lg">
        <input type="search" id="searchRecipes" placeholder="ما هي الوصفات التي تبحث عنها" class="form-control">
        <span class="input-group-text">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.65925 19.3102C11.8044 19.3103 13.8882 18.5946 15.5806 17.2764L21.9653 23.6612C22.4423 24.1218 23.2023 24.1086 23.663 23.6316C24.1123 23.1664 24.1123 22.4288 23.663 21.9635L17.2782 15.5788C20.5491 11.3682 19.7874 5.30333 15.5769 2.03243C11.3663 -1.23848 5.30149 -0.476799 2.03058 3.73374C-1.24033 7.94428 -0.478646 14.0092 3.73189 17.2801C5.42702 18.5969 7.51269 19.3113 9.65925 19.3102ZM4.52915 4.5273C7.36245 1.69394 11.9561 1.69389 14.7895 4.5272C17.6229 7.3605 17.6229 11.9542 14.7896 14.7876C11.9563 17.6209 7.36261 17.621 4.52925 14.7877C4.5292 14.7876 4.5292 14.7876 4.52915 14.7876C1.69584 11.9749 1.67915 7.39794 4.49181 4.56464C4.50424 4.55216 4.51667 4.53973 4.52915 4.5273Z"
                    fill="#C9C9C9" />
            </svg>
        </span>
    </div>
</div>

<!-- JavaScript للبحث -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchRecipes');
    const recipeCards = document.querySelectorAll('.container-cart');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.trim().toLowerCase();
        
        recipeCards.forEach(function(card) {
            // نجيب عنوان الوجبة
            const title = card.querySelector('.title span');
            const titleText = title ? title.textContent.toLowerCase() : '';
            
            // نجيب اسم المطبخ
            const kitchen = card.querySelector('.tags');
            const kitchenText = kitchen ? kitchen.textContent.toLowerCase() : '';
            
            // نجيب التصنيفات الفرعية
            const badges = card.querySelectorAll('.badge');
            let badgesText = '';
            badges.forEach(badge => {
                badgesText += badge.textContent.toLowerCase() + ' ';
            });
            
            // لو البحث فاضي، نعرض كل الوجبات
            if (searchTerm === '') {
                card.style.display = '';
            } 
            // لو البحث موجود في العنوان أو المطبخ أو التصنيفات
            else if (titleText.includes(searchTerm) || 
                     kitchenText.includes(searchTerm) || 
                     badgesText.includes(searchTerm)) {
                card.style.display = '';
            } 
            // لو مش موجود، نخفي الكارد
            else {
                card.style.display = 'none';
            }
        });
        
        // نعرض رسالة لو مفيش نتائج
        const visibleCards = Array.from(recipeCards).filter(card => card.style.display !== 'none');
        
        // نشيل الرسالة القديمة لو موجودة
        const oldMessage = document.querySelector('.no-results-message');
        if (oldMessage) {
            oldMessage.remove();
        }
        
        // لو مفيش نتائج، نعرض رسالة
        if (visibleCards.length === 0 && searchTerm !== '') {
            const message = document.createElement('div');
            message.className = 'no-results-message text-center py-5';
            message.innerHTML = `
                <i class="fa fa-search" style="font-size: 50px; color: #ccc;"></i>
                <h5 class="mt-3">لا توجد نتائج</h5>
                <p class="text-muted">لم نجد أي وجبات تطابق بحثك عن "<strong>${searchTerm}</strong>"</p>
            `;
            document.querySelector('.dz-custom-swiper').prepend(message);
        }
    });
});
</script>

                <form id="blockForm" action="{{ route('blocked.store') }}" method="POST"
                    onsubmit="return validateForm(event)">
                    @csrf

                    <!-- SearchBox -->
                    <div class="mb-3" style="text-align: center; position: relative;">
                        <label class="form-label">حدد فرد عائلة او الجميع</label>
                        <select multiple class="form-select" name="country[]" id="familyMembers"
                            style="border: 1px solid #660099; width: 84%; text-align: center; color: black;">
                            <option value="" style="border-bottom: 1px solid #eee;">الجميع</option>
                            @foreach ($my_family as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>

                        <!-- الزر دا هو اللي هيبعت الفورم -->
                        <button type="submit" class="correct">حظر</button>
                    </div>

                    <!-- Products Area -->
                    <div class="dz-custom-swiper">
                        @foreach ($recipes as $recipe)
                        <li class="container-cart">
                            <div class="dz-card list">
                                <div class="dz-media" style="position: relative;">
                                    <img src="{{ asset('storage/' . $recipe->dish_image) }}" alt="">
                                </div>
                                <div class="dz-content">
                                    <div class="dz-head">
                                        <h6 class="title">
                                            <span>{{ $recipe->title }}</span>
                                        </h6>
                                        <ul class="tag-list"></ul>

                                        @forelse ($recipe->subCategories as $subCategory)
                                        <span class="badge badge-info" style="margin-bottom: 3px;">
                                            {{ $subCategory->name_ar }}
                                        </span>
                                        @empty
                                        <span class="text-muted">لا توجد</span>
                                        @endforelse

                                        <ul class="tag-list" style="display: flex; gap: 10px;">
                                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                <i class="fa-solid fa-clock" style="color: var(--primary-color);"></i>
                                                {{ $recipe->preparation_time }}
                                            </li>
                                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                <i class="fa-solid fa-eye" style="color: var(--primary-color);"></i>
                                                {{ $recipe->views }}
                                            </li>
                                            <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                <i class="fa-solid fa-heart" style="color: var(--primary-color);"></i>
                                                {{ $recipe->favorited_by_count }}
                                            </li>
                                        </ul>

                                        <div>
                                            <div style="display: flex; gap: 10px; font-size: 13px; align-items: center;"
                                                class="tags">
                                                <img src="{{ asset('storage/' . $recipe->kitchen->image) }}"
                                                    style="border-radius: 50% !important; width: 30px; height: 30px;"
                                                    alt="">
                                                {{ $recipe->kitchen->name_ar }}
                                            </div>

                                            <!-- هنخلي الـ checkbox دا يمثل وجبة -->
                                            <div class="bookmark" style="margin-top: 8px;">
                                                <label
                                                    style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                                                    <input type="checkbox" name="recipes[]" value="{{ $recipe->id }}">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </div>
                </form>
            </div>
        </main>
        <!-- Main Content End -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validateForm(event) {
event.preventDefault(); // نوقف الإرسال لحد ما نتأكد

// نجيب الوجبات المختارة
const selectedRecipes = document.querySelectorAll('input[name="recipes[]"]:checked');

// نجيب الأعضاء المختارين
const selectedMembers = document.querySelectorAll('#familyMembers option:checked');

// لو مفيش وجبات محددة
if (selectedRecipes.length === 0) {
Swal.fire({
title: "يجب اختيار وجبة واحدة على الأقل",
icon: "warning",
confirmButtonText: "حسناً",
confirmButtonColor: "#660099",
showClass: {
popup: `
animate__animated
animate__fadeInUp
animate__faster
`
},
hideClass: {
popup: `
animate__animated
animate__fadeOutDown
animate__faster
`
}
});
return false;
}

// لو مفيش أعضاء محددين
if (selectedMembers.length === 0) {
Swal.fire({
title: "يجب اختيار عضو واحد على الأقل أو الجميع",
icon: "warning",
confirmButtonText: "حسناً",
confirmButtonColor: "#660099",
showClass: {
popup: `
animate__animated
animate__fadeInUp
animate__faster
`
},
hideClass: {
popup: `
animate__animated
animate__fadeOutDown
animate__faster
`
}
});
return false;
}

// لو كل حاجة تمام، نبعت الفورم
document.getElementById('blockForm').submit();
return true;
}
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="country"]').select2({
                placeholder: "اختر الأعضاء",
                allowClear: true
            });
        });
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