<?php

// API endpoint and credentials
$token_url = 'https://api.prokerala.com/token';
$client_id = '3647f185-6994-46d9-a3c0-97e4348150be';
$client_secret = '2MGCu2BeiOGMP9NXRS9wV7RBOccGHjf5TdQFhPZz';

// Prepare POST data
$data = [
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'grant_type' => 'client_credentials', // You might need to adjust this according to the API documentation
];

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// Execute cURL and get the response
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Decode the response to get the token
$response_data = json_decode($response, true);

// Check if the token was returned
if (isset($response_data['access_token'])) {
    $access_token = $response_data['access_token'];
    echo "Access Token: " . $access_token;
} else {
    echo "Error fetching access token.";
}
?>
