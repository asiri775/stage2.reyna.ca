<?php
namespace CurlyCore\CPT\Shortcodes\PricingTable;

use CurlyCore\Lib;

class PricingTableItem implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_pricing_table_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Pricing Table Item', 'curly-core'),
                    'base' => $this->base,
                    'icon' => 'icon-wpb-pricing-table-item extended-custom-icon',
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'allowed_container_element' => 'vc_row',
                    'as_child' => array('only' => 'mkdf_pricing_table'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'param_name' => 'custom_class',
                            'heading' => esc_html__('Custom CSS Class', 'curly-core'),
                            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'skin',
                            'heading' => esc_html__('Skin', 'curly-core'),
                            'value' => array(
                                esc_html__('Light', 'curly-core') => 'light',
                                esc_html__('Dark', 'curly-core') => 'dark',
                            ),
                            'save_always' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'title',
                            'heading' => esc_html__('Title', 'curly-core'),
                            'value' => esc_html__('Basic Plan', 'curly-core'),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'price',
                            'heading' => esc_html__('Price', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'price_decimal',
                            'heading' => esc_html__('Price Decimal', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'currency',
                            'heading' => esc_html__('Currency', 'curly-core'),
                            'description' => esc_html__('Default mark is $', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'price_period',
                            'heading' => esc_html__('Price Period', 'curly-core'),
                            'description' => esc_html__('Default label is monthly', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'link_text',
                            'heading' => esc_html__('Button Text', 'curly-core'),
                            'value' => esc_html__('Select', 'curly-core'),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'link',
                            'heading' => esc_html__('Button Link', 'curly-core'),
                            'dependency' => array('element' => 'link_text', 'not_empty' => true)
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'link_target',
                            'heading' => esc_html__('Target', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_link_target_array()),
                            'dependency' => array('element' => 'link', 'not_empty' => true)
                        ),
                        array(
                            'type' => 'textarea_html',
                            'param_name' => 'content',
                            'heading' => esc_html__('Content', 'curly-core'),
                            'value' => '<li>content content content</li><li>content content content</li><li>content content content</li>'
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'skin' => 'dark',
            'title' => '',
            'title_color' => '',
            'price' => '100',
            'price_decimal' => '00',
            'currency' => '$',
            'price_period' => 'monthly',
            'link' => '',
            'link_text' => '',
            'link_target' => '',
        );
        $params = shortcode_atts($args, $atts);

        $params['content'] = preg_replace('#^<\/p>|<p>$#', '', $content); // delete p tag before and after content
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['button_params'] = $this->getButtonParams($params);

        $html = curly_core_get_shortcode_module_template_part('templates/pricing-table', 'pricing-table', '', $params);

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';

        return implode(' ', $holderClasses);
    }

    private function getButtonParams($params) {
        $buttonParams = array();

        $buttonParams['link'] = $params['link'];
        $buttonParams['target'] = $params['link_target'];
        $buttonParams['text'] = $params['link_text'];
        $buttonParams['type'] = 'outline';

        if ($params['skin'] === 'light') {
            $buttonParams['color'] = '#ffffff';
            $buttonParams['border_color'] = '#ffffff';
        }

        return $buttonParams;
    }
}