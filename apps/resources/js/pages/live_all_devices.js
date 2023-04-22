import DriftMarker from "leaflet-drift-marker";
import "leaflet-rotatedmarker";
const url = window.burl;
// const iconUrl = "/assets/images/leaflet/yellow-car40px.png";
// const iconTop = "/assets/images/leaflet/yellow-car-top.png";
const sio = window.sio;
const gateIcon = '/assets/images/leaflet/toll_gate.png';
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
        iconSize:     window.c_marker_front_cfg[0],
        iconAnchor:   window.c_marker_front_cfg[1],
        popupAnchor:  window.c_marker_front_cfg[2]
    })
},randHexColor = function() {
    return Math.floor(Math.random()*16777215).toString(16);
},_lGate = [],layer_polyGates,_lPolyGate = [];

var _tileLayer = L.tileLayer(window.mapLayer, {
    attribution: '',
});
_tileLayer.addTo(map);

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
            // title: "Resource location",
            // alt: "Resource Location",
            riseOnHover: true,
            icon : myIcon(window.c_marker_front)
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
                iconUrl: window.c_marker_top,
                iconSize:     window.c_marker_top_cfg[0],
                iconAnchor:   window.c_marker_top_cfg[1],
                popupAnchor:  window.c_marker_top_cfg[2]
            });
            
            markers[v.id].setIcon(_movIcon);
            markers[v.id].setRotationAngle(v.direction);
            markers[v.id].setRotationOrigin("center center");
            markers[v.id]._latlng = _curLatLng;
            setTimeout(function () {
                markers[v.id].setIcon(myIcon(window.c_marker_front));
                markers[v.id].setRotationAngle(0);
            }, 300000);
        }
    });
}


$.get(url + "/info/js/gate/zone", function (res) {
    console.log(res)
    $.each(res.data, function (k, v) {
        _lGate.push({
            type: "Feature",
            properties: {
                created_at: v.created_at,
                fflat: v.fflat,
                fflon: v.fflon,
                fnpayment_type: v.fnpayment_type,
                ftdescription: v.ftdescription,
                ftname: v.ftname,
                ftsection: v.ftsection,
                id: v.id
            },
            geometry: { type: "Point", coordinates: [parseFloat(v.fflon), parseFloat(v.fflat)] },
        });
        _lPolyGate.push({
            "type": "Feature",
            "properties": {
                fntype: v.fntype
            },
            "geometry": {
                "type": "Polygon",
                "coordinates": [v.polygon]
            }
        })
    });
    
    if ( res.data.length != 0) {
        pointing(map);
        polyGates(map)
    }else{
        console.log('No Data')
    }
});

function pointing(map) {
    var bounds_group = new L.featureGroup([]);
    var jGate = {
        type: "FeatureCollection",
        name: "relay",
        features: _lGate
    };
    
    function pop_relay(feature, layer) {
        var v = feature.properties,payment_type = 'n/a';
        if (v.fnpayment_type === 1) {
            payment_type = 'Open';
        }else if (v.fnpayment_type === 2) {
            payment_type = 'Close';
        }
        layer.bindPopup(`<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span>` +
        `<div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">` +
        `GATE NAME</div><div class="col-7 pl-4">${v.ftname}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">` +
        `SECTION</div><div class="col-7 pl-4">${v.ftsection}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">`+
        `PAYMENT TYPE</div><div class="col-7 pl-4">${payment_type}</div></div>`, {maxHeight: 400});
        layer.bindTooltip(v.ftname);
    }

    map.createPane('pane_Gate');
    map.getPane('pane_Gate').style.zIndex = 402;
    map.getPane('pane_Gate').style['mix-blend-mode'] = 'normal';
    var lGate = new L.geoJson(jGate, {
        attribution: '',
        interactive: true,
        dataVar: 'jGate',
        layerName: 'lGate',
        pane: 'pane_Gate',
        onEachFeature: pop_relay,
        pointToLayer: function (feature, latlng) {
            
            // console.log(feature,latlng)
            return L.marker(latlng,{icon: L.icon({
                    iconUrl: gateIcon,
                    iconSize:     [30, 30],
                    iconAnchor:   [16, 25],
                    popupAnchor:  [0, -15]
                })
            });
            // return L.shapeMarker(latlng, style_Relay());
        },
    });
    bounds_group.addLayer(lGate);
    map.addLayer(lGate);
    map.fitBounds(bounds_group.getBounds());
}

function polyGates(map) {
    var json_polyGates = {
        type: "FeatureCollection",
        name: "polyGates",
        features: _lPolyGate
    }

    function style_polyGates (feature) {
        if (feature.properties.fntype === 1) {
            return {
                pane: 'pane_polyGates',
                opacity: 1,
                color: '#00FFCA',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 2,
                fillOpacity: 1,
                interactive: true,
            }
        }else{
            return {
                pane: 'pane_polyGates',
                opacity: 1,
                color: '#ED2B2A',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 2,
                fillOpacity: 0,
                interactive: true,
            }
        }
    }

    map.createPane('pane_polyGates');
    map.getPane('pane_polyGates').style.zIndex = 401;
    map.getPane('pane_polyGates').style['mix-blend-mode'] = 'normal';
    layer_polyGates = new L.geoJson(json_polyGates, {
        attribution: '',
        interactive: true,
        dataVar: 'json_polyGates',
        layerName: 'layer_polyGates',
        pane: 'pane_polyGates',
        style: style_polyGates,
        pointToLayer: function(v, latlng) {
            // console.log(v);
            return window._newMarker(latlng, {
                icon : L.icon({
                    iconUrl: window.gateUrl,
                    iconSize:     [30, 30],
                    iconAnchor:   [8, 25],
                    popupAnchor:  [0, -20]
                })
            },v.properties.gate_name,
            `<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span>` +
            `<div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">` +
            `GATE NAME</div><div class="col-7 pl-4">${v.properties.gate_name}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">` +
            `SECTION</div><div class="col-7 pl-4">${v.properties.ftsection}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">`+
            `DECLARE</div><div class="col-7 pl-4">${v.properties.ftdeclaration_type}</div></div>`)
        },
    });
    map.addLayer(layer_polyGates);
}