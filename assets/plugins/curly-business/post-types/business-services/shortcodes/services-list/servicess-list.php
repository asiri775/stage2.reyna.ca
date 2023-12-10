<?php

namespace CurlyBusiness\CPT\BusinessServices\Shortcodes\ServicesList;

use CurlyBusiness\Lib\ShortcodeInterface;

class ServicesList implements ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'mkdf_services_list';

        add_action('vc_before_init', array($this, 'vcMap'));

        // category filter
        add_filter('vc_autocomplete_mkdf_services_list_category_callback', array(&$this, 'servicesListCategoryAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        // category render
        add_filter('vc_autocomplete_mkdf_services_list_category_render', array(&$this, 'servicesListCategoryAutocompleteRender',), 10, 1); // Get suggestion(find). Must return an array
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {

            vc_map(array(
                    'name' => esc_html__('Services List', 'curly-business'),
                    'base' => $this->getBase(),
                    'category' => esc_html__('by CURLY BUSINESS', 'curly-business'),
                    'icon' => 'icon-wpb-services-list extended-custom-business-icon',
                    'allowed_container_element' => 'vc_row',
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Show Featured Image?', 'curly-business'),
                            'param_name' => 'show_featured_image',
                            'value' => array_flip(curly_mkdf_get_yes_no_select_array(false)),
                            'admin_label' => true,
                            'description' => esc_html__('Use this option to show featured image of menu items', 'curly-business'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Skin', 'curly-business'),
                            'param_name' => 'skin',
                            'value' => array_flip(curly_business_get_business_shortcodes_skins()),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Order By', 'curly-business'),
                            'param_name' => 'orderby',
                            'value' => array_flip(curly_mkdf_get_query_order_by_array()),
                            'save_always' => true,
                            'group' => esc_html__('Query and Layout Options', 'curly-business')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'order',
                            'heading' => esc_html__('Order', 'curly-business'),
                            'value' => array_flip(curly_mkdf_get_query_order_array()),
                            'save_always' => true,
                            'group' => esc_html__('Query and Layout Options', 'curly-business')
                        ),
                        array(
                            'type' => 'autocomplete',
                            'param_name' => 'category',
                            'heading' => esc_html__('One-Category Business Services list', 'curly-business'),
                            'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'curly-business')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'number',
                            'heading' => esc_html__('Number of Business Menu Items', 'curly-business'),
                            'value' => '-1',
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => esc_html__('(enter -1 to show all)', 'curly-business'),
                            'group' => esc_html__('Query and Layout Options', 'curly-business')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'title',
                            'heading' => esc_html__('Title', 'curly-business'),
                            'admin_label' => true,
                            'group' => esc_html__('Title Options', 'curly-business')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading' => esc_html__('Title Tag', 'curly-business'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                            'save_always' => true,
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Title Options', 'curly-business')
                        ),
                        array(
                            'type' => 'colorpicker',
                            'param_name' => 'title_color',
                            'heading' => esc_html__('Title Color', 'curly-business'),
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Title Options', 'curly-business')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_font_weight',
                            'heading' => esc_html__('Title Font Weight', 'curly-business'),
                            'value' => array_flip(curly_mkdf_get_font_weight_array(true)),
                            'save_always' => true,
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Title Options', 'curly-business')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'title_bottom_margin',
                            'heading' => esc_html__('Title Bottom Margin (px)', 'curly-business'),
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Title Options', 'curly-business')
                        ),
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'show_featured_image' => '',
            'orderby' => 'date',
            'order' => 'ASC',
            'category' => '',
            'number' => '-1',
            'skin' => '',
            'title' => '',
            'title_tag' => 'h6',
            'title_color' => '',
            'title_font_weight' => '',
            'title_bottom_margin' => '',
        );

        $params = shortcode_atts($args, $atts);

        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
        $params['title_styles'] = $this->getTitleStyles($params);

        $holderClasses = $this->getHolderClasses($params);
        $titleStyles = $this->getTitleStyles($params);

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);

        $listItemParams = array(
            'show_featured_image' => $params['show_featured_image']
        );

        $html = '<div ' . curly_mkdf_get_class_attribute($holderClasses) . '>';

        if (!empty($params['title'])) :
            $html .= '<' . esc_attr($params['title_tag']) . ' class="mkdf-bsl-title"' . curly_mkdf_get_inline_style($titleStyles) . '>';
            $html .= wp_kses($params['title'], array('span' => array('class' => true)));
            $html .= '</' . esc_attr($params['title_tag']) . '>';
        endif;

        if ($query_results->have_posts()) {
            $html .= '<ul class="mkdf-bsl">';

            while ($query_results->have_posts()) {
                $query_results->the_post();
                $html .= curly_business_get_shortcode_module_template_part('business-services', 'services-list', 'services-list-item-template', '', $listItemParams);
            }

            $html .= '</ul>';

            wp_reset_postdata();
        } else {
            $html .= '<p>' . esc_html__('Sorry, no menu items matched your criteria.', 'curly-business') . '</p>';
        }

        $html .= '</div>';

        return $html;
    }

    public function getQueryArray($params) {
        $query_array = array(
            'post_type' => 'business-services',
            'orderby' => $params['orderby'],
            'order' => $params['order'],
            'posts_per_page' => $params['number']
        );

        if (!empty($params['category'])) {
            $query_array['business-services-category'] = $params['category'];
        }

        return $query_array;
    }

    private function getHolderClasses($params) {
        $classes = array('mkdf-bsl-holder');

        $classes[] = $params['show_featured_image'] === 'yes' ? 'mkdf-bsl-with-image' : '';
        $classes[] = !empty($params['skin']) ? 'mkdf-bsl-' . $params['skin'] : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return $classes;
    }

    private function getTitleStyles($params) {
        $styles = array();

        $styles[] = !empty($params['title_color']) ? 'color: ' . $params['title_color'] : '';
        $styles[] = !empty($params['title_font_weight']) ? 'font-weight: ' . $params['title_font_weight'] : '';
        $styles[] = !empty($params['title_bottom_margin']) ? 'margin-bottom: ' . curly_mkdf_filter_px($params['title_bottom_margin']) . 'px' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(';', array_filter($styles));
    }

    public function servicesListCategoryAutocompleteSuggester($query) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.slug AS slug, a.name AS business_services_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'business-services-category' AND a.name LIKE '%%%s%%'", stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['slug'];
                $data['label'] = ((strlen($value['business_services_category_title']) > 0) ? esc_html__('Category', 'curly-business') . ': ' . $value['business_services_category_title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    public function servicesListCategoryAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested

        if (!empty($query)) {
            // get business services category
            $business_services_category = get_term_by('slug', $query, 'business-services-category');

            if (is_object($business_services_category)) {
                $business_services_category_slug = $business_services_category->slug;
                $business_services_category_title = $business_services_category->name;

                $business_services_category_title_display = '';
                if (!empty($business_services_category_title)) {
                    $business_services_category_title_display = esc_html__('Category', 'curly-business') . ': ' . $business_services_category_title;
                }

                $data = array();
                $data['value'] = $business_services_category_slug;
                $data['label'] = $business_services_category_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }
}