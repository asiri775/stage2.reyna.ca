<?php
$title_tag = isset( $name_tag ) && ! empty( $name_tag ) ? $name_tag : 'h4';

if ( ! empty( $name ) ) {
	?>
	<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-m-title">
		<?php echo esc_html( $name ); ?>
	</<?php echo esc_attr( $title_tag ); ?>>
	<?php
}
