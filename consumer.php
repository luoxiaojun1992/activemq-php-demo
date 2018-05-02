<?php

require_once __DIR__ . '/vendor/autoload.php';

use Stomp\Client;
use Stomp\StatefulStomp;

// make a connection
$stomp = new StatefulStomp(
    new Client('failover://(tcp://localhost:61613)?randomize=false')
);

// subscribe to the queue
$stomp->subscribe('/queue/test', null, 'client-individual');

while (true) {
    // receive a message from the queue
    $msg = $stomp->read();
    // do what you want with the message
    if ($msg != null) {
        echo "Received message with body '$msg->body'\n";
        // mark the message as received in the queue
        $stomp->ack($msg);
    } else {
        echo "Failed to receive a message\n";
    }
}

$stomp->unsubscribe();
