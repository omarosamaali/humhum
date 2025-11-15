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
    <a href="{{ route('families.meals.index') }}" class="btn">
        🍳 جدول الطبخ
    </a>
    <a href="{{ route('chefs.special-requests') }}" class="btn">
        📝 طلب جديد
    </a>
</div>