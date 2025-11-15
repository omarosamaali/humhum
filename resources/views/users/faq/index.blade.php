@extends('layouts.user')
@section('title', 'هم هم | Hum Hum')

@section('content')
<style>
    :root {
        --primary: #660099 !important;
    }
</style>

<body>
    <div class="page-wrapper">
        <div class="dz-nav-floting">
            <!-- Header -->
            <header class="header header-fixed">
                <div class="header-content">
                    <div class="left-content">
                        <a href="{{ url()->previous() ?: route('home') }}" class="icon dz-floating-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect y="2" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect y="18" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                                <rect x="4" y="10" width="20" height="3" rx="1.5" fill="#5F5F5F" />
                            </svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h4 class="title">الأسئلة الشائعة</h4>
                    </div>
                </div>
            </header>
            <!-- Header -->

            <main class="page-content" style="direction: rtl;">
                <div class="container">
                    <div class="accordion dz-accordion style-2" id="faqAccordionParent">
                        @foreach ($faqs as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $faq->id }}">
                                    {{ trans_field($faq, 'question') }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordionParent">
                                <div class="accordion-body">
                                    <p class="m-b0">
                                        {{ trans_field($faq, 'answer') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </main>
        </div>

        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/settings.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('index.js') }}"></script>
    </div>
</body>

@endsection