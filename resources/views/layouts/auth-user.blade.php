<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@300;400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    @yield('content')
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>