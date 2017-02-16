<?php

require_once 'vendor/autoload.php';
require_once 'conf.php';

use League\OAuth2\Client\Provider\Google as GoogleProvider;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Storage\Connection\Rest;
use Google\Cloud\RequestWrapper;

session_start();

$provider = new GoogleProvider([
    'clientId'     => CLIENT_ID,
    'clientSecret' => CLIENT_SECRET,
    'redirectUri'  => REDIRECT_URI
]);

$authUrl = $provider->getAuthorizationUrl([
   'scope' => [StorageClient::FULL_CONTROL_SCOPE]
]);

if (!empty($_GET['code']) && !isset($_SESSION['access_token'])) {
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);
    $accessToken = $token->getToken();
    $_SESSION['access_token'] = $accessToken;
    $redirect = 'http://' . $_SERVER['HTTP_HOST'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if ($_SESSION['access_token']) {
   $restConnection = new Rest([
     'accessToken' => $_SESSION['access_token'],
   ]);

   $requestWrapper = new RequestWrapper();
	
   $storage = new StorageClient([
     'projectId' => DEFAULT_PROJECT,
     'accessToken' => $_SESSION['access_token']
   ]);
}
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

