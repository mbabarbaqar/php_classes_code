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

            // Create markers.
            for (let i = 0; i < locations.length; i++) {
                console.log("Marker - " + i);
                const marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
                    map: map,
                });
            }

        }

        const locations = [
            { lat: 31.5686912, lng: 74.3604224 },
            { lat: 31.4237883, lng: 72.9492145 },
            { lat: 31.7110314, lng: 73.9759677 }
        ];

        window.initMap = initMap;
    </script>

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