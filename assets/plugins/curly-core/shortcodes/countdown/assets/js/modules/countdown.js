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