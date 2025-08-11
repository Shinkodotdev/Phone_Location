<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Location Tracker</title>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
    <style>
        #map { width: 100%; height: 500px; }
    </style>
</head>
<body>

<h2>Your Current Location on Mapbox</h2>
<div id="map"></div>
<p id="status"></p>

<!-- Inlcude here the script of your map api -->
<!-- <script src="API"></script> -->
<script>
    // include here the accesTOken from your API MAP
    // mapboxgl.accessToken = '';

    const status = document.getElementById('status');

    // Function to display Mapbox map with user location
    function displayMap(latitude, longitude) {
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [longitude, latitude],
            zoom: 14
        });

        // Add a marker for the user's location
        new mapboxgl.Marker()
            .setLngLat([longitude, latitude])
            .addTo(map);
    }

    // Check if Geolocation is supported
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                
                status.textContent = "Location access granted.";
                
                // Display map with user's location
                displayMap(latitude, longitude);
            },
            (error) => {
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        status.textContent = "Permission denied. Please allow location access.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        status.textContent = "Location information is unavailable.";
                        break;
                    case error.TIMEOUT:
                        status.textContent = "The request to get your location timed out.";
                        break;
                    default:
                        status.textContent = "An unknown error occurred.";
                        break;
                }
            }
        );
    } else {
        status.textContent = "Geolocation is not supported by your browser.";
    }
</script>

</body>
</html>
