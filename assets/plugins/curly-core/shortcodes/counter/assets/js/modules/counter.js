(function ($) {
    'use strict';

    var counter = {};
    mkdf.modules.counter = counter;

    counter.mkdfInitCounter = mkdfInitCounter;


    counter.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitCounter();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */

    function mkdfOnWindowLoad() {
        mkdfElementorCounter();
    }

    /**
     * Elementor
     */
    function mkdfElementorCounter(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_counter.default', function() {
                mkdfInitCounter();
            } );
        });
    }

    /**
     * Counter Shortcode
     */
    function mkdfInitCounter() {
        var counterHolder = $('.mkdf-counter-holder');

        if (counterHolder.length) {
            counterHolder.each(function () {
                var thisCounterHolder = $(this),
                    thisCounter = thisCounterHolder.find('.mkdf-counter');

                thisCounterHolder.appear(function () {
                    thisCounterHolder.css('opacity', '1');

                    //Counter zero type
                    if (thisCounter.hasClass('mkdf-zero-counter')) {
                        var max = parseFloat(thisCounter.text());
                        thisCounter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        thisCounter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

})(jQuery);