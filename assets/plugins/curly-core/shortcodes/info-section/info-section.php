<?php
namespace CurlyCore\CPT\Shortcodes\InfoSection;

use CurlyCore\Lib;

class InfoSection implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_info_section';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Info Section', 'curly-core'),
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
                            'param_name' => 'content_align',
                            'heading' => esc_html__('Content Align', 'curly-core'),
                            'value' => array(
                                esc_html__('Left', 'curly-core') => 'left',
                                esc_html__('Center', 'curly-core') => 'center',
                                esc_html__('Right', 'curly-core') => 'right',
                            ),
                            'std' => 'center',
                            'save_always' => true,
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'content_width',
                            'heading' => esc_html__('Content Width (%)', 'curly-core'),
                            'description' => esc_html__('Please insert value in percents', 'curly-core'),
                            'group' => esc_html__('Layout Options', 'curly-core'),
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
                            'heading' => esc_html__('Background Text Font Size (px)', 'curly-core'),
                            'description' => esc_html__('Please insert value in pixels', 'curly-core'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'subtitle',
                            'heading' => esc_html__('Subtitle', 'curly-core'),
                            'admin_label' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'subtitle_tag',
                            'heading' => esc_html__('Subtitle Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true)),
                            'save_always' => true,
                            'dependency' => array('element' => 'subtitle', 'not_empty' => true),
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
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'link',
                            'heading' => esc_html__('Link', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'link_target',
                            'heading' => esc_html__('Target', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_link_target_array()),
                            'dependency' => array('element' => 'link', 'not_empty' => true),
                            'save_always' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'link_text',
                            'heading' => esc_html__('Link Text', 'curly-core'),
                            'dependency' => array('element' => 'link', 'not_empty' => true)
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'link_type',
                            'heading' => esc_html__('Link Type', 'curly-core'),
                            'value' => array(
                                esc_html__('Simple', 'curly-core') => 'simple',
                                esc_html__('Outline', 'curly-core') => 'outline',
                            ),
                            'dependency' => array('element' => 'link', 'not_empty' => true),
                            'save_always' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'link_top_offset',
                            'heading' => esc_html__('Link Top Offset (px or %)', 'curly-core'),
                            'description' => esc_html__('Please insert value in pixels or percents', 'curly-core'),
                            'group' => esc_html__('Layout Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'background_text_font_size_responsive',
                            'heading' => esc_html__('Background Text Font Size (px)', 'curly-core'),
                            'dependency' => array('element' => 'background_text', 'not_empty' => true),
                            'description' => esc_html__('Between 1366px and 1025px', 'curly-core'),
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
            'content_align' => 'center',
            'content_width' => '66',
            'skin' => 'dark',
            'background_text' => '',
            'background_text_tag' => 'var',
            'background_text_font_size' => '225',
            'subtitle' => '',
            'subtitle_tag' => 'h5',
            'title' => '',
            'title_tag' => 'h3',
            'text' => '',
            'text_tag' => 'p',
            'link' => '',
            'link_target' => '_blank',
            'link_text' => '',
            'link_type' => 'simple',
            'link_top_offset' => '',
            'background_text_font_size_responsive' => '',
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['background_text_tag'] = !empty($params['background_text_tag']) ? $params['background_text_tag'] : $args['background_text_tag'];
        $params['background_text_styles'] = $this->getBackgroundTextStyles($params);
        $params['content_styles'] = $this->getContentStyles($params);
        $params['subtitle_tag'] = !empty($params['subtitle_tag']) ? $params['subtitle_tag'] : $args['subtitle_tag'];
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
        $params['text_tag'] = !empty($params['text_tag']) ? $params['text_tag'] : $args['text_tag'];
        $params['button_params'] = $this->getButtonParams($params);
        $params['link_styles'] = $this->getLinkStyles($params);
        $params['data_atts'] = $this->getDataAtts($params);

        $html = curly_core_get_shortcode_module_template_part('templates/info-section', 'info-section', '', $params);

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';
        $holderClasses[] = 'mkdf-' . $params['content_align'];

        return implode(' ', $holderClasses);
    }

    private function getBackgroundTextStyles($params) {
        $textStyles = array();

        $textStyles[] = 'font-size:' . $params['background_text_font_size'] . 'px';

        return implode(';', $textStyles);
    }

    private function getContentStyles($params) {
        $contentStyles = array();

        if (!empty($params['background_text'])) {
            $contentStyles[] = 'padding-top:' . ($params['background_text_font_size'] / 2) . 'px';
        }

        $contentStyles[] = 'width:' . $params['content_width'] . '%';

        return implode(';', $contentStyles);
    }

    private function getButtonParams($params) {
        $buttonParams = array();

        $buttonParams['link'] = $params['link'];
        $buttonParams['target'] = $params['link_target'];
        $buttonParams['text'] = $params['link_text'];
        $buttonParams['type'] = $params['link_type'];
        $buttonParams['size'] = 'medium';

        if ($params['skin'] === 'light' && $params['link_type'] === 'outline') {
            $buttonParams['color'] = '#ffffff';
            $buttonParams['border_color'] = '#ffffff';
        }

        return $buttonParams;
    }

    private function getLinkStyles($params) {
        $linkStyles = array();

        $linkStyles[] = !empty($params['link_top_offset']) ? 'margin-top:' . $params['link_top_offset'] : '';

        return implode(';', $linkStyles);
    }

    private function getDataAtts($params) {
        $data = array();

        if ($params['background_text_font_size_responsive'] !== '') {
            $data['data-font-size'] = curly_mkdf_filter_px($params['background_text_font_size_responsive']);
        }

        return $data;
    }
}