<?php
// send-bulk-notifications.php

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

// MySQLi connection
$servername = "localhost";
$username = "u911317397_leads_manage";
$password = "U911317397_leads_manage";
$dbname = "u911317397_leads_manage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Fetch all subscriptions from the database
$sql = "SELECT * FROM subscriptions";
$result = $conn->query($sql);

require 'vendor/autoload.php'; // Install web-push library with Composer

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// Prepare notification
$notification = [
    'title' => 'New Notification',
    'body' => $data['message'],
    'icon' => 'icon.png',
];

// Push setup
$webPush = new WebPush([
    'VAPID' => [
        'subject' => "mailto: <harsh.techalphonic@gmail.com>",
        'publicKey' => 'BOzQaq3J-Z8cdMmAZQNU3CoOSoSmRDNdihmu918YnOOWfGZ3AdRhN-draa7iGHmO5CkpksBQ7GKYbgnaFMuoFQ8',
        'privateKey' => 'Fzg42HnsZLyP5DZEK09HF2M4x3uAxjJjccKMZuG_PR8',
    ],
]);

if ($result->num_rows > 0) {
    // Output each subscription and send notifications
    while($row = $result->fetch_assoc()) {
        // print_r($row).PHP_EOL;
        $subscription = Subscription::create([
            'endpoint' => $row['endpoint'],
            'publicKey' => $row['p256dh'],
            'authToken' => $row['auth'],
            'contentEncoding' => 'aesgcm'
        ]);

        $webPush->queueNotification(
            $subscription,
            json_encode($notification)
        );
    }

    $webPush->flush();

    echo json_encode(['status' => 'Bulk notification sent']);
} else {
    echo json_encode(['error' => 'No subscriptions found']);
}

$conn->close();
