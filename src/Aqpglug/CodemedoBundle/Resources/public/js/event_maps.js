function initialize(place, lat, lng, zoom) {
    var _zoom = (zoom != null) ? zoom: 15;
    $(place).gmap3(
    "autoFit", {
        action: 'init',
        options:{
            center:[lat, lng],
            zoom: _zoom
        }
    },{
        action:'addMarker',
        latLng:[lat, lng]
    }
);
}