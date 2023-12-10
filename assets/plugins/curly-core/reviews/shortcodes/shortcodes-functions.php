<?php

if (!function_exists('curly_core_include_reviews_shortcodes_files')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function curly_core_include_reviews_shortcodes_files() {
	    if ( curly_core_theme_installed() && curly_core_is_theme_registered() ) {
		    foreach ( glob( CURLY_CORE_ABS_PATH . '/reviews/shortcodes/*/load.php' ) as $shortcode_load ) {
			    include_once $shortcode_load;
		    }
	    }
    }

    add_action('curly_core_action_include_shortcodes_file', 'curly_core_include_reviews_shortcodes_files');
}