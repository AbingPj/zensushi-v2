window._ = require("lodash");
try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");
    require("bootstrap");
    require('admin-lte');
    require('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js');
    window.moment = require('moment');
    require('admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js');
} catch (e) { }


window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

import Echo from "laravel-echo";
window.Pusher = require("pusher-js");
window.Echo = new Echo({
    broadcaster: "pusher",
    key: "8edc97b8507f1e75e12e",
    cluster: "ap1",
    forceTLS: true
});

require("gasparesganga-jquery-loading-overlay/dist/loadingoverlay");

$(function () {
    $("#prodDateTimePicker").datetimepicker({
        maxDate: new Date()
    });
});





