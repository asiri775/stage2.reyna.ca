<?php
$image_proportion = isset( $image_proportion ) ? $image_proportion : 'full';

if ( ! empty( $image ) ) {
	?>
	<div class="qodef-m-media-image">
		<?php echo wp_get_attachment_image( $image, $image_proportion ); ?>
	</div>
<?php } ?>
