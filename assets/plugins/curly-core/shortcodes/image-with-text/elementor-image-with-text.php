<?php
class CurlyCoreElementorImageWithText extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_image_with_text'; 
	}

	public function get_title() {
		return esc_html__( 'Image With Text', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-image-with-text';
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
			'image',
			[
				'label'     => esc_html__( 'Image', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'curly-core' )
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'     => esc_html__( 'Image Size', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use &quot;thumbnail&quot; size', 'curly-core' )
			]
		);

		$this->add_control(
			'enable_image_shadow',
			[
				'label'     => esc_html__( 'Enable Image Shadow', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'image_behavior',
			[
				'label'     => esc_html__( 'Image Behavior', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'None', 'curly-core'), 
					'lightbox' => esc_html__( 'Open Lightbox', 'curly-core'), 
					'custom-link' => esc_html__( 'Open Custom Link', 'curly-core'), 
					'zoom' => esc_html__( 'Zoom', 'curly-core'), 
					'grayscale' => esc_html__( 'Grayscale', 'curly-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'custom_link',
			[
				'label'     => esc_html__( 'Custom Link', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image_behavior' => array( 'custom-link' )
				]
			]
		);

		$this->add_control(
			'custom_link_target',
			[
				'label'     => esc_html__( 'Custom Link Target', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'_self' => esc_html__( 'Same Window', 'curly-core'), 
					'_blank' => esc_html__( 'New Window', 'curly-core')
				),
				'default' => '_self',
				'condition' => [
					'image_behavior' => array( 'custom-link' )
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
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
					'var' => esc_html__( 'Theme Defined Heading', 'curly-core')
				),
				'default' => 'h4',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_top_margin',
			[
				'label'     => esc_html__( 'Title Top Margin (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'text',
			[
				'label'     => esc_html__( 'Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->add_control(
			'text_top_margin',
			[
				'label'     => esc_html__( 'Text Top Margin (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->add_control(
			'bottom_buttons',
			[
				'label'     => esc_html__( 'Enable Bottom Double Custom Link Functionality', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => curly_mkdf_get_yes_no_select_array( false, false ),
				'default'   => 'no',
				'label_block' => true
			]
		);
		$this->add_control(
			'bottom_button_one_link',
			[
				'label'     => esc_html__( 'First Bottom Link', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'bottom_buttons' => 'yes'
				],
			]
		);
		$this->add_control(
			'bottom_button_one_label',
			[
				'label'     => esc_html__( 'First Bottom Link Label', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'bottom_buttons' => 'yes'
				],
			]
		);
		$this->add_control(
			'bottom_button_two_link',
			[
				'label'     => esc_html__( 'Second Bottom Link', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'bottom_buttons' => 'yes'
				],
			]
		);
		$this->add_control(
			'bottom_button_two_label',
			[
				'label'     => esc_html__( 'Second Bottom Link Label', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'bottom_buttons' => 'yes'
				],
			]
		);

		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

		$params['image']				= !empty($params['image']['id']) ? $params['image']['id'] : '';
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['image'] = $this->getImage($params);
        $params['image_size'] = $this->getImageSize($params['image_size']);
        $params['image_behavior'] = !empty($params['image_behavior']) ? $params['image_behavior'] : '';
        $params['custom_link_target'] = !empty($params['custom_link_target']) ? $params['custom_link_target'] : '_self';
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h4';
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['text_styles'] = $this->getTextStyles($params);
		$params['bottom_styles'] = $this->getBottomStyles($params);

		echo curly_core_get_shortcode_module_template_part('templates/image-with-text', 'image-with-text', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
        $holderClasses[] = !empty($params['image_behavior']) ? 'mkdf-image-behavior-' . $params['image_behavior'] : '';
		$holderClasses[] = $params['bottom_buttons'] === 'yes' ? 'mkdf-has-bottom-buttons' : '';
        return implode(' ', $holderClasses);
    }

    private function getImage($params) {
        $image = array();

        if (!empty($params['image'])) {
            $id = $params['image'];

            $image['image_id'] = $id;
            $image_original = wp_get_attachment_image_src($id, 'full');
            $image['url'] = $image_original[0];
            $image['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);
        }

        return $image;
    }

    private function getImageSize($image_size) {
        $image_size = trim($image_size);
        //Find digits
        preg_match_all('/\d+/', $image_size, $matches);
        if (in_array($image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
            return $image_size;
        } elseif (!empty($matches[0])) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'thumbnail';
        }
    }

    private function getTitleStyles($params) {
        $styles = array();

        if (!empty($params['title_color'])) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        if ($params['title_top_margin'] !== '') {
            $styles[] = 'margin-top: ' . curly_mkdf_filter_px($params['title_top_margin']) . 'px';
        }

        return implode(';', $styles);
    }

    private function getTextStyles($params) {
        $styles = array();

        if (!empty($params['text_color'])) {
            $styles[] = 'color: ' . $params['text_color'];
        }

        if ($params['text_top_margin'] !== '') {
            $styles[] = 'margin-top: ' . curly_mkdf_filter_px($params['text_top_margin']) . 'px';
        }

        return implode(';', $styles);
    }
	private function getBottomStyles($params) {
		$styles = array();

		if (!empty($params['title_color'])) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		return implode(';', $styles);
	}

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorImageWithText() );