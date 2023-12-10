<?php
namespace CurlyCore\CPT\Shortcodes\SectionTitle;

use CurlyCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_section_title';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Section Title', 'curly-core'),
                    'base' => $this->base,
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'icon' => 'icon-wpb-section-title extended-custom-icon',
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
                            'heading' => esc_html__('Layout', 'curly-core'),
                            'value' => array(
                                esc_html__('One Column', 'curly-core') => 'standard',
                                esc_html__('Two Columns', 'curly-core') => 'two-columns'
                            ),
                            'save_always' => true,
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_position',
                            'heading' => esc_html__('Title - Text Position', 'curly-core'),
                            'value' => array(
                                esc_html__('Title Left - Text Right', 'curly-core') => 'title-left',
                                esc_html__('Title Right - Text Left', 'curly-core') => 'title-right'
                            ),
                            'save_always' => true,
                            'dependency' => array('element' => 'type', 'value' => array('two-columns')),
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'columns_space',
                            'heading' => esc_html__('Space Between Columns', 'curly-core'),
                            'value' => array(
                                esc_html__('Normal', 'curly-core') => 'normal',
                                esc_html__('Small', 'curly-core') => 'small',
                                esc_html__('Tiny', 'curly-core') => 'tiny'
                            ),
                            'save_always' => true,
                            'dependency' => array('element' => 'type', 'value' => array('two-columns')),
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'content_alignment',
                            'heading' => esc_html__('Content Alignment', 'curly-core'),
                            'value' => array(
                                esc_html__('Left', 'curly-core') => 'left',
                                esc_html__('Center', 'curly-core') => 'center',
                                esc_html__('Right', 'curly-core') => 'right'
                            ),
                            'save_always' => true,
                            'dependency' => array('element' => 'type', 'value' => array('standard')),
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'holder_padding',
                            'heading' => esc_html__('Holder Side Padding (px or %)', 'curly-core'),
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'background_text',
                            'heading' => esc_html__('Background Text', 'curly-core'),
                            'admin_label' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'background_text_tag',
                            'heading' => esc_html__('Background Text Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true)),
                            'save_always' => true,
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'background_text_font_size',
                            'heading' => esc_html__('Background Text Font Size (px)'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'title',
                            'heading' => esc_html__('Title', 'curly-core'),
                            'admin_label' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading' => esc_html__('Title Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true)),
                            'save_always' => true,
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'title_break_words',
                            'heading' => esc_html__('Position of Line Break', 'curly-core'),
                            'description' => esc_html__('Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'curly-core'),
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'disable_break_words',
                            'heading' => esc_html__('Disable Line Break for Smaller Screens', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_yes_no_select_array(false)),
                            'save_always' => true,
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'textarea',
                            'param_name' => 'text',
                            'heading' => esc_html__('Text', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'text_tag',
                            'heading' => esc_html__('Text Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                            'save_always' => true,
                            'dependency' => array('element' => 'text', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'horizontal_offset',
                            'heading' => esc_html__('Horizontal Offset (px or %)', 'edgtf-core'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'vertical_offset',
                            'heading' => esc_html__('Vertical Offset (px or %)', 'edgtf-core'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'font_size_responsive',
                            'heading' => esc_html__('Font Size (px)', 'edgtf-core'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'description' => esc_html__('Between 1366px and 1024px', 'curly-core'),
                            'group' => esc_html__('Responsive Options', 'edgtf-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'horizontal_offset_responsive',
                            'heading' => esc_html__('Horizontal Offset (px or %)', 'edgtf-core'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'description' => esc_html__('Between 1366px and 1024px', 'curly-core'),
                            'group' => esc_html__('Responsive Options', 'edgtf-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'vertical_offset_responsive',
                            'heading' => esc_html__('Vertical Offset (px or %)', 'edgtf-core'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'description' => esc_html__('Between 1366px and 1024px', 'curly-core'),
                            'group' => esc_html__('Responsive Options', 'edgtf-core'),
                        ),
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'skin' => 'dark',
            'type' => 'standard',
            'title_position' => 'title-left',
            'columns_space' => 'normal',
            'content_alignment' => '',
            'holder_padding' => '',
            'background_text' => '',
            'background_text_tag' => 'var',
            'background_text_font_size' => '225',
            'title' => '',
            'title_tag' => 'h2',
            'title_color' => '',
            'title_break_words' => '',
            'disable_break_words' => '',
            'text' => '',
            'text_tag' => 'p',
            'horizontal_offset' => '',
            'vertical_offset' => '',
            'font_size_responsive' => '',
            'horizontal_offset_responsive' => '',
            'vertical_offset_responsive' => '',
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params, $args);
        $params['holder_styles'] = $this->getHolderStyles($params);
        $params['background_text_tag'] = !empty($params['background_text_tag']) ? $params['background_text_tag'] : $args['background_text_tag'];
        $params['background_text_styles'] = $this->getBackgroundTextStyles($params);
        $params['title'] = $this->getModifiedTitle($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
        $params['text_tag'] = !empty($params['text_tag']) ? $params['text_tag'] : $args['text_tag'];
        $params['data_atts'] = $this->getDataAtts($params);

        $html = curly_core_get_shortcode_module_template_part('templates/section-title', 'section-title', '', $params);

        return $html;
    }

    private function getHolderClasses($params, $args) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';
        $holderClasses[] = !empty($params['type']) ? 'mkdf-st-' . $params['type'] : 'mkdf-st-' . $args['type'];
        $holderClasses[] = !empty($params['title_position']) ? 'mkdf-st-' . $params['title_position'] : 'mkdf-st-' . $args['title_position'];
        $holderClasses[] = !empty($params['columns_space']) ? 'mkdf-st-' . $params['columns_space'] . '-space' : 'mkdf-st-' . $args['columns_space'] . '-space';
        $holderClasses[] = $params['disable_break_words'] === 'yes' ? 'mkdf-st-disable-title-break' : '';

        return implode(' ', $holderClasses);
    }

    private function getHolderStyles($params) {
        $styles = array();

        if (!empty($params['holder_padding'])) {
            $styles[] = 'padding: 0 ' . $params['holder_padding'];
        }

        if (!empty($params['content_alignment'])) {
            $styles[] = 'text-align: ' . $params['content_alignment'];
        }

        return implode(';', $styles);
    }

    private function getBackgroundTextStyles($params) {
        $textStyles = array();

        $textStyles[] = 'font-size:' . $params['background_text_font_size'] . 'px';
        if (!empty($params['horizontal_offset'])) {
            $textStyles[] = 'left: ' . $params['horizontal_offset'];
        }
        if (!empty($params['vertical_offset'])) {
            $textStyles[] = 'top: ' . $params['vertical_offset'];
        }

        return implode(';', $textStyles);
    }

    private function getModifiedTitle($params) {
        $title = $params['title'];
        $title_break_words = str_replace(' ', '', $params['title_break_words']);

        if (!empty($title)) {
            $split_title = explode(' ', $title);

            if (!empty($title_break_words)) {
	            $title_break_words = intval($title_break_words);
                if (!empty($split_title[$title_break_words - 1])) {
                    $split_title[$title_break_words - 1] = $split_title[$title_break_words - 1] . '<br />';
                }
            }

            $title = implode(' ', $split_title);
        }

        return $title;
    }

    private function getDataAtts($params) {
        $data = array();

        if ($params['font_size_responsive'] !== '') {
            $data['data-font-size'] = curly_mkdf_filter_px($params['font_size_responsive']) . 'px';
        }

        if ($params['horizontal_offset_responsive'] !== '') {
            $data['data-horizontal-offset'] = $params['horizontal_offset_responsive'];
        }

        if ($params['vertical_offset_responsive'] !== '') {
            $data['data-vertical-offset'] = $params['vertical_offset_responsive'];
        }

        return $data;
    }
}