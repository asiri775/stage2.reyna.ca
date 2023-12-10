(function ($) {
    'use strict';

    var accordions = {};
    mkdf.modules.accordions = accordions;

    accordions.mkdfInitAccordions = mkdfInitAccordions;


    accordions.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitAccordions();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */

    function mkdfOnWindowLoad() {
        mkdfElementorAccordions();
    }

    /**
     * Elementor
     */
    function mkdfElementorAccordions(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_accordion.default', function() {
                mkdfInitAccordions();
            } );
        });
    }

    /**
     * Init accordions shortcode
     */
    function mkdfInitAccordions() {
        var accordion = $('.mkdf-accordion-holder');

        if (accordion.length) {
            accordion.each(function () {
                var thisAccordion = $(this);

                if (thisAccordion.hasClass('mkdf-accordion')) {
                    thisAccordion.accordion({
                        animate: "swing",
                        collapsible: true,
                        active: 0,
                        icons: "",
                        heightStyle: "content"
                    });
                }

                if (thisAccordion.hasClass('mkdf-toggle')) {
                    var toggleAccordion = $(this),
                        toggleAccordionTitle = toggleAccordion.find('.mkdf-accordion-title'),
                        toggleAccordionContent = toggleAccordionTitle.next();

                    toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
                    toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
                    toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

                    toggleAccordionTitle.each(function () {
                        var thisTitle = $(this);

                        thisTitle.on('mouseenter mouseleave',function () {
                            thisTitle.toggleClass("ui-state-hover");
                        });

                        thisTitle.on('click', function () {
                            thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
                            thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
                        });
                    });
                }
            });
        }
    }

})(jQuery);