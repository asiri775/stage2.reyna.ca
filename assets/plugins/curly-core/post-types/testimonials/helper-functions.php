<?php

if (!function_exists('curly_core_testimonials_meta_box_functions')) {
    function curly_core_testimonials_meta_box_functions($post_types) {
        $post_types[] = 'testimonials';

        return $post_types;
    }

    add_filter('curly_mkdf_meta_box_post_types_save', 'curly_core_testimonials_meta_box_functions');
    add_filter('curly_mkdf_meta_box_post_types_remove', 'curly_core_testimonials_meta_box_functions');
}

if (!function_exists('curly_core_register_testimonials_cpt')) {
    function curly_core_register_testimonials_cpt($cpt_class_name) {
        $cpt_class = array(
            'CurlyCore\CPT\Testimonials\TestimonialsRegister'
        );

        $cpt_class_name = array_merge($cpt_class_name, $cpt_class);

        return $cpt_class_name;
    }

    add_filter('curly_core_filter_register_custom_post_types', 'curly_core_register_testimonials_cpt');
}

// Load testimonials shortcodes
if (!function_exists('curly_core_include_testimonials_shortcodes_files')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function curly_core_include_testimonials_shortcodes_files() {
	    if( curly_core_is_theme_registered() ) {
		    foreach ( glob( CURLY_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load ) {
			    include_once $shortcode_load;
		    }
	    }
    }

    add_action('curly_core_action_include_shortcodes_file', 'curly_core_include_testimonials_shortcodes_files');
}
// Load testimonials elementor widgets
if ( ! function_exists( 'curly_core_include_testimonials_elementor_widgets_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function curly_core_include_testimonials_elementor_widgets_files() {
		if ( curly_core_theme_installed() && curly_core_is_theme_registered()) {
			foreach (glob(CURLY_CORE_CPT_PATH . '/testimonials/shortcodes/*/elementor-*.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'curly_core_include_testimonials_elementor_widgets_files' );
}