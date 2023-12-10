(function ($) {
    'use strict';

    var rating = {};
    mkdf.modules.rating = rating;

    rating.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitCommentRating();
    }

    function mkdfInitCommentRating() {
        var ratingHolder = $('.mkdf-comment-form-rating');

        var addActive = function (stars, ratingValue) {
            for (var i = 0; i < stars.length; i++) {
                var star = stars[i];
                if (i < ratingValue) {
                    $(star).addClass('active');
                } else {
                    $(star).removeClass('active');
                }
            }
        };

        ratingHolder.each(function () {
            var thisHolder = $(this),
                ratingInput = thisHolder.find('.mkdf-rating'),
                ratingValue = ratingInput.val(),
                stars = thisHolder.find('.mkdf-star-rating');

            addActive(stars, ratingValue);

            stars.on('click', function () {
                ratingInput.val($(this).data('value')).trigger('change');
            });

            ratingInput.on('change', function () {
                ratingValue = ratingInput.val();
                addActive(stars, ratingValue);
            });
        });
    }

})(jQuery);
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
(function ($) {
    'use strict';

    var accordions = {};
    mkdf.modules.accordions = accordions;

    accordions.mkdfInitAccordions = mkdfInitAccordions;


    accordions.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitAccordions();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */

    function mkdfOnWindowLoad() {
        mkdfElementorAccordions();
    }

    /**
     * Elementor
     */
    function mkdfElementorAccordions(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_accordion.default', function() {
                mkdfInitAccordions();
            } );
        });
    }

    /**
     * Init accordions shortcode
     */
    function mkdfInitAccordions() {
        var accordion = $('.mkdf-accordion-holder');

        if (accordion.length) {
            accordion.each(function () {
                var thisAccordion = $(this);

                if (thisAccordion.hasClass('mkdf-accordion')) {
                    thisAccordion.accordion({
                        animate: "swing",
                        collapsible: true,
                        active: 0,
                        icons: "",
                        heightStyle: "content"
                    });
                }

                if (thisAccordion.hasClass('mkdf-toggle')) {
                    var toggleAccordion = $(this),
                        toggleAccordionTitle = toggleAccordion.find('.mkdf-accordion-title'),
                        toggleAccordionContent = toggleAccordionTitle.next();

                    toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
                    toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
                    toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

                    toggleAccordionTitle.each(function () {
                        var thisTitle = $(this);

                        thisTitle.on('mouseenter mouseleave',function () {
                            thisTitle.toggleClass("ui-state-hover");
                        });

                        thisTitle.on('click', function () {
                            thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
                            thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
                        });
                    });
                }
            });
        }
    }

})(jQuery);
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
(function ($) {
    'use strict';

    var banner = {};
    mkdf.modules.banner = banner;

    banner.mkdfInitBanner = mkdfInitBanner;


    banner.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitBanner();
    }

    /**
    All functions to be called on $(window).on('load',) should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorBanner();
    }

    /**
     * Elementor
     */
    function mkdfElementorBanner(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_banner.default', function() {
                mkdfInitBanner();
            } );
        });
    }

    /**
     * Banner Shortcode
     */
    function mkdfInitBanner() {
        var bannerHolder = $('.mkdf-banner-holder');

        if (bannerHolder.length) {
            bannerHolder.each(function () {
                $(this).css('height', $(this).width());
            });
        }
    }

})(jQuery);
(function ($) {
    'use strict';

    var button = {};
    mkdf.modules.button = button;

    button.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfButton().init();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorButton();
    }

    /**
     * Elementor
     */
    function mkdfElementorButton(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_button.default', function() {
                mkdfButton().init();
            } );
        });
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdfButton = function () {
        //all buttons on the page
        var buttons = $('.mkdf-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function (button) {
            if (typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function (event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
                button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
            }
        };

        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function (button) {
            if (typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function (event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
                button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function (button) {
            if (typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function (event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
                button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
            }
        };

        return {
            init: function () {
                if (buttons.length) {
                    buttons.each(function () {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };

    button.mkdfButton = mkdfButton;

})(jQuery);
(function ($) {
	'use strict';
	
	var clientsCarousel = {};
	mkdf.modules.clientsCarousel = clientsCarousel;


	clientsCarousel.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).on('load',mkdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfElementorClientsCarousel();
	}

    /**
     * Elementor
     */
	function mkdfElementorClientsCarousel() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_clients_carousel.default', function () {
				mkdf.modules.common.mkdfOwlSlider();
			});
		});
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var countdown = {};
    mkdf.modules.countdown = countdown;

    countdown.mkdfInitCountdown = mkdfInitCountdown;


    countdown.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitCountdown();
    }
    /**
     All functions to be called on $(window).on('load',) should be in this function
     */

    function mkdfOnWindowLoad() {
        mkdfElementorCountdown();
    }

    /**
     * Elementor
     */
    function mkdfElementorCountdown(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_countdown.default', function() {
                mkdfInitCountdown();
            } );
        });
    }

    /**
     * Countdown Shortcode
     */
    function mkdfInitCountdown() {
        var countdowns = $('.mkdf-countdown'),
            date = new Date(),
            currentMonth = date.getMonth(),
            currentYear = date.getFullYear(),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {
            countdowns.each(function () {
                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#' + countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');

                if (currentMonth !== month || currentYear !== year) {
                    month = month - 1;
                }

                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month, day, hour, minute, 44),
                    labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size': digitFontSize + 'px',
                        'line-height': digitFontSize + 'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size': labelFontSize + 'px'
                    });
                }
            });
        }
    }

})(jQuery);
(function ($) {
    'use strict';

    var counter = {};
    mkdf.modules.counter = counter;

    counter.mkdfInitCounter = mkdfInitCounter;


    counter.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitCounter();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */

    function mkdfOnWindowLoad() {
        mkdfElementorCounter();
    }

    /**
     * Elementor
     */
    function mkdfElementorCounter(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_counter.default', function() {
                mkdfInitCounter();
            } );
        });
    }

    /**
     * Counter Shortcode
     */
    function mkdfInitCounter() {
        var counterHolder = $('.mkdf-counter-holder');

        if (counterHolder.length) {
            counterHolder.each(function () {
                var thisCounterHolder = $(this),
                    thisCounter = thisCounterHolder.find('.mkdf-counter');

                thisCounterHolder.appear(function () {
                    thisCounterHolder.css('opacity', '1');

                    //Counter zero type
                    if (thisCounter.hasClass('mkdf-zero-counter')) {
                        var max = parseFloat(thisCounter.text());
                        thisCounter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        thisCounter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

})(jQuery);
(function ($) {
    'use strict';

    var customFont = {};
    mkdf.modules.customFont = customFont;

    customFont.mkdfCustomFontResize = mkdfCustomFontResize;
    customFont.mkdfCustomFontTypeOut = mkdfCustomFontTypeOut;


    customFont.mkdfOnDocumentReady = mkdfOnDocumentReady;
    customFont.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfCustomFontResize();
    }

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfCustomFontTypeOut();
        mkdfElementorCustomFont();
    }

    /**
     * Elementor
     */
    function mkdfElementorCustomFont(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_custom_font.default', function() {
                mkdfCustomFontResize();
                mkdfCustomFontTypeOut();
            } );
        });
    }

    /*
     **	Custom Font resizing style
     */
    function mkdfCustomFontResize() {
        var holder = $('.mkdf-custom-font-holder');

        if (holder.length) {
            holder.each(function () {
                var thisItem = $(this),
                    itemClass = '',
                    smallLaptopStyle = '',
                    ipadLandscapeStyle = '',
                    ipadPortraitStyle = '',
                    mobileLandscapeStyle = '',
                    style = '',
                    responsiveStyle = '';

                if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
                    itemClass = thisItem.data('item-class');
                }

                if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
                    smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
                }
                if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
                    ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
                }
                if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
                    ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
                }
                if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
                    mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
                }

                if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
                    smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
                }
                if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
                    ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
                }
                if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
                    ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
                }
                if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
                    mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
                }

                if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

                    if (smallLaptopStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
                    }
                    if (ipadLandscapeStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
                    }
                    if (ipadPortraitStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
                    }
                    if (mobileLandscapeStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
                    }
                }

                if (responsiveStyle.length) {
                    style = '<style type="text/css">' + responsiveStyle + '</style>';
                }

                if (style.length) {
                    $('head').append(style);
                }
            });
        }
    }

    /*
     * Init Type out functionality for Custom Font shortcode
     */
    function mkdfCustomFontTypeOut() {
        var mkdfTyped = $('.mkdf-cf-typed');

        if (mkdfTyped.length) {
            mkdfTyped.each(function () {

                //vars
                var thisTyped = $(this),
                    typedWrap = thisTyped.parent('.mkdf-cf-typed-wrap'),
                    customFontHolder = typedWrap.parent('.mkdf-custom-font-holder'),
                    $strings         = typedWrap.data( 'strings' );

                var options = {
                    strings: $strings,
                    typeSpeed: 90,
                    backDelay: 700,
                    loop: true,
                    contentType: 'text',
                    loopCount: false,
                    cursorChar: '_'
                };

                customFontHolder.appear(
                    function () {

                        if ( ! thisTyped.hasClass( 'qodef--initialized' ) ) {

                            var typed = new Typed(
                                thisTyped[0],
                                options
                            );
                            thisTyped.addClass( 'qodef--initialized' );
                        }

                    },
                    { accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount }
                );
            });
        }
    }

})(jQuery);
(function ($) {
    'use strict';

    var googleMap = {};
    mkdf.modules.googleMap = googleMap;

    googleMap.mkdfShowGoogleMap = mkdfShowGoogleMap;


    googleMap.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfShowGoogleMap();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorShowGoogleMap();
    }

    /**
     * Elementor
     */
    function mkdfElementorShowGoogleMap(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_google_map.default', function() {
                mkdfShowGoogleMap();
            } );
        });
    }

    /*
     **	Show Google Map
     */
    function mkdfShowGoogleMap() {
        var googleMap = $('.mkdf-google-map');

        if (googleMap.length) {
            googleMap.each(function () {
                var element = $(this);

                var snazzyMapStyle = false;
                var snazzyMapCode = '';
                if (typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
                    snazzyMapStyle = true;
                    var snazzyMapHolder = element.parent().find('.mkdf-snazzy-map'),
                        snazzyMapCodes = snazzyMapHolder.val();

                    if (snazzyMapHolder.length && snazzyMapCodes.length) {
                        snazzyMapCode = JSON.parse(snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, ''));
                    }
                }

                var customMapStyle;
                if (typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if (typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if (typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if (typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if (typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if (typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if (typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if (typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if (typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if (typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_" + uniqueId;
                var geocoder = "geocoder_" + uniqueId;
                var holderId = "mkdf-map-" + uniqueId;

                mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
            });
        }
    }

    /*
     **	Init Google Map
     */
    function mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

        if (typeof google !== 'object') {
            return;
        }

        var mapStyles = [];
        if (snazzyMapStyle && snazzyMapCode.length) {
            mapStyles = snazzyMapCode;
        } else {
            mapStyles = [
                {
                    stylers: [
                        {hue: color},
                        {saturation: saturation},
                        {lightness: lightness},
                        {gamma: 1}
                    ]
                }
            ];
        }

        var googleMapStyleId;

        if (snazzyMapStyle || customMapStyle === 'yes') {
            googleMapStyleId = 'mkdf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        wheel = wheel === 'yes';

        var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)) {
            height = height + 'px';
        }

        var myOptions = {
            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkdf-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function mkdfInitializeGoogleAddress(data, pin, map, geocoder) {
        if (data === '') {
            return;
        }

        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<div id="bodyContent">' +
            '<p>' + data + '</p>' +
            '</div>' +
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        geocoder.geocode({'address': data}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: pin,
                    title: data.store_title
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });

                google.maps.event.addDomListener(window, 'resize', function () {
                    map.setCenter(results[0].geometry.location);
                });
            }
        });
    }

})(jQuery);
(function ($) {
    'use strict';

    var elementsHolder = {};
    mkdf.modules.elementsHolder = elementsHolder;

    elementsHolder.mkdfInitElementsHolderResponsiveStyle = mkdfInitElementsHolderResponsiveStyle;


    elementsHolder.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitElementsHolderResponsiveStyle();
    }

    /*
     **	Elements Holder responsive style
     */
    function mkdfInitElementsHolderResponsiveStyle() {
        var elementsHolder = $('.mkdf-elements-holder');

        if (elementsHolder.length) {
            elementsHolder.each(function () {
                var thisElementsHolder = $(this),
                    elementsHolderItem = thisElementsHolder.children('.mkdf-eh-item'),
                    style = '',
                    responsiveStyle = '';

                elementsHolderItem.each(function () {
                    var thisItem = $(this),
                        itemClass = '',
                        largeLaptop = '',
                        smallLaptop = '',
                        ipadLandscape = '',
                        ipadPortrait = '',
                        mobileLandscape = '',
                        mobilePortrait = '';

                    if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
                        itemClass = thisItem.data('item-class');
                    }
                    if (typeof thisItem.data('1366-1600') !== 'undefined' && thisItem.data('1366-1600') !== false) {
                        largeLaptop = thisItem.data('1366-1600');
                    }
                    if (typeof thisItem.data('1024-1366') !== 'undefined' && thisItem.data('1024-1366') !== false) {
                        smallLaptop = thisItem.data('1024-1366');
                    }
                    if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
                        ipadLandscape = thisItem.data('768-1024');
                    }
                    if (typeof thisItem.data('680-768') !== 'undefined' && thisItem.data('680-768') !== false) {
                        ipadPortrait = thisItem.data('680-768');
                    }
                    if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
                        mobileLandscape = thisItem.data('680');
                    }

                    if (largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

                        if (largeLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.mkdf-eh-item-content." + itemClass + " { padding: " + largeLaptop + " !important; } }";
                        }
                        if (smallLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.mkdf-eh-item-content." + itemClass + " { padding: " + smallLaptop + " !important; } }";
                        }
                        if (ipadLandscape.length) {
                            responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.mkdf-eh-item-content." + itemClass + " { padding: " + ipadLandscape + " !important; } }";
                        }
                        if (ipadPortrait.length) {
                            responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.mkdf-eh-item-content." + itemClass + " { padding: " + ipadPortrait + " !important; } }";
                        }
                        if (mobileLandscape.length) {
                            responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-eh-item-content." + itemClass + " { padding: " + mobileLandscape + " !important; } }";
                        }
                    }
                });

                if (responsiveStyle.length) {
                    style = '<style type="text/css">' + responsiveStyle + '</style>';
                }

                if (style.length) {
                    $('head').append(style);
                }

                if (typeof mkdf.modules.common.mkdfOwlSlider === "function") {
                    mkdf.modules.common.mkdfOwlSlider();
                }
            });
        }
    }

})(jQuery);
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
(function ($) {
    'use strict';

    var iconWithText = {};
    mkdf.modules.iconWithText = iconWithText;

    iconWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
    }

    /**
    All functions to be called on $(window).on('load',) should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorIconWithText();
    }

    /**
     * Elementor
     */
    function mkdfElementorIconWithText(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_icon_with_text.default', function() {
                mkdf.modules.icon.mkdfIcon().init();
            } );
        });
    }

})(jQuery);
(function ($) {
    'use strict';

    var imageGallery = {};
    mkdf.modules.imageGallery = imageGallery;

    imageGallery.mkdfInitImageGalleryMasonry = mkdfInitImageGalleryMasonry;


    imageGallery.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).on('load',mkdfOnWindowLoad);

    /*
     ** All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitImageGalleryMasonry();
        mkdfElementorImageGallery();
    }

    /**
     * Elementor
     */
    function mkdfElementorImageGallery() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_image_gallery.default', function () {
                mkdfInitImageGalleryMasonry();
                mkdf.modules.common.mkdfOwlSlider();
                mkdf.modules.common.mkdfPrettyPhoto();
            });
        });
    }
    /*
     ** Init Image Gallery shortcode - Masonry layout
     */
    function mkdfInitImageGalleryMasonry() {
        var holder = $('.mkdf-image-gallery.mkdf-ig-masonry-type');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    masonry = thisHolder.find('.mkdf-ig-masonry');

                masonry.waitForImages(function () {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: '.mkdf-ig-image',
                        percentPosition: true,
                        packery: {
                            gutter: '.mkdf-ig-grid-gutter',
                            columnWidth: '.mkdf-ig-grid-sizer'
                        }
                    });

                    setTimeout(function () {
                        masonry.isotope('layout');
                        mkdf.modules.common.mkdfInitParallax();
                    }, 800);

                    masonry.css('opacity', '1');
                });
            });
        }
    }

})(jQuery);
(function ($) {
	'use strict';
	
	var imageWithText = {};
	mkdf.modules.imageWithText = imageWithText;


	imageWithText.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).on('load',mkdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfElementorImageWithText();
	}

    /**
     * Elementor
     */
	function mkdfElementorImageWithText() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_image_with_text.default', function () {
				mkdf.modules.common.mkdfPrettyPhoto();
			});
		});
	}
	
})(jQuery);
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
(function ($) {
    'use strict';

    var pieChart = {};
    mkdf.modules.pieChart = pieChart;

    pieChart.mkdfInitPieChart = mkdfInitPieChart;


    pieChart.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitPieChart();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorPieChart();
    }

    /**
     * Elementor
     */
    function mkdfElementorPieChart(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_pie_chart.default', function() {
                mkdfInitPieChart();
            } );
        });
    }

    /**
     * Init Pie Chart shortcode
     */
    function mkdfInitPieChart() {
        var pieChartHolder = $('.mkdf-pie-chart-holder');

        if (pieChartHolder.length) {
            pieChartHolder.each(function () {
                var thisPieChartHolder = $(this),
                    pieChart = thisPieChartHolder.children('.mkdf-pc-percentage'),
                    barColor = '#25abd1',
                    trackColor = '#f7f7f7',
                    lineWidth = 3,
                    size = 176;

                if (typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
                    size = pieChart.data('size');
                }

                if (typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
                    barColor = pieChart.data('bar-color');
                }

                if (typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
                    trackColor = pieChart.data('track-color');
                }

                pieChart.appear(function () {
                    initToCounterPieChart(pieChart);
                    thisPieChartHolder.css('opacity', '1');

                    pieChart.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart(pieChart) {
        var counter = pieChart.find('.mkdf-pc-percent'),
            max = parseFloat(counter.text());

        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });
    }

})(jQuery);
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
(function($) {
    'use strict';

    var singleImage = {};
    mkdf.modules.singleImage = singleImage;

    singleImage.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
    }
    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorSingleImage();
    }

    /**
     * Elementor
     */
    function mkdfElementorSingleImage(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_single_image.default', function() {
                mkdf.modules.common.mkdfPrettyPhoto();
            } );
        });
    }

})(jQuery);
(function ($) {
    'use strict';

    var stackedImages = {};
    mkdf.modules.stackedImages = stackedImages;

    stackedImages.mkdfInitItemShowcase = mkdfInitStackedImages;


    stackedImages.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitStackedImages();
    }

    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorStackedImages();
    }

    /**
     * Elementor
     */
    function mkdfElementorStackedImages(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_stacked_images.default', function() {
                mkdfInitStackedImages();
            } );
        });
    }

    /**
     * Init item showcase shortcode
     */
    function mkdfInitStackedImages() {
        var stackedImages = $('.mkdf-stacked-images-holder');

        if (stackedImages.length) {
            stackedImages.each(function () {
                var thisStackedImages = $(this),
                    itemImage = thisStackedImages.find('.mkdf-si-images');

                //logic
                thisStackedImages.animate({opacity: 1}, 200);

                setTimeout(function () {
                    thisStackedImages.appear(function () {
                        itemImage.addClass('mkdf-appeared');
                    }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
                }, 100);
            });
        }
    }

})(jQuery);
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
(function ($) {
    'use strict';

    var verticalSplitSlider = {};
    mkdf.modules.verticalSplitSlider = verticalSplitSlider;

    verticalSplitSlider.mkdfInitVerticalSplitSlider = mkdfInitVerticalSplitSlider;


    verticalSplitSlider.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitVerticalSplitSlider();
    }
    /**
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorVerticalSplitSlider();
    }

    /**
     * Elementor
     */
    function mkdfElementorVerticalSplitSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_vertical_split_slider.default', function() {
                mkdfInitVerticalSplitSlider();
            } );
        });
    }
    /*
     **	Vertical Split Slider
     */
    function mkdfInitVerticalSplitSlider() {
        var slider = $('.mkdf-vertical-split-slider');

        if (slider.length) {
            if (mkdf.body.hasClass('mkdf-vss-initialized')) {
                mkdf.body.removeClass('mkdf-vss-initialized');
                $.fn.multiscroll.destroy();
            }

            slider.height(mkdf.windowHeight).animate({opacity: 1}, 300);

            var defaultHeaderStyle = '';
            if (mkdf.body.hasClass('mkdf-light-header')) {
                defaultHeaderStyle = 'light';
            } else if (mkdf.body.hasClass('mkdf-dark-header')) {
                defaultHeaderStyle = 'dark';
            }

            slider.multiscroll({
                scrollingSpeed: 700,
                easing: 'easeInOutQuart',
                navigation: true,
                useAnchorsOnLoad: false,
                sectionSelector: '.mkdf-vss-ms-section',
                leftSelector: '.mkdf-vss-ms-left',
                rightSelector: '.mkdf-vss-ms-right',
                afterRender: function () {
                    mkdfCheckVerticalSplitSectionsForHeaderStyle($('.mkdf-vss-ms-left .mkdf-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
                    mkdf.body.addClass('mkdf-vss-initialized');

                    //prepare html for smaller screens - start //
                    var verticalSplitSliderResponsive = $('<div class="mkdf-vss-responsive"></div>'),
                        leftSide = slider.find('.mkdf-vss-ms-left > div'),
                        rightSide = slider.find('.mkdf-vss-ms-right > div');

                    slider.after(verticalSplitSliderResponsive);

                    for (var i = 0; i < leftSide.length; i++) {
                        verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
                        verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
                    }

                    //prepare google maps clones
                    var googleMapHolder = $('.mkdf-vss-responsive .mkdf-google-map');
                    if (googleMapHolder.length) {
                        googleMapHolder.each(function () {
                            var map = $(this);
                            map.empty();
                            var num = Math.floor((Math.random() * 100000) + 1);
                            map.attr('id', 'mkdf-map-' + num);
                            map.data('unique-id', num);
                        });
                    }

                    var contactForm7 = $('div.wpcf7 > form');
                    if (contactForm7.length) {
                        contactForm7.each(function () {
                            var thisForm = $(this);

                            thisForm.find('.wpcf7-submit').off().on('click', function (e) {
                                e.preventDefault();
                                wpcf7.submit(thisForm);
                            });
                        });
                    }

                    if (typeof mkdf.modules.animationHolder.mkdfInitAnimationHolder === "function") {
                        mkdf.modules.animationHolder.mkdfInitAnimationHolder();
                    }

                    if (typeof mkdf.modules.button.mkdfButton === "function") {
                        mkdf.modules.button.mkdfButton().init();
                    }

                    if (typeof mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle === "function") {
                        mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle();
                    }

                    if (typeof mkdf.modules.googleMap.mkdfShowGoogleMap === "function") {
                        mkdf.modules.googleMap.mkdfShowGoogleMap();
                    }

                    if (typeof mkdf.modules.icon.mkdfIcon === "function") {
                        mkdf.modules.icon.mkdfIcon().init();
                    }

                    if (typeof mkdf.modules.progressBar.mkdfInitProgressBars === "function") {
                        mkdf.modules.progressBar.mkdfInitProgressBars();
                    }
                },
                onLeave: function (index, nextIndex) {
                    mkdfIntiScrollAnimation(slider, nextIndex);
                    mkdfCheckVerticalSplitSectionsForHeaderStyle($($('.mkdf-vss-ms-left .mkdf-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
                }
            });

            if (mkdf.windowWidth <= 1024) {
                $.fn.multiscroll.destroy();
            } else {
                $.fn.multiscroll.build();
            }

            $(window).resize(function () {
                if (mkdf.windowWidth <= 1024) {
                    $.fn.multiscroll.destroy();
                } else {
                    $.fn.multiscroll.build();
                }
            });
        }
    }

    function mkdfIntiScrollAnimation(slider, nextIndex) {

        if (slider.hasClass('mkdf-vss-scrolling-animation')) {

            if (nextIndex > 1 && !slider.hasClass('mkdf-vss-scrolled')) {
                slider.addClass('mkdf-vss-scrolled');
            } else if (nextIndex === 1 && slider.hasClass('mkdf-vss-scrolled')) {
                slider.removeClass('mkdf-vss-scrolled');
            }
        }
    }

    /*
     **	Check slides on load and slide change for header style changing
     */
    function mkdfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
        if (section_header_style !== undefined && section_header_style !== '') {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + default_header_style + '-header');
        } else {
            mkdf.body.removeClass('mkdf-light-header mkdf-dark-header');
        }
    }

})(jQuery);

(function ($) {
	'use strict';
	
	var videoButton = {};
	mkdf.modules.videoButton = videoButton;


    videoButton.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).on('load',mkdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnWindowLoad() {
        mkdfElementorVideoButton();
	}


    /**
     * Elementor Team Carousel
     */
    function mkdfElementorVideoButton() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_video_button.default', function () {
                mkdf.modules.common.mkdfPrettyPhoto();
            });
        });
    }
	
})(jQuery);
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
(function ($) {
    'use strict';

    var testimonialsCarousel = {};
    mkdf.modules.testimonialsCarousel = testimonialsCarousel;

    testimonialsCarousel.mkdfInitTestimonials = mkdfInitTestimonialsCarousel;


    testimonialsCarousel.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).on('load',mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).on('load',) should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitTestimonialsCarousel();
        mkdfInitTestimonialsBGText();
        mkdfElementorTestimonialsCarousel();
    }

    /**
     * Elementor
     */
    function mkdfElementorTestimonialsCarousel(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_testimonials.default', function() {
                mkdf.modules.common.mkdfOwlSlider();
                mkdfInitTestimonialsCarousel();
            } );
        });
    }

    /**
     * Init testimonials shortcode elegant type
     */
    function mkdfInitTestimonialsCarousel() {
        var testimonial = $('.mkdf-testimonials-holder.mkdf-testimonials-carousel');

        if (testimonial.length) {
            testimonial.each(function () {
                var thisTestimonials = $(this),
                    mainTestimonialsSlider = thisTestimonials.find('.mkdf-testimonials-main'),
                    imagePagSlider = thisTestimonials.children('.mkdf-testimonial-image-nav'),
                    loop = true,
                    autoplay = true,
                    sliderSpeed = 5000,
                    sliderSpeedAnimation = 600,
                    mouseDrag = false;

                if (mainTestimonialsSlider.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (mainTestimonialsSlider.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (typeof mainTestimonialsSlider.data('slider-speed') !== 'undefined' && mainTestimonialsSlider.data('slider-speed') !== false) {
                    sliderSpeed = mainTestimonialsSlider.data('slider-speed');
                }
                if (typeof mainTestimonialsSlider.data('slider-speed-animation') !== 'undefined' && mainTestimonialsSlider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = mainTestimonialsSlider.data('slider-speed-animation');
                }
                if (mkdf.windowWidth < 680) {
                    mouseDrag = true;
                }

                if (mainTestimonialsSlider.length && imagePagSlider.length) {
                    var text = mainTestimonialsSlider.owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: mouseDrag,
                        onInitialize: function () {
                            mainTestimonialsSlider.css('visibility', 'visible');
                        }
                    });

                    var image = imagePagSlider.owlCarousel({
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        center: true,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: false,
                        responsive: {
                            1025: {
                                items: 5
                            },
                            0: {
                                items: 3
                            }
                        },
                        onInitialize: function () {
                            imagePagSlider.css('visibility', 'visible');
                            thisTestimonials.css('opacity', '1');
                        }
                    });

                    imagePagSlider.find('.owl-item').on('click touchpress', function (e) {
                        e.preventDefault();

                        var thisItem = $(this),
                            itemIndex = thisItem.index(),
                            numberOfClones = imagePagSlider.find('.owl-item.cloned').length,
                            modifiedItems = itemIndex - numberOfClones / 2 >= 0 ? itemIndex - numberOfClones / 2 : itemIndex;

                        image.trigger('to.owl.carousel', modifiedItems);
                        text.trigger('to.owl.carousel', modifiedItems);
                    });

                }
            });
        }
    }

    function mkdfInitTestimonialsBGText(){
        var bgText = $('.mkdf-testimonials-background-text');

        if(bgText.length){
            bgText.each(function(){
                var thisBgText = $(this);

                thisBgText.appear(function(){
                    thisBgText.addClass('mkdf-background-text-appeared');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

})(jQuery);
(function ($) {
    'use strict';

    var testimonialsImagePagination = {};
    mkdf.modules.testimonialsImagePagination = testimonialsImagePagination;

    testimonialsImagePagination.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load',mkdfOnWindowLoad);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfTestimonialsImagePagination();
    }

    /**
    All functions to be called on $(window).on('load',) should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorTestimonialsImagePagination();
    }

    /**
     * Elementor
     */
    function mkdfElementorTestimonialsImagePagination(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_testimonials.default', function() {
                mkdfTestimonialsImagePagination();
            } );
        });
    }

    /**
     * Init Owl Carousel
     */
    function mkdfTestimonialsImagePagination() {
        var sliders = $('.mkdf-testimonials-image-pagination-inner');

        if (sliders.length) {
            sliders.each(function () {
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = false,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 500,
                    margin = 0,
                    stagePadding = 0,
                    center = false,
                    autoWidth = false,
                    animateInClass = false, // keyframe css animation
                    animateOutClass = false, // keyframe css animation
                    navigation = true,
                    pagination = false,
                    drag = true,
                    sliderDataHolder = slider;

                if (sliderDataHolder.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
                    sliderSpeed = sliderDataHolder.data('slider-speed');
                }
                if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
                }
                if (sliderDataHolder.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
                    animateInClass = sliderDataHolder.data('slider-animate-in');
                }
                if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
                }
                if (sliderDataHolder.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (sliderDataHolder.data('enable-pagination') === 'yes') {
                    pagination = true;
                }

                if (navigation && pagination) {
                    slider.addClass('mkdf-slider-has-both-nav');
                }

                if (pagination) {
                    var dotsContainer = '#mkdf-testimonial-pagination';
                    $('.mkdf-tsp-item').on('click', function () {
                        slider.trigger('to.owl.carousel', [$(this).index(), 300]);
                    });
                }

                if (slideItemsNumber <= 1) {
                    loop = false;
                    autoplay = false;
                    navigation = false;
                    pagination = false;
                }

                slider.waitForImages(function () {
                    $(this).owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayHoverPause: autoplayHoverPause,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        margin: margin,
                        stagePadding: stagePadding,
                        center: center,
                        autoWidth: autoWidth,
                        animateIn: animateInClass,
                        animateOut: animateOutClass,
                        dots: pagination,
                        dotsContainer: dotsContainer,
                        nav: navigation,
                        drag: drag,
                        callbacks: true,
                        navText: [
                            '<span class="mkdf-prev-icon ion-chevron-left"></span>',
                            '<span class="mkdf-next-icon ion-chevron-right"></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        },
                        onDrag: function (e) {
                            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
                                var sliderIsMoving = e.isTrigger > 0;

                                if (sliderIsMoving) {
                                    slider.addClass('mkdf-slider-is-moving');
                                }
                            }
                        },
                        onDragged: function () {
                            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout') && slider.hasClass('mkdf-slider-is-moving')) {

                                setTimeout(function () {
                                    slider.removeClass('mkdf-slider-is-moving');
                                }, 500);
                            }
                        }
                    });

                });
            });
        }
    }

})(jQuery);