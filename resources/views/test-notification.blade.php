<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    // تمرير المفتاح العام من .env إلى JavaScript
    const VAPID_PUBLIC_KEY = "{{ config('webpush.vapid.public_key') }}";
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

    // دالة مساعدة لفك تشفير المفتاح العام
    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/-/g, '+')
            .replace(/_/g, '/');

        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }

    // منطق تسجيل Service Worker والاشتراك
    if ('serviceWorker' in navigator && 'PushManager' in window) {
        navigator.serviceWorker.register('/serviceworker.js')
            .then(registration => {
                console.log('Service Worker registered successfully.');

                // طلب الإذن بالإشعارات
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        console.log('Notification permission granted.');
                        
                        // محاولة الاشتراك
                        registration.pushManager.subscribe({
                            userVisibleOnly: true,
                            applicationServerKey: urlBase64ToUint8Array(VAPID_PUBLIC_KEY)
                        }).then(subscription => {
                            // إرسال الـ Subscription Object إلى الخادم للتخزين
                            sendSubscriptionToLaravel(subscription);
                        }).catch(error => {
                            console.error('Push subscription failed:', error);
                        });
                    } else {
                        console.warn('Notification permission denied.');
                    }
                });
            })
            .catch(error => {
                console.error('Service Worker registration failed:', error);
            });
    }

    function sendSubscriptionToLaravel(subscription) {
        // إرسال بيانات الاشتراك إلى مسار API في Laravel
        fetch('/push-subscribe', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN 
            },
            body: JSON.stringify(subscription)
        })
        .then(response => response.json())
        .then(data => console.log('Subscription saved:', data))
        .catch(error => console.error('Error saving subscription:', error));
    }
</script>