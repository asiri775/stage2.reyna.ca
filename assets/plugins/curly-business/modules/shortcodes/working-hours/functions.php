<?php

if (!function_exists('curly_business_add_working_hours_shortcodes')) {
    function curly_business_add_working_hours_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'CurlyBusiness\Shortcodes\WorkingHours\WorkingHours'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('curly_business_add_vc_shortcode', 'curly_business_add_working_hours_shortcodes');
}

if (!function_exists('curly_business_set_working_hours_icon_class_name_for_vc_shortcodes')) {
    /**
     * Function that set custom icon class name for property list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function curly_business_set_working_hours_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-working-hours';

        return $shortcodes_icon_class_array;
    }

    add_filter('curly_business_filter_add_vc_shortcodes_custom_icon_class', 'curly_business_set_working_hours_icon_class_name_for_vc_shortcodes');
}
