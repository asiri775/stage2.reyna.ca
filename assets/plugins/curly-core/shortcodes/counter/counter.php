<?php
namespace CurlyCore\CPT\Shortcodes\Counter;

use CurlyCore\Lib;

class Counter implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'mkdf_counter';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Counter', 'curly-core'),
                    'base' => $this->getBase(),
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'icon' => 'icon-wpb-counter extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
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
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'type',
                            'heading' => esc_html__('Type', 'curly-core'),
                            'value' => array(
                                esc_html__('Zero Counter', 'curly-core') => 'mkdf-zero-counter',
                                esc_html__('Random Counter', 'curly-core') => 'mkdf-random-counter'
                            ),
                            'save_always' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'background_text',
                            'heading' => esc_html__('Background Text', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'background_text_tag',
                            'heading' => esc_html__('Background Text Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true)),
                            'save_always' => true,
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'digit',
                            'heading' => esc_html__('Digit', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'digit_font_size',
                            'heading' => esc_html__('Digit Font Size (px)', 'curly-core'),
                            'dependency' => array('element' => 'digit', 'not_empty' => true)
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'title',
                            'heading' => esc_html__('Title', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading' => esc_html__('Title Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true)),
                            'save_always' => true,
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textarea',
                            'param_name' => 'text',
                            'heading' => esc_html__('Text', 'curly-core')
                        ),

                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'type' => 'mkdf-zero-counter',
            'skin' => 'dark',
            'digit' => '',
            'digit_font_size' => '45',
            'title' => '',
            'title_tag' => 'h5',
            'text' => '',
            'background_text' => '',
            'background_text_tag' => 'var',
            'background_text_font_size' => '',
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['background_text_tag'] = !empty($params['background_text_tag']) ? $params['background_text_tag'] : $args['background_text_tag'];
        $params['background_text_styles'] = $this->getBackgroundTextStyles($params);
        $params['counter_styles'] = $this->getCounterStyles($params);

        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];

        $html = curly_core_get_shortcode_module_template_part('templates/counter', 'counter', '', $params);

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';

        return implode(' ', $holderClasses);
    }

    private function getCounterStyles($params) {
        $styles = array();

        if (!empty($params['digit_font_size'])) {
            $styles[] = 'font-size: ' . curly_mkdf_filter_px($params['digit_font_size']) . 'px';
        }

        return implode(';', $styles);
    }

    private function getBackgroundTextStyles($params) {
        $textStyles = array();

        $textStyles[] = !empty($params['background_text_font_size']) ? 'font-size:' . $params['background_text_font_size'] . 'px' : '';

        return implode(';', $textStyles);
    }
}