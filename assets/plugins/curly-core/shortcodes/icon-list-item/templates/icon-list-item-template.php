<?php $icon_html = curly_mkdf_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="mkdf-icon-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo curly_mkdf_get_inline_style($holder_styles); ?>>
    <div class="mkdf-il-icon-holder">
        <?php echo wp_kses_post($icon_html); ?>
    </div>
    <p class="mkdf-il-text" <?php echo curly_mkdf_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>