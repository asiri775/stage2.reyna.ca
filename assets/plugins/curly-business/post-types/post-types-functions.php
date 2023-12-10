<?php

if (!function_exists('curly_business_include_custom_post_types_files')) {
    /**
     * Loads all custom post types by going through all folders that are placed directly in post types folder
     */
    function curly_business_include_custom_post_types_files() {
        if (curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
            foreach (glob(CURLY_BUSINESS_CPT_PATH . '/*/load.php') as $cpt_load) {
                include_once $cpt_load;
            }
        }
    }

    add_action('after_setup_theme', 'curly_business_include_custom_post_types_files', 1);
}

if (!function_exists('curly_business_include_custom_post_types_meta_boxes')) {
    /**
     * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
     */
    function curly_business_include_custom_post_types_meta_boxes() {
        if (curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
            foreach (glob(CURLY_BUSINESS_CPT_PATH . '/*/admin/meta-boxes/*.php') as $meta_boxes_map) {
                include_once $meta_boxes_map;
            }
        }
    }

    add_action('curly_mkdf_before_meta_boxes_map', 'curly_business_include_custom_post_types_meta_boxes');
}