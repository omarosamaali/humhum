<?php

namespace App\Services;

use Google\Client;
use Illuminate\Support\Facades\Http;

class FCMService
{
    protected $credentialsPath;

    public function __construct()
    {
        // مسار ملف الـ JSON الذي ظهر في صورتك
        $this->credentialsPath = storage_path('app/firebase/firebase-credentials.json');
    }

    private function getAccessToken()
    {
        $client = new Client();
        $client->setAuthConfig($this->credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->fetchAccessTokenWithAssertion();
        $token = $client->getAccessToken();
        return $token['access_token'];
    }

    public function sendNotification($deviceToken, $title, $body)
    {
        $url = 'https://fcm.googleapis.com/v1/projects/omdachina25/messages:send';
        $accessToken = $this->getAccessToken();
        $message = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
            ],
        ];
        $response = Http::withToken($accessToken)->post($url, $message);
        return $response->json();
    }

    public function sendToMultiple($tokens, $title, $body)
    {
        $url = 'https://fcm.googleapis.com/v1/projects/omdachina25/messages:send';
        $accessToken = $this->getAccessToken();
        $responses = [];

        foreach ($tokens as $token) {
            $message = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'webpush' => [
                        'fcm_options' => [
                            'link' => 'https://humhum.food/' // الرابط الذي يفتح عند الضغط
                        ]
                    ]
                ],
            ];

            $responses[] = Http::withToken($accessToken)->post($url, $message)->json();
        }

        return $responses;
    }
}
