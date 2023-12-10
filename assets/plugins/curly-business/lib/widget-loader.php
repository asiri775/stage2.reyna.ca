<?php

if (!function_exists('curly_business_include_widgets_file')) {
    /**
     * Loads all widgets by going through all folders that are placed directly in widgets folder
     */
    function curly_business_include_widgets_file() {
        if (curly_business_theme_installed()) {
            foreach (glob(CURLY_BUSINESS_WIDGETS_PATH . '/*/load.php') as $widget_load) {
                include_once $widget_load;
            }
            do_action('curly_business_include_widget_files');
        }
    }

    add_action('curly_mkdf_before_options_map', 'curly_business_include_widgets_file', 20);
}