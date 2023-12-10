<?php
class CurlyCoreElementorImageGallery extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_image_gallery'; 
	}

	public function get_title() {
		return esc_html__( 'Image Gallery', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-image-gallery';
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
			'type',
			[
				'label'     => esc_html__( 'Gallery Type', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'grid' => esc_html__( 'Image Grid', 'curly-core'), 
					'masonry' => esc_html__( 'Masonry', 'curly-core'), 
					'slider' => esc_html__( 'Slider', 'curly-core'), 
					'carousel' => esc_html__( 'Carousel', 'curly-core')
				),
				'default' => 'grid'
			]
		);

		$this->add_control(
			'images',
			[
				'label'     => esc_html__( 'Images', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::GALLERY,
				'description' => esc_html__( 'Select images from media library', 'curly-core' )
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
			'custom_links',
			[
				'label'     => esc_html__( 'Custom Links', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'Delimit links by comma', 'curly-core' ),
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
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'two' => esc_html__( 'Two', 'curly-core'), 
					'three' => esc_html__( 'Three', 'curly-core'), 
					'four' => esc_html__( 'Four', 'curly-core'), 
					'five' => esc_html__( 'Five', 'curly-core'), 
					'six' => esc_html__( 'Six', 'curly-core')
				),
				'default' => 'three',
				'condition' => [
					'type' => array( 'grid', 'masonry' )
				]
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

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'number_of_visible_items',
			[
				'label'     => esc_html__( 'Number Of Visible Items', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__( 'One', 'curly-core'), 
					'2' => esc_html__( 'Two', 'curly-core'), 
					'3' => esc_html__( 'Three', 'curly-core'), 
					'4' => esc_html__( 'Four', 'curly-core'), 
					'5' => esc_html__( 'Five', 'curly-core'), 
					'6' => esc_html__( 'Six', 'curly-core')
				),
				'default' => '1',
				'condition' => [
					'type' => array( 'carousel' )
				]
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label'     => esc_html__( 'Enable Slider Loop', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes',
				'condition' => [
					'type' => array( 'slider', 'carousel' )
				]
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'     => esc_html__( 'Enable Slider Autoplay', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes',
				'condition' => [
					'type' => array( 'slider', 'carousel' )
				]
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'     => esc_html__( 'Slide Duration', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default value is 5000 (ms)', 'curly-core' ),
				'condition' => [
					'type' => array( 'slider', 'carousel' )
				]
			]
		);

		$this->add_control(
			'slider_speed_animation',
			[
				'label'     => esc_html__( 'Slide Animation Duration', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'curly-core' ),
				'condition' => [
					'type' => array( 'slider', 'carousel' )
				]
			]
		);

		$this->add_control(
			'slider_padding',
			[
				'label'     => esc_html__( 'Enable Slider Padding', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Padding left and right on stage (can see neighbours).', 'curly-core' ),
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no',
				'condition' => [
					'type' => array( 'slider' )
				]
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label'     => esc_html__( 'Enable Slider Navigation Arrows', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes',
				'condition' => [
					'type' => array( 'slider', 'carousel' )
				]
			]
		);

		$this->add_control(
			'slider_pagination',
			[
				'label'     => esc_html__( 'Enable Slider Pagination', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes',
				'condition' => [
					'type' => array( 'slider', 'carousel' )
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();


        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['inner_classes'] = $this->getInnerClasses($params);
        $params['slider_data'] = $this->getSliderData($params);

        $params['type'] = !empty($params['type']) ? $params['type'] : 'grid';
        $params['images'] = $this->getGalleryImages($params);
        $params['image_size'] = $this->getImageSize($params['image_size']);
        $params['image_behavior'] = !empty($params['image_behavior']) ? $params['image_behavior'] : '';
        $params['custom_links'] = $this->getCustomLinks($params);
        $params['custom_link_target'] = !empty($params['custom_link_target']) ? $params['custom_link_target'] : '_self';

		echo curly_core_get_shortcode_module_template_part('templates/' . $params['type'], 'image-gallery', '', $params);
	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['type']) ? 'mkdf-ig-' . $params['type'] . '-type' : '';
        $holderClasses[] = !empty($params['space_between_items']) ? 'mkdf-' . $params['space_between_items'] . '-space' : '';
        $holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
        $holderClasses[] = !empty($params['image_behavior']) ? 'mkdf-image-behavior-' . $params['image_behavior'] : '';

        return implode(' ', $holderClasses);
    }

    private function getInnerClasses($params) {
        $holderClasses = array();

        $holderClasses[] = $params['type'] === 'masonry' ? 'mkdf-ig-masonry' : 'mkdf-ig-grid';
        $holderClasses[] = !empty($params['number_of_columns']) ? 'mkdf-ig-' . $params['number_of_columns'] . '-columns' : '';

        return implode(' ', $holderClasses);
    }

    private function getSliderData($params) {
        $slider_data = array();

        $slider_data['data-number-of-items'] = $params['number_of_visible_items'] !== '' && $params['type'] === 'carousel' ? $params['number_of_visible_items'] : '1';
        $slider_data['data-enable-loop'] = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay'] = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed'] = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-slider-padding'] = !empty($params['slider_padding']) ? $params['slider_padding'] : '';
        $slider_data['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $slider_data;
    }

    private function getGalleryImages($params) {
        $image_ids = array();
        $images = array();
        $i = 0;

		if ( $params['images'] !== '' ) {
			foreach ( $params['images'] as $image ) {
				$image_ids[] = $image['id'];
			}
		}

        foreach ($image_ids as $id) {

            $image['image_id'] = $id;
            $image_original = wp_get_attachment_image_src($id, 'full');
            $image['url'] = $image_original[0];
            $image['title'] = get_the_title($id);
            $image['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);

            $images[$i] = $image;
            $i++;
        }

        return $images;
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

    private function getCustomLinks($params) {
        $custom_links = array();

        if (!empty($params['custom_links'])) {
            $custom_links = array_map('trim', explode(',', $params['custom_links']));
        }

        return $custom_links;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorImageGallery() );