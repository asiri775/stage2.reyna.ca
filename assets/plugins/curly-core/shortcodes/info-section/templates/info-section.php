<div class="mkdf-info-section <?php echo esc_attr($holder_classes); ?>">

    <?php if (!empty($background_text)) : ?>
        <?php echo '<' . esc_attr($background_text_tag); ?> class="mkdf-is-background-text" <?php echo curly_mkdf_get_inline_style($background_text_styles); ?> id="mkdf-is-background-text-<?php echo rand(0, 1000); ?>" <?php echo curly_mkdf_get_inline_attrs($data_atts); ?>>
        <?php echo esc_html($background_text) ?>
        <?php echo '</' . esc_attr($background_text_tag); ?>>
    <?php endif; ?>

    <div class="mkdf-is-inner" <?php echo curly_mkdf_get_inline_style($content_styles); ?>>

        <?php if (!empty($subtitle)) : ?>
            <?php echo '<' . esc_attr($subtitle_tag); ?> class="mkdf-is-subtitle">
            <?php echo esc_html($subtitle) ?>
            <?php echo '</' . esc_attr($subtitle_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <?php echo '<' . esc_attr($title_tag); ?> class="mkdf-is-title">
            <?php echo esc_html($title) ?>
            <?php echo '</' . esc_attr($title_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($text)) : ?>
            <?php echo '<' . esc_attr($text_tag); ?> class="mkdf-is-text">
            <?php echo esc_html($text) ?>
            <?php echo '</' . esc_attr($text_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($link)) : ?>
            <div class="mkdf-is-button" <?php echo curly_mkdf_get_inline_style($link_styles); ?>>
                <?php echo curly_mkdf_get_button_html($button_params); ?>
            </div>
        <?php endif ?>

    </div>
</div>