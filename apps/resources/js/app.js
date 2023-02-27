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
window.sio = io("http://110.5.105.26:6001");

var offset = new Date().getTimezoneOffset();

console.log(offset, moment());

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