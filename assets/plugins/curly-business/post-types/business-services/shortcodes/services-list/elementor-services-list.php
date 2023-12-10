<?php
class CurlyBusinessElementorServicesList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_services_list'; 
	}

	public function get_title() {
		return esc_html__( 'Services List', 'curly-business' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-services-list';
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
			'show_featured_image',
			[
				'label'     => esc_html__( 'Show Featured Image?', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Use this option to show featured image of menu items', 'curly-business' ),
				'options' => array(
					'no' => esc_html__( 'No', 'curly-business'),
					'yes' => esc_html__( 'Yes', 'curly-business')
				),
				'default' => 'no'
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

		$this->add_control(
			'category',
			[
				'label'     => esc_html__( 'One-Category Business Services list', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'curly-business' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'query_and_layout_options',
			[
				'label' => esc_html__( 'Query and Layout Options', 'curly-business' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'     => esc_html__( 'Order By', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'date' => esc_html__( 'Date', 'curly-business'),
					'ID' => esc_html__( 'ID', 'curly-business'),
					'menu_order' => esc_html__( 'Menu Order', 'curly-business'),
					'name' => esc_html__( 'Post Name', 'curly-business'),
					'rand' => esc_html__( 'Random', 'curly-business'),
					'title' => esc_html__( 'Title', 'curly-business')
				),
				'default' => 'date'
			]
		);

		$this->add_control(
			'order',
			[
				'label'     => esc_html__( 'Order', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ASC' => esc_html__( 'ASC', 'curly-business'),
					'DESC' => esc_html__( 'DESC', 'curly-business')
				),
				'default' => 'ASC'
			]
		);

		$this->add_control(
			'number',
			[
				'label'     => esc_html__( 'Number of Business Menu Items', 'curly-business' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( '(enter -1 to show all)', 'curly-business' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'curly-business' ),
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


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h6';
        $params['title_styles'] = $this->getTitleStyles($params);

        $holderClasses = $this->getHolderClasses($params);
        $titleStyles = $this->getTitleStyles($params);

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);

		$listItemParams = array(
			'show_featured_image' => $params['show_featured_image']
		);

        $html = '<div ' . curly_mkdf_get_class_attribute($holderClasses) . '>';

        if (!empty($params['title'])) :
            $html .= '<' . esc_attr($params['title_tag']) . ' class="mkdf-bsl-title"' . curly_mkdf_get_inline_style($titleStyles) . '>';
			$html .= wp_kses($params['title'], array('span' => array('class' => true)));
            $html .= '</' . esc_attr($params['title_tag']) . '>';
        endif;

        if ($query_results->have_posts()) {
            $html .= '<ul class="mkdf-bsl">';

            while ($query_results->have_posts()) {
                $query_results->the_post();
                $html .= curly_business_get_shortcode_module_template_part('business-services', 'services-list', 'services-list-item-template', '', $listItemParams);
            }

            $html .= '</ul>';

            wp_reset_postdata();
        } else {
            $html .= '<p>' . esc_html__('Sorry, no menu items matched your criteria.', 'curly-business') . '</p>';
        }

        $html .= '</div>';

        echo curly_mkdf_display_content_output($html);
	}

    public function getQueryArray($params) {
        $query_array = array(
            'post_type' => 'business-services',
            'orderby' => $params['orderby'],
            'order' => $params['order'],
            'posts_per_page' => $params['number']
        );

        if (!empty($params['category'])) {
            $query_array['business-services-category'] = $params['category'];
        }

        return $query_array;
    }

    private function getHolderClasses($params) {
        $classes = array('mkdf-bsl-holder');

        $classes[] = $params['show_featured_image'] === 'yes' ? 'mkdf-bsl-with-image' : '';
        $classes[] = !empty($params['skin']) ? 'mkdf-bsl-' . $params['skin'] : '';

        // @see http://php.net/manual/en/function.array-filter.php
        return $classes;
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
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyBusinessElementorServicesList() );