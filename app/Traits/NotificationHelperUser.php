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
        // جيب اليوزر من الـ ID
        $user = User::find($userId);

        if (!$user) {
            Log::warning('User not found for notification', ['user_id' => $userId]);
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

                Log::info('Notification sent successfully', ['user_id' => $userId, 'message' => $message]);
            } catch (\Exception $e) {
                Log::error('Firebase notification error: ' . $e->getMessage());
            }
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
