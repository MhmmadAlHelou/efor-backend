<?php

require 'C:\xampp\htdocs\efor\vendor\autoload.php';
// require 'vendor/autoload.php';
use Google\Client;

function getAccessToken() {
   $serviceAccountPath = 'C:\xampp\htdocs\efor\notification\serviceAccountPath.json';
   // $serviceAccountPath = 'notification\serviceAccountPath.json';
   $client = new Client();
   $client->setAuthConfig($serviceAccountPath);
   $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
   $client->useApplicationDefaultCredentials();
   $token = $client->fetchAccessTokenWithAssertion();
   echo $token['access_token'];
   return $token['access_token'];
}
?>