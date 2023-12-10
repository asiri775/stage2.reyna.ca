<?php
namespace CurlyCore\CPT\Shortcodes\VerticalSplitSlider;

use CurlyCore\Lib;

class VerticalSplitSlider implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_vertical_split_slider';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Vertical Split Slider', 'curly-core'),
                    'base' => $this->base,
                    'icon' => 'icon-wpb-vertical-split-slider extended-custom-icon',
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'as_parent' => array('only' => 'mkdf_vertical_split_slider_left_panel, mkdf_vertical_split_slider_right_panel'),
                    'js_view' => 'VcColumnView',
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'enable_scrolling_animation',
                            'heading' => esc_html__('Enable Scrolling Animation', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_yes_no_select_array(false))
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'enable_scrolling_animation' => 'no'
        );
        $params = shortcode_atts($args, $atts);

        $holder_classes = $this->getHolderClasses($params);

        $html = '<div class="mkdf-vertical-split-slider ' . esc_attr($holder_classes) . '">';
        $html .= do_shortcode($content);
        $html .= '<div class="mkdf-vss-horizontal-mask"></div>';
        $html .= '<div class="mkdf-vss-vertical-mask"></div>';
        $html .= '</div>';

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = $params['enable_scrolling_animation'] === 'yes' ? 'mkdf-vss-scrolling-animation' : '';

        return implode(' ', $holderClasses);
    }
}
