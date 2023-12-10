<?php
if ( class_exists( 'CurlyCoreDashboardRestAPI' ) ) {
	class CurlyCoreDashboardThemeValidation extends CurlyCoreDashboardRestAPI {
		private static $instance;
		public function __construct() {
			parent::__construct();
			$this->set_route( 'theme-validation' );
		}
		/**
		 * @return CurlyCoreDashboardRestAPI|CurlyCoreDashboardThemeValidation
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		public function localize_script( $global ) {
			$global['validationThemeRoute'] = esc_attr( $this->get_namespace() . '/' . $this->get_route() );
			return $global;
		}
		public function register_rest_api_route() {
			register_rest_route(
				$this->get_namespace(),
				$this->get_route(),
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( CurlyCoreDashboard::get_instance(), 'theme_validation' ),
					'permission_callback' => function () {
						return true;
					},
					'args'                => array(
						'options' => array(
							'required'          => true,
							'validate_callback' => function ( $param, $request, $key ) {
								// Simple solution for validation can be 'is_array' value instead of callback function
								return is_array( $param ) ? $param : (array) strip_tags( $param );
							},
							'description'       => esc_html__( 'Options data is array with parameters', 'curly-core' ),
						),
					),
				)
			);
		}
	}
	CurlyCoreDashboardThemeValidation::get_instance();
}