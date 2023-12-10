<?php

if (!function_exists('curly_business_register_working_hours_widget')) {
    /**
     * Function that register sidearea opener widget
     */
    function curly_business_register_working_hours_widget($widgets) {
        $widgets[] = 'CurlyBusinessWorkingHours';

        return $widgets;
    }

    add_filter('curly_core_filter_register_widgets', 'curly_business_register_working_hours_widget');
}