<?php

namespace CurlyCore\Lib;

/**
 * interface PostTypeInterface
 * @package CurlyCore\Lib;
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