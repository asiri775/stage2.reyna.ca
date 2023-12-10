<?php

if (curly_business_theme_installed()) {
    if (!function_exists('curly_business_options_map')) {
        /**
         * Adds admin page for OpenTable integration
         */
        function curly_business_options_map() {
            curly_mkdf_add_admin_page(array(
                'title' => esc_html__('Business', 'curly-business'),
                'slug' => '_business',
                'icon' => 'fa fa-briefcase'
            ));

            // Working Hours panel
            $panel_working_hours = curly_mkdf_add_admin_panel(array(
                'page' => '_business',
                'name' => 'panel_working_hours',
                'title' => esc_html__('Working Hours', 'curly-business')
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'working_hours_layout',
                'type' => 'select',
                'label' => esc_html__('Working Hours Layout', 'curly-business'),
                'description' => esc_html__('Layout will be used in Working Hours shortcode', 'curly-business'),
                'options' => array(
                    '' => esc_html__('- Choose Working Hours Layout', 'curly-business'),
                    'all-days' => esc_html__('All Days', 'curly-business'),
                    'workdays-weekend' => esc_html__('Workdays + Weekend', 'curly-business'),
                    'workdays-sat-sun' => esc_html__('Workdays + Sat + Sun', 'curly-business'),
                    'same' => esc_html__('Same Throught the Week', 'curly-business'),
                    'mon-tue-wed-thu-fri-weekend' => esc_html__('Mon + Tue + Wed + Thu + Fri + Weekend', 'curly-business'),
                ),
                'parent' => $panel_working_hours,
            ));

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $weekend_container = curly_mkdf_add_admin_container_no_style(array(
                'name' => 'same_container',
                'hidden_property' => '',
                'hidden_value' => '',
                'parent' => $panel_working_hours,
                'dependency' => array(
                    'hide' => array(
                        'working_hours_layout' => array(
                            '',
                            'all-days',
                            'workdays-weekend',
                            'workdays-sat-sun',
                            'mon-tue-wed-thu-fri-weekend',
                        ),
                    ),
                ),
            ));

            $same_group = curly_mkdf_add_admin_group(array(
                'name' => 'same_group',
                'title' => esc_html__('All Days', 'curly-business'),
                'parent' => $weekend_container,
                'description' => esc_html__('Same throught the week', 'curly-business')
            ));

            $same_row = curly_mkdf_add_admin_row(array(
                'name' => 'same_row',
                'parent' => $same_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_same_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $same_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_same_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $same_row
            ));

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $work_days_container = curly_mkdf_add_admin_container_no_style(array(
                'name' => 'work_days_container',
                'hidden_property' => '',
                'hidden_value' => '',
                'parent' => $panel_working_hours,
                'dependency' => array(
                    'hide' => array(
                        'working_hours_layout' => array(
                            '',
                            'all-days',
                            'same',
                            'mon-tue-wed-thu-fri-weekend',
                        ),
                    ),
                ),
            ));

            $work_days_group = curly_mkdf_add_admin_group(array(
                'name' => 'work_days_group',
                'title' => esc_html__('Work Days', 'curly-business'),
                'parent' => $work_days_container,
                'description' => esc_html__('Working hours for workdays', 'curly-business')
            ));

            $work_days_row = curly_mkdf_add_admin_row(array(
                'name' => 'work_days_row',
                'parent' => $work_days_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_work_days_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $work_days_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_work_days_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $work_days_row
            ));

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $single_work_days_container = curly_mkdf_add_admin_container_no_style(array(
                'name' => 'single_work_days_container',
                'hidden_property' => '',
                'hidden_value' => '',
                'parent' => $panel_working_hours,
                'dependency' => array(
                    'hide' => array(
                        'working_hours_layout' => array(
                            '',
                            'workdays-weekend',
                            'workdays-sat-sun',
                            'same',
                        ),
                    ),
                ),
            ));

            $monday_group = curly_mkdf_add_admin_group(array(
                'name' => 'monday_group',
                'title' => esc_html__('Monday', 'curly-business'),
                'parent' => $single_work_days_container,
                'description' => esc_html__('Working hours for Monday', 'curly-business')
            ));

            $monday_row = curly_mkdf_add_admin_row(array(
                'name' => 'monday_row',
                'parent' => $monday_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_monday_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $monday_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_monday_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $monday_row
            ));

            $tuesday_group = curly_mkdf_add_admin_group(array(
                'name' => 'tuesday_group',
                'title' => esc_html__('Tuesday', 'curly-business'),
                'parent' => $single_work_days_container,
                'description' => esc_html__('Working hours for Tuesday', 'curly-business')
            ));

            $tuesday_row = curly_mkdf_add_admin_row(array(
                'name' => 'tuesday_row',
                'parent' => $tuesday_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_tuesday_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $tuesday_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_tuesday_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $tuesday_row
            ));

            $wednesday_group = curly_mkdf_add_admin_group(array(
                'name' => 'wednesday_group',
                'title' => esc_html__('Wednesday', 'curly-business'),
                'parent' => $single_work_days_container,
                'description' => esc_html__('Working hours for Wednesday', 'curly-business')
            ));

            $wednesday_row = curly_mkdf_add_admin_row(array(
                'name' => 'wednesday_row',
                'parent' => $wednesday_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_wednesday_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $wednesday_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_wednesday_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $wednesday_row
            ));

            $thursday_group = curly_mkdf_add_admin_group(array(
                'name' => 'thursday_group',
                'title' => esc_html__('Thursday', 'curly-business'),
                'parent' => $single_work_days_container,
                'description' => 'Working hours for Thursday'
            ));

            $thursday_row = curly_mkdf_add_admin_row(array(
                'name' => 'thursday_row',
                'parent' => $thursday_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_thursday_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $thursday_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_thursday_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $thursday_row
            ));

            $friday_group = curly_mkdf_add_admin_group(array(
                'name' => 'friday_group',
                'title' => esc_html__('Friday', 'curly-business'),
                'parent' => $single_work_days_container,
                'description' => esc_html__('Working hours for Friday', 'curly-business')
            ));

            $friday_row = curly_mkdf_add_admin_row(array(
                'name' => 'friday_row',
                'parent' => $friday_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_friday_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $friday_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_friday_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $friday_row
            ));

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $weekend_container = curly_mkdf_add_admin_container_no_style(array(
                'name' => 'weekend_container',
                'hidden_property' => '',
                'hidden_value' => '',
                'parent' => $panel_working_hours,
                'dependency' => array(
                    'hide' => array(
                        'working_hours_layout' => array(
                            '',
                            'all-days',
                            'workdays-sat-sun',
                            'same',
                        ),
                    ),
                ),
            ));

            $weekend_group = curly_mkdf_add_admin_group(array(
                'name' => 'weekend_group',
                'title' => esc_html__('Weekend', 'curly-business'),
                'parent' => $weekend_container,
                'description' => esc_html__('Working hours for weekend', 'curly-business')
            ));

            $weekend_row = curly_mkdf_add_admin_row(array(
                'name' => 'weekend_row',
                'parent' => $weekend_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_weekend_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $weekend_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_weekend_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $weekend_row
            ));

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $single_weekend_container = curly_mkdf_add_admin_container_no_style(array(
                'name' => 'single_weekend_container',
                'hidden_property' => '',
                'hidden_value' => '',
                'parent' => $panel_working_hours,
                'dependency' => array(
                    'hide' => array(
                        'working_hours_layout' => array(
                            '',
                            'workdays-weekend',
                            'same',
                            'mon-tue-wed-thu-fri-weekend',
                        ),
                    ),
                ),
            ));

            $saturday_group = curly_mkdf_add_admin_group(array(
                'name' => 'saturday_group',
                'title' => esc_html__('Saturday', 'curly-business'),
                'parent' => $single_weekend_container,
                'description' => esc_html__('Working hours for Saturday', 'curly-business')
            ));

            $saturday_row = curly_mkdf_add_admin_row(array(
                'name' => 'saturday_row',
                'parent' => $saturday_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_saturday_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $saturday_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_saturday_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $saturday_row
            ));

            $sunday_group = curly_mkdf_add_admin_group(array(
                'name' => 'sunday_group',
                'title' => esc_html__('Sunday', 'curly-business'),
                'parent' => $single_weekend_container,
                'description' => esc_html__('Working hours for Sunday', 'curly-business')
            ));

            $sunday_row = curly_mkdf_add_admin_row(array(
                'name' => 'sunday_row',
                'parent' => $sunday_group
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_sunday_from',
                'type' => 'textsimple',
                'label' => esc_html__('From', 'curly-business'),
                'parent' => $sunday_row
            ));

            curly_mkdf_add_admin_field(array(
                'name' => 'wh_sunday_to',
                'type' => 'textsimple',
                'label' => esc_html__('To', 'curly-business'),
                'parent' => $sunday_row
            ));
        }

        add_action('curly_mkdf_options_map', 'curly_business_options_map', 71); // one after elements
    }
}