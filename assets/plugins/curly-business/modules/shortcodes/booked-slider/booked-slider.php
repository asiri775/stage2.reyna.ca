<?php
namespace CurlyBusiness\Shortcodes\BookedSlider;

use CurlyBusiness\Lib\ShortcodeInterface;

class BookedSlider implements ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'mkdf_booked_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Booked Slider', 'curly-business'),
                'base' => $this->base,
                'category' => esc_html__('by CURLY BUSINESS', 'curly-business'),
                'icon' => 'icon-wpb-booked-slider extended-custom-business-icon',
                'js_view' => 'VcColumnView',
                'as_parent' => array('only' => 'rev_slider_vc'),
                'content_element' => true,
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
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'calendar_position',
                        'heading' => esc_html__('Calendar Position', 'curly-business'),
                        'value' => array(
                            esc_html__('Left', 'curly-business') => 'left',
                            esc_html__('Right', 'curly-business') => 'right',
                            esc_html__('Center', 'curly-business') => 'center'
                        ),
                        'save_always' => true,
                        'group' => esc_html__('Calendar Position', 'curly-business'),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'calendar_width',
                        'heading' => esc_html__('Calendar Width (px or %)', 'curly-business'),
                        'group' => esc_html__('Calendar Position', 'curly-business'),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'top_offset',
                        'heading' => esc_html__('Calendar Top Offset (px or %)', 'curly-business'),
                        'group' => esc_html__('Calendar Position', 'curly-business'),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'side_offset',
                        'heading' => esc_html__('Calendar Side Offset (px or %)', 'curly-business'),
                        'group' => esc_html__('Calendar Position', 'curly-business'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'calendar_is_middle',
                        'heading' => esc_html__('Set Calendar Vertical Align Middle', 'curly-business'),
                        'value' => array_flip(curly_mkdf_get_yes_no_select_array(false)),
                        'save_always' => true,
                        'group' => esc_html__('Calendar Position', 'curly-business'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'calendar_in_grid',
                        'heading' => esc_html__('Set Calendar In Grid', 'curly-business'),
                        'value' => array_flip(curly_mkdf_get_yes_no_select_array(false, true)),
                        'save_always' => true,
                        'group' => esc_html__('Calendar Position', 'curly-business'),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'width_laptop',
                        'heading' => esc_html__('Set calendar width for laptop screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Laptop', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'top_offset_laptop',
                        'heading' => esc_html__('Set calendar top offset for laptop screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Laptop', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'side_offset_laptop',
                        'heading' => esc_html__('Set calendar side offset for laptop screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Laptop', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'width_ipad_landscape',
                        'heading' => esc_html__('Set calendar width for tablet landscape screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Tablet Landscape', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'top_offset_ipad_landscape',
                        'heading' => esc_html__('Set calendar top offset for tablet landscape screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Tablet Landscape', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'side_offset_ipad_landscape',
                        'heading' => esc_html__('Set calendar side offset for tablet landscape screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Tablet Landscape', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'width_ipad',
                        'heading' => esc_html__('Set calendar width for tablet portrait screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Tablet Portrait', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'top_offset_ipad',
                        'heading' => esc_html__('Set calendar top offset for tablet portrait screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Tablet Portrait', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'side_offset_ipad',
                        'heading' => esc_html__('Set calendar side offset for tablet portrait screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Tablet Portrait', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'width_mobile',
                        'heading' => esc_html__('Set calendar width for mobile devices screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Mobile', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'top_offset_mobile',
                        'heading' => esc_html__('Set calendar top offset for mobile devices screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Mobile', 'curly-business')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'side_offset_mobile',
                        'heading' => esc_html__('Set calendar top offset for mobile devices screen size and smaller', 'curly-business'),
                        'description' => esc_html__('Please insert value with px or %', 'curly-business'),
                        'group' => esc_html__('Mobile', 'curly-business')
                    ),
                )
            )
        );
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
            'skin' => '',
            'calendar_position' => 'right',
            'calendar_width' => '',
            'top_offset' => '',
            'side_offset' => '',
            'calendar_is_middle' => 'no',
            'calendar_in_grid' => 'yes',
            'width_laptop' => '',
            'top_offset_laptop' => '',
            'side_offset_laptop' => '',
            'width_ipad_landscape' => '',
            'top_offset_ipad_landscape' => '',
            'side_offset_ipad_landscape' => '',
            'width_ipad' => '',
            'top_offset_ipad' => '',
            'side_offset_ipad' => '',
            'width_mobile' => '',
            'top_offset_mobile' => '',
            'side_offset_mobile' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['content'] = $content;
        $params['calendar_attrs'] = $this->getCalendarAttributes($params);
        $params['calendar_in_grid'] = $params['calendar_in_grid'] === 'yes' ? true : false;

        $params['calendar_styles'] = $this->getCalendarStyles($params);
        $params['calendar_responsive_data'] = '';
        $params['calendar_responsive_data'] = $this->getCalendarResponsiveData($params);

        return curly_business_get_template_part('modules/shortcodes/booked-slider/templates/booked-slider-template', '', $params, true);
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = 'mkdf-booked-slider';
        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-booked-' . $params['skin'] : '';
        $holderClasses[] = !empty($params['calendar_position']) ? 'mkdf-' . $params['calendar_position'] . '-position' : '';
        $holderClasses[] = $params['calendar_is_middle'] === 'yes' ? 'mkdf-bs-calendar-is-middle' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($holderClasses));
    }

    private function getCalendarAttributes($params) {
        $attrs = array();

        $attrs[] = !empty($params['calendar']) ? 'calendar="' . esc_attr($params['calendar']) . '"' : '';
        $attrs[] = !empty($params['calendar_size']) ? 'size="' . esc_attr($params['calendar_size']) . '"' : '';
        $attrs[] = !empty($params['calendar_style']) ? 'style="' . esc_attr($params['calendar_style']) . '"' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($attrs));
    }

    private function getTitleStyles($params) {
        $styles = array();

        $styles[] = !empty($params['title_color']) ? 'color: ' . $params['title_color'] : '';
        $styles[] = !empty($params['title_font_weight']) ? 'font-weight: ' . $params['title_font_weight'] : '';
        $styles[] = !empty($params['title_bottom_margin']) ? 'margin-bottom: ' . curly_mkdf_filter_px($params['title_bottom_margin']) . 'px' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(';', array_filter($styles));
    }

    private function getCalendarStyles($params) {
        $styles = array();

        $styles[] = !empty($params['calendar_width'] !== '') ? 'width: ' . $params['calendar_width'] : '';


        if ($params['top_offset'] !== '' && $params['calendar_is_middle'] !== 'yes') {
            $styles[] = 'top: ' . $params['top_offset'];
        } else if ($params['top_offset'] !== '' && $params['calendar_is_middle'] === 'yes') {
            $styles[] = 'margin-top: ' . $params['top_offset'];
        }

        if ($params['side_offset'] !== '' && $params['calendar_position'] === 'left') {
            $styles[] = 'left: ' . $params['side_offset'];
        }

        if ($params['side_offset'] !== '' && $params['calendar_position'] === 'right') {
            $styles[] = 'right: ' . $params['side_offset'];
        }

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(';', array_filter($styles));
    }

    private function getCalendarResponsiveData($params) {
        $data = array();

        if ($params['width_laptop'] !== '') {
            $data['data-width-laptop'] = $params['width_laptop'];
        }

        if ($params['top_offset_laptop'] !== '') {
            $data['data-top-offset-laptop'] = $params['top_offset_laptop'];
        }

        if ($params['side_offset_laptop'] !== '') {
            $data['data-side-offset-laptop'] = $params['side_offset_laptop'];
        }

        if ($params['width_ipad_landscape'] !== '') {
            $data['data-width-ipad-landscape'] = $params['width_ipad_landscape'];
        }

        if ($params['top_offset_ipad_landscape'] !== '') {
            $data['data-top-offset-ipad-landscape'] = $params['top_offset_ipad_landscape'];
        }

        if ($params['side_offset_ipad_landscape'] !== '') {
            $data['data-side-offset-ipad-landscape'] = $params['side_offset_ipad_landscape'];
        }

        if ($params['width_ipad'] !== '') {
            $data['data-width-ipad'] = $params['width_ipad'];
        }

        if ($params['top_offset_ipad'] !== '') {
            $data['data-top-offset-ipad'] = $params['top_offset_ipad'];
        }

        if ($params['side_offset_ipad'] !== '') {
            $data['data-side-offset-ipad'] = $params['side_offset_ipad'];
        }

        if ($params['width_mobile'] !== '') {
            $data['data-width-mobile'] = $params['width_mobile'];
        }

        if ($params['top_offset_mobile'] !== '') {
            $data['data-top-offset-mobile'] = $params['top_offset_mobile'];
        }

        if ($params['side_offset_mobile'] !== '') {
            $data['data-side-offset-mobile'] = $params['side_offset_mobile'];
        }

        return $data;
    }
}