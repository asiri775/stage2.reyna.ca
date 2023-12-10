<?php
/*
Plugin Name: Curly Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Mikado Themes
Version: 2.0.2
*/


include_once 'load.php';

if (!function_exists('curly_twitter_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function curly_twitter_theme_installed() {
        return defined('MIKADO_ROOT');
    }
}

if (!function_exists('curly_twitter_core_plugin_installed')) {
	function curly_twitter_core_plugin_installed() {
		return defined('CURLY_CORE_VERSION');
	}
}

if (!function_exists('curly_twitter_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function curly_twitter_feed_text_domain() {
        load_plugin_textdomain('curly-twitter-feed', false, CURLY_TWITTER_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'curly_twitter_feed_text_domain');
}