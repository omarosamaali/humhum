<style>
    .container-inputs {
        display: flex;
        gap: 20px;
        max-width: 500px;
        margin: auto;
    }

    .container-inputs div {
        width: 100%;
        text-align: center;
    }

    .custom-login .custom-wrapper {
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .custom-login .custom-wrapper .custom-row {
        bottom: 0px;
        position: fixed;
        align-items: center;
        justify-content: center;
        display: flex;
        margin: auto;
        width: 100%;
    }

    .custom-login .card {
        width: 100% !important;
    }

    input {
        text-align: c
    }

    .logo-img {
        bottom: -16px;
        width: 63px;
        align-items: center;
        justify-content: center;
        display: flex;
        position: relative;
        margin: auto;
    }

    .close-icon {
        top: 20px;
        left: 20px;
        cursor: pointer;
        position: absolute;
        color: black;
        width: 34px;
        height: 34px;
    }

    input {
        text-align: center;
    }
</style>
<img src="{{ asset('assets/img/bg2.png') }}" style=" position: fixed;
    width: 100%;
    height: 100%;
    z-index: 1;
    object-fit: cover;" alt="unkown image" />
<x-guest-layout>
    <x-auth-card>
        @php
        $languages = \App\Models\Utility::languages();
        $setting = \App\Models\Utility::getAdminPaymentSettings();
        App\models\Utility::setCaptchaConfig();
        @endphp
        @section('page-title')
        {{ __('Login') }}
        @endsection
        @section('language-bar')
        <div href="#" class="lang-dropdown-only-desk">
            <li class="dropdown dash-h-item drp-language">
                <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="drp-text"> {{ ucFirst($languages[$lang]) }} </span>
                </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                    @foreach ($languages as $code => $language)
                    <a href="{{ route('login', $code) }}" tabindex="0"
                        class="dropdown-item {{ $code == $lang ? 'active' : '' }}">
                        <span>{{ ucFirst($language) }}</span>
                    </a>
                    @endforeach
                </div>
            </li>
        </div>
        @endsection
        @section('content')
        <div class="card-body" id="card-body" style="border-radius: 0px !important; max-width: unset !important;">
            <div class="">
                <h2 class="mb-3 f-w-600" style="text-align: center;">{{ __('Login') }}</h2>
            </div>
            @if (session()->has('error'))
            <div>
                <p class="text-danger">{{ session('error') }}</p>
            </div>
            @endif
            <form method="POST" id="form_data" action="{{ route('login') }}" class="needs-validation" novalidate>
                @csrf
                <div class="">
                    <div class="container-inputs">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="emailaddress" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="{{ __('Enter Your Email') }}">
                            @error('email')
                            <span class="error invalid-email text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Password')
                                }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" id="password"
                                placeholder="{{ __('Enter Your Password') }}">
                            @error('password')
                            <span class="error invalid-password text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!--<div class="container-inputs" style="align-items: center; justify-content: center; height: 37px;">-->

                    <!-- <div class="form-group text-center">-->

                    <!-- <span>-->

                    <!-- <a href="{{ route('password.request', $lang) }}" tabindex="0">-->

                    <!-- {{ __('Forgot Your Password?') }}-->

                    <!-- </a>-->

                    <!-- </span>-->

                    <!-- </div>-->

                    <!-- @if ($setting['signup_button'] == 'on')-->

                    <!-- <p class="text-center" style="width: 100%;">{{ __("Don't have an account?") }}-->

                    <!-- <a href="{{ route('register', $lang) }}" class="my-4 text-center text-primary">-->

                    <!-- {{ __('Register') }} </a>-->

                    <!-- </p>-->

                    <!-- @endif-->

                    <!--</div>-->
                    @if ($setting['recaptcha_module'] == 'on')
                    @if (isset($setting['google_recaptcha_version']) &&
                    $setting['google_recaptcha_version'] == 'v2-checkbox')
                    <div class="form-group mb-3">
                        {!! NoCaptcha::display($setting['cust_darklayout'] == 'on' ?
                        ['data-theme' => 'dark'] : []) !!}
                        @error('g-recaptcha-response')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @else
                    <div class="form-group col-lg-12 col-md-12">
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" class="form-control">
                        @error('g-recaptcha-response')
                        <span class="error small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif
                    @endif
                    <div class="container-inputs">
                        <div class="d-grid">
                            <button type="submit" id="login_button" class="btn btn-primary btn-block">{{ __('Login')
                                }}</button>
                        </div>
                        <div class="d-grid">
                            <button type="button" id="" class="btn btn-primary btn-block ">
                                <a href="{{ route('client.login', $lang) }}" class="" style="color:#fff">
                                    تسجيل دخول العميل
                                </a>
                            </button>
                        </div>
                    </div>
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="unkown-img" class="logo-img" />
            </form>
        </div>
         <script>
            const cardBody = document.getElementById('card-body');
      function closeModal() {
        cardBody.style.display = 'none';
      }
    
        </script>
        @endsection
        @push('custom-scripts')
        <script src="{{ asset('assets/custom/libs/jquery/dist/jquery.min.js') }}"></script>
        <script>
            $(document).ready(function() {
        $("#form_data").submit(function(e) {
          $("#login_button").attr("disabled", true);
          return true;
        });
      });
    
        </script>
        @if ($setting['recaptcha_module'] == 'on')
        @if (isset($setting['google_recaptcha_version']) && $setting['google_recaptcha_version'] ==
        'v2-checkbox')
        {!! NoCaptcha::renderJs() !!}
        @elseif(isset($setting['google_recaptcha_version']) && $setting['google_recaptcha_version'] == 'v3')
        <script src="https://www.google.com/recaptcha/api.js?render={{ $setting['google_recaptcha_key'] }}">
        </script>
        <script>
            $(document).ready(function() {
        grecaptcha.ready(function() {
          grecaptcha.execute('{{ $setting['
            google_recaptcha_key '] }}', {
              action: 'submit'
            }).then(function(token) {
            $('#g-recaptcha-response').val(token);
          });
        });
      });
    
        </script>
        @endif
        @endif
        @endpush
    </x-auth-card>
</x-guest-layout>