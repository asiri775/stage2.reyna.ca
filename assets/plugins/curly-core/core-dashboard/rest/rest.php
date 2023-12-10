<?php

if ( ! class_exists( 'CurlyCoreDashboardRestAPI' ) ) {
	/**
	 * Rest API class with configuration
	 */
	class CurlyCoreDashboardRestAPI {
		private static $instance;
		private $namespace;
		private $route;

		public function __construct() {
			// Init variables
			$this->set_namespace( 'qode-api/v1' );
			$this->set_route( 'dashboard' );

			// Localize theme's main js script with rest variable
			add_filter( 'curly_core_dashboard_filter_js_global_variables', array( $this, 'localize_script' ) );

			// Function that register Rest API routes
			add_action( 'rest_api_init', array( $this, 'register_rest_api_route' ) );
		}

		public static function get_instance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function get_namespace() {
			return $this->namespace;
		}

		public function set_namespace( $namespace ) {
			$this->namespace = $namespace;
		}

		public function get_route() {
			return $this->route;
		}

		public function set_route( $route ) {
			$this->route = $route;
		}

		function localize_script( $global ) {
			$global['restUrl']   = esc_url_raw( rest_url() );
			$global['restRoute'] = esc_attr( $this->get_namespace() . '/' . $this->get_route() );
			$global['restNonce'] = wp_create_nonce( 'wp_rest' );

			return $global;
		}

		function register_rest_api_route() {}
	}

	CurlyCoreDashboardRestAPI::get_instance();
}