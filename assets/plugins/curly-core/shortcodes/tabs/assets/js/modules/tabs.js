(function ($) {
    'use strict';

    var tabs = {};
    mkdf.modules.tabs = tabs;

    tabs.mkdfInitTabs = mkdfInitTabs;


    tabs.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitTabs();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorInitTabs();
    }

    /**
     * Elementor
     */
    function mkdfElementorInitTabs(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_tabs.default', function() {
                mkdfInitTabs();
            } );
        });
    }

    /*
     **	Init tabs shortcode
     */
    function mkdfInitTabs() {
        var tabs = $('.mkdf-tabs');

        if (tabs.length) {
            tabs.each(function () {
                var thisTabs = $(this);

                thisTabs.children('.mkdf-tab-container').each(function (index) {
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.mkdf-tabs-nav li:nth-child(' + index + ') a'),
                        navLink = navItem.attr('href');

                    link = '#' + link;

                    if (link.indexOf(navLink) > -1) {
                        navItem.attr('href', link);
                    }
                });

                thisTabs.tabs();

                $('.mkdf-tabs a.mkdf-external-link').off('click');
            });
        }
    }

})(jQuery);