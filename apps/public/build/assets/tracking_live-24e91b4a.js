import{_ as m}from"./leaflet.rotatedMarker-71d1d069.js";import"./_commonjsHelpers-28e086c5.js";const v=window.sio;var a=$("input[name=_lat]").val(),r=$("input[name=_lon]").val(),c=$("input[name=_id]").val(),d=function(t){return L.icon({iconUrl:t,iconSize:[28,28],iconAnchor:[15,20]})},n=L.map("livemap",{minZoom:5,fullscreenControl:!0,attributionControl:!1}).setView([.33995192349439596,120.3733680354565],7),_=L.tileLayer(window.mapLayer);_.addTo(n);var e=new m([a,r],{draggable:!1,title:"Resource location",alt:"Resource Location",riseOnHover:!0,icon:d(window.c_marker_front)}).addTo(n),i=new L.FeatureGroup;i.addLayer(e);i.addTo(n);n.fitBounds(i.getBounds());var s=!0;setInterval(function(){s&&(e.setIcon(d(window.c_marker_front)),e.setRotationAngle(0))},15e3);v.on("trx_device_data_rcv",function(t){var o=JSON.parse(t);if(console.log(o,o.id,c),o.id===c){var l=new L.Polyline([{lat:a,lng:r},{lat:o.lat,lng:o.lon}],{color:"red",weight:5,opacity:.5,smoothFactor:1});l.addTo(n),console.log(l),a=o.lat,r=o.lon,e.slideTo([o.lat,o.lon],{duration:2e3,keepAtCenter:!1});var u=L.icon({iconUrl:window.c_marker_top,iconSize:[23,30],iconAnchor:[12,16]});e.setIcon(u),e.setRotationAngle(o.direction),e.setRotationOrigin("center center"),setTimeout(function(){s=!0},3e5)}});