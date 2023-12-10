<?php
class CurlyCoreElementorPortfolioList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_portfolio_list'; 
	}

	public function get_title() {
		return esc_html__( 'Portfolio List', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-portfolio-list';
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
			'item_type',
			[
				'label'     => esc_html__( 'Click Behavior', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Open portfolio single page on click', 'curly-core'), 
					'gallery' => esc_html__( 'Open gallery in Pretty Photo on click', 'curly-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Default value is Three', 'curly-core' ),
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'1' => esc_html__( 'One', 'curly-core'), 
					'2' => esc_html__( 'Two', 'curly-core'), 
					'3' => esc_html__( 'Three', 'curly-core'), 
					'4' => esc_html__( 'Four', 'curly-core'), 
					'5' => esc_html__( 'Five', 'curly-core')
				),
				'default' => '3'
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

		$this->add_control(
			'number_of_items',
			[
				'label'     => esc_html__( 'Number of Portfolios Per Page', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'curly-core' )
			]
		);

		$this->add_control(
			'enable_fixed_proportions',
			[
				'label'     => esc_html__( 'Enable Fixed Image Proportions', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set predefined image proportions for your masonry portfolio list. This option will apply image proportions you set in Portfolio Single page - dimensions for masonry option.', 'curly-core' ),
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
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
			'category',
			[
				'label'     => esc_html__( 'One-Category Portfolio List', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'curly-core' )
			]
		);

		$this->add_control(
			'selected_projects',
			[
				'label'     => esc_html__( 'Show Only Projects with Listed IDs', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'curly-core' )
			]
		);

		$this->add_control(
			'tag',
			[
				'label'     => esc_html__( 'One-Tag Portfolio List', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'curly-core' )
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'     => esc_html__( 'Order By', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'date' => esc_html__( 'Date', 'curly-core'), 
					'ID' => esc_html__( 'ID', 'curly-core'), 
					'menu_order' => esc_html__( 'Menu Order', 'curly-core'), 
					'name' => esc_html__( 'Post Name', 'curly-core'), 
					'rand' => esc_html__( 'Random', 'curly-core'), 
					'title' => esc_html__( 'Title', 'curly-core')
				),
				'default' => 'date'
			]
		);

		$this->add_control(
			'order',
			[
				'label'     => esc_html__( 'Order', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ASC' => esc_html__( 'ASC', 'curly-core'), 
					'DESC' => esc_html__( 'DESC', 'curly-core')
				),
				'default' => 'ASC'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_layout',
			[
				'label' => esc_html__( 'Content Layout', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_title',
			[
				'label'     => esc_html__( 'Enable Title', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes'
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
				'default' => 'h3',
				'condition' => [
					'enable_title' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'title_text_transform',
			[
				'label'     => esc_html__( 'Title Text Transform', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'none' => esc_html__( 'None', 'curly-core'), 
					'capitalize' => esc_html__( 'Capitalize', 'curly-core'), 
					'uppercase' => esc_html__( 'Uppercase', 'curly-core'), 
					'lowercase' => esc_html__( 'Lowercase', 'curly-core'), 
					'initial' => esc_html__( 'Initial', 'curly-core'), 
					'inherit' => esc_html__( 'Inherit', 'curly-core')
				),
				'default' => '',
				'condition' => [
					'enable_title' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'enable_category',
			[
				'label'     => esc_html__( 'Enable Category', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'curly-core'), 
					'no' => esc_html__( 'No', 'curly-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'enable_excerpt',
			[
				'label'     => esc_html__( 'Enable Excerpt', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'     => esc_html__( 'Excerpt Length', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of characters', 'curly-core' ),
				'condition' => [
					'enable_excerpt' => array( 'yes' )
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'additional_features',
			[
				'label' => esc_html__( 'Additional Features', 'curly-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'pagination_type',
			[
				'label'     => esc_html__( 'Pagination Type', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no-pagination' => esc_html__( 'None', 'curly-core'), 
					'standard' => esc_html__( 'Standard', 'curly-core'), 
					'load-more' => esc_html__( 'Load More', 'curly-core'), 
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'curly-core')
				),
				'default' => 'no-pagination'
			]
		);

		$this->add_control(
			'load_more_top_margin',
			[
				'label'     => esc_html__( 'Load More Top Margin (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'pagination_type' => array( 'load-more' )
				]
			]
		);

		$this->add_control(
			'filter',
			[
				'label'     => esc_html__( 'Enable Category Filter', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'filter_order_by',
			[
				'label'     => esc_html__( 'Filter Order By', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'name' => esc_html__( 'Name', 'curly-core'), 
					'count' => esc_html__( 'Count', 'curly-core'), 
					'id' => esc_html__( 'Id', 'curly-core'), 
					'slug' => esc_html__( 'Slug', 'curly-core')
				),
				'default' => 'name',
				'condition' => [
					'filter' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'filter_text_transform',
			[
				'label'     => esc_html__( 'Filter Text Transform', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'curly-core'), 
					'none' => esc_html__( 'None', 'curly-core'), 
					'capitalize' => esc_html__( 'Capitalize', 'curly-core'), 
					'uppercase' => esc_html__( 'Uppercase', 'curly-core'), 
					'lowercase' => esc_html__( 'Lowercase', 'curly-core'), 
					'initial' => esc_html__( 'Initial', 'curly-core'), 
					'inherit' => esc_html__( 'Inherit', 'curly-core')
				),
				'default' => '',
				'condition' => [
					'filter' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'filter_bottom_margin',
			[
				'label'     => esc_html__( 'Filter Bottom Margin (px or %)', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'filter' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'enable_article_animation',
			[
				'label'     => esc_html__( 'Enable Article Animation', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Enabling this option you will enable appears animation for your portfolio list items', 'curly-core' ),
				'options' => array(
					'no' => esc_html__( 'No', 'curly-core'), 
					'yes' => esc_html__( 'Yes', 'curly-core')
				),
				'default' => 'no'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['type'] = 'masonry';
        $params['item_style'] = 'gallery-overlay';
        $params['portfolio_slider_on'] = 'no';

        /***
         * @params query_results
         * @params holder_data
         * @params holder_classes
         * @params holder_inner_classes
         */
        $additional_params = array();

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);
        $additional_params['query_results'] = $query_results;

        $additional_params['holder_data'] = curly_mkdf_get_holder_data_for_cpt($params, $additional_params);
        $additional_params['holder_classes'] = $this->getHolderClasses($params);
        $additional_params['holder_inner_classes'] = $this->getHolderInnerClasses($params);

        $params['this_object'] = $this;

		echo curly_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-holder', $params['type'], $params, $additional_params);

	}

    public function getQueryArray($params) {
        $query_array = array(
            'post_status' => 'publish',
            'post_type' => 'portfolio-item',
            'posts_per_page' => $params['number_of_items'],
            'orderby' => $params['orderby'],
            'order' => $params['order']
        );

        if (!empty($params['category'])) {
            $query_array['portfolio-category'] = $params['category'];
        }

        $project_ids = null;
        if (!empty($params['selected_projects'])) {
            $project_ids = explode(',', $params['selected_projects']);
            $query_array['post__in'] = $project_ids;
        }

        if (!empty($params['tag'])) {
            $query_array['portfolio-tag'] = $params['tag'];
        }

        if (!empty($params['next_page'])) {
            $query_array['paged'] = $params['next_page'];
        } else {
            $query_array['paged'] = 1;
        }

        return $query_array;
    }

    public function getHolderClasses($params) {
        $classes = array();

        $classes[] = !empty($params['type']) ? 'mkdf-pl-' . $params['type'] : '';
        $classes[] = !empty($params['space_between_items']) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';

        $number_of_columns = $params['number_of_columns'];
        switch ($number_of_columns):
            case '1':
                $classes[] = 'mkdf-pl-one-column';
                break;
            case '2':
                $classes[] = 'mkdf-pl-two-columns';
                break;
            case '3':
                $classes[] = 'mkdf-pl-three-columns';
                break;
            case '4':
                $classes[] = 'mkdf-pl-four-columns';
                break;
            case '5':
                $classes[] = 'mkdf-pl-five-columns';
                break;
            default:
                $classes[] = 'mkdf-pl-three-columns';
                break;
        endswitch;

        $classes[] = !empty($params['item_style']) ? 'mkdf-pl-' . $params['item_style'] : '';
        $classes[] = $params['enable_fixed_proportions'] === 'yes' ? 'mkdf-masonry-images-fixed' : '';
        $classes[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-pl-has-shadow' : '';
        $classes[] = $params['enable_title'] === 'no' && $params['enable_category'] === 'no' && $params['enable_excerpt'] === 'no' ? 'mkdf-pl-no-content' : '';
        $classes[] = !empty($params['pagination_type']) ? 'mkdf-pl-pag-' . $params['pagination_type'] : '';
        $classes[] = $params['filter'] === 'yes' ? 'mkdf-pl-has-filter' : '';
        $classes[] = $params['enable_article_animation'] === 'yes' ? 'mkdf-pl-has-animation' : '';
        $classes[] = !empty($params['navigation_skin']) ? 'mkdf-nav-' . $params['navigation_skin'] . '-skin' : '';
        $classes[] = !empty($params['pagination_skin']) ? 'mkdf-pag-' . $params['pagination_skin'] . '-skin' : '';
        $classes[] = !empty($params['pagination_position']) ? 'mkdf-pag-' . $params['pagination_position'] : '';

        return implode(' ', $classes);
    }

    public function getHolderInnerClasses($params) {
        $classes = array();

        $classes[] = $params['portfolio_slider_on'] === 'yes' ? 'mkdf-owl-slider mkdf-pl-is-slider' : '';

        return implode(' ', $classes);
    }

    public function getArticleClasses($params) {
        $classes = array();

        $type = $params['type'];
        $item_style = $params['item_style'];

        if (get_post_meta(get_the_ID(), "mkdf_portfolio_featured_image_meta", true) !== "" && $item_style === 'standard-switch-images') {
            $classes[] = 'mkdf-pl-has-switch-image';
        } elseif (get_post_meta(get_the_ID(), "mkdf_portfolio_featured_image_meta", true) === "" && $item_style === 'standard-switch-images') {
            $classes[] = 'mkdf-pl-no-switch-image';
        }

        $image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
        $masonry_size = get_post_meta(get_the_ID(), 'mkdf_portfolio_masonry_' . $image_proportion . '_dimensions_meta', true);

        $classes[] = !empty($masonry_size) && $type === 'masonry' ? 'mkdf-masonry-size-' . esc_attr($masonry_size) : '';

        $article_classes = get_post_class($classes);

        return implode(' ', $article_classes);
    }

    public function getImageSize($params) {
        $thumb_size = 'full';

        if (!empty($params['image_proportions']) && $params['type'] == 'gallery') {
            $image_size = $params['image_proportions'];

            switch ($image_size) {
                case 'landscape':
                    $thumb_size = 'curly_mkdf_landscape';
                    break;
                case 'portrait':
                    $thumb_size = 'curly_mkdf_portrait';
                    break;
                case 'square':
                    $thumb_size = 'curly_mkdf_square';
                    break;
                case 'medium':
                    $thumb_size = 'medium';
                    break;
                case 'large':
                    $thumb_size = 'large';
                    break;
                case 'full':
                    $thumb_size = 'full';
                    break;
            }
        }

        if ($params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes') {
            $fixed_image_size = get_post_meta(get_the_ID(), 'mkdf_portfolio_masonry_fixed_dimensions_meta', true);

            switch ($fixed_image_size) {
                case 'small' :
                    $thumb_size = 'curly_mkdf_square';
                    break;
                case 'large-width':
                    $thumb_size = 'curly_mkdf_landscape';
                    break;
                case 'large-height':
                    $thumb_size = 'curly_mkdf_portrait';
                    break;
                case 'large-width-height':
                    $thumb_size = 'curly_mkdf_huge';
                    break;
                default :
                    $thumb_size = 'full';
                    break;
            }
        }

        return $thumb_size;
    }

    public function getStandardContentStyles($params) {
        $styles = array();

        $margin_top = isset($params['content_top_margin']) ? $params['content_top_margin'] : '';
        $margin_bottom = isset($params['content_bottom_margin']) ? $params['content_bottom_margin'] : '';

        if (!empty($margin_top)) {
            if (curly_mkdf_string_ends_with($margin_top, '%') || curly_mkdf_string_ends_with($margin_top, 'px')) {
                $styles[] = 'margin-top: ' . $margin_top;
            } else {
                $styles[] = 'margin-top: ' . curly_mkdf_filter_px($margin_top) . 'px';
            }
        }

        if (!empty($margin_bottom)) {
            if (curly_mkdf_string_ends_with($margin_bottom, '%') || curly_mkdf_string_ends_with($margin_bottom, 'px')) {
                $styles[] = 'margin-bottom: ' . $margin_bottom;
            } else {
                $styles[] = 'margin-bottom: ' . curly_mkdf_filter_px($margin_bottom) . 'px';
            }
        }

        return implode(';', $styles);
    }

    public function getTitleStyles($params) {
        $styles = array();

        if (!empty($params['title_text_transform'])) {
            $styles[] = 'text-transform: ' . $params['title_text_transform'];
        }

        return implode(';', $styles);
    }

    public function getSwitchFeaturedImage() {
        $featured_image_meta = get_post_meta(get_the_ID(), 'mkdf_portfolio_featured_image_meta', true);

        $featured_image = !empty($featured_image_meta) ? esc_url($featured_image_meta) : '';

        return $featured_image;
    }

    public function getLoadMoreStyles($params) {
        $styles = array();

        if (!empty($params['load_more_top_margin'])) {
            $margin = $params['load_more_top_margin'];

            if (curly_mkdf_string_ends_with($margin, '%') || curly_mkdf_string_ends_with($margin, 'px')) {
                $styles[] = 'margin-top: ' . $margin;
            } else {
                $styles[] = 'margin-top: ' . curly_mkdf_filter_px($margin) . 'px';
            }
        }

        return implode(';', $styles);
    }

    public function getFilterCategories($params) {
        $cat_id = 0;

        if (!empty($params['category'])) {
            $top_category = get_term_by('slug', $params['category'], 'portfolio-category');

            if (isset($top_category->term_id)) {
                $cat_id = $top_category->term_id;
            }
        }

        $order = $params['filter_order_by'] === 'count' ? 'DESC' : 'ASC';

        $args = array(
            'taxonomy' => 'portfolio-category',
            'child_of' => $cat_id,
            'orderby' => $params['filter_order_by'],
            'order' => $order
        );

        $filter_categories = get_terms($args);

        return $filter_categories;
    }

    public function getFilterHolderStyles($params) {
        $styles = array();

        if (!empty($params['filter_bottom_margin'])) {
            $margin = $params['filter_bottom_margin'];

            if (curly_mkdf_string_ends_with($margin, '%') || curly_mkdf_string_ends_with($margin, 'px')) {
                $styles[] = 'margin-bottom: ' . $margin;
            } else {
                $styles[] = 'margin-bottom: ' . curly_mkdf_filter_px($margin) . 'px';
            }
        }

        return implode(';', $styles);
    }

    public function getFilterStyles($params) {
        $styles = array();

        if (!empty($params['filter_text_transform'])) {
            $styles[] = 'text-transform: ' . $params['filter_text_transform'];
        }

        return implode(';', $styles);
    }

    public function getItemLink() {
        $portfolio_link_meta = get_post_meta(get_the_ID(), 'portfolio_external_link', true);
        $portfolio_link = !empty($portfolio_link_meta) ? $portfolio_link_meta : get_permalink(get_the_ID());

        return apply_filters('curly_mkdf_portfolio_external_link', $portfolio_link);
    }

    public function getItemLinkTarget() {
        $portfolio_link_meta = get_post_meta(get_the_ID(), 'portfolio_external_link', true);
        $portfolio_link_target = !empty($portfolio_link_meta) ? '_blank' : '_self';

        return apply_filters('curly_mkdf_portfolio_external_link_target', $portfolio_link_target);
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorPortfolioList() );