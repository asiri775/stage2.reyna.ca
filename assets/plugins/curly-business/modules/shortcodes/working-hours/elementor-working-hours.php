<?php
class CurlyBusinessElementorWorkingHours extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_working_hours'; 
	}

	public function get_title() {
		return esc_html__( 'Working Hours', 'curly-business' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-working-hours';
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

		$this->end_controls_section();

		$this->start_controls_section(
			'styling_options',
			[
				'label' => esc_html__( 'Styling Options', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
			'label_tag',
			[
				'label'     => esc_html__( 'Label Tag', 'curly-business' ),
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
				'default' => 'h4'
			]
		);

		$this->add_control(
			'time_tag',
			[
				'label'     => esc_html__( 'Time Tag', 'curly-business' ),
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
				'default' => 'p'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h6';
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['working_hours'] = $this->getWorkingHours();

        echo curly_business_get_template_part('modules/shortcodes/working-hours/templates/working-hours-template', '', $params, true);
	}

    private function getWorkingHours() {
        $workingHours = array();

        if (curly_business_theme_installed()) {
            switch (curly_mkdf_options()->getOptionValue('working_hours_layout')):

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'workdays-weekend':
                    // working days
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_from') !== '') {
                        $workingHours['work_days']['label'] = __('Working Days', 'curly-business');
                        $workingHours['work_days']['from'] = curly_mkdf_options()->getOptionValue('wh_work_days_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_to') !== '') {
                        $workingHours['work_days']['to'] = curly_mkdf_options()->getOptionValue('wh_work_days_to');
                    }

                    // weekends
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_from') !== '') {
                        $workingHours['weekend']['label'] = __('Weekend', 'curly-business');
                        $workingHours['weekend']['from'] = curly_mkdf_options()->getOptionValue('wh_weekend_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_to') !== '') {
                        $workingHours['weekend']['to'] = curly_mkdf_options()->getOptionValue('wh_weekend_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'workdays-sat-sun':
                    // working days
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_from') !== '') {
                        $workingHours['work_days']['label'] = __('Working Days', 'curly-business');
                        $workingHours['work_days']['from'] = curly_mkdf_options()->getOptionValue('wh_work_days_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_work_days_to') !== '') {
                        $workingHours['work_days']['to'] = curly_mkdf_options()->getOptionValue('wh_work_days_to');
                    }

                    // saturday
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_from') !== '') {
                        $workingHours['saturday']['label'] = __('Saturday', 'curly-business');
                        $workingHours['saturday']['from'] = curly_mkdf_options()->getOptionValue('wh_saturday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_to') !== '') {
                        $workingHours['saturday']['to'] = curly_mkdf_options()->getOptionValue('wh_saturday_to');
                    }

                    // sunday
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_from') !== '') {
                        $workingHours['sunday']['label'] = __('Sunday', 'curly-business');
                        $workingHours['sunday']['from'] = curly_mkdf_options()->getOptionValue('wh_sunday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_to') !== '') {
                        $workingHours['sunday']['to'] = curly_mkdf_options()->getOptionValue('wh_sunday_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'same':
                    // same
                    if (curly_mkdf_options()->getOptionValue('wh_same_from') !== '') {
                        $workingHours['same']['label'] = __('Every Day', 'curly-business');
                        $workingHours['same']['from'] = curly_mkdf_options()->getOptionValue('wh_same_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_same_to') !== '') {
                        $workingHours['same']['to'] = curly_mkdf_options()->getOptionValue('wh_same_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                case'mon-tue-wed-thu-fri-weekend':
                    // monday
                    if (curly_mkdf_options()->getOptionValue('wh_monday_from') !== '') {
                        $workingHours['monday']['label'] = __('Monday', 'curly-business');
                        $workingHours['monday']['from'] = curly_mkdf_options()->getOptionValue('wh_monday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_monday_to') !== '') {
                        $workingHours['monday']['to'] = curly_mkdf_options()->getOptionValue('wh_monday_to');
                    }

                    // tuesday
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_from') !== '') {
                        $workingHours['tuesday']['label'] = __('Tuesday', 'curly-business');
                        $workingHours['tuesday']['from'] = curly_mkdf_options()->getOptionValue('wh_tuesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_to') !== '') {
                        $workingHours['tuesday']['to'] = curly_mkdf_options()->getOptionValue('wh_tuesday_to');
                    }

                    // wednesday
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_from') !== '') {
                        $workingHours['wednesday']['label'] = __('Wednesday', 'curly-business');
                        $workingHours['wednesday']['from'] = curly_mkdf_options()->getOptionValue('wh_wednesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_to') !== '') {
                        $workingHours['wednesday']['to'] = curly_mkdf_options()->getOptionValue('wh_wednesday_to');
                    }

                    // thursday
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_from') !== '') {
                        $workingHours['thursday']['label'] = __('Thursday', 'curly-business');
                        $workingHours['thursday']['from'] = curly_mkdf_options()->getOptionValue('wh_thursday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_to') !== '') {
                        $workingHours['thursday']['to'] = curly_mkdf_options()->getOptionValue('wh_thursday_to');
                    }

                    // friday
                    if (curly_mkdf_options()->getOptionValue('wh_friday_from') !== '') {
                        $workingHours['friday']['label'] = __('Friday', 'curly-business');
                        $workingHours['friday']['from'] = curly_mkdf_options()->getOptionValue('wh_friday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_friday_to') !== '') {
                        $workingHours['friday']['to'] = curly_mkdf_options()->getOptionValue('wh_friday_to');
                    }

                    // weekends
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_from') !== '') {
                        $workingHours['weekend']['label'] = __('Weekend', 'curly-business');
                        $workingHours['weekend']['from'] = curly_mkdf_options()->getOptionValue('wh_weekend_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_weekend_to') !== '') {
                        $workingHours['weekend']['to'] = curly_mkdf_options()->getOptionValue('wh_weekend_to');
                    }
                    break;

                ////////////////////////////////////////////////////////////////////////////////////////////////////////
                default:
                    // monday
                    if (curly_mkdf_options()->getOptionValue('wh_monday_from') !== '') {
                        $workingHours['monday']['label'] = __('Monday', 'curly-business');
                        $workingHours['monday']['from'] = curly_mkdf_options()->getOptionValue('wh_monday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_monday_to') !== '') {
                        $workingHours['monday']['to'] = curly_mkdf_options()->getOptionValue('wh_monday_to');
                    }

                    // tuesday
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_from') !== '') {
                        $workingHours['tuesday']['label'] = __('Tuesday', 'curly-business');
                        $workingHours['tuesday']['from'] = curly_mkdf_options()->getOptionValue('wh_tuesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_tuesday_to') !== '') {
                        $workingHours['tuesday']['to'] = curly_mkdf_options()->getOptionValue('wh_tuesday_to');
                    }

                    // wednesday
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_from') !== '') {
                        $workingHours['wednesday']['label'] = __('Wednesday', 'curly-business');
                        $workingHours['wednesday']['from'] = curly_mkdf_options()->getOptionValue('wh_wednesday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_wednesday_to') !== '') {
                        $workingHours['wednesday']['to'] = curly_mkdf_options()->getOptionValue('wh_wednesday_to');
                    }

                    // thursday
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_from') !== '') {
                        $workingHours['thursday']['label'] = __('Thursday', 'curly-business');
                        $workingHours['thursday']['from'] = curly_mkdf_options()->getOptionValue('wh_thursday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_thursday_to') !== '') {
                        $workingHours['thursday']['to'] = curly_mkdf_options()->getOptionValue('wh_thursday_to');
                    }

                    // friday
                    if (curly_mkdf_options()->getOptionValue('wh_friday_from') !== '') {
                        $workingHours['friday']['label'] = __('Friday', 'curly-business');
                        $workingHours['friday']['from'] = curly_mkdf_options()->getOptionValue('wh_friday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_friday_to') !== '') {
                        $workingHours['friday']['to'] = curly_mkdf_options()->getOptionValue('wh_friday_to');
                    }

                    // saturday
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_from') !== '') {
                        $workingHours['saturday']['label'] = __('Saturday', 'curly-business');
                        $workingHours['saturday']['from'] = curly_mkdf_options()->getOptionValue('wh_saturday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_saturday_to') !== '') {
                        $workingHours['saturday']['to'] = curly_mkdf_options()->getOptionValue('wh_saturday_to');
                    }

                    // sunday
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_from') !== '') {
                        $workingHours['sunday']['label'] = __('Sunday', 'curly-business');
                        $workingHours['sunday']['from'] = curly_mkdf_options()->getOptionValue('wh_sunday_from');
                    }
                    if (curly_mkdf_options()->getOptionValue('wh_sunday_to') !== '') {
                        $workingHours['sunday']['to'] = curly_mkdf_options()->getOptionValue('wh_sunday_to');
                    }
            endswitch;
        }

        return $workingHours;
    }

    private function getHolderClasses($params) {
        $classes = array();

        $classes[] = 'mkdf-wh-holder';
        $classes[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $classes[] = !empty($params['skin']) ? 'mkdf-wh-' . $params['skin'] : '';

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

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyBusinessElementorWorkingHours() );