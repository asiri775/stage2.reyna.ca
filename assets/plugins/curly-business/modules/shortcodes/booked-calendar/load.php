<?php

if (function_exists('curly_business_is_booked_calendar_installed')) {
    if (curly_business_is_booked_calendar_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
        include_once CURLY_BUSINESS_SHORTCODES_PATH . '/booked-calendar/functions.php';
        include_once CURLY_BUSINESS_SHORTCODES_PATH . '/booked-calendar/booked-calendar.php';
    }
}
if ( ! function_exists( 'curly_core_include_booked_calendar_widgets_files' ) ) {
	function curly_core_include_booked_calendar_widgets_files() {
		if ( curly_business_theme_installed() && curly_business_is_booked_calendar_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
			include_once CURLY_BUSINESS_SHORTCODES_PATH . '/booked-calendar/elementor-booked-calendar.php';
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'curly_core_include_booked_calendar_widgets_files' );
}