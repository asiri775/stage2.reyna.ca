<?php
class CurlyBusinessElementorBookedCalendar extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_booked_calendar'; 
	}

	public function get_title() {
		return esc_html__( 'Booked Calendar', 'curly-business' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-booked-calendar';
	}

	public function get_categories() {
		return [ 'mikado' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_class',
			[
				'label'     => esc_html__( 'Custom CSS Class', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-business' )
			]
		);

		$this->add_control(
			'calendar',
			[
				'label'     => esc_html__( 'Calendar', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => curly_business_get_booked_calendar_array(),
				'default' => ''
			]
		);

		$this->add_control(
			'calendar_size',
			[
				'label'     => esc_html__( 'Calendar Size', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'large' => esc_html__( 'Large', 'curly-business'), 
					'small' => esc_html__( 'Small', 'curly-business')
				),
				'default' => 'large'
			]
		);

		$this->add_control(
			'calendar_style',
			[
				'label'     => esc_html__( 'Calendar Style', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'calendar' => esc_html__( 'Calendar', 'curly-business'), 
					'list' => esc_html__( 'List', 'curly-business')
				),
				'default' => 'calendar'
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-business'), 
					'h1' => esc_html__( 'h1', 'curly-business'), 
					'h2' => esc_html__( 'h2', 'curly-business'), 
					'h3' => esc_html__( 'h3', 'curly-business'), 
					'h4' => esc_html__( 'h4', 'curly-business'), 
					'h5' => esc_html__( 'h5', 'curly-business'), 
					'h6' => esc_html__( 'h6', 'curly-business'), 
					'var' => esc_html__( 'Theme Defined Heading', 'curly-business'), 
					'p' => esc_html__( 'p', 'curly-business')
				),
				'default' => 'h6',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_font_weight',
			[
				'label'     => esc_html__( 'Title Font Weight', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-business'), 
					'100' => esc_html__( '100 Thin', 'curly-business'), 
					'200' => esc_html__( '200 Thin-Light', 'curly-business'), 
					'300' => esc_html__( '300 Light', 'curly-business'), 
					'400' => esc_html__( '400 Normal', 'curly-business'), 
					'500' => esc_html__( '500 Medium', 'curly-business'), 
					'600' => esc_html__( '600 Semi-Bold', 'curly-business'), 
					'700' => esc_html__( '700 Bold', 'curly-business'), 
					'800' => esc_html__( '800 Extra-Bold', 'curly-business'), 
					'900' => esc_html__( '900 Ultra-Bold', 'curly-business')
				),
				'default' => '',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_bottom_margin',
			[
				'label'     => esc_html__( 'Title Bottom Margin (px)', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'skin',
			[
				'label'     => esc_html__( 'Skin', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-business'), 
					'light' => esc_html__( 'Light', 'curly-business'), 
					'dark' => esc_html__( 'Dark', 'curly-business')
				),
				'default' => ''
			]
		);

		curly_core_generate_elementor_templates_control( $this );

		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h6';
        $params['title_styles'] = $this->getTitleStyles($params);
		$params['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($params['template_id']);
        $params['calendar_attrs'] = $this->getCalendarAttributes($params);

        echo curly_business_get_template_part('modules/shortcodes/booked-calendar/templates/booked-calendar-template', '', $params, true);
	}

    private function getHolderClasses($params) {
        $classes = array();

        $classes[] = 'mkdf-booked-calendar';
        $classes[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $classes[] = !empty($params['skin']) ? 'mkdf-booked-' . $params['skin'] : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($classes));
    }

    private function getTitleStyles($params) {
        $styles = array();

        $styles[] = !empty($params['title_color']) ? 'color: ' . $params['title_color'] : '';
        $styles[] = !empty($params['title_font_weight']) ? 'font-weight: ' . $params['title_font_weight'] : '';
        $styles[] = !empty($params['title_bottom_margin']) ? 'margin-bottom: ' . curly_mkdf_filter_px($params['title_bottom_margin']) . 'px' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(';', array_filter($styles));
    }

    private function getCalendarAttributes($params) {
        $attrs = array();

        $attrs[] = !empty($params['calendar']) ? 'calendar="' . esc_attr($params['calendar']) . '"' : '';
        $attrs[] = !empty($params['calendar_size']) ? 'size="' . esc_attr($params['calendar_size']) . '"' : '';
        $attrs[] = !empty($params['calendar_style']) ? 'style="' . esc_attr($params['calendar_style']) . '"' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($attrs));
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyBusinessElementorBookedCalendar() );