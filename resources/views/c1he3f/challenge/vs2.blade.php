@extends('layouts.chef')
@section('content')
<style>
    .plus-btn {
        position: fixed;
        bottom: 30px;
        text-align: center;
        left: 20px;
        z-index: 99999;
        background-color: black;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 37px;
    }

    .challenge-link {
        color: white;
        text-decoration: none;
    }

    .swiper-slide {
        position: relative;
        height: unset !important;
    }

    .dz-categories-bx {
        padding: 0px !important;
        height: 112px;
        margin-top: 40px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .before-challenge-section {
        height: 100%;
        padding: 10px 20px;
        border-top-right-radius: 15px;
        width: 50%;
        background-color: #a50707;
        color: white;
    }

    .before-challenge-content {
        flex-direction: column;
        width: 100px;
        z-index: 999999;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 9px;
        position: relative;
        font-size: 15px;
        color: rgb(255, 255, 255);
        font-weight: normal;
        margin: 0;
    }

    .challenge-number {
        font-size: 28px;
        margin: 0;
    }

    .challenge-before-text {
        margin: 0;
    }

    .vs-icon-container {
        left: 37%;
        position: absolute;
        top: -16px;
        z-index: 99999999999999;
    }

    .vs-icon {
        width: 100px;
        height: 130px;
    }

    .challenge-info-section {
        padding: 10px 20px;
        width: 50%;
        border-top-left-radius: 15px;
        background-color: black;
        color: white;
        z-index: 99999;
    }

    .chef-info {
        display: flex;
        justify-content: center;
    }

    .chef-avatar {
        border-radius: 50px;
        background-color: #e00000;
        font-size: 17px;
        overflow: hidden;
        line-height: unset;
        border: 2px solid #e00000;
    }

    .chef-image {
        width: 30px;
        height: 30px;
    }

    .chef-name {
        font-size: 10px;
        color: gray;
        text-align: center;
        align-items: center;
        justify-content: center;
        display: flex;
        margin-right: 10px;
        margin: 0;
    }

    .challenge-title-text {
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .challenge-timer-container {
        margin-bottom: 2px;
        margin-top: 7px;
        text-align: center;
    }

    .challenge-timer {
        font-size: 15px;
        color: rgb(255, 255, 255);
        font-weight: bold;
    }

    .challenge-users-text {
        align-items: center;
        justify-content: center;
        display: flex;
        font-size: 12px;
        position: relative;
        top: 4px;
    }

    .dz-categories-bx-buttons {
        padding: 0px !important;
        background-color: transparent;
        height: 50px;
        margin-top: -40px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .view-challenges-section {
        height: 100%;
        padding: 10px 20px;
        width: 50%;
        justify-content: center;
        display: flex;
        text-align: center;
        border-bottom-right-radius: 15px;
        background-color: #a50707;
        color: white;
        position: relative;
        right: 1.1px;
    }

    .view-challenges-content {
        flex-direction: column;
        width: 100px;
        z-index: 999999;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        font-size: 15px;
        color: rgb(255, 255, 255);
        font-weight: normal;
        margin: 0;
    }

    .view-challenges-text {
        font-size: 17px;
        margin: 0;
    }

    .view-challenges-link {
        color: white;
        position: relative;
        top: 6px;
        text-decoration: none;
    }

    .accept-challenge-section {
        padding: 10px 20px;
        height: 100%;
        width: 49.89%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom-left-radius: 15px;
        background-color: black;
        color: white;
        z-index: 99999;
        position: relative;
        left: 1px;
    }

    .accept-challenge-text {
        font-size: 17px;
        position: relative;
        top: 9px;
        margin: 0;
    }

    .accept-challenge-link {
        color: white;
        text-decoration: none;
        position: relative;
        top: -5px;
    }

</style>

<body style="direction: rtl;">
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <header class="header header-fixed">
            <div class="header-content">
                <div class="mid-content">
                    <h4 class="title">تحدياتي</h4>

                </div>
                <div class="left-content">
                    <a href="index.html" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <main class="page-content space-top">
            <div class="container">
                <h5 stlye="text-align: center; margin:auto; display: flex; flex-direction: row;">
                    <h5 style="display: inline-flex;">تحديات للمستخدمين {{ $userChallengesCount }}</h5> / 
                    <h5 style="display: inline-flex;">تحديات للطهاه {{ $chefChallengesCount }}</h5>
                </h5>

                @foreach($challenges as $challenge)
                <div class="swiper-slide">
                    <a href="cheif-vs.html" class="challenge-link">
                        <div class="dz-categories-bx">
                            <div class="before-challenge-section">
                                <h3 class="before-challenge-content">
                                    <p class="challenge-number">{{ $acceptedChallengesCount ?? 0 }}</p>
                                    <span class="challenge-before-text">قبل التحدي</span>
                                </h3>
                            </div>
                            <div>
                                <div class="vs-icon-container">
                                    <img src="{{ asset('assets/images/vs-icon.png') }}" class="vs-icon" alt="">
                                </div>
                            </div>
                            <div class="challenge-info-section">
                                <div class="chef-info">
                                    <div class="chef-avatar">
                                        <img src="{{ $challenge->chef->avatar ? asset('storage/' . $challenge->chef->avatar) : asset('assets/images/chef.jpeg') }}" class="chef-image" alt="">
                                    </div>
                                    <h5 class="chef-name" style="margin-right: 5px;">{{ $challenge->chef->name }}</h5>
                                </div>
                            

                                <span class="challenge-title-text">{{ Str::limit($challenge->message, 10) }}</span>

                                <p class="challenge-timer-container">
                                    <sub class="challenge-timer">
                                        @php
                                        $endDateTime = \Carbon\Carbon::parse($challenge->end_date . ' ' . $challenge->end_time);
                                        $now = \Carbon\Carbon::now();
                                        $diff = $endDateTime->diff($now);
                                        if ($endDateTime->isPast()) {
                                        $timeLeft = 'انتهى التحدي';
                                        } else {
                                        $timeLeft = sprintf('%02d : %02d : %02d : %02d',
                                        $diff->d, $diff->h, $diff->i, $diff->s);
                                        }
                                        @endphp
                                        {{ $timeLeft }}
                                    </sub>
                                </p>
                                <span class="challenge-users-text">
                                    {{ $challenge->challenge_type == 'user' ? 'للمستخدمين' : 'للطهاه' }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="{{ route('challenge.vs-show', $challenge->id) }}" class="challenge-link">
                        <div class="dz-categories-bx-buttons">
                            <div class="view-challenges-section">
                                <h3 class="view-challenges-content">
                                    <p class="view-challenges-text">
                                        
                                                                                    <a href="{{ route('challenge.show', $challenge->id) }}" class="view-challenges-link">عرض التحدي
                                                                                    </a>


                                    </p>
                                </h3>
                            </div>
                            <div class="accept-challenge-section">
                                <p class="accept-challenge-text">
                                    @if ($challenge->challengeResponses->isNotEmpty())
                                    @php
                                    $firstResponse = $challenge->challengeResponses->first();
                                    @endphp
                                    <a href="{{ route('challenge.vs-show', $challenge->id) }}" class="accept-challenge-link">قيم التحدي</a>

                                    @else
                                    <span>لا توجد ردود بعد</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <a href="{{ route('challenge.all-vs') }}" class="plus-btn">
                    <span style="position: relative; top: -4px;">+</span>
                </a>
            </div>
        </main>
    </div>
</body>

@endsection
