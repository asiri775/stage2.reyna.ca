<?php if ( ! empty( $text_field ) ) : ?>
	<?php echo '<' . esc_attr( $text_tag ); ?> class="qodef-m-text">
		<?php echo esc_html( $text_field ); ?>
	<?php echo '</' . esc_attr( $text_tag ); ?>>
<?php endif; ?>
