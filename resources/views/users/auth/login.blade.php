@extends('layouts.user-auth')

@section('title', 'تسجيل الدخول | Login')

@section('section')
<div class="container py-0">
    <div class="dz-authentication-area">
        <div class="main-logo">
            <div class="logo" style="right: 32px; position: relative;">
                <img src="{{ asset('assets/images/user-logo/logo.png') }}" alt="logo">
            </div>
        </div>
        <div class="account-section">
            <form action="{{ route('users.auth.post') }}" method="POST" class="m-b30">
                @csrf
                <div class="mb-4">
                    <label class="form-label" for="email">البريد الإلكتروني</label>
                    <div class="input-group input-mini input-lg">
                        <input type="email" id="email" name="email" class="form-control text-center"
                            placeholder="example@email.com" required value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="m-b30">
                    <div class="input-group input-mini input-lg" style="justify-content: center;">
                        <label class="form-label">كلمة المرور</label>
                        <div class="otp-group" id="otpGroup" aria-label="حقل كلمة المرور المكوّن من 4 خانات"
                            style="display: flex;  gap: 5px; margin-bottom: 40px; direction: rtl;">
                            <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="0"
                                autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-2"
                                الاسم="الرقم ٢" عنصر نائب="" البيانات-التالي="الرقم ٣" البيانات-السابق="الرقم ١">
                            <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="1"
                                autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-3"
                                name="digit-3" placeholder="" data-next="digit-4" data-previous="digit-2">
                            <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="2"
                                autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-4"
                                name="digit-4" placeholder="" data-next="digit-5" data-previous="digit-3">
                            <input inputmode="numeric" pattern="[0-9]*" maxlength="1" data-index="3"
                                autocomplete="one-time-code" class="form-control otp-input" type="text" id="digit-5"
                                name="digit-5" placeholder="" data-next="digit-6" data-previous="digit-4">
                        </div>
                    </div>
                    @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" name="password" id="passwordHidden" />

                <!-- إضافة حقل FCM Token المخفي -->
                <input type="hidden" name="fcm_token" id="fcmToken" />

                <button type="submit" class="btn btn-thin btn-lg w-100 btn-primary rounded-xl mb-3">
                    دخول
                </button>
                <p class="form-text text-center">
                    نسيت كلمة المرور؟
                    <a href="{{ route('users.auth.password.request') }}" class="link ms-2">استرجاع كلمة المرور</a>
                </p>
            </form>
            <div class="text-center account-footer">
                <a href="{{ route('users.auth.register') }}" style="border: 1px solid var(--primary-color);
                background-color: white !important; color: var(--primary-color) !important;"
                    class="btn btn-secondary btn-lg btn-thin rounded-xl w-100">
                    إنشاء حساب جديد
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/password.js') }}"></script>
<!-- في نهاية الصفحة قبل </body> -->

<!-- Firebase SDK -->
<script type="module">
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js';
    import { getMessaging, getToken } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js';

    // إعدادات Firebase الخاصة بمشروعك
const firebaseConfig = {
apiKey: "AIzaSyBQCPTwnybdtLNUwNCzDDA23TLt3pD5zP4",
authDomain: "omdachina25.firebaseapp.com",
databaseURL: "https://omdachina25-default-rtdb.firebaseio.com",
projectId: "omdachina25",
storageBucket: "omdachina25.firebasestorage.app",
messagingSenderId: "1031143486488",
appId: "1:1031143486488:web:0a662055d970826268bf6d",
measurementId: "G-G9TLSKJ92H"
};

    // تهيئة Firebase
    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);

    // محاولة الحصول على FCM Token
    async function requestNotificationPermission() {
        try {
            const permission = await Notification.requestPermission();
            
            if (permission === 'granted') {
                const token = await getToken(messaging, { 
                    vapidKey: 'BB168ueRnlIhDY0r5lrLD7pvQydPk467794F97CWizmwnvzxAWtlx3fuZ9NQtxc0QeokXdnBjiYoiINBIRvCQiY' // من Firebase Console > Project Settings > Cloud Messaging
                });
                
                if (token) {
                    // وضع الـ Token في الحقل المخفي
                    document.getElementById('fcmToken').value = token;
                    console.log('FCM Token:', token);
                } else {
                    console.log('لم يتم الحصول على FCM Token');
                }
            } else {
                console.log('المستخدم رفض الإشعارات');
            }
        } catch (error) {
            console.error('خطأ في الحصول على FCM Token:', error);
        }
    }

    // طلب الإذن عند تحميل الصفحة
    requestNotificationPermission();
</script>
@endsection