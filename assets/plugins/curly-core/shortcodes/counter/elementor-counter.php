<?php
class CurlyCoreElementorCounter extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_counter'; 
	}

	public function get_title() {
		return esc_html__( 'Counter', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-counter';
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
			'type',
			[
				'label'     => esc_html__( 'Type', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'mkdf-zero-counter' => esc_html__( 'Zero Counter', 'curly-core'), 
					'mkdf-random-counter' => esc_html__( 'Random Counter', 'curly-core')
				),
				'default' => 'mkdf-zero-counter'
			]
		);

		$this->add_control(
			'background_text',
			[
				'label'     => esc_html__( 'Background Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'digit',
			[
				'label'     => esc_html__( 'Digit', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'digit_font_size',
			[
				'label'     => esc_html__( 'Digit Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'digit!' => ''
				]
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
			'text',
			[
				'label'     => esc_html__( 'Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA
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
			'background_text_tag',
			[
				'label'     => esc_html__( 'Background Text Tag', 'curly-core' ),
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
				'default' => 'var',
				'condition' => [
					'background_text!' => ''
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
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core')
				),
				'default' => 'h5',
				'condition' => [
					'title!' => ''
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['background_text_tag'] = !empty($params['background_text_tag']) ? $params['background_text_tag'] : 'var';
        $params['background_text_styles'] = $this->getBackgroundTextStyles($params);
        $params['counter_styles'] = $this->getCounterStyles($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h5';

		echo curly_core_get_shortcode_module_template_part('templates/counter', 'counter', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';

        return implode(' ', $holderClasses);
    }

    private function getCounterStyles($params) {
        $styles = array();

        if (!empty($params['digit_font_size'])) {
            $styles[] = 'font-size: ' . curly_mkdf_filter_px($params['digit_font_size']) . 'px';
        }

        return implode(';', $styles);
    }

    private function getBackgroundTextStyles($params) {
        $textStyles = array();

        $textStyles[] = !empty($params['background_text_font_size']) ? 'font-size:' . $params['background_text_font_size'] . 'px' : '';

        return implode(';', $textStyles);
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorCounter() );