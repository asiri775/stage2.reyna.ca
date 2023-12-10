<?php
$image_proportion = ! empty( $proportion ) ? $proportion : 'full';

if ( ! empty( $image ) ) { ?>
	<div class="qodef-m-image">
		<?php echo wp_get_attachment_image( $image, $image_proportion ); ?>
	</div>
<?php } ?>
