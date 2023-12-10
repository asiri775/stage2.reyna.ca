(function ($) {
    'use strict';

    var testimonialsImagePagination = {};
    mkdf.modules.testimonialsImagePagination = testimonialsImagePagination;

    testimonialsImagePagination.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfTestimonialsImagePagination();
    }

    /**
    All functions to be called on $(window).on('load',) should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorTestimonialsImagePagination();
    }

    /**
     * Elementor
     */
    function mkdfElementorTestimonialsImagePagination(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_testimonials.default', function() {
                mkdfTestimonialsImagePagination();
            } );
        });
    }

    /**
     * Init Owl Carousel
     */
    function mkdfTestimonialsImagePagination() {
        var sliders = $('.mkdf-testimonials-image-pagination-inner');

        if (sliders.length) {
            sliders.each(function () {
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = false,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 500,
                    margin = 0,
                    stagePadding = 0,
                    center = false,
                    autoWidth = false,
                    animateInClass = false, // keyframe css animation
                    animateOutClass = false, // keyframe css animation
                    navigation = true,
                    pagination = false,
                    drag = true,
                    sliderDataHolder = slider;

                if (sliderDataHolder.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
                    sliderSpeed = sliderDataHolder.data('slider-speed');
                }
                if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
                }
                if (sliderDataHolder.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
                    animateInClass = sliderDataHolder.data('slider-animate-in');
                }
                if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
                }
                if (sliderDataHolder.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (sliderDataHolder.data('enable-pagination') === 'yes') {
                    pagination = true;
                }

                if (navigation && pagination) {
                    slider.addClass('mkdf-slider-has-both-nav');
                }

                if (pagination) {
                    var dotsContainer = '#mkdf-testimonial-pagination';
                    $('.mkdf-tsp-item').on('click', function () {
                        slider.trigger('to.owl.carousel', [$(this).index(), 300]);
                    });
                }

                if (slideItemsNumber <= 1) {
                    loop = false;
                    autoplay = false;
                    navigation = false;
                    pagination = false;
                }

                slider.waitForImages(function () {
                    $(this).owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayHoverPause: autoplayHoverPause,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        margin: margin,
                        stagePadding: stagePadding,
                        center: center,
                        autoWidth: autoWidth,
                        animateIn: animateInClass,
                        animateOut: animateOutClass,
                        dots: pagination,
                        dotsContainer: dotsContainer,
                        nav: navigation,
                        drag: drag,
                        callbacks: true,
                        navText: [
                            '<span class="mkdf-prev-icon ion-chevron-left"></span>',
                            '<span class="mkdf-next-icon ion-chevron-right"></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        },
                        onDrag: function (e) {
                            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
                                var sliderIsMoving = e.isTrigger > 0;

                                if (sliderIsMoving) {
                                    slider.addClass('mkdf-slider-is-moving');
                                }
                            }
                        },
                        onDragged: function () {
                            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout') && slider.hasClass('mkdf-slider-is-moving')) {

                                setTimeout(function () {
                                    slider.removeClass('mkdf-slider-is-moving');
                                }, 500);
                            }
                        }
                    });

                });
            });
        }
    }

})(jQuery);