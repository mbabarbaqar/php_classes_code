<?php
global $apiKey;
include "api-key.php";

$suggestionsResult = [];
$city = "";
$state = "";
$country = "";
$postalCode = "";
$fullAddress = "";

// Get location data to populate the form fields
if (isset($_POST['autofill'])){
    $placeId = $_POST['autofill_address'] ?? "";
    # key,address,bounds,language,region,components
    $geoCodingAPI = "https://maps.googleapis.com/maps/api/geocode/json?place_id=$placeId&key=$apiKey";

    $curlx = curl_init();
    curl_setopt($curlx, CURLOPT_URL, $geoCodingAPI);
    curl_setopt($curlx, CURLOPT_HEADER, 0);
    curl_setopt($curlx, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlx, CURLOPT_POST, 1);
    curl_setopt($curlx, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $post_data = [];

    curl_setopt($curlx, CURLOPT_POSTFIELDS, $post_data);
    $resp = json_decode(curl_exec($curlx), true);
    curl_close($curlx);

    if (isset($resp['results'])) {
        $firstResult = $resp['results'][0];
        $addressComponents = $firstResult['address_components'];
        $fullAddress = $firstResult['formatted_address'];

        foreach ($addressComponents as $addressComponent){
            $types = $addressComponent['types'];
            if (in_array("country", $types)) {
                $country = $addressComponent['long_name'];
            }

            if (in_array("administrative_area_level_1", $types)) {
                $state = $addressComponent['long_name'];
            }

            if (in_array("administrative_area_level_2", $types)) {
                $city = $addressComponent['long_name'];
            }

            if (in_array("postal_code", $types)) {
                $postalCode = $addressComponent['long_name'];
            }
        }

    }

}

// Find location suggestions
if (isset($_POST['suggestions'])) {

    $searchString = str_replace(" ", "+", $_POST["search"]) ?? null;

    if (!empty($searchString)) {
        $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=$searchString&offset=3&radius=1000&language=en&region=pk&key=$apiKey";

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

        $suggestionData = json_decode($response, true);

        if ($suggestionData["status"] == "OK") {
            $suggestionsResult = $suggestionData["predictions"];
        }

    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Botstrap CRUD</title>
    <link href="../../assets/plugins/bootstrap.5.1/bootstrap.min.css" rel="stylesheet">
    <script src="../../assets/plugins/bootstrap.5.1/bootstrap.min.js"></script>

</head>
<body>
<div class="row">
    <div class="col-md-8" style="margin: 0 auto;">
        <h1>Registration Form</h1>
    </div>
    <div class="col-md-8" style="margin: 0 auto;">
        <form id="testForm" action="" method="post">

            <div class="mb-3">
                <input type="text" class="form-control" name="search" placeholder="Search.." id="search" aria-describedby="searchHelp">
                <div id="searchHelp" class="form-text">Search Address or type any word here.</div>
            </div>

            <div class="mb-3">
                <ul class="list-group">
                    <?php

                    foreach ($suggestionsResult as $suggestion){
                    ?>

                        <li class="list-group-item">
                            <input class="form-check-input me-1" name="autofill_address" type="radio" value="<?php echo $suggestion['place_id'] ?>" aria-label="...">
                            <?php echo $suggestion['description'] ?>
                        </li>

                    <?php
                    }
                    ?>

                </ul>
            </div>

            <button type="submit" name="suggestions" class="btn btn-primary btn-sm">Get Suggestions</button>
            <button type="submit" name="autofill" class="btn btn-primary btn-sm">Autofill Address</button>
        </form>

        <br /><hr /><br />

        <form id="testForm" action="" method="post">

            <div class="mb-3">
                <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" id="city" aria-describedby="cityHelp">
                <div id="cityHelp" class="form-text">City name.</div>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="state"  value="<?php echo $state; ?>" id="state" aria-describedby="stateHelp">
                <div id="stateHelp" class="form-text">State name.</div>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="country"  value="<?php echo $country; ?>" id="country" aria-describedby="countryHelp">
                <div id="countryHelp" class="form-text">Country name.</div>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" name="zipcode"  value="<?php echo $postalCode; ?>" id="zipcode" aria-describedby="zipcodeHelp">
                <div id="zipcodeHelp" class="form-text">Zipcode.</div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea name="address" class="form-control" placeholder="Your address.." id="address" style="height: 100px"><?php echo $fullAddress; ?></textarea>
                    <label for="address">Address</label>
                </div>
            </div>

            <button type="submit" name="add_form" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</body>
</html>

