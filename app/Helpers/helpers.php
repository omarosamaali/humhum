<?php

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache;

if (!function_exists('trans_field')) {
    function trans_field($model, $field)
    {
        $locale = app()->getLocale();
        $fieldName = "{$field}_{$locale}";
        return $model->$fieldName ?? $model->{"{$field}_ar"};
    }
}



if (!function_exists('auto_translate')) {
    function auto_translate($text, $from = 'ar', $to = null)
    {
        if (empty($text)) {
            return $text;
        }
        
        $to = $to ?? app()->getLocale();
        
        // لو نفس اللغة، ارجع النص
        if ($from == $to) {
            return $text;
        }
        
        // Cache key
        $cacheKey = "trans_" . md5($text . $from . $to);
        
        return Cache::remember($cacheKey, now()->addDays(30), function() use ($text, $to) {
            try {
                $translator = new GoogleTranslate($to);
                $translator->setSource('ar');
                return $translator->translate($text);
            } catch (\Exception $e) {
                \Log::error('Translation error: ' . $e->getMessage());
                return $text;
            }
        });
    }
}