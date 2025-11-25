<?php

namespace App\Services;

use GuzzleHttp\Client;

class OneSignalService
{
    protected $client;
    protected $appId;
    protected $restApiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->appId = env('ONESIGNAL_APP_ID');
        $this->restApiKey = env('ONESIGNAL_REST_API_KEY');
    }

    public function sendNotification($playerId, $message, $title = 'إشعار جديد')
    {
        try {
            $response = $this->client->post('https://onesignal.com/api/v1/notifications', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . $this->restApiKey,
                ],
                'json' => [
                    'app_id' => $this->appId,
                    'include_player_ids' => [$playerId],
                    'headings' => ['ar' => $title],
                    'contents' => ['ar' => $message],
                    'priority' => 10,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('OneSignal Error: ' . $e->getMessage());
            return false;
        }
    }
}
