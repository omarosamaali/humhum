<?php

namespace App\Traits;

use App\Models\Cook;
use App\Models\MyFamily;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

trait NotificationHelperUser
{
    /**
     * إرسال إشعار لليوزر صاحب الحساب
     * 
     * @param int $userId - الـ user_id من جدول cooks أو my_family
     * @param string $message - نص الرسالة
     * @param string $title - عنوان الإشعار
     * @param string $type - نوع الإشعار
     * @param array $extraData - بيانات إضافية
     */
    protected function sendNotificationToUser($userId, $message, $title = 'إشعار جديد', $type = 'general', $extraData = [])
    {
        Log::info('🔔 [FCM DEBUG] sendNotificationToUser called', [
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
        ]);

        // جيب اليوزر من الـ ID
        $user = User::find($userId);

        if (!$user) {
            Log::warning('🚫 [FCM DEBUG] User not found for notification', ['user_id' => $userId]);
            return false;
        }

        Log::info('👤 [FCM DEBUG] User found', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'fcm_token' => $user->fcm_token ? substr($user->fcm_token, 0, 30) . '...' : 'NULL - لا يوجد token',
        ]);

        Notification::create([
            'user_id' => $user->id,
            'family_member_id' => session('family_id'),
            'message' => $message,
            'is_read' => false
        ]);

        Log::info('💾 [FCM DEBUG] Notification saved to database', ['user_id' => $user->id]);

        // إرسال Firebase (لو موجود token)
        if ($user->fcm_token) {
            Log::info('📤 [FCM DEBUG] Attempting to send Firebase notification', [
                'token_preview' => substr($user->fcm_token, 0, 30) . '...',
            ]);
            try {
                $credentialsPath = config('services.firebase.credentials');
                Log::info('🔑 [FCM DEBUG] Credentials path: ' . $credentialsPath . ' | Exists: ' . (file_exists($credentialsPath) ? 'YES' : 'NO'));

                $firebase = (new Factory)->withServiceAccount($credentialsPath);
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

                Log::info('✅ [FCM DEBUG] Firebase notification sent successfully', ['user_id' => $userId, 'message' => $message]);
            } catch (\Exception $e) {
                Log::error('❌ [FCM DEBUG] Firebase notification error: ' . $e->getMessage(), [
                    'user_id' => $userId,
                    'exception_class' => get_class($e),
                ]);
            }
        } else {
            Log::warning('⚠️ [FCM DEBUG] fcm_token is NULL - notification NOT sent via Firebase!', [
                'user_id' => $userId,
                'hint' => 'المستخدم لم يسجل FCM token - WebView قد لا يدعم Service Worker',
            ]);
        }

        return true;
    }

    /**
     * إرسال إشعار تسجيل دخول طباخ
     */
    protected function sendCookLoginNotification(Cook $cook)
    {
        if (!$cook->user_id) {
            Log::warning('Cook has no user_id', ['cook_id' => $cook->id]);
            return false;
        }

        return $this->sendNotificationToUser(
            $cook->user_id,
            "قام الطباخ {$cook->name} بتسجيل الدخول",
            'تسجيل دخول طباخ',
            'cook_login',
            [
                'cook_id' => $cook->id,
                'cook_name' => $cook->name
            ]
        );
    }

    /**
     * إرسال إشعار تسجيل دخول فرد من العائلة
     */
    protected function sendFamilyLoginNotification(MyFamily $familyMember)
    {
        if (!$familyMember->user_id) {
            Log::warning('Family member has no user_id', ['family_member_id' => $familyMember->id]);
            return false;
        }

        return $this->sendNotificationToUser(
            $familyMember->user_id,
            " قام الفرد {$familyMember->name} بتسجيل الدخول بنجاح",
            'تسجيل دخول فرد من العائلة',
            'family_login',
            [
                'family_member_id' => $familyMember->id,
                'family_member_name' => $familyMember->name
            ]
        );
    }
}
