
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCccKoa-csICi9_a9SkSrS23-zWXcJsUxg",
    authDomain: "hum-hum-partner.firebaseapp.com",
    projectId: "hum-hum-partner",
    storageBucket: "hum-hum-partner.firebasestorage.app",
    messagingSenderId: "1041310056671",
    appId: "1:1041310056671:web:ad369ad5a30ada3114696a",
    measurementId: "G-T6WMTF4DF2"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});