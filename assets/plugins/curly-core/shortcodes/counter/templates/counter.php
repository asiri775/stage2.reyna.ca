<div class="mkdf-counter-holder <?php echo esc_attr($holder_classes); ?>">

    <?php if (!empty($background_text)) : ?>
        <?php echo '<' . esc_attr($background_text_tag); ?> class="mkdf-counter-background-text" <?php echo curly_mkdf_get_inline_style($background_text_styles); ?>>
        <?php echo esc_html($background_text) ?>
        <?php echo '</' . esc_attr($background_text_tag); ?>>
    <?php endif; ?>

    <div class="mkdf-counter-inner">

        <?php if (!empty($digit)) : ?>
            <span class="mkdf-counter <?php echo esc_attr($type) ?>" <?php echo curly_mkdf_get_inline_style($counter_styles); ?>>
                <?php echo esc_html($digit); ?>
            </span>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <?php echo '<' . esc_attr($title_tag); ?> class="mkdf-counter-title">
            <?php echo esc_html($title); ?>
            <?php echo '</' . esc_attr($title_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($text)) : ?>
            <p class="mkdf-counter-text"><?php echo esc_html($text); ?></p>
        <?php endif; ?>

    </div>
</div>