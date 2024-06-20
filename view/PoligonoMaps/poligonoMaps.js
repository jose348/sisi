//var myPolygon;
function initialize() {
    // Map Center
    var myLatLng = new google.maps.LatLng(-6.7715598028741795, -79.84316541251286);
    // General Options
    var mapOptions = {
        zoom: 12,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.RoadMap
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    // Polygon Coordinates
    var triangleCoords = [
        new google.maps.LatLng(-6.7715598028741795, -79.84316541251286),
        new google.maps.LatLng(-6.7715598028741795, -79.84316541251286),
        new google.maps.LatLng(-6.7715598028741795, -79.84316541251286)
    ];
    // Styling & Controls
    myPolygon = new google.maps.Polygon({
        paths: triangleCoords,
        draggable: true, // turn off if it gets annoying
        editable: true,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35
    });

    myPolygon.setMap(map);
    //google.maps.event.addListener(myPolygon, "dragend", getPolygonCoords);
    google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);
    //google.maps.event.addListener(myPolygon.getPath(), "remove_at", getPolygonCoords);
    google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);
}

//Display Coordinates below map
function getPolygonCoords() {
    var len = myPolygon.getPath().getLength();
    var htmlStr = "";
    for (var i = 0; i < len; i++) {
        htmlStr += (i + 1) + "° Coordenada [Latitud - Longitud(" + myPolygon.getPath().getAt(i).toUrlValue(5) + ")];";

        //Use this one instead if you want to get rid of the wrap > new google.maps.LatLng(),
        //htmlStr += "" + myPolygon.getPath().getAt(i).toUrlValue(5);
    }
    document.getElementById('info').innerHTML = htmlStr;
}

function copyToClipboard(text) {
    window.prompt("Copia y Pega", text);
}