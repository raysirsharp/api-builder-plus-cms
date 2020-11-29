// window._ = require('lodash');

try {
    // bootstrap & dependencies
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    // Sweet alert 2
    window.Swal = require('sweetalert2');
} catch (e) {}



