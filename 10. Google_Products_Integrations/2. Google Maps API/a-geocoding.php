<?php
global $apiKey;
include "api-key.php";

$postURL = "https://www.googleapis.com/geolocation/v1/geolocate?key=$apiKey";
//$postURL = "https://maps.googleapis.com/maps/api/geocode/json?address=walton+road+lahore&key=$apiKey";

$curlx = curl_init();
curl_setopt($curlx, CURLOPT_URL, $postURL);
curl_setopt($curlx, CURLOPT_HEADER, 0);
curl_setopt($curlx, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlx, CURLOPT_POST, 1);
curl_setopt($curlx, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));

$post_data = [
    "homeMobileCountryCode" => 92
];

curl_setopt($curlx, CURLOPT_POSTFIELDS, json_encode($post_data));
$resp = json_decode(curl_exec($curlx));
curl_close($curlx);

var_dump("<pre>",$resp);exit();