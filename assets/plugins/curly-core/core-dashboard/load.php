<?php

require_once CURLY_CORE_ABS_PATH . '/core-dashboard/core-dashboard.php';

if ( ! function_exists( 'curly_core_dashboard_load_files' ) ) {
	function curly_core_dashboard_load_files() {
		require_once CURLY_CORE_ABS_PATH . '/core-dashboard/rest/include.php';
		require_once CURLY_CORE_ABS_PATH . '/core-dashboard/registration-rest.php';
		require_once CURLY_CORE_ABS_PATH . '/core-dashboard/validation-rest.php';
		require_once CURLY_CORE_ABS_PATH . '/core-dashboard/sub-pages/sub-page.php';

		foreach (glob(CURLY_CORE_ABS_PATH . '/core-dashboard/sub-pages/*/load.php') as $subpages) {
			include_once $subpages;
		}
		
		
	}

	add_action('after_setup_theme', 'curly_core_dashboard_load_files');
}

