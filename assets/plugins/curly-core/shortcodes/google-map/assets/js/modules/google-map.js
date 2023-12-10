(function ($) {
    'use strict';

    var googleMap = {};
    mkdf.modules.googleMap = googleMap;

    googleMap.mkdfShowGoogleMap = mkdfShowGoogleMap;


    googleMap.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfShowGoogleMap();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorShowGoogleMap();
    }

    /**
     * Elementor
     */
    function mkdfElementorShowGoogleMap(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_google_map.default', function() {
                mkdfShowGoogleMap();
            } );
        });
    }

    /*
     **	Show Google Map
     */
    function mkdfShowGoogleMap() {
        var googleMap = $('.mkdf-google-map');

        if (googleMap.length) {
            googleMap.each(function () {
                var element = $(this);

                var snazzyMapStyle = false;
                var snazzyMapCode = '';
                if (typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
                    snazzyMapStyle = true;
                    var snazzyMapHolder = element.parent().find('.mkdf-snazzy-map'),
                        snazzyMapCodes = snazzyMapHolder.val();

                    if (snazzyMapHolder.length && snazzyMapCodes.length) {
                        snazzyMapCode = JSON.parse(snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, ''));
                    }
                }

                var customMapStyle;
                if (typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if (typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if (typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if (typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if (typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if (typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if (typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if (typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if (typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if (typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_" + uniqueId;
                var geocoder = "geocoder_" + uniqueId;
                var holderId = "mkdf-map-" + uniqueId;

                mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
            });
        }
    }

    /*
     **	Init Google Map
     */
    function mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

        if (typeof google !== 'object') {
            return;
        }

        var mapStyles = [];
        if (snazzyMapStyle && snazzyMapCode.length) {
            mapStyles = snazzyMapCode;
        } else {
            mapStyles = [
                {
                    stylers: [
                        {hue: color},
                        {saturation: saturation},
                        {lightness: lightness},
                        {gamma: 1}
                    ]
                }
            ];
        }

        var googleMapStyleId;

        if (snazzyMapStyle || customMapStyle === 'yes') {
            googleMapStyleId = 'mkdf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        wheel = wheel === 'yes';

        var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)) {
            height = height + 'px';
        }

        var myOptions = {
            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkdf-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function mkdfInitializeGoogleAddress(data, pin, map, geocoder) {
        if (data === '') {
            return;
        }

        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<div id="bodyContent">' +
            '<p>' + data + '</p>' +
            '</div>' +
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        geocoder.geocode({'address': data}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: pin,
                    title: data.store_title
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });

                google.maps.event.addDomListener(window, 'resize', function () {
                    map.setCenter(results[0].geometry.location);
                });
            }
        });
    }

})(jQuery);