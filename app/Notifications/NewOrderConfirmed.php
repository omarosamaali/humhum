<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel; // استيراد القناة
use NotificationChannels\OneSignal\OneSignalMessage; // استيراد رسالة OneSignal

class NewOrderConfirmed extends Notification
{
    use Queueable;

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * تحديد قنوات الإرسال.
     */
    public function via($notifiable)
    {
        // نحدد القناة التي سنستخدمها
        return [OneSignalChannel::class];
    }

    /**
     * تهيئة رسالة OneSignal.
     */
    public function toOneSignal($notifiable)
    {
        return OneSignalMessage::create()
            // العنوان الذي سيظهر في الإشعار
            ->subject('✅ تم تأكيد طلبك بنجاح!')
            // الرسالة التي ستظهر
            ->body('تهانينا، الطلب رقم ' . $this->orderId . ' قيد التنفيذ الآن.')
            // (اختياري) رابط يفتحه التطبيق عند الضغط على الإشعار
            ->url(url('/orders/' . $this->orderId))
            // (اختياري) بيانات إضافية ترسل للتطبيق دون عرضها كرسالة
            ->data('order_id', $this->orderId);
    }
}
