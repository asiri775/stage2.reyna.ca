<?php

if (!function_exists('curly_core_map_testimonials_meta')) {
    function curly_core_map_testimonials_meta() {
        $testimonial_meta_box = curly_mkdf_create_meta_box(
            array(
                'scope' => array('testimonials'),
                'title' => esc_html__('Testimonial', 'curly-core'),
                'name' => 'testimonial_meta'
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_testimonial_title',
                'type' => 'text',
                'label' => esc_html__('Title', 'curly-core'),
                'description' => esc_html__('Enter testimonial title', 'curly-core'),
                'parent' => $testimonial_meta_box,
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_testimonial_text',
                'type' => 'text',
                'label' => esc_html__('Text', 'curly-core'),
                'description' => esc_html__('Enter testimonial text', 'curly-core'),
                'parent' => $testimonial_meta_box,
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_testimonial_author',
                'type' => 'text',
                'label' => esc_html__('Author', 'curly-core'),
                'description' => esc_html__('Enter author name', 'curly-core'),
                'parent' => $testimonial_meta_box,
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_testimonial_author_position',
                'type' => 'text',
                'label' => esc_html__('Author Position', 'curly-core'),
                'description' => esc_html__('Enter author job position', 'curly-core'),
                'parent' => $testimonial_meta_box,
            )
        );
    }

    add_action('curly_mkdf_meta_boxes_map', 'curly_core_map_testimonials_meta', 95);
}