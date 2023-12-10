<?php

class CurlyTwitterFeedElementorTwitterList extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mkdf_twitter_list';
    }

    public function get_title() {
        return esc_html__( 'Twitter List', 'curly-twitter-feed' );
    }

    public function get_icon() {
        return 'curly-elementor-custom-icon curly-elementor-twitter-list';
    }

    public function get_categories() {
        return [ 'mikado' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'curly-twitter-feed' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'user_id',
			[
				'label'       => esc_html__( 'User ID', 'curly-twitter-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
            'number_of_columns',
            [
                'label'       => esc_html__( 'Number of Columns', 'curly-twitter-feed' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__('One', 'curly-twitter-feed'),
					'2' => esc_html__('Two', 'curly-twitter-feed'),
					'3' => esc_html__('Three', 'curly-twitter-feed'),
					'4' => esc_html__('Four', 'curly-twitter-feed'),
					'5' => esc_html__('Five', 'curly-twitter-feed')
				),
                'default'     => '3'
            ]
        );

        $this->add_control(
            'space_between_columns',
            [
                'label'   => esc_html__( 'Space Between Items', 'curly-twitter-feed' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => curly_mkdf_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'number_of_tweets',
            [
                'label'       => esc_html__( 'Number of Tweets', 'curly-twitter-feed' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
            ]
        );

		$this->add_control(
			'transient_time',
			[
				'label'       => esc_html__( 'Tweets Cache Time', 'curly-twitter-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => ''
			]
		);

        $this->end_controls_section();
    }

    public function render() {

		$params = $this->get_settings_for_display();
		extract($params);
		$params['holder_classes'] = $this->getHolderClasses( $params );

		$twitter_api = new \CurlyTwitterApi();
		$params['twitter_api'] = $twitter_api;

		if ($twitter_api->hasUserConnected()) {
			$response = $twitter_api->fetchTweets($user_id, $number_of_tweets, array(
				'transient_time' => $transient_time,
				'transient_id' => 'mkdf_twitter_' . rand(0, 1000)
			));

			$params['response'] = $response;
		}

		//Get HTML from template based on type of team
		echo curly_twitter_get_shortcode_module_template_part( 'holder', 'twitter-list', '', $params );
    }

	public function getHolderClasses($params) {
		$holderClasses = array();

		$holderClasses[] = $this->getColumnNumberClass($params['number_of_columns']);
		$holderClasses[] = !empty($params['space_between_columns']) ? 'mkdf-' . $params['space_between_columns'] . '-space' : 'mkdf-tl-normal-space';

		return implode(' ', $holderClasses);
	}

	public function getColumnNumberClass($params) {
		switch ($params) {
			case 1:
				$classes = 'mkdf-tl-one-column';
				break;
			case 2:
				$classes = 'mkdf-tl-two-columns';
				break;
			case 3:
				$classes = 'mkdf-tl-three-columns';
				break;
			case 4:
				$classes = 'mkdf-tl-four-columns';
				break;
			case 5:
				$classes = 'mkdf-tl-five-columns';
				break;
			default:
				$classes = 'mkdf-tl-three-columns';
				break;
		}

		return $classes;
	}

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyTwitterFeedElementorTwitterList() );