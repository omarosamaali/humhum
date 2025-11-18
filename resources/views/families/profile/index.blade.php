@extends('layouts.auth-user')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">

@section('title', 'ملفى')

@section('content')
<div class="page-wrapper">
    <x-preloader />
    <header class="header header-fixed" style="border-block: 1px solid #ccc;">
        <div class="header-content">
            <div class="left-content">
                <a href="{{ route('families.welcome') }}" style="background-color: unset !important; font-size: 24px;">
                    <i class="feather icon-home" style="font-weight: normal; color: #29A500;"></i>
                </a>
            </div>
            <div class="mid-content">
                {{-- <h4 class="title">{{ __('messages.حسابي') }}</h4> --}}
                @php
                $lang = session('cook_language')
            ?? session('family_language')
            ?? 'ar';

                $t = [
                'ar' => 'حسابي',
                'en' => 'My Account',
                'id' => 'Akun Saya',
                'am' => 'የእኔ መለያ',
                'hi' => 'मेरा खाता',
                'bn' => 'আমার অ্যাকাউন্ট',
                'ml' => 'എന്റെ അക്കൗണ്ട്',
                'fil' => 'Aking Account',
                'ur' => 'میرا اکاؤنٹ',
                'ta' => 'என் கணக்கு',
                'ne' => 'मेरो खाता',
                'ps' => 'زما حساب',
                'fr' => 'Mon compte',
                ][$lang] ?? 'حسابي'; // fallback عربي
                @endphp

                <h4 class="title">{{ $t }}</h4>
            </div>
        </div>
    </header>
    <main class="page-content p-b40" style="padding-top: 26px; margin-left: 20px; margin-right: 20px;">
        <img src="assets/images/hand.png" class="hand" alt="unkown image">
        <div class="container pt-0 container-profile" style="padding: 0px; position: relative;">
            <img src="assets/images/background.png" class="background-fixed" alt="">
            @php
            $lang = session('cook_language')
            ?? session('family_language')
            ?? 'ar';

            // ترجمات النصوص الستاتيك
            $static = [
            'my_name' => [
            'ar' => 'اسمي',
            'en' => 'My Name',
            'id' => 'Nama Saya',
            'am' => 'ስሜ',
            'hi' => 'मेरा नाम',
            'bn' => 'আমার নাম',
            'ml' => 'എന്റെ പേര്',
            'fil' => 'Aking Pangalan',
            'ur' => 'میرا نام',
            'ta' => 'என் பெயர்',
            'ne' => 'मेरो नाम',
            'ps' => 'زما نوم',
            'fr' => 'Mon nom',
            ],
            'languages' => [
            'ar' => 'العربية',
            'en' => 'English',
            'id' => 'Bahasa Indonesia',
            'am' => 'አማርኛ',
            'hi' => 'हिन्दी',
            'bn' => 'বাংলা',
            'ml' => 'മലയാളം',
            'fil' => 'Filipino',
            'ur' => 'اردو',
            'ta' => 'தமிழ்',
            'ne' => 'नेपाली',
            'ps' => 'پښتو',
            'fr' => 'Français',
            ],
            ];

            $t = fn($key) => $static[$key][$lang] ?? $static[$key]['ar'] ?? $key;
            @endphp

            <div class="profile-area" style="position: relative; z-index: 999;">
                <div class="author-bx">
                    <div class="line"></div>
                    <div class="dz-media">
                        <img src="{{ session('family_avatar') ? session('family_avatar') : asset('assets/images/default.jpg') }}"
                            style="border-radius: 50%; border: 3px solid #29A500; background: white;"
                            alt="{{ session('family_name') ?? 'unknown' }}">
                    </div>
                    <div class="dz-content">
                        <p style="color: white;">{{ $t('my_name') }}</p>
                        <h2 style="color: #ffffff;" class="name">
                            {{ session('family_name') ?? Auth::guard('family')->user()->name ?? 'ضيف' }}
                        </h2>
                            @php
                            $lang = session('cook_language')
            ?? session('family_language')
            ?? 'ar';

                            // مصفوفة أسماء اللغات
                            $langNames = [
                            'ar' => 'العربية',
                            'en' => 'English',
                            'id' => 'Bahasa Indonesia',
                            'am' => 'አማርኛ',
                            'hi' => 'हिन्दी',
                            'bn' => 'বাংলা',
                            'ml' => 'മലയാളം',
                            'fil' => 'Filipino',
                            'ur' => 'اردو',
                            'ta' => 'தமிழ்',
                            'ne' => 'नेपाली',
                            'ps' => 'پښتو',
                            'fr' => 'Français',
                            ];

                            // دالة بسيطة للترجمة
                            $t = fn($key) => $langNames[$key] ?? 'غير معروف';
                            @endphp

                            {{-- استخدمها كده --}}
                        <p style="background:#29A500; color:white; padding:5px;">
                            @if(session('is_family_logged_in'))
                            {{ $t($lang) }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection