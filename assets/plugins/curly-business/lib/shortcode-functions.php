<?php

if (!function_exists('curly_business_include_shortcodes_file')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function curly_business_include_shortcodes_file() {
        if (curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
            foreach (glob(CURLY_BUSINESS_SHORTCODES_PATH . '/*/load.php') as $shortcode_load) {
                include_once $shortcode_load;
            }
            do_action('curly_business_include_shortcode_files');
        }
    }

    add_action('init', 'curly_business_include_shortcodes_file', 6);
}

if (!function_exists('curly_business_load_shortcodes')) {
    function curly_business_load_shortcodes() {
        include_once CURLY_BUSINESS_ABS_PATH . '/lib/shortcode-loader.php';
        CurlyBusiness\Lib\ShortcodeLoader::getInstance()->load();
    }

    add_action('init', 'curly_business_load_shortcodes', 7);
}

if (!function_exists('curly_business_add_admin_shortcodes_styles')) {
    /**
     * Function that includes shortcodes core styles for admin
     */
    function curly_business_add_admin_shortcodes_styles() {

        //include shortcode styles for Visual Composer
        wp_enqueue_style('curly-business-vc-shortcodes', CURLY_BUSINESS_ASSETS_URL_PATH . '/css/admin/curly-vc-shortcodes.css');
    }

    add_action('curly_mkdf_admin_scripts_init', 'curly_business_add_admin_shortcodes_styles');
}

if (!function_exists('curly_business_add_admin_shortcodes_custom_styles')) {
    /**
     * Function that print custom vc shortcodes style
     */
    function curly_business_add_admin_shortcodes_custom_styles() {
        $style = apply_filters('curly_business_filter_add_vc_shortcodes_custom_style', $style = '');
        $shortcodes_icon_styles = array();
        $shortcode_icon_size = 32;
        $shortcode_position = 0;

        $shortcodes_icon_class_array = apply_filters('curly_business_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array());
        sort($shortcodes_icon_class_array);

        if (!empty($shortcodes_icon_class_array)) {
            foreach ($shortcodes_icon_class_array as $shortcode_icon_class) {
                $mark = $shortcode_position != 0 ? '-' : '';

                $shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-business-icon' . esc_attr($shortcode_icon_class) . ' {
					background-position: ' . $mark . esc_attr($shortcode_position * $shortcode_icon_size) . 'px 0;
				}';

                $shortcode_position++;
            }
        }

        if (!empty($shortcodes_icon_styles)) {
            $style .= implode(' ', $shortcodes_icon_styles);
        }

        if (!empty($style)) {
            wp_add_inline_style('curly-business-vc-shortcodes', $style);
        }
    }

    add_action('curly_mkdf_admin_scripts_init', 'curly_business_add_admin_shortcodes_custom_styles');
}

if ( ! function_exists( 'curly_business_get_elementor_shortcodes_path' ) ) {
	function curly_business_get_elementor_shortcodes_path() {
		$shortcodes       = array();
		$shortcodes_paths = array(
			CURLY_BUSINESS_SHORTCODES_PATH . '/*' => CURLY_BUSINESS_URL_PATH,
			CURLY_BUSINESS_CPT_PATH . '/**/shortcodes/*' => CURLY_BUSINESS_URL_PATH,
		);

		foreach ( $shortcodes_paths as $dir_path => $url_path ) {
			foreach ( glob( $dir_path, GLOB_ONLYDIR ) as $shortcode_dir_path ) {
				$shortcode_name     = basename( $shortcode_dir_path );
				$shortcode_url_path = $url_path . substr( $shortcode_dir_path, strpos( $shortcode_dir_path, basename( $url_path ) ) + strlen( basename( $url_path ) ) + 1 );

				$shortcodes[ $shortcode_name ] = array(
					'dir_path' => $shortcode_dir_path,
					'url_path' => $shortcode_url_path
				);
			}
		}

		return $shortcodes;
	}
}
if ( ! function_exists( 'curly_business_add_elementor_shortcodes_custom_styles' ) ) {
	function curly_business_add_elementor_shortcodes_custom_styles() {
		$style                  = '';
		$shortcodes_icon_styles = array();

		$shortcodes_icon_class_array = apply_filters( 'curly_business_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );

		$shortcodes_path = curly_business_get_elementor_shortcodes_path();
		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {

				$shortcode_name = str_replace( '.icon-wpb-', '', esc_attr( $shortcode_icon_class ) );

				if ( key_exists( $shortcode_name, $shortcodes_path ) && file_exists( $shortcodes_path[ $shortcode_name ]['dir_path'] . '/assets/img/dashboard_icon.png' ) ) {
					$shortcodes_icon_styles[] = '.curly-elementor-custom-icon.curly-elementor-' . $shortcode_name . ' {
                        background-image: url( "' . $shortcodes_path[ $shortcode_name ]['url_path'] . '/assets/img/dashboard_icon.png" );
                    }';
				}
			}
		}

		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style = implode( ' ', $shortcodes_icon_styles );
		}
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'curly-core-elementor', $style );
		}
	}

	add_action( 'elementor/editor/before_enqueue_scripts', 'curly_business_add_elementor_shortcodes_custom_styles', 15 );
}