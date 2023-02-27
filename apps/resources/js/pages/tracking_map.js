import '../ts/mkrmove';
const url = window.burl;
const iconUrl = '/assets/images/leaflet/marker-reddot.png';
const shadowUrl = window.shadowUrl;

var tbllogsdet = $('#tbllogsdet').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copy',
            // messageTop: function () {
            //     return rowTblLogsData[1] + ' to ' + rowTblLogsData[2];
            // }
        },
        {
            extend: 'pdf',
            // messageTop: function () {
            //     return rowTblLogsData[1] + ' to ' + rowTblLogsData[2];
            // }
        },
        {
            extend: 'print',
            // messageTop: function () {
            //     return rowTblLogsData[1] + ' to ' + rowTblLogsData[2];
            // }
        },
        {
            extend: 'excel',
            // messageTop: function () {
            //     return rowTblLogsData[1] + ' to ' + rowTblLogsData[2];
            // }
        },
    ],
    scrollX: true,
    order: [[0, 'asc']],
    "columnDefs": [
        {
            target: 0,
            visible: false,
            searchable: false,
        },
    ],
});
$("#tbllogsdet").width("100%");

// /tracking/detail/js/map?did=860371050882459&from=2023-02-10%2016:50:04&to=2023-02-22%2005:52:21
// https://github.com/ewoken/Leaflet.MovingMarker
var device_id,_dtfrom,_dtto,
map = L.map('trackingmap', {
    minZoom: 5,
    fullscreenControl: true,
    attributionControl: false,
}).setView([
    0.33995192349439596, 120.3733680354565
], 5), markers = {}, myFGMarker = new L.FeatureGroup(),_lines = [], polylines, _movMkrPoint = [],_speedToMkr = [], myMovingMarker = null;

var _tileLayer = L.tileLayer(window.mapLayer);
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
    // const customOptions = {
    //     'maxWidth': '342px', // set max-width
    //     'width': '342px',
    //     'className': 'customPopup' // name custom popup
    // }
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


// var marker = L.marker(_isLatLng);

function createPolyLine(markersPoint) {
    // var pointList = [_isLatLng[0], _isLatLng[1]];
    polylines = new L.Polyline(markersPoint, {
        color: 'red',
        weight: 5,
        opacity: 0.5,
        smoothFactor: 1
    });
    polylines.addTo(map);
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
    _movMkrPoint.forEach(function(k){
        delete _movMkrPoint[k];
    });
    _speedToMkr.forEach(function(k){
        delete _speedToMkr[k];
    });
    
    if (polylines) {
        map.removeLayer(polylines);
    }
    if (myMovingMarker) {
        // myMovingMarker.stop();
        map.removeLayer(myMovingMarker);
        myMovingMarker = null;
    }
    _lines = null;
    _speedToMkr = null;
    _movMkrPoint = null;
    _movMkrPoint = [];
    _speedToMkr = [];
    _lines = [];
    tbllogsdet.clear().draw();
    $.get(url + "/tracking/detail/js/map?did="+ device_id +"&from="+ _dtfrom +"&to=" + _dtto, function (res) {
        // console.log(res)
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
                    // shadowUrl: shadowUrl,
                    iconSize:     [10, 20], // size of the icon
                    // shadowSize:   [50, 64], // size of the shadow
                    iconAnchor:   [6, 15], // point of the icon which will correspond to marker's location
                    // shadowAnchor: [17, 37],  // the same for the shadow
                    popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor
                })}, v.created_at, contentInfoWindow(v));
            myFGMarker.addLayer(markers[v.id]);
            myFGMarker.addTo(map);
            _lines.push({ lat: v.fflat, lng: v.fflon });
            _movMkrPoint.push([v.fflat,v.fflon]);
            _speedToMkr.push(500);
            var _altitude = 'n/a ';
            if (v.alt) {
                _altitude = parseFloat(parseFloat(v.alt) / 3.2808).toFixed(2);
            }
            tbllogsdet.row.add([
                v.id,v.created_at, v.fflat , v.fflon, v.ffaccuracy_cep, v.ffdirection,v.ffspeed,v.ffaltitude
            ]).draw(true);
        });
        if ( res.relay.data.length != 0) {
            map.fitBounds(myFGMarker.getBounds());
            createPolyLine(_lines);
            myMovingMarker = new L.Marker.movingMarker(_movMkrPoint, _speedToMkr).addTo(map);
            myMovingMarker.start();
            myMovingMarker.on('end', function() {
                myMovingMarker.start();
            });
        }else{
            console.log('No Data')
        }
    });
});

$('.datepicker').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss'
});

function between(x, min, max) {
    return x >= min && x <= max;
}
var contentInfoWindow = function(v) {
    var strsignal = 'n/a';
    if (between(parseInt(v.fnsignal), 0, 10)) {
        strsignal = 'Poor'
    }else if(between(parseInt(v.fnsignal), 11, 20)) {
        strsignal = 'Good';
    }else if(between(parseInt(v.fnsignal), 21, 31)) {
        strsignal = 'Excelent';
    }
    return '<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span>' +
                '<div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">' +
                'DATE TIME</div><div class="col-7 pl-4">'+ v.created_at +'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'ALT (Meters)</div><div class="col-7 pl-4">'+ parseFloat(parseFloat(v.ffaltitude) / 3.2808).toFixed(2) +'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'SPEED</div><div class="col-7 pl-4">'+ v.ffspeed +'Km/h</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'ACCURACY (CEP)</div><div class="col-7 pl-4">'+ v.ffaccuracy_cep +'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'SIGNAL</div><div class="col-7 pl-4">'+ v.fnsignal +' ('+ strsignal +')</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'DIRECTION</div><div class="col-7 pl-4">'+ v.ffdirection +'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'COORDINATE</div><div class="col-7 pl-4">'+ v.fflat.toString() + ', ' + v.fflon.toString() +'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">'+
                'SATTELITE</div><div class="col-7 pl-4">'+ v.fnsattelite +'</div></div>';
}