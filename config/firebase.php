<?php

return [

    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS'), // JSON file path for service key
        // 'auto_discovery' => false,
    ],

    'database' => [
        'url' => env('FIREBASE_DATABASE_URL'), // Firebase Realtime Database Link if you are using it
    ],

    'project_id' => env('PROJECT_ID'),

];
