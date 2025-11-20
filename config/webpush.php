<?php

// config/webpush.php
return [

    'vapid' => [
'subject' => env('VAPID_SUBJECT', 'mailto:you@example.com'),
// تأكد أن المفاتيح يتم سحبها من .env
'public_key' => env('VAPID_PUBLIC_KEY'),
'private_key' => env('VAPID_PRIVATE_KEY'),
'pem_file' => env('VAPID_PEM_FILE'),
],

];
// ...