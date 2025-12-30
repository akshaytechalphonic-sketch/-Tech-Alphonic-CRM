<?php
require 'vendor/autoload.php'; // Ensure you have the web-push library

use Minishlink\WebPush\VAPID;

$vapid = VAPID::createVAPIDKeys(); // This will generate a public and private key

echo "Public Key: " . $vapid['publicKey'] . PHP_EOL;
echo "Private Key: " . $vapid['privateKey'] . PHP_EOL;
