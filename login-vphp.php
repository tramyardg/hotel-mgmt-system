<?php
session_start();
$fb = new Facebook\Facebook([
    'app_id' => '{app-id}', // Replace {app-id} with your app id
    'app_secret' => '{app-secret}',
    'default_graph_version' => 'v3.2',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$redirectUrl = 'https://' . $_SERVER['SERVER_NAME'] . '/hotel-mgmt-system/fb-callback.php';
$loginUrl = $helper->getLoginUrl($redirectUrl, $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
