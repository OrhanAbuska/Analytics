<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Install autoload.php
require __DIR__ . '/vendor/autoload.php';

// 2. Read-Only Google Analytics API infos
$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/mineral-prism-247414-xxxxxxxxxxx.json');
$client->setScopes(array('https://www.googleapis.com/auth/analytics.readonly'));

// 3. Google Analytics account credentials.
$analytics = new Google_Service_Analytics($client);

$viewId = 'xxxxxxxxx';

// 3.1 We are gathering the site information for the past 30 days. But we can choose specific days and months
$generalResult = $analytics->data_ga->get( // -> getting 2nd clients analytics
    'ga:' . $viewId,
    '30daysAgo', 
    'today',
    'ga:sessions,ga:pageviews', // we can find more metrics on https://ga-dev-tools.appspot.com/dimensions-metrics-explorer/
    [
        'dimensions' => 'ga:date,ga:keyword'
    ]
);

echo '<pre>';
print_r($generalResult['rows']);

