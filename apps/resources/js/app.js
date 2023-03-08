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
window.sio = io("http://110.5.105.26:60011");

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