<?php
/*
Plugin Name: Curly Core
Description: Plugin that adds all post types needed by our theme
Author: Mikado Themes
Version: 2.1.2
*/

require_once 'load.php';

add_action('after_setup_theme', array(CurlyCore\CPT\PostTypesRegister::getInstance(), 'register'));

if (!function_exists('curly_core_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines curly_mkdf_core_on_activate action
     */
    function curly_core_activation() {
        do_action('curly_mkdf_core_on_activate');

        CurlyCore\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'curly_core_activation');
}

if (!function_exists('curly_core_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function curly_core_text_domain() {
        load_plugin_textdomain('curly-core', false, CURLY_CORE_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'curly_core_text_domain');
}

if (!function_exists('curly_core_version_class')) {
    /**
     * Adds plugins version class to body
     *
     * @param $classes
     *
     * @return array
     */
    function curly_core_version_class($classes) {
        $classes[] = 'curly-core-' . CURLY_CORE_VERSION;

        return $classes;
    }

    add_filter('body_class', 'curly_core_version_class');
}

if (!function_exists('curly_core_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function curly_core_theme_installed() {
        return defined('MIKADO_ROOT');
    }
}

if (!function_exists('curly_core_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function curly_core_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('curly_core_is_woocommerce_integration_installed')) {
    //is Mikado Woocommerce Integration installed?
    function curly_core_is_woocommerce_integration_installed() {
        return defined('CURLY_CHECKOUT_INTEGRATION');
    }
}

if (!function_exists('curly_core_is_revolution_slider_installed')) {
    function curly_core_is_revolution_slider_installed() {
        return class_exists('RevSliderFront');
    }
}

if (!function_exists('curly_core_is_elementor_installed')) {
	function curly_core_is_elementor_installed() {
		return defined('ELEMENTOR_VERSION');
	}
}

if (!function_exists('curly_core_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function curly_core_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if (!function_exists('curly_core_theme_menu')) {
    /**
     * Function that generates admin menu for options page.
     * It generates one admin page per options page.
     */
    function curly_core_theme_menu() {
        if (curly_core_theme_installed() && curly_core_is_theme_registered()) {

            global $curly_mkdf_Framework;
            curly_mkdf_init_theme_options();

            $page_hook_suffix = add_menu_page(
                esc_html__('Curly Options', 'curly-core'), // The value used to populate the browser's title bar when the menu page is active
                esc_html__('Curly Options', 'curly-core'), // The text of the menu in the administrator's sidebar
                'administrator',                            // What roles are able to access the menu
                MIKADO_OPTIONS_SLUG,            // The ID used to bind submenu items to this menu
                array($curly_mkdf_Framework->getSkin(), 'renderOptions'), // The callback function used to render this menu
                $curly_mkdf_Framework->getSkin()->getSkinURI() . '/assets/img/admin-logo-icon.png', // Icon For menu Item
                4                                                                                            // Position
            );

            foreach ($curly_mkdf_Framework->mkdOptions->adminPages as $key => $value) {
                $slug = "";

                if (!empty($value->slug)) {
                    $slug = "_tab" . $value->slug;
                }

                $subpage_hook_suffix = add_submenu_page(
                    MIKADO_OPTIONS_SLUG,
                    esc_html__('Curly Options - ', 'curly-core') . $value->title, // The value used to populate the browser's title bar when the menu page is active
                    $value->title,                                                 // The text of the menu in the administrator's sidebar
                    'administrator',                                               // What roles are able to access the menu
                    MIKADO_OPTIONS_SLUG . $slug,                       // The ID used to bind submenu items to this menu
                    array($curly_mkdf_Framework->getSkin(), 'renderOptions')
                );

                add_action('admin_print_scripts-' . $subpage_hook_suffix, 'curly_mkdf_enqueue_admin_scripts');
                add_action('admin_print_styles-' . $subpage_hook_suffix, 'curly_mkdf_enqueue_admin_styles');
            };

            add_action('admin_print_scripts-' . $page_hook_suffix, 'curly_mkdf_enqueue_admin_scripts');
            add_action('admin_print_styles-' . $page_hook_suffix, 'curly_mkdf_enqueue_admin_styles');
        }
    }

    add_action('admin_menu', 'curly_core_theme_menu');
}

if (!function_exists('curly_core_theme_menu_backup_options')) {
    /**
     * Function that generates admin menu for options page.
     * It generates one admin page per options page.
     */
    function curly_core_theme_menu_backup_options() {
        if (curly_core_theme_installed() && curly_core_is_theme_registered()) {
            global $curly_mkdf_Framework;

            $slug = "_backup_options";
            $page_hook_suffix = add_submenu_page(
                MIKADO_OPTIONS_SLUG,
                esc_html__('Curly Options - Backup Options', 'curly-core'), // The value used to populate the browser's title bar when the menu page is active
                esc_html__('Backup Options', 'curly-core'),                // The text of the menu in the administrator's sidebar
                'administrator',                                             // What roles are able to access the menu
                MIKADO_OPTIONS_SLUG . $slug,                     // The ID used to bind submenu items to this menu
                array($curly_mkdf_Framework->getSkin(), 'renderBackupOptions')
            );

            add_action('admin_print_scripts-' . $page_hook_suffix, 'curly_mkdf_enqueue_admin_scripts');
            add_action('admin_print_styles-' . $page_hook_suffix, 'curly_mkdf_enqueue_admin_styles');
        }
    }

    add_action('admin_menu', 'curly_core_theme_menu_backup_options');
}

if (!function_exists('curly_core_theme_admin_bar_menu_options')) {
    /**
     * Add a link to the WP Toolbar
     */
    function curly_core_theme_admin_bar_menu_options($wp_admin_bar) {
	    if ( curly_core_theme_installed() && current_user_can( 'administrator' ) && curly_core_is_theme_registered() ) {
		    global $curly_mkdf_Framework;
		
		    $args = array(
			    'id'    => 'curly-admin-bar-options',
			    'title' => sprintf( '<span class="ab-icon dashicons-before dashicons-admin-generic"></span> %s', esc_html__( 'Curly Options', 'curly-core' ) ),
			    'href'  => esc_url( admin_url( 'admin.php?page=' . MIKADO_OPTIONS_SLUG ) )
		    );
		
		    $wp_admin_bar->add_node( $args );
		
		    foreach ( $curly_mkdf_Framework->mkdOptions->adminPages as $key => $value ) {
			    $suffix = ! empty( $value->slug ) ? '_tab' . $value->slug : '';
			
			    $args = array(
				    'id'     => 'curly-admin-bar-options-' . $suffix,
				    'title'  => $value->title,
				    'parent' => 'curly-admin-bar-options',
				    'href'   => esc_url( admin_url( 'admin.php?page=' . MIKADO_OPTIONS_SLUG . $suffix ) )
			    );
			
			    $wp_admin_bar->add_node( $args );
		    };
	    }
    }

    add_action('admin_bar_menu', 'curly_core_theme_admin_bar_menu_options', 999);
}

if( ! function_exists( 'curly_core_is_theme_registered' ) ) {
	function curly_core_is_theme_registered() {
		return class_exists('CurlyCoreDashboard') ? CurlyCoreDashboard::get_instance()->is_theme_registered() : true;
	}
}
