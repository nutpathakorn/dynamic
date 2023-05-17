/* ------------------------------------------------------------------------------
*
*  # Animated markers
*
*  Specific JS code additions for maps_google_markers.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // If you're adding a number of markers, you may want to
    // drop them on the map consecutively rather than all at once.
    // This example shows how to use setTimeout() to space
    // your markers' animation.


    // Add Berlin coordinates
    var berlin = new google.maps.LatLng(13.757538, 100.504324);

    // Add neighborhoods coordinates
    var neighborhoods = [
        new google.maps.LatLng(13.784885, 100.446988),
        new google.maps.LatLng(13.749166, 100.601148),
        new google.maps.LatLng(13.670832, 100.505341),
        new google.maps.LatLng(13.762198, 100.544152),
        new google.maps.LatLng(13.711516, 100.413353),
        new google.maps.LatLng(13.781535, 100.558238),
        new google.maps.LatLng(13.756207, 100.478920)
    ];


    // Variables
    var markers = [];
    var iterator = 0;
    var map;


    // Initialize
    function initialize() {

        // Options
        var mapOptions = {
            zoom: 12,
            center: berlin
        };

        // Apply options
        map = new google.maps.Map($('.map-marker-animation')[0], mapOptions);
    }


    // Drop markers
    function drop() {
        for (var i = 0; i < neighborhoods.length; i++) {
            setTimeout(function() {
                addMarker();
            }, i * 200);
        }
    }


    // Add markers
    function addMarker() {
        markers.push(new google.maps.Marker({
            position: neighborhoods[iterator],
            map: map,
            draggable: false,
            animation: google.maps.Animation.DROP
        }));
        iterator++;
    }


    // Drop markers on button click
    $('.drop-markers').on('click', function() {
        drop();
    });


    // Initialize map on window load
    google.maps.event.addDomListener(window, 'load', initialize);

});
