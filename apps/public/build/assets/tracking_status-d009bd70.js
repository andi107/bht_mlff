const p="/assets/images/leaflet/yellow-car40px.png";var d=$("input[name=_lat]").val(),m=$("input[name=_lon]").val(),s=$("#datetime").text();$("#datetime").text(window.dtHumanParse(s));var a=L.map("statusmap",{minZoom:5,fullscreenControl:!0,attributionControl:!1}).setView([.33995192349439596,120.3733680354565],5),r=new L.FeatureGroup,v=L.tileLayer(window.mapLayer);v.addTo(a);function c(n,t=null,o=null,l=null){var e;if(t?e=L.marker(n,t):e=L.marker(n),l){var i=L.popup().setContent(l);e.bindPopup(i).openPopup()}if(o){var u=L.tooltip().setContent(o);e.bindTooltip(u).openTooltip()}return e.addTo(a),e}var w=c({lat:d,lng:m},{icon:L.icon({iconUrl:p,iconSize:[30,30],iconAnchor:[15,33],popupAnchor:[0,-15]})},null,null),r=new L.FeatureGroup;r.addLayer(w);r.addTo(a);a.fitBounds(r.getBounds());
