<?php

if (!function_exists('curly_mkdf_portfolio_options_map')) {
    function curly_mkdf_portfolio_options_map() {

        curly_mkdf_add_admin_page(
            array(
                'slug' => '_portfolio',
                'title' => esc_html__('Portfolio', 'curly-core'),
                'icon' => 'fa fa-camera-retro'
            )
        );

        $panel_archive = curly_mkdf_add_admin_panel(
            array(
                'title' => esc_html__('Portfolio Archive', 'curly-core'),
                'name' => 'panel_portfolio_archive',
                'page' => '_portfolio'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_archive_number_of_items',
                'type' => 'text',
                'label' => esc_html__('Number of Items', 'curly-core'),
                'description' => esc_html__('Set number of items for your portfolio list on archive pages. Default value is 12', 'curly-core'),
                'parent' => $panel_archive,
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_archive_number_of_columns',
                'type' => 'select',
                'label' => esc_html__('Number of Columns', 'curly-core'),
                'default_value' => '4',
                'description' => esc_html__('Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'curly-core'),
                'parent' => $panel_archive,
                'options' => array(
                    '2' => esc_html__('2 Columns', 'curly-core'),
                    '3' => esc_html__('3 Columns', 'curly-core'),
                    '4' => esc_html__('4 Columns', 'curly-core'),
                    '5' => esc_html__('5 Columns', 'curly-core')
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_archive_space_between_items',
                'type' => 'select',
                'label' => esc_html__('Space Between Items', 'curly-core'),
                'description' => esc_html__('Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'curly-core'),
                'default_value' => 'normal',
                'options' => curly_mkdf_get_space_between_items_array(),
                'parent' => $panel_archive
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_archive_image_size',
                'type' => 'select',
                'label' => esc_html__('Image Proportions', 'curly-core'),
                'default_value' => 'landscape',
                'description' => esc_html__('Set image proportions for your portfolio list on archive pages. Default value is landscape', 'curly-core'),
                'parent' => $panel_archive,
                'options' => array(
                    'full' => esc_html__('Original', 'curly-core'),
                    'landscape' => esc_html__('Landscape', 'curly-core'),
                    'portrait' => esc_html__('Portrait', 'curly-core'),
                    'square' => esc_html__('Square', 'curly-core')
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_archive_item_layout',
                'type' => 'select',
                'label' => esc_html__('Item Style', 'curly-core'),
                'default_value' => 'standard-shader',
                'description' => esc_html__('Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'curly-core'),
                'parent' => $panel_archive,
                'options' => array(
                    'standard-shader' => esc_html__('Standard - Shader', 'curly-core'),
                    'gallery-overlay' => esc_html__('Gallery - Overlay', 'curly-core')
                )
            )
        );

        $panel = curly_mkdf_add_admin_panel(
            array(
                'title' => esc_html__('Portfolio Single', 'curly-core'),
                'name' => 'panel_portfolio_single',
                'page' => '_portfolio'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_template',
                'type' => 'select',
                'label' => esc_html__('Portfolio Type', 'curly-core'),
                'default_value' => 'small-images',
                'description' => esc_html__('Choose a default type for Single Project pages', 'curly-core'),
                'parent' => $panel,
                'options' => array(
                    'small-images' => esc_html__('Portfolio Small Images', 'curly-core'),
                    'small-gallery' => esc_html__('Portfolio Small Gallery', 'curly-core'),
                    'masonry' => esc_html__('Portfolio Masonry', 'curly-core'),
                    'custom' => esc_html__('Portfolio Custom', 'curly-core'),
                    'full-width-custom' => esc_html__('Portfolio Full Width Custom', 'curly-core')
                )
            )
        );

        /***************** Gallery Layout *****************/

        $portfolio_gallery_container = curly_mkdf_add_admin_container(
            array(
                'parent' => $panel,
                'name' => 'portfolio_gallery_container',
                'dependency' => array(
                    'show' => array(
                        'portfolio_single_template' => array(
                            'gallery',
                            'small-gallery'
                        )
                    )
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_gallery_columns_number',
                'type' => 'select',
                'label' => esc_html__('Number of Columns', 'curly-core'),
                'default_value' => 'three',
                'description' => esc_html__('Set number of columns for portfolio gallery type', 'curly-core'),
                'parent' => $portfolio_gallery_container,
                'options' => array(
                    'two' => esc_html__('2 Columns', 'curly-core'),
                    'three' => esc_html__('3 Columns', 'curly-core'),
                    'four' => esc_html__('4 Columns', 'curly-core')
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_gallery_space_between_items',
                'type' => 'select',
                'label' => esc_html__('Space Between Items', 'curly-core'),
                'description' => esc_html__('Set space size between columns for portfolio gallery type', 'curly-core'),
                'default_value' => 'normal',
                'options' => curly_mkdf_get_space_between_items_array(),
                'parent' => $portfolio_gallery_container
            )
        );

        /***************** Gallery Layout *****************/

        /***************** Masonry Layout *****************/

        $portfolio_masonry_container = curly_mkdf_add_admin_container(
            array(
                'parent' => $panel,
                'name' => 'portfolio_masonry_container',
                'dependency' => array(
                    'show' => array(
                        'portfolio_single_template' => array(
                            'masonry',
                            'small-masonry'
                        )
                    )
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_masonry_columns_number',
                'type' => 'select',
                'label' => esc_html__('Number of Columns', 'curly-core'),
                'default_value' => 'three',
                'description' => esc_html__('Set number of columns for portfolio masonry type', 'curly-core'),
                'parent' => $portfolio_masonry_container,
                'options' => array(
                    'two' => esc_html__('2 Columns', 'curly-core'),
                    'three' => esc_html__('3 Columns', 'curly-core'),
                    'four' => esc_html__('4 Columns', 'curly-core')
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_masonry_space_between_items',
                'type' => 'select',
                'label' => esc_html__('Space Between Items', 'curly-core'),
                'description' => esc_html__('Set space size between columns for portfolio masonry type', 'curly-core'),
                'default_value' => 'normal',
                'options' => curly_mkdf_get_space_between_items_array(),
                'parent' => $portfolio_masonry_container
            )
        );

        /***************** Masonry Layout *****************/

        curly_mkdf_add_admin_field(
            array(
                'type' => 'select',
                'name' => 'show_title_area_portfolio_single',
                'default_value' => '',
                'label' => esc_html__('Show Title Area', 'curly-core'),
                'description' => esc_html__('Enabling this option will show title area on single projects', 'curly-core'),
                'parent' => $panel,
                'options' => array(
                    '' => esc_html__('Default', 'curly-core'),
                    'yes' => esc_html__('Yes', 'curly-core'),
                    'no' => esc_html__('No', 'curly-core')
                ),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_lightbox_images',
                'type' => 'yesno',
                'label' => esc_html__('Enable Lightbox for Images', 'curly-core'),
                'description' => esc_html__('Enabling this option will turn on lightbox functionality for projects with images', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'yes'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_lightbox_videos',
                'type' => 'yesno',
                'label' => esc_html__('Enable Lightbox for Videos', 'curly-core'),
                'description' => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'no'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_enable_categories',
                'type' => 'yesno',
                'label' => esc_html__('Enable Categories', 'curly-core'),
                'description' => esc_html__('Enabling this option will enable category meta description on single projects', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'yes'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_hide_date',
                'type' => 'yesno',
                'label' => esc_html__('Enable Date', 'curly-core'),
                'description' => esc_html__('Enabling this option will enable date meta on single projects', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'yes'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_sticky_sidebar',
                'type' => 'yesno',
                'label' => esc_html__('Enable Sticky Side Text', 'curly-core'),
                'description' => esc_html__('Enabling this option will make side text sticky on Single Project pages. This option works only for the Small Images portfolio type', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'yes'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_comments',
                'type' => 'yesno',
                'label' => esc_html__('Show Comments', 'curly-core'),
                'description' => esc_html__('Enabling this option will show comments on your page', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'no'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_hide_pagination',
                'type' => 'yesno',
                'label' => esc_html__('Hide Pagination', 'curly-core'),
                'description' => esc_html__('Enabling this option will turn off portfolio pagination functionality', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'no'
            )
        );

        $container_navigate_category = curly_mkdf_add_admin_container(
            array(
                'name' => 'navigate_same_category_container',
                'parent' => $panel,
                'dependency' => array(
                    'hide' => array(
                        'portfolio_single_hide_pagination' => array(
                            'yes'
                        )
                    )
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_nav_same_category',
                'type' => 'yesno',
                'label' => esc_html__('Enable Pagination Through Same Category', 'curly-core'),
                'description' => esc_html__('Enabling this option will make portfolio pagination sort through current category', 'curly-core'),
                'parent' => $container_navigate_category,
                'default_value' => 'no'
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_slug',
                'type' => 'text',
                'label' => esc_html__('Portfolio Single Slug', 'curly-core'),
                'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'curly-core'),
                'parent' => $panel,
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        curly_mkdf_add_admin_field(
            array(
                'name' => 'portfolio_single_related_posts',
                'type' => 'yesno',
                'label' => esc_html__('Show Related Projects', 'curly-core'),
                'description' => esc_html__('Enabling this option will display related projects on Single Project', 'curly-core'),
                'parent' => $panel,
                'default_value' => 'yes'
            )
        );
    }

    add_action('curly_mkdf_options_map', 'curly_mkdf_portfolio_options_map', 14);
}