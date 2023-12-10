<?php

if (!function_exists('curly_core_reviews_map')) {
    function curly_core_reviews_map() {

        $reviews_panel = curly_mkdf_add_admin_panel(
            array(
                'title' => esc_html__('Reviews', 'curly-core'),
                'name' => 'panel_reviews',
                'page' => '_page_page'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'parent' => $reviews_panel,
                'type' => 'text',
                'name' => 'reviews_section_title',
                'label' => esc_html__('Reviews Section Title', 'curly-core'),
                'description' => esc_html__('Enter title that you want to show before average rating for each room', 'curly-core'),
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'parent' => $reviews_panel,
                'type' => 'textarea',
                'name' => 'reviews_section_subtitle',
                'label' => esc_html__('Reviews Section Subtitle', 'curly-core'),
                'description' => esc_html__('Enter subtitle that you want to show before average rating for each room', 'curly-core'),
            )
        );
    }

    add_action('curly_mkdf_additional_page_options_map', 'curly_core_reviews_map', 75); //one after elements
}