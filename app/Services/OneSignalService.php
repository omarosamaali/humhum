<?php

namespace App\Services;

use App\Models\PushSubscription;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OneSignalService
{
    protected $appId;
    protected $restApiKey;

    public function __construct()
    {
        $this->appId = config('services.onesignal.app_id');
        $this->restApiKey = config('services.onesignal.rest_api_key');
    }

    /**
     * إرسال إشعار لمستخدم معين
     */
    public function sendToUser($userId, $title, $message, $data = [])
    {
        $playerIds = PushSubscription::where('user_id', $userId)
            ->pluck('player_id')
            ->toArray();

        return $this->sendToPlayers($playerIds, $title, $message, $data);
    }

    /**
     * إرسال إشعار لعائلة معينة
     */
    public function sendToFamily($familyId, $title, $message, $data = [])
    {
        $playerIds = PushSubscription::where('family_id', $familyId)
            ->pluck('player_id')
            ->toArray();

        return $this->sendToPlayers($playerIds, $title, $message, $data);
    }

    /**
     * إرسال إشعار للطباخ
     */
    public function sendToCook($cookId, $title, $message, $data = [])
    {
        $playerIds = PushSubscription::where('cook_id', $cookId)
            ->pluck('player_id')
            ->toArray();

        return $this->sendToPlayers($playerIds, $title, $message, $data);
    }

    /**
     * إرسال لـ Player IDs محددة
     */
    public function sendToPlayers(array $playerIds, $title, $message, $data = [])
    {
        if (empty($playerIds)) {
            Log::warning('OneSignal: No player IDs found');
            return ['success' => false, 'message' => 'No players found'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $this->restApiKey,
                'Content-Type' => 'application/json',
            ])->post('https://onesignal.com/api/v1/notifications', [
                'app_id' => $this->appId,
                'include_player_ids' => $playerIds,
                'headings' => ['en' => $title, 'ar' => $title],
                'contents' => ['en' => $message, 'ar' => $message],
                'data' => $data,
                'android_channel_id' => 'humhum_notifications',
            ]);

            $result = $response->json();

            if ($response->successful()) {
                Log::info('OneSignal notification sent', ['response' => $result]);
                return ['success' => true, 'data' => $result];
            } else {
                Log::error('OneSignal error', ['response' => $result]);
                return ['success' => false, 'message' => $result['errors'] ?? 'Unknown error'];
            }
        } catch (\Exception $e) {
            Log::error('OneSignal exception', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * إرسال لكل المستخدمين
     */
    public function sendToAll($title, $message, $data = [])
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $this->restApiKey,
                'Content-Type' => 'application/json',
            ])->post('https://onesignal.com/api/v1/notifications', [
                'app_id' => $this->appId,
                'included_segments' => ['All'],
                'headings' => ['en' => $title, 'ar' => $title],
                'contents' => ['en' => $message, 'ar' => $message],
                'data' => $data,
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('OneSignal sendToAll error', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
