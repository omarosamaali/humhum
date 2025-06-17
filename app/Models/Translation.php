<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_code',
        'translatable_id',
        'translatable_type',
        'title',
        'description',
        'ingredients',
        'instructions',
        'step_text',
        'content',
        'name'
    ];

    /**
     * العلاقة العكسية مع النماذج القابلة للترجمة
     */
    public function translatable()
    {
        return $this->morphTo();
    }

    /**
     * العلاقة مع نموذج اللغة
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_code', 'code');
    }

    /**
     * نطاق للبحث بلغة معينة
     */
    public function scopeForLanguage($query, $languageCode)
    {
        return $query->where('language_code', $languageCode);
    }

    /**
     * نطاق للبحث بنوع نموذج معين
     */
    public function scopeForModel($query, $modelType)
    {
        return $query->where('translatable_type', $modelType);
    }
}
