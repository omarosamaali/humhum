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

@auth
<script>
async function saveChefFCMToken(token) {
    if (!token) return;
    try {
        await fetch('{{ route("subscribe.chef.topic") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({
                fcm_token:   token,
                cook_id:     {{ session('cook_id', 0) }},
                cook_number: '{{ session('cook_number', '') }}'
            })
        });
        console.log('✅ Chef FCM token saved');
    } catch (e) {
        console.error('❌ Failed to save chef FCM token:', e);
    }
}

async function initChefFCMToken() {
    if (window._fcmToken && window._fcmToken.length > 10) {
        await saveChefFCMToken(window._fcmToken); return;
    }
    if (window.AndroidBridge && typeof window.AndroidBridge.getFCMToken === 'function') {
        const t = window.AndroidBridge.getFCMToken();
        if (t && t.length > 10) { await saveChefFCMToken(t); return; }
    }
    try {
        const { initializeApp } = await import('https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js');
        const { getMessaging, getToken } = await import('https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js');
        const app = initializeApp({
            apiKey: "AIzaSyBQCPTwnybdtLNUwNCzDDA23TLt3pD5zP4",
            authDomain: "omdachina25.firebaseapp.com",
            projectId: "omdachina25",
            storageBucket: "omdachina25.firebasestorage.app",
            messagingSenderId: "1031143486488",
            appId: "1:1031143486488:web:0a662055d970826268bf6d"
        });
        const messaging = getMessaging(app);
        const permission = await Notification.requestPermission();
        if (permission !== 'granted') return;
        const token = await getToken(messaging, { vapidKey: 'BB168ueRnlIhDY0r5lrLD7pvQydPk467794F97CWizmwnvzxAWtlx3fuZ9NQtxc0QeokXdnBjiYoiINBIRvCQiY' });
        if (token) await saveChefFCMToken(token);
    } catch (e) {
        console.log('ℹ️ Web Push not supported:', e.message);
    }
}

initChefFCMToken();
</script>
@endauth