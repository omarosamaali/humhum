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
                <h4 class="title">{{ __('messages.حسابي') }}</h4>
            </div>
        </div>
    </header>
    <main class="page-content p-b40" style="padding-top: 26px; margin-left: 20px; margin-right: 20px;">
        <img src="assets/images/hand.png" class="hand" alt="unkown image">
        <div class="container pt-0 container-profile" style="padding: 0px; position: relative;">
            <img src="assets/images/background.png" class="background-fixed" alt="">
            <div class="profile-area" style="position: relative; z-index: 999;">
                <div class="author-bx">
                    <div class="line"></div>
                    <div class="dz-media">
                        <img src="{{ session('family_avatar') ? session('family_avatar') : asset('assets/images/default.jpg') }}"
                            style="border-radius: 50%; border: 3px solid #29A500; background: white;"
                            alt="{{ session('family_name') ?? 'unknown' }}">
                    </div>
                    <div class="dz-content">
                        <p style="color: white;">{{ __('messages.my_name') }}</p>
                        <h2 style="color: #ffffff;" class="name">{{ session('family_name') ?? Auth::user()->name ??
                            'ضيف' }}</h2>
                        <p class="text-primary"
                            style="background-color: #29A500; color:white !important; padding: 5px;">
                            @if(session('is_family_logged_in'))
                            اللغة {{ __('messages.' . session('family_language')) }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection