<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CurlyInstagramHelper
 */
class CurlyInstagramHelper {
	/**
	 * Generates HTML for given image from Instagram feed. Defines curly_instagram_image_atts filter
	 *
	 * @param $image associative array of image informations
	 * @param $imageSize image size that we want to show
	 *
	 * @return string generated HTML string
	 */
	public function getImageHTML( $image ) {
		$atts = '';

		$imageAtts = apply_filters( 'curly_instagram_image_atts',
			array(
				'src'   => $this->getImageSrc( $image ),
				'alt'   => $this->getImageAlt( $image ),
			) );

		if ( is_array( $imageAtts ) && count( $imageAtts ) ) {
			foreach ( $imageAtts as $attName => $attValue ) {
				$atts .= $attName . '="' . $attValue . '" ';
			}
		}

		return '<img ' . $atts . ' />';
	}

	/**
	 * Returns URL to Instagram image
	 *
	 * @param        $imageArr associative array of image informations
	 * @param string $size image size that we want to show
	 *
	 * @return string URL to Instagram image
	 */
	public function getImageSrc( $imageArr ) {

		if ( isset( $imageArr['thumbnail_url'] ) ) {
			return $imageArr['thumbnail_url'];
		} else if ( isset( $imageArr['media_url'] ) ) {
			return $imageArr['media_url'];
		} else {
			return '';
		}
	}

	/**
	 * Returns image description
	 *
	 * @param $imageArr associative array of image informations
	 *
	 * @return string image alt text
	 */
	public function getImageAlt( $imageArr ) {

		if ( isset( $imageArr['caption'] ) ) {
			return $imageArr['caption'];
		} else {
			return '';
		}
	}

	/**
	 * Returns a link to instagram image
	 *
	 * @param $imageArr
	 *
	 * @return string
	 */
	public function getImageLink( $imageArr ) {

		if ( isset( $imageArr['permalink'] ) ) {
			return $imageArr['permalink'];
		} else {
			return '';
		}
	}
}
