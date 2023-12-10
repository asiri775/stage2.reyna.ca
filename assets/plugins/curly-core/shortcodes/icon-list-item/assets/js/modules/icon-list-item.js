(function ($) {
    'use strict';

    var iconListItem = {};
    mkdf.modules.iconListItem = iconListItem;

    iconListItem.mkdfInitIconList = mkdfInitIconList;


    iconListItem.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitIconList().init();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorIconList();
    }

    /**
     * Elementor
     */
    function mkdfElementorIconList(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_icon_list_item.default', function() {
                mkdfInitIconList().init();
            } );
        });
    }

    /**
     * Button object that initializes icon list with animation
     * @type {Function}
     */
    var mkdfInitIconList = function () {
        var iconList = $('.mkdf-animate-list');

        /**
         * Initializes icon list animation
         * @param list current slider
         */
        var iconListInit = function (list) {
            setTimeout(function () {
                list.appear(function () {
                    list.addClass('mkdf-appeared');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            }, 30);
        };

        return {
            init: function () {
                if (iconList.length) {
                    iconList.each(function () {
                        iconListInit($(this));
                    });
                }
            }
        };
    };

})(jQuery);