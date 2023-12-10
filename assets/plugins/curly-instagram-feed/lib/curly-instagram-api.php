<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include 'curly-instagram-helper.php';

/**
 * Class CurlyInstagramApi
 */
class CurlyInstagramApi {
	private $instagramClientID;
	private $instagramSecret;
	private $instagramRedirectUri;
	private $instagramCode;
	private $instagramUserID;
	private $instagramAccessToken;
	private $instagramAccessTokenLongLived;

	private $facebookClientID;
	private $facebookSecret;
	private $facebookRedirectUri;
	private $facebookCode;
	private $facebookAccessToken;

	private static $instance;
	private $helper;

	const INSTAGRAM_CODE = 'curly_instagram_code';
	const INSTAGRAM_USER_ID = 'curly_instagram_user_id';
	const INSTAGRAM_TOKEN = 'curly_instagram_access_token';
	const INSTAGRAM_TOKEN_LONG_LIVED = 'curly_instagram_access_token_long_lived';
	const INSTAGRAM_TOKEN_LONG_LIVED_TIME = 'curly_instagram_access_token_long_lived_time';

	const FACEBOOK_CODE = 'curly_facebook_code';
	const FACEBOOK_TOKEN = 'curly_facebook_access_token';

	const CONNECTION_TYPE = 'curly_connection_type';

	/**
	 * Private constructor because of singletone pattern. It sets all necessary properties
	 */
	public function __construct() {
		$this->instagramClientID             = '3961337950544094';
		$this->instagramSecret               = 'c40450f40895f8862b216aa46495f308';
		$this->instagramRedirectUri          = 'https://demo.qodeinteractive.com/instagram-app/instagram-redirect.php';
		$this->instagramCode                 = get_option( self::INSTAGRAM_CODE );
		$this->instagramUserID               = get_option( self::INSTAGRAM_USER_ID );
		$this->instagramAccessToken          = get_option( self::INSTAGRAM_TOKEN );
		$this->instagramAccessTokenLongLived = get_option( self::INSTAGRAM_TOKEN_LONG_LIVED );

		$this->facebookClientID    = '132128361763786';
		$this->facebookSecret      = '';
		$this->facebookRedirectUri = 'https://demo.qodeinteractive.com/facebook-app/facebook-redirect.php';
		$this->facebookCode        = '';
		$this->facebookAccessToken = get_option( self::FACEBOOK_TOKEN );

		$this->helper = new CurlyInstagramHelper();
	}

	/**
	 * @return CurlyInstagramApi
	 */
	public static function getInstance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @return CurlyInstagramHelper
	 */
	public function getHelper() {
		return $this->helper;
	}

	/**
	 * Builds current page url that we use to redirect user to the page from which
	 * he made request to sign in to Instagram.
	 * @return string
	 */
	public function buildCurrentPageURI() {
		$protocol = is_ssl() ? 'https' : 'http';
		$site     = $_SERVER['SERVER_NAME'];
		$slug     = $_SERVER['REQUEST_URI'];

		$replacedSlug = str_replace('page=', 'page***', $slug);

		return urlencode( $protocol . '://' . $site . $replacedSlug );
	}

	/**
	 * Saves code that will be used when requesting token
	 */
	public function instagramStoreCode() {
		if ( ! empty( $_GET['code'] ) ) {
			$this->instagramCode = $_GET['code'];
			update_option( self::INSTAGRAM_CODE, $_GET['code'] );
		}
	}

	/**
	 * Saves code that will be used when requesting token
	 */
	public function facebookStoreToken() {
		if ( ! empty( $_GET['access_token'] ) ) {
			$this->instagramCode = $_GET['access_token'];
			update_option( self::FACEBOOK_TOKEN, $_GET['access_token'] );
		}
	}

	/**
	 * Saves code that will be used when requesting token
	 */
	public function setConnectionType( $type = '' ) {
		if ( ! empty( $type ) ) {
			update_option( self::CONNECTION_TYPE, $type );
		}
	}

	/**
	 * Retrieves images data from Instagram
	 *
	 * @param int   $limit
	 * @param array $transient transient config
	 *
	 * @return mixed returns either array of retrieved data if request was successful, or it returns false if it wasn't
	 *
	 * @see CurlyInstagramApi::fetchData()
	 */
	public function getImages( $limit = '', $transient = array() ) {
		$response = $this->fetchData( $limit, $transient );

		if ( property_exists( $response, 'status' ) && $response->status == 'ok' ) {
			return $response->data;
		}

		return false;
	}

	/**
	 * Gets requested data from Instagram API
	 *
	 * @param int   $limit how much images to retrieve
	 * @param array $transient transient config
	 *
	 * @return stdClass
	 *
	 * @see CurlyInstagramApi::instagramExchangeCodeForToken()
	 */
	private function fetchData( $limit = '', $transient = array( 'use_transient' => false ) ) {

		// refresh token
		if ( get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME ) && get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME ) < strtotime( '1 month ago' ) ) {

			//long lived refresh
			$long_lived_url        = wp_remote_get( 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=' . $this->instagramAccessTokenLongLived );
			$longLivedHttpResponse = wp_remote_retrieve_body( $long_lived_url );
			$longLivedHttpBody     = json_decode( $longLivedHttpResponse, true );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED, $longLivedHttpBody['access_token'] );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME, strtotime( 'now' ) );
		}

		$returnObject = new stdClass();
		//do we use transient and does it exists in the database?
		if ( $this->useTransients( $transient ) && get_transient( $transient['transient_name'] ) ) {
			//get transient value
			$data = get_transient( $transient['transient_name'] );

		} else {

			if ( get_option( self::CONNECTION_TYPE ) === 'instagram' ) {
				if ( get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME ) ) {
					$url = wp_remote_get( 'https://graph.instagram.com/me/media?fields=media_url,caption,permalink,media_type,thumbnail_url&access_token=' . $this->instagramAccessTokenLongLived . '&count=' . $limit );
				} else {
					$url = wp_remote_get('https://graph.instagram.com/me/media?fields=media_url,caption,permalink,media_type,thumbnail_url&access_token=' . $this->instagramAccessToken . '&count=' . $limit);
				}
			} else if ( get_option( self::CONNECTION_TYPE ) === 'facebook' ) {
				$url = wp_remote_get( 'https://graph.facebook.com/v8.0/me/accounts?access_token=' . $this->facebookAccessToken );
			} else {
				$url = '';
			}

			//request data from API
			$httpResponse = wp_remote_retrieve_body( $url );

			//is response an error
			if ( is_wp_error( $httpResponse ) ) {
				$returnObject->status  = 'error';
				$returnObject->message = 'Can\'t connect with Instagram';

				return $returnObject;
			}

			//parse returned JSON response to assoc array
			$httpBody = json_decode( $httpResponse, true );

			//if response code is something different than ok?
			if ( ! isset( $httpBody ) ) {
				$returnObject->status  = 'error';
				$returnObject->message = 'Can\'t connect with Instagram';

				return $returnObject;
			}

			$data = array();
			if ( get_option( self::CONNECTION_TYPE ) === 'instagram' && isset( $httpBody['data'] ) ) {
				$data = $httpBody['data'];
			}

			if ( get_option( self::CONNECTION_TYPE ) === 'facebook' ) {
				$data = array();

				if ( isset( $httpBody['data'] ) ) {
					foreach ( $httpBody['data'] as $singleIG ) {
						$pageID        = $singleIG['id']; // it can get more pages - we take first one
						$pages_url     = wp_remote_get( 'https://graph.facebook.com/v8.0/' . $pageID . '?fields=instagram_business_account&access_token=' . $this->facebookAccessToken );
						$pagesResponse = wp_remote_retrieve_body( $pages_url );
						$pagesBody     = json_decode( $pagesResponse, true );

						if ( isset ( $pagesBody['instagram_business_account'] ) ) {
							$instagramID   = implode( $pagesBody['instagram_business_account'] );//probably it can have more accounts also
							$getMedia      = wp_remote_get( 'https://graph.facebook.com/v8.0/' . $instagramID . '/media?access_token=' . $this->facebookAccessToken );
							$mediaResponse = wp_remote_retrieve_body( $getMedia );
							$mediaBody     = json_decode( $mediaResponse, true );
							$multipleImage = $mediaBody['data'];

							foreach ( $multipleImage as $singleImageID ) {
								$singleImage         = wp_remote_get( 'https://graph.facebook.com/v8.0/' . $singleImageID['id'] . '?fields=media_url,caption,permalink,media_type,thumbnail_url,username&access_token=' . $this->facebookAccessToken );
								$singleImageResponse = wp_remote_retrieve_body( $singleImage );
								$singleImageBody     = json_decode( $singleImageResponse, true );
								$data[]              = $singleImageBody;
							}
						}
					}
				}
			}

			//do we use transients?
			if ( $this->useTransients( $transient ) ) {
				//store transient so we can use it later
				set_transient( $transient['transient_name'], $data, $transient['transient_time'] );
			}
		}

		if ( ( count( $data ) > $limit ) && $limit !== '' ) {
			$data = array_slice( $data, 0, $limit );
		}

		//prepare return object and return it
		$returnObject->status  = 'ok';
		$returnObject->message = 'Success';
		$returnObject->data    = $data;

		return $returnObject;
	}

	/**
	 * Gets access token from Instagram auth based on code that we retrieved when user allowed us access
	 * @return stdClass return object. Contains status attribute and message attribute
	 */
	public function instagramExchangeCodeForToken() {
		$returnObject = new stdClass();

		//if code property is empty, user hasn't allowed us access
		if ( empty( $this->instagramCode ) ) {
			$returnObject->status  = 'error';
			$returnObject->message = 'User has\'nt connected with Instagram';

			return $returnObject;
		} else {

			$getTokenArgs = array(
				'body' => array(
					'client_id'     => $this->instagramClientID,
					'client_secret' => $this->instagramSecret,
					'grant_type'    => 'authorization_code',
					'redirect_uri'  => $this->instagramRedirectUri,
					'code'          => $this->instagramCode,
				)
			);

			//request access token from Instagram
			$httpResponse = wp_remote_post( 'https://api.instagram.com/oauth/access_token', $getTokenArgs );

			//check if response wasn't successful
			if ( is_wp_error( $httpResponse ) || ( isset( $httpResponse['response']['code'] ) && $httpResponse['response']['code'] !== 200 ) ) {
				$returnObject->status  = 'error';
				$returnObject->message = 'Can\t connect with Instagram API';

				return $returnObject;
			}

			//parse json response from API to assoc array
			$responseBody = json_decode( $httpResponse['body'], true, 512, JSON_BIGINT_AS_STRING);

			//if access token was returned store it to database. Also store user id
			if ( isset( $responseBody['user_id'] ) && isset( $responseBody['access_token'] ) ) {
				update_option( self::INSTAGRAM_USER_ID, $responseBody['user_id'] );
				update_option( self::INSTAGRAM_TOKEN, $responseBody['access_token'] );

				//long lived
				$long_lived_url        = wp_remote_get( 'https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret=' . $this->instagramSecret . '&access_token=' . $responseBody['access_token'] );
				$longLivedHttpResponse = wp_remote_retrieve_body( $long_lived_url );
				$longLivedHttpBody     = json_decode( $longLivedHttpResponse, true );
				update_option( self::INSTAGRAM_TOKEN_LONG_LIVED, $longLivedHttpBody['access_token'] );
				update_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME, strtotime( 'now' ) );
			} else {
				$returnObject->status  = 'error';
				$returnObject->message = 'Can\t get Instagram access token';

				return $returnObject;
			}
		}

		//prepare return object and return it
		$returnObject->status  = 'ok';
		$returnObject->message = 'Stored access token';

		return $returnObject;
	}

	/**
	 * Build disonnect url
	 * @return bool
	 */
	public function disconnectURL() {
		$protocol = is_ssl() ? 'https' : 'http';
		$site     = $_SERVER['SERVER_NAME'];
		$slug     = $_SERVER['REQUEST_URI'];

		return $protocol . '://' . $site . $slug . '&disconnect=yes';
	}

	/**
	 * Build reload url
	 * @return bool
	 */
	public function reloadURL() {
		$protocol = is_ssl() ? 'https' : 'http';
		$site     = $_SERVER['SERVER_NAME'];
		$slug     = $_SERVER['REQUEST_URI'];
		$slug     = strstr($slug, '&', true);

		return $protocol . '://' . $site . $slug;
	}

	/**
	 * Check reset database fields
	 * @return bool
	 */
	public function disconnect() {
		if ( ! empty( $_GET['disconnect'] ) ) {
			update_option( self::INSTAGRAM_CODE, '' );
			update_option( self::INSTAGRAM_USER_ID, '' );
			update_option( self::INSTAGRAM_TOKEN, '' );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED, '' );
			update_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME, '' );
			update_option( self::FACEBOOK_CODE, '' );
			update_option( self::FACEBOOK_TOKEN, '' );
			update_option( self::CONNECTION_TYPE, '' );
		}

		return '';
	}

	/**
	 * Check if user has authorized our application
	 * @return bool
	 */
	public function hasUserConnected() {
		$accessTokenIG = get_option( self::INSTAGRAM_TOKEN_LONG_LIVED_TIME );
		$accessTokenFB = get_option( self::FACEBOOK_TOKEN );

		return ! empty( $accessTokenIG ) || ! empty( $accessTokenFB );
	}

	/**
	 * Checks whether transient config array is set to use transients or not
	 *
	 * @param $transientConfig associative array of transient configuration
	 *
	 * @return bool
	 */
	private function useTransients( $transientConfig ) {
		return ( isset( $transientConfig['use_transients'] ) && $transientConfig['use_transients'] ) && ( ! empty( $transientConfig['transient_time'] ) );
	}

	/**
	 * Generates authorize URL which is used to allow access to our application and get instagram code
	 * @return string
	 */
	public function instagramRequestCode() {
		return 'https://api.instagram.com/oauth/authorize?client_id=' . $this->instagramClientID . '&redirect_uri=' . $this->instagramRedirectUri . '&response_type=code&scope={user_profile,user_media}' . '&state=' . $this->buildCurrentPageURI();
	}

	/**
	 * Generates authorize URL which is used to allow access to our application and get instagram code
	 * @return string
	 */
	public function facebookRequestCode() {
		return 'https://www.facebook.com/dialog/oauth?client_id=' . $this->facebookClientID . '&redirect_uri=' . $this->facebookRedirectUri . '&response_type=token&scope={instagram_basic,pages_show_list,pages_read_engagement}' . '&state=' . $this->buildCurrentPageURI();
	}
}
