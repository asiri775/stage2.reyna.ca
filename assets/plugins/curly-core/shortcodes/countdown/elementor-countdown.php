<?php
class CurlyCoreElementorCountdown extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_countdown'; 
	}

	public function get_title() {
		return esc_html__( 'Countdown', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-countdown';
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

		$this->add_control(
			'year',
			[
				'label'     => esc_html__( 'Year', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'2018' => esc_html__( '2018', 'curly-core'), 
					'2019' => esc_html__( '2019', 'curly-core'), 
					'2020' => esc_html__( '2020', 'curly-core'), 
					'2021' => esc_html__( '2021', 'curly-core'), 
					'2022' => esc_html__( '2022', 'curly-core')
				),
				'default' => '2018'
			]
		);

		$this->add_control(
			'month',
			[
				'label'     => esc_html__( 'Month', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__( 'January', 'curly-core'), 
					'2' => esc_html__( 'February', 'curly-core'), 
					'3' => esc_html__( 'March', 'curly-core'), 
					'4' => esc_html__( 'April', 'curly-core'), 
					'5' => esc_html__( 'May', 'curly-core'), 
					'6' => esc_html__( 'June', 'curly-core'), 
					'7' => esc_html__( 'July', 'curly-core'), 
					'8' => esc_html__( 'August', 'curly-core'), 
					'9' => esc_html__( 'September', 'curly-core'), 
					'10' => esc_html__( 'October', 'curly-core'), 
					'11' => esc_html__( 'November', 'curly-core'), 
					'12' => esc_html__( 'December', 'curly-core')
				),
				'default' => '1'
			]
		);

		$this->add_control(
			'day',
			[
				'label'     => esc_html__( 'Day', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__( '1', 'curly-core'), 
					'2' => esc_html__( '2', 'curly-core'), 
					'3' => esc_html__( '3', 'curly-core'), 
					'4' => esc_html__( '4', 'curly-core'), 
					'5' => esc_html__( '5', 'curly-core'), 
					'6' => esc_html__( '6', 'curly-core'), 
					'7' => esc_html__( '7', 'curly-core'), 
					'8' => esc_html__( '8', 'curly-core'), 
					'9' => esc_html__( '9', 'curly-core'), 
					'10' => esc_html__( '10', 'curly-core'), 
					'11' => esc_html__( '11', 'curly-core'), 
					'12' => esc_html__( '12', 'curly-core'), 
					'13' => esc_html__( '13', 'curly-core'), 
					'14' => esc_html__( '14', 'curly-core'), 
					'15' => esc_html__( '15', 'curly-core'), 
					'16' => esc_html__( '16', 'curly-core'), 
					'17' => esc_html__( '17', 'curly-core'), 
					'18' => esc_html__( '18', 'curly-core'), 
					'19' => esc_html__( '19', 'curly-core'), 
					'20' => esc_html__( '20', 'curly-core'), 
					'21' => esc_html__( '21', 'curly-core'), 
					'22' => esc_html__( '22', 'curly-core'), 
					'23' => esc_html__( '23', 'curly-core'), 
					'24' => esc_html__( '24', 'curly-core'), 
					'25' => esc_html__( '25', 'curly-core'), 
					'26' => esc_html__( '26', 'curly-core'), 
					'27' => esc_html__( '27', 'curly-core'), 
					'28' => esc_html__( '28', 'curly-core'), 
					'29' => esc_html__( '29', 'curly-core'), 
					'30' => esc_html__( '30', 'curly-core'), 
					'31' => esc_html__( '31', 'curly-core')
				),
				'default' => '1'
			]
		);

		$this->add_control(
			'hour',
			[
				'label'     => esc_html__( 'Hour', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'0' => esc_html__( '0', 'curly-core'), 
					'1' => esc_html__( '1', 'curly-core'), 
					'2' => esc_html__( '2', 'curly-core'), 
					'3' => esc_html__( '3', 'curly-core'), 
					'4' => esc_html__( '4', 'curly-core'), 
					'5' => esc_html__( '5', 'curly-core'), 
					'6' => esc_html__( '6', 'curly-core'), 
					'7' => esc_html__( '7', 'curly-core'), 
					'8' => esc_html__( '8', 'curly-core'), 
					'9' => esc_html__( '9', 'curly-core'), 
					'10' => esc_html__( '10', 'curly-core'), 
					'11' => esc_html__( '11', 'curly-core'), 
					'12' => esc_html__( '12', 'curly-core'), 
					'13' => esc_html__( '13', 'curly-core'), 
					'14' => esc_html__( '14', 'curly-core'), 
					'15' => esc_html__( '15', 'curly-core'), 
					'16' => esc_html__( '16', 'curly-core'), 
					'17' => esc_html__( '17', 'curly-core'), 
					'18' => esc_html__( '18', 'curly-core'), 
					'19' => esc_html__( '19', 'curly-core'), 
					'20' => esc_html__( '20', 'curly-core'), 
					'21' => esc_html__( '21', 'curly-core'), 
					'22' => esc_html__( '22', 'curly-core'), 
					'23' => esc_html__( '23', 'curly-core'), 
					'24' => esc_html__( '24', 'curly-core')
				),
				'default' => '0'
			]
		);

		$this->add_control(
			'minute',
			[
				'label'     => esc_html__( 'Minute', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'0' => esc_html__( '0', 'curly-core'), 
					'1' => esc_html__( '1', 'curly-core'), 
					'2' => esc_html__( '2', 'curly-core'), 
					'3' => esc_html__( '3', 'curly-core'), 
					'4' => esc_html__( '4', 'curly-core'), 
					'5' => esc_html__( '5', 'curly-core'), 
					'6' => esc_html__( '6', 'curly-core'), 
					'7' => esc_html__( '7', 'curly-core'), 
					'8' => esc_html__( '8', 'curly-core'), 
					'9' => esc_html__( '9', 'curly-core'), 
					'10' => esc_html__( '10', 'curly-core'), 
					'11' => esc_html__( '11', 'curly-core'), 
					'12' => esc_html__( '12', 'curly-core'), 
					'13' => esc_html__( '13', 'curly-core'), 
					'14' => esc_html__( '14', 'curly-core'), 
					'15' => esc_html__( '15', 'curly-core'), 
					'16' => esc_html__( '16', 'curly-core'), 
					'17' => esc_html__( '17', 'curly-core'), 
					'18' => esc_html__( '18', 'curly-core'), 
					'19' => esc_html__( '19', 'curly-core'), 
					'20' => esc_html__( '20', 'curly-core'), 
					'21' => esc_html__( '21', 'curly-core'), 
					'22' => esc_html__( '22', 'curly-core'), 
					'23' => esc_html__( '23', 'curly-core'), 
					'24' => esc_html__( '24', 'curly-core'), 
					'25' => esc_html__( '25', 'curly-core'), 
					'26' => esc_html__( '26', 'curly-core'), 
					'27' => esc_html__( '27', 'curly-core'), 
					'28' => esc_html__( '28', 'curly-core'), 
					'29' => esc_html__( '29', 'curly-core'), 
					'30' => esc_html__( '30', 'curly-core'), 
					'31' => esc_html__( '31', 'curly-core'), 
					'32' => esc_html__( '32', 'curly-core'), 
					'33' => esc_html__( '33', 'curly-core'), 
					'34' => esc_html__( '34', 'curly-core'), 
					'35' => esc_html__( '35', 'curly-core'), 
					'36' => esc_html__( '36', 'curly-core'), 
					'37' => esc_html__( '37', 'curly-core'), 
					'38' => esc_html__( '38', 'curly-core'), 
					'39' => esc_html__( '39', 'curly-core'), 
					'40' => esc_html__( '40', 'curly-core'), 
					'41' => esc_html__( '41', 'curly-core'), 
					'42' => esc_html__( '42', 'curly-core'), 
					'43' => esc_html__( '43', 'curly-core'), 
					'44' => esc_html__( '44', 'curly-core'), 
					'45' => esc_html__( '45', 'curly-core'), 
					'46' => esc_html__( '46', 'curly-core'), 
					'47' => esc_html__( '47', 'curly-core'), 
					'48' => esc_html__( '48', 'curly-core'), 
					'49' => esc_html__( '49', 'curly-core'), 
					'50' => esc_html__( '50', 'curly-core'), 
					'51' => esc_html__( '51', 'curly-core'), 
					'52' => esc_html__( '52', 'curly-core'), 
					'53' => esc_html__( '53', 'curly-core'), 
					'54' => esc_html__( '54', 'curly-core'), 
					'55' => esc_html__( '55', 'curly-core'), 
					'56' => esc_html__( '56', 'curly-core'), 
					'57' => esc_html__( '57', 'curly-core'), 
					'58' => esc_html__( '58', 'curly-core'), 
					'59' => esc_html__( '59', 'curly-core'), 
					'60' => esc_html__( '60', 'curly-core')
				),
				'default' => '0'
			]
		);

		$this->add_control(
			'month_label',
			[
				'label'     => esc_html__( 'Month Label', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'day_label',
			[
				'label'     => esc_html__( 'Day Label', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'hour_label',
			[
				'label'     => esc_html__( 'Hour Label', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'minute_label',
			[
				'label'     => esc_html__( 'Minute Label', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'second_label',
			[
				'label'     => esc_html__( 'Second Label', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'digit_font_size',
			[
				'label'     => esc_html__( 'Digit Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'label_font_size',
			[
				'label'     => esc_html__( 'Label Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
        $params['id'] = mt_rand(1000, 9999);
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['holder_data'] = $this->getHolderData($params);

		echo curly_core_get_shortcode_module_template_part('templates/countdown', 'countdown', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';

        return implode(' ', $holderClasses);
    }

    private function getHolderData($params) {
        $holderData = array();

        $holderData['data-year'] = !empty($params['year']) ? $params['year'] : '';
        $holderData['data-month'] = !empty($params['month']) ? $params['month'] : '';
        $holderData['data-day'] = !empty($params['day']) ? $params['day'] : '';
        $holderData['data-hour'] = $params['hour'] !== '' ? $params['hour'] : '';
        $holderData['data-minute'] = $params['minute'] !== '' ? $params['minute'] : '';
        $holderData['data-month-label'] = !empty($params['month_label']) ? $params['month_label'] : esc_html__('Months', 'curly-core');
        $holderData['data-day-label'] = !empty($params['day_label']) ? $params['day_label'] : esc_html__('Days', 'curly-core');
        $holderData['data-hour-label'] = !empty($params['hour_label']) ? $params['hour_label'] : esc_html__('Hours', 'curly-core');
        $holderData['data-minute-label'] = !empty($params['minute_label']) ? $params['minute_label'] : esc_html__('Minutes', 'curly-core');
        $holderData['data-second-label'] = !empty($params['second_label']) ? $params['second_label'] : esc_html__('Seconds', 'curly-core');
        $holderData['data-digit-size'] = !empty($params['digit_font_size']) ? $params['digit_font_size'] : '';
        $holderData['data-label-size'] = !empty($params['label_font_size']) ? $params['label_font_size'] : '';

        return $holderData;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorCountdown() );