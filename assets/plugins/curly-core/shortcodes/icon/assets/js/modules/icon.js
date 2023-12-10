(function ($) {
    'use strict';

    var icon = {};
    mkdf.modules.icon = icon;

    icon.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfIcon().init();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorIcon();
    }

    /**
     * Elementor
     */
    function mkdfElementorIcon(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_icon.default', function() {
                mkdfIcon().init();
            } );
        });
    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfIcon = function () {
        var icons = $('.mkdf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function (icon) {
            if (icon.hasClass('mkdf-icon-animation')) {
                icon.appear(function () {
                    icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkdf-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function (icon) {
            if (typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function (event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if (hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function (icon) {
            if (typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function (event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('borderTopColor');

                if (hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });
                }
            }
        };
    };
    icon.mkdfIcon = mkdfIcon;
})(jQuery);