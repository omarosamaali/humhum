<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>@yield('title')</title>

    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Globle Stylesheets -->

    <link rel="stylesheet" class="main-css" type="text/css" href="assets/css/style.css">
    @vite(['resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #660099;
        }

        select.form-select,
        .show-pass i,
        select.form-select,
        .form-text .link,
        .text-primary {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .form-control:focus,
        .form-control:active,
        .form-control.active,
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--primary-color) !important;
        }

        .w-full {
            width: 100% !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .justify-center {
            justify-content: center;
        }

        .account-section form div {
            text-align: right !important;
        }

        #country-select option::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 15px;
            margin-left: 8px;
        }

        .custom-select-rtl {
            background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 2424%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e');
            background-repeat: no-repeat;
            background-position: left 0.75rem center;
            background-size: 1.2em 1.2em;
            padding-left: 2.5rem;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        ::selection {
            background: var(--primary-color);
            color: #fff;
        }

        .form-label {
            display: flex;
            justify-content: center;
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

        <main class="page-content">
            @yield('section')
        </main>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>