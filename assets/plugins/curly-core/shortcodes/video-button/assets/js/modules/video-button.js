(function ($) {
	'use strict';
	
	var videoButton = {};
	mkdf.modules.videoButton = videoButton;


    videoButton.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).on('load',mkdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
        mkdfElementorVideoButton();
	}


    /**
     * Elementor Team Carousel
     */
    function mkdfElementorVideoButton() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_video_button.default', function () {
                mkdf.modules.common.mkdfPrettyPhoto();
            });
        });
    }
	
})(jQuery);