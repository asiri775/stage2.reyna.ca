(function ($) {
    'use strict';

    var sectionTitle = {};
    mkdf.modules.sectionTitle = sectionTitle;

    sectionTitle.mkdfInitSectionTitle = mkdfInitSectionTitle;

    sectionTitle.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitSectionTitle();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorSectionTitle();
    }

    /**
     * Elementor
     */
    function mkdfElementorSectionTitle(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_section_title.default', function() {
                mkdfInitSectionTitle();
            } );
        });
    }

    function mkdfInitSectionTitle() {
        var holder = $('.mkdf-st-background-text');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    fontSize = '',
                    horizontalOffset = '',
                    verticalOffset = '',
                    selector = '',
                    customStyle = '',
                    style = '';

                if (typeof $(this).data('font-size') !== 'undefined') {
                    fontSize = $(this).data('font-size');
                }

                if (typeof $(this).data('horizontal-offset') !== 'undefined') {
                    horizontalOffset = $(this).data('horizontal-offset');
                }

                if (typeof $(this).data('vertical-offset') !== 'undefined') {
                    verticalOffset = $(this).data('vertical-offset');
                }

                if (fontSize.length || horizontalOffset.length || verticalOffset.length) {
                    selector = '#' + $(this).attr('id');

                    if (fontSize.length) {
                        customStyle += 'font-size:' + fontSize + '!important;';
                    }

                    if (horizontalOffset.length) {
                        customStyle += 'left:' + horizontalOffset + '!important;';
                    }

                    if (verticalOffset.length) {
                        customStyle += 'top:' + verticalOffset + '!important;';
                    }
                }

                if (customStyle.length) {
                    style = '<style type="text/css">@media(max-width:1366px) and (min-width:769px){' + selector + '{' + customStyle + '}}</style>';
                }

                thisHolder.appear(function(){ 
                    thisHolder.addClass('mkdf-background-text-appeared');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

                if (style.length) {
                    $('head').append(style);
                }
            });
        }
    }

})(jQuery);