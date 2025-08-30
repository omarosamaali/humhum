<img src="{{ asset('assets/img/g.jpeg') }}" alt="" class=""
    style="position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    z-index: -1;
    height: 100%;
">
    <img src="{{ asset('assets/img/image 6.png') }}" alt="" style="    width: 134px;
    z-index: 9999999999999;
    margin: auto;
    display: flex
;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    position: absolute;
    top: 21px;
    ">
<div class="login-container">
    <h2 class="login-title">تسجيل الدخول</h2>

    <!-- Session Status -->
    @if (session('status'))
        <div class="status-message">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
            <input 
                id="email" 
                class="form-input" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="أدخل بريدك الإلكتروني"
            />
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">{{ __('كلمة المرور') }}</label>
            <input 
                id="password" 
                class="form-input"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
                placeholder="أدخل كلمة المرور"
            />
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="checkbox-container">
            <input 
                id="remember_me" 
                type="checkbox" 
                class="checkbox" 
                name="remember"
            >
            <label for="remember_me" class="checkbox-label">{{ __('تذكرني') }}</label>
        </div>

        <div class="form-footer">
            {{-- @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
             --}}
            <button type="submit" class="login-button">
                {{ __('Log in') }}
            </button>
        </div>

        <input type="hidden" name="fcm_token" value="{{ old('fcm_token') }}" id="fcm_token_input">
    </form>
</div>

<!-- Firebase SDK -->
{{-- <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js"></script> --}}


<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- FCM Token Update Script -->
<script>
    function updateFCMToken() {
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyCccKoa-csICi9_a9SkSrS23-zWXcJsUxg",
            authDomain: "hum-hum-partner.firebaseapp.com",
            projectId: "hum-hum-partner",
            storageBucket: "hum-hum-partner.firebasestorage.app",
            messagingSenderId: "1041310056671",
            appId: "1:1041310056671:web:ad369ad5a30ada3114696a",
            measurementId: "G-T6WMTF4DF2"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission().then(function() {
                return messaging.getToken();
            }).then(function(token) {
                console.log('FCM Token generated:', token);
                
                // Update the hidden input field
                document.getElementById('fcm_token_input').value = token;
                
                // If user is already logged in, update token via AJAX
                @auth
                    updateTokenOnServer(token);
                @endauth

            }).catch(function(err) {
                console.log(`Token Error :: ${err}`);
                // Generate fallback token
                const fallbackToken = 'fallback_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                document.getElementById('fcm_token_input').value = fallbackToken;
            });
        }

        function updateTokenOnServer(token) {
            // Send token to server to update user's FCM token
            fetch('{{ route("fcm.update-token") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    fcm_token: token
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Token updated on server:', data);
            })
            .catch(error => {
                console.error('Error updating token on server:', error);
            });
        }

        initFirebaseMessagingRegistration();

        // Listen for incoming messages
        messaging.onMessage(function(payload) {
            console.log('Message received:', payload);
            
            const { notification } = payload;
            if (notification) {
                new Notification(notification.title, {
                    body: notification.body,
                    icon: '/favicon.ico'
                });
            }
        });

        // Listen for token refresh
        messaging.onTokenRefresh(() => {
            messaging.getToken().then((refreshedToken) => {
                console.log('Token refreshed:', refreshedToken);
                document.getElementById('fcm_token_input').value = refreshedToken;
                
                // Update token on server if user is logged in
                @auth
                    updateTokenOnServer(refreshedToken);
                @endauth
            });
        });
    }

    // Initialize FCM token update when page loads
    document.addEventListener('DOMContentLoaded', function() {
        updateFCMToken();
    });
</script>

<!-- Add CSRF token meta tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
/* CSS for Login Form */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 50px 40px;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 420px;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4facfe, #00f2fe, #4facfe);
    background-size: 200% 100%;
    animation: gradient 3s ease infinite;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.login-title {
    text-align: center;
    margin-bottom: 35px;
    color: #2c3e50;
    font-size: 32px;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-label {
    display: block;
    margin-bottom: 10px;
    color: #34495e;
    font-weight: 600;
    text-align: center;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-input {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e8ecf4;
    border-radius: 12px;
    font-size: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(145deg, #f8f9fa, #ffffff);
    color: #2c3e50;
    font-weight: 500;
}

.form-input:focus {
    outline: none;
    border-color: #4facfe;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
    transform: translateY(-2px);
}

.form-input:hover {
    border-color: #bdc3c7;
    transform: translateY(-1px);
}

.form-input::placeholder {
    color: #95a5a6;
    font-weight: 400;
}

.error-message {
    color: #e74c3c;
    font-size: 13px;
    margin-top: 8px;
    display: block;
    font-weight: 500;
    padding-left: 5px;
}

.status-message {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    border: 1px solid #c3e6cb;
    font-weight: 500;
    text-align: center;
}

.checkbox-container {
    display: flex;
    align-items: center;
    margin: 25px 0 30px 0;
    padding: 15px;
    background: rgba(79, 172, 254, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(79, 172, 254, 0.1);
}

.checkbox {
    margin-left: 12px;
    width: 20px;
    height: 20px;
    accent-color: #4facfe;
    cursor: pointer;
}

.checkbox-label {
    color: #34495e;
    font-size: 15px;
    cursor: pointer;
    font-weight: 500;
    user-select: none;
}

.form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    flex-wrap: wrap;
    gap: 20px;
}

.forgot-password {
    color: #4facfe;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.forgot-password:hover {
    color: #00f2fe;
    transform: translateY(-1px);
}

.forgot-password::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #4facfe, #00f2fe);
    transition: width 0.3s ease;
}

.forgot-password:hover::after {
    width: 100%;
}

.login-button {
    background: #660099;
    color: white;
    padding: 15px 35px;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    min-width: 140px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
}

.login-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.login-button:hover::before {
    left: 100%;
}

.login-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(79, 172, 254, 0.4);
}

.login-button:active {
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
}

@media (max-width: 480px) {
    .login-container {
        padding: 40px 30px;
        margin: 10px;
    }
    
    .login-title {
        font-size: 28px;
    }
    
    .form-footer {
        flex-direction: column;
        text-align: center;
    }
    
    .login-button {
        width: 100%;
        margin-top: 10px;
    }
}

/* تأثير إضافي للحركة */
.form-group {
    animation: slideUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.checkbox-container { animation-delay: 0.4s; }
.form-footer { animation-delay: 0.5s; }

@keyframes slideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-title {
    animation: fadeInDown 0.8s ease-out;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>