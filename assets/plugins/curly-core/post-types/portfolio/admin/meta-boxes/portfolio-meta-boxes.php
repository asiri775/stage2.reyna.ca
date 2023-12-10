<?php

if (!function_exists('curly_core_map_portfolio_meta')) {
    function curly_core_map_portfolio_meta() {
        global $curly_mkdf_Framework;

        $curly_pages = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            $curly_pages[$page->ID] = $page->post_title;
        }

        //Portfolio Images

        $curly_portfolio_images = new CurlyMikadofMetaBox('portfolio-item', esc_html__('Portfolio Images (multiple upload)', 'curly-core'), '', '', 'portfolio_images');
        $curly_mkdf_Framework->mkdMetaBoxes->addMetaBox('portfolio_images', $curly_portfolio_images);

        $curly_portfolio_image_gallery = new CurlyMikadofMultipleImages('mkdf-portfolio-image-gallery', esc_html__('Portfolio Images', 'curly-core'), esc_html__('Choose your portfolio images', 'curly-core'));
        $curly_portfolio_images->addChild('mkdf-portfolio-image-gallery', $curly_portfolio_image_gallery);

        //Portfolio Single Upload Images/Videos

        $curly_portfolio_images_videos = curly_mkdf_create_meta_box(
            array(
                'scope' => array('portfolio-item'),
                'title' => esc_html__('Portfolio Images/Videos (single upload)', 'curly-core'),
                'name' => 'mkdf_portfolio_images_videos'
            )
        );
        curly_mkdf_add_repeater_field(
            array(
                'name' => 'mkdf_portfolio_single_upload',
                'parent' => $curly_portfolio_images_videos,
                'button_text' => esc_html__('Add Image/Video', 'curly-core'),
                'fields' => array(
                    array(
                        'type' => 'select',
                        'name' => 'file_type',
                        'label' => esc_html__('File Type', 'curly-core'),
                        'options' => array(
                            'image' => esc_html__('Image', 'curly-core'),
                            'video' => esc_html__('Video', 'curly-core'),
                        )
                    ),
                    array(
                        'type' => 'image',
                        'name' => 'single_image',
                        'label' => esc_html__('Image', 'curly-core'),
                        'dependency' => array(
                            'show' => array(
                                'file_type' => 'image'
                            )
                        )
                    ),
                    array(
                        'type' => 'select',
                        'name' => 'video_type',
                        'label' => esc_html__('Video Type', 'curly-core'),
                        'options' => array(
                            'youtube' => esc_html__('YouTube', 'curly-core'),
                            'vimeo' => esc_html__('Vimeo', 'curly-core'),
                            'self' => esc_html__('Self Hosted', 'curly-core'),
                        ),
                        'dependency' => array(
                            'show' => array(
                                'file_type' => 'video'
                            )
                        )
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'video_id',
                        'label' => esc_html__('Video ID', 'curly-core'),
                        'dependency' => array(
                            'show' => array(
                                'file_type' => 'video',
                                'video_type' => array('youtube', 'vimeo')
                            )
                        )
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'video_mp4',
                        'label' => esc_html__('Video mp4', 'curly-core'),
                        'dependency' => array(
                            'show' => array(
                                'file_type' => 'video',
                                'video_type' => 'self'
                            )
                        )
                    ),
                    array(
                        'type' => 'image',
                        'name' => 'video_cover_image',
                        'label' => esc_html__('Video Cover Image', 'curly-core'),
                        'dependency' => array(
                            'show' => array(
                                'file_type' => 'video',
                                'video_type' => 'self'
                            )
                        )
                    )
                )
            )
        );

        //Portfolio Additional Sidebar Items

        $curly_additional_sidebar_items = curly_mkdf_create_meta_box(
            array(
                'scope' => array('portfolio-item'),
                'title' => esc_html__('Additional Portfolio Sidebar Items', 'curly-core'),
                'name' => 'portfolio_properties'
            )
        );

        curly_mkdf_add_repeater_field(
            array(
                'name' => 'mkdf_portfolio_properties',
                'parent' => $curly_additional_sidebar_items,
                'button_text' => esc_html__('Add New Item', 'curly-core'),
                'fields' => array(
                    array(
                        'type' => 'text',
                        'name' => 'item_title',
                        'label' => esc_html__('Item Title', 'curly-core'),
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'item_text',
                        'label' => esc_html__('Item Text', 'curly-core')
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'item_url',
                        'label' => esc_html__('Enter Full URL for Item Text Link', 'curly-core')
                    )
                )
            )
        );
    }

    add_action('curly_mkdf_meta_boxes_map', 'curly_core_map_portfolio_meta', 40);
}