<?php

if (!function_exists('curly_business_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines curly_business_on_activate action
     */
    function curly_business_activation() {
        do_action('curly_business_on_activate');

        // CurlyBusiness\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'curly_business_activation');
}

if (!function_exists('curly_business_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function curly_business_text_domain() {
        load_plugin_textdomain('curly-business', false, CURLY_BUSINESS_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'curly_business_text_domain');
}

if (!function_exists('curly_business_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function curly_business_version_class($classes) {
        $classes[] = 'mkdf-business-' . CURLY_BUSINESS_VERSION;

        return $classes;
    }

    add_filter('body_class', 'curly_business_version_class');
}

if (!function_exists('curly_business_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function curly_business_theme_installed() {
        return defined('MIKADO_ROOT');
    }
}

if (!function_exists('curly_business_get_shortcode_module_template_part')) {
    /**
     * Loads module template part.
     *
     * @param string $post_type name of the post type folder
     * @param string $shortcode name of the shortcode folder
     * @param string $template name of the template to load
     * @param string $slug
     * @param array $params array of parameters to pass to template
     * @return html
     */
    function curly_business_get_shortcode_module_template_part($post_type, $shortcode, $template, $slug = '', $params = array()) {

        //HTML Content from template
        $html = '';
        $template_path = CURLY_BUSINESS_CPT_PATH . '/' . $post_type . '/shortcodes/' . $shortcode . '/templates';

        $temp = $template_path . '/' . $template;
        if (is_array($params) && count($params)) {
            extract($params);
        }

        $template = '';

        if ($temp !== '') {
            $template = $temp . '.php';

            if ($slug !== '') {
                $template = "{$temp}-{$slug}.php";
            }
        }
        if ($template) {
            ob_start();
            include($template);
            $html = ob_get_clean();
        }

        return $html;
    }
}

if (!function_exists('curly_business_get_template_part')) {
    /**
     * Loads template part with parameters. If file with slug parameter added exists it will load that file, else it will load file without slug added.
     * Child theme friendly function
     *
     * @param string $template name of the template to load without extension
     * @param string $slug
     * @param array $params array of parameters to pass to template
     * @param bool $return whether to return it as a string
     *
     * @return mixed
     */
    function curly_business_get_template_part($template, $slug = '', $params = array(), $return = false) {
        //HTML Content from template
        $html = '';
        $template_path = CURLY_BUSINESS_ABS_PATH;

        $temp = $template_path . '/' . $template;
        if (is_array($params) && count($params)) {
            extract($params);
        }

        $template = '';

        if ($temp !== '') {
            $template = $temp . '.php';

            if ($slug !== '') {
                $template = "{$temp}-{$slug}.php";
            }
        }

        if ($template) {
            if ($return) {
                ob_start();
            }

            include($template);

            if ($return) {
                $html = ob_get_clean();
            }

        }

        if ($return) {
            return $html;
        }
    }
}

if (!function_exists('curly_business_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function curly_business_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if (!function_exists('curly_business_get_booked_shortcodes_types')) {
    /**
     * Get value array for visual composer shortcodes
     *
     * @return array
     */
    function curly_business_get_booked_shortcodes_types() {
        $types = array(
            'calendar' => esc_html__('Calendar', 'curly-business'),
            'list' => esc_html__('List', 'curly-business'),
        );

        return $types;
    }
}

if (!function_exists('curly_business_get_business_shortcodes_skins')) {
    /**
     * Get value array for visual composer shortcodes
     *
     * @return array
     */
    function curly_business_get_business_shortcodes_skins() {
        $skins = array(
            '' => esc_html__('Default', 'curly-business'),
            'light' => esc_html__('Light', 'curly-business'),
            'dark' => esc_html__('Dark', 'curly-business'),
        );

        return $skins;
    }
}

if (!function_exists('curly_business_is_booked_calendar_installed')) {
    /**
     * Function that checks if Booked plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function curly_business_is_booked_calendar_installed() {
        return defined('BOOKED_VERSION');
    }
}

if (!function_exists('curly_business_core_plugin_installed')) {
	/**
	 * Function that checks if Mikado Core plugin installed
	 * @return bool
	 */
	function curly_business_core_plugin_installed() {
		return defined('CURLY_CORE_VERSION');
	}
}