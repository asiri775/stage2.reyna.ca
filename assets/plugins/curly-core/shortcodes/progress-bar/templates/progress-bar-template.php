<div class="mkdf-progress-bar <?php echo esc_attr($holder_classes); ?>">
    <<?php echo esc_attr($title_tag); ?> class="mkdf-pb-title-holder" <?php echo curly_mkdf_inline_style($title_styles); ?>>
    <span class="mkdf-pb-title"><?php echo esc_html($title); ?></span>
    <span class="mkdf-pb-percent">0</span>
</<?php echo esc_attr($title_tag); ?>>
<div class="mkdf-pb-content-holder" <?php echo curly_mkdf_inline_style($inactive_bar_style); ?>>
    <div data-percentage=<?php echo esc_attr($percent); ?> class="mkdf-pb-content" <?php echo curly_mkdf_inline_style($active_bar_style); ?>></div>
</div>
</div>