(function ($) {
	'use strict';
	
	var imageWithText = {};
	mkdf.modules.imageWithText = imageWithText;


	imageWithText.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).on('load',mkdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfElementorImageWithText();
	}

    /**
     * Elementor
     */
	function mkdfElementorImageWithText() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_image_with_text.default', function () {
				mkdf.modules.common.mkdfPrettyPhoto();
			});
		});
	}
	
})(jQuery);