const s=window.burl,c="/assets/images/leaflet/yellow-car40px.png";var r=L.map("dashboardmap",{minZoom:5,attributionControl:!1}).setView([.33995192349439596,120.3733680354565],5),d=new L.FeatureGroup,p=L.tileLayer(window.mapLayer,{attribution:""});p.addTo(r);function m(a,i=null,t=null,e=null){var o;if(i?o=L.marker(a,i):o=L.marker(a),e){var l=L.popup().setContent(e);o.bindPopup(l,{className:"custom-popup"}).openPopup()}if(t){var n=L.tooltip().setContent(t);o.bindTooltip(n).openTooltip()}return o.addTo(r),o}var u=function(a){return`<h3 class="h6 d-block text-uppercase font-weight-bold">${a.ftdevice_name}</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span><div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">Last Update</div><div class="col-7 pl-4">${window.dtHumanParse(a.created_at)}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">Vehicle ID</div><div class="col-7 pl-4">${a.ftasset_id}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">Vehicle Name</div><div class="col-7 pl-4">${a.ftasset_name}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark"></div>`};$.get(s+"/dashboard/js",function(a){$.each(a.data.data,function(i,t){var e=m({lat:t.fflat,lng:t.fflon},{icon:L.icon({iconUrl:c,iconSize:[30,30],iconAnchor:[16,23],popupAnchor:[0,-15]})},t.ftasset_id,u(t));d.addLayer(e),d.addTo(r)}),a.data.data.length!=0?r.fitBounds(d.getBounds()):console.log("No Data")});
