<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\MyFamily;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

trait NotificationHelper
{
    /**
     * إرسال إشعار (Database + Firebase)
     * 
     * @param string $message رسالة الإشعار
     * @param string|null $title عنوان الإشعار (للفايربيس)
     * @param string $type نوع الإشعار
     * @param array $extraData بيانات إضافية للفايربيس
     * @param int|null $familyMemberId معرف فرد العائلة (اختياري)
     */
    protected function sendNotification(
        $message,
        $title = null,
        $type = 'general',
        $extraData = [],
        $familyMemberId = null
    ) {
        $user = Auth::user();

        // إذا لم يتم تمرير family_member_id، حاول الحصول عليه من الـ session
        if (!$familyMemberId && session()->has('family_id')) {
            $familyMemberId = session('family_id');
        }

        // إنشاء الإشعار في قاعدة البيانات
        Notification::create([
            'user_id' => $user->id,
            'family_member_id' => $familyMemberId, // ⭐ إضافة هذا
            'message' => $message,
            'is_read' => 0,
        ]);

        // تحديد الـ FCM token المناسب
        $fcmToken = $this->getFcmToken($user, $familyMemberId);

        // إرسال Firebase (لو موجود token)
        if ($fcmToken) {
            try {
                $firebase = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
                $messaging = $firebase->createMessaging();

                $notificationData = [
                    'title' => $title ?? 'إشعار جديد',
                    'body' => $message,
                ];

                $data = array_merge([
                    'type' => $type,
                    'timestamp' => now()->toDateTimeString(),
                    'family_member_id' => $familyMemberId ? (string)$familyMemberId : null, // ⭐ إضافة هذا
                ], $extraData);

                $firebaseMessage = CloudMessage::withTarget('token', $fcmToken)
                    ->withNotification($notificationData)
                    ->withData($data);

                $messaging->send($firebaseMessage);
            } catch (\Exception $e) {
                Log::error('Firebase notification error: ' . $e->getMessage());
            }
        }
    }

    /**
     * الحصول على FCM Token المناسب
     * إذا كان فرد عائلة، نحصل على token الخاص به
     * وإلا نستخدم token المستخدم الرئيسي
     */
    private function getFcmToken($user, $familyMemberId = null)
    {
        // إذا كان فرد عائلة
        if ($familyMemberId) {
            $familyMember = MyFamily::find($familyMemberId);
            // إذا كان للفرد fcm_token خاص به
            if ($familyMember && !empty($familyMember->fcm_token)) {
                return $familyMember->fcm_token;
            }
        }

        // وإلا نستخدم token المستخدم الرئيسي
        return $user->fcm_token;
    }

    /**
     * إرسال إشعار لفرد عائلة محدد
     */
    protected function sendFamilyMemberNotification(
        $familyMemberId,
        $message,
        $title = null,
        $type = 'general',
        $extraData = []
    ) {
        $familyMember = MyFamily::findOrFail($familyMemberId);

        // إنشاء الإشعار
        Notification::create([
            'user_id' => $familyMember->user_id, // المستخدم الرئيسي
            'family_member_id' => $familyMemberId, // الفرد المعني
            'message' => $message,
            'is_read' => 0,
        ]);

        // إرسال Firebase
        $fcmToken = $familyMember->fcm_token ?? User::find($familyMember->user_id)->fcm_token;

        if ($fcmToken) {
            try {
                $firebase = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
                $messaging = $firebase->createMessaging();

                $notificationData = [
                    'title' => $title ?? 'إشعار جديد',
                    'body' => $message,
                ];

                $data = array_merge([
                    'type' => $type,
                    'timestamp' => now()->toDateTimeString(),
                    'family_member_id' => (string)$familyMemberId,
                ], $extraData);

                $firebaseMessage = CloudMessage::withTarget('token', $fcmToken)
                    ->withNotification($notificationData)
                    ->withData($data);

                $messaging->send($firebaseMessage);
            } catch (\Exception $e) {
                Log::error('Firebase notification error for family member: ' . $e->getMessage());
            }
        }
    }

    /**
     * إرسال إشعار للمستخدم الرئيسي فقط (بدون family_member_id)
     */
    protected function sendOwnerNotification(
        $message,
        $title = null,
        $type = 'general',
        $extraData = []
    ) {
        $this->sendNotification($message, $title, $type, $extraData, null);
    }
}
