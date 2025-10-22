<?php

namespace App\Traits;

use App\Models\Cook;
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
    protected function sendNotification($message, $title = 'إشعار جديد', $type = 'general', $extraData = [])
    {
        // حاول تجيب المستخدم من Auth أولاً
        $user = Auth::user();

        // لو مافيش user مسجل دخول، شوف لو في cook أو family member في extraData
        if (!$user) {
            if (isset($extraData['cook_id'])) {
                $cook = Cook::find($extraData['cook_id']);
                if ($cook && $cook->user_id) {
                    $user = \App\Models\User::find($cook->user_id);
                }
            } elseif (isset($extraData['family_member_id'])) {
                $familyMember = \App\Models\MyFamily::find($extraData['family_member_id']);
                if ($familyMember && $familyMember->user_id) {
                    $user = \App\Models\User::find($familyMember->user_id);
                }
            }
        }

        // لو لسه مافيش user، ارجع false
        if (!$user) {
            Log::warning('Could not find user for notification', $extraData);
            return false;
        }

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

                $data = array_merge([
                    'type' => $type,
                    'timestamp' => now()->toDateTimeString()
                ], $extraData);

                $firebaseMessage = CloudMessage::withTarget('token', $user->fcm_token)
                    ->withNotification([
                        'title' => $title,
                        'body' => $message,
                    ])
                    ->withData($data);

                $messaging->send($firebaseMessage);
            } catch (\Exception $e) {
                Log::error('Firebase notification error: ' . $e->getMessage());
            }
        }

        return true;
    }
}
