// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyBQCPTwnybdtLNUwNCzDDA23TLt3pD5zP4",
    authDomain: "omdachina25.firebaseapp.com",
    databaseURL: "https://omdachina25-default-rtdb.firebaseio.com",
    projectId: "omdachina25",
    storageBucket: "omdachina25.firebasestorage.app",
    messagingSenderId: "1031143486488",
    appId: "1:1031143486488:web:0a662055d970826268bf6d",
    measurementId: "G-G9TLSKJ92H",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon || "/icon.png",
        data: payload.data,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
