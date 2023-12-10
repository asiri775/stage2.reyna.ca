(function ($) {
    'use strict';

    var portfolio = {};
    mkdf.modules.portfolio = portfolio;

    portfolio.mkdfOnDocumentReady = mkdfOnDocumentReady;
    portfolio.mkdfOnWindowLoad = mkdfOnWindowLoad;
    portfolio.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        initPortfolioSingleMasonry();
    }

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        initPortfolioSingleMasonry();
    }

    var mkdfPortfolioSingleFollow = function () {
        var info = $('.mkdf-follow-portfolio-info .mkdf-portfolio-single-holder .mkdf-ps-info-sticky-holder');

        if (info.length) {
            var infoHolder = info.parent(),
                infoHolderOffset = infoHolder.offset().top,
                infoHolderHeight = infoHolder.height(),
                mediaHolder = $('.mkdf-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .mkdf-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0,
                constant = 30; //30 to prevent mispositioned
        }

        var infoHolderPosition = function () {
            if (info.length && mediaHolderHeight >= infoHolderHeight) {
                if (mkdf.scroll >= infoHolderOffset - headerHeight - mkdfGlobalVars.vars.mkdfAddForAdminBar - constant) {
                    var marginTop = mkdf.scroll - infoHolderOffset + mkdfGlobalVars.vars.mkdfAddForAdminBar + headerHeight + constant;
                    // if scroll is initially positioned below mediaHolderHeight
                    if (marginTop + infoHolderHeight > mediaHolderHeight) {
                        marginTop = mediaHolderHeight - infoHolderHeight + constant;
                    }
                    info.stop().animate({
                        marginTop: marginTop
                    });
                }
            }
        };

        var recalculateInfoHolderPosition = function () {
            if (info.length && mediaHolderHeight >= infoHolderHeight) {
                //Calculate header height if header appears
                if (mkdf.scroll > 0 && header.length) {
                    headerHeight = header.height();
                }

                if (mkdf.scroll >= infoHolderOffset - headerHeight - mkdfGlobalVars.vars.mkdfAddForAdminBar - constant) {
                    if (mkdf.scroll + headerHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar + constant + infoHolderHeight < infoHolderOffset + mediaHolderHeight) {
                        info.stop().animate({
                            marginTop: (mkdf.scroll - infoHolderOffset + mkdfGlobalVars.vars.mkdfAddForAdminBar + headerHeight + constant)
                        });
                        //Reset header height
                        headerHeight = 0;
                    } else {
                        info.stop().animate({
                            marginTop: mediaHolderHeight - infoHolderHeight
                        });
                    }
                } else {
                    info.stop().animate({
                        marginTop: 0
                    });
                }
            }
        };

        return {
            init: function () {
                infoHolderPosition();
                $(window).scroll(function () {
                    recalculateInfoHolderPosition();
                });
            }
        };
    };

    function initPortfolioSingleMasonry() {
        var masonryHolder = $('.mkdf-portfolio-single-holder .mkdf-ps-masonry-images'),
            masonry = masonryHolder.children();

        if (masonry.length) {
            var size = masonry.find('.mkdf-ps-grid-sizer').width(),
                isFixedEnabled = masonry.find('.mkdf-ps-image[class*="mkdf-masonry-size-"]').length > 0;

            masonry.waitForImages(function () {
                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: '.mkdf-ps-image',
                    percentPosition: true,
                    packery: {
                        gutter: '.mkdf-ps-grid-gutter',
                        columnWidth: '.mkdf-ps-grid-sizer'
                    }
                });

                mkdf.modules.common.setFixedImageProportionSize(masonry, masonry.find('.mkdf-ps-image'), size, isFixedEnabled);

                masonry.isotope('layout').css('opacity', '1');
            });
        }
    }

})(jQuery);