<?php
class CurlyCoreElementorVerticalSplitSlider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_vertical_split_slider'; 
	}

	public function get_title() {
		return esc_html__( 'Vertical Split Slider', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-vertical-split-slider';
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
			'enable_scrolling_animation',
			[
				'label'     => esc_html__( 'Enable Scrolling Animation', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'left_sliding_panel',
			[
				'label' => esc_html__( 'Left Sliding Panel', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater1 = new \Elementor\Repeater();

		$repeater1->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'curly-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

		$repeater1->add_control(
			'background_image',
			[
				'label' => esc_html__( 'Background Image', 'curly-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater1->add_control(
			'item_padding',
			[
				'label'       => esc_html__( 'Padding', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'curly-core' )
			]
		);

		$repeater1->add_control(
			'alignment',
			[
				'label'       => esc_html__( 'Content Alignment', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''       => esc_html__( 'Default', 'curly-core' ),
					'left'   => esc_html__( 'Left', 'curly-core' ),
					'right'  => esc_html__( 'Right', 'curly-core' ),
					'center' => esc_html__( 'Center', 'curly-core' ),
				],
			]
		);

		$repeater1->add_control(
			'header_style',
			[
				'label'       => esc_html__( 'Header/Bullets Style', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''      => esc_html__( 'Default', 'curly-core' ),
					'light' => esc_html__( 'Light', 'curly-core' ),
					'dark'  => esc_html__( 'Dark', 'curly-core' )
				],
			]
		);

		curly_core_generate_elementor_templates_control( $repeater1 );

		$this->add_control(
			'left_slide_content_item',
			[
				'label'       => esc_html__( 'Left Slide Content Items', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater1->get_controls(),
				'title_field' => esc_html__( 'Left Slide Content Item' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'right_sliding_panel',
			[
				'label' => esc_html__( 'Right Sliding Panel', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater2 = new \Elementor\Repeater();

		$repeater2->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'curly-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

		$repeater2->add_control(
			'background_image',
			[
				'label' => esc_html__( 'Background Image', 'curly-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater2->add_control(
			'item_padding',
			[
				'label'       => esc_html__( 'Padding', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'curly-core' )
			]
		);

		$repeater2->add_control(
			'alignment',
			[
				'label'       => esc_html__( 'Content Alignment', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''       => esc_html__( 'Default', 'curly-core' ),
					'left'   => esc_html__( 'Left', 'curly-core' ),
					'right'  => esc_html__( 'Right', 'curly-core' ),
					'center' => esc_html__( 'Center', 'curly-core' ),
				],
			]
		);

		$repeater2->add_control(
			'header_style',
			[
				'label'       => esc_html__( 'Header/Bullets Style', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''      => esc_html__( 'Default', 'curly-core' ),
					'light' => esc_html__( 'Light', 'curly-core' ),
					'dark'  => esc_html__( 'Dark', 'curly-core' )
				],
			]
		);

		curly_core_generate_elementor_templates_control( $repeater2 );

		$this->add_control(
			'right_slide_content_item',
			[
				'label'       => esc_html__( 'Right Slide Content Items', 'curly-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater2->get_controls(),
				'title_field' => esc_html__( 'Right Slide Content Item', 'curly-core' ),
			]
		);

		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$holder_classes = $this->getHolderClasses( $params );
		?>
		<div class="mkdf-vertical-split-slider <?php echo esc_attr( $holder_classes ); ?>">
			<div class="mkdf-vss-ms-left">
				<?php foreach ( $params['left_slide_content_item'] as $left ) {
					$left['holder_rand_class'] = 'mkdf-vss-' . mt_rand( 1000, 10000 );
					$left['content_data']      = $this->getItemContentData( $left );
					$left['content_style']     = $this->getItemContentStyles( $left );

					$left['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($left['template_id']);

					echo curly_core_get_shortcode_module_template_part( 'templates/vertical-split-slider-content-item-template', 'vertical-split-slider', '', $left );
				} ?>
			</div>

			<div class="mkdf-vss-ms-right">
				<?php foreach ( $params['right_slide_content_item'] as $right ) {
					$right['holder_rand_class'] = 'mkdf-vss-' . mt_rand( 1000, 10000 );
					$right['content_data']      = $this->getItemContentData( $right );
					$right['content_style']     = $this->getItemContentStyles( $right );

					$right['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($right['template_id']);

					echo curly_core_get_shortcode_module_template_part( 'templates/vertical-split-slider-content-item-template', 'vertical-split-slider', '', $right );
				} ?>
			</div>
			<div class="mkdf-vss-horizontal-mask"></div>
			<div class="mkdf-vss-vertical-mask"></div>
		</div>
		<?php
	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = $params['enable_scrolling_animation'] === 'yes' ? 'mkdf-vss-scrolling-animation' : '';

        return implode(' ', $holderClasses);
    }
	private function getItemContentData($params) {
		$data = array();

		if (!empty($params['header_style'])) {
			$data['data-header-style'] = $params['header_style'];
		}

		return $data;
	}

	private function getItemContentStyles($params) {
		$styles = array();

		if (!empty($params['background_color'])) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}

		if (!empty($params['background_image']['id'])) {
			$url = wp_get_attachment_url($params['background_image']['id']);
			$styles[] = 'background-image: url(' . $url . ')';
		}

		if (!empty($params['item_padding'])) {
			$styles[] = 'padding: ' . $params['item_padding'];
		}

		if (!empty($params['alignment'])) {
			$styles[] = 'text-align: ' . $params['alignment'];
		}

		return implode(';', $styles);
	}

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorVerticalSplitSlider() );