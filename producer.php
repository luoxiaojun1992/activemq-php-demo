<?php

require_once __DIR__ . '/vendor/autoload.php';

use Stomp\Client;
use Stomp\StatefulStomp;
use Stomp\Transport\Message;

// make a connection
$stomp = new StatefulStomp(
    new Client('failover://(tcp://localhost:61613)?randomize=false')
);

while (true) {
    // send a message to the queue
    $stomp->send('/queue/test', new Message('test'));
    echo "Sent message with body 'test'\n";
}
