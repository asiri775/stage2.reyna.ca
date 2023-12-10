<?php
namespace CurlyCore\CPT\Shortcodes\Team;

use CurlyCore\lib;

class Team implements lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'mkdf_team';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        $team_social_icons_array = array();

        for ($x = 1; $x < 6; $x++) {
            $teamIconCollections = curly_mkdf_icon_collections()->getCollectionsWithSocialIcons();
            foreach ($teamIconCollections as $collection_key => $collection) {

                $team_social_icons_array[] = array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Social Icon ', 'curly-core') . $x,
                    'param_name' => 'team_social_' . $collection->param . '_' . $x,
                    'value' => $collection->getSocialIconsArrayVC(),
                    'dependency' => Array('element' => 'team_social_icon_pack', 'value' => array($collection_key)),
                    'group' => esc_html__('Social Options', 'curly-core')
                );
            }

            $team_social_icons_array[] = array(
                'type' => 'textfield',
                'heading' => esc_html__('Social Icon ', 'curly-core') . $x . esc_html__(' Link', 'curly-core'),
                'param_name' => 'team_social_icon_' . $x . '_link',
                'dependency' => array(
                    'element' => 'team_social_icon_pack',
                    'value' => curly_mkdf_icon_collections()->getIconCollectionsKeys()
                ),
                'group' => esc_html__('Social Options', 'curly-core')
            );

            $team_social_icons_array[] = array(
                'type' => 'dropdown',
                'heading' => esc_html__('Social Icon ', 'curly-core') . $x . esc_html__(' Target', 'curly-core'),
                'param_name' => 'team_social_icon_' . $x . '_target',
                'value' => array(
                    esc_html__('Same Window', 'curly-core') => '_self',
                    esc_html__('New Window', 'curly-core') => '_blank'
                ),
                'dependency' => Array('element' => 'team_social_icon_' . $x . '_link', 'not_empty' => true),
                'group' => esc_html__('Social Options', 'curly-core')
            );
        }

        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Team', 'curly-core'),
                    'base' => $this->base,
                    'category' => esc_html__('by CURLY', 'curly-core'),
                    'icon' => 'icon-wpb-team extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params' => array_merge(
                        array(
                            array(
                                'type' => 'textfield',
                                'param_name' => 'custom_class',
                                'heading' => esc_html__('Custom CSS Class', 'curly-core'),
                                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-core')
                            ),
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'enable_image_shadow',
                                'heading' => esc_html__('Enable Image Shadow', 'curly-core'),
                                'value' => array_flip(curly_mkdf_get_yes_no_select_array(false)),
                                'save_always' => true,
                                'group' => esc_html__('Styling Options', 'curly-core')
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
                                'type' => 'attach_image',
                                'param_name' => 'team_image',
                                'heading' => esc_html__('Image', 'curly-core')
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'team_name',
                                'heading' => esc_html__('Name', 'curly-core')
                            ),
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'team_name_tag',
                                'heading' => esc_html__('Name Tag', 'curly-core'),
                                'value' => array_flip(curly_mkdf_get_title_tag(true)),
                                'save_always' => true,
                                'dependency' => array('element' => 'team_name', 'not_empty' => true),
                                'group' => esc_html__('Styling Options', 'curly-core')
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'team_position',
                                'heading' => esc_html__('Position', 'curly-core')
                            ),
                            array(
                                'type' => 'textfield',
                                'param_name' => 'team_text',
                                'heading' => esc_html__('Text', 'curly-core')
                            ),
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'team_social_icon_pack',
                                'heading' => esc_html__('Social Icon Pack', 'curly-core'),
                                'value' => array_merge(array('' => ''), curly_mkdf_icon_collections()->getIconCollectionsVCExclude('linea_icons')),
                                'save_always' => true
                            ),
                        ),
                        $team_social_icons_array
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'skin' => 'dark',
            'enable_image_shadow' => 'no',
            'team_image' => '',
            'team_name' => '',
            'team_name_tag' => 'h4',
            'team_position' => '',
            'team_text' => '',
            'team_social_icon_pack' => ''
        );

        $team_social_icons_form_fields = array();
        $number_of_social_icons = 5;

        for ($x = 1; $x <= $number_of_social_icons; $x++) {
            foreach (curly_mkdf_icon_collections()->iconCollections as $collection_key => $collection) {
                $team_social_icons_form_fields['team_social_' . $collection->param . '_' . $x] = '';
            }

            $team_social_icons_form_fields['team_social_icon_' . $x . '_link'] = '';
            $team_social_icons_form_fields['team_social_icon_' . $x . '_target'] = '';
        }

        $args = array_merge($args, $team_social_icons_form_fields);
        $params = shortcode_atts($args, $atts);

        $params['number_of_social_icons'] = 5;
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['team_name_tag'] = !empty($params['team_name_tag']) ? $params['team_name_tag'] : $args['team_name_tag'];
        $params['team_social_icons'] = $this->getTeamSocialIcons($params);

        //Get HTML from template based on type of team
        $html = curly_core_get_shortcode_module_template_part('templates/team', 'team', '', $params);

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';

        return implode(' ', $holderClasses);
    }

    private function getTeamSocialIcons($params) {
        extract($params);
        $social_icons = array();

        if ($team_social_icon_pack !== '') {

            $icon_pack = curly_mkdf_icon_collections()->getIconCollection($team_social_icon_pack);
            $team_social_icon_type_label = 'team_social_' . $icon_pack->param;
            $team_social_icon_param_label = $icon_pack->param;

            for ($i = 1; $i <= $params['number_of_social_icons']; $i++) {
                $team_social_icon = ${$team_social_icon_type_label . '_' . $i};
                $team_social_link = ${'team_social_icon_' . $i . '_link'};
                $team_social_target = ${'team_social_icon_' . $i . '_target'};

                if ($team_social_icon !== '') {
                    $team_icon_params = array();
                    $team_icon_params['icon_pack'] = $team_social_icon_pack;
                    $team_icon_params[$team_social_icon_param_label] = $team_social_icon;
                    $team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
                    $team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';

                    $social_icons[] = curly_mkdf_execute_shortcode('mkdf_icon', $team_icon_params);
                }
            }
        }

        return $social_icons;
    }
}