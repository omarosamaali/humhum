// public/firebase-messaging-sw.js
importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyBQCPTwnybdtLNUwNCzDDA23TLt3pD5zP4",
    authDomain: "omdachina25.firebaseapp.com",
    databaseURL: "https://omdachina25-default-rtdb.firebaseio.com",
    projectId: "omdachina25",
    storageBucket: "omdachina25.firebasestorage.app",
    messagingSenderId: "1031143486488",
    appId: "1:1031143486488:web:0a662055d970826268bf6d",
    measurementId: "G-G9TLSKJ92H"
});

const messaging = firebase.messaging();

// استقبال الإشعارات في الـ Background
messaging.onBackgroundMessage((payload) => {
    console.log('📩 Background Message:', payload);
    
    const notificationTitle = payload.notification?.title || 'إشعار جديد';
    const notificationOptions = {
        body: payload.notification?.body || '',
        icon: '/firebase-logo.png',
        badge: '/badge-icon.png',
        data: payload.data
    };
    
    self.registration.showNotification(notificationTitle, notificationOptions);
});