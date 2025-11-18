<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationHelper
{
    public static function translate($text, $targetLang)
    {
        if ($targetLang === 'ar' || empty($text)) {
            return $text;
        }

        $key = "trans_{$targetLang}_" . md5($text);

        return Cache::remember($key, now()->addWeek(), function () use ($text, $targetLang) {
            try {
                $response = Http::timeout(15)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                    ])
                    ->get('https://translate.googleapis.com/translate_a/single', [
                        'client' => 'gtx',
                        'sl' => 'ar',
                        'tl' => $targetLang,
                        'dt' => 't',
                        'q' => $text
                    ]);

                if ($response->successful()) {
                    $result = $response->json();

                    if (isset($result[0][0][0])) {
                        $translated = $result[0][0][0];
                        Log::info("Translation Success", [
                            'original' => $text,
                            'translated' => $translated,
                            'lang' => $targetLang
                        ]);
                        return $translated;
                    }
                }
            } catch (\Exception $e) {
                Log::error("Translation Failed", [
                    'error' => $e->getMessage(),
                    'text' => $text,
                    'lang' => $targetLang
                ]);
            }

            return $text;
        });
    }
}
