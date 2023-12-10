<?php
namespace CurlyCore\CPT\Shortcodes\Separator;

use CurlyCore\Lib;

class Separator implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_separator';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Separator', 'curly-core'),
                    'base' => $this->base,
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'icon' => 'icon-wpb-separator extended-custom-icon',
                    'show_settings_on_create' => true,
                    'class' => 'wpb_vc_separator',
                    'custom_markup' => '<div></div>',
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'param_name' => 'custom_class',
                            'heading' => esc_html__('Custom CSS Class', 'curly-core'),
                            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'type',
                            'heading' => esc_html__('Type', 'curly-core'),
                            'value' => array(
                                esc_html__('Normal', 'curly-core') => 'normal',
                                esc_html__('Full Width', 'curly-core') => 'full-width'
                            )
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'position',
                            'heading' => esc_html__('Position', 'curly-core'),
                            'value' => array(
                                esc_html__('Center', 'curly-core') => 'center',
                                esc_html__('Left', 'curly-core') => 'left',
                                esc_html__('Right', 'curly-core') => 'right'
                            ),
                            'dependency' => array('element' => 'type', 'value' => array('normal'))
                        ),
                        array(
                            'type' => 'colorpicker',
                            'param_name' => 'color',
                            'heading' => esc_html__('Color', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'border_style',
                            'heading' => esc_html__('Style', 'curly-core'),
                            'value' => array(
                                esc_html__('Default', 'curly-core') => '',
                                esc_html__('Dashed', 'curly-core') => 'dashed',
                                esc_html__('Solid', 'curly-core') => 'solid',
                                esc_html__('Dotted', 'curly-core') => 'dotted'
                            ),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'width',
                            'heading' => esc_html__('Width (px or %)', 'curly-core'),
                            'dependency' => array('element' => 'type', 'value' => array('normal'))
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'thickness',
                            'heading' => esc_html__('Thickness (px)', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'top_margin',
                            'heading' => esc_html__('Top Margin (px or %)', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'bottom_margin',
                            'heading' => esc_html__('Bottom Margin (px or %)', 'curly-core')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'type' => '',
            'position' => 'center',
            'color' => '',
            'border_style' => '',
            'width' => '',
            'thickness' => '',
            'top_margin' => '',
            'bottom_margin' => ''
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['holder_styles'] = $this->getHolderStyles($params);

        $html = curly_core_get_shortcode_module_template_part('templates/separator-template', 'separator', '', $params);

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['position']) ? 'mkdf-separator-' . $params['position'] : '';
        $holderClasses[] = !empty($params['type']) ? 'mkdf-separator-' . $params['type'] : '';

        return implode(' ', $holderClasses);
    }

    private function getHolderStyles($params) {
        $styles = array();

        if ($params['color'] !== '') {
            $styles[] = 'border-color: ' . $params['color'];
        }

        if ($params['border_style'] !== '') {
            $styles[] = 'border-style: ' . $params['border_style'];
        }

        if ($params['width'] !== '') {
            if (curly_mkdf_string_ends_with($params['width'], '%') || curly_mkdf_string_ends_with($params['width'], 'px')) {
                $styles[] = 'width: ' . $params['width'];
            } else {
                $styles[] = 'width: ' . curly_mkdf_filter_px($params['width']) . 'px';
            }
        }

        if ($params['thickness'] !== '') {
            $styles[] = 'border-bottom-width: ' . curly_mkdf_filter_px($params['thickness']) . 'px';
        }

        if ($params['top_margin'] !== '') {
            if (curly_mkdf_string_ends_with($params['top_margin'], '%') || curly_mkdf_string_ends_with($params['top_margin'], 'px')) {
                $styles[] = 'margin-top: ' . $params['top_margin'];
            } else {
                $styles[] = 'margin-top: ' . curly_mkdf_filter_px($params['top_margin']) . 'px';
            }
        }

        if ($params['bottom_margin'] !== '') {
            if (curly_mkdf_string_ends_with($params['bottom_margin'], '%') || curly_mkdf_string_ends_with($params['bottom_margin'], 'px')) {
                $styles[] = 'margin-bottom: ' . $params['bottom_margin'];
            } else {
                $styles[] = 'margin-bottom: ' . curly_mkdf_filter_px($params['bottom_margin']) . 'px';
            }
        }

        return implode(';', $styles);
    }
}
