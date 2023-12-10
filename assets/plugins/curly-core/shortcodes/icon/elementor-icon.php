<?php
class CurlyCoreElementorIcon extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_icon'; 
	}

	public function get_title() {
		return esc_html__( 'Icon', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-icon';
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

		curly_mkdf_icon_collections()->getElementorParamsArray( $this, '', '' );
		$this->add_control(
			'size',
			[
				'label'     => esc_html__( 'Size', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'mkdf-icon-tiny' => esc_html__( 'Tiny', 'curly-core'), 
					'mkdf-icon-small' => esc_html__( 'Small', 'curly-core'), 
					'mkdf-icon-medium' => esc_html__( 'Medium', 'curly-core'), 
					'mkdf-icon-large' => esc_html__( 'Large', 'curly-core'), 
					'mkdf-icon-huge' => esc_html__( 'Huge', 'curly-core')
				),
				'default' => 'mkdf-icon-tiny'
			]
		);

		$this->add_control(
			'custom_size',
			[
				'label'     => esc_html__( 'Custom Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'type',
			[
				'label'     => esc_html__( 'Type', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'mkdf-normal' => esc_html__( 'Normal', 'curly-core'), 
					'mkdf-circle' => esc_html__( 'Circle', 'curly-core'), 
					'mkdf-square' => esc_html__( 'Square', 'curly-core')
				),
				'default' => 'mkdf-normal'
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert border radius(Rounded corners) in px. For example: 4 ', 'curly-core' ),
				'condition' => [
					'type' => array( 'mkdf-square' )
				]
			]
		);

		$this->add_control(
			'shape_size',
			[
				'label'     => esc_html__( 'Shape Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => array( 'mkdf-circle', 'mkdf-square' )
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => esc_html__( 'Border Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'mkdf-circle', 'mkdf-square' )
				]
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'     => esc_html__( 'Border Width', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => array( 'mkdf-circle', 'mkdf-square' )
				]
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'mkdf-circle', 'mkdf-square' )
				]
			]
		);

		$this->add_control(
			'hover_icon_color',
			[
				'label'     => esc_html__( 'Hover Icon Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'hover_border_color',
			[
				'label'     => esc_html__( 'Hover Border Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'mkdf-circle', 'mkdf-square' )
				]
			]
		);

		$this->add_control(
			'hover_background_color',
			[
				'label'     => esc_html__( 'Hover Background Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'mkdf-circle', 'mkdf-square' )
				]
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
			'icon_animation',
			[
				'label'     => esc_html__( 'Icon Animation', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'icon_animation_delay',
			[
				'label'     => esc_html__( 'Icon Animation Delay (ms)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'icon_animation' => array( 'yes' )
				]
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
			'anchor_icon',
			[
				'label'     => esc_html__( 'Use Link as Anchor', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Check this box to use icon as anchor link (eg. #contact)', 'curly-core' ),
				'condition' => [
					'link!' => ''
				]
			]
		);

		$this->add_control(
			'target',
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


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $iconPackName = curly_mkdf_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params['icon'] = $params[$iconPackName];
        $params['icon_holder_classes'] = $this->generateIconHolderClasses($params);
        $params['icon_holder_styles'] = $this->generateIconHolderStyles($params);
        $params['icon_holder_data'] = $this->generateIconHolderData($params);
        $params['icon_params'] = $this->generateIconParams($params);
        $params['icon_animation_holder'] = isset($params['icon_animation']) && $params['icon_animation'] == 'yes';
        $params['icon_animation_holder_styles'] = $this->generateIconAnimationHolderStyles($params);
        $params['link_class'] = $this->getLinkClass($params);
        $params['target'] = !empty($params['target']) ? $params['target'] : '_self';

		echo curly_core_get_shortcode_module_template_part('templates/icon', 'icon', '', $params);

	}

    private function generateIconHolderClasses($params) {
        $holderClasses = array('mkdf-icon-shortcode', $params['type']);

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = $params['icon_animation'] == 'yes' ? 'mkdf-icon-animation' : '';
        $holderClasses[] = !empty($params['size']) ? $params['size'] : '';

        return implode(' ', $holderClasses);
    }

    private function generateIconParams($params) {
        $iconParams = array('icon_attributes' => array());

        $iconParams['icon_attributes']['style'] = $this->generateIconStyles($params);
        $iconParams['icon_attributes']['class'] = 'mkdf-icon-element';

        return $iconParams;
    }

    private function generateIconStyles($params) {
        $iconStyles = array();

        if (!empty($params['icon_color'])) {
            $iconStyles[] = 'color: ' . $params['icon_color'];
        }

        if (($params['type'] !== 'mkdf-normal' && !empty($params['shape_size'])) || ($params['type'] == 'mkdf-normal')) {
            if (!empty($params['custom_size'])) {
                $iconStyles[] = 'font-size:' . curly_mkdf_filter_px($params['custom_size']) . 'px';
            }
        }

        return implode(';', $iconStyles);
    }

    private function generateIconHolderStyles($params) {
        $iconHolderStyles = array();

        if ($params['margin'] !== '') {
            $iconHolderStyles[] = 'margin: ' . $params['margin'];
        }

        if ($params['type'] !== 'mkdf-normal') {

            $shapeSize = '';
            if (!empty($params['shape_size'])) {
                $shapeSize = $params['shape_size'];
            } elseif (!empty($params['custom_size'])) {
                $shapeSize = $params['custom_size'];
            }

            if (!empty($shapeSize)) {
                $iconHolderStyles[] = 'width: ' . curly_mkdf_filter_px($shapeSize) . 'px';
                $iconHolderStyles[] = 'height: ' . curly_mkdf_filter_px($shapeSize) . 'px';
                $iconHolderStyles[] = 'line-height: ' . curly_mkdf_filter_px($shapeSize) . 'px';
            }

            if (!empty($params['background_color'])) {
                $iconHolderStyles[] = 'background-color: ' . $params['background_color'];
            }

            if (!empty($params['border_color']) && (isset($params['border_width']) && $params['border_width'] !== '')) {
                $iconHolderStyles[] = 'border-style: solid';
                $iconHolderStyles[] = 'border-color: ' . $params['border_color'];
                $iconHolderStyles[] = 'border-width: ' . curly_mkdf_filter_px($params['border_width']) . 'px';
            } else if (isset($params['border_width']) && $params['border_width'] !== '') {
                $iconHolderStyles[] = 'border-style: solid';
                $iconHolderStyles[] = 'border-width: ' . curly_mkdf_filter_px($params['border_width']) . 'px';
            } else if (!empty($params['border_color'])) {
                $iconHolderStyles[] = 'border-color: ' . $params['border_color'];
            }

            if ($params['type'] == 'mkdf-square') {
                if (isset($params['border_radius']) && $params['border_radius'] !== '') {
                    $iconHolderStyles[] = 'border-radius: ' . curly_mkdf_filter_px($params['border_radius']) . 'px';
                }
            }
        }

        return $iconHolderStyles;
    }

    private function generateIconHolderData($params) {
        $iconHolderData = array();

        if (isset($params['type']) && $params['type'] !== 'mkdf-normal') {
            if (!empty($params['hover_border_color'])) {
                $iconHolderData['data-hover-border-color'] = $params['hover_border_color'];
            }

            if (!empty($params['hover_background_color'])) {
                $iconHolderData['data-hover-background-color'] = $params['hover_background_color'];
            }
        }

        if ((isset($params['icon_animation']) && $params['icon_animation'] == 'yes')
            && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')
        ) {
            $iconHolderData['data-animation-delay'] = $params['icon_animation_delay'];
        }

        if (!empty($params['hover_icon_color'])) {
            $iconHolderData['data-hover-color'] = $params['hover_icon_color'];
        }

        if (!empty($params['icon_color'])) {
            $iconHolderData['data-color'] = $params['icon_color'];
        }

        return $iconHolderData;
    }

    private function generateIconAnimationHolderStyles($params) {
        $styles = array();

        if ((isset($params['icon_animation']) && $params['icon_animation'] == 'yes') && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')) {
            $styles[] = '-webkit-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
            $styles[] = '-moz-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
            $styles[] = 'transition-delay: ' . $params['icon_animation_delay'] . 'ms';
        }

        return $styles;
    }

    private function getLinkClass($params) {
        $class = '';

        if ($params['anchor_icon'] != '' && $params['anchor_icon'] == 'yes') {
            $class .= 'mkdf-anchor';
        }

        return $class;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorIcon() );