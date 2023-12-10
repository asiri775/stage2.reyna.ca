<?php
if ( ! empty( $item_title ) ) { ?>
	<<?php echo esc_attr( $item_title_tag ); ?> class="qodef-e-title">
		<?php echo esc_html( $item_title ); ?>
	</<?php echo esc_attr( $item_title_tag ); ?>>
	<?php
}
