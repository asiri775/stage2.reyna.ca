<?php
/*
Plugin Name: Curly Business
Description: Plugin that adds features to our theme
Author: Mikado Themes
Version: 2.0.3
*/

include_once 'load.php';

add_action('after_setup_theme', array(CurlyBusiness\CPT\PostTypesRegister::getInstance(), 'register'));

if (!function_exists('curly_business_load_assets')) {
    function curly_business_load_assets() {
        wp_enqueue_style('curly-business-style', plugins_url('/assets/css/business.min.css', __FILE__), array(), '');

        if (function_exists('curly_mkdf_is_responsive_on') && curly_mkdf_is_responsive_on()) {
            wp_enqueue_style('curly-business-responsive-style', plugins_url('/assets/css/business-responsive.min.css', __FILE__), array(), '');
        }

        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('curly-business-script', plugins_url('/assets/js/business.min.js', __FILE__), array('jquery'), '', true);
    }

    add_action('wp_enqueue_scripts', 'curly_business_load_assets', 11);
}

if (!function_exists('curly_business_style_dynamics_deps')) {
    function curly_business_style_dynamics_deps($deps) {
        $style_dynamic_deps_array = array();
        $style_dynamic_deps_array[] = 'curly-business-style';

        if (function_exists('curly_mkdf_is_responsive_on') && curly_mkdf_is_responsive_on()) {
            $style_dynamic_deps_array[] = 'curly-business-responsive-style';
        }

        return array_merge($deps, $style_dynamic_deps_array);
    }

    add_filter('curly_mkdf_style_dynamic_deps', 'curly_business_style_dynamics_deps');
}