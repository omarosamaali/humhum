// Import Firebase messaging service worker
importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyBQCPTwnybdtLNUwNCzDDA23TLt3pD5zP4",
    authDomain: "omdachina25.firebaseapp.com",
    projectId: "omdachina25",
    storageBucket: "omdachina25.firebasestorage.app",
    messagingSenderId: "1031143486488",
    appId: "1:1031143486488:web:0a662055d970826268bf6d"
});

const messaging = firebase.messaging();

// Firebase background messages
messaging.onBackgroundMessage((payload) => {
    const title = payload.notification?.title || 'إشعار جديد';
    const options = {
        body: payload.notification?.body || '',
        icon: '/assets/images/user-logo/humhum-icon.png',
        badge: '/assets/images/user-logo/humhum-icon.png',
        data: payload.data,
        dir: 'rtl',
        lang: 'ar'
    };
    self.registration.showNotification(title, options);
});

// Web Push fallback
self.addEventListener('push', event => {
    if (event.data) {
        try {
            const data = event.data.json();
            const title = data.notification?.title || data.title || 'إشعار جديد';
            const options = {
                body: data.notification?.body || data.body || '',
                icon: '/assets/images/user-logo/humhum-icon.png',
                dir: 'rtl'
            };
            event.waitUntil(self.registration.showNotification(title, options));
        } catch(e) {}
    }
});

self.addEventListener('notificationclick', event => {
    event.notification.close();
    event.waitUntil(clients.openWindow('/'));
});
