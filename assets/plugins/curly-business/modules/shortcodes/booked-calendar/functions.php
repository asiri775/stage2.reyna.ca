<?php

if (!function_exists('curly_business_add_booked_calendar_shortcodes')) {
    function curly_business_add_booked_calendar_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'CurlyBusiness\Shortcodes\BookedCalendar\BookedCalendar'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('curly_business_add_vc_shortcode', 'curly_business_add_booked_calendar_shortcodes');
}

if (!function_exists('curly_business_set_booked_calendar_icon_class_name_for_vc_shortcodes')) {
    /**
     * Function that set custom icon class name for property list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function curly_business_set_booked_calendar_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-booked-calendar';

        return $shortcodes_icon_class_array;
    }

    add_filter('curly_business_filter_add_vc_shortcodes_custom_icon_class', 'curly_business_set_booked_calendar_icon_class_name_for_vc_shortcodes');
}

if (!function_exists('curly_business_get_booked_calendars')) {
    /**
     * Get Booked calendars
     *
     * @return array
     */
    function curly_business_get_booked_calendars() {
        global $wpdb;

        if (curly_business_is_wpml_installed()) {
            $lang = ICL_LANGUAGE_CODE;

            $sql = "SELECT t.term_id AS id, t.name AS name
				    FROM {$wpdb->prefix}terms t
				    INNER JOIN {$wpdb->prefix}term_taxonomy tt ON tt.term_id = t.term_id
				    INNER JOIN {$wpdb->prefix}icl_translations icl_t ON icl_t.element_id = t.term_id
				    WHERE icl_t.element_type = 'tax_booked_custom_calendars'
				    AND icl_t.language_code='$lang'
				    ORDER BY name ASC";
        } else {
            $sql = "SELECT t.term_id AS id, t.name AS name
				    FROM {$wpdb->prefix}terms t
				    INNER JOIN {$wpdb->prefix}term_taxonomy tt ON tt.term_id = t.term_id
				    WHERE tt.taxonomy = 'booked_custom_calendars'
				    ORDER BY name ASC";
        }

        $calendars = array();
        $calendars_terms = $wpdb->get_results($sql);

        if (!empty($calendars_terms)) {
            $calendars = $calendars_terms;
        }

        return $calendars;
    }
}

if (!function_exists('curly_business_get_booked_calendar_array')) {
    /**
     * Get value array for visual composer shortcodes
     *
     * @return array
     */
    function curly_business_get_booked_calendar_array($enable_default = true) {
        $select_options = array();

        if ($enable_default) {
            $select_options[''] = esc_html__('Default', 'curly-business');
        }

        $calendars = curly_business_get_booked_calendars();
        if (!empty($calendars)) {
            foreach ($calendars as $calendar) {
                $select_options[$calendar->id] = $calendar->name;
            }
        }

        return $select_options;
    }
}