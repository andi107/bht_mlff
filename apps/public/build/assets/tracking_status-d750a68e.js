const d="/assets/images/leaflet/yellow-car40px.png";var p=$("input[name=_lat]").val(),m=$("input[name=_lon]").val(),s=$("#datetime").text(),v=$("#ignitiondate").text();$("#datetime").text(window.dtHumanParse(s));$("#ignitiondate").text(window.dtHumanParse(v));var a=L.map("statusmap",{minZoom:5,fullscreenControl:!0,attributionControl:!1}).setView([.33995192349439596,120.3733680354565],5),n=new L.FeatureGroup,w=L.tileLayer(window.mapLayer);w.addTo(a);function c(t,r=null,i=null,o=null){var e;if(r?e=L.marker(t,r):e=L.marker(t),o){var l=L.popup().setContent(o);e.bindPopup(l).openPopup()}if(i){var u=L.tooltip().setContent(i);e.bindTooltip(u).openTooltip()}return e.addTo(a),e}var f=c({lat:p,lng:m},{icon:L.icon({iconUrl:d,iconSize:[30,30],iconAnchor:[15,33],popupAnchor:[0,-15]})},null,null),n=new L.FeatureGroup;n.addLayer(f);n.addTo(a);a.fitBounds(n.getBounds());