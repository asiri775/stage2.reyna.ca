<?php
class CurlyCoreElementorButton extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_button'; 
	}

	public function get_title() {
		return esc_html__( 'Button', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-button';
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
					'solid' => esc_html__( 'Solid', 'curly-core'), 
					'outline' => esc_html__( 'Outline', 'curly-core'), 
					'simple' => esc_html__( 'Simple', 'curly-core')
				),
				'default' => 'solid'
			]
		);

		$this->add_control(
			'size',
			[
				'label'     => esc_html__( 'Size', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'small' => esc_html__( 'Small', 'curly-core'), 
					'medium' => esc_html__( 'Medium', 'curly-core'), 
					'large' => esc_html__( 'Large', 'curly-core'), 
					'huge' => esc_html__( 'Huge', 'curly-core')
				),
				'default' => '',
				'condition' => [
					'type' => array( 'solid', 'outline' )
				]
			]
		);

		$this->add_control(
			'size_2',
			[
				'label'     => esc_html__( 'Size', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'small' => esc_html__( 'Small', 'curly-core'), 
					'medium' => esc_html__( 'Medium', 'curly-core')
				),
				'default' => '',
				'condition' => [
					'type' => array( 'simple' )
				]
			]
		);

		$this->add_control(
			'text',
			[
				'label'     => esc_html__( 'Text', 'curly-core' ),
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
			'target',
			[
				'label'     => esc_html__( 'Link Target', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'_self' => esc_html__( 'Same Window', 'curly-core'), 
					'_blank' => esc_html__( 'New Window', 'curly-core')
				),
				'default' => '_self'
			]
		);

		curly_mkdf_icon_collections()->getElementorParamsArray( $this, '', '' );
		$this->add_control(
			'text_transform',
			[
				'label'     => esc_html__( 'Text Transform', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'none' => esc_html__( 'None', 'curly-core'), 
					'capitalize' => esc_html__( 'Capitalize', 'curly-core'), 
					'uppercase' => esc_html__( 'Uppercase', 'curly-core'), 
					'lowercase' => esc_html__( 'Lowercase', 'curly-core'), 
					'initial' => esc_html__( 'Initial', 'curly-core'), 
					'inherit' => esc_html__( 'Inherit', 'curly-core')
				),
				'default' => ''
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'design_options',
			[
				'label' => esc_html__( 'Design Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'color',
			[
				'label'     => esc_html__( 'Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid' )
				]
			]
		);

		$this->add_control(
			'hover_background_color',
			[
				'label'     => esc_html__( 'Hover Background Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				]
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => esc_html__( 'Border Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				]
			]
		);

		$this->add_control(
			'hover_border_color',
			[
				'label'     => esc_html__( 'Hover Border Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				]
			]
		);

		$this->add_control(
			'font_size',
			[
				'label'     => esc_html__( 'Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'font_weight',
			[
				'label'     => esc_html__( 'Font Weight', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'100' => esc_html__( '100 Thin', 'curly-core'), 
					'200' => esc_html__( '200 Thin-Light', 'curly-core'), 
					'300' => esc_html__( '300 Light', 'curly-core'), 
					'400' => esc_html__( '400 Normal', 'curly-core'), 
					'500' => esc_html__( '500 Medium', 'curly-core'), 
					'600' => esc_html__( '600 Semi-Bold', 'curly-core'), 
					'700' => esc_html__( '700 Bold', 'curly-core'), 
					'800' => esc_html__( '800 Extra-Bold', 'curly-core'), 
					'900' => esc_html__( '900 Ultra-Bold', 'curly-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'margin',
			[
				'label'     => esc_html__( 'Margin', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'curly-core' )
			]
		);

		$this->add_control(
			'padding',
			[
				'label'     => esc_html__( 'Button Padding', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'curly-core' ),
				'condition' => [
					'type' => array( 'solid', 'outline' )
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

		if ( ! isset($params['html_type']) ) {
			$params['html_type'] = 'anchor';
		}
        if ($params['html_type'] !== 'input') {
            $iconPackName = curly_mkdf_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
            $params['icon'] = $iconPackName ? $params[$iconPackName] : '';
        }

        $params['type'] = !empty($params['type']) ? $params['type'] : 'solid';
        if ($params['type'] === 'simple') {
            $params['size'] = $params['size_2'];
        }
        $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';

        $params['link'] = !empty($params['link']) ? $params['link'] : '#';
        $params['target'] = !empty($params['target']) ? $params['target'] : '_self';

        $params['button_classes'] = $this->getButtonClasses($params);
        $params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : 
        $params['button_styles'] = $this->getButtonStyles($params);
        $params['button_data'] = $this->getButtonDataAttr($params);

        echo curly_core_get_shortcode_module_template_part('templates/' . $params['html_type'], 'button', '', $params);
	}

    private function getButtonStyles($params) {
        $styles = array();

        if (!empty($params['color'])) {
            $styles[] = 'color: ' . $params['color'];
        }

        if (!empty($params['background_color']) && $params['type'] !== 'outline') {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        if (!empty($params['border_color'])) {
            $styles[] = 'border-color: ' . $params['border_color'];
        }

        if (!empty($params['font_size'])) {
            $styles[] = 'font-size: ' . curly_mkdf_filter_px($params['font_size']) . 'px';
        }

        if (!empty($params['font_weight']) && $params['font_weight'] !== '') {
            $styles[] = 'font-weight: ' . $params['font_weight'];
        }

        if (!empty($params['text_transform'])) {
            $styles[] = 'text-transform: ' . $params['text_transform'];
        }

        if ($params['margin'] !== '') {
            $styles[] = 'margin: ' . $params['margin'];
        }

        if ($params['padding'] !== '') {
            $styles[] = 'padding: ' . $params['padding'];
        }

        return $styles;
    }

    private function getButtonDataAttr($params) {
        $data = array();

        if (!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if (!empty($params['hover_background_color'])) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if (!empty($params['hover_border_color'])) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        return $data;
    }

    private function getButtonClasses($params) {
        $buttonClasses = array(
            'mkdf-btn',
            'mkdf-btn-' . $params['size'],
            'mkdf-btn-' . $params['type']
        );

        if (!empty($params['hover_background_color'])) {
            $buttonClasses[] = 'mkdf-btn-custom-hover-bg';
        }

        if (!empty($params['hover_border_color'])) {
            $buttonClasses[] = 'mkdf-btn-custom-border-hover';
        }

        if (!empty($params['hover_color'])) {
            $buttonClasses[] = 'mkdf-btn-custom-hover-color';
        }

        if (!empty($params['icon'])) {
            $buttonClasses[] = 'mkdf-btn-icon';
        }

        if (!empty($params['custom_class'])) {
            $buttonClasses[] = esc_attr($params['custom_class']);
        }

        return $buttonClasses;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorButton() );
