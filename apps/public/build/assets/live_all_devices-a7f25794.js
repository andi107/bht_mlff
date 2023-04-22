import{_ as g}from"./leaflet.rotatedMarker-71d1d069.js";import"./_commonjsHelpers-28e086c5.js";const u=window.burl,v=window.sio,h="/assets/images/leaflet/toll_gate.png";var n=L.map("devicesmap",{minZoom:5,attributionControl:!1,fullscreenControl:!0}).setView([.33995192349439596,120.3733680354565],5),c=new L.FeatureGroup,r={},m=function(e){return L.icon({iconUrl:e,iconSize:window.c_marker_front_cfg[0],iconAnchor:window.c_marker_front_cfg[1],popupAnchor:window.c_marker_front_cfg[2]})},w=function(){return Math.floor(Math.random()*16777215).toString(16)},y=[],f,_=[],b=L.tileLayer(window.mapLayer,{attribution:""});b.addTo(n);var x=function(e){return`<h3 class="h6 d-block text-uppercase font-weight-bold">${e.ftdevice_name}</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span><div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">Last Update</div><div class="col-7 pl-4">${window.dtHumanParse(e.created_at)}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">Vehicle ID</div><div class="col-7 pl-4">${e.ftasset_id}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">Vehicle Name</div><div class="col-7 pl-4">${e.ftasset_name}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark"></div>`};$.get(u+"/devtools/monitor/js/devices",function(e){$.each(e.data.data,function(o,t){var a=new g([t.fflat,t.fflon],{draggable:!1,riseOnHover:!0,icon:m(window.c_marker_front)});a.bindTooltip(t.ftasset_id).openTooltip();var i=L.popup().setContent(x(t));a.bindPopup(i,{className:"custom-popup"}).openPopup(),r[t.ftdevice_id]=a,r[t.ftdevice_id].__pathColor=`#${w()}`,a.addTo(n),c.addLayer(a),c.addTo(n)}),e.data.data.length!=0?n.fitBounds(c.getBounds()):console.log("No Data"),k()});function k(){v.on("trx_device_data_rcv",function(e){var o=JSON.parse(e);if(typeof r[o.id]<"u"){var t={lat:o.lat,lng:o.lon},a=new L.Polyline([r[o.id]._latlng,t],{color:r[o.id].__pathColor,weight:5,opacity:.5,smoothFactor:1});a.addTo(n),r[o.id].slideTo([o.lat,o.lon],{duration:5e3,keepAtCenter:!1});var i=L.icon({iconUrl:window.c_marker_top,iconSize:window.c_marker_top_cfg[0],iconAnchor:window.c_marker_top_cfg[1],popupAnchor:window.c_marker_top_cfg[2]});r[o.id].setIcon(i),r[o.id].setRotationAngle(o.direction),r[o.id].setRotationOrigin("center center"),r[o.id]._latlng=t,setTimeout(function(){r[o.id].setIcon(m(window.c_marker_front)),r[o.id].setRotationAngle(0)},3e5)}})}$.get(u+"/info/js/gate/zone",function(e){console.log(e),$.each(e.data,function(o,t){y.push({type:"Feature",properties:{created_at:t.created_at,fflat:t.fflat,fflon:t.fflon,fnpayment_type:t.fnpayment_type,ftdescription:t.ftdescription,ftname:t.ftname,ftsection:t.ftsection,id:t.id},geometry:{type:"Point",coordinates:[parseFloat(t.fflon),parseFloat(t.fflat)]}}),_.push({type:"Feature",properties:{fntype:t.fntype},geometry:{type:"Polygon",coordinates:[t.polygon]}})}),e.data.length!=0?(G(n),A(n)):console.log("No Data")});function G(e){var o=new L.featureGroup([]),t={type:"FeatureCollection",name:"relay",features:y};function a(p,d){var l=p.properties,s="n/a";l.fnpayment_type===1?s="Open":l.fnpayment_type===2&&(s="Close"),d.bindPopup(`<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span><div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">GATE NAME</div><div class="col-7 pl-4">${l.ftname}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SECTION</div><div class="col-7 pl-4">${l.ftsection}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">PAYMENT TYPE</div><div class="col-7 pl-4">${s}</div></div>`,{maxHeight:400}),d.bindTooltip(l.ftname)}e.createPane("pane_Gate"),e.getPane("pane_Gate").style.zIndex=402,e.getPane("pane_Gate").style["mix-blend-mode"]="normal";var i=new L.geoJson(t,{attribution:"",interactive:!0,dataVar:"jGate",layerName:"lGate",pane:"pane_Gate",onEachFeature:a,pointToLayer:function(p,d){return L.marker(d,{icon:L.icon({iconUrl:h,iconSize:[30,30],iconAnchor:[16,25],popupAnchor:[0,-15]})})}});o.addLayer(i),e.addLayer(i),e.fitBounds(o.getBounds())}function A(e){var o={type:"FeatureCollection",name:"polyGates",features:_};function t(a){return a.properties.fntype===1?{pane:"pane_polyGates",opacity:1,color:"#00FFCA",dashArray:"",lineCap:"square",lineJoin:"bevel",weight:2,fillOpacity:1,interactive:!0}:{pane:"pane_polyGates",opacity:1,color:"#ED2B2A",dashArray:"",lineCap:"square",lineJoin:"bevel",weight:2,fillOpacity:1,interactive:!0}}e.createPane("pane_polyGates"),e.getPane("pane_polyGates").style.zIndex=401,e.getPane("pane_polyGates").style["mix-blend-mode"]="normal",f=new L.geoJson(o,{attribution:"",interactive:!0,dataVar:"json_polyGates",layerName:"layer_polyGates",pane:"pane_polyGates",style:t,pointToLayer:function(a,i){return window._newMarker(i,{icon:L.icon({iconUrl:window.gateUrl,iconSize:[30,30],iconAnchor:[8,25],popupAnchor:[0,-20]})},a.properties.gate_name,`<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span><div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">GATE NAME</div><div class="col-7 pl-4">${a.properties.gate_name}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SECTION</div><div class="col-7 pl-4">${a.properties.ftsection}</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">DECLARE</div><div class="col-7 pl-4">${a.properties.ftdeclaration_type}</div></div>`)}}),e.addLayer(f)}