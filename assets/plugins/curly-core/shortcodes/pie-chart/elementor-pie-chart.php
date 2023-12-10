<?php
class CurlyCoreElementorPieChart extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_pie_chart'; 
	}

	public function get_title() {
		return esc_html__( 'Pie Chart', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-pie-chart';
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
			'percent',
			[
				'label'     => esc_html__( 'Percentage', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'percent_color',
			[
				'label'     => esc_html__( 'Percentage Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'percent!' => ''
				]
			]
		);

		$this->add_control(
			'active_color',
			[
				'label'     => esc_html__( 'Pie Chart Active Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'inactive_color',
			[
				'label'     => esc_html__( 'Pie Chart Inactive Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'size',
			[
				'label'     => esc_html__( 'Pie Chart Size (px)', 'curly-core' ),
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
				'default' => 'h4',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				]
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
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text!' => ''
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['pie_chart_data'] = $this->getPieChartData($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h4';
        $params['percent_styles'] = $this->getPercentStyles($params);
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['text_styles'] = $this->getTextStyles($params);

		echo curly_core_get_shortcode_module_template_part('templates/pie-chart', 'pie-chart', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';

        return implode(' ', $holderClasses);
    }

    private function getPieChartData($params) {
        $data = array();

        if (!empty($params['percent'])) {
            $data['data-percent'] = $params['percent'];
        }
        if (!empty($params['size'])) {
            $data['data-size'] = $params['size'];
        }
        if (!empty($params['active_color'])) {
            $data['data-bar-color'] = $params['active_color'];
        }
        if (!empty($params['inactive_color'])) {
            $data['data-track-color'] = $params['inactive_color'];
        }

        return $data;
    }

    private function getPercentStyles($params) {
        $styles = array();

        if (!empty($params['percent_color'])) {
            $styles[] = 'color: ' . $params['percent_color'];
        }

        return implode(';', $styles);
    }

    private function getTitleStyles($params) {
        $styles = array();

        if (!empty($params['title_color'])) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        return implode(';', $styles);
    }

    private function getTextStyles($params) {
        $styles = array();

        if (!empty($params['text_color'])) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        return implode(';', $styles);
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorPieChart() );