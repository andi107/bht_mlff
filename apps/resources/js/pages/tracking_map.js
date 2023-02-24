const url = location.protocol + '//' + window.location.host;
const iconUrl = url + '/assets/images/leaflet/marker-icon.png';
const shadowUrl = url + '/assets/images/leaflet/marker-shadow.png';
// /tracking/detail/js/map?did=860371050882459&from=2023-02-10%2016:50:04&to=2023-02-22%2005:52:21
// https://github.com/ewoken/Leaflet.MovingMarker
var device_id,_dtfrom,_dtto,
map = L.map('trackingmap', {
    minZoom: 5,
    fullscreenControl: true,
}).setView([
    0.33995192349439596, 120.3733680354565
], 5), markers = {}, myFGMarker = new L.FeatureGroup(),_lines = [], polylines;

var _tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png');
_tileLayer.addTo(map);

var _isLatLng = [
    { lat: -6.201655766896261, lng: 106.6654244273562 },
    { lat: -6.168515731071985, lng: 106.82049262267968 },
    { lat: -6.171235758440484, lng: 106.82248281407831},
    { lat: -6.171514825537222, lng: 106.82467732891283},
    { lat: -6.171489455807232, lng: 106.82661666760377},
    { lat: -6.171489455807232, lng: 106.8279691011646},
    { lat: -6.17171778333345, lng: 106.82921946426798},
    { lat: -6.174609923481205, lng: 106.8300615455417},
    { lat: -6.177933328183428, lng: 106.83016361599911},
    { lat: -6.178948104087213, lng: 106.83166915524605},
];
    

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
    // marker.on('click', function(e) {
    //     console.log(e);
    // });
    // myFGMarker.addLayer(marker);
    // myFGMarker.addTo(map);
}


// var marker = L.marker(_isLatLng);

function createPolyLine(markersPoint) {
    // var pointList = [_isLatLng[0], _isLatLng[1]];
    polylines = new L.Polyline(markersPoint, {
        color: 'red',
        weight: 3,
        opacity: 0.5,
        smoothFactor: 1
    });
    polylines.addTo(map);
}

var animateIcon = function(_polyLn) {
    intValAnimIcon = setInterval(fanimateIcon, 20);
    var lineOffset = 0;
    var iconSpeed = 0.2;
    function fanimateIcon() {
        lineOffset = (lineOffset + iconSpeed) % 200;
        var lineIcon = _polyLn.get('icons');
        lineIcon[0].offset = lineOffset / 2 + '%';
        _polyLn.set('icons', lineIcon);
    }
}

$('#formMapTrack').submit(function (e) {
    e.preventDefault();
    device_id = $("input[name=device_id]").val();
    _dtfrom = $("input[name=txtdtfrom]").val();
    _dtto = $("input[name=txtdtto]").val();
    for (const [key, value] of Object.entries(markers)) {
        map.removeLayer(markers[key])
        delete markers[key];
    }
    _lines.forEach(function(_line) {
        delete _lines[_line];
    });
    if (polylines) {
        map.removeLayer(polylines);
    }
    _lines = null;
    _lines = [];
    $.get(url + "/tracking/detail/js/map?did="+ device_id +"&from="+ _dtfrom +"&to=" + _dtto, function (res) {
        // created_at
        // ffaccuracy_cep
        // ffbattery
        // ffdirection
        // fflat
        // fflon
        // ffspeed
        // fngeo_chkpoint
        // fngeo_id
        // ftdevice_id
        // fttype
        // id
        $.each(res.relay.data, function (k, v) {
            markers[v.id] = _newMarker({ lat: v.fflat, lng: v.fflon }, {
                icon : L.icon({
                    iconUrl: iconUrl,
                    shadowUrl: shadowUrl,
                    // iconSize:     [10, 95], // size of the icon
                    // shadowSize:   [50, 64], // size of the shadow
                    iconAnchor:   [17, 37], // point of the icon which will correspond to marker's location
                    shadowAnchor: [17, 37],  // the same for the shadow
                    popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor
                })},
                'Hello world!<br />This is a nice tooltip.',
                `HELOWORLD IM MARKER`);
            myFGMarker.addLayer(markers[v.id]);
            myFGMarker.addTo(map);
            _lines.push({ lat: v.fflat, lng: v.fflon })
        });
        map.fitBounds(myFGMarker.getBounds());
        createPolyLine(_lines);
    });
});