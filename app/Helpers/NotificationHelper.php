<?php

namespace App\Helpers;

use App\Services\FirebaseHttpService;

class NotificationHelper
{

    static function sendNotification($value, string $title, string $body)
    {
        try {
            $firebase = new FirebaseHttpService();
            $firebase->sendNotification($value, $title, $body, false);

            return response()->json(['status' => true]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
