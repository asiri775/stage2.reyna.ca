<?php

if (!function_exists('curly_business_services_meta_box_functions')) {
    function curly_business_services_meta_box_functions($post_types) {
        $post_types[] = 'business-services';

        return $post_types;
    }

    add_filter('curly_mkdf_meta_box_post_types_save', 'curly_business_services_meta_box_functions');
    add_filter('curly_mkdf_meta_box_post_types_remove', 'curly_business_services_meta_box_functions');
}

if (!function_exists('curly_business_register_business_services_cpt')) {
    function curly_business_register_business_services_cpt($cpt_class_name) {
        $cpt_class = array(
            'CurlyBusiness\CPT\BusinessServices\BusinessServicesRegister'
        );

        $cpt_class_name = array_merge($cpt_class_name, $cpt_class);

        return $cpt_class_name;
    }

    add_filter('curly_business_filter_register_custom_post_types', 'curly_business_register_business_services_cpt');
}

// Load business menu shortcodes
if (!function_exists('curly_business_include_business_services_shortcodes_file')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function curly_business_include_business_services_shortcodes_file() {
	    if ( curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
		    foreach ( glob( CURLY_BUSINESS_CPT_PATH . '/business-services/shortcodes/*/load.php' ) as $shortcode_load ) {
			    include_once $shortcode_load;
		    }
	    }
    }

    add_action('curly_business_include_shortcode_files', 'curly_business_include_business_services_shortcodes_file');
}

if ( ! function_exists( 'curly_core_include_business_service_elementor_widgets_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function curly_core_include_business_service_elementor_widgets_files() {
		if ( curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
			foreach (glob(CURLY_BUSINESS_CPT_PATH . '/business-services/shortcodes/*/elementor-*.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'curly_core_include_business_service_elementor_widgets_files' );
}

