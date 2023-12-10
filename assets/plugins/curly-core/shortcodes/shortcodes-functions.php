<?php

if (!function_exists('curly_core_include_shortcodes_file')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function curly_core_include_shortcodes_file() {
	    if ( curly_core_theme_installed() && curly_core_is_theme_registered() ) {
		    foreach ( glob( CURLY_CORE_SHORTCODES_PATH . '/*/load.php' ) as $shortcode_load ) {
			    include_once $shortcode_load;
		    }
	    }

        do_action('curly_core_action_include_shortcodes_file');
    }

    add_action('init', 'curly_core_include_shortcodes_file', 6); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if (!function_exists('curly_core_load_shortcodes')) {
    function curly_core_load_shortcodes() {
        include_once CURLY_CORE_ABS_PATH . '/lib/shortcode-loader.php';

        CurlyCore\Lib\ShortcodeLoader::getInstance()->load();
    }

    add_action('init', 'curly_core_load_shortcodes', 7); // permission 7 is set to be before vc_before_init hook that has permission 9 and after curly_core_include_shortcodes_file hook
}

if (!function_exists('curly_core_add_admin_shortcodes_styles')) {
    /**
     * Function that includes shortcodes core styles for admin
     */
    function curly_core_add_admin_shortcodes_styles() {

        //include shortcode styles for Visual Composer
        wp_enqueue_style('curly-core-vc-shortcodes', CURLY_CORE_ASSETS_URL_PATH . '/css/admin/curly-vc-shortcodes.css');
    }

    add_action('curly_mkdf_admin_scripts_init', 'curly_core_add_admin_shortcodes_styles');
}

if (!function_exists('curly_core_add_admin_shortcodes_custom_styles')) {
    /**
     * Function that print custom vc shortcodes style
     */
    function curly_core_add_admin_shortcodes_custom_styles() {
        $style = apply_filters('curly_core_filter_add_vc_shortcodes_custom_style', $style = '');
        $shortcodes_icon_styles = array();
        $shortcode_icon_size = 32;
        $shortcode_position = 0;

        $shortcodes_icon_class_array = apply_filters('curly_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array());
        sort($shortcodes_icon_class_array);

        if (!empty($shortcodes_icon_class_array)) {
            foreach ($shortcodes_icon_class_array as $shortcode_icon_class) {
                $mark = $shortcode_position != 0 ? '-' : '';

                $shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon' . esc_attr($shortcode_icon_class) . ' {
					background-position: ' . $mark . esc_attr($shortcode_position * $shortcode_icon_size) . 'px 0;
				}';

                $shortcode_position++;
            }
        }

        if (!empty($shortcodes_icon_styles)) {
            $style .= implode(' ', $shortcodes_icon_styles);
        }

        if (!empty($style)) {
            wp_add_inline_style('curly-core-vc-shortcodes', $style);
        }
    }

    add_action('curly_mkdf_admin_scripts_init', 'curly_core_add_admin_shortcodes_custom_styles');
}


if ( ! function_exists( 'curly_core_load_elementor_shortcodes' ) ) {
	/**
	 * Function that loads elementor files inside shortcodes folder
	 */
	function curly_core_load_elementor_shortcodes() {
		if ( curly_core_theme_installed() && curly_core_is_theme_registered() ) {
			$i = 0;
			foreach ( glob( CURLY_CORE_SHORTCODES_PATH . '/*/elementor-*.php' ) as $shortcode_load ) {
				if($i < 65) {
					include_once $shortcode_load;
				}
				$i++;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'curly_core_load_elementor_shortcodes' );
}

if ( ! function_exists( 'curly_core_add_elementor_widget_categories' ) ) {
	/**
	 * Registers category group
	 */
	function curly_core_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'mikado',
			[
				'title' => esc_html__( 'Mikado', 'curly-core' ),
				'icon'  => 'fa fa-plug',
			]
		);

	}

	add_action( 'elementor/elements/categories_registered', 'curly_core_add_elementor_widget_categories' );
}

if( ! function_exists( 'curly_core_remove_widgets_for_elementor') ) {
	function curly_core_remove_widgets_for_elementor( $black_list ) {
	    $black_list[] = 'CurlyMikadoButtonWidget';
		$black_list[] = 'CurlyMikadofContactForm7Widget';
		$black_list[] = 'CurlyMikadofSearchOpener';
		$black_list[] = 'CurlyMikadofSeparatorWidget';
		$black_list[] = 'CurlyMikadofSideAreaOpener';
		$black_list[] = 'CurlyMikadofClassIconsGroupWidget';
		$black_list[] = 'CurlyMikadofWoocommerceDropdownCart';
		$black_list[] = 'CurlyBusinessWorkingHours';

		return $black_list;
	}

	add_filter('elementor/widgets/black_list', 'curly_core_remove_widgets_for_elementor');
}

if ( ! function_exists( 'curly_core_return_elementor_templates' ) ) {
	/**
	 * Function that returns all Elementor saved templates
	 */
	function curly_core_return_elementor_templates() {
		return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
	}
}

if ( ! function_exists( 'curly_core_generate_elementor_templates_control' ) ) {
	/**
	 * Function that adds Template Elementor Control
	 */
	function curly_core_generate_elementor_templates_control( $object ) {
		$templates = curly_core_return_elementor_templates();

		if ( ! empty( $templates ) ) {
			$options = [
				'0' => '— ' . esc_html__( 'Select', 'curly-core' ) . ' —',
			];

			$types = [];

			foreach ( $templates as $template ) {
				$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
				$types[ $template['template_id'] ]   = $template['type'];
			}

			$object->add_control(
				'template_id',
				[
					'label'       => esc_html__( 'Choose Template', 'curly-core' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => '0',
					'options'     => $options,
					'types'       => $types,
					'label_block' => 'true'
				]
			);
		};
	}
}

//function that maps "Anchor" option for section
if( ! function_exists('curly_core_map_section_anchor_option') ){
	function curly_core_map_section_anchor_option( $section, $args ){
		$section->start_controls_section(
			'section_mikado_anchor',
			[
				'label' => esc_html__( 'Curly Anchor', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'anchor_id',
			[
				'label' => esc_html__( 'Curly Anchor ID', 'curly-core' ),
				'type'  => Elementor\Controls_Manager::TEXT,
			]
		);

		$section->end_controls_section();
	}

	add_action('elementor/element/section/_section_responsive/after_section_end', 'curly_core_map_section_anchor_option', 10, 2);
}

//function that renders "Anchor" option for section
if( ! function_exists('curly_core_render_section_anchor_option') ) {
	function curly_core_render_section_anchor_option( $element )   {
		if( 'section' !== $element->get_name() ) {
			return;
		}

		$params = $element->get_settings_for_display();

		if( ! empty( $params['anchor_id'] ) ){
			$element->add_render_attribute( '_wrapper', 'data-mkdf-anchor', $params['anchor_id'] );
		}
	}

	add_action( 'elementor/frontend/section/before_render', 'curly_core_render_section_anchor_option');
}

//function that maps "Parallax" option for section
if ( ! function_exists( 'curly_core_map_section_parallax_option' ) ) {
	function curly_core_map_section_parallax_option( $section, $args ) {
		$section->start_controls_section(
			'section_mikado_parallax',
			[
				'label' => esc_html__( 'Curly Parallax', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_enable_parallax',
			[
				'label'        => esc_html__( 'Enable Parallax', 'curly-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'     => esc_html__( 'No', 'curly-core' ),
					'holder' => esc_html__( 'Yes', 'curly-core' ),
				],
				'prefix_class' => 'mkdf-parallax-row-'
			]
		);

		$section->add_control(
			'mikado_parallax_image',
			[
				'label'              => esc_html__( 'Parallax Image', 'curly-core' ),
				'type'               => Elementor\Controls_Manager::MEDIA,
				'condition'          => [
					'mikado_enable_parallax' => 'holder'
				],
				'frontend_available' => true,
			]
		);

		$section->add_control(
			'mikado_parallax_speed',
			[
				'label'     => esc_html__( 'Parallax Speed', 'curly-core' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mikado_enable_parallax' => 'holder'
				],
				'default'   => '0'
			]
		);

		$section->add_control(
			'mikado_parallax_height',
			[
				'label'     => esc_html__( 'Parallax Section Height (px)', 'curly-core' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mikado_enable_parallax' => 'holder'
				],
				'default'   => '0'
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'curly_core_map_section_parallax_option', 10, 2 );
}

//frontend function for "Parallax"
if ( ! function_exists( 'curly_core_render_section_parallax_option' ) ) {
	function curly_core_render_section_parallax_option( $element ) {
		if ( 'section' !== $element->get_name() ) {
			return;
		}

		$params = $element->get_settings_for_display();

		if ( ! empty( $params['mikado_parallax_image']['id'] ) ) {
			$parallax_image_src = $params['mikado_parallax_image']['url'];
			$parallax_speed     = ! empty( $params['mikado_parallax_speed'] ) ? $params['mikado_parallax_speed'] : '1';
			$parallax_height    = ! empty( $params['mikado_parallax_height'] ) ? $params['mikado_parallax_height'] : 0;

			$element->add_render_attribute( '_wrapper', 'class', 'mkdf-parallax-row-holder' );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-speed', $parallax_speed );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-image', $parallax_image_src );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-height', $parallax_height );
		}
	}

	add_action( 'elementor/frontend/section/before_render', 'curly_core_render_section_parallax_option' );
}

//function that renders helper hidden input for parallax data attribute section
if ( ! function_exists( 'curly_core_generate_parallax_helper' ) ) {
	function curly_core_generate_parallax_helper( $template, $widget ) {
		if ( 'section' === $widget->get_name() ) {
			$template_preceding = "
            <# if( settings.mikado_enable_parallax == 'holder' ){
		        let parallaxSpeed = settings.mikado_parallax_speed !== '' ? settings.mikado_parallax_speed : '0';
	            let parallaxImage = settings.mikado_parallax_image.url !== '' ? settings.mikado_parallax_image.url : '0';
	            let parallaxHeight = settings.mikado_parallax_height !== '' ? settings.mikado_parallax_height : '0';
	        #>
		        <input type='hidden' class='mkdf-parallax-helper-holder' data-parallax-bg-speed='{{ parallaxSpeed }}' data-parallax-bg-image='{{ parallaxImage }}' data-parallax-bg-height='{{ parallaxHeight }}'/>
		    <# } #>";
			$template           = $template_preceding . " " . $template;
		}

		return $template;
	}

	add_action( 'elementor/section/print_template', 'curly_core_generate_parallax_helper', 10, 2 );
}

//function that maps "Content Alignment" option for section
if ( ! function_exists( 'curly_core_map_section_content_alignment_option' ) ) {
	function curly_core_map_section_content_alignment_option( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_content_alignment',
			[
				'label' => esc_html__( 'Curly Content Alignment', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_content_alignment',
			[
				'label'        => esc_html__( 'Content Alignment', 'curly-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'left',
				'options'      => [
					'left'   => esc_html__( 'Left', 'curly-core' ),
					'center' => esc_html__( 'Center', 'curly-core' ),
					'right'  => esc_html__( 'Right', 'curly-core' )
				],
				'prefix_class' => 'mkdf-content-aligment-'
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'curly_core_map_section_content_alignment_option', 10, 2 );
}

//function that maps "Grid" option for section
if ( ! function_exists( 'curly_core_map_section_grid_option' ) ) {
	function curly_core_map_section_grid_option( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_grid_row',
			[
				'label' => esc_html__( 'Curly Grid', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'curly-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'      => esc_html__( 'No', 'curly-core' ),
					'section' => esc_html__( 'Yes', 'curly-core' ),
				],
				'prefix_class' => 'mkdf-elementor-row-grid-'
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'curly_core_map_section_grid_option', 10, 2 );
}

//function that adds maps "Disable Background" option for section
if ( ! function_exists( 'curly_core_map_section_disable_background' ) ) {
	function curly_core_map_section_disable_background( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_disable_background',
			[
				'label' => esc_html__( 'Curly Disable Background Image', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'mikado_disable_background',
			[
				'label'        => esc_html__( 'Disable row background', 'curly-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'Never', 'curly-core' ),
					'1280' => esc_html__( 'Below 1280px', 'curly-core' ),
					'1024' => esc_html__( 'Below 1024px', 'curly-core' ),
					'768'  => esc_html__( 'Below 768px', 'curly-core' ),
					'680'  => esc_html__( 'Below 680px', 'curly-core' ),
					'480'  => esc_html__( 'Below 480px', 'curly-core' )
				],
				'prefix_class' => 'mkdf-disabled-bg-image-bellow-'
			]
		);

		$section->end_controls_section();
	}

	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'curly_core_map_section_disable_background', 10, 2 );
}


if( ! function_exists('curly_core_elementor_icons_style') ){
	function curly_core_elementor_icons_style(){

		wp_enqueue_style( 'curly-core-elementor', CURLY_CORE_ASSETS_URL_PATH . '/css/admin/curly-elementor.css');

	}

	add_action( 'elementor/editor/before_enqueue_scripts', 'curly_core_elementor_icons_style' );
}


if ( ! function_exists( 'curly_core_get_elementor_shortcodes_path' ) ) {
	function curly_core_get_elementor_shortcodes_path() {
		$shortcodes       = array();
		$shortcodes_paths = array(
			CURLY_CORE_SHORTCODES_PATH . '/*' => CURLY_CORE_URL_PATH,
			CURLY_CORE_CPT_PATH . '/**/shortcodes/*' => CURLY_CORE_URL_PATH,
			CURLY_TWITTER_SHORTCODES_PATH . '/*' => CURLY_TWITTER_URL_PATH,
			MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/**/shortcodes/*' => MIKADO_FRAMEWORK_ROOT . '/'
		);

		foreach ( $shortcodes_paths as $dir_path => $url_path ) {
			foreach ( glob( $dir_path, GLOB_ONLYDIR ) as $shortcode_dir_path ) {
				$shortcode_name     = basename( $shortcode_dir_path );
				$shortcode_url_path = $url_path . substr( $shortcode_dir_path, strpos( $shortcode_dir_path, basename( $url_path ) ) + strlen( basename( $url_path ) ) + 1 );

				$shortcodes[ $shortcode_name ] = array(
					'dir_path' => $shortcode_dir_path,
					'url_path' => $shortcode_url_path
				);
			}
		}

		return $shortcodes;
	}
}
if ( ! function_exists( 'curly_core_add_elementor_shortcodes_custom_styles' ) ) {
	function curly_core_add_elementor_shortcodes_custom_styles() {
		$style                  = '';
		$shortcodes_icon_styles = array();

		$shortcodes_icon_class_array = apply_filters( 'curly_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );

		$shortcodes_path = curly_core_get_elementor_shortcodes_path();
		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {

				$shortcode_name = str_replace( '.icon-wpb-', '', esc_attr( $shortcode_icon_class ) );

				if ( key_exists( $shortcode_name, $shortcodes_path ) && file_exists( $shortcodes_path[ $shortcode_name ]['dir_path'] . '/assets/img/dashboard_icon.png' ) ) {
					$shortcodes_icon_styles[] = '.curly-elementor-custom-icon.curly-elementor-' . $shortcode_name . ' {
                        background-image: url( "' . $shortcodes_path[ $shortcode_name ]['url_path'] . '/assets/img/dashboard_icon.png" );
                    }';
				}
			}
		}

		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style = implode( ' ', $shortcodes_icon_styles );
		}
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'curly-core-elementor', $style );
		}
	}

	add_action( 'elementor/editor/before_enqueue_scripts', 'curly_core_add_elementor_shortcodes_custom_styles', 15 );
}