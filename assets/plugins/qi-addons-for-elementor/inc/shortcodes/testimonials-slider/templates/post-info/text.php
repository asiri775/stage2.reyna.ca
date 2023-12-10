<?php
if ( ! empty( $item_text ) ) { ?>
	<<?php echo esc_attr( $item_text_tag ); ?> itemprop="description" class="qodef-e-text"><?php echo esc_html( $item_text ); ?></<?php echo esc_attr( $item_text_tag ); ?>>
<?php } ?>
