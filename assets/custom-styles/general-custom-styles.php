<?php

if (!function_exists('curly_mkdf_design_styles')) {
    /**
     * Generates general custom styles
     */
    function curly_mkdf_design_styles() {
        $font_family = curly_mkdf_options()->getOptionValue('google_fonts');
        if (!empty($font_family) && curly_mkdf_is_font_option_valid($font_family)) {
            $font_family_selector = array(
                'body'
            );
            echo curly_mkdf_dynamic_css($font_family_selector, array('font-family' => curly_mkdf_get_font_option_val($font_family)));
        }

        $first_main_color = curly_mkdf_options()->getOptionValue('first_color');
        if (!empty($first_main_color)) {

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // color

            $color_selector = array(
                'a:hover',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'p a:hover',
                'var',
                'blockquote a:hover',
                '.mkdf-comment-holder .mkdf-comment-text .comment-edit-link a:hover',
                '.mkdf-comment-holder .mkdf-comment-text .comment-edit-link:hover',
                '.mkdf-comment-holder .mkdf-comment-text .comment-reply-link a:hover',
                '.mkdf-comment-holder .mkdf-comment-text .comment-reply-link:hover',
                '.mkdf-comment-holder .mkdf-comment-text .mkdf-comment-date a:hover',
                '.mkdf-comment-holder .mkdf-comment-text .mkdf-comment-date:hover',
                '.mkdf-comment-holder .mkdf-comment-text .replay a:hover',
                '.mkdf-comment-holder .mkdf-comment-text .replay:hover',
                '.mkdf-comment-holder .mkdf-comment-text .comment-respond .comment-reply-title small',
                '.mkdf-comment-holder .mkdf-comment-text .comment-respond .comment-reply-title small a:hover',
                '.mkdf-owl-slider .owl-nav .owl-next:hover',
                '.mkdf-owl-slider .owl-nav .owl-prev:hover',
                '#mkdf-back-to-top',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text a',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text span',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text a:hover',
                '.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-twitter-icon i',
                'footer .widget a:hover',
                'footer .widget #wp-calendar tfoot a:hover',
                'footer .widget .mkdf-searchform .input-holder button:hover',
                'footer .widget .tagcloud a:hover',
                'footer .widget.mkdf-social-icons-group-widget.mkdf-square-icons .mkdf-social-icon-widget-holder:hover',
                '.mkdf-side-menu .widget a:hover',
                '.mkdf-side-menu .widget #wp-calendar tfoot a:hover',
                '.mkdf-side-menu .widget .mkdf-searchform .input-holder button:hover',
                '.mkdf-side-menu .widget .tagcloud a:hover',
                '.mkdf-side-menu .widget.mkdf-social-icons-group-widget.mkdf-square-icons .mkdf-social-icon-widget-holder:hover',
                '.wpb_widgetised_column .widget.widget_archive a:hover',
                '.wpb_widgetised_column .widget.widget_categories a:hover',
                '.wpb_widgetised_column .widget.widget_meta a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu a:hover',
                '.wpb_widgetised_column .widget.widget_pages a:hover',
                '.wpb_widgetised_column .widget.widget_recent_entries a:hover',
                'aside.mkdf-sidebar .widget.widget_archive a:hover',
                'aside.mkdf-sidebar .widget.widget_categories a:hover',
                'aside.mkdf-sidebar .widget.widget_meta a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu a:hover',
                'aside.mkdf-sidebar .widget.widget_pages a:hover',
                'aside.mkdf-sidebar .widget.widget_recent_entries a:hover',
                '.wpb_widgetised_column .widget a:hover',
                'aside.mkdf-sidebar .widget a:hover',
                '.wpb_widgetised_column .widget #wp-calendar tfoot a:hover',
                'aside.mkdf-sidebar .widget #wp-calendar tfoot a:hover',
                '.wpb_widgetised_column .widget .mkdf-searchform .input-holder button:hover',
                'aside.mkdf-sidebar .widget .mkdf-searchform .input-holder button:hover',
                '.wpb_widgetised_column .widget .tagcloud a:hover',
                'aside.mkdf-sidebar .widget .tagcloud a:hover',
                '.wpb_widgetised_column .widget.mkdf-social-icons-group-widget.mkdf-square-icons .mkdf-social-icon-widget-holder:hover',
                'aside.mkdf-sidebar .widget.mkdf-social-icons-group-widget.mkdf-square-icons .mkdf-social-icon-widget-holder:hover',
                'body .select2-container--default .select2-results__option--highlighted[aria-selected]',
                '.widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown .wpml-ls-item-toggle:hover',
                '.widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown-click .wpml-ls-item-toggle:hover',
                '.mkdf-blog-holder article.sticky .mkdf-post-title a',
                '.mkdf-blog-holder article .mkdf-post-info-top>div a:hover',
                '.mkdf-blog-holder article .mkdf-blog-like a:hover',
                '.mkdf-blog-holder article .mkdf-post-info-comments-holder a:hover',
                '.mkdf-blog-pagination ul li a a:hover',
                '.mkdf-blog-pagination ul li.mkdf-pag-first a:hover',
                '.mkdf-blog-pagination ul li.mkdf-pag-last a:hover',
                '.mkdf-blog-pagination ul li.mkdf-pag-next a:hover',
                '.mkdf-blog-pagination ul li.mkdf-pag-prev a:hover',
                '.mkdf-bl-standard-pagination ul li a a:hover',
                '.mkdf-bl-standard-pagination ul li.mkdf-bl-pag-next a:hover',
                '.mkdf-bl-standard-pagination ul li.mkdf-bl-pag-prev a:hover',
                '.mkdf-blog-holder.mkdf-blog-masonry article .mkdf-blog-list-button:hover',
                '.mkdf-blog-holder.mkdf-blog-masonry article .mkdf-blog-list-button:hover span',
                '.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-name a:hover',
                '.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-social-icons a:hover',
                '.mkdf-related-posts-holder .mkdf-related-post .mkdf-post-info>div a:hover',
                '.mkdf-blog-list-holder .mkdf-bli-info>div a:hover',
                '.mkdf-mobile-header .mkdf-mobile-menu-opener.mkdf-mobile-menu-opened a',
                '.mkdf-mobile-header .mkdf-mobile-nav .mkdf-grid>ul>li.mkdf-active-item>a',
                '.mkdf-mobile-header .mkdf-mobile-nav .mkdf-grid>ul>li.mkdf-active-item>h6',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav ul li h6:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-ancestor>a',
                '.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-ancestor>h6',
                '.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-item>a',
                '.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-item>h6',
                '.mkdf-search-page-holder article.sticky .mkdf-post-title a',
                '.mkdf-search-cover .mkdf-search-close:hover',
                '.mkdf-side-menu-button-opener.opened',
                '.mkdf-side-menu-button-opener:hover',
                '.mkdf-side-menu a.mkdf-close-side-menu:hover',
                '.mkdf-title-holder.mkdf-breadcrumbs-type .mkdf-breadcrumbs a a:hover',
                '.mkdf-title-holder.mkdf-breadcrumbs-type .mkdf-breadcrumbs a:hover',
                '.mkdf-title-holder.mkdf-breadcrumbs-type .mkdf-breadcrumbs span a:hover',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs a a:hover',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs a:hover',
                '.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs span a:hover',
                '.mkdf-portfolio-list-holder article .mkdf-pli-text .mkdf-pli-category-holder a a:hover',
                '.mkdf-portfolio-list-holder article .mkdf-pli-text .mkdf-pli-category-holder a:hover',
                '.mkdf-pl-filter-holder ul li span a:hover',
                '.mkdf-pl-filter-holder ul li.mkdf-pl-current span',
                '.mkdf-pl-filter-holder ul li:hover span',
                '.mkdf-pl-standard-pagination ul li a a:hover',
                '.mkdf-pl-standard-pagination ul li.mkdf-pl-pag-next a:hover',
                '.mkdf-pl-standard-pagination ul li.mkdf-pl-pag-prev a:hover',
                '.mkdf-portfolio-list-holder.mkdf-pl-gallery-overlay article .mkdf-pli-text .mkdf-pli-category-holder a:hover',
                '.mkdf-testimonials-holder .mkdf-testimonials-background-text',
                '.mkdf-testimonials-holder.mkdf-light .owl-nav .owl-next:hover',
                '.mkdf-testimonials-holder.mkdf-light .owl-nav .owl-prev:hover',
                '.mkdf-reviews-per-criteria .mkdf-item-reviews-average-rating',
                '.mkdf-btn.mkdf-btn-simple',
                '.mkdf-countdown .countdown-row .countdown-section .countdown-period a:hover',
                '.mkdf-counter-holder .mkdf-counter-background-text',
                '.mkdf-info-section .mkdf-is-background-text',
                '.mkdf-pie-chart-holder .mkdf-pc-percentage .mkdf-pc-percent a:hover',
                '.mkdf-section-title-holder .mkdf-st-background-text',
                '.mkdf-social-share-holder.mkdf-dropdown .mkdf-social-share-dropdown-opener:hover',
                '.mkdf-tabs .mkdf-tabs-nav li a a:hover',
                '.mkdf-team-holder.mkdf-light .mkdf-social-share-holder a:hover',
                '.mkdf-twitter-list-holder .mkdf-twitter-icon',
                '.mkdf-twitter-list-holder .mkdf-tweet-text a:hover',
                '.mkdf-twitter-list-holder .mkdf-twitter-profile a:hover',
                '.mkdf-bsl-holder .mkdf-bsl-item-description-holder',
                '.booked-appt-list h2 a:hover',
                '.booked-appt-list .booked-list-view-nav .booked-datepicker-wrap a:hover',
                '.booked-appt-list .booked-list-view-nav .booked-datepicker-wrap:hover',
                '.booked-appt-list .booked-list-view-nav .booked-list-view-date-next:hover',
                '.booked-appt-list .booked-list-view-nav .booked-list-view-date-prev:hover',
                '.booked-appt-list .timeslot .spots-available a:hover',
                '.booked-appt-list .timeslot button.button .button-timeslot a:hover',
                'body table.booked-calendar .monthName a:hover',
                'body .large table.booked-calendar .monthName a:hover',
                '#ui-datepicker-div.booked_custom_date_picker .ui-datepicker-title a:hover',
                'body .booked-modal .bm-window .booked-title-bar a:hover',
                'body .booked-modal .bm-window .booked-title-bar i.fa',
                'body .booked-modal .bm-window a:not(.close)',
                'body .booked-modal .bm-window .booked-form .appointment-title a:hover',
                '.mkdf-wh-holder .mkdf-wh-hours',
            );

            $woo_color_selector = array();
            if (curly_mkdf_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.mkdf-woocommerce-page table.cart tr.cart_item td.product-remove a:hover',
                    '.mkdf-woocommerce-page .cart-empty a:hover',
                    '.woocommerce .mkdf-new-product a:hover',
                    '.woocommerce .mkdf-onsale a:hover',
                    '.woocommerce .mkdf-out-of-stock a:hover',
                    '.woocommerce-pagination .page-numbers li a a:hover',
                    '.woocommerce-pagination .page-numbers li span a:hover',
                    '.woocommerce-pagination .page-numbers li a:hover.next',
                    '.woocommerce-pagination .page-numbers li a:hover.prev',
                    '.mkdf-woo-view-all-pagination a a:hover',
                    '.mkdf-woo-view-all-pagination a:hover',
                    '.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
                    '.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
                    'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
                    'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
                    '.woocommerce-page .mkdf-content label a:hover',
                    'div.woocommerce label a:hover',
                    '.mkdf-woocommerce-page .woocommerce-result-count a:hover',
                    'body.post-type-archive-product .select2-container--default .select2-dropdown .select2-results__option--highlighted',
                    'ul.products>.product .mkdf-pl-category a a:hover',
                    'ul.products>.product .mkdf-pl-category a:hover',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .woocommerce-review-link a:hover',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .product_meta>span .sku:hover',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .product_meta>span a:hover',
                    '.mkdf-woo-single-page .mkdf-single-product-summary .mkdf-woo-social-share-holder>span a:hover',
                    '.mkdf-woo-single-page .woocommerce-tabs ul.tabs>li a a:hover',
                    '.mkdf-woo-single-page .woocommerce-tabs table th a:hover',
                    '.mkdf-woo-single-page .woocommerce-tabs #reviews h2 a:hover',
                    '.mkdf-woo-single-page .woocommerce-tabs #reviews ol.commentlist .comment-text .meta strong a:hover',
                    '.mkdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .comment-reply-title a:hover',
                    '.mkdf-woo-single-page .related.products>h2 a:hover',
                    '.mkdf-woo-single-page .upsells.products>h2 a:hover',
                    '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-product-title a:hover',
                    '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .remove:hover',
                    '.widget.woocommerce.widget_layered_nav a:hover',
                    '.widget.woocommerce.widget_product_categories a:hover',
                    '.widget.woocommerce .product-title a:hover',
                    '.widget.woocommerce.widget_layered_nav .chosen a',
                    '.widget.woocommerce.widget_price_filter .price_slider_amount .price_label a:hover',
                    '.widget.woocommerce.widget_recent_reviews a a:hover',
                    '.widget.woocommerce.widget_shopping_cart a a:hover',
                    '.widget.woocommerce.widget_shopping_cart .buttons .button',
                    '.widget.woocommerce.widget_shopping_cart .buttons .button:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-new-product a:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-onsale a:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-out-of-stock a:hover',
                    '.mkdf-pl-holder .mkdf-pli-category a:hover',
                    '.mkdf-pl-holder.mkdf-product-info-light .mkdf-pli-category a:hover',
                    '.mkdf-pl-holder.mkdf-product-info-light .mkdf-pli-title a:hover',
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // color important

            $color_important_selector = array(
                'p a:hover>span',
                '.mkdf-btn.mkdf-btn-simple:not(.mkdf-btn-custom-hover-color):not(.mkdf-blog-list-button):hover',
                '.booked-appt-list .timeslot .timeslot-title',
                'body .booked-modal .bm-window .booked-form .appointment-title',
            );

            $woo_color_important_selector = array();
            if (curly_mkdf_is_woocommerce_installed()) {
                $woo_color_important_selector = array(
                    'ul.products>.product .mkdf-pl-cart-price-holder .added_to_cart.wc-forward',
                    'ul.products>.product .mkdf-pl-cart-price-holder .button',
                    '.mkdf-pl-holder .mkdf-pli-cart-price-holder .added_to_cart.wc-forward',
                    '.mkdf-pl-holder .mkdf-pli-cart-price-holder .button',
                );
            }

            $color_important_selector = array_merge($color_important_selector, $woo_color_important_selector);

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // background color

            $background_color_selector = array(
                '.mkdf-st-loader .pulse',
                '.mkdf-st-loader .double_pulse .double-bounce1',
                '.mkdf-st-loader .double_pulse .double-bounce2',
                '.mkdf-st-loader .cube',
                '.mkdf-st-loader .rotating_cubes .cube1',
                '.mkdf-st-loader .rotating_cubes .cube2',
                '.mkdf-st-loader .stripes>div',
                '.mkdf-st-loader .wave>div',
                '.mkdf-st-loader .two_rotating_circles .dot1',
                '.mkdf-st-loader .two_rotating_circles .dot2',
                '.mkdf-st-loader .five_rotating_circles .container1>div',
                '.mkdf-st-loader .five_rotating_circles .container2>div',
                '.mkdf-st-loader .five_rotating_circles .container3>div',
                '.mkdf-st-loader .atom .ball-1:before',
                '.mkdf-st-loader .atom .ball-2:before',
                '.mkdf-st-loader .atom .ball-3:before',
                '.mkdf-st-loader .atom .ball-4:before',
                '.mkdf-st-loader .clock .ball:before',
                '.mkdf-st-loader .mitosis .ball',
                '.mkdf-st-loader .lines .line1',
                '.mkdf-st-loader .lines .line2',
                '.mkdf-st-loader .lines .line3',
                '.mkdf-st-loader .lines .line4',
                '.mkdf-st-loader .fussion .ball',
                '.mkdf-st-loader .fussion .ball-1',
                '.mkdf-st-loader .fussion .ball-2',
                '.mkdf-st-loader .fussion .ball-3',
                '.mkdf-st-loader .fussion .ball-4',
                '.mkdf-st-loader .wave_circles .ball',
                '.mkdf-st-loader .pulse_circles .ball',
                '#submit_comment:hover',
                '.post-password-form input[type=submit]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '#mkdf-back-to-top:hover',
                'footer .widget.mkdf-social-icons-group-widget.mkdf-square-icons.mkdf-light-skin .mkdf-social-icon-widget-holder:hover',
                '.mkdf-side-menu .widget.mkdf-social-icons-group-widget.mkdf-square-icons.mkdf-light-skin .mkdf-social-icon-widget-holder:hover',
                '.wpb_widgetised_column .widget.mkdf-social-icons-group-widget.mkdf-square-icons.mkdf-light-skin .mkdf-social-icon-widget-holder:hover',
                'aside.mkdf-sidebar .widget.mkdf-social-icons-group-widget.mkdf-square-icons.mkdf-light-skin .mkdf-social-icon-widget-holder:hover',
                '.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
                '.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.mkdf-accordion-holder.mkdf-ac-boxed .mkdf-accordion-title.ui-state-active',
                '.mkdf-accordion-holder.mkdf-ac-boxed .mkdf-accordion-title.ui-state-hover',
                '.mkdf-icon-shortcode.mkdf-circle',
                '.mkdf-icon-shortcode.mkdf-dropcaps.mkdf-circle',
                '.mkdf-icon-shortcode.mkdf-square',
                '.mkdf-progress-bar .mkdf-pb-content-holder .mkdf-pb-content',
                '.mkdf-bsl-holder .mkdf-bsl-item-label-holder .mkdf-bsl-item-label',
                'body table.booked-calendar',
                'body table.booked-calendar td:hover .date span',
                'body .booked-modal .bm-window .close',
            );

            $woo_background_color_selector = array();
            if (curly_mkdf_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce-page .mkdf-content .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    '.woocommerce-page .mkdf-content a.added_to_cart:hover',
                    '.woocommerce-page .mkdf-content a.button:hover',
                    '.woocommerce-page .mkdf-content button[type=submit]:not(.mkdf-search-submit):hover',
                    '.woocommerce-page .mkdf-content input[type=submit]:hover',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    'div.woocommerce a.added_to_cart:hover',
                    'div.woocommerce a.button:hover',
                    'div.woocommerce button[type=submit]:not(.mkdf-search-submit):hover',
                    'div.woocommerce input[type=submit]:hover',
                    '.woocommerce .mkdf-onsale',
                    '.woocommerce .mkdf-out-of-stock',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-checkout:hover',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-view-cart:hover',
                    '.widget.woocommerce.widget_price_filter .price_slider_amount .button:hover',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-onsale',
                    '.mkdf-pl-holder .mkdf-pli-inner .mkdf-pli-image .mkdf-pli-out-of-stock',
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // background color important

            $background_color_important_selector = array(
                '.booked-appt-list .booked_list_date_picker_trigger.booked-dp-active',
                '.booked-appt-list .timeslot button.button',
                'body table.booked-calendar th',
                'body table.booked-calendar thead',
                'body table.booked-calendar thead th',
                'body table.booked-calendar thead tr',
                'body table.booked-calendar td.today .date span',
                'body table.booked-calendar td.today:hover .date span',
                '#ui-datepicker-div.booked_custom_date_picker .ui-datepicker-header',
                '#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar thead',
                '#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td a.ui-state-active',
                '#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td a.ui-state-active:hover',
                'body .booked-modal .bm-window input[type=submit].button-primary:hover',
                'body .booked-modal .bm-window button.cancel:hover',
            );

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // border color

            $border_color_selector = array(
                '.mkdf-st-loader .pulse_circles .ball',
                '.mkdf-owl-slider+.mkdf-slider-thumbnail>.mkdf-slider-thumbnail-item.active img',
                '#mkdf-back-to-top',
                '.mkdf-portfolio-list-holder.mkdf-pl-gallery-overlay .mkdf-pli-text-holder',
                '.mkdf-banner-holder .mkdf-banner-link:before',
                'body table.booked-calendar',
                '#ui-datepicker-div.booked_custom_date_picker',
                'body .booked-modal .bm-window',
            );

            $woo_border_color_selector = array();
            if (curly_mkdf_is_woocommerce_installed()) {
                $woo_border_color_selector = array(
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-checkout:hover',
                    '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-view-cart:hover',
                    '.widget.woocommerce.widget_price_filter .price_slider_amount .button:hover',
                );
            }

            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // border color important

            $border_color_important_selector = array(
                '.booked-appt-list .timeslot button.button',
                'body .booked-modal .bm-window button.cancel:hover',
            );

            echo curly_mkdf_dynamic_css($color_selector, array('color' => $first_main_color));
            echo curly_mkdf_dynamic_css($color_important_selector, array('color' => $first_main_color . '!important'));
            echo curly_mkdf_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
            echo curly_mkdf_dynamic_css($background_color_important_selector, array('background-color' => $first_main_color . '!important'));
            echo curly_mkdf_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
            echo curly_mkdf_dynamic_css($border_color_important_selector, array('border-color' => $first_main_color . '!important'));
        }

        $page_background_color = curly_mkdf_options()->getOptionValue('page_background_color');
        if (!empty($page_background_color)) {
            $background_color_selector = array(
                'body',
                '.mkdf-content'
            );
            echo curly_mkdf_dynamic_css($background_color_selector, array('background-color' => $page_background_color));
        }

        $selection_color = curly_mkdf_options()->getOptionValue('selection_color');
        if (!empty($selection_color)) {
            echo curly_mkdf_dynamic_css('::selection', array('background' => $selection_color));
            echo curly_mkdf_dynamic_css('::-moz-selection', array('background' => $selection_color));
        }

        $preload_background_styles = array();

        if (curly_mkdf_options()->getOptionValue('preload_pattern_image') !== "") {
            $preload_background_styles['background-image'] = 'url(' . curly_mkdf_options()->getOptionValue('preload_pattern_image') . ') !important';
        }

        echo curly_mkdf_dynamic_css('.mkdf-preload-background', $preload_background_styles);
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_design_styles');
}

if (!function_exists('curly_mkdf_content_styles')) {
    function curly_mkdf_content_styles() {
        $content_style = array();

        $padding = curly_mkdf_options()->getOptionValue('content_padding');
        if ($padding !== '') {
            $content_style['padding'] = $padding;
        }

        $content_selector = array(
            '.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
        );

        echo curly_mkdf_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();

        $padding_in_grid = curly_mkdf_options()->getOptionValue('content_padding_in_grid');
        if ($padding_in_grid !== '') {
            $content_style_in_grid['padding'] = $padding_in_grid;
        }

        $content_selector_in_grid = array(
            '.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
        );

        echo curly_mkdf_dynamic_css($content_selector_in_grid, $content_style_in_grid);
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_content_styles');
}

if (!function_exists('curly_mkdf_h1_styles')) {
    function curly_mkdf_h1_styles() {
        $margin_top = curly_mkdf_options()->getOptionValue('h1_margin_top');
        $margin_bottom = curly_mkdf_options()->getOptionValue('h1_margin_bottom');

        $item_styles = curly_mkdf_get_typography_styles('h1');

        if ($margin_top !== '') {
            $item_styles['margin-top'] = curly_mkdf_filter_px($margin_top) . 'px';
        }
        if ($margin_bottom !== '') {
            $item_styles['margin-bottom'] = curly_mkdf_filter_px($margin_bottom) . 'px';
        }

        $item_selector = array(
            'h1'
        );

        if (!empty($item_styles)) {
            echo curly_mkdf_dynamic_css($item_selector, $item_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_h1_styles');
}

if (!function_exists('curly_mkdf_h2_styles')) {
    function curly_mkdf_h2_styles() {
        $margin_top = curly_mkdf_options()->getOptionValue('h2_margin_top');
        $margin_bottom = curly_mkdf_options()->getOptionValue('h2_margin_bottom');

        $item_styles = curly_mkdf_get_typography_styles('h2');

        if ($margin_top !== '') {
            $item_styles['margin-top'] = curly_mkdf_filter_px($margin_top) . 'px';
        }
        if ($margin_bottom !== '') {
            $item_styles['margin-bottom'] = curly_mkdf_filter_px($margin_bottom) . 'px';
        }

        $item_selector = array(
            'h2'
        );

        if (!empty($item_styles)) {
            echo curly_mkdf_dynamic_css($item_selector, $item_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_h2_styles');
}

if (!function_exists('curly_mkdf_h3_styles')) {
    function curly_mkdf_h3_styles() {
        $margin_top = curly_mkdf_options()->getOptionValue('h3_margin_top');
        $margin_bottom = curly_mkdf_options()->getOptionValue('h3_margin_bottom');

        $item_styles = curly_mkdf_get_typography_styles('h3');

        if ($margin_top !== '') {
            $item_styles['margin-top'] = curly_mkdf_filter_px($margin_top) . 'px';
        }
        if ($margin_bottom !== '') {
            $item_styles['margin-bottom'] = curly_mkdf_filter_px($margin_bottom) . 'px';
        }

        $item_selector = array(
            'h3'
        );

        if (!empty($item_styles)) {
            echo curly_mkdf_dynamic_css($item_selector, $item_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_h3_styles');
}

if (!function_exists('curly_mkdf_h4_styles')) {
    function curly_mkdf_h4_styles() {
        $margin_top = curly_mkdf_options()->getOptionValue('h4_margin_top');
        $margin_bottom = curly_mkdf_options()->getOptionValue('h4_margin_bottom');

        $item_styles = curly_mkdf_get_typography_styles('h4');

        if ($margin_top !== '') {
            $item_styles['margin-top'] = curly_mkdf_filter_px($margin_top) . 'px';
        }
        if ($margin_bottom !== '') {
            $item_styles['margin-bottom'] = curly_mkdf_filter_px($margin_bottom) . 'px';
        }

        $item_selector = array(
            'h4'
        );

        if (!empty($item_styles)) {
            echo curly_mkdf_dynamic_css($item_selector, $item_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_h4_styles');
}

if (!function_exists('curly_mkdf_h5_styles')) {
    function curly_mkdf_h5_styles() {
        $margin_top = curly_mkdf_options()->getOptionValue('h5_margin_top');
        $margin_bottom = curly_mkdf_options()->getOptionValue('h5_margin_bottom');

        $item_styles = curly_mkdf_get_typography_styles('h5');

        if ($margin_top !== '') {
            $item_styles['margin-top'] = curly_mkdf_filter_px($margin_top) . 'px';
        }
        if ($margin_bottom !== '') {
            $item_styles['margin-bottom'] = curly_mkdf_filter_px($margin_bottom) . 'px';
        }

        $item_selector = array(
            'h5'
        );

        if (!empty($item_styles)) {
            echo curly_mkdf_dynamic_css($item_selector, $item_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_h5_styles');
}

if (!function_exists('curly_mkdf_h6_styles')) {
    function curly_mkdf_h6_styles() {
        $margin_top = curly_mkdf_options()->getOptionValue('h6_margin_top');
        $margin_bottom = curly_mkdf_options()->getOptionValue('h6_margin_bottom');

        $item_styles = curly_mkdf_get_typography_styles('h6');

        if ($margin_top !== '') {
            $item_styles['margin-top'] = curly_mkdf_filter_px($margin_top) . 'px';
        }
        if ($margin_bottom !== '') {
            $item_styles['margin-bottom'] = curly_mkdf_filter_px($margin_bottom) . 'px';
        }

        $item_selector = array(
            'h6'
        );

        if (!empty($item_styles)) {
            echo curly_mkdf_dynamic_css($item_selector, $item_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_h6_styles');
}

if (!function_exists('curly_mkdf_text_styles')) {
    function curly_mkdf_text_styles() {
        $item_styles = curly_mkdf_get_typography_styles('text');

        $item_selector = array(
            'p'
        );

        if (!empty($item_styles)) {
            echo curly_mkdf_dynamic_css($item_selector, $item_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_text_styles');
}

if (!function_exists('curly_mkdf_link_styles')) {
    function curly_mkdf_link_styles() {
        $link_styles = array();
        $link_color = curly_mkdf_options()->getOptionValue('link_color');
        $link_font_style = curly_mkdf_options()->getOptionValue('link_fontstyle');
        $link_font_weight = curly_mkdf_options()->getOptionValue('link_fontweight');
        $link_decoration = curly_mkdf_options()->getOptionValue('link_fontdecoration');

        if (!empty($link_color)) {
            $link_styles['color'] = $link_color;
        }
        if (!empty($link_font_style)) {
            $link_styles['font-style'] = $link_font_style;
        }
        if (!empty($link_font_weight)) {
            $link_styles['font-weight'] = $link_font_weight;
        }
        if (!empty($link_decoration)) {
            $link_styles['text-decoration'] = $link_decoration;
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo curly_mkdf_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_link_styles');
}

if (!function_exists('curly_mkdf_link_hover_styles')) {
    function curly_mkdf_link_hover_styles() {
        $link_hover_styles = array();
        $link_hover_color = curly_mkdf_options()->getOptionValue('link_hovercolor');
        $link_hover_decoration = curly_mkdf_options()->getOptionValue('link_hover_fontdecoration');

        if (!empty($link_hover_color)) {
            $link_hover_styles['color'] = $link_hover_color;
        }
        if (!empty($link_hover_decoration)) {
            $link_hover_styles['text-decoration'] = $link_hover_decoration;
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo curly_mkdf_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if (!empty($link_hover_color)) {
            $link_heading_hover_styles['color'] = $link_hover_color;
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo curly_mkdf_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('curly_mkdf_style_dynamic', 'curly_mkdf_link_hover_styles');
}

if (!function_exists('curly_mkdf_smooth_page_transition_styles')) {
    function curly_mkdf_smooth_page_transition_styles($style) {
        $id = curly_mkdf_get_page_id();
        $loader_style = array();
        $current_style = '';

        $background_color = curly_mkdf_get_meta_field_intersect('smooth_pt_bgnd_color', $id);
        if (!empty($background_color)) {
            $loader_style['background-color'] = $background_color;
        }

        $loader_selector = array(
            '.mkdf-smooth-transition-loader'
        );

        if (!empty($loader_style)) {
            $current_style .= curly_mkdf_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();
        $spinner_color = curly_mkdf_get_meta_field_intersect('smooth_pt_spinner_color', $id);
        if (!empty($spinner_color)) {
            $spinner_style['background-color'] = $spinner_color;
        }

        $spinner_selectors = array(
            '.mkdf-st-loader .mkdf-rotate-circles > div',
            '.mkdf-st-loader .pulse',
            '.mkdf-st-loader .double_pulse .double-bounce1',
            '.mkdf-st-loader .double_pulse .double-bounce2',
            '.mkdf-st-loader .cube',
            '.mkdf-st-loader .rotating_cubes .cube1',
            '.mkdf-st-loader .rotating_cubes .cube2',
            '.mkdf-st-loader .stripes > div',
            '.mkdf-st-loader .wave > div',
            '.mkdf-st-loader .two_rotating_circles .dot1',
            '.mkdf-st-loader .two_rotating_circles .dot2',
            '.mkdf-st-loader .five_rotating_circles .container1 > div',
            '.mkdf-st-loader .five_rotating_circles .container2 > div',
            '.mkdf-st-loader .five_rotating_circles .container3 > div',
            '.mkdf-st-loader .atom .ball-1:before',
            '.mkdf-st-loader .atom .ball-2:before',
            '.mkdf-st-loader .atom .ball-3:before',
            '.mkdf-st-loader .atom .ball-4:before',
            '.mkdf-st-loader .clock .ball:before',
            '.mkdf-st-loader .mitosis .ball',
            '.mkdf-st-loader .lines .line1',
            '.mkdf-st-loader .lines .line2',
            '.mkdf-st-loader .lines .line3',
            '.mkdf-st-loader .lines .line4',
            '.mkdf-st-loader .fussion .ball',
            '.mkdf-st-loader .fussion .ball-1',
            '.mkdf-st-loader .fussion .ball-2',
            '.mkdf-st-loader .fussion .ball-3',
            '.mkdf-st-loader .fussion .ball-4',
            '.mkdf-st-loader .wave_circles .ball',
            '.mkdf-st-loader .pulse_circles .ball'
        );

        if (!empty($spinner_style)) {
            $current_style .= curly_mkdf_dynamic_css($spinner_selectors, $spinner_style);
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('curly_mkdf_add_page_custom_style', 'curly_mkdf_smooth_page_transition_styles');
}