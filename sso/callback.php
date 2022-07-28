<?php
$base_url = "https://auth-dev-eoffice.kemkes.go.id/";
$client_id = "96e00575-a845-4949-82cb-4ed6472a57cf";
$client_secret = "KTGOS2UaZFuEaYcoVlk7pQDG9gKHXF48WnN3ini5";
$redirect_uri = "http://test-sso-kemkes.local/sso/callback.php";

$state = $_GET['state'];

$curl = curl_init();

$post = [
    'grant_type' => 'authorization_code',
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri' => $redirect_uri,
    'code' => $_GET['code'],
];

curl_setopt_array($curl, array(
CURLOPT_URL => $base_url . "/oauth/token",
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => $post,
CURLOPT_RETURNTRANSFER => true,
));

$response_raw = curl_exec($curl);
$response = json_decode($response_raw, true);

curl_close($curl);

if (!isset($response['access_token'])) {
    if (isset($response['message'])) {
        die("Login failed: ".$response['message']);
    } else {
        die("Login failed: ". $base_url . " -- ".$response_raw);
    }
}
$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => $base_url . "/oauth/usertoken",
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer ' . $response['access_token'],
),
CURLOPT_RETURNTRANSFER => true,
));

$response = json_decode(curl_exec($curl), true);
if (!$response) {
    return "Error";
}
if (!isset($response['success']) || !$response['success']) {
    return "Failed";
}

curl_close($curl);
echo "Selamat datang ".$response['username']; 
?>