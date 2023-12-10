<?php
class CurlyCoreElementorAccordion extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_accordion'; 
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-accordions';
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
			'style',
			[
				'label'     => esc_html__( 'Style', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'accordion' => esc_html__( 'Accordion', 'curly-core'), 
					'toggle' => esc_html__( 'Toggle', 'curly-core')
				),
				'default' => 'accordion'
			]
		);

		$this->add_control(
			'layout',
			[
				'label'     => esc_html__( 'Layout', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'curly-core'), 
					'simple' => esc_html__( 'Simple', 'curly-core')
				),
				'default' => 'boxed'
			]
		);

		$this->add_control(
			'background_skin',
			[
				'label'     => esc_html__( 'Background Skin', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'white' => esc_html__( 'White', 'curly-core')
				),
				'default' => '',
				'condition' => [
					'layout' => array( 'boxed' )
				]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter accordion section title', 'curly-core' )
			]
		);

		$repeater->add_control(
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
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core'), 
					'p' => esc_html__( 'p', 'curly-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'accordion_tab',
			[
				'label'     => esc_html__( 'Accordion Tab', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields'     => $repeater->get_controls(),
				'title_field'     => esc_html__( 'Item', 'curly-core' )
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$params['holder_classes'] = $this->getHolderClasses( $params ); ?>

		<div class="mkdf-accordion-holder <?php echo esc_attr( $params['holder_classes'] ); ?> clearfix">
			<?php foreach ( $params['accordion_tab'] as $tab ) {
				$tab['content'] = $tab['text'];
				$tab['title_tag'] = ! empty( $tab['title_tag'] ) ? $tab['title_tag'] : 'h5';
				echo curly_core_get_shortcode_module_template_part( 'templates/accordion-template', 'accordions', '', $tab );
			} ?>
		</div>
		<?php
	}

    private function getHolderClasses($params) {
        $holder_classes = array('mkdf-ac-default');

        $holder_classes[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holder_classes[] = $params['style'] == 'toggle' ? 'mkdf-toggle' : 'mkdf-accordion';
        $holder_classes[] = !empty($params['layout']) ? 'mkdf-ac-' . esc_attr($params['layout']) : '';
        $holder_classes[] = !empty($params['background_skin']) ? 'mkdf-' . esc_attr($params['background_skin']) . '-skin' : '';

        return implode(' ', $holder_classes);
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorAccordion() );