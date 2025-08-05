@extends('layouts.chef')
@section('content')

<body class="bg-light" style="direction: rtl;">
<div class="page-wrapper full-height">
    
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
		<header class="header header-fixed border-bottom">
			<div class="header-content">
				<div class="mid-content">
					<h4 class="title">بيانات الطلب</h4>
				</div>
				<div class="left-content">
					<a href="javascript:void(0);" class="back-btn">
						<i class="feather icon-arrow-left"></i>
					</a>
				</div>
				{{-- <div class="right-content"></div> --}}
			</div>
		</header>
	<!-- Header -->
	
	<!-- Main Content Start -->
	<main class="page-content space-top p-b80">
		<div class="container">
			<div class="dz-flex-box">	
				<div class="dz-list m-b20">
					<ul class="dz-list-group">
						<li class="list-group-items">
							<a href="delivery-address.html" class="item-link">
								<div class="dz-icon style-2 icon-fill"><i class="fi fi-rr-marker font-20"></i></div>
								<div class="list-content">
									<h6 class="title">Delivery address</h6>
									<p class="active-status">123 Main Street, Anytown, USA 12345</p>
								</div>
							</a>
						</li>
						<li class="list-group-items">
							<a href="payment.html" class="item-link">
								<div class="dz-icon dz-icon style-2 icon-fill"><i class="fi fi-rr-credit-card font-20"></i></div>
								<div class="list-content">
									<h6 class="title">Payment</h6>
									<p class="active-status">XXXX XXXX XXXX 3456</p>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="mb-3">
					<label class="form-label" for="notes">رمز الخصم</label>
					<input class="form-control" name="notes" id="notes" placeholder="إكتب هنا" />
				</div>

				<div class="view-cart mt-auto">
					<ul>
						<li>
							<span class="name">سعر الوصفة</span>
							<span class="about">100
								ايقونة
							</span>
						</li>
						<li>
							<span class="name">خدمات الموقع</span>
							<span class="about">00 ايقونة</span>
						</li>
						<li>
							<span class="name"> الخصم</span>
							<span class="about">-$100.00</span>
						</li>
						<li class="dz-total">
							<span class="name font-18 font-w600">القيمة الإجمالية</span>
							<h5 class="price">105</h5>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</main>
	<!-- Main Content End -->

	<!-- Footer Fixed Button -->	
	<div class="footer-fixed-btn bottom-0 bg-white">
		<a href="my-order.html" class="btn btn-lg btn-thin btn-primary w-100 rounded-xl">الدفع</a>
	</div>	
	<!-- Footer Fixed Button -->	
</div>  
</body>
@endsection

