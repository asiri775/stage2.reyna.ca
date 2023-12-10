<?php

if (!function_exists('curly_core_add_video_button_shortcodes')) {
    function curly_core_add_video_button_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'CurlyCore\CPT\Shortcodes\VideoButton\VideoButton'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('curly_core_filter_add_vc_shortcode', 'curly_core_add_video_button_shortcodes');
}

if (!function_exists('curly_core_set_video_button_icon_class_name_for_vc_shortcodes')) {
    /**
     * Function that set custom icon class name for video button shortcode to set our icon for Visual Composer shortcodes panel
     */
    function curly_core_set_video_button_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-video-button';

        return $shortcodes_icon_class_array;
    }

    add_filter('curly_core_filter_add_vc_shortcodes_custom_icon_class', 'curly_core_set_video_button_icon_class_name_for_vc_shortcodes');
}