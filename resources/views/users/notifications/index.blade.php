<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>الإشعارات</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta name="keywords"
        content="android, ios, mobile, mobile template, mobile app, ui kit, dark layout, app, delivery, ecommerce, material design, mobile, mobile web, order, phonegap, pwa, store, web app, Ombe, coffee app, coffee template, coffee shop, mobile UI, coffee design, app template, responsive design, coffee showcase, style app, trendy app, modern UI, technology, User-Friendly Interface, Coffee Shop App, PWA (Progressive Web App), Mobile Ordering, Coffee Experience, Digital Menu, Innovative Technology, App Development, Coffee Experience, cafe, bootatrap, Bootstrap Framework, UI/UX Design, Coffee Shop Technology, Online Presence, Coffee Shop Website, Cafe Template, Mobile App Design, Web Application, Digital Presence, ">

    <meta name="description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta property="og:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta property="og:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Ombe- Coffee Shop Mobile App Template (Bootstrap + PWA) | DexignZone">
    <meta name="twitter:description"
        content="Discover the perfect blend of design and functionality with Ombe, a Coffee Shop Mobile App Template crafted with Bootstrap and enhanced with Progressive Web App (PWA) capabilities. Elevate your coffee shop's online presence with a seamless, responsive, and feature-rich template. Explore a modern design, user-friendly interface, and PWA technology for an immersive mobile experience. Brew success for your coffee shop effortlessly – Ombe is the ideal template to caffeinate your digital presence.">

    <meta name="twitter:image" content="https://ombe.dexignzone.com/xhtml/social-image.png">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Mobile Specific -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">

    <!-- Global CSS -->
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
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

    <style>
        :root {
            --primary-color: #660099;
        }

        .pull_delete .pd_btn {
            right: unset !important;
            left: 0px !important;
        }

        .list-items.pull_delete {
            transform: translateX(-1px) !important;
            width: 100%;
            max-width: 100%;
            min-width: 109% !important;
        }

        .list-items {
            justify-content: space-between;
        }

        .pull_delete .pd_btn {
            background: var(--primary-color) !important;
        }
    </style>
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
        <header class="header header-fixed border-bottom">
            <div class="header-content">
                <div class="left-content">
                    <a href="{{ url()->previous() ?: route('home') }}" style="background-color: unset !important;"
                        id="back-btn">
                        @auth
                        <i class="feather icon-home" style="font-weight: normal; color: #660099;"></i>
                        @else
                        <i class="feather icon-home" style="font-weight: normal; color: #29A500;"></i>
                        @endauth
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">({{ $notifications->count() }})
                        @php
                        $lang = $lang = session('cook_language') ?? session('family_language') ?? 'ar';
                        @endphp
                        {{ \App\Helpers\TranslationHelper::translate('الإشعارات' ?? '', $lang) }}
                    </h4>
                </div>
                <div class="right-content">
                    {{-- <a href="search.html" class="icon font-24">
                        <i class="icon feather icon-search"></i>
                    </a> --}}
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content Start -->
        <main class="page-content space-top">
            <div style="direction: rtl;" class="container pb-0 overflow-hidden">
                <div class="notification-list">
                    <ul>
                        @foreach($notifications as $notification)
                        <li class="list-items" data-id="{{ $notification->id }}" style="align-items: start; gap: 5px; position: relative;">
                            <div class="media">
                                <div class="list-content">
                                    <h5 class="title">
                                        {{ \App\Helpers\TranslationHelper::translate($notification->message ?? '', $lang) }}
                                    </h5>
                                    <span class="date">
                                    {{ \App\Helpers\TranslationHelper::translate($notification->created_at->diffForHumans() ?? '', $lang) }}
                                    </span>
                                </div>
                            </div>
                            @auth
                            <button class="btn-delete" onclick="deleteNotification({{ $notification->id }}, this)"
                                style="background: #dc3545; color: white; border: none; border-radius: 5px; padding: 8px 15px; cursor: pointer;">
                                <i class="feather icon-trash-2"></i>
                            </button>
                            @endauth
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </main>
        <!-- Main Content End -->
    </div>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "008f1fac-93f0-43ee-9545-2ea058405cd1",  // ده الـ ID بتاعك
      safari_web_id: "web.onesignal.auto", // مش مهم في الأندرويد
      notifyButton: {
        enable: false,
      },
      allowLocalhostAsSecureOrigin: true, // لو بتجرب على localhost
    });

    // ده عشان يطلب الإشعارات أوتوماتيك لما التطبيق يفتح
    OneSignal.showNativePrompt();

    // لما يضغط على الإشعار هيفتح اللينك اللي إنت بعته
    OneSignal.on('notificationClick', function(event) {
      console.log('OneSignal notification clicked:', event);
      if (event.notification.url) {
        window.location.href = event.notification.url;
      }
    });
  });
</script>
    <script>
        function deleteNotification(id, button) {
        const li = button.closest('li');
        
        fetch(`/users.notifications.destroy.${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                li.style.transition = 'opacity 0.3s';
                li.style.opacity = '0';
                setTimeout(() => {
                    li.remove();
                    const count = document.querySelectorAll('.notification-list ul li').length;
                    document.querySelector('.mid-content .title').textContent = `(${count}) الإشعارات`;
                }, 300);
            }
        })
        .catch(error => {
            console.error('خطأ في الحذف:', error);
            alert('حدث خطأ أثناء الحذف');
        });
    }

    setInterval(function() {
        fetch('{{ route("users.notifications.index") }}')
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newNotifications = doc.querySelector('.notification-list ul');
                
                if (newNotifications) {
                    const currentIds = Array.from(document.querySelectorAll('.notification-list ul li'))
                        .map(li => li.dataset.id);
                    const newIds = Array.from(newNotifications.querySelectorAll('li'))
                        .map(li => li.dataset.id);
                    
                    // لو فيه إشعارات جديدة، حدث القائمة
                    if (JSON.stringify(currentIds) !== JSON.stringify(newIds)) {
                        document.querySelector('.notification-list ul').innerHTML = newNotifications.innerHTML;
                        
                        const count = newNotifications.querySelectorAll('li').length;
                        document.querySelector('.mid-content .title').textContent = `(${count}) الإشعارات`;
                    }
                }
            });
    }, 3000);
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/pulldelete.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        $(function () {
			$('.pull_delete').pulldelete(function ($dom) {
				// something you want here
				console.log('click delete');
				$dom.remove();
			});
		})

    </script>
</body>

</html>