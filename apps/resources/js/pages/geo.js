var customerData = [
    {id:0,text:'enhancement'},
    {id:1,text:'bug'},
    {id:2,text:'duplicate'},
    {id:3,text:'invalid'},
    {id:4,text:'wontfix'}
];

$("#selCustomer").select2({ data: customerData });

var layerTmp = null, geoTmp = [], osmUrl = 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
    osm = L.tileLayer(osmUrl, { minZoom: 5 }),
    map = new L.Map('objmap', {
        center: new L.LatLng(0.339951, 120.373368),
        zoom: 5, attributionControl: false,
        fullscreenControl: true,
    }),
    drawnItems = L.featureGroup().addTo(map);
L.control.layers({
    'osm': osm.addTo(map),
    "google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
        attribution: 'google'
    })
},{
    'drawlayer': drawnItems
},{
    position: 'topright',
    collapsed: false
}).addTo(map);
// self.Polygon = null;
// self.Circle = null;
// console.log(self)
// Add Draw

self.drawControlFull = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
        poly: {
            allowIntersection: false
        },
    },
    draw: {
        polygon: {
            allowIntersection: false,
            showArea: true
        },
        polyline: false,
        rectangle: false,
        marker: false,
        circle: {
            allowIntersection: false,
            showArea: true
        },
        circlemarker: false
    }
});
self.drawControlEdit = new L.Control.Draw({
  edit: {
    featureGroup: drawnItems,
    poly: {
        allowIntersection: false
    },
    // edit: true
  },
  draw: false
});
map.addControl(drawControlFull);

// eof

map.on(L.Draw.Event.CREATED, function (event) {
    if (self.Polygon || self.Circle) {
        alert('You can only create 1 location per geofence');
        return null;
    }
    var layer = event.layer;
    console.log(layer)
    if (layer._latlng && layer._mRadius) {
        console.log('circle')
        window.circle = layer;
        drawnItems.addLayer(layer);
    }else if (layer._latlngs && layer._bounds){
        geoTmp = layer._latlngs[0];
        if (geoTmp.length < 4) {
            alert('Minimum 4 points required!');
            return null;
        }
        self.Polygon = layer;
        self.Polygon.setStyle({
            color: '#FFB84C',
            fillColor: '#FFB84C',
            fillOpacity : 0.1
        });
        // console.log('latlng',layer.options.color);
        
    }else {
        alert('Please make 1 Geofencing!')
        return null;
    }
    
    self.drawControlFull.remove();
    self.drawControlEdit.addTo(map);
    drawnItems.addLayer(layer);
    layerTmp = layer;
    console.log('Final',self.Polygon,self.Circle)
});

map.on(L.Draw.Event.EDITED, function (event) {
    var layers = event.layers;
    layers.eachLayer(function (layer) {
        console.log('edited', layer)
        if (layer._latlng && layer._mRadius) {
            console.log('circle')
        }else if (layer._latlngs && layer._bounds){
            console.log('polygon')
            geoTmp = layer._latlngs[0];
            if (geoTmp.length < 4) {
                alert('Minimum 4 points required!');
                // self.Polygon = layerTmp;
                self.Polygon.remove();
                self.Polygon = null;
                self.drawControlEdit.remove();
	            self.drawControlFull.addTo(map);
                drawnItems.clearLayers();
                return null;
            }
            console.log('PolyF',self.Polygon)
            // self.polygon = layer;
            // layerTmp = layer;
        }else {
            alert('Please make 1 Geofencing!')
        }
    });
});

map.on(L.Draw.Event.DELETED, function (event) {
    var layers = event.layers;
    layers.eachLayer(function (layer) {
        console.log('deleted', layer)
        self.Circle = null;
        self.Polygon = null;
        geoTmp = [];
        self.drawControlEdit.remove();
	    self.drawControlFull.addTo(map);
    });
});
// var thisLayer = [];
// map.on(L.Draw.Event.DRAWVERTEX, function (e) {
//     for (thisLayer in e.target._layers) {
//         if (e.target._layers.hasOwnProperty(thisLayer)) {
//             if (e.target._layers[thisLayer].hasOwnProperty("edited")) {
//                 console.log("we think we found the polygon?");
//                 console.log(e.target._layers[thisLayer]);

//                 // the updated Polygon array points are here:
//                 newPolyLatLngArray = e.target._layers[thisLayer].editing.latlngs[0];
//                 console.log(newPolyLatLngArray)
//             }
//         }
//     };
// });

// if (layer instanceof L.Rectangle) {
//     console.log('im an instance of L rectangle');
// }

// if (layer instanceof L.Polygon) {
//     console.log('im an instance of L polygon');
// }

// if (layer instanceof L.Polyline) {
//     console.log('im an instance of L polyline');
// }