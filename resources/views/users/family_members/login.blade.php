<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>{{ $memberData ? 'تسجيل دخول ' . $memberData->name : 'تسجيل دخول الفرد' }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/family-logo/icon.png">
    <link rel="stylesheet" class="main-css" type="text/css" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        :root {
            --primary: #29A500;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .member-info {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
            margin-top: 72px;
        }

        .member-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: contain;
            border: 3px solid var(--primary);
            margin-bottom: 10px;
        }

        .member-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .member-number {
            font-size: 19px;
            color: #000;
        }

        .digit-group.input-mini .form-control {
            border-width: 2px;
            border-radius: 9px;
        }
    </style>
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

        <!-- Main Content Start  -->
        <main class="page-content">
            <div class="container py-0">
                <div class="dz-authentication-area">
                    <div class="main-logo">
                        <div class="logo" style="top: 15px; left: 32px; position: relative;">
                            <img src="assets/images/family-logo/logo.png" alt="logo">
                        </div>
                    </div>
                    @if($memberData)
                    <div class="member-info">
                        <div class="member-number">اهلا</div>
                        <img src="{{ $memberData->avatar ? $memberData->avatar : asset('assets/images/default.jpg') }}"
                            class="member-avatar" alt="{{ $memberData->name }}">
                        <div class="member-name">{{ $memberData->name }}</div>
                    </div>
                    @endif

                    <div class="account-section">
                        <form method="POST" action="{{ route('family_members.login.post') }}">
                            @csrf

                            @if($memberData)
                            <input type="hidden" name="family_number" value="{{ $memberData->family_number }}">
                            <input type="hidden" name="member_id" value="{{ $memberData->id }}">
                            @else
                            <div class="mb-4">
                                <label class="form-label" for="family_number">رقم العضوية</label>
                                <div class="input-group input-mini input-lg">
                                    <input type="text" name="family_number" id="family_number"
                                        class="form-control @error('family_number') is-invalid @enderror"
                                        value="{{ old('family_number', $family_number) }}" maxlength="5"
                                        pattern="\d{1,5}" inputmode="numeric">
                                </div>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif

                            <div class="m-b30">
                                <label class="form-label" for="password">رمز الدخول</label>
                                <div class="account-section">
                                    <input type="hidden" name="password" id="password-hidden">
                                    <div id="otp" class="digit-group input-mini">
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="0"
                                            required>
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="1"
                                            required>
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="2"
                                            required>
                                        <input class="form-control otp-input" type="text" maxlength="1" data-index="3"
                                            required>
                                    </div>
                                    @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                            {{ $error }}
                                            @endforeach
                                    @endif
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-thin btn-lg w-100 btn-primary rounded-xl mb-3">دخول</button>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const inputs = document.querySelectorAll('.otp-input');
                                const hiddenInput = document.getElementById('password-hidden');
                                
                                inputs.forEach((input, index) => {
                                    input.addEventListener('input', function(e) {
                                        if (this.value.length === 1) {
                                            if (index < inputs.length - 1) {
                                                inputs[index + 1].focus();
                                            }
                                        }
                                        updateHiddenInput();
                                    });
                                    
                                    input.addEventListener('keydown', function(e) {
                                        if (e.key === 'Backspace' && this.value === '' && index > 0) {
                                            inputs[index - 1].focus();
                                        }
                                    });
                                });
                                
                                function updateHiddenInput() {
                                    let password = '';
                                    inputs.forEach(input => {
                                        password += input.value;
                                    });
                                    hiddenInput.value = password;
                                }

                                // Auto-focus first input
                                if (inputs.length > 0) {
                                    inputs[0].focus();
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content End  -->
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/dz.carousel.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>