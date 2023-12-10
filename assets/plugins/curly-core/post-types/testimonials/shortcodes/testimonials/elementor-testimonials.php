<?php
class CurlyCoreElementorTestimonials extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_testimonials'; 
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-testimonials';
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
			'background_text',
			[
				'label'     => esc_html__( 'Background Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'number',
			[
				'label'     => esc_html__( 'Number of Testimonials', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'category',
			[
				'label'     => esc_html__( 'Category', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'curly-core' )
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
			'skin',
			[
				'label'     => esc_html__( 'Skin', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'light' => esc_html__( 'Light', 'curly-core'), 
					'dark' => esc_html__( 'Dark', 'curly-core')
				),
				'default' => 'light'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'label'     => esc_html__( 'Enable Slider Loop', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'     => esc_html__( 'Enable Slider Autoplay', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'     => esc_html__( 'Slide Duration', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default value is 5000 (ms)', 'curly-core' )
			]
		);

		$this->add_control(
			'slider_speed_animation',
			[
				'label'     => esc_html__( 'Slide Animation Duration', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'curly-core' )
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label'     => esc_html__( 'Enable Slider Navigation Arrows', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'slider_pagination',
			[
				'label'     => esc_html__( 'Enable Slider Pagination', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
        $params['background_text_tag'] = !empty($params['background_text_tag']) ? $params['background_text_tag'] : 'var';
        $params['background_text_styles'] = $this->getBackgroundTextStyles($params);
        $params['type'] = !empty($params['type']) ? $params['type'] : 'standard';
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['box_styles'] = $this->getBoxStyles($params);
        $params['data_attr'] = $this->getSliderData($params);

        $params['query_args'] = $this->getQueryParams($params);
        $params['query_results'] = new \WP_Query($params['query_args']);

        echo curly_core_get_cpt_shortcode_module_template_part('testimonials', 'testimonials', 'testimonials', '', $params);
	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        //$holderClasses[] = 'mkdf-testimonials-' . $params['type'];
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';

        return implode(' ', $holderClasses);
    }

    private function getQueryParams($params) {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'testimonials',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $params['number']
        );

        if ($params['category'] != '') {
            $args['testimonials-category'] = $params['category'];
        }

        return $args;
    }

    public function getBoxStyles($params) {
        $styles = array();

        if ($params['type'] === 'boxed' && !empty($params['box_color'])) {
            $styles[] = 'background-color: ' . $params['box_color'];
        }

        return $styles;
    }

    private function getSliderData($params) {
        $slider_data = array();

        $slider_data['data-number-of-items'] = !empty($params['number_of_visible_items']) && in_array($params['type'], array('boxed', 'boxed-text')) ? $params['number_of_visible_items'] : '1';
        $slider_data['data-enable-loop'] = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay'] = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed'] = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';
        $slider_data['data-slider-margin'] = in_array($params['type'], array('boxed', 'boxed-text')) ? 10 : '';
        $slider_data['data-slider-animate-in'] = 'fadeInLeft';
        $slider_data['data-slider-animate-out'] = 'fadeOutRight';

        return $slider_data;
    }

    private function getBackgroundTextStyles($params) {
        $textStyles = array();

        $textStyles[] = 'font-size:' . $params['background_text_font_size'] . 'px';

        return implode(';', $textStyles);
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorTestimonials() );