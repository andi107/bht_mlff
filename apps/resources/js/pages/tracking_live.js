import DriftMarker from "leaflet-drift-marker";
import "leaflet-rotatedmarker";
const url = window.burl;
const iconUrl = "/assets/images/leaflet/yellow-car40px.png";
const iconTop = "/assets/images/leaflet/yellow-car-top.png";
const sio = window.sio;
var _curLat = $("input[name=_lat]").val(), _curLon = $("input[name=_lon]").val(),
_device_id = $("input[name=_id]").val(),
myIcon = function name(iUrl) {
    return L.icon({
        iconUrl: iUrl,
        iconSize:     [30, 30],
        iconAnchor:   [15, 33],
        popupAnchor:  [0, -15]
    })
};

var map = L.map('livemap', {
    minZoom: 5,
    fullscreenControl: true,
    attributionControl: false,
}).setView([
    0.33995192349439596, 120.3733680354565
], 7), _lines = [];

var _tileLayer = L.tileLayer(window.mapLayer);
_tileLayer.addTo(map);

var mk = new DriftMarker([_curLat, _curLon], {
    draggable: true,
    title: "Resource location",
    alt: "Resource Location",
    riseOnHover: true,
    icon : myIcon(iconUrl)
  }).addTo(map);

var fgMkr = new L.FeatureGroup();
fgMkr.addLayer(mk);
fgMkr.addTo(map);
map.fitBounds(fgMkr.getBounds());



sio.on('trx_device_data_rcv', function (data) {
    var v = JSON.parse(data);
    console.log(v,v.id,_device_id)
    if (v.id === _device_id) {
        // createPolyLine(map,{ lat:v.lat, lng:v.lon});
        
        var polylines = new L.Polyline([{lat: _curLat, lng: _curLon}, { lat:v.lat, lng:v.lon}], {
            color: 'red',
            weight: 5,
            opacity: 0.5,
            smoothFactor: 1
        });
        polylines.addTo(map);
        console.log(polylines)
        _curLat = v.lat;
        _curLon = v.lon;
        mk.slideTo([v.lat, v.lon], {
            duration: 5000,
            keepAtCenter: false,
        });

        var _movIcon = L.icon({
            iconUrl: iconTop,
            iconSize:     [15, 30],
            iconAnchor:   [7,8],
            // popupAnchor:  [0, -15]
        });
        
        mk.setIcon(_movIcon);
        mk.setRotationAngle(v.direction);
        mk.setRotationOrigin("center center");
        
    }
});