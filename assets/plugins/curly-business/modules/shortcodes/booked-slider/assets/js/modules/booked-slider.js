(function ($) {
    'use strict';

    var bookedSlider = {};
    mkdf.modules.bookedSlider = bookedSlider;

    bookedSlider.mkdfInitBookedSlider = mkdfInitBookedSlider;
    bookedSlider.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitBookedSlider();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */

    function mkdfOnWindowLoad() {
        mkdfElementorBookedSlider();
    }

    /**
     * Elementor
     */
    function mkdfElementorBookedSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_booked_slider.default', function() {
                mkdfInitBookedSlider();
            } );
        });
    }

    function mkdfInitBookedSlider() {

        var calendar = $('.mkdf-bs-calendar-content');
        var n = 1;

        if (calendar.length) {
            calendar.each(function () {
                var thisCalendar = $(this),
                    side = $(this).hasClass('mkdf-right-position') ? 'right' : 'left',
                    itemClass = 'mkdf-bs-calendar-content' + n,
                    style = '',
                    responsiveStyle = '',
                    laptopWidth = '',
                    laptopTop = '',
                    laptopSide = '',
                    ipadWidthLand = '',
                    ipadTopLand = '',
                    ipadSideLand = '',
                    ipadWidth = '',
                    ipadTop = '',
                    ipadSide = '',
                    mobileWidth = '',
                    mobileTop = '',
                    mobileSide = '';

                $(this).addClass(itemClass);

                if (typeof thisCalendar.data('width-laptop') !== 'undefined' && thisCalendar.data('width-laptop') !== false) {
                    laptopWidth = thisCalendar.data('width-laptop');
                }
                if (typeof thisCalendar.data('top-offset-laptop') !== 'undefined' && thisCalendar.data('top-offset-laptop') !== false) {
                    laptopTop = thisCalendar.data('top-offset-laptop');
                }
                if (typeof thisCalendar.data('side-offset-laptop') !== 'undefined' && thisCalendar.data('side-offset-laptop') !== false) {
                    laptopSide = thisCalendar.data('side-offset-laptop');
                }
                if (typeof thisCalendar.data('width-ipad-landscape') !== 'undefined' && thisCalendar.data('width-ipad-landscape') !== false) {
                    ipadWidthLand = thisCalendar.data('width-ipad-landscape');
                }
                if (typeof thisCalendar.data('top-offset-ipad-landscape') !== 'undefined' && thisCalendar.data('top-offset-ipad-landscape') !== false) {
                    ipadTopLand = thisCalendar.data('top-offset-ipad-landscape');
                }
                if (typeof thisCalendar.data('side-offset-ipad-landscape') !== 'undefined' && thisCalendar.data('side-offset-ipad-landscape') !== false) {
                    ipadSideLand = thisCalendar.data('side-offset-ipad-landscape');
                }
                if (typeof thisCalendar.data('width-ipad') !== 'undefined' && thisCalendar.data('width-ipad') !== false) {
                    ipadWidth = thisCalendar.data('width-ipad');
                }
                if (typeof thisCalendar.data('top-offset-ipad') !== 'undefined' && thisCalendar.data('top-offset-ipad') !== false) {
                    ipadTop = thisCalendar.data('top-offset-ipad');
                }
                if (typeof thisCalendar.data('side-offset-ipad') !== 'undefined' && thisCalendar.data('side-offset-ipad') !== false) {
                    ipadSide = thisCalendar.data('side-offset-ipad');
                }
                if (typeof thisCalendar.data('width-mobile') !== 'undefined' && thisCalendar.data('width-mobile') !== false) {
                    mobileWidth = thisCalendar.data('width-mobile');
                }
                if (typeof thisCalendar.data('top-offset-mobile') !== 'undefined' && thisCalendar.data('top-offset-mobile') !== false) {
                    mobileTop = thisCalendar.data('top-offset-mobile');
                }
                if (typeof thisCalendar.data('side-offset-mobile') !== 'undefined' && thisCalendar.data('side-offset-mobile') !== false) {
                    mobileSide = thisCalendar.data('side-offset-mobile');
                }

                if (laptopWidth.length || laptopTop.length || laptopSide.length || ipadWidthLand.length || ipadTopLand.length || ipadSideLand.length || ipadWidth.length || ipadTop.length || ipadSide.length || mobileWidth.length || mobileTop.length || mobileSide.length) {

                    if (laptopWidth.length) {
                        responsiveStyle += "@media only screen and (max-width: 1280px) {.mkdf-bs-calendar-content." + itemClass + " { width: " + laptopWidth + " !important; } }";
                    }
                    if (laptopTop.length) {
                        responsiveStyle += "@media only screen and (max-width: 1280px) {.mkdf-bs-calendar-content." + itemClass + " { top: " + laptopTop + " !important; } }";
                    }
                    if (laptopSide.length) {
                        responsiveStyle += "@media only screen and (max-width: 1280px) {.mkdf-bs-calendar-content." + itemClass + " { " + side + ": " + laptopSide + " !important; } }";
                    }
                    if (ipadWidthLand.length) {
                        responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-bs-calendar-content." + itemClass + " { width: " + ipadWidthLand + " !important; } }";
                    }
                    if (ipadTopLand.length) {
                        responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-bs-calendar-content." + itemClass + " { top: " + ipadTopLand + " !important; } }";
                    }
                    if (ipadSideLand.length) {
                        responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-bs-calendar-content." + itemClass + " { " + side + ": " + ipadSideLand + " !important; } }";
                    }
                    if (ipadWidth.length) {
                        responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-bs-calendar-content." + itemClass + " { width: " + ipadWidth + " !important; } }";
                    }
                    if (ipadTop.length) {
                        responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-bs-calendar-content." + itemClass + " { top: " + ipadTop + " !important; } }";
                    }
                    if (ipadSide.length) {
                        responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-bs-calendar-content." + itemClass + " { " + side + ": " + ipadSide + " !important; } }";
                    }
                    if (mobileWidth.length) {
                        responsiveStyle += "@media only screen and (max-width: 600px) {.mkdf-bs-calendar-content." + itemClass + " { width: " + mobileWidth + " !important; } }";
                    }
                    if (mobileTop.length) {
                        responsiveStyle += "@media only screen and (max-width: 600px) {.mkdf-bs-calendar-content." + itemClass + " { top: " + mobileTop + " !important; } }";
                    }
                    if (mobileSide.length) {
                        responsiveStyle += "@media only screen and (max-width: 600px) {.mkdf-bs-calendar-content." + itemClass + " { " + side + ": " + mobileSide + " !important; } }";
                    }
                }

                if (responsiveStyle.length) {
                    style = '<style type="text/css" data-type="curly_business_style_shortcodes_custom_css">' + responsiveStyle + '</style>';
                }

                if (style.length) {
                    $('head').append(style);
                }

                n++;
            });
        }
    }

})(jQuery);