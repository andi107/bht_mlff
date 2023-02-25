const url = location.protocol + '//' + window.location.host;
const iconUrl = url + '/assets/images/leaflet/marker-icon.png';
const shadowUrl = url + '/assets/images/leaflet/marker-shadow.png';

var map = L.map('statusmap', {
    minZoom: 5,
    fullscreenControl: true,
    attributionControl: false,
}).setView([
    0.33995192349439596, 120.3733680354565
], 5), markers = {}, myFGMarker = new L.FeatureGroup(),_lines = [], polylines;

var _tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png');
_tileLayer.addTo(map);

function _newMarker(latLng,customIcon = null,customToolTip = null, customPopUp = null) {
    var mkr;
    if (customIcon) {
        mkr = L.marker(
            latLng,
            customIcon //// { icon: greenIcon }
        );
    }else{
        mkr = L.marker(latLng);
    }
    if (customPopUp) {
        var popup = L.popup().setContent(customPopUp);
        mkr.bindPopup(popup).openPopup();
    }
    if (customToolTip) {
        var tooltip = L.tooltip()
        .setContent(customToolTip)
        mkr.bindTooltip(tooltip).openTooltip();
    }

    mkr.addTo(map)
    return mkr;
}

var marker = _newMarker(
    { lat: -6.1966477248620455, lng: 106.67314981137596 }, {
        icon : L.icon({
            iconUrl: iconUrl,
            shadowUrl: shadowUrl,
            iconAnchor:   [17, 37],
            shadowAnchor: [17, 37],
            popupAnchor:  [0, -15]
        })
    }, null,null
);

var myFGMarker = new L.FeatureGroup();
myFGMarker.addLayer(marker);
myFGMarker.addTo(map);
map.fitBounds(myFGMarker.getBounds());