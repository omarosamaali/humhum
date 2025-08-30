// Firebase Configuration
// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCccKoa-csICi9_a9SkSrS23-zWXcJsUxg",
    authDomain: "hum-hum-partner.firebaseapp.com",
    projectId: "hum-hum-partner",
    storageBucket: "hum-hum-partner.firebasestorage.app",
    messagingSenderId: "1041310056671",
    appId: "1:1041310056671:web:ad369ad5a30ada3114696a",
    measurementId: "G-T6WMTF4DF2"
};

// Initialize Firebase
let app;
let messaging;

// Check if Firebase is available (for module-based imports)
if (typeof firebase !== 'undefined') {
    app = firebase.initializeApp(firebaseConfig);
    messaging = firebase.messaging();
} else {
    // For ES6 module imports, we'll initialize in the FCM token manager
    window.firebaseConfig = firebaseConfig;
}

// VAPID Key for FCM (you'll need to get this from Firebase Console)
// Go to Project Settings > Cloud Messaging > Web Push certificates
window.FCM_VAPID_KEY = "YOUR_VAPID_KEY_HERE"; // Replace with your actual VAPID key

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = firebaseConfig;
}
