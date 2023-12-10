<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php curly_mkdf_inline_style($button_styles); ?> <?php curly_mkdf_class_attribute($button_classes); ?> <?php echo curly_mkdf_get_inline_attrs($button_data); ?> <?php echo curly_mkdf_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo curly_mkdf_icon_collections()->renderIcon($icon, $icon_pack); ?>
</a>