(function ($) {
	'use strict';
	
	var clientsCarousel = {};
	mkdf.modules.clientsCarousel = clientsCarousel;


	clientsCarousel.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).on('load',mkdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfElementorClientsCarousel();
	}

    /**
     * Elementor
     */
	function mkdfElementorClientsCarousel() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_clients_carousel.default', function () {
				mkdf.modules.common.mkdfOwlSlider();
			});
		});
	}
	
})(jQuery);