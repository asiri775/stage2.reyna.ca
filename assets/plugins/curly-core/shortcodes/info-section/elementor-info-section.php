<?php
class CurlyCoreElementorInfoSection extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_info_section'; 
	}

	public function get_title() {
		return esc_html__( 'Info Section', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-info-section';
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
			'background_text',
			[
				'label'     => esc_html__( 'Background Text', 'curly-core' ),
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
				'default' => '_blank',
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

		$this->add_control(
			'link_type',
			[
				'label'     => esc_html__( 'Link Type', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'simple' => esc_html__( 'Simple', 'curly-core'), 
					'outline' => esc_html__( 'Outline', 'curly-core')
				),
				'default' => 'simple',
				'condition' => [
					'link!' => ''
				]
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

		$this->add_control(
			'content_width',
			[
				'label'     => esc_html__( 'Content Width (%)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value in percents', 'curly-core' )
			]
		);

		$this->add_control(
			'link_top_offset',
			[
				'label'     => esc_html__( 'Link Top Offset (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value in pixels or percents', 'curly-core' )
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
			'background_text_font_size',
			[
				'label'     => esc_html__( 'Background Text Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value in pixels', 'curly-core' ),
				'condition' => [
					'background_text!' => ''
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
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core')
				),
				'default' => 'h5',
				'condition' => [
					'subtitle!' => ''
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
				'default' => 'h3',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'text_tag',
			[
				'label'     => esc_html__( 'Text Tag', 'curly-core' ),
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
				'default' => 'p',
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'responsive_options',
			[
				'label' => esc_html__( 'Responsive Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'background_text_font_size_responsive',
			[
				'label'     => esc_html__( 'Background Text Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Between 1366px and 1025px', 'curly-core' ),
				'condition' => [
					'background_text!' => ''
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
        $params['content_styles'] = $this->getContentStyles($params);
        $params['subtitle_tag'] = !empty($params['subtitle_tag']) ? $params['subtitle_tag'] : 'h5';
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h3';
        $params['text_tag'] = !empty($params['text_tag']) ? $params['text_tag'] : 'p';
        $params['button_params'] = $this->getButtonParams($params);
        $params['link_styles'] = $this->getLinkStyles($params);
        $params['data_atts'] = $this->getDataAtts($params);

		echo curly_core_get_shortcode_module_template_part('templates/info-section', 'info-section', '', $params);

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
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorInfoSection() );