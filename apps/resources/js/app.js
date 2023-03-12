import './bootstrap';
import $ from 'jquery';
window.jQuery = $;
import 'popper.js';

// window.mapLayer = 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
const url = location.protocol + '//' + window.location.host;
window.burl = url;
window.iconUrl = url + '/assets/images/leaflet/marker-icon.png';
window.shadowUrl = url + '/assets/images/leaflet/marker-shadow.png';
window.mapLayer = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
const sio = io("http://110.5.105.26:60011");
window.sio = sio;
sio.on("trx_device_geo_rcv",function(data) {
    // {
    //     "app_name": "polygon_v1",
    //     "id": "860371050882459",
    //     "type": "geo_notif",
    //     "geoid": "994ff33a-f3af-48a5-ad35-e06550873d95",
    //     "declare": 1
    // }
    // {
    //     "data": {
    //         "id": "994ff33a-f3af-48a5-ad35-e06550873d95",
    //         "ftgeo_name": "PT. Bagus Harapan Tritunggal Office",
    //         "ftaddress": "Jl. Harmoni, Jakarta indonesia",
    //         "fntype": 1,
    //         "fnstatus": 1,
    //         "created_at": "2023-02-26 16:59:28",
    //         "updated_at": "2023-03-09 07:57:48"
    //     }
    // }
    // {
    //     "data": {
    //         "ftdevice_id": "860371050882459",
    //         "ftdevice_name": "Xenxor Made",
    //         "ftasset_id": "B XXX CA",
    //         "ftasset_name": "Motor",
    //         "ftasset_description": "Main Test Device",
    //         "fncategory": 1,
    //         "uuid_customer_id": null,
    //         "fflat": "0",
    //         "fflon": "0",
    //         "ffdirect": "0",
    //         "ffalt": "0",
    //         "fbignition": false,
    //         "ffbattery": "0",
    //         "fnstatus": 1,
    //         "created_at": "2023-02-25 21:04:28",
    //         "updated_at": "2023-03-01 01:34:35",
    //         "uuid_geo_id": "994ff33a-f3af-48a5-ad35-e06550873d95"
    //     }
    // }
    console.log(data);
    var res = JSON.parse(data);
    
    if (res.type === 'geo_notif') {
        var _asset_name,_geo_name;

        axios.get(url + `/info/js/device/${res.id}`).then(res => {
            _asset_name = res.data.data.ftasset_name;
        }).catch(err => {});
        axios.get(url + `/info/js/geo/${res.geoid}`).then(res => {
            _geo_name = res.data.data.ftgeo_name;
        }).catch(err => {});

        console.log(_asset_name,_geo_name)
        if (res.declare == 1) {
            toastr.success(`${_asset_name} <i><b>Enter</b></i> ${_geo_name}`, 'Geo Notification');
        }else{
            toastr.warning(`${_asset_name} <i><b>Exit</b></i> ${_geo_name}`, 'Geo Notification');
        }
    }
});

const offsetTz = new Date().getTimezoneOffset();
window.dtHumanID = function () {
    const tzCode = parseInt(- (offsetTz / 60));
    if (tzCode > 0) {
        return `+${tzCode}`;
    }else{
        return `${tzCode}`;
    }
};
window.dtHumanName = function() {
    return Intl.DateTimeFormat().resolvedOptions().timeZone;
    // return moment.tz.guess();
};
// var visitortime = new Date();
// var visitortimezone = "GMT " + - visitortime.getTimezoneOffset() / 60;
window.dtHumanParse = function(isDateTime) {
    var date = {
        // utc: '2013-10-16T21:31:51',
        utc: isDateTime.toString(),
        offset: offsetTz
    }
    //MM/DD/YYYY h:mm A - am/pm
    //dd Month yyyy - hh:i
    return moment.utc(date.utc).zone(date.offset).format('YYYY-MM-DD HH:mm:ss');
}

var latitude = '-6.22609';
var longitude = '106.833912';
// isNaN(latitude[i])
if(latitude < -127 || latitude > 75){
    console.log("Lat 1 not vaild.");
}

if(longitude < -127 || longitude > 75){
    console.log("Long 1 not vaild.");
}

var reg = new RegExp("^(-?\d+(\.\d+)?),\s*(-?\d+(\.\d+)?)$");


if( reg.exec(latitude) ) {
 //do nothing
} else {
    console.log("LAt 2 not vaild.");
}

if( reg.exec(longitude) ) {
 //do nothing
} else {
    console.log("Long 2 not vaild.");
}

console.log(window.dtHumanID(),window.dtHumanName(),window.dtHumanParse("2023-02-28 02:41:09"));

$(() => {
    // console.log('isJQ')
    
    Site.run();
});
// (function(document, window, $){
//   'use strict';
//   var Site = window.Site;
//   $(document).ready(function(){
//     Site.run();
//   });
// })(document, window, jQuery);