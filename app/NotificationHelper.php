<?php

namespace App\Traits;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

trait NotificationHelper
{
    /**
     * إرسال إشعار (Database + Firebase)
     */
    protected function sendNotification($message, $title = null, $type = 'general', $extraData = [])
    {
        $user = Auth::user();

        // حفظ في قاعدة البيانات
        Notification::create([
            'user_id' => $user->id,
            'message' => $message
        ]);

        // إرسال Firebase (لو موجود token)
        if ($user->fcm_token) {
            try {
                $firebase = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
                $messaging = $firebase->createMessaging();

                $notificationData = [
                    'title' => $title ?? 'إشعار جديد',
                    'body' => $message,
                ];

                $data = array_merge([
                    'type' => $type,
                    'timestamp' => now()->toDateTimeString()
                ], $extraData);

                $firebaseMessage = CloudMessage::withTarget('token', $user->fcm_token)
                    ->withNotification($notificationData)
                    ->withData($data);

                $messaging->send($firebaseMessage);
            } catch (\Exception $e) {
                Log::error('Firebase notification error: ' . $e->getMessage());
            }
        }
    }
}
