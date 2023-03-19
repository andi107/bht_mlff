import{_ as k}from"./leaflet.rotatedMarker-71d1d069.js";import"./_commonjsHelpers-28e086c5.js";(function(i){typeof define=="function"&&define.amd?define(i):i()})(function(){L.ShapeMarker=L.CircleMarker.extend({options:{fill:!0,shape:"triangle",radius:10,rotation:0},setRadius:function(i){return this.options.radius=i,this.redraw()},getRadius:function(){return this.options.radius},setRotation:function(i){return this.options.rotation=i,this.redraw()},getRotation:function(){return this.options.rotation},_updatePath:function(){this._renderer._updateShape(this)},toGeoJSON:function(){return L.GeoJSON.getFeature(this,{type:"Point",coordinates:L.GeoJSON.latLngToCoords(this.getLatLng())})}}),L.shapeMarker=function(a,e){return new L.ShapeMarker(a,e)},L.SVG.include({_updateShape:function(a){var e=a._point,t=a.options.radius,o=a.options.shape,c=a.options.rotation;if(a._path.setAttribute("transform",`rotate(${c},${e.x},${e.y})`),o==="diamond"){var r="M"+(e.x-Math.sqrt(2)*t)+" "+e.y+" L "+e.x+" "+(e.y-Math.sqrt(2)*t)+" L"+(e.x+Math.sqrt(2)*t)+" "+e.y+" L"+e.x+" "+(e.y+Math.sqrt(2)*t)+" L"+(e.x-Math.sqrt(2)*t)+" "+e.y;this._setPath(a,r)}if(o==="square"){var r="M"+(e.x-t)+" "+(e.y-t)+" L "+(e.x+t)+" "+(e.y-t)+" L"+(e.x+t)+" "+(e.y+t)+" L"+(e.x-t)+" "+(e.y+t)+" L"+(e.x-t)+" "+(e.y-t);this._setPath(a,r)}if(o==="triangle"||o==="triangle-up"){var r="M"+(e.x-1.3*t)+" "+(e.y+.75*t)+" L"+e.x+" "+(e.y-1.5*t)+" L"+(e.x+1.3*t)+" "+(e.y+.75*t)+" Z";this._setPath(a,r)}if(o==="triangle-down"){var r="M"+(e.x-1.3*t)+" "+(e.y-.75*t)+" L"+e.x+" "+(e.y+1.5*t)+" L"+(e.x+1.3*t)+" "+(e.y-.75*t)+" Z";this._setPath(a,r)}if(o==="arrowhead"||o==="arrowhead-up"){var r="M "+(e.x+1.3*t)+" "+(e.y+1.3*t)+" L "+e.x+" "+(e.y-1.3*t)+" L "+(e.x-1.3*t)+" "+(e.y+1.3*t)+" L "+e.x+" "+(e.y+.5*t)+" L "+(e.x+1.3*t)+" "+(e.y+1.3*t)+" Z";this._setPath(a,r)}if(o==="arrowhead-down"){var r="M "+(e.x-1.3*t)+" "+(e.y-1.3*t)+" L "+e.x+" "+(e.y+1.3*t)+" L "+(e.x+1.3*t)+" "+(e.y-1.3*t)+" L "+e.x+" "+(e.y-.5*t)+" L "+(e.x-1.3*t)+" "+(e.y-1.3*t)+" Z";this._setPath(a,r)}if(o==="circle"&&this._updateCircle(a),o.startsWith("star")){var d=o.split(/[^0-9a-z]/gi,2),u=parseInt(d[1]);if(d[0]==="star"&&!isNaN(u)&&u>2)var l=u;else var l=5;for(var b=.5*(1+Math.sqrt(5))+1,m=[],p=0;p<l;p++)m.push(e.x+t/b*Math.sin(2*Math.PI/l*p)+","+(e.y+t/b*Math.cos(2*Math.PI/l*p))),m.push(e.x+t*Math.sin(1/l*Math.PI+2*Math.PI/l*p)+","+(e.y+t*Math.cos(1/l*Math.PI+2*Math.PI/l*p)));var r="M"+m.join("L")+"Z";this._setPath(a,r)}if(o==="x"){t=t/2;var r="M"+(e.x+t)+","+(e.y+t)+"L"+(e.x-t)+","+(e.y-t)+"M"+(e.x-t)+","+(e.y+t)+"L"+(e.x+t)+","+(e.y-t);this._setPath(a,r)}}})});const T=window.burl,w="/assets/images/leaflet/yellow-car-top.png";var C=$("#tbllogsdet").DataTable({dom:"Bfrtip",buttons:[{extend:"copy"},{extend:"pdf"},{extend:"print"},{extend:"excel"}],scrollX:!0,order:[[0,"desc"]]});$("#tbllogsdet").width("100%");var M,P,I,n=L.map("trackingmap",{minZoom:5,fullscreenControl:!0,attributionControl:!1}).setView([.33995192349439596,120.3733680354565],5),F=L.tileLayer(window.mapLayer);F.addTo(n);var y,x,f=[],_=[];$("#formMapTrack").submit(function(i){i.preventDefault(),M=$("input[name=device_id]").val(),P=$("input[name=txtdtfrom]").val(),I=$("input[name=txtdtto]").val(),f=[],_=[],y&&(n.removeLayer(y),n.removeLayer(x)),v&&clearInterval(v),C.clear().draw(),$.get(T+`/tracking/detail/js/map?did=${M}&from=${P}&to=${I}&humanTz=${window.dtHumanName()}`,function(a){$.each(a.relay.data,function(e,t){f.push({type:"Feature",properties:{created_at:t.created_at,ffaccuracy_cep:t.ffaccuracy_cep,ffaltitude:t.ffaltitude,ffbattery:t.ffbattery,ffdirection:t.ffdirection,fflat:t.fflat,fflon:t.fflon,ffspeed:t.ffspeed},geometry:{type:"Point",coordinates:[parseFloat(t.fflon),parseFloat(t.fflat)]}}),_.push([parseFloat(t.fflon),parseFloat(t.fflat)])}),a.relay.data.length!=0?(A(),S(),R()):toastr.info("Vehicle tracking not found.","Information")})});function A(){var i=new L.featureGroup([]),a={type:"FeatureCollection",name:"relay",features:f};function e(){return{pane:"pane_Relay",shape:"circle",radius:4,opacity:1,color:"#CF0A0A",dashArray:"",lineCap:"butt",lineJoin:"miter",weight:1,fill:!0,fillOpacity:1,fillColor:"#FF0032",interactive:!0}}function t(o,c){var r=o.properties,d="n/a";g(parseInt(r.fnsignal),0,10)?d="Poor":g(parseInt(r.fnsignal),11,20)?d="Good":g(parseInt(r.fnsignal),21,31)&&(d="Excelent");var u='<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span><div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">DATE TIME</div><div class="col-7 pl-4">'+window.dtHumanParse(r.created_at)+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">ALT (Meters)</div><div class="col-7 pl-4">'+parseFloat(parseFloat(r.ffaltitude)/3.2808).toFixed(2)+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SPEED</div><div class="col-7 pl-4">'+r.ffspeed+'Km/h</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">ACCURACY (CEP)</div><div class="col-7 pl-4">'+r.ffaccuracy_cep+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SIGNAL</div><div class="col-7 pl-4">'+r.fnsignal+" ("+d+')</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">DIRECTION</div><div class="col-7 pl-4">'+r.ffdirection+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">COORDINATE</div><div class="col-7 pl-4">'+r.fflat.toString()+", "+r.fflon.toString()+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SATTELITE</div><div class="col-7 pl-4">'+r.fnsattelite+"</div></div>";c.bindPopup(u,{maxHeight:400}),c.bindTooltip(window.dtHumanParse(r.created_at)).openTooltip()}n.createPane("pane_Relay"),n.getPane("pane_Relay").style.zIndex=402,n.getPane("pane_Relay").style["mix-blend-mode"]="normal",y=new L.geoJson(a,{attribution:"",interactive:!0,dataVar:"jRelay",layerName:"lRelay",pane:"pane_Relay",onEachFeature:t,pointToLayer:function(o,c){return L.shapeMarker(c,e())}}),i.addLayer(y),n.addLayer(y),n.fitBounds(i.getBounds())}function S(){var i={type:"FeatureCollection",name:"line_relay",features:[{type:"Feature",properties:{},geometry:{type:"LineString",coordinates:_}}]};function a(e){return{pane:"pane_line_relay",opacity:1,color:"#FF0032",dashArray:"",lineCap:"square",lineJoin:"bevel",weight:1,fillOpacity:0,interactive:!0}}n.createPane("pane_line_relay"),n.getPane("pane_line_relay").style.zIndex=401,n.getPane("pane_line_relay").style["mix-blend-mode"]="normal",x=new L.geoJson(i,{attribution:"",interactive:!0,dataVar:"json_line_relay",layerName:"layer_line_relay",pane:"pane_line_relay",style:a}),n.addLayer(x)}function g(i,a,e){return i>=a&&i<=e}var s,h=0,v;function R(){h=0;var i=f[0];s&&n.removeLayer(s),s=new k([i.geometry.coordinates[1],i.geometry.coordinates[0]],{draggable:!1,riseOnHover:!0,icon:L.icon({iconUrl:w,iconSize:[15,30],iconAnchor:[7,16],tooltipAnchor:[0,-15]})}).addTo(n),v=setInterval(function(){var a=f[h];s.slideTo([a.geometry.coordinates[1],a.geometry.coordinates[0]],{duration:1e3,keepAtCenter:!1}),s.setIcon(L.icon({iconUrl:w,iconSize:[15,30],iconAnchor:[7,16],tooltipAnchor:[16,0]})),s.setRotationAngle(a.properties.ffdirection),s.setRotationOrigin("center center"),s.bindTooltip(`Speed: ${a.properties.ffspeed} Km/h`,{position:"bottom"}),s.openTooltip(),h++,h===f.length&&(clearInterval(v),R())},1e3)}