<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Install autoload.php
require __DIR__ . '/vendor/autoload.php';

// 2. Read-Only Google Analytics API infos -> You can change the json file with yours
$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/mineral-prism-247414-xxxxxxxxxxx.json');
$client->setScopes(array('https://www.googleapis.com/auth/analytics.readonly'));

// 3. Google Analytics account credentials. 

$analytics = new Google_Service_Analytics($client);

 // $viewId = 'xxxxxxx' is my own websites ID number. You can change it to whatever site you want.

$viewId = 'xxxxxxxx'; 

// 3.2 Real Time live analytics info scraping
$rtResult = $analytics->data_realtime->get(
    'ga:' . $viewId,
    'rt:activeUsers ', // we can find more metrics on https://ga-dev-tools.appspot.com/dimensions-metrics-explorer/
    [
        'dimensions' => 'rt:pagePath,rt:country,rt:city,rt:longitude,rt:latitude' // I want to collect which page is currently active, which country and city viewer is coming from? And I'm gathering a latitude and longtitude coordinations in order to use them in Javascript libraries for graphing purposes...
    ]
);


$arr = [
    'online'=>$rtResult->getTotalResults(),
    'data' => $rtResult->getRows()
];

$json_response = json_encode($arr);

echo $json_response;
echo '<br>';
 print_r($rtResult['rows']);
