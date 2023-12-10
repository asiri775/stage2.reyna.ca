<?php

if ( ! function_exists( 'curly_core_register_widgets' ) ) {
    function curly_core_register_widgets() {
        $widgets = apply_filters( 'curly_core_filter_register_widgets', $widgets = array() );

        foreach ( $widgets as $widget ) {
            register_widget( $widget );
        }
    }

    add_action( 'widgets_init', 'curly_core_register_widgets' );
}