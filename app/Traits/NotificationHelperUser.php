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

        // إرسال Firebase
        try {
            $messaging = app('firebase.messaging');

            $data = array_merge([
                'type' => $type,
                'timestamp' => now()->toDateTimeString()
            ], $extraData);

            // محاولة 1: توبيك خاص بالمستخدم
            $userTopic = \App\Models\FcmTopic::where('user_id', $userId)->first();
            $topicToSend = $userTopic ? $userTopic->topic : 'humhum_user_' . $userId;

            $firebaseMessage = CloudMessage::withTarget('topic', $topicToSend)
                ->withNotification(['title' => $title, 'body' => $message])
                ->withData($data);

            $messaging->send($firebaseMessage);
            Log::info('✅ [FCM DEBUG] Sent via topic: ' . $topicToSend);

        } catch (\Exception $e) {
            Log::warning('⚠️ [FCM DEBUG] Topic failed: ' . $e->getMessage() . ' - trying all topics');

            // محاولة 2: إرسال لكل التوبيكس الموجودة في قاعدة البيانات
            try {
                $allTopics = \App\Models\FcmTopic::whereNotNull('topic')->get();
                Log::info('📋 [FCM DEBUG] All topics in DB: ' . $allTopics->count());

                if ($allTopics->isNotEmpty()) {
                    $messaging = app('firebase.messaging');
                    foreach ($allTopics as $t) {
                        $msg = CloudMessage::withTarget('topic', $t->topic)
                            ->withNotification(['title' => $title, 'body' => $message])
                            ->withData($data);
                        $messaging->send($msg);
                        Log::info('📤 [FCM DEBUG] Sent to fallback topic: ' . $t->topic);
                    }
                } else {
                    Log::warning('❌ [FCM DEBUG] No topics at all in DB - user must subscribe first');
                }
            } catch (\Exception $e2) {
                Log::error('❌ [FCM DEBUG] All fallbacks failed: ' . $e2->getMessage());
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
