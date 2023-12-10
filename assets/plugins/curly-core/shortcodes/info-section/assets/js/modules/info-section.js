(function ($) {
    'use strict';

    var infoSection = {};
    mkdf.modules.infoSection = infoSection;

    infoSection.mkdfInitInfoSection = mkdfInitInfoSection;

    infoSection.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitInfoSection();
    }

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorInfoSection();
    }

    /**
     * Elementor
     */
    function mkdfElementorInfoSection() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_info_section.default', function () {
                mkdfInitInfoSection();
            });
        });
    }

    function mkdfInitInfoSection() {
        var holder = $('.mkdf-is-background-text');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    fontSize = '',
                    selector = '',
                    customStyle1 = '',
                    customStyle2 = '',
                    style = '';

                if (typeof $(this).data('font-size') !== 'undefined') {
                    fontSize = $(this).data('font-size');
                }

                if (fontSize !== '') {
                    selector = '#' + $(this).attr('id');

                    if (fontSize !== '') {
                        customStyle1 += 'font-size:' + fontSize + 'px !important;';
                        customStyle2 += 'padding-top:' + (fontSize / 2) + 'px !important';
                    }
                }

                if (customStyle1.length) {
                    style = '<style type="text/css">@media(max-width:1366px) and (min-width:1025px){' +
                        '' + selector + '{' + customStyle1 + '}' +
                        '' + selector + ' + div {' + customStyle2 + '}' +
                        '}</style>';
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