<?php
/**
 * Dropcaps shortcode template
 */
?>

<span class="mkdf-dropcaps <?php echo esc_attr($dropcaps_class); ?>" <?php curly_mkdf_inline_style($dropcaps_style); ?>>
	<?php echo esc_html($letter); ?>
</span>