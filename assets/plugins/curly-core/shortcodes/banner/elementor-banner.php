<?php
class CurlyCoreElementorBanner extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_banner'; 
	}

	public function get_title() {
		return esc_html__( 'Banner', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-banner';
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
			'tagline',
			[
				'label'     => esc_html__( 'Tagline', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'     => esc_html__( 'Subtitle', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'link',
			[
				'label'     => esc_html__( 'Link', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'     => esc_html__( 'Target', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'_self' => esc_html__( 'Same Window', 'curly-core'), 
					'_blank' => esc_html__( 'New Window', 'curly-core')
				),
				'default' => '_self',
				'condition' => [
					'link!' => ''
				]
			]
		);

		$this->add_control(
			'link_text',
			[
				'label'     => esc_html__( 'Link Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'link!' => ''
				]
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
			'tagline_tag',
			[
				'label'     => esc_html__( 'Tagline Tag', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'h1' => esc_html__( 'h1', 'curly-core'), 
					'h2' => esc_html__( 'h2', 'curly-core'), 
					'h3' => esc_html__( 'h3', 'curly-core'), 
					'h4' => esc_html__( 'h4', 'curly-core'), 
					'h5' => esc_html__( 'h5', 'curly-core'), 
					'h6' => esc_html__( 'h6', 'curly-core'), 
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core'), 
					'p' => esc_html__( 'p', 'curly-core')
				),
				'default' => 'var',
				'condition' => [
					'tagline!' => ''
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'h1' => esc_html__( 'h1', 'curly-core'), 
					'h2' => esc_html__( 'h2', 'curly-core'), 
					'h3' => esc_html__( 'h3', 'curly-core'), 
					'h4' => esc_html__( 'h4', 'curly-core'), 
					'h5' => esc_html__( 'h5', 'curly-core'), 
					'h6' => esc_html__( 'h6', 'curly-core'), 
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core'), 
					'p' => esc_html__( 'p', 'curly-core')
				),
				'default' => 'h3',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'subtitle_tag',
			[
				'label'     => esc_html__( 'Subtitle Tag', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'h1' => esc_html__( 'h1', 'curly-core'), 
					'h2' => esc_html__( 'h2', 'curly-core'), 
					'h3' => esc_html__( 'h3', 'curly-core'), 
					'h4' => esc_html__( 'h4', 'curly-core'), 
					'h5' => esc_html__( 'h5', 'curly-core'), 
					'h6' => esc_html__( 'h6', 'curly-core'), 
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core'), 
					'p' => esc_html__( 'p', 'curly-core')
				),
				'default' => 'h5',
				'condition' => [
					'subtitle!' => ''
				]
			]
		);

		$this->add_control(
			'transparent_background',
			[
				'label'     => esc_html__( 'Transparent Background?', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_options',
			[
				'label' => esc_html__( 'Layout Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'hover_behavior',
			[
				'label'     => esc_html__( 'Hover Behavior', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'mkdf-visible-on-hover' => esc_html__( 'Visible on Hover', 'curly-core'), 
					'mkdf-visible-on-default' => esc_html__( 'Visible on Default', 'curly-core')
				),
				'default' => 'mkdf-visible-on-hover'
			]
		);

		$this->add_control(
			'content_align',
			[
				'label'     => esc_html__( 'Content Align', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'left' => esc_html__( 'Left', 'curly-core'), 
					'center' => esc_html__( 'Center', 'curly-core'), 
					'right' => esc_html__( 'Right', 'curly-core')
				),
				'default' => 'center'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['tagline_tag'] = !empty($params['tagline_tag']) ? $params['tagline_tag'] : 'var';
        $params['subtitle_tag'] = !empty($params['subtitle_tag']) ? $params['subtitle_tag'] : 'h5';
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h3';
        $params['button_params'] = $this->getButtonParams($params);

		echo curly_core_get_shortcode_module_template_part('templates/banner', 'banner', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['hover_behavior']) ? $params['hover_behavior'] : '';
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
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorBanner() );