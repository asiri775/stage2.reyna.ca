<?php

if (!function_exists('curly_mkdf_content_responsive_styles')) {
    /**
     * Generates content responsive custom styles
     */
    function curly_mkdf_content_responsive_styles() {
        $content_style = array();

        $padding_mobile = curly_mkdf_options()->getOptionValue('content_padding_mobile');
        if ($padding_mobile !== '') {
            $content_style['padding'] = $padding_mobile;
        }

        $content_selector = array(
            '.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
            '.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
        );

        echo curly_mkdf_dynamic_css($content_selector, $content_style);
    }

    add_action('curly_mkdf_style_dynamic_responsive_1024', 'curly_mkdf_content_responsive_styles');
}

if (!function_exists('curly_mkdf_h1_responsive_styles3')) {
    function curly_mkdf_h1_responsive_styles3() {
        $selector = array(
            'h1'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h1_responsive', '_3');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_768_1024', 'curly_mkdf_h1_responsive_styles3');
}

if (!function_exists('curly_mkdf_h2_responsive_styles3')) {
    function curly_mkdf_h2_responsive_styles3() {
        $selector = array(
            'h2'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h2_responsive', '_3');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_768_1024', 'curly_mkdf_h2_responsive_styles3');
}

if (!function_exists('curly_mkdf_h3_responsive_styles3')) {
    function curly_mkdf_h3_responsive_styles3() {
        $selector = array(
            'h3'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h3_responsive', '_3');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_768_1024', 'curly_mkdf_h3_responsive_styles3');
}

if (!function_exists('curly_mkdf_h4_responsive_styles3')) {
    function curly_mkdf_h4_responsive_styles3() {
        $selector = array(
            'h4'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h4_responsive', '_3');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_768_1024', 'curly_mkdf_h4_responsive_styles3');
}

if (!function_exists('curly_mkdf_h5_responsive_styles3')) {
    function curly_mkdf_h5_responsive_styles3() {
        $selector = array(
            'h5'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h5_responsive', '_3');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_768_1024', 'curly_mkdf_h5_responsive_styles3');
}

if (!function_exists('curly_mkdf_h6_responsive_styles3')) {
    function curly_mkdf_h6_responsive_styles3() {
        $selector = array(
            'h6'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h6_responsive', '_3');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_768_1024', 'curly_mkdf_h6_responsive_styles3');
}

if (!function_exists('curly_mkdf_h1_responsive_styles')) {
    function curly_mkdf_h1_responsive_styles() {
        $selector = array(
            'h1'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h1_responsive');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680_768', 'curly_mkdf_h1_responsive_styles');
}

if (!function_exists('curly_mkdf_h2_responsive_styles')) {
    function curly_mkdf_h2_responsive_styles() {
        $selector = array(
            'h2'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h2_responsive');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680_768', 'curly_mkdf_h2_responsive_styles');
}

if (!function_exists('curly_mkdf_h3_responsive_styles')) {
    function curly_mkdf_h3_responsive_styles() {
        $selector = array(
            'h3'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h3_responsive');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680_768', 'curly_mkdf_h3_responsive_styles');
}

if (!function_exists('curly_mkdf_h4_responsive_styles')) {
    function curly_mkdf_h4_responsive_styles() {
        $selector = array(
            'h4'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h4_responsive');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680_768', 'curly_mkdf_h4_responsive_styles');
}

if (!function_exists('curly_mkdf_h5_responsive_styles')) {
    function curly_mkdf_h5_responsive_styles() {
        $selector = array(
            'h5'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h5_responsive');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680_768', 'curly_mkdf_h5_responsive_styles');
}

if (!function_exists('curly_mkdf_h6_responsive_styles')) {
    function curly_mkdf_h6_responsive_styles() {
        $selector = array(
            'h6'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h6_responsive');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680_768', 'curly_mkdf_h6_responsive_styles');
}

if (!function_exists('curly_mkdf_text_responsive_styles')) {
    function curly_mkdf_text_responsive_styles() {
        $selector = array(
            'body',
            'p'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('text', '_res1');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680_768', 'curly_mkdf_text_responsive_styles');
}

if (!function_exists('curly_mkdf_h1_responsive_styles2')) {
    function curly_mkdf_h1_responsive_styles2() {
        $selector = array(
            'h1'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h1_responsive', '_2');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680', 'curly_mkdf_h1_responsive_styles2');
}

if (!function_exists('curly_mkdf_h2_responsive_styles2')) {
    function curly_mkdf_h2_responsive_styles2() {
        $selector = array(
            'h2'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h2_responsive', '_2');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680', 'curly_mkdf_h2_responsive_styles2');
}

if (!function_exists('curly_mkdf_h3_responsive_styles2')) {
    function curly_mkdf_h3_responsive_styles2() {
        $selector = array(
            'h3'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h3_responsive', '_2');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680', 'curly_mkdf_h3_responsive_styles2');
}

if (!function_exists('curly_mkdf_h4_responsive_styles2')) {
    function curly_mkdf_h4_responsive_styles2() {
        $selector = array(
            'h4'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h4_responsive', '_2');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680', 'curly_mkdf_h4_responsive_styles2');
}

if (!function_exists('curly_mkdf_h5_responsive_styles2')) {
    function curly_mkdf_h5_responsive_styles2() {
        $selector = array(
            'h5'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h5_responsive', '_2');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680', 'curly_mkdf_h5_responsive_styles2');
}

if (!function_exists('curly_mkdf_h6_responsive_styles2')) {
    function curly_mkdf_h6_responsive_styles2() {
        $selector = array(
            'h6'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('h6_responsive', '_2');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680', 'curly_mkdf_h6_responsive_styles2');
}

if (!function_exists('curly_mkdf_text_responsive_styles2')) {
    function curly_mkdf_text_responsive_styles2() {
        $selector = array(
            'body',
            'p'
        );

        $styles = curly_mkdf_get_responsive_typography_styles('text', '_res2');

        if (!empty($styles)) {
            echo curly_mkdf_dynamic_css($selector, $styles);
        }
    }

    add_action('curly_mkdf_style_dynamic_responsive_680', 'curly_mkdf_text_responsive_styles2');
}