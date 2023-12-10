<?php
$images_proportion = isset( $images_proportion ) ? $images_proportion : 'full';
?>
<div class="qodef-m-image">
	<?php echo wp_get_attachment_image( $image, $images_proportion ); ?>
</div>
