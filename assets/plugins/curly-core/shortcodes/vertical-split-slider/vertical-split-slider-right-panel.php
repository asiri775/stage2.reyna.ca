<?php
namespace CurlyCore\CPT\Shortcodes\VerticalSplitSliderRightPanel;

use CurlyCore\Lib;

class VerticalSplitSliderRightPanel implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_vertical_split_slider_right_panel';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Right Sliding Panel', 'curly-core'),
                    'base' => $this->base,
                    'as_parent' => array('only' => 'mkdf_vertical_split_slider_content_item'),
                    'as_child' => array('only' => 'mkdf_vertical_split_slider'),
                    'content_element' => true,
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'icon' => 'icon-wpb-vertical-split-slider-right-panel extended-custom-icon',
                    'show_settings_on_create' => false,
                    'js_view' => 'VcColumnView'
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $html = '<div class="mkdf-vss-ms-right">';
        $html .= do_shortcode($content);
        $html .= '</div>';

        return $html;
    }
}
