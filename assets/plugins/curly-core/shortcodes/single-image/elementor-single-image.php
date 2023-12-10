<?php
class CurlyCoreElementorSingleImage extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_single_image'; 
	}

	public function get_title() {
		return esc_html__( 'Single Image', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-single-image';
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
					'grayscale' => esc_html__( 'Grayscale', 'curly-core'), 
					'moving' => esc_html__( 'Moving on Hover', 'curly-core')
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


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$params['image'] 				= !empty($params['image']['id']) ? $params['image']['id'] : '';
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['holder_styles'] = $this->getHolderStyles($params);
        $params['image'] = $this->getImage($params);
        $params['image_size'] = $this->getImageSize($params['image_size']);
        $params['image_behavior'] = !empty($params['image_behavior']) ? $params['image_behavior'] : '';
        $params['custom_link_target'] = !empty($params['custom_link_target']) ? $params['custom_link_target'] : '_self';

		echo curly_core_get_shortcode_module_template_part('templates/single-image', 'single-image', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
        $holderClasses[] = !empty($params['image_behavior']) ? 'mkdf-image-behavior-' . $params['image_behavior'] : '';

        return implode(' ', $holderClasses);
    }

    private function getHolderStyles($params) {
        $styles = array();

        if (!empty($params['image']) && $params['image_behavior'] === 'moving') {
            $image_original = wp_get_attachment_image_src($params['image'], 'full');

            $styles[] = 'background-image: url(' . $image_original[0] . ')';
        }

        return implode(';', $styles);
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

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorSingleImage() );