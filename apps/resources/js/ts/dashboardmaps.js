var map = L.map('dashboardmap', {
    minZoom: 5,
    // maxZoom: 15
}).setView([
    0.33995192349439596, 120.3733680354565
], 5), markers = {};

var _tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    attribution: '',
});
_tileLayer.addTo(map);

_newMarker(
    { lat: -6.168515731071985, lng: 106.82049262267968 },
    {icon : L.icon({
        iconUrl: window.location.origin + '/assets/images/leaflet/marker-icon.png',
        shadowUrl: window.location.origin + '/assets/images/leaflet/marker-shadow.png',
    
        // iconSize:     [10, 95], // size of the icon
        // shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [17, 37], // point of the icon which will correspond to marker's location
        shadowAnchor: [17, 37],  // the same for the shadow
        popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor
    })},
    'Hello world!<br />This is a nice tooltip.',
    `HELOWORLD IM MARKER`);

function _newMarker(latLng,customIcon = null,customToolTip = null, customPopUp = null) {
    // var myFGMarker = new L.FeatureGroup();
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
    // marker.on('click', function(e) {
    //     console.log(e);
    // });
    // myFGMarker.addLayer(marker);
    // myFGMarker.addTo(map);
}