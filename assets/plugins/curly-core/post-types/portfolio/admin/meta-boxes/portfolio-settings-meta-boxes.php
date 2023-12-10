<?php

if (!function_exists('curly_core_map_portfolio_settings_meta')) {
    function curly_core_map_portfolio_settings_meta() {
        $meta_box = curly_mkdf_create_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'curly-core'),
            'name' => 'portfolio_settings_meta_box'
        ));

        curly_mkdf_create_meta_box_field(array(
            'name' => 'mkdf_portfolio_single_template_meta',
            'type' => 'select',
            'label' => esc_html__('Portfolio Type', 'curly-core'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'curly-core'),
            'parent' => $meta_box,
            'options' => array(
                '' => esc_html__('Default', 'curly-core'),
                'masonry' => esc_html__('Portfolio Masonry', 'curly-core'),
                'small-images' => esc_html__('Portfolio Small Images', 'curly-core'),
                'small-gallery' => esc_html__('Portfolio Small Gallery', 'curly-core'),
                'custom' => esc_html__('Portfolio Custom', 'curly-core'),
                'full-width-custom' => esc_html__('Portfolio Full Width Custom', 'curly-core')
            )
        ));

        /***************** Gallery Layout *****************/

        $gallery_type_meta_container = curly_mkdf_add_admin_container(
            array(
                'parent' => $meta_box,
                'name' => 'mkdf_gallery_type_meta_container',
                'dependency' => array(
                    'show' => array(
                        'mkdf_portfolio_single_template_meta' => array(
                            'gallery',
                            'small-gallery'
                        )
                    )
                )
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_portfolio_single_gallery_columns_number_meta',
                'type' => 'select',
                'label' => esc_html__('Number of Columns', 'curly-core'),
                'default_value' => '',
                'description' => esc_html__('Set number of columns for portfolio gallery type', 'curly-core'),
                'parent' => $gallery_type_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'curly-core'),
                    'two' => esc_html__('2 Columns', 'curly-core'),
                    'three' => esc_html__('3 Columns', 'curly-core'),
                    'four' => esc_html__('4 Columns', 'curly-core')
                )
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_portfolio_single_gallery_space_between_items_meta',
                'type' => 'select',
                'label' => esc_html__('Space Between Items', 'curly-core'),
                'description' => esc_html__('Set space size between columns for portfolio gallery type', 'curly-core'),
                'default_value' => '',
                'options' => curly_mkdf_get_space_between_items_array(true),
                'parent' => $gallery_type_meta_container
            )
        );

        /***************** Gallery Layout *****************/

        /***************** Masonry Layout *****************/

        $masonry_type_meta_container = curly_mkdf_add_admin_container(
            array(
                'parent' => $meta_box,
                'name' => 'mkdf_masonry_type_meta_container',
                'dependency' => array(
                    'show' => array(
                        'mkdf_portfolio_single_template_meta' => array(
                            'masonry',
                            'small-masonry'
                        )
                    )
                )
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_portfolio_single_masonry_columns_number_meta',
                'type' => 'select',
                'label' => esc_html__('Number of Columns', 'curly-core'),
                'default_value' => '',
                'description' => esc_html__('Set number of columns for portfolio masonry type', 'curly-core'),
                'parent' => $masonry_type_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'curly-core'),
                    'two' => esc_html__('2 Columns', 'curly-core'),
                    'three' => esc_html__('3 Columns', 'curly-core'),
                    'four' => esc_html__('4 Columns', 'curly-core')
                )
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_portfolio_single_masonry_space_between_items_meta',
                'type' => 'select',
                'label' => esc_html__('Space Between Items', 'curly-core'),
                'description' => esc_html__('Set space size between columns for portfolio masonry type', 'curly-core'),
                'default_value' => '',
                'options' => curly_mkdf_get_space_between_items_array(true),
                'parent' => $masonry_type_meta_container
            )
        );

        /***************** Masonry Layout *****************/

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_show_title_area_portfolio_single_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Title Area', 'curly-core'),
                'description' => esc_html__('Enabling this option will show title area on your single portfolio page', 'curly-core'),
                'parent' => $meta_box,
                'options' => curly_mkdf_get_yes_no_select_array()
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'portfolio_info_top_padding',
                'type' => 'text',
                'label' => esc_html__('Portfolio Info Top Padding', 'curly-core'),
                'description' => esc_html__('Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'curly-core'),
                'parent' => $meta_box,
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'portfolio_external_link',
                'type' => 'text',
                'label' => esc_html__('Portfolio External Link', 'curly-core'),
                'description' => esc_html__('Enter URL to link from Portfolio List page', 'curly-core'),
                'parent' => $meta_box,
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'mkdf_portfolio_masonry_fixed_dimensions_meta',
                'type' => 'select',
                'label' => esc_html__('Dimensions for Masonry - Image Fixed Proportion', 'curly-core'),
                'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'curly-core'),
                'default_value' => '',
                'parent' => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'curly-core'),
                    'small' => esc_html__('Small', 'curly-core'),
                    'large-width' => esc_html__('Large Width', 'curly-core'),
                    'large-height' => esc_html__('Large Height', 'curly-core'),
                    'large-width-height' => esc_html__('Large Width/Height', 'curly-core')
                )
            )
        );

        $all_pages = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        curly_mkdf_create_meta_box_field(
            array(
                'name' => 'portfolio_single_back_to_link',
                'type' => 'select',
                'label' => esc_html__('"Back To" Link', 'curly-core'),
                'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'curly-core'),
                'parent' => $meta_box,
                'options' => $all_pages,
                'args' => array(
                    'select2' => true
                )
            )
        );
    }

    add_action('curly_mkdf_meta_boxes_map', 'curly_core_map_portfolio_settings_meta', 41);
}