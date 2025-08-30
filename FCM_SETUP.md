# FCM Token Setup Guide

This guide explains how to set up and use Firebase Cloud Messaging (FCM) tokens for push notifications in your Laravel application.

## Overview

The FCM token functionality has been implemented across all authentication forms (login and register) in your application. When users log in or register, an FCM token is automatically generated and stored in the database.

## Features Implemented

1. **Automatic FCM Token Generation**: Tokens are generated when users visit login/register pages
2. **Fallback Token System**: If Firebase is not available, a fallback token is generated
3. **Token Storage**: Tokens are stored in the `fcm_token` field in the users table
4. **Cross-Platform Support**: Works with all authentication systems (Admin, ChefLens, C1he3f)

## Files Modified/Created

### New Files:
- `public/js/fcm-token.js` - Main FCM token management script
- `public/js/firebase-config.js` - Firebase configuration template
- `FCM_SETUP.md` - This setup guide

### Modified Files:
- `resources/views/auth/login.blade.php` - Added FCM token field and script
- `resources/views/auth/register.blade.php` - Added FCM token field and script
- `resources/views/chef_lens/auth/sign-in.blade.php` - Added FCM token field and script
- `resources/views/chef_lens/auth/sign-up.blade.php` - Added FCM token field and script
- `resources/views/c1he3f/auth/welcome.blade.php` - Added FCM token field and script
- `resources/views/c1he3f/auth/sign-up.blade.php` - Added FCM token field and script
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php` - Updated to handle FCM tokens
- `app/Http/Controllers/Auth/RegisteredUserController.php` - Updated to handle FCM tokens
- `app/Http/Controllers/ChefLens/LoginController.php` - Updated to handle FCM tokens
- `app/Http/Controllers/ChefLens/ChefRegisterController.php` - Updated to handle FCM tokens
- `app/Http/Controllers/C1he3f/Auth/ChefAuthenticatedSessionController.php` - Updated to handle FCM tokens

## Setup Instructions

### 1. Firebase Project Setup

1. Go to [Firebase Console](https://console.firebase.google.com/)
2. Create a new project or select an existing one
3. Enable Cloud Messaging in the project settings
4. Generate a VAPID key pair for web push notifications

### 2. Configure Firebase

✅ **Firebase Configuration Updated**: Your Firebase configuration has been automatically updated with your project settings.

**Next Step - Get VAPID Key:**

1. Go to [Firebase Console](https://console.firebase.google.com/)
2. Select your project: **"hum-hum-partner"**
3. Go to **Project Settings** (gear icon in the top left)
4. Click on **"Cloud Messaging"** tab
5. Scroll down to **"Web Push certificates"**
6. Click **"Generate Key Pair"** if you don't have one
7. Copy the **"Key pair"** (this is your VAPID key)

Then update the VAPID key in `public/js/firebase-config.js`:

```javascript
// Replace this line:
window.FCM_VAPID_KEY = "YOUR_VAPID_KEY_HERE";

// With your actual VAPID key:
window.FCM_VAPID_KEY = "BEl62iUYgUivxIkv69yViEuiBIa1..."; // Your actual key here
```

### 3. Include Firebase SDK

Add the Firebase SDK to your layout files or individual pages. You can include it via CDN:

```html
<!-- Firebase App (the core Firebase SDK) -->
<script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-app.js"></script>

<!-- Firebase Cloud Messaging -->
<script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-messaging.js"></script>

<!-- Your Firebase config -->
<script src="{{ asset('js/firebase-config.js') }}"></script>

<!-- FCM Token Manager -->
<script src="{{ asset('js/fcm-token.js') }}"></script>
```

### 4. Database Migration

The FCM token field has already been added to the users table via migration. If you haven't run the migration yet, run:

```bash
php artisan migrate
```

## How It Works

### Token Generation Process

1. When a user visits any login or register page, the FCM token manager initializes
2. If Firebase is available and notification permission is granted:
   - A real FCM token is generated
   - The token is stored in the hidden input field
3. If Firebase is not available or permission is denied:
   - A fallback token is generated (format: `fallback_timestamp_randomstring`)
   - The fallback token is stored in the hidden input field

### Token Storage

When users submit login or registration forms:
1. The FCM token is sent along with other form data
2. The token is validated and stored in the `fcm_token` field in the users table
3. For login requests, existing tokens are updated with new ones

### Token Refresh

The system automatically handles token refresh:
- When Firebase refreshes the token, it's automatically updated in the form
- The new token will be sent on the next form submission

## Usage Examples

### Sending Push Notifications

Once you have FCM tokens stored, you can send push notifications using Laravel's notification system or direct FCM API calls.

Example using Laravel Notifications:

```php
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderNotification extends Notification
{
    public function toFcm($notifiable)
    {
        return [
            'notification' => [
                'title' => 'New Order',
                'body' => 'You have a new order!',
            ],
            'data' => [
                'order_id' => '123',
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            ],
        ];
    }
}
```

### Manual Token Management

You can also manually manage tokens in your controllers:

```php
// Update user's FCM token
$user->fcm_token = $request->fcm_token;
$user->save();

// Get all users with FCM tokens
$usersWithTokens = User::whereNotNull('fcm_token')->get();

// Send notification to specific user
$user->notify(new OrderNotification());
```

## Testing

### Test Token Generation

1. Open browser developer tools
2. Visit any login or register page
3. Check the console for FCM token generation messages
4. Verify the hidden input field contains a token value

### Test Form Submission

1. Fill out a login or register form
2. Submit the form
3. Check the database to verify the FCM token was stored
4. Check the user's `fcm_token` field in the database

## Troubleshooting

### Common Issues

1. **Firebase not initialized**: Make sure Firebase SDK is loaded before the FCM token script
2. **Permission denied**: Users need to grant notification permission for real FCM tokens
3. **VAPID key missing**: Ensure the VAPID key is set in the Firebase config
4. **Token not updating**: Check browser console for JavaScript errors

### Debug Mode

Enable debug logging by adding this to your browser console:

```javascript
localStorage.setItem('fcm_debug', 'true');
```

This will show detailed logs about token generation and updates.

## Security Considerations

1. **VAPID Key**: Keep your VAPID key secure and don't expose it in client-side code for production
2. **Token Validation**: Always validate FCM tokens on the server side
3. **HTTPS**: FCM requires HTTPS in production environments
4. **Token Expiry**: Implement token expiry and refresh mechanisms

## Next Steps

1. ✅ **Firebase Configuration**: Your Firebase project is configured
2. 🔄 **Get VAPID Key**: Follow the instructions above to get your VAPID key
3. 🧪 **Test the Implementation**: 
   - Visit `http://your-domain.com/fcm-test.html` to test token generation
   - Or visit any login/register page and check browser console
4. 📱 **Test on Authentication Forms**: Try logging in or registering to see tokens being generated
5. 🔔 **Implement Push Notifications**: Use the stored tokens to send push notifications
6. 🔄 **Add Token Refresh**: Implement token refresh and cleanup mechanisms
7. 📊 **Set up Monitoring**: Add monitoring and analytics for push notifications

## Quick Test

1. Visit any login page (e.g., `/login`)
2. Open browser developer tools (F12)
3. Check the console for FCM token generation messages
4. Look for messages like:
   - "FCM Token generated: [token]"
   - "Fallback FCM Token generated: [token]"
   - "VAPID key not configured" (if you haven't set it yet)

## Files Created for Testing

- `public/fcm-test.html` - Test page to verify FCM token generation
- `public/js/get-vapid-key.js` - Helper script with VAPID key instructions

## Support

If you encounter any issues:
1. Check the browser console for JavaScript errors
2. Verify Firebase configuration is correct
3. Ensure all required scripts are loaded in the correct order
4. Check that the database migration has been run
