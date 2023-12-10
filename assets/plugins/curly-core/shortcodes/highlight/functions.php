<?php

if (!function_exists('curly_core_add_highlight_shortcodes')) {
    function curly_core_add_highlight_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'CurlyCore\CPT\Shortcodes\Highlight\Highlight'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('curly_core_filter_add_vc_shortcode', 'curly_core_add_highlight_shortcodes');
}