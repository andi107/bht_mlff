import './bootstrap';
// import './global/vendor/popper-js/umd/popper.min.js';
import $ from 'jquery';
window.jQuery = $;
import 'popper.js';

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