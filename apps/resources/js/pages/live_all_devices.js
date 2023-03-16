import DriftMarker from "leaflet-drift-marker";
import "leaflet-rotatedmarker";
const url = window.burl;
const iconUrl = "/assets/images/leaflet/yellow-car40px.png";
const iconTop = "/assets/images/leaflet/yellow-car-top.png";
const sio = window.sio;

var map = L.map('devicesmap', {
    minZoom: 5,
    attributionControl: false,
    fullscreenControl: true,
}).setView([
    0.33995192349439596, 120.3733680354565
], 5), myFGMarker = new L.FeatureGroup(), markers = {},
myIcon = function (iUrl) {
    return L.icon({
        iconUrl: iUrl,
        iconSize:     [30, 30],
        iconAnchor:   [15, 20],
        // popupAnchor:  [0, -15]
    })
},randHexColor = function() {
    return Math.floor(Math.random()*16777215).toString(16);
};

var _tileLayer = L.tileLayer(window.mapLayer, {
    attribution: '',
});
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
//         mkr.bindPopup(popup, {
//             'className': 'custom-popup'
//         }).openPopup();
//     }
//     if (customToolTip) {
//         var tooltip = L.tooltip()
//         .setContent(customToolTip)
//         mkr.bindTooltip(tooltip).openTooltip();
//     }

//     mkr.addTo(map)
//     return mkr;
// }

var contentInfoWindow = function(v) {
    return `<h3 class="h6 d-block text-uppercase font-weight-bold">${v.ftdevice_name}</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span>` +
    `<div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">` +
    `Last Update</div><div class="col-7 pl-4">${window.dtHumanParse(v.created_at)}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">` +
    `Vehicle ID</div><div class="col-7 pl-4">${v.ftasset_id}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">` +
    `Vehicle Name</div><div class="col-7 pl-4">${v.ftasset_name}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">` +
    `</div>`;
}

$.get(url + "/devtools/monitor/js/devices", function (res) {
    // console.log(res.data)
    $.each(res.data.data, function (k, v) {
        var mk = new DriftMarker([v.fflat, v.fflon], {
            draggable: false,
            title: "Resource location",
            alt: "Resource Location",
            riseOnHover: true,
            icon : myIcon(iconUrl)
        });
        mk.bindTooltip(v.ftasset_id).openTooltip();
        
        var popup = L.popup().setContent(contentInfoWindow(v));
        mk.bindPopup(popup, {
            'className': 'custom-popup'
        }).openPopup();
        markers[v.ftdevice_id] = mk;
        markers[v.ftdevice_id].__pathColor = `#${randHexColor()}`;
        mk.addTo(map);
        myFGMarker.addLayer(mk);
        myFGMarker.addTo(map);
    });
    if ( res.data.data.length != 0) {
        map.fitBounds(myFGMarker.getBounds());
    }else{
        console.log('No Data')
    }
    startRecord();
});

function startRecord() {
    sio.on('trx_device_data_rcv', function (data) {
        var v = JSON.parse(data);
        
        if (typeof(markers[v.id]) !== "undefined") {
            var _curLatLng = { lat:v.lat, lng:v.lon};
            var polylines = new L.Polyline([markers[v.id]._latlng, _curLatLng], {
                color: markers[v.id].__pathColor,
                weight: 5,
                opacity: 0.5,
                smoothFactor: 1
            });
            polylines.addTo(map);
            
            markers[v.id].slideTo([v.lat, v.lon], {
                duration: 5000,
                keepAtCenter: false,
            });
    
            var _movIcon = L.icon({
                iconUrl: iconTop,
                iconSize:     [15, 30],
                iconAnchor:   [7,16],
                // popupAnchor:  [0, -15]
            });
            
            markers[v.id].setIcon(_movIcon);
            markers[v.id].setRotationAngle(v.direction);
            markers[v.id].setRotationOrigin("center center");
            markers[v.id]._latlng = _curLatLng;
            setTimeout(function () {
                markers[v.id].setIcon(myIcon(iconUrl));
                markers[v.id].setRotationAngle(0);
            }, 300000);
        }
    });
}