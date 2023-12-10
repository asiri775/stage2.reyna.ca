<?php
class CurlyCoreElementorSocialShare extends \Elementor\Widget_Base {
	private $socialNetworks;

	public function __construct(  $data = [], $args = null ) {
		parent::__construct( $data, $args );

		$this->socialNetworks = array(
			'facebook',
			'twitter',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk'
		);
	}

	public function get_name() {
		return 'mkdf_social_share'; 
	}

	public function get_title() {
		return esc_html__( 'Social Share', 'curly-core' );
	}

	public function get_icon() {
		return 'curly-elementor-custom-icon curly-elementor-social-share';
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
			'type',
			[
				'label'     => esc_html__( 'Type', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'list' => esc_html__( 'List', 'curly-core'), 
					'dropdown' => esc_html__( 'Dropdown', 'curly-core')
				),
				'default' => 'list'
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'     => esc_html__( 'Icons Type', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'font-awesome' => esc_html__( 'Font Awesome', 'curly-core')
				),
				'default' => 'font-awesome'
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Social Share Title', 'curly-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => array( 'list' )
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        //Is social share enabled
        $params['enable_social_share'] = (curly_mkdf_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;

        //Is social share enabled for post type
        $post_type = get_post_type();
        $params['enabled'] = (curly_mkdf_options()->getOptionValue('enable_social_share_on_' . $post_type) == 'yes') ? true : false;

        //Social Networks Data
        $params['networks'] = $this->getSocialNetworksParams($params);

        $html = '';

        if ($params['enable_social_share']) {
            if ($params['enabled']) {
                $html .= curly_core_get_shortcode_module_template_part('templates/' . $params['type'], 'social-share', '', $params);
            }
        }

        echo curly_mkdf_display_content_output($html);
	}

    public function getSocialNetworks() {
        return $this->socialNetworks;
    }

    private function getSocialNetworksParams($params) {
        $networks = array();
        $icons_type = $params['icon_type'];

        foreach ($this->socialNetworks as $net) {
            $html = '';

            if (curly_mkdf_options()->getOptionValue('enable_' . $net . '_share') == 'yes') {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                $params = array(
                    'name' => $net
                );
                $params['link'] = $this->getSocialNetworkShareLink($net, $image);
                $params['icon'] = $this->getSocialNetworkIcon($net, $icons_type);
                $params['custom_icon'] = (curly_mkdf_options()->getOptionValue($net . '_icon')) ? curly_mkdf_options()->getOptionValue($net . '_icon') : '';

                $html = curly_core_get_shortcode_module_template_part('templates/parts/network', 'social-share', '', $params);
            }

            $networks[$net] = $html;
        }

        return $networks;
    }

    private function getSocialNetworkShareLink($net, $image) {
        switch ($net) {
            case 'facebook':
                if (wp_is_mobile()) {
                    $link = 'window.open(\'http://m.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\');';
                } else {
                    $link = 'window.open(\'http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
                }
                break;
            case 'twitter':
                $count_char = (isset($_SERVER['https'])) ? 23 : 22;
                $twitter_via = (curly_mkdf_options()->getOptionValue('twitter_via') !== '') ? ' via ' . curly_mkdf_options()->getOptionValue('twitter_via') . ' ' : '';
				$link        = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( curly_mkdf_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . ' ' . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				break;
            case 'linkedin':
                $link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'tumblr':
                $link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'pinterest':
                $link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . sanitize_title(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'vk':
                $link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            default:
                $link = '';
        }

        return $link;
    }

    private function getSocialNetworkIcon($net, $type) {
        switch ($net) {
            case 'facebook':
                $icon = ($type == 'font-elegant') ? 'social_facebook' : 'fa fa-facebook';
                break;
            case 'twitter':
                $icon = ($type == 'font-elegant') ? 'social_twitter' : 'fa fa-twitter';
                break;
            case 'linkedin':
                $icon = ($type == 'font-elegant') ? 'social_linkedin' : 'fa fa-linkedin';
                break;
            case 'tumblr':
                $icon = ($type == 'font-elegant') ? 'social_tumblr' : 'fa fa-tumblr';
                break;
            case 'pinterest':
                $icon = ($type == 'font-elegant') ? 'social_pinterest' : 'fa fa-pinterest';
                break;
            case 'vk':
                $icon = 'fa fa-vk';
                break;
            default:
                $icon = '';
        }

        return $icon;
    }

}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CurlyCoreElementorSocialShare() );