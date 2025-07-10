<!DOCTYPE html>
<html lang="en">
<head>
    <title>نوع التعاقد</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/app-logo/favicon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
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
        <header class="header header-fixed border-bottom onepage">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">نوع التعاقد</h4>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <main class="page-content space-top" style="margin-top: 50px;">
            <div class="container fixed-full-area">
                <form method="POST" action="{{ route('c1he3f.profile.updateAgreementType') }}" id="contractForm">
                    @csrf
                    <div class="error-page" style="top: 20%;">
                        <div class="clearfix">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">نوع التعاقد</label>
                                    <select class="form-select" name="contract_type" id="contract_type" style="margin: auto; width:95%; text-align: center;">
                                        <option value="">اختر نوع التعاقد</option>
                                        <option value="per_recipe" {{ Auth::user()->chefProfile && Auth::user()->chefProfile->contract_type == 'per_recipe' ? 'selected' : '' }} {{ old('contract_type') == 'per_recipe' ? 'selected' : '' }}>
                                            بالوصفة
                                        </option>
                                        <option value="annual_subscription" {{ Auth::user()->chefProfile && Auth::user()->chefProfile->contract_type == 'annual_subscription' ? 'selected' : '' }} {{ old('contract_type') == 'annual_subscription' ? 'selected' : '' }}>
                                            بنظام الاشتراك
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div id="subscription-fields" class="col-md-12" style="top: 100%; position: fixed; display: none;">
                                <div class="">
                                    الاسعار بالدرهم الاماراتي فقط
                                </div>
                                <div class="row" style="width: 95%; margin: auto;">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">سعر اشتراك 3 شهور</label>
                                            <input type="number" step="0.01" class="form-control" name="subscription_3_months_price" value="{{ old('subscription_3_months_price', Auth::user()->chefProfile->subscription_3_months_price ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">سعر اشتراك 6 شهور</label>
                                            <input type="number" step="0.01" class="form-control" name="subscription_6_months_price" value="{{ old('subscription_6_months_price', Auth::user()->chefProfile->subscription_6_months_price ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">سعر اشتراك 12 شهر</label>
                                            <input type="number" step="0.01" class="form-control" name="subscription_12_months_price" value="{{ old('subscription_12_months_price', Auth::user()->chefProfile->subscription_12_months_price ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-fixed-btn bottom-0 bg-white">
                        <button type="submit" class="btn btn-lg btn-thin btn-primary rounded-xl w-100">
                            حفظ</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contractTypeSelect = document.getElementById('contract_type');
        const subscriptionFields = document.getElementById('subscription-fields');
        const contractForm = document.getElementById('contractForm');
        const currentContractType = '{{ Auth::user()->chefProfile->contract_type ?? "" }}';

        function toggleFields() {
            subscriptionFields.style.display = contractTypeSelect.value === 'annual_subscription' ? 'block' : 'none';
        }

        toggleFields();

        contractTypeSelect.addEventListener('change', function() {
            const selectedValue = this.value;

            if (currentContractType === 'annual_subscription' && selectedValue === 'per_recipe') {
                Swal.fire({
                    title: 'تأكيد تغيير نوع التعاقد'
                    , html: `
                    <div style="text-align: right; margin-bottom: 20px;">
                        <p>لتغيير نوع التعاقد من <strong>بنظام الاشتراك</strong> إلى <strong>نظام الوصفة</strong> يجب عليك كتابة كلمة <strong>change</strong> في الحقل أدناه.</p>
                        <p style="color: #dc3545; font-size: 0.9em; margin-top: 10px;">
                            <strong>تحذير:</strong> سيتم تحويل جميع الوصفات المدفوعة إلى غير فعالة ويجب عليك وضع سعر محدد لكل وصفة.
                        </p>
                    </div>
                    <div class="confirmation-input">
                        <label for="confirmationInput" style="display: block; margin-bottom: 8px; font-weight: bold;">اكتب كلمة "change" للتأكيد:</label>
                        <input type="text" id="confirmationInput" class="swal2-input" placeholder="اكتب change هنا" style="margin:0px; width: 100%; text-align: center;">
                        <div id="inputError" class="error-text" style="display: none; color: #dc3545; font-size: 0.875em; margin-top: 5px;">يجب كتابة كلمة "change" بالضبط</div>
                    </div>
                `
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'تأكيد التغيير'
                    , cancelButtonText: 'إلغاء'
                    , customClass: {
                        popup: 'text-right'
                        , title: 'text-right'
                        , content: 'text-right'
                    }
                    , preConfirm: () => {
                        const inputValue = document.getElementById('confirmationInput').value;
                        const errorDiv = document.getElementById('inputError');
                        if (inputValue !== 'change') {
                            errorDiv.style.display = 'block';
                            return false;
                        }
                        return true;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        toggleFields();

                        // Show success message and submit form on confirmation
                        Swal.fire({
                            title: 'تم التأكيد'
                            , text: 'تم تغيير نوع التعاقد بنجاح'
                            , icon: 'success'
                            , confirmButtonText: 'موافق'
                            , customClass: {
                                popup: 'text-right'
                                , title: 'text-right'
                                , content: 'text-right'
                            }
                        }).then((successResult) => {
                            if (successResult.isConfirmed) {
                                // Submit the form when user clicks "موافق"
                                contractForm.submit();
                            }
                        });
                    } else {
                        // User cancelled, revert to previous selection
                        contractTypeSelect.value = currentContractType;
                        toggleFields();
                    }
                });
            } else {
                toggleFields();
            }
        });

        // Form submission handler
        contractForm.addEventListener('submit', function(e) {
            const selectedValue = contractTypeSelect.value;

            // If changing from annual_subscription to per_recipe, prevent default submission
            // because it will be handled by the confirmation dialog
            if (currentContractType === 'annual_subscription' && selectedValue === 'per_recipe') {
                e.preventDefault();
                // Trigger the change event to show confirmation dialog
                contractTypeSelect.dispatchEvent(new Event('change'));
            }
            // For other cases, form will submit normally
        });
    });

</script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('index.js') }}"></script>
</body>

</html>
