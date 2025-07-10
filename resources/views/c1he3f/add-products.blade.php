@extends('layouts.chef')
@section('title', 'إضافة منتجات')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    /* Add any specific styles for your new elements here if needed */
    .hidden {
        display: none !important;
    }

    .file-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        margin-top: 20px;
        background-color: #f8f9fa;
        cursor: pointer;
        position: relative;
        /* Needed for absolute positioning of the input */
    }

    .file-upload-area:hover {
        background-color: #e9ecef;
    }

    .file-upload-area input[type="file"] {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-upload-info {
        margin-top: 10px;
        font-size: 0.9em;
        color: #6c757d;
    }

    .remove-file-btn {
        margin-top: 10px;
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

</style>

<body class="bg-light" style="direction: rtl;">
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
                <div class="mid-content">
                    <h4 class="title">إضافة منتجات</h4>
                </div>
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
                <div class="right-content"></div>
            </div>
        </header>
        <main class="page-content space-top p-b100" style="direction: rtl; text-align: center;">
            <div class="container" style="text-align: center;">
                <form action="{{ route('c1he3f.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
                    @csrf

                    <div class="bg-cookpad-gray-9gi p-6h1" style="height: 40vh; width: 80%; margin: auto; border-radius: 15px; position: relative;">
                        <div style="top: 20%;" class="image-zyn text-wbi fle-kj4 item-sji justify-byc">
                            <div class="text-fim">
                                <img class="w-8so mx-33j pointer-events-j3t" src="https://global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                                <p class="text-x8v font-9s7 mt-mnq">حمّل الصورة الرئيسية لمنتجك</p>
                            </div>
                            <input type="file" name="image" id="product_image_input" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" required>
                        </div>
                    </div>

                    <div class="my-4">
                        <input type="text" id="product_name" name="name" style="text-align: center; color: #000000;" placeholder="عنوان المنتج" class="form-control" required>
                    </div>

                    <div class="my-4">
                        <textarea id="product_description" name="description" style="text-align: center; color: #000000;" placeholder="وصف المنتج" class="form-control" rows="3"></textarea>
                    </div>

                    <h6 class="dz-title my-2">نوع المنتج</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="type" id="typePhysical" value="physical" checked>
                            <label class="form-check-label" for="typePhysical">
                                منتج
                            </label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="type" id="typeDigital" value="digital">
                            <label class="form-check-label" for="typeDigital">
                                منتج رقمي
                            </label>
                        </div>
                    </div>

                    <div id="digital-file-upload-section" class="my-4 hidden">
                        <label for="digital_file_path" style="text-align: center; display: block; margin-bottom: 5px;">حمّل ملف المنتج الرقمي (PDF, فيديو, صوت)</label>
                        <div class="file-upload-area" id="digital-file-drop-area">
                            <i class="feather icon-upload" style="font-size: 30px; color: #007bff;"></i>
                            <p>اسحب وأفلت الملف هنا أو انقر للتحميل</p>
                            <input type="file" name="digital_file_path" id="digital_file_path" accept=".pdf,video/*,audio/*">

                            <div id="digital-file-info" class="file-upload-info"></div>
                            <button type="button" class="remove-file-btn hidden" id="remove-digital-file-btn">إزالة الملف</button>
                        </div>
                    </div>

                    <div class="my-4">
                                                <label for="payment_gateway_fee">سعر المنتج الأصلي</label>
                        <input type="number" step="0.01" id="base_price" name="base_price" style="text-align: center; color: #000000;" placeholder="السعر الأساسي للمنتج" class="form-control" required>
                    </div>

                    <div class="my-4">
                        <label for="payment_gateway_fee">رسوم بوابة الدفع 
                            <span style="font-size: 13px; color: red !important;">
                                2.9% + 1 درهم
                           <span id="payment_gateway_fee_span"></span>


                        </label>
                        <input type="text" id="payment_gateway_fee" name="payment_gateway_fee" 
                        style="text-align: center; color: #000000;" placeholder="" class="form-control" 
                        value="0.00" readonly>
                    </div>
<script>
    document.getElementById('payment_gateway_fee').addEventListener('input', function() {
        document.getElementById('payment_gateway_fee_span').textContent = this.value;
    });

</script>

                    <div class="my-4">
                        <label for="payment_gateway_fee">المبلغ الذي سوف تحصل عليه</label>
                        <input type="number" step="0.01" id="selling_price" name="selling_price" style="text-align: center; color: #000000;" placeholder="سعر البيع النهائي" class="form-control" required readonly>
                    </div>

                    <h6 class="dz-title my-2">الحالة</h6>
                    <div class="d-flex flex-wrap gap-2" style="justify-content: center;">
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="is_active" id="statusActive" value="1" checked>
                            <label class="form-check-label" for="statusActive">
                                فعال
                            </label>
                        </div>
                        <div class="form-check style-2">
                            <input class="form-check-input" type="radio" name="is_active" id="statusInactive" value="0">
                            <label class="form-check-label" for="statusInactive">
                                غير فعال
                            </label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 80%; margin: auto;">إضافة المنتج</button>
                    </div>

                </form>
            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typePhysical = document.getElementById('typePhysical');
        const typeDigital = document.getElementById('typeDigital');
        const digitalFileUploadSection = document.getElementById('digital-file-upload-section');
        const digitalFileInput = document.getElementById('digital_file_path');
        const digitalFileDropArea = document.getElementById('digital-file-drop-area');
        const digitalFileInfo = document.getElementById('digital-file-info');
        const removeDigitalFileBtn = document.getElementById('remove-digital-file-btn');
        const basePriceInput = document.getElementById('base_price');
        const paymentGatewayFeeInput = document.getElementById('payment_gateway_fee');
        const sellingPriceInput = document.getElementById('selling_price');

        // Function to toggle digital file upload section visibility
        function toggleDigitalFileUploadSection() {
            if (typeDigital.checked) {
                digitalFileUploadSection.classList.remove('hidden');
                digitalFileInput.setAttribute('required', 'required'); // Make file upload required for digital products
            } else {
                digitalFileUploadSection.classList.add('hidden');
                digitalFileInput.removeAttribute('required');
                digitalFileInput.value = '';
                digitalFileInfo.textContent = '';
                removeDigitalFileBtn.classList.add('hidden');
            }
        }

        // Event listeners for product type change
        typePhysical.addEventListener('change', toggleDigitalFileUploadSection);
        typeDigital.addEventListener('change', toggleDigitalFileUploadSection);

        // Initial call to set visibility based on default checked radio
        toggleDigitalFileUploadSection();

        // Handle digital file input change
        digitalFileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                digitalFileInfo.textContent = `الملف المختار: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                removeDigitalFileBtn.classList.remove('hidden');
            } else {
                digitalFileInfo.textContent = '';
                removeDigitalFileBtn.classList.add('hidden');
            }
        });

        // Handle remove digital file button click
        removeDigitalFileBtn.addEventListener('click', function() {
            digitalFileInput.value = ''; // Clear the input
            digitalFileInfo.textContent = ''; // Clear the info text
            removeDigitalFileBtn.classList.add('hidden'); // Hide the button
        });

        // Drag and drop for digital file
        digitalFileDropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            digitalFileDropArea.style.backgroundColor = '#e3f2fd';
        });

        digitalFileDropArea.addEventListener('dragleave', () => {
            digitalFileDropArea.style.backgroundColor = '#f8f9fa';
        });

        digitalFileDropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            digitalFileDropArea.style.backgroundColor = '#f8f9fa';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                digitalFileInput.files = files;
                const event = new Event('change', {
                    bubbles: true
                });
                digitalFileInput.dispatchEvent(event);
            }
        });

        // Price Calculation Logic
        function calculatePrices() {
            const basePrice = parseFloat(basePriceInput.value);
            if (isNaN(basePrice) || basePrice < 0) {
                paymentGatewayFeeInput.value = '0.00';
                sellingPriceInput.value = '0.00';
                return;
            }

            const feePercentage = 0.029; // 2.9%
            const fixedFee = 1.00; // 1 AED

            // Calculate the payment gateway fee
            const paymentGatewayFee = (basePrice * feePercentage) + fixedFee;

            // Calculate the final selling price (base price minus fees)
            const sellingPrice = basePrice - paymentGatewayFee;

            paymentGatewayFeeInput.value = paymentGatewayFee.toFixed(2);
            sellingPriceInput.value = sellingPrice.toFixed(2);
        }

        // Event listener for base price input changes
        basePriceInput.addEventListener('input', calculatePrices);

        // Initial calculation on page load if a default base price is set
        calculatePrices();
    });

    // SweetAlert2 helper function
    function showMessage(title, message, icon) {
        Swal.fire({
            title: title
            , text: message
            , icon: icon
            , confirmButtonText: 'حسناً'
        });
    }

</script>
</body>

@endsection
