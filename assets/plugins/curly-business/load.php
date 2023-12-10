<?php

include_once 'const.php';

// load lib
include_once 'lib/helpers-functions.php';
require_once 'lib/shortcode-interface.php';
require_once 'lib/shortcode-loader.php';
require_once 'lib/shortcode-functions.php';
require_once 'lib/widget-loader.php';

// load post-post-types
require_once 'lib/post-type-interface.php';
require_once 'post-types/post-types-functions.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last

// load admin
if (!function_exists('curly_business_load_admin')) {
    function curly_business_load_admin() {
        require_once 'admin/options/map.php';
    }

    add_action('curly_mkdf_before_options_map', 'curly_business_load_admin');
}