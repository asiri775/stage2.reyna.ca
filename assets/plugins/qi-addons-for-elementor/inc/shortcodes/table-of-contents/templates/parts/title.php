<?php if ( ! empty( $title ) ) { ?>
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title qodef-exclude">
		<?php echo qi_addons_for_elementor_framework_wp_kses_html( 'content', $title ); ?>
	</<?php echo esc_attr( $title_tag ); ?>>
<?php } ?>
