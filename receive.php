<?php
require 'vendor/autoload.php';

use Google\Cloud\PubSub\PubSubClient;

function pull_messages($projectId, $subscriptionName)
{
    $pubsub = new PubSubClient([
        'projectId' => $projectId,
    ]);

    $subscription = $pubsub->subscription($subscriptionName);
    $messages = $subscription->pull();

    if (empty($messages)) {
        echo "لا توجد رسائل جديدة حالياً." . PHP_EOL;
        return;
    }

    foreach ($messages as $message) {
        printf('تم استلام رسالة: %s' . PHP_EOL, $message->data());
        $subscription->acknowledge($message);
    }
}

$myProjectId = 'omdachina25';
$mySubscription = 'my-sub';

pull_messages($myProjectId, $mySubscription);
