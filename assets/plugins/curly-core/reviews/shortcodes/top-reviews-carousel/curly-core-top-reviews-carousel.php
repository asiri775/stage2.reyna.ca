<?php
class CurlyCoreElementorCurlyCoreTopReviewsCarousel extends \Elementor\Widget_Base {

	public function get_name() {
		return 'curly_core_top_reviews_carousel'; 
	}

	public function get_title() {
		return esc_html__( 'Top Reviews Carousel', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-curly-core-top-reviews-carousel';
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
			'title',
			[
				'label'     => esc_html__( 'Title', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'number_of_reviews',
			[
				'label'     => esc_html__( 'Number of Reviews', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Leave empty for all', 'curly-core' )
			]
		);

		$this->add_control(
			'review_criteria',
			[
				'label'     => esc_html__( 'Order by Review Criteria', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'mkdf_global_rating' => esc_html__( 'Rating', 'curly-core')
				),
				'default' => 'mkdf_global_rating'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();



        $params['reviews'] = $this->getTopReviews($params);
        $params['this_shortcode'] = $this;

        echo curly_core_get_module_shortcode_template_part('reviews', 'top-reviews-carousel', 'top-reviews-carousel', '', $params);
	}

    public function getTopReviews($params) {
        $number = isset($params['number_of_reviews']) ? $params['number_of_reviews'] : '';

        $args = array(
            'status' => 'approve',
            'number' => $number
        );

        if (isset($params['review_criteria']) && !empty($params['review_criteria'])) {
            $meta_query = array();

            $meta_query[] = array(
                'key' => $params['review_criteria'],
                'compare' => 'EXISTS'
            );
            $args['meta_query'] = $meta_query;
            $args['orderby'] = 'meta_value';
        }

        $comments = get_comments($args);

        return $comments;
    }

    public function generateItemParams($params) {
        $comment = $params['comment'];
        $new_comment = array();
        $new_comment['comment_id'] = $comment->comment_ID;
        $new_comment['post_link'] = get_the_permalink($comment->comment_post_ID);
        $new_comment['post_title'] = get_the_title($comment->comment_post_ID);
        $new_comment['comment_text'] = get_comment_text($comment->comment_ID);
        $new_comment['auhtor_email'] = $comment->comment_author_email;

        if (isset($params['review_criteria']) && !empty($params['review_criteria'])) {
            $new_comment['review_value'] = get_comment_meta($comment->comment_ID, $params['review_criteria'], true);
        }

        return $new_comment;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorCurlyCoreTopReviewsCarousel() );