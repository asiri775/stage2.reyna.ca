<?php

if ( ! function_exists( 'curly_core_set_contact_form_7_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for contact_form_7 shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function curly_core_set_contact_form_7_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-contact-form-7';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'curly_core_filter_add_vc_shortcodes_custom_icon_class', 'curly_core_set_contact_form_7_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'curly_core_exclude_contact_form_7_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for contact_form_7 shortcode to set our icon for Visual Composer shortcodes panel
     */
    function curly_core_exclude_contact_form_7_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-contact-form-7';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'curly_core_filter_exclude_vc_shortcodes_custom_icon_class', 'curly_core_exclude_contact_form_7_icon_class_name_for_vc_shortcodes' );
}