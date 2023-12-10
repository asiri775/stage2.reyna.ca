(function ($) {
    'use strict';

    var animationHolder = {};
    mkdf.modules.animationHolder = animationHolder;

    animationHolder.mkdfInitAnimationHolder = mkdfInitAnimationHolder;


    animationHolder.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitAnimationHolder();
    }

    /*
     *	Init animation holder shortcode
     */
    function mkdfInitAnimationHolder() {
        var elements = $('.mkdf-grow-in, .mkdf-fade-in-down, .mkdf-element-from-fade, .mkdf-element-from-left, .mkdf-element-from-right, .mkdf-element-from-top, .mkdf-element-from-bottom, .mkdf-flip-in, .mkdf-x-rotate, .mkdf-z-rotate, .mkdf-y-translate, .mkdf-fade-in, .mkdf-fade-in-left-x-rotate'),
            animationClass,
            animationData,
            animationDelay;

        if (elements.length) {
            elements.each(function () {
                var thisElement = $(this);

                thisElement.appear(function () {
                    animationData = thisElement.data('animation');
                    animationDelay = parseInt(thisElement.data('animation-delay'));

                    if (typeof animationData !== 'undefined' && animationData !== '') {
                        animationClass = animationData;
                        var newClass = animationClass + '-on';

                        setTimeout(function () {
                            thisElement.addClass(newClass);
                        }, animationDelay);
                    }
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

})(jQuery);