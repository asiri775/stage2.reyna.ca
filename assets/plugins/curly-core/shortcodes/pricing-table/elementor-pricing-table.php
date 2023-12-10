<?php
class CurlyCoreElementorPricingTable extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_pricing_table'; 
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-pricing-table';
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
			'columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'mkdf-one-column' => esc_html__( 'One', 'curly-core'), 
					'mkdf-two-columns' => esc_html__( 'Two', 'curly-core'), 
					'mkdf-three-columns' => esc_html__( 'Three', 'curly-core'), 
					'mkdf-four-columns' => esc_html__( 'Four', 'curly-core'), 
					'mkdf-five-columns' => esc_html__( 'Five', 'curly-core')
				),
				'default' => 'mkdf-two-columns'
			]
		);

		$this->add_control(
			'space_between_items',
			[
				'label'     => esc_html__( 'Space Between Items', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'large' => esc_html__( 'Large', 'curly-core'), 
					'medium' => esc_html__( 'Medium', 'curly-core'), 
					'normal' => esc_html__( 'Normal', 'curly-core'), 
					'small' => esc_html__( 'Small', 'curly-core'), 
					'tiny' => esc_html__( 'Tiny', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'normal'
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'custom_class',
			[
				'label'     => esc_html__( 'Custom CSS Class', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'curly-core' )
			]
		);

		$repeater->add_control(
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

		$repeater->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'price',
			[
				'label'     => esc_html__( 'Price', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'price_decimal',
			[
				'label'     => esc_html__( 'Price Decimal', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'currency',
			[
				'label'     => esc_html__( 'Currency', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default mark is $', 'curly-core' )
			]
		);

		$repeater->add_control(
			'price_period',
			[
				'label'     => esc_html__( 'Price Period', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default label is monthly', 'curly-core' )
			]
		);

		$repeater->add_control(
			'link_text',
			[
				'label'     => esc_html__( 'Button Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'     => esc_html__( 'Button Link', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'link_text!' => ''
				]
			]
		);

		$repeater->add_control(
			'link_target',
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

		$repeater->add_control(
			'content',
			[
				'label'     => esc_html__( 'Content', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG
			]
		);

		$this->add_control(
			'pricing_table_item',
			[
				'label'     => esc_html__( 'Pricing Table Item', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields'     => $repeater->get_controls(),
				'title_field'     => esc_html__( 'Item', 'curly-core' )
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$holder_class = $this->getHolderClasses( $params );
		?>
		<div class="mkdf-pricing-tables clearfix  <?php echo esc_attr( $holder_class ); ?>">
			<div class="mkdf-pt-wrapper mkdf-outer-space">
				<?php foreach ( $params['pricing_table_item'] as $pti ) {

					$pti['holder_classes']          = $this->getItemHolderClasses( $pti );
					$pti['button_params']          = $this->getItemButtonParams( $pti );

					echo curly_core_get_shortcode_module_template_part('templates/pricing-table', 'pricing-table', '', $pti);

				} ?>
			</div>
		</div>
		<?php
	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['columns']) ? $params['columns'] : '';
        $holderClasses[] = !empty($params['space_between_items']) ? 'mkdf-' . $params['space_between_items'] . '-space' : '';

        return implode(' ', $holderClasses);
    }

	private function getItemHolderClasses($params) {
		$holderClasses = array();

		$holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
		$holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';

		return implode(' ', $holderClasses);
	}

	private function getItemButtonParams($params) {
		$buttonParams = array();

		$buttonParams['link'] = $params['link'];
		$buttonParams['target'] = $params['link_target'];
		$buttonParams['text'] = $params['link_text'];
		$buttonParams['type'] = 'outline';

		if ($params['skin'] === 'light') {
			$buttonParams['color'] = '#ffffff';
			$buttonParams['border_color'] = '#ffffff';
		}

		return $buttonParams;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorPricingTable() );