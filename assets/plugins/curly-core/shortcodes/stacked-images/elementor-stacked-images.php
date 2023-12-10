<?php
class CurlyCoreElementorStackedImages extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_stacked_images'; 
	}

	public function get_title() {
		return esc_html__( 'Stacked Images', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-stacked-images';
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
			'item_image',
			[
				'label'     => esc_html__( 'Image', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'item_stack_image',
			[
				'label'     => esc_html__( 'Stack Image', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'stack_image_position',
			[
				'label'     => esc_html__( 'Stack Image Position', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'left' => esc_html__( 'Left Offset', 'curly-core'), 
					'right' => esc_html__( 'Right Offset', 'curly-core')
				),
				'default' => 'left',
				'condition' => [
					'item_stack_image!' => ''
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$params['item_image'] = !empty($params['item_image']['id']) ? $params['item_image']['id'] : '';
		$params['item_stack_image'] = !empty($params['item_stack_image']['id']) ? $params['item_stack_image']['id'] : '';


        $params['holder_classes'] = $this->getHolderClasses($params);

		echo curly_core_get_shortcode_module_template_part('templates/stacked-images', 'stacked-images', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['stack_image_position']) ? 'mkdf-si-position-' . $params['stack_image_position'] : '';

        return implode(' ', $holderClasses);
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorStackedImages() );