<?php
/*
Plugin Name: Curly Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Mikado Themes
Version: 2.1.2
*/

include_once 'load.php';

if (!function_exists('curly_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function curly_instagram_feed_text_domain() {
        load_plugin_textdomain('curly-instagram-feed', false, CURLY_INSTAGRAM_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'curly_instagram_feed_text_domain');
}
