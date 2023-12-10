<?php
if (curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
    if (!function_exists('curly_business_services_meta_box_map')) {
        function curly_business_services_meta_box_map() {

            $business_services_meta_box = curly_mkdf_create_meta_box(
                array(
                    'scope' => array('business-services'),
                    'title' => esc_html__('Business Services Item Settings', 'curly-business'),
                    'name' => 'business_services_item_meta'
                )
            );

            curly_mkdf_create_meta_box_field(
                array(
                    'name' => 'business_services_item_price',
                    'type' => 'text',
                    'default_value' => '',
                    'label' => esc_html__('Business Services Item Price', 'curly-business'),
                    'description' => esc_html__('Enter price for this business services item', 'curly-business'),
                    'parent' => $business_services_meta_box,
                    'args' => array(
                        'col_width' => '3'
                    )
                )
            );

            curly_mkdf_create_meta_box_field(
                array(
                    'name' => 'business_services_item_description',
                    'type' => 'text',
                    'default_value' => '',
                    'label' => esc_html__('Business Services Item Description', 'curly-business'),
                    'description' => esc_html__('Enter description for this business services item', 'curly-business'),
                    'parent' => $business_services_meta_box,
                )
            );

            curly_mkdf_create_meta_box_field(
                array(
                    'name' => 'business_services_item_label',
                    'type' => 'text',
                    'default_value' => '',
                    'label' => esc_html__('Business Services Item Label', 'curly-business'),
                    'description' => esc_html__('Enter label for this business services item', 'curly-business'),
                    'parent' => $business_services_meta_box,
                    'args' => array(
                        'col_width' => '3'
                    )
                )
            );

        }

        add_action('curly_mkdf_meta_boxes_map', 'curly_business_services_meta_box_map');
    }
}