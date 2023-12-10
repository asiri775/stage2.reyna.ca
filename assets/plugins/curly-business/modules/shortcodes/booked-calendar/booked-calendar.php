<?php
namespace CurlyBusiness\Shortcodes\BookedCalendar;

use CurlyBusiness\Lib\ShortcodeInterface;

class BookedCalendar implements ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'mkdf_booked_calendar';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name' => esc_html__('Booked Calendar', 'curly-business'),
            'base' => $this->base,
            'category' => esc_html__('by CURLY BUSINESS', 'curly-business'),
            'icon' => 'icon-wpb-booked-calendar extended-custom-business-icon',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'custom_class',
                    'heading' => esc_html__('Custom CSS Class', 'curly-business'),
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-business')
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'calendar',
                    'heading' => esc_html__('Calendar', 'curly-business'),
                    'value' => array_flip(curly_business_get_booked_calendar_array()),
                    'save_always' => true
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'calendar_size',
                    'heading' => esc_html__('Calendar Size', 'curly-business'),
                    'value' => array(
                        esc_html__('Large', 'curly-business') => 'large',
                        esc_html__('Small', 'curly-business') => 'small'
                    ),
                    'save_always' => true
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'calendar_style',
                    'heading' => esc_html__('Calendar Style', 'curly-business'),
                    'value' => array_flip(curly_business_get_booked_shortcodes_types()),
                    'save_always' => true
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => esc_html__('Title', 'curly-business'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'title_tag',
                    'heading' => esc_html__('Title Tag', 'curly-business'),
                    'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                    'save_always' => true,
                    'dependency' => array('element' => 'title', 'not_empty' => true)
                ),
                array(
                    'type' => 'colorpicker',
                    'param_name' => 'title_color',
                    'heading' => esc_html__('Title Color', 'curly-business'),
                    'dependency' => array('element' => 'title', 'not_empty' => true)
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'title_font_weight',
                    'heading' => esc_html__('Title Font Weight', 'curly-business'),
                    'value' => array_flip(curly_mkdf_get_font_weight_array(true)),
                    'save_always' => true,
                    'dependency' => array('element' => 'title', 'not_empty' => true)
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'title_bottom_margin',
                    'heading' => esc_html__('Title Bottom Margin (px)', 'curly-business'),
                    'dependency' => array('element' => 'title', 'not_empty' => true)
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'skin',
                    'heading' => esc_html__('Skin', 'curly-business'),
                    'value' => array_flip(curly_business_get_business_shortcodes_skins()),
                    'save_always' => true
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'calendar' => '',
            'calendar_size' => 'large',
            'calendar_style' => 'calendar',
            'title' => '',
            'title_tag' => 'h6',
            'title_color' => '',
            'title_font_weight' => '',
            'title_bottom_margin' => '',
            'skin' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['content'] = $content;
        $params['calendar_attrs'] = $this->getCalendarAttributes($params);

        return curly_business_get_template_part('modules/shortcodes/booked-calendar/templates/booked-calendar-template', '', $params, true);
    }

    private function getHolderClasses($params) {
        $classes = array();

        $classes[] = 'mkdf-booked-calendar';
        $classes[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $classes[] = !empty($params['skin']) ? 'mkdf-booked-' . $params['skin'] : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($classes));
    }

    private function getTitleStyles($params) {
        $styles = array();

        $styles[] = !empty($params['title_color']) ? 'color: ' . $params['title_color'] : '';
        $styles[] = !empty($params['title_font_weight']) ? 'font-weight: ' . $params['title_font_weight'] : '';
        $styles[] = !empty($params['title_bottom_margin']) ? 'margin-bottom: ' . curly_mkdf_filter_px($params['title_bottom_margin']) . 'px' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(';', array_filter($styles));
    }

    private function getCalendarAttributes($params) {
        $attrs = array();

        $attrs[] = !empty($params['calendar']) ? 'calendar="' . esc_attr($params['calendar']) . '"' : '';
        $attrs[] = !empty($params['calendar_size']) ? 'size="' . esc_attr($params['calendar_size']) . '"' : '';
        $attrs[] = !empty($params['calendar_style']) ? 'style="' . esc_attr($params['calendar_style']) . '"' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($attrs));
    }
}