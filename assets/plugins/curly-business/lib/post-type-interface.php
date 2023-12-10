<?php
namespace CurlyBusiness\Lib;

/**
 * interface PostTypeInterface
 * @package CurlyBusiness\Lib;
 */
interface PostTypeInterface
{
    /**
     * @return string
     */
    public function getBase();

    /**
     * Registers custom post type with WordPress
     */
    public function register();
}