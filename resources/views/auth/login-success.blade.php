{{-- resources/views/users/auth/login-success.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول بنجاح</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .success-container {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 450px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .checkmark-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #4CAF50;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .checkmark {
            width: 50px;
            height: 50px;
            border: 4px solid white;
            border-top: none;
            border-right: none;
            transform: rotate(-45deg);
            animation: checkmark 0.5s 0.3s ease-in-out forwards;
            opacity: 0;
        }

        @keyframes checkmark {
            to {
                opacity: 1;
            }
        }

        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .username {
            color: #667eea;
            font-weight: 700;
        }

        .message {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .progress-container {
            width: 100%;
            height: 6px;
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            animation: progress 3.5s linear forwards;
            width: 0;
        }

        @keyframes progress {
            to {
                width: 100%;
            }
        }

        .countdown {
            color: #999;
            font-size: 14px;
            font-weight: 500;
        }

        .countdown span {
            color: #667eea;
            font-weight: 700;
            font-size: 18px;
        }

        .dots {
            display: inline-block;
        }

        .dots::after {
            content: '';
            animation: dots 1.5s steps(4, end) infinite;
        }

        @keyframes dots {

            0%,
            20% {
                content: '';
            }

            40% {
                content: '.';
            }

            60% {
                content: '..';
            }

            80%,
            100% {
                content: '...';
            }
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="checkmark-circle">
            <div class="checkmark"></div>
        </div>

        <h1>أهلاً وسهلاً <span class="username">{{ Auth::user()->name ?? 'مستخدم' }}</span>!</h1>
        <p class="message">تم تسجيل دخولك بنجاح ✨</p>

        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>

        <p class="countdown">جاري التحويل خلال <span id="timer">4</span> ثانية<span class="dots"></span></p>
    </div>

    <script>
        let timeLeft = 4;
        const timerElement = document.getElementById('timer');
        
        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
            }
        }, 1000);

        // التحويل بعد 4 ثواني
        setTimeout(() => {
            window.location.href = "{{ route('users.welcome') }}";
        }, 4000);
    </script>
</body>

</html>