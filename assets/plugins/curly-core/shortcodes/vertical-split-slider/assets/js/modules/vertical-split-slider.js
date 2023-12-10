(function ($) {
    'use strict';

    var verticalSplitSlider = {};
    mkdf.modules.verticalSplitSlider = verticalSplitSlider;

    verticalSplitSlider.mkdfInitVerticalSplitSlider = mkdfInitVerticalSplitSlider;


    verticalSplitSlider.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitVerticalSplitSlider();
    }
    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorVerticalSplitSlider();
    }

    /**
     * Elementor
     */
    function mkdfElementorVerticalSplitSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_vertical_split_slider.default', function() {
                mkdfInitVerticalSplitSlider();
            } );
        });
    }
    /*
     **	Vertical Split Slider
     */
    function mkdfInitVerticalSplitSlider() {
        var slider = $('.mkdf-vertical-split-slider');

        if (slider.length) {
            if (mkdf.body.hasClass('mkdf-vss-initialized')) {
                mkdf.body.removeClass('mkdf-vss-initialized');
                $.fn.multiscroll.destroy();
            }

            slider.height(mkdf.windowHeight).animate({opacity: 1}, 300);

            var defaultHeaderStyle = '';
            if (mkdf.body.hasClass('mkdf-light-header')) {
                defaultHeaderStyle = 'light';
            } else if (mkdf.body.hasClass('mkdf-dark-header')) {
                defaultHeaderStyle = 'dark';
            }

            slider.multiscroll({
                scrollingSpeed: 700,
                easing: 'easeInOutQuart',
                navigation: true,
                useAnchorsOnLoad: false,
                sectionSelector: '.mkdf-vss-ms-section',
                leftSelector: '.mkdf-vss-ms-left',
                rightSelector: '.mkdf-vss-ms-right',
                afterRender: function () {
                    mkdfCheckVerticalSplitSectionsForHeaderStyle($('.mkdf-vss-ms-left .mkdf-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
                    mkdf.body.addClass('mkdf-vss-initialized');

                    //prepare html for smaller screens - start //
                    var verticalSplitSliderResponsive = $('<div class="mkdf-vss-responsive"></div>'),
                        leftSide = slider.find('.mkdf-vss-ms-left > div'),
                        rightSide = slider.find('.mkdf-vss-ms-right > div');

                    slider.after(verticalSplitSliderResponsive);

                    for (var i = 0; i < leftSide.length; i++) {
                        verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
                        verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
                    }

                    //prepare google maps clones
                    var googleMapHolder = $('.mkdf-vss-responsive .mkdf-google-map');
                    if (googleMapHolder.length) {
                        googleMapHolder.each(function () {
                            var map = $(this);
                            map.empty();
                            var num = Math.floor((Math.random() * 100000) + 1);
                            map.attr('id', 'mkdf-map-' + num);
                            map.data('unique-id', num);
                        });
                    }

                    var contactForm7 = $('div.wpcf7 > form');
                    if (contactForm7.length) {
                        contactForm7.each(function () {
                            var thisForm = $(this);

                            thisForm.find('.wpcf7-submit').off().on('click', function (e) {
                                e.preventDefault();
                                wpcf7.submit(thisForm);
                            });
                        });
                    }

                    if (typeof mkdf.modules.animationHolder.mkdfInitAnimationHolder === "function") {
                        mkdf.modules.animationHolder.mkdfInitAnimationHolder();
                    }

                    if (typeof mkdf.modules.button.mkdfButton === "function") {
                        mkdf.modules.button.mkdfButton().init();
                    }

                    if (typeof mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle === "function") {
                        mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle();
                    }

                    if (typeof mkdf.modules.googleMap.mkdfShowGoogleMap === "function") {
                        mkdf.modules.googleMap.mkdfShowGoogleMap();
                    }

                    if (typeof mkdf.modules.icon.mkdfIcon === "function") {
                        mkdf.modules.icon.mkdfIcon().init();
                    }

                    if (typeof mkdf.modules.progressBar.mkdfInitProgressBars === "function") {
                        mkdf.modules.progressBar.mkdfInitProgressBars();
                    }
                },
                onLeave: function (index, nextIndex) {
                    mkdfIntiScrollAnimation(slider, nextIndex);
                    mkdfCheckVerticalSplitSectionsForHeaderStyle($($('.mkdf-vss-ms-left .mkdf-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
                }
            });

            if (mkdf.windowWidth <= 1024) {
                $.fn.multiscroll.destroy();
            } else {
                $.fn.multiscroll.build();
            }

            $(window).resize(function () {
                if (mkdf.windowWidth <= 1024) {
                    $.fn.multiscroll.destroy();
                } else {
                    $.fn.multiscroll.build();
                }
            });
        }
    }

    function mkdfIntiScrollAnimation(slider, nextIndex) {

        if (slider.hasClass('mkdf-vss-scrolling-animation')) {

            if (nextIndex > 1 && !slider.hasClass('mkdf-vss-scrolled')) {
                slider.addClass('mkdf-vss-scrolled');
            } else if (nextIndex === 1 && slider.hasClass('mkdf-vss-scrolled')) {
                slider.removeClass('mkdf-vss-scrolled');
            }
        }
    }

    /*
     **	Check slides on load and slide change for header style changing
     */
    function mkdfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
        if (section_header_style !== undefined && section_header_style !== '') {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + default_header_style + '-header');
        } else {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header');
        }
    }

})(jQuery);
