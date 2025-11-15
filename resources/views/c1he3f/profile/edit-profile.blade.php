<!DOCTYPE html>
<html lang="en">
<head>
    <title>تعديل الملف الشخصي</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta property="og:image" content="{{ asset('assets/images/social-image.png') }}">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description" content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="{{ asset('assets/images/social-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-LCY/8p2NaW6Bsmo1g3+6j+EkH0dY1o+2C73AVM0DIA3A92vN0bFz5H6uX3bM6+0F5a1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    {!! $swalScript !!}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        .error-message {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
            text-align: right;
        }

    </style>
</head>

<body>
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
                    <h4 class="title">تعديل الملف الشخصي</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <main class="page-content space-top p-b80">
            <div class="container">
                <div class="edit-profile">
                    <form action="{{ route('c1he3f.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-image">
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    @php
                                    $profileImage = Auth::user()->chefProfile?->official_image
                                    ? asset('storage/' . Auth::user()->chefProfile->official_image)
                                    : asset('assets/images/chef (3).png'); // Placeholder image if no image
                                    @endphp
                                    <img class="img-fluid" id="imagePreview" style="border-radius: 50%; width: 100%; height: 100%;" src="{{ $profileImage }}" alt="صورة البروفايل">

                                    <div class="change-btn" style="cursor: pointer;">
                                        <input type='file' class="form-control d-none" id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg">
                                        <label for="imageUpload">
                                            <i class="fi fi-rr-pencil"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4" style="text-align: center;">
                            <label class="form-label" for="name">الاسم</label>
                            <div class="input-group input-mini input-sm">
                                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control">
                            </div>
                            @error('name')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4" style="text-align: center;">
                            <label class="form-label" for="email">البريد الالكتروني</label>
                            <div class="input-group input-mini input-sm">
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
                            </div>
                            @error('email')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($user->role == 'طاه') {{-- عرض هذا القسم إذا كان المستخدم المحرر شيف --}}
                        <div id="chef-fields" class="chef-fields">
                            <div class="col-md-12" style="text-align: center;">
                                <div class="mb-3">
                                    <label class="form-label" for="country">الدولة</label>
                                    <select class="form-select" id="country" name="country" required style="width: 100%; text-align: center;">
                                        <option value="" {{ !old('country') && !$user->chefProfile?->country ? 'selected' : '' }}>اختر الدولة</option>
                                        <option value="sa" {{ old('country', $user->chefProfile?->country) == 'sa' ? 'selected' : '' }}>المملكة العربية السعودية</option>
                                        <option value="ae" {{ old('country', $user->chefProfile?->country) == 'ae' ? 'selected' : '' }}>الإمارات العربية المتحدة</option>
                                        <option value="qa" {{ old('country', $user->chefProfile?->country) == 'qa' ? 'selected' : '' }}>قطر</option>
                                        <option value="kw" {{ old('country', $user->chefProfile?->country) == 'kw' ? 'selected' : '' }}>الكويت</option>
                                        <option value="bh" {{ old('country', $user->chefProfile?->country) == 'bh' ? 'selected' : '' }}>البحرين</option>
                                        <option value="om" {{ old('country', $user->chefProfile?->country) == 'om' ? 'selected' : '' }}>سلطنة عُمان</option>
                                        <option value="ye" {{ old('country', $user->chefProfile?->country) == 'ye' ? 'selected' : '' }}>اليمن</option>
                                        <option value="iq" {{ old('country', $user->chefProfile?->country) == 'iq' ? 'selected' : '' }}>العراق</option>
                                        <option value="sy" {{ old('country', $user->chefProfile?->country) == 'sy' ? 'selected' : '' }}>سوريا</option>
                                        <option value="jo" {{ old('country', $user->chefProfile?->country) == 'jo' ? 'selected' : '' }}>الأردن</option>
                                        <option value="lb" {{ old('country', $user->chefProfile?->country) == 'lb' ? 'selected' : '' }}>لبنان</option>
                                        <option value="ps" {{ old('country', $user->chefProfile?->country) == 'ps' ? 'selected' : '' }}>فلسطين</option>
                                        <option value="eg" {{ old('country', $user->chefProfile?->country) == 'eg' ? 'selected' : '' }}>مصر</option>
                                        <option value="sd" {{ old('country', $user->chefProfile?->country) == 'sd' ? 'selected' : '' }}>السودان</option>
                                        <option value="ly" {{ old('country', $user->chefProfile?->country) == 'ly' ? 'selected' : '' }}>ليبيا</option>
                                        <option value="tn" {{ old('country', $user->chefProfile?->country) == 'tn' ? 'selected' : '' }}>تونس</option>
                                        <option value="dz" {{ old('country', $user->chefProfile?->country) == 'dz' ? 'selected' : '' }}>الجزائر</option>
                                        <option value="ma" {{ old('country', $user->chefProfile?->country) == 'ma' ? 'selected' : '' }}>المغرب</option>
                                        <option value="mr" {{ old('country', $user->chefProfile?->country) == 'mr' ? 'selected' : '' }}>موريتانيا</option>
                                        <option value="dj" {{ old('country', $user->chefProfile?->country) == 'dj' ? 'selected' : '' }}>جيبوتي</option>
                                        <option value="so" {{ old('country', $user->chefProfile?->country) == 'so' ? 'selected' : '' }}>الصومال</option>
                                        <option value="km" {{ old('country', $user->chefProfile?->country) == 'km' ? 'selected' : '' }}>جزر القمر</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif @if(session('error'))

                        <div class="error-message text-center mt-3">{{ session('error') }}</div>
                        @endif

                        <div class="footer-fixed-btn bottom-0 bg-white">
                            <button type="submit" class="btn btn-lg btn-thin btn-primary rounded-xl w-100">
                                تحديث الملف الشخصي</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('index.js') }}"></script> --}} <script>
        // SweetAlert for session messages
        @if(session('success'))
        Swal.fire({
            icon: 'success'
            , title: 'نجاح!'
            , text: '{{ session('
            success ') }}'
            , confirmButtonText: 'حسناً'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error'
            , title: 'خطأ!'
            , text: '{{ session('
            error ') }}'
            , confirmButtonText: 'حسناً'
        });
        @endif

        @if(session('info'))
        Swal.fire({
            icon: 'info'
            , title: 'معلومة!'
            , text: '{{ session('
            info ') }}'
            , confirmButtonText: 'حسناً'
        });
        @endif

        // Image upload preview logic
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result); // Update src attribute directly
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

        // The remove-img logic might need to be re-evaluated if you're not using background-image for #imagePreview
        // For direct <img> src, you would just change its src to a default placeholder.
        // $('.remove-img').on('click', function() {
        //     var imageUrl = "{{ asset('assets/images/user.png') }}"; // A default placeholder image
        //     $('#imagePreview').attr('src', imageUrl);
        // });

    </script>
</body>
</html>
