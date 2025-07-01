@extends('layouts.chef')

@section('title', 'تحويلاتي')

@section('content')


<div class="page-wrapper">

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!-- Preloader end-->

    <!-- Header -->
    <header class="header header-fixed">
        <div class="header-content">
            <div class="left-content">
                <a href="javascript:void(0);" class="back-btn">
                    <i class="feather icon-arrow-left"></i>
                </a>
            </div>
            <div class="mid-content">
                <h4 class="title">أرباحي</h4>
            </div>
        </div>
    </header>
    <!-- Header -->

    <!-- Main Content Start -->
    <main class="page-content space-top">
        <div class="container">
            <div class="rewards-box">
                <div style="display: flex; position: relative; top: -5px; justify-content: space-between;">
                    <div style="display: flex; gap: 7px;">
                        <h2 style="display: inline; font-size: 18px;" class="title">87,550</h2>
                        <h5 style="display: inline;" class="sub-title">بالمحفظة</h5>
                    </div>
                    <div style="display: flex; gap: 7px;">
                        <h2 style="display: inline; font-size: 18px;" class="title">87,550</h2>
                        <h5 style="display: inline;" class="sub-title">أرباحي</h5>
                    </div>
                </div>

                <a href="{{ route('c1he3f.withdrwal') }}" class="btn redeem-btn">طلب سحب</a>
                <div class="bg-icon">
                    <img src="{{ asset('assets/images/logo-white.png') }}" style="width: 113px; position: relative; right: 20px; bottom: 20px;" alt="images">

                </div>
            </div>
            <div class="title-bar" style="direction: rtl;">
                <h5 class="title" style="margin-right: 0px;">سجل المعاملات</h5>
                <select class="form-select" style="margin-left: 15px;">
                    <option selected>أرباح</option>
                    <option value="1">سحب</option>
                    <option value="2">شراء</option>
                </select>

                <select class="form-select">
                    <option selected>الجميع</option>
                    <option value="1">الأحدث</option>
                    <option value="2">الأقدم</option>
                </select>
            </div>
            <div class="rewards-list" style="direction: rtl;">
                <ul>
                    <li>
                        <div class="item-head">
                            <h6 class="title">شراء منتج جديد / بهارات</h6>
                            <div class="dz-meta">
                                <ul>
                                    <li>June 18, 2020</li>
                                    <li>4:00 AM</li>
                                </ul>
                            </div>
                        </div>
                        <div class="pts-bx">
                            <h4 class="points text-success">+250</h4>
                        </div>
                    </li>
                    <li>
                        <div class="item-head">
                            <h6 class="title">شراء وصفة جديدة / كشري</h6>
                            <div class="dz-meta">
                                <ul>
                                    <li>June 18, 2020</li>
                                    <li>4:00 AM</li>
                                </ul>
                            </div>
                        </div>
                        <div class="pts-bx">
                            <h4 class="points text-success">+100</h4>
                        </div>
                    </li>
                    <li>
                        <div class="item-head">
                            <h6 class="title">مشترك جديد / الإمارات</h6>
                            <div class="dz-meta">
                                <ul>
                                    <li>June 18, 2020</li>
                                    <li>4:00 AM</li>
                                </ul>
                            </div>
                        </div>
                        <div class="pts-bx">
                            <h4 class="points text-success">+250</h4>
                        </div>
                    </li>
                    <li>
                        <div class="item-head">
                            <h6 class="title">سحب مبلغ</h6>
                            <div class="dz-meta">
                                <ul>
                                    <li>June 18, 2020</li>
                                    <li>4:00 AM</li>
                                </ul>
                            </div>
                        </div>
                        <div class="pts-bx">
                            <h4 class="points text-primary">-250</h4>
                        </div>
                    </li>
                    <li>
                        <div class="item-head">
                            <h6 class="title">طلب سحب مبلغ</h6>
                            <div class="dz-meta">
                                <ul>
                                    <li>June 18, 2020</li>
                                    <li>4:00 AM</li>
                                </ul>
                            </div>
                        </div>
                        <div class="pts-bx">
                            <h4 class="points text-info">-250</h4>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </main>
    <!-- Main Content End -->
</div>
@endsection


<!--**********************************
    Scripts
***********************************-->
{{-- <script src="assets/js/jquery.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
	<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="assets/js/dz.carousel.js"></script>
	<script src="assets/js/settings.js"></script>
	<script src="assets/js/custom.js"></script>
</body>

</html> --}}
