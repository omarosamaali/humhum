<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class MessageUser extends Model
{
    protected $table = 'message_users';
    protected $fillable = ['user_id', 'title', 'content', 'file_path', 'status', 'type'];

    public function replies()
    {
        return $this->morphMany(MessageReply::class, 'messageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ترجمة العنوان
    public function getTitleAttribute($value)
    {
        return $this->translateField($value, 'title');
    }

    // ترجمة المحتوى
    public function getContentAttribute($value)
    {
        return $this->translateField($value, 'content');
    }

    // دالة مساعدة للترجمة مع Cache
    protected function translateField($value, $fieldName)
    {
        $locale = app()->getLocale();

        // لو عربي، ارجع النص كما هو
        if ($locale == 'ar') {
            return $value;
        }

        // استخدم Cache عشان السرعة
        $cacheKey = "message_{$this->id}_{$fieldName}_{$locale}";

        return Cache::remember($cacheKey, now()->addDays(30), function () use ($value) {
            if (!function_exists('auto_translate')) {
                return $value;
            }

            try {
                return auto_translate($value);
            } catch (\Exception $e) {
                \Log::error("Translation failed for message {$this->id}: " . $e->getMessage());
                return $value;
            }
        });
    }
}
