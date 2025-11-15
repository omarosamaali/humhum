@extends('layouts.auth-user')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">

@section('title', 'ملفى')

@section('content')
<div class="page-wrapper">

    <x-preloader />

    <x-user-header title="{{ __('messages.حسابي') }}" route="{{ route('users.profile.edit', Auth::user()->id) }}"
        back="{{ route('users.welcome') }}" />

    <main class="page-content p-b40" style="padding-top: 26px; margin-left: 20px; margin-right: 20px;">

        <img src="assets/images/hand.png" class="hand" alt="unkown image">

        <div class="container pt-0 container-profile" style="padding: 0px; position: relative;">
            <img src="assets/images/background.png" class="background-fixed" alt="">
            <div class="profile-area" style="position: relative; z-index: 999;">
                <div class="author-bx">
                    <div class="line"></div>
                    <div class="dz-media">
                        <img src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('assets/images/default.jpg') }}"
                            style="border-radius: 50%; border: 3px solid #660099; background: white;"
                            alt="unkown image">
                    </div>
                    <div class="dz-content">
                        <p style="color: white;">{{ __('messages.my_name') }}</p>
                        <h2 style="color: #ffffff;" class="name">{{ Auth::user()->name }}</h2>

                        <p class="text-primary"
                            style="background-color: #660099; color:white !important; padding: 5px;">
                            {{ __('messages.account') }}
                            @php
                            $status = Auth::user()->status;
                            $locale = session('locale', 'ar');
                            @endphp
                            @if ($locale === 'ar')
                            {{ $status == 'فعال' ? 'فعّال' : 'غير فعّال' }}
                            @else
                            {{ $status == 'فعال' ? 'Active' : 'Inactive' }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="widget_getintuch pb-15 profile">
                    <ul>
                        <li style="text-align: center; justify-content: center;">
                            <div class="dz-content">
                                <h6 class="title" style="color: white;"> {{ __('messages.from') }}
                                    <img src="https://flagcdn.com/24x18/{{ Auth::user()->country }}.png"
                                        alt="Flag {{ Auth::user()->country }}"
                                        style="width: 24px; height: 18px; vertical-align: middle;" /> </span>
                                    {{ $countryName }}
                                </h6>
                            </div>
                        </li>

                        <li style="text-align: center; justify-content: center;">
                            <div class="dz-content">
                                <h6 class="title" style="color: white;">{{ Auth::user()->email }}</h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection