<?php
class CurlyCoreElementorTeam extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_team'; 
	}

	public function get_title() {
		return esc_html__( 'Team', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-team';
	}

	public function get_categories() {
		return [ 'mikado' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_class',
			[
				'label'     => esc_html__( 'Custom CSS Class', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-core' )
			]
		);

		$this->add_control(
			'team_image',
			[
				'label'     => esc_html__( 'Image', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'team_name',
			[
				'label'     => esc_html__( 'Name', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'team_position',
			[
				'label'     => esc_html__( 'Position', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'team_text',
			[
				'label'     => esc_html__( 'Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styling_options',
			[
				'label' => esc_html__( 'Styling Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_image_shadow',
			[
				'label'     => esc_html__( 'Enable Image Shadow', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'skin',
			[
				'label'     => esc_html__( 'Skin', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'light' => esc_html__( 'Light', 'curly-core'), 
					'dark' => esc_html__( 'Dark', 'curly-core')
				),
				'default' => 'dark'
			]
		);

		$this->add_control(
			'team_name_tag',
			[
				'label'     => esc_html__( 'Name Tag', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'h1' => esc_html__( 'h1', 'curly-core'), 
					'h2' => esc_html__( 'h2', 'curly-core'), 
					'h3' => esc_html__( 'h3', 'curly-core'), 
					'h4' => esc_html__( 'h4', 'curly-core'), 
					'h5' => esc_html__( 'h5', 'curly-core'), 
					'h6' => esc_html__( 'h6', 'curly-core'), 
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core')
				),
				'default' => 'h4',
				'condition' => [
					'team_name!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_options',
			[
				'label' => esc_html__( 'Social Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

		curly_mkdf_icon_collections()->getElementorParamsArray( $repeater, '', '' );

		$repeater->add_control(
			'team_social_icon_link',
			[
				'label' => esc_html__( 'Social Icon Link', 'dor-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'team_social_icon_target',
			[
				'label'   => esc_html__( 'Social Icon Target', 'dor-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => curly_mkdf_get_link_target_array()
			]
		);

		$this->add_control(
			'social_icon',
			[
				'label'       => esc_html__( 'Social Icons', 'dor-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Social Icon' ),
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

		$params['team_image'] = !empty($params['team_image']['id']) ? $params['team_image']['id'] : '';
		$params['number_of_social_icons'] = 5;
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['team_name_tag'] = !empty($params['team_name_tag']) ? $params['team_name_tag'] : 'h4';
        $params['team_social_icons'] = $this->getTeamSocialIcons($params);

        //Get HTML from template based on type of team
		echo curly_core_get_shortcode_module_template_part('templates/team', 'team', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';

        return implode(' ', $holderClasses);
    }

    private function getTeamSocialIcons($params) {
		$team_social_icons = array();

		if ( $params['social_icon'] !== '' ) {

			foreach ( $params['social_icon'] as $icon ) {

				$iconPackName = curly_mkdf_icon_collections()->getIconCollectionParamNameByKey( $icon['icon_pack'] );

				$team_icon_params                  = array();
				$team_icon_params['icon_pack']     = $icon['icon_pack'];
				$team_icon_params[ $iconPackName ] = $icon[ $iconPackName ];
				$team_icon_params['link']          = $icon['team_social_icon_link'];
				$team_icon_params['target']        = $icon['team_social_icon_target'];

				$team_social_icons[] = curly_mkdf_execute_shortcode( 'mkdf_icon', $team_icon_params );
			}
		}

		return $team_social_icons;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorTeam() );