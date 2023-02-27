L.AnimatedMarker=L.Marker.extend({options:{distance:200,interval:1e3,autoStart:!0,onEnd:function(){},clickable:!1},initialize:function(t,i){this.setLine(t),L.Marker.prototype.initialize.call(this,t[0],i)},_chunk:function(t){var i,o=t.length,e=[];for(i=1;i<o;i++){var a=t[i-1],r=t[i],l=a.distanceTo(r),u=this.options.distance/l,y=u*(r.lat-a.lat),_=u*(r.lng-a.lng);if(l>this.options.distance)for(;l>this.options.distance;)a=new L.LatLng(a.lat+y,a.lng+_),l=a.distanceTo(r),e.push(a);else e.push(a)}return e.push(t[o-1]),e},onAdd:function(t){L.Marker.prototype.onAdd.call(this,t),this.options.autoStart&&this.start()},animate:function(){var t=this,i=this._latlngs.length,o=this.options.interval;this._i<i&&this._i>0&&(o=this._latlngs[this._i-1].distanceTo(this._latlngs[this._i])/this.options.distance*this.options.interval),L.DomUtil.TRANSITION&&(this._icon&&(this._icon.style[L.DomUtil.TRANSITION]="all "+o+"ms linear"),this._shadow&&(this._shadow.style[L.DomUtil.TRANSITION]="all "+o+"ms linear")),this.setLatLng(this._latlngs[this._i]),this._i++,this._tid=setTimeout(function(){t._i===i?t.options.onEnd.apply(t,Array.prototype.slice.call(arguments)):t.animate()},o)},start:function(){this.animate()},stop:function(){this._tid&&clearTimeout(this._tid)},setLine:function(t){L.DomUtil.TRANSITION?this._latlngs=t:(this._latlngs=this._chunk(t),this.options.distance=10,this.options.interval=30),this._i=0}});L.animatedMarker=function(t,i){return new L.AnimatedMarker(t,i)};const m=window.burl,w="/assets/images/leaflet/marker-reddot.png";var g=$("#tbllogsdet").DataTable({dom:"Bfrtip",buttons:[{extend:"copy"},{extend:"pdf"},{extend:"print"},{extend:"excel"}],scrollX:!0,order:[[0,"asc"]],columnDefs:[{target:0,visible:!1,searchable:!1}]});$("#tbllogsdet").width("100%");var v,k,b,n=L.map("trackingmap",{minZoom:5,fullscreenControl:!0,attributionControl:!1}).setView([.33995192349439596,120.3733680354565],5),c={},p=new L.FeatureGroup,s=[],f,d,x=L.tileLayer(window.mapLayer);x.addTo(n);function T(t,i=null,o=null,e=null){var a;if(i?a=L.marker(t,i):a=L.marker(t),e){var r=L.popup().setContent(e);a.bindPopup(r).openPopup()}if(o){var l=L.tooltip().setContent(o);a.bindTooltip(l).openTooltip()}return a.addTo(n),a}function A(t){f=new L.Polyline(t,{color:"red",weight:5,opacity:.5,smoothFactor:1}),f.addTo(n)}$("#formMapTrack").submit(function(t){t.preventDefault(),v=$("input[name=device_id]").val(),k=$("input[name=txtdtfrom]").val(),b=$("input[name=txtdtto]").val();for(const[i,o]of Object.entries(c))n.removeLayer(c[i]),delete c[i];s.forEach(function(i){delete s[i]}),f&&(n.removeLayer(f),n.removeLayer(d),d=null),s=null,s=[],g.clear().draw(),$.get(m+"/tracking/detail/js/map?did="+v+"&from="+k+"&to="+b,function(i){$.each(i.relay.data,function(o,e){c[e.id]=T({lat:e.fflat,lng:e.fflon},{icon:L.icon({iconUrl:w,iconSize:[10,20],iconAnchor:[5,15],popupAnchor:[0,-15]})},e.created_at,I(e)),p.addLayer(c[e.id]),p.addTo(n),s.push({lat:e.fflat,lng:e.fflon}),e.alt&&parseFloat(parseFloat(e.alt)/3.2808).toFixed(2),g.row.add([e.id,e.created_at,e.fflat,e.fflon,e.ffaccuracy_cep,e.ffdirection,e.ffspeed,e.ffaltitude]).draw(!0)}),i.relay.data.length!=0?(n.fitBounds(p.getBounds()),A(s),d=L.animatedMarker(f.getLatLngs(),{autoStart:!0,distance:200,interval:1e3,icon:L.icon({iconUrl:m+"/assets/images/leaflet/yellow-car40px.png",iconSize:[30,30],iconAnchor:[15,33],popupAnchor:[0,-15]}),onEnd:function(){}}),n.addLayer(d),d.on("click",function(o){d.start()})):console.log("No Data")})});$(".datepicker").datetimepicker({format:"YYYY-MM-DD HH:mm:ss"});function h(t,i,o){return t>=i&&t<=o}var I=function(t){var i="n/a";return h(parseInt(t.fnsignal),0,10)?i="Poor":h(parseInt(t.fnsignal),11,20)?i="Good":h(parseInt(t.fnsignal),21,31)&&(i="Excelent"),'<h3 class="h6 text-center d-block text-uppercase font-weight-bold">INFO</h3><span class="bottom-line d-block mx-auto mt-3 mb-4"></span><div class="row my-2 mx-auto"><div class="col text-right border-right border-dark">DATE TIME</div><div class="col-7 pl-4">'+t.created_at+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">ALT (Meters)</div><div class="col-7 pl-4">'+parseFloat(parseFloat(t.ffaltitude)/3.2808).toFixed(2)+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SPEED</div><div class="col-7 pl-4">'+t.ffspeed+'Km/h</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">ACCURACY (CEP)</div><div class="col-7 pl-4">'+t.ffaccuracy_cep+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SIGNAL</div><div class="col-7 pl-4">'+t.fnsignal+" ("+i+')</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">DIRECTION</div><div class="col-7 pl-4">'+t.ffdirection+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">COORDINATE</div><div class="col-7 pl-4">'+t.fflat.toString()+", "+t.fflon.toString()+'</div></div><div class="row my-2 mx-auto"><div class="col-5 text-right border-right border-dark">SATTELITE</div><div class="col-7 pl-4">'+t.fnsattelite+"</div></div>"};