(function($) {
    'use strict';

    var singleImage = {};
    mkdf.modules.singleImage = singleImage;

    singleImage.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
    }
    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorSingleImage();
    }

    /**
     * Elementor
     */
    function mkdfElementorSingleImage(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_single_image.default', function() {
                mkdf.modules.common.mkdfPrettyPhoto();
            } );
        });
    }

})(jQuery);