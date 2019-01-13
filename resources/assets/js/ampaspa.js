$(document).ready(function () {
     //  Alerts
    $('div.alert').not('.alert-important').delay(3000).fadeOut(1000);
    // Popovers
    $('[data-toggle="popover"]').popover({
        "placement": "top"
    });
})
