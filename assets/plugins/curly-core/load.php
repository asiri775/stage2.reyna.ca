<?php

require_once 'const.php';

//load lib
require_once 'lib/google-fonts.php';
require_once 'lib/helpers-functions.php';

//load widgets
require_once 'widgets/load.php';

//load shortcodes
require_once 'lib/shortcode-interface.php';
require_once 'shortcodes/shortcodes-functions.php';

//load post-post-types
require_once 'lib/post-type-interface.php';
require_once 'post-types/post-types-functions.php';
require_once 'post-types/post-types-register.php'; //this has to be loaded last

//load dashboard
if ( file_exists( CURLY_CORE_ABS_PATH . '/core-dashboard' ) ) {
	require_once 'core-dashboard/load.php';
}

//load export
require_once 'backup/functions.php';

//load reviews
require_once 'reviews/load.php';