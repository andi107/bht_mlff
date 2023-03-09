import DriftMarker from "leaflet-drift-marker";
const url = window.burl;
const iconUrl = "/assets/images/leaflet/yellow-car40px.png";
const iconTop = "/assets/images/leaflet/yellow-car-top.png";
const sio = window.sio;
var _curLat = $("input[name=_lat]").val(), _curLon = $("input[name=_lon]").val(),
_device_id = $("input[name=_id]").val(),
myIcon = function name(iUrl) {
    return L.icon({
        iconUrl: iUrl,
        // shadowUrl: shadowUrl,
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
], 7), myFGMarker = new L.FeatureGroup(),_lines = [], polylines;

var _tileLayer = L.tileLayer(window.mapLayer);
_tileLayer.addTo(map);

// function _newMarker(latLng,customIcon = null,customToolTip = null, customPopUp = null) {
//     var mkr;
//     if (customIcon) {
//         mkr = L.marker(
//             latLng,
//             customIcon //// { icon: greenIcon }
//         );
//     }else{
//         mkr = L.marker(latLng);
//     }
//     if (customPopUp) {
//         var popup = L.popup().setContent(customPopUp);
//         mkr.bindPopup(popup).openPopup();
//     }
//     if (customToolTip) {
//         var tooltip = L.tooltip()
//         .setContent(customToolTip)
//         mkr.bindTooltip(tooltip).openTooltip();
//     }

//     mkr.addTo(map)
//     return mkr;
// }

// var marker = _newMarker(
//     // { lat: -6.1966477248620455, lng: 106.67314981137596 }, {
//         {lat: _curLat, lng: _curLon}, {
//         icon : L.icon({
//             iconUrl: iconUrl,
//             // shadowUrl: shadowUrl,
//             iconSize:     [30, 30],
//             iconAnchor:   [15, 33],
//             popupAnchor:  [0, -15]
//         })
//     }, null,null
// );



// const mk = new DriftMarker([-6.174995875435529, 106.8269879988658]);

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
        mk.slideTo([v.lat, v.lon], {
            duration: 5000,
            keepAtCenter: false,
        });
        
        mk.setIcon(myIcon(iconUrl));
        
        console.log(v.id,v.lat, v.lon)
        console.log(mk)
    }
});