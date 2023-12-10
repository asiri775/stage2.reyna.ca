<?php
namespace CurlyCore\CPT\Shortcodes\Banner;

use CurlyCore\Lib;

class Banner implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'mkdf_banner';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Banner', 'curly-core'),
                    'base' => $this->getBase(),
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'icon' => 'icon-wpb-banner extended-custom-icon',
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
                            'type' => 'textfield',
                            'param_name' => 'tagline',
                            'heading' => esc_html__('Tagline', 'curly-core'),
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'tagline_tag',
                            'heading' => esc_html__('Tagline Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                            'save_always' => true,
                            'dependency' => array('element' => 'tagline', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core'),
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
                            'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                            'save_always' => true,
                            'dependency' => array('element' => 'title', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core'),
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'subtitle',
                            'heading' => esc_html__('Subtitle', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'subtitle_tag',
                            'heading' => esc_html__('Subtitle Tag', 'curly-core'),
                            'value' => array_flip(curly_mkdf_get_title_tag(true, array('p' => 'p'))),
                            'save_always' => true,
                            'dependency' => array('element' => 'subtitle', 'not_empty' => true),
                            'group' => esc_html__('Styling Options', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'hover_behavior',
                            'heading' => esc_html__('Hover Behavior', 'curly-core'),
                            'value' => array(
                                esc_html__('Visible on Hover', 'curly-core') => 'mkdf-visible-on-hover',
                                esc_html__('Visible on Default', 'curly-core') => 'mkdf-visible-on-default',
                            ),
                            'save_always' => true,
                            'group' => esc_html__('Layout Options', 'curly-core')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'content_align',
                            'heading' => esc_html__('Content Align', 'curly-core'),
                            'value' => array(
                                esc_html__('Left', 'curly-core') => 'left',
                                esc_html__('Center', 'curly-core') => 'center',
                                esc_html__('Right', 'curly-core') => 'right'
                            ),
                            'save_always' => true,
                            'group' => esc_html__('Layout Options', 'curly-core'),
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
                            'dependency' => array('element' => 'link', 'not_empty' => true)
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'link_text',
                            'heading' => esc_html__('Link Text', 'curly-core'),
                            'dependency' => array('element' => 'link', 'not_empty' => true)
                        ),
                        array(
                            'type' => 'checkbox',
                            'param_name' => 'transparent_background',
                            'heading' => esc_html__('Transparent Background?', 'curly-core'),
                            'value' => esc_html__('Yes', 'curly-core'),
                            'group' => esc_html__('Styling Options', 'curly-core'),
                        ),
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class' => '',
            'tagline' => '',
            'tagline_tag' => 'var',
            'title' => '',
            'title_tag' => 'h3',
            'subtitle' => '',
            'subtitle_tag' => 'h5',
            'link' => '',
            'link_target' => '_self',
            'link_text' => '',
            'skin' => 'dark',
            'content_align' => 'center',
            'hover_behavior' => 'mkdf-visible-on-hover',
            'transparent_background' => '',
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params, $args);
        $params['tagline_tag'] = !empty($params['tagline_tag']) ? $params['tagline_tag'] : $args['tagline_tag'];
        $params['subtitle_tag'] = !empty($params['subtitle_tag']) ? $params['subtitle_tag'] : $args['subtitle_tag'];
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
        $params['button_params'] = $this->getButtonParams($params);

        $html = curly_core_get_shortcode_module_template_part('templates/banner', 'banner', '', $params);

        return $html;
    }

    private function getHolderClasses($params, $args) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['hover_behavior']) ? $params['hover_behavior'] : $args['hover_behavior'];
        $holderClasses[] = 'mkdf-' . $params['content_align'];
        $holderClasses[] = 'mkdf-' . $params['skin'];
        $holderClasses[] = !empty($params['transparent_background']) ? 'mkdf-transparent-background' : '';

        return implode(' ', $holderClasses);
    }

    private function getButtonParams($params) {
        $buttonParams = array();

        $buttonParams['link'] = $params['link'];
        $buttonParams['target'] = $params['link_target'];
        $buttonParams['text'] = $params['link_text'];
        $buttonParams['type'] = 'simple';

        return $buttonParams;
    }
}