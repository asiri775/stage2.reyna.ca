<div class="mkdf-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo curly_mkdf_get_inline_style($holder_styles); ?> <?php echo curly_mkdf_get_inline_attrs($holder_data); ?>>
    <div class="mkdf-eh-item-inner">
        <div class="mkdf-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo curly_mkdf_get_inline_style($content_styles); ?>>
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
</div>