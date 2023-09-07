<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Simple Map Sample</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
</head>
  
<body>
    <div id="mapid" style="height: 500px;"></div>
    <script>
        var map = L.map('mapid', {
            center: [35.66572, 139.73100],
            zoom: 17,
        });
        var tileLayer = L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
	    attribution: "<a href='https://developers.google.com/maps/documentation' target='_blank'>Google Map</a>"
        });
        tileLayer.addTo(map);

        L.marker([35.66572, 139.73100]).addTo(map); 
    </script>
</body>
</html>