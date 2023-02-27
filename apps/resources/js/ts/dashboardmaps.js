const url = window.burl;
const iconUrl = window.iconUrl;
const shadowUrl = window.shadowUrl;

var map = L.map('dashboardmap', {
    minZoom: 5,
    attributionControl: false,
}).setView([
    0.33995192349439596, 120.3733680354565
], 5), myFGMarker = new L.FeatureGroup();

var _tileLayer = L.tileLayer(window.mapLayer, {
    attribution: '',
});
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
        mkr.bindPopup(popup, {
            'maxWidth': '342px', // set max-width
            'width': '342px',
            'className': 'customPopup' // name custom popup
        }).openPopup();
    }
    if (customToolTip) {
        var tooltip = L.tooltip()
        .setContent(customToolTip)
        mkr.bindTooltip(tooltip).openTooltip();
    }

    mkr.addTo(map)
    return mkr;
}

var contentInfoWindow = function(v) {
    return '<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span>' +
                '<div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">' +
                'DATE TIME</div><div class="col-7 pl-4"></div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'ALT (Meters)</div><div class="col-7 pl-4"></div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'SPEED</div><div class="col-7 pl-4">Km/h</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'ACCURACY (CEP)</div><div class="col-7 pl-4"></div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'SIGNAL</div><div class="col-7 pl-4"></div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'DIRECTION</div><div class="col-7 pl-4"></div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'COORDINATE</div><div class="col-7 pl-4"></div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'SATTELITE</div><div class="col-7 pl-4"></div></div>';
}

$.get(url + "/dashboard/js", function (res) {
    $.each(res.data.data, function (k, v) {
        var marker = _newMarker({ lat: v.fflat, lng: v.fflon }, {
            icon : L.icon({
                iconUrl: iconUrl,
                shadowUrl: shadowUrl,
                // iconSize:     [10, 95], // size of the icon
                // shadowSize:   [50, 64], // size of the shadow
                iconAnchor:   [17, 37], // point of the icon which will correspond to marker's location
                shadowAnchor: [17, 37],  // the same for the shadow
                popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor
            })},
            v.created_at,
            contentInfoWindow(v));
            myFGMarker.addLayer(marker);
            myFGMarker.addTo(map);
    });
    if ( res.data.data.length != 0) {
        map.fitBounds(myFGMarker.getBounds());
    }else{
        console.log('No Data')
    }
});