<?php

if ( ! function_exists( 'curly_core_add_import_sub_page_to_list' ) ) {
	function curly_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'CurlyCoreImportPage';
		return $sub_pages;
	}
	
	add_filter( 'curly_core_filter_add_sub_page', 'curly_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'CurlyCoreSubPage' ) ) {
	class CurlyCoreImportPage extends CurlyCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__('Import', 'curly-core'));
			$this->set_atts( $this->set_atributtes());
		}

		public function set_atributtes(){
			$params = array();

			$iparams = CurlyCoreDashboard::get_instance()->get_import_params();
			if(is_array($iparams) && isset($iparams['submit'])) {
				$params['submit'] = $iparams['submit'];
			}

			return $params;
		}
	}
}