<?php
namespace CurlyCore\CPT\Shortcodes\StackedImages;

use CurlyCore\Lib;

class StackedImages implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_stacked_images';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Stacked Images', 'curly-core'),
                    'base' => $this->base,
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'icon' => 'icon-wpb-stacked-images extended-custom-icon',
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'param_name' => 'custom_class',
                            'heading' => esc_html__('Custom CSS Class', 'curly-core'),
                            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-core')
                        ),
                        array(
                            'type' => 'attach_image',
                            'param_name' => 'item_image',
                            'heading' => esc_html__('Image', 'curly-core')
                        ),
                        array(
                            'type' => 'attach_image',
                            'param_name' => 'item_stack_image',
                            'heading' => esc_html__('Stack Image', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'stack_image_position',
                            'heading' => esc_html__('Stack Image Position', 'curly-core'),
                            'value' => array(
                                esc_html__('Left Offset', 'curly-core') => 'left',
                                esc_html__('Right Offset', 'curly-core') => 'right'
                            ),
                            'save_always' => true,
                            'dependency' => array('element' => 'item_stack_image', 'not_empty' => true)
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'item_image' => '',
            'item_stack_image' => '',
            'stack_image_position' => 'left'
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params, $args);

        $html = curly_core_get_shortcode_module_template_part('templates/stacked-images', 'stacked-images', '', $params);

        return $html;
    }

    private function getHolderClasses($params, $args) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['stack_image_position']) ? 'mkdf-si-position-' . $params['stack_image_position'] : 'mkdf-si-position-' . $args['stack_image_position'];

        return implode(' ', $holderClasses);
    }
}