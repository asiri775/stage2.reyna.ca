<?php

include_once CURLY_BUSINESS_SHORTCODES_PATH . '/working-hours/functions.php';
include_once CURLY_BUSINESS_SHORTCODES_PATH . '/working-hours/working-hours.php';

if ( ! function_exists( 'curly_core_include_working_hours_widgets_files' ) ) {
	function curly_core_include_working_hours_widgets_files() {
		if ( curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
			include_once CURLY_BUSINESS_SHORTCODES_PATH . '/working-hours/elementor-working-hours.php';
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'curly_core_include_working_hours_widgets_files' );
}