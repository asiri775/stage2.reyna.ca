(function ($) {
    'use strict';

    var stackedImages = {};
    mkdf.modules.stackedImages = stackedImages;

    stackedImages.mkdfInitItemShowcase = mkdfInitStackedImages;


    stackedImages.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitStackedImages();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorStackedImages();
    }

    /**
     * Elementor
     */
    function mkdfElementorStackedImages(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_stacked_images.default', function() {
                mkdfInitStackedImages();
            } );
        });
    }

    /**
     * Init item showcase shortcode
     */
    function mkdfInitStackedImages() {
        var stackedImages = $('.mkdf-stacked-images-holder');

        if (stackedImages.length) {
            stackedImages.each(function () {
                var thisStackedImages = $(this),
                    itemImage = thisStackedImages.find('.mkdf-si-images');

                //logic
                thisStackedImages.animate({opacity: 1}, 200);

                setTimeout(function () {
                    thisStackedImages.appear(function () {
                        itemImage.addClass('mkdf-appeared');
                    }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
                }, 100);
            });
        }
    }

})(jQuery);