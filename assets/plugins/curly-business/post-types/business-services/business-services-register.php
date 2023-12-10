<?php
namespace CurlyBusiness\CPT\BusinessServices;

use CurlyBusiness\Lib;

/**
 * Class BusinessServicesRegister
 * @package CurlyBusiness\CPT\BusinessServices
 */
class BusinessServicesRegister implements Lib\PostTypeInterface
{
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base = 'business-services';
        $this->taxBase = 'business-services-category';
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    public function register() {
	    if (curly_business_theme_installed() && (curly_business_core_plugin_installed() ? curly_core_is_theme_registered() : false)) {
		    $this->registerPostType();
		    $this->registerTax();
	    }
    }

    /**
     * Regsiters custom post type with WordPress
     */
    private function registerPostType() {

        $menuPosition = 5;
        $menuIcon = 'dashicons-list-view';

        register_post_type($this->base,
            array(
                'labels' => array(
                    'name' => __('Business Services', 'curly-business'),
                    'menu_name' => __('Business Services', 'curly-business'),
                    'all_items' => __('Business Services Items', 'curly-business'),
                    'add_new' => __('Add New Business Services Item', 'curly-business'),
                    'singular_name' => __('Business Services Item', 'curly-business'),
                    'add_item' => __('New Business Services Item', 'curly-business'),
                    'add_new_item' => __('Add New Business Services Item', 'curly-business'),
                    'edit_item' => __('Edit Business Services Item', 'curly-business')
                ),
                'public' => false,
                'show_in_menu' => true,
                'menu_position' => $menuPosition,
                'show_ui' => true,
                'has_archive' => false,
                'hierarchical' => false,
                'supports' => array('title', 'thumbnail'),
                'menu_icon' => $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __('Business Services Category', 'curly-business'),
            'singular_name' => __('Business Services Category', 'curly-business'),
            'search_items' => __('Search Business Services Categories', 'curly-business'),
            'all_items' => __('All Business Services Categories', 'curly-business'),
            'parent_item' => __('Parent Business Services Category', 'curly-business'),
            'parent_item_colon' => __('Parent Business Services Category:', 'curly-business'),
            'edit_item' => __('Edit Business Services Category', 'curly-business'),
            'update_item' => __('Update Business Services Category', 'curly-business'),
            'add_new_item' => __('Add New Business Services Category', 'curly-business'),
            'new_item_name' => __('New Business Services Category Name', 'curly-business'),
            'menu_name' => __('Business Services Categories', 'curly-business'),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => true,
        ));
    }
}