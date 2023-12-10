(function ($) {
    'use strict';

    var iconWithText = {};
    mkdf.modules.iconWithText = iconWithText;

    iconWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
    }

    /**
    All functions to be called on $(window).on('load',) should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorIconWithText();
    }

    /**
     * Elementor
     */
    function mkdfElementorIconWithText(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_icon_with_text.default', function() {
                mkdf.modules.icon.mkdfIcon().init();
            } );
        });
    }

})(jQuery);