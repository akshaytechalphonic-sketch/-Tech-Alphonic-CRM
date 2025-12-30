<?php
// save-subscription.php

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

// Save subscription to the database
$stmt = $conn->prepare("INSERT INTO subscriptions (endpoint, p256dh, auth) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $data['endpoint'], $data['keys']['p256dh'], $data['keys']['auth']);
if ($stmt->execute()) {
    echo json_encode(['status' => 'Subscription saved']);
} else {
    echo json_encode(['error' => 'Failed to save subscription']);
}

$stmt->close();
$conn->close();
