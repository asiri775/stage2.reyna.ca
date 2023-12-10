<?php
namespace CurlyBusiness\Shortcodes\WorkingHours;

use CurlyBusiness\Lib\ShortcodeInterface;

class WorkingHours implements ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'mkdf_working_hours';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name' => esc_html__('Working Hours', 'curly-business'),
            'base' => $this->base,
            'category' => esc_html__('by CURLY BUSINESS', 'curly-business'),
            'icon' => 'icon-wpb-working-hours extended-custom-business-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'custom_class',
                    'heading' => esc_html__('Custom CSS Class', 'curly-business'),
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-business')
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => esc_html__('Title', 'curly-business'),
                    'admin_label' => true,
                    'group' => esc_html__('Styling Options', 'curly-business')
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'title_tag',
                    'heading' => esc_html__('Title Tag', 'curly-business'),
                    'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                    'save_always' => true,
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group' => esc_html__('Styling Options', 'curly-business')
                ),
                array(
                    'type' => 'colorpicker',
                    'param_name' => 'title_color',
                    'heading' => esc_html__('Title Color', 'curly-business'),
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group' => esc_html__('Styling Options', 'curly-business')
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'title_font_weight',
                    'heading' => esc_html__('Title Font Weight', 'curly-business'),
                    'value' => array_flip(curly_mkdf_get_font_weight_array(true)),
                    'save_always' => true,
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group' => esc_html__('Styling Options', 'curly-business')
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'title_bottom_margin',
                    'heading' => esc_html__('Title Bottom Margin (px)', 'curly-business'),
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group' => esc_html__('Styling Options', 'curly-business')
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
                    'param_name' => 'label_tag',
                    'heading' => esc_html__('Label Tag', 'curly-business'),
                    'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                    'save_always' => true,
                    'std' => 'h4',
                    'group' => esc_html__('Styling Options', 'curly-business')
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'time_tag',
                    'heading' => esc_html__('Time Tag', 'curly-business'),
                    'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                    'std' => 'p',
                    'save_always' => true,
                    'group' => esc_html__('Styling Options', 'curly-business')
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'title' => '',
            'title_tag' => 'h6',
            'title_color' => '',
            'title_font_weight' => '',
            'title_bottom_margin' => '',
            'label_tag' => 'h4',
            'time_tag' => 'p',
            'skin' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['working_hours'] = $this->getWorkingHours();

        return curly_business_get_template_part('modules/shortcodes/working-hours/templates/working-hours-template', '', $params, true);
    }

    private function getWorkingHours() {
        $workingHours = array();

        if (curly_business_theme_installed()) {
            switch (curly_mkdf_options()->getOptionValue('working_hours_layout')):

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'workdays-weekend':
                    // working days
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_from') !== '') {
                        $workingHours['work_days']['label'] = __('Working Days', 'curly-business');
                        $workingHours['work_days']['from'] = curly_mkdf_options()->getOptionValue('wh_work_days_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_to') !== '') {
                        $workingHours['work_days']['to'] = curly_mkdf_options()->getOptionValue('wh_work_days_to');
                    }

                    // weekends
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_from') !== '') {
                        $workingHours['weekend']['label'] = __('Weekend', 'curly-business');
                        $workingHours['weekend']['from'] = curly_mkdf_options()->getOptionValue('wh_weekend_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_to') !== '') {
                        $workingHours['weekend']['to'] = curly_mkdf_options()->getOptionValue('wh_weekend_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'workdays-sat-sun':
                    // working days
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_from') !== '') {
                        $workingHours['work_days']['label'] = __('Working Days', 'curly-business');
                        $workingHours['work_days']['from'] = curly_mkdf_options()->getOptionValue('wh_work_days_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_to') !== '') {
                        $workingHours['work_days']['to'] = curly_mkdf_options()->getOptionValue('wh_work_days_to');
                    }

                    // saturday
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_from') !== '') {
                        $workingHours['saturday']['label'] = __('Saturday', 'curly-business');
                        $workingHours['saturday']['from'] = curly_mkdf_options()->getOptionValue('wh_saturday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_to') !== '') {
                        $workingHours['saturday']['to'] = curly_mkdf_options()->getOptionValue('wh_saturday_to');
                    }

                    // sunday
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_from') !== '') {
                        $workingHours['sunday']['label'] = __('Sunday', 'curly-business');
                        $workingHours['sunday']['from'] = curly_mkdf_options()->getOptionValue('wh_sunday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_to') !== '') {
                        $workingHours['sunday']['to'] = curly_mkdf_options()->getOptionValue('wh_sunday_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'same':
                    // same
                    if (curly_mkdf_options()->getOptionValue('wh_same_from') !== '') {
                        $workingHours['same']['label'] = __('Every Day', 'curly-business');
                        $workingHours['same']['from'] = curly_mkdf_options()->getOptionValue('wh_same_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_same_to') !== '') {
                        $workingHours['same']['to'] = curly_mkdf_options()->getOptionValue('wh_same_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'mon-tue-wed-thu-fri-weekend':
                    // monday
                    if (curly_mkdf_options()->getOptionValue('wh_monday_from') !== '') {
                        $workingHours['monday']['label'] = __('Monday', 'curly-business');
                        $workingHours['monday']['from'] = curly_mkdf_options()->getOptionValue('wh_monday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_monday_to') !== '') {
                        $workingHours['monday']['to'] = curly_mkdf_options()->getOptionValue('wh_monday_to');
                    }

                    // tuesday
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_from') !== '') {
                        $workingHours['tuesday']['label'] = __('Tuesday', 'curly-business');
                        $workingHours['tuesday']['from'] = curly_mkdf_options()->getOptionValue('wh_tuesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_to') !== '') {
                        $workingHours['tuesday']['to'] = curly_mkdf_options()->getOptionValue('wh_tuesday_to');
                    }

                    // wednesday
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_from') !== '') {
                        $workingHours['wednesday']['label'] = __('Wednesday', 'curly-business');
                        $workingHours['wednesday']['from'] = curly_mkdf_options()->getOptionValue('wh_wednesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_to') !== '') {
                        $workingHours['wednesday']['to'] = curly_mkdf_options()->getOptionValue('wh_wednesday_to');
                    }

                    // thursday
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_from') !== '') {
                        $workingHours['thursday']['label'] = __('Thursday', 'curly-business');
                        $workingHours['thursday']['from'] = curly_mkdf_options()->getOptionValue('wh_thursday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_to') !== '') {
                        $workingHours['thursday']['to'] = curly_mkdf_options()->getOptionValue('wh_thursday_to');
                    }

                    // friday
                    if (curly_mkdf_options()->getOptionValue('wh_friday_from') !== '') {
                        $workingHours['friday']['label'] = __('Friday', 'curly-business');
                        $workingHours['friday']['from'] = curly_mkdf_options()->getOptionValue('wh_friday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_friday_to') !== '') {
                        $workingHours['friday']['to'] = curly_mkdf_options()->getOptionValue('wh_friday_to');
                    }

                    // weekends
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_from') !== '') {
                        $workingHours['weekend']['label'] = __('Weekend', 'curly-business');
                        $workingHours['weekend']['from'] = curly_mkdf_options()->getOptionValue('wh_weekend_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_to') !== '') {
                        $workingHours['weekend']['to'] = curly_mkdf_options()->getOptionValue('wh_weekend_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                default:
                    // monday
                    if (curly_mkdf_options()->getOptionValue('wh_monday_from') !== '') {
                        $workingHours['monday']['label'] = __('Monday', 'curly-business');
                        $workingHours['monday']['from'] = curly_mkdf_options()->getOptionValue('wh_monday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_monday_to') !== '') {
                        $workingHours['monday']['to'] = curly_mkdf_options()->getOptionValue('wh_monday_to');
                    }

                    // tuesday
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_from') !== '') {
                        $workingHours['tuesday']['label'] = __('Tuesday', 'curly-business');
                        $workingHours['tuesday']['from'] = curly_mkdf_options()->getOptionValue('wh_tuesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_to') !== '') {
                        $workingHours['tuesday']['to'] = curly_mkdf_options()->getOptionValue('wh_tuesday_to');
                    }

                    // wednesday
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_from') !== '') {
                        $workingHours['wednesday']['label'] = __('Wednesday', 'curly-business');
                        $workingHours['wednesday']['from'] = curly_mkdf_options()->getOptionValue('wh_wednesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_to') !== '') {
                        $workingHours['wednesday']['to'] = curly_mkdf_options()->getOptionValue('wh_wednesday_to');
                    }

                    // thursday
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_from') !== '') {
                        $workingHours['thursday']['label'] = __('Thursday', 'curly-business');
                        $workingHours['thursday']['from'] = curly_mkdf_options()->getOptionValue('wh_thursday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_to') !== '') {
                        $workingHours['thursday']['to'] = curly_mkdf_options()->getOptionValue('wh_thursday_to');
                    }

                    // friday
                    if (curly_mkdf_options()->getOptionValue('wh_friday_from') !== '') {
                        $workingHours['friday']['label'] = __('Friday', 'curly-business');
                        $workingHours['friday']['from'] = curly_mkdf_options()->getOptionValue('wh_friday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_friday_to') !== '') {
                        $workingHours['friday']['to'] = curly_mkdf_options()->getOptionValue('wh_friday_to');
                    }

                    // saturday
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_from') !== '') {
                        $workingHours['saturday']['label'] = __('Saturday', 'curly-business');
                        $workingHours['saturday']['from'] = curly_mkdf_options()->getOptionValue('wh_saturday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_to') !== '') {
                        $workingHours['saturday']['to'] = curly_mkdf_options()->getOptionValue('wh_saturday_to');
                    }

                    // sunday
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_from') !== '') {
                        $workingHours['sunday']['label'] = __('Sunday', 'curly-business');
                        $workingHours['sunday']['from'] = curly_mkdf_options()->getOptionValue('wh_sunday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_to') !== '') {
                        $workingHours['sunday']['to'] = curly_mkdf_options()->getOptionValue('wh_sunday_to');
                    }
            endswitch;
        }

        return $workingHours;
    }

    private function getHolderClasses($params) {
        $classes = array();

        $classes[] = 'mkdf-wh-holder';
        $classes[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $classes[] = !empty($params['skin']) ? 'mkdf-wh-' . $params['skin'] : '';

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
}
