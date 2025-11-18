<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&display=swap"
    rel="stylesheet">
<title>هم هم | Hum Hum</title>
<style>
    body {
        margin: 0px;
        padding: 0px;
        font-family: 'Cairo', sans-serif;
    }

    .container {
        display: flex;
        width: 100%;
        height: 100%;
    }

    .container a {
        text-decoration: none;
        width: 100%;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 61px;
        color: white;
    }

    .container a:first-child {
        background: #29A500;
    }

    .container a:last-child {
        background: #000;
    }
</style>

<div class="container">
    @php
    $translations = [
    'ar' => [
    'cooking_schedule' => '🍳 جدول الطبخ',
    'new_request' => '📝 طلب جديد'
    ],
    'en' => [
    'cooking_schedule' => '🍳 Cooking Schedule',
    'new_request' => '📝 New Request'
    ],
    'id' => [
    'cooking_schedule' => '🍳 Jadwal Memasak',
    'new_request' => '📝 Permintaan Baru'
    ],
    'am' => [
    'cooking_schedule' => '🍳 የማብሰል መርሃ ግብር',
    'new_request' => '📝 አዲስ ጥያቄ'
    ],
    'hi' => [
    'cooking_schedule' => '🍳 खाना पकाने का कार्यक्रम',
    'new_request' => '📝 नई अनुरोध'
    ],
    'bn' => [
    'cooking_schedule' => '🍳 রান্নার সময়সূচী',
    'new_request' => '📝 নতুন অনুরোধ'
    ],
    'ml' => [
    'cooking_schedule' => '🍳 പാചക ഷെഡ്യൂൾ',
    'new_request' => '📝 പുതിയ അഭ്യർത്ഥന'
    ],
    'fil' => [
    'cooking_schedule' => '🍳 Iskedyul ng Pagluluto',
    'new_request' => '📝 Bagong Kahilingan'
    ],
    'ur' => [
    'cooking_schedule' => '🍳 کھانا پکانے کا شیڈول',
    'new_request' => '📝 نئی درخواست'
    ],
    'ta' => [
    'cooking_schedule' => '🍳 சமையல் அட்டவணை',
    'new_request' => '📝 புதிய கோரிக்கை'
    ],
    'ne' => [
    'cooking_schedule' => '🍳 खाना पकाउने तालिका',
    'new_request' => '📝 नयाँ अनुरोध'
    ],
    'ps' => [
    'cooking_schedule' => '🍳 د پخلي مهالوېش',
    'new_request' => '📝 نوې غوښتنه'
    ],
    'fr' => [
    'cooking_schedule' => '🍳 Planning des repas',
    'new_request' => '📝 Nouvelle demande'
    ],
    ];

    $lang =$lang = session('cook_language', 'ar');
    $t = $translations[$lang] ?? $translations['ar'];
    @endphp
    <a href="{{ route('families.meals.index') }}" class="btn">
        {{ $t['cooking_schedule'] }}
    </a>
    <a href="{{ route('chefs.special-requests') }}" class="btn">
        {{ $t['new_request'] }}
    </a>
</div>