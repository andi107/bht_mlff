import{_ as m}from"./leaflet.rotatedMarker-71d1d069.js";import"./_commonjsHelpers-28e086c5.js";const s="/assets/images/leaflet/yellow-car40px.png",p="/assets/images/leaflet/yellow-car-top.png",f=window.sio;var a=$("input[name=_lat]").val(),i=$("input[name=_lon]").val(),c=$("input[name=_id]").val(),d=function(n){return L.icon({iconUrl:n,iconSize:[30,30],iconAnchor:[15,20]})},t=L.map("livemap",{minZoom:5,fullscreenControl:!0,attributionControl:!1}).setView([.33995192349439596,120.3733680354565],7),g=L.tileLayer(window.mapLayer);g.addTo(t);var e=new m([a,i],{draggable:!1,title:"Resource location",alt:"Resource Location",riseOnHover:!0,icon:d(s)}).addTo(t),r=new L.FeatureGroup;r.addLayer(e);r.addTo(t);t.fitBounds(r.getBounds());var u=!0;setInterval(function(){u&&(e.setIcon(d(s)),e.setRotationAngle(0))},15e3);f.on("trx_device_data_rcv",function(n){var o=JSON.parse(n);if(console.log(o,o.id,c),o.id===c){var l=new L.Polyline([{lat:a,lng:i},{lat:o.lat,lng:o.lon}],{color:"red",weight:5,opacity:.5,smoothFactor:1});l.addTo(t),console.log(l),a=o.lat,i=o.lon,e.slideTo([o.lat,o.lon],{duration:5e3,keepAtCenter:!1});var v=L.icon({iconUrl:p,iconSize:[15,30],iconAnchor:[7,16]});e.setIcon(v),e.setRotationAngle(o.direction),e.setRotationOrigin("center center"),setTimeout(function(){u=!0},3e5)}});