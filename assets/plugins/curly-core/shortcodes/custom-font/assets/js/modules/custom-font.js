(function ($) {
    'use strict';

    var customFont = {};
    mkdf.modules.customFont = customFont;

    customFont.mkdfCustomFontResize = mkdfCustomFontResize;
    customFont.mkdfCustomFontTypeOut = mkdfCustomFontTypeOut;


    customFont.mkdfOnDocumentReady = mkdfOnDocumentReady;
    customFont.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfCustomFontResize();
    }

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfCustomFontTypeOut();
        mkdfElementorCustomFont();
    }

    /**
     * Elementor
     */
    function mkdfElementorCustomFont(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_custom_font.default', function() {
                mkdfCustomFontResize();
                mkdfCustomFontTypeOut();
            } );
        });
    }

    /*
     **	Custom Font resizing style
     */
    function mkdfCustomFontResize() {
        var holder = $('.mkdf-custom-font-holder');

        if (holder.length) {
            holder.each(function () {
                var thisItem = $(this),
                    itemClass = '',
                    smallLaptopStyle = '',
                    ipadLandscapeStyle = '',
                    ipadPortraitStyle = '',
                    mobileLandscapeStyle = '',
                    style = '',
                    responsiveStyle = '';

                if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
                    itemClass = thisItem.data('item-class');
                }

                if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
                    smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
                }
                if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
                    ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
                }
                if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
                    ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
                }
                if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
                    mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
                }

                if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
                    smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
                }
                if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
                    ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
                }
                if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
                    ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
                }
                if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
                    mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
                }

                if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

                    if (smallLaptopStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
                    }
                    if (ipadLandscapeStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
                    }
                    if (ipadPortraitStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
                    }
                    if (mobileLandscapeStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
                    }
                }

                if (responsiveStyle.length) {
                    style = '<style type="text/css">' + responsiveStyle + '</style>';
                }

                if (style.length) {
                    $('head').append(style);
                }
            });
        }
    }

    /*
     * Init Type out functionality for Custom Font shortcode
     */
    function mkdfCustomFontTypeOut() {
        var mkdfTyped = $('.mkdf-cf-typed');

        if (mkdfTyped.length) {
            mkdfTyped.each(function () {

                //vars
                var thisTyped = $(this),
                    typedWrap = thisTyped.parent('.mkdf-cf-typed-wrap'),
                    customFontHolder = typedWrap.parent('.mkdf-custom-font-holder'),
                    $strings         = typedWrap.data( 'strings' );

                var options = {
                    strings: $strings,
                    typeSpeed: 90,
                    backDelay: 700,
                    loop: true,
                    contentType: 'text',
                    loopCount: false,
                    cursorChar: '_'
                };

                customFontHolder.appear(
                    function () {

                        if ( ! thisTyped.hasClass( 'qodef--initialized' ) ) {

                            var typed = new Typed(
                                thisTyped[0],
                                options
                            );
                            thisTyped.addClass( 'qodef--initialized' );
                        }

                    },
                    { accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount }
                );
            });
        }
    }

})(jQuery);