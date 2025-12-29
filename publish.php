<?php
// 1. Include the Composer Autoloader
require 'vendor/autoload.php';

use Google\Cloud\PubSub\MessageBuilder;
use Google\Cloud\PubSub\PubSubClient;

function publish_message($projectId, $topicName, $message)
{
    $pubsub = new PubSubClient([
        'projectId' => $projectId,
    ]);
    $topic = $pubsub->topic($topicName);
    $topic->publish((new MessageBuilder)->setData($message)->build());
    echo 'Message published' . PHP_EOL;
}

// 2. EXECUTION: Call the function with your specific details
$myProjectId = 'omdachina25';
$myTopic = 'my-topic';
$myMessage = 'Hello from PHP!';

publish_message($myProjectId, $myTopic, $myMessage);
