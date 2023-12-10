<?php
class CurlyBusinessElementorBookedSlider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_booked_slider'; 
	}

	public function get_title() {
		return esc_html__( 'Booked Slider', 'curly-business' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-booked-slider';
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
				'options' => array(
					'' => esc_html__( 'Default', 'curly-business')
				),
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => esc_html__( 'Widget title', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'curly-business' )
			]
		);

		$repeater->add_control(
			'alias',
			[
				'label'     => esc_html__( 'Revolution Slider', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Select your Revolution Slider.', 'curly-business' ),
				'options' => array(
					'hair-salon' => esc_html__( 'Hair-Salon', 'curly-business'), 
					'hairstyle-home' => esc_html__( 'Hairstyle-Home', 'curly-business'), 
					'landing-bottom' => esc_html__( 'Landing-Bottom', 'curly-business'), 
					'landing-pages' => esc_html__( 'Landing-Pages', 'curly-business'), 
					'landing-top' => esc_html__( 'Landing-Top', 'curly-business'), 
					'main-home' => esc_html__( 'Main-Home', 'curly-business'), 
					'vertical-showcase' => esc_html__( 'Vertical-Showcase', 'curly-business')
				),
				'default' => 'hair-salon'
			]
		);

		$repeater->add_control(
			'el_class',
			[
				'label'     => esc_html__( 'Extra class name', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'curly-business' )
			]
		);

		$repeater->add_control(
			'enable_paspartu',
			[
				'label'     => esc_html__( 'Mikado Enable Passepartout', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-business'), 
					'yes' => esc_html__( 'Yes', 'curly-business')
				),
				'default' => 'no'
			]
		);

		$repeater->add_control(
			'paspartu_size',
			[
				'label'     => esc_html__( 'Mikado Passepartout Size', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'tiny' => esc_html__( 'Tiny', 'curly-business'), 
					'small' => esc_html__( 'Small', 'curly-business'), 
					'normal' => esc_html__( 'Normal', 'curly-business'), 
					'large' => esc_html__( 'Large', 'curly-business')
				),
				'default' => 'tiny',
				'condition' => [
					'enable_paspartu' => array( 'yes' )
				]
			]
		);

		$repeater->add_control(
			'disable_side_paspartu',
			[
				'label'     => esc_html__( 'Mikado Disable Side Passepartout', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-business'), 
					'yes' => esc_html__( 'Yes', 'curly-business')
				),
				'default' => 'no',
				'condition' => [
					'enable_paspartu' => array( 'yes' )
				]
			]
		);

		$repeater->add_control(
			'disable_top_paspartu',
			[
				'label'     => esc_html__( 'Mikado Disable Top Passepartout', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-business'), 
					'yes' => esc_html__( 'Yes', 'curly-business')
				),
				'default' => 'no',
				'condition' => [
					'enable_paspartu' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'rev_slider_vc',
			[
				'label'     => esc_html__( 'Revolution Slider', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields'     => $repeater->get_controls(),
				'title_field'     => esc_html__( 'Item', 'curly-business' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'calendar_position',
			[
				'label' => esc_html__( 'Calendar Position', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'calendar_position',
			[
				'label'     => esc_html__( 'Calendar Position', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'left' => esc_html__( 'Left', 'curly-business'), 
					'right' => esc_html__( 'Right', 'curly-business'), 
					'center' => esc_html__( 'Center', 'curly-business')
				),
				'default' => 'right'
			]
		);

		$this->add_control(
			'calendar_width',
			[
				'label'     => esc_html__( 'Calendar Width (px or %)', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'top_offset',
			[
				'label'     => esc_html__( 'Calendar Top Offset (px or %)', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'side_offset',
			[
				'label'     => esc_html__( 'Calendar Side Offset (px or %)', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'calendar_is_middle',
			[
				'label'     => esc_html__( 'Set Calendar Vertical Align Middle', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-business'), 
					'yes' => esc_html__( 'Yes', 'curly-business')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'calendar_in_grid',
			[
				'label'     => esc_html__( 'Set Calendar In Grid', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-business'), 
					'no' => esc_html__( 'No', 'curly-business')
				),
				'default' => 'yes'
			]
		);

		curly_core_generate_elementor_templates_control( $this );

		$this->end_controls_section();

		$this->start_controls_section(
			'laptop',
			[
				'label' => esc_html__( 'Laptop', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'width_laptop',
			[
				'label'     => esc_html__( 'Set calendar width for laptop screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'top_offset_laptop',
			[
				'label'     => esc_html__( 'Set calendar top offset for laptop screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'side_offset_laptop',
			[
				'label'     => esc_html__( 'Set calendar side offset for laptop screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tablet_landscape',
			[
				'label' => esc_html__( 'Tablet Landscape', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'width_ipad_landscape',
			[
				'label'     => esc_html__( 'Set calendar width for tablet landscape screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'top_offset_ipad_landscape',
			[
				'label'     => esc_html__( 'Set calendar top offset for tablet landscape screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'side_offset_ipad_landscape',
			[
				'label'     => esc_html__( 'Set calendar side offset for tablet landscape screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tablet_portrait',
			[
				'label' => esc_html__( 'Tablet Portrait', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'width_ipad',
			[
				'label'     => esc_html__( 'Set calendar width for tablet portrait screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'top_offset_ipad',
			[
				'label'     => esc_html__( 'Set calendar top offset for tablet portrait screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'side_offset_ipad',
			[
				'label'     => esc_html__( 'Set calendar side offset for tablet portrait screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mobile',
			[
				'label' => esc_html__( 'Mobile', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'width_mobile',
			[
				'label'     => esc_html__( 'Set calendar width for mobile devices screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'top_offset_mobile',
			[
				'label'     => esc_html__( 'Set calendar top offset for mobile devices screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);

		$this->add_control(
			'side_offset_mobile',
			[
				'label'     => esc_html__( 'Set calendar top offset for mobile devices screen size and smaller', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Please insert value with px or %', 'curly-business' )
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h6';
        $params['title_styles'] = $this->getTitleStyles($params);
		$params['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($params['template_id']);
		$params['calendar_attrs'] = $this->getCalendarAttributes($params);
        $params['calendar_in_grid'] = $params['calendar_in_grid'] === 'yes' ? true : false;

        $params['calendar_styles'] = $this->getCalendarStyles($params);
        $params['calendar_responsive_data'] = '';
        $params['calendar_responsive_data'] = $this->getCalendarResponsiveData($params);

        echo curly_business_get_template_part('modules/shortcodes/booked-slider/templates/booked-slider-template', '', $params, true);
	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = 'mkdf-booked-slider';
        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-booked-' . $params['skin'] : '';
        $holderClasses[] = !empty($params['calendar_position']) ? 'mkdf-' . $params['calendar_position'] . '-position' : '';
        $holderClasses[] = $params['calendar_is_middle'] === 'yes' ? 'mkdf-bs-calendar-is-middle' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($holderClasses));
    }

    private function getCalendarAttributes($params) {
        $attrs = array();

        $attrs[] = !empty($params['calendar']) ? 'calendar="' . esc_attr($params['calendar']) . '"' : '';
        $attrs[] = !empty($params['calendar_size']) ? 'size="' . esc_attr($params['calendar_size']) . '"' : '';
        $attrs[] = !empty($params['calendar_style']) ? 'style="' . esc_attr($params['calendar_style']) . '"' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(' ', array_filter($attrs));
    }

    private function getTitleStyles($params) {
        $styles = array();

        $styles[] = !empty($params['title_color']) ? 'color: ' . $params['title_color'] : '';
        $styles[] = !empty($params['title_font_weight']) ? 'font-weight: ' . $params['title_font_weight'] : '';
        $styles[] = !empty($params['title_bottom_margin']) ? 'margin-bottom: ' . curly_mkdf_filter_px($params['title_bottom_margin']) . 'px' : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(';', array_filter($styles));
    }

    private function getCalendarStyles($params) {
        $styles = array();

        $styles[] = !empty($params['calendar_width'] !== '') ? 'width: ' . $params['calendar_width'] : '';


        if ($params['top_offset'] !== '' && $params['calendar_is_middle'] !== 'yes') {
            $styles[] = 'top: ' . $params['top_offset'];
        } else if ($params['top_offset'] !== '' && $params['calendar_is_middle'] === 'yes') {
            $styles[] = 'margin-top: ' . $params['top_offset'];
        }

        if ($params['side_offset'] !== '' && $params['calendar_position'] === 'left') {
            $styles[] = 'left: ' . $params['side_offset'];
        }

        if ($params['side_offset'] !== '' && $params['calendar_position'] === 'right') {
            $styles[] = 'right: ' . $params['side_offset'];
        }

        // @see http://php.net/manual/en/function.array-filter.php
        return implode(';', array_filter($styles));
    }

    private function getCalendarResponsiveData($params) {
        $data = array();

        if ($params['width_laptop'] !== '') {
            $data['data-width-laptop'] = $params['width_laptop'];
        }

        if ($params['top_offset_laptop'] !== '') {
            $data['data-top-offset-laptop'] = $params['top_offset_laptop'];
        }

        if ($params['side_offset_laptop'] !== '') {
            $data['data-side-offset-laptop'] = $params['side_offset_laptop'];
        }

        if ($params['width_ipad_landscape'] !== '') {
            $data['data-width-ipad-landscape'] = $params['width_ipad_landscape'];
        }

        if ($params['top_offset_ipad_landscape'] !== '') {
            $data['data-top-offset-ipad-landscape'] = $params['top_offset_ipad_landscape'];
        }

        if ($params['side_offset_ipad_landscape'] !== '') {
            $data['data-side-offset-ipad-landscape'] = $params['side_offset_ipad_landscape'];
        }

        if ($params['width_ipad'] !== '') {
            $data['data-width-ipad'] = $params['width_ipad'];
        }

        if ($params['top_offset_ipad'] !== '') {
            $data['data-top-offset-ipad'] = $params['top_offset_ipad'];
        }

        if ($params['side_offset_ipad'] !== '') {
            $data['data-side-offset-ipad'] = $params['side_offset_ipad'];
        }

        if ($params['width_mobile'] !== '') {
            $data['data-width-mobile'] = $params['width_mobile'];
        }

        if ($params['top_offset_mobile'] !== '') {
            $data['data-top-offset-mobile'] = $params['top_offset_mobile'];
        }

        if ($params['side_offset_mobile'] !== '') {
            $data['data-side-offset-mobile'] = $params['side_offset_mobile'];
        }

        return $data;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyBusinessElementorBookedSlider() );