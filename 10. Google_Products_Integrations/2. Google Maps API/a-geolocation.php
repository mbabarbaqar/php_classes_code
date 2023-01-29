<?php
global $apiKey;
include "api-key.php";

// address
// key
// bounds
// language
// region
// components
//$geoCodingAPI = "https://www.googleapis.com/geolocation/v1/geolocate?field=locationAreaCode&address=lahore+punjab+pakistan&key=$apiKey";
$geoCodingAPI = "https://www.googleapis.com/geolocation/v1/geolocate?place_id=EiRXYWx0b24gUm9hZCwgU2hhaCBUYWogQ29sb255LCBMYWhvcmUiLiosChQKEgm9dOiQ0QUZOREU87GwjbFQtRIUChIJGZLJQMUFGTkRE2RynY4jMm8&key=$apiKey";

echo $geoCodingAPI;
echo "<br />";


$postURL = $geoCodingAPI;

$curlx = curl_init();
curl_setopt($curlx, CURLOPT_URL, $postURL);
curl_setopt($curlx, CURLOPT_HEADER, 0);
curl_setopt($curlx, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlx, CURLOPT_POST, 1);
curl_setopt($curlx, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));

$post_data = [];

curl_setopt($curlx, CURLOPT_POSTFIELDS, $post_data);
$resp = json_decode(curl_exec($curlx));
curl_close($curlx);

var_dump("<pre>",$resp);exit();


