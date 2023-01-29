<?php
global $apiKey;
include "api-key.php";

// address
// key
// bounds
// language
// region
// components
//$geoCodingAPI = "https://maps.googleapis.com/maps/api/geocode/json?region=pk&address=walton&places=true&key=$apiKey";
$geoCodingAPI = "https://maps.googleapis.com/maps/api/geocode/json?place_id=EiRXYWx0b24gUm9hZCwgU2hhaCBUYWogQ29sb255LCBMYWhvcmUiLiosChQKEgm9dOiQ0QUZOREU87GwjbFQtRIUChIJGZLJQMUFGTkRE2RynY4jMm8&types=postal_code&key=$apiKey";

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


if ($resp->status == "OK") {
    $results = $resp->results ?? [];

    foreach ($results as $result){
        $address_components = $result->address_components ?? [];
        $formatted_address = $result->formatted_address ?? "";
        $geometry = $result->geometry ?? [];
        $location = $geometry->location ?? [];
        $place_id = $result->place_id ?? "";

        //var_dump("<pre>",$geometry);exit();

        echo "<br />";
        echo "<div><strong>Place ID: </strong>$place_id</div>";

        echo "<br />";
        echo "<div><strong>Formated Address: </strong>$formatted_address</div>";

        echo "<br />";
        echo "<div><strong><u>Address Components: </u></strong></div>";
                foreach ($address_components as $address_component){

                echo "<div> <strong>".$address_component->types[0].": </strong>";
                    echo "<span>". ($address_component->long_name ?? "N/A") ." </span> ";
                    echo "<span>". ($address_component->short_name ?? "N/A") ." </span> ";
                echo "<div>";
            }
        echo "</div>";

        echo "<br />";
        echo "<div><strong><u>Geomatry Location Components: </u></strong></div>";
        echo "<div> <strong>Latitude: </strong>".$location->lat."<div>";
        echo "<div> <strong>Longitude: </strong>".$location->lng."<div>";

    }
}