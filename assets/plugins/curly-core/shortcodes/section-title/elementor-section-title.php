<?php
class CurlyCoreElementorSectionTitle extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_section_title'; 
	}

	public function get_title() {
		return esc_html__( 'Section Title', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-section-title';
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
			'background_text',
			[
				'label'     => esc_html__( 'Background Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
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
			'text',
			[
				'label'     => esc_html__( 'Text', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styling_options',
			[
				'label' => esc_html__( 'Styling Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'default' => 'dark'
			]
		);

		$this->add_control(
			'background_text_tag',
			[
				'label'     => esc_html__( 'Background Text Tag', 'curly-core' ),
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
				'default' => 'var',
				'condition' => [
					'background_text!' => ''
				]
			]
		);

		$this->add_control(
			'background_text_font_size',
			[
				'label'     => esc_html__( 'Background Text Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'background_text!' => ''
				]
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
				'default' => 'h2',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_break_words',
			[
				'label'     => esc_html__( 'Position of Line Break', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter &quot;3&quot;)', 'curly-core' ),
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'disable_break_words',
			[
				'label'     => esc_html__( 'Disable Line Break for Smaller Screens', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'text_tag',
			[
				'label'     => esc_html__( 'Text Tag', 'curly-core' ),
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
				'default' => 'p',
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_options',
			[
				'label' => esc_html__( 'Layout Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'type',
			[
				'label'     => esc_html__( 'Layout', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'standard' => esc_html__( 'One Column', 'curly-core'), 
					'two-columns' => esc_html__( 'Two Columns', 'curly-core')
				),
				'default' => 'standard'
			]
		);

		$this->add_control(
			'title_position',
			[
				'label'     => esc_html__( 'Title - Text Position', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'title-left' => esc_html__( 'Title Left - Text Right', 'curly-core'), 
					'title-right' => esc_html__( 'Title Right - Text Left', 'curly-core')
				),
				'default' => 'title-left',
				'condition' => [
					'type' => array( 'two-columns' )
				]
			]
		);

		$this->add_control(
			'columns_space',
			[
				'label'     => esc_html__( 'Space Between Columns', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'normal' => esc_html__( 'Normal', 'curly-core'), 
					'small' => esc_html__( 'Small', 'curly-core'), 
					'tiny' => esc_html__( 'Tiny', 'curly-core')
				),
				'default' => 'normal',
				'condition' => [
					'type' => array( 'two-columns' )
				]
			]
		);

		$this->add_control(
			'content_alignment',
			[
				'label'     => esc_html__( 'Content Alignment', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'left' => esc_html__( 'Left', 'curly-core'), 
					'center' => esc_html__( 'Center', 'curly-core'), 
					'right' => esc_html__( 'Right', 'curly-core')
				),
				'default' => 'left',
				'condition' => [
					'type' => array( 'standard' )
				]
			]
		);

		$this->add_control(
			'holder_padding',
			[
				'label'     => esc_html__( 'Holder Side Padding (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'horizontal_offset',
			[
				'label'     => esc_html__( 'Horizontal Offset (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'background_text!' => ''
				]
			]
		);

		$this->add_control(
			'vertical_offset',
			[
				'label'     => esc_html__( 'Vertical Offset (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'background_text!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'responsive_options',
			[
				'label' => esc_html__( 'Responsive Options', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'font_size_responsive',
			[
				'label'     => esc_html__( 'Font Size (px)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Between 1366px and 1024px', 'curly-core' ),
				'condition' => [
					'background_text!' => ''
				]
			]
		);

		$this->add_control(
			'horizontal_offset_responsive',
			[
				'label'     => esc_html__( 'Horizontal Offset (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Between 1366px and 1024px', 'curly-core' ),
				'condition' => [
					'background_text!' => ''
				]
			]
		);

		$this->add_control(
			'vertical_offset_responsive',
			[
				'label'     => esc_html__( 'Vertical Offset (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Between 1366px and 1024px', 'curly-core' ),
				'condition' => [
					'background_text!' => ''
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['holder_styles'] = $this->getHolderStyles($params);
        $params['background_text_tag'] = !empty($params['background_text_tag']) ? $params['background_text_tag'] : 'var';
        $params['background_text_styles'] = $this->getBackgroundTextStyles($params);
        $params['title'] = $this->getModifiedTitle($params);
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : 'h2';
        $params['text_tag'] = !empty($params['text_tag']) ? $params['text_tag'] : 'p';
        $params['data_atts'] = $this->getDataAtts($params);

		echo curly_core_get_shortcode_module_template_part('templates/section-title', 'section-title', '', $params);

	}

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = !empty($params['skin']) ? 'mkdf-' . $params['skin'] : '';
        $holderClasses[] = !empty($params['type']) ? 'mkdf-st-' . $params['type'] : '';
        $holderClasses[] = !empty($params['title_position']) ? 'mkdf-st-' . $params['title_position'] : '';
        $holderClasses[] = !empty($params['columns_space']) ? 'mkdf-st-' . $params['columns_space'] . '-space' : '';
        $holderClasses[] = $params['disable_break_words'] === 'yes' ? 'mkdf-st-disable-title-break' : '';

        return implode(' ', $holderClasses);
    }

    private function getHolderStyles($params) {
        $styles = array();

        if (!empty($params['holder_padding'])) {
            $styles[] = 'padding: 0 ' . $params['holder_padding'];
        }

        if (!empty($params['content_alignment'])) {
            $styles[] = 'text-align: ' . $params['content_alignment'];
        }

        return implode(';', $styles);
    }

    private function getBackgroundTextStyles($params) {
        $textStyles = array();

        $textStyles[] = 'font-size:' . $params['background_text_font_size'] . 'px';
        if (!empty($params['horizontal_offset'])) {
            $textStyles[] = 'left: ' . $params['horizontal_offset'];
        }
        if (!empty($params['vertical_offset'])) {
            $textStyles[] = 'top: ' . $params['vertical_offset'];
        }

        return implode(';', $textStyles);
    }

    private function getModifiedTitle($params) {
        $title = $params['title'];
        $title_break_words = str_replace(' ', '', $params['title_break_words']);

        if (!empty($title)) {
            $split_title = explode(' ', $title);

            if (!empty($title_break_words)) {
                if (!empty($split_title[$title_break_words - 1])) {
                    $split_title[$title_break_words - 1] = $split_title[$title_break_words - 1] . '<br />';
                }
            }

            $title = implode(' ', $split_title);
        }

        return $title;
    }

    private function getDataAtts($params) {
        $data = array();

        if ($params['font_size_responsive'] !== '') {
            $data['data-font-size'] = curly_mkdf_filter_px($params['font_size_responsive']) . 'px';
        }

        if ($params['horizontal_offset_responsive'] !== '') {
            $data['data-horizontal-offset'] = $params['horizontal_offset_responsive'];
        }

        if ($params['vertical_offset_responsive'] !== '') {
            $data['data-vertical-offset'] = $params['vertical_offset_responsive'];
        }

        return $data;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorSectionTitle() );