(function ($) {
    'use strict';

    var banner = {};
    mkdf.modules.banner = banner;

    banner.mkdfInitBanner = mkdfInitBanner;


    banner.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitBanner();
    }

    /**
    All functions to be called on $(window).on('load',) should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorBanner();
    }

    /**
     * Elementor
     */
    function mkdfElementorBanner(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_banner.default', function() {
                mkdfInitBanner();
            } );
        });
    }

    /**
     * Banner Shortcode
     */
    function mkdfInitBanner() {
        var bannerHolder = $('.mkdf-banner-holder');

        if (bannerHolder.length) {
            bannerHolder.each(function () {
                $(this).css('height', $(this).width());
            });
        }
    }

})(jQuery);