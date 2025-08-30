<?php

namespace App\Services;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;

class FirebaseHttpService
{
    protected $client;
    protected $serviceAccountPath;

    public function __construct()
    {
        $this->serviceAccountPath = config('firebase.credentials.file');
        $this->client = new Client();
    }

    function getAccessToken()
    {
        // Read service credentials from a JSON file
        $serviceAccount = json_decode(file_get_contents(config('firebase.credentials.file')), true);

        // Preparing the data to be encrypted
        $now = time();
        $token = [
            'iss' => $serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $now + 3600, // expire data after one hour
            'iat' => $now
        ];

        // Encrypt data using private key
        $jwt = JWT::encode($token, $serviceAccount['private_key'], 'RS256');

        // Header setting
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        // Preparing data sent with the request
        $data = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ];

        // Submit a request to get a token
        $client = new Client();
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'headers' => $headers,
            'form_params' => $data
        ]);

        // Read the request response to obtain an Access Token
        $tokenData = json_decode($response->getBody()->getContents(), true);

        return $tokenData['access_token'];
    }

    /**
     * Send notification via Firebase HTTP v1
     *
     * @param string $token
     * @param string $title
     * @param string $body
     * @param boolean $is_topic
     * @return void
     */
    public function sendNotification($value, $title, $body, $is_topic = false)
    {
        $accessToken = $this->getAccessToken();

        $url = 'https://fcm.googleapis.com/v1/projects/' . config('firebase.project_id') . '/messages:send';

        $key = $is_topic ? 'topic' : 'token';

        $payload = [
            'message' => [
                $key => $value,
                // 'token' => $token,
                // 'topic' => 'my_topic',
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
            ],
        ];

        $this->client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload,
        ]);
    }
}
