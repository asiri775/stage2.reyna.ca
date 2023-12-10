(function ($) {
    'use strict';

    var progressBar = {};
    mkdf.modules.progressBar = progressBar;

    progressBar.mkdfInitProgressBars = mkdfInitProgressBars;


    progressBar.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitProgressBars();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorProgressBars();
    }

    /**
     * Elementor
     */
    function mkdfElementorProgressBars(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_progress_bar.default', function() {
                mkdfInitProgressBars();
            } );
        });
    }

    /*
     **	Horizontal progress bars shortcode
     */
    function mkdfInitProgressBars() {
        var progressBar = $('.mkdf-progress-bar');

        if (progressBar.length) {
            progressBar.each(function () {
                var thisBar = $(this),
                    thisBarContent = thisBar.find('.mkdf-pb-content'),
                    percentage = thisBarContent.data('percentage');

                thisBar.appear(function () {
                    mkdfInitToCounterProgressBar(thisBar, percentage);

                    thisBarContent.css('width', '0%');
                    thisBarContent.animate({'width': percentage + '%'}, 2000);
                });
            });
        }
    }

    /*
     **	Counter for horizontal progress bars percent from zero to defined percent
     */
    function mkdfInitToCounterProgressBar(progressBar, $percentage) {
        var percentage = parseFloat($percentage),
            percent = progressBar.find('.mkdf-pb-percent');

        if (percent.length) {
            percent.each(function () {
                var thisPercent = $(this);
                thisPercent.css('opacity', '1');

                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 2000,
                    refreshInterval: 50
                });
            });
        }
    }

})(jQuery);