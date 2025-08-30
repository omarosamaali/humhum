// FCM Token Management
class FCMTokenManager {
    constructor() {
        this.fcmToken = null;
        this.init();
    }

    async init() {
        try {
            // Check if Firebase is available (both old and new SDK)
            if (typeof firebase !== 'undefined' && firebase.messaging) {
                await this.initializeFirebase();
            } else if (window.firebaseConfig) {
                // Try to initialize with ES6 modules
                await this.initializeFirebaseES6();
            } else {
                // Fallback: Generate a simple token if Firebase is not available
                this.generateFallbackToken();
            }
        } catch (error) {
            console.warn('FCM initialization failed, using fallback token:', error);
            this.generateFallbackToken();
        }
    }

    async initializeFirebase() {
        try {
            // Request permission for notifications
            const permission = await Notification.requestPermission();
            
            if (permission === 'granted') {
                // Get the messaging instance
                const messaging = firebase.messaging();
                
                // Get the FCM token
                this.fcmToken = await messaging.getToken({
                    vapidKey: this.getVapidKey()
                });
                
                console.log('FCM Token generated:', this.fcmToken);
                
                // Update all hidden input fields
                this.updateTokenFields();
                
                // Listen for token refresh
                messaging.onTokenRefresh(() => {
                    messaging.getToken().then((refreshedToken) => {
                        this.fcmToken = refreshedToken;
                        this.updateTokenFields();
                        console.log('FCM Token refreshed:', this.fcmToken);
                    });
                });
                
            } else {
                console.warn('Notification permission denied, using fallback token');
                this.generateFallbackToken();
            }
        } catch (error) {
            console.error('Firebase messaging error:', error);
            this.generateFallbackToken();
        }
    }

    async initializeFirebaseES6() {
        try {
            // Request permission for notifications
            const permission = await Notification.requestPermission();
            
            if (permission === 'granted') {
                // Import Firebase modules dynamically
                const { initializeApp } = await import('https://www.gstatic.com/firebasejs/12.2.1/firebase-app.js');
                const { getMessaging, getToken, onMessage } = await import('https://www.gstatic.com/firebasejs/12.2.1/firebase-messaging.js');
                
                // Initialize Firebase
                const app = initializeApp(window.firebaseConfig);
                const messaging = getMessaging(app);
                
                // Get the FCM token
                this.fcmToken = await getToken(messaging, {
                    vapidKey: this.getVapidKey()
                });
                
                console.log('FCM Token generated (ES6):', this.fcmToken);
                
                // Update all hidden input fields
                this.updateTokenFields();
                
                // Listen for token refresh (for ES6, we need to handle this differently)
                // The token refresh is handled automatically by Firebase
                
            } else {
                console.warn('Notification permission denied, using fallback token');
                this.generateFallbackToken();
            }
        } catch (error) {
            console.error('Firebase ES6 messaging error:', error);
            this.generateFallbackToken();
        }
    }

    generateFallbackToken() {
        // Generate a simple token for fallback
        this.fcmToken = 'fallback_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        console.log('Fallback FCM Token generated:', this.fcmToken);
        this.updateTokenFields();
    }

    updateTokenFields() {
        // Update all hidden input fields with the FCM token
        const tokenFields = document.querySelectorAll('input[name="fcm_token"]');
        tokenFields.forEach(field => {
            field.value = this.fcmToken;
        });
    }

    getVapidKey() {
        // Return your VAPID key from config or environment
        // You can set this in your .env file and access it via a global variable
        return window.FCM_VAPID_KEY || null;
    }

    getToken() {
        return this.fcmToken;
    }

    // Method to manually update token (useful for testing)
    setToken(token) {
        this.fcmToken = token;
        this.updateTokenFields();
    }
}

// Initialize FCM Token Manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.fcmTokenManager = new FCMTokenManager();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FCMTokenManager;
}
