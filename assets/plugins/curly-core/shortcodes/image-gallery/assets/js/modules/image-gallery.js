(function ($) {
    'use strict';

    var imageGallery = {};
    mkdf.modules.imageGallery = imageGallery;

    imageGallery.mkdfInitImageGalleryMasonry = mkdfInitImageGalleryMasonry;


    imageGallery.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).on('load',mkdfOnWindowLoad);

    /*
     ** All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitImageGalleryMasonry();
        mkdfElementorImageGallery();
    }

    /**
     * Elementor
     */
    function mkdfElementorImageGallery() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_image_gallery.default', function () {
                mkdfInitImageGalleryMasonry();
                mkdf.modules.common.mkdfOwlSlider();
                mkdf.modules.common.mkdfPrettyPhoto();
            });
        });
    }
    /*
     ** Init Image Gallery shortcode - Masonry layout
     */
    function mkdfInitImageGalleryMasonry() {
        var holder = $('.mkdf-image-gallery.mkdf-ig-masonry-type');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    masonry = thisHolder.find('.mkdf-ig-masonry');

                masonry.waitForImages(function () {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: '.mkdf-ig-image',
                        percentPosition: true,
                        packery: {
                            gutter: '.mkdf-ig-grid-gutter',
                            columnWidth: '.mkdf-ig-grid-sizer'
                        }
                    });

                    setTimeout(function () {
                        masonry.isotope('layout');
                        mkdf.modules.common.mkdfInitParallax();
                    }, 800);

                    masonry.css('opacity', '1');
                });
            });
        }
    }

})(jQuery);