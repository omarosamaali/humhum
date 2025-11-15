<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>الحقائق</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .back--btn {
            background: #000000;
            width: 50px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            border-radius: 50%;
        }

        .back--btn i {
            font-size: 23px;
            color: white;
        }

        .dz-card.list {
            margin-bottom: 0px;
        }

    </style>
    <style>
        :root {
            --primary: #dc3545;
            --secondary: #f8f9fa;
            --danger: #dc3545;
            --success: #28a745;
            --light: #fff;
            --dark: #333;
            --border: #e9ecef;
        }

        body {
            font-family: 'Cairo', sans-serif;
            font-size: 17px;
            line-height: 1.5;
            background-color: #f5f5f5;
            color: #4a4a4a;
            direction: rtl;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        .header {
            background-color: var(--light);
            border-bottom: 1px solid var(--border);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 60px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            height: 100%;
        }

        .header .title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }

        .back-btn {
            color: var(--primary);
            text-decoration: none;
            font-size: 18px;
        }

        .page-content {
            padding-top: 80px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .ingredient-item {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .ingredient-item[data-type="heading"] h4 {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: 2px solid var(--primary);
            display: inline-block;
        }

        .ingredient-item[data-type="ingredient"] p {
            font-size: 1rem;
            margin: 0;
            color: #555;
            padding-right: 15px;
            position: relative;
        }

        .ingredient-item[data-type="ingredient"] p::before {
            content: "\2022";
            /* Bullet point */
            color: var(--primary);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-right: -1em;
        }

    </style>
</head>

<body class="bg-light">
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
                    <h4 class="title">الحقائق الغذائية</h4>
                </div>
                <div class="left-content">
                    <a href="{{ url()->previous() }}" class="back--btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>

                </div>
            </div>
        </header>
        <main class="page-content space-top p-b100" style="direction: rtl;">
            <div class="container">
                {{-- Form to submit nutritional facts --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-white rounded-lg border-0 shadow-lg p-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">السعرات الحرارية</span>
                                <h5 class="font-weight-bold text-dark mb-0">{{ $recipe->calories ?? 0 }} كالوري</h5>
                            </div>
                        </div>

                        <div class="card bg-white rounded-lg border-0 shadow-lg p-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">الدهون</span>
                                <h5 class="font-weight-bold text-dark mb-0">{{ $recipe->fats ?? 0 }} جرام</h5>
                            </div>
                        </div>

                        <div class="card bg-white rounded-lg border-0 shadow-lg p-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">الكربوهيدرات</span>
                                <h5 class="font-weight-bold text-dark mb-0">{{ $recipe->carbs ?? 0 }} جرام</h5>
                            </div>
                        </div>

                        <div class="card bg-white rounded-lg border-0 shadow-lg p-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">البروتين</span>
                                <h5 class="font-weight-bold text-dark mb-0">{{ $recipe->protein ?? 0 }} جرام</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    /* Add any custom styling here to match your app's design */
                    .card {
                        border-radius: 12px !important;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05) !important;
                    }

                    .text-muted {
                        color: #888 !important;
                    }

                    .text-dark {
                        color: #333 !important;
                    }

                    .font-weight-bold {
                        font-weight: 700 !important;
                    }

                </style>
            </div>


        </main>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('index.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {!! $swalScript !!}

</body>

</html>
