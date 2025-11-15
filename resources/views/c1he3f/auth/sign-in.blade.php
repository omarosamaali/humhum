@extends('layouts.chef')
@section('content')

<body style="direction: rtl">
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="sidebar dz-floting-sidebar">
            <div class="sidebar-header">
                <div class="app-logo">
                    <img class="logo-dark" src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                    <img class="logo-white d-none" src="{{ asset('assets/images/app-logo/logo-white.png') }}" alt="logo">
                </div>
                <div class="title-bar mb-0">
                    <h4 class="title font-w600" style="visibility: collapse;">Main وصفة</h4>
                    <a href="{{ url()->previous() ?: route('home') }}" class="floating-close"><i class="feather icon-x"></i></a>
                </div>
            </div>
            <ul class="nav navbar-nav" style="direction: ltr;">
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.auth.welcome') }}">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_329_300)">
                                    <path d="M15.7 11.7171C16.6839 10.9477 17.4031 9.89048 17.7575 8.69283C18.1118 7.49518 18.0836 6.21681 17.6767 5.03597C17.2698 3.85513 16.5046 2.8307 15.4877 2.10553C14.4708 1.38036 13.253 0.990601 12.004 0.990601C10.755 0.990601 9.53719 1.38036 8.52031 2.10553C7.50342 2.8307 6.73819 3.85513 6.33131 5.03597C5.92443 6.21681 5.89619 7.49518 6.25053 8.69283C6.60487 9.89048 7.32413 10.9477 8.308 11.7171C6.44917 12.4567 4.85467 13.7364 3.73027 15.3911C2.60587 17.0458 2.00318 18.9995 2 21.0001V22.0001C2 22.2653 2.10536 22.5196 2.29289 22.7072C2.48043 22.8947 2.73478 23.0001 3 23.0001H21C21.2652 23.0001 21.5196 22.8947 21.7071 22.7072C21.8946 22.5196 22 22.2653 22 22.0001V21.0001C21.9975 19.0004 21.3959 17.0474 20.273 15.3928C19.1501 13.7382 17.5573 12.4579 15.7 11.7171V11.7171ZM8 7.00007C8 6.20895 8.2346 5.43559 8.67412 4.77779C9.11365 4.12 9.73836 3.60731 10.4693 3.30456C11.2002 3.00181 12.0044 2.92259 12.7804 3.07693C13.5563 3.23128 14.269 3.61224 14.8284 4.17165C15.3878 4.73106 15.7688 5.44379 15.9231 6.21971C16.0775 6.99564 15.9983 7.7999 15.6955 8.53081C15.3928 9.26171 14.8801 9.88642 14.2223 10.3259C13.5645 10.7655 12.7911 11.0001 12 11.0001C10.9391 11.0001 9.92172 10.5786 9.17157 9.8285C8.42143 9.07835 8 8.06094 8 7.00007ZM4 21.0001C4 18.8783 4.84285 16.8435 6.34315 15.3432C7.84344 13.8429 9.87827 13.0001 12 13.0001C14.1217 13.0001 16.1566 13.8429 17.6569 15.3432C19.1571 16.8435 20 18.8783 20 21.0001H4Z" fill="#B0ACB3" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_329_300">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <span>ملفي</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.faqGuest') }}"> <span class="dz-icon">
                            <i class="fi fi-rr-comments text-dark"></i>
                        </span>
                        <span>الأسئلة الشائعة</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.aboutGuest') }}"> <span class="dz-icon">
                            <i class="fi fi-rr-info text-dark"></i>
                        </span>
                        <span>إعرفنا</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('c1he3f.auth.welcome') }}"> <span class="dz-icon">
                            <i class="feather icon-message-circle"></i>
                        </span>
                        <span>تواصل معنا</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="{{ route('c1he3f.auth.welcome') }}">
                        <span class="dz-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.65 3.10008C16.5318 3.04157 16.4033 3.00692 16.2717 2.9981C16.1401 2.98928 16.0081 3.00646 15.8831 3.04866C15.7582 3.09087 15.6428 3.15727 15.5435 3.24407C15.4442 3.33088 15.363 3.43639 15.3045 3.55458C15.246 3.67277 15.2114 3.80132 15.2025 3.9329C15.1937 4.06448 15.2109 4.19652 15.2531 4.32146C15.2953 4.4464 15.3617 4.5618 15.4485 4.66108C15.5353 4.76036 15.6408 4.84157 15.759 4.90008C17.4682 5.74788 18.8405 7.14857 19.6532 8.87467C20.4659 10.6008 20.6712 12.5509 20.2358 14.4084C19.8004 16.2659 18.7499 17.9217 17.2548 19.1069C15.7597 20.292 13.9079 20.937 12 20.937C10.0922 20.937 8.24035 20.292 6.74526 19.1069C5.25018 17.9217 4.19964 16.2659 3.76424 14.4084C3.32885 12.5509 3.53417 10.6008 4.34687 8.87467C5.15956 7.14857 6.5319 5.74788 8.24102 4.90008C8.47972 4.78192 8.6617 4.57379 8.74694 4.32146C8.83217 4.06913 8.81368 3.79327 8.69553 3.55458C8.57737 3.31588 8.36924 3.1339 8.11691 3.04866C7.86458 2.96343 7.58872 2.98192 7.35002 3.10008C5.23724 4.14875 3.54096 5.88079 2.5366 8.01498C1.53223 10.1492 1.27875 12.5602 1.81731 14.8566C2.35587 17.153 3.65485 19.2 5.50334 20.6651C7.35184 22.1302 9.64131 22.9275 12 22.9275C14.3587 22.9275 16.6482 22.1302 18.4967 20.6651C20.3452 19.2 21.6442 17.153 22.1827 14.8566C22.7213 12.5602 22.4678 10.1492 21.4635 8.01498C20.4591 5.88079 18.7628 4.14875 16.65 3.10008V3.10008Z" fill="#FF8484" />
                                <path d="M12 13.0001C12.2652 13.0001 12.5196 12.8948 12.7071 12.7072C12.8947 12.5197 13 12.2654 13 12.0001V2.00012C13 1.73491 12.8947 1.48055 12.7071 1.29302C12.5196 1.10548 12.2652 1.00012 12 1.00012C11.7348 1.00012 11.4804 1.10548 11.2929 1.29302C11.1054 1.48055 11 1.73491 11 2.00012V12.0001C11 12.2654 11.1054 12.5197 11.2929 12.7072C11.4804 12.8948 11.7348 13.0001 12 13.0001Z" fill="#FF8484" />
                            </svg>
                        </span>
                        <span>تسجيل دخول</span>
                    </a>
                    <form id="sign-out-form" action="{{ route('chef.logout') }}" method="POST" class="d-none">

                        @csrf
                    </form>
                </li>
            </ul>
            <div class="sidebar-bottom" style="direction: ltr;">
                <div class="dz-mode">
                    <div class="theme-btn">
                        <i class="feather icon-sun sun"></i>
                        <i class="feather icon-moon moon"></i>
                    </div>
                </div>
                <div class="app-info">
                    <h6 class="name">هم هم - الشريك</h6>
                    <span class="ver-info">v.4.0.1</span>
                </div>
            </div>
        </div>
        <!-- Main Content Start  -->
        <div class="dz-nav-floting">
            <header class="header py-2 mx-auto" style="position: fixed; width: 100%;">
                <div class="header-content">
                    <div class="left-content">
                        <div class="info">
                        </div>
                    </div>
                    <div class="mid-content">
                        <div class="logo" style="position: relative; display: flex; justify-content: center;">
                            <img src="{{ asset('assets/images/app-logo/logo.png') }}" alt="logo">
                        </div>
                    </div>
                    <div class="right-content d-flex align-items-center gap-4">
                                                <a href="javascript:void(0);" class="icon dz-floating-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect y="2" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect y="18" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect x="4" y="10" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                            </svg>
                        </a>

                    </div>
                </div>
            </header>

            <main class="page-content" style="margin-top: 100px;">
                <div class="container py-0">
                    <div class="search-box">
                        @if ($banner)
                        <img style="width: 100%; height: 300px; border-radius: 15px;" src="{{ asset('storage/' . $banner->image) }}" alt="">
                        @else
                        <img style="width: 100%;" src="{{ asset('path/to/default-image.jpg') }}" alt="Default Banner">
                        @endif
                    </div>
                    <div class="title-bar mb-0">
                        <h5 class="title">الطهاه</h5>
                    </div>
                    <div class="swiper categories-swiper dz-swiper m-b20">
                        <div class="swiper-wrapper" style="height: min-content;">
                            @foreach ($users as $user)
                            <div class="swiper-slide">
                                <div>
                                    <div class="dz-categories-bx" style="padding: 15px !important; width: 220px;">
                                        <div class="icon-bx">
                                            <img src="{{ asset('storage/' . $user->chefProfile?->official_image) }}" style="border-radius: 50%; width: 50px; height: 50px;" alt="">
                                        </div>
                                        <div class="dz-content" style="display: flex; align-items: center;">
                                            <h6 class="title">
                                                {{ $user->name }}
                                            </h6>
                                            {{-- <span class="وصفة text-primary">{{ $user->recipes_count ?? 0  }}
                                            وصفة</span> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="title-bar mb-0">
                        <h5 class="title">المطابخ</h5>
                    </div>
                    <div class="swiper categories-swiper dz-swiper m-b20">
                        <div class="swiper-wrapper" style="height: min-content;">
                            @foreach ($kitchens as $kitchen)
                            <div class="swiper-slide">
                                <div>
                                    <div class="dz-categories-bx" style="padding: 15px !important;">
                                        <div class="icon-bx">
                                            <img src="{{ asset('storage/' . $kitchen->image) }}" style="border-radius: 50%; width: 50px; height: 50px;" alt="">
                                        </div>
                                        <div class="dz-content">
                                            <h6 class="title">
                                                {{ $kitchen->name_ar }}
                                            </h6>
                                            <span class="وصفة text-primary">{{ $kitchen->kitchen_count ?? 0  }}
                                                وصفة</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
@if($hosp)
<div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; background: white; padding: 15px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

    <div>
        <img style="width: 100px; height: 100px; border-radius: 15px; object-fit: cover;" 
        src="{{ $hosp->calc_nutrition_image ? asset('storage/' . $hosp->calc_nutrition_image) : 'https://img.freepik.com/free-vector/black-girl-woman-big-colored-concept-beautiful-woman-sitting-front-artwork-with-flowers-colorful-leaves-vector-illustration_1284-79511.jpg' }}" alt="{{ $hosp->title }}">


    </div>

    <div style="flex: 1;">
        <p style="color: black; font-weight: 600; font-size: 16px; margin-bottom: 10px; line-height: 1.4;">
            {{ $hosp->title_ar }}
        </p>

        <button onclick="showHospDetails({{ $hosp->id }})" style="padding: 8px 16px; border-radius: 7px; background-color: #000000; color: white; border: none; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">
            عرض المزيد
        </button>
    </div>
</div>

<!-- مودال لعرض التفاصيل -->
<div id="hospModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; border-radius: 15px; padding: 20px; max-width: 90%; max-height: 80%; overflow-y: auto; position: relative;">
        <button onclick="closeHospModal()" style="position: absolute; top: 15px; right: 15px; background: #f3f4f6; border: none; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; font-size: 18px;">
            ×
        </button>

        <h3 style="color: #1f2937; font-weight: bold; font-size: 18px; margin-bottom: 15px;">
            {{-- {{ $hosp->title }} --}}
        </h3>

        @if($hosp->nutrition_label_image)

        <div style="margin-bottom: 15px;">
            <img style="width: 100%; height: 200px; border-radius: 10px;" src="{{ asset('storage/' . $hosp->nutrition_label_image) }}" alt="صورة فرعية">

        </div>
        @endif

        <div style="color: #4b5563; line-height: 1.6; font-size: 14px;">
            {{ $hosp->description_ar }}
        </div>
    </div>
</div>
@if($food)
<div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; background: white; padding: 15px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <div>
        <img style="width: 100px; height: 100px; border-radius: 15px; " src="{{ $food->main_image ? asset('storage/' . $food->main_image) : 'https://img.freepik.com/free-photo/fresh-healthy-food-table_144627-16502.jpg' }}" alt="{{ $food->title }}">
    </div>

    <div style="flex: 1;">
        <p style="color: black; font-weight: 600; font-size: 16px; margin-bottom: 10px; line-height: 1.4;">
            {{ $food->title_ar }}
        </p>

        <button onclick="showModal('foodModal')" style="padding: 8px 16px; border-radius: 7px; background-color: #000000; color: white; border: none; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">
            عرض المزيد
        </button>
    </div>
</div>
@endif

<!-- عرض Types -->
@if($types)
<div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; background: white; padding: 15px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <div>
        <img style="width: 100px; height: 100px; border-radius: 15px;" src="{{ $types->main_image ? asset('storage/' . $types->main_image) : 'https://img.freepik.com/free-photo/various-vegetables-black-table_1220-687.jpg' }}" alt="{{ $types->title }}">
    </div>

    <div style="flex: 1;">
        <p style="color: black; font-weight: 600; font-size: 16px; margin-bottom: 10px; line-height: 1.4;">
            {{ $types->title_ar }}
        </p>

        <button onclick="showModal('typesModal')" style="padding: 8px 16px; border-radius: 7px; background-color: #000000; color: white; border: none; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">
            عرض المزيد
        </button>
    </div>
</div>
@endif

<!-- مودال Food -->
@if($food)
<div id="foodModal" class="modal-overlay">
    <div class="modal-content">
        <button onclick="closeModal('foodModal')" class="modal-close-btn">×</button>

        <h3 style="color: #1f2937; font-weight: bold; font-size: 18px; margin-bottom: 15px;">
            {{-- {{ $food->title_ar }} --}}
        </h3>

        @if($food->sub_image)
        <div style="margin-bottom: 15px;">
            <img style="width: 100%; height: 200px; border-radius: 10px;" src="{{ asset('storage/' . $food->sub_image) }}" alt="صورة فرعية">
        </div>
        @endif

        <div style="color: #4b5563; line-height: 1.6; font-size: 14px;">
            {{ $food->description_ar }}
        </div>
    </div>
</div>
@endif

<!-- مودال Types -->
@if($types)
<div id="typesModal" class="modal-overlay">
    <div class="modal-content">
        <button onclick="closeModal('typesModal')" class="modal-close-btn">×</button>

        <h3 style="color: #1f2937; font-weight: bold; font-size: 18px; margin-bottom: 15px;">
            {{-- {{ $types->title_ar }} --}}
        </h3>

        @if($types->sub_image)
        <div style="margin-bottom: 15px;">
            <img style="width: 100%; height: 200px; border-radius: 10px;" src="{{ asset('storage/' . $types->sub_image) }}" alt="صورة فرعية">
        </div>
        @endif

        <div style="color: #4b5563; line-height: 1.6; font-size: 14px;">
            {{ $types->description_ar }}
        </div>
    </div>
</div>
@endif

<script>
    function showHospDetails(hospId) {
        document.getElementById('hospModal').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // منع التمرير في الخلفية
    }

    function closeHospModal() {
        document.getElementById('hospModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // إعادة تفعيل التمرير
    }

    // إغلاق المودال عند الضغط على الخلفية
    document.getElementById('hospModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeHospModal();
        }
    });

</script>


<script>
    function showModal(modalId) {
        document.getElementById(modalId).style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // إغلاق المودال عند الضغط على الخلفية
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });

    // إغلاق المودال بمفتاح Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                if (modal.style.display === 'flex') {
                    closeModal(modal.id);
                }
            });
        }
    });

</script>
<style>
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        border-radius: 15px;
        padding: 20px;
        max-width: 90%;
        max-height: 80%;
        overflow-y: auto;
        position: relative;
        margin: 20px;
    }

    .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #f3f4f6;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        color: #666;
    }

    .modal-close-btn:hover {
        background: #e5e7eb;
    }

</style>

@endif

                </div>
            </main>
        </div>
    </div>
</body>

@endsection
