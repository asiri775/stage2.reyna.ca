<?php
/**
 * Highlight shortcode template
 */
?>

<span class="mkdf-highlight" <?php curly_mkdf_inline_style($highlight_style); ?>>
	<?php echo esc_html($content); ?>
</span>