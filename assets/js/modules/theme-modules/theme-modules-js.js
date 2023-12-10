(function ($) {
    "use strict";

    var blog = {};
    mkdf.modules.blog = blog;

    blog.mkdfOnDocumentReady = mkdfOnDocumentReady;
    blog.mkdfOnWindowLoad = mkdfOnWindowLoad;
    blog.mkdfOnWindowResize = mkdfOnWindowResize;
    blog.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitAudioPlayer();
        mkdfInitBlogMasonry();
    }

    /* 
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitBlogPagination().init();
    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitBlogMasonry();
    }

    /* 
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
        mkdfInitBlogPagination().scroll();
    }

    /**
     * Init audio player for Blog list and single pages
     */
    function mkdfInitAudioPlayer() {
        var players = $('audio.mkdf-blog-audio');

        if (players.length) {
            players.mediaelementplayer({
                audioWidth: '100%'
            });
        }
    }

    /**
     * Init Blog Masonry Layout
     */
    function mkdfInitBlogMasonry() {
        var holder = $('.mkdf-blog-holder.mkdf-blog-type-masonry');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    masonry = thisHolder.children('.mkdf-blog-holder-inner'),
                    size = thisHolder.find('.mkdf-blog-masonry-grid-sizer').width();

                masonry.waitForImages(function () {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: 'article',
                        percentPosition: true,
                        packery: {
                            gutter: '.mkdf-blog-masonry-grid-gutter',
                            columnWidth: '.mkdf-blog-masonry-grid-sizer'
                        }
                    });

                    mkdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), size);

                    masonry.isotope('layout').css('opacity', '1');
                });
            });
        }
    }

    /**
     * Initializes blog pagination functions
     */
    function mkdfInitBlogPagination() {
        var holder = $('.mkdf-blog-holder');

        var initLoadMorePagination = function (thisHolder) {
            var loadMoreButton = thisHolder.find('.mkdf-blog-pag-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function (thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - mkdfGlobalVars.vars.mkdfAddForAdminBar;

            if (!thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll-started') && mkdf.scroll + mkdf.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function (thisHolder) {
            var thisHolderInner = thisHolder.children('.mkdf-blog-holder-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if (thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll')) {
                thisHolder.addClass('mkdf-blog-pagination-infinite-scroll-started');
            }

            var loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.mkdf-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            if (nextPage <= maxNumPages) {
                loadingItem.addClass('mkdf-showing');

                var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'curly_mkdf_blog_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        nextPage++;

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        thisHolder.waitForImages(function () {
                            if (thisHolder.hasClass('mkdf-blog-type-masonry')) {
                                mkdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                mkdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), thisHolderInner.find('.mkdf-blog-masonry-grid-sizer').width());
                            } else {
                                mkdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
                            }

                            setTimeout(function () {
                                mkdfInitAudioPlayer();
                                mkdf.modules.common.mkdfOwlSlider();
                                mkdf.modules.common.mkdfFluidVideo();
                                mkdf.modules.common.mkdfInitSelfHostedVideoPlayer();
                                mkdf.modules.common.mkdfSelfHostedVideoSize();

                                if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                                    mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                                }

                                // Trigger event.
                                $(document.body).trigger('blog_list_load_more_trigger');

                            }, 400);
                        });

                        if (thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll-started')) {
                            thisHolder.removeClass('mkdf-blog-pagination-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisHolder.find('.mkdf-blog-pag-load-more').hide();
            }
        };

        var mkdfInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing');

            setTimeout(function () {
                thisHolderInner.isotope('layout');
            }, 600);
        };

        var mkdfInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('mkdf-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('mkdf-blog-pagination-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if (thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('mkdf-blog-pagination-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

})(jQuery);
(function ($) {
    "use strict";

    var footer = {};
    mkdf.modules.footer = footer;

    footer.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */

    function mkdfOnWindowLoad() {
        uncoveringFooter();
    }

    function uncoveringFooter() {
        var uncoverFooter = $('body:not(.error404) .mkdf-footer-uncover');

        if (uncoverFooter.length && !mkdf.htmlEl.hasClass('touchevents')) {

            var footer = $('footer'),
                footerHeight = footer.outerHeight(),
                content = $('.mkdf-content');

            var uncoveringCalcs = function () {
                content.css('margin-bottom', footerHeight);
                footer.css('height', footerHeight);
            };


            //set
            uncoveringCalcs();

            $(window).resize(function () {
                //recalc
                footerHeight = footer.find('.mkdf-footer-inner').outerHeight();
                uncoveringCalcs();
            });
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var header = {};
    mkdf.modules.header = header;

    header.mkdfSetDropDownMenuPosition = mkdfSetDropDownMenuPosition;
    header.mkdfSetDropDownWideMenuPosition = mkdfSetDropDownWideMenuPosition;

    header.mkdfOnDocumentReady = mkdfOnDocumentReady;
    header.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfSetDropDownMenuPosition();
        setTimeout(function () {
            mkdfDropDownMenu();
        }, 100);
    }

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfSetDropDownWideMenuPosition();
    }

    /**
     * Set dropdown position
     */
    function mkdfSetDropDownMenuPosition() {
        var menuItems = $('.mkdf-drop-down > ul > li.narrow.menu-item-has-children');

        if (menuItems.length) {
            menuItems.each(function (i) {
                var thisItem = $(this),
                    menuItemPosition = thisItem.offset().left,
                    dropdownHolder = thisItem.find('.second'),
                    dropdownMenuItem = dropdownHolder.find('.inner ul'),
                    dropdownMenuWidth = dropdownMenuItem.outerWidth(),
                    menuItemFromLeft = mkdf.windowWidth - menuItemPosition;

                if (mkdf.body.hasClass('mkdf-boxed')) {
                    menuItemFromLeft = mkdf.boxedLayoutWidth - (menuItemPosition - (mkdf.windowWidth - mkdf.boxedLayoutWidth ) / 2);
                }

                var dropDownMenuFromLeft; //has to stay undefined because 'dropDownMenuFromLeft < dropdownMenuWidth' conditional will be true

                if (thisItem.find('li.sub').length > 0) {
                    dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
                }

                dropdownHolder.removeClass('right');
                dropdownMenuItem.removeClass('right');
                if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
                    dropdownHolder.addClass('right');
                    dropdownMenuItem.addClass('right');
                }
            });
        }
    }

    /**
     * Set dropdown wide position
     */
    function mkdfSetDropDownWideMenuPosition() {
        var menuItems = $(".mkdf-drop-down > ul > li.wide");

        if (menuItems.length) {
            menuItems.each(function (i) {
                var menuItem = $(this);
                var menuItemSubMenu = menuItem.find('.second');

                if (menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
                    menuItemSubMenu.css('left', 0);

                    var left_position = menuItemSubMenu.offset().left;

                    if (mkdf.body.hasClass('mkdf-boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.mkdf-boxed .mkdf-wrapper .mkdf-wrapper-inner').outerWidth();
                        left_position = left_position - (mkdf.windowWidth - boxedWidth) / 2;
                        menuItemSubMenu.css({'left': -left_position, 'width': boxedWidth});

                    } else if (mkdf.body.hasClass('mkdf-wide-dropdown-menu-in-grid')) {
                        //wide dropdown in grid case
                        menuItemSubMenu.css({
                            'left': -left_position + (mkdf.windowWidth - mkdf.gridWidth()) / 2,
                            'width': mkdf.gridWidth()
                        });

                    }
                    else {
                        //wide dropdown full width case
                        menuItemSubMenu.css({'left': -left_position, 'width': mkdf.windowWidth});

                    }
                }
            });
        }
    }

    function mkdfDropDownMenu() {
        var menu_items = $('.mkdf-drop-down > ul > li');

        menu_items.each(function () {
            var thisItem = $(this);

            if (thisItem.find('.second').length) {
                thisItem.waitForImages(function () {
                    var dropDownHolder = thisItem.find('.second'),
                        dropDownHolderHeight = !mkdf.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;

                    if (thisItem.hasClass('wide')) {
                        var tallest = 0,
                            dropDownSecondItem = dropDownHolder.find('> .inner > ul > li');

                        dropDownSecondItem.each(function () {
                            var thisHeight = $(this).outerHeight();

                            if (thisHeight > tallest) {
                                tallest = thisHeight;
                            }
                        });

                        dropDownSecondItem.css('height', '').height(tallest);

                        if (!mkdf.menuDropdownHeightSet) {
                            dropDownHolderHeight = dropDownHolder.outerHeight();
                        }
                    }

                    if (!mkdf.menuDropdownHeightSet) {
                        dropDownHolder.height(0);
                    }

                    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                        thisItem.on("touchstart mouseenter", function () {
                            dropDownHolder.css({
                                'height': dropDownHolderHeight,
                                'overflow': 'visible',
                                'visibility': 'visible',
                                'opacity': '1'
                            });
                        }).on("mouseleave", function () {
                            dropDownHolder.css({
                                'height': '0px',
                                'overflow': 'hidden',
                                'visibility': 'hidden',
                                'opacity': '0'
                            });
                        });
                    } else {
                        if (mkdf.body.hasClass('mkdf-dropdown-animate-height')) {
                            var animateConfig = {
                                interval: 0,
                                over: function () {
                                    setTimeout(function () {
                                        dropDownHolder.addClass('mkdf-drop-down-start').css({
                                            'visibility': 'visible',
                                            'height': '0',
                                            'opacity': '1'
                                        });
                                        dropDownHolder.stop().animate({
                                            'height': dropDownHolderHeight
                                        }, 400, 'easeInOutQuint', function () {
                                            dropDownHolder.css('overflow', 'visible');
                                        });
                                    }, 100);
                                },
                                timeout: 100,
                                out: function () {
                                    dropDownHolder.stop().animate({
                                        'height': '0',
                                        'opacity': 0
                                    }, 100, function () {
                                        dropDownHolder.css({
                                            'overflow': 'hidden',
                                            'visibility': 'hidden'
                                        });
                                    });

                                    dropDownHolder.removeClass('mkdf-drop-down-start');
                                }
                            };

                            thisItem.hoverIntent(animateConfig);
                        } else {
                            var config = {
                                interval: 0,
                                over: function () {
                                    setTimeout(function () {
                                        dropDownHolder.addClass('mkdf-drop-down-start').stop().css({'height': dropDownHolderHeight});
                                    }, 150);
                                },
                                timeout: 150,
                                out: function () {
                                    dropDownHolder.stop().css({'height': '0'}).removeClass('mkdf-drop-down-start');
                                }
                            };

                            thisItem.hoverIntent(config);
                        }
                    }
                });
            }
        });

        $('.mkdf-drop-down ul li.wide ul li a').on('click', function (e) {
            if (e.which === 1) {
                var $this = $(this);

                setTimeout(function () {
                    $this.mouseleave();
                }, 500);
            }
        });

        mkdf.menuDropdownHeightSet = true;
    }

})(jQuery);
(function ($) {
    'use strict';

    var like = {};

    like.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /**
     *  All functions to be called on $(document).ready() should be in this function
     **/
    function mkdfOnDocumentReady() {
        mkdfLikes();
    }

    function mkdfLikes() {
        $(document).on('click', '.mkdf-like', function () {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if (likeLink.hasClass('liked')) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'curly_mkdf_like',
                likes_id: id,
                type: type
            };

            var like = $.post(mkdfGlobalVars.vars.mkdfAjaxUrl, dataToPass, function (data) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }

})(jQuery);
(function ($) {
    "use strict";

    var sidearea = {};
    mkdf.modules.sidearea = sidearea;

    sidearea.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfSideArea();
        mkdfSideAreaScroll();
    }

    /**
     * Show/hide side area
     */
    function mkdfSideArea() {

        var wrapper = $('.mkdf-wrapper'),
            sideMenu = $('.mkdf-side-menu'),
            sideMenuButtonOpen = $('a.mkdf-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (mkdf.body.hasClass('mkdf-side-menu-slide-from-right')) {
            $('.mkdf-cover').remove();
            cssClass = 'mkdf-right-side-menu-opened';
            wrapper.prepend('<div class="mkdf-cover"/>');
            slideFromRight = true;
        } else if (mkdf.body.hasClass('mkdf-side-menu-slide-with-content')) {
            cssClass = 'mkdf-side-menu-open';
            slideWithContent = true;
        } else if (mkdf.body.hasClass('mkdf-side-area-uncovered-from-content')) {
            cssClass = 'mkdf-right-side-menu-opened';
            slideUncovered = true;
        }

        $('a.mkdf-side-menu-button-opener, a.mkdf-close-side-menu').on('click', function (e) {
            e.preventDefault();

            if (!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                mkdf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.mkdf-wrapper .mkdf-cover').on( 'click', function () {
                        mkdf.body.removeClass('mkdf-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility': 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function () {
                    if (Math.abs(mkdf.scroll - currentScroll) > 400) {
                        mkdf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function () {
                                sideMenu.css({'visibility': 'hidden'});
                                clearTimeout(hideSideMenu);
                            }, 400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                mkdf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function () {
                        sideMenu.css({'visibility': 'hidden'});
                        clearTimeout(hideSideMenu);
                    }, 400);
                }

            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.on('click', function () {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    mkdf.body.removeClass('mkdf-side-menu-open');
                });

            }

        });

    }

    /*
     **  Smooth scroll functionality for Side Area
     */
    function mkdfSideAreaScroll() {
        var sideMenu = $('.mkdf-side-menu');

        if (sideMenu.length) {
            sideMenu.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
        }
    }

})(jQuery);

(function ($) {
    "use strict";

    var title = {};
    mkdf.modules.title = title;

    title.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
    function mkdfParallaxTitle() {
        var parallaxBackground = $('.mkdf-title-holder.mkdf-bg-parallax');

        if (parallaxBackground.length > 0 && mkdf.windowWidth > 1024) {
            var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('mkdf-bg-parallax-zoom-out'),
                titleHeight = parseInt(parallaxBackground.data('height')),
                imageWidth = parseInt(parallaxBackground.data('background-width')),
                parallaxRate = titleHeight / 10000 * 7,
                parallaxYPos = -(mkdf.scroll * parallaxRate),
                adminBarHeight = mkdfGlobalVars.vars.mkdfAddForAdminBar;

            parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});

            if (parallaxBackgroundWithZoomOut) {
                parallaxBackground.css({'background-size': imageWidth - mkdf.scroll + 'px auto'});
            }

            //set position of background on window scroll
            $(window).scroll(function () {
                parallaxYPos = -(mkdf.scroll * parallaxRate);
                parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});

                if (parallaxBackgroundWithZoomOut) {
                    parallaxBackground.css({'background-size': imageWidth - mkdf.scroll + 'px auto'});
                }
            });
        }
    }

})(jQuery);

(function ($) {
    'use strict';

    var woocommerce = {};
    mkdf.modules.woocommerce = woocommerce;

    woocommerce.mkdfOnDocumentReady = mkdfOnDocumentReady;
    woocommerce.mkdfOnWindowLoad = mkdfOnWindowLoad;
    woocommerce.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitQuantityButtons();
        mkdfInitSelect2();
        mkdfInitSingleProductLightbox();
        mkdfInitSingleProductFeaturedImage();
    }

    /* 
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitProductListMasonryShortcode();
    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitProductListMasonryShortcode();
    }

    /*
     ** Init quantity buttons to increase/decrease products for cart
     */
    function mkdfInitQuantityButtons() {
        $(document).on('click', '.mkdf-quantity-minus, .mkdf-quantity-plus', function (e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.mkdf-quantity-input'),
                step = parseFloat(inputField.data('step')),
                max = parseFloat(inputField.data('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkdf-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if (max === undefined) {
                    inputField.val(newInputValue);
                } else {
                    if (newInputValue >= max) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger('change');
        });
    }

    /*
     ** Init select2 script for select html dropdowns
     */
    function mkdfInitSelect2() {
        var orderByDropDown = $('.woocommerce-ordering .orderby');
        if (orderByDropDown.length) {
            orderByDropDown.select2({
                minimumResultsForSearch: Infinity
            });
        }

        var variableProducts = $('.mkdf-woocommerce-page .mkdf-content .variations td.value select');
        if (variableProducts.length) {
            variableProducts.select2();
        }

        var shippingCountryCalc = $('#calc_shipping_country');
        if (shippingCountryCalc.length) {
            shippingCountryCalc.select2();
        }

        var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
        if (shippingStateCalc.length) {
            shippingStateCalc.select2();
        }
    }

    /*
     ** Init Product Single Pretty Photo attributes
     */
    function mkdfInitSingleProductLightbox() {
        var item = $('.mkdf-woo-single-page.mkdf-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');

        if (item.length) {
            item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');

            if (typeof mkdf.modules.common.mkdfPrettyPhoto === "function") {
                mkdf.modules.common.mkdfPrettyPhoto();
            }
        }
    }

    /*
     ** Init Product List Masonry Shortcode Layout
     */
    function mkdfInitProductListMasonryShortcode() {
        var container = $('.mkdf-pl-holder.mkdf-masonry-layout .mkdf-pl-outer');

        if (container.length) {
            container.each(function () {
                var thisContainer = $(this),
                    size = thisContainer.find('.mkdf-pl-sizer').width();

                thisContainer.waitForImages(function () {
                    thisContainer.isotope({
                        itemSelector: '.mkdf-pli',
                        resizable: false,
                        masonry: {
                            columnWidth: '.mkdf-pl-sizer',
                            gutter: '.mkdf-pl-gutter'
                        }
                    });

                    if (thisContainer.find('.mkdf-woo-fixed-masonry').length) {
                        mkdf.modules.common.setFixedImageProportionSize(thisContainer, thisContainer.find('.mkdf-pli'), size, true);
                    }

                    thisContainer.isotope('layout').css('opacity', 1);
                });
            });
        }
    }

    /**
     * init single product featured image as background image
     */

    function mkdfInitSingleProductFeaturedImage() {
        var featuredContainer = $('body.single-product .woocommerce-product-gallery--with-images .woocommerce-product-gallery__wrapper div:first-child img');

        if (featuredContainer.length) {
            var image = featuredContainer.attr('src');

            featuredContainer.parent().css('background-image', 'url(' + image + ')');
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var blogListSC = {};
    mkdf.modules.blogListSC = blogListSC;

    blogListSC.mkdfOnDocumentReady = mkdfOnDocumentReady;
    blogListSC.mkdfOnWindowLoad = mkdfOnWindowLoad;
    blogListSC.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitBlogListMasonry();
    }

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitBlogListShortcodePagination().init();
        mkdfElementorBlogList();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
        mkdfInitBlogListShortcodePagination().scroll();
    }

    /**
     * Elementor Blog List
     */
    function mkdfElementorBlogList() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_blog_list.default', function () {
                mkdfInitBlogListMasonry();
                mkdfInitBlogListShortcodePagination().init();
            });
        });
    }

    /**
     * Init blog list shortcode masonry layout
     */
    function mkdfInitBlogListMasonry() {
        var holder = $('.mkdf-blog-list-holder.mkdf-bl-masonry');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    masonry = thisHolder.find('.mkdf-blog-list');

                masonry.waitForImages(function () {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: '.mkdf-bl-item',
                        percentPosition: true,
                        packery: {
                            gutter: '.mkdf-bl-grid-gutter',
                            columnWidth: '.mkdf-bl-grid-sizer'
                        }
                    });

                    masonry.css('opacity', '1');
                });
            });
        }
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function mkdfInitBlogListShortcodePagination() {
        var holder = $('.mkdf-blog-list-holder');

        var initStandardPagination = function (thisHolder) {
            var standardLink = thisHolder.find('.mkdf-bl-standard-pagination li');

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

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function (thisHolder) {
            var loadMoreButton = thisHolder.find('.mkdf-blog-pag-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function (thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - mkdfGlobalVars.vars.mkdfAddForAdminBar;

            if (!thisHolder.hasClass('mkdf-bl-pag-infinite-scroll-started') && mkdf.scroll + mkdf.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function (thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.mkdf-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if (thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                thisHolder.data('next-page', pagedLink);
            }

            if (thisHolder.hasClass('mkdf-bl-pag-infinite-scroll')) {
                thisHolder.addClass('mkdf-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.mkdf-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            if (nextPage <= maxNumPages) {
                if (thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                    loadingItem.addClass('mkdf-showing mkdf-standard-pag-trigger');
                    thisHolder.addClass('mkdf-bl-pag-standard-shortcodes-animate');
                } else {
                    loadingItem.addClass('mkdf-showing');
                }

                var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'curly_mkdf_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        if (!thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        if (thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                            mkdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function () {
                                if (thisHolder.hasClass('mkdf-bl-masonry')) {
                                    mkdfInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    mkdfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                                        mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function () {
                                if (thisHolder.hasClass('mkdf-bl-masonry')) {
                                    mkdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    mkdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                                        mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if (thisHolder.hasClass('mkdf-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('mkdf-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisHolder.find('.mkdf-blog-pag-load-more').hide();
            }
        };

        var mkdfInitStandardPaginationLinkChanges = function (thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.mkdf-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.mkdf-bl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.mkdf-bl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.mkdf-bl-pag-next a');

            standardPagNumericItem.removeClass('mkdf-bl-pag-active');
            standardPagNumericItem.eq(nextPage - 1).addClass('mkdf-bl-pag-active');

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

        var mkdfInitHtmlIsotopeNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            thisHolder.removeClass('mkdf-bl-pag-standard-shortcodes-animate');

            setTimeout(function () {
                thisHolderInner.isotope('layout');

                if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                    mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var mkdfInitHtmlGalleryNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            thisHolder.removeClass('mkdf-bl-pag-standard-shortcodes-animate');
            thisHolderInner.html(responseHtml);
        };

        var mkdfInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing');

            setTimeout(function () {
                thisHolderInner.isotope('layout');

                if (typeof mkdf.modules.common.mkdfStickySidebarWidget === 'function') {
                    mkdf.modules.common.mkdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var mkdfInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('mkdf-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('mkdf-bl-pag-standard-shortcodes')) {
                            initStandardPagination(thisHolder);
                        }

                        if (thisHolder.hasClass('mkdf-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if (thisHolder.hasClass('mkdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('mkdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

})(jQuery);
(function ($) {
    "use strict";

    var headerMinimal = {};
    mkdf.modules.headerMinimal = headerMinimal;

    headerMinimal.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function mkdfFullscreenMenu() {
        var popupMenuOpener = $('a.mkdf-fullscreen-menu-opener');

        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".mkdf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.mkdf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.mkdf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.mkdf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild = $('.mkdf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.mkdf-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            popupMenuHolderOuter.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });

            //set height of popup holder on resize
            $(window).resize(function () {
                popupMenuHolderOuter.height(mkdf.windowHeight);
            });

            if (mkdf.body.hasClass('mkdf-fade-push-text-right')) {
                cssClass = 'mkdf-push-nav-right';
                fadeRight = true;
            } else if (mkdf.body.hasClass('mkdf-fade-push-text-top')) {
                cssClass = 'mkdf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay': 0 + 'ms',
                        '-moz-animation-delay': 0 + 'ms',
                        'animation-delay': 0 + 'ms'
                    });
                }
                menuItems.each(function (i) {
                    $(this).css({
                        '-webkit-animation-delay': (i + 1) * 70 + 'ms',
                        '-moz-animation-delay': (i + 1) * 70 + 'ms',
                        'animation-delay': (i + 1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay': (menuItems.length + 1) * 70 + 'ms',
                        '-moz-animation-delay': (menuItems.length + 1) * 70 + 'ms',
                        'animation-delay': (menuItems.length + 1) * 70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click', function (e) {
                e.preventDefault();

                if (!popupMenuOpener.hasClass('mkdf-fm-opened')) {
                    popupMenuOpener.addClass('mkdf-fm-opened');
                    mkdf.body.removeClass('mkdf-fullscreen-fade-out').addClass('mkdf-fullscreen-menu-opened mkdf-fullscreen-fade-in');
                    mkdf.body.removeClass(cssClass);
                    mkdf.modules.common.mkdfDisableScroll();

                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) {
                            popupMenuOpener.removeClass('mkdf-fm-opened');
                            mkdf.body.removeClass('mkdf-fullscreen-menu-opened mkdf-fullscreen-fade-in').addClass('mkdf-fullscreen-fade-out');
                            mkdf.body.addClass(cssClass);
                            mkdf.modules.common.mkdfEnableScroll();

                            $("nav.mkdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('mkdf-fm-opened');
                    mkdf.body.removeClass('mkdf-fullscreen-menu-opened mkdf-fullscreen-fade-in').addClass('mkdf-fullscreen-fade-out');
                    mkdf.body.addClass(cssClass);
                    mkdf.modules.common.mkdfEnableScroll();

                    $("nav.mkdf-fullscreen-menu ul.sub_menu").slideUp(200);
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function (e) {
                e.preventDefault();

                var thisItem = $(this),
                    thisItemParent = thisItem.parent(),
                    thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

                if (thisItemParent.hasClass('has_sub')) {
                    var submenu = thisItemParent.find('> ul.sub_menu');

                    if (submenu.is(':visible')) {
                        submenu.slideUp(450, 'easeInOutQuint');
                        thisItemParent.removeClass('open_sub');
                    } else {
                        thisItemParent.addClass('open_sub');

                        if (thisItemParentSiblingsWithDrop.length === 0) {
                            submenu.slideDown(400, 'easeInOutQuint');
                        } else {
                            thisItemParent.closest('li.menu-item').siblings().find('.menu-item').removeClass('open_sub');
                            thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
                                submenu.slideDown(400, 'easeInOutQuint');
                            });
                        }
                    }
                }

                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {
                if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
                    if (e.which == 1) {
                        popupMenuOpener.removeClass('mkdf-fm-opened');
                        mkdf.body.removeClass('mkdf-fullscreen-menu-opened');
                        mkdf.body.removeClass('mkdf-fullscreen-fade-in').addClass('mkdf-fullscreen-fade-out');
                        mkdf.body.addClass(cssClass);
                        $("nav.mkdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        mkdf.modules.common.mkdfEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var mobileHeader = {};
    mkdf.modules.mobileHeader = mobileHeader;

    mobileHeader.mkdfOnDocumentReady = mkdfOnDocumentReady;
    mobileHeader.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
    $(window).resize(mkdfOnWindowResize);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitMobileNavigation();
        mkdfInitMobileNavigationScroll();
        mkdfMobileHeaderBehavior();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitMobileNavigationScroll();
    }

    function mkdfInitMobileNavigation() {
        var navigationOpener = $('.mkdf-mobile-header .mkdf-mobile-menu-opener'),
            navigationHolder = $('.mkdf-mobile-header .mkdf-mobile-nav'),
            dropdownOpener = $('.mkdf-mobile-nav .mobile_arrow, .mkdf-mobile-nav h6, .mkdf-mobile-nav a.mkdf-mobile-no-link');

        //whole mobile menu opening / closing
        if (navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(450, 'easeInOutQuint');
                    navigationOpener.removeClass('mkdf-mobile-menu-opened');
                } else {
                    navigationHolder.slideDown(450, 'easeInOutQuint');
                    navigationOpener.addClass('mkdf-mobile-menu-opened');
                }
            });
        }
	
	    //dropdown opening / closing
	    if (dropdownOpener.length) {
		    dropdownOpener.each(function () {
			    var thisItem = $(this),
				    initialNavHeight = navigationHolder.outerHeight();
			
			    thisItem.on('tap click', function (e) {
				    var thisItemParent = thisItem.parent('li'),
					    thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');
				
				    if (thisItemParent.hasClass('has_sub')) {
					    var submenu = thisItemParent.find('> ul.sub_menu');
					
					    if (submenu.is(':visible')) {
						    submenu.slideUp(450, 'easeInOutQuint');
						    thisItemParent.removeClass('mkdf-opened');
						    navigationHolder.stop().animate({'height': initialNavHeight}, 300);
					    } else {
						    thisItemParent.addClass('mkdf-opened');
						
						    if (thisItemParentSiblingsWithDrop.length === 0) {
							    thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
								    submenu.slideDown(400, 'easeInOutQuint');
								    navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
							    });
						    } else {
							    thisItemParent.siblings().removeClass('mkdf-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
								    submenu.slideDown(400, 'easeInOutQuint');
								    navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
							    });
						    }
					    }
				    }
			    });
		    });
	    }

        $('.mkdf-mobile-nav a, .mkdf-mobile-logo-wrapper a').on('click tap', function (e) {
            if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(450, 'easeInOutQuint');
                navigationOpener.removeClass("mkdf-mobile-menu-opened");
            }
        });
    }

    function mkdfInitMobileNavigationScroll() {
        if (mkdf.windowWidth <= 1024) {
            var mobileHeader = $('.mkdf-mobile-header'),
                mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
                navigationHolder = mobileHeader.find('.mkdf-mobile-nav'),
                navigationHeight = navigationHolder.outerHeight(),
                windowHeight = mkdf.windowHeight - 100;

            //init scrollable menu
            var scrollHeight = mobileHeaderHeight + navigationHeight > windowHeight ? windowHeight - mobileHeaderHeight : navigationHeight;

            navigationHolder.height(scrollHeight).perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
        }
    }

    function mkdfMobileHeaderBehavior() {
        var mobileHeader = $('.mkdf-mobile-header'),
            mobileMenuOpener = mobileHeader.find('.mkdf-mobile-menu-opener'),
            mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;

        if (mkdf.body.hasClass('mkdf-content-is-behind-header') && mobileHeaderHeight > 0 && mkdf.windowWidth <= 1024) {
            $('.mkdf-content').css('marginTop', -mobileHeaderHeight);
        }

        if (mkdf.body.hasClass('mkdf-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                adminBar = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar;

            $(window).scroll(function () {
                var docYScroll2 = $(document).scrollTop();

                if (docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkdf-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('mkdf-animate-mobile-header');
                }

                if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('mkdf-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if (adminBar.length) {
                        mobileHeader.find('.mkdf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var stickyHeader = {};
    mkdf.modules.stickyHeader = stickyHeader;

    stickyHeader.isStickyVisible = false;
    stickyHeader.stickyAppearAmount = 0;
    stickyHeader.behaviour = '';

    stickyHeader.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        if (mkdf.windowWidth > 1024) {
            mkdfHeaderBehaviour();
        }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdfHeaderBehaviour() {
        var header = $('.mkdf-page-header'),
            stickyHeader = $('.mkdf-sticky-header'),
            fixedHeaderWrapper = $('.mkdf-fixed-wrapper'),
            fixedMenuArea = fixedHeaderWrapper.children('.mkdf-menu-area'),
            fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.mkdf-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
            stickyAppearAmount,
            headerAppear;

        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - mkdfGlobalVars.vars.mkdfAddForAdminBar : 0;

        switch (true) {
            // sticky header that will be shown when user scrolls up
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up'):
                mkdf.modules.stickyHeader.behaviour = 'mkdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(mkdfGlobalVars.vars.mkdfTopBarHeight) + parseInt(mkdfGlobalVars.vars.mkdfLogoAreaHeight) + parseInt(mkdfGlobalVars.vars.mkdfMenuAreaHeight) + parseInt(mkdfGlobalVars.vars.mkdfStickyHeaderHeight);

                headerAppear = function () {
                    var docYScroll2 = $(document).scrollTop();

                    if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                        mkdf.body.removeClass('mkdf-sticky-header-appear');
                    } else {
                        mkdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                        mkdf.body.addClass('mkdf-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up'):
                mkdf.modules.stickyHeader.behaviour = 'mkdf-sticky-header-on-scroll-down-up';

                if (mkdfPerPageVars.vars.mkdfStickyScrollAmount !== 0) {
                    mkdf.modules.stickyHeader.stickyAppearAmount = parseInt(mkdfPerPageVars.vars.mkdfStickyScrollAmount);
                } else {
                    mkdf.modules.stickyHeader.stickyAppearAmount = parseInt(mkdfGlobalVars.vars.mkdfTopBarHeight) + parseInt(mkdfGlobalVars.vars.mkdfLogoAreaHeight) + parseInt(mkdfGlobalVars.vars.mkdfMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function () {
                    if (mkdf.scroll < mkdf.modules.stickyHeader.stickyAppearAmount) {
                        mkdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                        mkdf.body.removeClass('mkdf-sticky-header-appear');
                    } else {
                        mkdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                        mkdf.body.addClass('mkdf-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case mkdf.body.hasClass('mkdf-fixed-on-scroll'):
                mkdf.modules.stickyHeader.behaviour = 'mkdf-fixed-on-scroll';
                var headerFixed = function () {

                    if (mkdf.scroll <= headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        mkdf.body.removeClass('mkdf-fixed-header-appear');
                        header.css('margin-bottom', '0');
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        mkdf.body.addClass('mkdf-fixed-header-appear');
                        header.css('margin-bottom', fixedMenuAreaHeight + 'px');
                    }
                };

                headerFixed();

                $(window).scroll(function () {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var searchCoversHeader = {};
    mkdf.modules.searchCoversHeader = searchCoversHeader;

    searchCoversHeader.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfSearchCoversHeader();
    }

    /**
     * Init Search Types
     */
    function mkdfSearchCoversHeader() {
        if (mkdf.body.hasClass('mkdf-search-covers-header')) {

            var searchOpener = $('a.mkdf-search-opener');

            if (searchOpener.length > 0) {
                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchFormHeight,
                        searchFormHeaderHolder = $('.mkdf-page-header'),
                        searchFormTopHeaderHolder = $('.mkdf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.mkdf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.mkdf-mobile-header'),
                        searchForm = $('.mkdf-search-cover'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.mkdf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.mkdf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.mkdf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.mkdf-mobile-header').length;

                    searchForm.removeClass('mkdf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormHeight = mkdfGlobalVars.vars.mkdfTopBarHeight;
                        searchFormTopHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                        searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        //searchFormHeight = searchFormHeaderHolder.find('.mkdf-sticky-header').outerHeight();
                        searchFormHeight = mkdfGlobalVars.vars.mkdfStickyHeaderHeight;
                        searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormHeight = searchFormMobileHeaderHolder.children('.mkdf-mobile-header-inner').outerHeight();
                        } else {
                            searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                        }

                        searchFormMobileHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');

                    } else {
                        searchFormHeight = searchFormHeaderHolder.outerHeight();
                        searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');
                    }

                    if (searchForm.hasClass('mkdf-is-active')) {
                        searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                    }

                    searchForm.find('.mkdf-search-close').on('click', function (e) {
                        e.preventDefault();
                        searchForm.stop(true).fadeOut(450);
                    });

                    searchForm.blur(function () {
                        searchForm.stop(true).fadeOut(450);
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(450);
                    });
                });
            }
        }
    }

})(jQuery);
