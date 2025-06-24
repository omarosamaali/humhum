<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChefProfile extends Model
{

    // تعريف الثابتات للحالات (كما فعلنا سابقًا)
    const STATUS_PENDING_COMPLETION = 'بإنتظار إستكمال البيانات';
    const STATUS_PENDING_ACTIVATION = 'قيد التفعيل'; // الحالة التي نريد أن يصل إليها الشيف بعد إكمال البيانات
    const STATUS_ACTIVE = 'فعال'; // أو 'معتمد'
    const STATUS_REJECTED = 'مرفوض';

    protected $fillable = [
        'name_ar',
        'name_en',
        'name_id',
        'name_am',
        'name_hi',
        'name_bn',
        'name_ml',
        'name_fil',
        'name_ur',
        'name_ta',
        'name_ps',
        'name', // احتفظ بهذا إذا كنت لا تزيله أو تغير اسمه
        'user_id',
        'country',
        'bio',
        'contract_type',
        'profit_transfer_details',
        'official_image',
        'subscription_3_months_price',
        'subscription_6_months_price',
        'subscription_12_months_price',
    ];

    public function getIsDataCompleteAttribute(): bool
    {
        // تحقق من وجود العلاقة User
        if (!$this->user) {
            return false;
        }

        $isOfficialImageComplete = !empty($this->official_image);
        $isContractTypeComplete = !empty($this->contract_type);
        $isBioComplete = !empty($this->bio);
        $isContractSigned = !empty($this->user->contract_signed_at); // هذا من موديل User

        return $isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
