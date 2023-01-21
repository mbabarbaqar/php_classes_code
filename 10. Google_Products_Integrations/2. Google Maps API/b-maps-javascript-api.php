<?php
global $apiKey;
include "api-key.php";
?>

<html>
<head>
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 31.5686912, lng: 74.3604224 },
                zoom: 8,
            });

        }

        window.initMap = initMap;
    </script>

    <script type="module" src="./index.js"></script>

    <style>
        #map {
            height: 100%;
        }
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<!--Map Container-->
<div style="width: 100%; height: 400px;" id="map"></div>

<!--
  The `defer` attribute causes the callback to execute after the full HTML
  document has been parsed. For non-blocking uses, avoiding race conditions,
  and consistent behavior across browsers, consider loading using Promises
  with https://www.npmjs.com/package/@googlemaps/js-api-loader.
  -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&callback=initMap&v=weekly"
    defer
></script>
</body>
</html>