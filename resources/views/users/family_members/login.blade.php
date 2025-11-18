@php
$translations = [
'ar' => ['welcome' => 'أهلاً', 'family_number' => 'رقم العضوية', 'password' => 'رمز الدخول', 'login' => 'دخول'],
'en' => [
'welcome' => 'Hello',
'family_number' => 'Membership Number',
'password' => 'Access Code',
'login' => 'Login',
],
'id' => [
'welcome' => 'Halo',
'family_number' => 'Nomor Keanggotaan',
'password' => 'Kode Akses',
'login' => 'Masuk',
],
'am' => ['welcome' => 'ሰላም', 'family_number' => 'የአባልነት ቁጥር', 'password' => 'የመዳረሻ ኮድ', 'login' => 'ግባ'],
'hi' => [
'welcome' => 'नमस्ते',
'family_number' => 'सदस्यता संख्या',
'password' => 'पहुँच कोड',
'login' => 'लॉगिन',
],
'bn' => [
'welcome' => 'হ্যালো',
'family_number' => 'সদস্য নম্বর',
'password' => 'অ্যাক্সেস কোড',
'login' => 'লগইন',
],
'ml' => [
'welcome' => 'ഹലോ',
'family_number' => 'അംഗത്വ നമ്പർ',
'password' => 'ആക്സസ് കോഡ്',
'login' => 'ലോഗിൻ',
],
'fil' => [
'welcome' => 'Kumusta',
'family_number' => 'Numero ng Miyembro',
'password' => 'Access Code',
'login' => 'Mag-login',
],
'ur' => ['welcome' => 'ہیلو', 'family_number' => 'ممبرشپ نمبر', 'password' => 'رسائی کوڈ', 'login' => 'لاگ ان'],
'ta' => [
'welcome' => 'வணக்கம்',
'family_number' => 'உறுப்பினர் எண்',
'password' => 'அணுகல் குறியீடு',
'login' => 'உள்நுழை',
],
'ne' => [
'welcome' => 'नमस्ते',
'family_number' => 'सदस्यता नम्बर',
'password' => 'पहुँच कोड',
'login' => 'लगइन',
],
'ps' => [
'welcome' => 'سلام',
'family_number' => 'د غړیتوب شمېره',
'password' => 'د لاسرسي کوډ',
'login' => 'ننوتل',
],
'fr' => [
'welcome' => 'Bonjour',
'family_number' => 'Numéro de membre',
'password' => 'Code d\'accès',
'login' => 'Connexion',
],
];

$lang = $memberData->language ?? 'ar';
$t = $translations[$lang] ?? $translations['ar'];
@endphp

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
                    @if ($memberData)
                    <div class="member-info">
                        <div class="member-number">{{ $t['welcome'] }}</div>
                        <img src="{{ $memberData->avatar ?? asset('assets/images/default.jpg') }}" class="member-avatar"
                            alt="{{ $memberData->name }}">
                        <div class="member-name">{{ $memberData->name }}</div>
                    </div>
                    @endif

                    <div class="account-section">
                        <form method="POST" action="{{ route('family_members.login.post') }}">
                            @csrf

                            @if ($memberData)
                            <input type="hidden" name="family_number" value="{{ $memberData->family_number }}">
                            <input type="hidden" name="member_id" value="{{ $memberData->id }}">
                            @else
                            <div class="mb-4">
                                <label>{{ $t['family_number'] }}</label>
                                <input type="text" name="family_number"
                                    value="{{ old('family_number', $family_number ?? '') }}"
                                    class="form-control @error('family_number') is-invalid @enderror" maxlength="5">
                                @error('family_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif

                            <div class="m-b30">
                                <label>{{ $t['password'] }}</label>
                                <input type="hidden" name="password" id="password-hidden">
                                @php
                                $rtlLanguages = ['ar', 'ur', 'ps'];
                                $dir = in_array($memberData->language, $rtlLanguages) ? 'direction:rtl;' : 'direction:ltr;';
                                @endphp
                                <div style="{{ $dir }}" id="otp" class="digit-group">
                                    @for ($i = 0; $i < 4; $i++) <input class="form-control otp-input" type="text"
                                        maxlength="1" data-index="{{ $i }}" required>
                                        @endfor
                                </div>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if ($errors->has('login'))
                                <div class="text-danger">{{ $errors->first('login') }}</div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                {{ $t['login'] }}
                            </button>
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