<?php
$base_url = "https://auth-dev-eoffice.kemkes.go.id/";
$client_id = "96e00575-a845-4949-82cb-4ed6472a57cf";
$redirect_uri = "http://test-sso-kemkes.local/sso/callback.php";
$response_type = "code";
$scope = "openid";
$state = "login-portal";

$url = "$base_url/oauth/authorize?"
    . "client_id=" . urlencode($client_id)
    . "&redirect_uri=" . urlencode($redirect_uri)
    . "&response_type=" . urlencode($response_type)
    . "&scope=" . urlencode($scope)
    . "&state=" . urlencode($state);

header("Location: $url");
?>