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