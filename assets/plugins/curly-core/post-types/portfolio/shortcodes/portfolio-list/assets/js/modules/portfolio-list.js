(function ($) {
    'use strict';

    var portfolioList = {};
    mkdf.modules.portfolioList = portfolioList;

    portfolioList.mkdfOnDocumentReady = mkdfOnDocumentReady;
    portfolioList.mkdfOnWindowLoad = mkdfOnWindowLoad;
    portfolioList.mkdfOnWindowResize = mkdfOnWindowResize;
    portfolioList.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {

    }

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitPortfolioMasonry();
        mkdfInitPortfolioFilter();
        mkdfInitPortfolioListAnimation();
        mkdfInitPortfolioPagination().init();
        mkdfElementorPortfolioList();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
        mkdfInitPortfolioPagination().scroll();
    }
    /**
     * Elementor
     */
    function mkdfElementorPortfolioList(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_portfolio_list.default', function() {
                mkdfInitPortfolioMasonry();
                mkdfInitPortfolioFilter();
                mkdfInitPortfolioListAnimation();
                mkdfInitPortfolioPagination().init();
            } );
        });
    }
    /**
     * Initializes portfolio list article animation
     */
    function mkdfInitPortfolioListAnimation() {
        var portList = $('.mkdf-portfolio-list-holder.mkdf-pl-has-animation');

        if (portList.length) {
            portList.each(function () {
                var thisPortList = $(this).children('.mkdf-pl-inner');

                thisPortList.children('article').each(function (l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function () {
                        thisArticle.addClass('mkdf-item-show');

                        setTimeout(function () {
                            thisArticle.addClass('mkdf-item-shown');
                        }, 1000);
                    }, {accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function mkdfInitPortfolioMasonry() {
        var holder = $('.mkdf-portfolio-list-holder.mkdf-pl-masonry');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    masonry = thisHolder.children('.mkdf-pl-inner'),
                    size = thisHolder.find('.mkdf-pl-grid-sizer').width();

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.mkdf-pl-grid-gutter',
                        columnWidth: '.mkdf-pl-grid-sizer'
                    }
                });

                mkdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), size);

                setTimeout(function () {
                    mkdf.modules.common.mkdfInitParallax();
                }, 600);

                masonry.isotope('layout').css('opacity', '1');
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function mkdfInitPortfolioFilter() {
        var filterHolder = $('.mkdf-portfolio-list-holder .mkdf-pl-filter-holder');

        if (filterHolder.length) {
            filterHolder.each(function () {
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.mkdf-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.mkdf-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('mkdf-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.mkdf-pl-filter:first').addClass('mkdf-pl-current');

                if (thisPortListHolder.hasClass('mkdf-pl-gallery')) {
                    thisPortListInner.isotope();
                }

                thisFilterHolder.find('.mkdf-pl-filter').on('click', function () {
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.mkdf-pl-filter').removeClass('mkdf-pl-current');
                    thisFilter.addClass('mkdf-pl-current');

                    if (portListHasLoadMore && !portListHasArticles && filterValue.length) {
                        mkdfInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        filterValue = filterValue.length === 0 ? '*' : filterValue;

                        thisFilterHolder.parent().children('.mkdf-pl-inner').isotope({filter: filterValue});
                        mkdf.modules.common.mkdfInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function mkdfInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.mkdf-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
            ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'curly_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.mkdf-pl-loading');

        if (nextPage <= maxNumPages) {
            loadingItem.addClass('mkdf-showing mkdf-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if (portListHasArticles) {
                            setTimeout(function () {
                                mkdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.mkdf-pl-grid-sizer').width());
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('mkdf-showing mkdf-filter-trigger');

                                setTimeout(function () {
                                    thisPortListInner.css('opacity', '1');
                                    mkdfInitPortfolioListAnimation();
                                    mkdf.modules.common.mkdfInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('mkdf-showing mkdf-filter-trigger');
                            mkdfInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }

    /**
     * Initializes portfolio pagination functions
     */
    function mkdfInitPortfolioPagination() {
        var portList = $('.mkdf-portfolio-list-holder');

        var initStandardPagination = function (thisPortList) {
            var standardLink = thisPortList.find('.mkdf-pl-standard-pagination li');

            if (standardLink.length) {
                standardLink.each(function () {
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisPortList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function (thisPortList) {
            var loadMoreButton = thisPortList.find('.mkdf-pl-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisPortList);
            });
        };

        var initInifiteScrollPagination = function (thisPortList) {
            var portListHeight = thisPortList.outerHeight(),
                portListTopOffest = thisPortList.offset().top,
                portListPosition = portListHeight + portListTopOffest - mkdfGlobalVars.vars.mkdfAddForAdminBar;

            if (!thisPortList.hasClass('mkdf-pl-infinite-scroll-started') && mkdf.scroll + mkdf.windowHeight > portListPosition) {
                initMainPagFunctionality(thisPortList);
            }
        };

        var initMainPagFunctionality = function (thisPortList, pagedLink) {
            var thisPortListInner = thisPortList.find('.mkdf-pl-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
                maxNumPages = thisPortList.data('max-num-pages');
            }

            if (thisPortList.hasClass('mkdf-pl-pag-standard')) {
                thisPortList.data('next-page', pagedLink);
            }

            if (thisPortList.hasClass('mkdf-pl-pag-infinite-scroll')) {
                thisPortList.addClass('mkdf-pl-infinite-scroll-started');
            }

            var loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisPortList),
                loadingItem = thisPortList.find('.mkdf-pl-loading');

            nextPage = loadMoreDatta.nextPage;

            if (nextPage <= maxNumPages || maxNumPages === 0) {
                if (thisPortList.hasClass('mkdf-pl-pag-standard')) {
                    loadingItem.addClass('mkdf-showing mkdf-standard-pag-trigger');
                    thisPortList.addClass('mkdf-pl-pag-standard-animate');
                } else {
                    loadingItem.addClass('mkdf-showing');
                }

                var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'curly_core_portfolio_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        if (!thisPortList.hasClass('mkdf-pl-pag-standard')) {
                            nextPage++;
                        }

                        thisPortList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        if (thisPortList.hasClass('mkdf-pl-pag-standard')) {
                            mkdfInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);

                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('mkdf-pl-masonry')) {
                                    mkdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                } else if (thisPortList.hasClass('mkdf-pl-gallery') && thisPortList.hasClass('mkdf-pl-has-filter')) {
                                    mkdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                } else {
                                    mkdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                }
                            });
                        } else {
                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('mkdf-pl-masonry')) {
                                    if (pagedLink == 1) {
                                        mkdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        mkdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
                                } else if (thisPortList.hasClass('mkdf-pl-gallery') && thisPortList.hasClass('mkdf-pl-has-filter') && pagedLink != 1) {
                                    mkdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                } else {
                                    if (pagedLink == 1) {
                                        mkdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        mkdfInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
                                }
                            });
                        }

                        if (thisPortList.hasClass('mkdf-pl-infinite-scroll-started')) {
                            thisPortList.removeClass('mkdf-pl-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisPortList.find('.mkdf-pl-load-more-holder').hide();
            }
        };

        var mkdfInitStandardPaginationLinkChanges = function (thisPortList, maxNumPages, nextPage) {
            var standardPagHolder = thisPortList.find('.mkdf-pl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.mkdf-pl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.mkdf-pl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.mkdf-pl-pag-next a');

            standardPagNumericItem.removeClass('mkdf-pl-pag-active');
            standardPagNumericItem.eq(nextPage - 1).addClass('mkdf-pl-pag-active');

            standardPagPrevItem.data('paged', nextPage - 1);
            standardPagNextItem.data('paged', nextPage + 1);

            if (nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if (nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var mkdfInitHtmlIsotopeNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
            mkdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.mkdf-pl-grid-sizer').width());
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            thisPortList.removeClass('mkdf-pl-pag-standard-animate');

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                mkdfInitPortfolioListAnimation();
                mkdf.modules.common.mkdfInitParallax();
                mkdf.modules.common.mkdfPrettyPhoto();
            }, 600);
        };

        var mkdfInitHtmlGalleryNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            thisPortList.removeClass('mkdf-pl-pag-standard-animate');
            thisPortListInner.html(responseHtml);
            mkdfInitPortfolioListAnimation();
            mkdf.modules.common.mkdfInitParallax();
            mkdf.modules.common.mkdfPrettyPhoto();
        };

        var mkdfInitAppendIsotopeNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
            mkdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.mkdf-pl-grid-sizer').width());
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing');

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                mkdfInitPortfolioListAnimation();
                mkdf.modules.common.mkdfInitParallax();
                mkdf.modules.common.mkdfPrettyPhoto();
            }, 600);
        };

        var mkdfInitAppendGalleryNewContent = function (thisPortListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('mkdf-showing');
            thisPortListInner.append(responseHtml);
            mkdfInitPortfolioListAnimation();
            mkdf.modules.common.mkdfInitParallax();
            mkdf.modules.common.mkdfPrettyPhoto();
        };

        return {
            init: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('mkdf-pl-pag-standard')) {
                            initStandardPagination(thisPortList);
                        }

                        if (thisPortList.hasClass('mkdf-pl-pag-load-more')) {
                            initLoadMorePagination(thisPortList);
                        }

                        if (thisPortList.hasClass('mkdf-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            },
            scroll: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('mkdf-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            },
            getMainPagFunction: function (thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
        };
    }

})(jQuery);