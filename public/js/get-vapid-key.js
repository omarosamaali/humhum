// Helper script to get VAPID key from Firebase Console
console.log(`
🔥 FCM VAPID Key Setup Guide 🔥

To get your VAPID key:

1. Go to Firebase Console: https://console.firebase.google.com/
2. Select your project: "hum-hum-partner"
3. Go to Project Settings (gear icon)
4. Click on "Cloud Messaging" tab
5. Scroll down to "Web Push certificates"
6. Click "Generate Key Pair" if you don't have one
7. Copy the "Key pair" (this is your VAPID key)

Then update the VAPID key in public/js/firebase-config.js:

window.FCM_VAPID_KEY = "YOUR_ACTUAL_VAPID_KEY_HERE";

Example:
window.FCM_VAPID_KEY = "BEl62iUYgUivxIkv69yViEuiBIa1...";

After updating the VAPID key, refresh your page and check the console for FCM token generation.
`);

// Check if VAPID key is set
if (window.FCM_VAPID_KEY && window.FCM_VAPID_KEY !== "YOUR_VAPID_KEY_HERE") {
    console.log('✅ VAPID key is configured:', window.FCM_VAPID_KEY.substring(0, 20) + '...');
} else {
    console.log('❌ VAPID key not configured. Please follow the steps above.');
}
