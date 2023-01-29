<?php
global $apiKey;
include "api-key.php";

$url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Walton+Road,Shah+Taj+Colony&offset=3&radius=1000&language=en&region=pk&key=$apiKey";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
